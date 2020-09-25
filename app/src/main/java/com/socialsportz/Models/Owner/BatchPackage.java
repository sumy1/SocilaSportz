package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class BatchPackage extends BaseModel implements Serializable {

    private int packageId;
    private String packageName;
    private String packageDuration;

    public BatchPackage(JSONObject jsonResponse){
        this.packageId = Integer.valueOf(getValue(jsonResponse,kPackageId,String.class));
        this.packageName = getValue(jsonResponse,kPackageName,String.class);
        this.packageDuration = getValue(jsonResponse,kPackageDuration,String.class);
    }

    public BatchPackage(int id,String name,String duration){
        this.packageId = id;
        this.packageName = name;
        this.packageDuration = duration;
    }

    public int getPackageId() {
        return packageId;
    }

    public void setPackageId(int packageId) {
        this.packageId = packageId;
    }

    public String getPackageName() {
        return packageName;
    }

    public void setPackageName(String packageName) {
        this.packageName = packageName;
    }

    public String getPackageDuration() {
        return packageDuration;
    }

    public void setPackageDuration(String packageDuration) {
        this.packageDuration = packageDuration;
    }
}
