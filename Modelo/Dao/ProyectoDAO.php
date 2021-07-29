<?php

class proyectoDAO {

    private $conexion;

    public function __construct() {
        $conn = new Conexion();
        $this->conexion = $conn->crearConexion();
    }

    public function registrarProyecto($proyectoDTO, $tutorias) {
        $conexion = $this->conexion;
        $exito = false;
        $idFeria = $proyectoDTO->getIdFeria();
        $idLinea = $proyectoDTO->getIdLinea();
        $idEstado = $proyectoDTO->getIdEstado();
        $titulo = $proyectoDTO->getTitulo();
        $resumen = $proyectoDTO->getResumen();
        $idLider = $proyectoDTO->getIdLider();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->beginTransaction();
            $stm = $conexion->prepare("insert into proyecto(idferia,idlinea,idestado,titulo,resumen,idlider) values(?,?,?,?,?,?)");
            $stm->bindParam(1, $idFeria, PDO::PARAM_INT);
            $stm->bindParam(2, $idLinea, PDO::PARAM_INT);
            $stm->bindParam(3, $idEstado, PDO::PARAM_INT);
            $stm->bindParam(4, $titulo, PDO::PARAM_STR);
            $stm->bindParam(5, $resumen, PDO::PARAM_STR);
            $stm->bindParam(6, $idLider, PDO::PARAM_INT);
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
            $stm->bindParam(2, $idLider, PDO::PARAM_INT);
            $stm->execute();
            $conexion->commit();
            $exito = true;
        } catch (Exception $ex) {
            $conexion->rollBack();
            if (strpos($ex->getMessage(), "uniqueproyecto")) {
                throw new Exception("Ya existe un proyecto registrado con el titulo que ingresaste en esta feria. Por favor ingresa un titulo diferente.");
            }
        }
        return $exito;
    }

    function listarProyectoId($id) {
        $conexion = $this->conexion;
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
        $conexion = $this->conexion;
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select if(feria.fechalimiteinscripcion>=curdate(),true,false)as eslider from proyecto INNER JOIN estudiante ON estudiante.id=proyecto.idlider INNER JOIN feria on feria.id=proyecto.idferia where estudiante.id=? and proyecto.id=?");
            $stm->bindParam(1, $idLider, PDO::PARAM_INT);
            $stm->bindParam(2, $idProyecto, PDO::PARAM_INT);
            $ok = $stm->execute();
            $existe = $ok && $stm->rowCount() > 0;
            if ($existe) {
                $aux = $stm->fetch();
                $exito = $aux["eslider"] == 1;
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }

    public function validarLiderProyecto2($idLider, $idProyecto) {
        $conexion = $this->conexion;
        $existe = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.idlider from proyecto INNER JOIN estudiante ON estudiante.id=proyecto.idlider INNER JOIN feria on feria.id=proyecto.idferia where estudiante.id=? and proyecto.id=?");
            $stm->bindParam(1, $idLider, PDO::PARAM_INT);
            $stm->bindParam(2, $idProyecto, PDO::PARAM_INT);
            $ok = $stm->execute();
            $existe = $ok && $stm->rowCount() > 0;
        } catch (Exception $ex) {
            
        }
        return $existe;
    }

    public function listarMisProyectos($idEstudiante) {
        $conexion = $this->conexion;
        $proyectos = FALSE;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.id,proyecto.titulo,linea.nombre as lineainvestigacion,estadoproyecto.nombre as estadoproyecto,proyecto.horario, feria.id as idferia,feria.nombre as nombreferia,feria.fechafinal,IF(proyecto.idlider=estudiante.id,true,false) as lider from proyecto INNER JOIN linea ON linea.id=proyecto.idlinea INNER JOIN estadoproyecto on estadoproyecto.id=proyecto.idestado INNER JOIN feria ON feria.id=proyecto.idferia INNER JOIN proyectoestudiante on proyectoestudiante.idproyecto=proyecto.id INNER JOIN estudiante on estudiante.id= proyectoestudiante.idestudiante where estudiante.id=?");
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
        $conexion = $this->conexion;
        $proyectos = FALSE;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.id,proyecto.titulo,proyecto.horario,feria.id as idferia,feria.nombre as tituloferia,ifnull(feria.fechafinal,false) as ffinal ,ifnull(feria.fechainicio,false) as fcalificar,if(feria.fechafinal is null and feria.fechainicio=curdate(),if( x.calificacion is null,true,if(x.calificacion=0,true,false))  ,false) as calificar from proyecto INNER JOIN evaluadorproyecto on evaluadorproyecto.idproyecto=proyecto.id INNER JOIN evaluadorferia on evaluadorferia.id=evaluadorproyecto.idevaluadorferia INNER JOIN evaluador on evaluadorferia.idevaluador=evaluador.id INNER JOIN feria on evaluadorferia.idferia=feria.id and feria.id=proyecto.idferia left JOIN (select proyecto.id,evaluador.id as idevaluador,evaluadorproyecto.id as idevaluadorproyecto,sum(calificacion.nota) as calificacion from proyecto INNER JOIN evaluadorproyecto on evaluadorproyecto.idproyecto=proyecto.id INNER JOIN evaluadorferia on evaluadorferia.id=evaluadorproyecto.idevaluadorferia INNER JOIN evaluador on evaluadorferia.idevaluador=evaluador.id INNER JOIN calificacion on calificacion.idevaluador=evaluadorproyecto.id where evaluador.id=? GROUP by evaluadorproyecto.idevaluadorferia,evaluadorproyecto.idproyecto)x on x.id=proyecto.id and x.idevaluador=evaluador.id and x.idevaluadorproyecto=evaluadorproyecto.id where evaluador.id=?");
            $stm->bindParam(1, $idEvaluador, PDO::PARAM_INT);
            $stm->bindParam(2, $idEvaluador, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $proyectos = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $proyectos;
    }

    public function validarKeyLider($id, $idLider) {
        $conexion = $this->conexion;
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
        $conexion = $this->conexion;
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
        $conexion = $this->conexion;
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
        $conexion = $this->conexion;
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
                $proyecto = $stm->fetch();
            }
        } catch (Exception $ex) {
            
        }
        return $proyecto;
    }

    public function validarEvaluadorProyecto($idProyecto, $idEvaluador, $idFeria) {

        $conexion = $this->conexion;
        $proyecto = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.id,if(feria.fechafinal is null and feria.fechainicio=curdate(),if( x.calificacion is null,true,if(x.calificacion=0,true,false))  ,false) as calificar from proyecto INNER JOIN evaluadorproyecto on evaluadorproyecto.idproyecto=proyecto.id INNER JOIN evaluadorferia on evaluadorferia.id=evaluadorproyecto.idevaluadorferia INNER JOIN evaluador on evaluadorferia.idevaluador=evaluador.id INNER JOIN feria on evaluadorferia.idferia=feria.id and feria.id=proyecto.idferia left JOIN (select proyecto.id,evaluador.id as idevaluador,evaluadorproyecto.id as idevaluadorproyecto,sum(calificacion.nota) as calificacion from proyecto INNER JOIN evaluadorproyecto on evaluadorproyecto.idproyecto=proyecto.id INNER JOIN evaluadorferia on evaluadorferia.id=evaluadorproyecto.idevaluadorferia INNER JOIN evaluador on evaluadorferia.idevaluador=evaluador.id INNER JOIN calificacion on calificacion.idevaluador=evaluadorproyecto.id where evaluador.id=? GROUP by evaluadorproyecto.idevaluadorferia,evaluadorproyecto.idproyecto)x on x.id=proyecto.id and x.idevaluador=evaluador.id and x.idevaluadorproyecto=evaluadorproyecto.id where evaluador.id=? and feria.id=? and proyecto.id=? ");
            $stm->bindParam(1, $idEvaluador, PDO::PARAM_INT);
            $stm->bindParam(2, $idEvaluador, PDO::PARAM_INT);
            $stm->bindParam(3, $idFeria, PDO::PARAM_INT);
            $stm->bindParam(4, $idProyecto, PDO::PARAM_INT);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $proyecto = $stm->fetch();
            }
        } catch (Exception $ex) {
            
        }
        return $proyecto;
    }

    public function editarDato($nombreColumna, $dato, $idProyecto) {
        $conexion = $this->conexion;
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("update proyecto set proyecto." . $nombreColumna . "=? where proyecto.id=?");
            $au = $nombreColumna == "idlinea" ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stm->bindParam(1, $dato, $au);
            $stm->bindParam(2, $idProyecto, PDO::PARAM_STR);
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $exito = true;
            }
        } catch (Exception $ex) {
            if (strpos($ex->getMessage(), "uniqueproyecto")) {
                throw new Exception("Ya existe un proyecto registrado con el titulo que ingresaste en esta feria. Por favor ingresa un titulo diferente.");
            }
        }
        return $exito;
    }

    public function listarProyectosFinal() {
        $conexion = $this->conexion;
        $proyectos = FALSE;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select proyecto.id, proyecto.titulo, 
calificacion.calificacion / jurados.evaluadores as total, jurados.evaluadores,
estus.integrantes, estus.numintegrantes

from proyecto inner join
(SELECT 
  `proyecto`.`id`,
  `proyecto`.`titulo`,
  group_concat(`estudiante`.`nombre`) AS integrantes,
  count(`estudiante`.`nombre`) AS numintegrantes
FROM
  `proyecto`
  INNER JOIN `proyectoestudiante` ON (`proyecto`.`id` = `proyectoestudiante`.`idproyecto`)
  INNER JOIN `estudiante` ON (`proyectoestudiante`.`idestudiante` = `estudiante`.`id`)
GROUP BY
  `proyecto`.`id`,
  `proyecto`.`titulo`) estus on estus.id = proyecto.id
inner join
(SELECT 
proyecto.id,  
`proyecto`.`titulo`,
  SUM(`calificacion`.`nota`) calificacion
FROM
  `proyecto`
  INNER JOIN `evaluadorproyecto` ON (`proyecto`.`id` = `evaluadorproyecto`.`idproyecto`)
  INNER JOIN `calificacion` ON (`evaluadorproyecto`.`id` = `calificacion`.`idevaluador`)
GROUP BY
  `proyecto`.`titulo`,
proyecto.id) calificacion on calificacion.id = proyecto.id

inner join 
(SELECT 
  `proyecto`.id,
  `proyecto`.`titulo`,
  count(distinct `calificacion`.`idevaluador`) AS evaluadores
FROM
  `proyecto`
  INNER JOIN `evaluadorproyecto` ON (`proyecto`.`id` = `evaluadorproyecto`.`idproyecto`)
  INNER JOIN `calificacion` ON (`evaluadorproyecto`.`id` = `calificacion`.`idevaluador`)    
GROUP BY
  `proyecto`.`titulo`,
  `proyecto`.id) jurados on jurados.id = proyecto.id

order by 3 desc, 6 asc
");
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $proyectos = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $proyectos;
    }

    public function listarProyectosCantidadEvaluaciones() {
        $conexion = $this->conexion;
        $proyectos = FALSE;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT titulo, coalesce(ev.evaluado,0) as evaluado
FROM
  `proyecto`
  LEFT OUTER JOIN (SELECT count(distinct `calificacion`.`idevaluador`) AS `evaluado`,
  `evaluadorproyecto`.`idproyecto`
FROM
  `evaluadorproyecto`
  INNER JOIN `calificacion` ON (`evaluadorproyecto`.`id` = `calificacion`.`idevaluador`)
GROUP BY
  `evaluadorproyecto`.`idproyecto`) ev ON (`proyecto`.`id` = ev.`idproyecto`)");
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $proyectos = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $proyectos;
    }

    public function listarProyectoConsultaRene() {
        $conexion = $this->conexion;
        $proyectos = FALSE;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT 
  `linea`.`nombre`,
  UCASE(`proyecto`.`titulo`) as titulo,
  `evaluador`.`nombre` as nombreevaluador,
  GROUP_CONCAT(`estudiante`.`nombre`) as integrantes,num, horario
FROM
  `evaluador`
  INNER JOIN `evaluadorferia` ON (`evaluador`.`id` = `evaluadorferia`.`idevaluador`)
  INNER JOIN `evaluadorproyecto` ON (`evaluadorferia`.`id` = `evaluadorproyecto`.`idevaluadorferia`)
  INNER JOIN `proyecto` ON (`evaluadorproyecto`.`idproyecto` = `proyecto`.`id`)
  INNER JOIN `linea` ON (`proyecto`.`idlinea` = `linea`.`id`)
  INNER JOIN `proyectoestudiante` ON (`proyecto`.`id` = `proyectoestudiante`.`idproyecto`)
  INNER JOIN `estudiante` ON (`proyectoestudiante`.`idestudiante` = `estudiante`.`id`)

GROUP BY `linea`.`nombre`,
  UCASE(`proyecto`.`titulo`),
  `evaluador`.`nombre`,num, horario");
            $ok = $stm->execute();
            if ($ok && $stm->rowCount() > 0) {
                $proyectos = $stm->fetchAll();
            }
        } catch (Exception $ex) {
            
        }
        return $proyectos;
    }

    public function listarNotaFinalProyecto($idProyecto,$idEstudiante) {
        $conexion = $this->conexion;
        $nota=null;
        try {
            
           $stm= $conexion->prepare("select sumas.id,COALESCE(sumas.suma/evalu.evarealizada,0)as nota from  (select proyecto.id,proyecto.idferia,sum(COALESCE(calificacion.nota,0)) as suma from proyecto INNER JOIN evaluadorproyecto on proyecto.id=evaluadorproyecto.idproyecto left JOIN calificacion on calificacion.idevaluador=evaluadorproyecto.id GROUP by proyecto.id) sumas INNER JOIN (select a.id,sum(IF (a.idevaluador is not null,1,0)) as evarealizada from (select proyecto.id,calificacion.idevaluador from proyecto INNER JOIN evaluadorproyecto on evaluadorproyecto.idproyecto=proyecto.id left JOIN calificacion on calificacion.idevaluador=evaluadorproyecto.id GROUP BY proyecto.id ,calificacion.idevaluador) a GROUP by a.id) evalu on evalu.id=sumas.id INNER JOIN proyectoestudiante on sumas.id=proyectoestudiante.idproyecto INNER JOIN estudiante on estudiante.id=proyectoestudiante.idestudiante where sumas.id=? and estudiante.id=?")
           ;
           $stm->bindParam(1,$idProyecto, PDO::PARAM_INT);
           $stm->bindParam(2,$idEstudiante,PDO::PARAM_INT );
           $ok = $stm->execute();
           if ($ok and $stm->rowCount()>0) {
               $n=$stm->fetchAll();
               $nota=$n[0]["nota"];
           }
        } catch (Exception $ex) {
            
        }
        return $nota;
    }

}
