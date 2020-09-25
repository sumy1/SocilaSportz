package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserEventViewGallery extends BaseModel implements Serializable {

    private String galleryImg;
    private String folderName;

    public UserEventViewGallery(JSONObject jsonResponse){

        if(jsonResponse.has(kEventGalleryImage)){
			this.galleryImg = getValue(jsonResponse,kEventGalleryImage,String.class);
		}else{
			this.galleryImg = getValue(jsonResponse,kGalleryImage,String.class);
		}

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
