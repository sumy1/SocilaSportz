package com.socialsportz.Constants;

public interface Constants {

	/*****************************Public Static Constant and Keys**********************************/

	String kDefaultAppName = "SocialSportz";
	String kIsFirstTime = "isFirstTime";
	String kApiVersion = "apiVersion";
	String kAppPreferences = "SocialSportzPreferences";
	//String kImageBaseUrl = "https://socialsportz.in/betav2/assets/public/images/";
	String kImageBaseUrl = "https://www.socialsportz.com/assets/public/images/";



	/**********************API RequestParameters And ResponseParameters****************************/


	//.....CCAvenue Payment

	int DAY_TIME_RESULT = 20;
	int EDIT_PROFILE_RESULT = 30;
	int EDIT_BANK_RESULT = 40;
	int EDIT_FACILITY_RESULT = 45;
	int EDIT_ACHIEVE_RESULT = 50;
	int ACHIEVEMENT_RESULT = 55;
	int EDIT_SPORT_RESULT = 60;
	int EDIT_AMENITY_RESULT = 70;
	int EDIT_OPEN_CLOSE_TIMING = 80;
	int EDIT_GAllERY_RESULT = 90;
	int BATCH_SLOT_RESULT = 95;
	int BATCH_SLOT_ARCHIVE=101;
	int EDIT_EVENT_RESULT = 100;
	int GALLERY_PIC_RESULT = 21;
	int PERMISSIONS_REQUEST = 22;
	int REQUEST_LOCATION = 101;
	int REQUEST_PERMISSION_LOCATION = 102;
	int REQUEST_PERMISSIONS_STORAGE = 103;

	//API Base Key
	String kId = "Id";
	String kTag = "tag";
	String kStatus = "status";
	String kMessage = "message";
	String kResponse = "response";
	String kResponseMessage = "response_messege";
	String kAction = "action";
	String kSuccess = "success";
	String kResult = "result";
	String kRecords = "records";
	String kRecord = "record";
	String kType = "type";
	String kData = "data";
	String kDate = "date";
	String kSDate = "start_date";
	String kPage = "page";
	String karchiveBy="archive_by";
	String kFlag = "flag";
	String kTitle = "title";
	String kImage = "image";
	String kResults = "results";
	String kTotalRecords = "totalRecords";
	String kDescription = "description";
	String kFolderName = "folder_name";
	String kGalleryFolder = "folder_gallery";
	String kfacFolderName="facility_folder_name";

	String kSeperator = "__";
	String kHyhen = "-";
	String kEmptyString = "";
	String kWhitespace = " ";
	Number kEmptyNumber = 0;

	// Error Messages
	String kMessageInternalInconsistency = "Some internal inconsistency occurred. Please try again.";
	String kMessageNetworkError = "Device does not connect to internet.";
	String kSocketTimeOut = "Social Sportz Server not responding..";
	String kMessageServerNotRespondingError = "Social Sportz server not responding!";
	String kDataUnsuccessful = "Record does not exist";
	String kDataAlreadySubmitted = "Record already save";
	String kDataInsertSuccessfull = "Record inserted successfully";
	String kDataDeleteSuccessfull = "Record deleted successfully";
	String kImageDeleteSuccessful = "Image Removed Sucessfully";
	String kMessageConnecting = "Connecting...";
	String kError = "Error";
	String kDeleteMsg = "Are you sure you want to delete?";
	String kLocationPermissionMsg = "You have denied the access permission permanently, allow the permission from setting.";

	String kCurrentTimeStamp = "CurrentTimeStamp";
	String kTimestamp = "TimeStamp";

	String kAuthToken = "user_oauth_id";
	String kGenericAuthToken = "genericAuthToken";
	String kDefaultAuthToken = "defaultAuthToken";


	//profileSummyStatus
	String kProfileSattuss="Profile";
	String kfacilityStatus="Facility/Academy Details";
	String kbankStatus="Bank Details";
	String kDocumentsStatus="Upload Documents";
	String kAmenityStatuss="Amenity Status";
	String kSportsStatus="Sport Status";
	String kGalleryStatuss="Gallery Status";
	String kTimingStatus="Timing Status";

	// Types
	String kCurrentUser = "currentUser";
	String kFacility = "facility";

	// User
	String kUserId = "user_id";
	String KFilterType="filter_type";
	String kCoupanCode = "coupn_code";
	String kCoupanAmount = "coupon_amount";
	String kLoginType = "user_login_type";
	String kUserName = "user_name";
	String kPassword = "user_password";
	String kGender = "user_gender";
	String kEmail = "user_email";
	String kMobile = "user_mobile";
	String kPhone = "user_mobile_no";
	String kRole = "user_role";
	String kUserStatus = "user_status";
	String kProfile = "user_profile_image";
	String kIsMobileVerified = "is_mobile_verified";
	String kIsEmailVerified = "is_email_verified";
	String kMobileVerify = "mobile_verification";
	String kuserActivityCount="Activity_notification";
	String kRegisteredEmail = "register_email";
	String kOldPassword = "old_password";
	String kNewPassword = "new_password";
	String kProfileStatus = "profile_status";
		String kNotificationCount = "notification_count";
	String kEmailAlertCount = "email_alert_count";

	//...Enquire constants
	String kEnquireName = "query_name";
	String kEnguireContact = "query_contact";
	String kEnquireEmail = "query_email";
	String kEnquireMessage = "query_message";
	String kEnquireSubject = "query_title";


	//Rating Update
	String kratingMsg = "rating_message";

    String kCount="activity_count";
	String kFacilityList = "facility_list";
	String kAcademyList = "academy_list";
	String kEventList = "event_listing";

	//Event Booked

	String kEventBookList="booking_event_listing";
	String kFacilityAcademyBooklIst="booking_facility_listing";
	String kuserSlotList="booking_slot_listing";



	//Address constants
	String kAddressId = "addressId";
	String kStreetAddress = "user_google_address";
	String kAddress = "user_address";
	String kAddress2 = "user_address2";
	String kCity = "user_city";
	String kState = "user_state";
	String kFacTimingList="fac_timing_list";
	String kCountry = "user_country";
	String kPincode = "user_pincode";
	String kLatitude = "user_latitude";
	String kLongitude = "user_longitude";

	// Sport
	String kSportList = "sport_list";
	String kSportListing = "sport_listing";
	String kSportId = "sport_id";
	String kSportName = "sport_name";
	String kbatchSlotTypename="batch_slot_type_name";
	String kSportIcon = "sport_icon";
	String kSportImage = "sport_image";
	String kSportStatus = "sport_status";
	String kSposrtListing = "sport_listing";
	String kMasterSport = "master_Sport";
	String kBookingCount = "booking_count";
	String keventAvailable="event_available";
//..favroute

	String kfavrouteId = "favourite_id";

	//Booking Count

	String kMyBooking = "MY BOOKINGS";
	String kEventBookin = "EVENT BOOKINGS";
	String kMyEnquiry = "MY ENQUIRY";
	String kNotifications = "NOTIFICATIONS";
	String kMyReviews = "MY REVIEW";

	// Amenity
	String kAmenityList = "amenities_list";
	String kAminities = "aminities_list";
	String kAmenities = "amenities";
	String kAmenityId = "amenity_id";
	String kAmenityIds = "amenities_ids";
	String kAmenityName = "amenity_name";
	String kAmenityIcon = "amenity_icon";
	String KAmenityDesc = "amenity_description";
	String kAmenityStatus = "amenity_status";
	String kRating_value = "rating_value";
	String kfacilityApporval="facility_approval";

	//Facility
	String kFacId = "fac_id";
	String kAceivementId="achievement_id";
	String kTotal="Total";
	String kActive="Active";
	String kInactive="Inactive";
	String kYear="year";


	//...Cancellation Charge

	String kOptioOneStartDate="option_one_start_days";
	String kOptionOneEndday="option_one_end_days";
	String kOptionOneCharge="option_one_charge";
	String kOptionTwoStartDay="option_two_start_days";
	String kOptiontwoEndday="option_two_end_days";
	String kOptionTwoCharge="option_two_charge";
	String kOptionThreeStartDay="option_three_start_days";
	String kOptionThreeEndDay="option_three_end_days";
	String kOptionThreeCharge="option_three_charge";



	String kaddcart = "add_cart";
	String kCartId = "cart_id";
	String kAddedOn = "added_on";
	String kReturnPackageId = "return_package_id";
	String kReturnistrial = "return_is_trial";
	String kFacName = "fac_name";
	String kFacType = "fac_type";
	String kFacDesc = "fac_description";
	String kFacShort = "fac_short_description";
	String kFacCity = "fac_city";
	String kSlotCount="slot_count";
	String kFacState = "fac_state";
	String kFacCountry = "fac_country";
	String kFacAddress = "fac_address";
	String kFacGoogle = "fac_google_address";
	String kFacPincode = "fac_pincode";
	String kFacLat = "fac_latitude";
	String kFacLng = "fac_longitude";
	String kFacBanner = "fac_banner_image";
	String kFacLogo = "fac_logo_image";
	String kFacStatus = "fac_status";
	String kfacSlug="fac_slug";
	String kBookingFor="booking_for";

	//Fac Timing
	String kFacTiming = "fac_timing";
	String kFacTimeListing = "fac_timing_list";
	String kFacTimingId = "fac_timing_id";
	String kFacDayName = "day";
	String kFacDayStatus = "day_status";
	String kFacOpenTime = "open_time";
	String kFacCloseTime = "close_time";
	String kTimeListing = "timing_list";

	// Fac Achieve
	String kAchievementList = "achievement_list";
	String kFacAchieve = "fac_achieve";
	String kAchieveId = "reward_achievement_id";


	// Fac Reward
	String kRewardList = "reward_achievement_list";
	String kFacReward = "fac_reward";
	String kRewardTitle = "reward_title";
	String kRewardId = "reward_id";
	String kRewardName = "reward_name";
	String kImage1 = "image1";
	String kImage2 = "image2";

	// Fac Achieve
	String kFacAmenityList = "my_facility_aminity";
	String kFacAmenityId = "fac_amenities_id";
	String kFacAmenityQty = "fac_amenities_qty";
	String kFacAmenityDesc = "fac_amenities_desc";

	// Fac Sport
	String kFacSportList = "facility_sport_list";
	String kFacSportId = "fac_sport_id";
	String kFacCourt = "sport_court";
	String kFacIndoor = "sport_indor";
	String kFacOutdoor = "sport_outdor";

	String kMonth = "month";
	String kCreateOn = "create_on";
	String kCreatedOn = "created_on";
	String kCreateBy = "created_by";
	String kUserBy = "user_by";
	String kUpdatedOn = "updated_on";
	String kUpdatedBy = "updated_by";
	String kUpdateOn = "update_on";
	String kavilcart="available_cart";

	String kUserField = "user_field";
	String kAvailability = "availability";
	String kTotalSeats = "total_seats";
	String kAvailSeats = "booked_seats";

	//Bank Detail
	String kBankId = "bank_info_id";
	String kBankDetails = "user_bank_details";
	String kIFSCCode = "ifsc_code";
	String kBankName = "bank_name";
	String kBankBranch = "branch_address";
	String kAccountType = "account_type";
	String kAccountName = "account_name";
	String kAccountNumber = "account_number";
	String kGSTNumber = "gst_no";
	String kPANNumber = "pan_no";
	String kCINNumber = "cin_no";
	String kGSTImage = "gst_image";
	String kPANImage = "pan_image";
	String kCINImage = "firm_image";
	String kChequeImage = "cheque_image";
	String kProofImage = "address_proof_image";

	//Fac gallery
	String kGalleryId = "gallery_id";
	String kGalleryType = "gallery_category_type";
	String kImageCaption = "image_caption";
	String kGalleryImage = "gallery_image";
	String kGalleryStatus = "gallery_status";
	String kEventGalleryImage="image";

	//Fac ViewGallery
	String kGalleryList = "gallery_list";


	// WeekOff day
	String kWeekOffs = "weekoffs";
	String kWeekOffId = "batch_slot_weekoff_id";
	String kWeekOffDay = "batch_slot_weekoff_day";
	String kWeekOffStatus = "weekoff_day_status";

	// Batch Type
	String kTypeId = "batch_slot_type_id";
	String kTypeName = "batch_slot_type";
	String kBatchSlotTypeName="batch_slot_type_name";
	String kbatchSloTypeTitle="batch_slot_type_title";

	// Batch Package
	String kPackageId = "package_id";
	String kPackageName = "package_name";
	String kPackageDuration = "package_duration";

	// Slot Batch Price
	String kPriceId = "slot_package_price_id";
	String kPriceNo = "slot_package_price";

	// Batch Slot
	String kBatchSlotId = "batch_slot_id";
	String kBatchSlotType = "batch_slot_type";
	String kIsTrial = "is_trial";
	String kSportType = "sport_type";
	String kSessionId = "session_id";
	String kStartTime = "start_time";
	String kBookDate = "book_date";
	String kEndTime = "end_time";
	String kStartDate = "start_date";
	String kEndDate = "end_date";
	String kActualPrice = "actual_price";
	String kIsKit = "is_kit_available";
	String kKitPrice = "kit_price";
	String kCourtType = "court_type";
	String kCourtDesc = "court_description";
	String kMaxParticipants = "max_participanets";
	String kPricing = "pricing";
	String kBatchSlotData = "batch_slot_data";
	String kBatchSlotStatus = "fac_batch_slot_status";
	String kcartListing = "add_cart_listing";
	String ktotalcart="total_batch_slot_data";
	String kbatchSlotType="batch_slot_type";
	String kcoutDescription="court_description";
	String kslotAvailable="slots_available";
	String kArchiveStatus="archive_status";
	String kArchiveComment="archive_comment";
	String karchieveBy="archive_by";





	//Notification

	String kHistoryId = "history_id";
	String kActivityTime = "activity_time";

	//Enquire
	String kQuireTitle = "query_title";
	String kQuireMessage = "query_message";



	//User Convenience Charges
    String kConvenicesPersantage="fees";
    String kconveniencemaxfees="max_fees";
    String kconvenienceTyep="fee_type";
    String kconveniensTexes="taxes";

	// UserEvent


	String kEventId = "event_id";
	String kUserCartCount="cart_count";
	String kEventSlug = "event_slug";
	String kEventMetaTitle = "event_meta_title";
	String kEventMetaDes = "event_meta_description";
	String kMetaKeyword = "event_meta_keyword";
	String kSpotsFolderBanner = "sport_folder_name";
	String kIsHome = "is_home";
	String kEventName = "event_name";
	String kEventDesc = "event_description";
	String kEventPrice = "event_price";
	String kEventStartDate = "event_start_date";
	String kEventEndDate = "event_end_date";
	String kEventStartTime = "event_start_time";
	String kEventEndTime = "event_end_time";
	String kEventStartEnroll = "application_start_date";
	String kEventEndEnroll = "application_end_date";
	String kEventBooked = "event_booked_slots";
	String kBookedEvent="booked_slot_count";
	String kEventAvailableBooked="available_slot_count";
	String kEventMax = "event_max_capicity_per_day";
	String kEventVenue = "event_venue";
	String kEventCity = "event_city";
	String kEventLat = "event_latitude";
	String kEventLog = "event_longitude";
	String kEventRules = "event_eligibility";
	String kEventBanner = "event_banner";
	String kEventContact = "event_contact_person";
	String kEventEmail = "event_contact_person_email";
	String kEventPhone = "event_contact_person_no";
	String kEventCategory="event_categories";
	String kEventAgeCategory="event_age_category";
	String kEventApproval = "event_approval";
	String kEventAwardPrize="event_award_prize";
	String kEventStatus = "event_status";
	String kEventGallery = "event_gallery";
	String kEventAmenities = "event_amenity";
	String kEventAmenityId = "event_amenities_id";
	String kEventSport = "event_sport_id";
	String kEventDeleteGallery = "delete_gallery";
	String kRatingId = "rating_id";
	String kReviewsList = "rating_list";
	String kRatingType = "rating_type";
	String kRating = "rating";
	String kReview = "review_listing";
	String kReviewId = "review_id";
	String kReviewMsg = "review_message";
	String kReviewDate = "created_on";
	String kReviewUserImage = "user_profile_image";
	String kAbuseState = "report_abuse";
	String kFolderNames="folder_names";

	String kNotificationId = "notification_id";
	String kNotificationTitle = "notification_title";
	String kNotificationMessage = "notification_message";
	String kNotBookingId = "booking_id";
	String kNotBookingEmail = "booking_email";

	String kEmailNotificationId = "email_notification_id";
	String kEmailNotificationTitle = "email_notification_title";
	String kEmailNotificationMsg = "email_notification_message";
	String kEmailNotificationActivity = "email_notification_activity";

	String kEnquiryId = "query_id";
	String kEnquiryTitle = "query_title";
	String kEnquiryMessage = "query_message";
	String kEnquiryStatus = "query_status";
	String kEnquiryApprove = "approve_status";
	String kcancelCharges="bs_cancel_charges";
	String kcancelOn="bs_cancel_on";
	String kCancelResion="bs_cancel_reason";
	String kCancelStatus="bs_cancel_status";
	String kOtherCharges="bs_other_charges";
	String krefaundAmt="bs_refund_amount";

	//Booking Data
	String kBookingId = "booking_order_id";
	String kBookingOrder = "booking_order_no";
	String kBookingName = "name";
	String kBookingEmail = "email";
	String kBookingMobile = "mobile";
	String kBookingAddress = "address";
	String kBookingCity = "city";
	String kBookingState = "state";
	String kBookingCountry = "country";
	String kBookingTotal = "total_amount";
	String kBookingTaxes = "taxes";
	String kBookingCoupon = "coupon_code";
	String kBookingDiscount = "discount_amount";
	String kBookingFinal = "final_amount";
	String kBookingStatus = "booking_status";
	String kCovenienceFee="convenience_fee";
	String kConvenienceTaxes="taxes";
	String kPaymentTranId = "pay_transction_id";
	String kPaymentTranOther = "pay_transction_other";
	String kPaymentStatus = "payment_status";
	String kPaymentMethod = "payment_method";
	String kUDownloadReceipt="download_receipt";
	String kBookingType = "booking_type";
	String kBookingDate = "booking_on";
	String kBookingDetails = "booking_slot_listing";
	String kEventBookingDetails = "booking_event_listing";
	String kBookingArray = "booking_array";


	//Event Cancel..

	String kEventCanceldate="cancel_on";
	String kEventCancelReason="cancel_reason";
	String kEventCancelReqStatus="cancel_req_status";
	String kEventCancelCharge="cancel_charges";
	String kEventOtherCharge="other_charges";
	String kEventCancelRefundAmnt="refund_amount";
	String kEventCancelRefundStatus="refund_status";
	String kSelectAll="select_all";
	String kUserBatchSlotIds="batch_slot_ids";


	//Booking Details
	String kBookingDetailId = "booking_detail_id";
	String kBookingTrial = "is_trial";
	String kBookingStartTime = "batch_slot_start_time";
	String kBookingEndTime = "batch_slot_end_time";
	String kBookingStartDate = "start_date";
	String kBookingDetailTotal = "booking_detail_total_amount";
	String kBookingDetailDiscount = "booking_detail_discount";
	String kBookingDetailFinal = "booking_detail_final_amount";
	String kBookingDetailStatus = "booking_detail_status";

  //..Year dat..

	 String kjan="Jan";
	 String kfeb="Feb";
	 String kmar="Mar";
	 String kapr="Apr";
	 String kmay="May";
	 String kjune="June";
	 String kjuly="July";
	 String kaug="Aug";
	 String ksept="Sept";
	 String koct="Oct";
	 String knov="Nov";
	 String kdec="Dec";





	//DashBoard
	String kBookingView = "dashbord_booking";
	String kyeardata="getSunResultLimitBooking";

	String kstatisticOffline="BookingOrderCountOffline";
	String kstatisticOnline="BookingOrderCountOnline";



	String kTodayBoking = "todays_booking_count1";
	String kTrialBoking = "total_queries";
	String kTrialBookingg = "upcoming_confirmed_booking_count";
	String kTotalBoking = "today_transation_count";
	String kConfirmedBoking = "upcoming_cancelled_slot_count";
	String kPendingBoking = "total_pending_booking_count";




	String kUpcomingEvents = "upcoming_events";
	String kLatestQueries = "latest_queries";
	String kReviewSummary = "review_summary";
	String kTotal1Star = "total_1_review";
	String kTotal2Star = "total_2_review";
	String kTotal3Star = "total_3_review";
	String kTotal4Star = "total_4_review";
	String kTotal5Star = "total_5_review";
	String kReviewCount = "review_count";


	String kTrialBooking = "Trial Booking";
	String kPendingBooking = "Pending Booking";
	String kTotalBooking = "Total Booking";
	String kConfirmedBooking = "Confirmed Booking";
	String kTodayBooking = "Today's Booking";
	String kUpcomingTrialBooking="Total Queries";
	String kTodaysTransations="Today's Transactions";
	String kUpcomingcancelledSlotCount="Upcoming Cancelled Slot";
	String kUpcomingcancelledBatchCount="Upcoming Cancelled Batch";
	String kUpcomingBookingSlot="Upcoming Booking (Slot)";
	String kUpcomingBookingBatch="Upcoming Booking (Batch)";

	//User FacDash
	String kIsFavorite = "is_favourate";
	String kRatingCount = "rating_count";
	String kRatingAverage = "rating_avg";
	String kEventBookings = "event_booking";
	String kThingNote = "thing_to_note";
	String kfacCount="favourate_count";

	//regarding the updating of app.
	String kCurrentVersion = "currentVersion";
	String kBuildNumber = "buildNumber";
	String kVersionNumber = "versionNumber";
	String kVersionDescription = "versionDescription";
	String kIsMandatoryUpdate = "isMandatoryUpdate";
	String kRolloutTimestamp = "rolloutTimestamp";
	String kVersionMandatoryTimestamp = "versionMandatoryTimestamp";
	String kBuildType = "buildType";
	String kMinOSVersion = "minOSVersion";
	String kMaxOSVersion = "maxOSVersion";
	String kLanguageSupported = "languageSupported";

	//Dialog constants
	String KSCREENWIDTH = "screenwidth";
	String KSCREENHEIGHT = "screenheight";
	String kName="name";

	// Facebook Constants
	String kFacebookFields = "fields";
	String kFacebookAllFields = "id,name,link,email,picture,first_name,last_name,gender";

	String kFacebookId = "id";
	String kFacebookEmail = "email";
	String kFacebookFirstName = "first_name";
	String kFacebookLastName = "last_name";
	String kFacebookGender = "gender";

	//Google map api constants
	String kPremise = "premise";
	String kStreetNumber = "street_number";
	String kRoute = "route";
	String kLocality = "locality";
	String ksublocality="sublocality";
	String ksubLocalitylevel3="sublocality_level_3";
	String kAdministrativeAreaLevel2 = "administrative_area_level_2";
	String kAdministrativeAreaLevel1 = "administrative_area_level_1";
	String kAdministrativeAreaLevel3="administrative_area_level_3";
	String kPostalCode = "postal_code";
	String kGCountry = "country";


	//...Event Booked LList..

	String kEventGoogleADDress="event_google_address";
	String kupdateByType="updated_by_type";
	String kCreatedByType="created_by_type";
	String kAdminApprovedCmt="admin_approval_comment";
	String kAdminApproved="admin_approval";
	String kfavMetaKeywd="fac_meta_keyword";
	String kFacMetadEs="fac_meta_description";
	String kfacmetaTile="fac_meta_title";

	/**
	 * Http Status for API Response
	 */
	enum HTTPStatus {
		success(1),
		badRequest(400),
		unauthorized(401),
		notFound(404),
		methodNotAllowed(405),
		notAcceptable(406),
		proxyAuthenticationRequired(407),
		requestTimeout(408),
		error(-100);         //No option found.

		//Definition
		private int httpStatus;

		HTTPStatus(int httpStatus) {
			this.httpStatus = httpStatus;
		}

		public static HTTPStatus getStatus(int status) {
			for (HTTPStatus httpStatus : HTTPStatus.values()) {
				if (httpStatus.httpStatus == status) {
					return httpStatus;
				}
			}
			return error;
		}

		public Integer getValue() {
			return this.httpStatus;
		}
	}

	/**
	 * Status Enumeration for Task Status
	 */
	enum Status {
		success(1),
		fail(0),
		reachLimit(2),
		noChange(3),
		history(4),            //If xmpp message is history
		normal(5),            //If Normal xmpp message
		discard(6);

		//Definition
		private int value;

		Status(int status) {
			this.value = status;
		}

		public static Status getStatus(int value) {
			for (Status status : Status.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return fail;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * Role Enumeration for user roles
	 */
	enum Role {
		EndUser(1),
		Owner(2);

		//Definition
		private int value;

		Role(int status) {
			this.value = status;
		}

		public static Constants.Role getRole(int value) {
			for (Constants.Role status : Constants.Role.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return EndUser;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * FacType Enumeration for facility/Academy types
	 */
	enum FacType {
		academy(2),
		facility(1);

		//Definition
		private int value;

		FacType(int status) {
			this.value = status;
		}

		public static Constants.FacType getFacType(int value) {
			for (Constants.FacType status : Constants.FacType.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return facility;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * LoginType Enumeration for user login scenario
	 */
	enum LoginType {
		Normal(1),
		Facebook(2),
		Google(3);

		//Definition
		private int value;

		LoginType(int status) {
			this.value = status;
		}

		public static Constants.LoginType getLoginType(int value) {
			for (Constants.LoginType status : Constants.LoginType.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return Normal;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * Profile Status Enumeration
	 */
	enum ProfileStatus {
		complete(1),
		pending(2),
		rejected(3);

		//Definition
		private int value;

		ProfileStatus(int status) {
			this.value = status;
		}

		public static Constants.ProfileStatus getProfileStatus(int value) {
			for (Constants.ProfileStatus status : Constants.ProfileStatus.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return complete;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * Default Status Enumeration
	 */
	enum DefaultStatus {
		yes(1),
		no(2);

		//Definition
		private int value;

		DefaultStatus(int status) {
			this.value = status;
		}

		public static Constants.DefaultStatus getDefaultStatus(int value) {
			for (Constants.DefaultStatus status : Constants.DefaultStatus.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return yes;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * Gallery Status Enumeration
	 */
	enum BatchSlotEnum {
		batch(2),
		slot(1);

		//Definition
		private int value;

		BatchSlotEnum(int status) {
			this.value = status;
		}

		public static Constants.BatchSlotEnum getBatchSlotType(int value) {
			for (Constants.BatchSlotEnum status : Constants.BatchSlotEnum.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return slot;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * Gallery Status Enumeration
	 */
	enum GalleryStatus {
		active(1),
		deactive(2);

		//Definition
		private int value;

		GalleryStatus(int status) {
			this.value = status;
		}

		public static Constants.GalleryStatus getGalleryStatus(int value) {
			for (Constants.GalleryStatus status : Constants.GalleryStatus.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return active;
		}

		/**
		 * To get Integer value of corresponding emum
		 */

		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * PaymentStatus Enumeration for any type of status
	 */
	enum PaymentStatus {
		fail(0),
		success(1),
		pending(2);

		//Definition
		private int value;

		PaymentStatus(int status) {
			this.value = status;
		}

		public static Constants.PaymentStatus getPaymentStatus(int value) {
			for (Constants.PaymentStatus status : Constants.PaymentStatus.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return success;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * PaymentStatus Enumeration for any type of status
	 */
	enum PaymentMethod {
		online(0),
		cod(1);

		//Definition
		private int value;

		PaymentMethod(int status) {
			this.value = status;
		}

		public static Constants.PaymentMethod getPaymentMethod(int value) {
			for (Constants.PaymentMethod status : Constants.PaymentMethod.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return online;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * PaymentStatus Enumeration for any type of status
	 */
	enum BookingStatus {
		confirm(1),
		pending(2),
		cancel(3);

		//Definition
		private int value;

		BookingStatus(int status) {
			this.value = status;
		}

		public static Constants.BookingStatus getBookingStatus(int value) {
			for (Constants.BookingStatus status : Constants.BookingStatus.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return confirm;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}

	/**
	 * PaymentStatus Enumeration for any type of status
	 */
	enum BookingType {
		online(1),
		offline(2);

		//Definition
		private int value;

		BookingType(int status) {
			this.value = status;
		}

		public static Constants.BookingType getBookingType(int value) {
			for (Constants.BookingType status : Constants.BookingType.values()) {
				if (status.value == value) {
					return status;
				}
			}
			return online;
		}

		/**
		 * To get Integer value of corresponding emum
		 */
		public Integer getValue() {
			return this.value;
		}

	}
}
