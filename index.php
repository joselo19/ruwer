<!-- Pagina Principal-->
    <?php 
        include("admin/production/conection/conecta.php");
        include("includes/opciones.php");
        include("admin/functions/limita-texto.php");
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <!--Cabeza de la página-->
                <?php 
                    include("includes/head.php");
                ?>
            <!--/Cabeza de la página-->
        </head>

        <body class="nav-md">
            <div class="container body">
                <div class="main_container">
                    <!--Cabeza de la página-->
                        <header class="#">
                            <?php 
                                include("includes/menu-vertical.php");
                                include("includes/menu-horizontal.php");
                            ?>
                        </header>
                    <!--/Cabeza de la página-->

                    <!--Cuerpo  de la página-->
                        <section>
                            <?php
                                include($contenido_admin);
                            ?>
                        </section>
                    <!--/Cuerpo  de la página-->

                    <!-- footer content -->
                        <footer style=" background: #d9d9d9;">
                            <?php 
                                include("includes/footer.php");
                            ?>
                        </footer>
                    <!-- /footer content -->
                </div>
            </div>

            <!--Archivos y Funcions JavaScript -->
                <?php 
                    include("includes/archivos-js.php");
                ?>
            <!--/Archivos y Funcions JavaScript -->  
        </body>
    </html>
<!-- /Pagina Principal-->