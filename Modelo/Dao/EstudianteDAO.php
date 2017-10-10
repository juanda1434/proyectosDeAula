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

    function registrarEstudiante($estudianteDTO) {
        $conexion = Conexion::crearConexion();
        $exito = false;
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
            $exito = $stm->execute();
        } catch (Exception $ex) {
            if (strpos($ex->getMessage(), "documento_UNIQUE")) {
                throw new Exception("Ingresaste un documento que ya esta registrado en el sistema");
            } else if (strpos($ex->getMessage(), "correo_UNIQUE")) {
                throw new Exception("Ingresaste un correo que ya esta registrado en el sistema");
            } else if (strpos($ex->getMessage(), "programa_codigo_UNIQUE")) {
                throw new Exception("Ingresaste un codigo que ya esta registrado en el sistema (" . $estudianteDTO->getCodigoPrograma() . $estudianteDTO->getCodigo() . ")");
            }
        }

        return $exito;
    }

    function validarRegistro($llaveValidacion, $correo) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("update estudiante set estudiante.validarregistro=null where estudiante.correo=? and estudiante.validarregistro=?");
            $stm->bindParam(1, $correo, PDO::PARAM_STR);
            $stm->bindParam(2, $llaveValidacion, PDO::PARAM_STR);
            $exito = $stm->execute();
            if ($exito) {
                if ($stm->rowCount()<1) {
                    $exito=false;
                }
            }            
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $exito;
    }

    public function IngresarEstudiante($estudianteDTO) {
        $conexion = Conexion::crearConexion();
        $estudiante = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select nombre,correo,codigo,documento,codigoprograma,validarregistro from estudiante where correo=? and contrasenia=?");
            $stm->bindParam(1, $estudianteDTO->getCorreo(), PDO::PARAM_STR);
            $stm->bindParam(2, $estudianteDTO->getContrasenia(), PDO::PARAM_STR);
            $ok = $stm->execute();
            if ($ok) {
                $estudiante=$stm->fetch();
            }
        } catch (Exception $ex) {
            throw new Exception("Error al ingresar Estudiante bd");
        }
        return $estudiante;
    }

}
