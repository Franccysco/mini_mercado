-- -----------------------------------------------------
-- Table `products`
-- -----------------------------------------------------

CREATE TABLE `products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `description` VARCHAR(255),
    `price` DECIMAL(10,2),
    `quantity` INT,
    `image` VARCHAR(255),
    `status` ENUM("available", "unavailable") DEFAULT "available",
    `category_id` INT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

-- -----------------------------------------------------
-- Table `categories`
-- -----------------------------------------------------
CREATE TABLE `categories` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `description` VARCHAR(255),
    `image` VARCHAR(255),
    `status` ENUM("active", "inactive") DEFAULT "active",
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

-- -----------------------------------------------------
-- Table `equipes`
-- -----------------------------------------------------
CREATE TABLE `equipes` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(40) NOT NULL,
    `cor` VARCHAR(10) NULL DEFAULT NULL,
    `quantidade` INT(11) NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- -----------------------------------------------------
-- Table `customers`
-- -----------------------------------------------------
CREATE TABLE `customers` (
    `id` INT NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(255),
    `address` VARCHAR(255),
    `email` VARCHAR(255),
    `phone` VARCHAR(255),
    `photo` VARCHAR(255),
    `password` VARCHAR(255),
    `status` ENUM("active", "inactive") DEFAULT "active",
    `equipes_id` INT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`equipes_id`) REFERENCES `equipes`(`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
);

-- -----------------------------------------------------
-- Table `orders`
-- -----------------------------------------------------
CREATE TABLE `orders` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `date` DATETIME,
    `customer_id` INT,
    `amount` DECIMAL(10,2),
    `status` ENUM("delivered", "received", "processing", "canceled") DEFAULT "received",
    `payment_method` ENUM("pix", "fiado", "dinhero", "cartao"),
    `payment_status` ENUM("paid", "unpaid") DEFAULT "unpaid",
    `observation` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`customer_id`) REFERENCES `customers`(`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
);

-- -----------------------------------------------------
-- Table `order_items`
-- -----------------------------------------------------
CREATE TABLE `order_items` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `price` DECIMAL(10,2) NOT NULL,
    `total` DECIMAL(10,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `reviews`
-- -----------------------------------------------------
CREATE TABLE `reviews` (
    `id` INT NOT NULL AUTO_INCREMENT UNIQUE,
    `customer_id` INT,
    `product_id` INT,
    `rating` INT,
    `content` VARCHAR(255),
    `date` DATETIME,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`customer_id`) REFERENCES `customers`(`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
    FOREIGN KEY(`product_id`) REFERENCES `products`(`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
);


--
-- Inserindo dados para a tabela `equipes`
--

INSERT INTO `equipes` (`id`, `nome`, `cor`, `quantidade`) VALUES
(1, 'SECRETARIA', '', NULL),
(2, 'COZINHA', '', NULL),
(3, 'CAFEZINHO', '', NULL),
(4, 'COMPRAS', '', NULL),
(5, 'GARÇOM', '', NULL),
(6, 'SALA', '', NULL),
(7, 'MINI-MERCADO', '', NULL),
(8, 'LITURGIA', '', NULL),
(9, 'VIGILIA', '', NULL),
(10, 'EXTERNA', '', NULL),
(11, 'CIRCULO', '', NULL),
(12, 'ORDEM E LIMPEZA', '', NULL),
(13, 'COORDENAÇÃO GERAL', '', NULL),
(14, 'ENCONTRISTAS', '', NULL);

-- -----------------------------------------------------
-- Table `groups`
-- -----------------------------------------------------
CREATE TABLE `groups` (
    `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(20) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE `users` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `ip_address` VARCHAR(45) NOT NULL,
    `username` VARCHAR(100) NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(254) NOT NULL,
    `activation_selector` VARCHAR(255) DEFAULT NULL,
    `activation_code` VARCHAR(255) DEFAULT NULL,
    `forgotten_password_selector` VARCHAR(255) DEFAULT NULL,
    `forgotten_password_code` VARCHAR(255) DEFAULT NULL,
    `forgotten_password_time` INT(11) UNSIGNED DEFAULT NULL,
    `remember_selector` VARCHAR(255) DEFAULT NULL,
    `remember_code` VARCHAR(255) DEFAULT NULL,
    `created_on` INT(11) UNSIGNED NOT NULL,
    `last_login` INT(11) UNSIGNED DEFAULT NULL,
    `active` TINYINT(1) UNSIGNED DEFAULT NULL,
    `first_name` VARCHAR(50) DEFAULT NULL,
    `last_name` VARCHAR(50) DEFAULT NULL,
    `company` VARCHAR(100) DEFAULT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `uc_email` UNIQUE (`email`),
    CONSTRAINT `uc_activation_selector` UNIQUE (`activation_selector`),
    CONSTRAINT `uc_forgotten_password_selector` UNIQUE (`forgotten_password_selector`),
    CONSTRAINT `uc_remember_selector` UNIQUE (`remember_selector`)
);

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_code`, `forgotten_password_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa', 'admin@admin.com', '', NULL, '1268889823', '1268889823', '1', 'Admin', 'istrator', 'ADMIN', '0');

-- -----------------------------------------------------
-- Table `users_groups`
-- -----------------------------------------------------
CREATE TABLE `users_groups` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `group_id` MEDIUMINT(8) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_users_groups_users1_idx` (`user_id`),
    KEY `fk_users_groups_groups1_idx` (`group_id`),
    CONSTRAINT `uc_users_groups` UNIQUE (`user_id`, `group_id`),
    CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
    CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
);

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- -----------------------------------------------------
-- Table `login_attempts`
-- -----------------------------------------------------
CREATE TABLE `login_attempts` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `ip_address` VARCHAR(45) NOT NULL,
    `login` VARCHAR(100) NOT NULL,
    `time` INT(11) UNSIGNED DEFAULT NULL,
    PRIMARY KEY (`id`)
);