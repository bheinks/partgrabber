-- Table Creation SQL
-- for PCPartPicker Database
-- Group G19

CREATE DATABASE partgrabber;

USE partgrabber;

CREATE TABLE `cpu` (
  `comp_id` int(5) NOT NULL,
  `manaufacturer` varchar(32) NOT NULL,
  `architecture` varchar(32) NOT NULL,
  `socket` varchar(32) NOT NULL,
  PRIMARY KEY (`comp_id`)
);

CREATE TABLE `gpu` (
  `comp_id` int(5) NOT NULL,
  `manaufacturer` varchar(32) NOT NULL,
  `clock_speed` varchar(32) NOT NULL,
  `vram` varchar(32) NOT NULL,
  PRIMARY KEY (`comp_id`)
);

CREATE TABLE `manufacturer` (
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
);

CREATE TABLE `motherboard` (
  `comp_id` int(5) NOT NULL,
  `manaufacturer` varchar(32) NOT NULL,
  `form_factor` varchar(32) NOT NULL,
  `socket` varchar(32) NOT NULL,
  PRIMARY KEY (`comp_id`)
);

CREATE TABLE `psu` (
  `comp_id` int(5) NOT NULL,
  `manaufacturer` varchar(32) NOT NULL,
  `wattage` varchar(32) NOT NULL,
  `form_factor` varchar(32) NOT NULL,
  PRIMARY KEY (`comp_id`)
);

CREATE TABLE `ram` (
  `comp_id` int(5) NOT NULL,
  `manaufacturer` varchar(32) NOT NULL,
  `capacity` varchar(32) NOT NULL,
  `speed` varchar(32) NOT NULL,
  PRIMARY KEY (`comp_id`)
);

CREATE TABLE `retailer` (
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
);

CREATE TABLE `saved_build` (
  `username` varchar(32) NOT NULL,
  `build_name` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  `cost` float(6,2) NOT NULL,
  PRIMARY KEY (`username`, `build_name`)
);

CREATE TABLE `sold_by` (
  `retail_name` varchar(32) NOT NULL,
  `comp_id` int(5) NOT NULL,
  `price` float(3,2) NOT NULL,
  PRIMARY KEY (`retail_name`, `price`)
);

CREATE TABLE `storage` (
  `comp_id` int(5) NOT NULL,
  `manaufacturer` varchar(32) NOT NULL,
  `capacity` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`comp_id`)
);


CREATE TABLE `user` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`username`)
);
