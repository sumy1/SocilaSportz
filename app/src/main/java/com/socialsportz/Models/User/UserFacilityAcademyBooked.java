package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserFacilityAcademyBooked extends BaseModel implements Serializable {



    public UserFacilityAcademyBooked(JSONObject jsonObject){
        try {
            this.bookingfacilityAcademyList = handleAmenities(getValue(jsonObject,kFacilityAcademyBooklIst,JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }


    public CopyOnWriteArrayList<FacilityAcademyBookListItem> getBookingfacilityAcademyList() {
        return bookingfacilityAcademyList;
    }

    public void setBookingfacilityAcademyList(CopyOnWriteArrayList<FacilityAcademyBookListItem> bookingfacilityAcademyList) {
        this.bookingfacilityAcademyList = bookingfacilityAcademyList;
    }

    private CopyOnWriteArrayList<FacilityAcademyBookListItem>bookingfacilityAcademyList;


    private CopyOnWriteArrayList<FacilityAcademyBookListItem> handleAmenities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<FacilityAcademyBookListItem> galleries = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            galleries.add(new FacilityAcademyBookListItem(jsonArray.getJSONObject(i)));
        }
        return galleries;
    }
}
