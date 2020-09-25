package com.socialsportz.APIManager;

import com.google.gson.JsonObject;

import java.util.List;
import java.util.Map;

import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;
import retrofit2.http.PartMap;
import retrofit2.http.Query;
import retrofit2.http.Url;

public interface ApiInterface {


	//new api's for User....

	String kSearchListing="user/search_listing";
	String kUserEnquiry="user/user_enquiry_facility";
	String kUserEnquireList="user/user_enquiry_listing";
	String kUserNotification="user/user_notification";
	String kUserProfile="user/user_profile";
	String kratingUpdate="user/user_review_edit";
	String kUserInsertReview="user/ratinginsert";
	String kUpdateSports="user/user_sport_update";
	String kUserPakageList="user/package_listing";
	String kUserAddtocart="user/user_add_cart";
	String uUserFacilityAll="user/seeallfacility";
	String kUserDeactivateFav="user/deactivate_favorite";
	String kuserCartList="user/user_cart_list";
	String kUserCount="user/count_cart";
	String kUserCovenienceCharge="user/convenience_charge";
	String kusercancellationCharge="user/cancellation_charge";
	String kuserDeletecart="user/delete_cart";


	//...end

	//Base page for all the api's
	String kBasePage     = "index.php";

	//User will login through userLogin API.
	String kUserLogin = "user/user_login";

	String kUserSocial = "user/existing_user";

	//User will login through userReg API.
	String kUserReg = "user/user_registration";

	String kUserEditProfile="user/user_profile_update";

	//User will get mobile verified.
	String kMobileVerify = "user/mobile_verification";
	String kuserNotificationCount="user/notification_activity";

	//User will set forgot password.
	String kForgotPassword = "user/forgot_password";

	//User will set change password.
	String kChangePassword = "user/change_password";

	//User will get logout from app.
	String kLogout = "facility/logout";

	String kMasterSports = "facility/master_sport_list";

	String kMasterAmenities = "facility/master_amenities_list";

	String kMasterRewards = "facility/reward_achievement_list";

	//Facility will get facility Profile.
	String kFacilityProfile = "facility/facility_profile";

	String kFacilityAddProfile = "facility/facility_profiling_step2";

	String kFacilityAddSports = "facility/sports_step_3";

	String kFacilityAddAmenities = "facility/facility_step_4";

	String kFacilityAddAchieve = "facility/add_edit_achievements";

	String kFacilityAddBank = "facility/facility_step_5";

	String kFacAcaListing = "facility/facility_academy_listing";

	String kFacAchieveListing = "facility/facility_reward_achievement";

	String kFacSportsListing = "facility/fac_sport_listing";

	String kFacAcaDelete = "facility/delete_facility";

	String kFacSportDelete = "facility/sport_delete";

	String kFacAchieveDelete = "facility/delete_achievements";

	String kFacTimingUpdate = "facility/fac_timings_edit";

	String kBatchSlotTypes = "facility/master_batch_slot_type_list";

	String kFacBatchPackages = "facility/master_batch_package_list";

	String kFacAddEditSlot = "facility/add_edit_slot";

	String kAcaAddEditBatch = "facility/add_edit_batch";

	String kFacBatchSlotList = "facility/batch_slot_listing";
	String kfacbatcharciveList="facility/archive_batch_slot_listing";

	String kFacAddEditEvent = "facility/add_edit_event";

	String kFacEventList = "facility/event_listing";
	String kEventArchiveList="facility/archive_event_listing";

	String kFacAddEditGallery = "facility/add_edit_facility_gallery";

	String kFacGalleryList = "facility/gallery_listing";

	String kFacEventEnableDisable = "facility/enable_disable_event";

	String kFacBookingListing = "facility/booking_listing";

	String kEventBookingListing = "facility/event_booking";

	String kFacReviewListing = "facility/review_listing";

	String kFacReviewListingg = "user/user_review_rating_list";

	String kFacEnquiryListing = "facility/enquiries_listing";

	String kFacNotificationListing = "facility/notification_listing";

	String kFacEmailAlertListing = "facility/email_notification_listing";

	String kFacDashBoard = "facility/dashbord_booking";
	String kFacStaticticsSlot="facility/statesSlotbatch";
	String kFacStaticticsEvent="facility/statesEvent";

	String kAvailableBooking = "facility/available_slots";

	String kUserDetails = "facility/user_details";

	String kBookingCheckout = "facility/offline_booking_checkout";

	String kFacCalendarData = "facility/availability_count_of_month";

	String kCalendarSlotBatchDetail = "facility/slot_batch_detail";

	String kCalendarBookingList = "facility/userbookingdetail";

	String kUserProfileStatus = "facility/profile_status";
	String kuserfacilityStatus="facility/facility_profile_status";
	String kUserfacSlotcount="facility/slotListingcount";

	String kUserNotificationCount = "facility/notification_counts";

	String kUserNotificationUpdate = "facility/update_user_notification_status";

	String kUserEmailAlertUpdate = "facility/update_email_alert_status";

	String kUserProfileUpdate = "facility/user_profile_updated";

	String kUserFacilityUpdate = "facility/facility_detail";
	String kUserAcheivemnetDellete="facility/facility_achievement_delete";

	String kUserAmenityUpdate = "facility/facility_amenities_listing";

	String kUserBankDetails = "facility/bank_detail";

	String kUserFacTimingUpdate = "facility/facility_timing";

	String kFacAcaListingNew = "facility/facility_listing_view";

	String kRatingAbuseUpdate = "facility/update_rating";


	String kUserEmailVerification = "facility/email_verification";

	//User
	String kUserDashBoard = "user/dashboard_Detail";
	String kUserFavourite = "user/user_favourate";

	String kUserSlotsAvailable="user/slots_available_list";
	String kUserAvailableSlot="user/user_available_slots";
	String kUserDeleteCart ="user/remove_item_to_cart" ;
	String kUserFavouriteDelete ="user/favourite_delete" ;
	String kUserFavouriteListDelete = "user/favourite_delete_all";
	String kuserBooking="user/booking_now";
	String kUserApplyCoupan="user/apply_coupon";
	String kuserbookinglist="user/user_event_booking_listing";
	String kuserfacilityBooking="user/user_facility_booking_listing";
	String kuserAddfav="user/add_favourite";
	String kEventCheckOut ="user/event_checkout" ;
	String kUserEventCancel="user/cancel_event";
	String kuserBatchSlotCancel="user/cancel_batch_slot";

	/**
	 * set api request with api key and corresponding parameters
	 * @param APIKey  key of the url
	 * @param details details contains request body parameters
	 * @param files   if include file will be sent in multipart
	 * @return JsonObject ie. response
	 */
	@Multipart
	@POST()
	Call<JsonObject> APIRequestWithFile(
		@Url String APIKey,
		@PartMap Map<String, RequestBody> details,
		@Part List<MultipartBody.Part> files
	);


	@POST()
	Call<JsonObject> APIRequestRaw(
		@Url String APIKey,
		@Body RequestBody params
	);

	@GET("maps/api/geocode/json")
	Call<JsonObject> getLocation(
		@Query("latlng") String latlng,
		@Query("key") String key
	);

	@GET("maps/api/place/autocomplete/json")
	Call<JsonObject> getPlaces(
		@Query("input") String input,
		@Query("key") String key,
		@Query("components") String value
	);

	@GET("maps/api/place/details/json")
	Call<JsonObject> getPlacesByID(
		@Query("placeid") String placeID,
		@Query("key") String key
	);

	@GET("maps/api/geocode/json")
	Call<JsonObject> getCordinates(
		@Query("address") String address,
		@Query("key") String key
	);

}


