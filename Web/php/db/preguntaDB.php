<?php

require_once 'dbUtils.php';

function findPregunta($titulo, $cuerpo, $usuario){
    $conexion = getConnection();

    try{
        $datos = array('titulo' => $titulo, 'cuerpo' => $cuerpo, 'usuario' => $usuario);

        $consulta = $conexion -> prepare('SELECT * FROM Pregunta WHERE titulo = :titulo AND cuerpo = :cuerpo AND Usuario_idUsuario = :usuario');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        $pregunta = $consulta -> fetch();

        $conexion = null;
        return $pregunta;
    }
    catch (Exception $e){
        return null;
    }
}

function findPreguntaById($id){
    $conexion = getConnection();

    try{
        $datos = array('id' => $id);

        $consulta = $conexion -> prepare('SELECT * FROM Pregunta WHERE idPregunta = :id');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        $pregunta = $consulta -> fetch();

        $conexion = null;
        return $pregunta;
    }
    catch (Exception $e){
        return null;
    }
}

function insertPregunta($titulo, $cuerpo, $usuario){
    $conexion = getConnection();

    try{
        $fecha=date("Y")."-".date("m")."-".date("d");
        $datos = array('titulo' => $titulo, 'cuerpo' => $cuerpo, 'fecha' => $fecha, 'usuario' => $usuario);

        $consulta = $conexion -> prepare('INSERT INTO Pregunta (titulo, cuerpo, fecha, Usuario_idUsuario) VALUES (:titulo, :cuerpo, :fecha, :usuario)');
        $consulta -> execute($datos);

        $conexion = null;
    }
    catch (Exception $e){
        return null;
    }
}

function insertPreguntaTema($pregunta, $tema){
    $conexion = getConnection();

    try{
        $datos = array('pregunta' => $pregunta, 'tema' => $tema);

        $consulta = $conexion -> prepare('INSERT INTO Pregunta_has_Tema (Pregunta_idPregunta, Tema_idTema) VALUES (:pregunta, :tema)');
        $consulta -> execute($datos);

        $conexion = null;
    }
    catch (Exception $e){
        return null;
    }
}

function findPreguntasByUsuario($usuario){
    $conexion = getConnection();

    try{
        $datos = array('usuario' => $usuario);

        $consulta = $conexion -> prepare('SELECT * FROM Pregunta WHERE Usuario_idUsuario = :usuario');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        while($pregunta = $consulta -> fetch())
        {
            $preguntas[]=$pregunta;
        }

        $conexion = null;
        return $preguntas;
    }
    catch (Exception $e){
        return null;
    }
}
?>