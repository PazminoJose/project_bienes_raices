<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="heading-contacto">Contacto</h1>
    <?php if (!is_null($mensaje)) { ?>
        <p data-cy="alerta-envio-formulario" class="alerta <?php echo $alerta ?>"><?php echo $mensaje; ?></p>
    <?php } ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>
    <h2 data-cy="heading-formulario">Llene el Formulario de Contacto</h2>
    <form data-cy="formulario-contacto" class="formulario" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input data-cy="input-nombre" name="contacto[nombre]" id="nombre" placeholder="Tu Nombre" type="text" required>
            <label for="mensaje">Mensaje</label>
            <textarea data-cy="input-mensaje" name="contacto[mensaje]" id="mensaje" cols="30" rows="10"></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre Propiedad</legend>
            <label for="select">Vende o Compra</label>
            <select data-cy="input-opciones" name="contacto[tipo]" id="select" class="formulario__campo" name="" id="" required>
                <option disabled selected value="">-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <label for="presupuesto">Precio o Presupuesto:</label>
            <input data-cy="input-precio" name="contacto[precio]" id="presupuesto" type="number" required>
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>
            <p>Como dedea ser Contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input data-cy="forma-contacto" name="contacto[contacto]" id="contactar-telefono" value="telefono" type="radio" required>

                <label for="contactar-email">Email</label>
                <input data-cy="forma-contacto" name="contacto[contacto]" id="contactar-email" value="email" type="radio" required>
            </div>

            <div id="contacto"></div>
        </fieldset>
        <input class="boton-verde" type="submit">
    </form>
</main>