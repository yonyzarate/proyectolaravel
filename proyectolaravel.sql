DROP DATABASE IF EXISTS proyectolaravel;

CREATE DATABASE proyectolaravel;

USE proyectolaravel;



CREATE TABLE categorias (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE,
    descripcion VARCHAR(256) NULL,
	 condicion TINYINT DEFAULT '1' 
)ENGINE=INNODB DEFAULT CHARSET=Latin1;


CREATE TABLE productos (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    idcategoria INT(11) NOT NULL,
    codigo VARCHAR(50) NULL,
    nombre VARCHAR(100)NOT NULL UNIQUE,
    precio_venta DECIMAL(11,2),categorias
    stock INT(20) NOT NULL,
    condicion TINYINT DEFAULT '1',
    CONSTRAINT FK_categoria_Producto FOREIGN KEY (idcategoria) REFERENCES categorias (id)
)ENGINE=INNODB DEFAULT CHARSET=Latin1; 