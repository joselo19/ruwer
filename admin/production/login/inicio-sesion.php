<?php 
	ob_start();
    session_start();
    
    //verificando si existe o no la sesion
    if(isset($_SESSION['usuario_system']) && (isset($_SESSION['password_system']))) {
        header("Location:index.php");
    }
 ?>