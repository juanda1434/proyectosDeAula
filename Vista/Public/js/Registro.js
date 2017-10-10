$(document).ready(function () {
    $("#formRegistrarEstudiante").validate({
        
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
            nombreE: {required: true},
            correoE: {required: true, email: true},
            codigoE: {required: true},
            documentoE: {required: true},
            contraseniaE: {required: true},
            programaE: {required: true}
        },
        messages:
                {
                    nombreE: "Nombre vacio",
                    correoE: {required: "Email vacio", email: "Ingrese un email correcto (asdf@asdf.com)"},
                    codigoE: "Codigo vacio",
                    documentoE: {required: "Documento Vacio"},
                    contraseniaE: "Contraseña Vacia",
                    programaE: {required:"Seleccione un programa academico"}
                    
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
                beforeSend :function (){
                    respuestaInfoEspera("Espera un momento por favor.")
                    
                },
                success: function (respuesta)
                { 
                    if (respuesta["exito"]) {
                        respuestaExito("Registro exitoso","Te has registro en el sistema. En breve recibiras un correo para validar tu registro.");
                    }else if (!respuesta["exito"]) {
                        respuestaError("Error Registro","Error : "+respuesta["error"]);
                    }

                }
            });
        }
    }
    );

});

