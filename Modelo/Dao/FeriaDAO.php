<?php

class FeriaDAO {

    public function buscarFeriaId($id) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id from feria where feria.id=? and feria.fechalimiteinscripcion>=curdate()");
            $stm->bindParam(1, $id, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $exito = true;
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    public function mostrarFeriaId($idFeria) {
        $tipoCriterio = false;
        $criterios = false;
        $descripcionCriteros = false;
        $informacionFeria = false;
        $feria = false;
        try {
            $criterios = CriterioFeriaDAO::listarCriterios($idFeria); 
            if (isset($criterios["criterio"], $criterios["tipoCriterio"])) {                
                $conexion = Conexion::crearConexion();
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $descripcionCriteros = $criterios["criterio"];
                $tipoCriterio = $criterios["tipoCriterio"];
                $stm = $conexion->prepare("select feria.nombre,feria.resumen from feria where feria.id=?");
                $stm->bindParam(1, $idFeria, PDO::PARAM_INT);
                $ok = $stm->execute();                
                if ($ok && $stm->rowCount() > 0) {
                    $informacionFeria = $stm->fetchAll();
                }
            }
            if ($tipoCriterio && $descripcionCriteros && $informacionFeria) {
                $feria = [];
                $feria["informacion"] = $informacionFeria;
                $feria["tipoCriterio"] = $tipoCriterio;
                $feria["criterio"] = $descripcionCriteros;
            }
        } catch (Exception $ex) {
            
        }
        return $feria;
    }

    public function listarFerias($filtro) {
        $conexion = Conexion::crearConexion();
        $ferias = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $this->retornarSqlFiltro($filtro);
            $stm = $conexion->prepare($sql[1]);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $aux = $stm->fetch();
                if (isset($aux["total"]) && $aux["total"] != 0) {
                    $stm = $conexion->prepare($sql[0]);
                    $ok = $stm->execute();
                    if ($ok && $stm->rowCount() > 0) {
                        $ferias = $stm->fetchAll();
                        $ferias[count($ferias)]["total"] = $aux["total"];
                    }
                }
            }
        } catch (Exception $ex) {
            
        }
        return $ferias;
    }

    public function listarFeriasParticipacionEstudiante($filtro) {
        $conexion = Conexion::crearConexion();
        $ferias = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $this->retornarSqlFiltroParticipacionEstudiante($filtro);
            $stm = $conexion->prepare($sql[1]);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $aux = $stm->fetch();
                if (isset($aux["total"]) && $aux["total"] != 0) {
                    $stm = $conexion->prepare($sql[0]);
                    $ok = $stm->execute();
                    if ($ok && $stm->rowCount() > 0) {
                        $ferias = $stm->fetchAll();
                        $ferias[count($ferias)]["total"] = $aux["total"];
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex;
        }
        return $ferias;
    }

    public function listarFeriasParticipacionEvaluador($filtro) {
        $conexion = Conexion::crearConexion();
        $ferias = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $this->retornarSqlFiltroParticipacionEvaluador($filtro);
            $stm = $conexion->prepare($sql[1]);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $aux = $stm->fetch();
                if (isset($aux["total"]) && $aux["total"] != 0) {
                    $stm = $conexion->prepare($sql[0]);
                    $ok = $stm->execute();
                    if ($ok && $stm->rowCount() > 0) {
                        $ferias = $stm->fetchAll();
                        $ferias[count($ferias)]["total"] = $aux["total"];
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex;
        }
        return $ferias;
    }

    private function retornarSqlFiltro($filtro) {
        $sql1 = "select feria.id,feria.nombre,feria.resumen,";
        $sql2 = "select count(feria.id)as total from feria";
        switch ($filtro["estado"]) {
            case "Activa":
                $sql1.= "feria.fechalimiteinscripcion as limite from feria INNER JOIN (SELECT feria.id,COUNT(criterioferia.id) as total FROM criterioferia INNER JOIN feria on feria.id=criterioferia.idferia INNER JOIN tipocriterio on tipocriterio.id=criterioferia.idtipo INNER JOIN criterioevaluacion on criterioevaluacion.id= criterioferia.idcriterioevaluacion GROUP BY feria.id)x on x.id=feria.id where x.total>0 and feria.fechalimiteinscripcion>=curdate() and feria.fechafinal is null and if(feria.fechainicio is not null, if(feria.fechalimiteinscripcion<feria.fechainicio,true,false),true)";
                $sql2 .=" INNER JOIN (SELECT feria.id,COUNT(criterioferia.id) as total FROM criterioferia INNER JOIN feria on feria.id=criterioferia.idferia INNER JOIN tipocriterio on tipocriterio.id=criterioferia.idtipo INNER JOIN criterioevaluacion on criterioevaluacion.id= criterioferia.idcriterioevaluacion group by feria.id)x on x.id=feria.id where x.total>0 and feria.fechalimiteinscripcion>=curdate() and feria.fechafinal is null and if(feria.fechainicio is not null, if(feria.fechalimiteinscripcion<feria.fechainicio,true,false),true)";
                if ($filtro["valor"] == "Fecha") {
                    $sql1.= " order by feria.fechalimiteinscripcion ";
                }
                break;
            case "Finalizada":
                $sql1.= "feria.fechafinal as final from feria where feria.fechafinal is not null ";
                $sql2.=" where feria.fechafinal is not null";
                if ($filtro["valor"] == "Fecha") {
                    $sql1.= " order by feria.fechafinal ";
                }
                break;
        }
        if ($filtro["valor"] == "Nombre") {
            $sql1.= " order by feria.nombre ";
        }
        $pagina = (int) $filtro["pagina"];
        $num = $pagina * 6;
        $sql1.= $filtro["orden"] . " limit $num,6";        
        $sql = array(0 => $sql1, 1 => $sql2);
        return $sql;
    }

    private function retornarSqlFiltroParticipacionEstudiante($filtro) {
        $sql1 = "select distinct feria.id,feria.nombre,feria.resumen,";
        $sql2 = "select count(feria.id)as total from feria";
        $id = $filtro["idEstu"];
        switch ($filtro["estado"]) {
            case "Activa":
                $sql1.= "feria.fechalimiteinscripcion as limite from feria INNER JOIN proyecto on proyecto.idferia = feria.id INNER JOIN proyectoestudiante on proyectoestudiante.idproyecto=proyecto.id INNER JOIN estudiante on estudiante.id=proyectoestudiante.idestudiante INNER JOIN (SELECT feria.id,COUNT(criterioferia.id) as total FROM criterioferia INNER JOIN feria on feria.id=criterioferia.idferia INNER JOIN tipocriterio on tipocriterio.id=criterioferia.idtipo INNER JOIN criterioevaluacion on criterioevaluacion.id= criterioferia.idcriterioevaluacion GROUP BY feria.id)x on x.id=feria.id where x.total>0 and feria.fechalimiteinscripcion >=curdate() and feria.fechafinal is null and IF(feria.fechainicio is not null, IF(feria.fechalimiteinscripcion<=feria.fechainicio,true,false) ,true) and estudiante.id=$id ";
                $sql2.=" INNER JOIN proyecto on proyecto.idferia = feria.id INNER JOIN proyectoestudiante on proyectoestudiante.idproyecto=proyecto.id INNER JOIN estudiante on estudiante.id=proyectoestudiante.idestudiante INNER JOIN (SELECT feria.id,COUNT(criterioferia.id) as total FROM criterioferia INNER JOIN feria on feria.id=criterioferia.idferia INNER JOIN tipocriterio on tipocriterio.id=criterioferia.idtipo INNER JOIN criterioevaluacion on criterioevaluacion.id= criterioferia.idcriterioevaluacion )x on x.id=feria.id where x.total>0 and feria.fechalimiteinscripcion >=curdate() and feria.fechafinal is null and IF(feria.fechainicio is not null, IF(feria.fechalimiteinscripcion<=feria.fechainicio,true,false) ,true) and estudiante.id=$id";
                if ($filtro["valor"] == "Fecha") {
                    $sql1.= " order by feria.fechalimiteinscripcion ";
                }
                break;
            case "Finalizada":
                $sql1.= "feria.fechafinal as final from feria INNER JOIN proyecto on proyecto.idferia = feria.id INNER JOIN proyectoestudiante on proyectoestudiante.idproyecto=proyecto.id INNER JOIN estudiante on estudiante.id=proyectoestudiante.idestudiante where fechafinal is not null and estudiante.id=$id ";
                $sql2.= " INNER JOIN proyecto on proyecto.idferia = feria.id INNER JOIN proyectoestudiante on proyectoestudiante.idproyecto=proyecto.id INNER JOIN estudiante on estudiante.id=proyectoestudiante.idestudiante where fechafinal is not null and estudiante.id=$id ";
                if ($filtro["valor"] == "Fecha") {
                    $sql1.= " order by feria.fechafinal ";
                }
                break;
        }
        if ($filtro["valor"] == "Nombre") {
            $sql1.= " order by feria.nombre ";
        }
        $pagina = (int) $filtro["pagina"];
        $num = $pagina * 6;
        $sql1.= $filtro["orden"] . " limit $num,6";
        $sql[0] = $sql1;
        $sql[1] = $sql2;
        return $sql;
    }

    private function retornarSqlFiltroParticipacionEvaluador($filtro) {
        $sql1 = "select distinct feria.id,feria.nombre,feria.resumen,";
        $sql2 = "select count(feria.id)as total from feria";
        $id = $filtro["idEva"];
        switch ($filtro["estado"]) {
            case "Activa":
                $sql1.= " feria.fechalimiteinscripcion as limite from feria INNER JOIN evaluadorferia on evaluadorferia.idferia=feria.id INNER JOIN evaluador ON evaluadorferia.idevaluador=evaluador.id INNER JOIN (SELECT feria.id,COUNT(criterioferia.id) as total FROM criterioferia INNER JOIN feria on feria.id=criterioferia.idferia INNER JOIN tipocriterio on tipocriterio.id=criterioferia.idtipo INNER JOIN criterioevaluacion on criterioevaluacion.id= criterioferia.idcriterioevaluacion GROUP BY feria.id)x on x.id=feria.id where x.total>0 and feria.fechalimiteinscripcion >=curdate() and fechafinal is null and IF(fechainicio is not null, IF(fechalimiteinscripcion<=fechainicio,true,false) ,true) and evaluador.id=$id ";
                $sql2.=" INNER JOIN evaluadorferia on evaluadorferia.idferia=feria.id INNER JOIN evaluador ON evaluadorferia.idevaluador=evaluador.id INNER JOIN (SELECT feria.id,COUNT(criterioferia.id) as total FROM criterioferia INNER JOIN feria on feria.id=criterioferia.idferia INNER JOIN tipocriterio on tipocriterio.id=criterioferia.idtipo INNER JOIN criterioevaluacion on criterioevaluacion.id= criterioferia.idcriterioevaluacion)x on x.id=feria.id where x.total>0 and feria.fechalimiteinscripcion >=curdate() and fechafinal is null and IF(fechainicio is not null, IF(fechalimiteinscripcion<=fechainicio,true,false) ,true) and evaluador.id=$id  ";
                if ($filtro["valor"] == "Fecha") {
                    $sql1.= " order by fechalimiteinscripcion ";
                }
                break;
            case "Finalizada":
                $sql1.= " feria.fechafinal as final from feria INNER JOIN evaluadorferia on evaluadorferia.idferia=feria.id INNER JOIN evaluador ON evaluadorferia.idevaluador=evaluador.id where fechafinal is not null and evaluador.id=$id ";
                $sql2.= " INNER JOIN proyecto on proyecto.idferia = feria.id INNER JOIN evaluadorferia on evaluadorferia.idferia=feria.id INNER JOIN evaluador ON evaluadorferia.idevaluador=evaluador.id where fechafinal is not null and evaluador.id=$id ";
                if ($filtro["valor"] == "Fecha") {
                    $sql1.= " order by fechafinal ";
                }
                break;
        }
        if ($filtro["valor"] == "Nombre") {
            $sql1.= " order by nombre ";
        }
        $pagina = (int) $filtro["pagina"];
        $num = $pagina * 6;
        $sql1.= $filtro["orden"] . " limit $num,6";
        $sql[0] = $sql1;
        $sql[1] = $sql2;
        return $sql;
    }

}
