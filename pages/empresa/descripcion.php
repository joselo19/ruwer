<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <i class="fa fa-university"></i> 
                ¿Quiénes somos?<small></small>
            </h2>
                            
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
                            
            <div class="clearfix"></div>
        </div>

        <div class="x_content text-justify">
                <?php 
                    $sql = "SELECT * FROM empresa";

                    try{
                        $resultado = $conexion->prepare($sql);
                        $resultado->execute();
                        $contar = $resultado->rowCount();
                                                            
                        if($contar > 0 ){
                            while($mostrar = $resultado->fetch(PDO::FETCH_OBJ)){
                                echo $mostrar->informacion_empresa; 
             
                            }//while
                        }else{
                             echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Aviso!</strong> No existe información registrada.
                                </div>';
                        }

                    }catch(PDOException $erro){ 
                        echo $erro;
                    }
                ?>    
        </div>
    </div>
</div>