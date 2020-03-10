<?php
include_once 'validacion.inc.php';
include_once 'db/repositorios/RepositorioUsuario.inc.php';

class validacionReg extends validacion {

    private $usuario;
    private $clave;

    private $errorUsuario;
    private $errorClave;
    private $errorRepClave;
    
    public function __construct($nombre, $apellido, $fechaNac, $usuario, $clave, $repClave, $email, $conexion) {
        $this -> nombre = "";
        $this -> apellido = "";
        $this -> fechaNac = "";
        $this -> usuario = "";
        $this -> clave = "";
        $this -> email = "";

        $this -> fecha = explode("/", $fechaNac);

        $this -> errorNombre = $this -> validarNombre($nombre);
        $this -> errorApellido = $this -> validarApellido($apellido);
        $this -> errorUsuario = $this -> validarUsuario($conexion, $usuario);
        $this -> errorFechaNac = $this -> validarFechaNac($fechaNac);
        $this -> errorClave = $this -> validarClave($clave);
        $this -> errorRepClave = $this -> validarRepClave($clave, $repClave);
        $this -> errorEmail = $this -> validarEmail($conexion, $email);

        if ($this -> errorClave == "" && $this -> errorRepClave == "") {
            $this -> clave = $clave;
        }
    }

    private function validarUsuario($conexion, $usuario) {
        if (!$this -> datoIniciado($usuario)) {
            return "Debes colocar tu usuario";
        } else {
            if (strlen($usuario) > 200) {
                return "Límite excedido (200)";
            } else {
                if (!preg_match('`^[a-zA-Z\d_-]+$`', $usuario)) {
                    return "Sólo puedes colocar letras, números o guiones";
                } else {
                    if (!is_null(RepositorioUsuario :: getUsuario($conexion, $usuario))) {
                        return "Este usuario ya está registrado";
                    } else {
                        $this -> usuario = $usuario;
                    }
                }
            }
        }
        return "";
    }

    private function validarClave($clave) {
        if (!$this -> datoIniciado($clave)) {
            return "Debes colocar tu contraseña";
        } else {
            if (strlen($clave) < 8) {
                return "Debes colocar al menos 8 caracteres";
            } else {
                if (!preg_match('`^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$`', $clave)) {
                    if (strlen($clave) < 8) {
                        return "Debes escribir al menos 8 caracteres";
                    }
                    
                    if (!preg_match('`\D`', $clave)){
                        return "La clave debe tener al menos una letra";
                    }
                    
                    if (!preg_match('`\d`', $clave)){
                        return "La clave debe tener al menos un caracter numérico";
                    }
                } else {
                    
                }
            }
        }
        return "";
    }

    private function validarRepClave($clave, $repClave) {
        if (!$this -> datoIniciado($clave)) {
            return "Debes colocar tu contraseña primero";
        } else {
            if (!$this -> datoIniciado($repClave)) {
                return "Debes repetir tu contraseña";
            }

            if ($clave !== $repClave) {
                return "Ambas contraseñas deben coincidir";
            }
        }
        return "";
    }

    private function validarEmail($conexion, $email) {
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
                    if (!is_null(RepositorioUsuario :: getUsuarioEmail($conexion, $email))) {
                        return "Este email ya está registrado";
                    } else {
                        $this -> email = $email;
                    }
                }
            }
        }
        return "";
    }

    public function getUsuario() {
        return $this -> usuario;
    }

    public function getErrorUsuario() {
        return $this -> errorUsuario;
    }

    public function getClave() {
        return $this -> clave;
    }

    public function getErrorClave() {
        return $this -> errorClave;
    }

    public function getRepClave() {
        return $this -> repClave;
    }

    public function getErrorRepClave() {
        return $this -> errorRepClave;
    }

    public function mostrarUsuario() {
        if ($this -> usuario !== "") {
            echo 'value="'. $this -> usuario . '"';
        }
    }

    public function mostrarErrorUsuario() {
        if ($this -> errorUsuario !== ""){
            echo $this -> errorUsuario;
        }
    }

    public function mostrarClave() {
        if ($this -> clave !== "") {
            echo 'value="'. $this -> clave . '"';
        }
    }

    public function mostrarErrorClave() {
        if ($this -> errorClave !== ""){
            echo $this -> errorClave;
        }
    }

    public function mostrarErrorRepClave() {
        if ($this -> errorRepClave !== ""){
            echo $this -> errorRepClave;
        }
    }

    public function registroValido() {
        // === mismo VALOR y mismo TIPO
        if ($this -> errorNombre == "" &&
            $this -> errorApellido == "" &&
            $this -> errorFechaNac == "" &&
            $this -> errorUsuario == "" &&
            $this -> errorClave == "" &&
            $this -> errorRepClave == "" &&
            $this -> errorEmail == "") {
            return true;
        } else {
            return false;
        }
    }
}