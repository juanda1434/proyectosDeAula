<?php

class Controlador {
private $negocio;
    public function __construct() {
        $this->negocio=new Negocio();
    }


    public function generarPlantilla() {
        return $this->negocio->generarPlantilla();
    }

    public function generarVista() {
        $enlace = filter_input(INPUT_GET, "ubicacion");
        if ($enlace) {
            $enlace = $this->negocio->generarEnlace($enlace);
        } else {
            $enlace = $this->negocio->generarEnlace("Inicio");
                    echo "<script>location.href= 'Inicio' </script>";

        }
        include_once $enlace;
    }

    public function registrarEstudianteControlador($estudianteDTO) {
        return $this->negocio->registrarEstudianteNegocio($estudianteDTO);
    }

    public function validarRegistroEstudianteControlador($llaveValidacion) {
        return $this->negocio->validarRegistroEstudianteNegocio($llaveValidacion);
    }

    
    public function listarProgramasAcademicosControlador() {
        return $this->negocio->listarProgramasAcademicosNegocio();
        
    }
    
    public function ingresarEstudianteControlador($estudianteDTO) {
        return $this->negocio->ingresarEstudianteNegocio($estudianteDTO);
    }
    
    public function listarDatosPerfilControlador(){
        return $this->negocio->listarDatosPerfilNegocio();
    }
    
    public function listarDocentesControlador(){
        return $this->negocio->listarDocentesNegocio();        
    }
    
    public function listarAsignaturasControlador() {
        return $this->negocio->listarAsignaturasNegocio();
    }
    
    public function listarLineasInvestigacionControlador() {
        return $this->negocio->listarLineasInvestigacionNegocio();
    }
    
    public function guardarTutoriaControlador($tutoriaDTO){
        return $this->negocio->guardarTutoriaNegocio($tutoriaDTO);
    }
    
    public function listarTutoriasControlador() {
       return $this->negocio->listarTutoriasNegocio();
    }
    
    
    
    
    
    public function validarFeriaControlador($id){
        return $this->negocio->validarFeriaNegocio($id);
    }
    
    public function registrarProyectoControlador($proyectoDTO){
        return $this->negocio->registrarProyectoNegocio($proyectoDTO);
    }
    
    
    
    public function enviarCorreoValidacionControlador(){
        return $this->negocio->enviarCorreoValidacionNegocio();
         
    }
    
    public function listarProyectoIdControlador(){
        return $this->negocio->listarProyectoIdNegocio();
    }
    
    public function listarMisProyectosControlador(){
        return $this->negocio->listarMisProyectosNegocio();
    }
    
    public function mostrarFeriaIdControlador(){
        return $this->negocio->mostrarFeriaIdNegocio();
    }
    
    public function invitarCompanieroControlador($correo) {
        return $this->negocio->invitarCompanieroNegocio($correo);
    }
    
    public function validarUnionProyectoControlador($key,$proyectoEstudianteDTO){
        return $this->negocio->validarUnionProyectoNegocio($key, $proyectoEstudianteDTO);
    }
    
    public function ingresarEvaluadorControlador($evaluadorDTO) {
        return $this->negocio->ingresarEvaluadorNegocio($evaluadorDTO);
    }
    
    public function listarFeriaControlador($filtro){
        return $this->negocio->listarFeriaFiltroNegocio($filtro);
    }
    
    public function mostrarCriteriosEvaluarControlador(){
        return $this->negocio->mostrarCriteriosEvaluarNegocio();
    }
    
    public function validarProyectoEvaluadorControlador(){
        return $this->negocio->validarProyectoEvaluadorNegocio();
    }
    public function validarEvaluadorProyectoControlador(){
        return $this->negocio->validarEvaluadorProyectoNegocio();
    }
    
    public function modificarNotaTemporalControlador($idCriterio,$nota,$observacion){
        return $this->negocio->modificarNotaTemporalNegocio($idCriterio,$nota,$observacion);
    }
    
    public function registrarCalifacionControlador($calificaciones){
        return $this->negocio->registrarCalificacionNegocio($calificaciones);
    }
    
    public function recuperarContraseniaEstudianteControlador($estudianteDTO){
       return $this->negocio->recuperarContraseniaEstudianteNegocio($estudianteDTO);
    }
     public function recuperarContraseniaEvaluadorControlador($evaluadorDTO){
       return $this->negocio->recuperarContraseniaEvaluadorNegocio($evaluadorDTO);
    }
    
    public function validarRecuperarContraseniaControlador($usuario,$key,$tipo){
        return $this->negocio->validarRecuperarContraseniaNegocio($usuario, $key, $tipo);
    }
    
    public function ingresarContraseniaNuevaRecuperacionControlador($contrasenia){
        return $this->negocio->ingresarContraseniaNuevaRecuperacionNegocio($contrasenia);
    }
    
    public function actualizarContraseniaControlador($contrasenia){
        return $this->negocio->actualizarContraseniaNegocio($contrasenia);
    }
    
    public function actualizarDatoProyectoControlador($nombre,$dato){
        return $this->negocio->actualizarDatoProyectoNegocio($nombre,$dato);
    }
    
    public function listarGanadoresFeriaControlador(){
        return $this->negocio->listarGanadoresFeriaNegocio();
    }
    
    public function listarProyectosCantidadEvaluacionesControlador(){
        return $this->negocio->listarProyectosCantidadEvaluacionesNegocio();
    }
    
    public function consultaRene(){
        return $this->negocio->consultaRene();
    }
}
