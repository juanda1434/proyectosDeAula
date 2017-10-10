<?php 
if (!isset($_SESSION["perfil"])) {
  header("location:Inicio");
}
?>

<div class="container" style="margin-top: 3%">
        
        <form class="form-horizontal" id="formRegistrarEstudiante">
        
    <div class="form-group">
        <label class="control-label col-md-2 "  for="nombreE">Nombre</label>
        <div class="col-md-6">
            <input  name="nombreE" type="text" id="nombreE" class="form-control" >
            <label id="error-nombreE"></label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="correoE">Correo</label>
        <div class="col-md-6">
        <input name="correoE" type="text" id="correoE" class="form-control" >
        <label id="error-correoE"></label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="codigoE">Codigo</label>
        <div class="col-md-6">
        <input name="codigoE" type="text" id="codigoE" class="form-control" > 
        <label id="error-codigoE"></label>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-md-2" for="documentoE">Documento</label>
        <div class="col-md-6">
        <input name="documentoE" type="text" id="documentoE" class="form-control" >
        <label id="error-documentoE"></label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="contraseniaE">Contrasenia</label>
        <div class="col-md-6">
        <input name="contraseniaE" type="password" id="contraseniaE" class="form-control" >
        <label id="error-contraseniaE"></label>
        </div>
    </div>

    <div class="form-group programas">
    </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-2"> 
        <button class="btn btn-primary" type="submit">Aceptar</button>  
        </div>
            </div>
</form>
        
    </div>
    
