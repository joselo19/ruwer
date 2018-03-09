<!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <!-- Botón Nuevo Video-->
                <?php 
                    $select = "SELECT * from video";
                                                                                                                             
                    try{
                        $result = $conexion->prepare($select);     
                        $result->execute();
                        $contar = $result->rowCount();
                                                                                                      
                        if($contar<=0){
                ?>
                            <div>
                                <!-- Botón Maximizado-->
                                <div class="row text-center hidden-xs">
                                    <a href="index.php?accion=nuevo-video"  class="btn btn-primary" title = "Nuevo Video">
                                        <i class="fa fa-video-camera"></i>
                                        <span> Nuevo Video</span>
                                    </a>
                                </div>
                                        
                                <!-- Botón Minimizado-->
                                <div class="row text-center visible-xs">
                                    <a href="index.php?accion=nuevo-video"  class="btn btn-primary" title = "Nuevo Video">
                                        <i class="fa fa-video-camera"></i>
                                    </a>
                                </div>
                            </div>
            
                            <br>
                            <br>
                <?php 
                        }//fin del if
                                                                         
                    }catch (PDOWException $erro){ 
                        echo $erro;
                    }   
                ?>  
            <!-- /Botón Nuevo Video-->

            <!--tabla del Video Institucional-->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <!--Cabecera de la Tabla-->
                                <div class="x_title">
                                    <h2>Video Empresarial <small></small></h2>
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

                            <!-- Codigo para eliminar un registro-->
                                <?php
                                    if(isset($_GET['delete'])){
                                        $id_delete = $_GET['delete'];
                                                                                
                                        $seleciona = "SELECT * from video WHERE id_video= :id_delete";

                                        try{
                                            $result = $conexion->prepare($seleciona);    
                                            $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);     
                                            $result->execute();
                                            $contar = $result->rowCount();
                                                                                            
                                            if($contar > 0){
                                                $loop = $result->fetchAll();
                                                                                                
                                                foreach ($loop as $exibir){}
                                                                                                
                                                $fotoDeleta = $exibir['portada_video'];
                                                $arquivo = "../imagenes/empresa/img_video/" . $fotoDeleta;
                                                unlink($arquivo); //elimina la imagen
                                                                                                
                                                // exclui o registo
                                                $seleciona = "DELETE from video WHERE id_video=:id_delete";
                                                try{
                                                    $result = $conexion->prepare($seleciona);
                                                    $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);             
                                                    $result->execute();
                                                    $contar = $result->rowCount();
                                                                                                    
                                                    if($contar>0){
                                                        echo '<div class="alert alert-success">
                                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                                  <strong>Exito!</strong> El Video Empresarial fue eliminado.
                                                              </div>';
                                                    }else{
                                                        echo '<div class="alert alert-danger">
                                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                                  <strong>Error</strong> No fue posible eliminar el Video Empresarial.
                                                              </div>';    
                                                    }
                                                }catch (PDOWException $erro){ 
                                                    echo $erro;
                                                }
                                            }                             
                                        }catch (PDOWException $erro){ 
                                            echo $erro;
                                        }
                                    }// fin del if (isset($_GET['delete'])) 
                                ?>
                            <!-- /Codigo para eliminar un registro-->
                            
                            <div class="x_content">
                                <div class="table-responsive">
                                    <table class="table table-bordered jambo_table">
                                        <!--Cabecera de la Tabla-->
                                            <thead>
                                                <tr>
                                                    <th class="text-center">N°</th>
                                                    <th class="text-center">Portada del Video</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                        <!--/Cabecera de la Tabla-->
                                        
                                        <!--Cuerpo de la Tabla-->
                                            <tbody>
                                                <?php
                                                    $select = "SELECT * from video";
                                                    $contando =1;
                                                            
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
                                                                        <img src="../imagenes/empresa/img_video/<?php echo $mostrar->portada_video;?>" class= "img-thumbnail" width="115"/>
                                                                    </td>
                                                                    
                                                                    <td class="td-actions text-center">
                                                                        <a href="index.php?accion=editar-video&id=<?php echo $mostrar->id_video;?>" class="btn btn-small btn-success" title = "Click para Editar">
                                                                            <i class="glyphicon glyphicon-pencil"> </i>
                                                                        </a>

                                                                        <a href="#ver-registro<?php echo $mostrar->id_video;?>" class="btn btn-small btn-info" data-toggle="modal" title = " Click para Visualizar">
                                                                            <i class="glyphicon glyphicon-eye-open"> </i>
                                                                        </a>
                                                                                                                                                                        
                                                                        <a href="#eliminar-registro<?php echo $mostrar->id_video;?>" class="btn btn-small btn-danger" data-toggle="modal" title = " Click para Eliminar">
                                                                            <i class="glyphicon glyphicon-trash"> </i>
                                                                        </a>                
                                                                    </td>
                                                                </tr>

                                                                <!-- Ver Registro-->
                                                                    <div class="modal fade" id="ver-registro<?php echo $mostrar->id_video;?>">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <!-- Header de la Ventana -->
                                                                                    <div class="modal-header text-center">
                                                                                        <h1 class="modal-title text-center">Visualizando</h1>
                                                                                    </div>
                                                                                <!-- /Header de la Ventana -->
                                                                                                   
                                                                                <!-- Contenido de la Ventana -->
                                                                                    <div class="modal-body text-justify">
                                                                                        <h4>
                                                                                            <strong>Portada del Video:</strong>
                                                                                        </h4>
                                                                                                                
                                                                                        <br>
                                                                                       
                                                                                                           
                                                                                        <div class="text-center">
                                                                                            <img src="../imagenes/empresa/img_video/<?php echo $mostrar->portada_video;?>" class= "img-thumbnail" width="170"/>
                                                                                        </div>

                                                                                        <br>
                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Video Empresarial:</strong>  
                                                                                        </h4>

                                                                                      

                                                                                        <div class="text-justify">
                                                                                            <?php 
                                                                                                $direccion = $mostrar->video_direccion;
                                                                                                $link = "http://www.youtube.com/embed/" . $direccion; 

                                                                                                //echo $link;
                                                                                            ?>

                                                                                            <br>

                                                                                            <div class="text-center">
                                                                                                <iframe
                                                                                                    class="img-thumbnail" 
                                                                                                    src="<?php echo $link; ?>"  
                                                                                                    allowfullscreen>
                                                                                                </iframe>
                                                                                            </div>
                                                                                        </div>
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
                                                                
                                                                <!-- Ventana para Eliminar-->
                                                                    <div class="modal fade" id="eliminar-registro<?php echo $mostrar->id_video;?>">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <!-- Header de la Ventana -->
                                                                                    <div class="modal-header text-center">
                                                                                        <h1 class="modal-title text-center">Eliminar</h1>
                                                                                    </div>
                                                                                <!-- /Header de la Ventana -->
                                                                                                   
                                                                                <!-- Contenido de la Ventana -->
                                                                                    <div class="modal-body text-justify">
                                                                                        <p>
                                                                                            <strong><?php echo $usuarioLogueado;?></strong>.. 
                                                                                            Quieres <strong>ELIMINAR</strong> el Video Empresarial?:
                                                                                        </p>

                                                                                        <br>

                                                                                        <div class="text-center">
                                                                                            <img src="../imagenes/empresa/img_video/<?php echo $mostrar->portada_video;?>" class= "img-thumbnail" width="170"/>
                                                                                        </div>
                                                                                    </div>
                                                                                <!-- /Contenido de la Ventana -->

                                                                                <!-- Footer de la Ventana -->
                                                                                    <div class="modal-footer">
                                                                                        <div class="text-center"> 
                                                                                            <button href="" type="button" class="btn btn-primary" data-dismiss="modal" title = "No">
                                                                                                <i class="fa fa-thumbs-down"></i>
                                                                                                <span> No</span>
                                                                                            </button>
                                                                                          
                                                                                            <a href="index.php?accion=video&delete=<?php echo $mostrar->id_video;?>" class="btn btn-danger" title="Si">
                                                                                                <i class="fa fa-thumbs-up"></i>
                                                                                                <span> Si</span>
                                                                                            </a>  
                                                                                        </div>
                                                                                    </div>
                                                                                <!-- /Footer de la Ventana -->
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                <!-- /Ventana para Eliminar-->
                                                <?php
                                                            }//fin del while
                                                        }//fin del if
                                                        else{
                                                            echo '<div class="alert alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                                        <strong>Aviso!</strong> No existe el Video Empresarial registrado.
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
                            </div>
                        </div>
                    </div> 
                </div> 
            <!--/tabla del Video Institucional-->
        </div>
    </div>
<!-- /page content -->