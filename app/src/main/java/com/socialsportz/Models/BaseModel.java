package com.socialsportz.Models;

import android.util.Log;

import com.socialsportz.Constants.Constants;

import org.json.JSONObject;

import java.lang.reflect.Type;

public class BaseModel implements Constants {
    private static final String TAG = BaseModel.class.getSimpleName();
    //*********************************Public Static Methods*******************************************/
    /**To check for nil, if value nil then return @""*/
    private static Object properValue(Object value) {

    	Log.d("value",value+"");

        if(value == null || value.equals("") || (value instanceof String && value.equals(kEmptyString)))
            return kEmptyString;
        else
            return value;
    }

    /**Return the nonnull value of type Object and ensure for integrity of data in models corresponding to key*/
    @SuppressWarnings("unchecked")
    public static <T> T getValue(JSONObject jsonResponse,String key, Type type){
		Log.d("type",type+""+key);
        try {
            if(jsonResponse.isNull(key))
                return (T)kEmptyString;
            else if(type == Boolean.class)
                return (T) Boolean.valueOf(jsonResponse.get(key).equals(1));
            else if(type==Character.class)
            	return (T) String.valueOf(jsonResponse.get(key).equals(null));
            else
                return (T) properValue(jsonResponse.get(key));
        }catch (Exception e){
            Log.e(TAG," "+e);
            if(type == String.class || type==null)
                return (T)kEmptyString;
            else if(type == Integer.class || type == Double.class)
                return (T)kEmptyString;
            else if(type == Boolean.class)
                return (T)kEmptyString;
            else
                return (T)kEmptyString;
        }
    }



}
