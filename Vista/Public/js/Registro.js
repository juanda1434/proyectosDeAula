$(document).ready(function () {

    $("#formRegistrarEstudiante").validate({
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
            nombreE: {required: true, maxlength: 50},
            correoE: {required: true, email: true, maxlength: 30},
            codigoE: {required: true, number: true, minlength: 4, maxlength: 4},
            documentoE: {required: true,maxlength:13},
            contraseniaE: {required: true},
            programaE: {required: true}
        },
        messages:
                {
                    nombreE: {required: "Nombre vacio",
                        maxlength: "Ingrese maximo 50 caracteres"
                    },
                    correoE: {required: "Email vacio",
                        email: "Ingrese un email correcto (asdf@asdf.com)",
                        maxlength: "Ingrese maximo 30 caracteres"
                    },
                    codigoE: {
                        required: "Codigo vacio",
                        number: "Ingrese numeros",
                        minlength: "Ingrese 4 caracteres",
                        maxlength: "Ingrese 4 caracteres"
                    },
                    documentoE: {required: "Documento Vacio",
                        maxlength:"Ingrese maximo 13 caracteres"
                    },
                    contraseniaE: {
                        required:"Contraseña Vacia",
                        maxlength:"Ingrese maximo 8 caracteres"
                        
                    },
                    programaE: {required: "Seleccione un programa academico"}

                },
        submitHandler: function (form) {
            var datos = {nombreE: $("#nombreE").val(),
                correoE: $("#correoE").val(),
                codigoE: $("#codigoE").val(),
                documentoE: $("#documentoE").val(),
                contraseniaE: $("#contraseniaE").val(),
                programaAcademicoE: $("select[name=programaE]").val()

            };
            $.ajax({
                url: "Vista/Modulos/Ajax.php",
                method: 'POST',
                data: datos,
                dataType: 'json',
                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.")

                },
                success: function (respuesta)
                {
                    if (respuesta["exito"]) {
                        respuestaExitoRecargar("Registro exitoso", "Te has registro en el sistema. En breve recibiras un correo para validar tu registro.");
                    } else if (!respuesta["exito"]) {
                        respuestaError("Error Registro", "Error : " + respuesta["error"]);
                    }

                }
            });
        }
    }
    );

$("#btnEnviarCorreo").on("click",function (e){
    $.ajax({
       url:"Vista/Modulos/Ajax.php",
       method:"post",
            dataType: 'json',
       data:{validarCorreo:true},
       beforeSend :function (){
                    respuestaInfoEspera("Espera un momento por favor.")
                    
                },
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta instanceof Object) {
                    if (respuesta["exito"]) {
                        respuestaExito("Se ha enviado un mensaje a tu correo electronico para que valides tu registro.");
                    }else{
                        respuestaError("Error",respuesta["error"]);
                    }
                }
            }
    });
});
});

