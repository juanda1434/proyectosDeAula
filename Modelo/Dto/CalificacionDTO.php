<?php


class CalificacionDTO {
    
    
    private $id;
    private $idEvaluador;
    private $nota;
    private $idCriterio;
    private $observacion;
    
    function __construct($id, $idEvaluador, $nota, $idCriterio, $observacion) {
        $this->id = $id;
        $this->idEvaluador = $idEvaluador;
        $this->nota = $nota;
        $this->idCriterio = $idCriterio;
        $this->observacion = $observacion;
    }

    function getId() {
        return $this->id;
    }

    function getIdEvaluador() {
        return $this->idEvaluador;
    }

    function getNota() {
        return $this->nota;
    }

    function getIdCriterio() {
        return $this->idCriterio;
    }

    function getObservacion() {
        return $this->observacion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdEvaluador($idEvaluador) {
        $this->idEvaluador = $idEvaluador;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }

    function setIdCriterio($idCriterio) {
        $this->idCriterio = $idCriterio;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }


    
}
