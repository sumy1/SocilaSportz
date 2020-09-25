package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserAddcartList extends BaseModel implements Serializable {


    public CopyOnWriteArrayList<UserAddcart> getUserAddcart() {
        return userAddcart;
    }

    public void setUserAddcart(CopyOnWriteArrayList<UserAddcart> userAddcart) {
        this.userAddcart = userAddcart;
    }

    private CopyOnWriteArrayList<UserAddcart> userAddcart;

    public UserAddcartList(JSONObject jsonResponse){


    	if(jsonResponse.has(kcartListing)){


			try {
				this.userAddcart = handleBatchSlotList(getValue(jsonResponse,kcartListing, JSONArray.class));
			} catch (JSONException e) {
				e.printStackTrace();
			}

		}

        /*try {
            this.userAddcart = handleBatchSlotList(getValue(jsonResponse,kcartListing, JSONArray.class));
        } catch (JSONException e) {
            e.printStackTrace();
        }*/
    }

    private CopyOnWriteArrayList<UserAddcart> handleBatchSlotList(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<UserAddcart> masterReward = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {

            masterReward.add(new UserAddcart(jsonArray.getJSONObject(i)));
        }
        return masterReward;
    }
}
