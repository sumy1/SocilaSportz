package com.socialsportz.Models.User;

import org.json.JSONObject;

import static com.socialsportz.Constants.Constants.kUserCartCount;
import static com.socialsportz.Models.BaseModel.getValue;

public class CartCount {

	public String getCart_count() {
		return cart_count;
	}

	public void setCart_count(String cart_count) {
		this.cart_count = cart_count;
	}

	private String cart_count;

	public CartCount(JSONObject jsonResonse){
		this.cart_count = getValue(jsonResonse, kUserCartCount, String.class);

	}
}
