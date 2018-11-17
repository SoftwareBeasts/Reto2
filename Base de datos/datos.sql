/*Datos tabla usuario*/
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`) VALUES ('admin', 'admin@softwarebeasts.com', '$2y$10$ZAdQGxOcGBNCRm9NRhgfp.XTdih9jj4rGQlLmOmofrfkKrM3jE5e2', 'Soy el administrador de todo esto :)');
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`) VALUES ('jon','jon@softwarebeasts.com','$2y$10$gJfqO80gFYyhZ5ni9r/QSOGCil6Wr3D5E5MwEide.Srf9PUgpTeJm','It was me, DIO!');/*12345*/
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`) VALUES ('unai','unai@softwarebeasts.com','$2y$10$ur/GulBWw33753nGzrUxbuKYQKdIofkQEHb7XGtubXRsHwlRN4jVy','Soy Unai');/*unaisito*/
INSERT INTO `usuario` (`nombreusu`, `correo`, `pass`, `desc`) VALUES ('imanol','imanol@softwarebeasts.com','$2y$10$SmcnpUNZIIHlOYV.X8HhwevKO2MicDjMLgjEVkIDYBfAgOhhKxNPS','Soy Imanol');/*imanolsito*/
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