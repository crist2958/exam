-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-10-2023 a las 15:51:19
-- Versión del servidor: 10.5.20-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id21339672_miempresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--
CREATE TABLE `tb_productos` (
  `idPro` int(11) NOT NULL AUTO_INCREMENT,  -- Agregar AUTO_INCREMENT aquí para incrementar automáticamente el ID
  `Nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,  -- Nombre del producto
  `Precio` float NOT NULL,  -- Precio del producto
  `Ext` int(11) NOT NULL,  -- Cantidad en existencia
  PRIMARY KEY (`idPro`)  -- Definir idPro como clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcado de datos para la tabla `tb_productos`
-- Insertar productos sin especificar idPro porque es AUTO_INCREMENT
INSERT INTO `tb_productos` (`Nombre`, `Precio`, `Ext`) VALUES
('TV UltraHD 52 plg.', 12500, 4),  -- Producto 1: TV
('Impresora Laser Color', 5200, 3);  -- Producto 2: Impresora

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tb_usuarios`
CREATE TABLE `tb_usuarios` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,  -- idUser es AUTO_INCREMENT para incrementar automáticamente
  `NomUser` varchar(20) NOT NULL,  -- Nombre de usuario
  `Passwd` varchar(25) NOT NULL,  -- Contraseña del usuario
  `NiveUser` int(11) NOT NULL,  -- Nivel de usuario
  `NomComplet` text,  -- Nombre completo del usuario
  PRIMARY KEY (`idUser`)  -- Definir idUser como clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcado de datos para la tabla tb_usuarios
-- Insertar usuarios con datos y permitir que idUser se incremente automáticamente
INSERT INTO `tb_usuarios` (`NomUser`, `Passwd`, `NiveUser`, `NomComplet`) VALUES
('jefeventas', 'unach//..8975423', 2, 'CRISTHIAN CABRERA RIVERA'),  -- Usuario 1
('jefesuc1', 'suc&&//889..', 2, NULL),  -- Usuario 2, sin nombre completo
('jefe', '123', 2, 'JOSE MANUEL MALDONADO MONZON');  -- Usuario 3

-- --------------------------------------------------------
-- AUTO_INCREMENT de las tablas volcadas

-- AUTO_INCREMENT de la tabla `tb_productos`
ALTER TABLE `tb_productos`
  MODIFY `idPro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;  -- Comenzar AUTO_INCREMENT en 3 (porque ya hay 2 productos)

-- AUTO_INCREMENT de la tabla `tb_usuarios`
ALTER TABLE `tb_usuarios`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;  -- Comenzar AUTO_INCREMENT en 4 (porque ya hay 3 usuarios)
