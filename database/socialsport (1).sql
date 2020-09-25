-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tbl_activity`;
CREATE TABLE `tbl_activity` (
  `activity_id` int(10) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(100) NOT NULL COMMENT 'Ex-Login,Logout',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `admin_id` int(3) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_username` varchar(50) DEFAULT NULL,
  `admin_password` varchar(50) DEFAULT NULL,
  `admin_role` tinyint(4) DEFAULT NULL COMMENT '''1->''SuperAdmin'',''2->Admin'',''3->Accountant'',''4->Content manager''',
  `admin_status` enum('Enable','Disable') NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `upadted_on` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_username`, `admin_password`, `admin_role`, `admin_status`, `created_on`, `upadted_on`) VALUES
(1,	'Anil',	'anil.dubey@vibescom.in',	'anil',	'123',	NULL,	'Enable',	'2019-07-03 00:00:00',	'2019-07-03 00:00:00');

DROP TABLE IF EXISTS `tbl_admin_role_access`;
CREATE TABLE `tbl_admin_role_access` (
  `role_access_id` int(3) NOT NULL AUTO_INCREMENT,
  `role_access_for` varchar(100) NOT NULL COMMENT 'Ex. admin_user_mgtm,end_uder_mgtm,sport_mgmt etc',
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`role_access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_admin_user_role`;
CREATE TABLE `tbl_admin_user_role` (
  `user_role_id` int(3) NOT NULL,
  `role_access_id` int(3) NOT NULL,
  `admin_id` int(3) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  KEY `role_access_id` (`role_access_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `tbl_admin_user_role_ibfk_1` FOREIGN KEY (`role_access_id`) REFERENCES `tbl_admin_role_access` (`role_access_id`),
  CONSTRAINT `tbl_admin_user_role_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_advertisement`;
CREATE TABLE `tbl_advertisement` (
  `advertisement_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertisement_name` varchar(100) NOT NULL,
  `advertisement_type` enum('Event','Facility') NOT NULL,
  `advertisement_start_date` datetime NOT NULL,
  `advertisement_end_date` datetime NOT NULL,
  `advertisement_banner` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `is_featured` enum('Yes','No') NOT NULL,
  `exm_price` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`advertisement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_amenity`;
CREATE TABLE `tbl_amenity` (
  `amenity_id` int(3) NOT NULL AUTO_INCREMENT,
  `amenity_name` varchar(100) NOT NULL,
  `amenity_description` text NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`amenity_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `tbl_amenity_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  CONSTRAINT `tbl_amenity_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_batch_slot_type`;
CREATE TABLE `tbl_batch_slot_type` (
  `batch_slot_type_id` int(3) NOT NULL AUTO_INCREMENT,
  `batch_slot_type` varchar(100) DEFAULT NULL COMMENT 'Ex. premium,normal ,discounted',
  `batch_status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`batch_slot_type_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `tbl_batch_slot_type_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  CONSTRAINT `tbl_batch_slot_type_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_booking_event_detail`;
CREATE TABLE `tbl_booking_event_detail` (
  `booking_detail_id` int(11) NOT NULL,
  `booking_order_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `booking_detail_total_amount` varchar(10) NOT NULL,
  `booking_detail_discount` varchar(10) DEFAULT NULL,
  `booking_detail_final_amount` varchar(10) NOT NULL,
  `booking_detail_status` enum('pending','confiirm','cancel') DEFAULT NULL,
  `facility_approval` enum('enable','disable','void') DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  KEY `booking_id` (`booking_order_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `tbl_booking_event_detail_ibfk_1` FOREIGN KEY (`booking_order_id`) REFERENCES `tbl_booking_order` (`booking_order_id`),
  CONSTRAINT `tbl_booking_event_detail_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_booking_log`;
CREATE TABLE `tbl_booking_log` (
  `booking_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `order_log_activity_id` int(3) NOT NULL,
  `updated_by_type` enum('user','facility','admin') NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`booking_log_id`),
  KEY `booking_id` (`booking_id`),
  KEY `order_log_activity_id` (`order_log_activity_id`),
  CONSTRAINT `tbl_booking_log_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `tbl_booking_order` (`booking_order_id`),
  CONSTRAINT `tbl_booking_log_ibfk_2` FOREIGN KEY (`order_log_activity_id`) REFERENCES `tbl_booking_log_activity` (`order_log_activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_booking_log_activity`;
CREATE TABLE `tbl_booking_log_activity` (
  `order_log_activity_id` int(3) NOT NULL AUTO_INCREMENT,
  `order_log_activity_name` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`order_log_activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_booking_order`;
CREATE TABLE `tbl_booking_order` (
  `booking_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `country_id` int(2) NOT NULL,
  `state_id` int(2) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `total_amount` varchar(10) NOT NULL,
  `taxes` varchar(10) DEFAULT NULL,
  `coupon_code` varchar(20) DEFAULT NULL,
  `discount_amount` varchar(10) DEFAULT NULL,
  `final_amount` varchar(10) NOT NULL,
  `payment_status` enum('pending','success','fail') DEFAULT NULL,
  `pay_transction_id` varchar(50) DEFAULT NULL,
  `pay_transction_other` varchar(200) DEFAULT NULL,
  `booking_status` enum('pending','confirm','cancle') DEFAULT NULL,
  `boking_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by_type` enum('admin','user') DEFAULT NULL,
  PRIMARY KEY (`booking_order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_booking_slot_detail`;
CREATE TABLE `tbl_booking_slot_detail` (
  `booking_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_order_id` int(11) NOT NULL,
  `is_trial` enum('yes','no') NOT NULL DEFAULT 'no',
  `batch_slot_id` int(11) NOT NULL,
  `booking_detail_total_amount` varchar(10) NOT NULL,
  `booking_detail_discount` varchar(10) DEFAULT NULL,
  `booking_detail_final_amount` varchar(10) NOT NULL,
  `booking_detail_status` enum('pending','confiirm','cancel') DEFAULT NULL,
  `facility_approval` enum('enable','disable','void') DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`booking_detail_id`),
  KEY `booking_id` (`booking_order_id`),
  KEY `batch_slot_id` (`batch_slot_id`),
  CONSTRAINT `tbl_booking_slot_detail_ibfk_1` FOREIGN KEY (`booking_order_id`) REFERENCES `tbl_booking_order` (`booking_order_id`),
  CONSTRAINT `tbl_booking_slot_detail_ibfk_2` FOREIGN KEY (`batch_slot_id`) REFERENCES `tbl_facility_batch_slot` (`batch_slot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_email_suscriber`;
CREATE TABLE `tbl_email_suscriber` (
  `email_suscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_sent_by_type` enum('admin','facility') NOT NULL,
  `sent_to_user_id` int(10) NOT NULL,
  `sent_by_user_id` int(10) NOT NULL,
  `sent_by_admin_id` int(11) NOT NULL,
  `sent_on` datetime NOT NULL,
  PRIMARY KEY (`email_suscriber_id`),
  KEY `sent_to_user_id` (`sent_to_user_id`),
  CONSTRAINT `tbl_email_suscriber_ibfk_1` FOREIGN KEY (`sent_to_user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_email_template`;
CREATE TABLE `tbl_email_template` (
  `template_id` int(5) NOT NULL AUTO_INCREMENT,
  `template_title` varchar(100) DEFAULT NULL,
  `template_subject` varchar(100) DEFAULT NULL,
  `template_body` varchar(100) DEFAULT NULL,
  `template_status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`template_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `tbl_email_template_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  CONSTRAINT `tbl_email_template_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_event`;
CREATE TABLE `tbl_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_price` varchar(100) NOT NULL COMMENT 'per person / per day',
  `event_start_date` datetime NOT NULL,
  `event_end_date` datetime NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_max_capicity_per_day` int(5) NOT NULL COMMENT 'Per day',
  `event_banner` varchar(100) NOT NULL,
  `event_approval` enum('Approved','Disapproved','Void') NOT NULL COMMENT 'By Admin',
  `application_start_date` int(5) NOT NULL COMMENT 'booking can not be done before this date',
  `application_end_date` datetime NOT NULL COMMENT 'booking can not be done after this date',
  `event_eligibility` text NOT NULL,
  `event_status` enum('Enabel','Disable') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `fac_id` (`fac_id`),
  CONSTRAINT `tbl_event_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_event_gallery`;
CREATE TABLE `tbl_event_gallery` (
  `event_gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `image_caption` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `event_image_category` varchar(50) NOT NULL,
  `gallery_status` enum('enabel','disable') DEFAULT 'enabel',
  `admin_approval` enum('enable','disable','void') DEFAULT NULL,
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  PRIMARY KEY (`event_gallery_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `tbl_event_gallery_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_event_price`;
CREATE TABLE `tbl_event_price` (
  `event_price_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `event_caption` varchar(100) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL COMMENT 'different date may have different price',
  `per_person_price` varchar(10) DEFAULT NULL,
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  PRIMARY KEY (`event_price_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `tbl_event_price_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_event_sport`;
CREATE TABLE `tbl_event_sport` (
  `event_sport_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `fac_sport_id` int(11) NOT NULL,
  `create_on` datetime DEFAULT NULL,
  PRIMARY KEY (`event_sport_id`),
  KEY `event_id` (`event_id`),
  KEY `fac_sport_id` (`fac_sport_id`),
  CONSTRAINT `tbl_event_sport_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`),
  CONSTRAINT `tbl_event_sport_ibfk_2` FOREIGN KEY (`fac_sport_id`) REFERENCES `tbl_facility_sport` (`fac_sport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_facility`;
CREATE TABLE `tbl_facility` (
  `fac_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `fac_name` varchar(255) NOT NULL,
  `fac_type` enum('academy','facility') DEFAULT NULL,
  `fac_opening_time` time NOT NULL,
  `fac_closing_time` time NOT NULL,
  `fac_description` text NOT NULL,
  `fac_short_description` text NOT NULL,
  `fac_logo_image` varchar(100) NOT NULL,
  `fac_banner_image` varchar(100) NOT NULL,
  `fac_address` varchar(255) NOT NULL,
  `fac_city` varchar(50) NOT NULL,
  `fac_state` varchar(50) NOT NULL,
  `fac_country` varchar(50) NOT NULL,
  `fac_pincode` int(10) NOT NULL,
  `fac_google_address` varchar(255) NOT NULL,
  `fac_latitude` varchar(20) NOT NULL,
  `fac_longitude` varchar(20) NOT NULL,
  `fac_status` enum('Enable','Disable') NOT NULL,
  `admin_approval` enum('Approved','Disapproved','Void') NOT NULL,
  `admin_approval_comment` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_type` enum('admin','user') NOT NULL,
  `updated_by_type` enum('admin','user') DEFAULT NULL,
  PRIMARY KEY (`fac_id`),
  KEY `tbl_fac_ibfk_1` (`user_id`),
  CONSTRAINT `tbl_facility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_facility_amenities`;
CREATE TABLE `tbl_facility_amenities` (
  `fac_aminities_id` int(11) NOT NULL AUTO_INCREMENT,
  `aminity_id` int(3) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `fac_aminities_quantity` int(11) NOT NULL,
  `fac_aminities_desc` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`fac_aminities_id`),
  KEY `aminity_id` (`aminity_id`),
  KEY `fac_id` (`fac_id`),
  CONSTRAINT `tbl_facility_amenities_ibfk_1` FOREIGN KEY (`aminity_id`) REFERENCES `tbl_amenity` (`amenity_id`),
  CONSTRAINT `tbl_facility_amenities_ibfk_2` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_facility_batch_slot`;
CREATE TABLE `tbl_facility_batch_slot` (
  `batch_slot_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_id` int(11) NOT NULL,
  `fac_sport_id` int(11) NOT NULL,
  `batch_slot_type_id` int(3) NOT NULL,
  `package_id` int(3) NOT NULL,
  `allow_trial_per_days` int(2) DEFAULT '0' COMMENT '0->no trial ,>0 means only this much trial booking is allowed',
  `day_start_time` time DEFAULT NULL,
  `day_end_time` time DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `week_off_days` varchar(100) DEFAULT NULL,
  `actual_price` varchar(10) DEFAULT NULL COMMENT 'if actual<base, it is discounted batch',
  `fac_batch_slot_status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  PRIMARY KEY (`batch_slot_id`),
  KEY `fac_id` (`fac_id`),
  KEY `fac_sport_id` (`fac_sport_id`),
  KEY `batch_slot_type_id` (`batch_slot_type_id`),
  KEY `package_id` (`package_id`),
  CONSTRAINT `tbl_facility_batch_slot_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`),
  CONSTRAINT `tbl_facility_batch_slot_ibfk_2` FOREIGN KEY (`fac_sport_id`) REFERENCES `tbl_facility_sport` (`fac_sport_id`),
  CONSTRAINT `tbl_facility_batch_slot_ibfk_3` FOREIGN KEY (`batch_slot_type_id`) REFERENCES `tbl_batch_slot_type` (`batch_slot_type_id`),
  CONSTRAINT `tbl_facility_batch_slot_ibfk_4` FOREIGN KEY (`package_id`) REFERENCES `tbl_package` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_facility_gallery`;
CREATE TABLE `tbl_facility_gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_id` int(11) NOT NULL,
  `gallery_category_type` varchar(50) NOT NULL COMMENT 'Ex. Event gallery, Facility Gallery, Stadium gallery',
  `image_caption` varchar(100) NOT NULL,
  `gallery_image` varchar(100) NOT NULL,
  `gallery_status` enum('Active','Deactive') NOT NULL,
  `admin_approval` enum('Enable','Disable','Void') NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`gallery_id`),
  KEY `fac_id` (`fac_id`),
  CONSTRAINT `tbl_facility_gallery_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_facility_reward_achievement`;
CREATE TABLE `tbl_facility_reward_achievement` (
  `reward_achievement_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `type` varchar(100) NOT NULL COMMENT 'Ex. certificate, award,achievement',
  `image1` varchar(100) DEFAULT NULL,
  `image2` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`reward_achievement_id`),
  KEY `fac_id` (`fac_id`),
  CONSTRAINT `tbl_facility_reward_achievement_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_facility_sport`;
CREATE TABLE `tbl_facility_sport` (
  `fac_sport_id` int(11) NOT NULL AUTO_INCREMENT,
  `sport_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `sport_court` int(11) NOT NULL,
  `sport_indor` int(11) NOT NULL,
  `indor_kit_available` enum('yes','no') NOT NULL,
  `indor_kit_price` varchar(10) NOT NULL,
  `sport_outdor` int(11) NOT NULL,
  `outdor_kit_available` enum('yes','no') NOT NULL,
  `outdor_kit_price` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`fac_sport_id`),
  KEY `fac_id` (`fac_id`),
  KEY `sport_id` (`sport_id`),
  CONSTRAINT `tbl_facility_sport_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`),
  CONSTRAINT `tbl_facility_sport_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `tbl_sport_list` (`sport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_newsletter`;
CREATE TABLE `tbl_newsletter` (
  `newsletter_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`newsletter_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_newsletter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_package`;
CREATE TABLE `tbl_package` (
  `package_id` int(3) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(100) DEFAULT NULL,
  `package_duration` varchar(100) DEFAULT NULL,
  `package_status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`package_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `tbl_package_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  CONSTRAINT `tbl_package_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_rating`;
CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `rating_type` tinyint(4) NOT NULL COMMENT '''1->facility'',''2->event''',
  `rating` int(11) NOT NULL COMMENT 'max-5',
  `fac_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `admin_approval` enum('Approved','Disapproved','Void') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `user_id` (`user_id`),
  KEY `fac_id` (`fac_id`),
  CONSTRAINT `tbl_rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_rating_ibfk_2` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_review`;
CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating_id` int(11) NOT NULL,
  `review_message` text NOT NULL,
  PRIMARY KEY (`review_id`),
  CONSTRAINT `tbl_review_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `tbl_rating` (`rating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_slot_package_price`;
CREATE TABLE `tbl_slot_package_price` (
  `slot_package_price_id` int(11) NOT NULL,
  `batch_slot_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `slot_package_price` varchar(10) NOT NULL,
  KEY `batch_slot_id` (`batch_slot_id`),
  KEY `package_id` (`package_id`),
  CONSTRAINT `tbl_slot_package_price_ibfk_1` FOREIGN KEY (`batch_slot_id`) REFERENCES `tbl_facility_batch_slot` (`batch_slot_id`),
  CONSTRAINT `tbl_slot_package_price_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `tbl_package` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_sport_list`;
CREATE TABLE `tbl_sport_list` (
  `sport_id` int(5) NOT NULL AUTO_INCREMENT,
  `sport_name` varchar(100) NOT NULL,
  `sport_icon` varchar(100) DEFAULT NULL,
  `sport_image` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `sport_status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`sport_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `tbl_sport_list_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  CONSTRAINT `tbl_sport_list_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_static_page`;
CREATE TABLE `tbl_static_page` (
  `static_page_id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `short_description` text,
  `long_description` text,
  `meta` text,
  `image_name` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `page_type` enum('about_us','privacy_policy','terms_conditions','disclaimer','contact_us') DEFAULT NULL,
  `status` enum('Active','Inactive','Delete') DEFAULT 'Active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`static_page_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `tbl_static_page_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  CONSTRAINT `tbl_static_page_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `is_email_verified` enum('Yes','No','','') DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_gender` enum('M','F','T') DEFAULT NULL,
  `user_mobile_no` varchar(50) DEFAULT NULL,
  `is_mobile_verified` enum('Yes','No','','') DEFAULT NULL,
  `user_city` varchar(50) DEFAULT NULL,
  `user_address` text,
  `user_pincode` int(10) DEFAULT NULL,
  `user_country` varchar(20) NOT NULL,
  `user_role` tinyint(4) DEFAULT NULL COMMENT '''1->EndUser'',''2->Academy/Facility'',',
  `user_login_type` tinyint(4) DEFAULT NULL COMMENT '''1->''Website'',''2->FB'',''3->Google''',
  `user_oauth_id` varchar(100) DEFAULT NULL,
  `user_profile_image` varchar(100) DEFAULT NULL,
  `user_status` enum('Enable','Disable','','') DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_mobile_no` (`user_mobile_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_user_activity_log`;
CREATE TABLE `tbl_user_activity_log` (
  `history_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `activity_id` int(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `activity_time` datetime NOT NULL,
  PRIMARY KEY (`history_id`),
  KEY `activity_id` (`activity_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_user_forgot_password`;
CREATE TABLE `tbl_user_forgot_password` (
  `forgot_password_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `password_code` varchar(20) NOT NULL,
  `expire_on` datetime NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by_user` datetime DEFAULT NULL,
  PRIMARY KEY (`forgot_password_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_user_password_log`;
CREATE TABLE `tbl_user_password_log` (
  `password_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`password_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_user_query`;
CREATE TABLE `tbl_user_query` (
  `query_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `query_title` varchar(100) DEFAULT NULL,
  `query_message` varchar(255) DEFAULT NULL,
  `query_status` enum('active','inactive') DEFAULT 'active',
  `approve_status` enum('approved','disapproved','void') DEFAULT 'void',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`query_id`),
  KEY `user_id` (`user_id`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `tbl_user_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_user_query_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_user_sport_interest`;
CREATE TABLE `tbl_user_sport_interest` (
  `interest_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `sport_id` int(5) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`interest_id`),
  KEY `user_id` (`user_id`),
  KEY `sport_id` (`sport_id`),
  CONSTRAINT `tbl_user_sport_interest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_user_sport_interest_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `tbl_sport_list` (`sport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_user_verification`;
CREATE TABLE `tbl_user_verification` (
  `verification_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `verification_type` enum('Email','Mobile') NOT NULL,
  `verification_code` varchar(20) NOT NULL,
  `status` enum('Verified','Unverified') NOT NULL,
  `expire_on` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by_user` datetime NOT NULL,
  PRIMARY KEY (`verification_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2019-07-05 04:27:00
