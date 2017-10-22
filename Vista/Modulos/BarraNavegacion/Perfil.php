<?php
if (!isset($_SESSION["perfil"])) {
    header("location:Inicio");
}

?>
<div class="container-fluid contenedor sombra" style="margin-top: 3%">
    <div class="row">

        <div class="col-md-8" ><div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h1>Perfil</h1></div>
  

  <!-- Table -->
  <table class="table table-striped table-bordered" id="datosPerfil">
  </table>
</div>
        </div>
    </div>
</div>


