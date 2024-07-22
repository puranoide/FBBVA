<?php
session_start();
if(!isset($_SESSION['nombre_usuario'])){
    echo'
    <script>
        alert("por favor debes iniciar sesion");
        window.location="../index.php";
    </script>
    ';
    
    session_destroy();
    die();
}

if($_SESSION['rol']==1){
    $componente='
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="viewPrincipal.php">home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="dasboard.php">dasboard</a>
            </div>
              <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="viewParametroReporte.php">Agregar Parametro de valor por red social</a>
            </div>
             <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="vistalistada.php">historial de registro</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
             <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="cerrar_sesion.php">cerrar sesion</a>
            </div>
            </div>
        </div>
    </nav>
    ';

}else {
    $componente='
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="viewPrincipal.php">home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
             <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="vistalistada.php">historial de registro</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="cerrar_sesion.php">cerrar sesion</a>
            </div>
            </div>

            
        </div>
    </nav>
    ';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Inicio del portal</title>
</head>
<body>

    <?php
    echo $componente;
    ?>

    <br>


    <form action="cerrar_sesion.php">
        <button>cerrar sesion</button>
    </form>
<div class="conteiner-inputs-selects">
        <select id="seleccionFundacion" onchange="actualizarFormulario()">
            <option value="">Selecciona una fundacion</option>
            <option value="Faromedic">Faromedic</option>
            <option value="FBBVA">FBBVA</option>
        </select>
    
        <select id="seleccion" onchange="actualizarFormulario()">
            <option value="">Selecciona una red social</option>
            <option value="FB">Facebook</option>
            <option value="IG">Instagram</option>
            
        </select>
        
        <input type="date" name="Fecha Campaña" id="dateCampania" onchange="actualizarFormulario()">
        
        
        <select id="seleccionObjetivo" onchange="actualizarFormulario()">
            <option value="">Selecciona un objetivo</option>
            <option value="PPL">PPL</option>
            <option value="PPA">PPA</option>
        </select>
        <input type="text" name="Fecha Campaña" id="NombreEscritoCampania" oninput="actualizarFormulario()">
    </div>
    <form id="formulario"  action="postdata.php" method="post" class="FormPost">
        <!-- Campos del formulario que se actualizarán dinámicamente -->
    </form>








 <script src="../assets/app.js"></script>
 <script src="../assets/appFiltrar.js"></script>
</body>
</html>