CREATE TABLE `companies` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `tax_rate` decimal(5,2) DEFAULT NULL
);

CREATE TABLE `holidays` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `status` enum('approve','decline','pending') DEFAULT 'pending'
);

CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_category_id` int DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
);

CREATE TABLE `service_categories` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
);

CREATE TABLE `service_rates` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `company_id` int NOT NULL,
  `unit` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `supply_markup` float DEFAULT NULL,
  `overhead_markup` float DEFAULT NULL,
  `misc_markup` float DEFAULT NULL,
  `service_request_id` int NOT NULL
);

CREATE TABLE `service_request` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `issue_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `proposed_start_date` datetime DEFAULT NULL,
  `proposed_end_date` datetime NOT NULL,
  `actual_start_date` datetime NOT NULL,
  `actual_end_date` datetime DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `adjustment` text NOT NULL
);

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `hourly_rate` float DEFAULT NULL,
  `address` text,
  `phone` varchar(30) DEFAULT NULL
);

CREATE TABLE `work_orders` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_request_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` enum('approve','decline','pending','started','completed','paid') DEFAULT 'pending'
);
