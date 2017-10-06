
<div class="container">
    
    <h1 class="col-md-offset-2">Registro</h1>
    
    <form class="form-horizontal" id="formRegistrarEstudiante">
        
    <div class="form-group">
        <label class="control-label col-md-2 "  for="nombreE">Nombre</label>
        <div class="col-md-10">
            <input  name="nombreE" type="text" id="nombreE" class="form-control" >
            <label id="error-nombreE"></label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="correoE">Correo</label>
        <div class="col-md-10">
        <input name="correoE" type="text" id="correoE" class="form-control" >
        <label id="error-correoE"></label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="codigoE">Codigo</label>
        <div class="col-md-10">
        <input name="codigoE" type="text" id="codigoE" class="form-control" > 
        <label id="error-codigoE"></label>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-md-2" for="documentoE">Documento</label>
        <div class="col-md-10">
        <input name="documentoE" type="text" id="documentoE" class="form-control" >
        <label id="error-documentoE"></label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="contraseniaE">Contrasenia</label>
        <div class="col-md-10">
        <input name="contraseniaE" type="password" id="contraseniaE" class="form-control" >
        <label id="error-contraseniaE"></label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="programa"E>Programa academico</label>
        <div class="col-md-10">
        <select name="programaE" class="form-control" id="programaE">
            <option  value="">Programas academicos</option>
            <option  value="Ingenieria de sistemas">Ingenieria de sistemas</option>
        </select> 
            <label id="error-programaE"></label>
        </div>
    </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-2"> 
        <button class="btn btn-primary" type="submit">Aceptar</button>  
        </div>
            </div>
</form>
    
    
</div>

