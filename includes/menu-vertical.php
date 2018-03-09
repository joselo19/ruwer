<!-- Menu Vertical-->
    <!-- Validacion del $accion-->
        <?php 
            //par activar los menus
            if(isset($_GET['accion'])){ 
                $accion = $_GET['accion'];
            }
            else{
                $accion ='home';
            }
        ?>  
    <!--/Validacion del $accion-->  

    <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
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
                                        <img src="admin/imagenes/empresa/img_logo/<?php echo $mostrar->imagen_empresa;?>" alt="<?php echo  $mostrar->nombre_empresa;?>" class="img-circle profile_img" width = "20" height="60">
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
                
            <br/>

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
                                        <i class="fa fa-home"></i> 
                                        <span> Inicio</span>
                                    </a>
                                </li>
                            <!-- /Pagina Inicio-->


                            <!-- Pagina Archivo PDF -->
                                <li class="<?php if($accion =="pdf"){echo 'active"';}?>">
                                    <a href="index.php?accion=pdf">
                                        <i class="fa fa-file-pdf-o"></i> 
                                        <span> Archivos PDF</span>
                                    </a>
                                </li>
                            <!-- /Pagina Archivo PDF-->


                            <!-- Pagina Noticias -->
                                <li class="<?php if($accion =="noticias"  || ($accion =="ver-noticia")
                                                   || ($accion =="busca-noticia")){echo "active";}?> dropdown">
                                                
                                    <a  href="index.php?accion=noticias">
                                        <i class="fa fa-globe"></i> 
                                        Noticias 
                                    </a>
                                </li>  
                            <!-- /Pagina Noticias -->
                                     
                            <!-- Pagina Contacto -->
                                <li class="<?php  if ($accion == "contacto") 
                                                    { echo "active";}?>">
                                        
                                    <a  href="index.php?accion=contacto">
                                        <i class="fa fa-envelope"></i> 
                                        Contacto 
                                    </a>
                                </li>
                            <!-- /Pagina Contacto -->
                        </ul>
                    </div>    
                </div>
            <!-- /sidebar menu -->
        </div>
    </div>
<!-- /Menu Vertical -->