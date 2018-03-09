<?php  
    $select = "SELECT * from empresa";

    try{
        $result = $conexion->prepare($select);   
        $result->execute();
        $contar = $result->rowCount();
                                    
        if($contar>0){
            while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                $nombre = $mostrar->nombre_empresa;
            }       
        }
                                    
    }catch(PDOException $e){
        echo $e;
    }  


    $select = "SELECT * from redesSociales";
                        
    try{
        $result = $conexion->prepare($select); 
        $result->execute();
        $contar = $result->rowCount();
                                              
        if($contar>0){
            while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
                $url_facebook  = $mostrar->url_facebook; 
                $url_instagram = $mostrar->url_instagram;
                $url_twitter  = $mostrar->url_twitter;
                $url_youtube  = $mostrar->url_youtube;
            }       
        }          
    }catch(PDOException $e){
        echo $e;
    } 
?>

<div class="pull-left">
    <a href="index.php?accion=home"> <?php echo $nombre; ?></a>

    
</div>


<div class="pull-right">
    <?php 
        if (!empty($url_facebook)){
    ?>
        <a href="<?php  echo $url_facebook;?>" class="" title = "Facebook" target="_blank">
           <i class="fa fa-facebook-square"></i>
        </a>
    <?php
        }

        if (!empty($url_twitter)){
    ?>
           	<a href="<?php  echo $url_twitter;?>" class="" title = "Twitter" target="_blank">
              	<i class="fa fa-twitter-square"></i>
           	</a>
   	<?php
       	}
                                       
       	if (!empty($url_instagram)){ 
   	?>
            <a href="<?php  echo $url_instagram;?>" class=" " title = "Instagram" target="_blank">
               <i class="fa fa-instagram"></i>
            </a>
    <?php 
        }
                                       
        if (!empty($url_youtube)){  
    ?>
            <a href="<?php  echo $url_youtube;?>" class="" title = "Youtube" target="_blank">
               <i class="fa fa-youtube-play"></i>
            </a>
    <?php 
        }
    ?>
    
</div>

<div class="clearfix"></div>