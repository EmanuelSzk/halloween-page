<?php
include('db.php');
if (isset($_POST['nombre'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);

    $existe = mysqli_query($con, "SELECT * FROM usuarios WHERE nombre='$nombre'");
    if (mysqli_num_rows($existe) > 0) {
        $mensaje = "Ese usuario ya existe.";
    } else {
        mysqli_query($con, "INSERT INTO usuarios (nombre, clave) VALUES ('$nombre', '$clave')");
        $mensaje = "Usuario registrado con éxito. <a href='login.php'>Inicia sesión</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse 🎃</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>🎃 Registro de usuario</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="login.php">Iniciar sesión</a>
        </nav>
    </header>

    <main>
        <form action="registro.php" method="POST" class="formulario">
            <input type="text" name="nombre" placeholder="Nombre de usuario" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>

        <?php if (isset($mensaje)): ?>
            <p style="color:orange;"><?= $mensaje ?></p>
        <?php endif; ?>
    </main>

    <footer>
        <p>© 2025 Concurso Halloween - Paradigmas III</p>
    </footer>
</body>

</html>