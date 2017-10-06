<?php

class Negocio {
    
 
    
    
   
    public function numero(){
        $this->numero++;
        echo $this->numero;
    }
            function __construct() {
        $this->mail= new Mail();
}
    public function generarPlantilla(){
        include 'Vista/Plantilla.php';
}

private function validarPalabraNavbar($palabra){
    $exito=false;
    $palabras=array("Inicio","Registro","Significado","Importancia","Objetivos","Ingresar");
    if (in_array($palabra,$palabras)) {
        $exito=true;
    }
    return $exito;
}

private function validarPalabraRedireccion($palabra){
    $exito=false;
    $palabras=array("Validar");
     if (in_array($palabra,$palabras)) {
        $exito=true;
    }
    return $exito;
}

public function generarEnlace($enlace){
    
    if ($this->validarPalabraNavbar($enlace)) {
        return "Vista/Modulos/BarraNavegacion/".$enlace.".php";
    }else if ($this->validarPalabraRedireccion($enlace)) {
        return "Vista/Modulos/".$enlace.".php";
    }else{
        return "Vista/Modulos/BarraNavegacion/Inicio.php";
    }
}




public function registrarEstudianteNegocio($estudianteDTO){
    $registroExitoso=EstudianteDAO::registrar($estudianteDTO);
    if ($registroExitoso) {
        
        Mail::enviarMailValidarRegistro($estudianteDTO->getCorreo(),$estudianteDTO->getValidarRegistro());
        
    }
    return $registroExitoso;
}


public function validarRegistroEstudianteNegocio($llaveValidacion){
    return EstudianteDAO::validarRegistro($llaveValidacion,$_SESSION["id"]);
}
}
