<?php
require_once 'Controlador/Controlador.php';
require_once 'Modelo/Negocio.php';
require_once 'Modelo/Conexion.php';
require_once 'Modelo/Mail/Mail.php';
require_once 'Modelo/Dao/EstudianteDAO.php';
require_once 'Modelo/Dao/FeriaDAO.php';
require_once 'Modelo/Dao/CriterioFeriaDAO.php';
require_once 'Modelo/Dao/ProyectoDAO.php';
require_once 'Modelo/Dao/proyectoEstudianteDAO.php';
require_once 'Modelo/Dto/ProyectoEstudianteDTO.php';
require_once 'Modelo/Dto/EstudianteDTO.php';
require_once 'Modelo/Dto/EvaluadorDTO.php';
require 'Modelo/Dao/EvaluadorDAO.php';
ob_start();
$controlador=new Controlador(); 

$controlador->generarPlantilla();


//try {
//    $conexion = new Conexion();
//$conn=$conexion->crearConexion();
//$stm=$conn->prepare("select * from estudiante where estudiante.codigo='1290'");
//$stm->execute();
//$aux=$stm->fetch();
//var_dump($aux);
//} catch (Exception $ex) {
//    
//}
