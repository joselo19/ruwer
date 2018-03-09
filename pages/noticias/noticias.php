<!-- page content -->
    <div class="right_col" role="main">
        <!--Iniciando Paginacion-->
            <?php
                $cantidad_fichero = 2; //cantidad de ficheros por pag
                $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

                $inicio = ($pagina - 1) * $cantidad_fichero;
                $sql_total = "SELECT * from noticias";

                $resultado = $conexion->prepare($sql_total);
                $resultado->execute(array());
                                        
                //total de registros de la consulta
                $num_filas = $resultado->rowCount();

                //redondea a un numero entero
                //division de la paginas para los registros 
                $total_paginas = ceil($num_filas / $cantidad_fichero);

                if ($num_filas == 0) {
                                            
                    //*****************

                } else {
                    if(($pagina > $total_paginas) || ($pagina <= 0)){
                        echo    '<script language= "JavaScript">
                                        location.href="index.php?accion=noticias";
                                </script>';
                    }  
                }
            ?>
        <!--/Iniciando Paginacion-->

        <!-- Mensaje de la Página-->            
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="bs-example" data-example-id="simple-jumbotron">
                                <div class="jumbotron" style=" background: #2A3F54; color: white;">
                                    <h1 class="text-center">Noticias</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Mensaje de la Página-->


        <!-- Busqueda de Noticias-->
            <div class="page-title">
                    <div class="title_left">
                      <h3></h3>
                    </div>

                    <div class="title_right">
                        <form method="post" action="index.php?accion=busca-noticia">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <div class="form-group">
                                        <input type="text" name="busqueda" class="form-control" placeholder="Título de la Noticia" required>
                                    </div>
                                        
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary" title = "Buscar">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
                <div class="clearfix"></div>
        <!--/Busqueda de Noticias--> 



        <?php
                                    
            $sql = "SELECT * from noticias ORDER BY id_noticia DESC LIMIT $inicio, $cantidad_fichero";
                                                        
            try{
                $resultado = $conexion->prepare($sql);
                                   
                $resultado->execute();
                $contar = $resultado->rowCount();
                                                            
                if($contar > 0){
                    while($mostrar = $resultado->fetch(PDO::FETCH_OBJ)){
        ?>
                        <div class="">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>
                                            <i class="fa fa-calendar"></i> 
                                            <?php
                                                $date = $mostrar->fecha_noticia;
                                                $date2 = date_create($date);
                                            ?>
                                            <?php echo date_format($date2, 'd/m/Y');?><small></small>
                                        </h2>
                                        
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li>
                                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                
                                    <div class="x_content">
                                        <div class="row">
                                            
                                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                                <div class="profile_img">
                                                    <div id="crop-avatar">
                                                        <!-- Current avatar -->
                                                        <img class="img-responsive avatar-view img-thumbnail" src="admin/imagenes/noticias/<?php echo $mostrar->imagen_noticia;?>" alt="<?php echo $mostrar->imagen_noticia;?>" title="<?php echo $mostrar->imagen_noticia;?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <h3><strong> <?php echo $mostrar->titulo_noticia?></strong></h3>
                                            </div>

                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="profile_title">
                                                    <div class="col-md-12 text-justify">
                                                        <?php echo limitarTexto($mostrar->descripcion_noticia, $limite=650)?>

                                                        <div class="text-center hidden-xs">
                                                            <a href="?accion=ver-noticia&id=<?php echo $mostrar->id_noticia;?>" class="btn btn-small btn-success btn-xs" data-toggle="modal" title = " Click para Visualizar">
                                                                <i class="glyphicon glyphicon-eye-open"> </i>
                                                                <span>Visualizar</span>
                                                            </a>
                                                        </div>

                                                        <div class="text-center visible-xs">
                                                            <a href="?accion=ver-noticia&id=<?php echo $mostrar->id_noticia;?>" class="btn btn-small btn-success btn-xs" data-toggle="modal" title = " Click para Visualizar">
                                                                <i class="glyphicon glyphicon-eye-open"> </i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                 </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

        <?php
                    }//while
                                                        
                }else{
                    echo '<div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Aviso!</strong> No existe ninguna Infraestructura Universitraia Registrada.
                            </div>';
                }

            }catch(PDOException $erro){ 
                echo $erro;
            }
        ?> 

        <!-- Paginacion Informe-->
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="text-center">
                        <?php    
                            echo "Mostrando la página <strong>" . $pagina . "</strong>  de <strong>" . $total_paginas . "</strong><br>";
                        ?>
                    </div>
                </div>
            </div>
        <!--/ Paginacion Informe-->

        <!-- Paginacion-->
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <style>  
                        .paginas a:hover{background:#00BA8B; color:black;}
                                            
                        /*para que el boton con el cual se encuentre se quede activo*/
                        <?php
                            if(isset($_GET['pagina'])){
                                $num_pg = $_GET['pagina'];  
                            }else{
                                $num_pg = 1;
                            }
                        ?>

                        .paginas a.activo<?php echo $num_pg;?>
                        {
                            background:rgb(208,228,247);                                      
                        }

                        .color{
                            color: #00BA8B;
                        }
                    </style>

                    <?php
                        //Verificar a pagina anterior e posterior
                        $pagina_anterior = $pagina - 1;
                        $pagina_posterior = $pagina + 1;

                        $links = 2;

                        if(isset($i)){
                            //******
                        }
                        else{
                            $i = '1';
                    }
                                        ?>
                                           
                    <?php 
                        if ($contar > 0) {  
                    ?>
                            <nav class="text-center">
                                <ul class="pagination pagination-sm paginas">
                                    <li>
                                        <a href="index.php?accion=noticias&pagina=1">Inicio</a>

                                            <?php
                                                if($pagina_anterior != 0){ 
                                            ?>
                                                    <a href="index.php?accion=noticias&pagina=<?php echo $pagina_anterior; ?>" class="activo">
                                                        <span aria-hidden="" class="color">&laquo;</span>
                                                    </a>     
                                            <?php
                                                }
                                                else{              
                                            ?>
                                                    <span aria-hidden="" class="color">&laquo;</span>

                                            <?php
                                                }           
                                                    if(isset($_GET['pagina'])){
                                                        $num_pg = $_GET['pagina'];  
                                                    }
                                                                                        
                                                    for($i = $pagina- $links; $i <= $pagina- 1; $i++){
                                                        if($i<=0){
                                                            //*****
                                                        }
                                                        else{ 
                                            ?>
                                                            <a href="index.php?accion=noticias&pagina=<?php echo $i;?>"  class="activo<?php echo $i;?>"><?php echo $i;?></a>
                                            <?php
                                                        }//fin del else $i<=0
                                                    }//fin del for $i = $pagina- $links; $i <= $pagina- 1; $i++
                                            ?>  
                                    </li>
                                                            
                                    <li>
                                        <a href="index.php?accion=noticias&pagina=<?php echo $pagina;?>" class="activo<?php echo $i;?>"><?php echo $pagina;?></a>

                                        <?php
                                            for($i = $pagina+1; $i <= $pagina+$links; $i++){
                                                if($i > $total_paginas){
                                                    //******
                                                }
                                                else{
                                        ?>
                                                    <a href="index.php?accion=noticias&pagina=<?php echo $i;?>" class="activo<?php echo $i;?>"><?php echo $i;?></a>        
                                        <?php
                                                }//fin del else $i > $paginas
                                            }//fin del $i = $pagina+1; $i <= $pagina+$links; $i++
                                        ?>

                                        <?php
                                            if($pagina_posterior <= $total_paginas){ 
                                        ?>
                                                <a href="index.php?accion=noticias&pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                                                    <span aria-hidden="" class="color">&raquo;</span>
                                                </a>
                                        <?php 
                                            }else{ 
                                        ?>
                                                <span aria-hidden="true" class="color">&raquo;</span>
                                        <?php 
                                            }  
                                        ?>
                                            <a href="index.php?accion=noticias&pagina=<?php echo $total_paginas;?>">Final</a>    
                                    </li>
                                </ul>
                            </nav>
                    <?php 
                        } // finb de ($contar > 0)
                    ?>
                </div>
            </div>
        <!-- /Paginacion-->                          
    </div>
<!-- /page content -->