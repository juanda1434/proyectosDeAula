<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvaluadorDAO
 *
 * @author USUARIO
 */
class EvaluadorDAO {

    private $conexion;

    public function __construct() {
        $conn = new Conexion();
        $this->conexion = $conn->crearConexion();
    }

    function IngresarEvaluador($evaluadorDTO) {
        $conexion = $this->conexion;
        $evalaluador = false;
        $documento = $evaluadorDTO->getDocumento();
        $contrasenia = $evaluadorDTO->getContrasenia();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select evaluador.id,evaluador.nombre,evaluador.correo,evaluador.documento,IF(administrador.idevaluador is not null,'administrador',false) as admin from evaluador LEFT JOIN administrador on administrador.idevaluador=evaluador.id where documento=? and contrasenia=? ");
            $stm->bindParam(1, $documento);
            $stm->bindParam(2, $contrasenia);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $evalaluador = $stm->fetch();
            }
        } catch (Exception $ex) {
            
        }
        return $evalaluador;
    }

    public function modificarKeyValidacionContrasenia($evaluadorDTO) {
        $conexion = $this->conexion;
        $exito = false;
        $key = $evaluadorDTO->getValidarContrasenia();
        $documento = $evaluadorDTO->getDocumento();
        $correo = $evaluadorDTO->getCorreo();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("UPDATE evaluador set evaluador.validarcontrasenia=? where evaluador.documento=? and evaluador.correo=?");
            $stm->bindParam(1, $key, PDO::PARAM_STR);
            $stm->bindParam(2, $documento, PDO::PARAM_STR);
            $stm->bindParam(3, $correo, PDO::PARAM_STR);
            $ok = $stm->execute();
            if ($ok) {
                if ($stm->rowCount() > 0) {
                    $exito = true;
                }
            }
        } catch (Exception $ex) {
            echo $ex;
        }
        return $exito;
        ;
    }

    public function validarKeyContrasenia($evaluadorDTO) {
        $exito = false;
        $conexion = $this->conexion;
        $validarContrasenia = $evaluadorDTO->getValidarContrasenia();
        $documento = $evaluadorDTO->getDocumento();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id from evaluador where evaluador.documento=? and evaluador.validarcontrasenia=?");
            $stm->bindParam(1, $documento, PDO::PARAM_STR);
            $stm->bindParam(2, $validarContrasenia, PDO::PARAM_STR);
            $ok = $stm->execute();
            echo $ok;
            if ($ok && $stm->rowCount() > 0) {
                $exito = true;
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    public function ingresarContraRecuperacion($evaluadorDTO, $contrasenia) {
        $exito = false;
        $conexion = $this->conexion;
        $validarContrasenia = $evaluadorDTO->getValidarContrasenia();
        $documento = $evaluadorDTO->getDocumento();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("update evaluador set evaluador.contrasenia=?,evaluador.validarcontrasenia=null where evaluador.documento=?  and evaluador.validarcontrasenia=?");
            $stm->bindParam(1, $contrasenia, PDO::PARAM_STR);
            $stm->bindParam(2, $documento, PDO::PARAM_STR);
            $stm->bindParam(3, $validarContrasenia, PDO::PARAM_STR);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $exito = true;
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    public function actualizarContrasenia($id, $contrasenia) {
        $exito = false;
        $conexion = $this->conexion;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("update evaluador set evaluador.contrasenia=? where evaluador.id=?");
            $stm->bindParam(1, $contrasenia, PDO::PARAM_STR);
            $stm->bindParam(2, $id, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $exito = true;
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    
    public function obtenerIdEvaluadorProyecto($idEvaluador,$idProyecto){        
        $exito = false;
        $conexion = $this->conexion;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select evaluadorproyecto.id from evaluadorproyecto INNER JOIN proyecto on proyecto.id=evaluadorproyecto.idproyecto INNER JOIN evaluadorferia on evaluadorferia.id=evaluadorproyecto.idevaluadorferia INNER JOIN evaluador on evaluador.id=evaluadorferia.idevaluador where evaluador.id=? and proyecto.id=?");
            $stm->bindParam(1, $idEvaluador, PDO::PARAM_INT);
            $stm->bindParam(2, $idProyecto, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $exito =$stm->fetch();
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }
}
