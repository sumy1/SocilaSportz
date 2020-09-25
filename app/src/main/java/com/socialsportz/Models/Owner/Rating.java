package com.socialsportz.Models.Owner;

import com.google.gson.JsonArray;
import com.socialsportz.Models.BaseModel;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

public class Rating extends BaseModel implements Serializable {
    private String rate_id,user_id,fac_id,event_id;
    private String user_name,user_email,date,type;
    private float rating;
    private int abuse;
    private String reviewTxt;
    private CopyOnWriteArrayList<Review> recycleReviews;

    public Rating(JSONObject jsonResponse){
        this.rate_id = getValue(jsonResponse,kRatingId,String.class);
        this.user_id = getValue(jsonResponse,kUserId,String.class);
        this.fac_id = getValue(jsonResponse,kFacId,String.class);
        this.event_id = getValue(jsonResponse,kEventId,String.class);
        this.user_name = getValue(jsonResponse,kUserName,String.class);
        this.user_email = getValue(jsonResponse,kEmail,String.class);
        this.type = getValue(jsonResponse,kRatingType,String.class);
        this.abuse = Integer.valueOf(getValue(jsonResponse,kAbuseState,String.class));
        this.rating = Float.valueOf(getValue(jsonResponse,kRating,String.class));
        this.date = Utils.changeDateTimeFormat(getValue(jsonResponse, kCreatedOn,String.class));
         try {
            this.recycleReviews = handleMyReview(getValue(jsonResponse,kReview, JsonArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private CopyOnWriteArrayList<Review> handleMyReview(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<Review> reviews = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            reviews.add(new Review(jsonArray.getJSONObject(i)));
        }
        return reviews;
    }

    public String getRate_id() {
        return rate_id;
    }

    public void setRate_id(String rat_id) {
        this.rate_id = rat_id;
    }

    public String getUser_id() {
        return user_id;
    }

    public void setUser_id(String user_id) {
        this.user_id = user_id;
    }

    public String getFac_id() {
        return fac_id;
    }

    public void setFac_id(String fac_id) {
        this.fac_id = fac_id;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getEvent_id() {
        return event_id;
    }

    public void setEvent_id(String event_id) {
        this.event_id = event_id;
    }


    public String getUser_name() {
        return user_name;
    }

    public void setUser_name(String user_name) {
        this.user_name = user_name;
    }

    public String getUser_email() {
        return user_email;
    }

    public void setUser_email(String user_email) {
        this.user_email = user_email;
    }

    public void setRating(float rating) {
        this.rating = rating;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public Float getRating() {
        return rating;
    }

    public void setRating(Float rating) {
        this.rating = rating;
    }

    public List<Review> getRecycleReviews() {
        return recycleReviews;
    }

    public void setRecycleReviews(CopyOnWriteArrayList<Review> recycleReviews) {
        this.recycleReviews = recycleReviews;
    }

    public String getReviewTxt() {
        return reviewTxt;
    }

    public void setReviewTxt(String reviewTxt) {
        this.reviewTxt = reviewTxt;
    }

    public int getAbuse() {
        return abuse;
    }

    public void setAbuse(int abuse) {
        this.abuse = abuse;
    }
}
