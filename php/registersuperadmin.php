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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/styles/indexstyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Sistema Alumnos</title>
</head>
<body>
    

    <form action="registeruser.php" method="POST" class="form-login">
        <h1>LOGIN</h1>
            
            <input type="text" id="" placeholder="username" name="username" required>
            <select name="rol" required>
                <option value="1">Admin</option>
                <option value="2">gestor</option>
            </select>
            <input type="text" id="" placeholder="completename" name="completename" required>
            <input type="text" id="" placeholder="password" name="password" required>
            
        <button>login</button>
    </form>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>
</html>