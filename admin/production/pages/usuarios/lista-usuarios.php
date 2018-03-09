<!-- page content -->
    <div class="right_col" role="main">
        <div class="row">

            <!--Iniciando Paginacion-->
                    <?php
                            $cantidad_fichero = 5; //cantidad de ficheros por pag
                            $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

                            $inicio = ($pagina - 1) * $cantidad_fichero;
                            $sql_total = "SELECT * from usuarios";

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
                                                    location.href="index.php?accion=lista-usuarios";
                                            </script>';
                                }  
                            }
                    ?>
            <!--/Iniciando Paginacion-->

            <!-- Botón Nuevo Usuario-->
                <div>
                    <!-- Botón Maximizado-->
                    <div class="row text-center hidden-xs">
                        <a href="index.php?accion=nuevo-usuario"  class="btn btn-primary" title = "Nuevo Usuario">
                            <i class="fa fa-user"></i>
                            <span> Nuevo Usuario</span>
                        </a>
                    </div>
                                        
                    <!-- Botón Minimizado-->
                    <div class="row text-center visible-xs">
                        <a href="index.php?accion=nuevo-usuario"  class="btn btn-primary" title = "Nuevo Usuario">
                            <i class="fa fa-user"></i>
                        </a>
                    </div>
                </div>
            
                <br>
                <br>           
            <!-- /Botón Nuevo Usuario-->

            <!--tabla de Usuarios-->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <!--Cabecera de la Tabla-->
                                <div class="x_title">
                                    <h2>Listado de Usuarios <small></small></h2>
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
                                                            
                                        $seleciona = "SELECT * from usuarios WHERE id_usuario= :id_delete";

                                        try{
                                            $result = $conexion->prepare($seleciona);    
                                            $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);     
                                            $result->execute();
                                            $contar = $result->rowCount();
                                                                        
                                            if($contar > 0){
                                                $loop = $result->fetchAll();
                                                                            
                                                foreach ($loop as $exibir){}
                                                                            
                                                $fotoDeleta = $exibir['foto'];
                                                $arquivo = "../imagenes/usuarios/" . $fotoDeleta;
                                                unlink($arquivo); //elimina la imagen
                                                                            
                                                // exclui o registo
                                                $seleciona = "DELETE from usuarios WHERE id_usuario=:id_delete";
                                                try{
                                                    $result = $conexion->prepare($seleciona);
                                                    $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);             
                                                    $result->execute();
                                                    $contar = $result->rowCount();
                                                                                
                                                    if($contar>0){
                                                        echo '<div class="alert alert-success">
                                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                                    <strong>Exito!</strong> El Usuario fue eliminado del Sistema.
                                                              </div>';
                                                    }else{
                                                        echo '<div class="alert alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                                    <strong>Error</strong> No fue posible eliminar el Logo Institucional.
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
                                                    <th class="text-center">Foto</th>
                                                    <th class="text-center">Usuario</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                        <!--/Cabecera de la Tabla-->
                                        
                                        <!--Cuerpo de la Tabla-->
                                            <tbody>
                                                <?php
                                                    $select = "SELECT * from usuarios ORDER BY id_usuario DESC LIMIT $inicio, $cantidad_fichero";
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
                                                                        <img src="../imagenes/usuarios/<?php echo $mostrar->foto;?>" class= "img-thumbnail" width="115" height="115"/>
                                                                    </td>

                                                                    <td class="text-center">
                                                                        <?php echo $mostrar->usuario; ?>
                                                                    </td>


                                                                    <td class="td-actions text-center">

                                                                            <?php  
                                                                                if($mostrar->usuario != $usuarioLogueado){  
                                                                            ?>
                                                                                    <!--<a href="index.php?accion=editar-usuario&id=<?php //echo $mostrar->id_usuario;?>" class="btn btn-small btn-success" title = "Click para Editar">
                                                                                        <i class="glyphicon glyphicon-pencil"> </i>
                                                                                    </a> -->

                                                                                    <a href="#ver-registro<?php echo $mostrar->id_usuario;?>" class="btn btn-small btn-info" data-toggle="modal" title = " Click para Visualizar">
                                                                                        <i class="glyphicon glyphicon-eye-open"> </i>
                                                                                    </a>
                                                                                                                                                                                    
                                                                                    <a href="#eliminar-registro<?php echo $mostrar->id_usuario;?>" class="btn btn-small btn-danger" data-toggle="modal" title = " Click para Eliminar">
                                                                                        <i class="glyphicon glyphicon-trash"> </i>
                                                                                    </a>                
                                                                            <?php
                                                                                }
                                                                                else{
                                                                                    echo "Acciones no disponibles";
                                                                                }
                                                                            ?> 
                                                                    </td> 
                                                                </tr>

                                                                <!-- Ver Registro-->
                                                                    <div class="modal fade" id="ver-registro<?php echo $mostrar->id_usuario;?>">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <!-- Header de la Ventana -->
                                                                                    <div class="modal-header text-center">
                                                                                        <h1 class="modal-title text-center">Visualizando - Usuario </h1>
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
                                                                                            <img src="../imagenes/usuarios/<?php echo $mostrar->foto;?>" class= "img-thumbnail" width="170"/>
                                                                                        </div>

                                                                                        <br>
                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Usuario:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php echo $mostrar->usuario;?>
                                                                                        </div>

                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Nivel de Usuario:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php echo $mostrar->nivel;?>
                                                                                        </div>

                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Nombres y Apellidos:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php 
                                                                                                echo $mostrar->nombre;
                                                                                                echo " ";
                                                                                                echo $mostrar->apellido;
                                                                                            ?>
                                                                                        </div>

                                                                                         <br>

                                                                                        <h4>
                                                                                            <strong>Email:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php 
                                                                                                echo $mostrar->email;
                                                                                            ?>
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
                                                                    <div class="modal fade" id="eliminar-registro<?php echo $mostrar->id_usuario;?>">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <!-- Header de la Ventana -->
                                                                                    <div class="modal-header text-center">
                                                                                        <h1 class="modal-title text-center">Eliminar Logo</h1>
                                                                                    </div>
                                                                                <!-- /Header de la Ventana -->
                                                                                                   
                                                                                <!-- Contenido de la Ventana -->
                                                                                    <div class="modal-body text-justify">
                                                                                        <p>
                                                                                            <strong><?php echo $usuarioLogueado;?></strong>.. 
                                                                                            Quieres <strong>ELIMINAR</strong> a este Usuario:
                                                                                        </p>

                                                                                        <br>

                                                                                        <div class="text-center">
                                                                                            <img src="../imagenes/usuarios/<?php echo $mostrar->foto;?>" class= "img-thumbnail" width="170"/>
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
                                                                                          
                                                                                            <a href="index.php?accion=lista-usuarios&delete=<?php echo $mostrar->id_usuario;?>" class="btn btn-danger" title="Si">
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
                                                                        <strong>Aviso!</strong> No existe un Logo Institucional registrado.
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
                                                            <a href="index.php?accion=lista-usuarios&pagina=1">Inicio</a>

                                                                <?php
                                                                    if($pagina_anterior != 0){ 
                                                                ?>
                                                                        <a href="index.php?accion=lista-usuarios&pagina=<?php echo $pagina_anterior; ?>" class="activo">
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
                                                                                <a href="index.php?accion=lista-usuarios&pagina=<?php echo $i;?>"  class="activo<?php echo $i;?>"><?php echo $i;?></a>
                                                                <?php
                                                                            }//fin del else $i<=0
                                                                        }//fin del for $i = $pagina- $links; $i <= $pagina- 1; $i++
                                                                ?>  
                                                        </li>
                                                            
                                                        <li>
                                                            <a href="index.php?accion=lista-usuarios&pagina=<?php echo $pagina;?>" class="activo<?php echo $i;?>"><?php echo $pagina;?></a>

                                                            <?php
                                                                for($i = $pagina+1; $i <= $pagina+$links; $i++){
                                                                    if($i > $total_paginas){
                                                                        //******
                                                                    }
                                                                    else{
                                                            ?>
                                                                        <a href="index.php?accion=lista-usuarios&pagina=<?php echo $i;?>" class="activo<?php echo $i;?>"><?php echo $i;?></a>        
                                                            <?php
                                                                    }//fin del else $i > $paginas
                                                                }//fin del $i = $pagina+1; $i <= $pagina+$links; $i++
                                                            ?>

                                                            <?php
                                                                if($pagina_posterior <= $total_paginas){ 
                                                            ?>
                                                                    <a href="index.php?accion=lista-usuarios&pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                                                                        <span aria-hidden="" class="color">&raquo;</span>
                                                                    </a>
                                                            <?php 
                                                                }else{ 
                                                            ?>
                                                                    <span aria-hidden="true" class="color">&raquo;</span>
                                                            <?php 
                                                                }  
                                                            ?>
                                                                <a href="index.php?accion=lista-usuarios&pagina=<?php echo $total_paginas;?>">Final</a>    
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
            <!--/tabla de Usuarios-->
        </div>
    </div>
<!-- /page content -->