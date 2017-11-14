<?php

class Negocio {

    public function generarPlantilla() {
        include 'Vista/Plantilla.php';
    }

    private function validarPalabraNavbar($palabra) {
        $exito = false;
        $palabras = array("Inicio", "Registro", "Significado", "Importancia", "Objetivos", "Ingresar", "Salir", "Perfil");
        if (in_array($palabra, $palabras)) {
            $exito = true;
        }
        return $exito;
    }

    private function validarPalabraRedireccion($palabra) {
        $exito = false;
        $palabras = array("Validar", "RegistrarProyecto", "Feria", "MisProyectos", "Proyecto", "ValidarUnion", "IngresarCalificacion");
        if (in_array($palabra, $palabras)) {
            $exito = true;
        }
        return $exito;
    }

    public function generarEnlace($enlace) {
        if ($this->validarPalabraNavbar($enlace)) {
            return "Vista/Modulos/BarraNavegacion/" . $enlace . ".php";
        } else if ($this->validarPalabraRedireccion($enlace)) {
            return "Vista/Modulos/" . $enlace . ".php";
        } else {
            echo "<script>location.href= 'Inicio' </script>";
            return "Vista/Modulos/BarraNavegacion/Inicio.php";
        }
    }

    public function registrarEstudianteNegocio($estudianteDTO) {
        $codigoProgama = TipoProgramaDAO::obtenerCodigoPrograma($estudianteDTO->getCodigoPrograma());
        $registroExitoso = false;
        if ($codigoProgama) {
            $estudianteDTO->setCodigoPrograma($codigoProgama);
            $registroExitoso = EstudianteDAO::registrarEstudiante($estudianteDTO);
            if ($registroExitoso) {
                $mailer = new Mail();
                $mailer->enviarMailValidarRegistro($estudianteDTO->getCorreo(), $estudianteDTO->getValidarRegistro());
            }
        }

        return $registroExitoso;
    }

    public function validarRegistroEstudianteNegocio($llaveValidacion) {
        $exito = EstudianteDAO::validarRegistro($llaveValidacion, $_SESSION["perfil"]["correo"]);
        if ($exito) {
            $datos = $_SESSION["perfil"];
            $datos["key"] = false;
            $_SESSION["perfil"] = $datos;
        }
        return $exito;
    }

    public function listarProgramasAcademicosNegocio() {
        return TipoProgramaDAO::listarProgramasAcademicos();
    }

    public function ingresarEstudianteNegocio($estudianteDTO) {
        $estudiante = EstudianteDAO::IngresarEstudiante($estudianteDTO);
        $exito = false;
        if ($estudiante) {
            $this->guardarDatosPerfilEstudiante($estudiante);
            $exito = true;
        }
        return $exito;
    }

    private function guardarDatosPerfilEstudiante($estudiante) {
        $key;
        if (isset($estudiante["validarregistro"])) {
            $key = true;
        } else {
            $key = false;
        }
        $datos = array("nombre" => $estudiante["nombre"],
            "codigo" => $estudiante["codigoprograma"] . $estudiante["codigo"],
            "tipo" => "Estudiante",
            "correo" => $estudiante["correo"],
            "documento" => $estudiante["documento"],
            "key" => $key,
            "id" => (int) $estudiante["id"]);
        $_SESSION["perfil"] = $datos;
    }

    public function listarDatosPerfilNegocio() {
        $perfil = $_SESSION["perfil"];

        unset($perfil["id"]);
        if ($perfil["tipo"] == "Estudiante") {
            $key = $perfil["key"];
            unset($perfil["key"]);
            if ($key) {
                $perfil["estado"] = "No validado";
            } else {
                $perfil["estado"] = "Validado";
            }
        }

        return $perfil;
    }

    public function listarDocentesNegocio() {
        return DocenteDAO::listarDocentes();
    }

    public function listarAsignaturasNegocio() {
        $codigo = $_SESSION["perfil"]["codigo"];
        return AsignaturaDAO::listarAsignaturas(substr($codigo, 0, 3));
    }

    public function listarLineasInvestigacionNegocio() {
        return LineaDAO::listarLineasInvestigacion();
    }

    public function guardarTutoriaNegocio($tutoriaDTO) {
        $asignatura = AsignaturaDAO::listarAsignaturaCodigo($tutoriaDTO);
        $docente = DocenteDAO::listarDocenteCodigo($tutoriaDTO);

        $exito = false;
        $tuto = $this->validarExistenciaTutoria($tutoriaDTO);
        if ($tuto == -1) {
            if ($asignatura && $docente && !isset($_SESSION["tutorias"])) {
                $tutorias = [];
                $tutorias[] = array("docente" => $docente, "asignatura" => $asignatura);

                $_SESSION["tutorias"] = $tutorias;
                $exito = true;
            } else if ($asignatura && $docente) {
                $tutorias = $_SESSION["tutorias"];
                $tutorias[] = array("docente" => $docente, "asignatura" => $asignatura);
                $_SESSION["tutorias"] = $tutorias;
                $exito = true;
            }
        } else {
            throw new Exception("Ya tienes esta tutoria seleccionada.");
        }


        return $exito;
    }

    public function listarTutoriasNegocio() {
        if (isset($_SESSION["tutorias"])) {
            return $_SESSION["tutorias"];
        }
    }

    private function validarExistenciaTutoria($tutoriaDTO) {
        $tuto = -1;
        if (isset($_SESSION["tutorias"])) {
            $tutorias = $_SESSION["tutorias"];
            for ($i = 0; $i < count($tutorias); $i++) {
                $tutoria = $tutorias[$i];
                $docente = $tutoria["docente"];
                $asignatura = $tutoria["asignatura"];
                if ($docente["codigo"] == $tutoriaDTO->getCodigoDocente() &&
                        $docente["codigoprograma"] == $tutoriaDTO->getCodigoProgramaDocente() &&
                        $asignatura["codigo"] == $tutoriaDTO->getCodigoAsignatura() &&
                        $asignatura["codigoprograma"] == $tutoriaDTO->getCodigoProgramaAsignatura()) {
                    $tuto = $i;
                    break;
                }
            }
        }
        return $tuto;
    }

    public function validarFeriaNegocio($id) {
        $exito = FeriaDAO::buscarFeriaId((int) $id);
        if ($exito) {
            $_SESSION["idFeria"] = $id;
        }
        return $exito;
    }

    public function registrarProyectoNegocio($proyectoDTO) {
        $idLinea = LineaDAO::validarLineaNombre($proyectoDTO->getIdLinea());
        $idEstado = EstadoProyectoDAO::buscarIdEstado();
        $exito = false;
        if ($idEstado && $idLinea) {
            if (!isset($_SESSION["tutorias"])) {
                throw new Exception("No has seleccionado por lo menos una tutoria");
            }
            $proyectoDTO->setIdLinea($idLinea["id"]);
            $datos = $_SESSION["perfil"];
            $proyectoDTO->setIdLider($datos["id"]);
            $proyectoDTO->setIdFeria($_SESSION["idFeria"]);
            $proyectoDTO->setIdEstado($idEstado);
            $tutorias = $_SESSION["tutorias"];

            $exito = proyectoDAO::registrarProyecto($proyectoDTO, $tutorias);
            if ($exito) {
                unset($_SESSION["tutorias"]);
            }
        }
        return $exito;
    }

    function enviarCorreoValidacionNegocio() {
        $exito = false;
        if (isset($_SESSION["perfil"]) && $_SESSION["perfil"]["tipo"] == "Estudiante") {
            $datos = $_SESSION["perfil"];
            if ($datos["key"]) {
                $estudianteDTO = new EstudianteDTO(NULL, $datos["correo"], null, NULL, null, NULL, md5(time()), $datos["id"]);
                $modificacion = EstudianteDAO::modificarKeyValidacion($estudianteDTO);
                if ($modificacion) {
                    $mailer = new Mail();
                    $exito = $mailer->enviarMailValidarRegistro($estudianteDTO->getCorreo(), $estudianteDTO->getValidarRegistro());
                }
            }
        }

        return $exito;
    }

    public function listarProyectoIdNegocio() {
        $proyecto = false;
        if (isset($_SESSION["idProyecto"])) {
            $proyecto = proyectoDAO::listarProyectoId($_SESSION["idProyecto"]);
            if ($proyecto) {
                $proyecto["lider"] = false;
                $proyecto["tipo"] = "comun";
                if (isset($_SESSION["perfil"])) {
                    $datos = $_SESSION["perfil"];
                    $proyecto["tipo"] = $datos["tipo"];
                    if (proyectoDAO::validarLiderProyecto($datos["id"], $_SESSION["idProyecto"])) {
                        $proyecto["lider"] = true;
                    }
                }
            }
        }

        return $proyecto;
    }

    public function listarMisProyectosNegocio() {
        $proyecto = false;
        if (isset($_SESSION["perfil"])) {
            $datos = $_SESSION["perfil"];
            switch ($datos["tipo"]) {
                case "Estudiante":
                    $proyecto = proyectoDAO::listarMisProyectos($datos["id"]);
                    $proyecto[count($proyecto)]["tipo"] = "Estudiante";

                    break;
                case "Evaluador":
                    $proyecto = proyectoDAO::listarMisProyectosEvaluador($datos["id"]);
                    $proyecto[count($proyecto)]["tipo"] = "Evaluador";
                    break;
            }
        }
        return $proyecto;
    }

    public function mostrarFeriaIdNegocio() {
        $feria = false;
        if (isset($_SESSION["idFeria"])) {
            $feria = FeriaDAO::mostrarFeriaId((int) $_SESSION["idFeria"]);
        }
        return $feria;
    }

    public function invitarCompanieroNegocio($correo) {
        $correoEnviado = false;
        if (isset($_SESSION["perfil"]) && $_SESSION["perfil"]["tipo"] == "Estudiante") {
            $datos = $_SESSION["perfil"];
            $key = proyectoDAO::validarKeyLider($_SESSION["idProyecto"], $datos["id"]);
            $llave;
            $exito = false;
            $pase = false;
            if ($key) {
                if (isset($key["llave"])) {
                    $llave = $key["llave"];
                    $pase = true;
                } else {
                    $llave = md5(time());
                    $pase = proyectoDAO::ingresarKeyValidacion($llave, $_SESSION["idProyecto"]);
                }
                if ($pase) {
                    $mailer = new Mail();
                    $exito = $mailer->enviarMailInvitarProyecto($correo, $llave, $key["titulo"], $_SESSION["idProyecto"]);
                }
            }
        }

        return $exito;
    }

    public function validarUnionProyectoNegocio($key, $proyectoEstudianteDTO) {
        $exito = false;
        $datos = $_SESSION["perfil"];
        $proyectoEstudianteDTO->setIdEstudiante($datos["id"]);
        $keyActiva = proyectoDAO::validarKey($proyectoEstudianteDTO->getIdProyecto(), $key);
        if ($keyActiva) {
            $proyectoEstudiante = proyectoEstudianteDAO::listarProyectoEstudiante($proyectoEstudianteDTO);
            if (!$proyectoEstudiante) {
                $exito = proyectoEstudianteDAO::registrarUnion($proyectoEstudianteDTO);
            }
        }
        return $exito;
    }

    public function ingresarEvaluadorNegocio($evaluadorDTO) {
        $evaluador = EvaluadorDAO::ingresarEvaluador($evaluadorDTO);
        $exito = false;
        if ($evaluador) {
            $this->guardarDatosPerfilEvaluador($evaluador);
            $exito = true;
        }
        return $exito;
    }

    private function guardarDatosPerfilEvaluador($evaluador) {
        $evaluador["tipo"] = "Evaluador";
        $datos = array("nombre" => $evaluador["nombre"],
            "tipo" => "Evaluador",
            "correo" => $evaluador["correo"],
            "documento" => $evaluador["documento"],
            "id" => (int) $evaluador["id"]);
        $_SESSION["perfil"] = $datos;
    }

    public function listarFeriaFiltroNegocio($filtro) {
        $feriaDAO = new FeriaDAO();
        $ferias = false;
        session_start();
        if ($filtro["participo"] == "true" && isset($_SESSION["perfil"])) {
            if ($_SESSION["perfil"]["tipo"] == "Estudiante") {
                $filtro["idEstu"] = $_SESSION["perfil"]["id"];
                $ferias = $feriaDAO->listarFeriasParticipacionEstudiante($filtro);
                $ferias[count($ferias) - 1]["tipo"] = "Estudiante";
            } else if ($_SESSION["perfil"]["tipo"] == "Evaluador") {
                $filtro["idEva"] = $_SESSION["perfil"]["id"];
                $ferias = $feriaDAO->listarFeriasParticipacionEvaluador($filtro);
                $ferias[count($ferias) - 1]["tipo"] = "Evaluador";
            }
        } else {
            $ferias = $feriaDAO->listarFerias($filtro);
            $ferias[count($ferias) - 1]["tipo"] = isset($_SESSION["perfil"]["tipo"]) ? $_SESSION["perfil"]["tipo"] : "Otros";
        }
        return $ferias;
    }

    public function mostrarCriteriosEvaluarNegocio() {
        $criterios = false;
        if (isset($_SESSION["calificar"])) {
            $idProyecto = $_SESSION["calificar"]["idProyecto"];
            if (isset($_SESSION["calificacion" . $idProyecto])) {
                $validarProyectoEvaluador = $this->validarProyectoEvaluadorNegocio();
                if ($validarProyectoEvaluador) {
                    $criterios = $_SESSION["calificacion" . $idProyecto];
                }
            } else {
                $idProyecto = $_SESSION["calificar"]["idProyecto"];
                $validarProyectoEvaluador = $this->validarProyectoEvaluadorNegocio();
                if ($validarProyectoEvaluador) {
                    $criterios = CriterioFeriaDAO::listarCriterios($_SESSION["calificar"]["idFeria"]);
                    if ($criterios) {
                        $tipoCriterio = $criterios["tipoCriterio"];
                        $descripcionCriterios = $criterios["criterio"];
                        for ($i = 0; $i < count($descripcionCriterios); $i++) {
                            $descripcionCriterios[$i]["calificacion"] = array("nota" => null, "observacion" => NULL);
                            $t = count($descripcionCriterios[$i]);
                            for ($j = 0; $j < $t; $j++) {
                                if (isset($descripcionCriterios[$i][$j])) {
                                    unset($descripcionCriterios[$i][$j]);
                                }
                                if (isset($tipoCriterio[$i][$j])) {
                                    unset($tipoCriterio[$i][$j]);
                                }
                                if (isset($validarProyectoEvaluador[$i])) {
                                    unset($validarProyectoEvaluador[$i]);
                                }
                            }
                        }
                        $criterios = [];
                        $criterios["infoProyecto"] = $validarProyectoEvaluador;
                        $criterios["criterios"] = $descripcionCriterios;
                        $criterios["tipo"] = $tipoCriterio;
                        $_SESSION["calificacion" . $idProyecto] = $criterios;
                    }
                }
            }
            return $criterios;
        }
    }

    public function validarProyectoEvaluadorNegocio() {
        return proyectoDAO::validarProyectoEvaluador($_SESSION["calificar"]["idProyecto"], (int) $_SESSION["perfil"]["id"], $_SESSION["calificar"]["idFeria"]);
    }

   

   

    private function validarRegistroCalificacion($calificaciones) {
        $calificacionesDTO=[];
        $crite = $_SESSION["calificacion" . $_SESSION["calificar"]["idProyecto"]]["criterios"];
        
        $exito = true;
        for ($i = 0; $i < count($crite); $i++) {
            $criterio = $crite[$i];
            $id= $criterio["id"];
            if ( !isset($calificaciones[$id],$calificaciones[$id]["max"],$calificaciones[$id]["nota"])||  !array_key_exists("observacion", $calificaciones[$id]) ||$calificaciones[$id] == null|| !is_numeric($calificaciones[$id]["max"])||((int)$criterio["valor"])!=((int)$calificaciones[$id]["max"]) ||  !is_numeric($calificaciones[$id]["nota"]) || ((int)$calificaciones[$id]["max"])<0 || ((int)$calificaciones[$id]["max"])>((int)$criterio["valor"])) {
                $exito = false;
                break;
            } else {
                $calificacionesDTO[$i] = new CalificacionDTO(null, $_SESSION["perfil"]["id"], (int)$calificaciones[$id]["nota"], (int)$id, $calificaciones[$id]["observacion"]=="" ? NULL:$calificaciones[$id]["observacion"]);
                
            }
        }
        return array("exito" => $exito, "calificacionesDTO" => $calificacionesDTO);
    }

    

    public function registrarCalificacionNegocio($calificaciones) {        
        $exito = false;
        if (isset($_SESSION["perfil"], $_SESSION["calificar"], $_SESSION["calificacion" . $_SESSION["calificar"]["idProyecto"]])) {
            $calificacionesDTO=$this->validarRegistroCalificacion($calificaciones);
           
            if ($calificacionesDTO["exito"]) {
                 $exito=  CalificacionDAO::registrarCalificacion($calificacionesDTO["calificacionesDTO"]);
                 unset($_SESSION["calificacion" . $_SESSION["calificar"]["idProyecto"]]);
                 unset($_SESSION["calificar"]);
            }
           
        }
        return $exito;
    }

}
