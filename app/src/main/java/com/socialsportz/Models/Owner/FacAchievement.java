package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class FacAchievement extends BaseModel implements Serializable {

    private int facAchieveId;
    private int facId;
    private String facRewardTitle;
    private int facRewardId;
    private String facRewardName;
    private String facAchieveImg1;
    private String facAchieveImg2;
    private String facAchieveDate;
    private String facFolder;

    public FacAchievement(JSONObject jsonResponse){
        this.facAchieveId = Integer.valueOf(getValue(jsonResponse,kAchieveId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResponse,kFacId,String.class));
        this.facRewardTitle = getValue(jsonResponse,kRewardTitle,String.class);
        this.facRewardId = Integer.valueOf(getValue(jsonResponse,kRewardId,String.class));
        this.facRewardName = getValue(jsonResponse,kRewardName,String.class);
        this.facAchieveImg1 = getValue(jsonResponse,kImage1,String.class);
        this.facAchieveImg2 = getValue(jsonResponse,kImage2,String.class);
        this.facFolder = getValue(jsonResponse,kFolderName,String.class);
        this.facAchieveDate = getValue(jsonResponse, kCreatedOn,String.class);
    }

    public FacAchievement(int facAchieveId, int facId, String facRewardTitle, String facReward, String facAchieveImg1, String facAchieveImg2, String facAchieveDate) {
        this.facAchieveId = facAchieveId;
        this.facId = facId;
        this.facRewardTitle = facRewardTitle;
        this.facRewardName = facReward;
        this.facAchieveImg1 = facAchieveImg1;
        this.facAchieveImg2 = facAchieveImg2;
        this.facAchieveDate = facAchieveDate;
    }

    public int getFacAchieveId() {
        return facAchieveId;
    }

    public void setFacAchieveId(int facAchieveId) {
        this.facAchieveId = facAchieveId;
    }

    public int getFacId() {
        return facId;
    }

    public void setFacId(int facId) {
        this.facId = facId;
    }

    public String getFacRewardTitle() {
        return facRewardTitle;
    }

    public void setFacRewardTitle(String facRewardTitle) {
        this.facRewardTitle = facRewardTitle;
    }

    public int getFacRewardId() {
        return facRewardId;
    }

    public void setFacRewardId(int facRewardId) {
        this.facRewardId = facRewardId;
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

    public String getFacAchieveDate() {
        return facAchieveDate;
    }

    public void setFacAchieveDate(String facAchieveDate) {
        this.facAchieveDate = facAchieveDate;
    }

    public String getFacFolder() {
        return facFolder;
    }

    public void setFacFolder(String facFolder) {
        this.facFolder = facFolder;
    }
}
