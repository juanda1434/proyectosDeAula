<?php
if (!isset($_SESSION["perfil"])) {
    header("location:Inicio");
}

?>
<div class="container">
    <div class="row" >


        <div class="headline black">
        </div>
        <h3 class="text-center  black-text">Lista de proyectos registrados</h3>
        <div class="headline black">
        </div>

        <div class="col-md-12 z-depth-1" style="margin-bottom: 3%;padding-bottom: 3%">
            <table class='footable table-striped ' data-paging='true' data-sorting='true' data-filtering='true'>

                <thead>
                    <tr id="cabeceraMisProyectos">
                        <th >
                            Titulo proyecto                        
                        </th>
                        <th data-breakpoints="xs">
                            Estado proyecto                        
                        </th>
                        <th data-breakpoints="xs">
                            Linea Investigacion                        
                        </th>
                        <th>
                            Titulo Feria
                        </th>
                        <th>
                            Fecha realizacion
                        </th>
                        <th>
                         Lider Proyecto   
                        </th>
                        <th data-breakpoints="xs">
                            Acciones
                        </th>
                    </tr>

                </thead>
                <tbody id="misProyectos" >
                    <tr data-expanded='true'>
                        <td>
                            ferias proyectos de aula
                        </td>
                        <td>
                            Inscrito
                        </td>
                        <td>
                            Ingenieria de software
                        </td>
                        <td>
                            Feria proyectos de aula Ingenieria de sistemas
                        </td>
                        <td>
                            <a href="Feria=1" class="btn btn-warning">Informacion Feria</a>
                            <a href="Proyecto=1" class="btn btn-primary">Mas informacion</a>                        
                            <a class="btn btn-danger" id="btnEliminarProyecto">Eliminar</a>
                        </td>
                    </tr>

                </tbody>



            </table>

        </div>
    </div>


</div>
