<!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <!-- Titulo -->
                      <div class="x_title">
                          <h2>
                              Redes Sociales
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
                          $select = "SELECT * from redesSociales";

                          try{
                              $result = $conexion->prepare($select); 
                              $result->execute();
                              $contar = $result->rowCount();
                                          
                              if($contar>0){
                                  while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                      $idRed     = $mostrar->id_social;
                                     
                                      $url_facebook  = $mostrar->url_facebook; 
                                      $url_instagram = $mostrar->url_instagram;
                                      $url_twitter  = $mostrar->url_twitter;
                                      $url_youtube  = $mostrar->url_youtube;
                                  }       
                              }else{
                                  echo '<div class="alert alert-danger">
                                              <button type="button" class="close" data-dismiss="alert">×</button>
                                              <strong>Aviso!</strong> No existen Redes Sociales registradas.
                                             
                                        </div>';
                                        //exit;
                              }
                                          
                          }catch(PDOException $e){
                              echo $e;
                          }  

                          if(isset($_POST['actualizar'])){
                              $url_facebook     = trim(strip_tags($_POST['url_facebook']));
                              $url_instagram   = trim(strip_tags($_POST['url_instagram']));
                              $url_twitter     = trim(strip_tags($_POST['url_twitter']));
                              $url_youtube     = trim(strip_tags($_POST['url_youtube']));
                              
                              
                      
                              $update = "UPDATE redesSociales 
                                         SET url_facebook=:url_facebook, url_instagram=:url_instagram, 
                                            url_twitter=:url_twitter, url_youtube=:url_youtube 
                                         WHERE id_social=:id_social";
                                          
                              try{
                                  $result = $conexion->prepare($update);
                                  $result->bindParam(':id_social', $idRed, PDO::PARAM_INT);
                                  $result->bindParam(':url_facebook', $url_facebook, PDO::PARAM_STR);
                                  $result->bindParam(':url_instagram', $url_instagram, PDO::PARAM_STR);
                                  $result->bindParam(':url_twitter', $url_twitter, PDO::PARAM_STR);
                                  $result->bindParam(':url_youtube', $url_youtube, PDO::PARAM_STR);
                                 
                                                   
                                  $result->execute();
                                  $contar = $result->rowCount();

                                  if($contar>0){
                                      echo '<div class="alert alert-success">
                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                  <strong>Exito!</strong> Información de las Redes Sociales actualizadas.
                                            </div>';
                                  }else{
                                      echo '<div class="alert alert-danger">
                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                  <strong>No se actualizó la información de las Rdees Sociales</strong> 
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

                          <form id="redes-sociales" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">                                      
                              <!--Facebook-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        Facebook
                                        <span class="required"></span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" value="Facebook" disabled>
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        URL de Facebook
                                        <span class="required"></span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" id="url_facebook" name="url_facebook" value="<?php echo $url_facebook;?>">
                                    </div>
                                </div>
                              <!--/Facebook-->

                              <br>
                              <br>

                              <!--Instragram-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        Instragram
                                        <span class="required"></span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" value="Instragram" disabled>
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        URL de Instragram
                                        <span class="required"></span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" id="url_instagram" name="url_instagram" value="<?php echo $url_instagram;?>">
                                    </div>
                                </div>
                              <!--/Instragram-->


                              <br>
                              <br>

                              <!--Twitter-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        Twitter
                                        <span class="required"></span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" value="Twitter" disabled>
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        URL de Twitter
                                        <span class="required"></span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" id="url_twitter" name="url_twitter" value="<?php echo $url_twitter;?>">
                                    </div>
                                </div>
                              <!--/Twitter-->


                              <br>
                              <br>

                              <!--YouTube-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        YouTube
                                        <span class="required"></span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" value="YouTube" disabled>
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        URL de YouTube
                                        <span class="required"></span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" id="url_youtube" name="url_youtube" value="<?php echo $url_youtube;?>">
                                    </div>
                                </div>
                              <!--/Twitter-->

                              <br>
                              <br>
                              <br>


                              <!--Botones Maximizados-->
                                    <div class="text-center hidden-xs">
                                        <a href="#actualizar-registro" class="btn btn-primary fileinput-button" data-toggle="modal" title = "Guardar">
                                            <i class="glyphicon glyphicon-ok-circle"></i>
                                            <span> Guardar</span>
                                        </a>
              
                                        <a href="#cancelar-creacion" class="btn btn-danger" data-toggle="modal" title = "Cancelar">
                                            <i class="glyphicon glyphicon-remove-sign"></i>
                                            <span> Cancelar</span>
                                        </a>
                                    </div>
                              <!--/Botones Maximizados-->
                              
                                <!--Botones Minimizados-->
                                    <div class="text-center visible-xs">
                                       <a href="#actualizar-registro" class="btn btn-primary fileinput-button" data-toggle="modal" title = "Guardar">
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
                                                              Quieres <strong>GUARDAR</strong> la información 
                                                              de las Redes Sociales?.
                                                             
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
                                              Quieres <strong>SALIR Y CANCELAR</strong> la edición de la
                                              información de las Redes Sociales?.
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
              </div>
          </div>
      </div>
  </div>
<!-- /page content -->