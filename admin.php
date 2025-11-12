<?php
session_start();
include('db.php');

// verificar si es admin (puedes hacer un usuario especial "admin")
if (!isset($_SESSION['usuario']) || $_SESSION['nombre'] != 'admin') {
    header("Location: index.php");
    exit;
}

$disfraces = mysqli_query($con, "SELECT * FROM disfraces WHERE eliminado=0");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin 🎃</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>🎃 Panel de Administración</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="logout.php">Cerrar sesión</a>
        </nav>
    </header>

    <main>
        <h2>Lista de disfraces</h2>
        <table border="1" style="margin:auto; background:#222; color:orange;">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Votos</th>
                <th>Acciones</th>
            </tr>
            <?php while ($r = mysqli_fetch_assoc($disfraces)): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['nombre']) ?></td>
                    <td><?= htmlspecialchars($r['descripcion']) ?></td>
                    <td><?= $r['votos'] ?></td>
                    <td>
                        <a href="editar.php?id=<?= $r['id'] ?>">Editar</a> |
                        <a href="eliminar.php?id=<?= $r['id'] ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h3>Agregar nuevo disfraz</h3>
        <form action="nuevo_disfraz.php" method="POST" enctype="multipart/form-data" class="formulario">
            <input type="text" name="nombre" placeholder="Nombre del disfraz" required>
            <textarea name="descripcion" placeholder="Descripción" required></textarea>
            <input type="file" name="foto" accept="image/*" required>
            <button type="submit">Agregar</button>
        </form>
    </main>

    <footer>
        <p>© 2025 Concurso Halloween - Paradigmas III</p>
    </footer>
</body>

</html>