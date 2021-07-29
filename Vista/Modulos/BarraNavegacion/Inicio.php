

   
        <div class ="content-all" >
            <div class ="content-img" id="img1"  >
                <a href="#img3" class="fa fa-arrow-left"></a> 
                <img src="Vista/Public/plantilla/img/b6a80e0720a86a67d366081d27293c4d.jpg">
                <a href="#img2" class="fa fa-arrow-right"></a>  
                <div class="content-details">  
                    <?php
                    echo isset($_SESSION["perfil"])? '<h3>  ! Bienvenido al Sitio Web Feria de Proyectos de Aula !  </h3> <a class="botonn" href="#filtros" >Inscribe proyecto </a>':'<h3>  ! Bienvenido al Sitio Web Feria de Proyectos de Aula !  </h3>
                    <p> Si deseas inscribir tu Proyecto, y saber mas sobre Proyectos de Aula </p>            
                    
                    <a href="Registro"><input type="button" value="Registrate"/> </a>
                    <br>
                    <p>  ó Si ya te has Registrado <u><a href="Ingresar">  Inicia Sesión  </a> </u> </p>';
                    ?>
                    
                </div>
            </div>
            <div class ="content-img" id="img2"  >
                <a href="#img1" class="fa fa-arrow-left"></a> 
                <img src="Vista/Public/plantilla/img/2246d36031da923ba74a3ff8a6daef86.png">
                <a href="#img3" class="fa fa-arrow-right"></a>  
                <div class="content-details">  
                    <h3>  ! Bienvenido al Sitio Web De Ferias de Proyectos de Aula !  </h3>
                    <p> Siguenos en: </p>             
                    <div class="social">
                        <ul>
                        <li><a href="https://www.facebook.com/profile.php?id=100023177731668" target="_blank" class="fa fa-facebook" title ="Facebook"></a></li>
                        <li><a href="https://twitter.com/ProyectosAula" target="_blank" class="fa fa-twitter" title ="Twitter" ></a></li>  
                        <li><a href="https://www.youtube.com/channel/UCgPz-qqaAk4lbHfr0XH3k2g" target="_blank" class="fa fa-youtube" title ="Youtube"></a></li> 
                        <li><a href="https://www.instagram.com/ufpscucuta/" target="_blank" class="fa fa-instagram" title ="Instagram"></a></li>
                        <li><a href="Contacto" class="fa fa-envelope-o" title ="Envianos un correo" ></a></li>
                         </ul>
                    </div>
                </div>
            </div>
            <div class ="content-img" id="img3"  >
                <a href="#img2" class="fa fa-arrow-left"></a> 
                <img src="Vista/Public/plantilla/img/00734e46e47cd9dfcf70b99c4b91bc58.png">
                <a href="#img1" class="fa fa-arrow-right"></a>  
                <div class="content-details">  
                    <h3>  Apoyo  </h3>
                        <div class="apoyo">
                            <ul>
                            <li><a href="http://tksis.com/" target="_blank" id="tksis" >TKSIS</a></li>  
                            <li><a href="https://www.docuxer.com" target="_blank" id="docuxer">DOCUXER</a></li> 
                            <li><a href="http://www.codetein.com/" target="_blank" id="codetein" > CODETEIN</a></li>
                            <li><a href="http://www.paginasamarillas.com.co/empresas/ferroelectricos-san-vicente/cucuta-15427687"id="sanvicente">FERROELECTRICOS SAN VICENTE </a></li>
                            <li><h3>  Interes </h3></li>
                            <li><a href="http://ciinatic2017.ufps.edu.co/wordpress/" target="_blank" id="cinatic">CINATIC 2017</a></li>
                         </ul>
                    </div>
                    
                </div>
                
                
            </div>
        </div>
        <p> <br> <br> <br> 

<br><hr class="style2"><br>

        <a id="filtros"></a>
        
<div class="container-fluid" style="margin-bottom: 3%">
    <div class="row grey lighten-5" >
        <div class="col-md-3" >
                <div class="panel-contenedor">
                    <i class="icon-custom icon-lg rounded-x icon-color-yellow icon-line fa fa-bookmark" style="background: #fff"></i>
                    <div class="panel-cabeza">
                        <h3 style="color: #666; text-align: center;margin-top: 30px;" >Filtro ferias</h3>
                </div>
                    <div class="panel-body">
                        
                        <div style="border-bottom: 3px solid #f1c40f;margin-bottom: 3%;margin-top: 1%"></div>
                            <div class="radio">
                            <label for="radInscripcion"> 
                                <input type="radio" id="radInscripcion" name="filtro" checked="true">Ferias estado de inscripcion activo
                            </label>
                        </div>
                        <div class="radio">
                            <label for="radActiva">
                                <input type="radio" id="radActiva" name="filtro">Ferias activas
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
                        
                        <div style="border-bottom: 3px solid #f1c40f;margin-bottom: 3%;margin-top: 1%"></div>
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
            
        
                <a id="gale"></a>
                <br><hr class="style3">
                
                <div class="fondo">
                
                <div class ="galeria" >
            <div class ="contenedorImagenes" id="im1"  >
                <a href="#im12" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a1.jpg">
                <a href="#im2" class="fa fa-chevron-circle-right"></a>  
            </div>
            <div class ="contenedorImagenes" id="im2"  >
                <a href="#im1" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a2.jpg">
                <a href="#im3" class="fa fa-chevron-circle-right"></a>  
            </div>
            <div class ="contenedorImagenes" id="im3"  >
                <a href="#im2" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a3.jpg">
                <a href="#im4"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im4"  >
                <a href="#im3" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a5.jpg">
                <a href="#im5"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im5"  >
                <a href="#im4" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a6.jpg">
                <a href="#im6"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im6"  >
                <a href="#im5" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a7.jpg">
                <a href="#im7"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im7"  >
                <a href="#im6" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a8.jpg">
                <a href="#im8"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im8"  >
                <a href="#im7" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a9.jpg">
                <a href="#im9"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im9"  >
                <a href="#im8" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a10.jpg">
                <a href="#im10"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im10"  >
                <a href="#im9" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a11.jpg">
                <a href="#im11"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im11"  >
                <a href="#im10" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a12.jpg">
                <a href="#im12"class="fa fa-chevron-circle-right"></a>  
            </div>
                    <div class ="contenedorImagenes" id="im12"  >
                <a href="#im11" class="fa fa-chevron-circle-left" ></a> 
                <img src="Vista/Public/plantilla/img/a4.jpg">
                <a href="#im1"class="fa fa-chevron-circle-right"></a>  
            </div>
        </div>            
                </div>
                
                <br>    
        
        
        
                <hr class="style1" id="novedades" >
            
        <div class ="content-all" id="principal">
            <div id="noticias"> 
                <div > 
                    <i class="icon-custom icon-lg rounded-x icon-color-yellow icon-line fa fa-bookmark" style="background: #fff"></i>
                    <h3><b>Ediciones Anteriores</b></h3>
                    <br>
                    <p> Conoce la programación de las fechas y lugares en donde fueron presentados los proyectos y charlas ofrecidas en el primer semetre de 2017. 
                        <br><br>
                        <b><u><a href="http://ingsistemas.ufps.edu.co/rsc/PROGRAMACI%C3%93N_FERIA_DE_PROYECTOS_.pdf" style="color:#666" target="_blank"> Click aquí </a></u></b></p>
                </div>
                <div> 
                    <i class="icon-custom icon-lg rounded-x icon-color-yellow icon-line fa fa-bookmark" style="background: #fff"></i>
                    <h3><b>Para tener en cuenta</b></h3>
                    <p> <b> Ponencia Modalidad poster para la presentación de los proyectos.</b><br><br>
                        Son presentados por profesionales, profesores y estudiantes, interesados en dar a conocer trabajos en las siguientes etapas de investigación: proyectos en curso o terminados de investigación científica formal o investigación formativa.</p>       
                </div>
                <div> 
                    <i class="icon-custom icon-lg rounded-x icon-color-yellow icon-line fa fa-bookmark" style="background: #fff"></i>
                    <h3><b>Equipo de Trabajo</b></h3><br>
                     <p>
                         <b>  Bases De Datos Grupo A</b><br><br>
                         Juan David Sanchez<br>
                         Alexander Peñaloza<br>
                         Jefersson Peñaranda<br><br>
                         <b><u><a href="http://ingsistemas.ufps.edu.co/" style="color:#666" target="_blank"> Ing Sistemas Ufps </a></u></b>
                     </p>
                </div>
            </div>
        </div>
        
        
        
 