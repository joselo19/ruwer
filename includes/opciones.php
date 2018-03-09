<?php			
		if(isset($_GET['accion'])){
			$accion = $_GET['accion'];

			switch ($accion) {
				/*------------------------------------------------------------*/
				//INICIO 
				/*------------------------------------------------------------*/
				case 'welcome': // Inicio
						$contenido_admin = "pages/inicio.php";
						$titulo_admin = "Inicio";
						break;



			

				/*------------------------------------------------------------*/
				// ARCHIVOS PDF
				/*------------------------------------------------------------*/
					case 'pdf': // Admin Reglamentos
						$contenido_admin = "pages/archivos/pdf.php";
						$titulo_admin = "Archivos PDF";
						break;

			 


				/*------------------------------------------------------------*/
				//SECCION NOTICIAS
				/*------------------------------------------------------------*/
				
					case 'noticias': // VER TODAS las noticias
						$contenido_admin = "pages/noticias/noticias.php";
						$titulo_admin = "Noticias";
						break;

					case 'busca-noticia': // BUSCAR noticias
						$contenido_admin = "pages/noticias/busca-noticia.php";
						$titulo_admin = "Búsqueda de Noticias";
						break;

					case 'ver-noticia': // Ver la Noticia
						$contenido_admin = "pages/noticias/ver-noticia.php";
						$titulo_admin = "Visualizando Noticia";
						break;


				/*------------------------------------------------------------*/
				//SECCION CONTACTO
				/*------------------------------------------------------------*/
					case 'contacto': // Contacto
						$contenido_admin = "pages/contacto/contacto.php";
						$titulo_admin = "Contacto";
						break;

						

				/*------------------------------------------------------------*/
					default:
						$contenido_admin = "pages/inicio.php";// validacion de la URL
						$titulo_admin = "Inicio";
						break;
			}	
					
		}else{
			$contenido_admin = "pages/inicio.php";
			$titulo_admin = "Inicio";
		}
?>