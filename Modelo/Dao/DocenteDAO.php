<?php

class DocenteDAO {
  private $conexion;
    public function __construct() {
        $conn = new Conexion();
        $this->conexion=$conn->crearConexion();
    }
    
    public function listarDocentes(){
        $conexion= $this->conexion;     
        $docentes=false;
        try {            
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("select * from docente");
            $ok=$stm->execute();
            if ($stm->rowCount()>0) {
                 $docentes=$stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        
        return $docentes;
    }

    
    public function listarDocenteCodigo($tutoriaDTO){
        $conexion= $this->conexion;
        $codigoDocente=$tutoriaDTO->getCodigoDocente();
        $codigoProgramaDocente=$tutoriaDTO->getCodigoProgramaDocente();
        $docente=false;
        try{
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stm=$conexion->prepare("select * from docente where codigo=? and codigoprograma=?");
             $stm->bindParam(1, $codigoDocente,PDO::PARAM_STR);
             $stm->bindParam(2, $codigoProgramaDocente,PDO::PARAM_STR);
             $ok=$stm->execute();
             if ($ok && $stm->rowCount()>0) {
                 $docente=$stm->fetch();
             }
        } catch (Exception $ex) {

        }
        
        return $docente;
    }
}

