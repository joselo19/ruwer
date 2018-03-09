<!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <!-- Titulo -->
                      <div class="x_title">
                          <h2>
                              Editar Perfil 
                              <small>(*) Campos Obligatorios</small>
                          </h2>
                          <ul class="nav navbar-right panel_toolbox">
                              <li>
                                  <a class="collapse-link">
                                      <i class="fa fa-chevron-up"></i>
                                  </a>
                              </li>
                          </ul>
                          <div class="clearfix"></div>
                      </div>
                  <!-- /Titulo -->
                  
                  <!-- Trabajando con el Codigo PHP -->
                      <?php
                          //recuperando los datos por medio del ID

                          $id = $idLogueado;
                          //echo $id;
                          $select = "SELECT * from usuarios WHERE id_usuario=:id";
                          //$contagem =1;

                          try{
                              $result = $conexion->prepare($select);
                              $result->bindParam(':id', $id, PDO::PARAM_INT);     
                              $result->execute();
                              $contar = $result->rowCount();
                                          
                              if($contar>0){
                                  while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                      $idUsu = $mostrar->id_usuario;
                                      $usuario = $mostrar->usuario;
                                      $nombre = $mostrar->nombre;
                                      $nivel = $mostrar->nivel;
                                      $apellido = $mostrar->apellido;
                                      $password = $mostrar->password;
                                      $imagen = $mostrar->foto;
                                  }       
                              }else{
                                  echo '<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Aviso!</strong> No existe el Usuario.
                                       </div>';
                                  exit;
                              }                
                          }catch(PDOException $e){
                            echo $e;
                          }           
                                              
                          $novoNome = $imagen;

                          //Actualizando los datos
                          if(isset($_POST['actualizar'])){
                              //
                              $password    = strip_tags($_POST['password']);
                              $nombre      = trim(strip_tags($_POST['nombre']));
                              $apellido    = trim(strip_tags($_POST['apellido'])); 

                              //$password_cifrado = password_hash($password, PASSWORD_DEFAULT, array("cost" => 12));

                              //si el campo no esta vacio actualiza con la misma imagen
                              if(!empty($_FILES['img']['name'])){
                                  //INFO IMAGEM
                                  $file     = $_FILES['img'];
                                  $numFile  = count(array_filter($file['name']));
                                                  
                                  //direccion en donde se guardaran las imagenes
                                  $folder   = '../imagenes/usuarios/';
                                                  
                                  //REQUISITOS
                                  $permite  = array('image/jpeg', 'image/png');
                                  $maxSize  = 1024 * 1024 * 5;

                                  //MENSAGENS
                                  $msg    = array();
                                  $errorMsg = array(
                                    1 => 'El archivo es mayor al límite definido en el UPLOAT del sistema',
                                    2 => 'El archivo pasa el límite del tamaño en el MAX_FILE_SIZE que fue especificado',
                                    3 => 'El UPLOAT del archivo fue hecho parcialmente',
                                    4 => 'No se ha podido realizar el UPLOAT del archivo'
                                  ); //$errorMsg
                                                
                                    if($numFile <= 0){
                                       /*-----------------------------*/
                                    }
                                    else if($numFile >=2){
                                        echo '<div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                Solo puede seleccionar 1 imágen!.
                                            </div>';
                                    }else{
                                        for($i = 0; $i < $numFile; $i++){
                                            $name   = $file['name'][$i];
                                            $type = $file['type'][$i];
                                            $size = $file['size'][$i];
                                            $error  = $file['error'][$i];
                                            $tmp  = $file['tmp_name'][$i];
                                                
                                            $extensao = @end(explode('.', $name));
                                            $novoNome = rand().".$extensao";
                                                      
                                            if($error != 0)
                                                echo $msg[] = "<b>$name :</b> ".$errorMsg[$error];
                                            else if(!in_array($type, $permite))
                                                echo $msg[] = "<b>$name :</b> Error imagen no soportada!";
                                            else if($size > $maxSize)
                                                echo $msg[] = "<b>$name :</b> Error la imagen supera el tamaño de 5MB";
                                            else{
                                                if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                                                  //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
                                                          
                                                  // se edita la imagen y se borra la anterior del servidor
                                                  $arquivo = "../imagenes/usuarios/" .$imagen;
                                                  unlink($arquivo);

                                                }else
                                                  $msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
                                                                
                                                }
                                                                
                                                foreach($msg as $pop)
                                                  echo '';
                                                  //echo $pop.'<br>';
                                            }
                                        }                             
                                    }//si el campo esta vacio
                              else{
                                  $novoNome = $imagen;
                              } 

                              if (!empty($password)) {

                                  $password    = md5(trim(strip_tags($_POST['password'])));
                                  
                                  $update = "UPDATE usuarios SET nombre=:nombre, apellido=:apellido, 
                                                     password=:password, foto=:foto WHERE id_usuario=:id";
                                                            
                                  try{
                                      $result = $conexion->prepare($update);
                                                        
                                      $result->bindParam(':id', $id, PDO::PARAM_INT);
                                      $result->bindParam(':password', $password, PDO::PARAM_STR);
                                      $result->bindParam(':foto', $novoNome, PDO::PARAM_STR);
                                      $result->bindParam(':nombre', $nombre, PDO::PARAM_STR);  
                                      $result->bindParam(':apellido', $apellido, PDO::PARAM_STR);
                                              
                                                        
                                      $result->execute();
                                      $contar = $result->rowCount();

                                      if($contar>0){
                                          echo '<div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>Exito!</strong> Datos de tu perfil Actualizado.
                                                </div>';
                                      }else{
                                          echo '<div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>No se actualizó la información del Usuario.</strong> 
                                                </div>';
                                      }     
                                  }catch(PDOException $e){
                                    echo $e;
                                  }  
                              } else {
                                
                                  $update = "UPDATE usuarios SET nombre=:nombre, apellido=:apellido, 
                                                    foto=:foto WHERE id_usuario=:id";
                                                            
                                  try{
                                      $result = $conexion->prepare($update);
                                                        
                                      $result->bindParam(':id', $id, PDO::PARAM_INT);
                                      $result->bindParam(':foto', $novoNome, PDO::PARAM_STR);
                                      $result->bindParam(':nombre', $nombre, PDO::PARAM_STR);  
                                      $result->bindParam(':apellido', $apellido, PDO::PARAM_STR);
                                              
                                                        
                                      $result->execute();
                                      $contar = $result->rowCount();

                                      if($contar>0){
                                          echo '<div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>Exito!</strong> Datos de tu perfil Actualizado.
                                                </div>';
                                      }else{
                                          echo '<div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>No se actualizó la información del Usuario.</strong> 
                                                </div>';
                                      }     
                                  }catch(PDOException $e){
                                    echo $e;
                                  }  
                              }             
                          } 
                      ?> 
                  <!-- /Trabajando con el Codigo PHP -->
                  
                  <!-- Contenido del Formulario-->
                      <div class="x_content">
                          <br />
                          <form id="editar-perfil" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>                                      
                              <!--Foto-->
                                  <div class="form-group">
                                      <div id="portada">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                Foto 
                                                <span class="required">*</span>
                                          </label>

                                          <a href="#info-imagen" class="btn btn-small btn-warning" data-toggle="modal" title = "Información de la imagen a Reemplazar">
                                              <i class="glyphicon glyphicon-question-sign"> </i>
                                          </a>  

                                          <div id="preview" class="thumbnail">
                                              <a href="#" id="file-select" class="btn btn-default">Elegir archivo</a>
                                              <img src="../imagenes/usuarios/<?php echo $novoNome;?>" class = "img-thumbnail"/>
                                          </div>

                                          <div class="row">
                                              <div class="col-xs-12 col-md-4"></div>
                                              <div class="col-xs-12 col-md-4"><span class="alert alert-info" id="file-info">Foto de Perfil: <?php echo $novoNome; ?></span> </div>
                                              <div class="col-xs-12 col-md-4"></div>
                                          </div>

                                          <input type="file" class="span6 fileinput" id="img2" name="img[]">
                                      </div>
                                  </div>
                              <!--/Foto-->

                                  <br>
                                  <br>
                                          
                              <!--Usuario-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Usuario
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="usuario" name="usuario" value="<?php echo $usuario;?>" disabled>
                                      </div>
                                  </div>
                              <!--/Usuario-->

                                  <br>
                                  <br>

                              <!--Usuario-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Nivel de Usuario
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="nivel" name="nivel" value="<?php echo $nivel;?>" disabled>
                                      </div>
                                  </div>
                              <!--/Usuario-->

                                  <br>
                                  <br>

                              <!--Contraseña-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Nueva Contraseña
                                          <span class="required"></span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="password" class="form-control col-md-7 col-xs-12" id="p_password" name="p_password" placeholder="Nueva Contraseña">
                                      </div>
                                  </div>

                                  <br>
                                  <br>

                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Confirmar Contraseña
                                          <span class="required"></span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="password" class="form-control col-md-7 col-xs-12" id="password" name="password" placeholder=" Confirmar Nueva Contraseña">
                                      </div>
                                  </div>
                              <!--/Contraseña-->

                                  <br>
                                  <br>

                              <!--Nombre/s-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Nombre/s
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="nombre" name="nombre" value="<?php echo $nombre;?>">
                                      </div>
                                  </div>
                              <!--/Nombre/s-->

                                  <br>
                                  <br>

                              <!--Apellido/s-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Apellido/s
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="apellido" name="apellido" value="<?php echo $apellido;?>">
                                      </div>
                                  </div>
                              <!--/Apellido/s-->

                                  <br>
                                  <br>

                            
                             <!--Botones Maximizados-->
                                    <div class="text-center hidden-xs">
                                        <a href="#actualizar-registro" class="btn btn-primary fileinput-button" data-toggle="modal" title = "Actualizar">
                                            <i class="glyphicon glyphicon-ok-circle"></i>
                                            <span> Actualizar</span>
                                        </a>
              
                                        <a href="#cancelar-creacion" class="btn btn-danger" data-toggle="modal" title = "Cancelar">
                                            <i class="glyphicon glyphicon-remove-sign"></i>
                                            <span> Cancelar</span>
                                        </a>
                                    </div>
                              <!--/Botones Maximizados-->
                              
                                <!--Botones Minimizados-->
                                    <div class="text-center visible-xs">
                                       <a href="#actualizar-registro" class="btn btn-primary fileinput-button" data-toggle="modal" title = "Actualizar">
                                            <i class="glyphicon glyphicon-ok-circle"></i>
                                        </a>

                                        <a href="#cancelar-creacion" class="btn btn-danger" data-toggle="modal" title = "Cancelar">
                                            <i class="glyphicon glyphicon-remove-sign"></i>
                                        </a>
                                    </div> 
                                <!--/Botones Minimizados-->   

                                <!-- Ventana  Actualizar Registro-->
                                      <div class="modal fade" id="actualizar-registro">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <!-- Header de la Ventana -->
                                                      <div class="modal-header">
                                                          <h1 class="modal-title text-center" id="myModalLabel2">Actualizar</h1>
                                                      </div>
                                                  <!-- /Header de la Ventana -->

                                                  <!-- Contenido de la Ventana -->
                                                      <div class="modal-body text-justify">
                                                          <p>
                                                              <strong><?php echo $usuarioLogueado;?></strong>.. 
                                                              Quieres <strong>ACTUALIZAR</strong> la información 
                                                              de tu perfil???..
                                                             
                                                          </p>
                                                      </div>
                                                  <!-- /Contenido de la Ventana -->

                                                  <!-- Footer de la Ventana -->
                                                      <div class="modal-footer hidden-xs">
                                                          <div class="text-center"> 
                                                              <span class="btn btn-primary fileinput-button" title = "Si quiero">
                                                                  <i class="fa fa-thumbs-up"></i>
                                                                  <span> Si quiero</span>
                                                                  <input type="submit" name="actualizar">
                                                              </span>
                                                      
                                                              <button type="button" class="btn btn-danger" data-dismiss="modal" title = "No quiero">
                                                                  <i class="fa fa-thumbs-down"></i>
                                                                  No quiero
                                                              </button>
                                                          </div>
                                                      </div>

                                                      <div class="modal-footer visible-xs">
                                                          <div class="text-center"> 
                                                              <span class="btn btn-primary fileinput-button" title = "Si quiero">
                                                                  <i class="fa fa-thumbs-up"></i>
                                                                  <input type="submit" name="actualizar">
                                                              </span>
                                                      
                                                              <button type="button" class="btn btn-danger" data-dismiss="modal" title = "No quiero">
                                                                  <i class="fa fa-thumbs-down"></i>
                                                              </button>
                                                          </div>
                                                      </div>
                                                  <!-- /Footer de la Ventana -->
                                              </div>
                                          </div>
                                      </div>
                                <!-- /Ventana  Actualizar Registro-->                      
                          </form>
                      </div>
                  <!-- /Contenido del Formulario-->
                                
                  <!-- Ventana  Cancelar Creación-->
                      <div class="modal fade" id="cancelar-creacion">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <!-- Header de la Ventana -->
                                      <div class="modal-header">
                                          <h1 class="modal-title text-center" id="myModalLabel2">Cancelar</h1>
                                      </div>
                                  <!-- /Header de la Ventana -->

                                  <!-- Contenido de la Ventana -->
                                      <div class="modal-body text-justify">
                                          <p>
                                              <strong><?php echo $usuarioLogueado;?></strong>.. 
                                              Quieres <strong>SALIR Y CANCELAR</strong> la edición de 
                                              tu perfil?...
                                          </p>
                                      </div>
                                  <!-- /Contenido de la Ventana -->

                                  <!-- Footer de la Ventana -->
                                      <div class="modal-footer hidden-xs">
                                          <div class="text-center"> 
                                              <button href="" type="button" class="btn btn-primary" data-dismiss="modal" title = "No quiero">
                                                  <i class="fa fa-thumbs-down"></i>
                                                  No quiero
                                              </button>
                                      
                                              <a href="index.php?accion=welcome" class="btn btn-danger" title="Si quiero">
                                                  <i class="fa fa-thumbs-up"></i>
                                                  <span> Si quiero</span>
                                              </a>  
                                          </div>
                                      </div>

                                      <div class="modal-footer visible-xs">
                                          <div class="text-center">
                                              <button type="button" class="btn btn-primary"  data-dismiss="modal" title = "No quiero">
                                                  <i class="fa fa-thumbs-down"></i>
                                              </button>
                                        
                                              <a href="index.php?accion=welcome" class="btn btn-danger" title="Si quiero">
                                                  <i class="fa fa-thumbs-up"></i>
                                              </a> 
                                          </div>
                                      </div>
                                  <!-- /Footer de la Ventana -->
                              </div>
                          </div>
                      </div>
                  <!-- /Ventana  Cancelar Creación-->

                  <!-- Ventana para Informacion de la Imagen-->
                      <div class="modal fade" id="info-imagen">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <!-- Header de la Ventana -->
                                      <div class="modal-header text-center">
                                          <h1 class="modal-title text-center">Información</h1>
                                      </div>
                                  <!--/ Header de la Ventana -->

                                  <!-- Contenido de la Ventana -->
                                      <div class="modal-body text-justify">
                                          <p>
                                              La imagen a <strong>editar:</strong>
                                          </p>                                              
                  
                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              1- Podrá tener una tamaño máximo de hasta  
                                              &quot;<em>5 MB</em>&quot;.
                                          </p>

                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              2- Tendrá la dimensión estándar de   
                                              &quot;<em>1024 x 1024</em>&quot;.
                                          </p>

                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              3- Debe de ser de tipo:    
                                              &quot;<em>.jpeg</em>&quot;, &quot;<em>.jpg</em>&quot; o  
                                              &quot;<em>.png</em>&quot;.
                                          </p>
                                      </div>
                                  <!--/ Contenido de la Ventana -->

                                  <!-- Footer de la Ventana -->
                                      <div class="modal-footer hidden-xs">
                                          <div class="text-center">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal" title = "Cerrar">
                                                  <i class="fa fa-times-circle"></i>
                                                  <span> Cerrar</span>
                                              </button>
                                          </div>            
                                      </div>
                                 
                                      <div class="modal-footer visible-xs">
                                          <div class="text-center">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal" title = "Cerrar">
                                                  <i class="fa fa-times-circle"></i>
                                              </button>
                                          </div>
                                      </div>
                                   <!-- /Footer de la Ventana -->
                              </div>
                          </div>
                      </div> 
                  <!-- /Ventana para Informacion de la Imagen--> 

                  <!-- Ventana para Informacion del Usuario-->
                      <div class="modal fade" id="info-nivel">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <!-- Header de la Ventana -->
                                      <div class="modal-header text-center">
                                          <h1 class="modal-title text-center">Información</h1>
                                      </div>
                                  <!--/ Header de la Ventana -->

                                  <!-- Contenido de la Ventana -->
                                      <div class="modal-body text-justify">
                                          <p>
                                              <strong>El Usuario Nivel 1 </strong> podrá administrar:
                                          </p>                                              
                  
                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              1- Las informaciones del 
                                              &quot;<em>Front-End del Sitio Informativo</em>&quot;.
                                          </p>

                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              2- El área de &quot;<em>Publicaciones de Noticias</em>&quot;.
                                          </p>

                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              3- El &quot;<em>Panel de Usuarios</em>&quot;.
                                          </p>

                                          <br>
                                          <br>
                                           <p>
                                              <strong>El Usuario Nivel 2 </strong> podrá administrar:
                                          </p>                                              
                  
                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              1- Las informaciones del 
                                              &quot;<em>Front-End del Sitio Informativo</em>&quot;.
                                          </p>

                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              2- El área de &quot;<em>Publicaciones de Noticias</em>&quot;.
                                          </p>


                                          <br>
                                          <br>
                                           <p>
                                              <strong>El Usuario Nivel 3 </strong> podrá administrar:
                                          </p>                                              
                  
                                          <p>
                                              &nbsp;  &nbsp;  &nbsp; 
                                              1- Las informaciones del 
                                              &quot;<em>Front-End del Sitio Informativo</em>&quot;.
                                          </p>

                                          
                                      </div>
                                  <!--/ Contenido de la Ventana -->

                                  <!-- Footer de la Ventana -->
                                      <div class="modal-footer hidden-xs">
                                          <div class="text-center">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal" title = "Cerrar">
                                                  <i class="fa fa-times-circle"></i>
                                                  <span> Cerrar</span>
                                              </button>
                                          </div>            
                                      </div>
                                 
                                      <div class="modal-footer visible-xs">
                                          <div class="text-center">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal" title = "Cerrar">
                                                  <i class="fa fa-times-circle"></i>
                                              </button>
                                          </div>
                                      </div>
                                   <!-- /Footer de la Ventana -->
                              </div>
                          </div>
                      </div> 
                  <!-- /Ventana para Informacion del Usuario--> 

                  
              </div>
          </div>
      </div>
  </div>
<!-- /page content -->