CREATE TABLE IF NOT EXISTS `#__jobspro_` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`positiontype` VARCHAR(255)  NOT NULL ,
`published` DATE NOT NULL ,
`startdate` DATE NOT NULL ,
`applicationdeadline` DATE NOT NULL ,
`address` VARCHAR(255)  NOT NULL ,
`title` VARCHAR(255)  NOT NULL ,
`description` TEXT NOT NULL ,
`link` VARCHAR(255)  NOT NULL ,
`category` TEXT NOT NULL ,
`alias` VARCHAR(255) COLLATE utf8_bin NOT NULL ,
`mod_wrap` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

