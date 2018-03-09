<!-- page content -->
    <div class="right_col" role="main">
        <!-- Mensaje de Bienvenida al Usuario-->
            <div class="row">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Bienvenido/a </h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Sistema Web Informativo - RUWER</h2>
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
                                <p class="text-justify">
                                    <strong><?php echo $usuarioLogueado?></strong>, sea muy bienvenido al 
                                    <strong>Panel de Administración Web</strong> del Sitio Informativo RUWER. 
                                    Permítanos recordarle que usted cuenta el en <ins>Nivel de Usuario</ins> 
                                    <strong> Número <?php echo $nivelLogueado; ?></strong>, 
                                    y por lo tanto usted tiene habilitada las siguienes opciones:
                                </p> 

                                <?php 
                                    $pagina_web = "<p>
                                                        &nbsp;  &nbsp;  &nbsp; 
                                                        1- Usted podrá <strong>administrar</strong> 
                                                        las informaciones básicas del 
                                                        &quot;<em>Front-End del Sitio Informativo</em>&quot;.
                                                    </p>";

                                    $noticias_web = "<p>
                                                        &nbsp;  &nbsp;  &nbsp; 
                                                        2- Usted podrá <strong>administrar</strong> 
                                                        el área de &quot;<em>Publicaciones de Noticias y de Archivos PDF</em>&quot;.
                                                    </p>";

                                    $usuarios_web = "<p>
                                                        &nbsp;  &nbsp;  &nbsp; 
                                                        3- Usted podrá <strong>administrar</strong> el 
                                                        &quot;<em>Panel de Usuarios</em>&quot;.
                                                    </p>";


                                    if ($nivelLogueado == 1) {  
                                        echo  $pagina_web;
                                        echo  $noticias_web;
                                        echo  $usuarios_web;
                                    }

                                    if ($nivelLogueado == 2) {  
                                        echo  $pagina_web;
                                        echo  $noticias_web;
                                    }

                                    if ($nivelLogueado == 3) {  
                                        echo  $pagina_web;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Mensaje de Bienvenida al Usuario-->
     
        <?php 
            if ($nivelLogueado == 1 or $nivelLogueado == 2) { 
            ?>
        <!-- Registros de los Archivos PDF-->
                    <div class="row">
                        <!-- Cuadro de Informe-->
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </div>

                                    <?php
                                       $select = "SELECT * from archivos_pdf";
                                    
                                        try{
                                            $result = $conexion->prepare($select);     
                                            $result->execute();
                                            $contar = $result->rowCount();
                                    ?>
                                                      
                                                <div class="count"><?php echo $contar ?></div>

                                    <?php                                
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    ?>

                                    <h3>Archivos PFD</h3>
                                    <p><a href="index.php?accion=pdf">Ver Listado Completo</a></p>
                                </div>
                            </div>
                        <!--/ Cuadro de Informe-->

                         <!-- tabla de Archivos PDF-->
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Archivo/s PDF: <small>(se muestran los 5 últimos publicados)</small></h2>
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered jambo_table">
                                                <thead>
                                                    <tr>
                                                        <th  class="text-center">N°</th>
                                                        <th  class="text-center">Archivo</th>
                                                        <th  class="text-center">Actividad</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                        <?php 
                                                            $select = "SELECT * from archivos_pdf ORDER BY id_archivo DESC LIMIT 5";
                                                            $contando =1;
                                                        
                                                            try{
                                                                $result = $conexion->prepare($select);     
                                                                $result->execute();
                                                                $contar = $result->rowCount();
                       

                                                                if($contar>0){
                                                                    while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                                        ?>
                                                                    <tr>
                                                                        <th class="text-center"scope="row"><?php echo $contando++;?></th>
                                                                        <td class="text-center"><?php echo $mostrar->titulo_archivo;?></td>
                                                                        <td class="text-center">
                                                                            <a href="../pdf/archivos-pdf.php?pdf-archivo=<?php echo $mostrar->archivo_pdf;?>" class="btn btn-small btn-info" title = "Click para Visualizar" target="_blank">
                                                                                <i class="glyphicon glyphicon-eye-open"></i>
                                                                                <span> Ver PDF</span>
                                                                            </a> 
                                                                        </td>
                                                                    </tr>
                                                        <?php
                                                                    }//fin del while
                                                                }//fin del if
                                                                else{
                                                                    echo'<div class="alert alert-danger">
                                                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                <strong>Aviso!</strong> No existen Archivos PDF Registrados.
                                                                            </div>';
                                                                }//fin del else 

                                                            }catch(PDOException $e){
                                                                echo $e;
                                                            }
                                                        ?>
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- /tabla de Archivos PDF--> 
                    </div>
        <!-- /Registros de las Archivos PDF-->

        <!-- Registros de las Noticias-->
                    <div class="row">
                        <!-- Cuadro de Informe-->
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon">
                                        <i class="fa fa-globe"></i>
                                    </div>

                                    <?php
                                       $select = "SELECT * from noticias";
                                    
                                        try{
                                            $result = $conexion->prepare($select);     
                                            $result->execute();
                                            $contar = $result->rowCount();
                                    ?>
                                                      
                                                <div class="count"><?php echo $contar ?></div>

                                    <?php                                
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    ?>

                                    <h3>Noticias/s</h3>
                                    <p><a href="index.php?accion=lista-noticias">Ver Listado Completo</a></p>
                                </div>
                            </div>
                        <!--/ Cuadro de Informe-->

                        <!-- tabla de Noticias-->
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Noticia/s: <small>(se muestran las  últimas 5 agregadas)</small></h2>
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered jambo_table">
                                                <thead>
                                                    <tr>
                                                        <th  class="text-center">N°</th>
                                                        <th  class="text-center">Imagen</th>
                                                        <th  class="text-center">Noticia</th>
                                                        <th  class="text-center">F. de Publicación</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                        <?php 
                                                            $select = "SELECT * from noticias ORDER BY id_noticia DESC LIMIT 5";
                                                            $contando =1;
                                                        
                                                            try{
                                                                $result = $conexion->prepare($select);     
                                                                $result->execute();
                                                                $contar = $result->rowCount();
                       

                                                                if($contar>0){
                                                                    while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                                        ?>
                                                                    <tr>
                                                                        <th class="text-center"scope="row"><?php echo $contando++;?></th>
                                                                        <td class="text-center">
                                                                            <img src="../imagenes/noticias/<?php echo $mostrar->imagen_noticia;?>" class= "img-thumbnail" width="115" height="115"/>
                                                                        </td>
                                                                        <td class="text-center"><?php echo $mostrar->titulo_noticia;?></td>
                                                                        
                                                                        <?php
                                                                            $date = $mostrar->fecha_noticia;
                                                                            $date2 = date_create($date);
                                                                        ?>

                                                                        <td class="text-center">
                                                                            <?php echo date_format($date2, 'd/m/Y');?>
                                                                        </td>
                                                                    </tr>
                                                        <?php
                                                                    }//fin del while
                                                                }//fin del if
                                                                else{
                                                                    echo'<div class="alert alert-danger">
                                                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                <strong>Aviso!</strong> No existen Noticias Registradas.
                                                                            </div>';
                                                                }//fin del else 

                                                            }catch(PDOException $e){
                                                                echo $e;
                                                            }
                                                        ?>
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- /tabla de Noticias--> 
                    </div>
            <?php 
                }
            ?>
        <!-- /Registros de las Noticias-->

        <!-- Registros de los Usuarios-->
            <?php 
                if ($nivelLogueado == 1) { 
            ?>
                    <div class="row">
                        <!-- Cuadro de Informe-->
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon">
                                        <i class="fa fa-user"></i>
                                    </div>

                                    <?php
                                       $select = "SELECT * from usuarios";
                                    
                                        try{
                                            $result = $conexion->prepare($select);     
                                            $result->execute();
                                            $contar = $result->rowCount();
                                    ?>
                                                      
                                                <div class="count"><?php echo $contar ?></div>

                                    <?php                                
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                    ?>

                                    <h3>Usuario/s</h3>
                                    <p><a href="index.php?accion=lista-usuarios">Ver Listado Completo</a></p>
                                </div>
                            </div>
                        <!--/ Cuadro de Informe-->

                        <!-- tabla de Usuarios-->
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Usuarios: <small>(se muestran las 3 últimos agregados)</small></h2>
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered jambo_table">
                                                <thead>
                                                    <tr>
                                                        <th  class="text-center">N°</th>
                                                        <th  class="text-center">Foto</th>
                                                        <th  class="text-center">Usuario</th>
                                                        <th  class="text-center">Nivel</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                        <?php 
                                                            $select = "SELECT * from usuarios ORDER BY id_usuario DESC LIMIT 3";
                                                            $contando =1;
                                                        
                                                            try{
                                                                $result = $conexion->prepare($select);     
                                                                $result->execute();
                                                                $contar = $result->rowCount();
                       

                                                                if($contar>0){
                                                                    while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                                        ?>
                                                                    <tr>
                                                                        <th class="text-center"scope="row"><?php echo $contando++;?></th>
                                                                        <td class="text-center">
                                                                            <img src="../imagenes/usuarios/<?php echo $mostrar->foto;?>" class= "img-thumbnail" width="115" height="115"/>
                                                                        </td>
                                                                        <td class="text-center"><?php echo $mostrar->usuario;?></td>
                                                                        <td class="text-center"><?php echo $mostrar->nivel;?></td>
                                                                    </tr>
                                                        <?php
                                                                    }//fin del while
                                                                }//fin del if
                                                                else{
                                                                    echo'<div class="alert alert-danger">
                                                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                <strong>Aviso!</strong> No existen Usuarios Registrados.
                                                                            </div>';
                                                                }//fin del else 

                                                            }catch(PDOException $e){
                                                                echo $e;
                                                            }
                                                        ?>
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- /tabla de Usuarios--> 
                    </div>
            <?php 
                }
            ?>
        <!-- /Registros de los Usuarios-->
    </div>
<!-- /page content -->