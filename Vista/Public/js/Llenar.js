
var lineas;
var filtro;
cabeceraFiltros = {0: "Nombre", 1: "Fecha"};
var cabecerasFiltros = {0: "Nombre", 1: "Fecha"};
var estadoFiltro = {0: "Inscripcion", 1: "Finalizada", 2: "Activa"};
var pagination = {}
function llenarCards() {
    var url = window.location.pathname;
    if (url.indexOf("Inicio") != -1) {
        filtro = {};
        filtro.estado = "";
        filtro.filtro = "";
        filtro.filtro = {valor: "Nombre", orden: true, estado: "Inscripcion", pagina: 0, participo: false};
        $("#sortNombre").prop("hidden", false);
        darFuncionFiltro(0);
        darFuncionFiltro(1);
        darFuncionEstadoFiltro(0);
        darFuncionEstadoFiltro(1);
        darFuncionEstadoFiltro(2);
        darFuncionFiltroParticipa();
        enviarFiltro("Letras");
        cambiarPagina();
    }
}

function darFuncionFiltro(key) {
    var name = "#rad" + cabecerasFiltros[key];
    $(name).on("click", function () {
        var sort = "#sort" + cabecerasFiltros[key];
        if (filtro.filtro.valor == cabecerasFiltros[key]) {
            filtro.filtro.orden = !filtro.filtro.orden;
            if (filtro.filtro.orden) {
                $(sort).prop("class", "glyphicon glyphicon-sort-by-attributes");
            } else {
                $(sort).prop("class", "glyphicon glyphicon-sort-by-attributes-alt");
            }
        } else {
            var sort2 = "#sort" + filtro.filtro.valor;
            $(sort2).prop("hidden", true);
            $(sort).prop("hidden", false);
            filtro.filtro.valor = cabecerasFiltros[key];
            filtro.filtro.orden = true;
        }
        enviarFiltro("Letras");
    });
}

function darFuncionEstadoFiltro(key) {
    var name = "#rad" + estadoFiltro[key];
    $(name).on("click", function () {
        filtro.filtro.pagina = 0;
        filtro.filtro.estado = estadoFiltro[key];
        enviarFiltro("Letras");
    });
}
function darFuncionFiltroParticipa() {
    var obj = $("#radParticipa");
    obj.on("click", function () {
        filtro.filtro.pagina = 0;
        filtro.filtro.participo = !filtro.filtro.participo;
        obj.prop("checked", filtro.filtro.participo);
        enviarFiltro("Letras");
    });
}

function cambiarPagina(i) {
    $(".pagination").on("click", "#btnpagina" + i, function () {
        if (!pagination[i]) {
            for (var key in pagination) {
                if (key != i && pagination[key]) {
                    pagination[key] = false;
                    $("#btnpagina" + key).prop("class", "");

                }
            }
            pagination[i] = true;
            $("#btnpagina" + i).prop("class", "active");
            filtro.filtro.pagina = i;
            enviarFiltro("Numero");
        }

    });
}




function enviarFiltro(tipo) {
    $.ajax({
        url: "Vista/Modulos/Ajax.php",
        method: "POST",
        data: filtro,
        cache: false,
        success: function (respuest) {
            var respuesta = JSON.parse(respuest.trim());
            if (respuesta instanceof Object) {
                if (respuesta["exito"] != undefined && !respuesta["exito"]) {
                    $("#contenedorFerias").html("<div class='container z-depth-1 red darken-3 col-md-5'><p class='white-text' style='margin-top:2%;margin-left:2%'>No se encuentran ferias que concuerden con los filtros seleccionados</p></div>");

                    var izquierda = '<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                    var derecha = '<li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                    var centro = "<li class='active'><a>1</a></li>";
                    $(".pagination").html(izquierda + centro + izquierda);
                } else {

                    var mostrar = '';
                    var items = '<div class="row">';
                    if (respuesta instanceof Object) {
                        for (var i = 0; i < respuesta.length - 1; i++) {
                            var feria = respuesta[i];
                            var botonInscribir = respuesta[respuesta.length - 1]["tipo"] == "Estudiante" && filtro.filtro.estado == 'Inscripcion' ? '<a href="Inscribir=' + feria["id"] + '" class="btn btn-danger">Inscribir proyecto</a>' : "";
                            var fechaLimite = feria["limite"] != undefined && feria["limite"] != null ? '<b>Fecha limite de inscripcion: ' + feria["limite"] + ' </b>' : "";
                            var fechaFinal = feria["final"] != undefined && feria["final"] != null ? '<b>Fecha de finalizacion: ' + feria["final"] + ' </b>' : "";
                            var fechaInicio = feria["inicio"] != undefined && feria["inicio"] != null && filtro.filtro.estado == 'Activa' ? '<b>Fecha de Realizacion: ' + feria["inicio"] + '</b>' : filtro.filtro.estado == "Activa" ? "<b>Fecha de Realizacion : No se ha seleccionado.</b>" : "";
                            if (i == 3) {
                                items += '</div><div class="row">';
                            }
                            items += '<div class="col-md-4 ">\n\
<div class="card grey darken-3">\n\
<div class="card-image "></div>\n\
<div class="card-content white-text">\n\
<h5> <b class="white-text headline">' + feria["nombre"] + '</b></h5>\n\
<p class="text-justify">' + feria["resumen"] + '<div class="headline"></div>\n\
<p>' + fechaFinal + fechaLimite + '</p>\n\
<p>' + fechaInicio + '</p></div>\n\
<div class="card-action">\n\
<a href="Feria=' + feria["id"] + '" class="btn btn-danger">Mas informacion</a>\n\
' + botonInscribir + '</div></div></div>';

                        }
                        items += '</div>';

                        if (tipo == "Letras") {
                            $("#contenedorFerias").html(items);
                            var n = respuesta[respuesta.length - 1].total;
                            var aux = n / 6;
                            var cov = Math.ceil(aux);
                            var izquierda = '<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                            var derecha = '<li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                            var centro = "";
                            for (var i = 0; i < cov; i++) {
                                var activa = i == 0 ? "class='active'" : "";
                                centro += "<li " + activa + " id='btnpagina" + i + "' value='" + i + "'><a >" + (i + 1) + "</a></li>";
                                i == 0 ? pagination[i] = true : pagination[i] = false;
                                cambiarPagina(i);
                            }
                            $(".pagination").html(izquierda + centro + izquierda);
                        } else if (tipo == "Numero") {
                            $("#contenedorFerias").html(items);
                        }

                    }



                }
            }




        }

    });
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
    } else if (url.indexOf("MisProyectos") != -1) {
        mostrarMisProyectos();

    } else if (url.indexOf("Feria") != -1) {
        mostrarFeria();
    }
}

function llenarProgramas() {

    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?programasAcademicos=true",
                success: function (respuest)
                {
                    var respuesta = JSON.parse(respuest.trim());
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
                success: function (respuest)
                {
                    var respuesta = JSON.parse(respuest.trim());
                    if (respuesta instanceof Object) {
                        var fila = "";
                        for (var key in respuesta) {
                            fila += "<tr><th>" + key + "</th><td class='row'><div class='col-md-12'>" + respuesta[key] + "</div></td></tr>";
                        }
                        fila += "<tr><th>Contraseña</th><td class='row' id='contenedorCambioPass'><div class='col-md-4'>********</div> <a id='btnCambiarPass' class='btn btn-primary col-md-2 col-md-offset-5'><span class='glyphicon glyphicon-edit'></span> editar</a></td></tr>";
                        $("#datosPerfil").html(fila);
                        accionEditarContrasenia();
                    }

                }
            });
}



//<div class='col-md-4'>********</div> <a id='btnCambiarPass' class='btn btn-primary col-md-2 col-md-offset-5'><span class='glyphicon glyphicon-edit'></span> editar</a>
//<div class='col-md-5'><input class='form-control' maxlength='8' minlength='4' placeholder='Ingresa maximo 8 caracteres'  ></input></div><a class='btn btn-success col-md-2 col-md-offset-1' id='btnActualizarPass'><span class='glyphicon glyphicon-ok-sign'></span> Actualizar</a> <a class='btn btn-danger col-md-2 col-md-offset-1' id='btnCancelarPass'><span class='glyphicon glyphicon-remove-sign'></span> Cancelar</a>


function accionEditarContrasenia() {
    $("#datosPerfil").on("click", "#btnCambiarPass", function () {
        $("#contenedorCambioPass").html("<div class='col-md-5'><input id='inputContraseniaNueva' type='password' class='form-control' maxlength='8' minlength='4' placeholder='Ingresa maximo 8 caracteres'  ></input></div><a class='btn btn-success col-md-2 col-md-offset-1' id='btnActualizarPass'><span class='glyphicon glyphicon-ok-sign'></span> Actualizar</a> <a class='btn btn-danger col-md-2 col-md-offset-1' id='btnCancelarPass'><span class='glyphicon glyphicon-remove-sign'></span> Cancelar</a>");
    });
    $("#datosPerfil").on("click", "#btnCancelarPass", function () {
        $("#contenedorCambioPass").html("<div class='col-md-4'>********</div> <a id='btnCambiarPass' class='btn btn-primary col-md-2 col-md-offset-5'><span class='glyphicon glyphicon-edit'></span> editar</a>");
    });
    $("#datosPerfil").on("click", "#btnActualizarPass", function () {
        var contra = $("#inputContraseniaNueva").val();

        if (contra.trim().length == 0) {
            respuestaPeligro("Ingrese una contraseña");
            return;
        } else if (contra.length < 4 || contra.length > 8) {
            respuestaPeligro("La contraseña debe tener minimo 4 y maximo 8 caracteres.");
            return;
        }
        $.ajax({url: "Vista/Modulos/Ajax.php",
            method: "post",
            data: {contraNueva: contra},
            success: function (respuest) {
                var respuesta = JSON.parse(respuest.trim());
                if (respuesta instanceof Object) {
                    if (respuesta["exito"]) {
                        respuestaExito("Has actualizado tu contraseña");
                        $("#contenedorCambioPass").html("<div class='col-md-4'>********</div> <a id='btnCambiarPass' class='btn btn-primary col-md-2 col-md-offset-5'><span class='glyphicon glyphicon-edit'></span> editar</a>");

                    } else {
                        respuestaError("Error", "Error al actualizar tu contraseña, Ingresa una contraseña distinta a la actual.");
                    }
                }
            }
        });
    });
}




function mostrarMisProyectos() {

    $.ajax({
        url: "Vista/Modulos/Ajax.php",
        method: "post",
        data: {listarMisProyectos: true},
        success: function (respuest) {
            var respuesta = JSON.parse(respuest.trim());
            var datosTabla = "";
            if (respuesta instanceof Object) {

                if (respuesta[respuesta.length - 1] != undefined && respuesta[respuesta.length - 1]["exito"]) {
                    if (respuesta[respuesta.length - 1]["tipo"] == "Estudiante") {
                        datosTabla = retornarTablaMisProyectosEstudiante(respuesta);
                    } else if (respuesta[respuesta.length - 1]["tipo"] == "Evaluador") {
                        $("#cabeceraMisProyectos").html("<th>Titulo proyecto</th><th>Horario</th><th>Titulo feria</th><th>Fecha calificar</th><th>Fecha finalizacion</th><th>Acciones</th>");
                        datosTabla = retornarTablaMisProyectosEvaluador(respuesta);
                    }

                }

            }
            $("#misProyectos").html(datosTabla);
            $(".footable").footable({
                "filtering": {
                    "empty": "No tiene valores",
                    "placeholder": "Buscar"


                }
            }
            );
        }
    });
}
function retornarTablaMisProyectosEvaluador(respuesta) {
    var datosTabla = "";
    for (var key in respuesta) {
        if (key != (respuesta.length - 1)) {
            var proyecto = respuesta[key];
            var fechaCalificar = proyecto["fcalificar"] != 0 ? proyecto["fcalificar"] : "No registrado";
            var fechaFinal = proyecto["ffinal"] != 0 ? proyecto["ffinal"] : "La feria no ha finalizado";
            var botonCalificar = proyecto["calificar"] != 0 ? "<a style='margin-left: 2%;margin-bottom:2%' href='Calificar=" + proyecto["id"] + "&" + proyecto["idferia"] + "' class='btn btn-primary'><span class='glyphicon glyphicon-pencil  '></span> Calificar</a>" : "";
            var informacionProyecto = '<a style="margin-left: 2%;margin-bottom:2%" href="LProyecto=' + proyecto["id"] + '" class="btn btn-primary"><span class="glyphicon glyphicon-info-sign"></span> Mas informacion</a>';
            var informacionFeria = '<a style="margin-left: 2%;margin-bottom:2%" href="Feria=' + proyecto["idferia"] + '" class="btn btn-warning"><span class="glyphicon glyphicon-info-sign"></span> Informacion Feria</a>';
            var hora = proyecto["horario"] != undefined && proyecto["horario"] != null ? proyecto["horario"] : "No definido";
            if (key == 0) {
                datosTabla += "<tr data-expanded='true'><td>" + proyecto["titulo"] + "</td><td>" + hora + "</td><td>" + proyecto["tituloferia"] + "</td><td>" + fechaCalificar + "</td> <td>" + fechaFinal + "</td>  <td>" + botonCalificar + informacionProyecto + informacionFeria + "</td> </tr>"
            } else {
                datosTabla += "<tr><td>" + proyecto["titulo"] + "</td><td>" + hora + "</td><td>" + proyecto["tituloferia"] + "</td><td>" + fechaCalificar + "</td> <td>" + fechaFinal + "</td>  <td>" + botonCalificar + informacionProyecto + informacionFeria + "</td> </tr>"

            }

        }
    }
    return datosTabla;
}

function retornarTablaMisProyectosEstudiante(respuesta) {
    var datosTabla = "";
    for (var key in respuesta) {
        if (key != (respuesta.length - 1)) {
            var proyecto = respuesta[key];
            var fecha = proyecto["fechafinal"] != null ? proyecto["fechafinal"] : "Feria no finalizada";
            var lider = proyecto["lider"] == 1 ? "Eres lider" : "No eres lider";
            var hora = proyecto["horario"] != undefined && proyecto["horario"] != null ? proyecto["horario"] : "No definido";
            if (key == 0) {
                var informacionProyecto = '<a style="margin-left: 2%;margin-bottom:2%" href="LProyecto=' + proyecto["id"] + '" class="btn btn-primary"><span class="glyphicon glyphicon-info-sign"></span> Mas informacion</a>';
                var informacionFeria = '<a style="margin-left: 2%;margin-bottom:2%" href="Feria=' + proyecto["idferia"] + '" class="btn btn-warning"><span class="glyphicon glyphicon-info-sign"></span> Informacion Feria</a>';
                var eliminar = '<a class="btn btn-danger" id="btnEliminarProyecto">Eliminar</a>';
                datosTabla += "<tr data-expanded='true'><td>" + proyecto["titulo"] + "</td><td>" + proyecto["estadoproyecto"] + "</td><td>" + proyecto["lineainvestigacion"] + "</td><td>" + hora + "</td><td>" + proyecto["nombreferia"] + "</td><td>" + fecha + "</td><td>" + lider + "</td> <td>" + informacionProyecto + informacionFeria + "</td> </tr>"

            } else {

                var informacionProyecto = '<a style="margin-left: 2%;margin-bottom:2%" href="LProyecto=' + proyecto["id"] + '" class="btn btn-primary"><span class="glyphicon glyphicon-info-sign"></span> Mas informacion</a>';
                var informacionFeria = '<a style="margin-left: 2%;margin-bottom:2%" href="Feria=' + proyecto["idferia"] + '" class="btn btn-warning"><span class="glyphicon glyphicon-info-sign"></span> Informacion Feria</a>';
                var eliminar = '<a class="btn btn-danger" id="btnEliminarProyecto">Eliminar</a>';

                datosTabla += "<tr><td>" + proyecto["titulo"] + "</td><td>" + proyecto["estadoproyecto"] + "</td><td>" + proyecto["lineainvestigacion"] + "</td><td>" + hora + "</td><td>" + proyecto["nombreferia"] + "</td><td>" + fecha + "</td> <td>" + lider + "</td>  <td>" + informacionProyecto + informacionFeria + "</td> </tr>"

            }

        }
    }
    return datosTabla;
}

function mostrarFeria() {

    $.ajax({
        url: "Vista/Modulos/Ajax.php",
        data: {mostrarFeria: true},
        method: "post",
        success: function (respuest) {
            var respuesta = JSON.parse(respuest.trim());
            console.log(respuesta);
            if (respuesta instanceof Object) {
                if (respuesta["exito"]) {
                    var informacion = respuesta["informacion"][0];
                    $("#tituloFeria").html(informacion["nombre"]);
                    $("#resumenFeria").html(informacion["resumen"]);
                    var tipoCriterio = respuesta["tipoCriterio"];
                    var criterios = respuesta["criterio"];
                    var tipo = respuesta["tipo"];
                    var tabla = "";
                    if (tipo == "Evaluador") {
                        for (var key in tipoCriterio) {
                            var tipo = tipoCriterio[key];

                            tabla += "<tr><td><b>" + tipo["descripcion"] + " ( " + tipo["puntos"] + " Puntos )" + "</b></td><td></td></tr>";
                            for (var key2 in criterios) {
                                var cri = criterios[key2];
                                if (cri["tipo"] == tipo["idtipo"]) {
                                    tabla += "<tr><td><b>" + cri["nombre"] + "</b><p>" + cri["descripcion"] + "</p></td><td><p class='text-center'> " + cri["valor"] + "</p></td></tr>";
                                }
                            }
                        }
                    } else {
                        $("#cabeceraCriteriosFeria").html("<th>Criterio</th>");
                        for (var key in tipoCriterio) {
                            var tipo = tipoCriterio[key];
                            tabla += "<tr><td><b>" + tipo["descripcion"] + "</b></td></tr>";
                            for (var key2 in criterios) {
                                var cri = criterios[key2];
                                if (cri["tipo"] == tipo["idtipo"]) {
                                    tabla += "<tr><td><b>" + cri["nombre"] + "</b><p>" + cri["descripcion"] + "</p></td></tr>";
                                }
                            }
                        }
                    }

                    $("#tablaCriterios").html(tabla);
                }
            }
        }

    });
}