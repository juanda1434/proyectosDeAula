<?php
if (!isset($_SESSION["perfil"])) {
    header("location:Ingresar");
} else if (!isset($_GET["id"]) || $_SESSION["perfil"]["tipo"]!="Estudiante") {
    header("location:Inicio");
} else {
    $controlador = new Controlador();
    if (!$controlador->validarFeriaControlador($_GET["id"])) {
        header("location:Inicio");
    }
}
?>

<div class="container contenedor" >

    <div class="row ">
        <div class="form-group col-md-12">
            <h2 class=""><strong>INSCRIPCION DE PROYECTO</strong></h2>
        </div>
        <form class="form-horizontal" id="formRegistrarProyecto">  

            <div class="col-md-5 z-depth-5" > 

                <div class="form-group">
                    <h4 class="col-md-6">Informacion</h4>
                </div>
                <div class="form-group">
                    <div class="col-md-12 ">
                        <label class=" "  for="nombreP">Titulo proyecto</label>        
                        <input  name="nombreP" type="text" id="nombreP" class="form-control" required="true" maxlength="30" >
                        <label id="error-nombreP"></label>
                    </div>
                </div>

                <div class="form-group" >
                    <div class="col-md-12">
                        <label class="" for="resumenP">Resumen</label>

                        <textarea name="resumenP" rows="5" id="resumenP"  class="form-control" ></textarea>
                        <label id="error-resumenP"></label>
                    </div>
                </div>


                <div class="form-group" >
                    <div class="col-md-2 " style="margin-bottom: 3%"> 
                        <button class="btn btn-primary" type="submit">Aceptar</button>  
                    </div>
                </div> 
            </div>

            <div class="col-md-4 col-md-push-1 z-depth-5"  >
                <div class="form-group">
                    <h5 class="col-md-12">Linea de investigacion</h5>
                </div>

                <div class="form-group linea col-md-12 lineas">
                    <label>Linea Investigacion</label>

                </div>




                <div class="form-group col-md-6 col-sm-6 col-xs-6">

                    <a class="btn btn-primary"  id="mostrarLineaBoton"  >Descripcion</a>
                </div>



            </div>

        </form>    




        <div class="col-md-6 col-md-push-1 z-depth-5" style="margin-top: 3%">
            <div class="form-group">
                <h4 class="col-md-6">Tutoria</h4>
            </div>

            <div class="form-group docentes col-md-12">
                <label>Docente</label>
            </div>


            <div class="form-group asignaturas col-md-12 ">
                <label>Asignatura</label>
                <select>
                    <option></option>
                </select>

            </div>
            <div class="form-group col-md-6" >

                <a class="btn btn-primary" id="btnTutoria" style="margin-bottom: 3%">Confirmar tutoria</a>
            </div>

        </div>

<div class="row z-depth-5 col-md-5" >
        <div class="">
            <h5>Tutoria seleccionada</h5>
            <ul class="list-group" id="listaTutoria">
                <li class="list-group-item list-group-item-warning"></li>
                <li class="list-group-item list-group-item-danger">No ha seleccionado una tutoria</li>
            </ul>

        </div>

    </div>


    </div>

    




</div>



<!-- Modal -->
<div class="modal fade" id="infoLinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoLineaTitulo">Modal title</h4>
            </div>
            <div class="modal-body" id="infoLineaBody">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
