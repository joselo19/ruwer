<?php
	ob_start();
	session_start();
	
	//si no esta logueado redirecciona al index
	if(!isset($_SESSION['usuario_system']) && (!isset($_SESSION['password_system']))){
		header("Location: login.php?accion=negado");
		exit;
	}
		include("conection/conecta.php");
		include("logout.php");
		
		//RECUPERANDO DATOS DEL USUARIO LOGUEADO
		$usuarioLogueado = $_SESSION['usuario_system'];
		$passwordLogueado = $_SESSION['password_system'];
	
		// seleciona a usuario logado
		$seleccionaLogueado = "SELECT * from usuarios WHERE usuario=:usuarioLogueado AND password=:passwordLogueado";
		
		try{
			$result = $conexion->prepare($seleccionaLogueado);	
			$result->bindParam('usuarioLogueado',$usuarioLogueado, PDO::PARAM_STR);		
			$result->bindParam('passwordLogueado',$passwordLogueado, PDO::PARAM_STR);		
			$result->execute();
			$contar = $result->rowCount();	
			
			if($contar = 1){
				$loop = $result->fetchAll();
				
				foreach ($loop as $show){
					$idLogueado = $show['id_usuario'];
					$userLogueado = $show['usuario'];
					$nivelLogueado = $show['nivel'];
					$nombreLogueado = $show['nombre'];
					$apellidoLogueado = $show['apellido'];
					$emailLogueado = $show['email'];
					$passwordLogueado = $show['password'];
					$fotoLogueado = $show['foto'];
				}
			}
			
		}catch (PDOWException $erro){ 
				echo $erro;
		}	
?>