<?php

if (isset($_GET["id"], $_GET["key"])) {
    if (isset($_SESSION["validarUnion"])) {
        if ($_GET["id"]!=$_SESSION["validarUnion"]["id"] || $_GET["key"]!=$_SESSION["validarUnion"]["key"]) {
            $_SESSION["validarUnion"]=array("id"=>$_GET["id"],"key"=>$_GET["key"]);
        }
        
    if (isset($_SESSION["perfil"])) {
        validar($_SESSION["validarUnion"]["id"],$_SESSION["validarUnion"]["key"]);
    }else{
         $_SESSION["errorIngresarUnion"]=true;  
        header("location:Ingresar");
    }
    
}else if (isset($_SESSION["perfil"])) {
        validar($_GET["id"], $_GET["key"]);
    } else {
       $_SESSION["validarUnion"]=array("id"=>$_GET["id"],"key"=>$_GET["key"]);
        $_SESSION["errorIngresarUnion"]=true;        
        header("location:Ingresar");
    }
} else {
    $_SESSION["errorValidarUnion"]=true;  
    header("location:Inicio");
    
}

function validar($id,$key){
    $controlador = new Controlador();
        $proyectoEstudianteDTO = new proyectoEstudianteDTO(null, null, $id);
        $exito = $controlador->validarUnionProyectoControlador($key, $proyectoEstudianteDTO);
        if (isset($_SESSION["validarUnion"])) {
            unset($_SESSION["validarUnion"]);
        }
        if ($exito) {
            $_SESSION["exitoValidarUnion"]=true;
            header("location:LProyecto=" . $id);
        } else {
            $_SESSION["errorValidarUnion"]=true;            
            header("location:Inicio");
            
        }
}