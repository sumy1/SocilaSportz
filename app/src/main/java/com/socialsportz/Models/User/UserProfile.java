package com.socialsportz.Models.User;

import android.util.Log;

import com.socialsportz.Models.BaseModel;
import com.socialsportz.Models.Owner.Sport;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserProfile extends BaseModel implements Serializable {

    private String userId;
    private String userName;
    private String userEmail;
    private String isEmailVarified;
    private String userPassword;
    private String userGender;
    private String userPhone;
    private String isPhoneVerified;
    private String userCity;
    private String useraddress;
    private String userPiccode;
    private String userCountry;
    private String useGoogleAddress;
    private String userlat;
    private String userLang;
    private String userRole;
    private String userLoginType;
    private String userOuthid;
    private String userImage;
    private String userStatus;
    private String updatedOn;
    private String updatedBy;

    private String userProfile;

    private CopyOnWriteArrayList<Sport>sportListing;
    private CopyOnWriteArrayList<MasterSports>masterSports;

    public JSONObject getBppkingCount() {
        return bppkingCount;
    }

    public void setBppkingCount(JSONObject bppkingCount) {
        this.bppkingCount = bppkingCount;
    }

    private  JSONObject bppkingCount;

    public UserProfile(JSONObject jsonObject){
        this.userId=getValue(jsonObject,kUserId,String.class);
        this.userName=getValue(jsonObject,kUserName,String.class);
        this.userEmail=getValue(jsonObject,kEmail,String.class);
        this.isEmailVarified=getValue(jsonObject,kIsEmailVerified,String.class);
        this.userPassword=getValue(jsonObject,kPassword,String.class);
        this.userGender=getValue(jsonObject,kGender,String.class);
        this.userPhone=getValue(jsonObject,kPhone,String.class);
        this.isPhoneVerified=getValue(jsonObject,kIsMobileVerified,String.class);
        this.userCity=getValue(jsonObject,kCity,String.class);
        this.useraddress=getValue(jsonObject,kAddress,String.class);
        this.userPiccode=getValue(jsonObject,kPincode,String.class);
        this.userCountry=getValue(jsonObject,kCountry,String.class);
        this.useGoogleAddress=getValue(jsonObject,kStreetAddress,String.class);
        this.userlat=getValue(jsonObject,kLatitude,String.class);
        this.userLang=getValue(jsonObject,kLongitude,String.class);
        this.userRole=getValue(jsonObject,kRole,String.class);
        this.userLoginType=getValue(jsonObject,kLoginType,String.class);
        this.userOuthid=getValue(jsonObject,kAuthToken,String.class);
        this.userProfile=getValue(jsonObject,kProfile,String.class);
        this.userImage=getValue(jsonObject,kProfile,String.class);
        this.userStatus=getValue(jsonObject,kUserStatus,String.class);
        this.updatedOn=getValue(jsonObject,kUpdatedOn,String.class);
        this.updatedBy=getValue(jsonObject,kUpdatedBy,String.class);

		try {
			this.masterSports = handleMasterSpots(getValue(jsonObject,kMasterSport, JSONArray.class));

			Log.d("masterSport",masterSports.size()+"");
		} catch (JSONException e) {
			e.printStackTrace();
		}
                if(jsonObject.has(kSposrtListing)){


					try {
						JSONArray array=jsonObject.getJSONArray(kSposrtListing);

						if(array!=null){
							try {
								this.sportListing = handleSportListing(getValue(jsonObject,kSposrtListing, JSONArray.class));
							} catch (JSONException e) {
								e.printStackTrace();
							}
						}

						Log.d("array",array.toString());
					} catch (JSONException e) {
						e.printStackTrace();
					}

				}






        this.bppkingCount =getValue(jsonObject,kBookingCount, JSONObject.class);


        
    }

    private CopyOnWriteArrayList<Sport> handleSportListing(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<Sport> sportListing = new CopyOnWriteArrayList<>();

        for (int i = 0; i < jsonArray.length(); i++) {
            sportListing.add(new Sport(jsonArray.getJSONObject(i)));
        }
        return sportListing;
    }


    private CopyOnWriteArrayList<MasterSports> handleMasterSpots(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<MasterSports> masterSports = new CopyOnWriteArrayList<>();


        for (int i = 0; i < jsonArray.length(); i++) {
            masterSports.add(new MasterSports(jsonArray.getJSONObject(i)));
        }
        return masterSports;
    }

    private CopyOnWriteArrayList<BookingCount> handleBookingCount(JSONObject jsonArray) throws JSONException {
        CopyOnWriteArrayList<BookingCount> bppkingCount = new CopyOnWriteArrayList<>();

        return bppkingCount;
    }

    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getUserName() {
        return userName;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getUserEmail() {
        return userEmail;
    }

    public void setUserEmail(String userEmail) {
        this.userEmail = userEmail;
    }

    public String getIsEmailVarified() {
        return isEmailVarified;
    }

    public void setIsEmailVarified(String isEmailVarified) {
        this.isEmailVarified = isEmailVarified;
    }

    public String getUserPassword() {
        return userPassword;
    }

    public void setUserPassword(String userPassword) {
        this.userPassword = userPassword;
    }

    public String getUserGender() {
        return userGender;
    }

    public void setUserGender(String userGender) {
        this.userGender = userGender;
    }

    public String getUserPhone() {
        return userPhone;
    }

    public void setUserPhone(String userPhone) {
        this.userPhone = userPhone;
    }

    public String getIsPhoneVerified() {
        return isPhoneVerified;
    }

    public void setIsPhoneVerified(String isPhoneVerified) {
        this.isPhoneVerified = isPhoneVerified;
    }

    public String getUserCity() {
        return userCity;
    }

    public void setUserCity(String userCity) {
        this.userCity = userCity;
    }

    public String getUseraddress() {
        return useraddress;
    }

    public void setUseraddress(String useraddress) {
        this.useraddress = useraddress;
    }

    public String getUserPiccode() {
        return userPiccode;
    }

    public void setUserPiccode(String userPiccode) {
        this.userPiccode = userPiccode;
    }

    public String getUserCountry() {
        return userCountry;
    }

    public void setUserCountry(String userCountry) {
        this.userCountry = userCountry;
    }

    public String getUseGoogleAddress() {
        return useGoogleAddress;
    }

    public void setUseGoogleAddress(String useGoogleAddress) {
        this.useGoogleAddress = useGoogleAddress;
    }

    public String getUserlat() {
        return userlat;
    }

    public void setUserlat(String userlat) {
        this.userlat = userlat;
    }

    public String getUserLang() {
        return userLang;
    }

    public void setUserLang(String userLang) {
        this.userLang = userLang;
    }

    public String getUserRole() {
        return userRole;
    }

    public void setUserRole(String userRole) {
        this.userRole = userRole;
    }

    public String getUserLoginType() {
        return userLoginType;
    }

    public void setUserLoginType(String userLoginType) {
        this.userLoginType = userLoginType;
    }

    public String getUserOuthid() {
        return userOuthid;
    }

    public void setUserOuthid(String userOuthid) {
        this.userOuthid = userOuthid;
    }

    public String getUserImage() {
        return userImage;
    }

    public void setUserImage(String userImage) {
        this.userImage = userImage;
    }

    public String getUserStatus() {
        return userStatus;
    }

    public void setUserStatus(String userStatus) {
        this.userStatus = userStatus;
    }

    public String getUpdatedOn() {
        return updatedOn;
    }

    public void setUpdatedOn(String updatedOn) {
        this.updatedOn = updatedOn;
    }

    public String getUpdatedBy() {
        return updatedBy;
    }

    public void setUpdatedBy(String updatedBy) {
        this.updatedBy = updatedBy;
    }

    public CopyOnWriteArrayList<Sport> getSportListing() {
        return sportListing;
    }

    public void setSportListing(CopyOnWriteArrayList<Sport> sportListing) {
        this.sportListing = sportListing;
    }

    public CopyOnWriteArrayList<MasterSports> getMasterSports() {
        return masterSports;
    }

    public void setMasterSports(CopyOnWriteArrayList<MasterSports> masterSports) {
        this.masterSports = masterSports;
    }

    public String getUserProfile() {
        return userProfile;
    }

    public void setUserProfile(String userProfile) {
        this.userProfile = userProfile;
    }





}
