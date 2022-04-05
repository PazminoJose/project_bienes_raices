<div data-cy="propiedades-anuncios" class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) { ?>
        <div data-cy="anuncio" class="anuncio">

            <img src="/imagenes/<?php echo s($propiedad->imagen) ?>" alt="">

            <div class="contenido-anuncios">
                <h3><?php echo s($propiedad->titulo) ?></h3>
                <p><?php echo s($propiedad->descripcion) ?></p>
                <p class="precio">$<?php echo s($propiedad->precio) ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p>3</p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p>3</p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p>4</p>
                    </li>
                </ul>
                <a data-cy="enlace-propiedad" class="boton-amarillo-block" href="/propiedad?id=<?php echo s($propiedad->id); ?>">Ver Propiedad</a>
            </div> <!-- .contenido-anuncios-->
        </div> <!-- .anuncio-->
    <?php } ?>
</div> <!-- .contenedor-anuncios-->