<?php
session_start();
include('db.php');
$q = mysqli_query($con, "SELECT * FROM disfraces WHERE eliminado=0");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎃 Disfraces - Concurso Halloween</title>
    <link rel="stylesheet" href="css/styles.css?v=0.1">
</head>

<body>
    <header>
        <div class="titulo">
            <img src="sources/calabaza.png" class="decoracion">
            <h1>Concurso de Disfraces</h1>
        </div>
        <nav>
            <a href="index.php">Inicio</a>
            <?php
            if (isset($_SESSION['usuario'])) {
                echo '<a href="logout.php">Cerrar sesión</a>';
                if (isset($_SESSION['nombre']) && $_SESSION['nombre'] === 'admin') {
                    echo '<a href="admin.php">Panel Admin</a>';
                };
            } else {
                echo '<a href="login.php">Iniciar sesión</a>';
                echo '<a href="registro.php">Registrarse</a>';
            }
            ?>
        </nav>
    </header>

    <main>

        <?php
        if (isset($_SESSION['usuario'])) {
            if (isset($_SESSION['nombre']) && $_SESSION['nombre'] != 'admin') {
                echo ' <div class="consejo">
            <p>Para acceder a las caracteristicas del admin (CRUD) debe crearse un usuario "admin"</p>
        </div>';
            };
        }
        ?>

        <?php while ($r = mysqli_fetch_assoc($q)): ?>
            <div class="disfraz">
                <?php if (!empty($r['foto']) && file_exists("fotos/" . $r['foto'])): ?>
                    <img src="fotos/<?= htmlspecialchars($r['foto']) ?>" alt="<?= htmlspecialchars($r['nombre']) ?>">
                <?php else: ?>
                    <img src="fotos/no-image.png" alt="Sin imagen">
                <?php endif; ?>
                <h2><?= htmlspecialchars($r['nombre']) ?></h2>
                <p><?= htmlspecialchars($r['descripcion']) ?></p>
                <p>Votos: <?= $r['votos'] ?></p>

                <?php if (isset($_SESSION['usuario'])): ?>
                    <form method="POST" action="votar.php">
                        <input type="hidden" name="id_disfraz" value="<?= $r['id'] ?>">
                        <button type="submit">Votar 🎃</button>
                    </form>
                <?php else: ?>
                    <p><a href="login.php">Inicia sesión para votar</a></p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </main>

    <footer>
        <p>© 2025 Concurso Halloween - Paradigmas III</p>
    </footer>
</body>

</html>