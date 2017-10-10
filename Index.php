<?php
require_once 'Controlador/Controlador.php';
require_once 'Modelo/Negocio.php';
require_once 'Modelo/Conexion.php';
require_once 'Modelo/Mail/Mail.php';
require_once 'Modelo/Dao/EstudianteDAO.php';
ob_start();
$controlador=new Controlador(); 

$controlador->generarPlantilla();


