-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS basedatos;

-- Usar la base de datos
USE basedatos;

-- Crear la tabla "registros" si no existe
CREATE TABLE IF NOT EXISTS registros (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    correo VARCHAR(255)
);