CREATE DATABASE laboratorio;
USE DATABASE laboratorio;


DROP TABLE IF EXISTS userlab;
CREATE TABLE userlab (
    id INT(5) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL UNIQUE,
    contrasena VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    correo VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    id_persona INT(5)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS persona;
CREATE TABLE persona (
    id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    apellido VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    cedula INT(10),
    telefono INT(15),
    tipo ENUM("Doctor", "Enfermero", "Cliente") NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS exam;
CREATE TABLE exam (
    id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_doctor INT(15) NOT NULL,
    id_paciente INT(15) NOT NULL,
    resultados VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
    realizado BOOLEAN DEFAULT 0,
    tipo VARCHAR(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
    contrasena,
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
    contrasena,
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
    correo VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO persona (
    nombre,
    apellido,
    cedula,
    telefono,
    tipo
) VALUES (
    'Ritchell',
    'Guerrero',
    '42069231',
    '04243241',
    'Cliente'
);

INSERT INTO clientes (
    id_persona,
    correo
) VALUES (
    '3',
    'guerra2@gmail.com'
);

INSERT INTO persona (
    nombre,
    apellido,
    cedula,
    telefono,
    tipo
) VALUES (
    'Enrichter',
    'Hidalmont',
    '6666666',
    '6666666',
    'Cliente'
);

INSERT INTO clientes (
    id_persona,
    correo
) VALUES (
    '4',
    'cazavampiros@castlevaniasonic.com'
);