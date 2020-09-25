package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class Facility extends BaseModel implements Serializable {

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
    private CopyOnWriteArrayList<FacDayTime> facTimingList;
    private CopyOnWriteArrayList<FacAchievement> achieveList;
    private CopyOnWriteArrayList<FacSport> facSportList;
    private CopyOnWriteArrayList<FacGallery> galleryList;
    private CopyOnWriteArrayList<BatchPackage> packages;

    public Facility(JSONObject jsonResponse) {
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
        try {
            if(jsonResponse.has(kFacTimeListing))
                this.facTimingList = handleFacTimings(getValue(jsonResponse, kFacTimeListing, JSONArray.class));
            else
                this.facTimingList = new CopyOnWriteArrayList<>();

            if(jsonResponse.has(kRewardList))
                this.achieveList = handleFacAchieve(getValue(jsonResponse, kRewardList, JSONArray.class));
            else
                this.achieveList = new CopyOnWriteArrayList<>();

            if(jsonResponse.has(kFacSportList))
                this.facSportList = handleFacSports(getValue(jsonResponse, kFacSportList, JSONArray.class));
            else
                this.facSportList = new CopyOnWriteArrayList<>();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void setData(JSONObject jsonResponse) {
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
    }

    private CopyOnWriteArrayList<FacDayTime> handleFacTimings(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<FacDayTime> facDayTimings = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            facDayTimings.add(new FacDayTime(jsonArray.getJSONObject(i)));
        }
        return facDayTimings;
    }

    private CopyOnWriteArrayList<FacAchievement> handleFacAchieve(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<FacAchievement> facAchieves = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            facAchieves.add(new FacAchievement(jsonArray.getJSONObject(i)));
        }
        return facAchieves;
    }

    private CopyOnWriteArrayList<FacSport> handleFacSports(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<FacSport> facSports = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            facSports.add(new FacSport(jsonArray.getJSONObject(i)));
        }
        return facSports;
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

    public String getFacName() {
        return facName;
    }

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

    public CopyOnWriteArrayList<FacDayTime> getFacTimingList() {
        return facTimingList;
    }

    public void setFacTimingList(CopyOnWriteArrayList<FacDayTime> facTimingList) {
        this.facTimingList = facTimingList;
    }

    public CopyOnWriteArrayList<FacAchievement> getAchieveList() {
        return achieveList;
    }

    public void setAchieveList(CopyOnWriteArrayList<FacAchievement> achieveList) {
        this.achieveList = achieveList;
    }

    public CopyOnWriteArrayList<FacSport> getFacSportList() {
        return facSportList;
    }

    public void setFacSportList(CopyOnWriteArrayList<FacSport> facSportList) {
        this.facSportList = facSportList;
    }

    public CopyOnWriteArrayList<FacGallery> getGalleryList() {
        return galleryList;
    }

    public void setGalleryList(CopyOnWriteArrayList<FacGallery> galleryList) {
        this.galleryList = galleryList;
    }

    public CopyOnWriteArrayList<BatchPackage> getPackages() {
        return packages;
    }

    public void setPackages(CopyOnWriteArrayList<BatchPackage> packages) {
        this.packages = packages;
    }

    public String getFacFolder() {
        return facFolder;
    }

    public void setFacFolder(String facFolder) {
        this.facFolder = facFolder;
    }
}
