package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class Amenity extends BaseModel implements Serializable {

    private int amenityId;
    private String amenityName;
    private String amenityIcon;
    private int amenityImage;
    private String amenityDesc;
    private String amenityDate;
    private boolean status;
    private String folderName;

    public Amenity(JSONObject jsonResponse){
        this.amenityId = Integer.valueOf(getValue(jsonResponse,kAmenityId,String.class));
        this.amenityName = getValue(jsonResponse,kAmenityName,String.class);
        this.amenityIcon = getValue(jsonResponse,kAmenityIcon,String.class);
        this.folderName = getValue(jsonResponse,kFolderName,String.class);
    }

    public Amenity(int amenityId, String amenityName) {
        this.amenityId = amenityId;
        this.amenityName = amenityName;
    }

    public Amenity(int amenityId, String amenityName,String amenityImage) {
        this.amenityId = amenityId;
        this.amenityName = amenityName;
        this.amenityIcon = amenityImage;
    }

    public int getAmenityId() {
        return amenityId;
    }

    public void setAmenityId(int amenityId) {
        this.amenityId = amenityId;
    }

    public String getAmenityName() {
        return amenityName;
    }

    public void setAmenityName(String amenityName) {
        this.amenityName = amenityName;
    }

    public Integer getAmenityImage() {
        return amenityImage;
    }

    public void setAmenityImage(Integer amenityImage) {
        this.amenityImage = amenityImage;
    }

    public String getAmenityDesc() {
        return amenityDesc;
    }

    public void setAmenityDesc(String amenityDesc) {
        this.amenityDesc = amenityDesc;
    }

    public String getAmenityDate() {
        return amenityDate;
    }

    public void setAmenityDate(String amenityDate) {
        this.amenityDate = amenityDate;
    }

    public String getAmenityIcon() {
        return amenityIcon;
    }

    public void setAmenityIcon(String amenityIcon) {
        this.amenityIcon = amenityIcon;
    }

    public void setAmenityImage(int amenityImage) {
        this.amenityImage = amenityImage;
    }

    public boolean isStatus() {
        return status;
    }

    public void setStatus(boolean status) {
        this.status = status;
    }

    public String getFolderName() {
        return folderName;
    }

    public void setFolderName(String folderName) {
        this.folderName = folderName;
    }
}
