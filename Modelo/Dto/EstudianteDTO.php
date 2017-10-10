<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstudianteDTO
 *
 * @author USUARIO
 */
class EstudianteDTO {
    
   
   private $nombre;
   private $correo;
   private $codigo;
   private $documento;
   private $contrasenia;
   private $codigoPrograma;
   private $validarRegistro;
   
   function __construct($nombre, $correo, $codigo, $documento, $contrasenia, $codigoPrograma,$validarRegistro) {
       $this->nombre = $nombre;
       $this->correo = $correo;
       $this->codigo = $codigo;
       $this->documento = $documento;
       $this->contrasenia = $contrasenia;
       $this->codigoPrograma = $codigoPrograma;
       $this->validarRegistro= $validarRegistro;
   }
   function getValidarRegistro() {
       return $this->validarRegistro;
   }

      function getNombre() {
       return $this->nombre;
   }

   function getCorreo() {
       return $this->correo;
   }

   function getCodigo() {
       return $this->codigo;
   }

   function getDocumento() {
       return $this->documento;
   }

   function getContrasenia() {
       return $this->contrasenia;
   }

   function getCodigoPrograma() {
       return $this->codigoPrograma;
   }

   function setNombre($nombre) {
       $this->nombre = $nombre;
   }

   function setCorreo($correo) {
       $this->correo = $correo;
   }

   function setCodigo($codigo) {
       $this->codigo = $codigo;
   }

   function setDocumento($documento) {
       $this->documento = $documento;
   }

   function setContrasenia($contrasenia) {
       $this->contrasenia = $contrasenia;
   }

   function setCodigoPrograma($codigoPrograma) {
       $this->codigoPrograma = $codigoPrograma;
   }

   function setValidarRegistro($validarRegistro) {
       $this->validarRegistro = $validarRegistro;
   }


}
