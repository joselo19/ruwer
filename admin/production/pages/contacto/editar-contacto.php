<!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <!-- Titulo -->
                      <div class="x_title">
                          <h2>
                              Editar Contacto
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
                        $select = "SELECT * FROM contacto";

                        try{
                              $result = $conexion->prepare($select); 
                              $result->execute();
                              $contar = $result->rowCount();
                                          
                              if($contar>0){
                                  while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                                      $idCon     = $mostrar->id_contacto;
                                      $direccion  = $mostrar->direccion_contacto;
                                      $celular = $mostrar->celular_contacto;
                                      $telefono = $mostrar->telefono_contacto;
                                      $email   = $mostrar->email_contacto;
                                      $atencion   = $mostrar->atencion_contacto;
                                  }       
                              }else{
                                  echo '<div class="alert alert-danger">
                                              <button type="button" class="close" data-dismiss="alert">×</button>
                                              <strong>Aviso!</strong> No existen informaciones referente al Contacto.
                                        </div>'; 
                              }
                                          
                          }catch(PDOException $e){
                              echo $e;
                          } 


                          if(isset($_POST['actualizar'])){
                              $direccion       = trim(strip_tags($_POST['direccion']));
                              $telefono        = trim(strip_tags($_POST['telefono']));
                              $celular         = trim(strip_tags($_POST['celular']));
                              $email           = trim(strip_tags($_POST['email']));
                              $atencion        = trim(strip_tags($_POST['atencion']));
                              
                      
                              $update = "UPDATE contacto 
                                         SET direccion_contacto=:direccion_contacto, telefono_contacto=:telefono_contacto, 
                                            celular_contacto=:celular_contacto, email_contacto=:email_contacto, atencion_contacto=:atencion_contacto 
                                         WHERE id_contacto=:id_contacto";
                              
                              
                              try{
                                  $result = $conexion->prepare($update);
                                  $result->bindParam(':id_contacto', $idCon, PDO::PARAM_INT);
                                  $result->bindParam(':direccion_contacto', $direccion, PDO::PARAM_STR);
                                  $result->bindParam(':telefono_contacto', $telefono, PDO::PARAM_STR);
                                  $result->bindParam(':celular_contacto', $celular, PDO::PARAM_STR);
                                  $result->bindParam(':email_contacto', $email, PDO::PARAM_STR);
                                  $result->bindParam(':atencion_contacto', $atencion, PDO::PARAM_STR);
                                                   
                                  $result->execute();
                                  $contar = $result->rowCount();

                                  if($contar>0){
                                      echo '<div class="alert alert-success">
                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                  <strong>Exito!</strong> Contacto Actualizado.
                                            </div>';
                                  }else{
                                      echo '<div class="alert alert-danger">
                                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                                  <strong>No se pudo actualizar la información del Contacto.</strong> 
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

                          <form id="editar-contacto" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">                                      
                              <!--Direccion-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        Dirección 
                                        <span class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" id="direccion" name="direccion" value="<?php echo $direccion;?>" required>
                                    </div>
                                </div>
                              <!--/Direccion-->
                                          

                              <!--Telefono-->
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Teléfono 
                                          <span class="required">*</span>
                                      </label>
                                      
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="telefono" name="telefono" value="<?php echo $telefono;?>" required>
                                      </div>
                                  </div>
                              <!--/Telefono-->


                              <!--Celular-->
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Celular 
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="celular" name="celular" value="<?php echo $celular;?>" required>
                                      </div>
                                  </div>
                              <!--/Celular-->

                  
                              <!--Email-->
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Email 
                                          <span class="required">*</span>
                                      </label>
                                      
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="email" name="email" value="<?php echo $email;?>" required>
                                      </div>
                                  </div>
                              <!--/Email-->
                                          

                              <!--Horario de Atención-->
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                          Horario de Atención 
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" class="form-control col-md-7 col-xs-12" id="atencion" name="atencion" value="<?php echo $atencion;?>" required>
                                      </div>
                                  </div>
                              <!--/Horario de Atención-->

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
                                                              del Contacto???..
                                                             
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
                                              Quieres <strong>SALIR Y CANCELAR</strong> la edición del 
                                              Contacto?...
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