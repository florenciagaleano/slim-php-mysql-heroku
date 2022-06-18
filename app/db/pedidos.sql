-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-03-2021 a las 21:21:28
-- Versión del servidor: 8.0.13-4
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7

CREATE TABLE `pedidos` (
  ID int auto_increment,
  MESA_ID int,
  PRODUCTO_ID int,
  USUARIO_ID int,
  primary key(ID)
);


ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
