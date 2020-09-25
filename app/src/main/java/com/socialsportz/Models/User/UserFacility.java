package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserFacility extends BaseModel implements Serializable {




    public CopyOnWriteArrayList<UserFacAca> getFacilities() {
        return facilities;
    }

    public void setFacilities(CopyOnWriteArrayList<UserFacAca> facilities) {
        this.facilities = facilities;
    }

    private CopyOnWriteArrayList<UserFacAca> facilities;


    public  UserFacility(JSONObject jsonObject) {
        try {

            if(jsonObject.has(kFacilityList)){
                this.facilities=handleFacilities(jsonObject.getJSONArray(kFacilityList));
            }



            //this.facilities = handleFacilities(getValue(jsonObject, kFacilityList, JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }


    private CopyOnWriteArrayList<UserFacAca> handleFacilities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<UserFacAca> facilities = new CopyOnWriteArrayList<>();


        for (int i = 0; i < jsonArray.length(); i++) {
            facilities.add(new UserFacAca(jsonArray.getJSONObject(i)));
        }
        return facilities;
    }

}
