-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database-2013214
CREATE DATABASE IF NOT EXISTS `database-2013214` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database-2013214`;

-- Dumping structure for table database-2013214.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_uuid` char(36) NOT NULL DEFAULT uuid(),
  `firstname` varchar(20) NOT NULL DEFAULT '',
  `lastname` varchar(20) NOT NULL DEFAULT '',
  `address` varchar(25) NOT NULL DEFAULT '',
  `city` varchar(25) NOT NULL DEFAULT '',
  `province` varchar(25) NOT NULL DEFAULT '',
  `postal_code` varchar(7) NOT NULL DEFAULT '',
  `username` varchar(12) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`customer_uuid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for procedure database-2013214.customers_delete
DELIMITER //
CREATE PROCEDURE `customers_delete`(
	IN `p_customer_uuid` CHAR(36)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(customers_delete) 

#delete row from table customers when it finds customer_uuid is equal to p_customer_uuid(passed in parameter)
DELETE 
FROM customers
WHERE customer_uuid = p_customer_uuid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.customers_insert
DELIMITER //
CREATE PROCEDURE `customers_insert`(
	IN `p_firstname` VARCHAR(20),
	IN `p_lastname` VARCHAR(20),
	IN `p_address` VARCHAR(25),
	IN `p_city` VARCHAR(25),
	IN `p_province` VARCHAR(25),
	IN `p_postal_code` VARCHAR(7),
	IN `p_username` VARCHAR(12),
	IN `p_password` VARCHAR(255)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(customers_insert) 
#insert new row in table customers
INSERT INTO customers (firstname, lastname, address, city, province, postal_code, username, password)
VALUES (p_firstname, p_lastname, p_address, p_city, p_province, p_postal_code, p_username, p_password);

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.customers_select
DELIMITER //
CREATE PROCEDURE `customers_select`()
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(customers_select) 
#select all rows(data) from table customers
SELECT customer_uuid, firstname, lastname, address, city, province, postal_code, username, PASSWORD 
FROM customers
ORDER BY create_date;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.customers_update
DELIMITER //
CREATE PROCEDURE `customers_update`(
	IN `p_customer_uuid` CHAR(36),
	IN `p_firstname` VARCHAR(20),
	IN `p_lastname` VARCHAR(20),
	IN `p_address` VARCHAR(25),
	IN `p_city` VARCHAR(25),
	IN `p_province` VARCHAR(25),
	IN `p_postal_code` VARCHAR(7),
	IN `p_username` VARCHAR(12),
	IN `p_password` VARCHAR(255)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(customers_update) 

#update the data in table customers when it finds customer_uuid is equal to p_customer_uuid(passed in parameter)
UPDATE customers
SET customer_uuid = p_customer_uuid, firstname = p_firstname, lastname = p_lastname, 
	 address = p_address, city = p_city, province = p_province, postal_code = p_postal_code, username = p_username, 
	 password = p_password, modify_date = NOW()
WHERE customer_uuid = p_customer_uuid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.customer_logged_in
DELIMITER //
CREATE PROCEDURE `customer_logged_in`(
	IN `p_username` VARCHAR(12),
	IN `p_password` VARCHAR(255)
)
BEGIN
 
#Revision history
#Happy Patel (2013214)		3-12-2020		Create procedure(customer_logged_in) 

#select firstname and lastname from table customers when it finds username = p_username AND PASSWORD = p_password(both condition have to satisfied)
SELECT customer_uuid,firstname, lastname
FROM customers
WHERE username = p_username AND PASSWORD = p_password;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.customer_login
DELIMITER //
CREATE PROCEDURE `customer_login`(
	IN `p_username` VARCHAR(12)
)
BEGIN

#Revision history
#Happy Patel (2013214)		3-12-2020		Create procedure(customer_login) 

#select password when it finds username is equal to p_username(passed in parameter) 
SELECT PASSWORD  
FROM customers
WHERE username = p_username;
 
END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.get_customer_row
DELIMITER //
CREATE PROCEDURE `get_customer_row`(
	IN `p_customer_uuid` CHAR(36)
)
BEGIN

#Revision history
#Happy Patel (2013214)		3-12-2020		Create procedure(get_customer_row) 

#select particular row(data) from table customers when it finds customer_uuid is equal to p_customer_uuid
SELECT customer_uuid, firstname, lastname, address, city, province, postal_code, username, PASSWORD 
FROM customers
WHERE customer_uuid = p_customer_uuid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.get_product
DELIMITER //
CREATE PROCEDURE `get_product`(
	IN `p_product_uuid` CHAR(36)
)
BEGIN

#Revision history
#Happy Patel (2013214)		3-12-2020		Create procedure(get_product) 

#select price from table products when it finds product_uuid is equal to p_product_uuid
SELECT product_code, price 
FROM products
WHERE product_uuid = p_product_uuid;

END//
DELIMITER ;

-- Dumping structure for table database-2013214.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_uuid` char(36) NOT NULL DEFAULT uuid(),
  `product_code` varchar(12) NOT NULL DEFAULT '',
  `price` decimal(7,2) DEFAULT NULL,
  `description` varchar(100) NOT NULL DEFAULT '',
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_uuid`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for procedure database-2013214.products_delete
DELIMITER //
CREATE PROCEDURE `products_delete`(
	IN `p_product_uuid` CHAR(36)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(products_delete) 

#delete row from table products when it finds product_uuid is equal to p_product_uuid(passed in parameter)
DELETE 
FROM products
WHERE product_uuid = p_product_uuid; 

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.products_insert
DELIMITER //
CREATE PROCEDURE `products_insert`(
	IN `p_product_code` VARCHAR(12),
	IN `p_price` DECIMAL(7,2),
	IN `p_description` VARCHAR(100)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(products_insert) 

#insert new row in table products
INSERT INTO products (product_code, price, description)
VALUES (product_code, price, description);

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.products_select
DELIMITER //
CREATE PROCEDURE `products_select`()
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(products_select) 

#select all the rows(data) from products table
SELECT product_uuid, product_code, price, description
FROM products
ORDER BY create_date;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.products_update
DELIMITER //
CREATE PROCEDURE `products_update`(
	IN `p_product_uuid` CHAR(36),
	IN `p_product_code` VARCHAR(12),
	IN `p_price` DECIMAL(7,2),
	IN `p_description` VARCHAR(100)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(products_update) 

#update the data in table products when it finds product_uuid is equal to p_product_uuid(passed in parameter)
UPDATE products
SET product_uuid = p_product_uuid, product_code = p_product_code, price = p_price, description = p_description, modify_date = NOW()
WHERE product_uuid = p_product_uuid;

END//
DELIMITER ;

-- Dumping structure for view database-2013214.products_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `products_view` (
	`product_uuid` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`product_code` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`price` DECIMAL(7,2) NULL,
	`description` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table database-2013214.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_uuid` char(36) NOT NULL DEFAULT uuid(),
  `customer_uuid` char(36) NOT NULL,
  `product_uuid` char(36) NOT NULL,
  `product_code` varchar(12) NOT NULL DEFAULT '',
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `city` varchar(25) NOT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(3) NOT NULL,
  `sub_total` decimal(7,2) NOT NULL,
  `tax` decimal(7,2) NOT NULL,
  `grand_total` decimal(7,2) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`purchase_uuid`),
  KEY `FK_purchases_customers` (`customer_uuid`),
  KEY `FK_purchases_products` (`product_uuid`),
  CONSTRAINT `FK_purchases_customers` FOREIGN KEY (`customer_uuid`) REFERENCES `customers` (`customer_uuid`),
  CONSTRAINT `FK_purchases_products` FOREIGN KEY (`product_uuid`) REFERENCES `products` (`product_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for procedure database-2013214.purchases_delete
DELIMITER //
CREATE PROCEDURE `purchases_delete`(
	IN `p_purchase_uuid` CHAR(36)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(purchases_delete) 

#delete row from table purchases when it finds purchase_uuid is equal to p_purchase_uuid(passed in parameter)
DELETE 
FROM purchases 
WHERE purchase_uuid = p_purchase_uuid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.purchases_insert
DELIMITER //
CREATE PROCEDURE `purchases_insert`(
	IN `p_product_uuid` CHAR(36),
	IN `p_customer_uuid` CHAR(36),
	IN `p_product_code` VARCHAR(12),
	IN `p_firstname` VARCHAR(20),
	IN `p_lastname` VARCHAR(20),
	IN `p_city` VARCHAR(25),
	IN `p_comments` VARCHAR(200),
	IN `p_price` DECIMAL(7,2),
	IN `p_quantity` INT,
	IN `p_sub_total` DECIMAL(7,2),
	IN `p_tax` DECIMAL(7,2),
	IN `p_grand_total` DECIMAL(7,2)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(purchases_insert) 
#Happy Patel (2013214)		5-12-2020		did some changes(in primary key) in procedure(purchases_insert)
 
#insert new row in table purchases
INSERT INTO purchases (product_uuid, customer_uuid, product_code, firstname, lastname, city, comments, price, quantity, sub_total, tax, grand_total)
VALUES (p_product_uuid, p_customer_uuid, p_product_code, p_firstname, p_lastname, p_city, p_comments, p_price, p_quantity, p_sub_total, p_tax, p_grand_total);

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.purchases_select
DELIMITER //
CREATE PROCEDURE `purchases_select`()
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(purchases_select) 
#Happy Patel (2013214)		5-12-2020		did some changes(in primary key) in procedure(purchases_select)
 
#select all the rows(data) from purchases table
SELECT purchase_uuid, product_uuid, customer_uuid, product_code, firstname, lastname, city, comments, price, quantity, sub_total, tax, grand_total
FROM purchases
ORDER BY create_date;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.purchases_select_row
DELIMITER //
CREATE PROCEDURE `purchases_select_row`(
	IN `p_customer_uuid` CHAR(36)
)
BEGIN

#Revision history
#Happy Patel (2013214)		6-12-2020		Create procedure(purchases_select_row) 

#select the rows(data) from purchases table when it finds customer_uuid is equal to p_customer_uuid
SELECT purchase_uuid, product_uuid, customer_uuid, product_code, firstname, lastname, city, comments, price, quantity, sub_total, tax, grand_total
FROM purchases
WHERE customer_uuid = p_customer_uuid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.purchases_sort
DELIMITER //
CREATE PROCEDURE `purchases_sort`(
	IN `p_date` DATETIME,
	IN `p_uuid` CHAR(36)
)
BEGIN

#Revision history
#Happy Patel (2013214)		11-12-2020		Create procedure(purchases_sort) 

#this procedure will take date as parameter and gives all purchase transaction from that date till now with sorted by purchase date in desending order
#if date is not valid it shows all the purchases(orders) of logged in user
DECLARE resultcount INT;

		SELECT COUNT(purchase_uuid)
		INTO @resultcount
		FROM ((purchases
		INNER JOIN customers ON purchases.customer_uuid = customers.customer_uuid)
		INNER JOIN products ON purchases.product_uuid = products.product_uuid)
		WHERE purchases.create_date >= p_date AND purchases.customer_uuid = p_uuid;
		
		IF (@resultcount<=0) THEN
				SELECT purchase_uuid, customers.firstname, customers.lastname,customers.city, products.product_code, purchases.quantity, purchases.price, purchases.comments, purchases.create_date,purchases.sub_total,purchases.tax,purchases.grand_total
				FROM ((purchases
				INNER JOIN customers ON purchases.customer_uuid = customers.customer_uuid)
				INNER JOIN products ON purchases.product_uuid = products.product_uuid)
				WHERE  purchases.customer_uuid = p_uuid
				ORDER BY create_date DESC;
		ELSE
			SELECT purchase_uuid, customers.firstname, customers.lastname,customers.city, products.product_code, purchases.quantity, purchases.price, purchases.comments, purchases.create_date,purchases.sub_total,purchases.tax,purchases.grand_total
			FROM ((purchases
			INNER JOIN customers ON purchases.customer_uuid = customers.customer_uuid)
			INNER JOIN products ON purchases.product_uuid = products.product_uuid)
			WHERE purchases.create_date >= p_date AND purchases.customer_uuid = p_uuid
			ORDER BY create_date DESC;
		END IF;
				

END//
DELIMITER ;

-- Dumping structure for procedure database-2013214.purchases_update
DELIMITER //
CREATE PROCEDURE `purchases_update`(
	IN `p_purchase_uuid` CHAR(36),
	IN `p_product_uuid` CHAR(36),
	IN `p_customer_uuid` CHAR(36),
	IN `p_product_code` VARCHAR(12),
	IN `p_firstname` VARCHAR(20),
	IN `p_lastname` VARCHAR(20),
	IN `p_city` VARCHAR(25),
	IN `p_comments` VARCHAR(200),
	IN `p_price` DECIMAL(7,2),
	IN `p_quantity` INT,
	IN `p_sub_total` DECIMAL(7,2),
	IN `p_tax` DECIMAL(7,2),
	IN `p_grand_total` DECIMAL(7,2)
)
BEGIN

#Revision history
#Happy Patel (2013214)		30-11-2020		Create procedure(purchases_update) 
#Happy Patel (2013214)		5-12-2020		did some changes(in primary key) in procedure(purchases_update) 

#update the data in table purchases when it finds purchase_uuid is equal to p_purchase_uuid(passed in parameter)
UPDATE purchases
SET purchase_uuid = p_purchase_uuid, product_uuid = p_product_uuid, customer_uuid = p_customer_uuid, product_code = p_product_code, 
	 firstname = p_firstname, lastname = p_lastname, city = p_city, comments = p_comments, 
	 price = p_price, quantity = p_quantity, sub_total = p_sub_total, tax = p_tax, grand_total = p_grand_total,
	 modify_date = NOW()
WHERE purchase_uuid = p_purchase_uuid;

END//
DELIMITER ;

-- Dumping structure for view database-2013214.products_view
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `products_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `products_view` AS select `products`.`product_uuid` AS `product_uuid`,`products`.`product_code` AS `product_code`,`products`.`price` AS `price`,`products`.`description` AS `description` from `products` order by `products`.`product_code`;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
