<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 13/11/2018
 * Time: 12:11
 */


function selectRecientes($connection){

    try {
        $consulta = $connection->prepare("SELECT * FROM pregunta ORDER BY fecha DESC LIMIT  20");
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta ->execute();
        $listaPreguntas=array();
        $id = 0;

        while($pregunta = $consulta->fetch()){
            $listaPreguntas[$id] = $pregunta;
            $id++;
        }

        $connection=null;
        return $listaPreguntas;
    }
    catch(Exception $e){
        echo $e;
    }
}

function selectMasVotadas($conexion){
    try{
        $consulta = $conexion->prepare("SELECT pregunta.* FROM pregunta WHERE pregunta.idPregunta IN (SELECT `idPre` FROM 
                                      (SELECT `contados`,`idPre` FROM
                                        (SELECT COUNT(*) AS `contados`,Pregunta_idPregunta AS `idPre` FROM `votos_pregunta` WHERE tipo=1 GROUP BY Pregunta_idPregunta) AS contar1 ORDER BY `contados` DESC LIMIT 20
                                      ) AS contar2)");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        $listaPreguntas = array();
        $id = 0;

        while($pregunta = $consulta->fetch()){
            $listaPreguntas[$id] = $pregunta;
            $id++;
        }

        $conexion = null;
        return $listaPreguntas;
    }catch(Exception $e){
        echo $e;
    }
}

function selectPreguntabyID($conexion,$id){
    try{

        $consulta = $conexion->prepare("SELECT * FROM pregunta WHERE idPregunta = :id");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id',"$id");
        $consulta->execute();
        $pregunta = $consulta -> fetch();

        $conexion=null;
        return $pregunta;
    }catch (Exception $e){
        echo $e;
    }
}

function selectPreguntabyTemas($conexion,$temas,$id){
    try{
        if ($id==null){
            $id = 0;
        }
        $contador = 0;
        $temasConsulta = "";
        foreach ($temas as $item=>$value){

            if($contador==sizeof($temas)-1){
                $temasConsulta = $temasConsulta . " tema.idTema = " . $value['idTema'];
            }else {
                $temasConsulta = $temasConsulta . " tema.idTema = " . $value['idTema'] . " OR";
            }
            $contador++;
        }

        $consulta = $conexion->prepare("SELECT pregunta.* FROM pregunta,tema,pregunta_has_tema 
          WHERE tema.idTema=pregunta_has_tema.Tema_idTema AND pregunta.idPregunta = pregunta_has_tema.Pregunta_idPregunta
          AND (".$temasConsulta .") AND pregunta.idPregunta>:id LIMIT 1");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id',"$id");
        $consulta->execute();



       $pregunta = $consulta->fetch();



        $conexion = null;
        return $pregunta;
    }catch(Exception $e){
        echo $e;
    }
}

