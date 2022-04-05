<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="heading-login">Iniciar Sesión</h1>
    <?php foreach ($errores as $error) { ?>
        <div data-cy="alerta-login" class="alerta error"><?php echo $error ?></div>
    <?php } ?>
    <form data-cy="formulario-login" method="POST" class="formulario">
        <fieldset>
            <legend>Email y Contaseña</legend>

            <label for="email">E-Mail</label>
            <input data-cy="input-email-login" id="email" placeholder="Tu Correo electrónico" type="email" name="login[email]" value="<?php echo s($admin->email) ?>">
            <label for="password">Contraseña</label>
            <input data-cy="input-password-login" id="password" placeholder="Tu Contraseña" type="password" name="login[password]">
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </fieldset>

    </form>
</main>