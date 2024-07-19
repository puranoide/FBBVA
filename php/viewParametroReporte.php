<?php
include_once('conection.php');
$query="SELECT * FROM `parametrosreportes`;";
$result_consultas = $conexion->query($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametros para reportes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <style>
        .table{
        width: 90%;
        margin-left: 5%;

    }
    </style>


  <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="viewPrincipal.php">home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
        </div>
    </nav>

    <form action="addParametro.php" method="POST" class="form-login">
        <h1>parametros de redes</h1>
            <div>
                <input type="number" id="" placeholder="Parametro para instagram" name="ParametroIg" required>
            </div>
            <div>
                <input type="number" id="" placeholder="Parametro para facebook" name="ParametroFb" required>
            </div>
        <button type="submit">agregar</button>
    </form>


    <table class="table">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Valor-Instagram</th>
            <th scope="col">Valor-facebook</th>
            <th scope="col">fechaAgregada</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if ($result_consultas->num_rows > 0){
                while ($row = $result_consultas->fetch_assoc()){
                    echo'
                    <tr >
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['valorIg'].'</td>
                        <td>'.$row['valorFb'].'</td>
                        <td>'.$row['dateParametro'].'</td>
                    </tr>
                    
                    
                    ';
                }
            }
            
            ?>
        </tbody>
    </table>


  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>