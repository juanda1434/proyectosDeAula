<?php

class EstadoProyectoDAO {

     private $conexion;
    public function __construct() {
        $conn = new Conexion();
        $this->conexion=$conn->crearConexion();
    }
    public function buscarIdEstado() {
        $conexion = $this->conexion;
        $idEstado=false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id from estadoproyecto where nombre='inscripcion'");
            $ok=$stm->execute();
            if ($ok && $stm->rowCount()>0) {
                $estado = $stm->fetch();
            $idEstado = $estado["id"];
            }
            
        } catch (Exception $ex) {
            
        }
        return $idEstado;
    }

}
