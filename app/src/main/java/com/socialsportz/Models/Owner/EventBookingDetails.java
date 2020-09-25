package com.socialsportz.Models.Owner;

import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class EventBookingDetails extends BaseModel implements Serializable {

    private int id,bookingId,facId,sportId,eventId;
    private String eventName, sportName, startDate,endDate, startTime,endTime;
    private String detail_total_amount,detail_discount,detail_final_amount,detail_status;

    public EventBookingDetails(JSONObject jsonResponse){
        this.id = Integer.valueOf(getValue(jsonResponse,kBookingDetailId,String.class));
        this.bookingId = Integer.valueOf(getValue(jsonResponse,kBookingId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResponse,kFacId,String.class));
        this.eventId = Integer.valueOf(getValue(jsonResponse,kEventId,String.class));
        this.sportId = Integer.valueOf(getValue(jsonResponse,kEventSport,String.class));
        this.eventName = getValue(jsonResponse,kEventName,String.class);
        this.sportName = getSportName(this.sportId);
        this.startDate = getValue(jsonResponse,kEventStartDate,String.class);
        this.endDate = getValue(jsonResponse,kEventEndDate,String.class);
        this.startTime = getValue(jsonResponse,kEventStartTime,String.class);
        this.endTime = getValue(jsonResponse,kEventEndTime,String.class);
        this.detail_total_amount = getValue(jsonResponse,kBookingDetailTotal,String.class);
        this.detail_discount = getValue(jsonResponse,kBookingDetailDiscount,String.class);
        this.detail_final_amount = getValue(jsonResponse,kBookingDetailFinal,String.class);
        this.detail_status = getValue(jsonResponse,kBookingDetailStatus,String.class);
     }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getBookingId() {
        return bookingId;
    }

    public void setBookingId(int bookingId) {
        this.bookingId = bookingId;
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

    public int getEventId() {
        return eventId;
    }

    public void setEventId(int eventId) {
        this.eventId = eventId;
    }

    public String getEventName() {
        return eventName;
    }

    public void setEventName(String eventName) {
        this.eventName = eventName;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public String getStartDate() {
        return startDate;
    }

    public void setStartDate(String startDate) {
        this.startDate = startDate;
    }

    public String getEndDate() {
        return endDate;
    }

    public void setEndDate(String endDate) {
        this.endDate = endDate;
    }

    public String getStartTime() {
        return startTime;
    }

    public void setStartTime(String startTime) {
        this.startTime = startTime;
    }

    public String getEndTime() {
        return endTime;
    }

    public void setEndTime(String endTime) {
        this.endTime = endTime;
    }

    public String getDetail_total_amount() {
        return detail_total_amount;
    }

    public void setDetail_total_amount(String detail_total_amount) {
        this.detail_total_amount = detail_total_amount;
    }

    public String getDetail_discount() {
        return detail_discount;
    }

    public void setDetail_discount(String detail_discount) {
        this.detail_discount = detail_discount;
    }

    public String getDetail_final_amount() {
        return detail_final_amount;
    }

    public void setDetail_final_amount(String detail_final_amount) {
        this.detail_final_amount = detail_final_amount;
    }

    public String getDetail_status() {
        return detail_status;
    }

    public void setDetail_status(String detail_status) {
        this.detail_status = detail_status;
    }

    private String getSportName(int sportId){
        String name = "";
        try{
            CopyOnWriteArrayList<Sport> sports = ModelManager.modelManager().getCurrentUser().getSports();
            if(!sports.isEmpty()){
                for(int i=0;i<sports.size();i++){
                    if(sports.get(i).getSportId()==sportId){
                        name = sports.get(i).getSportName();
                        break;
                    }
                }
            }
        }catch (Exception e){
            e.printStackTrace();
            return kEmptyString;
        }
        return name;
     }

}
