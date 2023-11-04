CREATE TABLE `medicine` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255),
  `code` varchar(255),
  `expired_date` datetime,
  `manufactured_date` datetime,
  `publisher` varchar(255),
  `instruction` text,
  `ingredient` varchar(255),
  `unit` varchar(255),
  `price` double,
  `created_at` timestamp DEFAULT (now()),
  `updated_at` timestamp DEFAULT (now())
);