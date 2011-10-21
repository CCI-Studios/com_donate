CREATE TABLE IF NOT EXISTS `#__donate_memberships` (
	`donation_membership_id` SERIAL,
	
	`first_name` VARCHAR(250) NOT NULL,
	`last_name` VARCHAR(250) NOT NULL,
	`occupation` VARCHAR(250) NOT NULL,
	`phone` VARCHAR(20) NOT NULL,
	`email` VARCHAR(250) NOT NULL,
	
	`address1` VARCHAR(250) NOT NULL,
	`address2` VARCHAR(250) NOT NULL,
	`city` VARCHAR(250) NOT NULL,
	`province` VARCHAR(250) NOT NULL,
	`postal` VARCHAR(10) NOT NULL,
	
	`amount` VARCHAR(250) NOT NULL,
	`donation` VARCHAR(250) NOT NULL,
	`renew` TINYINT(1) NOT NULL,
	`volunteer` TINYINT(1) NOT NULL,
	`gift` TINYINT(1) NOT NULL DEFAULT '0',
	`type` TINYINT(1) NOT NULL DEFAULT '1',
	`newsletter_format` VARCHAR(10) NOT NULL,
	`recognized` TINYINT(1) NOT NULL DEFAULT '1',
	
	`confirmation` VARCHAR(250) NOT NULL,
	`status` TINYINT(1) NOT NULL DEFAULT '0'
);

CREATE TABLE IF NOT EXISTS `#__donate_donations` (
	`donation_donation_id` SERIAL,
	
	`first_name` VARCHAR(250) NOT NULL,
	`last_name` VARCHAR(250) NOT NULL,
	`occupation` VARCHAR(250) NOT NULL,
	`phone` VARCHAR(20) NOT NULL,
	`email` VARCHAR(250) NOT NULL,
	
	`address1` VARCHAR(250) NOT NULL,
	`address2` VARCHAR(250) NOT NULL,
	`city` VARCHAR(250) NOT NULL,
	`province` VARCHAR(250) NOT NULL,
	`postal` VARCHAR(10) NOT NULL,
	
	`donation` VARCHAR(250) NOT NULL,
	`volunteer` TINYINT(1) NOT NULL,
	`gift` TINYINT(1) NOT NULL DEFAULT '0',
	`newsletter_format` VARCHAR(10) NOT NULL,
	
	`confirmation` VARCHAR(250) NOT NULL,
	`status` TINYINT(1) NOT NULL DEFAULT '0'
);