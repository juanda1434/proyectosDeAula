<?php

class DocenteDAO {
 
    public function listarDocentes(){
        $conexion= Conexion::crearConexion();     
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
        $conexion= Conexion::crearConexion();
        $docente=false;
        try{
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stm=$conexion->prepare("select * from docente where codigo=? and codigoprograma=?");
             $stm->bindParam(1, $tutoriaDTO->getCodigoDocente(),PDO::PARAM_STR);
             $stm->bindParam(2, $tutoriaDTO->getCodigoProgramaDocente(),PDO::PARAM_STR);
             $ok=$stm->execute();
             if ($ok && $stm->rowCount()>0) {
                 $docente=$stm->fetch();
             }
        } catch (Exception $ex) {

        }
        
        return $docente;
    }
}

