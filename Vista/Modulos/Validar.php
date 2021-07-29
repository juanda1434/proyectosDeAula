<?php

if (isset($_GET["key"])) {
    if (isset($_SESSION["perfil"])) {
        $controlador = new Controlador();
        $validacion = $controlador->validarRegistroEstudianteControlador($_GET["key"]);

        if ($validacion) {
            header("location:Perfil");
        } else {
            header("location:Inicio");
        }
        if (isset($_SESSION["validarRegistro"])) {
            isset($_SESSION["validarRegistro"]);
        }
    } else {
        $_SESSION["validarRegistro"] = $_GET["key"];
        header("location:Ingresar");
    }
} else {
    header("location:Inicio");
}
