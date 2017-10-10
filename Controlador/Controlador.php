<?php

class Controlador {

    public function generarPlantilla() {
        return Negocio::generarPlantilla();
    }

    public function generarVista() {
        $negocio = new Negocio();
        $enlace = filter_input(INPUT_GET, "ubicacion");
        if ($enlace) {
            $enlace = $negocio->generarEnlace($enlace);
        } else {
            $enlace = $negocio->generarEnlace("Inicio");
        }
        include_once $enlace;
    }

    public function registrarEstudianteControlador($estudianteDTO) {
        $negocio = new Negocio();
        return $negocio->registrarEstudianteNegocio($estudianteDTO);
    }

    public function validarRegistroEstudianteControlador($llaveValidacion) {
        $negocio = new Negocio();
        return $negocio->validarRegistroEstudianteNegocio($llaveValidacion);
    }

    
    public function listarProgramasAcademicosControlador() {
        $negocio= new Negocio();
        return $negocio->listarProgramasAcademicosNegocio();
        
    }
    
    public function ingresarEstudianteControlador($estudianteDTO) {
        $negocio=new Negocio();
        return $negocio->ingresarEstudianteNegocio($estudianteDTO);
    }
    
    public function listarDatosPerfilControlador(){
        $negocio= new Negocio();
        return $negocio->listarDatosPerfilNegocio();
    }
}
