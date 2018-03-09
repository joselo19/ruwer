<!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <!-- Titulo -->
                      <div class="x_title">
                          <h2>
                              Editar Autoridad
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
                          if(!isset($_GET['id'])){ 
                            header("Location: index.php?accion=equipo"); 
                            exit;
                          }

                          $id = $_GET['id'];
                          $select = "SELECT * from equipo WHERE id_miembro=:id";
                          $contagem =1;

                          try{
                              $result = $conexion->prepare($select);
                              $result->bindParam(':id', $id, PDO::PARAM_INT);     
                              $result->execute();
                              $contar = $result->rowCount();
                                          
                              if($contar>0){
                                  while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                      $id = $mostrar->id_miembro;
                                      $nombre = $mostrar->nombre_miembro;
                                      $apellido = $mostrar->apellido_miembro;
                                      $cargo = $mostrar->cargo_miembro;
                                      $descripcion = $mostrar->descripcion_miembro;
                                      $imagen = $mostrar->imagen_miembro;
                                  }       
                              }else{
                                  echo '<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Aviso!</strong> No existe el Miembro en el Equipo de Trabajo.
                                       </div>';
                                      exit;
                              }
                                          
                          }catch(PDOException $e){
                            echo $e;
                          }           
                                              
                          $novoNome = $imagen;

                          //Actualizando los datos
                          if(isset($_POST['actualizar'])){
                              $nombre      = trim(strip_tags($_POST['nombre']));
                              $apellido    = trim(strip_tags($_POST['apellido'])); 
                              $cargo       = trim(strip_tags($_POST['cargo']));
                              $descripcion    = trim($_POST['descripcion']);
                                        
                              //si el campo no esta vacio actualiza con la misma imagen
                              if(!empty($_FILES['img']['name'])){
                                  //INFO IMAGEM
                                  $file     = $_FILES['img'];
                                  $numFile  = count(array_filter($file['name']));
                                          
                                  //direccion en donde se guardaran las imagenes
                                  $folder   = '../imagenes/empresa/img_equipo/';
                                          
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
                                      /*echo '<div class="alert alert-danger">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          Seleccione una imagen e intente nuevamente!
                                        </div>';*/
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
                                                $arquivo = "../imagenes/empresa/img_equipo/" .$imagen;
                                                unlink($arquivo);

                                              }else
                                                $msg[] = "<b>$name :</b> Disculpe! Ocurrió un error...";       
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


                              $update = "UPDATE equipo SET nombre_miembro=:nombre_miembro, apellido_miembro=:apellido_miembro, 
                                        descripcion_miembro=:descripcion_miembro, imagen_miembro=:imagen_miembro, cargo_miembro=:cargo_miembro 
                                        WHERE id_miembro=:id_miembro";
                                                
                              try{
                                  $result = $conexion->prepare($update);
                                  $result->bindParam(':id_miembro', $id, PDO::PARAM_INT);             
                                  $result->bindParam(':imagen_miembro', $novoNome, PDO::PARAM_STR);
                                  $result->bindParam(':nombre_miembro', $nombre, PDO::PARAM_STR);  
                                  $result->bindParam(':apellido_miembro', $apellido, PDO::PARAM_STR);
                                  $result->bindParam(':descripcion_miembro', $descripcion, PDO::PARAM_STR);
                                  $result->bindParam(':cargo_miembro', $cargo, PDO::PARAM_STR);
                                            
                                  $result->execute();
                                  $contar = $result->rowCount();

                                  if($contar>0){
                                        echo '<div class="alert alert-success">
                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                  <strong>Exito!</strong> información del Miembro actualizada.
                                              </div>';
                                  }else{
                                        echo '<div class="alert alert-danger">
                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                  <strong>No se pudo actualizar la información del Miembro del Equipo.</strong> 
                                              </div>';
                                  }     
                              }catch(PDOException $e){
                                echo $e;
                              }                   
                          } 
                      ?>       
                  <!-- /Trabajando con el Codigo PHP -->
                  
                  <!-- Contenido del Formulario-->
                      <div class="x_content">
                          <br />
                          <form id= "editar-equipo" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">                                      
                              <!--Foto-->
                                  <div class="form-group">
                                      <div id="portada">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                Foto 
                                                <span class="required">*</span>
                                          </label>

                                          <a href="#info-imagen" class="btn btn-small btn-warning" data-toggle="modal" title = "Información de la imagen a Subir">
                                              <i class="glyphicon glyphicon-question-sign"> </i>
                                          </a>  

                                          <div id="preview" class="thumbnail">
                                              <a href="#" id="file-select" class="btn btn-default">Elegir archivo</a>
                                              <img src="../imagenes/empresa/img_equipo/<?php echo $novoNome;?>" class = "img-thumbnail"/>
                                          </div>

                                          <div class="row">
                                              <div class="col-xs-12 col-md-4"></div>
                                              <div class="col-xs-12 col-md-4"><span class="alert alert-info" id="file-info">Foto: <?php echo $novoNome;?></span>  </div>
                                              <div class="col-xs-12 col-md-4"></div>
                                          </div>
       
                                          <input type="file" class="span6 fileinput" id="img2" name="img[]">
                                      </div>
                                  </div>
                              <!--/Foto-->

                                  <br>
                                  <br>

                              <!--Cargo-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Cargo
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" name="cargo" value="<?php echo $cargo;?>">
                                      </div>
                                  </div>
                              <!--/Cargo-->

                                  <br>
                                  <br>
                                          
                              <!--Nombre/s-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Nombre/s
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="nombre" name="nombre" value="<?php echo $nombre;?>" >
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

                              <!--Biografía-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                      Biografía
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea class="resizable_textarea form-control col-md-7 col-xs-12" placeholder="" id = "descripcion" name="descripcion">
                                                 <?php echo $descripcion;?>
                                            </textarea>
                                      </div>          
                                  </div>
                              <!--/Biografía-->

                              <br/>
                              <br/>

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
                                                          Quieres <strong>Actualizar</strong> la información de éste
                                                         Miembro del Equipo de Trabajo?...
                                                                    
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
                                
                  <!-- Ventana  Cancelar Actualizacion-->
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
                                              Quieres <strong>SALIR Y CANCELAR</strong> la actualización de la información de 
                                              éste Miembro del Equipo de Trabajo?...
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
                                      
                                              <a href="index.php?accion=equipo" class="btn btn-danger" title="Si quiero">
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
                                        
                                              <a href="index.php?accion=equipo" class="btn btn-danger" title="Si quiero">
                                                  <i class="fa fa-thumbs-up"></i>
                                              </a> 
                                          </div>
                                      </div>
                                  <!-- /Footer de la Ventana -->
                              </div>
                          </div>
                      </div>
                  <!-- /Ventana  Cancelar Actualizacion-->

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
                                              La imagen a <strong>reemplazar:</strong>
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
              </div>
          </div>
      </div>
  </div>
<!-- /page content -->