<?php

class ProyectoDTO {
    
    private $idFeria;
    private $idLinea;
    private $idEstado;
    private $titulo;
    private $resumen;
    private $idLider;
    function __construct($idFeria, $idLinea, $idEstado, $titulo, $resumen,$idLider) {
        $this->idFeria = $idFeria;
        $this->idLinea = $idLinea;
        $this->idEstado = $idEstado;
        $this->titulo = $titulo;
        $this->resumen = $resumen;
        $this->idLider=$idLider;
    }
    function getIdLider() {
        return $this->idLider;
    }

    function setIdLider($idLider) {
        $this->idLider = $idLider;
    }

        function getIdFeria() {
        return $this->idFeria;
    }

    function getIdLinea() {
        return $this->idLinea;
    }

    function getIdEstado() {
        return $this->idEstado;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getResumen() {
        return $this->resumen;
    }

    function setIdFeria($idFeria) {
        $this->idFeria = $idFeria;
    }

    function setIdLinea($idLinea) {
        $this->idLinea = $idLinea;
    }

    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setResumen($resumen) {
        $this->resumen = $resumen;
    }


}
