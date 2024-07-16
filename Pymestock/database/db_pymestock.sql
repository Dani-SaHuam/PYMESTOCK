CREATE DATABASE db_pymestock CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE db_pymestock

CREATE TABLE usuarios (
  usuario_id INT AUTO_INCREMENT PRIMARY KEY,
  n_documento VARCHAR(20) NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  apellidos VARCHAR(150) NOT NULL,
  correo VARCHAR(150) UNIQUE NOT NULL,
  clave VARCHAR(200) NOT NULL,
  estado TINYINT DEFAULT 1,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;

CREATE TABLE categoria (
  categoria_id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  descripcion TEXT NOT NULL,
  estado TINYINT DEFAULT 1,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)ENGINE=INNODB;

CREATE TABLE subcategoria(
  subcategoria_id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  categoria_id INT NOT NULL,
  estado TINYINT DEFAULT 1,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (categoria_id) REFERENCES categoria(categoria_id)
  ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=INNODB;

CREATE TABLE unidad_de_medida(
  unidad_id INT AUTO_INCREMENT PRIMARY KEY,
  codigo_abrev VARCHAR(50) NOT NULL,
  nombre VARCHAR(150) NOT NULL,
  estado TINYINT DEFAULT 1,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;

CREATE TABLE productos (
  producto_id INT AUTO_INCREMENT PRIMARY KEY,
  codigo_barras VARCHAR(100) COMMENT 'CODIGO DE BARRAS O CODIGO SKU',
  nombre VARCHAR(250) NOT NULL,
  descripcion TEXT,
  categoria_id INT NOT NULL,
  subcategoria_id INT NOT NULL,
  unidad_id INT NOT NULL,
  precio_compra DECIMAL(20,2) NOT NULL,
  precio_venta DECIMAL(20,2) NOT NULL,
  lleva_impuesto TINYINT DEFAULT 1 COMMENT '1 =  lleva impuesto , 0 = no lleva',
  estado TINYINT DEFAULT 1,
  imagen VARCHAR(250),
  stock_min INT NOT NULL,
  stock INT NOT NULL,
  FOREIGN KEY (categoria_id) REFERENCES categoria(categoria_id)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (subcategoria_id) REFERENCES subcategoria(subcategoria_id)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (unidad_id) REFERENCES unidad_de_medida(unidad_id)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;

CREATE TABLE clientes (
  cliente_id INT AUTO_INCREMENT PRIMARY KEY,
  n_documento VARCHAR(20) NOT NULL,
  razon_social VARCHAR(200) NOT NULL,
  celular VARCHAR(20) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  direccion VARCHAR(250) NOT NULL,
  correo VARCHAR(150) NOT NULL,
  estado TINYINT DEFAULT 1,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;

CREATE TABLE proveedores (
  proveedor_id INT AUTO_INCREMENT PRIMARY KEY,
  n_documento VARCHAR(20) NOT NULL,
  razon_social VARCHAR(200) NOT NULL,
  representante VARCHAR(200) NOT NULL,
  celular VARCHAR(20) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  direccion VARCHAR(250) NOT NULL,
  correo VARCHAR(150) NOT NULL,
  estado TINYINT DEFAULT 1,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;

CREATE TABLE tipo_documentos(
  documento_id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  estado TINYINT DEFAULT 1,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;

CREATE TABLE ventas (
  venta_id INT AUTO_INCREMENT PRIMARY KEY,
  documento_id INT NOT NULL,
  num_documento VARCHAR(20) UNIQUE NOT NULL,
  usuario_id INT NOT NULL,
  cliente_id INT NOT NULL,
  fecha DATE,
  estado TINYINT DEFAULT 1,
  total DECIMAL(20,2) NOT NULL,
  impuesto DECIMAL(20,2) NOT NULL,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (documento_id) REFERENCES tipo_documentos(documento_id)
  ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = INNODB;

CREATE TABLE detalle_ventas(
  detalle_id INT AUTO_INCREMENT PRIMARY KEY,
  venta_id INT NOT NULL,
  producto_id INT NOT NULL,
  precio_venta DECIMAL(20,2) NOT NULL,
  cantidad INT NOT NULL,
  FOREIGN KEY (venta_id) REFERENCES ventas(venta_id) 
  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (producto_id) REFERENCES productos(producto_id) 
  ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = INNODB;

CREATE TABLE compras(
  compra_id INT AUTO_INCREMENT PRIMARY KEY,
  documento_id INT NOT NULL,
  num_documento VARCHAR(20) UNIQUE NOT NULL,
  usuario_id INT NOT NULL,
  proveedor_id INT NOT NULL,
  fecha DATE,
  estado TINYINT DEFAULT 1,
  total DECIMAL(20,2) NOT NULL,
  impuesto DECIMAL(20,2) NOT NULL,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (proveedor_id) REFERENCES proveedores(proveedor_id)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (documento_id) REFERENCES tipo_documentos(documento_id)
  ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = INNODB;

CREATE TABLE detalle_compras(
  detalle_id INT AUTO_INCREMENT PRIMARY KEY,
  compra_id INT NOT NULL,
  producto_id INT NOT NULL,
  precio_compra DECIMAL(20,2) NOT NULL,
  cantidad INT NOT NULL,
  FOREIGN KEY (compra_id) REFERENCES compras(compra_id) 
  ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (producto_id) REFERENCES productos(producto_id) 
  ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = INNODB;

CREATE TABLE empresa (
n_documento VARCHAR(20) NOT NULL,
razon_social VARCHAR(250) NOT NULL,
correo VARCHAR(100) NOT NULL,
celular VARCHAR(20) NOT NULL,
telefono VARCHAR(20) NOT NULL,
localidad VARCHAR(200) NOT NULL,
impuesto DECIMAL(10,2) NOT NULL,
logo VARCHAR(200) NOT NULL,
fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;