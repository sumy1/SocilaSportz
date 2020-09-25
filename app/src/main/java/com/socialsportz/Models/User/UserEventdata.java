package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserEventdata extends BaseModel implements Serializable {


    public CopyOnWriteArrayList<EventListing> getEventListing() {
        return eventListing;
    }

    public void setEventListing(CopyOnWriteArrayList<EventListing> eventListing) {
        this.eventListing = eventListing;
    }

    private CopyOnWriteArrayList<EventListing> eventListing;


    public  UserEventdata(JSONObject jsonObject) {
        try {
            this.eventListing = handleFacilities(getValue(jsonObject, kEventList, JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }


    private CopyOnWriteArrayList<EventListing> handleFacilities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<EventListing> facilities = new CopyOnWriteArrayList<>();


        for (int i = 0; i < jsonArray.length(); i++) {
            facilities.add(new EventListing(jsonArray.getJSONObject(i)));
        }
        return facilities;
    }
}
