<?php
// se verifica si la sesion existe para que se mande a una ventana
session_start();
if(isset($_SESSION['nombre_usuario'])){
    echo'
    <script>
        
        window.location="php/viewPrincipal.php";
    </script>
    ';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/indexstyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Sistema FBBVA</title>
</head>
<body>
    

    <form action="php/loginphp.php" method="POST" class="form-login">
        <h1>LOGIN</h1>
            <div>
                <input type="text" id="" placeholder="username" name="username" required>
            </div>
            <div>
                <input type="text" id="" placeholder="password" name="password" required>
            </div>
        <button type="submit">login</button>
    </form>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>
</html>