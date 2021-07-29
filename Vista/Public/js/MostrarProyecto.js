var datosActuales = {titulo: "", resumen: "", linea: ""};
var datoEnviar = {};
$(document).ready(function () {





    var url = window.location.pathname;
    if (url.indexOf("LProyecto") != -1) {

        $("#btnInvitarProyecto").on("click", function (e) {
            $("#invitarProyecto").modal("show");
        });
        mostrarProyecto();
        accionesEditarProyecto();

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
        success: function (respuest) {
            var respuesta = JSON.parse(respuest.trim());
            if (respuesta instanceof Object) {
console.log(respuesta);
                if (!respuesta["exito"]) {
                    window.location.replace("Inicio");

                }
                var general = respuesta["datosGenerales"][0];
                var integrantes = respuesta["integrantes"];
                var tutorias = respuesta ["tutorias"];
            
                var editarTitulo = respuesta["lider"][0] ? "<a class='btn btn-primary' id='editarTituloProyecto'><span class='glyphicon glyphicon-edit'></span> Editar</a> " : "";
                var editarResumen = respuesta["lider"][0] ? "<a class='btn btn-primary' id='editarResumen'><span class='glyphicon glyphicon-edit'></span> Editar</a> " : "";
                var editarLinea = respuesta["lider"][0] ? "<a class='btn btn-primary' id='editarLinea'><span class='glyphicon glyphicon-edit'></span> Editar</a> " : "";
                var nota= respuesta["notaFinal"] !=undefined && respuesta["notaFinal"]!=null ?'<div class="col-md-5 z-depth-1"  style="margin-top: 2%"> <h5 >Nota : '+respuesta["notaFinal"]+'</h5></div>':"";
                $("#tituloProyecto").html(general["titulo"] + " " + editarTitulo);
                $("#notaFinalProyecto").html(nota);
                $("#resProyecto").html("Resumen " + editarResumen);
                $("#resumenProyecto").html(general["resumen"]);
                $("#lineaTrabajoProyecto").html("Linea de Trabajo " + editarLinea);
                $("#lineaProyecto").html(general["lineainvestigacion"]);
                datosActuales.resumen = general.resumen;
                datosActuales.titulo = general.titulo;
                datosActuales.linea = general.lineainvestigacion;
                if (general["estado"] == "inscripcion" && respuesta["lider"][1] && respuesta["tipo"] == "Estudiante") {
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

function accionesEditarProyecto() {

    $("#contenedorMostrarProyecto").on("click", "#editarTituloProyecto", function () {
        $("#contieneTituloProyecto").html("<div class='col-md-12' style='padding-top:3%'><input class='form-control' id='inputTituloProyecto' placeholder='Titulo Nuevo' value='" + datosActuales.titulo + "' maxlength='100'> </div>");
        $("#aquiActualizarProyecto").html("<a class='btn btn-success' style='margin-top: 3%' id='btnAceptarActualizarProyecto'><span class='glyphicon glyphicon-edit'></span> Actualizar Dato</a> <a class='btn btn-danger' style='margin-top: 3%' id='btnCancelarActualizarDatoProyecto'><span class='glyphicon glyphicon-remove-sign'></span> Cancelar</a>");
        $("#resProyecto").html("Resumen");
        $("#lineaTrabajoProyecto").html("Linea de Trabajo");
    });

    $("#contenedorMostrarProyecto").on("click", "#editarResumen", function () {
        $("#contieneResumenProyecto").html("<div class='col-md-10 col-md-offset-1 container-fluid z-depth-2' style='margin-bottom: 3%;padding-bottom: 3%'><textArea rows='5' style='margin-top: 3%' class='form-control' id='inputResumenProyecto' placeholder='Resumen Nuevo (Ingresa maximo 300 caracteres)' maxlength='300'></textArea> </div>");
        $("#aquiActualizarProyecto").html("<a class='btn btn-success' style='margin-top: 3%' id='btnAceptarActualizarProyecto'><span class='glyphicon glyphicon-edit' ></span> Actualizar Dato</a> <a class='btn btn-danger' style='margin-top: 3%' id='btnCancelarActualizarDatoProyecto'><span class='glyphicon glyphicon-remove-sign'></span> Cancelar</a>");
        $("#tituloProyecto").html(datosActuales.titulo);
        $("#lineaTrabajoProyecto").html("Linea de Trabajo");
    });

    $("#contenedorMostrarProyecto").on("click", "#editarLinea", function () {
        $("#aquiActualizarProyecto").html("<a class='btn btn-success' style='margin-top: 3%' id='btnAceptarActualizarProyecto'><span class='glyphicon glyphicon-edit'></span> Actualizar Dato</a> <a class='btn btn-danger' style='margin-top: 3%' id='btnCancelarActualizarDatoProyecto'><span class='glyphicon glyphicon-remove-sign'></span> Cancelar</a>");
        $("#tituloProyecto").html(datosActuales.titulo);
        $("#resProyecto").html("Resumen");
        llenarLineasInvestigacionMostrar();
    });

    $("#contenedorMostrarProyecto").on("click", "#btnCancelarActualizarDatoProyecto", function () {
        finalizarActualizacionProyecto();
    });

    $("#contenedorMostrarProyecto").on("click", "#btnAceptarActualizarProyecto", function () {
        editarDatoProyecto(datoEnviar.nombre, datoEnviar.dato);
    });

    $("#contenedorMostrarProyecto").on("change", "#inputTituloProyecto", function () {
        datoEnviar = {nombre: "titulo", dato: $(this).val()};
    });
    $("#contenedorMostrarProyecto").on("change", "#inputResumenProyecto", function () {
        datoEnviar = {nombre: "resumen", dato: $(this).val()};
    });
    $("#contenedorMostrarProyecto").on("change", "#lineaActualizar", function () {
        datoEnviar = {nombre: "linea", dato: $(this).val()};
    });
}
function finalizarActualizacionProyecto() {
    $("#contieneTituloProyecto").html('<div class="headline col-md-12"><h3 id="tituloProyecto" ></h3></div>');
    $("#contieneResumenProyecto").html('<div class="z-depth-2 container text-justify col-md-10 col-md-offset-1"  style="margin-bottom: 3%"><p style="margin-top: 3%" id="resumenProyecto"></p></div>');
    $("#contieneLineaProyecto").html('<b><h5 style="" id="lineaTrabajoProyecto">Linea de Trabajo</h5></b><p id="lineaProyecto"></p>');
    $("#aquiActualizarProyecto").html("");
    mostrarProyecto();
}

function llenarLineasInvestigacionMostrar() {
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?lineasInvestigacion=true",
                success: function (respuest)
                {
                    var respuesta = JSON.parse(respuest.trim());
                    lineas = [];
                    if (respuesta instanceof Object) {
                        var opciones = "";
                        for (var i = 0; i < respuesta.length; i++) {
                            var asignatura = respuesta[i];
                            opciones += '<option  value="' + asignatura["nombre"] + '">' + asignatura["nombre"] + '</option>';
                            lineas[asignatura["nombre"]] = asignatura["descripcion"];
                        }
                        var inicio = '<b><h5 style="" id="lineaTrabajoProyecto">Linea de Trabajo</h5></b><label class="" for="lineaP">Linea de Trabajo</label>\n\
<select style="margin-bottom: 3%" name="lineaActualizar" class="form-control" id="lineaActualizar">\n\
<option  value="">Seleccione Linea de Trabajo</option>';
                        var fin = '</select> </div>';
                        $("#contieneLineaProyecto").html(inicio + opciones + fin);
                    }

                }
            });
}


function editarDatoProyecto(nombre, dato) {
    var aux = datosActuales[nombre];
    var datoEnviar;
    if (aux == dato) {
        respuestaPeligro("Ingrese un dato diferente al ya registrado por favor.");
        return;
    } else if (dato.trim().length == 0) {
        respuestaPeligro("Ingrese un dato porfavor");
        return;
    }
    switch (nombre) {
        case "titulo":
            if (dato.length > 100) {
                respuestaPeligro("Ingrese maximo 100 caracteres para el titulo.");
                return;
            }
            datoEnviar = {actualizarDatoProyecto: {nombre: "titulo", dato: dato}};
            break;
        case "resumen":
            if (dato.length > 300) {
                respuestaPeligro("Ingrese maximo 300 caracteres para el resumen.");
                return;
            }
            datoEnviar = {actualizarDatoProyecto: {nombre: "resumen", dato: dato}};
            break;
        case "linea":
            if (dato.length == 0) {
                respuestaPeligro("Selecciona una linea de trabajo");
                return;
            }
            datoEnviar = {actualizarDatoProyecto: {nombre: "linea", dato: dato}};
            break;
    }

    enviarDato(datoEnviar);

}

function enviarDato(datos) {
    $.ajax({url: "Vista/Modulos/Ajax.php",
        method: "post",
        data: datos,
        success: function (respuest) {
            console.log(respuest);
            var respuesta = JSON.parse(respuest);
            if (respuesta != undefined && respuesta instanceof Object) {
                if (respuesta["exito"]) {
                    respuestaExito("Has actualizado " + datos.actualizarDatoProyecto.nombre + " del proyecto");
                    finalizarActualizacionProyecto();
                } else {
                    if (respuesta["error"] != undefined && respuesta["error"] != null) {
                        respuestaError("Error", respuesta["error"]);
                    } else {
                        respuestaError("Error", "Error al actualizar " + datos.actualizarDatoProyecto.nombre + " del proyecto");
                    }
                }
            }
        }
    });
}


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
    } else if (correoFiltrado.length > 50) {
        $("#error-correoInvitacion").html("Ingrese maximo 50 caracteres");
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
        beforeSend: function () {
            respuestaInfoEspera("Espera un momento por favor.");
        },
        success: function (respuest) {
            console.log(respuest);
            var respuesta = JSON.parse(respuest.trim());
            if (respuesta instanceof Object) {
                if (respuesta["exito"]) {
                    respuestaExitoRecargar("Invitacion Enviada", "Has enviado un correo de invitacion a tu proyecto.");
                } else {
                    respuestaError("Error de envio", respuesta["error"]);
                }
            }
        }
    });
}