<?php
$controlador = new Controlador();
if (!(isset($_GET["proyecto"], $_GET["feria"], $_SESSION["perfil"]) && $_SESSION["perfil"]["tipo"] == "Evaluador")) {
header("Location:Inicio");
} else {
    $_SESSION["calificar"] = array("idProyecto" => (int)$_GET["proyecto"], "idFeria" => (int)$_GET["feria"]);
   $ok= $controlador->validarProyectoEvaluadorControlador();
   if (!$ok) {
       header("Location:Inicio");
   }
}
?>

<div class="container" style="margin-bottom: 2%">
    <div class="row">
        
        
        <div class="col-md-12 z-depth-2"style="margin-top: 4%;padding-bottom: 2%">
            <div class="headline">
                <h4>Criterio de evaluacion</h4>
            </div>
            
            
            <table id="criteriosEvaluar" class="table-bordered grey lighten-5" >                
                <thead>
                    <tr>
                        
                        <th class="col-lg-4" id="titulototal" >Criterio</th>
                        <th class="col-lg-1"  >Valoracion</th>
                        <th class="col-lg-2" >Nota</th>
                        <th class="" >Observacion</th>
                    </tr>
                </thead>
                
                <tbody id="tablaCriterios" >
                </tbody>
            </table>
            
            <a class="btn btn-primary" id="btnEnviarCalificacion" style="margin-bottom:1%;margin-top: 2%">Enviar calificacion</a>
        </div>

        

    </div>
</div>
