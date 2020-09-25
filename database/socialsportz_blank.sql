-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2019 at 06:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialsportz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `activity_id` int(10) NOT NULL,
  `activity_name` varchar(100) NOT NULL COMMENT 'Ex-Login,Logout',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(3) NOT NULL,
  `admin_name` varchar(100) DEFAULT NULL,
  `admin_username` varchar(50) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_password` varchar(50) DEFAULT NULL,
  `admin_role` tinyint(4) DEFAULT NULL COMMENT '''1->''SuperAdmin'',''2->Admin'',''3->Accountant'',''4->Content manager''',
  `admin_status` enum('Enable','Disable','','') NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `upadted_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertisement`
--

CREATE TABLE `tbl_advertisement` (
  `advertisement_id` int(11) NOT NULL,
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
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_amenity`
--

CREATE TABLE `tbl_amenity` (
  `amenity_id` int(3) NOT NULL,
  `amenity_name` varchar(100) NOT NULL,
  `amenity_description` text NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_slot_type`
--

CREATE TABLE `tbl_batch_slot_type` (
  `batch_slot_type_id` int(3) NOT NULL,
  `batch_slot_type` varchar(100) DEFAULT NULL COMMENT 'Ex. premium,normal ,discounted',
  `batch_status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_event_detail`
--

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
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_log`
--

CREATE TABLE `tbl_booking_log` (
  `booking_log_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `order_log_activity_id` int(3) NOT NULL,
  `updated_by_type` enum('user','facility','admin') NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_log_activity`
--

CREATE TABLE `tbl_booking_log_activity` (
  `order_log_activity_id` int(3) NOT NULL,
  `order_log_activity_name` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_order`
--

CREATE TABLE `tbl_booking_order` (
  `booking_order_id` int(11) NOT NULL,
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
  `updated_by_type` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_slot_detail`
--

CREATE TABLE `tbl_booking_slot_detail` (
  `booking_detail_id` int(11) NOT NULL,
  `booking_order_id` int(11) NOT NULL,
  `is_trial` enum('yes','no') NOT NULL DEFAULT 'no',
  `batch_slot_id` int(11) NOT NULL,
  `booking_detail_total_amount` varchar(10) NOT NULL,
  `booking_detail_discount` varchar(10) DEFAULT NULL,
  `booking_detail_final_amount` varchar(10) NOT NULL,
  `booking_detail_status` enum('pending','confiirm','cancel') DEFAULT NULL,
  `facility_approval` enum('enable','disable','void') DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_suscriber`
--

CREATE TABLE `tbl_email_suscriber` (
  `email_suscriber_id` int(11) NOT NULL,
  `email_sent_by_type` enum('admin','facility') NOT NULL,
  `sent_to_user_id` int(10) NOT NULL,
  `sent_by_user_id` int(10) NOT NULL,
  `sent_by_admin_id` int(11) NOT NULL,
  `sent_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_template`
--

CREATE TABLE `tbl_email_template` (
  `template_id` int(5) NOT NULL,
  `template_title` varchar(100) DEFAULT NULL,
  `template_subject` varchar(100) DEFAULT NULL,
  `template_body` varchar(100) DEFAULT NULL,
  `template_status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `event_id` int(11) NOT NULL,
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
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_gallery`
--

CREATE TABLE `tbl_event_gallery` (
  `event_gallery_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `image_caption` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `event_image_category` varchar(50) NOT NULL,
  `gallery_status` enum('enabel','disable') DEFAULT 'enabel',
  `admin_approval` enum('enable','disable','void') DEFAULT NULL,
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_price`
--

CREATE TABLE `tbl_event_price` (
  `event_price_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_caption` varchar(100) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL COMMENT 'different date may have different price',
  `per_person_price` varchar(10) DEFAULT NULL,
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_sport`
--

CREATE TABLE `tbl_event_sport` (
  `event_sport_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `fac_sport_id` int(11) NOT NULL,
  `create_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility`
--

CREATE TABLE `tbl_facility` (
  `fac_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `fac_name` varchar(255) NOT NULL,
  `fac_type` enum('academy','facility') DEFAULT NULL,
  `fac_opening_time` time NOT NULL,
  `fac_closing_time` time NOT NULL,
  `fac_description` text NOT NULL,
  `fac_short_description` text NOT NULL,
  `fac_city` varchar(50) NOT NULL,
  `fac_state` varchar(50) NOT NULL,
  `fac_country` varchar(50) NOT NULL,
  `fac_address` varchar(255) NOT NULL,
  `fac_google_address` varchar(255) NOT NULL,
  `fac_pincode` int(10) NOT NULL,
  `fac_latitude` varchar(20) NOT NULL,
  `fac_longitude` varchar(20) NOT NULL,
  `fac_banner_image` varchar(100) NOT NULL,
  `fac_logo_image` varchar(100) NOT NULL,
  `fac_status` enum('Enable','Disable') NOT NULL,
  `admin_approval` enum('Approved','Disapproved','Void') NOT NULL,
  `admin_approval_comment` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by_type` enum('admin','user') NOT NULL,
  `updated_by_type` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_amenities`
--

CREATE TABLE `tbl_facility_amenities` (
  `fac_aminities_id` int(11) NOT NULL,
  `aminity_id` int(3) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `fac_aminities_quantity` int(11) NOT NULL,
  `fac_aminities_desc` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_batch_slot`
--

CREATE TABLE `tbl_facility_batch_slot` (
  `batch_slot_id` int(11) NOT NULL,
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
  `update_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_gallery`
--

CREATE TABLE `tbl_facility_gallery` (
  `gallery_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `gallery_category_type` varchar(50) NOT NULL COMMENT 'Ex. Event gallery, Facility Gallery, Stadium gallery',
  `image_caption` varchar(100) NOT NULL,
  `gallery_image` varchar(100) NOT NULL,
  `gallery_status` enum('Active','Deactive') NOT NULL,
  `admin_approval` enum('Enable','Disable','Void') NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_reward_achievement`
--

CREATE TABLE `tbl_facility_reward_achievement` (
  `reward_achievement_id` int(11) NOT NULL,
  `fac_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `type` varchar(100) NOT NULL COMMENT 'Ex. certificate, award,achievement',
  `image1` varchar(100) DEFAULT NULL,
  `image2` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_sport`
--

CREATE TABLE `tbl_facility_sport` (
  `fac_sport_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `sport_court` int(11) NOT NULL,
  `sport_indor` int(11) NOT NULL,
  `sport_outdor` int(11) NOT NULL,
  `indor_kit_available` enum('yes','no') NOT NULL,
  `indor_kit_price` varchar(10) NOT NULL,
  `outdor_kit_available` enum('yes','no') NOT NULL,
  `outdor_kit_price` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE `tbl_newsletter` (
  `newsletter_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `package_id` int(3) NOT NULL,
  `package_name` varchar(100) DEFAULT NULL,
  `package_duration` varchar(100) DEFAULT NULL,
  `package_status` enum('active','inactive') DEFAULT 'active',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `rating_type` tinyint(4) NOT NULL COMMENT '''1->facility'',''2->event''',
  `rating` int(11) NOT NULL COMMENT 'max-5',
  `fac_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `admin_approval` enum('Approved','Disapproved','Void') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `rating_id` int(11) NOT NULL,
  `review_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slot_package_price`
--

CREATE TABLE `tbl_slot_package_price` (
  `slot_package_price_id` int(11) NOT NULL,
  `batch_slot_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `slot_package_price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sport_list`
--

CREATE TABLE `tbl_sport_list` (
  `sport_id` int(5) NOT NULL,
  `sport_name` varchar(100) NOT NULL,
  `sport_icon` varchar(100) DEFAULT NULL,
  `sport_image` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `sport_status` enum('Enable','Disable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_static_page`
--

CREATE TABLE `tbl_static_page` (
  `static_page_id` int(3) NOT NULL,
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
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) NOT NULL,
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
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_activity_log`
--

CREATE TABLE `tbl_user_activity_log` (
  `history_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `activity_id` int(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `activity_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_forgot_password`
--

CREATE TABLE `tbl_user_forgot_password` (
  `forgot_password_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `password_code` varchar(20) NOT NULL,
  `expire_on` datetime NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by_user` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_password_log`
--

CREATE TABLE `tbl_user_password_log` (
  `password_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_query`
--

CREATE TABLE `tbl_user_query` (
  `query_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `query_title` varchar(100) DEFAULT NULL,
  `query_message` varchar(255) DEFAULT NULL,
  `query_status` enum('active','inactive') DEFAULT 'active',
  `approve_status` enum('approved','disapproved','void') DEFAULT 'void',
  `create_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_sport_interest`
--

CREATE TABLE `tbl_user_sport_interest` (
  `interest_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `sport_id` int(5) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_verification`
--

CREATE TABLE `tbl_user_verification` (
  `verification_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `verification_type` enum('Email','Mobile') NOT NULL,
  `verification_code` varchar(20) NOT NULL,
  `status` enum('Verified','Unverified') NOT NULL,
  `expire_on` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by_user` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_advertisement`
--
ALTER TABLE `tbl_advertisement`
  ADD PRIMARY KEY (`advertisement_id`);

--
-- Indexes for table `tbl_amenity`
--
ALTER TABLE `tbl_amenity`
  ADD PRIMARY KEY (`amenity_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_batch_slot_type`
--
ALTER TABLE `tbl_batch_slot_type`
  ADD PRIMARY KEY (`batch_slot_type_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_booking_event_detail`
--
ALTER TABLE `tbl_booking_event_detail`
  ADD KEY `booking_id` (`booking_order_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `tbl_booking_log`
--
ALTER TABLE `tbl_booking_log`
  ADD PRIMARY KEY (`booking_log_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `order_log_activity_id` (`order_log_activity_id`);

--
-- Indexes for table `tbl_booking_log_activity`
--
ALTER TABLE `tbl_booking_log_activity`
  ADD PRIMARY KEY (`order_log_activity_id`);

--
-- Indexes for table `tbl_booking_order`
--
ALTER TABLE `tbl_booking_order`
  ADD PRIMARY KEY (`booking_order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_booking_slot_detail`
--
ALTER TABLE `tbl_booking_slot_detail`
  ADD PRIMARY KEY (`booking_detail_id`),
  ADD KEY `booking_id` (`booking_order_id`),
  ADD KEY `batch_slot_id` (`batch_slot_id`);

--
-- Indexes for table `tbl_email_suscriber`
--
ALTER TABLE `tbl_email_suscriber`
  ADD PRIMARY KEY (`email_suscriber_id`),
  ADD KEY `sent_to_user_id` (`sent_to_user_id`);

--
-- Indexes for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  ADD PRIMARY KEY (`template_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `fac_id` (`fac_id`);

--
-- Indexes for table `tbl_event_gallery`
--
ALTER TABLE `tbl_event_gallery`
  ADD PRIMARY KEY (`event_gallery_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `tbl_event_price`
--
ALTER TABLE `tbl_event_price`
  ADD PRIMARY KEY (`event_price_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `tbl_event_sport`
--
ALTER TABLE `tbl_event_sport`
  ADD PRIMARY KEY (`event_sport_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `fac_sport_id` (`fac_sport_id`);

--
-- Indexes for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  ADD PRIMARY KEY (`fac_id`),
  ADD KEY `tbl_fac_ibfk_1` (`user_id`);

--
-- Indexes for table `tbl_facility_amenities`
--
ALTER TABLE `tbl_facility_amenities`
  ADD PRIMARY KEY (`fac_aminities_id`),
  ADD KEY `aminity_id` (`aminity_id`),
  ADD KEY `fac_id` (`fac_id`);

--
-- Indexes for table `tbl_facility_batch_slot`
--
ALTER TABLE `tbl_facility_batch_slot`
  ADD PRIMARY KEY (`batch_slot_id`),
  ADD KEY `fac_id` (`fac_id`),
  ADD KEY `fac_sport_id` (`fac_sport_id`),
  ADD KEY `batch_slot_type_id` (`batch_slot_type_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `tbl_facility_gallery`
--
ALTER TABLE `tbl_facility_gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `fac_id` (`fac_id`);

--
-- Indexes for table `tbl_facility_reward_achievement`
--
ALTER TABLE `tbl_facility_reward_achievement`
  ADD PRIMARY KEY (`reward_achievement_id`),
  ADD KEY `fac_id` (`fac_id`);

--
-- Indexes for table `tbl_facility_sport`
--
ALTER TABLE `tbl_facility_sport`
  ADD PRIMARY KEY (`fac_sport_id`),
  ADD KEY `fac_id` (`fac_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD PRIMARY KEY (`newsletter_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fac_id` (`fac_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_slot_package_price`
--
ALTER TABLE `tbl_slot_package_price`
  ADD KEY `batch_slot_id` (`batch_slot_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `tbl_sport_list`
--
ALTER TABLE `tbl_sport_list`
  ADD PRIMARY KEY (`sport_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_static_page`
--
ALTER TABLE `tbl_static_page`
  ADD PRIMARY KEY (`static_page_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_mobile_no` (`user_mobile_no`);

--
-- Indexes for table `tbl_user_activity_log`
--
ALTER TABLE `tbl_user_activity_log`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user_forgot_password`
--
ALTER TABLE `tbl_user_forgot_password`
  ADD PRIMARY KEY (`forgot_password_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user_password_log`
--
ALTER TABLE `tbl_user_password_log`
  ADD PRIMARY KEY (`password_id`);

--
-- Indexes for table `tbl_user_query`
--
ALTER TABLE `tbl_user_query`
  ADD PRIMARY KEY (`query_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_user_sport_interest`
--
ALTER TABLE `tbl_user_sport_interest`
  ADD PRIMARY KEY (`interest_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `tbl_user_verification`
--
ALTER TABLE `tbl_user_verification`
  ADD PRIMARY KEY (`verification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `activity_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_advertisement`
--
ALTER TABLE `tbl_advertisement`
  MODIFY `advertisement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_amenity`
--
ALTER TABLE `tbl_amenity`
  MODIFY `amenity_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_batch_slot_type`
--
ALTER TABLE `tbl_batch_slot_type`
  MODIFY `batch_slot_type_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking_log`
--
ALTER TABLE `tbl_booking_log`
  MODIFY `booking_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking_log_activity`
--
ALTER TABLE `tbl_booking_log_activity`
  MODIFY `order_log_activity_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking_order`
--
ALTER TABLE `tbl_booking_order`
  MODIFY `booking_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking_slot_detail`
--
ALTER TABLE `tbl_booking_slot_detail`
  MODIFY `booking_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_email_suscriber`
--
ALTER TABLE `tbl_email_suscriber`
  MODIFY `email_suscriber_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  MODIFY `template_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_event_gallery`
--
ALTER TABLE `tbl_event_gallery`
  MODIFY `event_gallery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_event_price`
--
ALTER TABLE `tbl_event_price`
  MODIFY `event_price_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_event_sport`
--
ALTER TABLE `tbl_event_sport`
  MODIFY `event_sport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_facility_amenities`
--
ALTER TABLE `tbl_facility_amenities`
  MODIFY `fac_aminities_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_facility_batch_slot`
--
ALTER TABLE `tbl_facility_batch_slot`
  MODIFY `batch_slot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_facility_gallery`
--
ALTER TABLE `tbl_facility_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_facility_reward_achievement`
--
ALTER TABLE `tbl_facility_reward_achievement`
  MODIFY `reward_achievement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_facility_sport`
--
ALTER TABLE `tbl_facility_sport`
  MODIFY `fac_sport_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  MODIFY `newsletter_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `package_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sport_list`
--
ALTER TABLE `tbl_sport_list`
  MODIFY `sport_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_static_page`
--
ALTER TABLE `tbl_static_page`
  MODIFY `static_page_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_activity_log`
--
ALTER TABLE `tbl_user_activity_log`
  MODIFY `history_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_forgot_password`
--
ALTER TABLE `tbl_user_forgot_password`
  MODIFY `forgot_password_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_password_log`
--
ALTER TABLE `tbl_user_password_log`
  MODIFY `password_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_query`
--
ALTER TABLE `tbl_user_query`
  MODIFY `query_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_sport_interest`
--
ALTER TABLE `tbl_user_sport_interest`
  MODIFY `interest_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_verification`
--
ALTER TABLE `tbl_user_verification`
  MODIFY `verification_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_amenity`
--
ALTER TABLE `tbl_amenity`
  ADD CONSTRAINT `tbl_amenity_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  ADD CONSTRAINT `tbl_amenity_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);

--
-- Constraints for table `tbl_batch_slot_type`
--
ALTER TABLE `tbl_batch_slot_type`
  ADD CONSTRAINT `tbl_batch_slot_type_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  ADD CONSTRAINT `tbl_batch_slot_type_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);

--
-- Constraints for table `tbl_booking_event_detail`
--
ALTER TABLE `tbl_booking_event_detail`
  ADD CONSTRAINT `tbl_booking_event_detail_ibfk_1` FOREIGN KEY (`booking_order_id`) REFERENCES `tbl_booking_order` (`booking_order_id`),
  ADD CONSTRAINT `tbl_booking_event_detail_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`);

--
-- Constraints for table `tbl_booking_log`
--
ALTER TABLE `tbl_booking_log`
  ADD CONSTRAINT `tbl_booking_log_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `tbl_booking_order` (`booking_order_id`),
  ADD CONSTRAINT `tbl_booking_log_ibfk_2` FOREIGN KEY (`order_log_activity_id`) REFERENCES `tbl_booking_log_activity` (`order_log_activity_id`);

--
-- Constraints for table `tbl_booking_order`
--
ALTER TABLE `tbl_booking_order`
  ADD CONSTRAINT `tbl_booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_booking_slot_detail`
--
ALTER TABLE `tbl_booking_slot_detail`
  ADD CONSTRAINT `tbl_booking_slot_detail_ibfk_1` FOREIGN KEY (`booking_order_id`) REFERENCES `tbl_booking_order` (`booking_order_id`),
  ADD CONSTRAINT `tbl_booking_slot_detail_ibfk_2` FOREIGN KEY (`batch_slot_id`) REFERENCES `tbl_facility_batch_slot` (`batch_slot_id`);

--
-- Constraints for table `tbl_email_suscriber`
--
ALTER TABLE `tbl_email_suscriber`
  ADD CONSTRAINT `tbl_email_suscriber_ibfk_1` FOREIGN KEY (`sent_to_user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  ADD CONSTRAINT `tbl_email_template_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  ADD CONSTRAINT `tbl_email_template_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);

--
-- Constraints for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD CONSTRAINT `tbl_event_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`);

--
-- Constraints for table `tbl_event_gallery`
--
ALTER TABLE `tbl_event_gallery`
  ADD CONSTRAINT `tbl_event_gallery_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`);

--
-- Constraints for table `tbl_event_price`
--
ALTER TABLE `tbl_event_price`
  ADD CONSTRAINT `tbl_event_price_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`);

--
-- Constraints for table `tbl_event_sport`
--
ALTER TABLE `tbl_event_sport`
  ADD CONSTRAINT `tbl_event_sport_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`),
  ADD CONSTRAINT `tbl_event_sport_ibfk_2` FOREIGN KEY (`fac_sport_id`) REFERENCES `tbl_facility_sport` (`fac_sport_id`);

--
-- Constraints for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  ADD CONSTRAINT `tbl_facility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_facility_amenities`
--
ALTER TABLE `tbl_facility_amenities`
  ADD CONSTRAINT `tbl_facility_amenities_ibfk_1` FOREIGN KEY (`aminity_id`) REFERENCES `tbl_amenity` (`amenity_id`),
  ADD CONSTRAINT `tbl_facility_amenities_ibfk_2` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`);

--
-- Constraints for table `tbl_facility_batch_slot`
--
ALTER TABLE `tbl_facility_batch_slot`
  ADD CONSTRAINT `tbl_facility_batch_slot_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`),
  ADD CONSTRAINT `tbl_facility_batch_slot_ibfk_2` FOREIGN KEY (`fac_sport_id`) REFERENCES `tbl_facility_sport` (`fac_sport_id`),
  ADD CONSTRAINT `tbl_facility_batch_slot_ibfk_3` FOREIGN KEY (`batch_slot_type_id`) REFERENCES `tbl_batch_slot_type` (`batch_slot_type_id`),
  ADD CONSTRAINT `tbl_facility_batch_slot_ibfk_4` FOREIGN KEY (`package_id`) REFERENCES `tbl_package` (`package_id`);

--
-- Constraints for table `tbl_facility_gallery`
--
ALTER TABLE `tbl_facility_gallery`
  ADD CONSTRAINT `tbl_facility_gallery_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`);

--
-- Constraints for table `tbl_facility_reward_achievement`
--
ALTER TABLE `tbl_facility_reward_achievement`
  ADD CONSTRAINT `tbl_facility_reward_achievement_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`);

--
-- Constraints for table `tbl_facility_sport`
--
ALTER TABLE `tbl_facility_sport`
  ADD CONSTRAINT `tbl_facility_sport_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`),
  ADD CONSTRAINT `tbl_facility_sport_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `tbl_sport_list` (`sport_id`);

--
-- Constraints for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD CONSTRAINT `tbl_newsletter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD CONSTRAINT `tbl_package_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  ADD CONSTRAINT `tbl_package_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);

--
-- Constraints for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD CONSTRAINT `tbl_rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_rating_ibfk_2` FOREIGN KEY (`fac_id`) REFERENCES `tbl_facility` (`fac_id`);

--
-- Constraints for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD CONSTRAINT `tbl_review_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `tbl_rating` (`rating_id`);

--
-- Constraints for table `tbl_slot_package_price`
--
ALTER TABLE `tbl_slot_package_price`
  ADD CONSTRAINT `tbl_slot_package_price_ibfk_1` FOREIGN KEY (`batch_slot_id`) REFERENCES `tbl_facility_batch_slot` (`batch_slot_id`),
  ADD CONSTRAINT `tbl_slot_package_price_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `tbl_package` (`package_id`);

--
-- Constraints for table `tbl_sport_list`
--
ALTER TABLE `tbl_sport_list`
  ADD CONSTRAINT `tbl_sport_list_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  ADD CONSTRAINT `tbl_sport_list_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);

--
-- Constraints for table `tbl_static_page`
--
ALTER TABLE `tbl_static_page`
  ADD CONSTRAINT `tbl_static_page_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admin` (`admin_id`),
  ADD CONSTRAINT `tbl_static_page_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);

--
-- Constraints for table `tbl_user_query`
--
ALTER TABLE `tbl_user_query`
  ADD CONSTRAINT `tbl_user_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_user_query_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_admin` (`admin_id`);

--
-- Constraints for table `tbl_user_sport_interest`
--
ALTER TABLE `tbl_user_sport_interest`
  ADD CONSTRAINT `tbl_user_sport_interest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_user_sport_interest_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `tbl_sport_list` (`sport_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
