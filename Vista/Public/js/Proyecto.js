
$(document).ready(function () {
    $("#btnTutoria").on("click", function (e) {
        enviarTutoria();
    });

    
    
    $("#panelAgregar").on("click","#btnInvitarProyecto",function (e){
       enviarCorreoInvitacion(); 
    });

    llenarProyecto();

    $("#formRegistrarProyecto").validate(
            {debug: true,
                errorPlacement: function (error, element) {
                    var aux = error[0];
                    var nombreError = aux["outerText"];
                    var c = element["0"];
                    var idGeneradorError = c["id"];

                    $("#error-" + idGeneradorError).html(nombreError);
                    var padre = element.parents("div.form-group");
                    padre.removeClass("has-error");
                    padre.addClass("has-error");

                },
                rules: {
                    resumenP: {required: true},
                    nombreP: {required: true},
                    lineaP:{required:true}
                },
                messages:
                        {
                            nombreP: "Nombre vacio",
                            resumenP: "Codigo vacio",
                            lineaP: "Seleccione una linea de investigacion"

                        },
                submitHandler: function (form) {
                    var datos = {
                        nombreP: $("#nombreP").val(),
                        resumenP: $("#resumenP").val(),
                        lineaP:$("select[name=lineaP]").val()
                    };
                    $.ajax({
                        url: "Vista/Modulos/Ajax.php",
                        method: 'POST',
                        data: datos,
                        dataType: 'json',
                        success: function (respuesta)
                        {

                            if (respuesta["exito"]) {
                                respuestaExitoRecargar("Registro Exitoso", "Has registrado un proyecto de manera exitosa.\nPuedes modificar los datos del proyecto e invitar a tus compañeros");
                            } else if (!respuesta["exito"]) {
                                respuestaError("Error Registro", "Error : " + respuesta["error"]);
                            }

                        }
                    });
                }
            }
    );

});

function enviarTutoria() {
    var asignatura = $("select[name=asignaturaP]").val();
    var docente = $("select[name=docenteP]").val();
    if (docente == "") {
        respuestaPeligro("Seleccione un docente");
        return;
    }
    if (asignatura == "") {
        respuestaPeligro("Seleccione una asignatura.");
        return;
    }
    var datos = {
        asignaturaP: asignatura,
        docenteP: docente

    };
    $.ajax({
        url: "Vista/Modulos/Ajax.php",
        method: "POST",
        data: datos,
        dataType: 'json',
        success: function (respuesta) {
            if (respuesta instanceof Object) {
                if (respuesta["exito"]) {
                    respuestaExito("Seleccionaste una tutoria");
                    mostrarTutoriasSeleccionadas();
                } else {
                    respuestaPeligro(respuesta["error"]);
                }
            }
        }
    });
}



function llenarProyecto(){
    $("#btnInvitarProyecto").on("click",function (e){
       $("#invitarProyecto").modal("show");
   });
   
    var url = window.location.pathname;
    if (url.indexOf("Proyecto")!=-1) {
        mostrarProyecto();
    } 
}


function mostrarProyecto(){
    $.ajax({
       url:"Vista/Modulos/Ajax.php",
       method:"post",
        data: {listarProyecto:true},
        dataType: 'json',
        success:function (respuesta){   
            if (respuesta instanceof Object) {
                
                if (!respuesta["exito"]) {
                   window.location.replace( "http://localhost/Proyectosdeaula/Inicio");
                  
                }
                var general= respuesta["datosGenerales"][0];
                var integrantes= respuesta["integrantes"];
                var tutorias= respuesta ["tutorias"];
                
                $("#tituloProyecto").html(general["titulo"]);
                $("#resumenProyecto").html(general["resumen"]);
                $("#lineaProyecto").html(general["lineainvestigacion"]);   
                if (general["estado"]=="inscripcion" && respuesta["lider"] && respuesta["tipo"]=="Estudiante") {
                    $("#panelAgregar").html('<div id="miniPanel" class="col-md-12" style="margin-bottom: 3%" >\n\
<label for="correoInvitacion">Correo electronico</label>\n\
<input id="correoInvitacion" type="text" class="form-control"><label class="bg-danger" id="error-correoInvitacion"></label></div>\n\
<div class="col-md-12" >\n\
<a id="btnInvitarProyecto" class="btn btn-primary" style="margin-bottom: 3%">Invitar Compañero</a></div>');
                }
                var tablaIntegrantes="";
                for (var i = 0; i < integrantes.length; i++) {                 
                    var integrante= integrantes[i];   
                    console.log(integrante);
                    var lider=integrante["lider"]==1 ?"Lider":"Integrante";
                    tablaIntegrantes+="<tr><td>"+integrante["codigoprogramaestudiante"]+integrante["codigoestudiante"]+"</td><td>"+integrante["nombreestudiante"]+"</td><td>"+lider+"</td><td>"+integrante["programaestudiante"]+"</td></tr>"
                }
                $("#integrantesProyecto").html(tablaIntegrantes);
                var tablaTutoria="";
                for (var i = 0; i < tutorias.length; i++) {
                    var tutoria= tutorias[i] ;                        
                    if (i==0) {
                        tablaTutoria+="<tr data-expanded='true' ><td>"+tutoria["codigoprogramadocente"]+tutoria["codigodocente"]+"</td><td>"+tutoria["nombredocente"]+"</td><td>"+tutoria["programadocente"]+"</td><td>"+tutoria["codigoprogramaasignatura"]+tutoria["codigoasignatura"]+"</td><td>"+tutoria["nombreasignatura"]+"</td><td>"+tutoria["programaasignatura"]+"</td></tr>";
                
                    }else
                    tablaTutoria+="<tr><td>"+tutoria["codigoprogramadocente"]+tutoria["codigodocente"]+"</td><td>"+tutoria["nombredocente"]+"</td><td>"+tutoria["programadocente"]+"</td><td>"+tutoria["codigoprogramaasignatura"]+tutoria["codigoasignatura"]+"</td><td>"+tutoria["nombreasignatura"]+"</td><td>"+tutoria["programaasignatura"]+"</td></tr>";
                }
                $("#tutoriaProyecto").html(tablaTutoria);
                
                 $(".footable").footable({
                     "empty":"No hay tutorias",
                    "filtering": {
                        "placeholder": "Buscar"                        
                    }
                    
                });
            }
        }
        
        
    });
    
};

function enviarCorreoInvitacion(){
    var correo=$("#correoInvitacion").val();
    if (validarCorreo(correo)) {
        return;
    }    
    var datos={correoInvitacion:correo};    
    $.ajax({
        url:"Vista/Modulos/Ajax.php",
        method:"post",
        data:datos,
        dataType: 'json',
        beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.")

                },
        success: function (respuesta){
            if (respuesta instanceof Object) {
                if (respuesta["exito"]) {
                    respuestaExitoRecargar("Invitacion Enviada","Has enviado un correo de invitacion a tu proyecto.");
                }else{
                    respuestaError("Error de envio",respuesta["error"]);
                }
            }
        }
    })
}


function validarCorreo(correo){    
    var aux=false;
    var correoFiltrado= correo.replace(" ","");
    if(correoFiltrado.length==0){
        $("#error-correoInvitacion").html("Correo vacio");
        $("#miniPanel").addClass("has-error");
        aux=true;
    }else if (correo.indexOf("@")==-1) {
        $("#error-correoInvitacion").html("Ingrese un correo correcto (asdf@asdf.com)");
        $("#miniPanel").addClass("has-error");
        aux=true;
    }else if(correoFiltrado.length>30){
        $("#error-correoInvitacion").html("Ingrese maximo 30 caracteres");
        $("#miniPanel").addClass("has-error");
        aux=true;
    }else {
        $("#error-correoInvitacion").html("");
        $("#miniPanel").removeClass("has-error");
    }
    return aux;
}