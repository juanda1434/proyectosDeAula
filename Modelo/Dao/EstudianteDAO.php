<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstudianteDAO
 *
 * @author USUARIO
 */
class EstudianteDAO {
    private $conexion;
    public function __construct() {
        $conn = new Conexion();
        $this->conexion=$conn->crearConexion();
    }
                function registrarEstudiante($estudianteDTO) {
        $conexion = $this->conexion;
        $exito = false;
        $nombre=$estudianteDTO->getNombre();
        $correo=$estudianteDTO->getCorreo();
        $codigo=$estudianteDTO->getCodigo();
        $documento=$estudianteDTO->getDocumento();
        $contrasenia=$estudianteDTO->getContrasenia();
        $programa=$estudianteDTO->getCodigoPrograma();
        $validarRegistro=$estudianteDTO->getValidarRegistro();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("insert into estudiante(nombre,correo,codigo,documento,contrasenia,codigoprograma,validarregistro) values(?,?,?,?,?,?,?)");
            $stm->bindParam(1, $nombre, PDO::PARAM_STR);
            $stm->bindParam(2, $correo, PDO::PARAM_STR);
            $stm->bindParam(3,$codigo , PDO::PARAM_STR);
            $stm->bindParam(4,$documento , PDO::PARAM_STR);
            $stm->bindParam(5,$contrasenia , PDO::PARAM_STR);
            $stm->bindParam(6, $programa, PDO::PARAM_STR);
            $stm->bindParam(7,$validarRegistro , PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            if (strpos($ex->getMessage(), "documento_UNIQUE")) {
                throw new Exception("Ingresaste un documento que ya esta registrado en el sistema");
            } else if (strpos($ex->getMessage(), "correo_UNIQUE")) {
                throw new Exception("Ingresaste un correo que ya esta registrado en el sistema");
            } else if (strpos($ex->getMessage(), "programa_codigo_UNIQUE")) {
                throw new Exception("Ingresaste un codigo que ya esta registrado en el sistema (" . $estudianteDTO->getCodigoPrograma() . $estudianteDTO->getCodigo() . ")");
            }
        }

        return $exito;
    }

    function validarRegistro($llaveValidacion, $correo) {
        $conexion = $conexion = $this->conexion;
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("update estudiante set estudiante.validarregistro=null where estudiante.correo=? and estudiante.validarregistro=?");
            $stm->bindParam(1, $correo, PDO::PARAM_STR);
            $stm->bindParam(2, $llaveValidacion, PDO::PARAM_STR);
            $exito = $stm->execute();
            if ($exito) {
                if ($stm->rowCount()<1) {
                    $exito=false;
                }
            }            
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $exito;
    }

    public function IngresarEstudiante($estudianteDTO) {
        $conexion = $conexion = $this->conexion;
        $estudiante = false;
        $codigo=$estudianteDTO->getCodigo();
        $codigoPrograma=$estudianteDTO->getCodigoPrograma();
        $contrasenia=$estudianteDTO->getContrasenia();
        
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id,nombre,correo,codigo,documento,codigoprograma,validarregistro from estudiante where codigo=? and codigoprograma=? and contrasenia=?");
            $stm->bindParam(1, $codigo, PDO::PARAM_STR);
            $stm->bindParam(2,$codigoPrograma , PDO::PARAM_STR);
            $stm->bindParam(3,$contrasenia , PDO::PARAM_STR);
            $ok = $stm->execute();
            if ($ok) {
                $estudiante=$stm->fetch();
            }
        } catch (Exception $ex) {
            throw new Exception("Error al ingresar Estudiante bd");
        }
        return $estudiante;
    }

    
    public function modificarKeyValidacion($estudianteDTO){
        $conexion = $this->conexion;
        $exito=false;
        $validarRegistro=$estudianteDTO->getValidarRegistro();
        $id=$estudianteDTO->getId();
        try {
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stm = $conexion->prepare("UPDATE estudiante set estudiante.validarregistro=? where estudiante.id=?");
        $stm->bindParam(1, $validarRegistro,  PDO::PARAM_STR);
        $stm->bindParam(2,$id , PDO::PARAM_INT);
        $exito= $stm->execute();
        } catch (Exception $ex) {
            
        }
        return $exito;;
    }
    
    
    public function modificarKeyValidacionContrasenia($estudianteDTO){
         $conexion = $this->conexion;
        $exito=false;
        $validarRegistro=$estudianteDTO->getValidarContrasenia();
        $codigo=$estudianteDTO->getCodigo();
        $codigoPrograma=$estudianteDTO->getCodigoPrograma();
        $correo=$estudianteDTO->getCorreo();
        try {
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stm = $conexion->prepare("UPDATE estudiante set estudiante.validarcontrasenia=? where estudiante.codigo=? and estudiante.codigoprograma=? and estudiante.correo=?");
        $stm->bindParam(1, $validarRegistro,  PDO::PARAM_STR);
        $stm->bindParam(2, $codigo,  PDO::PARAM_STR);
        $stm->bindParam(3, $codigoPrograma,  PDO::PARAM_STR);
        $stm->bindParam(4, $correo,  PDO::PARAM_STR);
        $ok= $stm->execute();
        if ($ok) {
            if ($stm->rowCount()>0) {
             $exito=true;   
            }
        }
        } catch (Exception $ex) {
        }
        return $exito;;
    }
    
    public function validarKeyContrasenia($estudianteDTO){
        $exito=false;
        $conexion=$this->conexion;      
        $validarContrasenia=$estudianteDTO->getValidarContrasenia();
        $codigo=$estudianteDTO->getCodigo();
        $codigPrograma= $estudianteDTO->getCodigoPrograma();        
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("select id from estudiante where estudiante.codigo=? and estudiante.codigoprograma=? and estudiante.validarcontrasenia=?");
            $stm->bindParam(1, $codigo , PDO::PARAM_STR);
            $stm->bindParam(2, $codigPrograma , PDO::PARAM_STR);
            $stm->bindParam(3, $validarContrasenia , PDO::PARAM_STR);
            $ok=$stm->execute();
            echo $ok;
            if ($ok && $stm->rowCount()>0) {
                $exito=true;
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }
    
    public function ingresarContraRecuperacion($estudianteDTO,$contrasenia){
        $exito=false;
        $conexion=$this->conexion;      
        $validarContrasenia=$estudianteDTO->getValidarContrasenia();
        $codigo=$estudianteDTO->getCodigo();
        $codigPrograma= $estudianteDTO->getCodigoPrograma();   
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("update estudiante set estudiante.contrasenia=?,estudiante.validarcontrasenia=null where estudiante.codigo=? and estudiante.codigoprograma=? and estudiante.validarcontrasenia=?");
            $stm->bindParam(1, $contrasenia,PDO::PARAM_STR);
            $stm->bindParam(2, $codigo , PDO::PARAM_STR);
            $stm->bindParam(3, $codigPrograma , PDO::PARAM_STR);
            $stm->bindParam(4, $validarContrasenia , PDO::PARAM_STR);
            $ok=$stm->execute();
            if ($ok && $stm->rowCount()>0) {
                $exito=true;
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }
    
    
   public function actualizarContrasenia($id,$contrasenia){
        try {
            $exito=false;
        $conexion=$this->conexion;   
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("update estudiante set estudiante.contrasenia=? where estudiante.id=?");
            $stm->bindParam(1, $contrasenia,PDO::PARAM_STR);
            $stm->bindParam(2, $id , PDO::PARAM_INT);
            $ok=$stm->execute();
            if ($ok && $stm->rowCount()>0) {
                $exito=true;
            }
        } catch (Exception $ex) {
        }
        return $exito;
   }
}
