<?php
session_start();
include('db.php');


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['usuario'];
$id_disfraz = $_POST['id_disfraz'];

$yaVoto = mysqli_query($con, "SELECT * FROM votos WHERE id_usuario=$id_usuario AND id_disfraz=$id_disfraz");
if (mysqli_num_rows($yaVoto) == 0) {
    mysqli_query($con, "INSERT INTO votos (id_usuario, id_disfraz) VALUES ($id_usuario, $id_disfraz)");
    mysqli_query($con, "UPDATE disfraces SET votos=votos+1 WHERE id=$id_disfraz");
}
header("Location: index.php");
exit;
