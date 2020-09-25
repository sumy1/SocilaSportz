package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class StatisticsData extends BaseModel implements Serializable {


	public int getBookingOrderCountOffline() {
		return BookingOrderCountOffline;
	}

	public void setBookingOrderCountOffline(int bookingOrderCountOffline) {
		BookingOrderCountOffline = bookingOrderCountOffline;
	}

	public int getBookingOrderCountOnline() {
		return BookingOrderCountOnline;
	}

	public void setBookingOrderCountOnline(int bookingOrderCountOnline) {
		BookingOrderCountOnline = bookingOrderCountOnline;
	}

	private int BookingOrderCountOffline;
	private int BookingOrderCountOnline;


	public JSONObject getTotalYearScedules() {
		return totalYearScedules;
	}

	public void setTotalYearScedules(JSONObject totalYearScedules) {
		this.totalYearScedules = totalYearScedules;
	}

	JSONObject totalYearScedules;

    public StatisticsData(JSONObject jsonResponse){


		this.totalYearScedules = getValue(jsonResponse,kyeardata, JSONObject.class);

		this.BookingOrderCountOffline = getValue(jsonResponse,kstatisticOffline,Integer.class);
            this.BookingOrderCountOnline = getValue(jsonResponse,kstatisticOnline,Integer.class);


    }







	/*private JSONObject handleAmenities(JSONObject jsonArray) throws JSONException {
		JSONObject galleries = new JSONObject();


		galleries.put(new TotalYearScedule(jsonArray));

		return galleries;
	}*/


}
