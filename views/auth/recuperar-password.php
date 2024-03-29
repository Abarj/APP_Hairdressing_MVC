<h1 class="nombre-pagina">Restablecer contraseña</h1>

<p class="descripcion-pagina">Escribe tu nueva contraseña a continuación</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>

<?php if($error) return; ?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Nueva contraseña</label>
        <input type="password" id="password" name="password" placeholder="Nueva contraseña">
    </div>

    <input type="submit" class="boton" value="Guardar">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
</div>