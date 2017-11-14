<?php

class proyectoDAO {

    public function registrarProyecto($proyectoDTO, $tutorias) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->beginTransaction();
            $stm = $conexion->prepare("insert into proyecto(idferia,idlinea,idestado,titulo,resumen,idlider) values(?,?,?,?,?,?)");
            $stm->bindParam(1, $proyectoDTO->getIdFeria(), PDO::PARAM_INT);
            $stm->bindParam(2, $proyectoDTO->getIdLinea(), PDO::PARAM_INT);
            $stm->bindParam(3, $proyectoDTO->getIdEstado(), PDO::PARAM_INT);
            $stm->bindParam(4, $proyectoDTO->getTitulo(), PDO::PARAM_STR);
            $stm->bindParam(5, $proyectoDTO->getResumen(), PDO::PARAM_STR);
            $stm->bindParam(6, $proyectoDTO->getIdLider(), PDO::PARAM_INT);
            $stm->execute();
            $idProyecto = $conexion->lastInsertId("proyecto");

            for ($i = 0; $i < count($tutorias); $i++) {
                $tutoria = $tutorias[$i];
                $docente = $tutoria["docente"];
                $asignatura = $tutoria["asignatura"];
                $idTutoria;
                $stm = $conexion->prepare("select id from tutoria where codigodocente=? and codigoprogramadocente=? and codigoasignatura=? and codigoprogramaasignatura=?");
                $stm->bindParam(1, $docente["codigo"], PDO::PARAM_STR);
                $stm->bindParam(2, $docente["codigoprograma"], PDO::PARAM_STR);
                $stm->bindParam(3, $asignatura["codigo"], PDO::PARAM_STR);
                $stm->bindParam(4, $asignatura["codigoprograma"], PDO::PARAM_STR);
                $ok = $stm->execute();
                if ($ok && $stm->rowCount() > 0) {
                    $tuto = $stm->fetch();
                    $idTutoria = $tuto["id"];
                } else {
                    $stm = $conexion->prepare("insert into tutoria(codigodocente,codigoprogramadocente,codigoasignatura,codigoprogramaasignatura)"
                            . "values(?,?,?,?)");
                    $stm->bindParam(1, $docente["codigo"], PDO::PARAM_STR);
                    $stm->bindParam(2, $docente["codigoprograma"], PDO::PARAM_STR);
                    $stm->bindParam(3, $asignatura["codigo"], PDO::PARAM_STR);
                    $stm->bindParam(4, $asignatura["codigoprograma"], PDO::PARAM_STR);
                    $stm->execute();
                    $idTutoria = $conexion->lastInsertId("tutoria");
                }
                $stm = $conexion->prepare("insert into proyectotutoria (idproyecto,idtutoria) values(?,?)");
                $stm->bindParam(1, $idProyecto, PDO::PARAM_INT);
                $stm->bindParam(2, $idTutoria, PDO::PARAM_INT);
                $stm->execute();
            }
            $stm = $conexion->prepare("insert into proyectoestudiante (idproyecto,idestudiante) values(?,?)");
            $stm->bindParam(1, $idProyecto, PDO::PARAM_INT);
            $stm->bindParam(2, $proyectoDTO->getIdLider(), PDO::PARAM_INT);
            $stm->execute();
            $conexion->commit();
            $exito = true;
        } catch (Exception $ex) {
            $conexion->rollBack();
            throw new Exception($ex->getMessage());
        }
        return $exito;
    }

    function listarProyectoId($id) {
        $conexion = Conexion::crearConexion();
        $datosGenerales = false;
        $tutorias = false;
        $integrantes = false;
        $proyecto = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.titulo as titulo,proyecto.resumen,linea.nombre as lineainvestigacion,estadoproyecto.nombre as estado FROM proyecto INNER JOIN linea on proyecto.idlinea=linea.id INNER JOIN estadoproyecto on estadoproyecto.id=proyecto.idestado WHERE proyecto.id=?");
            $stm->bindParam(1, $id, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $datosGenerales = $stm->fetchAll();
                $ok = false;
                $stm = false;
                $stm = $conexion->prepare("select docente.codigoprograma as codigoprogramadocente,docente.codigo as codigodocente,p.nombre as programadocente,docente.nombre as nombredocente,asignatura.codigoprograma as codigoprogramaasignatura,asignatura.codigo as codigoasignatura,programa.nombre as programaasignatura,asignatura.nombre as nombreasignatura FROM proyecto INNER JOIN proyectotutoria ON proyecto.id=proyectotutoria.idproyecto INNER JOIN tutoria on tutoria.id=proyectotutoria.idtutoria INNER JOIN docente on docente.codigo=tutoria.codigodocente and docente.codigoprograma=tutoria.codigoprogramadocente INNER JOIN asignatura on asignatura.codigo=tutoria.codigoasignatura and tutoria.codigoprogramaasignatura=asignatura.codigoprograma INNER JOIN programa on programa.codigo=asignatura.codigoprograma INNER JOIN programa p on p.codigo=docente.codigoprograma where proyecto.id=?");
                $stm->bindParam(1, $id, PDO::PARAM_INT);
                $ok = $stm->execute();
                if ($ok && $stm->rowCount() > 0) {
                    $tutorias = $stm->fetchAll();
                    $ok = false;
                    $stm = false;
                    $stm = $conexion->prepare("select estudiante.id as idestudiante,estudiante.nombre as nombreestudiante,estudiante.codigo as codigoestudiante,estudiante.codigoprograma as codigoprogramaestudiante,programa.nombre as programaestudiante,if(estudiante.id=proyecto.idlider,true,false)as lider from proyecto INNER JOIN proyectoestudiante on proyecto.id= proyectoestudiante.idproyecto INNER JOIN estudiante on estudiante.id=proyectoestudiante.idestudiante INNER JOIN programa on programa.codigo=estudiante.codigoprograma where proyecto.id=? ORDER BY lider DESC");
                    $stm->bindParam(1, $id, PDO::PARAM_INT);
                    $ok = $stm->execute();
                    if ($ok && $stm->rowCount() > 0) {
                        $integrantes = $stm->fetchAll();
                    }
                }
            }

            if ($datosGenerales && $tutorias && $integrantes) {
                $proyecto = [];
                $proyecto["datosGenerales"] = $datosGenerales;
                $proyecto["tutorias"] = $tutorias;
                $proyecto["integrantes"] = $integrantes;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            echo $ex->getTraceAsString();
        }
        return $proyecto;
    }

    public function validarLiderProyecto($idLider, $idProyecto) {
        $conexion = Conexion::crearConexion();
        $existe = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.id,estudiante.id from proyecto INNER JOIN estudiante ON estudiante.id=proyecto.idlider where estudiante.id=? and proyecto.id=?");
            $stm->bindParam(1, $idLider, PDO::PARAM_INT);
            $stm->bindParam(2, $idProyecto, PDO::PARAM_INT);
            $ok = $stm->execute();
            $existe = $ok && $stm->rowCount() > 0;
        } catch (Exception $ex) {
            
        }
        return $existe;
    }

    public function listarMisProyectos($idEstudiante) {
        $conexion = Conexion::crearConexion();
        $proyectos = FALSE;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.id,proyecto.titulo,linea.nombre as lineainvestigacion,estadoproyecto.nombre as estadoproyecto, feria.id as idferia,feria.nombre as nombreferia,feria.fechafinal,IF(proyecto.idlider=estudiante.id,true,false) as lider from proyecto INNER JOIN linea ON linea.id=proyecto.idlinea INNER JOIN estadoproyecto on estadoproyecto.id=proyecto.idestado INNER JOIN feria ON feria.id=proyecto.idferia INNER JOIN proyectoestudiante on proyectoestudiante.idproyecto=proyecto.id INNER JOIN estudiante on estudiante.id= proyectoestudiante.idestudiante where estudiante.id=?");
            $stm->bindParam(1, $idEstudiante, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $proyectos = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $proyectos;
    }

    public function listarMisProyectosEvaluador($idEvaluador) {
        $conexion = Conexion::crearConexion();
        $proyectos = FALSE;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.id,proyecto.titulo,feria.id as idferia,feria.nombre as tituloferia,
IF(feria.fechainicio is null ,false,IF(feria.fechainicio=curdate() and feria.fechafinal is null and ifnull(x.aux,0)=0,true,false)) as calificar,ifnull(feria.fechafinal,false) as ffinal ,ifnull(feria.fechainicio,false) as fcalificar from proyecto INNER JOIN evaluadorproyecto on evaluadorproyecto.idproyecto=proyecto.id INNER JOIN evaluadorferia on evaluadorproyecto.idevaluadorferia=evaluadorferia.id INNER JOIN evaluador on evaluadorferia.idevaluador= evaluador.id INNER JOIN feria on feria.id=proyecto.idferia left join (select proyecto.id as id, count(calificacion.nota) as aux from proyecto INNER JOIN evaluadorproyecto on evaluadorproyecto.idproyecto=proyecto.id INNER JOIN evaluadorferia on evaluadorferia.id=evaluadorproyecto.idevaluadorferia INNER JOIN evaluador on evaluador.id=evaluadorferia.idevaluador INNER JOIN calificacion on calificacion.idevaluador= evaluadorproyecto.id INNER JOIN feria on feria.id= evaluadorferia.idferia and feria.id=proyecto.idferia GROUP by proyecto.id)x on x.id=proyecto.id WHERE evaluador.id=?");
            $stm->bindParam(1, $idEvaluador, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $proyectos = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $proyectos;
    }

    public function validarKeyLider($id, $idLider) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.validarunion as llave,proyecto.titulo from proyecto INNER JOIN estudiante on estudiante.id=proyecto.idlider where proyecto.id=? and proyecto.idlider=?");
            $stm->bindParam(1, $id, PDO::PARAM_INT);
            $stm->bindParam(2, $idLider, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $exito = $stm->fetch();
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    public function ingresarKeyValidacion($key, $idProyecto) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("update proyecto set validarunion=? where id=?");
            $stm->bindParam(1, $key, PDO::PARAM_STR);
            $stm->bindParam(2, $idProyecto, PDO::PARAM_INT);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $exito;
    }

    public function validarKey($id, $key) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.validarunion as llave from proyecto where proyecto.id=? and proyecto.validarunion=?");
            $stm->bindParam(1, $id, PDO::PARAM_INT);
            $stm->bindParam(2, $key, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $exito = $stm->fetch();
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    public function validarProyectoEvaluador($idProyecto, $idEvaluador, $idFeria) {
        $conexion = Conexion::crearConexion();
        $proyecto = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select  proyecto.titulo, feria.nombre as tituloFeria,count(calificacion.nota) as califica from proyecto

INNER JOIN evaluadorproyecto on evaluadorproyecto.idproyecto=proyecto.id

INNER JOIN evaluadorferia on evaluadorferia.id=evaluadorproyecto.idevaluadorferia

INNER JOIN evaluador on evaluador.id=evaluadorferia.idevaluador

INNER JOIN calificacion on calificacion.idevaluador= evaluadorproyecto.id

INNER JOIN feria on feria.id= evaluadorferia.idferia and feria.id=proyecto.idferia where evaluador.id=? and feria.id=? and proyecto.id=? HAVING califica=0");
            $stm->bindParam(1, $idEvaluador, PDO::PARAM_INT);
            $stm->bindParam(2, $idFeria, PDO::PARAM_INT);
            $stm->bindParam(3, $idProyecto, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $proyecto= $stm->fetch();
            }
        } catch (Exception $ex) {
            echo $ex;
        }
        return $proyecto;
    }

    
    
}
