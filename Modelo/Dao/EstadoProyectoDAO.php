<?php

class EstadoProyectoDAO {

    public function buscarIdEstado() {
        $conexion = Conexion::crearConexion();
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
