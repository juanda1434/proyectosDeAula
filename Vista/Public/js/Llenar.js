var lineas;

function llenarCards() {
    var url = window.location.pathname;
    if (url.indexOf("Inicio") != -1) {
        filtrarFerias();
    }
}
function llenarSelect() {
    var url = window.location.pathname;
    if (url.indexOf("Registro") != -1) {
        llenarProgramas();
    }
}

function llenarTabla() {
    var url = window.location.pathname;
    if (url.indexOf("Perfil") != -1) {
        llenarPerfil();
    } else if (url.indexOf("Inscribir") != -1) {
        llenarDocentes();
        llenarAsignaturas();
        llenarLineasInvestigacion();
        mostrarTutoriasSeleccionadas();
    } else if (url.indexOf("MisProyectos") != -1) {
        mostrarMisProyectos();

    }else if (url.indexOf("Feria")!=-1) {
        mostrarFeria();
    }
}

function llenarProgramas() {

    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?programasAcademicos=true",
                dataType: 'json',
                success: function (respuesta)
                {
                    if (respuesta instanceof Object) {
                        var opciones = "";
                        for (var i = 0; i < respuesta.length; i++) {
                            var programa = respuesta[i];
                            opciones += '<option  value="' + programa["nombre"] + '">' + programa["nombre"] + '</option>';

                        }
                        var inicio = '<div class="col-md-12"><label class="" for="programaE">Programa academico</label>\n\
<select name="programaE" class="form-control" id="programaE">\n\
<option  value="">Programas academicos</option>';
                        var fin = '</select><label class="bg-danger"  id="error-programaE"></label></div>';
                        $(".programas").html(inicio + opciones + fin);
                    }

                }
            });
}

$(document).ready(function () {
    llenarSelect();
    llenarTabla();
    llenarCards();



});

function llenarPerfil() {
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?datosPerfil=true",
                dataType: 'json',
                success: function (respuesta)
                {
                    if (respuesta instanceof Object) {
                        var fila = "";
                        for (var key in respuesta) {
                            fila += "<tr><th>" + key + "</th><td>" + respuesta[key] + "</td></tr>";
                        }

                        $("#datosPerfil").html(fila);
                    }

                }
            });
}


function llenarDocentes() {
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?docentes=true",
                dataType: 'json',
                success: function (respuesta)
                {
                    if (respuesta instanceof Object) {
                        var opciones = "";
                        for (var i = 0; i < respuesta.length; i++) {
                            var docente = respuesta[i];
                            opciones += '<option  value="' + docente["codigoprograma"] + docente["codigo"] + '">' + "[" + docente["codigoprograma"] + docente["codigo"] + "] " + docente["nombre"] + '</option>';

                        }
                        var inicio = '<label class="" for="docenteP">Tutor</label>\n\
<select name="docenteP" class="form-control" id="docenteP">\n\
<option  value="">Seleccione tutor</option>';
                        var fin = '</select><label id="error-docenteP"></label></div>';
                        $(".docentes").html(inicio + opciones + fin);
                    }

                }
            });
}

function llenarAsignaturas() {
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?asignaturas=true",
                dataType: 'json',
                success: function (respuesta)
                {
                    if (respuesta instanceof Object) {
                        var opciones = "";
                        for (var i = 0; i < respuesta.length; i++) {
                            var asignatura = respuesta[i];
                            opciones += '<option  value="' + asignatura["codigoprograma"] + asignatura["codigo"] + '">' + "[" + asignatura["codigoprograma"] + asignatura["codigo"] + "] " + asignatura["nombre"] + '</option>';

                        }
                        var inicio = '<label class="" for="asignaturaP">Asignatura</label>\n\
<select name="asignaturaP" class="form-control" id="asignaturaP">\n\
<option  value="">Seleccione asignatura</option>';
                        var fin = '</select><label id="error-asignaturaP"></label></div>';
                        $(".asignaturas").html(inicio + opciones + fin);
                    }

                }
            });
}

function llenarLineasInvestigacion() {
    $("#mostrarLineaBoton").on("click", function (e) {
        var seleccion = $("select[name=lineaP]").val();
        var body = lineas[seleccion];
        mostrarInfoLinea(seleccion, body);
    });

    $("#infoLinea").on("hide.bs.modal", function (e) {
        $("#infoLineaTitulo").html("");
        $("#infoLineaBody").html("");
    });
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?lineasInvestigacion=true",
                dataType: 'json',
                success: function (respuesta)
                {
                    lineas = [];
                    if (respuesta instanceof Object) {
                        var opciones = "";
                        for (var i = 0; i < respuesta.length; i++) {
                            var asignatura = respuesta[i];
                            opciones += '<option  value="' + asignatura["nombre"] + '">' + asignatura["nombre"] + '</option>';
                            lineas[asignatura["nombre"]] = asignatura["descripcion"];
                        }
                        var inicio = '<label class="" for="lineaP">Linea de investigacion</label>\n\
<select name="lineaP" class="form-control" id="lineaP">\n\
<option  value="">Seleccione Linea</option>';
                        var fin = '</select><label id="error-lineaP"></label></div>';
                        $(".lineas").html(inicio + opciones + fin);
                    }

                }
            });
}

function mostrarInfoLinea(titulo, body) {

    if (titulo != "") {
        $("#infoLineaTitulo").html(titulo);

        $("#infoLineaBody").html(body);
        $("#infoLinea").modal("show");
    } else {
        respuestaPeligro("Seleccione una linea de investigacion");
    }



}

function mostrarTutoriasSeleccionadas() {
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?tutorias=true",
                dataType: 'json',
                success: function (respuesta)
                {
                    if (respuesta instanceof Object) {
                        var lista = '';
                        for (var i = 0; i < respuesta.length; i++) {
                            var tutoria = respuesta[i];
                            var docente = tutoria["docente"];
                            var asignatura = tutoria["asignatura"];
                            var inicio = '<li class="list-group-item list-group-item-info">';
                            var fin = '</li>';
                            lista += inicio + "[" + docente["codigoprograma"] + docente["codigo"] + "] " + docente["nombre"] + " -- " + "[" + asignatura["codigoprograma"] + asignatura["codigo"] + "] " + asignatura["nombre"] + fin;

                        }
                        var header = '<li class="list-group-item list-group-item-warning"></li>';

                        $("#listaTutoria").html(header + lista);
                    }

                }
            });
}




function filtrarFerias() {
    $.ajax({
        url: "Vista/Modulos/Ajax.php?filtrarFeria=activa",
        dataType: 'json',
        success: function (respuesta) {
            var mostrar = '';
            var items = '<div class="row">';
            if (respuesta instanceof Object) {
                for (var i = 0; i < respuesta.length - 1; i++) {
                    var feria = respuesta[i];
                    var botonInscribir = respuesta[respuesta.length - 1] ? '<a href="RegistrarProyecto=' + feria["id"] + '" class="btn btn-danger">Inscribir proyecto</a>' : "";

                    if (i == 3) {
                        items += '</div><div class="row">';
                    }
                    items += '<div class="col-md-4 ">\n\
<div class="card grey darken-3">\n\
<div class="card-image "></div>\n\
<div class="card-content white-text">\n\
<h5> <b class="white-text headline">' + feria["nombre"] + '</b></h5>\n\
<p class="text-justify">' + feria["resumen"] + '<div class="headline"></div>\n\
<p><b>Fecha limite de inscripcion: ' + feria["limite"] + ' </b></p></div>\n\
<div class="card-action">\n\
<a href="Feria=' + feria["id"] + '" class="btn btn-danger">Mas informacion</a>\n\
' + botonInscribir + '</div></div></div>';

                }
                items += '</div>';
                $("#contenedorFerias").html(items);
            }
        }


    });
}


function mostrarMisProyectos() {

    $.ajax({
        url: "Vista/Modulos/Ajax.php",
        method: "post",
        data: {listarMisProyectos: true},
        dataType: 'json',
        success: function (respuesta) {
            var datosTabla = "";
            if (respuesta instanceof Object) {
                
                if (respuesta["exito"]) {
                    
                    for (var key in respuesta) {
                        
                        if (key != "exito") {
                            var proyecto = respuesta[key];
                            var fecha=proyecto["fechafinal"]!=null ? proyecto["fechafinal"]:"Feria no finalizada";
                            var lider=proyecto["lider"]==1 ? "Eres lider": "No eres lider";
                            if (key==0) {                                
                            var informacionProyecto = '<a style="margin-left: 2%;margin-bottom:2%" href="Proyecto=' + proyecto["id"] + '" class="btn btn-primary">Mas informacion</a>';
                            var informacionFeria = '<a style="margin-left: 2%;margin-bottom:2%" href="Feria=' + proyecto["idferia"] + '" class="btn btn-warning">Informacion Feria</a>';
                            var eliminar= '<a class="btn btn-danger" id="btnEliminarProyecto">Eliminar</a>';
                            datosTabla += "<tr data-expanded='true'><td>" + proyecto["titulo"] + "</td><td>" + proyecto["estadoproyecto"] + "</td><td>" + proyecto["lineainvestigacion"] + "</td><td>" + proyecto["nombreferia"] + "</td><td>"+fecha+"</td><td>"+lider+"</td> <td>" + informacionProyecto + informacionFeria + "</td> </tr>"
 
                            }else{
                                
                            var informacionProyecto = '<a style="margin-left: 2%;margin-bottom:2%" href="Proyecto=' + proyecto["id"] + '" class="btn btn-primary">Mas informacion</a>';
                            var informacionFeria = '<a style="margin-left: 2%;margin-bottom:2%" href="Feria=' + proyecto["idferia"] + '" class="btn btn-warning">Informacion Feria</a>';
                            var eliminar= '<a class="btn btn-danger" id="btnEliminarProyecto">Eliminar</a>';
                            datosTabla += "<tr><td>" + proyecto["titulo"] + "</td><td>" + proyecto["estadoproyecto"] + "</td><td>" + proyecto["lineainvestigacion"] + "</td><td>" + proyecto["nombreferia"] + "</td><td>"+fecha+"</td> <td>"+lider+"</td>  <td>" + informacionProyecto + informacionFeria + "</td> </tr>"
 
                            }
                            
                        }
                    }
                }

            }
            $("#misProyectos").html(datosTabla);
            $(".footable").footable({
                "filtering": {
                    "empty":"No tiene valores",
                        "placeholder": "Buscar"
                        
                        
                    }
            }
                    );
        }
    });
}


function mostrarFeria(){
    
    $.ajax({
       url: "Vista/Modulos/Ajax.php",
       data:{mostrarFeria:true},
       method:"post",
        dataType: 'json',
        success: function (respuesta){
            if (respuesta instanceof Object) {
                if (respuesta["exito"]) {
                    var informacion = respuesta["informacion"][0];
                    $("#tituloFeria").html(informacion["nombre"]);
                    $("#resumenFeria").html(informacion["resumen"]);
                    var tipoCriterio= respuesta["tipoCriterio"];                    
                    var criterios=respuesta["criterio"];
                     var tabla="";
                    for(var key in tipoCriterio){
                        var tipo= tipoCriterio[key];
                        
                       tabla+="<tr><td><b>"+tipo["descripcion"]+" ( "+tipo["puntos"]+" Puntos )"+"</b></td><td></td></tr>";
                        for(var key2 in criterios ){
                            var cri= criterios[key2];
                            if (cri["tipo"]==tipo["idtipo"]) {
                               tabla+="<tr><td><b>"+cri["nombre"]+"</b><p>"+cri["descripcion"]+"</p></td><td><p class='text-center'> "+cri["valor"]+"</p></td></tr>";
                            }
                        }
                    }
                    $("#tablaCriterios").html(tabla);
                }
            }
        }
        
    });
}