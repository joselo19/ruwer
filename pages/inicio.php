<!-- page content -->
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
                                    <h1 class="text-center">Bienvenidos</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Mensaje de la Página-->
        
        <!-- Quienes somos-->
            <div class="row">
                <?php include("empresa/descripcion.php") ?>                
            </div>
        <!--/ Quienes somos-->

        <!--  Equipo de Trabajo-->
            <div class="row">
                <?php include("empresa/equipo.php") ?>
            </div>
        <!--/ Equipo de Trabajo-->

        <!-- Botones de las Redes Sociales-->
            <div class="row">
                <?php include("empresa/redes.php") ?>
            </div>
        <!--/ Botones de las Redes Sociales-->

        <!-- Video Institucional y Ultimas Noticias-->
            <div class="row">
                <!-- Video Institucional-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php include("empresa/video.php") ?> 
                    </div>
                <!-- /Video Institucional-->

                <!-- Ultimas Noticias-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php include("empresa/noticias.php") ?> 
                    </div>
                <!-- /Ultimas Noticias-->
            </div>
        <!--/ Video Institucional y Ultimas Noticias-->
    </div>
<!-- /page content -->