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
            usuarioI: {required: true,number:true},    
            contraseniaI: {required: true}, 
            tipoUsuarioI:{
                        required:true
                    }
        },
        messages:
                {
                    usuarioI: {required: "Usuario vacio", number: "Ingrese numeros por favor"},                   
                    contraseniaI: "Contraseña Vacia",
                    tipoUsuarioI:{
                        required:"Seleccione un tipo de usuario"
                    }
                    
                },
        submitHandler: function (form) {
            var datos = {
                usuarioI: $("#usuarioI").val(),
                contraseniaI: $("#contraseniaI").val(),
                tipoUsuarioI:$("select[name=tipoUsuarioI]").val()
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
                        window.location.reload();
                    }else if (!respuesta["exito"]) {
                        respuestaError("Error Login","Error : "+respuesta["error"]);
                    }

                }
            });
        }
    }
    );


});


