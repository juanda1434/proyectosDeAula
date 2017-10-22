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
                    echo "<script>location.href= 'Inicio' </script>";

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
    
    public function listarDocentesControlador(){
        $negocio= new Negocio();
        return $negocio->listarDocentesNegocio();        
    }
    
    public function listarAsignaturasControlador() {
        $negocio= new Negocio();
        return $negocio->listarAsignaturasNegocio();
    }
    
    public function listarLineasInvestigacionControlador() {
        $negocio=new Negocio();
        return $negocio->listarLineasInvestigacionNegocio();
    }
    
    public function guardarTutoriaControlador($tutoriaDTO){
        $negocio= new Negocio();
        return $negocio->guardarTutoriaNegocio($tutoriaDTO);
    }
    
    public function listarTutoriasControlador() {
       $negocio= new Negocio();
       return $negocio->listarTutoriasNegocio();
    }
    
    
    
    
    
    public function validarFeriaControlador($id){
        $negocio=new Negocio();
        return $negocio->validarFeriaNegocio($id);
    }
    
    public function registrarProyectoControlador($proyectoDTO){
        $negocio=new Negocio();
        return $negocio->registrarProyectoNegocio($proyectoDTO);
    }
    
    public function listarFeriaFiltroControlador($filtro) {
        $negocio=new Negocio();
        return $negocio->listarFeriasFiltroNegocio($filtro);
        
    }
    
    public function enviarCorreoValidacionControlador(){
        $negocio=new Negocio();
        return $negocio->enviarCorreoValidacionNegocio();
         
    }
    
    public function listarProyectoIdControlador(){
        $negocio=new Negocio();
        return $negocio->listarProyectoIdNegocio();
    }
    
    public function listarMisProyectosControlador(){
        $negocio=new Negocio();
        return $negocio->listarMisProyectosNegocio();
    }
    
    public function mostrarFeriaIdControlador(){
        $negocio= new Negocio();
        return $negocio->mostrarFeriaIdNegocio();
    }
    
    public function invitarCompanieroControlador($correo) {
        $negocio= new Negocio();
        return $negocio->invitarCompanieroNegocio($correo);
    }
    
    public function validarUnionProyectoControlador($key,$proyectoEstudianteDTO){
        $negocio=new Negocio();
        return $negocio->validarUnionProyectoNegocio($key, $proyectoEstudianteDTO);
    }
}
