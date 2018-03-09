<!-- Menu Vertical-->
    <?php 
        //par activar los menus
        if(isset($_GET['accion'])){ 
            $accion = $_GET['accion'];
        }
        else{
            $accion ='home';
        }
    ?>    

    <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="index.php?accion=welcome" class="site_title">
                    <i class="fa fa-institution"></i> 
                    <span>RUWER</span>
                </a>
            </div>
            
            <!-- Info Nombre y Logo -->
                <?php 
                    $select = "SELECT * from empresa";
                                                                                                                             
                    try{
                        $result = $conexion->prepare($select);     
                        $result->execute();
                        $contar = $result->rowCount();
                                                                                                      
                         if($contar>0){
                            while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                ?>
                                <div class="clearfix"></div>
                            
                                <div class="profile">
                                    <div class="profile_pic">
                                        <img src="../imagenes/empresa/img_logo/<?php echo $mostrar->imagen_empresa;?>" alt="..." class="img-circle profile_img" >
                                    </div>
                                    <div class="profile_info text-center">
                                        <h2 style="line-height: 24px;"><?php echo $mostrar->nombre_empresa;?></h2>
                                    </div>
                                </div>
                <?php 
                            }// fin del while
                        }//fin del if
                                                                         
                    }catch (PDOWException $erro){ 
                        echo $erro;
                    }   
                ?>  
            <!-- /Info Nombre y Logo -->
                

                <br />

                <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            
                            <ul class="nav side-menu">
                                <!-- Pagina Inicio -->
                                    <li class="<?php if($accion =="welcome" || ($accion =="home")){echo 'active"';}?>">
                                        <a href="index.php?accion=welcome">
                                            <i class="fa fa-th-large"></i> 
                                            <span> Inicio</span>
                                        </a>
                                    </li>
                                <!-- /Pagina Inicio-->


                                <!-- Pagina Empresa -->
                                    <li class="<?php  if ($accion == "informacion" || ($accion =="editar-informacion")
                                                      || ($accion == "redes-sociales")
                                                      || ($accion == "video") || ($accion =="nuevo-video") || ($accion =="editar-video")
                                                      || ($accion == "equipo") || ($accion =="nuevo-equipo") || ($accion =="editar-equipo")) 
                                                    { echo "active";}?>"
                                    >
                                        <a>
                                            <i class="fa fa-home"></i> 
                                            Empresa
                                            <span class="fa fa-chevron-down"></span>
                                        </a>
                                        <ul class="nav child_menu"  style="display: <?php  if ($accion == "informacion" || ($accion =="editar-informacion") 
                                                      || ($accion == "redes-sociales") 
                                                      || ($accion == "video") || ($accion =="nuevo-video") || ($accion =="editar-video")
                                                      || ($accion == "equipo") || ($accion =="nuevo-equipo") || ($accion =="editar-equipo")) 
                                                    { echo "block";}?>"
                                        >

                                            <li class="<?php if($accion == "informacion"  || ($accion =="editar-informacion"))
                                                        {echo "current-page";} ?>">
                                                <a href="index.php?accion=informacion">Información</a>
                                            </li>


                                            <li class="<?php if($accion == "redes-sociales")
                                                        {echo "current-page";} ?>">
                                                <a href="index.php?accion=redes-sociales">Redes Sociales</a>
                                            </li>

                                            <li class="<?php if($accion == "video-web" || ($accion =="nuevo-video") || ($accion =="editar-video"))
                                                        {echo "current-page";} ?>">
                                                <a href="index.php?accion=video">Video</a>
                                            </li>


                                            <li class="<?php if($accion == "equipo" || ($accion =="nuevo-equipo") || ($accion =="editar-equipo"))
                                                        {echo "current-page";} ?>">
                                                <a href="index.php?accion=equipo">Equipo de Trabajo</a>
                                            </li>
                                        </ul>
                                    </li>
                                <!-- /Pagina Empresa -->
                              
                                <!-- Paginas Archivo PDF y Noticias -->
                                    <!-- ***************** Opcion visible para los usuarios Nivel 1 y 2 *****************-->
                                    <?php 
                                        if(($nivelLogueado==1) || ($nivelLogueado==2)) {
                                    ?>

                                            <li class="<?php if($accion =="pdf" || ($accion =="nuevo-pdf") || ($accion =="editar-pdf") 
                                                                     || ($accion =="busca-pdf")){echo "active";}?> dropdown">
                                                        
                                                <a  href="index.php?accion=pdf">
                                                    <i class="fa fa-file-pdf-o"></i> 
                                                    Archivos PDF     
                                                </a>
                                            </li> 

                                            <li class="<?php if($accion =="lista-noticias" || ($accion =="nueva-noticia") || ($accion =="editar-noticia") )
                                                                {echo "active";}?> dropdown">
                                                
                                                <a  href="index.php?accion=lista-noticias">
                                                    <i class="fa fa-globe"></i> 
                                                    Noticias 
                                                </a>
                                            </li>
                                    <?php 
                                        }
                                    ?>
                                <!-- /Pagina Noticias -->
                                     

                                <!-- Pagina Contacto -->
                                    <li class="<?php  if ($accion =="editar-contacto") 
                                                    { echo "active";}?>">
                                        <a  href="index.php?accion=editar-contacto">
                                            <i class="fa fa-envelope"></i> 
                                            Contacto 
                                        </a>
                                    </li>
                                <!-- /Pagina Contacto -->


                                <!-- Pagina Usuarios -->
                                    <!-- ***************** Opcion visible para los usuarios Nivel 1 y 2 *****************-->
                                    <?php 
                                        if($nivelLogueado==1){
                                    ?>
                                            <li class="<?php  if ($accion == "lista-usuarios" || ($accion =="nuevo-usuario") || ($accion =="editar-usuario")) 
                                                            { echo "active";}?>">
                                                <a  href="index.php?accion=lista-usuarios">
                                                    <i class="fa fa-users"></i> 
                                                    Usuarios 
                                                </a>
                                            </li>
                                    <?php 
                                        }
                                    ?>
                                <!-- /Pagina Usuarios -->
                            </ul>
                        </div>    
                    </div>
                <!-- /sidebar menu -->
        </div>
    </div>
<!-- /Menu Vertical -->