<main class="contenedor seccion">
    <h2 data-cy='heading-nosotros'>Más Sobre Nosotros</h2>

    <?php include 'iconosNosotros.php'; ?>

</main>
<section class="seccion contenedor">
    <h2 data-cy="propiedades">Casas y Depa en Venta</h2>

    <?php include __DIR__ . '/listadoPropiedades.php'; ?>

    <div class="alinear-derecha">
        <a data-cy="todas-propiedades" class="boton-verde" href="/propiedades">Ver Todas</a>
    </div>
</section>
<section data-cy="imagen-contacto" class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a class="boton-amarillo" href="/contacto">Contactanos</a>
</section>
<div class="contenedor seccion seccion-inferior">
    <section data-cy="blog" class="blog">
        <h3>Nuestro Blog</h3>

       <?php include 'entradas.php' ?>

    </section>
    <section data-cy="testimoniales" class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El Personal se comporto de una excelente froma, muy buena atención y la casa que me ofrecieron
                cumple con todas mis espectativas
            </blockquote>
            <P>- José Pazmiño</P>
        </div>
    </section>
</div>