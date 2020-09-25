package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class CalendarData extends BaseModel implements Serializable {
    private String date;
    private int total_seats,available_seats;

    public CalendarData (JSONObject jsonResponse){
        this.date = getValue(jsonResponse,kDate,String.class);
        this.total_seats = getValue(jsonResponse,kTotalSeats,Integer.class);
        this.available_seats = getValue(jsonResponse,kAvailSeats,Integer.class);
    }

    public CalendarData(String date,int total,int avail){
        this.date = date;
        this.total_seats = total;
        this.available_seats = avail;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public int getTotal_seats() {
        return total_seats;
    }

    public void setTotal_seats(int total_seats) {
        this.total_seats = total_seats;
    }

    public int getAvailable_seats() {
        return available_seats;
    }

    public void setAvailable_seats(int available_seats) {
        this.available_seats = available_seats;
    }
}
