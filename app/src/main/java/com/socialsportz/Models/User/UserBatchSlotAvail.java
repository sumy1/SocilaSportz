package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserBatchSlotAvail extends BaseModel implements Serializable {



	String date;
    private CopyOnWriteArrayList<UserBatchSlotAvailList> batchSlot;

	public UserBatchSlotAvail(String date,CopyOnWriteArrayList<UserBatchSlotAvailList> batchSlot) {
		this.date = date;
		this.batchSlot = batchSlot;
	}

    public UserBatchSlotAvail( CopyOnWriteArrayList<UserBatchSlotAvailList> batchSlot) {

        this.batchSlot = batchSlot;
    }

    public UserBatchSlotAvail(JSONObject jsonResponse){

        try {
            this.batchSlot = handleBatchSlotList(getValue(jsonResponse,kBatchSlotData,JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }



    public CopyOnWriteArrayList<UserBatchSlotAvailList> getBatchSlot() {
        return batchSlot;
    }

    private CopyOnWriteArrayList<UserBatchSlotAvailList> handleBatchSlotList(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<UserBatchSlotAvailList> masterReward = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {

            masterReward.add(new UserBatchSlotAvailList(jsonArray.getJSONObject(i)));
        }
        return masterReward;
    }

}
