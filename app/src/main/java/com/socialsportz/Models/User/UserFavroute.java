package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.Sport;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserFavroute extends BaseModel implements Serializable {


	private int facId;
	private int userId;
	private String facName;
	private String facType;
	private String facDesc;
	private String facShortDesc;
	private String facAddress;
	private String facCity;
	private String facPincode;
	private String facState;
	private String facCountry;
	private String facGoogleAdd;
	private String facLat;
	private String facLng;
	private String facBannerImg;
	private String facLogoImg;
	private String facStatus;
	private String facDate;
	private String facFolder;
	private int isFav;
	private String thingNote;

	public String getFavouriteId() {
		return favouriteId;
	}

	public void setFavouriteId(String favouriteId) {
		this.favouriteId = favouriteId;
	}

	private String favouriteId;

	public String getFavourate_count() {
		return favourate_count;
	}

	public void setFavourate_count(String favourate_count) {
		this.favourate_count = favourate_count;
	}

	private String favourate_count;
	private CopyOnWriteArrayList<UserFacTimings> facTimingList;
	private CopyOnWriteArrayList<UserFacAchievements> achieveList;
	private CopyOnWriteArrayList<UserReviews> userReviewsList;
	private CopyOnWriteArrayList<Sport> facSportList;
	private CopyOnWriteArrayList<Amenity> facAmenitiesList;
	private CopyOnWriteArrayList<UserFacViewGallery> facGalleryList;
	private int rating;
	private int ratingg;
	private String ratingAvg;
	private int image;

	public UserFavroute(JSONObject jsonResponse){
		this.facId = Integer.valueOf(getValue(jsonResponse, kFacId, String.class));
		this.userId = Integer.valueOf(getValue(jsonResponse, kUserId, String.class));
		this.facName = getValue(jsonResponse, kFacName, String.class);
		if(getValue(jsonResponse, kFacType, String.class).equals(FacType.academy.toString()))
			this.facType = FacType.academy.toString();
		else
			this.facType = FacType.facility.toString();
		this.facDesc = getValue(jsonResponse, kFacDesc, String.class);
		this.facShortDesc = getValue(jsonResponse, kFacShort, String.class);
		this.facCity = getValue(jsonResponse, kFacCity, String.class);
		this.facState = getValue(jsonResponse, kFacState, String.class);
		this.facCountry = getValue(jsonResponse, kFacCountry, String.class);
		this.facAddress = getValue(jsonResponse, kFacAddress, String.class);
		this.facGoogleAdd = getValue(jsonResponse, kFacGoogle, String.class);
		this.facPincode = getValue(jsonResponse, kFacPincode, String.class);
		this.facLat = getValue(jsonResponse, kFacLat, String.class);
		this.facLng = getValue(jsonResponse, kFacLng, String.class);
		//this.facLogoImg = getValue(jsonResponse, kFacLogo, String.class);
		this.facBannerImg = getValue(jsonResponse, kFacBanner, String.class);
		this.facStatus = getValue(jsonResponse, kFacStatus, String.class);
		this.facDate = getValue(jsonResponse, kCreatedOn, String.class);
		this.facFolder = getValue(jsonResponse,kFolderName,String.class);
		this.rating = getValue(jsonResponse,kRatingCount,Integer.class);
		this.ratingAvg = getValue(jsonResponse,kRatingAverage,String.class);
		this.isFav = getValue(jsonResponse,kIsFavorite,Integer.class);
		this.thingNote = getValue(jsonResponse,kThingNote,String.class);
		this.favourate_count=getValue(jsonResponse,kfacCount,String.class);
		this.favouriteId=getValue(jsonResponse,kfavrouteId,String.class);

		try {
			if(jsonResponse.has(kTimeListing))
				this.facTimingList = handleFacTimings(getValue(jsonResponse, kTimeListing, JSONArray.class));
			else
				this.facTimingList = new CopyOnWriteArrayList<>();

			if(jsonResponse.has(kAchievementList))
				this.achieveList = handleFacAchieve(getValue(jsonResponse, kAchievementList, JSONArray.class));
			else
				this.achieveList = new CopyOnWriteArrayList<>();
			if(jsonResponse.has(kReviewsList))
				this.userReviewsList = handleReviewList(getValue(jsonResponse, kReviewsList, JSONArray.class));
			else
				this.userReviewsList = new CopyOnWriteArrayList<>();

			if(jsonResponse.has(kSportList))
				this.facSportList = handleFacSports(getValue(jsonResponse, kSportList, JSONArray.class));
			else
				this.facSportList = new CopyOnWriteArrayList<>();

			if(jsonResponse.has(kAmenityList))
				this.facAmenitiesList = handleFacAmenities(getValue(jsonResponse, kAmenityList, JSONArray.class));
			else
				this.facAmenitiesList = new CopyOnWriteArrayList<>();

			if(jsonResponse.has(kGalleryList))
				this.facGalleryList = handleFacViewGallery(getValue(jsonResponse, kGalleryList, JSONArray.class));
			else
				this.facGalleryList = new CopyOnWriteArrayList<>();



		} catch (Exception e) {
			e.printStackTrace();
		}
	}



	public UserFavroute(int id, int image) {
		this.facId = id;
		this.image = image;
		this.facBannerImg = "";
	}

	public int getId() {
		return facId;
	}

	public void setId(int id) {
		this.facId = id;
	}

	public int getImage() {
		return image;
	}

	public void setImage(int image) {
		this.image = image;
	}

	public int getFacId() {
		return facId;
	}

	public void setFacId(int facId) {
		this.facId = facId;
	}

	public int getUserId() {
		return userId;
	}

	public void setUserId(int userId) {
		this.userId = userId;
	}

	public String getFacName() { return facName; }

	public void setFacName(String facName) {
		this.facName = facName;
	}

	public String getFacType() {
		return facType;
	}

	public void setFacType(String facType) {
		this.facType = facType;
	}

	public String getFacDesc() {
		return facDesc;
	}

	public void setFacDesc(String facDesc) {
		this.facDesc = facDesc;
	}

	public String getFacShortDesc() {
		return facShortDesc;
	}

	public void setFacShortDesc(String facShortDesc) {
		this.facShortDesc = facShortDesc;
	}

	public String getFacAddress() {
		return facAddress;
	}

	public void setFacAddress(String facAddress) {
		this.facAddress = facAddress;
	}

	public String getFacCity() {
		return facCity;
	}

	public void setFacCity(String facCity) {
		this.facCity = facCity;
	}

	public String getFacPincode() {
		return facPincode;
	}

	public void setFacPincode(String facPincode) {
		this.facPincode = facPincode;
	}

	public String getFacState() {
		return facState;
	}

	public void setFacState(String facState) {
		this.facState = facState;
	}

	public String getFacCountry() {
		return facCountry;
	}

	public void setFacCountry(String facCountry) {
		this.facCountry = facCountry;
	}

	public String getFacGoogleAdd() {
		return facGoogleAdd;
	}

	public void setFacGoogleAdd(String facGoogleAdd) {
		this.facGoogleAdd = facGoogleAdd;
	}

	public String getFacLat() {
		return facLat;
	}

	public void setFacLat(String facLat) {
		this.facLat = facLat;
	}

	public String getFacLng() {
		return facLng;
	}

	public void setFacLng(String facLng) {
		this.facLng = facLng;
	}

	public String getFacBannerImg() {
		return facBannerImg;
	}

	public void setFacBannerImg(String facBannerImg) {
		this.facBannerImg = facBannerImg;
	}

	public String getFacLogoImg() {
		return facLogoImg;
	}

	public void setFacLogoImg(String facLogoImg) {
		this.facLogoImg = facLogoImg;
	}

	public String getFacStatus() {
		return facStatus;
	}

	public void setFacStatus(String facStatus) {
		this.facStatus = facStatus;
	}

	public String getFacDate() {
		return facDate;
	}

	public void setFacDate(String facDate) {
		this.facDate = facDate;
	}

	public int getRating() {
		return rating;
	}

	public void setRating(int rating) {
		this.rating = rating;
	}

	public String getRatingAvg() {
		return ratingAvg;
	}

	public void setRatingAvg(String ratingAvg) {
		this.ratingAvg = ratingAvg;
	}

	public String getFacFolder() {
		return facFolder;
	}

	public void setFacFolder(String facFolder) {
		this.facFolder = facFolder;
	}

	public int getIsFav() {
		return isFav;
	}

	public void setIsFav(int isFav) {
		this.isFav = isFav;
	}

	public String getThingNote() {
		return thingNote;
	}

	public void setThingNote(String thingNote) {
		this.thingNote = thingNote;
	}

	public CopyOnWriteArrayList<UserFacTimings> getFacTimingList() {
		return facTimingList;
	}

	public void setFacTimingList(CopyOnWriteArrayList<UserFacTimings> facTimingList) {
		this.facTimingList = facTimingList;
	}

	public CopyOnWriteArrayList<UserFacAchievements> getAchieveList() {
		return achieveList;
	}

	public void setAchieveList(CopyOnWriteArrayList<UserFacAchievements> achieveList) {
		this.achieveList = achieveList;
	}


	public CopyOnWriteArrayList<UserReviews> getUserReviewsList(){return userReviewsList;}
	public void setUserReviewsList(CopyOnWriteArrayList<UserReviews> userReviewsList) {this.userReviewsList = userReviewsList;}

	public CopyOnWriteArrayList<Sport> getFacSportList() {
		return facSportList;
	}

	public void setFacSportList(CopyOnWriteArrayList<Sport> facSportList) {
		this.facSportList = facSportList;
	}

	public CopyOnWriteArrayList<Amenity> getFacAmenitiesList() {
		return facAmenitiesList;
	}

	public void setFacAmenitiesList(CopyOnWriteArrayList<Amenity> facAmenitiesList) {
		this.facAmenitiesList = facAmenitiesList;
	}

	public CopyOnWriteArrayList<UserFacViewGallery> getViewGalleryList() {
		return facGalleryList;
	}


	public void setFacGalleryList(CopyOnWriteArrayList<UserFacViewGallery> facGalleryList) {
		this.facGalleryList = facGalleryList;
	}


	private CopyOnWriteArrayList<UserFacTimings> handleFacTimings(JSONArray jsonArray) throws JSONException {
		CopyOnWriteArrayList<UserFacTimings> facDayTimings = new CopyOnWriteArrayList<>();
		for (int i = 0; i < jsonArray.length(); i++) {
			facDayTimings.add(new UserFacTimings(jsonArray.getJSONObject(i)));
		}
		return facDayTimings;
	}

	private CopyOnWriteArrayList<UserFacAchievements> handleFacAchieve(JSONArray jsonArray) throws JSONException {
		CopyOnWriteArrayList<UserFacAchievements> facAchieves = new CopyOnWriteArrayList<>();
		for (int i = 0; i < jsonArray.length(); i++) {
			facAchieves.add(new UserFacAchievements(jsonArray.getJSONObject(i)));
		}
		return facAchieves;
	}


	private CopyOnWriteArrayList<UserReviews> handleReviewList(JSONArray jsonArray) throws JSONException {
		CopyOnWriteArrayList<UserReviews> userReviews = new CopyOnWriteArrayList<>();
		for (int i = 0; i < jsonArray.length(); i++) {
			userReviews.add(new UserReviews(jsonArray.getJSONObject(i)));
		}
		return userReviews;
	}


	private CopyOnWriteArrayList<Sport> handleFacSports(JSONArray jsonArray) throws JSONException {
		CopyOnWriteArrayList<Sport> facSports = new CopyOnWriteArrayList<>();
		for (int i = 0; i < jsonArray.length(); i++) {
			facSports.add(new Sport(jsonArray.getJSONObject(i)));
		}
		return facSports;
	}

	private CopyOnWriteArrayList<Amenity> handleFacAmenities(JSONArray jsonArray) throws JSONException {
		CopyOnWriteArrayList<Amenity> facSports = new CopyOnWriteArrayList<>();
		for (int i = 0; i < jsonArray.length(); i++) {
			facSports.add(new Amenity(jsonArray.getJSONObject(i)));
		}
		return facSports;
	}

	private CopyOnWriteArrayList<UserFacViewGallery> handleFacViewGallery(JSONArray jsonArray) throws JSONException {
		CopyOnWriteArrayList<UserFacViewGallery> facSports = new CopyOnWriteArrayList<>();
		for (int i = 0; i < jsonArray.length(); i++) {
			facSports.add(new UserFacViewGallery(jsonArray.getJSONObject(i)));
		}
		return facSports;
	}



}
