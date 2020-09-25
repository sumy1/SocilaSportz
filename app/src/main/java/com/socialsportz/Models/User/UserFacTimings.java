package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserFacTimings extends BaseModel implements Serializable {

    private String day,openTime,closeTime;

    public UserFacTimings(JSONObject jsonObject){
        this.day = getValue(jsonObject,kFacDayName,String.class);
        this.openTime = getValue(jsonObject,kFacOpenTime,String.class);
        this.closeTime = getValue(jsonObject,kFacCloseTime,String.class);
    }

    public String getDay() {
        return day;
    }

    public void setDay(String day) {
        this.day = day;
    }

    public String getOpenTime() {
        return openTime;
    }

    public void setOpenTime(String openTime) {
        this.openTime = openTime;
    }

    public String getCloseTime() {
        return closeTime;
    }

    public void setCloseTime(String closeTime) {
        this.closeTime = closeTime;
    }
}
