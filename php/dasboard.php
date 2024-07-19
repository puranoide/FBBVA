<?php
include_once('conection.php');
$query="SELECT * FROM monitorieo JOIN usuarios ON monitorieo.idEmpleado = usuarios.id;";
$result_consultas = $conexion->query($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoreo de acciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    .table{
        width: 90%;
        margin-left: 5%;

    }
  </style>
  <body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="viewPrincipal.php">home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
        </div>
    </nav>
    <br>
    <h1 class="text-center">Listado de acciones de la plataforma</h1>
    <br>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">id-monitoreo</th>
            <th scope="col">nombre del usuario</th>
            <th scope="col">Accion realizada</th>
            <th scope="col">fecha de accion</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if ($result_consultas->num_rows > 0){
                while ($row = $result_consultas->fetch_assoc()){
                    echo'
                    <tr >
                        <th scope="row">'.$row['idMonitoreo'].'</th>
                        <td>'.$row['username'].'</td>
                        <td>'.$row['actionMonitoreada'].'</td>
                        <td>'.$row['fechadeaccion'].'</td>
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