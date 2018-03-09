<div class="col-md-12  col-sm-12 col-xs-12">
    
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-desktop"></i> 
                    Redes Sociales<small></small>
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
                    $select = "SELECT * from redesSociales";
                            
                    try{
                        $result = $conexion->prepare($select); 
                        $result->execute();
                        $contar = $result->rowCount();
                                                  
                        if($contar>0){
                            while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                $url_facebook  = $mostrar->url_facebook; 
                                $url_instagram = $mostrar->url_instagram;
                                $url_twitter  = $mostrar->url_twitter;
                                $url_youtube  = $mostrar->url_youtube;
                            }       
                        }else{
                            echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Aviso!</strong> No existen Redes Sociales registradas.
                                </div>';
                        }
                                                  
                    }catch(PDOException $e){
                                      echo $e;
                    } 
                ?>

                <!-- Iconos Visibles-->
                    <div class="text-center hidden-xs">
                            <?php 
                            if (!empty($url_facebook)){
                                            ?>
                                     <a href="<?php  echo $url_facebook;?>" class="btn btn-primary" title = "Facebook" target="_blank">
                                        <i class="fa fa-facebook-square"></i>
                                        <span> Facebook</span>
                                    </a>
                            <?php
                                }
                                           
                                if (!empty($url_twitter)){
                            ?>
                                     <a href="<?php  echo $url_twitter;?>" class="btn btn-info" title = "Twitter" target="_blank">
                                        <i class="fa fa-twitter-square"></i>
                                        <span> Twitter</span>
                                    </a>
                            <?php
                                }
                                           
                                if (!empty($url_instagram)){ 
                            ?>
                                    <a href="<?php  echo $url_instagram;?>" class="btn btn-warning " title = "Instagram" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                        <span> Instagram</span>
                                    </a>
                            <?php 
                                                }
                                           
                                if (!empty($url_youtube)){  

                            ?>
                                    <a href="<?php  echo $url_youtube;?>" class="btn btn-danger" title = "Youtube" target="_blank">
                                        <i class="fa fa-youtube-play"></i>
                                        <span> Youtube</span>
                                    </a>
                            <?php 
                                }
                            ?>
                    </div>
                <!-- /Iconos Visibles-->
                        
                <!-- Iconos Visibles XS-->
                    <div class="text-center visible-xs">
                            <?php 
                                if (!empty($url_facebook)){
                            ?>
                                    <a href="<?php  echo $url_facebook;?>" class="btn btn-primary" title = "Facebook" target="_blank">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                            <?php
                                }
                                           
                                if (!empty($url_twitter)){
                            ?>
                                    <a href="<?php  echo $url_twitter;?>" class="btn btn-info" title = "Twitter" target="_blank">
                                        <i class="fa fa-twitter-square"></i>
                                    </a>
                            <?php
                                }
                                           
                                if (!empty($url_instagram)){ 
                            ?>
                                    <a href="<?php  echo $url_instagram;?>" class="btn btn-warning " title = "Instagram" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                            <?php 
                                }
                                           
                                if (!empty($url_youtube)){  

                            ?>
                                    <a href="<?php  echo $url_youtube;?>" class="btn btn-danger" title = "Youtube" target="_blank">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                            <?php 
                                }
                            ?>
                    </div>
                <!-- /Iconos Visibles XS-->
            </div>
        </div>
   
</div>