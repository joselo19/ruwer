<!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <!--tabla Informacion de la Empresa-->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <!--Cabecera de la Tabla-->
                                <div class="x_title">
                                    <h2>Datos de la Empresa <small></small></h2>
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
                                                    <th class="text-center">Logo</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                        <!--/Cabecera de la Tabla-->
                                        
                                        <!--Cuerpo de la Tabla-->
                                            <tbody>
                                                <?php
                                                    $select = "SELECT * from empresa";
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
                                                                        <img src="../imagenes/empresa/img_logo/<?php echo $mostrar->imagen_empresa;?>" class= "img-thumbnail" width="115"/>
                                                                    </td>

                                                                    <td class="text-center">
                                                                        <?php echo $mostrar->nombre_empresa; ?>
                                                                    </td>
                                                                    
                                                                    <td class="td-actions text-center">
                                                                        <a href="index.php?accion=editar-informacion&id=<?php echo $mostrar->id_empresa;?>" class="btn btn-small btn-success" title = "Click para Editar">
                                                                            <i class="glyphicon glyphicon-pencil"> </i>
                                                                        </a>

                                                                        <a href="#ver-registro<?php echo $mostrar->id_empresa;?>" class="btn btn-small btn-info" data-toggle="modal" title = " Click para Visualizar">
                                                                            <i class="glyphicon glyphicon-eye-open"> </i>
                                                                        </a>                                                                                 
                                                                    </td>
                                                                </tr>

                                                                <!-- Ver Registro-->
                                                                    <div class="modal fade" id="ver-registro<?php echo $mostrar->id_empresa;?>">
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
                                                                                            <strong>Logo:</strong>
                                                                                        </h4>
                                                                                                                
                                                                                        <br>
                                                                                        <br>
                                                                                                           
                                                                                        <div class="text-center">
                                                                                            <img src="../imagenes/empresa/img_logo/<?php echo $mostrar->imagen_empresa;?>" class= "img-thumbnail" width="170"/>
                                                                                        </div>

                                                                                        <br>
                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Nombre:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php echo $mostrar->nombre_empresa; ?>
                                                                                        </div>

                                                                                        <br>
                                                                                        <br>

                                                                                        <h4>
                                                                                            <strong>Información Empresarial:</strong>  
                                                                                        </h4>

                                                                                        <br>

                                                                                        <div class="text-justify">
                                                                                            <?php echo $mostrar->informacion_empresa; ?>
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
                                                            }//fin del while
                                                        }//fin del if
                                                        else{
                                                            echo '<div class="alert alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                                        <strong>Aviso!</strong> No existe ninguna Empresa Registrada.
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
            <!--/tabla Informacion de la Empresa-->
        </div>
    </div>
<!-- /page content -->