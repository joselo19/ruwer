<!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <!-- Titulo -->
                      <div class="x_title">
                          <h2>
                              Crear un Video Empresarial
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
                          if(isset($_POST['crear'])){                
                              $direccion  = $_POST['direccion_video'];

                              //INFO IMAGEM
                              $file     = $_FILES['img'];
                              $numFile  = count(array_filter($file['name']));
                                  
                              //direccion en donde se guardaran las imagenes
                              $folder   = '../imagenes/empresa/img_video/';
                                  
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
                                  echo '<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            Seleccione una imagen e intente nuevamente!
                                        </div>';
                              }
                              else if($numFile >=2){
                                  echo '<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            Solo puede seleccionar 1 imágen!.
                                        </div>';
                              }
                              else{
                                  for($i = 0; $i < $numFile; $i++){
                                        $name   = $file['name'][$i];
                                        $type   = $file['type'][$i];
                                        $size   = $file['size'][$i];
                                        $error  = $file['error'][$i];
                                        $tmp    = $file['tmp_name'][$i];
                                        
                                        $extensao = @end(explode('.', $name));
                                        $novoNome = rand().".$extensao";
                                        
                                        if($error != 0)
                                            echo $msg[] = "<b>$name :</b> ".$errorMsg[$error];
                                        else if(!in_array($type, $permite))
                                            echo $msg[] = '<div class="alert alert-danger">
                                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                              El fichero <b>' . $name . ' </b>, no es un archivo permitido.
                                                          </div>';
                                        else if($size > $maxSize)
                                            echo $msg[] = "<b>$name :</b> Error la imagen supera el tamaño de 5MB";
                                        else{

                                            if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                                                
                                                $insert = "INSERT into video (portada_video, video_direccion) 
                                                          VALUES (:portada_video, :video_direccion)";
                                      
                                                try{
                                                    $result = $conexion->prepare($insert);
                                                    $result->bindParam(':portada_video', $novoNome, PDO::PARAM_STR);
                                                    $result->bindParam(':video_direccion', $direccion, PDO::PARAM_STR);

                                                    $result->execute();
                                                    $contar = $result->rowCount();

                                                    if($contar>0){
                                                      echo '<div class="alert alert-success">
                                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                                <strong>Exito!</strong> Nuevo Video Empresarial Registrado.
                                                            </div>';
                                                    }else{
                                                      echo '<div class="alert alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                                <strong>Error!</strong> No fue posible registrar el Video Empresarial.
                                                            </div>';
                                                    }     
                                                }catch(PDOException $e){
                                                    echo $e;
                                                }
                                            }
                                            else
                                                $msg[] = "<b>$name :</b> Disculpe! Ocurrió un error...";
                                        }
                                  }// for
                                    
                                        foreach($msg as $pop)
                                            echo '';
                                            //echo $pop.'<br>';
                              }
                          }                                   
                      ?>
                  <!-- /Trabajando con el Codigo PHP -->
                  
                  <!-- Contenido del Formulario-->
                      <div class="x_content">
                          <br />

                          <?php 
                              $select = "SELECT * from video";
                                                                                                                                       
                              try{
                                  $result = $conexion->prepare($select);     
                                  $result->execute();
                                  $contar = $result->rowCount();
                                                                                                                
                                  if($contar<=0){
                          ?>
                                      <form id="nuevo-video" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>                                      
                                          <!--Imagen de Portada-->
                                              <div class="form-group">
                                                  <div id="portada">
                                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                            Imagen de Portada 
                                                            <span class="required">*</span>
                                                      </label>

                                                      <a href="#info-imagen" class="btn btn-small btn-warning" data-toggle="modal" title = "Información de la imagen a Subir">
                                                          <i class="glyphicon glyphicon-question-sign"> </i>
                                                      </a>  

                                                      <div id="preview" class="thumbnail">
                                                          <a href="#" id="file-select" class="btn btn-default">Elegir archivo</a>
                                                          <img src="images/subir.png" class = "img-thumbnail"/>
                                                      </div>

                                                      <div class="row">
                                                          <div class="col-xs-12 col-md-4"></div>
                                                          <div class="col-xs-12 col-md-4"><span class="alert alert-info" id="file-info">Ninguna imagen seleccionada</span></div>
                                                          <div class="col-xs-12 col-md-4"></div>
                                                      </div>
                                                               
                                                      <input type="file" class="span6 fileinput" id="img2" name="img[]">
                                                  </div>
                                              </div>
                                          <!--/Imagen de Portada-->

                                              <br>
                                              <br>
                                                      
                                          <!--Direccion del Video-->
                                              <div class="item form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                      Dirección del Video
                                                      <span class="required">*</span>
                                                  </label>

                                                  <a href="#info-video" class="btn btn-small btn-warning" data-toggle="modal" title = "Información del Video a Subir">
                                                      <i class="glyphicon glyphicon-question-sign"> </i>
                                                  </a> 
                  
                                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input type="text" class="form-control col-md-7 col-xs-12" id="direccion_video" name="direccion_video" placeholder="Dirección del Video" required>
                                                  </div>
                                              </div>
                                          <!--/Direccion del Video-->

                                          <br/>
                                          <br/>
                                          <br/>
                                        
                                          <!--Botones Maximizados-->
                                            <div class="text-center hidden-xs">
                                                <a href="#crear-registro" class="btn btn-primary fileinput-button" data-toggle="modal" title = "Crear">
                                                    <i class="glyphicon glyphicon-ok-circle"></i>
                                                    <span> Crear</span>
                                                </a>
                            
                                                <a href="#cancelar-creacion" class="btn btn-danger" data-toggle="modal" title = "Cancelar">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                    <span> Cancelar</span>
                                                </a>
                                            </div>
                                          <!--/Botones Maximizados-->
                                          
                                          <!--Botones Minimizados-->
                                            <div class="text-center visible-xs">
                                                <a href="#crear-registro" class="btn btn-primary fileinput-button" data-toggle="modal" title = "Crear">
                                                    <i class="glyphicon glyphicon-ok-circle"></i>
                                                </a>

                                                <a href="#cancelar-creacion" class="btn btn-danger" data-toggle="modal" title = "Cancelar">
                                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                                </a>
                                            </div> 
                                          <!--/Botones Minimizados-->  

                                          <!-- Ventana  Crear Registro-->
                                              <div class="modal fade" id="crear-registro">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <!-- Header de la Ventana -->
                                                              <div class="modal-header">
                                                                  <h1 class="modal-title text-center" id="myModalLabel2">Crear</h1>
                                                              </div>
                                                          <!-- /Header de la Ventana -->

                                                          <!-- Contenido de la Ventana -->
                                                              <div class="modal-body text-justify">
                                                                  <p>
                                                                      <strong><?php echo $usuarioLogueado;?></strong>.. 
                                                                      Quieres <strong>CREAR</strong> el Video Empresarial?.
                                                                     
                                                                  </p>
                                                              </div>
                                                          <!-- /Contenido de la Ventana -->

                                                          <!-- Footer de la Ventana -->
                                                              <div class="modal-footer hidden-xs">
                                                                  <div class="text-center"> 
                                                                      <span class="btn btn-primary fileinput-button" title = "Si quiero">
                                                                          <i class="fa fa-thumbs-up"></i>
                                                                          <span> Si quiero</span>
                                                                          <input type="submit" name="crear">
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
                                                                          <input type="submit" name="crear">
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
                                          <!-- /Ventana  Crear Registro-->                
                                      </form>
                          <?php 
                                  }//fin del if
                                  else{
                          ?>
                                      <span><strong>El Video Empresarial ya se encuentra creado!!!..
                                       No es posible crear más de uno.</strong></span>

                                      <br>
                                      <br>

                                      <div class="text-center">
                                          <a href="index.php?accion=video" class="btn btn-danger" title="Salir">
                                               <i class="fa fa-thumbs-up"></i>
                                               Salir
                                          </a> 
                                      </div>
                          <?php
                                  }
                                                                                   
                              }catch (PDOWException $erro){ 
                                  echo $erro;
                              }   
                          ?>  
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
                                              Quieres <strong>SALIR Y CANCELAR</strong> la creación 
                                              del Video Empresarial?.
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
                                      
                                              <a href="index.php?accion=video" class="btn btn-danger" title="Si quiero">
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
                                        
                                              <a href="index.php?accion=video" class="btn btn-danger" title="Si quiero">
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
                                              La imagen a <strong>subir:</strong>
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

                  <!-- Ventana para Informacion del Video-->
                      <div class="modal fade" id="info-video">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <!-- Header de la Ventana -->
                                      <div class="modal-header text-center">
                                          <h1 class="modal-title text-center">Información - Video</h1>
                                      </div>
                                  <!-- /Header de la Ventana -->
                                  
                                  <!-- Contenido de la Ventana -->
                                      <div class="modal-body text-justify">
                                          <p>
                                              Para <strong>agregar</strong> el Vídeo Empresarial
                                              usted solo debe ingresar la última parte de la
                                              <strong>URL Web</strong>, la parte en negritas de colora zul.
                                          </p>

                                          <p>
                                              <ins>Ejemplo</ins>: 
                                              &quot;https://www.youtube.com/watch?v=<strong style ="color: #291EC2;">dOxjEnakguA</strong>&quot;
                                          </p>                                               
                                      </div>
                                  <!-- /Contenido de la Ventana -->

                                  <!-- Footer de la Ventana -->
                                      <div class="modal-footer hidden-xs">
                                          <div class="text-center">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal" title = "Cerrar">
                                                  <i class="glyphicon glyphicon-ok-circle"></i>
                                                  <span> Cerrar</span>
                                              </button>
                                          </div>
                                      </div>
                                                  
                                      <div class="modal-footer visible-xs">
                                          <div class="text-center">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal" title = "Cerrar">
                                                  <i class="glyphicon glyphicon-ok-circle"></i>
                                              </button>
                                          </div>
                                      </div>
                                  <!-- /Footer de la Ventana -->
                              </div>
                          </div>
                      </div>
                  <!-- /Ventana para Informacion del Video--> 
              </div>
          </div>
      </div>
  </div>
<!-- /page content -->