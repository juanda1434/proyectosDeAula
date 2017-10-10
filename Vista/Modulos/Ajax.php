<?php

include_once '../../Modelo/Dto/EstudianteDTO.php';
require_once '../../Modelo/Dao/EstudianteDAO.php';
require_once '../../Controlador/Controlador.php';
require_once '../../Modelo/Negocio.php';
require_once '../../Modelo/Conexion.php';
require_once '../../Modelo/Mail/Mail.php';
require_once '../../Modelo/Dao/TipoProgramaDAO.php';

class Ajax {

    public function registrarEstudianteAjax($nombre, $codigo, $correo, $documento, $contrasenia, $programaAcademico) {
        $controlador = new Controlador();
        $validarRegistro = md5(time());
        $estudianteDTO = new EstudianteDTO($nombre, $correo, $codigo, $documento, $contrasenia, $programaAcademico, $validarRegistro);
        try {
            $exito = $controlador->registrarEstudianteControlador($estudianteDTO);
            if ($exito) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false, "error" => "No se pudo registrar un estudiante"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => $ex->getMessage()));
        }
    }

    public function listarProgramasAcademicosAjax() {
        $controlador = new Controlador();
        $aux = json_encode($controlador->listarProgramasAcademicosControlador());
        echo $aux;
    }


    public function ingresarEstudiante($correo, $contrasenia) {
        session_start();
        $controlador = new Controlador();
        $exito = false;
        try {
            $exito = $controlador->ingresarEstudianteControlador(new EstudianteDTO(null, $correo, null, null, $contrasenia, null, null));
            if ($exito) {
                echo  json_encode(array("exito"=>true));
            }else{
                echo json_encode(array("exito"=>false,"error"=>"Error al ingresar"));
            }
            
        } catch (Exception $exc) {
            echo json_encode(array("exito"=>false,"error"=>$exc->getMessage()));
        }
    }
    
    public function listarDatosPerfilAjax(){
        session_start();
        $controlador=new Controlador();
        echo json_encode($controlador->listarDatosPerfilControlador());
    }

}

$ajax = new Ajax();
//si esta variable es true significa que debe registrar un estudiante.
$registrarEstudiante = isset($_POST["nombreE"], $_POST["codigoE"], $_POST["correoE"], $_POST["documentoE"], $_POST["contraseniaE"], $_POST["programaAcademicoE"]);

//si esta variable es true significa que debe buscar los programas academicos registrados
$buscarProgramas = isset($_GET["programasAcademicos"]);

//si esta variable es true significa que debe ingresar un usuario al sistema
$ingresarUsuario = isset($_POST["correoI"], $_POST["contraseniaI"]);

//si esta variable es true significa que debe listar los datos de el usuario logeado
$listarDatos= isset($_GET["datosPerfil"]);

if ($registrarEstudiante) {
    $ajax->registrarEstudianteAjax($_POST["nombreE"], $_POST["codigoE"], $_POST["correoE"], $_POST["documentoE"], $_POST["contraseniaE"], $_POST["programaAcademicoE"]);
} else if ($buscarProgramas && $_GET["programasAcademicos"]) {
    $ajax->listarProgramasAcademicosAjax();
} else if ($ingresarUsuario) {
    $ajax->ingresarEstudiante($_POST["correoI"], $_POST["contraseniaI"]);
}else if($listarDatos && $_GET["datosPerfil"]){
    $ajax->listarDatosPerfilAjax();    
}