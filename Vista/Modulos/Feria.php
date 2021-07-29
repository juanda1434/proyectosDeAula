<?php

if (!isset($_GET["id"])) {
    header("location:Inicio");
}
$_SESSION["idFeria"]=$_GET["id"];
$controlador=new Controlador();
$exito=$controlador->mostrarFeriaIdControlador();
 $controlador->listarGanadoresFeriaControlador();
if (!$exito) {
    header("location:Inicio");
}
?>


<div class="container" style="margin-top: 3%;margin-bottom: 3%">

    <div class="row">

        <div class="col-md-8 z-depth-2 col-md-push-2">
            <div class="container-fluid">
                <div class="headline">
                    <h3 id="tituloFeria">Titulo de la feria</h3>
                </div>
                <div class="headline" style="margin-bottom: 12%">
                    <h4 class="col-md-6">Resumen</h4>
                </div>
                <div class="container-fluid z-depth-2"style="margin-bottom: 4%">
                    <p id="resumenFeria">
                        En el marco de las asignaturas de la carrera de Ingeniería de Sistemas guiadas en el semestre, los estudiantes de la carrera desarrollan proyectos de aula, en los cuales integran sus habilidades y conocimientos adquiridos en las demás asignaturas a lo largo del semestre y de la carrera.
                    </p>
                </div>


            </div>

        </div>

       <?php
       if (isset($_SESSION["admin"])) {
               $ganadores=$controlador->listarGanadoresFeriaControlador();
               $proyectosConEvaluaciones=$controlador->listarProyectosCantidadEvaluacionesControlador();
//               $proyectoRene=$controlador->consultaRene();
               $datos= "";
               $datos2="";
//               $datos3="";
               if ($ganadores) {
                   foreach ($ganadores as $value) {
                   $puesto=$value["puesto"];
                   $titulo=$value["titulo"];
                   $total=$value["total"];
                   $evaluadores=$value["evaluadores"];
                   $integrantes=$value["integrantes"];
                   $numI=$value["numintegrantes"];
                   $datos.="<tr><td>$puesto</td><td>$titulo</td><td>$total</td><td>$evaluadores</td><td>$integrantes</td><td>$numI</td></tr>";
               } 
               }
               if ($proyectosConEvaluaciones) {
                    foreach ($proyectosConEvaluaciones as $value) {
                   $titulo=$value["titulo"];
                   $cantidad=$value["evaluado"];
                   $datos2.="<tr><td> <a href='LProyecto=30'>$titulo</a></td><td>$cantidad</td></tr>";
               }
               }
//               if ($proyectoRene) {
//                   foreach ($proyectoRene as $value){
//                   $linea= $value["nombre"];
//                   $titulo= $value["titulo"];
//                   $evaluador= $value["nombreevaluador"];
//                   $integrantes= $value["integrantes"];
//                   $num= $value["num"];
//                   $horario= $value["horario"];
//                   $datos3.="<tr><td>$linea</td><td>$titulo</td><td>$evaluador</td><td>$integrantes</td><td>$num</td><td>$horario</td></tr>";
//               }
//               }
               
           $tablas= ' <div class="col-md-12 z-depth-2"style="margin-top: 4%;padding-bottom: 2%">
            <div class="headline">
                <h4>Puestos</h4>
            </div>
            
            <table class="table-bordered grey lighten-4" >                
                <thead>
                    <tr id="">      
                        <th>Puesto</th>
                <th>Titulo</th>
                <th>Total</th>
                <th>Cantidad Evaluaciones</th>
                <th>Integrantes</th>
                <th>Cantidad Integrantes</th>
                    </tr>
                </thead>                
                <tbody id="">
                '.$datos.'
                
                </tbody>
            </table>
        </div>
        <div class="col-md-12 z-depth-2"style="margin-top: 4%;padding-bottom: 2%">
            <div class="headline">
                <h4>Listado de proyectos</h4>
            </div>
            
            <table class="table-bordered grey lighten-4" >                
                <thead>
                    <tr id="">                        
                <th>Titulo</th>
                <th>Cantidad de calificaciones Ingresadas</th>
                    </tr>
                </thead>                
                <tbody id="">'.$datos2.'
                </tbody>
            </table>
            
            
        </div>
 ';
           /*
           $a='
        <div class="col-md-12 z-depth-2"style="margin-top: 4%;padding-bottom: 2%">
            <div class="headline">
                <h4>Listado</h4>
            </div>
            
            <table class="table-bordered grey lighten-4" >                
                <thead>
                    <tr id="">                        
                <th>Linea</th>
                <th>Titulo</th>
                <th>Evaluador</th>
                <th>Integrantes</th>
                <th>Num</th>
                <th>Honario</th>
                    </tr>
                </thead>                
               <tbody id="">'.$datos3.'
                </tbody>
            </table>
            
            
        </div>
        ';*/
           echo $tablas;
       }
       ?>
        
        
        
        
        <div class="col-md-7 z-depth-2"style="margin-top: 4%;padding-bottom: 2%">
            <div class="headline">
                <h4>Criterio de evaluacion</h4>
            </div>
            
            <table class="table-bordered grey lighten-4" >                
                <thead>
                    <tr id="cabeceraCriteriosFeria">                        
                <th>Criterio</th>
                <th>Valoracion</th>
                    </tr>
                </thead>
                
                <tbody id="tablaCriterios">
                </tbody>
            </table>
            
            
        </div>
        
        
    </div>

</div>