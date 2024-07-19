<?php
session_start();

// Conexión a la base de datos
include 'conection.php';

// Verificar conexión
if (mysqli_connect_errno()) {
    echo "Error de conexión a MySQL: " . mysqli_connect_error();
    exit();
}

// Obtener datos del formulario
$nombre_usuario = $_POST['username'];
$contrasena = $_POST['password'];

// Consulta SQL para verificar el usuario
$sql = "SELECT * FROM usuarios WHERE username = '$nombre_usuario'";
$resultado = mysqli_query($conexion, $sql);

// Verificar si hay algún resultado
if (mysqli_num_rows($resultado) == 1) {
    // Usuario encontrado, verificar contraseña
    $fila = mysqli_fetch_assoc($resultado);
    if (password_verify($contrasena, $fila['password'])) {
        // Contraseña válida, inicio de sesión exitoso
        $_SESSION['id_usuario'] = $fila['id'];
        $_SESSION['rol'] = $fila['rol'];
        $idUser=$_SESSION['id_usuario'];
        $fechaDeinicio= date('Y-m-d H:i:s');
        $_SESSION['nombre_usuario'] = $fila['username'];
        $sqlmonLogin="INSERT INTO monitorieo(idEmpleado,actionMonitoreada,fechadeaccion) values ('$idUser','inicio-sesion','$fechaDeinicio')";
        mysqli_query($conexion,$sqlmonLogin);
        header("location:viewPrincipal.php");
        exit;
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta";
    }
} else {
    // Usuario no encontrado
    echo "Usuario no encontrado";
}

// Cerrar conexión
mysqli_close($conexion);
?>
