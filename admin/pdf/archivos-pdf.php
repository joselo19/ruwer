<?php 

		//recuperando los datos por medio del ID
        if(!isset($_GET['pdf_archivo'])){ 
          exit;
        }

        $pdf = $_GET['pdf_archivo'];
      
    		$archivo = $pdf;
    		$file = $archivo;
        
       
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
                           
        header('Accept-Ranges: bytes');
        @readfile($file);

       // echo $file;

 ?>

 