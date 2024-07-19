<?php 
include 'conection.php';
// Verificar conexión
if (mysqli_connect_errno()) {
    echo "Error de conexión a MySQL: " . mysqli_connect_error();
    exit();
}
$idPost=$_POST["idPost"];
//echo $idPost;
// Consulta SQL para verificar el usuario
$sql = "SELECT * FROM post WHERE idPost = '$idPost'";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Editar Post</title>

</head>
<body>
    
<?php 
    if($resultado){
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo '  
            <form action="editarDataPost.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" hidden>id</label>
                <input name="id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="'.$fila["idPost"].'" readonly hidden >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre del Post</label>
                <input name="nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="'.$fila["namePost"].'">
            </div>
          
            <div class="divscontainer-edit">
            <div>
                <h1>Datos Ads</h1> 
                    Alcance ADS<input type="number" name="alcanceInorganico" placeholder="Alcance Inorganico" value="'.$fila["alcanceInorganic"].'">
                    Iteracciones ADS<input type="number" name="interacionesInorganico" placeholder="Interacciones Inorganicas" value="'.$fila["interaccionesInorganic"].'">
                    Clicks ADS<input type="number" name="clicksInorganico" placeholder="Clicks Inorganicos" value="'.$fila["clicsInorganic"].'">
                    Seguidores ADS<input type="number" name="seguidoresInorganicos" placeholder="Seguidores Inorganicos" value="'.$fila['seguidoresNuevosInorganic'].'">
                    pautas ADS<input type="text"  name="PautaTotal" placeholder="Pautas Totales" value="'.$fila["pautaAds"].'">
                    impresiones ADS<input type="number" name="impresionesTotales" placeholder=" impresiones Totales" value="'.$fila["impresionesAds"].'">
            </div>
            <div>
            <h1>Datos POST</h1> 
                <input type="hidden" value="'.$fila["idPost"].'"   hidden >
                
                alcance POST<input type="number" name="AlcanceTotal" placeholder="Alcance meta" value="'.$fila["alcanceAds"].'" >
                
                interacciones POST<input type="number" name="interacionestotal" placeholder="Interacciones Totales"
                value="'.$fila["interaccionesAds"].'" >
                
                click POST<input type="number" name="clicksTotales" placeholder="Clicks Totales" value="'.$fila["clicsAds"].'">
                
                seguidores POST<input type="number" name="SeguidoresTotales" placeholder="Seguidores Totales" value="'.$fila["seguidoresNuevosAds"].'">
                
                
            <button type="submit" class="btn btn-success">editar</button>
            </div>
            </div>
            
            </form>
          ';
        }
    }
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>