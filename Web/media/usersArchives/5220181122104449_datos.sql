/*Establecer a 1 todos los auto_increment de las tablas*/
ALTER TABLE `pregunta` AUTO_INCREMENT=1;
ALTER TABLE `respuesta` AUTO_INCREMENT=1;
ALTER TABLE `tema` AUTO_INCREMENT=1;
ALTER TABLE `usuario` AUTO_INCREMENT=1;
ALTER TABLE `voto_respuesta` AUTO_INCREMENT=1;
ALTER TABLE `voto_pregunta` AUTO_INCREMENT=1;

/*Datos tabla usuario*/
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`, `img`) VALUES ('admin', 'admin@softwarebeasts.com', '$2y$10$ZAdQGxOcGBNCRm9NRhgfp.XTdih9jj4rGQlLmOmofrfkKrM3jE5e2', 'Soy el administrador de todo esto :)' ,'/media/usersImg/user_default.png');
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`, `img`) VALUES ('jon','jon@softwarebeasts.com','$2y$10$gJfqO80gFYyhZ5ni9r/QSOGCil6Wr3D5E5MwEide.Srf9PUgpTeJm','It was me, DIO!' ,'/media/usersImg/user_default.png');/*12345*/
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`, `img`) VALUES ('unai','unai@softwarebeasts.com','$2y$10$ur/GulBWw33753nGzrUxbuKYQKdIofkQEHb7XGtubXRsHwlRN4jVy','Soy Unai' ,'/media/usersImg/user_default.png');/*unaisito*/
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`, `img`) VALUES ('imanol','imanol@softwarebeasts.com','$2y$10$SmcnpUNZIIHlOYV.X8HhwevKO2MicDjMLgjEVkIDYBfAgOhhKxNPS','Soy Imanol' ,'/media/usersImg/user_default.png');/*imanolsito*/
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`, `img`) VALUES ('unaipuelles', 'unai.puelles@ikasle.egibide.org', '$2y$10$1N5omX10suf5qOAkzisy6.PtMtcULnugiULlZdGgQDTdvGB1wF0z6', NULL ,'/media/usersImg/unaipuelles.png');/*12345Abcde*/

/*Datos tabla Preguntas*/
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-6','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP2','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-7','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP3','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-8','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP4','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-9','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP5','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-10','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP6','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-11','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP7','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-12','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP8','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-13','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP9','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-14','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP10','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-15','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP11','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-16','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP12','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-17','2');
INSERT INTO `pregunta` (`titulo`,`cuerpo`,`fecha`,`Usuario_idUsuario`) VALUES ('Como usar PHP13','Ayuda por favor, no se como usar php y me estoy rayando un monton, por favor ayudenme si son tan amables muchas gracias de antemano','2018-11-18','2');


/*DATOS RESPUESTAS*/
	/*PREGUNTA 1*/
	INSERT INTO `respuesta`(`titulo`,`cuerpo`,`fecha`,`aprobado`,`Usuario_idUsuario`,`Pregunta_idPregunta`) VALUES('Jaja que bobo','Si no sabes como usar php a estas alturas, no se como has programado esta web jaja','2018-11-14',0,'2','1');
	INSERT INTO `respuesta`(`titulo`,`cuerpo`,`fecha`,`aprobado`,`Usuario_idUsuario`,`Pregunta_idPregunta`) VALUES('Jaja que bobo','Si no sabes como usar php a estas alturas, no se como has programado esta web jaja','2018-11-14',0,'2','1');
	INSERT INTO `respuesta`(`titulo`,`cuerpo`,`fecha`,`aprobado`,`Usuario_idUsuario`,`Pregunta_idPregunta`) VALUES('Jaja que bobo','Si no sabes como usar php a estas alturas, no se como has programado esta web jaja','2018-11-14',0,'2','1');
	
/*TEMAS*/
INSERT INTO `tema`(nombre) VALUES('php');	


/*Pregunta has Tema*/
INSERT INTO `pregunta_has_tema`(`Pregunta_idPregunta`,`Tema_idTema`) VALUES(1,1);
INSERT INTO `pregunta_has_tema`(`Pregunta_idPregunta`,`Tema_idTema`) VALUES(2,1);