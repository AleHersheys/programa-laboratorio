CREATE DATABASE laboratorio;
USE DATABASE laboratorio;


DROP TABLE IF EXISTS userlab;
CREATE TABLE userlab (
    id INT(5) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(50) NOT NULL,
    correo VARCHAR(50) NOT NULL,
    id_persona INT(5)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS persona;
CREATE TABLE persona (
    id INT(5) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(20) NOT NULL,
    apellido VARCHAR(20) NOT NULL,
    cedula INT(10),
    telefono INT(15),
    tipo ENUM("Doctor", "Enfermero", "Cliente") NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS exam;
CREATE TABLE exam (
    id INT(5) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
    id_doctor INT(15) NOT NULL,
    id_paciente INT(15) NOT NULL,
    resultados VARCHAR(400),
    realizado BOOLEAN DEFAULT 0,
    tipo VARCHAR(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO persona (
    nombre,
    apellido,
    cedula,
    telefono,
    tipo
) VALUES (
    'Jorge',
    'Simancas',
    '81767346',
    '0424678211',
    'Doctor'
);

INSERT INTO persona (
    nombre,
    apellido,
    cedula,
    telefono,
    tipo
) VALUES (
    'Maritza',
    'Albarrán',
    '11976732',
    '0424678211',
    'Enfermero'
);

INSERT INTO userlab (
    usuario,
    contraseña,
    correo,
    id_persona
) VALUES (
    'DoctorEpico123',
    '44f635d5e0ae172e735f273a3a8f6907',
    'doctorepico@hotmail.com',
    '1'
);

INSERT INTO userlab (
    usuario,
    contraseña,
    correo,
    id_persona
) VALUES (
    'Enfermeruwu',
    '5daf0165477726dade5181b6c9cb8c1b',
    'enfermera@enfermera.com',
    '2'
);

DROP TABLE IF EXISTS clientes;
CREATE TABLE clientes (
    id INT(5) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
    id_persona INT(5),
    correo VARCHAR(20)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;