<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 21/11/2018
 * Time: 9:39
 */
/*SELECT `idPRe` FROM ( SELECT `contados`,`idPre` FROM ( SELECT COUNT(*) AS `contados`,Pregunta_idPregunta AS `idPre` FROM `respuesta` GROUP BY Pregunta_idPregunta) AS contar1 ORDER BY `contados` DESC LIMIT 20 ) AS contar2*/

