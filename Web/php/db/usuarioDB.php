<?php

/**
 * Buscar usuario por id o por correo
 * @param $conexion conexion de la base de datos
 * @param $correo correo del usuario
 * @param null $id id del usuario
 * @return null reotrna array asociativo del usuario y si no lo ha encontrado retorna null
 */
function findUsuario($conexion, $correo, $id = null)
{

    try {
        $datos = array();
        if ($correo == "no") {
            $datos['id'] = $id;
            $consulta = $conexion->prepare('SELECT * FROM usuario WHERE idUsuario = :id');
        } else {
            $datos['correo'] = $correo;
            $consulta = $conexion->prepare('SELECT * FROM usuario WHERE correo = :correo');
        }
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute($datos);
        $usuario = $consulta->fetch();
        $conexion = null;
        return $usuario;
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Buscar un usuario por nombre de usuario
 * @param $conexion conexion de la base de datos
 * @param $nombreusu nombre de usuario
 * @return bool true si lo ha encontdado
 */
function findUsuarioByNombreUsu($conexion, $nombreusu)
{
    $encontrado = false;
    try {
        $consulta = $conexion->prepare('SELECT nombreusu FROM usuario WHERE nombreusu = :nombreusu');
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':nombreusu', "$nombreusu");
        $consulta->execute();
        $usuario = $consulta->fetch();
        if (!$usuario == null)
            $encontrado = true;
        else
            $encontrado = false;
    } catch (Exception $e) {
    }
    return $encontrado;
}

/**
 * Buscar usuario por correo
 * @param $conexion conexion de la base de datos
 * @param $correo correo del usuario
 * @return bool true si lo ha encontrado
 */
function findUsuarioByEmail($conexion, $correo)
{
    $encontrado = false;
    try {
        $consulta = $conexion->prepare('SELECT correo FROM usuario WHERE correo = :correo');
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':correo', "$correo");
        $consulta->execute();
        $usuario = $consulta->fetch();
        if (!$usuario == null)
            $encontrado = true;
        else
            $encontrado = false;
    } catch (Exception $e) {
    }
    return $encontrado;
}

/**
 * Insertar usuario en la base de datos
 * @param $conexion conexion de la base de datos
 * @param $datos array asociativo con todos los datos del usuario
 * @return bool true si se ha introducido correctamente
 */
function altaUsuario($conexion, $datos)
{
    $correcto = false;
    try {
        $consulta = $conexion->prepare('INSERT INTO usuario (`nombreusu`, `correo`, `pass`, `desc`, `img`) 
                                          VALUES (:nombreusu, :correo, :pass, :desc, :img)');
        $consulta->execute($datos);
        $correcto = true;
    } catch (Exception $e) {
    }
    return $correcto;
}