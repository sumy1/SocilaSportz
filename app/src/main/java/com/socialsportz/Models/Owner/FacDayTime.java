package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class FacDayTime extends BaseModel implements Serializable {
    private int dayId;
    private String dayName;
    private int dayStatus;
    private String dayOpenTime;
    private String dayCloseTime;

    public FacDayTime (JSONObject jsonResponse){
        this.dayId = Integer.valueOf(getValue(jsonResponse, kFacTimingId, String.class));
        this.dayName = getValue(jsonResponse, kFacDayName, String.class);
        this.dayStatus = Integer.valueOf(getValue(jsonResponse, kFacDayStatus, String.class));
        this.dayOpenTime = getValue(jsonResponse, kFacOpenTime, String.class);
        this.dayCloseTime = getValue(jsonResponse, kFacCloseTime, String.class);
    }

    /*public FacDayTime(int dayId, String dayName,int dayStatus){
        this.dayId = dayId;
        this.dayName = dayName;
        this.dayStatus = dayStatus;
    }*/

    public FacDayTime(int dayId, String dayName,int dayStatus, String dayOpenTime, String dayCloseTime) {
        this.dayId = dayId;
        this.dayName = dayName;
        this.dayStatus = dayStatus;
        this.dayOpenTime = dayOpenTime;
        this.dayCloseTime = dayCloseTime;
    }

    public int getDayId() {
        return dayId;
    }

    public void setDayId(int dayId) {
        this.dayId = dayId;
    }

    public String getDayName() {
        return dayName;
    }

    public void setDayName(String dayName) {
        this.dayName = dayName;
    }

    public int getDayStatus() {
        return dayStatus;
    }

    public void setDayStatus(int dayStatus) {
        this.dayStatus = dayStatus;
    }

    public String getDayOpenTime() {
        return dayOpenTime;
    }

    public void setDayOpenTime(String dayOpenTime) {
        this.dayOpenTime = dayOpenTime;
    }

    public String getDayCloseTime() {
        return dayCloseTime;
    }

    public void setDayCloseTime(String dayCloseTime) {
        this.dayCloseTime = dayCloseTime;
    }
}
