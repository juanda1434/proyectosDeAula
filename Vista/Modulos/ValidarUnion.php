<?php

if (isset($_SESSION["perfil"])) {
    if (isset($_GET["id"],$_GET["key"])) {
        $controlador=new Controlador();
        $proyectoEstudianteDTO=new proyectoEstudianteDTO(null,null,$_GET["id"]);
        $exito=$controlador->validarUnionProyectoControlador($_GET["key"], $proyectoEstudianteDTO);
        if ($exito) {
            header("location:Proyecto=".$_GET["id"]);
        }else{
            header("location:Inicio");
        }
    }else{
        header("location:Inicio");
    }
}else{
    header("location:Ingresar");
}
