<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalificacionDAO
 *
 * @author USUARIO
 */
class CalificacionDAO {

    public function registrarCalificacion($calificacionesDTO) {        
        $conexion = Conexion::crearConexion();
        $exito=false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->beginTransaction();
            for ($i = 0; $i < count($calificacionesDTO); $i++) {
                $calificacionDTO = $calificacionesDTO[$i];
                $stm = $conexion->prepare("insert into calificacion (idevaluador,idcriterio,nota,observacion) values(?,?,?,?)");
                $stm->bindParam(1, $calificacionDTO->getIdEvaluador(),PDO::PARAM_INT);
                $stm->bindParam(2, $calificacionDTO->getIdCriterio(),PDO::PARAM_INT);
                $stm->bindParam(3, $calificacionDTO->getNota(),PDO::PARAM_INT);
                $stm->bindParam(4, $calificacionDTO->getObservacion(),PDO::PARAM_STR);
                $stm->execute();
            }
            $exito=$conexion->commit();
            
        } catch (Exception $ex) {
            $conexion->rollBack();
            echo $ex->getMessage();
        }
        return $exito;
    }

}
