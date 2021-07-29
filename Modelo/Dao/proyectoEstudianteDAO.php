<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of proyectoEstudianteDAO
 *
 * @author USUARIO
 */
class proyectoEstudianteDAO {

    private $conexion;
    public function __construct() {
        $conn = new Conexion();
        $this->conexion=$conn->crearConexion();
    }
    
    function registrarUnion($proyectoEstudianteDTO) {
        $conexion = $this->conexion;
        $exito = false;
        $idEstudiante=$proyectoEstudianteDTO->getIdEstudiante();
        $idProyecto=$proyectoEstudianteDTO->getIdProyecto();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("insert into proyectoestudiante (idestudiante,idproyecto) values(?,?)");
            $stm->bindParam(1, $idEstudiante, PDO::PARAM_INT);
            $stm->bindParam(2, $idProyecto, PDO::PARAM_INT);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    function listarProyectoEstudiante($proyectoEstudianteDTO) {
        $conexion = $this->conexion;
        $exito = false;
        $proyectoEstudiante = false;
        $idEstudiante= $proyectoEstudianteDTO->getIdEstudiante();
        $idProyecto=$proyectoEstudianteDTO->getIdProyecto();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select * from proyectoestudiante where idestudiante=? and idproyecto=?");
            $stm->bindParam(1, $idEstudiante, PDO::PARAM_INT);
            $stm->bindParam(2, $idProyecto, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok) {
                $proyectoEstudiante = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $proyectoEstudiante;
    }

}
