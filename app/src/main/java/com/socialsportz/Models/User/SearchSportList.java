package com.socialsportz.Models.User;

import java.io.Serializable;

public class SearchSportList implements Serializable {
    private int sportId,sportImg;
    private String sportName;

    public SearchSportList(int sportId, int sportImg, String sportName) {
        this.sportId = sportId;
        this.sportImg = sportImg;
        this.sportName = sportName;
    }

    public int getSportId() {
        return sportId;
    }

    public void setSportId(int sportId) {
        this.sportId = sportId;
    }

    public int getSportImg() {
        return sportImg;
    }

    public void setSportImg(int sportImg) {
        this.sportImg = sportImg;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }
}
