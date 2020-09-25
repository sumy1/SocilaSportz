package com.socialsportz.Models.User;

import org.json.JSONException;
import org.json.JSONObject;

import static com.socialsportz.Constants.Constants.kResponse;
import static com.socialsportz.Constants.Constants.kResponseMessage;
import static com.socialsportz.Models.BaseModel.getValue;

public class FavModelChecked {


	public String getMsg() {
		return msg;
	}

	public void setMsg(String msg) {
		this.msg = msg;
	}

	private int res;

	public int getRes() {
		return res;
	}

	public void setRes(int res) {
		this.res = res;
	}

	private String msg;


	public FavModelChecked(JSONObject jsonObject){
		this.msg=getValue(jsonObject,kResponseMessage,String.class);

		if(jsonObject.has(kResponse)){
			try {
				this.res=jsonObject.getInt(kResponse);
			} catch (JSONException e) {
				e.printStackTrace();
			}
		}


	}

}
