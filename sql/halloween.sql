CREATE DATABASE halloween;

USE halloween;

CREATE TABLE
    usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        clave TEXT NOT NULL
    );

CREATE TABLE
    disfraces (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        descripcion TEXT NOT NULL,
        votos INT DEFAULT 0,
        foto VARCHAR(100),
        foto_blob BLOB,
        eliminado INT DEFAULT 0
    );

CREATE TABLE
    votos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT,
        id_disfraz INT,
        FOREIGN KEY (id_usuario) REFERENCES usuarios (id),
        FOREIGN KEY (id_disfraz) REFERENCES disfraces (id)
    );