
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <i class="fa fa-video-camera"></i> 
                Video<small></small>
            </h2>
                            
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
                            
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
               <?php 
                    $sql = "SELECT * from video";

                    try{
                        $resultado = $conexion->prepare($sql);
                        $resultado->execute();
                        $contar = $resultado->rowCount();

                                                                                
                        if($contar > 0 ){
                            while($mostrar = $resultado->fetch(PDO::FETCH_OBJ)){
                                $direccion = $mostrar->video_direccion;
                                $img_video = $mostrar->portada_video;                              
                ?>

                                <figure>
                                    <a class="iframe" id="open_video" href="http://www.youtube.com/embed/<?php echo $direccion; ?>" data-fancybox>
                                        <img src="admin/imagenes/empresa/img_video/<?php echo $img_video; ?>" class="img-responsive img-thumbnail" width="100%">
                                    </a>
                                                            
                                    <figcaption class="post-title text-center">
                                        <strong style="">Click en la imágen para ver el video</strong>
                                    </figcaption>
                                </figure>
                <?php                            
                            }//while color:#021C64;
                        }
                        else{
                            echo '<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Aviso!</strong> No existen ninguna Información del Vídeo.
                                    </div>';
                        }
                    }catch(PDOException $erro){ 
                            echo $erro;
                    }
                ?> 
        </div>
    </div>
