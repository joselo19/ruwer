
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <i class="fa fa-globe"></i> 
                Últimas Noticias<small></small>
            </h2>
                            
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
                            
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <ul class="list-unstyled msg_list">
                <?php 
                    $sql = "SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT 5";

                    try{
                        $resultado = $conexion->prepare($sql);
                        $resultado->execute();
                        $contar = $resultado->rowCount();

                                                                                
                        if($contar > 0 ){
                            while($mostrar = $resultado->fetch(PDO::FETCH_OBJ)){                         
                ?>

                                <li>
                                    <a href="?accion=ver-noticia&id=<?php echo $mostrar->id_noticia;?>">
                                        <span class="image">
                                             <img src="admin/imagenes/noticias/<?php echo $mostrar->imagen_noticia;?>" alt="img" />
                                        </span>
                                                                
                                        <span>
                                            <strong><?php echo $mostrar->titulo_noticia;?></strong>

                                            <?php
                                                $date = $mostrar->fecha_noticia;
                                                $date2 = date_create($date);
                                            ?>
                                            <span class="time"><?php echo date_format($date2, 'd/m/Y');?></span>
                                        </span>
                                                                
                                        <span class="message">
                                            <!-- Espacio libre-->
                                        </span>
                                    </a>
                                </li>
                <?php                            
                            }//while color:#021C64;
                        }
                        else{
                            echo '<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Aviso!</strong> No existen ninguna Noticia Registrada.
                                    </div>';
                        }
                    }catch(PDOException $erro){ 
                            echo $erro;
                    }
                ?> 
            </ul>
        </div>
    </div>
