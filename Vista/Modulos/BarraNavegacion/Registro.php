<?php 
if (isset($_SESSION["perfil"])) {    
    header("location:Inicio");
  
}
?>
<div class="container contenedor" style="margin-top: 3%">
    
    <div class="row">
        <div class="col-md-6 col-md-push-3 sombra">
            
            <h3 class="center">Registro</h3>
    
    <form class="form-horizontal" id="formRegistrarEstudiante">
        
    <div class="form-group">
        <div class="col-md-12">
        <label class=""  for="nombreE">Nombre</label>        
            <input  name="nombreE" type="text" id="nombreE" class="form-control" >
            <label class="bg-danger" id="error-nombreE"></label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
        <label class="" for="correoE">Correo</label>        
        <input name="correoE" type="text" id="correoE" class="form-control" >
        <label class="bg-danger" id="error-correoE"></label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
        <label class="" for="codigoE">Codigo</label>        
        <input name="codigoE" type="text" id="codigoE" class="form-control" > 
        <label class="bg-danger" id="error-codigoE"></label>
        </div>
    </div>


    <div class="form-group">
         <div class="col-md-12">
        <label class="" for="documentoE">Documento</label>       
        <input name="documentoE" type="text" id="documentoE" class="form-control" >
        <label class="bg-danger" id="error-documentoE"></label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
        <label class="" for="contraseniaE">Contrasenia</label>        
        <input name="contraseniaE" type="password" id="contraseniaE" class="form-control" >
        <label class="bg-danger" id="error-contraseniaE"></label>
        </div>
    </div>

    <div class="form-group programas">
    </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-2"> 
        <button class="btn btn-primary" type="submit">Aceptar</button>  
        </div>
            </div>
            
        </div>
        
        
    </div>
    
    
</form>
    
    
    
</div>

