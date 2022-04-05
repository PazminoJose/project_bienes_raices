<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="titulo-propiedad"><?php echo s($propiedad->titulo); ?></h1>

    <img loading="lazy" src="imagenes/<?php echo s($propiedad->imagen); ?>" alt="anuncio">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo s($propiedad->precio); ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo s($propiedad->wc); ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo s($propiedad->estacionamiento); ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo s($propiedad->habitaciones); ?></p>
            </li>
        </ul>
        <p><?php echo s($propiedad->descripcion); ?></p>

    </div>
</main>