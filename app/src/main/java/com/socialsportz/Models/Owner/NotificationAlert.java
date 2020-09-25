package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;
import com.socialsportz.Utils.Utils;

import org.json.JSONObject;

import java.io.Serializable;

public class NotificationAlert extends BaseModel implements Serializable {
    private int id,facId;
    private String bookingId, title, msg, time,bookingEmail;

    public NotificationAlert(JSONObject jsonResponse){
        this.id = Integer.valueOf(getValue(jsonResponse,kNotificationId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResponse,kFacId,String.class));
        this.title = getValue(jsonResponse,kNotificationTitle,String.class);
        this.msg = getValue(jsonResponse,kNotificationMessage,String.class);
        this.bookingId = getValue(jsonResponse,kNotBookingId,String.class);
        this.bookingEmail = getValue(jsonResponse,kNotBookingEmail,String.class);
        this.time = Utils.changeDateTimeFormat(getValue(jsonResponse, kCreatedOn,String.class));
    }

    public NotificationAlert(int id, String title, String msg, String time) {
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

    public int getFacId() {
        return facId;
    }

    public void setFacId(int facId) {
        this.facId = facId;
    }

    public String getBookingId() {
        return bookingId;
    }

    public void setBookingId(String bookingId) {
        this.bookingId = bookingId;
    }

    public String getBookingEmail() {
        return bookingEmail;
    }

    public void setBookingEmail(String bookingEmail) {
        this.bookingEmail = bookingEmail;
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

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }
}
