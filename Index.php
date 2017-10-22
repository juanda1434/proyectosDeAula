<?php
require_once 'Controlador/Controlador.php';
require_once 'Modelo/Negocio.php';
require_once 'Modelo/Conexion.php';
require_once 'Modelo/Mail/Mail.php';
require_once 'Modelo/Dao/EstudianteDAO.php';
require_once 'Modelo/Dao/FeriaDAO.php';
require_once 'Modelo/Dao/ProyectoDAO.php';
require_once 'Modelo/Dao/proyectoEstudianteDAO.php';
require_once 'Modelo/Dto/proyectoEstudianteDTO.php';
ob_start();
$controlador=new Controlador(); 

$controlador->generarPlantilla();


