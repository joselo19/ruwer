<div class="animate form login_form">
    <section class="login_content">
        <form method="post" enctype="multipart/form-data" class="form-signin" id="login_form" name="login_form">
                <h1  style="color: white;">Login al Sistema</h1>

                <!-- mensajes de ingreso al sistema -->
                    <?php
                        //validando los mensajes de errores,
                        if(!isset($_POST['ingresar'])){
                            if(isset($_GET['accion'])){
                                $accion = $_GET['accion'];

                                if ($accion == 'negado') {
                                    echo '
                                            <div class="x_content bs-example-popovers">
                                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    
                                                    <h4>
                                                        <strong>Error!!!!.</strong> Debe logearse para acceder al sistema.
                                                    </h4>
                                                    
                                                    <div>
                                                        <h3><i class="fa fa-circle-o-notch fa-spin"></i></h3>
                                                    </div>
                                                </div>
                                            </div>    
                                    ';
                                } 
                            }
                        }

                        //trabajando con los datos de ingreso
                        if(isset($_POST['ingresar'])){
                            //asociando los campos
                            // trimp remueve los espacios y strip remueve etiquetas html
                            $usuario = trim(strip_tags($_POST['usuario']));
                            $password = md5((trim(strip_tags($_POST['password'])))); 
                            // $password = (trim(strip_tags($_POST['password'])));   

                            //seleccionar los registros de la base de datos
                            $select = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password'";

                            //redireccionando al sistema del loogin
                            try{
                                $result = $conexion->prepare($select);  
                                $result->execute();
                                                                            
                                $contar = $result->rowCount();
                                                                            
                                if($contar>0){
                                    //$usuario = $_POST['usuario'];
                                    //$senha   = md5($_POST['password']);
                                    $_SESSION['usuario_system'] = $usuario;
                                    $_SESSION['password_system'] = $password;
                                                                                
                                    echo '
                                            <div class="x_content bs-example-popovers">
                                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>

                                                    <h4>
                                                        <strong>Datos Correctos!!!</strong> Ingresando al Sistema.
                                                    </h4>

                                                    <div>
                                                        <h3><i class="fa fa-spinner fa-spin"></i></h3>
                                                    </div>   
                                                </div>
                                            </div>
                                        ';

                                    header("Refresh: 3, index.php"); 
                                    exit;
                                }   
                                else{
                                    echo ' 
                                            <div class="x_content bs-example-popovers">
                                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>

                                                    <h4>
                                                        <strong>Error!!!</strong> Datos Incorrectos.
                                                    </h4>

                                                    <div>
                                                        <h3><i class="fa fa-circle-o-notch fa-spin"></i></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                }

                            }catch (PDOException $erro) {   
                                echo $erro; 
                            }
                        } 
                    ?> 
                <!--/mensajes de ingreso al sistema -->

                <!-- Cajas de Texto -->
                    <div>
                        <input  type="text" id="username" name="usuario" placeholder="Usuario" class="form-control" autofocus>                                        
                    </div>
                                  
                    <div>
                        <input type="password" id="password" name="password" placeholder="Contraseña"  class="form-control">
                    </div> 
                <!-- /Cajas de Texto -->                   

                <!--Botones Maximizados-->
                    <div class="text-center hidden-xs">
                        <button type="submit" name="ingresar" class="btn btn-success" title = "Ingresar al Sistema">
                            <i class="glyphicon glyphicon-log-in"></i>
                            <span ">Ingresar al Sistema</span>
                        </button>
                    </div> 
                <!--/Botones Maximizados-->
                            
                <!--Botones Minimizados-->
                    <div class="text-center visible-xs">
                        <button type="submit" name="ingresar" class="btn btn-success" title = "Ingresar al Sistema">
                            <i class="glyphicon glyphicon-log-in"></i>
                        </button>
                    </div>
                <!--/Botones Minimizados-->

                <div class="clearfix"></div>

                <!--Footer del Login-->
                    <div class="separator">
                        <p class="change_link" style="color: white;">Olvidaste tu Contraseña?
                            <a href="#signup" class="to_register" style="color: white;"> Aquí puedes recuperarla</a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1  style="color: white;"><i class="fa fa-institution"  style="color: white;"></i> RUWER</h1>
                            <p  style="color: white;">©2017 - Sistema Web Informativo</p>
                        </div>
                    </div>
                <!--Footer del Login-->
        </form>
    </section>
</div>