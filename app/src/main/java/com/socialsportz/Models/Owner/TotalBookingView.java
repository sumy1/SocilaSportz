package com.socialsportz.Models.Owner;

import java.io.Serializable;

public class TotalBookingView implements Serializable {
   private int id,totalNo;
   private String totalText;

    public TotalBookingView(int id, int totalNo, String totalText) {
        this.id = id;
        this.totalNo = totalNo;
        this.totalText = totalText;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getTotalNo() {
        return totalNo;
    }

    public void setTotalNo(int totalNo) {
        this.totalNo = totalNo;
    }

    public String getTotalText() {
        return totalText;
    }

    public void setTotalText(String totalText) {
        this.totalText = totalText;
    }
}
