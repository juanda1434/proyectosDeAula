<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvaluadorDTO
 *
 * @author USUARIO
 */
class EvaluadorDTO {
    
    private $nombre;
    private $correo;
    private $contrasenia;
    private $documento;
    private $validarRegistro;
    private $validarContrasenia;
    
    function __construct($nombre, $correo, $contrasenia, $documento,$validarRegistro,$validarContrasenia) {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contrasenia = $contrasenia;
        $this->documento = $documento;
        $this->validarRegistro=$validarRegistro;
        $this->validarContrasenia=$validarContrasenia;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getContrasenia() {
        return $this->contrasenia;
    }

    function getDocumento() {
        return $this->documento;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function getValidarRegistro() {
        return $this->validarRegistro;
    }

    function getValidarContrasenia() {
        return $this->validarContrasenia;
    }



    
}
