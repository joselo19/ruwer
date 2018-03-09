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
                                    <h1 class="text-center">Archivos PDF</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Mensaje de la Página-->

        <div class="row">
                <!--Iniciando Paginacion-->
                    <?php
                            $cantidad_fichero = 5; //cantidad de ficheros por pag
                            $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

                            $inicio = ($pagina - 1) * $cantidad_fichero;
                            $sql_total = "SELECT * from archivos_pdf";

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
                                                    location.href="index.php?accion=pdf";
                                            </script>';
                                }  
                            }
                    ?>
                <!--/Iniciando Paginacion-->


            <!--tabla de los Reglamentos-->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <!--Cabecera de la Tabla-->
                                <div class="x_title">
                                    <h2>Listado de Archivos <small></small></h2>
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
                                                    <th class="text-center">Archivo</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                        <!--/Cabecera de la Tabla-->
                                        
                                        <!--Cuerpo de la Tabla-->
                                            <tbody>
                                                <?php
                                                    $select = "SELECT * from archivos_pdf ORDER BY id_archivo LIMIT $inicio, $cantidad_fichero";
                                                    $contando =$inicio + 1; 
                                                            
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
                                                                        <?php echo $mostrar->titulo_archivo; ?>
                                                                    </td>
                                                                    
                                                                    <td class="td-actions text-center">
                                                                       
                                                                        <a href="admin/pdf/archivos-pdf.php?pdf_archivo=<?php echo $mostrar->archivo_pdf;?>" class="btn btn-small btn-info" data-toggle="modal" title = " Click para Visualizar" 
                                                                        target="_blank">
                                                                            <i class="glyphicon glyphicon-eye-open"> </i>
                                                                        </a>             
                                                                    </td>
                                                                </tr>
                                                <?php
                                                            }//fin del while
                                                        }//fin del if
                                                        else{
                                                            echo '<div class="alert alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                                        <strong>Aviso!</strong> No existe ningún Archivo PDF Registrado.
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
                                                                <a href="index.php?accion=pdf&pagina=1">Inicio</a>

                                                                    <?php
                                                                        if($pagina_anterior != 0){ 
                                                                    ?>
                                                                            <a href="index.php?accion=pdf&pagina=<?php echo $pagina_anterior; ?>" class="activo">
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
                                                                                    <a href="index.php?pdf&pagina=<?php echo $i;?>"  class="activo<?php echo $i;?>"><?php echo $i;?></a>
                                                                    <?php
                                                                                }//fin del else $i<=0
                                                                            }//fin del for $i = $pagina- $links; $i <= $pagina- 1; $i++
                                                                    ?>  
                                                            </li>
                                                                
                                                            <li>
                                                                <a href="index.php?accion=pdf&pagina=<?php echo $pagina;?>" class="activo<?php echo $i;?>"><?php echo $pagina;?></a>

                                                                <?php
                                                                    for($i = $pagina+1; $i <= $pagina+$links; $i++){
                                                                        if($i > $total_paginas){
                                                                            //******
                                                                        }
                                                                        else{
                                                                ?>
                                                                            <a href="index.php?accion=pdf&pagina=<?php echo $i;?>" class="activo<?php echo $i;?>"><?php echo $i;?></a>        
                                                                <?php
                                                                        }//fin del else $i > $paginas
                                                                    }//fin del $i = $pagina+1; $i <= $pagina+$links; $i++
                                                                ?>

                                                                <?php
                                                                    if($pagina_posterior <= $total_paginas){ 
                                                                ?>
                                                                        <a href="index.php?accion=pdf&pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                                                                            <span aria-hidden="" class="color">&raquo;</span>
                                                                        </a>
                                                                <?php 
                                                                    }else{ 
                                                                ?>
                                                                        <span aria-hidden="true" class="color">&raquo;</span>
                                                                <?php 
                                                                    }  
                                                                ?>
                                                                    <a href="index.php?accion=pdf&pagina=<?php echo $total_paginas;?>">Final</a>    
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
            <!--/tabla de los Reglamentos-->
        </div>
    </div>
<!-- /page content -->