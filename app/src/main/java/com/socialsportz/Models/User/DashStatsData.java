package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import java.io.Serializable;

public class DashStatsData extends BaseModel implements Serializable {

    private int count;
    private String title;

    public DashStatsData(int count,String title){
        this.count = count;
        this.title = title;
    }

    public int getCount() {
        return count;
    }

    public void setCount(int count) {
        this.count = count;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }
}
