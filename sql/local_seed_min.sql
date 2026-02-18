-- IASis local seed minimo de demo
-- Fecha: 2026-02-16

SET @anio_actual = YEAR(CURDATE());

USE base_sobral;

INSERT INTO curso2 (idcurso, curso, division, descripcion, habilitado) VALUES
('1A','1','A','1A - Primero A','1'),
('2A','2','A','2A - Segundo A','1')
ON DUPLICATE KEY UPDATE descripcion=VALUES(descripcion), habilitado=VALUES(habilitado);

INSERT INTO alumno (dni, apellido, nombre) VALUES
('30111222','Gomez','Ana'),
('30222333','Perez','Luis'),
('30333444','Sosa','Marta')
ON DUPLICATE KEY UPDATE apellido=VALUES(apellido), nombre=VALUES(nombre);

DELETE FROM cursa WHERE alumno IN ('30111222','30222333','30333444') AND anio=@anio_actual;
INSERT INTO cursa (alumno, curso, divi, anio, control) VALUES
('30111222','1','A',@anio_actual,'1'),
('30222333','1','A',@anio_actual,'1'),
('30333444','1','A',@anio_actual,'1');

INSERT INTO injus (id, letra, valorfalta) VALUES
(0, 'J', 1.00),
(1, 'I', 1.00),
(2, 'T', 0.50),
(3, 'AP', 0.00),
(4, 'TT', 0.25),
(5, 'PEND', 0.00)
ON DUPLICATE KEY UPDATE letra=VALUES(letra), valorfalta=VALUES(valorfalta);

INSERT IGNORE INTO feriados (fecha, descripcion) VALUES
(DATE_FORMAT(CURDATE(), '%Y-%m-01'), 'Feriado demo de mes actual');

DELETE FROM alumnos_faltas WHERE dni IN ('30111222','30222333','30333444') AND YEAR(fecha)=@anio_actual;
INSERT INTO alumnos_faltas (dni, fecha, tipo, injus) VALUES
('30111222', CURDATE(), 'General', 1),
('30222333', CURDATE(), 'General', 0),
('30333444', CURDATE(), 'EF', 2),
('30111222', DATE_SUB(CURDATE(), INTERVAL 3 DAY), 'General', 0),
('30222333', DATE_SUB(CURDATE(), INTERVAL 4 DAY), 'TEDI', 1),
('30333444', DATE_SUB(CURDATE(), INTERVAL 6 DAY), 'General', 1);

INSERT INTO usuarios (usuario, pass, nombre, valor, estado, role) VALUES
('demo','demo','Usuario Demo',1,1,'directivo')
ON DUPLICATE KEY UPDATE pass=VALUES(pass), nombre=VALUES(nombre), valor=VALUES(valor), estado=VALUES(estado), role=VALUES(role);

INSERT INTO notificaciones (codigo, descripcion, agente, anio, path) VALUES
(1, CONCAT('NOTIFICACION DEMO ', @anio_actual), 'Usuario Demo', @anio_actual, NULL),
(2, CONCAT('FALTA - DOCENTE DEMO FECHA: ', CURDATE()), 'Usuario Demo', @anio_actual, NULL)
ON DUPLICATE KEY UPDATE descripcion=VALUES(descripcion), agente=VALUES(agente), anio=VALUES(anio), path=VALUES(path);

INSERT INTO notasnuevo (codigo, descripcion, gen, fecha, agente, anio, path) VALUES
(101, 'Nota demo de convivencia', 'GEN-001', CURDATE(), 'Usuario Demo', @anio_actual, NULL),
(102, 'Nota demo de asistencia', 'GEN-002', DATE_SUB(CURDATE(), INTERVAL 5 DAY), 'Usuario Demo', @anio_actual, NULL)
ON DUPLICATE KEY UPDATE descripcion=VALUES(descripcion), gen=VALUES(gen), fecha=VALUES(fecha), agente=VALUES(agente), anio=VALUES(anio), path=VALUES(path);

INSERT INTO docente (dni, apellido, nombre, direccion, numero) VALUES
('30111222','Gomez','Ana','Yamana','1572')
ON DUPLICATE KEY UPDATE apellido=VALUES(apellido), nombre=VALUES(nombre), direccion=VALUES(direccion), numero=VALUES(numero);

INSERT INTO preceptores (dni, apellido, nombre, turno, email, telefono, activo) VALUES
('40111222','Lopez','Carla','Manana','carla.lopez@example.com','2901-555111',1)
ON DUPLICATE KEY UPDATE apellido=VALUES(apellido), nombre=VALUES(nombre), turno=VALUES(turno), email=VALUES(email), telefono=VALUES(telefono), activo=VALUES(activo);

INSERT INTO alumnos (dni, alumno, curso, division) VALUES
('30111222','Gomez Ana','1','A'),
('30222333','Perez Luis','1','A'),
('30333444','Sosa Marta','1','A')
ON DUPLICATE KEY UPDATE alumno=VALUES(alumno), curso=VALUES(curso), division=VALUES(division);

USE sid;

INSERT INTO alumnos (dni, alumno, curso, division) VALUES
('30111222','Gomez Ana','1','A'),
('30222333','Perez Luis','1','A'),
('30333444','Sosa Marta','1','A')
ON DUPLICATE KEY UPDATE alumno=VALUES(alumno), curso=VALUES(curso), division=VALUES(division);

DELETE FROM alumnos_faltas WHERE dni IN ('30111222','30222333','30333444') AND YEAR(fecha)=@anio_actual;
INSERT INTO alumnos_faltas (dni, fecha, tipo, injus) VALUES
('30111222', CURDATE(), 'General', 1),
('30222333', CURDATE(), 'General', 0),
('30333444', CURDATE(), 'EF', 2);

INSERT INTO usuarios (usuario, pass, nombre, valor, estado, role) VALUES
('demo','demo','Usuario Demo',1,1,'directivo')
ON DUPLICATE KEY UPDATE pass=VALUES(pass), nombre=VALUES(nombre), valor=VALUES(valor), estado=VALUES(estado), role=VALUES(role);

INSERT INTO notificaciones (codigo, descripcion, agente, anio, path) VALUES
(1, CONCAT('NOTIFICACION DEMO ', @anio_actual), 'Usuario Demo', @anio_actual, NULL),
(2, CONCAT('FALTA - Gomez Ana FECHA: ', CURDATE(), ' MATERIA: Matematica CURSO: 1A TURNO: Manana'), 'Usuario Demo', @anio_actual, NULL)
ON DUPLICATE KEY UPDATE descripcion=VALUES(descripcion), agente=VALUES(agente), anio=VALUES(anio), path=VALUES(path);

INSERT INTO notasnuevo (codigo, descripcion, gen, fecha, agente, anio, path) VALUES
(101, 'Nota demo de convivencia', 'GEN-001', CURDATE(), 'Usuario Demo', @anio_actual, NULL),
(102, 'Nota demo de asistencia', 'GEN-002', DATE_SUB(CURDATE(), INTERVAL 5 DAY), 'Usuario Demo', @anio_actual, NULL)
ON DUPLICATE KEY UPDATE descripcion=VALUES(descripcion), gen=VALUES(gen), fecha=VALUES(fecha), agente=VALUES(agente), anio=VALUES(anio), path=VALUES(path);

INSERT INTO docente (dni, apellido, nombre, direccion, numero) VALUES
('30111222','Gomez','Ana','Yamana','1572')
ON DUPLICATE KEY UPDATE apellido=VALUES(apellido), nombre=VALUES(nombre), direccion=VALUES(direccion), numero=VALUES(numero);

INSERT INTO preceptores (dni, apellido, nombre, turno, email, telefono, activo) VALUES
('40111222','Lopez','Carla','Manana','carla.lopez@example.com','2901-555111',1)
ON DUPLICATE KEY UPDATE apellido=VALUES(apellido), nombre=VALUES(nombre), turno=VALUES(turno), email=VALUES(email), telefono=VALUES(telefono), activo=VALUES(activo);
