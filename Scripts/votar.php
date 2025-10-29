<?php

include '../index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    $i = 0;
    // Actualiza la columna "votos" sumando 1
    while ($i < count($votosUsuario)) {
        if ($id == $votosUsuario[$i]) {
            echo "usted ya modificó esta columna";
            header("Location: ../index.php");
            exit;
        }
        $i++;
        }
            $consulta = "UPDATE disfraces SET votos = votos + 1 WHERE id = $id";
            array_push($votosUsuario, $id);
            $con->query($consulta);

            if ($con->affected_rows > 0) {
                echo "¡Voto registrado correctamente!";
            } else {
                echo "Error o ID no encontrado.";
            };

            header("Location: ../index.php");
            exit;
    }

desconectar();
