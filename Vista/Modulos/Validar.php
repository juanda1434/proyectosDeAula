<?php   
 if (isset($_GET["key"])) {
     if (isset($_SESSION["id"])) {
        $controlador=new Controlador();
        $validacion=$controlador->validarRegistroEstudianteControlador($_GET["key"]);
        if ($validacion) {
//            header("location:Perfil");
            echo "has sido validado papu";
        }else{
//            header("location:Inicio");
            echo "no te has podido validar papu la key no funciona papu";
        }
     }else{
         $_SESSION["key"]=$_GET["key"];
        header("location:Ingresar");
     }
}else{
//    header("location:Inicio");
    echo 'que haces aqui papu?';
}
