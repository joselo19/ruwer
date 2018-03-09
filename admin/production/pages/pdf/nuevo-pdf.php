          <!-- page content -->
                <div class="right_col" role="main">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <!-- Titulo -->
                                    <div class="x_title">
                                        <h2>
                                            Nuevo Archivo
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
                                          $titulo     = trim(strip_tags($_POST['titulo']));
                                          
                                          //INFO IMAGEM
                                          $file     = $_FILES['pdf'];
                                          $numFile  = count(array_filter($file['name']));
                                              
                                          //direccion en donde se guardaran los archivos
                                          $folder   = '../pdf/';
                                              
                                          //REQUISITOS
                                          $permite  = array('application/pdf');
                                          $maxSize  = 1024 * 1024 * 10;



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
                                                                  Seleccione un archivo PDF e intente nuevamente!
                                                              </div>';
                                                    }
                                                    else if($numFile >=2){
                                                        echo '<div class="alert alert-danger">
                                                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                  Solo puede seleccionar 1 archivo PDF!.
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
                                                                  echo $msg[] = "<b>$name :</b> Error el archivo PDF supera el tamaño de 10 MB";
                                                              else{

                                                                  if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                                                                      //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
                                                            
                                                                      $insert = "INSERT INTO archivos_pdf (titulo_archivo, archivo_pdf) 
                                                                                VALUES (:titulo_archivo, :archivo_pdf)";
                                                            
                                                                      try{
                                                                          $result = $conexion->prepare($insert);
                                                                          $result->bindParam(':titulo_archivo', $titulo, PDO::PARAM_STR);
                                                                          $result->bindParam(':archivo_pdf', $novoNome, PDO::PARAM_STR);
                                                                          $result->execute();
                                                                          $contar = $result->rowCount();

                                                                          if($contar>0){
                                                                            echo '<div class="alert alert-success">
                                                                                      <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                      <strong>Exito!</strong> Nuevo Archivo PDF creado.
                                                                                  </div>';
                                                                          }else{
                                                                            echo '<div class="alert alert-danger">
                                                                                      <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                      <strong>Error!</strong> No fue posible crear el Archivo PDF.
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
                                              
                                      } 
                                  ?>  
                                <!-- /Trabajando con el Codigo PHP -->
                                
                                <!-- Contenido del Formulario-->
                                    <div class="x_content">
                                        <br />

                                        <form id="nuevo-pdf" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>                                      
                                                       
                                            <!--Archivo PDF-->
                                                <div class="form-group">
                                                    <div id="portada">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                              Archivo PFD 
                                                              <span class="required">*</span>
                                                        </label>

                                                        <a href="#info-pdf" class="btn btn-small btn-warning" data-toggle="modal" title = "Información del PDF a Subir">
                                                            <i class="glyphicon glyphicon-question-sign"> </i>
                                                        </a>  

                                                        <div id="preview-pdf" class="thumbnail">
                                                            <a href="#" id="file-select-pdf" class="btn btn-default">Elegir archivo</a>
                                                            <img src="images/subir-pdf.png" class = "img-thumbnail"/>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-4"></div>
                                                            <div class="col-xs-12 col-md-4"><span class="alert alert-info" id="file-info-pdf">Ningún Documento PDF seleccionado</span> </div>
                                                            <div class="col-xs-12 col-md-4"></div>
                                                        </div>
                              
                                                        <input type="file" class="span6 fileinput" id="pdf" name="pdf[]">
                                                    </div>
                                                </div>
                                            <!--/Archivo PDF-->

                                            <br>
                                            <br>

                                            <!--Achivo Nombre-->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                        Nombre del Achivo
                                                        <span class="required">*</span>
                                                    </label>

                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control col-md-7 col-xs-12" id="titulo" name="titulo" placeholder="Título del Reglamento">
                                                    </div>
                                                </div>
                                            <!--/Achivo Nombre-->

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
                                                                        Quieres <strong>CREAR</strong> éste nuevo Archivo??......
                                                                      
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
                                                            Quieres <strong>SALIR Y CANCELAR</strong> la creación de
                                                            éste Archivo???...
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
                                                    
                                                            <a href="index.php?accion=pdf" class="btn btn-danger" title="Si quiero">
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
                                                      
                                                            <a href="index.php?accion=pdf" class="btn btn-danger" title="Si quiero">
                                                                <i class="fa fa-thumbs-up"></i>
                                                            </a> 
                                                        </div>
                                                    </div>
                                                <!-- /Footer de la Ventana -->
                                            </div>
                                        </div>
                                    </div>
                                <!-- /Ventana  Cancelar Creación-->

                                <!-- Ventana para Informacion del archivo PDF-->
                                    <div class="modal fade" id="info-pdf">
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
                                                            El archivo PDF a <strong>subir:</strong>
                                                        </p>                                              
                                
                                                        <p>
                                                            &nbsp;  &nbsp;  &nbsp; 
                                                            1- Podrá tener una tamaño máximo de hasta  
                                                            &quot;<em>5 MB</em>&quot;.
                                                        </p>

                                                        <p>
                                                            &nbsp;  &nbsp;  &nbsp;  
                                                            2- Debe de ser de tipo:    
                                                            &quot;<em>PDF</em>.
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
                                <!-- /Ventana para Informacion del archivo PDF-->  
                            </div>
                        </div>
                    </div>
                </div>
          <!-- /page content -->