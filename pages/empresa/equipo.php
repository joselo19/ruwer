<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <i class="fa fa-users"></i> 
                Nuestro Equipo<small></small>
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
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <ul class="pagination pagination-split">
                        <?php
                                $cantidad_fichero = 3; //cantidad de ficheros por pag
                                $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

                                $inicio = ($pagina - 1) * $cantidad_fichero;
                                $sql_total = "SELECT * from equipo";


                                $resultado = $conexion->prepare($sql_total);
                                $resultado->execute(array());
                                                            
                                //total de registros de la consulta
                                $num_filas = $resultado->rowCount();

                                //redondea a un numero entero
                                //division de la paginas para los registros 
                                $total_paginas = ceil($num_filas / $cantidad_fichero);

                                if ($num_filas == 0) {
                                                                
                                     //*****************
                                }
                                else {
                                    if(($pagina > $total_paginas) || ($pagina <= 0)){
                                        echo    '<script language= "JavaScript">
                                                        location.href="index.php?accion=welcome";
                                                </script>';
                                    }  
                                }
                        ?>
                    </ul>
                </div>

                <div class="clearfix"></div>

                <?php 
                    $sql = "SELECT * from equipo ORDER BY id_miembro LIMIT $inicio, $cantidad_fichero";

                    try{
                        $resultado = $conexion->prepare($sql);
                        $resultado->execute();
                        $contar = $resultado->rowCount();
                                                            
                        if($contar > 0 ){
                            while($mostrar = $resultado->fetch(PDO::FETCH_OBJ)){
                ?>
                                <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                        <div class="col-sm-12">
                                            <h4 class="brief">
                                                <i><?php echo $mostrar->cargo_miembro;?></i>
                                            </h4>

                                            <div class="left col-xs-7">
                                                <h2> <?php echo $mostrar->nombre_miembro;?> <?php echo $mostrar->apellido_miembro;?></h2>
                                                <p class="text-justify">
                                                    <strong>Biografía: </strong> 
                                                    <?php echo limitarTexto($mostrar->descripcion_miembro, $limite=75)?>. 
                                                </p>
                                            </div>
                                                            
                                            <div class="right col-xs-5 text-center">
                                                <img src="admin/imagenes/empresa/img_equipo/<?php echo $mostrar->imagen_miembro;?>" alt="" class="img-circle img-responsive">
                                            </div>
                                        </div>
                                                      
                                        <div class="col-xs-12 bottom text-center">
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <!-- -->
                                            </div>
                                                            
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <a href="#ver-registro<?php echo $mostrar->id_miembro;?>" data-toggle="modal" class="btn btn-primary btn-xs" title = " Click para Visualizar">
                                                    <i class="fa fa-user"> </i> Visualizar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Ver Registro-->
                                    <div class="modal fade" id="ver-registro<?php echo $mostrar->id_miembro;?>">
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
                                                            <strong>Foto:</strong>
                                                        </h4>
                                                                                                                
                                                        <br>
                                                        <br>
                                                                                                           
                                                        <div class="text-center">
                                                            <img src="admin/imagenes/empresa/img_equipo/<?php echo $mostrar->imagen_miembro;?>" class= "img-thumbnail" width="170"/>
                                                        </div>

                                                        <br>
                                                        <br>

                                                        <h4>
                                                            <strong>Miembro:</strong>  
                                                        </h4>

                                                        <br>

                                                        <div class="text-justify">
                                                                <?php echo $mostrar->nombre_miembro . " " . $mostrar->apellido_miembro; ?>
                                                        </div>

                                                        <br>
                                                        <br>

                                                        <h4>
                                                            <strong>Cargo:</strong>  
                                                        </h4>

                                                        <br>

                                                        <div class="text-justify">
                                                            <?php echo $mostrar->cargo_miembro; ?>
                                                        </div>

                                                        <br>
                                                        <br>

                                                        <h4>
                                                            <strong>Biografía:</strong>  
                                                        </h4>

                                                        <br>

                                                        <div class="text-justify">
                                                            <?php echo $mostrar->descripcion_miembro; ?>
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

                <?php
                            }//while
                        }else{
                             echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Aviso!</strong> No existen Miembros registrados.
                                </div>';
                        }

                    }catch(PDOException $erro){ 
                        echo $erro;
                    }
                ?>    
            </div>

            <div class="row">
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
                                                <a href="index.php?accion=welcome&pagina=1">Inicio</a>

                                                <?php
                                                    if($pagina_anterior != 0){ 
                                                ?>
                                                        <a href="index.php?accion=welcome&pagina=<?php echo $pagina_anterior; ?>" class="activo">
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
                                                                <a href="index.php?accion=welcome&pagina=<?php echo $i;?>"  class="activo<?php echo $i;?>"><?php echo $i;?></a>
                                                <?php
                                                            }//fin del else $i<=0
                                                        }//fin del for $i = $pagina- $links; $i <= $pagina- 1; $i++
                                                ?>  
                                            </li>
                                                                                
                                            <li>
                                                <a href="index.php?accion=welcome&pagina=<?php echo $pagina;?>" class="activo<?php echo $i;?>"><?php echo $pagina;?></a>

                                                <?php
                                                    for($i = $pagina+1; $i <= $pagina+$links; $i++){
                                                        if($i > $total_paginas){
                                                            //******
                                                        }
                                                                        else{
                                                ?>
                                                            <a href="index.php?accion=welcome&pagina=<?php echo $i;?>" class="activo<?php echo $i;?>"><?php echo $i;?></a>        
                                                <?php
                                                        }//fin del else $i > $paginas
                                                    }//fin del $i = $pagina+1; $i <= $pagina+$links; $i++
                                                ?>

                                                <?php
                                                    if($pagina_posterior <= $total_paginas){ 
                                                ?>
                                                        <a href="index.php?accion=welcome&pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                                                            <span aria-hidden="" class="color">&raquo;</span>
                                                        </a>
                                                <?php 
                                                    }else{ 
                                                ?>
                                                        <span aria-hidden="true" class="color">&raquo;</span>
                                                <?php 
                                                    }  
                                                ?>
                                                    <a href="index.php?accion=welcome&pagina=<?php echo $total_paginas;?>">Final</a>    
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
        </div>
    </div>
</div>