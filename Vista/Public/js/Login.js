$(document).ready(function () {
    $("#formIngresar").validate({
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
            usuarioI: {required: true, number: true,maxlength:13},
            contraseniaI: {required: true, maxlength: 8,minlength:4},
            tipoUsuarioI: {
                required: true
            }
        },
        messages:
                {
                    usuarioI: {required: "Usuario vacio", number: "Ingrese numeros por favor"},
                    contraseniaI: {required: "Contraseña Vacia", maxlength: "Ingrese maximo 8 caracteres",minlength:"Ingrese minimo 4 caracteres"},
                    tipoUsuarioI: {
                        required: "Seleccione un tipo de usuario"
                    }

                },
        submitHandler: function (form) {
            var datos = {
                usuarioI: $("#usuarioI").val(),
                contraseniaI: $("#contraseniaI").val(),
                tipoUsuarioI: $("select[name=tipoUsuarioI]").val()
            };
            $.ajax({
                url: "Vista/Modulos/Ajax.php",
                method: 'POST',
                data: datos,
                beforeSend: function () {

                    respuestaInfoEspera("Espera un momento por favor.")

                },
                success: function (respuest)
                {console.log(respuest);
                    var respuesta = JSON.parse(respuest.trim());
                    
                    if (respuesta instanceof Object) {
                        if (respuesta["exito"]) {
                            if (respuesta["redireccionarUnion"] != null && respuesta["redireccionarUnion"] != undefined) {
                                window.location.replace("unirse=" + respuesta.redireccionarUnion.id + "-" + respuesta.redireccionarUnion.key);
                            }else if (respuesta["redireccionarValidar"] != null && respuesta["redireccionarValidar"] != undefined) {
                                window.location.replace("Validacion="+respuesta.redireccionarValidar.key);
                            } else {
                                window.location.reload();
                            }

                        } else if (!respuesta["exito"]) {
                            respuestaError("Error Login", "Error : " + respuesta["error"]);
                        }
                    }


                }
            });
        }
    }
    );




    $("#formRecuperarContrasenia").validate({
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
            usuarioRe: {required: true, number: true},
            correoRe: {required: true, email: true, maxlength: 50},
            tipoUsuarioRe: {
                required: true
            }
        },
        messages:
                {
                    usuarioRe: {required: "Usuario vacio", number: "Ingrese numeros por favor"},
                    correoRe: {required: "Correo Vacia", email: "Ingrese correo valido (asasa@asasa)", maxlength: "Ingrese maximo 50 caracteres"},
                    tipoUsuarioRe: {
                        required: "Seleccione un tipo de usuario"
                    }

                },
        submitHandler: function (form) {
            var datos = {
                usuarioRe: $("#usuarioRe").val(),
                correoRe: $("#correoRe").val(),
                tipoUsuarioRe: $("select[name=tipoUsuarioRe]").val()
            };
            $.ajax({
                url: "Vista/Modulos/Ajax.php",
                method: 'POST',
                data: datos,
                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.")

                },
                success: function (respuest)
                {
                 console.log(respuest);
                    var respuesta = JSON.parse(respuest.trim());
                    if (respuesta instanceof Object) {
                        if (respuesta["exito"]) {
                            respuestaExitoRecargar("Correcto", "Has solicitado cambio de contraseña. Te hemos enviado un correo de verificacion.");

                        } else if (!respuesta["exito"]) {
                            respuestaError("Error", "Error al enviar correo electronico.Posiblemente ingresaste un correo electronico diferente al correo asosiado a tu cuenta.")
                        }
                    }


                }
            });
        }
    }
    );

    $("#formActualizarContrasenia").validate({
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
            contraseniaNueva: {required: true, maxlength: 8,minlength:4},
        },
        messages:
                {
                    contraseniaNueva: {required: "contraseña vacia", maxlength: "Ingrese maximo 8 caracteres",minlength:"Ingrese minimo 4 caracteres"}

                },
        submitHandler: function (form) {
            var datos = {
                contraseniaNueva: $("#contraseniaNueva").val()
            };
            $.ajax({
                url: "Vista/Modulos/Ajax.php",
                method: 'POST',
                data: datos,
                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.")

                },
                success: function (respuest)
                {
                    var respuesta = JSON.parse(respuest.trim());
                    if (respuesta instanceof Object) {
                        if (respuesta["exito"]) {
                            respuestaExitoRecargar("Correcto","Has actualizado correctamente tu contraseña");

                        }else{
                            respuestaError("Error","Error al actualizar contraseña, intentalo nuevamente");
                        }
                    }

                }
            });
        }
    }
    );
});


