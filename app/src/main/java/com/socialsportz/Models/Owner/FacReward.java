package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class FacReward extends BaseModel implements Serializable {
    private int rewardId;
    private String rewardName;

    public FacReward(JSONObject jsonResponse){
        this.rewardId = Integer.valueOf(getValue(jsonResponse,kRewardId,String.class));
        this.rewardName = getValue(jsonResponse,kRewardName,String.class);
    }

    public int getRewardId() {
        return rewardId;
    }

    public void setRewardId(int rewardId) {
        this.rewardId = rewardId;
    }

    public String getRewardName() {
        return rewardName;
    }

    public void setRewardName(String rewardName) {
        this.rewardName = rewardName;
    }
}
