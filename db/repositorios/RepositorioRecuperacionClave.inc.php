<?php

class RepositorioRecuperacionClave {

    public static function generarPeticion($conexion, $idusu, $url) {
        $peticionGenerada = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO recuperacion_clave (idusu, url, fecha) VALUES (:idusu, 
                :url, NOW())";
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':idusu', $idusu, PDO::PARAM_STR);
                $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);

                $peticionGenerada = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $peticionGenerada;
    }

    public static function getIDurl($conexion, $url) {
        $idusuario = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM recuperacion_clave WHERE url = :url";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();

                if (!empty($resultado)) {
                    $idusuario = $resultado['idusu'];
                } else {
                    $idusuario = -1;
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $idusuario;
    }

    public static function usuarioExiste($conexion, $idusu) {
        $usuarioExiste = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM recuperacion_clave WHERE idusu = :idusu";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':idusu', $idusu, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();

                if (count($resultado)) {
                    $usuarioExiste = true;
                } else {
                    $usuarioExiste = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $usuarioExiste;
    }

    public static function borrarPeticion($conexion, $idusu) {
        if (isset($conexion)) {
            try {
                if (self :: usuarioExiste($conexion, $idusu)) {
                    $sql = "DELETE FROM recuperacion_clave WHERE idusu = :idusu";
                    $sentencia = $conexion -> prepare($sql);
                    $sentencia -> bindParam(':idusu', $idusu, PDO::PARAM_STR);
                    $sentencia -> execute();
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
    }
}