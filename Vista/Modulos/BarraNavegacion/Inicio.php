<blockquote style="margin-top: 5%">
    <b><h1 style="border-bottom: 3px solid #aa1916;  size: 7"> INICIO </h1></b>
</blockquote>
<div class="container-fluid" style="margin-bottom: 3%">
    <div class="row grey lighten-5">
         <div class="col-md-12 text-center"> <h1 style="border-bottom: 2px solid black;  size: 7">Ferias</h1></div>
        <div class="col-md-3">
            <div class="z-depth-5" >
                <div class="panel panel-dark">
                    
                    <div class="panel-heading">
                        <h3 style="color: white">Filtro ferias</h3>
                </div>
                    <div class="panel-body">
                        
                        <div style="border-bottom: 3px solid black;margin-bottom: 3%;margin-top: 1%"></div>
                            <div class="radio">
                            <label for="radActiva"> 
                                <input type="radio" id="radActiva" name="filtro" checked="true">Ferias activas
                            </label>
                        </div>
                        <div class="radio">
                            <label for="radFinalizada">
                                <input type="radio" id="radFinalizada" name="filtro">Ferias finalizadas
                            </label>
                        </div>
                        <?php 
                        if (isset($_SESSION["perfil"])){
                            echo '<div style="border-bottom: 3px solid black;margin-bottom: 3%;margin-top: 1%"></div>
                        <div class="radio">
                            <label for="radParticipa">
                                <input type="radio" id="radParticipa" name="filtro3">Yo participo
                            </label>
                        </div>';
                        }
                        ?>                        
                        
                        <div style="border-bottom: 3px solid black;margin-bottom: 3%;margin-top: 1%"></div>
                        <div class="radio">
                            <label for="radNombre">
                                <input type="radio" id="radNombre" name="filtro2" checked="true">Nombre <span id="sortNombre" hidden class="glyphicon glyphicon-sort-by-attributes"></span>
                            </label>
                        </div>
                        <div class="radio">
                            <label for="radFecha">
                                <input type="radio" id="radFecha" name="filtro2">Fecha <span id="sortFecha" hidden class="glyphicon glyphicon-sort-by-attributes"></span>
                            </label>
                        </div>
                        <div></div>
                        <div></div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
         <div class="col-md-9" id="contenedorFerias">
            
            
            
            
        </div>
        
    </div>
    
    <nav aria-label="Page navigation" class="center">
  <ul class="pagination">
      <li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a>2</a></li>
    <li><a >3</a></li>
    <li><a >4</a></li>
    <li><a >5</a></li>
    <li><a href="" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
  </ul>
</nav>
</div>