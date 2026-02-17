-- IASis local schema minimo de demo
-- Fecha: 2026-02-16

CREATE DATABASE IF NOT EXISTS base_sobral CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE DATABASE IF NOT EXISTS sid CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Opcional: crear usuarios legacy locales (ejecutar solo si tenes permisos de administrador MySQL)
-- CREATE USER IF NOT EXISTS 'fgoicoechea'@'localhost' IDENTIFIED BY 'sobral2011';
-- CREATE USER IF NOT EXISTS 'root'@'localhost' IDENTIFIED BY 'msi2010';
-- GRANT ALL PRIVILEGES ON base_sobral.* TO 'fgoicoechea'@'localhost';
-- GRANT ALL PRIVILEGES ON sid.* TO 'fgoicoechea'@'localhost';
-- GRANT ALL PRIVILEGES ON sid.* TO 'root'@'localhost';
-- FLUSH PRIVILEGES;

USE base_sobral;

CREATE TABLE IF NOT EXISTS curso2 (
  idcurso VARCHAR(10) NOT NULL,
  curso VARCHAR(10) DEFAULT NULL,
  division VARCHAR(10) DEFAULT NULL,
  descripcion VARCHAR(100) DEFAULT NULL,
  habilitado CHAR(1) DEFAULT '1',
  PRIMARY KEY (idcurso)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS alumno (
  dni VARCHAR(20) NOT NULL,
  apellido VARCHAR(100) DEFAULT NULL,
  nombre VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (dni)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cursa (
  id INT NOT NULL AUTO_INCREMENT,
  alumno VARCHAR(20) NOT NULL,
  curso VARCHAR(10) DEFAULT NULL,
  divi VARCHAR(10) DEFAULT NULL,
  anio INT DEFAULT NULL,
  control CHAR(1) DEFAULT '1',
  PRIMARY KEY (id),
  KEY idx_cursa_alumno (alumno),
  KEY idx_cursa_curso_divi_anio (curso, divi, anio)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS alumnos_faltas (
  dni VARCHAR(20) NOT NULL,
  fecha DATE NOT NULL,
  tipo VARCHAR(50) DEFAULT NULL,
  injus INT DEFAULT NULL,
  KEY idx_falta_dni_fecha (dni, fecha)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS injus (
  id INT NOT NULL,
  letra VARCHAR(10) DEFAULT NULL,
  valorfalta DECIMAL(6,2) DEFAULT 1,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS feriados (
  id INT NOT NULL AUTO_INCREMENT,
  fecha DATE NOT NULL,
  descripcion VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_feriado_fecha (fecha)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(60) NOT NULL,
  pass VARCHAR(120) NOT NULL,
  nombre VARCHAR(120) DEFAULT NULL,
  valor INT DEFAULT 1,
  estado INT DEFAULT 1,
  PRIMARY KEY (id),
  UNIQUE KEY uq_usuario (usuario)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS notificaciones (
  id INT NOT NULL AUTO_INCREMENT,
  codigo INT DEFAULT NULL,
  descripcion VARCHAR(500) DEFAULT NULL,
  agente VARCHAR(120) DEFAULT NULL,
  anio INT DEFAULT NULL,
  path VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_notif_anio_codigo (anio, codigo)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS notasnuevo (
  id INT NOT NULL AUTO_INCREMENT,
  codigo INT DEFAULT NULL,
  descripcion VARCHAR(500) DEFAULT NULL,
  gen VARCHAR(80) DEFAULT NULL,
  fecha DATE DEFAULT NULL,
  agente VARCHAR(120) DEFAULT NULL,
  anio INT DEFAULT NULL,
  path VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_notas_anio_codigo (anio, codigo)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS docente (
  dni VARCHAR(20) NOT NULL,
  apellido VARCHAR(100) DEFAULT NULL,
  nombre VARCHAR(100) DEFAULT NULL,
  direccion VARCHAR(255) DEFAULT NULL,
  numero VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (dni)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS alumnos (
  dni VARCHAR(20) NOT NULL,
  alumno VARCHAR(200) DEFAULT NULL,
  curso VARCHAR(20) DEFAULT NULL,
  division VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (dni)
) ENGINE=InnoDB;

USE sid;

CREATE TABLE IF NOT EXISTS alumnos (
  dni VARCHAR(20) NOT NULL,
  alumno VARCHAR(200) DEFAULT NULL,
  curso VARCHAR(20) DEFAULT NULL,
  division VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (dni)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS alumnos_faltas (
  dni VARCHAR(20) NOT NULL,
  fecha DATE NOT NULL,
  tipo VARCHAR(50) DEFAULT NULL,
  injus INT DEFAULT NULL,
  KEY idx_falta_dni_fecha (dni, fecha)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(60) NOT NULL,
  pass VARCHAR(120) NOT NULL,
  nombre VARCHAR(120) DEFAULT NULL,
  valor INT DEFAULT 1,
  estado INT DEFAULT 1,
  PRIMARY KEY (id),
  UNIQUE KEY uq_usuario (usuario)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS notificaciones (
  id INT NOT NULL AUTO_INCREMENT,
  codigo INT DEFAULT NULL,
  descripcion VARCHAR(500) DEFAULT NULL,
  agente VARCHAR(120) DEFAULT NULL,
  anio INT DEFAULT NULL,
  path VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_notif_anio_codigo (anio, codigo)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS notasnuevo (
  id INT NOT NULL AUTO_INCREMENT,
  codigo INT DEFAULT NULL,
  descripcion VARCHAR(500) DEFAULT NULL,
  gen VARCHAR(80) DEFAULT NULL,
  fecha DATE DEFAULT NULL,
  agente VARCHAR(120) DEFAULT NULL,
  anio INT DEFAULT NULL,
  path VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_notas_anio_codigo (anio, codigo)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS docente (
  dni VARCHAR(20) NOT NULL,
  apellido VARCHAR(100) DEFAULT NULL,
  nombre VARCHAR(100) DEFAULT NULL,
  direccion VARCHAR(255) DEFAULT NULL,
  numero VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (dni)
) ENGINE=InnoDB;
