<?php

if (!isset($_GET["id"])) {
    header("location:Inicio");
}
$_SESSION["idFeria"]=$_GET["id"];
$controlador=new Controlador();
$exito=$controlador->mostrarFeriaIdControlador();

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

        <div class="col-md-7 z-depth-2"style="margin-top: 4%;padding-bottom: 2%">
            <div class="headline">
                <h4>Criterio de evaluacion</h4>
            </div>
            
            <table class="table-bordered grey lighten-5" >                
                <thead>
                    <tr>
                        
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