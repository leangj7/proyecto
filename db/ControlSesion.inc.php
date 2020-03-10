<?php
class ControlSesion {
    public static function iniciarSesion($idusuario, $nomusuario) {
        // Si esa id ya fue llamada / creada, no es necesario crear
        // otras sesion
        if (session_id() == '') {
            session_start();
        }

        $_SESSION['idusuario'] = $idusuario;
        $_SESSION['nomusuario'] = $nomusuario;
    }

    public static function cerrarSesion() {
        if (session_id() == '') {
            session_start();
        }

        // Borrar cookies
        if (isset($_SESSION['idusuario'])) {
            unset($_SESSION['idusuario']);
        }
        if (isset($_SESSION['nomusuario'])) {
            unset($_SESSION['nomusuario']);
        }

        session_destroy();
    }

    public static function sesionIniciada() {
        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION['idusuario']) && isset($_SESSION['nomusuario'])) {
            return true;
        } else {
            return false;
        }
    }
}