<?php
    $_SESSION["idProyecto"]=(int)$_GET["id"];

?>
<div class="container" style="margin-bottom: 3%">


    <div class="row" style="margin-top: 3%">


        

        <div class="col-md-6 z-depth-5" style="padding-bottom: 1%">
            <div class="headline">
                <h3 id="tituloProyecto"></h3>
        </div>
            <div class="headline" style="margin-bottom: 12%">
                <h4 class="col-md-6">Resumen</h4>
            </div>
            <div class="z-depth-2 container-fluid text-justify" style="margin-bottom: 3%"><p style="margin-top: 3%" id="resumenProyecto"></p></div>
            
            <div class="z-depth-2 container-fluid">
                <b><h5 style="">Linea de investigacion</h5></b>
                <p id="lineaProyecto"></p>
            </div>
        </div>
        
        <div class="col-md-5 z-depth-5 col-md-push-1" >

            <div class="headline" style="margin-bottom: 12%">
                <h4 class="col-md-6">Integrantes</h4>
            </div>



            <table class="z-depth-1 table-striped" style="margin-bottom: 2%">
                <thead>
                    <tr> 
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Programa Academico</th>                         
                </tr>
                </thead>
                
                <tbody id="integrantesProyecto">
                   
                </tbody>
                
            </table>

            <div class="container-fluid" style="margin-bottom: 3%;margin-top: 7%">
                <div class="row z-depth-1" style="margin-bottom: 3%" id="panelAgregar">
                
                               
                
            
                
                
            </div>
                
            </div>
            
            
            


        </div>
        
        <div class="col-md-10 z-depth-5" style="margin-top: 3%;padding-bottom: 3%   " >

            <div class="headline" style="margin-bottom: 4%">
                <h4 class="col-md-6">Tutorias</h4>
            </div>



            <table class="z-depth-1 table-striped footable" style="margin-bottom: 2%" >
                <thead>
                <tr> 
                    <th data-breakpoints="xs">Codigo docente</th>
                    <th>Nombre docente</th>
                    <th data-breakpoints="xs">Programa academico</th>
                    <th data-breakpoints="xs">Codigo asignatura</th>
                    <th>Nombre asignatura</th>
                    <th data-breakpoints="xs">Programa academico </th>
                </tr>
                <thead>
                <tbody id="tutoriaProyecto">
                </tbody>
                
            </table>

            
            
            
            


        </div>

    </div>



</div>

