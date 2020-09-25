package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserEnquire extends BaseModel implements Serializable {

    private String facId;
    private String queryTitle;
    private String quiryMessage;
    private String createdOn;
    private String facName;

    public UserEnquire(JSONObject jsonObject){
        this.facId=getValue(jsonObject,kFacId,String.class);
        this.queryTitle=getValue(jsonObject,kQuireTitle,String.class);
        this.quiryMessage=getValue(jsonObject,kQuireMessage,String.class);
        this.createdOn=getValue(jsonObject,kCreateOn,String.class);
        this.facName=getValue(jsonObject,kFacName,String.class);

    }

    public String getFacId() {
        return facId;
    }

    public void setFacId(String facId) {
        this.facId = facId;
    }

    public String getQueryTitle() {
        return queryTitle;
    }

    public void setQueryTitle(String queryTitle) {
        this.queryTitle = queryTitle;
    }

    public String getQuiryMessage() {
        return quiryMessage;
    }

    public void setQuiryMessage(String quiryMessage) {
        this.quiryMessage = quiryMessage;
    }

    public String getCreatedOn() {
        return createdOn;
    }

    public void setCreatedOn(String createdOn) {
        this.createdOn = createdOn;
    }

    public String getFacName() {
        return facName;
    }

    public void setFacName(String facName) {
        this.facName = facName;
    }



}
