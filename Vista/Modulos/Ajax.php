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
require_once '../../Modelo/Dao/EstadoProyectoDAO.php';
require_once '../../Modelo/Dao/ProyectoDAO.php';
require_once '../../Modelo/Dao/FeriaDAO.php';
class Ajax {

    public function registrarEstudianteAjax($nombre, $codigo, $correo, $documento, $contrasenia, $programaAcademico) {
        $controlador = new Controlador();
        $validarRegistro = md5(time());
        $estudianteDTO = new EstudianteDTO($nombre, $correo, $codigo, $documento, $contrasenia, $programaAcademico, $validarRegistro,null);
        try {
            $exito = $controlador->registrarEstudianteControlador($estudianteDTO);
            if ($exito) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false, "error" => "No se pudo registrar un estudiante"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito" => false, "error" => $ex->getMessage()));
        }
    }

    public function listarProgramasAcademicosAjax() {
        $controlador = new Controlador();
        $aux = "";
        try {
            $aux = json_encode($controlador->listarProgramasAcademicosControlador());
        } catch (Exception $ex) {
            echo json_encode(array("error" => "Error al llamar los programas academicos. Contanta con el soporte de la pagina."));
            return;
        }
        echo $aux;
    }

    public function ingresarEstudiante($codigo, $contrasenia) {
        session_start();
        $controlador = new Controlador();
        $exito = false;
        $codigoP = substr($codigo, 0, 3);
        $codigoE = substr($codigo, 3, 4);
        try {
            $exito = $controlador->ingresarEstudianteControlador(new EstudianteDTO(null, null, $codigoE, null, $contrasenia, $codigoP, null,null));
            if ($exito) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false, "error" => "Usuario o contrasenia incorrecta"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
    }

    public function listarDatosPerfilAjax() {
        session_start();
        $controlador = new Controlador();
        if (isset($_SESSION["perfil"])) {
            echo json_encode($controlador->listarDatosPerfilControlador());
        }
    }

    public function listarDocentesAjax() {
        session_start();
        $controlador = new Controlador();
        if (isset($_SESSION["perfil"])) {
            echo json_encode($controlador->listarDocentesControlador());
        }
    }

    public function listarAsignaturasAjax() {
        session_start();
        $controlador = new Controlador();
        if (isset($_SESSION["perfil"])) {
            echo json_encode($controlador->listarAsignaturasControlador());
        }
    }

    public function listarLineasInvestigacionAjax() {
        $controlador = new Controlador();
        $lineas = $controlador->listarLineasInvestigacionControlador();
        if ($lineas) {
            echo json_encode($lineas);
        } else {
            echo json_encode(array("error" => "No hay lineas de investigacion"));
        }
    }

    public function guardarTutoriaAjax($codigoDocente, $codigoAsignatura) {
        session_start();
        $controlador = new Controlador();
        $codigoProgramaDocente = substr($codigoDocente, 0, 3);
        $codigoDocente = substr($codigoDocente, 3, 4);
        $codigoProgramaAsignatura = substr($codigoAsignatura, 0, 3);
        $codigoAsignatura = substr($codigoAsignatura, 3, 4);
        $tutoriaDTO = new TutoriaDTO($codigoDocente, $codigoAsignatura, $codigoProgramaDocente, $codigoProgramaAsignatura);
        try {
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
        if (isset($_SESSION["perfil"])) {
            $controlador = new Controlador();
            $tutorias = $controlador->listarTutoriasControlador();
            echo json_encode($tutorias);
        }
    }

    public function guardarLineaInvestigacionTemporalAjax($nombreLinea) {
        session_start();
        if (isset($_SESSION["perfil"])) {
            $controlador = new Controlador();
            if ($controlador->guardarLineaInvestigacionTemporalControlador($nombreLinea)) {
                echo json_encode(array("exito" => true));
            } else {
                echo json_encode(array("exito" => false, "error" => "Seleccione uns linea de investigacion correcta"));
            }
        }
    }

   
    
    public function registrarProyectoAjax($titulo,$resumen,$linea) {
        session_start();
        $controlador=new Controlador();
        $proyectoDTO= new ProyectoDTO(NULL, $linea, NULL, $titulo, $resumen,null);
        try {
            $exito=$controlador->registrarProyectoControlador($proyectoDTO);
            if ($exito) {
                echo json_encode(array("exito"=>true));
            }else{
                echo json_encode(array("exito"=>false,"error"=>"No lograste registrar proyecto"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito"=>false,"error"=>$ex->getMessage()));
        }
        
    }
    
    public function listarFeriasAjax($filtro){
        session_start();
        $controlador =new Controlador();
        $ferias=$controlador->listarFeriaFiltroControlador($filtro);
        if ($ferias) {
            echo json_encode($ferias);
        }
    }
    
     public function enviarCorreoValidacionAjax(){
        $controlador=new Controlador();
        session_start();
        try {
            $exito= $controlador->enviarCorreoValidacionControlador();
            if ($exito) {
                echo json_encode(array("exito"=>true));
            }else{
                echo json_encode(array("exito"=>false,"error"=>"Error al enviar correo electronico de validacion"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("exito"=>false,"error"=>"Error al enviar correo electronico de validacion"));
        }
        
         
    }
    
    public function listarProyectoIdAjax(){
        session_start();
        
            $controlador= new Controlador();
            $proyecto= $controlador->listarProyectoIdControlador();
            if ($proyecto) {
                $proyecto["exito"]=true;
                echo json_encode($proyecto);
            }else{
                echo json_encode(array("exito"=>false));
            }
            
        
        
    }
    
    public function listarMisProyectosAjax(){
        session_start();
        $controlador=new Controlador;
        $proyectos=$controlador->listarMisProyectosControlador();
        if ($proyectos) {
            $proyectos["exito"]=true;
            echo json_encode($proyectos);
        }else{
            echo json_encode(array("exito"=>false));
        }
    }
          
    public function mostrarFeriaIdAjax(){
        session_start();
        $controlador=new Controlador();
        $feria=$controlador->mostrarFeriaIdControlador();
        if ($feria) {
            $feria["exito"]=true;
            echo json_encode($feria);
        }else{
            echo json_encode(array("exito"=>false));
        }
    }

    public function invitarCompanieroAjax($correo){
        session_start();
        $controlador= new Controlador();
        $correoEnviado= $controlador->invitarCompanieroControlador($correo);
        if ($correoEnviado) {
            echo json_encode(array("exito"=>true));
        }else{
            echo json_encode(array("exito"=>false,"error"=>"No lograste enviar un correo de invitacion a tu proyecto."));
        }
    }
}

$ajax = new Ajax();
//si esta variable es true significa que debe registrar un estudiante.
$registrarEstudiante = isset($_POST["nombreE"], $_POST["codigoE"], $_POST["correoE"], $_POST["documentoE"], $_POST["contraseniaE"], $_POST["programaAcademicoE"]);

//si esta variable es true significa que debe buscar los programas academicos registrados
$buscarProgramas = isset($_GET["programasAcademicos"]);

//si esta variable es true significa que debe ingresar un usuario al sistema
$ingresarUsuario = isset($_POST["usuarioI"], $_POST["contraseniaI"]);

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
$registrarProyecto= isset($_POST["nombreP"],$_POST["resumenP"],$_POST["lineaP"]);

//si esta variable es true significa que debe listar las ferias de acuerdo a un filtro
$listarFerias=  isset($_GET["filtrarFeria"]);

//si esta variable es true significa que debe enviar un correo de validacion al usuario
$validarCorreo = isset($_POST["validarCorreo"]);


//si esta variable es true significa que debe listar los datos de un proyecto por id
$listarProyectoId =  isset($_POST["listarProyecto"]);

//si esta varibale es true significa que debe listar los datos de lOS proyectos registrados del usuario logeado
$listarMisProyectos= isset($_POST["listarMisProyectos"]);

//si esta variable es true significa que debe listar informacion de una feria especifica.
$mostrarFeriaId=  isset($_POST["mostrarFeria"]);

//si esta varibale es true significa que debe utilizar el correo ingresado para invitar compañero a un proyecto.
$inviarCompaniero = isset($_POST["correoInvitacion"]);


if ($registrarEstudiante) {
    $ajax->registrarEstudianteAjax($_POST["nombreE"], $_POST["codigoE"], $_POST["correoE"], $_POST["documentoE"], $_POST["contraseniaE"], $_POST["programaAcademicoE"]);
} else if ($buscarProgramas && $_GET["programasAcademicos"]) {
    $ajax->listarProgramasAcademicosAjax();
} else if ($ingresarUsuario) {
    $ajax->ingresarEstudiante($_POST["usuarioI"], $_POST["contraseniaI"]);
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
}elseif ($registrarProyecto) {
    $ajax->registrarProyectoAjax($_POST["nombreP"], $_POST["resumenP"],$_POST["lineaP"]);
}else if($listarFerias && $_GET["filtrarFeria"]=="activa"){
    $ajax->listarFeriasAjax($_GET["filtrarFeria"]);
}else if ($validarCorreo && $_POST["validarCorreo"]) {
    $ajax->enviarCorreoValidacionAjax();
}else if ($listarProyectoId && $_POST["listarProyecto"]) {
    $ajax->listarProyectoIdAjax();
}else if ($listarMisProyectos) {
    $ajax->listarMisProyectosAjax();
}else if ($mostrarFeriaId) {
    $ajax->mostrarFeriaIdAjax();
}else if($inviarCompaniero){
    $ajax->invitarCompanieroAjax($_POST["correoInvitacion"]);
}