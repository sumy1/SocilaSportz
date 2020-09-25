package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserFacEventAmenities extends BaseModel implements Serializable {
    private int amenityid;
    private String amenityName;

    public UserFacEventAmenities(JSONObject jsonObject){
        this.amenityid = Integer.valueOf(getValue(jsonObject,kAmenityId,String.class));
    }

    public int getAmenityid() {
        return amenityid;
    }

    public void setAmenityid(int amenityid) {
        this.amenityid = amenityid;
    }
}
