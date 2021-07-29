<?php

include_once '../../Modelo/Dto/EstudianteDTO.php';
require_once '../../Modelo/Dao/EstudianteDAO.php';
require_once '../../Controlador/Controlador.php';
require_once '../../Modelo/Negocio.php';
require_once '../../Modelo/Conexion.php';
require_once '../../Modelo/Mail/Mail.php';
require_once '../../Modelo/Dao/TipoProgramaDAO.php';
require_once '../../Modelo/Dao/DocenteDAO.php';
require_once '../../Modelo/Dto/DocenteDTO.php';
require_once '../../Modelo/Dao/AsignaturaDAO.php';
require_once '../../Modelo/Dao/LineaDAO.php';
require_once '../../Modelo/Dto/TutoriaDTO.php';
require_once '../../Modelo/Dto/ProyectoDTO.php';
require_once '../../Modelo/Dto/EvaluadorDTO.php';
require_once '../../Modelo/Dao/EvaluadorDAO.php';
require_once '../../Modelo/Dto/CalificacionDTO.php';
require_once '../../Modelo/Dao/CalificacionDAO.php';
require_once '../../Modelo/Dao/EstadoProyectoDAO.php';
require_once '../../Modelo/Dao/ProyectoDAO.php';
require_once '../../Modelo/Dao/FeriaDAO.php';
require_once '../../Modelo/Dao/CriterioFeriaDAO.php';

class Ajax {

    private $controlador;

    public function __construct() {
        $this->controlador = new Controlador();
    }

    public function registrarEstudianteAjax($nombre, $codigo, $correo, $documento, $contrasenia, $programaAcademico) {

        $controlador = $this->controlador;
        $validarRegistro = md5(time());
        $estudianteDTO = new EstudianteDTO($nombre, $correo, $codigo, $documento, $contrasenia, $programaAcademico, $validarRegistro, null);
        try {
            $exito = $controlador->registrarEstudianteControlador($estudianteDTO);
            if ($exito) {
                $respuesta = array("exito" => true);
                echo json_encode($respuesta);
            } else {
                echo json_encode(array("exito" => false, "error" => "No se pudo registrar un estudiante"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => $ex->getMessage()));
        }
    }

    public function listarProgramasAcademicosAjax() {
        $controlador = $this->controlador;
        $aux = "";
        try {
            $aux = json_encode($controlador->listarProgramasAcademicosControlador());
        } catch (Exception $ex) {
            echo json_encode(array("error" => "Error al llamar los programas academicos. Contanta con el soporte de la pagina."));
            return;
        }
        echo $aux;
    }

    public function ingresarUsuarioAjax($usuario, $contrasenia, $tipoUsuario) {        
        $exito = false;
        try {
            switch ($tipoUsuario) {
                case "estudiante":
                    $exito = $this->ingresarEstudianteAjax($usuario, $contrasenia);

                    break;
                case "evaluador":
                    $exito = $this->ingresarEvaluadorAjax($usuario, $contrasenia);
                    break;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            $respuesta = array("exito" => true);
            if (isset($_SESSION["validarUnion"])) {
                $respuesta["redireccionarUnion"] = array("id" => $_SESSION["validarUnion"]["id"], "key" => $_SESSION["validarUnion"]["key"]);
            }else if (isset ($_SESSION["validarRegistro"])) {
                $respuesta["redireccionarValidar"]= array("key"=>$_SESSION["validarRegistro"]);
            }
            echo json_encode($respuesta);
        } else {
            echo json_encode(array("exito" => false, "error" => "Usuario o contrasenia incorrecta"));
        }
    }

    private function ingresarEstudianteAjax($usuario, $contrasenia) {
        session_start();
        $controlador = $this->controlador;
        $codigoP = substr($usuario, 0, 3);
        $codigoE = substr($usuario, 3, 4);
        return $controlador->ingresarEstudianteControlador(new EstudianteDTO(null, null, $codigoE, null, $contrasenia, $codigoP, null, null, null));
    }

    private function ingresarEvaluadorAjax($usuario, $contrasenia) {
        session_start();
        $controlador = $this->controlador;
        return $controlador->ingresarEvaluadorControlador(new EvaluadorDTO(null, null, $contrasenia, $usuario, null, null));
    }

    public function listarDatosPerfilAjax() {
        session_start();
        try {
            $controlador = $this->controlador;
            if (isset($_SESSION["perfil"])) {
                echo json_encode($controlador->listarDatosPerfilControlador());
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => FALSE, "error" => "Error al listar los datos de perfil"));
        }
    }

    public function listarDocentesAjax() {
        session_start();
        try {
            $controlador = $this->controlador;
            if (isset($_SESSION["perfil"])) {
                echo json_encode($controlador->listarDocentesControlador());
            } else {
                echo json_encode(array("exito" => false, "error" => "Error al listar docentes"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "Error al listar docentes"));
        }
    }

    public function listarAsignaturasAjax() {
        session_start();
        try {
            $controlador = $this->controlador;
            if (isset($_SESSION["perfil"])) {
                echo json_encode($controlador->listarAsignaturasControlador());
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "Error al listar asignaturas"));
        }
    }

    public function listarLineasInvestigacionAjax() {
        try {
            $controlador = $this->controlador;

            $lineas = $controlador->listarLineasInvestigacionControlador();
            if ($lineas) {
                echo json_encode($lineas);
            } else {
                echo json_encode(array("error" => "No hay lineas de investigacion"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "Error al listar lineas de investigacion"));
        }
    }

    public function guardarTutoriaAjax($codigoDocente, $codigoAsignatura) {
        session_start();

        try {
            try {
                $controlador = $this->controlador;
                $codigoProgramaDocente = substr($codigoDocente, 0, 3);
                $codigoDocente = substr($codigoDocente, 3, 5);
                $codigoProgramaAsignatura = substr($codigoAsignatura, 0, 3);
                $codigoAsignatura = substr($codigoAsignatura, 3, 4);
                $tutoriaDTO = new TutoriaDTO($codigoDocente, $codigoAsignatura, $codigoProgramaDocente, $codigoProgramaAsignatura);
            } catch (Exception $ex) {
                throw new Exception("Error al guardar tutoria");
            }
            $exito = $controlador->guardarTutoriaControlador($tutoriaDTO);
            if ($exito) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false, "error" => "Seleccione una asignatura o un docente correctos"));
            }
        } catch (Exception $e) {
            echo json_encode(array("exito" => false, "error" => $e->getMessage()));
        }
    }

    public function listarTutoriasAjax() {
        session_start();
        try {
            if (isset($_SESSION["perfil"])) {
                $controlador = $this->controlador;
                $tutorias = $controlador->listarTutoriasControlador();
                echo json_encode($tutorias);
            } else {
                echo json_encode(array("exito" => false, "error" => "error al listar tutorias seleccionadas"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "error al listar tutorias seleccionadas"));
        }
    }

    public function registrarProyectoAjax($titulo, $resumen, $linea) {
        session_start();
        $controlador = $this->controlador;
        $proyectoDTO = new ProyectoDTO(NULL, $linea, NULL, $titulo, $resumen, null);
        try {
            $exito = $controlador->registrarProyectoControlador($proyectoDTO);
            if ($exito) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false, "error" => "No lograste registrar proyecto"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => $ex->getMessage()));
        }
    }

    public function enviarCorreoValidacionAjax() {
        $controlador = $this->controlador;
        session_start();
        try {
            $exito = $controlador->enviarCorreoValidacionControlador();
            if ($exito) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false, "error" => "Error al enviar correo electronico de validacion"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "Error al enviar correo electronico de validacion"));
        }
    }

    public function listarProyectoIdAjax() {
        session_start();
        try {
            $controlador = $this->controlador;
            $proyecto = $controlador->listarProyectoIdControlador();
            if ($proyecto) {
                $proyecto["exito"] = true;
                echo json_encode($proyecto);
            } else {
                echo json_encode(array("exito" => false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "Error al listar proyecto"));
        }
    }

    public function listarMisProyectosAjax() {
        try {
            session_start();
            $controlador = $this->controlador;
            $proyectos = $controlador->listarMisProyectosControlador();
            if ($proyectos) {
                $proyectos[count($proyectos) - 1]["exito"] = true;
                echo json_encode($proyectos);
            } else {
                echo json_encode(array("exito" => false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "Error al listar proyectos"));
        }
    }

    public function mostrarFeriaIdAjax() {
        try {
            session_start();
            $controlador = $this->controlador;
            $feria = $controlador->mostrarFeriaIdControlador();
            if ($feria) {
                $feria["exito"] = true;
                echo json_encode($feria);
            } else {
                echo json_encode(array("exito" => false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "Error al listar feria"));
        }
    }

    public function invitarCompanieroAjax($correo) {
        try {
            session_start();
            $controlador = $this->controlador;
            $correoEnviado = $controlador->invitarCompanieroControlador($correo);
            if ($correoEnviado) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false, "error" => "No lograste enviar un correo de invitacion a tu proyecto."));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => "No lograste enviar un correo de invitacion a tu proyecto."));
        }
    }

    public function listarFeriaFiltroAjax($filtro) {
        try {
            if ($filtro["orden"] == "true") {
                $filtro["orden"] = "asc";
            } else if ($filtro["orden"] == "false") {
                $filtro["orden"] = "desc";
            }
            $controlador = $this->controlador;
            $ferias = $controlador->listarFeriaControlador($filtro);
            if ($ferias) {
                if (count($ferias) < 2) {
                    echo json_encode(array("exito" => false));
                } else {
//                    echo json_encode($ferias);
                    echo json_encode($ferias);
                }
            } else {
                echo json_encode(array("exito" => false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false));
        }
    }

    public function listarCalificarAjax() {
        try {
            session_start();
            $controlador = $this->controlador;
            $criterios = $controlador->mostrarCriteriosEvaluarControlador();
            if ($criterios) {
                echo json_encode($criterios);
            } else {
                echo json_encode(array("exito" => false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false));
        }
    }

    public function modificarNotaTemporalAjax($idCriterio, $nota, $observacion) {
        try {
            session_start();
            $controlador = $this->controlador;
            $exito = $controlador->modificarNotaTemporalControlador($idCriterio, $nota, $observacion);
            echo json_encode($exito);
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false));
        }
    }

    public function registrarCalificacionAjax($calificaciones) {
        try {
            session_start();
            $controlador = $this->controlador;
            $exito = false;
            $exito = $controlador->registrarCalifacionControlador($calificaciones);
            if ($exito) {
                echo json_encode(array("exito" => $exito));
            } else {
                echo json_encode(array("exito" => $exito, "error" => "No se pudo ingresar calificacion final. Por favor recargue al pagina e ingrese de nuevo las notas."));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => $exito, "error" => "No se pudo ingresar calificacion final. Por favor recargue al pagina e ingrese de nuevo las notas."));
        }
    }

    public function recuperarContraseniaAjax($correo, $usuario, $tipoUsuario) {
        switch ($tipoUsuario) {
            case "evaluador":
                $this->recuperarContraseniaEvaluador($usuario, $correo);
                break;
            case "estudiante":
                $this->recuperarContraseniaEstudiante($usuario, $correo);
                break;
        }
    }

    private function recuperarContraseniaEstudiante($usuario, $correo) {
        $codigoP = substr($usuario, 0, 3);
        $codigoE = substr($usuario, 3, 4);
        $validar = md5(time());
        $exito = false;
        $estudianteDTO = new EstudianteDTO(null, $correo, $codigoE, null, null, $codigoP, null, null, $validar);
        try {
            $exito = $this->controlador->recuperarContraseniaEstudianteControlador($estudianteDTO);
            if ($exito) {
                echo json_encode(Array("exito" => true));
            } else {
                echo json_encode(array("exito" => false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false));
        }
    }

    private function recuperarContraseniaEvaluador($usuario, $correo) {
        $validar = md5(time());
        $exito = false;
        $evaluadorDTO = new EvaluadorDTO(NULL, $correo, null, $usuario, NULL, $validar);
        try {
            $exito = $this->controlador->recuperarContraseniaEvaluadorControlador($evaluadorDTO);
            if ($exito) {
                echo json_encode(Array("exito" => true));
            } else {
                echo json_encode(array("exito" => false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false));
        }
    }

    public function ingresarContraseniaNuevaRecuperacionAjax($contrasenia) {
        $exito = false;
        session_start();
        try {
            $exito = $this->controlador->ingresarContraseniaNuevaRecuperacionControlador($contrasenia);
            if ($exito) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false));
        }
    }
    
    public function actualizarContraseniaAjax($contrasenia){
        $exito=false;
        session_start();
        try {
            $exito=$this->controlador->actualizarContraseniaControlador($contrasenia);
            if ($exito) {
                echo json_encode(array("exito"=>true));
            }else{
                echo json_encode(array("exito"=>false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito"=>false));
        }
    }
    
    public function actualizarDatoProyectoAjax($nombre,$dato){
        $exito=false;
        session_start();
        try {
            $exito=$this->controlador->actualizarDatoProyectoControlador($nombre, $dato);
            if ($exito) {
                echo json_encode(array("exito"=>true));
            }else{
                echo json_encode(array("exito"=>false));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito"=>false,"error"=>$ex->getMessage()));
            
        }
    }

}

$ajax = new Ajax();
//si esta variable es true significa que debe registrar un estudiante.
$registrarEstudiante = isset($_POST["nombreE"], $_POST["codigoE"], $_POST["correoE"], $_POST["documentoE"], $_POST["contraseniaE"], $_POST["programaAcademicoE"]);

//si esta variable es true significa que debe buscar los programas academicos registrados
$buscarProgramas = isset($_GET["programasAcademicos"]);

//si esta variable es true significa que debe ingresar un usuario al sistema
$ingresarUsuario = isset($_POST["usuarioI"], $_POST["contraseniaI"], $_POST["tipoUsuarioI"]);

//si esta variable es true significa que debe listar los datos de el usuario logeado
$listarDatos = isset($_GET["datosPerfil"]);

//si esta variable es true significa que debe listar los docentes registrados
$listarDocentes = isset($_GET["docentes"]);

//si esta varibale es true significa que debe listar asignaturas
$listarAsignaturas = isset($_GET["asignaturas"]);

//si esta varibale es true significa que debe listar las lineas de investigacion
$listarLineasInvestigacion = isset($_GET["lineasInvestigacion"]);

//si esta variable es true significa que debe guardar temporalmente una tutoria
$guardarTutoria = isset($_POST["asignaturaP"], $_POST["docenteP"]);

//si esta variable es true significa que debe listar las tutorias temporales
$listarTutorias = isset($_GET["tutorias"]);

//si esta variable es true significa que debe guardar una linea de investigacion
//si esta variable es true significa que debe registrar un proyecto
$registrarProyecto = isset($_POST["nombreP"], $_POST["resumenP"], $_POST["lineaP"]);

//si esta variable es true significa que debe listar las ferias de acuerdo a un filtro
//si esta variable es true significa que debe enviar un correo de validacion al usuario
$validarCorreo = isset($_POST["validarCorreo"]);


//si esta variable es true significa que debe listar los datos de un proyecto por id
$listarProyectoId = isset($_POST["listarProyecto"]);

//si esta varibale es true significa que debe listar los datos de lOS proyectos registrados del usuario logeado
$listarMisProyectos = isset($_POST["listarMisProyectos"]);

//si esta variable es true significa que debe listar informacion de una feria especifica.
$mostrarFeriaId = isset($_POST["mostrarFeria"]);

//si esta varibale es true significa que debe utilizar el correo ingresado para invitar compañero a un proyecto.
$inviarCompaniero = isset($_POST["correoInvitacion"]);


//si esta variable es true significa que debe listar las ferias de acuerdo a un filtro enviado.
$listarFeriaFiltro = isset($_POST["filtro"]);


//si esta variable es true significa que debe listar los criterios de evaluacion de un proyecto que sera evaluado
$listarCalificar = isset($_POST["listarCalificar"]);


// si esta variable es true significa que debe guardar una calificacion temporal
$actualizarNotaTemporal = isset($_POST["idCriterioM"], $_POST["actualizarNotaTemporalM"], $_POST["notaM"], $_POST["observacionM"]);


//si esta variable es true significa que debe registrar las calificaciones seleccionadas anteriormente
$registrarCalificacion = isset($_POST["enviarCalificacionC"], $_POST["datosCalificacion"]);


//si esta variable es true significa que debe recuperar la contrasenia
$recuperarContrasenia = isset($_POST["usuarioRe"], $_POST["correoRe"], $_POST["tipoUsuarioRe"]);

//si esta variable es true signficia que debe ingresar la contraseña nueva por recuperacion de contraseña
$ingresarContraRecupera = isset($_POST["contraseniaNueva"]);


//si esta variable es true significa que debe actualizar la contraseña
$actualizarContrasenia=  isset($_POST["contraNueva"]);


//si esta variable es true significa que debe actualizar un dato del proyecto
$actualizarDatoProyecto= isset($_POST["actualizarDatoProyecto"]);

if ($listarFeriaFiltro) {
    $ajax->listarFeriaFiltroAjax($_POST["filtro"]);
} else
if ($registrarEstudiante) {
    $ajax->registrarEstudianteAjax($_POST["nombreE"], $_POST["codigoE"], $_POST["correoE"], $_POST["documentoE"], $_POST["contraseniaE"], $_POST["programaAcademicoE"]);
} else if ($buscarProgramas && $_GET["programasAcademicos"]) {
    $ajax->listarProgramasAcademicosAjax();
} else if ($ingresarUsuario) {
    $ajax->ingresarUsuarioAjax($_POST["usuarioI"], $_POST["contraseniaI"], $_POST["tipoUsuarioI"]);
} else if ($listarDatos && $_GET["datosPerfil"]) {
    $ajax->listarDatosPerfilAjax();
} else if ($listarDocentes && $_GET["docentes"]) {
    $ajax->listarDocentesAjax();
} else if ($listarAsignaturas && $_GET["asignaturas"]) {
    $ajax->listarAsignaturasAjax();
} else if ($listarLineasInvestigacion && $_GET["lineasInvestigacion"]) {
    $ajax->listarLineasInvestigacionAjax();
} else if ($guardarTutoria) {
    $ajax->guardarTutoriaAjax($_POST["docenteP"], $_POST["asignaturaP"]);
} else if ($listarTutorias && $_GET["tutorias"]) {
    $ajax->listarTutoriasAjax();
} elseif ($registrarProyecto) {
    $ajax->registrarProyectoAjax($_POST["nombreP"], $_POST["resumenP"], $_POST["lineaP"]);
} else if ($validarCorreo && $_POST["validarCorreo"]) {
    $ajax->enviarCorreoValidacionAjax();
} else if ($listarProyectoId && $_POST["listarProyecto"]) {
    $ajax->listarProyectoIdAjax();
} else if ($listarMisProyectos) {
    $ajax->listarMisProyectosAjax();
} else if ($mostrarFeriaId) {
    $ajax->mostrarFeriaIdAjax();
} else if ($inviarCompaniero) {
    $ajax->invitarCompanieroAjax($_POST["correoInvitacion"]);
} else if ($listarCalificar) {
    $ajax->listarCalificarAjax();
} else if ($actualizarNotaTemporal) {
    $ajax->modificarNotaTemporalAjax($_POST["idCriterioM"], $_POST["notaM"], $_POST["observacionM"]);
} else if ($registrarCalificacion) {
    $ajax->registrarCalificacionAjax($_POST["datosCalificacion"]);
} else if ($recuperarContrasenia) {
    $ajax->recuperarContraseniaAjax($_POST["correoRe"], $_POST["usuarioRe"], $_POST["tipoUsuarioRe"]);
} else if ($ingresarContraRecupera) {
    $ajax->ingresarContraseniaNuevaRecuperacionAjax($_POST["contraseniaNueva"]);
}else if ($actualizarContrasenia) {
    $ajax->actualizarContraseniaAjax($_POST["contraNueva"]);
}else if ($actualizarDatoProyecto) {
    $ajax->actualizarDatoProyectoAjax($_POST["actualizarDatoProyecto"]["nombre"], $_POST["actualizarDatoProyecto"]["dato"]);
}