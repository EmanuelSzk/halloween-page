<?php

function conectar() {
    global $con;

    $serverName = "127.0.0.1:3307";
    $userName = "root";
    $password = "";
    $dbName = "halloween";

    $con = mysqli_connect($serverName, $userName, $password, $dbName);

    if(mysqli_connect_error()) {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    } else {
        $con -> set_charset("utf8");
        $ret = true;
    }
    return $ret;
}

function desconectar() {
    global $con;
    mysqli_close($con);
}

?>
