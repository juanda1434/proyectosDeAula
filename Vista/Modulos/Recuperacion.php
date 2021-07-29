<?php
if (!isset($_GET["key"], $_GET["usuario"], $_GET["tipo"]) && !isset($_SESSION["perfil"])) {
    header("location:Inicio");
} else {

    $controlador = new Controlador();
    $ok = $controlador->validarRecuperarContraseniaControlador($_GET["usuario"], $_GET["key"], $_GET["tipo"]);
    if ($ok) {
        $_SESSION["recuperarContrasenia"] = array("key" => $_GET["key"], "usuario" => $_GET["usuario"], "tipo" => $_GET["tipo"]);
    }else{
        header("location:Inicio");
    }
}
?>

<div class="container contenedor" style="margin-top: 3%">    


    <form class="form-horizontal " id="formActualizarContrasenia">
        <div class="row">

            <div class="col-md-5 col-md-push-3 sombra">

                <div class="form-group">
                    <h3 class=" center">Ingrese Contraseña</h3>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <label class="" for="contraseniaNueva">Contraseña</label>       
                        <input type="password" id="contraseniaNueva" name="contraseniaNueva" minlength="4" maxlength="8" class="form-control" placeholder="Ingresa maximo 8 caracteres" >
                        <label class="bg-danger" id="error-contraseniaNueva"></label>     
                    </div></div>

                <div class="form-group col-md-12">


                    <button class="col-md-6 col-md-offset-3 btn btn-danger" type="submit"><span class="glyphicon glyphicon-share"></span> Actualizar contraseña</button>  

                </div>

            </div>
        </div>



    </form>


</div>
