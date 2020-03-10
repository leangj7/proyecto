<?php
class Usuario {
    private $id;
    private $nombre;
    private $apellido;
    private $fechaNac;
    private $usuario;
    private $clave;
    private $email;
    private $activo;

    public function __construct($id, $nombre, $apellido, $fechaNac, $usuario, $clave, $email, $activo) {
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> fechaNac = $fechaNac;
        $this -> usuario = $usuario;
        $this -> clave = $clave;
        $this -> email = $email;
        $this -> activo = $activo;
    }

    public function getID() {
        return $this -> id;
    }

    public function getNombre() {
        return $this -> nombre;
    }

    public function getApellido() {
        return $this -> apellido;
    }

    public function getFechaNac() {
        return $this -> fechaNac;
    }

    public function getUsuario() {
        return $this -> usuario;
    }

    public function getClave() {
        return $this -> clave;
    }

    public function getEmail() {
        return $this -> email;
    }

    public function getActivo() {
        return $this -> activo;
    }

    /*-------------------------*/

    /* La id solo se asigna una vez y no
    precisa ser cambiado */

    /* El c�digo personal solo se asigna una vez y no
    precisa ser cambiado */

    public function setNombre($nombre) {
        $this -> nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this -> apellido = $apellido;
    }

    public function setFechaNac($fechaNac) {
        $this -> fechaNac = $fechaNac;
    }

    public function edadUsuario($fechaNac) {
        $fecha = explode("/", $fechaNac);
        $dia = date("j");
        $mes = date("n");
        $ano = date("Y");

        if (($fecha[1] == $mes) && ($fecha[0] > $dia)) {
            $ano = ($ano - 1);
        }

        if ($fecha[1] > $mes) {
            $ano = ($ano - 1);
        }

        $edad = ($ano - $fecha[2]);
        return $edad;
    }

    public function setClave($clave) {
        $this -> clave = $clave;
    }

    public function setEmail($email) {
        $this -> email = $email;
    }

    public function setActivo($activo) {
        $this -> activo = $activo;
    }
}