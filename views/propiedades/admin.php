<main class="contenedor seccion">
    <h1 data-cy="heading-admin">Administrador de Bienes Raices</h1>
    <?php
    if ($resultado) {

        $mensaje = mostrarNotificacion(intval($resultado));

        if ($mensaje) {
    ?>
            <p class="alerta exito"><?php echo s($mensaje) ?></p>

    <?php
        }
    }
    ?>

    <h2>Propiedades</h2>
    <a class="boton boton-verde" href="/propiedades/crear">Nueva Propiedad</a>
    <a class="boton boton-amarillo" href="/vendedores/crear">Nuevo(a) Vendedor</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propiedades as $propiedad) { ?>
                <tr>
                    <td><?php echo $propiedad->id ?></td>
                    <td><?php echo $propiedad->titulo ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad->precio ?></td>
                    <td>
                        <form action="/propiedades/eliminar" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>


    </table>

<!-- CRUD VENDEDORES -->
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) { ?>
                <tr>
                    <td><?php echo s($vendedor->id) ?></td>
                    <td><?php echo s($vendedor->nombre) . ' '. s($vendedor->apellido) ?></td>
                    <td><?php echo s($vendedor->telefono) ?></td>
                    <td>
                        <form action="/vendedores/eliminar" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/vendedores/actualizar?id=<?php echo s($vendedor->id) ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>


    </table>
</main>