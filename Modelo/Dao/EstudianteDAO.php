<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstudianteDAO
 *
 * @author USUARIO
 */
class EstudianteDAO {

    function registrar($estudianteDTO) {
        $conexion = Conexion::crearConexion();
        $exito=false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("insert into estudiante(nombre,correo,codigo,documento,contrasenia,codigoprograma,validarregistro) values(?,?,?,?,?,?,?)");
            $stm->bindParam(1, $estudianteDTO->getNombre(), PDO::PARAM_STR);
            $stm->bindParam(2, $estudianteDTO->getCorreo(), PDO::PARAM_STR);
            $stm->bindParam(3, $estudianteDTO->getCodigo(), PDO::PARAM_STR);
            $stm->bindParam(4, $estudianteDTO->getDocumento(), PDO::PARAM_STR);
            $stm->bindParam(5, $estudianteDTO->getContrasenia(), PDO::PARAM_STR);
            $stm->bindParam(6, $estudianteDTO->getCodigoPrograma(), PDO::PARAM_STR);
            $stm->bindParam(7, $estudianteDTO->getValidarRegistro(), PDO::PARAM_STR);
            $exito=$stm->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
        return $exito;
    }

    function validarRegistro($llaveValidacion,$idEstudiante){
        $conexion= Conexion::crearConexion();
        $exito=false;
        try{
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("update estudiante set estudiante.validarregistro=null where estudiante.id=? and estudiante.validarregistro=?");
            $stm->bindParam(1, $idEstudiante,PDO::PARAM_INT);
            $stm->bindParam(2, $llaveValidacion,PDO::PARAM_STR);
            $exito=$stm->execute();            
        } catch (Exception $ex) {
echo $ex->getMessage();
        }
        return validarRegistro;
    }
}
