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
    imagen VARCHAR(300)NULL,
    CONSTRAINT FK_categoria_Producto FOREIGN KEY (idcategoria) REFERENCES categorias (id)
)ENGINE=INNODB DEFAULT CHARSET=Latin1; 

CREATE TABLE proveedores (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    tipo_documento VARCHAR(20) NULL,
    num_documento VARCHAR(20) NULL,
    direccion VARCHAR(70) NULL,
    telefono VARCHAR(20) NULL,
    email VARCHAR(50) NULL
)ENGINE=INNODB DEFAULT CHARSET=Latin1;

CREATE TABLE clientes (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NULL,
    tipo_documento VARCHAR(20) NULL,
    num_documento VARCHAR(20) NULL,
    direccion VARCHAR(70) NULL,
    telefono VARCHAR(20) NULL,
    email VARCHAR(50) NULL
)ENGINE=INNODB DEFAULT CHARSET=Latin1;

CREATE TABLE roles (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE,
    descripcion VARCHAR(100) NULL,
	condicion TINYINT DEFAULT '1' 
)ENGINE=INNODB DEFAULT CHARSET=Latin1;

CREATE TABLE users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NULL,
    tipo_documento VARCHAR(20) NULL,
    num_documento VARCHAR(20) NULL,
    direccion VARCHAR(70) NULL,
    telefono VARCHAR(20) NULL,
    email VARCHAR(50) NULL,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    passwor VARCHAR(100) NOT NULL,
    condicion TINYINT DEFAULT '1',
    idrol INT(11) NOT NULL,
    imagen VARCHAR(300) NULL,
    remember_token VARCHAR(100) NULL,
    CONSTRAINT FK_rol_users FOREIGN KEY (idrol) REFERENCES roles (id)
 )ENGINE=INNODB DEFAULT CHARSET=Latin1;