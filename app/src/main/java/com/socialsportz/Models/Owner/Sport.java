package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class Sport extends BaseModel implements Serializable {
    private int sportId;
    private String sportName;
    private String sportIcon;
    private String sportImg;
    private String sportDate;
    private String folderName;

    public Sport(JSONObject jsonResponse){
        this.sportId = Integer.valueOf(getValue(jsonResponse,kSportId,String.class));
        this.sportName = getValue(jsonResponse,kSportName,String.class);
        if(jsonResponse.has(kSportIcon))
            this.sportIcon = getValue(jsonResponse,kSportIcon,String.class);
        if(jsonResponse.has(kSportImage))
            this.sportImg = getValue(jsonResponse,kSportImage,String.class);
        this.folderName = getValue(jsonResponse,kFolderName,String.class);
    }

    public Sport(int id, String name, String path){
        this.sportId = id;
        this.sportName = name;
        this.sportIcon = path;
    }

    public Sport(int id, String name){
        this.sportId = id;
        this.sportName = name;
    }

    public int getSportId() {
        return sportId;
    }

    public void setSportId(int sportId) {
        this.sportId = sportId;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public String getSportIcon() {
        return sportIcon;
    }

    public void setSportIcon(String sportIcon) {
        this.sportIcon = sportIcon;
    }

    public String getSportImg() {
        return sportImg;
    }

    public void setSportImg(String sportImg) {
        this.sportImg = sportImg;
    }

    public String getSportDate() {
        return sportDate;
    }

    public void setSportDate(String sportDate) {
        this.sportDate = sportDate;
    }

    public String getFolderName() {
        return folderName;
    }

    public void setFolderName(String folderName) {
        this.folderName = folderName;
    }
}
