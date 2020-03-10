<?php
if (ControlSesion :: sesionIniciada())
    Redireccion :: redirigir(RUTA_INICIO);

include_once 'plantillas/header.inc.php'
?>
    <body id="bienvenida">
        <div class="wrapper">
            <div class="caja">
                <img class="logo" src="<?php echo RUTA_IMG?>logo.png" alt="Logo">
                <div id="botones">
                    <a href="<?php echo RUTA_INICIO_SESION ?>"><input type="button" class="boton" value="Iniciar sesión"></a>
                    <a href="<?php echo RUTA_REGISTRO ?>"><input type="button" class="boton" value="Registrarse"></a>
                </div>
                <div class="info">
                    <label><!-- Código removido --><br><a href="<?php echo RUTA_INFO ?>">Más información</a></label>
                </div>
            </div>
        </div>
    </body>
</html>