<?php
session_start();
include('db.php');

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];

    $q = mysqli_query($con, "SELECT * FROM usuarios WHERE nombre='$nombre'");
    if (mysqli_num_rows($q) == 1) {
        $u = mysqli_fetch_assoc($q);
        if (password_verify($clave, $u['clave'])) {
            $_SESSION['usuario'] = $u['id'];
            $_SESSION['nombre'] = $u['nombre'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión 🎃</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>🎃 Iniciar sesión</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="registro.php">Registrarse</a>
        </nav>
    </header>

    <main>
        <form method="POST" action="login.php" class="formulario">
            <input type="text" name="nombre" placeholder="Usuario" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>

        <?php if (isset($error)): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </main>

    <footer>
        <p>© 2025 Concurso Halloween - Paradigmas III</p>
    </footer>
</body>

</html>