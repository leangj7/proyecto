<?php
if (ControlSesion :: sesionIniciada()) {
    Conexion :: abrirConexion();
    $id = $_SESSION['idusuario'];
    $usuario = RepositorioUsuario :: getDatosUsuario(Conexion :: getConexion(), $id);
    if (is_null(RepositorioUsuario :: getDatosUsuario(Conexion :: getConexion(), $id))) {
        if (file_exists(DIRECTORIO_RAIZ . "/subidas/" . $id)) {
            unlink(DIRECTORIO_RAIZ . "/subidas/" . $id);
        }
        ControlSesion :: cerrarSesion();
        Redireccion :: redirigir(SERVIDOR);
    }
}
Conexion :: cerrarConexion();