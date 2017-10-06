$(document).ready(function (){
   $('#formLogin').validate({
        errorPlacement: function (error, element) {
            generarErrores(error, element);
        },
        rules: {
            usuarioc: {required: true},
            nombrec: {required: true},
            correoc: {required: true, email: true},
            direccionc: {required: true},
            telefonoc: {required: true, number: true},
            cedulac: {required: true, number: true},
            contraseniac: {required: true}
        },
        messages:
                {
                    usuarioc: "Usuario Vacio",
                    correoc: {required: "Email vacio", email: "Ingrese un email correcto (asdf@asdf.com)"},
                    direccionc: "Direccion vacia",
                    telefonoc: {required: "Telefono Vacio", number: "Ingrese numero"},
                    cedulac: {required: "Cedula Vacia", number: "Ingrese numero"},
                    contraseniac: "Contraseña Vacia",
                    nombrec: "Nombre Vacio"
                },
        submitHandler: function (form) {
            var datos = {usuarioc: $("#usuarioc").val(),
                nombrec: $("#nombrec").val(),
                correoc: $("#correoc").val(),
                direccionc: $("#direccionc").val(),
                telefonoc: $("#telefonoc").val(),
                cedulac: $("#cedulac").val(),
                contrac: $("#contraseniac").val(),
                tipoRegistroc: "cliente",
                tipoc: "cliente"

            };
            console.log(datos);
            $.ajax({
                url: "vista/Modulos/Ajax.php",
                method: 'POST',
                data: datos,
                dataType: 'json',
                success: function (respuesta)
                {
                     console.log(respuesta);
                    if (respuesta["exito"]) {
                        respuestaExito("Registro Exitoso","Te has Registrado.Redirigiendo en 2 segundos")
                        
                    } else {
                        swal('Error!', respuesta["error"], 'error');
                    }
                }
            });
        }
    }); 
});

