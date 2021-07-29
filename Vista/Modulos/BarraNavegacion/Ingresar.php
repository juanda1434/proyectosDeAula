<?php
if (isset($_SESSION["perfil"])) {
    header("location:Inicio");
  
}

?>

<div class="container contenedor" style="margin-top: 3%">
    
    
    
    <form class="form-horizontal " id="formIngresar">
        <div class="row">
            
            <div class="col-md-5 col-md-push-3 sombra">
                
                <div class="form-group">
                    <h3 class=" center">Ingresar</h3>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="" for="usuarioI">Usuario</label>        
                        <input type="text" id="usuarioI" name="usuarioI" class="form-control" placeholder="(Ingresa Codigo Estudiante o Cedula Evaluador)" maxlength="13">            
            <label class="bg-danger" id="error-usuarioI"></label>
                    </div>
            
        </div>
    


    <div class="form-group">
        <div class="col-md-12">
        <label class="" for="contraseniaI">Contraseña</label>       
        <input type="password" id="contraseniaI" name="contraseniaI"  class="form-control" maxlength="8" minlength="4" placeholder="Ingresa maximo 8 caracteres" >
            <label class="bg-danger" id="error-contraseniaI"></label>     
    </div></div>
<div class="form-group">
        <div class="col-md-12">
        <label class="" for="tipoUsuarioI">Tipo de Usuario</label>       
        <select id="tipoUsuarioI" name="tipoUsuarioI" class="form-control"> 
            <option value="">Seleccione tipo de usuario</option>
            <option value="estudiante">Estudiante</option>
            <option value="evaluador">Evaluador</option>
        </select>
            <label class="bg-danger" id="error-tipoUsuarioI"></label>     
    </div></div>
                <div class="form-group col-md-12">
            
                
        <button class="col-md-4 col-md-offset-4 btn btn-danger" type="submit"><span class="glyphicon glyphicon-share"></span> Iniciar sesión</button>  
       
            </div>
                
                <p class="center-align col-md-12 "><a class="black-text" href="Registro">¿ No has creado una cuenta ?. </a> <a href="Registro">Crea una.</a></p>

                <p class="center-align col-md-12 "><a class="black-text" href="Recuperar">¿ Has olvidado tu contraseña ?. </a><a href="Recuperar">Recuperar contraseña.</a></p>
        
            </div>
        </div>
   
        
    
</form>
    
    
</div>