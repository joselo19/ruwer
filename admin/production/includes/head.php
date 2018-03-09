        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $titulo_admin; ?></title>

        <?php  
            $select = "SELECT * from empresa";

            try{
                $result = $conexion->prepare($select);   
                $result->execute();
                $contar = $result->rowCount();
                                    
                if($contar>0){
                    while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                        $imagen = $mostrar->imagen_empresa;
                    }       
                }
                                    
            }catch(PDOException $e){
                        echo $e;
            }  
        ?>
        
        <!-- Icono  de la pagina -->
        <link rel="shorcut icon" href="../imagenes/empresa/img_logo/<?php echo $imagen; ?>" type"image/x-icon">

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <!-- Portada para subida de imagenes -->
        <link href="css/img-portada.css" rel="stylesheet">
        <!-- Portada para subida de pdf -->
        <link href="css/img-pdf.css" rel="stylesheet">

        <!-- Validaciones del formulario -->
        <link href="../validaciones/validation.css" rel="stylesheet">



        <!-- Archivo del editor de texto -->
        <script src="ckeditor/ckeditor.js"></script>      

        <script src="../bootstrap/js/jquery.js"></script>