$(document).ready(function () {





    var url = window.location.pathname;
    if (url.indexOf("LProyecto") != -1) {

        $("#btnInvitarProyecto").on("click", function (e) {
            $("#invitarProyecto").modal("show");
        });
        mostrarProyecto();

        $("#panelAgregar").on("click", "#btnInvitarProyecto", function (e) {
            enviarCorreoInvitacion();
        });
    }
});

function mostrarProyecto() {
    $.ajax({
        url: "Vista/Modulos/Ajax.php",
        method: "post",
        data: {listarProyecto: true},
        dataType: 'json',
        success: function (respuesta) {
            if (respuesta instanceof Object) {

                if (!respuesta["exito"]) {
                    window.location.replace("http://localhost/Proyectosdeaula/Inicio");

                }
                var general = respuesta["datosGenerales"][0];
                var integrantes = respuesta["integrantes"];
                var tutorias = respuesta ["tutorias"];

                $("#tituloProyecto").html(general["titulo"]);
                $("#resumenProyecto").html(general["resumen"]);
                $("#lineaProyecto").html(general["lineainvestigacion"]);
                if (general["estado"] == "inscripcion" && respuesta["lider"] && respuesta["tipo"] == "Estudiante") {
                    $("#panelAgregar").html('<div id="miniPanel" class="col-md-12" style="margin-bottom: 3%" >\n\
<label for="correoInvitacion">Correo electronico</label>\n\
<input id="correoInvitacion" type="text" class="form-control"><label class="bg-danger" id="error-correoInvitacion"></label></div>\n\
<div class="col-md-12" >\n\
<a id="btnInvitarProyecto" class="btn btn-primary" style="margin-bottom: 3%">Invitar Compañero</a></div>');
                }
                var tablaIntegrantes = "";
                for (var i = 0; i < integrantes.length; i++) {
                    var integrante = integrantes[i];
                    var lider = integrante["lider"] == 1 ? "Lider" : "Integrante";
                    tablaIntegrantes += "<tr><td>" + integrante["codigoprogramaestudiante"] + integrante["codigoestudiante"] + "</td><td>" + integrante["nombreestudiante"] + "</td><td>" + lider + "</td><td>" + integrante["programaestudiante"] + "</td></tr>"
                }
                $("#integrantesProyecto").html(tablaIntegrantes);
                var tablaTutoria = "";
                for (var i = 0; i < tutorias.length; i++) {
                    var tutoria = tutorias[i];
                    if (i == 0) {
                        tablaTutoria += "<tr data-expanded='true' ><td>" + tutoria["codigoprogramadocente"] + tutoria["codigodocente"] + "</td><td>" + tutoria["nombredocente"] + "</td><td>" + tutoria["programadocente"] + "</td><td>" + tutoria["codigoprogramaasignatura"] + tutoria["codigoasignatura"] + "</td><td>" + tutoria["nombreasignatura"] + "</td><td>" + tutoria["programaasignatura"] + "</td></tr>";

                    } else
                        tablaTutoria += "<tr><td>" + tutoria["codigoprogramadocente"] + tutoria["codigodocente"] + "</td><td>" + tutoria["nombredocente"] + "</td><td>" + tutoria["programadocente"] + "</td><td>" + tutoria["codigoprogramaasignatura"] + tutoria["codigoasignatura"] + "</td><td>" + tutoria["nombreasignatura"] + "</td><td>" + tutoria["programaasignatura"] + "</td></tr>";
                }
                $("#tutoriaProyecto").html(tablaTutoria);

                $(".footable").footable({
                    "empty": "No hay tutorias",
                    "filtering": {
                        "placeholder": "Buscar"
                    }

                });
            }
        }


    });

}
;



function validarCorreo(correo) {
    var aux = false;
    var correoFiltrado = correo.replace(" ", "");
    if (correoFiltrado.length == 0) {
        $("#error-correoInvitacion").html("Correo vacio");
        $("#miniPanel").addClass("has-error");
        aux = true;
    } else if (correo.indexOf("@") == -1) {
        $("#error-correoInvitacion").html("Ingrese un correo correcto (asdf@asdf.com)");
        $("#miniPanel").addClass("has-error");
        aux = true;
    } else if (correoFiltrado.length > 30) {
        $("#error-correoInvitacion").html("Ingrese maximo 30 caracteres");
        $("#miniPanel").addClass("has-error");
        aux = true;
    } else {
        $("#error-correoInvitacion").html("");
        $("#miniPanel").removeClass("has-error");
    }
    return aux;
}

function enviarCorreoInvitacion() {
    var correo = $("#correoInvitacion").val();
    if (validarCorreo(correo)) {
        return;
    }
    var datos = {correoInvitacion: correo};
    $.ajax({
        url: "Vista/Modulos/Ajax.php",
        method: "post",
        data: datos,
        dataType: 'json',
        beforeSend: function () {
            respuestaInfoEspera("Espera un momento por favor.")

        },
        success: function (respuesta) {
            if (respuesta instanceof Object) {
                if (respuesta["exito"]) {
                    respuestaExitoRecargar("Invitacion Enviada", "Has enviado un correo de invitacion a tu proyecto.");
                } else {
                    respuestaError("Error de envio", respuesta["error"]);
                }
            }
        }
    })
}