<?php
if (isset($_SESSION["perfil"])) {
    header("location:Inicio");
}
?>
<div class="container contenedor" style="margin-top: 3%">
    
    
    
    <form class="form-horizontal " id="formRecuperarContrasenia">
        <div class="row">
            
            <div class="col-md-5 col-md-push-3 sombra">
                
                <div class="form-group">
                    <h3 class=" center">Recuperar Contraseña</h3>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="" for="usuarioRe">Usuario</label>        
                        <input type="text" id="usuarioRe" name="usuarioRe" class="form-control" placeholder="(Ingresa Codigo Estudiante o Cedula Evaluador)">            
            <label class="bg-danger" id="error-usuarioRe"></label>
                    </div>
            
        </div>
    <div class="form-group">
                    <div class="col-md-12">
                        <label class="" for="correoRe">Correo</label>        
                        <input type="email" id="correoRe" name="correoRe" maxlength="50" class="form-control" placeholder="Ingrese correo (asasa@asasa)">            
            <label class="bg-danger" id="error-correoRe"></label>
                    </div>
            
        </div>


    
<div class="form-group">
        <div class="col-md-12">
        <label class="" for="tipoUsuarioRe">Tipo de Usuario</label>       
        <select id="tipoUsuarioRe" name="tipoUsuarioRe" class="form-control"> 
            <option value="">Seleccione tipo de usuario</option>
            <option value="estudiante">Estudiante</option>
            <option value="evaluador">Evaluador</option>
        </select>
            <label class="bg-danger" id="error-tipoUsuarioRe"></label>     
    </div></div>
                <div class="form-group col-md-12">
            
                
        <button class="col-md-6 col-md-offset-3 btn btn-danger" type="submit"><span class="glyphicon glyphicon-share"></span> Recuperar contraseña</button>  
       
            </div>
                
            </div>
        </div>
   
        
    
</form>
    
    
</div>


