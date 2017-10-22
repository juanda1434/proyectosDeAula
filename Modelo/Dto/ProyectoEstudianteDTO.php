<?php


class ProyectoEstudianteDTO {
   
    private $id;
    private $idEstudiante;
    private $idProyecto;
    
    
    function __construct($id, $idEstudiante, $idProyecto) {
        $this->id = $id;
        $this->idEstudiante = $idEstudiante;
        $this->idProyecto = $idProyecto;
    }
    function getId() {
        return $this->id;
    }

    function getIdEstudiante() {
        return $this->idEstudiante;
    }

    function getIdProyecto() {
        return $this->idProyecto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdEstudiante($idEstudiante) {
        $this->idEstudiante = $idEstudiante;
    }

    function setIdProyecto($idProyecto) {
        $this->idProyecto = $idProyecto;
    }


}
