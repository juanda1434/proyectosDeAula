<?php

class LineaDAO {
 
    public function listarLineasInvestigacion(){
        $conexion= Conexion::crearConexion();
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
        $conexion=  Conexion::crearConexion();
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
