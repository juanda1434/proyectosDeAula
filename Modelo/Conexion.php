<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author USUARIO
 */
class Conexion {
    
    public function crearConexion(){
        try{
            
        $conexion= new PDO("mysql:host=localhost;dbname=feria","ufps","ufps",array(PDO::ATTR_PERSISTENT => true));
        return $conexion;
        } catch (Exception $ex) {
            throw new Exception("Error al conectar con la base de datos. Por favor contacta con el soporte de la pagina.");
        }
    }
}
