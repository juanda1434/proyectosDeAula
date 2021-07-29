<?php

class AsignaturaDAO {
 private $conexion;
    public function __construct() {
      $con=new Conexion();
      $this->conexion=$con->crearConexion();
    }

    public function listarAsignaturas($codigoPrograma) {
        $conexion= $this->conexion;
        
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
        $conexion= $this->conexion;
        $asignatura=false;
         $codigoAsignatura=$tutoriaDTO->getCodigoAsignatura();
         $codigoProgramaAsignatura=$tutoriaDTO->getCodigoProgramaAsignatura();
        try{
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stm=$conexion->prepare("select * from asignatura where codigo=? and codigoprograma=?");
             $stm->bindParam(1,$codigoAsignatura ,PDO::PARAM_STR);
             $stm->bindParam(2, $codigoProgramaAsignatura,PDO::PARAM_STR);
             $ok=$stm->execute();
             if ($ok && $stm->rowCount()>0) {
                 $asignatura=$stm->fetch();
             }
        } catch (Exception $ex) {

        }        
        return $asignatura;
    }

}
