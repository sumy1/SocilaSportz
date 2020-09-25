package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class EventAmenity extends BaseModel implements Serializable {

    private int eventAmenityId;
    private int eventId;
    private int amenityId;

    public EventAmenity(JSONObject jsonResponse ){
        this.eventAmenityId = Integer.valueOf(getValue(jsonResponse,kEventAmenityId,String.class));
        this.amenityId = Integer.valueOf(getValue(jsonResponse,kAmenityId,String.class));
        this.eventId = Integer.valueOf(getValue(jsonResponse,kEventId,String.class));
    }

    public int getEventAmenityId() {
        return eventAmenityId;
    }

    public void setEventAmenityId(int eventAmenityId) {
        this.eventAmenityId = eventAmenityId;
    }

    public int getEventId() {
        return eventId;
    }

    public void setEventId(int eventId) {
        this.eventId = eventId;
    }

    public int getAmenityId() {
        return amenityId;
    }

    public void setAmenityId(int amenityId) {
        this.amenityId = amenityId;
    }
}
