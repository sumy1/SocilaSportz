package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class FacAmenity extends BaseModel implements Serializable {

    private int facAmenityId;
    private int amenityId;
    private int facAmenityQty;
    private String facAmenityDesc;
    private String facAmenityDate;

    public FacAmenity(JSONObject jsonResponse ){
        this.facAmenityId = Integer.valueOf(getValue(jsonResponse,kFacAmenityId,String.class));
        this.amenityId = Integer.valueOf(getValue(jsonResponse,kAmenityId,String.class));
        this.facAmenityDesc = getValue(jsonResponse,kFacAmenityDesc,String.class);
        this.facAmenityQty = Integer.valueOf(getValue(jsonResponse,kFacAmenityQty,String.class));
        this.facAmenityDate = getValue(jsonResponse, kCreatedOn,String.class);
    }

    public int getAmenityId() {
        return amenityId;
    }

    public void setAmenityId(int amenityId) {
        this.amenityId = amenityId;
    }

    public int getFacAmenityId() {
        return facAmenityId;
    }

    public void setFacAmenityId(int facAmenityId) {
        this.facAmenityId = facAmenityId;
    }

    public int getFacAmenityQty() {
        return facAmenityQty;
    }

    public void setFacAmenityQty(int facAmenityQty) {
        this.facAmenityQty = facAmenityQty;
    }

    public String getFacAmenityDesc() {
        return facAmenityDesc;
    }

    public void setFacAmenityDesc(String facAmenityDesc) {
        this.facAmenityDesc = facAmenityDesc;
    }

    public String getFacAmenityDate() {
        return facAmenityDate;
    }

    public void setFacAmenityDate(String facAmenityDate) {
        this.facAmenityDate = facAmenityDate;
    }
}
