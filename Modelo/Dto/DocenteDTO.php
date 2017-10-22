<?php

class DocenteDTO {
  private $nombre;
    private $codigo;
    private $programa;
    
    function __construct($nombre, $codigo, $programa) {
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->programa = $programa;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getPrograma() {
        return $this->programa;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setPrograma($programa) {
        $this->programa = $programa;
    }

}
