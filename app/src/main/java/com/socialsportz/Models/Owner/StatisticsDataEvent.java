package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class StatisticsDataEvent extends BaseModel implements Serializable {







	public JSONObject getTotalYearScedules() {
		return totalYearScedules;
	}

	public void setTotalYearScedules(JSONObject totalYearScedules) {
		this.totalYearScedules = totalYearScedules;
	}

	JSONObject totalYearScedules;

    public StatisticsDataEvent(JSONObject jsonResponse){


		this.totalYearScedules = getValue(jsonResponse,kyeardata, JSONObject.class);




    }







	/*private JSONObject handleAmenities(JSONObject jsonArray) throws JSONException {
		JSONObject galleries = new JSONObject();


		galleries.put(new TotalYearScedule(jsonArray));

		return galleries;
	}*/


}
