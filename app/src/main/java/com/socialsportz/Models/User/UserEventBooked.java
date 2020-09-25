package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserEventBooked extends BaseModel implements Serializable {



    public  UserEventBooked(JSONObject jsonObject){
        try {
            this.bookingEventList = handleAmenities(getValue(jsonObject,kEventBookList,JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }



    public CopyOnWriteArrayList<UserEventBookedItemList> getBookingEventList() {
        return bookingEventList;
    }

    public void setBookingEventList(CopyOnWriteArrayList<UserEventBookedItemList> bookingEventList) {
        this.bookingEventList = bookingEventList;
    }

    private CopyOnWriteArrayList<UserEventBookedItemList>bookingEventList;


    private CopyOnWriteArrayList<UserEventBookedItemList> handleAmenities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<UserEventBookedItemList> galleries = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            galleries.add(new UserEventBookedItemList(jsonArray.getJSONObject(i)));
        }
        return galleries;
    }
}
