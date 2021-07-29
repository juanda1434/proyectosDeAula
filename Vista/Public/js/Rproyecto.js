
$(document).ready(function () {
    $("#btnTutoria").on("click", function (e) {
        enviarTutoria();
    });

    var url = window.location.pathname;
    if (url.indexOf("Inscribir") != -1) {
        llenarDocentes();
        llenarAsignaturas();
        llenarLineasInvestigacion();
        mostrarTutoriasSeleccionadas();
    }
    

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
                            lineaP: "Seleccione una linea de trabajo"

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
                        success: function (respuest)
                        {
                            var respuesta= JSON.parse(respuest.trim());
                            var respuesta=JSON.parse(respuest.trim());

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
        success: function (respuest) {
            console.log(respuest);
            var respuesta= JSON.parse(respuest.trim());
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



function llenarDocentes() {
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?docentes=true",
                success: function (respuest)
                {
                    var respuesta= JSON.parse(respuest.trim());
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
                success: function (respuest)
                {
                    var respuesta= JSON.parse(respuest.trim());
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
                success: function (respuest)
                {
                    var respuesta=JSON.parse(respuest.trim());
                    lineas = [];
                    if (respuesta instanceof Object) {
                        var opciones = "";
                        for (var i = 0; i < respuesta.length; i++) {
                            var asignatura = respuesta[i];
                            opciones += '<option  value="' + asignatura["nombre"] + '">' + asignatura["nombre"] + '</option>';
                            lineas[asignatura["nombre"]] = asignatura["descripcion"];
                        }
                        var inicio = '<label class="" for="lineaP">Linea de Trabajo</label>\n\
<select name="lineaP" class="form-control" id="lineaP">\n\
<option  value="">Seleccione Linea de Trabajo</option>';
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
        respuestaPeligro("Seleccione una Linea de Trabajo");
    }



}



function mostrarTutoriasSeleccionadas() {
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?tutorias=true",
                success: function (respuest)
                {
                    var respuesta= JSON.parse(respuest.trim());
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






