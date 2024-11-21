-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 16 nov. 2024 à 21:47
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `weapon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(16) NOT NULL,
  `damage` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `viking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `attack` int NOT NULL,
  `defense` int NOT NULL,
  `health` int NOT NULL,
  `weaponId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`weaponId`) REFERENCES `weapon`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `viking` (`name`, `attack`, `defense`, `health`) VALUES
('Ragnar', 200, 150, 300),
('Floki', 150, 80, 350),
('Lagertha', 300, 200, 200),
('Björn', 350, 200, 100);

INSERT INTO `weapon` (`type`, `damage`) VALUES
('sword', 800),
('axe', 600),
('bow', 400),
('spear', 550);