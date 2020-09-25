package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserNotification extends BaseModel implements Serializable {


    public UserNotification(JSONObject jsonObject){
        this.activity_time=getValue(jsonObject,kActivityTime,String.class);
        this.description=getValue(jsonObject,kDescription,String.class);
        this.userId=getValue(jsonObject,kUserId,String.class);
        this.activity_time=getValue(jsonObject,kActivityTime,String.class);
        this.fac_name=getValue(jsonObject,kFacName,String.class);
        this.sport_name=getValue(jsonObject,kSportName,String.class);
        this.historyId=getValue(jsonObject,kHistoryId,String.class);

    }


    public String getHistoryId() {
        return historyId;
    }

    public void setHistoryId(String historyId) {
        this.historyId = historyId;
    }

    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getFac_name() {
        return fac_name;
    }

    public void setFac_name(String fac_name) {
        this.fac_name = fac_name;
    }

    public String getSport_name() {
        return sport_name;
    }

    public void setSport_name(String sport_name) {
        this.sport_name = sport_name;
    }

    public String getActivity_time() {
        return activity_time;
    }

    public void setActivity_time(String activity_time) {
        this.activity_time = activity_time;
    }

    private String historyId;
    private String userId;
    private String description;
    private String fac_name;
    private String sport_name;
    private String activity_time;


}
