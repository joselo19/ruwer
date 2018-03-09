<!-- page content -->
    <div class="right_col" role="main">
        <div class="row">

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



            <!--tabla de las Noticias-->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <!--Cabecera de la Tabla-->
                                <div class="x_title">
                                    <h2>Noticia/s Buscada/s<small></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            <!--/Cabecera de la Tabla-->
                            
                            <div class="x_content">
                                <div class="table-responsive">
                                    <table class="table table-bordered jambo_table">
                                        <!--Cabecera de la Tabla-->
                                            <thead>
                                                <tr>
                                                    <th class="text-center">N°</th>
                                                    <th class="text-center">Imagen</th>
                                                    <th class="text-center">Noticia</th>
                                                    <th class="text-center">F. de Publicación</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                        <!--/Cabecera de la Tabla-->
                                        
                                        <!--Cuerpo de la Tabla-->
                                            <tbody>
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
                                                                <tr>
                                                                    <th scope="row" class="text-center"><?php echo $contando++;?></th>
                                                                    
                                                                    <td class="text-center">
                                                                        <img src="../imagenes/noticias/<?php echo $mostrar->imagen_noticia;?>" class= "img-thumbnail" width="115" height="115"/>
                                                                    </td>

                                                                    <td class="text-center">
                                                                        <?php echo $mostrar->titulo_noticia; ?>
                                                                    </td>

                                                                    <?php
                                                                        $date = $mostrar->fecha_noticia;
                                                                        $date2 = date_create($date);
                                                                    ?>

                                                                    <td class="text-center">
                                                                        <?php echo date_format($date2, 'd/m/Y');?>
                                                                    </td>


                                                                    <td class="td-actions text-center">
                                                                        <a href="index.php?accion=editar-noticia&id=<?php echo $mostrar->id_noticia;?>" class="btn btn-small btn-success" title = "Click para Editar">
                                                                            <i class="glyphicon glyphicon-pencil"> </i>
                                                                        </a>

                                                                        <a href="#ver-registro<?php echo $mostrar->id_noticia;?>" class="btn btn-small btn-info" data-toggle="modal" title = " Click para Visualizar">
                                                                            <i class="glyphicon glyphicon-eye-open"> </i>
                                                                        </a>
                                                                                                                                                                                                   
                                                                    </td> 
                                                                </tr>

                                                                <!-- Ver Registro-->
                                                                    <div class="modal fade" id="ver-registro<?php echo $mostrar->id_noticia;?>">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <!-- Header de la Ventana -->
                                                                                    <div class="modal-header text-center">
                                                                                        <h1 class="modal-title text-center">Visualizando</h1>
                                                                                    </div>
                                                                                <!-- /Header de la Ventana -->
                                                                                                   
                                                                                <!-- Contenido de la Ventana -->
                                                                                    <div class="modal-body text-justify">

                                                                                        <?php 
                                                                                            $id_actual =  $mostrar->id_noticia;
                                                                                            
                                                                                        ?>
                                                                                        <h4>
                                                                                            <strong>Imagen:</strong>
                                                                                        </h4>
                                                                                                                
                                                                                        <br>
                                                                                        <br>
                                                                                                           
                                                                                        <div class="text-center">
                                                                                            <img src="../imagenes/noticias/<?php echo $mostrar->imagen_noticia;?>" class= "img-thumbnail" width="170"/>
                                                                                        </div>

                                                                                        <br>
                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Titulo:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php echo $mostrar->titulo_noticia;?>
                                                                                        </div>

                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Fecha de Publicación:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php
                                                                                                $date = $mostrar->fecha_noticia;
                                                                                                $date2 = date_create($date);
                                                                                                echo date_format($date2, 'd/m/Y');
                                                                                            ?>
                                                                                        </div>

                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Descripción de la Noticia:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php 
                                                                                                echo $mostrar->descripcion_noticia;
                                                                                            ?>
                                                                                        </div>

                                                                                        <br>
                                                                                    </div>
                                                                                <!-- /Contenido de la Ventana -->
                                                                                
                                                                                <!-- Footer de la Ventana -->
                                                                                    <div class="modal-footer">
                                                                                        <div class="text-center"> 
                                                                                            <button href="" type="button" class="btn btn-danger" data-dismiss="modal" title = "Cerrar">
                                                                                                <i class="fa fa-remove"></i>
                                                                                                <span> Cerrar</span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                <!-- /Footer de la Ventana -->
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                <!--/Ver Registro-->
                                                                
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
                                            </tbody>
                                        <!--/Cuerpo de la Tabla-->

                                    </table> 
                                </div>

                                
                                        <!--Botones Maximizados-->                                      
                                            <div class="text-center hidden-xs">
                                                <a href="javascript:history.back()" class="btn btn-primary" data-toggle="modal" title = "Volver">
                                                    <i class="glyphicon glyphicon-arrow-left"></i>
                                                    <span> Volver</span>
                                                </a>
                                            </div>

                                        <!--Botones Minimizados-->
                                            <div class="text-center visible-xs">
                                                <a href="javascript:history.back()" class="btn btn-primary" data-toggle="modal" title = "Volver">
                                                    <i class="glyphicon glyphicon-arrow-left"></i>
                                                </a>
                                            </div>  
                            </div>
                        </div>
                    </div> 
                </div> 
            <!--/tabla de las Noticias-->
        </div>
    </div>
<!-- /page content -->