<!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <!-- Titulo -->
                      <div class="x_title">
                          <h2>
                              Editar Archivo
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
                              header("Location: index.php?accion=pdf"); 
                              exit;
                            }

                            $id = $_GET['id'];
                            $select = "SELECT * from archivos_pdf WHERE id_archivo=:id_archivo";
                            $contagem =1;

                            try{
                                $result = $conexion->prepare($select);
                                $result->bindParam(':id_archivo', $id, PDO::PARAM_INT);     
                                $result->execute();
                                $contar = $result->rowCount();
                                            
                                if($contar>0){
                                    while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                        $idReg = $mostrar->id_archivo;
                                        $titulo = $mostrar->titulo_archivo;
                                        $archivo = $mostrar->archivo_pdf;
                                    }       
                                }else{
                                    echo '<div class="alert alert-danger">
                                              <button type="button" class="close" data-dismiss="alert">×</button>
                                              <strong>Aviso!</strong> No existe el Archivo PDF.
                                         </div>';
                                        exit;
                                }
                                            
                            }catch(PDOException $e){
                              echo $e;
                            }           
                                                
                            $novoNome = $archivo;

                            //Actualizando los datos
                            if(isset($_POST['actualizar'])){
                                $titulo     = trim(strip_tags($_POST['titulo']));
                                
                                //si el campo no esta vacio actualiza con la misma imagen
                                if(!empty($_FILES['pdf']['name'])){
                                    //INFO IMAGEM
                                    $file     = $_FILES['pdf'];
                                    $numFile  = count(array_filter($file['name']));
                                            
                                    //direccion en donde se guardaran las imagenes
                                    $folder   = '../pdf/';
                                            
                                    //REQUISITOS
                                    $permite  = array('application/pdf');
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
                                                    Seleccione un archivo PDF e intente nuevamente!
                                              </div>';*/
                                    }
                                    else if($numFile >=2){
                                        echo '<div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    Solo puede seleccionar 1 archivo!.
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
                                                echo $msg[] = "<b>$name :</b> Error archivo no soportada!";
                                            else if($size > $maxSize)
                                                echo $msg[] = "<b>$name :</b> Error el archivo supera el tamaño de 10 MB";
                                            else{
                                                if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                                                  //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
                                                    
                                                  // se edita la imagen y se borra la anterior del servidor
                                                  $arquivo = "../pdf/" .$archivo;
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
                                    $novoNome = $archivo;
                                } 


                                $update = "UPDATE archivos_pdf 
                                          SET titulo_archivo=:titulo_archivo, archivo_pdf=:archivo_pdf 
                                          WHERE id_archivo=:id_archivo";
                                                  
                                try{
                                    $result = $conexion->prepare($update);
                                              
                                    $result->bindParam(':id_archivo', $idReg, PDO::PARAM_INT);
                                    $result->bindParam(':titulo_archivo', $titulo, PDO::PARAM_STR);
                                    $result->bindParam(':archivo_pdf', $novoNome, PDO::PARAM_STR);
                                              
                                    $result->execute();
                                    $contar = $result->rowCount();

                                    if($contar>0){
                                          echo '<div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>Exito!</strong> Información del Arhivo Actualizada PDF.
                                                </div>';
                                    }else{
                                          echo '<div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>No se pudo actualizar la información del Archivo PDF.</strong> 
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
                          <form id="editar-pdf" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>                                      
                                <!--Archivo-->
                                    <div class="form-group">
                                        <div id="portada">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                  Archivo PDF 
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
                                                <div class="col-xs-12 col-md-4"><span class="alert alert-info" id="file-info-pdf">Archivo PDF "<?php echo $novoNome; ?></span> </div>
                                                <div class="col-xs-12 col-md-4"></div>
                                            </div>
                
                                            <input type="file" class="span6 fileinput" id="pdf" name="pdf[]">
                                        </div>
                                    </div>
                                <!--/Archivo-->

                                <br/>
                                <br/>

                                 <!--Archivo-->
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                            Nombre del Archivo
                                            <span class="required">*</span>
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="titulo" name="titulo" value="<?php echo $titulo;?>">
                                        </div>
                                    </div>
                                <!--/Archivo-->

                                <br>
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
                                                              de éste Archivo???.
                                                             
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
                                
                  <!-- Ventana  Cancelar Edición-->
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
                                              Quieres <strong>SALIR Y CANCELAR</strong> la edición del
                                              Archivo:  <?php echo $titulo;?> ??...
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
                  <!-- /Ventana  Cancelar Edición-->

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
                                              El archivo PDF a <strong>editar:</strong>
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