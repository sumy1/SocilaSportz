package com.socialsportz.Models.User;

import java.io.Serializable;

public class UserFavSport implements Serializable {
    private int id;
    private String SportName;

    public UserFavSport(int id, String sportName) {
        this.id = id;
        SportName = sportName;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getSportName() {
        return SportName;
    }

    public void setSportName(String sportName) {
        SportName = sportName;
    }
}
