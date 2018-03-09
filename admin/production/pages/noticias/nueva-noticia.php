<!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <!-- Titulo -->
                      <div class="x_title">
                          <h2>
                              Crear Nueva Noticia
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
                          if(isset($_POST['postear'])){
                              $titulo     = trim(strip_tags($_POST['titulo']));
                              $fecha      = date("Y-m-d");//trim(strip_tags($_POST['fecha']));
                              $descripcion  = $_POST['descripcion'];

                              //INFO IMAGEM
                              $file     = $_FILES['img'];
                              $numFile  = count(array_filter($file['name']));
                                  
                              //direccion en donde se guardaran las imagenes
                              $folder   = '../imagenes/noticias/';
                                  
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
                              }else{
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
                    
                                                $insert = "INSERT into noticias (titulo_noticia, fecha_noticia, imagen_noticia, descripcion_noticia) 
                                                            VALUES (:titulo_noticia, :fecha_noticia, :imagen_noticia, :descripcion_noticia)";
                                      
                                                try{
                                                    $result = $conexion->prepare($insert);
                                                    $result->bindParam(':titulo_noticia', $titulo, PDO::PARAM_STR);
                                                    $result->bindParam(':fecha_noticia', $fecha, PDO::PARAM_STR);
                                                    $result->bindParam(':imagen_noticia', $novoNome, PDO::PARAM_STR);
                                                    $result->bindParam(':descripcion_noticia', $descripcion, PDO::PARAM_STR);

                                                    $result->execute();
                                                    $contar = $result->rowCount();

                                                    $lastId = $conexion->lastInsertId('noticias');; // ultimo id de la tabla noticias

                                                    if($contar>0){
                                                      echo '<div class="alert alert-success">
                                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                                <strong>Exito!</strong> Noticia publicada.
                                                            </div>';
                                                    }else{
                                                      echo '<div class="alert alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                                <strong>Error!</strong> No fue posible publicar la noticia.
                                                            </div>';
                                                    }     
                                                }catch(PDOException $e){
                                                    echo $e;
                                                }
                                            }
                                            else
                                                $msg[] = "<b>$name :</b> Disculpe! Ocurrió un error...";
                                        }
                                  }
                                    
                                        foreach($msg as $pop)
                                            echo '';
                                            //echo $pop.'<br>';
                              }          
                          }// if(isset($_POST['postear'])){                                  
                      ?>
                  <!-- /Trabajando con el Codigo PHP -->
                  
                  <!-- Contenido del Formulario-->
                      <div class="x_content">
                          <form id ="nueva-noticia" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">                                      
                              <!--Portada de la Noticia-->
                                  <div class="form-group">
                                      <div id="portada">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                Portada de la Noticia
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
                              <!--/Portada de la noticia-->

                              <br>
                              <br>            
                                                      
                              <!--Titulo-->
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Título
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="titulo" name="titulo" placeholder="Titulo de la Noticia">
                                      </div>
                                  </div>
                              <!--/Titulo-->

                              <br>
                              <br>

                               <!--Fecha de Publicación-->
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Fecha de Publicación
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="fecha" name="fecha" placeholder="<?php echo  $fecha = date("d-m-Y");?>" disabled>
                                      </div>
                                  </div>
                              <!--/Fecha de Publicación-->

                              <br>
                              <br>

                              <!--Descripción-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Descripción
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea class="resizable_textarea form-control col-md-7 col-xs-12" placeholder="" id = "descripcion" name="descripcion"></textarea>
                                      </div>          
                                  </div>
                              <!--/Descripción-->

                              <br>
                              <br>

                              <!--Botones Maximizados-->
                                  <div class="text-center hidden-xs">
                                      <a href="#crear-registro" class="btn btn-primary fileinput-button" data-toggle="modal" title = "Publicar">
                                          <i class="glyphicon glyphicon-ok-circle"></i>
                                          <span> Publicar</span>
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
                                                      <h1 class="modal-title text-center" id="myModalLabel2">PUBLICAR</h1>
                                                  </div>
                                              <!-- /Header de la Ventana -->

                                              <!-- Contenido de la Ventana -->
                                                  <div class="modal-body text-justify">
                                                      <p>
                                                          <strong><?php echo $usuarioLogueado;?></strong>.. 
                                                          Quieres <strong>PUBLICAR</strong> ésta Nueva Noticia?.
                                                      </p>
                                                  </div>
                                              <!-- /Contenido de la Ventana -->

                                              <!-- Footer de la Ventana -->
                                                  <div class="modal-footer hidden-xs">
                                                      <div class="text-center"> 
                                                          <span class="btn btn-primary fileinput-button" title = "Si quiero">
                                                              <i class="fa fa-thumbs-up"></i>
                                                              <span> Si quiero</span>
                                                              <input type="submit" name="postear">
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
                                                              <input type="submit" name="postear">
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
                                              Quieres <strong>SALIR Y CANCELAR</strong> la publicación de
                                              ésta nueva Noticia?.
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
                                      
                                              <a href="index.php?accion=lista-noticias" class="btn btn-danger" title="Si quiero">
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
                                        
                                              <a href="index.php?accion=lista-noticias" class="btn btn-danger" title="Si quiero">
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
              </div>
          </div>
      </div>
  </div>
<!-- /page content -->