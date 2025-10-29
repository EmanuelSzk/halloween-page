<?php

    include "Conexion/conexion.php";
    $votosUsuario = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/style.css">
    <title>Actividad-Halloween</title>
</head>

<body>
    <div class="grid">

        <header>
            <nav>
                <ul>
                    <a><li>Home</li></a>
                    <a><li>Categories</li></a>
                    <a><li>Blog</li></a>
                    <a><li>Contact</li></a>
                </ul>
            </nav>
        </header>

        <main>
            <h2>Cantidad de disfraces disponibles: </h2>
            <ul>
                <?php
                conectar();
                $consultaSQL = "SELECT * FROM disfraces";
                $datosConsulta = $con->query($consultaSQL);

                if($datosConsulta->num_rows > 0) {
                    while($row = $datosConsulta->fetch_assoc()) {
                        echo 
                    "<h3>". $row["nombre"] ."</h3>
                    <ul>
                        <li>Descripcion: ". $row["descripcion"] ."</li>
                        <li>Cantidad de votos: ". $row["votos"] ."</li>
                    </ul>
                    <form action='Scripts/votar.php' method='POST'>
                        <input type='hidden' name='id' value=". $row["id"] .">
                        <button type='submit'>Votar</button>
                    </form>";
                    } } else {
                    echo "<h3>no hay disfraces disponibles, lo sentimos mucho</h3>";
                };
                ?>
            </ul>
        </main>

        <footer>

        </footer>

    </div>
</body>

</html>