<?php
$controlador = new Controlador();
if (!(isset($_GET["proyecto"], $_GET["feria"], $_SESSION["perfil"]) && $_SESSION["perfil"]["tipo"] == "Evaluador")) {
header("Location:Inicio");
} else {
    $_SESSION["calificar"] = array("idProyecto" => (int)$_GET["proyecto"], "idFeria" => (int)$_GET["feria"]);
   $ok= $controlador->validarEvaluadorProyectoControlador();
   $_SESSION["idProyecto"]=$_GET["proyecto"];
   $datosProyecto= $controlador->listarProyectoIdControlador();
   $datosProyecto["datosGenerales"][0]["resumen"]; 
   if (!$ok) {
       if (isset($_SESSION["calificar"])) {
           unset($_SESSION["calificar"]);
       }
       if (isset($_SESSION["idProyecto"])) {
           unset($_SESSION["idProyecto"]);
       }
       header("Location:Inicio");
   }else if (!isset ($ok["calificar"]) || $ok["calificar"]!="1") {
       header("Location:Inicio");
   }
}
?>

<div class="container" style="margin-bottom: 2%">
    <div class="row">
        <div class="col-md-12 z-depth-2"style="margin-top: 4%;padding-bottom: 2%">
            <div class="headline">
                <h4>Titulo Proyecto : <?php echo $datosProyecto["datosGenerales"][0]["titulo"];  ?></h4>
            </div>
           
            <div class="headline">
                <h4>Criterio de evaluacion</h4>
            </div>
            
            <table id="criteriosEvaluar" class="table-bordered grey lighten-1" >                
                <thead>
                    <tr>
                        
                        <th class="col-lg-4" id="titulototal" >Criterio</th>
                        <th class="col-lg-1"  >Valoracion</th>
                        <th class="col-lg-2" data-breakpoints="xs">Nota</th>
                        <th class="" data-breakpoints="xs">Observacion</th>
                    </tr>
                </thead>
                
                <tbody id="tablaCriterios" >
                </tbody>
            </table>
            
            <a class="btn btn-danger" id="btnEnviarCalificacion" style="margin-bottom:1%;margin-top: 2%"><span class="glyphicon glyphicon-share"></span> Enviar calificacion</a>
        </div>

        

    </div>
</div>
