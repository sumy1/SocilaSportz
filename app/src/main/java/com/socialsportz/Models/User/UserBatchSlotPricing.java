package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserBatchSlotPricing extends BaseModel implements Serializable {


    private String slotPacpriceId;
    private String batchSId;
    private String pacId;
    private String slotpacPrice;
    private String createdOn;


    public UserBatchSlotPricing(JSONObject jsonObject){
        this.slotPacpriceId=getValue(jsonObject,kPriceId,String.class);
        this.batchSId=getValue(jsonObject,kBatchSlotId,String.class);
        this.pacId=getValue(jsonObject,kPackageId,String.class);
        this.slotpacPrice=getValue(jsonObject,kPriceNo,String.class);
        this.createdOn=getValue(jsonObject,kCreatedOn,String.class);
    }

	public UserBatchSlotPricing(String id, String type, String price) {
		this.slotPacpriceId = id;
		this.pacId = type;
		this.slotpacPrice = price;
	}

    public String getSlotPacId() {
        return slotPacpriceId;
    }

    public void setSlotPacId(String slotPacpriceId) {
        this.slotPacpriceId = slotPacpriceId;
    }

    public String getBatchSId() {
        return batchSId;
    }

    public void setBatchSId(String batchSId) {
        this.batchSId = batchSId;
    }

    public String getPacId() {
        return pacId;
    }

    public void setPacId(String pacId) {
        this.pacId = pacId;
    }

    public String getSlotpacPrice() {
        return slotpacPrice;
    }

    public void setSlotpacPrice(String slotpacPrice) {
        this.slotpacPrice = slotpacPrice;
    }

    public String getCreatedOn() {
        return createdOn;
    }

    public void setCreatedOn(String createdOn) {
        this.createdOn = createdOn;
    }


}
