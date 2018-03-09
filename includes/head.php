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
        <link rel="shorcut icon" href="admin/imagenes/empresa/img_logo/<?php echo $imagen; ?>" type"image/x-icon">

        <!-- Bootstrap -->
        <link href="admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        
        <!-- NProgress -->
        <link href="admin/vendors/nprogress/nprogress.css" rel="stylesheet">
        
        <!-- iCheck -->
        <link href="admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        
        <!-- bootstrap-progressbar -->
        <link href="admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        
        <!-- JQVMap -->
        <link href="admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        
        <!-- Custom Theme Style -->
        <link href="admin/build/css/custom.min.css" rel="stylesheet">

        <!-- Lightbox -->
        <link href="admin/light/lightbox.css" rel="stylesheet">