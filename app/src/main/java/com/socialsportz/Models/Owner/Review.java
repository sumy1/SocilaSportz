package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class Review extends BaseModel implements Serializable {
    private int rev_id,rate_id;
    private String rev_msg;
    private boolean status;

    public Review(JSONObject jsonResponse){
        this.rate_id = Integer.valueOf(getValue(jsonResponse,kRatingId,String.class));
        this.rev_id = Integer.valueOf(getValue(jsonResponse,kReviewId,String.class));
        this.rev_msg =getValue(jsonResponse,kReviewMsg,String.class);
    }

    public Review(int rev_id, int rate_id, String rev_msg,boolean status) {
        this.rev_id = rev_id;
        this.rate_id = rate_id;
        this.rev_msg = rev_msg;
        this.status=status;
    }

    public int getRev_id() {
        return rev_id;
    }

    public void setRev_id(int rev_id) {
        this.rev_id = rev_id;
    }

    public int getRate_id() {
        return rate_id;
    }

    public void setRate_id(int rate_id) {
        this.rate_id = rate_id;
    }

    public String getRev_msg() {
        return rev_msg;
    }

    public void setRev_msg(String rev_msg) {
        this.rev_msg = rev_msg;
    }

    public boolean isStatus() {
        return status;
    }

    public void setStatus(boolean status) {
        this.status = status;
    }
}
