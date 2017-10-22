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

    function registrarUnion($proyectoEstudianteDTO) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("insert into proyectoestudiante (idestudiante,idproyecto) values(?,?)");
            $stm->bindParam(1, $proyectoEstudianteDTO->getIdEstudiante(), PDO::PARAM_INT);
            $stm->bindParam(2, $proyectoEstudianteDTO->getIdProyecto(), PDO::PARAM_INT);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    function listarProyectoEstudiante($proyectoEstudianteDTO) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        $proyectoEstudiante = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select * from proyectoestudiante where idestudiante=? and idproyecto=?");
            $stm->bindParam(1, $proyectoEstudianteDTO->getIdEstudiante(), PDO::PARAM_INT);
            $stm->bindParam(2, $proyectoEstudianteDTO->getIdProyecto(), PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok) {
                $proyectoEstudiante = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $proyectoEstudiante;
    }

}
