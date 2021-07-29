<?php


class CriterioFeriaDAO {
 
     private $conexion;
    public function __construct() {
        $conn = new Conexion();
        $this->conexion=$conn->crearConexion();
    }
    
    public function listarCriterios($idFeria) {
        
        $conexion = $this->conexion;
        $tipoCriterio = false;
        $descripcionCriteros = false;
        $criterios = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select criterioferia.idtipo,tipocriterio.descripcion,sum(criterioferia.valor) as puntos from criterioferia INNER JOIN feria on feria.id=criterioferia.idferia INNER JOIN tipocriterio on tipocriterio.id=criterioferia.idtipo  where feria.id=?  GROUP by criterioferia.idtipo  ORDER by puntos asc");
            $stm->bindParam(1, $idFeria, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $tipoCriterio = $stm->fetchAll();
                $ok = false;
                $stm = false;
                $stm = $conexion->prepare("select criterioferia.id,criterioevaluacion.nombre,criterioevaluacion.descripcion,criterioferia.valor,tipocriterio.id as tipo from criterioferia INNER JOIN feria on criterioferia.idferia=feria.id INNER JOIN criterioevaluacion ON criterioevaluacion.id = criterioferia.idcriterioevaluacion INNER JOIN tipocriterio on tipocriterio.id =criterioferia.idtipo where feria.id=?");
                $stm->bindParam(1, $idFeria, PDO::PARAM_INT);
                $ok = $stm->execute();
                if ($ok && $stm->rowCount() > 0) {
                    $descripcionCriteros = $stm->fetchAll();                    
                }
            }
            if ($tipoCriterio && $descripcionCriteros) {
                $criterios = [];
                $criterios["tipoCriterio"] = $tipoCriterio;
                $criterios["criterio"] = $descripcionCriteros;
            }
        } catch (Exception $ex) {
        }
        return $criterios;
    }
    
}
