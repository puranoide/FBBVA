<?php

include 'conection.php';

$completename=$_POST['completename'];
$username=$_POST['username'];
$passwordform=$_POST['password'];
$rol=$_POST['rol'];

// Encriptar la contraseña con Bcrypt
$password_encrypted = password_hash($passwordform, PASSWORD_BCRYPT);

$query = "INSERT INTO usuarios(completename, username,password,rol) 
          VALUES('$completename', '$username', '$password_encrypted',$rol)";

// verificamos que el correo no se repita en la bd
$verificar_user= mysqli_query($conexion,"SELECT * FROM usuarios WHERE username='$username' ");

if(mysqli_num_rows($verificar_user)>0){
    echo '
        <script>
            alert("Este username ya está en uso, intenta con otro diferente");
            window.location="registersuperadmin.html";
        </script>
    ';
    mysqli_close($conexion);
    exit();
}

/*
// verificamos que el usuario no se repita en la bd
$verificar_usuario= mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario='$usuario' ");

if(mysqli_num_rows($verificar_usuario)>0){
    echo '
        <script>
            alert("Este usuario ya está registrado, intenta con otro diferente");
            window.location="../index.php";
        </script>
    ';
    mysqli_close($conexion);
    exit();
}
*/

$ejecutar=mysqli_query($conexion,$query);

if($ejecutar){
    echo '
        <script>
            alert("Usuario registrado correctamente");
            window.location="../index.php";
        </script>
    ';
} else {
    echo '
    
        <script>
        
            alert("Usuario no almacenado, inténtelo de nuevo");
            window.location="registersuperadmin.html";
        </script>
    ';
}

mysqli_close($conexion);
?>
