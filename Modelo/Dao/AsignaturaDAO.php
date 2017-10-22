<?php

class AsignaturaDAO {

    public function listarAsignaturas($codigoPrograma) {
        $conexion= Conexion::crearConexion();
        
        try{
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("select * from asignatura where codigoprograma=?");
            $stm->bindParam(1, $codigoPrograma,PDO::PARAM_STR);
            $asignaturas= false;
            $stm->execute();
            if ($stm->rowCount()>0) {
                $asignaturas=$stm->fetchAll();
            }
        } catch (Exception $ex) {

        }
        return $asignaturas;
    }
    
     public function listarAsignaturaCodigo($tutoriaDTO){
        $conexion= Conexion::crearConexion();
        $asignatura=false;
        try{
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stm=$conexion->prepare("select * from asignatura where codigo=? and codigoprograma=?");
             $stm->bindParam(1, $tutoriaDTO->getCodigoAsignatura(),PDO::PARAM_STR);
             $stm->bindParam(2, $tutoriaDTO->getCodigoProgramaAsignatura(),PDO::PARAM_STR);
             $ok=$stm->execute();
             if ($ok && $stm->rowCount()>0) {
                 $asignatura=$stm->fetch();
             }
        } catch (Exception $ex) {

        }        
        return $asignatura;
    }

}
