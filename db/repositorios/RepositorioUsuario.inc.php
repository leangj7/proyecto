<?php
include_once 'db/tablas/Usuario.inc.php';

class RepositorioUsuario {

    public static function sa($longitud) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numero_caracteres = strlen($caracteres);
        $string_aleatorio = '';
        
        for ($i = 0; $i < $longitud; $i++) {
            $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
        }
        
        return $string_aleatorio;
    }
    
    public static function insertarUsuario($conexion, $usuario) {
        $usuarioInsertado = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO usuario (nombre, apellido, fechaNac, usuario, clave, email, activo) VALUES (:nombre, :apellido, :fechaNac, :usuario, :clave, :email, :activo)";
                $sentencia = $conexion -> prepare($sql);
                
                $nomTemp = $usuario -> getNombre();
                $apeTemp = $usuario -> getApellido();
                $fechaNacTemp = $usuario -> getFechaNac();
                $usuTemp = $usuario -> getUsuario();
                $claveTemp = $usuario -> getClave();
                $emailTemp = $usuario -> getEmail();
                $activoTemp = $usuario -> getActivo();

                $sentencia -> bindParam(':nombre', $nomTemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':apellido', $apeTemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':fechaNac', $fechaNacTemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':usuario', $usuTemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':clave', $claveTemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $emailTemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':activo', $activoTemp, PDO::PARAM_STR);

                $usuarioInsertado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $usuarioInsertado;
    }

    public static function insertarConfirmacion($conexion, $idusu, $url) {
        $confirmacionGenerada = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO confirmacion_cuenta (idusu, url, fecha) VALUES (:idusu, 
                :url, NOW())";
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':idusu', $idusu, PDO::PARAM_STR);
                $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);

                $confirmacionGenerada = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $confirmacionGenerada;
    }

    public static function getIDurl($conexion, $url) {
        $idusuario = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM confirmacion_cuenta WHERE url = :url";
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

    public static function activarUsuario($conexion, $id) {
        if (isset($conexion)) {
            try {
                $conexion -> beginTransaction();

                $sql = "UPDATE usuario SET activo = 1 WHERE id = :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> execute();

                $sql1 = "DELETE FROM confirmacion_cuenta WHERE idusu = :id";
                $sentencia1 = $conexion -> prepare($sql1);
                $sentencia1 -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia1 -> execute();

                $conexion -> commit();
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
                $conexion -> rollBack();
            }
        }
    }

    public static function modificarUsuario($conexion, $nombre, $apellido, $fechaNac, $email, $id) {
        $usuarioModificado = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE usuario SET nombre = :nombre, apellido = :apellido, fechaNac = :fechaNac, email = :email WHERE id = :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia -> bindParam(':apellido', $apellido, PDO::PARAM_STR);
                $sentencia -> bindParam(':fechaNac', $fechaNac, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);

                $usuarioModificado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $usuarioModificado;
    }
    
    public static function eliminarUsuario($conexion, $id) {
        if (isset($conexion)) {
            try {
                $conexion -> beginTransaction();

                $sql1 = "DELETE FROM consigue WHERE idusu = :id";
                $sentencia1 = $conexion -> prepare($sql1);
                $sentencia1 -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia1 -> execute();

                $sql2 = "DELETE FROM recuperacion_clave WHERE idusu = :id";
                $sentencia2 = $conexion -> prepare($sql2);
                $sentencia2 -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia2 -> execute();

                $sql3 = "DELETE FROM elige WHERE idusu = :id";
                $sentencia3 = $conexion -> prepare($sql3);
                $sentencia3 -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia3 -> execute();

                $sql4 = "DELETE FROM usuario WHERE id = :id";
                $sentencia4 = $conexion -> prepare($sql4);
                $sentencia4 -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia4 -> execute();

                $conexion -> commit();
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
                $conexion -> rollBack();
            }
        }
    }

    public static function getUsuarioEmail($conexion, $email) {
        $usuario = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuario WHERE email = :email";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                if (!empty($resultado)) {
                    $usuario = new Usuario(
                        $resultado['id'], $resultado['nombre'], 
                        $resultado['apellido'], $resultado['fechaNac'], 
                        $resultado['usuario'], $resultado['clave'], 
                        $resultado['email'], $resultado['activo']);
                } else {
                    $usuario = null;
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $usuario;
    }

    public static function getUsuario($conexion, $nomusuario) {
        $usuario = null;

        if (isset($conexion)) {
            try
            {
                $sql = "SELECT * FROM usuario WHERE usuario = :usuario";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':usuario', $nomusuario, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch(); // Pide un resultado unico y no un array

                if (!empty($resultado)) {
                    $usuario = new Usuario(
                        $resultado['id'], $resultado['nombre'], 
                        $resultado['apellido'], $resultado['fechaNac'], 
                        $resultado['usuario'], $resultado['clave'], 
                        $resultado['email'], $resultado['activo']);
                } else {
                    $usuario = null;
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $usuario;
    }

    public static function getDatosUsuario($conexion, $id) {
        $usuario = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuario WHERE id = :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();

                if (!empty($resultado)) {
                    $usuario = new Usuario(
                        $resultado['id'], $resultado['nombre'], 
                        $resultado['apellido'], $resultado['fechaNac'], 
                        $resultado['usuario'], $resultado['clave'], 
                        $resultado['email'], $resultado['activo']);
                } else {
                    $usuario = null;
                }
            } catch (PDOException  $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $usuario;
    }
    
    // Verificar si un usuario intenta registrarse con SU email o uno existente en la BD
    public static function usuario_email($conexion, $id, $email) {
        $usuario_email = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuario WHERE id = :id AND email = :email";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
    
                if (count($resultado)) {
                    $usuario_email = true;
                } else {
                    $usuario_email = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $usuario_email;
    }

    public static function actualizarClave($conexion, $id, $clave) {
        $claveActualizada = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE usuario SET clave = :clave WHERE id = :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam('clave', $clave, PDO::PARAM_STR);
                $sentencia -> bindParam('id', $id, PDO::PARAM_STR);

                $claveActualizada = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage() . '<br>';
            }
        }
        return $claveActualizada;
    }
}