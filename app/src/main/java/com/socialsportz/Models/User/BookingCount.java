package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class BookingCount extends BaseModel implements Serializable {


    private int myBooking;
    private int eventBooking;
    private int myEnquiry;
    private int notifications;
    private int myReviews;

    public BookingCount(JSONObject  jsonObject){
        this.myBooking=getValue(jsonObject,kMyBooking,Integer.class);
        this.eventBooking=getValue(jsonObject,kEventBookin,Integer.class);
        this.myEnquiry=getValue(jsonObject,kMyEnquiry,Integer.class);
        this.notifications=getValue(jsonObject,kNotifications,Integer.class);
        this.myReviews=getValue(jsonObject,kMyReviews,Integer.class);

    }

    public int getMyBooking() {
        return myBooking;
    }

    public void setMyBooking(int myBooking) {
        this.myBooking = myBooking;
    }

    public int getEventBooking() {
        return eventBooking;
    }

    public void setEventBooking(int eventBooking) {
        this.eventBooking = eventBooking;
    }

    public int getMyEnquiry() {
        return myEnquiry;
    }

    public void setMyEnquiry(int myEnquiry) {
        this.myEnquiry = myEnquiry;
    }

    public int getNotifications() {
        return notifications;
    }

    public void setNotifications(int notifications) {
        this.notifications = notifications;
    }

    public int getMyReviews() {
        return myReviews;
    }

    public void setMyReviews(int myReviews) {
        this.myReviews = myReviews;
    }



   
   
}
