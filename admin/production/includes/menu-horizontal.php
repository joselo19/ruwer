<!-- Menu Horizontal -->
    <div class="top_nav">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <!-- Foto y Nombres -->
                            <?php 
                                /* $select = "SELECT * from usuarios";
                                                                                                                                 
                                    try{
                                        $result = $conexion->prepare($select);     
                                        $result->execute();
                                        $contar = $result->rowCount();
                                                                                                                      
                                        if($contar>0){
                                            while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                                $idUsu = $mostrar->id_usuario;

                                                if ($idUsu == $idLogueado) {
                                                    # code...*/
                                               
                            ?>
                                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <img src="../imagenes/usuarios/<?php echo $fotoLogueado; ?>" alt="">
                                                        <?php echo $nombreLogueado . " " . $apellidoLogueado; ?>
                                                        <span class=" fa fa-angle-down"></span>
                                                    </a>

                            <?php 
                                               /* }
                                            }// fin del while
                                        }//fin del if
                                                                                         
                                    }catch (PDOWException $erro){ 
                                        echo $erro;
                                    }   */
                            ?>  
                        <!-- /Foto y Nombres -->



                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <!-- Perfil -->
                                <li>
                                    <a href="index.php?accion=editar-perfil">
                                        <i class="fa fa-user pull-right"></i> 
                                        <span>Perfil</span>
                                    </a>
                                </li>
                            <!-- /Perfil -->
                            
                            <!-- Ayuda -->
                                <li>
                                    <a href="index.php?accion=ayuda">
                                        <i class="fa fa-desktop pull-right"></i> 
                                        <span>Ayuda</span>
                                    </a>
                                </li>
                            <!-- /Ayuda -->
                            
                            <!-- Salir -->
                                <li>
                                    <a href="#salir-sistema" data-toggle="modal">
                                        <i class="fa fa-sign-out pull-right"></i>
                                        <span>Salir</span>
                                    </a>
                                </li>
                            <!-- /Salir -->
                        </ul>
                    </li>
                </ul>
            </nav>
                    
            <!-- Ventana  para salir del sistema-->
                <div class="modal fade" id="salir-sistema">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Header de la Ventana -->
                                <div class="modal-header">
                                    <h1 class="modal-title text-center" id="myModalLabel2">Salir del Sistema</h1>
                                </div>
                            <!-- /Header de la Ventana -->

                            <!-- Contenido de la Ventana -->
                                <div class="modal-body text-justify">
                                    <p>
                                        <strong><?php echo $usuarioLogueado;?></strong>.. 
                                        deseas salir del Sistema?
                                    </p>
                                </div>
                            <!-- /Contenido de la Ventana -->

                            <!-- Footer de la Ventana -->
                                <div class="modal-footer hidden-xs">
                                    <div class="text-center">
                                        <a href="?salir" class="btn btn-primary" title ="Salir">
                                            <i class="glyphicon glyphicon-log-out"></i>
                                            <span> Salir</span>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" title="Cancelar">
                                            <i class="glyphicon glyphicon-remove-sign"></i>
                                            <span> Cancelar</span>
                                        </button>  
                                    </div>
                                </div>

                                <div class="modal-footer visible-xs">
                                    <div class="text-center">
                                        <a href="?salir" class="btn btn-primary" title ="Salir">
                                            <i class="glyphicon glyphicon-log-out"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" title="Cancelar">
                                            <i class="glyphicon glyphicon-remove-sign"></i>
                                        </button>  
                                    </div>
                                </div>
                            <!-- /Footer de la Ventana -->
                        </div>
                    </div>
                </div>
            <!--/ Ventana  para salir del sistema-->
        </div>
    </div>
<!-- /Menu Horizontal -->