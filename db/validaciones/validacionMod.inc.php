<?php
include_once 'validacion.inc.php';
include_once 'db/repositorios/RepositorioUsuario.inc.php';

class validacionMod extends validacion{

    public function __construct($id, $nombre, $apellido, $fechaNac, $email, $conexion) {
        $this -> nombre = "";
        $this -> apellido = "";
        $this -> fechaNac = "";
        $this -> email = "";
        $this -> fecha = explode("/", $fechaNac);

        $this -> errorNombre = $this -> validarNombre($nombre);
        $this -> errorApellido = $this -> validarApellido($apellido);
        $this -> errorFechaNac = $this -> validarFechaNac($fechaNac);
        $this -> errorEmail = $this -> validarEmail($conexion, $id, $email);
    }

    private function validarEmail($conexion, $id, $email) {
        if (!$this -> datoIniciado($email)) {
            return "Debes colocar tu email";
        } else {
            if (strlen($email) > 255) {
                return "Límite excedido (255)";
            } else {
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return "No es un email válido";
                } else {
                    if (!RepositorioUsuario :: usuario_email($conexion, $id, $email)) {
                        return "Este email ya está registrado";
                    } else {
                        $this -> email = $email;
                    }
                }
            }
        }
        return "";
    }

    public function modificacionValida() {
        if ($this -> errorNombre == "" &&
            $this -> errorApellido == "" &&
            $this -> errorFechaNac == "" &&
            $this -> errorEmail == "") {
            return true;
        } else {
            return false;
        }
    }
}