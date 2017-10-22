<?php

class FeriaDAO {

    public function buscarFeriaId($id) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id from feria where feria.id=? and feria.fechalimiteinscripcion>curdate()");
            $stm->bindParam(1, $id, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $exito = true;
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    public function listarFeriaFiltro($filtro) {
        $conexion = Conexion::crearConexion();
        $ferias = false;
        $ok=false;
        $stm=false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if ($filtro == "activa") {
                $stm = $conexion->prepare("select id,nombre,resumen,nombre,fechalimiteinscripcion as limite from feria where fechalimiteinscripcion >=curdate() limit 0,6");
                $ok = $stm->execute();
            }
            if ($stm && $ok && $stm->rowCount() > 0) {
                $ferias = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $ferias;
    }
    
    
    public function mostrarFeriaId($idFeria){
        $conexion= Conexion::crearConexion();
        $tipoCriterio=false;
        $descripcionCriteros=false;
        $informacionFeria=false;
        $feria=false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("select criterioferia.idtipo,tipocriterio.descripcion,sum(criterioferia.valor) as puntos from criterioferia INNER JOIN feria on feria.id=criterioferia.idferia INNER JOIN tipocriterio on tipocriterio.id=criterioferia.idtipo  where feria.id=1  GROUP by criterioferia.idtipo  ORDER by puntos asc");
            $ok= $stm->bindParam(1, $idFeria,PDO::PARAM_INT);
            $ok=$stm->execute();            
            if ($ok && $stm->rowCount()>0) {
                $tipoCriterio=$stm->fetchAll();
                $ok=false;
                $stm=false;
                $stm= $conexion->prepare("select criterioevaluacion.nombre,criterioevaluacion.descripcion,criterioferia.valor,tipocriterio.id as tipo from criterioferia INNER JOIN feria on criterioferia.idferia=feria.id INNER JOIN criterioevaluacion ON criterioevaluacion.id = criterioferia.idcriterioevaluacion INNER JOIN tipocriterio on tipocriterio.id =criterioferia.idtipo where feria.id=?");
                 $stm->bindParam(1, $idFeria,PDO::PARAM_INT);
                 $ok=$stm->execute();
                 if ($ok && $stm->rowCount()>0) {
                     $descripcionCriteros=$stm->fetchAll();
                     $ok=false;
                     $stm=false;
                     $stm= $conexion->prepare("select feria.nombre,feria.resumen from feria where feria.id=?");
                      $stm->bindParam(1, $idFeria,PDO::PARAM_INT);
                      $ok=$stm->execute();
                     if ($ok && $stm->rowCount()>0) {
                         $informacionFeria=$stm->fetchAll();
                     }
                 }
                  
            }
            if ($tipoCriterio && $descripcionCriteros && $informacionFeria) {
                $feria=[];
                $feria["informacion"]=$informacionFeria;
                $feria["tipoCriterio"]=$tipoCriterio;
                $feria["criterio"]=$descripcionCriteros;
            }
        } catch (Exception $ex) {
            
        }
        return $feria;
        
    }
    

}
