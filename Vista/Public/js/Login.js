$(document).ready(function () {
    $("#formIngresar").validate({
        
        errorPlacement: function (error, element) {
             var aux=error[0];
            var nombreError=aux["outerText"];
            var c = element["0"];
            var idGeneradorError = c["id"];
            
            $("#error-"+idGeneradorError).html(nombreError);
            var padre= element.parents("div.form-group");
            padre.removeClass("has-error");
            padre.addClass("has-error");
            
        },
        rules: {            
            correoI: {required: true, email: true},    
            contraseniaI: {required: true}, 
        },
        messages:
                {
                    correoI: {required: "Email vacio", email: "Ingrese un email correcto (asdf@asdf.com)"},                   
                    contraseniaI: "Contraseña Vacia",
                    
                },
        submitHandler: function (form) {
            var datos = {
                correoI: $("#correoI").val(),
                contraseniaI: $("#contraseniaI").val(),

            };
            $.ajax({
                url: "Vista/Modulos/Ajax.php",
                method: 'POST',
                data: datos,
                dataType: 'json',
                beforeSend :function (){
                    respuestaInfoEspera("Espera un momento por favor.")
                    
                },
                success: function (respuesta)
                { 
                    if (respuesta["exito"]) {
                        respuestaExito("Login exitoso","Te has logeado.");
                    }else if (!respuesta["exito"]) {
                        respuestaError("Error Login","Error : "+respuesta["error"]);
                    }

                }
            });
        }
    }
    );

});


