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

    private $conexion;

    public function __construct() {
        $conn = new Conexion();
        $this->conexion = $conn->crearConexion();
    }

    public function registrarCalificacion($calificacionesDTO) {
        $conexion = $this->conexion;
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->beginTransaction();
            for ($i = 0; $i < count($calificacionesDTO); $i++) {
                $calificacionDTO = $calificacionesDTO[$i];
                $idEvaluador = $calificacionDTO->getIdEvaluador();
                $idCriterio = $calificacionDTO->getIdCriterio();
                $nota = $calificacionDTO->getNota();
                $observacion = $calificacionDTO->getObservacion();
                $stm = $conexion->prepare("insert into calificacion (idevaluador,idcriterio,nota,observacion) values(?,?,?,?)");
                $stm->bindParam(1, $idEvaluador, PDO::PARAM_INT);
                $stm->bindParam(2, $idCriterio, PDO::PARAM_INT);
                $stm->bindParam(3, $nota, PDO::PARAM_INT);
                $stm->bindParam(4, $observacion, PDO::PARAM_STR);
                $stm->execute();
            }
            $exito = $conexion->commit();
        } catch (Exception $ex) {
            $conexion->rollBack();
            echo $ex->getMessage();
        }
        return $exito;
    }

}
