<?php
if (isset($_SESSION["perfil"])) {
    header("location:Inicio");
  
}

?>

<div class="container">
    
    <h1 class="col-md-offset-5">Ingresar</h1>
    
    <form class="form-horizontal" id="formIngresar">
   
    <div class="form-group">
        <label class="control-label col-md-2 col-md-offset-1" for="correoI">Correo</label>
        <div class="col-md-5">
            <input type="text" id="correoI" name="correoI" class="form-control" >
            <label id="error-correoI"></label>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-md-2 col-md-offset-1" for="contraseniaI">Contrasenia</label>
        <div class="col-md-5">
            <input type="password" id="contraseniaI" name="contraseniaI" class="form-control" >
            <label id="error-contraseniaI"></label>
        </div>
    </div>


        <div class="form-group">
            <div class="col-md-2 col-md-offset-3"> 
        <button class="btn btn-primary" type="submit">Aceptar</button>  
        </div>
            </div>
</form>
    
    
</div>