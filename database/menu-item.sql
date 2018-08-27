CREATE TABLE IF NOT EXISTS `mylife_db`.`menu_item` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` MEDIUMTEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `code` VARCHAR(10) NULL,
  `name_menu` VARCHAR(100) NULL,
  `name_EN` VARCHAR(255) NULL,
  `name_JP` VARCHAR(255) NULL,
  `name_VN` VARCHAR(255) NULL,
  `chay` TINYINT(1) NULL,
  `cay` TINYINT(1) NULL,
  `price` INT(20) NOT NULL,
  `image` MEDIUMTEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `companyId` INT(10) UNSIGNED NOT NULL,
  `menuCategoryId` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `menu_companyid_foreign` (`companyId` ASC),
  CONSTRAINT `menu_companyid_foreign`
    FOREIGN KEY (`companyId`)
    REFERENCES `mylife_db`.`company` (`id`),
  CONSTRAINT `menu_menucategoryid_foreign`
    FOREIGN KEY ()
    REFERENCES `mylife_db`.`menu_item_category` ())
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mylife_db`.`menu_item_category` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` MEDIUMTEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `code` VARCHAR(10) NULL,
  `name_menu` VARCHAR(100) NULL,
  `name_EN` VARCHAR(255) NULL,
  `name_JP` VARCHAR(255) NULL,
  `name_VN` VARCHAR(255) NULL,
  `chay` TINYINT(1) NULL,
  `cay` TINYINT(1) NULL,
  `price` INT(20) NOT NULL,
  `image` MEDIUMTEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `companyId` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `menu_companyid_foreign` (`companyId` ASC),
  CONSTRAINT `menu_companyid_foreign0`
    FOREIGN KEY (`companyId`)
    REFERENCES `mylife_db`.`company` (`id`))
ENGINE = InnoDB