        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login al Sistema</title>

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
        <!-- Animate.css -->
        <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">

        <!-- Validacion de los Campos de los Formularios-->
        <script src="../validaciones/Jquery/jquery-1.11.1.js"></script>
        <script src="../validaciones/js/validate.js"></script>
        <script src="../validaciones/validation.js"></script>