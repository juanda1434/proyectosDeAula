<?php


include_once '../../Modelo/Dto/EstudianteDTO.php';
require_once '../../Modelo/Dao/EstudianteDAO.php';
require_once '../../Controlador/Controlador.php';
require_once '../../Modelo/Negocio.php';
require_once '../../Modelo/Conexion.php';
require_once '../../Modelo/Mail/Mail.php';
class Ajax {

    public function registrarEstudianteAjax($nombre,$codigo,$correo,$documento,$contrasenia,$programaAcademico) {
        $controlador = new Controlador();
        $validarRegistro= md5(time());
        $estudianteDTO =new EstudianteDTO($nombre, $correo, $codigo, $documento, $contrasenia, $programaAcademico,$validarRegistro);
        try {
            $exito = $controlador->registrarEstudianteControlador($estudianteDTO);
            if ($exito) {
                echo json_encode(array("exito" => true));
            }else{
                echo json_encode(array("exito" =>false , "error"=>"No se pudo registrar un estudiante"));
            }
        } catch (Exception $ex) {
            echo json_encode(array ("exito" => false, "error"=>$ex->getMessage()));
        }
    }

}
$ajax = new Ajax();

//si esta variable es true significa que debe registrar un estudiante.
$validarRegistroEstudiante = isset($_POST["nombreE"],$_POST["codigoE"],$_POST["correoE"],$_POST["documentoE"],$_POST["contraseniaE"],$_POST["programaAcademicoE"]);


if($validarRegistroEstudiante) {
    $ajax->registrarEstudianteAjax($_POST["nombreE"],$_POST["codigoE"],$_POST["correoE"],$_POST["documentoE"],$_POST["contraseniaE"],$_POST["programaAcademicoE"]);
}