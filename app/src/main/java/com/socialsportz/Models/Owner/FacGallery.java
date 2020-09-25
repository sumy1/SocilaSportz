package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class FacGallery extends BaseModel implements Serializable {

    private int galleryId;
    private int facId;
    private String galleryType;
    private String galleryCaption;
    private String galleryImg;
    private String galleryStatus;
    private String folderName;

    public FacGallery(JSONObject jsonResponse){
        this.galleryId = Integer.valueOf(getValue(jsonResponse,kGalleryId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResponse,kFacId,String.class));
        this.galleryType = getValue(jsonResponse,kGalleryType,String.class);
        this.galleryCaption = getValue(jsonResponse,kImageCaption,String.class);
        this.galleryImg = getValue(jsonResponse,kGalleryImage,String.class);
        this.galleryStatus = getValue(jsonResponse,kGalleryStatus,String.class);
        this.folderName = getValue(jsonResponse,kFolderName,String.class);
    }

    public FacGallery( int facId, String galleryCaption, String galleryImg, String galleryStatus) {
        this.facId = facId;
        this.galleryCaption = galleryCaption;
        this.galleryImg = galleryImg;
        this.galleryStatus = galleryStatus;
    }


    public int getGalleryId() {
        return galleryId;
    }

    public void setGalleryId(int galleryId) {
        this.galleryId = galleryId;
    }

    public int getFacId() {
        return facId;
    }

    public void setFacId(int facId) {
        this.facId = facId;
    }

    public String getGalleryType() {
        return galleryType;
    }

    public void setGalleryType(String galleryType) {
        this.galleryType = galleryType;
    }

    public String getGalleryCaption() {
        return galleryCaption;
    }

    public void setGalleryCaption(String galleryCaption) {
        this.galleryCaption = galleryCaption;
    }

    public String getGalleryImg() {
        return galleryImg;
    }

    public void setGalleryImg(String galleryImg) {
        this.galleryImg = galleryImg;
    }

    public String getGalleryStatus() {
        return galleryStatus;
    }

    public void setGalleryStatus(String galleryStatus) {
        this.galleryStatus = galleryStatus;
    }

    public String getFolderName() {
        return folderName;
    }

    public void setFolderName(String folderName) {
        this.folderName = folderName;
    }
}
