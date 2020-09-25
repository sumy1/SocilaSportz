package com.socialsportz.Models.User;

import com.socialsportz.Constants.Constants;
import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserAddcart extends BaseModel implements Serializable {


    public String getFacId() {
        return facId;
    }

    public void setFacId(String facId) {
        this.facId = facId;
    }

    public String getSportId() {
        return sportId;
    }

    public void setSportId(String sportId) {
        this.sportId = sportId;
    }

    public String getPackageId() {
        return packageId;
    }

    public void setPackageId(String packageId) {
        this.packageId = packageId;
    }

    public String getPackageName() {
        return packageName;
    }

    public void setPackageName(String packageName) {
        this.packageName = packageName;
    }

    public String getBatchSlotId() {
        return batchSlotId;
    }

    public void setBatchSlotId(String batchSlotId) {
        this.batchSlotId = batchSlotId;
    }

    public String getStartTime() {
        return startTime;
    }

    public void setStartTime(String startTime) {
        this.startTime = startTime;
    }

    public String getEndTime() {
        return endTime;
    }

    public void setEndTime(String endTime) {
        this.endTime = endTime;
    }

    public String getBookDate() {
        return bookDate;
    }

    public void setBookDate(String bookDate) {
        this.bookDate = bookDate;
    }

    public String getIsTrial() {
        return isTrial;
    }

    public void setIsTrial(String isTrial) {
        this.isTrial = isTrial;
    }

    public String getIsKit() {
        return isKit;
    }

    public void setIsKit(String isKit) {
        this.isKit = isKit;
    }

    public String getSlotPacPrice() {
        return slotPacPrice;
    }

    public void setSlotPacPrice(String slotPacPrice) {
        this.slotPacPrice = slotPacPrice;
    }

    public String getSportType() {
        return sportType;
    }

    public void setSportType(String sportType) {
        this.sportType = sportType;
    }

    public String getAddedOn() {
        return addedOn;
    }

    public void setAddedOn(String addedOn) {
        this.addedOn = addedOn;
    }

    public String getCardId() {
        return cardId;
    }

    public void setCardId(String cardId) {
        this.cardId = cardId;
    }

    public String getUserId() {
        return UserId;
    }

    public void setUserId(String userId) {
        UserId = userId;
    }

    public String getSessionId() {
        return sessionId;
    }

    public void setSessionId(String sessionId) {
        this.sessionId = sessionId;
    }

    private String facId;
    private String sportId;
    private String packageId;
    private String packageName;
    private String batchSlotId;
    private String startTime;
    private String endTime;
    private String bookDate;
    private String isTrial;
    private String isKit;
    private String slotPacPrice;
    private String sportType;
    private String addedOn;
    private String cardId;
    private String UserId;
    private String sessionId;

	public String getBatchSlotTyeTitle() {
		return batchSlotTyeTitle;
	}

	public void setBatchSlotTyeTitle(String batchSlotTyeTitle) {
		this.batchSlotTyeTitle = batchSlotTyeTitle;
	}

	private String batchSlotTyeTitle;

	public String getSlotAvailable() {
		return slotAvailable;
	}

	public void setSlotAvailable(String slotAvailable) {
		this.slotAvailable = slotAvailable;
	}

	private String slotAvailable;



    public UserAddcart(JSONObject jsonObject){
        this.facId = getValue(jsonObject,kFacId,String.class);
        this.sportId = getValue(jsonObject,kSportId,String.class);
        this.sportType = getValue(jsonObject,kSportType,String.class);
        this.packageId = getValue(jsonObject,kPackageId,String.class);
        this.batchSlotId = getValue(jsonObject,kBatchSlotId,String.class);
        this.startTime = getValue(jsonObject,kStartTime,String.class);
        this.endTime = getValue(jsonObject,kEndTime,String.class);
        this.bookDate = getValue(jsonObject,kBookDate,String.class);
        this.isTrial = getValue(jsonObject, Constants.kTrialBookingg,String.class);
        this.isKit = getValue(jsonObject,kIsKit,String.class);
        this.slotPacPrice = getValue(jsonObject,kPriceNo,String.class);
        this.addedOn=  getValue(jsonObject,kAddedOn,String.class);
        this.cardId = getValue(jsonObject,kCartId,String.class);
        this.UserId=getValue(jsonObject,kUserId,String.class);
        this.packageName=getValue(jsonObject,kPackageName,String.class);
        this.sessionId=getValue(jsonObject,kSessionId,String.class);
        this.batchSlotTyeTitle=getValue(jsonObject,kbatchSloTypeTitle,String.class);
        this.slotAvailable=getValue(jsonObject,kslotAvailable,String.class);
    }


}
