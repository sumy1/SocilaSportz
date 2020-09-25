package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class FacSport extends BaseModel implements Serializable {
    private int facSportId;
    private int facId;
    private int sportId;
    private String sportName;
    private int sportCourt;
    private int sportIndoor;
    private int sportOutdoor;
    private String facSportDate;

    public FacSport(JSONObject jsonResponse){
        this.facSportId = Integer.valueOf(getValue(jsonResponse,kFacSportId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResponse,kFacId,String.class));
        this.sportId = Integer.valueOf(getValue(jsonResponse,kSportId,String.class));
        this.sportName = getValue(jsonResponse,kSportName,String.class);
        this.sportCourt = Integer.valueOf(getValue(jsonResponse,kFacCourt,String.class));
        this.sportIndoor = Integer.valueOf(getValue(jsonResponse,kFacIndoor,String.class));
        this.sportOutdoor = Integer.valueOf(getValue(jsonResponse,kFacOutdoor,String.class));
    }

    public FacSport(int facSportId, int facId, int sportId, String sportName, int sportCourt,
                    int sportIndoor, int sportOutdoor, String facSportDate) {
        this.facSportId = facSportId;
        this.facId = facId;
        this.sportId = sportId;
        this.sportName = sportName;
        this.sportCourt = sportCourt;
        this.sportIndoor = sportIndoor;
        this.sportOutdoor = sportOutdoor;
        this.facSportDate = facSportDate;
    }

    public int getFacSportId() {
        return facSportId;
    }

    public void setFacSportId(int facSportId) {
        this.facSportId = facSportId;
    }

    public int getFacId() {
        return facId;
    }

    public void setFacId(int facId) {
        this.facId = facId;
    }

    public int getSportId() {
        return sportId;
    }

    public void setSportId(int sportId) {
        this.sportId = sportId;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public int getSportCourt() {
        return sportCourt;
    }

    public void setSportCourt(int sportCourt) {
        this.sportCourt = sportCourt;
    }

    public int getSportIndoor() {
        return sportIndoor;
    }

    public void setSportIndoor(int sportIndoor) {
        this.sportIndoor = sportIndoor;
    }

    public int getSportOutdoor() {
        return sportOutdoor;
    }

    public void setSportOutdoor(int sportOutdoor) {
        this.sportOutdoor = sportOutdoor;
    }

    public String getFacSportDate() {
        return facSportDate;
    }

    public void setFacSportDate(String facSportDate) {
        this.facSportDate = facSportDate;
    }
}
