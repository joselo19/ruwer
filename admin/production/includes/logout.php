<?php
	if(isset($_REQUEST['salir'])){	
		session_destroy();
		session_unset($_SESSION['usuario_system']);
		session_unset($_SESSION['password_system']);	
		header("Location: login.php");	
	}
?>