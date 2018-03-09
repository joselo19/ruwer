<div id="register" class="animate form registration_form">
    <section class="login_content">
        <form method="post" enctype="multipart/form-data" class="form-signin" id="login_form" name="login_form">
            <h1 style="color: white;">Recuperar Cuenta</h1>
                <!-- Validando Email -->
                    <?php
                        if(isset($_POST['recuperar'])){   

                            $email = $_POST['email'];      

                            $select = "SELECT email from usuarios WHERE email LIKE '%$email%'";

                            try {
                                $result = $conexion->prepare($select);     
                                $result->execute();
                                $contar = $result->rowCount();
                                                                          
                                if($contar>0){
                                    echo '<div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong class="text-center">Datos enviados a su Correo</strong>
                                         </div>';
                                }
                                else{
                                    echo '<div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Error! Dirección de Correo no registrada</strong>.
                                          </div>';
                                }

                            } catch (Exception $e) {
                                    echo $e;
                            }
                        } 
                    ?>
                <!--/ Validando Email --> 
                
                <!-- Cajas de Texto -->          
                    <div>
                        <input  type="text" id="username" name="email" placeholder="Email" class="form-control" autofocus>
                    </div>
                <!-- Cajas de Texto -->
                          
                 <!--Botones Maximizados-->
                    <div class="text-center hidden-xs">
                        <button type="submit" name="recuperar" class="btn btn-success" title = "Recuperar Cuenta">
                            <i class="glyphicon glyphicon-send"></i>
                            <span> Recuperar Cuenta</span>
                        </button>
                    </div> 
                <!--/Botones Maximizados-->
                            
                <!--Botones Minimizados-->
                    <div class="text-center visible-xs">
                        <button type="submit" name="recuperar" class="btn btn-success" title = "Recuperar Cuenta">
                            <i class="glyphicon glyphicon-send"></i>
                        </button>
                    </div>
                <!--/Botones Minimizados-->

                <div class="clearfix"></div>
                
                <!--Footer del Login-->
                    <div class="separator">
                        <p class="change_link">
                            <a href="#signin" class="to_register" style="color: white;"> Página de Login </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1 style="color: white;"><i class="fa fa-institution"></i> RUWER</h1>
                            <p style="color: white;">©2017 - Sistema Web Informativo</p>
                        </div>
                    </div>
                <!--/Footer del Login-->
        </form>
    </section>
</div>