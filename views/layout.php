<?php
if (!isset($_SESSION)) {
    session_start();
}
$autenticado = $_SESSION['login'] ?? false;

$inicio = $inicio ?? false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Bienes Raices</title>
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="../build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="movil-menu">
                    <img src="../build/img/barras.svg" alt="icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="../build/img/dark-mode.svg" alt="Boton Dark Mode">
                    <nav data-cy="navegacion-header" class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($autenticado) {  ?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php  } else { ?>
                            <a href="/login">Iniciar Sesión</a>
                        <?php  } ?>
                    </nav>
                </div>
            </div><!-- .barra-->
            <?php

            echo ($inicio) ? "<h1 data-cy='heading-principal'>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : "";

            ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav data-cy='navegacion-footer' class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Propiedades</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
            <p data-cy='copyright' class="copyright">Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
        </div>
    </footer>
    <script src="../build/js/bundle.js"></script>
</body>

</html>