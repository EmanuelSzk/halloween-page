<?php
session_start();
include('db.php');

// Solo el admin puede acceder
if (!isset($_SESSION['usuario']) || $_SESSION['nombre'] != 'admin') {
    header("Location: index.php");
    exit;
}

if (isset($_POST['nombre'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $votos = 0;

    // Manejo de la imagen
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $archivo = $_FILES['foto']['name'];
        $extension = explode('.', $archivo);
        $nombreArchivo = time() . '.' . end($extension);
        copy($_FILES['foto']['tmp_name'], "fotos/" . $nombreArchivo);
    } else {
        $nombreArchivo = null;
    }

    $sql = "INSERT INTO disfraces (nombre, descripcion, votos, foto) 
          VALUES ('$nombre', '$descripcion', $votos, '$nombreArchivo')";

    if (mysqli_query($con, $sql)) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
