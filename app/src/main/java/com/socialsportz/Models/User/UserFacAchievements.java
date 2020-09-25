package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserFacAchievements extends BaseModel implements Serializable {

    private String facRewardTitle;
    private String facRewardName;
    private String facAchieveImg1;
    private String facAchieveImg2;
    private String facFolder;

    public UserFacAchievements(JSONObject jsonResponse){
        this.facRewardTitle = getValue(jsonResponse,kRewardTitle,String.class);
        this.facRewardName = getValue(jsonResponse,kRewardName,String.class);
        this.facAchieveImg1 = getValue(jsonResponse,kImage1,String.class);
        this.facAchieveImg2 = getValue(jsonResponse,kImage2,String.class);
        this.facFolder = getValue(jsonResponse,kFolderName,String.class);
    }

    public String getFacRewardTitle() {
        return facRewardTitle;
    }

    public void setFacRewardTitle(String facRewardTitle) {
        this.facRewardTitle = facRewardTitle;
    }

    public String getFacRewardName() {
        return facRewardName;
    }

    public void setFacRewardName(String facRewardName) {
        this.facRewardName = facRewardName;
    }

    public String getFacAchieveImg1() {
        return facAchieveImg1;
    }

    public void setFacAchieveImg1(String facAchieveImg1) {
        this.facAchieveImg1 = facAchieveImg1;
    }

    public String getFacAchieveImg2() {
        return facAchieveImg2;
    }

    public void setFacAchieveImg2(String facAchieveImg2) {
        this.facAchieveImg2 = facAchieveImg2;
    }

    public String getFacFolder() {
        return facFolder;
    }

    public void setFacFolder(String facFolder) {
        this.facFolder = facFolder;
    }
}
