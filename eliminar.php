<?php
session_start();
include('db.php');

if (!isset($_SESSION['usuario']) || $_SESSION['nombre'] != 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$r = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM disfraces WHERE id=$id"));

if ($r['foto'] && file_exists("fotos/" . $r['foto'])) {
    unlink("fotos/" . $r['foto']); // borrar la imagen
}

mysqli_query($con, "DELETE FROM disfraces WHERE id=$id");
header("Location: admin.php");
exit;
