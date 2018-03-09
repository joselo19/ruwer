<!-- pagina del login-->
<?php
    include("login/inicio-sesion.php");
    include("conection/conecta.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Cabeza de la página-->
            <?php 
                include("login/head-login.php");
            ?>
        <!--/Cabeza de la página-->

        <script src="admin/Jquery/jquery-1.11.1.js"></script>
    </head>

    <body class="login" style="background:#2A3F54;">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <!--Formulario de Login al Sistema-->
                    <?php 
                        include("login/formulario-login.php");
                    ?>
                <!--/Formulario de Login al Sistema-->
                
                <!--Formulario de Recuperar Cuenta-->
                    <?php 
                        include("login/formulario-recuperar.php");
                    ?>
                <!--/Formulario de Recuperar Cuenta-->
            </div>
        </div>

        <!--Archivos JS-->
            <?php 
                include("login/js-login.php");
            ?>
        <!--/Archivos JS-->
    </body>
</html>
