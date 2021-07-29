<?php

class LineaDAO {
  private $conexion;
    public function __construct() {
        $conn = new Conexion();
        $this->conexion=$conn->crearConexion();
    }
    
    public function listarLineasInvestigacion(){
        $conexion= $this->conexion;
        $lineas=false;
        try{
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("select nombre,descripcion from linea");
            $ok= $stm->execute();
            if ($ok && $stm->rowCount()>0) {
                $lineas=$stm->fetchAll();
            }
        } catch (Exception $ex) {

        }
        return $lineas;
    }
    
    public function validarLineaNombre($nombre){
        $conexion=  $this->conexion;
        $exito=false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm=$conexion->prepare("select id from linea where nombre=?");
            $stm->bindParam(1, $nombre,PDO::PARAM_STR);
            $ok=$stm->execute();
            if ($ok && $stm->rowCount()>0) {
                $exito=$stm->fetch();
            }
        } catch (Exception $ex) {
            
        }
        return $exito;
    }
}
