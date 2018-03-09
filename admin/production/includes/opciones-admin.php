<?php			
		if(isset($_GET['accion'])){
			$accion = $_GET['accion'];

			switch ($accion) {
				/*------------------------------------------------------------*/
				//INICIO 
				/*------------------------------------------------------------*/
				case 'welcome': // inicio para el administrador
					$contenido_admin = "pages/inicio.php";
					$titulo_admin = "Inicio";
					break;


				/*------------------------------------------------------------*/
				// EMPRESA
				/*------------------------------------------------------------*/
				case 'informacion': // Admin Info
					$contenido_admin = "pages/empresa/informacion/institucion.php";
					$titulo_admin = "Empresa";
					break;

				case 'editar-informacion': // Editar Info
					$contenido_admin = "pages/empresa/informacion/editar-institucion.php";
					$titulo_admin = "Editar Empresa";
					break;
				/**************************/


				case 'redes-sociales': // Admin Redes Sociales
					$contenido_admin = "pages/empresa/redes-sociales/redes-sociales.php";
					$titulo_admin = "Redes Sociales";
					break;


				/**************************/
				case 'video': // Admin Video
					$contenido_admin = "pages/empresa/video/video.php";
					$titulo_admin = "Video Empresarial";
					break;

				case 'nuevo-video': // Nuevo Video
					$contenido_admin = "pages/empresa/video/nuevo-video.php";
					$titulo_admin = "Nuevo Video";
					break;

				case 'editar-video': // Editar Video
					$contenido_admin = "pages/empresa/video/editar-video.php";
					$titulo_admin = "Editar Video";
					break;


				/**************************/
				case 'equipo': // Admin Equipo
					$contenido_admin = "pages/empresa/equipo/equipo.php";
					$titulo_admin = "Equipo de Trabajo";
					break;

				case 'nuevo-equipo': // Nuevo Miembro
					$contenido_admin = "pages/empresa/equipo/nuevo-equipo.php";
					$titulo_admin = "Nuevo Miembro";
					break;

				case 'editar-equipo': // Editar Miembro
					$contenido_admin = "pages/empresa/equipo/editar-equipo.php";
					$titulo_admin = "Editar Miembro";
					break;



				/*------------------------------------------------------------*/
				// ARCHIVOS PDF
				/*------------------------------------------------------------*/
				case 'pdf': // Admin Archivo PDF
					$contenido_admin = "pages/pdf/pdf.php";
					$titulo_admin = "Archivos PDF";
					break;

				case 'nuevo-pdf': // Nuevo Archivo PDF
					$contenido_admin = "pages/pdf/nuevo-pdf.php";
					$titulo_admin = "Nuevo PDF";
					break;

				case 'editar-pdf': // Editar Archivo PDF
					$contenido_admin = "pages/pdf/editar-pdf.php";
					$titulo_admin = "Editar PDF";
					break;

		


				/*------------------------------------------------------------*/
				//SECCION NOTICIAS
				/*------------------------------------------------------------*/
				case 'nueva-noticia': // CREAR una nueva noticia
					$contenido_admin = "pages/noticias/nueva-noticia.php";
					$titulo_admin = "Nueva Noticia";
					break;

				case 'lista-noticias': // VER TODAS las noticias
					$contenido_admin = "pages/noticias/lista-noticias.php";
					$titulo_admin = "Listado de Noticias";
					break;

				case 'busca-noticia': // BUSCAR noticias
					$contenido_admin = "pages/noticias/busca-noticia.php";
					$titulo_admin = "Búsqueda de Noticias";
					break;

				case 'editar-noticia': // EDITAR las Noticias
					$contenido_admin = "pages/noticias/editar-noticia.php";
					$titulo_admin = "Edición de Noticias";
					break;



				/*------------------------------------------------------------*/
				//SECCION CONTACTO
				/*------------------------------------------------------------*/
				case 'editar-contacto': // Edición de Contacto
					$contenido_admin = "pages/contacto/editar-contacto.php";
					$titulo_admin = "Editar Contacto";
					break;
			


				/*------------------------------------------------------------*/
				//SECCION USUARIOS
				/*------------------------------------------------------------*/
				case 'lista-usuarios': // Listado de Usuarios
					$contenido_admin = "pages/usuarios/lista-usuarios.php";
					$titulo_admin = "Listado de Usuarios";
					break;

				case 'nuevo-usuario': // CREAR un nuevo USUARIO
					$contenido_admin = "pages/usuarios/nuevo-usuario.php";
					$titulo_admin = "Nuevo Usuario";
					break;

				

				/*------------------------------------------------------------*/
				//EDITAR PERFIL
				/*------------------------------------------------------------*/
				case 'editar-perfil': // Edición de Perfil
					$contenido_admin = "pages/perfil/editar-perfil.php";
					$titulo_admin = "Editar Perfil";
					break;



				/*------------------------------------------------------------*/
				//EDITAR PERFIL
				/*------------------------------------------------------------*/
				case 'ayuda': // Ayuda
					$contenido_admin = "pages/ayuda/ayuda.php";
					$titulo_admin = "Ayuda";
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