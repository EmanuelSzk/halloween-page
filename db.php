<?php
$ServerName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'halloween';

$con = mysqli_connect($ServerName, $userName, $password, $dbName);
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}