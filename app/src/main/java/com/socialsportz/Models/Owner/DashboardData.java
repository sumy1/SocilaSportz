package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class DashboardData extends BaseModel implements Serializable {


    private CopyOnWriteArrayList<TotalBookingView> numberList;
    private CopyOnWriteArrayList<Events> upcomingEvents;
    private CopyOnWriteArrayList<Enquires> latestEnquiries;
    private int total_1_rating;
    private int total_2_rating;
    private int total_3_rating;
    private int total_4_rating;
    private int total_5_rating;
    private int reviewCount;

	public String getFacType() {
		return facType;
	}

	public void setFacType(String facType) {
		this.facType = facType;
	}

	private String facType;

    public DashboardData(JSONObject jsonResponse){

    	this.facType=getValue(jsonResponse,kFacType,String.class);
        try {
            JSONObject counts = jsonResponse.getJSONObject(kBookingView);
            this.numberList = handleCounts(counts);
        } catch (JSONException e) {
            e.printStackTrace();
        }
        try{
            JSONObject rating = jsonResponse.getJSONObject(kReviewSummary);
            this.total_1_rating = getValue(rating,kTotal1Star,Integer.class);
            this.total_2_rating = getValue(rating,kTotal2Star,Integer.class);
            this.total_3_rating = getValue(rating,kTotal3Star,Integer.class);
            this.total_4_rating = getValue(rating,kTotal4Star,Integer.class);
            this.total_5_rating = getValue(rating,kTotal5Star,Integer.class);
            this.reviewCount = getValue(rating,kReviewCount,Integer.class);
        } catch (JSONException e) {
            e.printStackTrace();
        }
        try {
            this.upcomingEvents = handleEvents(getValue(jsonResponse,kUpcomingEvents,JSONArray.class));
            this.latestEnquiries = handleEnquries(getValue(jsonResponse,kLatestQueries,JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private CopyOnWriteArrayList<Events> handleEvents(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<Events> facilities = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            facilities.add(new Events(jsonArray.getJSONObject(i)));
        }
        return facilities;
    }

    private CopyOnWriteArrayList<Enquires> handleEnquries(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<Enquires> facilities = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            facilities.add(new Enquires(jsonArray.getJSONObject(i)));
        }
        return facilities;
    }


    private CopyOnWriteArrayList<TotalBookingView> handleCounts(JSONObject jsonObject){
        CopyOnWriteArrayList<TotalBookingView> bookings = new CopyOnWriteArrayList<>();
        bookings.add(new TotalBookingView(1,getValue(jsonObject,kTodayBoking,Integer.class),kTodayBooking));
        bookings.add(new TotalBookingView(2,getValue(jsonObject,kTrialBoking,Integer.class),kUpcomingTrialBooking));
        bookings.add(new TotalBookingView(4,getValue(jsonObject,kTotalBoking,Integer.class),kTodaysTransations));

        if(facType.equalsIgnoreCase("facility")){
			bookings.add(new TotalBookingView(3,getValue(jsonObject,kConfirmedBoking,Integer.class),kUpcomingcancelledSlotCount));
			bookings.add(new TotalBookingView(5,getValue(jsonObject,kTrialBookingg,Integer.class),kUpcomingBookingSlot));
		}else{
			bookings.add(new TotalBookingView(3,getValue(jsonObject,kConfirmedBoking,Integer.class),kUpcomingcancelledBatchCount));
			bookings.add(new TotalBookingView(5,getValue(jsonObject,kTrialBookingg,Integer.class),kUpcomingBookingBatch));
		}



        return bookings;
    }

    public CopyOnWriteArrayList<TotalBookingView> getNumberList() {
        return numberList;
    }

    public void setNumberList(CopyOnWriteArrayList<TotalBookingView> numberList) {
        this.numberList = numberList;
    }

    public CopyOnWriteArrayList<Events> getUpcomingEvents() {
        return upcomingEvents;
    }

    public void setUpcomingEvents(CopyOnWriteArrayList<Events> upcomingEvents) {
        this.upcomingEvents = upcomingEvents;
    }

    public CopyOnWriteArrayList<Enquires> getLatestEnquiries() {
        return latestEnquiries;
    }

    public void setLatestEnquiries(CopyOnWriteArrayList<Enquires> latestEnquiries) {
        this.latestEnquiries = latestEnquiries;
    }

    public int getTotal_1_rating() {
        return total_1_rating;
    }

    public void setTotal_1_rating(int total_1_rating) {
        this.total_1_rating = total_1_rating;
    }

    public int getTotal_2_rating() {
        return total_2_rating;
    }

    public void setTotal_2_rating(int total_2_rating) {
        this.total_2_rating = total_2_rating;
    }

    public int getTotal_3_rating() {
        return total_3_rating;
    }

    public void setTotal_3_rating(int total_3_rating) {
        this.total_3_rating = total_3_rating;
    }

    public int getTotal_4_rating() {
        return total_4_rating;
    }

    public void setTotal_4_rating(int total_4_rating) {
        this.total_4_rating = total_4_rating;
    }

    public int getTotal_5_rating() {
        return total_5_rating;
    }

    public void setTotal_5_rating(int total_5_rating) {
        this.total_5_rating = total_5_rating;
    }

    public int getReviewCount() {
        return reviewCount;
    }

    public void setReviewCount(int reviewCount) {
        this.reviewCount = reviewCount;
    }
}
