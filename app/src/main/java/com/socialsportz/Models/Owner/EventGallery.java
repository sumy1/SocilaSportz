package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class EventGallery extends BaseModel implements Serializable {

    private String galleryImg;

    public EventGallery(JSONObject jsonResponse){
        this.galleryImg = getValue(jsonResponse,kImage,String.class);
    }

    public EventGallery(String image){
        this.galleryImg = image;
    }

    public String getGalleryImg() {
        return galleryImg;
    }

    public void setGalleryImg(String galleryImg) {
        this.galleryImg = galleryImg;
    }
}
