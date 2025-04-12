-- CREACIÓN DE TABLAS

CREATE TABLE categoria (
  categoria_id int(11) NOT NULL,
  nombre varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE marca (
  marca_id int(11) NOT NULL,
  nombre varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE proveedor (
  proveedor_id int(11) NOT NULL,
  contacto varchar(255) DEFAULT NULL,
  direccion longtext DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  nombre varchar(255) NOT NULL,
  telefono varchar(255) DEFAULT NULL,
  ruc varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE ubicacion_almacen (
  ubicacion_id int(11) NOT NULL,
  contenedor varchar(255) NOT NULL,
  estante varchar(255) NOT NULL,
  pasillo varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE modelo (
  modelo_id int(11) NOT NULL,
  genero enum('Femenino','Masculino','Unisex') NOT NULL,
  nombre varchar(255) NOT NULL,
  categoria_id int(11) NOT NULL,
  marca_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE entrada (
  entrada_id int(11) NOT NULL,
  fecha_entrada date NOT NULL,
  orden_compra varchar(255) DEFAULT NULL,
  proveedor_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE zapato (
  zapato_id int(11) NOT NULL,
  color varchar(255) NOT NULL,
  precio_comercial decimal(10,2) NOT NULL,
  sku varchar(255) NOT NULL,
  talla decimal(3,1) NOT NULL,
  url_imagen varchar(255) NOT NULL,
  modelo_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE inventario (
  inventario_id int(11) NOT NULL,
  cantidad_actual int(11) NOT NULL DEFAULT 0,
  stock_maximo int(11) NOT NULL DEFAULT 100,
  stock_minimo int(11) NOT NULL DEFAULT 10,
  ultima_actualizacion datetime(6) NOT NULL,
  ubicacion_id int(11) NOT NULL,
  zapato_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE detalle_entrada (
  detalle_id int(11) NOT NULL,
  cantidad int(11) NOT NULL,
  precio_compra decimal(10,2) NOT NULL,
  entrada_id int(11) NOT NULL,
  ubicacion_id int(11) NOT NULL,
  zapato_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE user (
  id binary(16) NOT NULL,
  created_at datetime(6) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  updated_at datetime(6) DEFAULT NULL,
  username varchar(255) DEFAULT NULL,
  fecha_creacion datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- LLAVES PRIMARIAS Y FORÁNEAS
ALTER TABLE categoria
  ADD PRIMARY KEY (categoria_id),
  ADD UNIQUE KEY UK35t4wyxqrevf09uwx9e9p6o75 (nombre);

ALTER TABLE marca
  ADD PRIMARY KEY (marca_id),
  ADD UNIQUE KEY UKg42kcgw83i65q054yikohi8b9 (nombre);

ALTER TABLE proveedor
  ADD PRIMARY KEY (proveedor_id);

ALTER TABLE ubicacion_almacen
  ADD PRIMARY KEY (ubicacion_id),
  ADD UNIQUE KEY UKh7fs8iogkbujfh51udk6tfrr9 (pasillo,estante,contenedor);

ALTER TABLE modelo
  ADD PRIMARY KEY (modelo_id),
  ADD KEY FK1qunbybfv0exqex3lmvsp1byk (categoria_id),
  ADD KEY FKllxq2dldvhxvb5q9csar7vdfy (marca_id);

ALTER TABLE entrada
  ADD PRIMARY KEY (entrada_id),
  ADD KEY FKs90da0scilue4ye83wyl94ftk (proveedor_id);

ALTER TABLE zapato
  ADD PRIMARY KEY (zapato_id),
  ADD UNIQUE KEY UKm8w1f6gnh2v76mwnpox2ftn3a (modelo_id,talla,color),
  ADD UNIQUE KEY UKlgowa1fj85y63muajtvsl23dl (sku);

ALTER TABLE inventario
  ADD PRIMARY KEY (inventario_id),
  ADD UNIQUE KEY UKnodkk1p2phdynmtai5m7fudig (zapato_id,ubicacion_id),
  ADD KEY FK38apr4nts8dxpgbd968kupm29 (ubicacion_id);

ALTER TABLE detalle_entrada
  ADD PRIMARY KEY (detalle_id),
  ADD KEY FKlab3gmfvasge851t36uvs4e82 (entrada_id),
  ADD KEY FK5n6yil44smxfey7c9prc3h410 (ubicacion_id),
  ADD KEY FK3dhujupnk5apy9l3ccr6s4tll (zapato_id);

ALTER TABLE user
  ADD PRIMARY KEY (id);

-- CONSTRAINTS
ALTER TABLE modelo
  ADD CONSTRAINT FK1qunbybfv0exqex3lmvsp1byk FOREIGN KEY (categoria_id) REFERENCES categoria (categoria_id),
  ADD CONSTRAINT FKllxq2dldvhxvb5q9csar7vdfy FOREIGN KEY (marca_id) REFERENCES marca (marca_id);

ALTER TABLE entrada
  ADD CONSTRAINT FKs90da0scilue4ye83wyl94ftk FOREIGN KEY (proveedor_id) REFERENCES proveedor (proveedor_id);

ALTER TABLE zapato
  ADD CONSTRAINT FKohn0ot0qaplh60glogx40nf2u FOREIGN KEY (modelo_id) REFERENCES modelo (modelo_id);

ALTER TABLE inventario
  ADD CONSTRAINT FK38apr4nts8dxpgbd968kupm29 FOREIGN KEY (ubicacion_id) REFERENCES ubicacion_almacen (ubicacion_id),
  ADD CONSTRAINT FKss4cebmfji3enbjenpvaogv2r FOREIGN KEY (zapato_id) REFERENCES zapato (zapato_id);

ALTER TABLE detalle_entrada
  ADD CONSTRAINT FK3dhujupnk5apy9l3ccr6s4tll FOREIGN KEY (zapato_id) REFERENCES zapato (zapato_id),
  ADD CONSTRAINT FK5n6yil44smxfey7c9prc3h410 FOREIGN KEY (ubicacion_id) REFERENCES ubicacion_almacen (ubicacion_id),
  ADD CONSTRAINT FKlab3gmfvasge851t36uvs4e82 FOREIGN KEY (entrada_id) REFERENCES entrada (entrada_id);

-- PROCEDIMIENTOS ALMACENADOS
DELIMITER $$
CREATE PROCEDURE IngresosMensuales (IN anio INT)  
BEGIN
    SELECT
        DATE_FORMAT(e.fecha_entrada, '%b') AS mes,
        m.nombre AS marca,
        SUM(de.cantidad) AS total_ingresado
    FROM entrada e
    JOIN detalle_entrada de ON e.entrada_id = de.entrada_id
    JOIN zapato z ON de.zapato_id = z.zapato_id
    JOIN modelo mo ON z.modelo_id = mo.modelo_id
    JOIN marca m ON mo.marca_id = m.marca_id
    WHERE YEAR(e.fecha_entrada) = anio
    GROUP BY m.nombre, mes
    ORDER BY MONTH(e.fecha_entrada);
END$$

CREATE PROCEDURE ListarInventario ()   
BEGIN
    SELECT 
        z.sku AS sku,
        z.url_imagen AS imagen,
        m.nombre AS modelo,
        z.talla AS talla,
        z.color AS color,
        ma.nombre AS marca,
        i.cantidad_actual AS stock,
        CONCAT(u.pasillo, '-', u.estante, '-', u.contenedor) AS almacen
    FROM inventario i
    JOIN zapato z ON i.zapato_id = z.zapato_id
    JOIN modelo m ON z.modelo_id = m.modelo_id
    JOIN marca ma ON m.marca_id = ma.marca_id
    JOIN ubicacion_almacen u ON i.ubicacion_id = u.ubicacion_id;
END$$

CREATE PROCEDURE ObtenerInventarioPorMarca ()   
BEGIN
    SELECT
        m.nombre AS Marca,
        SUM(i.cantidad_actual) AS Total
    FROM marca m
    JOIN modelo mo ON m.marca_id = mo.marca_id
    JOIN zapato z ON mo.modelo_id = z.modelo_id
    JOIN inventario i ON z.zapato_id = i.zapato_id
    GROUP BY m.nombre
    ORDER BY SUM(i.cantidad_actual) DESC;
END$$

CREATE PROCEDURE TotalDeInversion ()   
BEGIN
  SELECT SUM(precio_compra) AS Total FROM detalle_entrada;
END$$

CREATE PROCEDURE TotalDeProveedores ()   
BEGIN
  SELECT COUNT(proveedor_id) AS Total FROM proveedor;
END$$

CREATE PROCEDURE TotalDeZapatillas ()   
BEGIN
  SELECT SUM(cantidad_actual) AS Total FROM inventario;
END$$

CREATE PROCEDURE TotalModeloBajoStock (IN cantidad INT)   
BEGIN
    SELECT 
        COUNT(DISTINCT zapato_id) AS Total_Modelos 
    FROM inventario 
    WHERE cantidad_actual < cantidad;
END$$
DELIMITER ;

-- VISTAS
CREATE VIEW ListarInventario AS
SELECT 
    z.sku AS sku,
    z.url_imagen AS imagen,
    m.nombre AS modelo,
    z.talla AS talla,
    z.color AS color,
    ma.nombre AS marca,
    i.cantidad_actual AS stock,
    CONCAT(u.pasillo, '-', u.estante, '-', u.contenedor) AS almacen
FROM inventario i
JOIN zapato z ON i.zapato_id = z.zapato_id
JOIN modelo m ON z.modelo_id = m.modelo_id
JOIN marca ma ON m.marca_id = ma.marca_id
JOIN ubicacion_almacen u ON i.ubicacion_id = u.ubicacion_id;

CREATE VIEW ListarRecientes AS
SELECT 
    z.url_imagen AS Imagen,
    z.talla AS Talla,
    z.precio_comercial AS Precio,
    mo.nombre AS Modelo,
    z.color AS Color,
    SUM(de.cantidad) AS Stock_Ingresado,
    MAX(e.fecha_entrada) AS Fecha_Ingreso
FROM detalle_entrada de
JOIN entrada e ON de.entrada_id = e.entrada_id
JOIN zapato z ON de.zapato_id = z.zapato_id
JOIN modelo mo ON z.modelo_id = mo.modelo_id
JOIN marca ma ON mo.marca_id = ma.marca_id
GROUP BY z.zapato_id, z.url_imagen, z.talla, z.precio_comercial, mo.nombre, z.color
ORDER BY MAX(e.fecha_entrada) DESC
LIMIT 10;

-- INSERTS (Ordenados para respetar relaciones)
INSERT INTO categoria (categoria_id, nombre) VALUES
(1, 'Deportivo'),
(2, 'Urbano');

INSERT INTO marca (marca_id, nombre) VALUES
(1, 'Nike'),
(2, 'Rebook');

INSERT INTO proveedor (proveedor_id, contacto, direccion, email, nombre, telefono, ruc) VALUES
(1, 'Raul Mendez', 'Tupac', 'yolu@gmail.com', 'Yolu', '939428950', '123456');

INSERT INTO ubicacion_almacen (ubicacion_id, contenedor, estante, pasillo) VALUES
(1, 'A', '1', '1'),
(2, 'B', '1', '1');

INSERT INTO modelo (modelo_id, genero, nombre, categoria_id, marca_id) VALUES
(2, 'Unisex', 'Reebok Classic', 2, 2);

INSERT INTO entrada (entrada_id, fecha_entrada, orden_compra, proveedor_id) VALUES
(2, '2025-03-24', 'CP-2304', 1);

INSERT INTO zapato (zapato_id, color, precio_comercial, sku, talla, url_imagen, modelo_id) VALUES
(2, 'Gris/Rojo', 350.00, 'PR-2304-SD', 39.0, 'https://demostorage939.blob.core.windows.net/product-storage/7660177a-db1b-4c80-9805-8f81478b31a6.png', 2);

INSERT INTO inventario (inventario_id, cantidad_actual, stock_maximo, stock_minimo, ultima_actualizacion, ubicacion_id, zapato_id) VALUES
(2, 15, 50, 4, '2025-03-24 10:19:17.000000', 1, 2);

INSERT INTO detalle_entrada (detalle_id, cantidad, precio_compra, entrada_id, ubicacion_id, zapato_id) VALUES
(2, 15, 3600.00, 2, 1, 2);

INSERT INTO user (id, created_at, email, password, updated_at, username, fecha_creacion) VALUES
(0x33ca0324b23146658a0156eb4c157c9d, NULL, NULL, '$2a$10$E9Sbqb3p9.Q2w402KTQLDeAMQYRymXF6ehDe70uUulpdYS5h0i8ee', NULL, 'anthony', NULL);

-- AUTO_INCREMENT Y RESET DE VALORES
ALTER TABLE categoria
  MODIFY categoria_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE marca
  MODIFY marca_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE proveedor
  MODIFY proveedor_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE ubicacion_almacen
  MODIFY ubicacion_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE modelo
  MODIFY modelo_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE entrada
  MODIFY entrada_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE zapato
  MODIFY zapato_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE inventario
  MODIFY inventario_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE detalle_entrada
  MODIFY detalle_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


-- Modificar las claves foráneas para agregar ON DELETE CASCADE y ON UPDATE CASCADE

ALTER TABLE modelo
  DROP FOREIGN KEY FK1qunbybfv0exqex3lmvsp1byk,
  DROP FOREIGN KEY FKllxq2dldvhxvb5q9csar7vdfy;

ALTER TABLE modelo
  ADD CONSTRAINT FK1qunbybfv0exqex3lmvsp1byk FOREIGN KEY (categoria_id) REFERENCES categoria (categoria_id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FKllxq2dldvhxvb5q9csar7vdfy FOREIGN KEY (marca_id) REFERENCES marca (marca_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE entrada
  DROP FOREIGN KEY FKs90da0scilue4ye83wyl94ftk;

ALTER TABLE entrada
  ADD CONSTRAINT FKs90da0scilue4ye83wyl94ftk FOREIGN KEY (proveedor_id) REFERENCES proveedor (proveedor_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE zapato
  DROP FOREIGN KEY FKohn0ot0qaplh60glogx40nf2u;

ALTER TABLE zapato
  ADD CONSTRAINT FKohn0ot0qaplh60glogx40nf2u FOREIGN KEY (modelo_id) REFERENCES modelo (modelo_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE inventario
  DROP FOREIGN KEY FK38apr4nts8dxpgbd968kupm29,
  DROP FOREIGN KEY FKss4cebmfji3enbjenpvaogv2r;

ALTER TABLE inventario
  ADD CONSTRAINT FK38apr4nts8dxpgbd968kupm29 FOREIGN KEY (ubicacion_id) REFERENCES ubicacion_almacen (ubicacion_id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FKss4cebmfji3enbjenpvaogv2r FOREIGN KEY (zapato_id) REFERENCES zapato (zapato_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE detalle_entrada
  DROP FOREIGN KEY FK3dhujupnk5apy9l3ccr6s4tll,
  DROP FOREIGN KEY FK5n6yil44smxfey7c9prc3h410,
  DROP FOREIGN KEY FKlab3gmfvasge851t36uvs4e82;

ALTER TABLE detalle_entrada
  ADD CONSTRAINT FK3dhujupnk5apy9l3ccr6s4tll FOREIGN KEY (zapato_id) REFERENCES zapato (zapato_id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FK5n6yil44smxfey7c9prc3h410 FOREIGN KEY (ubicacion_id) REFERENCES ubicacion_almacen (ubicacion_id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FKlab3gmfvasge851t36uvs4e82 FOREIGN KEY (entrada_id) REFERENCES entrada (entrada_id) ON DELETE CASCADE ON UPDATE CASCADE;