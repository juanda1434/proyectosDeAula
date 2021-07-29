$(document).ready(function (){
    $("#formRegistrarFeria").validate({
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
            nombreE: {required: true, maxlength: 50}
        },
        messages:
                {
                    nombreE: {required: "Nombre vacio",
                        maxlength: "Ingrese maximo 50 caracteres"
                    }

                },
        submitHandler: function (form) {
            var datos = {nombreE: $("#nombreE").val()

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
                    var respuesta=JSON.parse(respuest.trim());
                    if (respuesta["exito"]) {
                        respuestaExitoRegistro("Registro exitoso", "Te has registro en el sistema. En breve recibiras un correo para validar tu registro.");
                    } else if (!respuesta["exito"]) {
                        respuestaError("Error Registro", "Error : " + respuesta["error"]);
                    }

                }
            });
        }
    }
    );
    
    
});


