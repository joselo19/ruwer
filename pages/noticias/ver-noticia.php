<!-- page content -->
    <div class="right_col" role="main">
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
                                    <h1 class="text-center">Noticia</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Mensaje de la Página-->


        <?php
            if(isset($_GET['id'])){
                $idUrl = $_GET['id'];
            }
                                                    
            $sql = "SELECT * from noticias WHERE id_noticia=:id LIMIT 1";
                                                    
            try{
                $resultado = $conexion->prepare($sql);
                $resultado->bindParam('id',$idUrl, PDO::PARAM_INT);
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
                                                        <figure>
                                                            <a href="admin/imagenes/noticias/<?php echo $mostrar->imagen_noticia;?>" data-lightbox="galeria">
                                                                <img class="img-responsive avatar-view img-thumbnail" src="admin/imagenes/noticias/<?php echo $mostrar->imagen_noticia;?>" alt="<?php echo $mostrar->imagen_noticia;?>" title="<?php echo $mostrar->imagen_noticia;?>">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <h3><strong> <?php echo $mostrar->titulo_noticia?></strong></h3>
                                            </div>

                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="profile_title">
                                                    <div class="col-md-12 text-justify">
                                                        <?php echo $mostrar->descripcion_noticia;?>
                                                        <br>

                                                        <div class="text-center hidden-xs">
                                                            <a href="javascript:history.back()" class="btn btn-small btn-danger btn-xs" data-toggle="modal" title = "Volver">
                                                                <i class="fa fa-mail-reply"> </i>
                                                                <span>Volver</span>
                                                            </a>
                                                        </div>

                                                        <div class="text-center visible-xs">
                                                            <a href="javascript:history.back()" class="btn btn-small btn-danger btn-xs" data-toggle="modal" title = "Volver">
                                                                <i class="fa fa-mail-reply"> </i>
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
                                <strong>Aviso!</strong> No existe la Noticia que desea Ver.
                            </div>';
                }

            }catch(PDOException $erro){ 
                echo $erro;
            }
        ?>                         
    </div>
<!-- /page content -->