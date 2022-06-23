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
    password VARCHAR(100) NOT NULL,
    condicion TINYINT DEFAULT '1',
    idrol INT(11) NOT NULL,
    imagen VARCHAR(300) NULL,
    remember_token VARCHAR(100) NULL,
    CONSTRAINT FK_rol_users FOREIGN KEY (idrol) REFERENCES roles (id)
)ENGINE=INNODB DEFAULT CHARSET=Latin1;

CREATE TABLE compras (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    idproveedor INT(11) NOT NULL,
    idusuario INT(11) NOT NULL,
    tipo_identificacion VARCHAR(20) NULL,
    num_compra VARCHAR(10) NULL,
    fecha_compra DATETIME NULL,
    impuesto DECIMAL(4,2) NULL,
    total DECIMAL(11,2) NULL,
    estado VARCHAR(20)NULL,
    CONSTRAINT FK_proveedor_compras FOREIGN KEY (idproveedor) REFERENCES proveedores (id),
    CONSTRAINT FK_usuario_compras FOREIGN KEY (idusuario) REFERENCES users (id)
)ENGINE=INNODB DEFAULT CHARSET=Latin1; 


CREATE TABLE detalle_compras (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    idcompra INT(11) NOT NULL,
    idproducto INT(11) NOT NULL,
    cantidad INT(11) NULL,
    precio DECIMAL(11,2) NULL,
    CONSTRAINT FK_compas_Dcompras FOREIGN KEY (idcompra) REFERENCES compras (id),
    CONSTRAINT FK_producto_Dcompras FOREIGN KEY (idproducto) REFERENCES productos (id)
)ENGINE=INNODB DEFAULT CHARSET=Latin1; 

CREATE TABLE ventas (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    idcliente INT(11) NOT NULL,
    idusuario INT(11) NOT NULL,
    tipo_identificacion VARCHAR(20) NULL,
    num_venta VARCHAR(10) NULL,
    fecha_venta DATETIME NULL,
    impuesto DECIMAL(4,2) NULL,
    total DECIMAL(11,2) NULL,
    estado VARCHAR(20)NULL,
    CONSTRAINT FK_cliente_ventas FOREIGN KEY (idcliente) REFERENCES clientes (id),
    CONSTRAINT FK_usuario_ventas FOREIGN KEY (idusuario) REFERENCES users (id)
)ENGINE=INNODB DEFAULT CHARSET=Latin1; 


CREATE TABLE detalle_ventas (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    idventa INT(11) NOT NULL,
    idproductoo INT(11) NOT NULL,
    cantidad INT(11) NULL,
    precio DECIMAL(11,2) NULL,
    descuento DECIMAL(11,2) NULL,
    CONSTRAINT FK_venta_Dcompras FOREIGN KEY (idventa) REFERENCES ventas (id),
    CONSTRAINT FK_producto_Dcompras FOREIGN KEY (idproducto) REFERENCES productos (id)
)ENGINE=INNODB DEFAULT CHARSET=Latin1; 