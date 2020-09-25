package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;
import com.socialsportz.Utils.Utils;

import org.json.JSONObject;

import java.io.Serializable;

public class EmailAlerts extends BaseModel implements Serializable {
    private int id,userId;
    private String title, msg,activity, time;

    public EmailAlerts(JSONObject jsonResponse){
        this.id = Integer.valueOf(getValue(jsonResponse,kEmailNotificationId,String.class));
        this.userId = Integer.valueOf(getValue(jsonResponse,kUserId,String.class));
        this.title = getValue(jsonResponse,kEmailNotificationTitle,String.class);
        this.msg = getValue(jsonResponse,kEmailNotificationMsg,String.class);
        this.activity = getValue(jsonResponse,kEmailNotificationActivity,String.class);
        this.time = Utils.changeDateTimeFormat(getValue(jsonResponse, kCreatedOn,String.class));
    }

    public EmailAlerts(int id, String title, String msg, String time) {
        this.id = id;
        this.title = title;
        this.msg = msg;
        this.time = time;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getMsg() {
        return msg;
    }

    public void setMsg(String msg) {
        this.msg = msg;
    }

    public String getActivity() {
        return activity;
    }

    public void setActivity(String activity) {
        this.activity = activity;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }
}
