package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;

public class UserAmenity extends BaseModel implements Serializable {

    public String getAmenityId() {
        return amenityId;
    }

    public void setAmenityId(String amenityId) {
        this.amenityId = amenityId;
    }

    public String getAmenityName() {
        return amenityName;
    }

    public void setAmenityName(String amenityName) {
        this.amenityName = amenityName;
    }

    public String getAmenityIcon() {
        return amenityIcon;
    }

    public void setAmenityIcon(String amenityIcon) {
        this.amenityIcon = amenityIcon;
    }

    public String getFolderName() {
        return folderName;
    }

    public void setFolderName(String folderName) {
        this.folderName = folderName;
    }

    private String amenityId;
    private String amenityName;
    private String amenityIcon;
    private String folderName;



    public UserAmenity(JSONObject jsonResponse){
        try {
            this.amenityId= jsonResponse.getString(kAmenityId);
        } catch (JSONException e) {
            e.printStackTrace();
        }
       // this.amenityId = jsonResponse,kAmenityId,String.class));
        this.amenityName = getValue(jsonResponse,kAmenityName,String.class);
        this.amenityIcon = getValue(jsonResponse,kAmenityIcon,String.class);
        this.folderName = getValue(jsonResponse,kFolderName,String.class);
    }

    public UserAmenity(String amenityId, String amenityName) {
        this.amenityId = amenityId;
        this.amenityName = amenityName;
    }

    public UserAmenity(String amenityId, String amenityName, String amenityImage) {
        this.amenityId = amenityId;
        this.amenityName = amenityName;
        this.amenityIcon = amenityImage;
    }


}
