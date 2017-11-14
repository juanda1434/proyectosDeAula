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

    function IngresarEvaluador($evaluadorDTO) {        
        $conexion = Conexion::crearConexion();
        $evalaluador = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id,nombre,correo,documento from evaluador where documento=? and contrasenia=?");
            $stm->bindParam(1, $evaluadorDTO->getDocumento());
            $stm->bindParam(2, $evaluadorDTO->getContrasenia());            
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $evalaluador = $stm->fetch();
            }
        } catch (Exception $ex) {
            
        }
        return $evalaluador;
    }

    
}
