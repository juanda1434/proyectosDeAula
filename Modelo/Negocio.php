<?php

class Negocio {

    public function numero() {
        $this->numero++;
        echo $this->numero;
    }

    function __construct() {
        $this->mail = new Mail();
    }

    public function generarPlantilla() {
        include 'Vista/Plantilla.php';
    }

    private function validarPalabraNavbar($palabra) {
        $exito = false;
        $palabras = array("Inicio", "Registro", "Significado", "Importancia", "Objetivos", "Ingresar","Salir","Perfil");
        if (in_array($palabra, $palabras)) {
            $exito = true;
        }
        return $exito;
    }

    private function validarPalabraRedireccion($palabra) {
        $exito = false;
        $palabras = array("Validar","RegistrarProyecto");
        if (in_array($palabra, $palabras)) {
            $exito = true;
        }
        return $exito;
    }

    public function generarEnlace($enlace) {

        if ($this->validarPalabraNavbar($enlace)) {
            return "Vista/Modulos/BarraNavegacion/" . $enlace . ".php";
        } else if ($this->validarPalabraRedireccion($enlace)) {
            return "Vista/Modulos/" . $enlace . ".php";
        } else {
            return "Vista/Modulos/BarraNavegacion/Inicio.php";
        }
    }

    public function registrarEstudianteNegocio($estudianteDTO) {
        $codigoProgama = TipoProgramaDAO::obtenerCodigoPrograma($estudianteDTO->getCodigoPrograma());
        $registroExitoso = false;
        if ($codigoProgama) {
            $estudianteDTO->setCodigoPrograma($codigoProgama);
            $registroExitoso = EstudianteDAO::registrarEstudiante($estudianteDTO);
            if ($registroExitoso) {
                Mail::enviarMailValidarRegistro($estudianteDTO->getCorreo(), $estudianteDTO->getValidarRegistro());
            }
        }

        return $registroExitoso;
    }

    public function validarRegistroEstudianteNegocio($llaveValidacion) {
       $exito= EstudianteDAO::validarRegistro($llaveValidacion, $_SESSION["perfil"]["correo"]);
       if ($exito) {
           $_SESSION["perfil"]["Key"]=false;
       }
       return $exito;
    }

    public function listarProgramasAcademicosNegocio(){
        return TipoProgramaDAO::listarProgramasAcademicos();
    }
    
    public function ingresarEstudianteNegocio($estudianteDTO){
        $estudiante= EstudianteDAO::IngresarEstudiante($estudianteDTO);
        $exito=false;
        if ($estudiante) {            
            $this->guardarDatosPerfilEstudiante($estudiante);
            $exito=true;
        }
        return $exito;
    }
    
    private function guardarDatosPerfilEstudiante($estudiante){
        $key;
        if (isset($estudiante["validarregistro"])) {
            $key=true;
        }else{
            $key=false;
        }
        $datos= array("nombre"=>$estudiante["nombre"],
            "codigo"=>$estudiante["codigoprograma"].$estudiante["codigo"],
            "tipo"=>"Estudiante",
            "correo"=>$estudiante["correo"],
            "documento"=>$estudiante["documento"],
            "key"=>$key);
        $_SESSION["perfil"]=$datos;
    }
    
    
    public function listarDatosPerfilNegocio(){
        $perfil = $_SESSION["perfil"];
        $key= $perfil["key"];
        unset($perfil["key"]);
        if ($key) {
            $perfil["estado"]="Validado";
        }else{
            $perfil["estado"]="No validado";
        }
        return $perfil;
    }
}
