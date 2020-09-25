package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class MasterSports extends BaseModel implements Serializable {

    private String sportId;
    private String sportName;
    private String sportIcon;

    public MasterSports(JSONObject jsonObject){
        this.sportId=getValue(jsonObject,kSportId,String.class);
        this.sportName=getValue(jsonObject,kSportName,String.class);
        this.sportIcon=getValue(jsonObject,kSportIcon,String.class);

    }


    public String getSportId() {
        return sportId;
    }

    public void setSportId(String sportId) {
        this.sportId = sportId;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public String getSportIcon() {
        return sportIcon;
    }

    public void setSportIcon(String sportIcon) {
        this.sportIcon = sportIcon;
    }



}
