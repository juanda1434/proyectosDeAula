<?php


class TutoriaDTO {
    
    private $codigoDocente;
    private $codigoAsignatura;
    private $codigoProgramaDocente;
    private $codigoProgramaAsignatura;
    
    function __construct($codigoDocente, $codigoAsignatura, $codigoProgramaDocente, $codigoProgramAsignatura) {
        $this->codigoDocente = $codigoDocente;
        $this->codigoAsignatura = $codigoAsignatura;
        $this->codigoProgramaDocente = $codigoProgramaDocente;
        $this->codigoProgramaAsignatura = $codigoProgramAsignatura;
    }

    function getCodigoDocente() {
        return $this->codigoDocente;
    }

    function getCodigoAsignatura() {
        return $this->codigoAsignatura;
    }

    function getCodigoProgramaDocente() {
        return $this->codigoProgramaDocente;
    }

    function getCodigoProgramaAsignatura() {
        return $this->codigoProgramaAsignatura;
    }

    function setCodigoDocente($codigoDocente) {
        $this->codigoDocente = $codigoDocente;
    }

    function setCodigoAsignatura($codigoAsignatura) {
        $this->codigoAsignatura = $codigoAsignatura;
    }

    function setCodigoProgramaDocente($codigoProgramaDocente) {
        $this->codigoProgramaDocente = $codigoProgramaDocente;
    }

    function setCodigoProgramaAsignatura($codigoProgramAsignatura) {
        $this->codigoProgramaAsignatura = $codigoProgramAsignatura;
    }


}
