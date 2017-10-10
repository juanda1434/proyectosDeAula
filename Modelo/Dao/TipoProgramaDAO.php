<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoProgramaDAO
 *
 * @author USUARIO
 */
class TipoProgramaDAO {

    public function obtenerCodigoPrograma($nombre) {
        $conexion = Conexion::crearConexion();
        $codigo = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select codigo from programa where nombre = ? ");
            $stm->bindParam(1, $nombre, PDO::PARAM_STR);
            $ok = $stm->execute();
            if ($ok) {
                $codigo = $stm->fetch();
                $codigo = $codigo["codigo"];
            }
        } catch (Exception $exc) {
            throw new Exception("Ingresa un programa academico valido por favor.");
        }
        return $codigo;
    }

    public function listarProgramasAcademicos() {
        $conexion = Conexion::crearConexion();
        $codigo = false;
        $programas = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select nombre from programa");
            $ok = $stm->execute();
            if ($ok) {
                $programas = $stm->fetchAll();
            }
        } catch (Exception $exc) {
            throw new Exception("");
        }

        return $programas;
    }

}
