package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserDashBoard extends BaseModel implements Serializable {

    private CopyOnWriteArrayList<UserFacAca> facilities;
    private CopyOnWriteArrayList<UserFacAca> academies;
    private CopyOnWriteArrayList<UserEvent> events;

    public  UserDashBoard(JSONObject jsonObject){
        try {
            this.facilities = handleFacilities(getValue(jsonObject,kFacilityList,JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
        try {
            this.academies = handleFacilities(getValue(jsonObject,kAcademyList,JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
        try {
            this.events = handleEvents(getValue(jsonObject,kEventList,JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public CopyOnWriteArrayList<UserFacAca> getFacilities() {
        return facilities;
    }

    public void setFacilities(CopyOnWriteArrayList<UserFacAca> facilities) {
        this.facilities = facilities;
    }

    public CopyOnWriteArrayList<UserFacAca> getAcademies() {
        return academies;
    }

    public void setAcademies(CopyOnWriteArrayList<UserFacAca> academies) {
        this.academies = academies;
    }

    public CopyOnWriteArrayList<UserEvent> getEvents() {
        return events;
    }

    public void setEvents(CopyOnWriteArrayList<UserEvent> events) {
        this.events = events;
    }

    private CopyOnWriteArrayList<UserFacAca> handleFacilities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<UserFacAca> facilities = new CopyOnWriteArrayList<>();


        for (int i = 0; i < jsonArray.length(); i++) {
            facilities.add(new UserFacAca(jsonArray.getJSONObject(i)));
        }
        return facilities;
    }

    private CopyOnWriteArrayList<UserEvent> handleEvents(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<UserEvent> facilities = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            facilities.add(new UserEvent(jsonArray.getJSONObject(i)));
        }
        return facilities;
    }
}
