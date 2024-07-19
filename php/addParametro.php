<?php

include 'conection.php';

$valorIg=$_POST['ParametroIg'];
$valorFb=$_POST['ParametroFb'];
$date = new DateTime();
$date->modify('-7 hours');
$dateDeParametro = $date->format('Y-m-d H:i:s');

$query = "INSERT INTO parametrosreportes (valorIg,valorFb,dateParametro) VALUES ($valorIg,$valorFb,'$dateDeParametro')";


$ejecutar=mysqli_query($conexion,$query);

if($ejecutar){
    echo '
        <script>
            alert("registrado correctamente");
            window.location="viewParametroReporte.php";
        </script>
    ';
} else {
    echo '
    
        <script>
        
            alert("no almacenado, inténtelo de nuevo");
            window.location="viewParametroReporte.php";
        </script>
    ';
}

mysqli_close($conexion);

?>