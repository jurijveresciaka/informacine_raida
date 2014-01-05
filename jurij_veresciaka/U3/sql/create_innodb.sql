-- ///////////////////////////////////////////////////////////////////////////
-- Create database `TURKISH_INSURANCE`
-- ///////////////////////////////////////////////////////////////////////////

DROP DATABASE IF EXISTS `TURKISH_INSURANCE`;

CREATE DATABASE `TURKISH_INSURANCE` CHARSET=utf8 COLLATE utf8_general_ci;

USE  `TURKISH_INSURANCE`;

-- ///////////////////////////////////////////////////////////////////////////
-- 01. Create table `CUSTOMER`
-- ///////////////////////////////////////////////////////////////////////////

CREATE TABLE IF NOT EXISTS `CUSTOMER` (
    `customer_id` INT(11) NOT NULL AUTO_INCREMENT,
    
    first_name  VARCHAR(30) NOT NULL, 
    second_name VARCHAR(30) NOT NULL,
    phone       VARCHAR(20) NOT NULL,
    email       VARCHAR(50) NOT NULL,

    PRIMARY KEY (`customer_id`),

    UNIQUE INDEX cui_first_name_second_name (first_name, second_name),
    UNIQUE INDEX cui_phone (phone),
    UNIQUE INDEX cui_email (email)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- ///////////////////////////////////////////////////////////////////////////
-- 02. Create table `INSURANCE_PLAN`
-- ///////////////////////////////////////////////////////////////////////////

CREATE TABLE IF NOT EXISTS `INSURANCE_PLAN` (
    `insurance_plan_id` INT(11) NOT NULL AUTO_INCREMENT,
    
    title       VARCHAR(50) NOT NULL,
    daily_rate  DECIMAL(6, 2) NOT NULL,
    
    PRIMARY KEY (`insurance_plan_id`),
    
    UNIQUE INDEX cui_title (title)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- ///////////////////////////////////////////////////////////////////////////
-- 03. Create table `INSURANCE_CONTRACT`
-- ///////////////////////////////////////////////////////////////////////////

CREATE TABLE IF NOT EXISTS `INSURANCE_CONTRACT` (
    `insurance_contract_id` INT(11) NOT NULL AUTO_INCREMENT,
    
    start_date  DATE          NOT NULL,
    end_date    DATE          NOT NULL,
    price       DECIMAL(6, 2) NOT NULL,

    `customer_id`       INT(11) NOT NULL,
    `insurance_plan_id` INT(11) NOT NULL,

    PRIMARY KEY (`insurance_contract_id`),

    UNIQUE INDEX cui_start_date (start_date),
    UNIQUE INDEX cui_end_date   (end_date)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `INSURANCE_CONTRACT`
  ADD CONSTRAINT fk_customer_id FOREIGN KEY (customer_id) REFERENCES `CUSTOMER` (customer_id);
  
ALTER TABLE `INSURANCE_CONTRACT`
  ADD CONSTRAINT fk_insurance_plan_id FOREIGN KEY (insurance_plan_id) REFERENCES `INSURANCE_PLAN` (insurance_plan_id);