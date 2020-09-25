package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class BatchSlotWeekOff extends BaseModel implements Serializable {

    private int batchSlotId;
    private int weekOffTypeId;
    private String weekOffDay;
    private int weekOffStatus;

    public BatchSlotWeekOff(JSONObject jsonResponse) {
        this.batchSlotId = Integer.valueOf(getValue(jsonResponse,kBatchSlotId,String.class));
        this.weekOffTypeId = Integer.valueOf(getValue(jsonResponse,kWeekOffId,String.class));
        this.weekOffDay = getValue(jsonResponse,kWeekOffDay,String.class);
        this.weekOffStatus = Integer.valueOf(getValue(jsonResponse,kWeekOffStatus,String.class));
    }

    public BatchSlotWeekOff(int id,String day,int status){
        this.weekOffTypeId = id;
        this.weekOffDay = day;
        this.weekOffStatus = status;
    }

    public int getBatchSlotId() {
        return batchSlotId;
    }

    public void setBatchSlotId(int batchSlotId) {
        this.batchSlotId = batchSlotId;
    }

    public int getWeekOffTypeId() {
        return weekOffTypeId;
    }

    public void setWeekOffTypeId(int weekOffTypeId) {
        this.weekOffTypeId = weekOffTypeId;
    }

    public String getWeekOffDay() {
        return weekOffDay;
    }

    public void setWeekOffDay(String weekOffDay) {
        this.weekOffDay = weekOffDay;
    }

    public int getWeekOffStatus() {
        return weekOffStatus;
    }

    public void setWeekOffStatus(int weekOffStatus) {
        this.weekOffStatus = weekOffStatus;
    }


}
