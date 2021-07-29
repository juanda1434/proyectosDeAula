
<div id="menu-principal" class="header-v6 header-white-transparent header-sticky" style="position: relative;">
    <div id="barra-superior" class="header-v8">
        <!-- Topbar blog -->
        <div class="blog-topbar">
            
            <div class="container">
                <div class="row">
                    <div class="col-sm-7 col-xs-7">

                        <div class="topbar-toggler" style="font-size: 10px; color: #eee; letter-spacing: 1px; text-transform: uppercase;"><span class="fa fa-angle-down"></span> PERFILES</div>
                        <ul class="topbar-list topbar-menu">
                            <?php
                            if (isset($_SESSION["perfil"])&&$_SESSION["perfil"]["tipo"]=="Estudiante" && $_SESSION["perfil"]["key"]) {
                                echo '<li>No has validado tu registro. Has click <a id="btnEnviarCorreo" ><strong>AQUI!</strong></a> para enviar un correo de validacion.</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    
                </div><!--/end row-->
            </div><!--/end container-->
        </div>
        <!-- End Topbar blog -->

    </div>


    <div class="header-v8 img-logo-superior" style="background-color: #aa1916;">

        <!--=== Parallax Quote ===-->
        <div class="parallax-quote parallaxBg" style="padding: 30px 30px;">
         
                <div class="parallax-quote-in" style="padding: 0px;">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-5">
                            <a href="#">
                                <img id="logo-header"
                                     src="Vista/Public/plantilla/img/logo_ufps.png" alt="Logo UFPS">
                            </a>
                        </div>
                        <div class="col-md-2 col-ms-1 col-xs-2 pull-right">
                            <a href="http://www.colombia.co/"><img class="header-banner"
                                                                   src="Vista/Public/plantilla/img/escudo_colombia.png"
                                                                   alt="Escudo de Colombia"></a>
                        </div>
                    </div>
                </div>
        </div>
        <!--=== End Parallax Quote ===-->


    </div><!--/end header-v8-->


    <div class="menu-responsive">
        <!-- Logo -->
        <a class="logo logo-responsive" href="index.html">
            <img src="Vista/Public/plantilla/img/horizontal_logo_pequeno.png" alt="Logo">
        </a>  
        <!-- End Logo -->



        <!-- Toggle get grouped for better mobile display -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
        </button>
        <!-- End Toggle -->
    </div>

    <!-- Navbar -->
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
        <div class="container">
            <ul class="nav navbar-nav padd" >
               
                <li class="dropdown">
                    <a href="Inicio" >
                        Inicio <span class="glyphicon glyphicon-home"></span>
                        <ul class="dropdown-menu">
                            <li class="active"><a href="Inicio#filtros">Filtrar Feria</a></li>
                            <li class="active"><a href="Inicio#gale">Galeria</a></li>
                            <li class="active"><a href="Inicio#novedades">Novedades</a></li>
                        </ul>
                    </a>
                
            </li>
            
            <li class="dropdown">
                <a href="Significado" >
                    ¿Que es? <span class="glyphicon glyphicon-info-sign"></span>
                    <ul class="dropdown-menu">
                            <li class="active"><a href="Significado#significado">Significado</a></li>
                            <li class="active"><a href="Significado#historico">Historico</a></li>
                        </ul>
                </a>
                
            </li>
            <li class="dropdown">
                <a href="Importancia">
                    Importancia <span class="glyphicon glyphicon-info-sign"></span>
                    <ul class="dropdown-menu">
                            <li class="active"><a href="Importancia#importancia">Importancia</a></li>
                            <li class="active"><a href="Importancia#ventajas">Ventajas</a></li>
                        </ul>
                </a>
                
            </li>
            <li class="dropdown">
                <a href="Objetivos">
                   Objetivos <span class="glyphicon glyphicon-info-sign"></span>
                       
                </a>
                
            </li>  
            <li class="dropdown">
                <a href="Contacto">
                   Contacto <span class="glyphicon glyphicon-info-sign"></span>
                       
                </a>
                
            </li>
            <?php 
            if (!isset($_SESSION["perfil"])) {
                  echo '<li class="dropdown">
                <a href="Ingresar">
                    Ingresar <span class="glyphicon glyphicon-user"></span>
                </a>
                
            </li>';
                  echo '<li class="dropdown">
                <a href="Registro">
                    Registrate <span class="glyphicon glyphicon-pencil"></span>
                </a>
                
            </li>';
}else{
    $aux=' <li class="dropdown hidden-xs hidden-sm">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        Usuario <span class="glyphicon glyphicon-user"></span>
                    </a>
                    
                    <ul class="dropdown-menu">
                    <li class="active"><a href="Perfil">Perfil</a></li>
                        <li class="active"><a href="MisProyectos">Mis proyectos</a></li>
                        <li class="active"><a href="Salir">Salir</a></li>

</ul> </li> 
<li class="dropdown hidden-md hidden-lg"><a href="Perfil"> Perfil <span class="glyphicon glyphicon-user
"></span></a></li>
<li class="dropdown hidden-md hidden-lg"><a href="MisProyectos">MisProyectos <span class="glyphicon glyphicon-book"></span></a></li>
            <li class="dropdown hidden-md hidden-lg"><a href="Salir"> Salir <span class="glyphicon glyphicon-log-out"></span> </a></li>';
    
    echo $aux;
   
}
            ?>
             

            </ul>
        </div>
    </div><!--/navbar-collapse-->

    <!-- End Navbar -->
</div>
   

