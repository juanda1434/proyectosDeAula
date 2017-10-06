function aux(elemento){
    elemento.deleteClass("has-error");
}

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
                    programaE: "Seleccione un programa academico"
                },
        submitHandler: function (form) {
            var datos = {nombreE: "juan",
                correoE: "juandavidsm@ufps.edu.co",
                codigoE: "1308",
                documentoE: "1090505894",
                contraseniaE: "12345678",
                programaAcademicoE: "115"

            };
            $.ajax({
                url: "vista/Modulos/Ajax.php",
                method: 'POST',
                data: datos,
                success: function (respuesta)
                {
                    console.log(respuesta);

                }
            });
        }
    }
    );

});

