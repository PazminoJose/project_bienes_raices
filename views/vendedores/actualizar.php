<main class="contenedor seccion">
    <h1>Actualizar</h1>
    <div class="alinear-izquierda">
        <a class="boton boton-verde" href="/admin">Volver</a>
    </div>
    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data" class="formulario">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
    </form>
</main>