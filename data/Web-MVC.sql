CREATE DATABASE `web-mvc.noebuerki-services.ch`;
USE `web-mvc.noebuerki-services.ch`;

CREATE TABLE `user` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `apiKey` VARCHAR(20) NOT NULL UNIQUE,
    `admin` BOOLEAN DEFAULT false
);