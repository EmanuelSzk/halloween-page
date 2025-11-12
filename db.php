<?php
$ServerName = '127.0.0.1:3307'; /* tengo el mysql de xampp en el puerto 3307, porque me generaba conflicto con el mySQL que ya tenía instalado y en el puerto 3306 */
$userName = 'root';
$password = '';
$dbName = 'halloween';

$con = mysqli_connect($ServerName, $userName, $password, $dbName);
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}