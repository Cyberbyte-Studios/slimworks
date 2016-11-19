
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- containers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `containers`;

CREATE TABLE `containers`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` VARCHAR(32) NOT NULL,
    `classname` VARCHAR(32) NOT NULL,
    `pos` VARCHAR(64),
    `inventory` TEXT NOT NULL,
    `gear` TEXT NOT NULL,
    `dir` VARCHAR(128),
    `active` TINYINT(1) DEFAULT 0 NOT NULL,
    `owned` TINYINT(1) DEFAULT 0,
    `insert_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`,`pid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- gangs
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `gangs`;

CREATE TABLE `gangs`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `owner` VARCHAR(32),
    `name` VARCHAR(32),
    `members` TEXT,
    `maxmembers` INTEGER(3) DEFAULT 8,
    `bank` INTEGER(100) DEFAULT 0,
    `active` TINYINT(1) DEFAULT 1,
    `insert_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `name_UNIQUE` (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- houses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `houses`;

CREATE TABLE `houses`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` VARCHAR(32) NOT NULL,
    `pos` VARCHAR(64),
    `owned` TINYINT(1) DEFAULT 0,
    `garage` TINYINT(1) DEFAULT 0 NOT NULL,
    `insert_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`,`pid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- players
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `players`;

CREATE TABLE `players`
(
    `uid` INTEGER(12) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(32) NOT NULL,
    `aliases` TEXT NOT NULL,
    `playerid` VARCHAR(64) NOT NULL,
    `cash` INTEGER(100) DEFAULT 0 NOT NULL,
    `bankacc` INTEGER(100) DEFAULT 0 NOT NULL,
    `coplevel` enum('0','1','2','3','4','5','6','7') DEFAULT '0' NOT NULL,
    `mediclevel` enum('0','1','2','3','4','5') DEFAULT '0' NOT NULL,
    `civ_licenses` TEXT NOT NULL,
    `cop_licenses` TEXT NOT NULL,
    `med_licenses` TEXT NOT NULL,
    `civ_gear` TEXT NOT NULL,
    `cop_gear` TEXT NOT NULL,
    `med_gear` TEXT NOT NULL,
    `civ_stats` VARCHAR(32) DEFAULT '\"[100,100,0]\"' NOT NULL,
    `cop_stats` VARCHAR(32) DEFAULT '\"[100,100,0]\"' NOT NULL,
    `med_stats` VARCHAR(32) DEFAULT '\"[100,100,0]\"' NOT NULL,
    `arrested` TINYINT(1) DEFAULT 0 NOT NULL,
    `adminlevel` enum('0','1','2','3','4','5') DEFAULT '0' NOT NULL,
    `donorlevel` enum('0','1','2','3','4','5') DEFAULT '0' NOT NULL,
    `blacklist` TINYINT(1) DEFAULT 0 NOT NULL,
    `civ_alive` TINYINT(1) DEFAULT 0 NOT NULL,
    `civ_position` VARCHAR(64) DEFAULT '\"[]\"' NOT NULL,
    `playtime` VARCHAR(32) DEFAULT '\"[0,0,0]\"' NOT NULL,
    `insert_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_seen` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`uid`),
    UNIQUE INDEX `playerid` (`playerid`),
    INDEX `name` (`name`),
    INDEX `blacklist` (`blacklist`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vehicles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles`
(
    `id` INTEGER(12) NOT NULL AUTO_INCREMENT,
    `side` VARCHAR(16) NOT NULL,
    `classname` VARCHAR(64) NOT NULL,
    `type` VARCHAR(16) NOT NULL,
    `pid` VARCHAR(32) NOT NULL,
    `alive` TINYINT(1) DEFAULT 1 NOT NULL,
    `blacklist` TINYINT(1) DEFAULT 0 NOT NULL,
    `active` TINYINT(1) DEFAULT 0 NOT NULL,
    `plate` VARCHAR(64) NOT NULL,
    `plateString` VARCHAR(64) NOT NULL,
    `color` INTEGER(20) NOT NULL,
    `inventory` TEXT NOT NULL,
    `gear` TEXT NOT NULL,
    `fuel` DOUBLE DEFAULT 1 NOT NULL,
    `damage` VARCHAR(256) NOT NULL,
    `insert_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `side` (`side`),
    INDEX `pid` (`pid`),
    INDEX `type` (`type`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- wanted
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `wanted`;

CREATE TABLE `wanted`
(
    `wantedID` VARCHAR(64) NOT NULL,
    `wantedName` VARCHAR(32) NOT NULL,
    `wantedCrimes` TEXT NOT NULL,
    `wantedBounty` INTEGER(100) NOT NULL,
    `active` TINYINT(1) DEFAULT 0 NOT NULL,
    `insert_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`wantedID`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
