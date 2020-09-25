package com.socialsportz.Models;

import java.io.Serializable;

public class NavigationModel implements Serializable {

    private int navId;
    private int navImg;
    private String navName;

    public NavigationModel(int navId, int navImg, String navName) {
        this.navId = navId;
        this.navImg = navImg;
        this.navName = navName;

    }

    public int getNavId() {
        return navId;
    }

    public void setNavId(int navId) {
        this.navId = navId;
    }

    public int getNavImg() {
        return navImg;
    }

    public void setNavImg(int navImg) {
        this.navImg = navImg;
    }

    public String getNavName() {
        return navName;
    }

    public void setNavName(String navName) {
        this.navName = navName;
    }

}
