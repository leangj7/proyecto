<?php
if (!ControlSesion :: sesionIniciada())
    Redireccion :: redirigir(SERVIDOR);

include_once 'plantillas/usuarioExiste.inc.php';
include_once 'plantillas/header.inc.php';
include_once 'plantillas/menu-principal.inc.php';
?>
	<script>
	    window.onload = function() {
	        document.getElementById("faq").style.boxShadow="inset 0px -2px 0px 0px #222222";
	    }
	</script>
        <main>
            <div class="principal">
                <div class="presentacion general" id="pagFaq">
                    <div class="banner">
                        <h1>Preguntas frecuentes</h1>
                    </div>
                </div>
                <div class="contenido">
                    <!-- Código removido -->
                </div>
            </div>
        </main>
        <?php
        include_once 'plantillas/footer.inc.php';
        ?>
    </body>
</html>