<?php
session_start();
include('db.php');

if (!isset($_SESSION['usuario']) || $_SESSION['nombre'] != 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$r = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM disfraces WHERE id=$id"));

if (isset($_POST['nombre'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $foto_actual = $r['foto'];

    // Si se sube una nueva foto
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        if ($foto_actual && file_exists("fotos/" . $foto_actual)) {
            unlink("fotos/" . $foto_actual); // borra la anterior
        }
        $archivo = $_FILES['foto']['name'];
        $extension = explode('.', $archivo);
        $nombreArchivo = time() . '.' . end($extension);
        copy($_FILES['foto']['tmp_name'], "fotos/" . $nombreArchivo);
    } else {
        $nombreArchivo = $foto_actual;
    }

    $sql = "UPDATE disfraces SET nombre='$nombre', descripcion='$descripcion', foto='$nombreArchivo' WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar disfraz 🎃</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <header>
        <h1>Editar Disfraz 🎃</h1>
        <nav>
            <a href="admin.php">Volver al panel</a>
        </nav>
    </header>

    <main>
        <form method="POST" enctype="multipart/form-data" class="formulario">
            <input type="text" name="nombre" value="<?= htmlspecialchars($r['nombre']) ?>" required>
            <textarea name="descripcion" required><?= htmlspecialchars($r['descripcion']) ?></textarea>
            <p>Foto actual:</p>
            <?php if ($r['foto'] && file_exists("fotos/" . $r['foto'])): ?>
                <img src="fotos/<?= $r['foto'] ?>" width="150">
            <?php endif; ?>
            <p>Cambiar imagen:</p>
            <input type="file" name="foto" accept="image/*">
            <button type="submit">Guardar cambios</button>
        </form>
    </main>
</body>

</html>