<?php

function findPregunta($conexion, $titulo, $cuerpo, $usuario){
    try{
        $datos = array('titulo' => $titulo, 'cuerpo' => $cuerpo, 'usuario' => $usuario);

        $consulta = $conexion -> prepare('SELECT * FROM Pregunta WHERE titulo = :titulo AND cuerpo = :cuerpo AND Usuario_idUsuario = :usuario');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        $pregunta = $consulta -> fetch();
        return $pregunta;
    }
    catch (Exception $e){
        return null;
    }
}

function findPreguntaById($conexion, $id){
    try{
        $datos = array('id' => $id);

        $consulta = $conexion -> prepare('SELECT * FROM Pregunta WHERE idPregunta = :id');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        $pregunta = $consulta -> fetch();
        return $pregunta;
    }
    catch (Exception $e){
        return null;
    }
}

function insertPregunta($conexion, $titulo, $cuerpo, $usuario){
    try{
        $fecha=date("Y")."-".date("m")."-".date("d");
        $datos = array('titulo' => $titulo, 'cuerpo' => $cuerpo, 'fecha' => $fecha, 'usuario' => $usuario);

        $consulta = $conexion -> prepare('INSERT INTO Pregunta (titulo, cuerpo, fecha, Usuario_idUsuario) VALUES (:titulo, :cuerpo, :fecha, :usuario)');
        $consulta -> execute($datos);
    }
    catch (Exception $e){
        return null;
    }
}

function insertPreguntaTema($conexion, $pregunta, $tema){
    try{
        $datos = array('pregunta' => $pregunta, 'tema' => $tema);

        $consulta = $conexion -> prepare('INSERT INTO Pregunta_has_Tema (Pregunta_idPregunta, Tema_idTema) VALUES (:pregunta, :tema)');
        $consulta -> execute($datos);
    }
    catch (Exception $e){
        return null;
    }
}

function findPreguntasByUsuario($conexion, $usuario){
    try{
        $datos = array('usuario' => $usuario);

        $consulta = $conexion -> prepare('SELECT * FROM Pregunta WHERE Usuario_idUsuario = :usuario');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        while($pregunta = $consulta -> fetch())
        {
            $preguntas[]=$pregunta;
        }
        return $preguntas;
    }
    catch (Exception $e){
        return null;
    }
}
?>