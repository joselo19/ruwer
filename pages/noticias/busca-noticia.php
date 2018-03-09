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
                                    <h1 class="text-center">Búsqueda</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Mensaje de la Página-->


        <?php
            if(isset($_POST['busqueda'])){
                $busca = addslashes($_POST['busqueda']);
                $sql_total = "SELECT * from noticias WHERE titulo_noticia LIKE '%$busca%'"; 
            }

            $resultado = $conexion->prepare($sql_total);
            $resultado->execute(array());
                                
            //total de registros de la consulta
            $num_filas = $resultado->rowCount();
                                
            //$resultado->closeCursor();
        ?>          

          
        <?php
            if(isset($_POST['busqueda'])){
                $busca = addslashes($_POST['busqueda']);
                $select = "SELECT * from noticias WHERE titulo_noticia LIKE '%$busca%' ORDER BY id_noticia";    
                                                                         
            }
            else{
                $busca = addslashes($_GET['busqueda']);
                $select = "SELECT * from noticias WHERE titulo_noticia LIKE '%$busca%'"; 
            }                            
                                                                                  
            $contando=0;
            $contando =$contando + 1;
                                            
            try{
                $result = $conexion->prepare($select);     
                $result->execute();
                $contar = $result->rowCount();
                                                                                        
                if($contar>0){
                    while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
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
                    }//fin del while
                }//fin del if
                else{
                    echo '<div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Aviso!</strong> No existe la Noticia que está buscando.
                            </div>';
                }//fin del else                                         
            }catch(PDOException $e){
                echo $e;
            }
                                                                      
        ?> 


         <!--Botones Maximizados-->                                      
              <div class="text-center hidden-xs">
                  <a href="javascript:history.back()" class="btn btn-danger" data-toggle="modal" title = "Volver">
                      <i class="glyphicon glyphicon-arrow-left"></i>
                      <span> Volver</span>
                  </a>
              </div>

          <!--Botones Minimizados-->
              <div class="text-center visible-xs">
                  <a href="javascript:history.back()" class="btn btn-danger" data-toggle="modal" title = "Volver">
                      <i class="glyphicon glyphicon-arrow-left"></i>
                  </a>
              </div>  

    </div>
<!-- /page content -->