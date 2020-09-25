package com.socialsportz.Models;

import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotType;
import com.socialsportz.Models.Owner.DashboardData;
import com.socialsportz.Models.Owner.FacAmenity;
import com.socialsportz.Models.Owner.FacBankModel;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.FacReward;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.UserDashBoard;
import com.socialsportz.Models.User.UserFacAca;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

public class CurrentUser extends BaseModel implements Serializable{

    private String authToken;
    private Integer userId;
    private String username;
    private String email;
    private boolean emailVerified;
    private String gender;
    private String password;
    private String phone;
    private boolean phoneVerified;
    private Integer role;
    private String roleName;
    private String userAddress;
    private String userSubArea;
    private String userCity;
    private String userState;
    private String userPinCode;
    private String userCountry;
    private String userGoogleAdd;
    private String userLat;
    private String userLng;
    private String userProfileImg;
    private Integer loginType;
    private String userStatus;
    private String createdOn;
    private CopyOnWriteArrayList<SportInterest> sportList;
    private FacBankModel userBankDetails;
    private CopyOnWriteArrayList<Amenity> amenities;
    private CopyOnWriteArrayList<Sport> sports;
    private CopyOnWriteArrayList<FacReward> rewards;
    private UserDashBoard userDashBoardData;
    private UserFacAca userFacAcaData;

    private CopyOnWriteArrayList<Facility> facilities;
    private CopyOnWriteArrayList<FacAmenity> myAmenities;
    private CopyOnWriteArrayList<BatchSlotType> batchSlotTypes;
    private CopyOnWriteArrayList<BatchPackage> batchPackages;

	public CopyOnWriteArrayList<FacDayTime> getFac_timing_listt() {
		return fac_timing_listt;
	}

	public void setFac_timing_listt(CopyOnWriteArrayList<FacDayTime> fac_timing_listt) {
		this.fac_timing_listt = fac_timing_listt;
	}

	private CopyOnWriteArrayList<FacDayTime> fac_timing_listt;
    private Integer selectedFacId=0;
    private DashboardData dashData;
    private int profileStatus;
    private int notificationCount,emailAlertCount;
    private boolean mFirstLogin;
    private BatchSlot batchSlot;
    public BatchSlot getBatchSlot() {
        return batchSlot;
    }

    public void setBatchSlot(BatchSlot batchSlot) {
        this.batchSlot = batchSlot;
    }



    public CurrentUser(JSONObject jsonResponse,int state) {// 1= signUp 0= signIn
        this.userId = Integer.valueOf(getValue(jsonResponse, kUserId, String.class));
        this.authToken = getValue(jsonResponse,kAuthToken,String.class);
        this.role = Integer.valueOf(getValue(jsonResponse,kRole,String.class));
        if(role.equals(Role.EndUser.getValue()))
            this.roleName = Role.EndUser.toString();
        else if(role.equals(Role.Owner.getValue()))
            this.roleName = Role.Owner.toString();
        this.userProfileImg = getValue(jsonResponse,kProfile,String.class);
        this.username = getValue(jsonResponse, kUserName, String.class);
        this.userStatus = getValue(jsonResponse,kUserStatus,String.class);
        this.email = getValue(jsonResponse, kEmail, String.class);
        this.emailVerified = getValue(jsonResponse, kIsEmailVerified,String.class).equals("yes");
        this.phone = getValue(jsonResponse, kPhone, String.class);
        this.phoneVerified = getValue(jsonResponse, kIsMobileVerified, String.class).equals("yes");
        this.password = getValue(jsonResponse,kPassword,String.class);
        this.gender = getValue(jsonResponse,kGender,String.class);
        this.loginType = Integer.valueOf(getValue(jsonResponse,kLoginType,String.class));

        this.userGoogleAdd = getValue(jsonResponse,kStreetAddress,String.class);
        this.userAddress = getValue(jsonResponse,kAddress,String.class);
        this.userSubArea = getValue(jsonResponse, kAddress2,String.class);
        this.userCity = getValue(jsonResponse,kCity,String.class);
        this.userState = getValue(jsonResponse,kState,String.class);
        this.userCountry = getValue(jsonResponse,kCountry,String.class);
        this.userPinCode = getValue(jsonResponse,kPincode,String.class);
        this.userLat = getValue(jsonResponse,kLatitude,String.class);
        this.userLng = getValue(jsonResponse,kLongitude,String.class);
        this.createdOn = getValue(jsonResponse, kCreatedOn,String.class);
        if(role.equals(Role.Owner.getValue())){
            try {
                if(state==1){
                    this.myAmenities = new CopyOnWriteArrayList<>();
                    this.facilities = new CopyOnWriteArrayList<>();
                    this.userBankDetails = null;
                    this.fac_timing_listt=new CopyOnWriteArrayList<>();

                    if(jsonResponse.has(kFacTimeListing)){
						this.fac_timing_listt=handlefacDayTime(jsonResponse.getJSONArray(kFacTimeListing));
					}else{
						this.fac_timing_listt=null;
					}

                    //this.fac_timing_listt=handlefacDayTime(getValue(jsonResponse,kFacTimeListing,JSONArray.class));
                    this.sports = handleSportList(getValue(jsonResponse,kSportList,JSONArray.class));
                    this.amenities = handleAmenityList(getValue(jsonResponse,kAmenityList,JSONArray.class));
                    this.rewards = handleRewardList(getValue(jsonResponse,kRewardList,JSONArray.class));
                }else if(state==0){
                    this.myAmenities = handleMyAmenities(getValue(jsonResponse,kFacAmenityList,JSONArray.class));
                    this.facilities = handleFacilities(getValue(jsonResponse,kFacilityList,JSONArray.class));
                    if(!jsonResponse.isNull(kBankDetails))
                        this.userBankDetails = new FacBankModel(getValue(jsonResponse,kBankDetails,JSONObject.class));
                    else
                        this.userBankDetails = null;
                    this.sports = handleSportList(getValue(jsonResponse,kSportList,JSONArray.class));
                    this.amenities = handleAmenityList(getValue(jsonResponse,kAmenityList,JSONArray.class));
					if(jsonResponse.has(kFacTimeListing)){
						this.fac_timing_listt=handlefacDayTime(jsonResponse.getJSONArray(kFacTimeListing));
					}else{
						this.fac_timing_listt=null;
					}
                    this.rewards = handleRewardList(getValue(jsonResponse,kRewardList,JSONArray.class));
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }else{
           /* try {

				this.sports = handleSportList(getValue(jsonResponse,kSportList,JSONArray.class));
				this.amenities = handleAmenityList(getValue(jsonResponse,kAmenityList,JSONArray.class));
            } catch (JSONException e) {
                e.printStackTrace();
            }*/
        }
    }

    public boolean ismFirstLogin() {
        return mFirstLogin;
    }

    public void setmFirstLogin(boolean mFirstLogin) {
        this.mFirstLogin = mFirstLogin;
    }

    public String getAuthToken() {
        return authToken;
    }

    public void setAuthToken(String authToken) {
        this.authToken = authToken;
    }

    public Integer getUserId() {
        return userId;
    }

    public void setUserId(Integer userId) {
        this.userId = userId;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public Integer getRole() {
        return role;
    }

    public void setRole(Integer role) {
        this.role = role;
    }

    public String getRoleName() {
        return roleName;
    }

    public void setRoleName(String roleName) {
        this.roleName = roleName;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getUserStatus() {
        return userStatus;
    }

    public void setUserStatus(String userStatus) {
        this.userStatus = userStatus;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public boolean isEmailVerified() {
        return emailVerified;
    }

    public void setEmailVerified(boolean emailVerified) {
        this.emailVerified = emailVerified;
    }

    public String getGender() {
        return gender;
    }

    public void setGender(String gender) {
        this.gender = gender;
    }

    public boolean isPhoneVerified() {
        return phoneVerified;
    }

    public void setPhoneVerified(boolean phoneVerified) {
        this.phoneVerified = phoneVerified;
    }

    public String getUserAddress() {
        return userAddress;
    }

    public void setUserAddress(String userAddress) {
        this.userAddress = userAddress;
    }

    public String getUserSubArea() {
        return userSubArea;
    }

    public void setUserSubArea(String userSubArea) {
        this.userSubArea = userSubArea;
    }

    public String getUserCity() {
        return userCity;
    }

    public void setUserCity(String userCity) {
        this.userCity = userCity;
    }

    public String getUserState() {
        return userState;
    }

    public void setUserState(String userState) {
        this.userState = userState;
    }

    public String getUserPinCode() {
        return userPinCode;
    }

    public void setUserPinCode(String userPinCode) {
        this.userPinCode = userPinCode;
    }

    public String getUserCountry() {
        return userCountry;
    }

    public void setUserCountry(String userCountry) {
        this.userCountry = userCountry;
    }

    public String getUserGoogleAdd() {
        return userGoogleAdd;
    }

    public void setUserGoogleAdd(String userGoogleAdd) {
        this.userGoogleAdd = userGoogleAdd;
    }

    public String getUserLat() {
        return userLat;
    }

    public void setUserLat(String userLat) {
        this.userLat = userLat;
    }

    public String getUserLng() {
        return userLng;
    }

    public void setUserLng(String userLng) {
        this.userLng = userLng;
    }

    public String getUserProfileImg() {
        return userProfileImg;
    }

    public void setUserProfileImg(String userProfileImg) {
        this.userProfileImg = userProfileImg;
    }

    public Integer getLoginType() {
        return loginType;
    }

    public void setLoginType(Integer loginType) {
        this.loginType = loginType;
    }

    public String getCreatedOn() {
        return createdOn;
    }

    public void setCreatedOn(String createdOn) {
        this.createdOn = createdOn;
    }

    public Integer getSelectedFacId() {
        return selectedFacId;
    }

    public void setSelectedFacId(Integer selectedFacId) {
        this.selectedFacId = selectedFacId;
    }

    public List<SportInterest> getSportList() {
        return sportList;
    }

    public void setSportList(CopyOnWriteArrayList<SportInterest> sportList) {
        this.sportList = sportList;
    }

    public FacBankModel getUserBankDetails() {
        return userBankDetails;
    }

    public void setUserBankDetails(FacBankModel userBankDetails) {
        this.userBankDetails = userBankDetails;
    }

    public CopyOnWriteArrayList<Amenity> getAmenities() {
        return amenities;
    }

    public void setAmenities(CopyOnWriteArrayList<Amenity> amenities) {
        this.amenities = amenities;
    }

    public CopyOnWriteArrayList<Sport> getSports() {
        return sports;
    }

    public void setSports(CopyOnWriteArrayList<Sport> sports) {
        this.sports = sports;
    }

    public CopyOnWriteArrayList<FacAmenity> getMyAmenities() {
        return myAmenities;
    }

    public void setMyAmenities(CopyOnWriteArrayList<FacAmenity> myAmenities) {
        this.myAmenities = myAmenities;
    }

    public CopyOnWriteArrayList<Facility> getFacilities() {
        return facilities;
    }

    public void setFacilities(CopyOnWriteArrayList<Facility> facilities) {
        this.facilities = facilities;
    }

    public CopyOnWriteArrayList<FacReward> getRewards() {
        return rewards;
    }

    public void setRewards(CopyOnWriteArrayList<FacReward> rewards) {
        this.rewards = rewards;
    }

    public CopyOnWriteArrayList<BatchSlotType> getBatchSlotTypes() {
        return batchSlotTypes;
    }

    public void setBatchSlotTypes(CopyOnWriteArrayList<BatchSlotType> batchSlotTypes) {
        this.batchSlotTypes = batchSlotTypes;
    }

    public CopyOnWriteArrayList<BatchPackage> getBatchPackages() {
        return batchPackages;
    }

    public void setBatchPackages(CopyOnWriteArrayList<BatchPackage> batchPackages) {
        this.batchPackages = batchPackages;
    }

    private CopyOnWriteArrayList<FacAmenity> handleMyAmenities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<FacAmenity> amenities = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            amenities.add(new FacAmenity(jsonArray.getJSONObject(i)));
        }
        return amenities;
    }

    private CopyOnWriteArrayList<Facility> handleFacilities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<Facility> facilities = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            facilities.add(new Facility(jsonArray.getJSONObject(i)));
        }
        return facilities;
    }

    private CopyOnWriteArrayList<Sport> handleSportList(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<Sport> masterSports = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            masterSports.add(new Sport(jsonArray.getJSONObject(i)));
        }
        return masterSports;
    }

	private CopyOnWriteArrayList<FacDayTime> handlefacDayTime(JSONArray jsonArray) throws JSONException {
		CopyOnWriteArrayList<FacDayTime> masterSports = new CopyOnWriteArrayList<>();
		for (int i = 0; i < jsonArray.length(); i++) {
			masterSports.add(new FacDayTime(jsonArray.getJSONObject(i)));
		}
		return masterSports;
	}

    private CopyOnWriteArrayList<Amenity> handleAmenityList(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<Amenity> masterAmenities = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            masterAmenities.add(new Amenity(jsonArray.getJSONObject(i)));
        }
        return masterAmenities;
    }

    private CopyOnWriteArrayList<FacReward> handleRewardList(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<FacReward> masterReward = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            masterReward.add(new FacReward(jsonArray.getJSONObject(i)));
        }
        return masterReward;
    }

    public DashboardData getDashData() {
        return dashData;
    }

    public void setDashData(DashboardData dashData) {
        this.dashData = dashData;
    }

    public UserDashBoard getUserDashBoardData() {
        return userDashBoardData;
    }

    public void setUserDashBoardData(UserDashBoard userDashBoardData) {
        this.userDashBoardData = userDashBoardData;
    }

    public UserFacAca getUserFacAcaData() {
        return userFacAcaData;
    }

    public void setUserFacAcaData(UserFacAca userFacAcaData) {
        this.userFacAcaData = userFacAcaData;
    }


    public int getProfileStatus() {
        return profileStatus;
    }

    public void setProfileStatus(int profileStatus) {
        this.profileStatus = profileStatus;
    }

    public int getNotificationCount() {
        return notificationCount;
    }

    public void setNotificationCount(int notificationCount) {
        this.notificationCount = notificationCount;
    }

    public int getEmailAlertCount() {
        return emailAlertCount;
    }

    public void setEmailAlertCount(int emailAlertCount) {
        this.emailAlertCount = emailAlertCount;
    }
}
