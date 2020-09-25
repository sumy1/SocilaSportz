package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserFacViewGallery extends BaseModel implements Serializable {

    private String galleryImg;
    private String folderName;

    public UserFacViewGallery(JSONObject jsonResponse){

        if(jsonResponse.has(kGalleryImage))
            this.galleryImg = getValue(jsonResponse,kGalleryImage,String.class);
        this.folderName = getValue(jsonResponse,kFolderName,String.class);
    }

    public String getGalleryImg() {
        return galleryImg;
    }

    public void setGalleryImg(String galleryImg) {
        this.galleryImg = galleryImg;
    }



    public String getFolderName() {
        return folderName;
    }

    public void setFolderName(String folderName) {
        this.folderName = folderName;
    }

}
