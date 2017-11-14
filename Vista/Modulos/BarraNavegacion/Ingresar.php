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
                        <label class="" for="usuarioI">usuario</label>        
            <input type="text" id="usuarioI" name="usuarioI" class="form-control" >            
            <label class="bg-danger" id="error-usuarioI"></label>
                    </div>
            
        </div>
    


    <div class="form-group">
        <div class="col-md-12">
        <label class="" for="contraseniaI">Contrasenia</label>       
            <input type="password" id="contraseniaI" name="contraseniaI" class="form-control" >
            <label class="bg-danger" id="error-contraseniaI"></label>     
    </div></div>
<div class="form-group">
        <div class="col-md-12">
        <label class="" for="tipoUsuarioI">Tipo usuario</label>       
        <select id="tipoUsuarioI" name="tipoUsuarioI" class="form-control"> 
            <option value="">Seleccione tipo de usuario</option>
            <option value="estudiante">Estudiante</option>
            <option value="evaluador">Evaluador</option>
        </select>
            <label class="bg-danger" id="error-tipoUsuarioI"></label>     
    </div></div>

        <div class="form-group">
            <div class="col-md-2 col-md-push-4"> 
        <button class="btn btn-primary" type="submit">Aceptar</button>  
        </div>
            </div>
                
            </div>
        </div>
   
        
    
</form>
    
    
</div>