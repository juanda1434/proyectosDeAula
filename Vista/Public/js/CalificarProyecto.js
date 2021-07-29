var calificaciones = {};
var total;

$(document).ready(function () {

    var url = window.location.pathname;
    if (url.indexOf("Calificar") != -1) {
        llenarCriteriosEvaluar();
        darAccionbtnActualizarNota();
        darAccionEnviarNota();
    }

});




function darAccionEnviarNota() {
    $("#btnEnviarCalificacion").on("click", function () {
        if (total == undefined || total == null || total != 0) {
            respuestaError("Error", "Por favor ingrese todas las notas antes de enviar la calificacion final.");
        } else {
            $.ajax({
                url: "Vista/Modulos/Ajax.php",
                method: "post",
                data: {enviarCalificacionC: true,
                    datosCalificacion: calificaciones},
                success: function (respuest) {
                    var respuesta=JSON.parse(respuest.trim());
                    if (respuesta instanceof Object) {
                        if (respuesta["exito"]) {
                            respuestaExito("Has ingresado correctamente la calificacion final.");
                            window.location.replace("MisProyectos");
                        } else {
                            respuestaError("Error", respuesta["error"]);
                        }
                    }

                }

            })

        }
    });
}


function darAccionbtnActualizarNota() {
    $("#tablaCriterios").on("change", ".entradaArea", function () {
        var observacion = $(this).val();
        var mid = $(this).attr("va");
        calificaciones[mid].observacion = observacion;

    });
    $("#tablaCriterios").on("input", ".entradaInput", function () {
        var nota = parseInt($(this).val());
        var mid = $(this).attr("va");
        if (validarNota(nota, mid)) {
            $(this).val(calificaciones[mid].nota);
        } else {
            calificaciones[mid].nota = nota;
            evaluarTotal();
            actualizarCrite(mid);
        }

    });

    function evaluarTotal() {
        total = 0;
        for (var key in calificaciones) {
            calificaciones[key].nota == null ? total++ : "";
        }
    }
    $("#criteriosEvaluar").on("click", ".btnActualizarNota", function () {
//        var mid = $(this).attr("value");
//        var observacion = $("#observa" + mid).val() == "" ? null : $("#observa" + mid).val();
//        var nota = $("#nota" + mid).val() == "" ? null : $("#nota" + mid).val();
//
//        if (validarNota(nota, mid, observacion)) {
//            return;
//        }
//        
//        calificaciones[mid].nota=nota;
//        calificaciones[mid].observacion=observacion;
////        var datos = {idCriterioM: mid,
////            actualizarNotaTemporalM: true,
////            notaM: nota,
////            observacionM: observacion
////        };
////
////
////        $.ajax({
////            url: "Vista/Modulos/Ajax.php",
////            method: "post",
////            data: datos,
////            dataType: 'json',
////            success: function (respuesta) {
////                llenarTablaEvaluar(respuesta);
////
////            }
////
////        });
    });
}

function validarNota(not, mid) {
    var nota = not;
    var max = parseInt(calificaciones[mid].max);
    var notaGuardada = parseInt(calificaciones[mid].nota);
    var aux = false;
    if (nota == null || !$.isNumeric(nota) || isNaN(nota)) {
        respuestaError("Error", "Ingrese un valor numerico para la nota");
        aux = true;
    } else if (nota > max || nota < 0) {
        respuestaError("Error", "Esta nota puede tener un valor maximo de " + calificaciones[mid].max + " y minimo de " + 0);
        aux = true;
    }
    return aux;
}

function llenarCriteriosEvaluar() {
    $.ajax({
        url: "Vista/Modulos/Ajax.php",
        method: "post",
        data: {listarCalificar: true},
        success: function (respuest) {
            var respuesta=JSON.parse(respuest.trim());
            llenarTablaEvaluar(respuesta);
        }

    });
}

function actualizarCrite(id) {
    calificaciones[id].nota != null ? $("#ingreseNota" + id).html("") : "Ingrese nota";
    var notas = total != 0 ? "<div class='red-text'>(" + total + " notas por ingresar)</div>" : "<div class='green-text'>Puedes enviar calificacion</div>";
    $("#titulototal").html("Criterio " + notas);
}

function llenarTablaEvaluar(respuesta) {

    var criterios = respuesta["criterios"];
    if (respuesta instanceof Object) {
        var tipoCriterio = respuesta["tipo"];
        var criterios = respuesta["criterios"];
        var tabla = "";
        total = 0;
        for (var key in tipoCriterio) {
            var tipo = tipoCriterio[key];

            tabla += "<tr class='black-text'><td class=''><b>" + tipo["descripcion"] + " ( " + tipo["puntos"] + " Puntos )" + "</b></td><td></td></tr>";

            for (var key2 in criterios) {
                var cri = criterios[key2];

                if (cri["tipo"] == tipo["idtipo"]) {
                    var observa = '<div  class="col-md-12" style="margin-top: 3%;margin-left: 4%;"> <textarea id="observa' + cri["id"] + '" va="' + cri.id + '" class="area entradaArea" rows="5" ></textarea></div>';
                    var validaciones = 'max="' + cri["valor"] + '" min="0"';

                    var ingreseNota = cri.calificacion.nota == null ? "<div class='red-text' id='ingreseNota" + cri.id + "'>Ingrese nota</div>" : "";
                    var nota = cri.calificacion.nota == null ? "" : cri.calificacion.nota;
                    cri.calificacion.nota == null ? total++ : "";
                    tabla += "<tr><td><b>" + cri["nombre"] + "</b><p class='black-text'>" + cri["descripcion"] + ingreseNota + "</p></td><td><p class='text-center black-text'> " + cri.valor + "</p></td><td>" + "<input id='nota" + cri["id"] + "' va='" + cri.id + "' type='number' class='form-control entradaInput text-center' style='margin-top: 2%;margin-left: 20%;width:60%' " + validaciones + " >  " + "</td><td >" + observa + "</td></tr>";

                    calificaciones[cri.id] = {nota: cri.calificacion.nota, observacion: cri.calificacion.observacion, max: cri["valor"]};

                }
            }
        }
        $("#tablaCriterios").html(tabla);
        var notas = total != 0 ? "<div class='red-text'>(" + total + " notas por ingresar)</div>" : "<div class='green-text'>Puedes enviar calificacion</div>";
        $("#titulototal").html("Criterio " + notas);
    }

    $("#criteriosEvaluar").footable();
}