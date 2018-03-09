<!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <!-- Titulo -->
                      <div class="x_title">
                          <h2>
                              Editar Empresa
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
                            header("Location: index.php?accion=empresa"); 
                            exit;
                          }

                          $id = $_GET['id'];
                          $select = "SELECT * from empresa WHERE id_empresa=:id";
                          $contagem =1;

                          try{
                              $result = $conexion->prepare($select);
                              $result->bindParam(':id', $id, PDO::PARAM_INT);     
                              $result->execute();
                              $contar = $result->rowCount();
                                          
                              if($contar>0){
                                  while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                      $idLog = $mostrar->id_empresa;
                                      $nombre_empresa = $mostrar->nombre_empresa;
                                      $imagen = $mostrar->imagen_empresa;
                                      $descripcion = $mostrar->informacion_empresa;
                                  }       
                              }else{
                                  echo '<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Aviso!</strong> No existe la imágen que desea Editar.
                                       </div>';
                                      exit;
                              }
                                          
                          }catch(PDOException $e){
                            echo $e;
                          }           
                                              
                          $novoNome = $imagen;

                          //Actualizando los datos
                          if(isset($_POST['actualizar'])){                 
                              $nombre_empresa  = $_POST['nombre_empresa'];
                              $descripcion    = trim($_POST['descripcion']);
                            
                                        
                              //si el campo no esta vacio actualiza con la misma imagen
                              if(!empty($_FILES['img']['name'])){
                                  //INFO IMAGEM
                                  $file     = $_FILES['img'];
                                  $numFile  = count(array_filter($file['name']));
                                          
                                  //direccion en donde se guardaran las imagenes
                                  $folder   = '../imagenes/empresa/img_logo/';
                                          
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
                                                $arquivo = "../imagenes/empresa/img_logo/" . $imagen;
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


                              $update = "UPDATE empresa
                                        SET  nombre_empresa=:nombre_empresa, imagen_empresa=:imagen_empresa, informacion_empresa=:informacion_empresa 
                                        WHERE id_empresa=:id_empresa";
                                                
                              try{
                                  $result = $conexion->prepare($update);
                                  $result->bindParam(':id_empresa', $id, PDO::PARAM_INT);             
                                  $result->bindParam(':imagen_empresa', $novoNome, PDO::PARAM_STR); 
                                  $result->bindParam(':nombre_empresa', $nombre_empresa, PDO::PARAM_STR);
                                  $result->bindParam(':informacion_empresa', $descripcion, PDO::PARAM_STR);
                                            
                                  $result->execute();
                                  $contar = $result->rowCount();

                                  if($contar>0){
                                        echo '<div class="alert alert-success">
                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                  <strong>Exito!</strong> La información de la Empresa fue actualizada.
                                              </div>';
                                  }else{
                                        echo '<div class="alert alert-danger">
                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                  <strong>No se actualizó la información de la Empresa.</strong> 
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
                          <form id="editar_empresa" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">                                      
                              <!--Imagen Logo-->
                                  <div class="form-group">
                                      <div id="portada">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                Imagen Logo 
                                                <span class="required">*</span>
                                          </label>

                                          <a href="#info-imagen" class="btn btn-small btn-warning" data-toggle="modal" title = "Información de la imagen a Sustituir">
                                              <i class="glyphicon glyphicon-question-sign"> </i>
                                          </a>  

                                          <div id="preview" class="thumbnail">
                                              <a href="#" id="file-select" class="btn btn-default">Elegir archivo</a>
                                              <img src="../imagenes/empresa/img_logo/<?php echo $novoNome;?>" class = "img-thumbnail"/>
                                          </div>

                                          <div class="row">
                                                <div class="col-xs-12 col-md-4"></div>
                                                <div class="col-xs-12 col-md-4"><span class="alert alert-info" id="file-info">Imagen Logo: <?php echo $novoNome; ?></span></div>
                                                <div class="col-xs-12 col-md-4"></div>
                                            </div>
        
                                          <input type="file" class="span6 fileinput" id="img2" name="img[]">
                                      </div>
                                  </div>
                              <!--/Imagen Logo-->

                                  <br>
                                  <br>
                                          
                              <!--Nombre de la Empresa-->
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Nombre de la Empresa
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="nombre_empresa" name="nombre_empresa" value="<?php echo $nombre_empresa; ?>"  required>
                                      </div>
                                  </div>
                              <!--/Nombre de la Empresa-->

                              <br/>
                              <br/>
                              <br/>

                              <!--Descripción-->
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Información Empresarial
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea class="resizable_textarea form-control col-md-7 col-xs-12" placeholder="" id = "descripcion" name="descripcion">
                                                <?php echo $descripcion;?>
                                            </textarea>
                                      </div>          
                                  </div>
                              <!--/Descripción-->
                              
                              <br/>
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
                                                              Quieres <strong>ACTUALIZAR</strong> la información de la 
                                                              Empresa?.
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
                                              Quieres <strong>SALIR Y CANCELAR</strong> la edición de la información  
                                              de la Empresa?.
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
                                      
                                              <a href="index.php?accion=informacion" class="btn btn-danger" title="Si quiero">
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
                                        
                                              <a href="index.php?accion=informacion" class="btn btn-danger" title="Si quiero">
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
