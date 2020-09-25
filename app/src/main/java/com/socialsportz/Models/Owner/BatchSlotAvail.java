package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class BatchSlotAvail extends BaseModel implements Serializable {

    private String date;
    private CopyOnWriteArrayList<BatchSlot> batchSlot;

    public BatchSlotAvail(String date,CopyOnWriteArrayList<BatchSlot> batchSlot) {
        this.date = date;
        this.batchSlot = batchSlot;
    }

    public BatchSlotAvail(JSONObject jsonResponse){
        this.date = getValue(jsonResponse,kDate,String.class);
        try {
            this.batchSlot = handleBatchSlotList(getValue(jsonResponse,kBatchSlotData,JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public String getDate() {
        return date;
    }

    public CopyOnWriteArrayList<BatchSlot> getBatchSlot() {
        return batchSlot;
    }

    private CopyOnWriteArrayList<BatchSlot> handleBatchSlotList(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<BatchSlot> masterReward = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {

            masterReward.add(new BatchSlot(jsonArray.getJSONObject(i)));
        }
        return masterReward;
    }

}
