<?php
include_once 'db/repositorios/RepositorioUsuario.inc.php';

class validacionClave {

    protected $clave;

    protected $errorClave;
    protected $errorRepClave;

    public function __construct($clave, $repClave) {
        $this -> clave = "";
        $this -> repClave = "";

        $this -> errorClave = $this -> validarClave($clave);
        $this -> errorRepClave = $this -> validarRepClave($clave, $repClave);

        if ($this -> errorClave == "" && $this -> errorRepClave == "") {
            $this -> clave = $clave;
        }
    }

    protected function datoIniciado($dato) {
        if (isset($dato) && !empty($dato)) {
            return true;
        } else {
            return false;
        }
    }

    private function validarClave($clave) {
        if (!$this -> datoIniciado($clave)) {
            return "Debes colocar tu contraseña";
        } else {
            if (strlen($clave) < 8) {
                return "Debes colocar al menos 8 caracteres";
            } else {
                if (!preg_match('`\D`', $clave)){
                    return "La clave debe tener al menos una letra";
                }
                
                if (!preg_match('`\d`', $clave)){
                    return "La clave debe tener al menos un caracter numérico";
                }
            }
        }
        return "";
    }

    protected function validarRepClave($clave, $repClave) {
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

    public function getClave() {
        return $this -> clave;
    }

    public function getErrorClave() {
        return $this -> errorClave;
    }

    public function getErrorRepClave() {
        return $this -> errorRepClave;
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

    public function claveValida() {
        if ($this -> errorClave == "" &&
            $this -> errorRepClave == "") {
            return true;
        } else {
            return false;
        }
    }
}