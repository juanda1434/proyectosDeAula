<?php
require_once 'Controlador/Controlador.php';
require_once 'Modelo/Negocio.php';
require_once 'Modelo/Mail/Mail.php';
ob_start();
$controlador=new Controlador(); 

$controlador->generarPlantilla();


