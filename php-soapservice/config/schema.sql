CREATE TABLE `companies` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `name` varchar(255),
  `email` varchar(255),
  `logo_url` varchar(255),
  `address` varchar(255),
  `country` varchar(255),
  `tax_rate` decimal(5,2)
);


CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `company_id` int DEFAULT NULL,
  `first_name` varchar(100),
  `last_name` varchar(100),
  `avatar_url` varchar(255),
  `email` varchar(100),
  `role` varchar(100),
  `hourly_rate` float,
  `address` text,
  `phone` varchar(30)
);

CREATE TABLE `holidays` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `user_id` int,
  `start_date` timestamp,
  `end_date` timestamp,
  `status` ENUM ('approve', 'decline', 'pending')DEFAULT 'pending'
);

CREATE TABLE `service_categories` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `name` varchar(100)
);

CREATE TABLE `services` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `service_category_id` int,
  `company_id` int,
  `name` varchar(255)
);

CREATE TABLE `service_rates` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `service_id` int,
  `unit` float,
  `amount` float, 
  `duration` float,
  `supply_markup` float,
  `overhead_markup` float,
  `misc_markup` float
);

CREATE TABLE `service_request` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `service_category_id` int,
  `company_id` int,
  `name` varchar(255)
);

CREATE TABLE `work_order` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp,
  `service_request_id` int,
  `employee_id` int,
  `status`  ENUM ('approve', 'decline', 'pending', 'started', 'completed', 'paid')DEFAULT 'pending'
);





