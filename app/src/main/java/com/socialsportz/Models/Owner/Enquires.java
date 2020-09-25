package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;
import com.socialsportz.Utils.Utils;

import org.json.JSONObject;

import java.io.Serializable;

public class Enquires extends BaseModel implements Serializable {

    private int id,facId,userId;
    private String profile_img,user_name,user_mobile,user_email,title,message,date,status,approcve;

    public Enquires(JSONObject jsonResponse){
        this.id = Integer.valueOf(getValue(jsonResponse,kEnquiryId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResponse,kFacId,String.class));
        //this.userId = Integer.valueOf(getValue(jsonResponse,kUserId,String.class));
        this.user_name = getValue(jsonResponse,kUserName,String.class);
        this.user_mobile = getValue(jsonResponse,kMobile,String.class);
        this.user_email = getValue(jsonResponse,kEmail,String.class);
        this.title = getValue(jsonResponse,kEnquiryTitle,String.class);
        this.message = getValue(jsonResponse,kEnquiryMessage,String.class);
        this.status = getValue(jsonResponse,kEnquiryStatus,String.class);
        this.approcve = getValue(jsonResponse, kEnquiryApprove,String.class);
        this.date = Utils.changeDateTimeFormat(getValue(jsonResponse, kCreateOn,String.class));
    }

    public Enquires(int id, String user_name, String user_mobile, String user_email, String message, String date) {
        this.id = id;
        this.user_name = user_name;
        this.user_mobile = user_mobile;
        this.user_email = user_email;
        this.message = message;
        this.date = date;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getFacId() {
        return facId;
    }

    public void setFacId(int facId) {
        this.facId = facId;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public String getProfile_img() {
        return profile_img;
    }

    public void setProfile_img(String profile_img) {
        this.profile_img = profile_img;
    }

    public String getUser_name() {
        return user_name;
    }

    public void setUser_name(String user_name) {
        this.user_name = user_name;
    }

    public String getUser_mobile() {
        return user_mobile;
    }

    public void setUser_mobile(String user_mobile) {
        this.user_mobile = user_mobile;
    }

    public String getUser_email() {
        return user_email;
    }

    public void setUser_email(String user_email) {
        this.user_email = user_email;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getApprocve() {
        return approcve;
    }

    public void setApprocve(String approcve) {
        this.approcve = approcve;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }
}
