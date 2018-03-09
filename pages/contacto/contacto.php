<div class="right_col" role="main">
    <!-- Mensaje de la Página-->            
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="bs-example" data-example-id="simple-jumbotron">
                                <div class="jumbotron" style=" background: #2A3F54; color: white;">
                                    <h1 class="text-center">Contacto</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Mensaje de la Página-->    
  
    <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-phone"></i> Contacto de la Empresa <small></small></h2>

                      <ul class="nav navbar-right panel_toolbox">
                          <li>
                              <a class="collapse-link">
                                  <i class="fa fa-chevron-up"></i>
                              </a>
                          </li>
                      </ul>
                      
                      <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content">
                      <div class="col-xs-2">
                          <!-- required for floating -->
                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs tabs-left">
                              <li class="active">
                                  <a href="#direccion" data-toggle="tab">Dirección</a>
                              </li>

                              <li class="">
                                  <a href="#telefono" data-toggle="tab">Teléfono</a>
                              </li>

                              <li class="">
                                  <a href="#fax" data-toggle="tab">Celular</a>
                              </li>

                              <li class="">
                                  <a href="#email" data-toggle="tab">Email</a>
                              </li>

                              <li class="">
                                  <a href="#horario" data-toggle="tab">Horario de Atención</a>
                              </li>
                          </ul>
                      </div>


                      <div class="col-xs-10">
                          <!-- Tab panes -->
                          <div class="tab-content">
                              <?php 
                                  $select = "SELECT * from contacto";
                                                                                                                                           
                                  try{
                                      $result = $conexion->prepare($select);     
                                      $result->execute();
                                      $contar = $result->rowCount();
                                                                                                                    
                                      if($contar>0){
                                          while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                              ?>
                                              <div class="tab-pane active" id="direccion">
                                                  <p class="lead">Dirección</p>
                                                  <p><?php echo $mostrar->direccion_contacto; ?></p>
                                              </div>

                                              <div class="tab-pane" id="telefono">
                                                  <p class="lead">Teléfono</p>
                                                  <p><?php echo $mostrar->telefono_contacto; ?></p>
                                              </div>
                                              
                                              <div class="tab-pane" id="fax">
                                                  <p class="lead">Celular</p>
                                                  <p><?php echo $mostrar->celular_contacto; ?></p>
                                              </div>

                                              <div class="tab-pane" id="email">
                                                  <p class="lead">Email</p>
                                                  <p><?php echo $mostrar->email_contacto; ?></p>
                                              </div>

                                               <div class="tab-pane" id="horario">
                                                  <p class="lead">Horario de Atención</p>
                                                  <p><?php echo $mostrar->atencion_contacto; ?></p>
                                              </div>
                              <?php 
                                           }//fin del while
                                      }//fin del if
                                                                                       
                                  }catch (PDOWException $erro){ 
                                      echo $erro;
                                  }   
                              ?>  
                          </div>
                      </div>

                    <div class="clearfix"></div>
                  </div>
              </div>
          </div>
    </div>
</div>