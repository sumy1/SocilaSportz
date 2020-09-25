package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserPackage extends BaseModel implements Serializable {


    public UserPackage(JSONObject jsonObject){
        this.batchSlotId=getValue(jsonObject,kBatchSlotId,String.class);
        this.facId=getValue(jsonObject,kFacId,String.class);
        this.packageId=getValue(jsonObject,kPackageId,String.class);
        this.packageName=getValue(jsonObject,kPackageName,String.class);

    }

    public String getBatchSlotId() {
        return batchSlotId;
    }

    public void setBatchSlotId(String batchSlotId) {
        this.batchSlotId = batchSlotId;
    }

    public String getFacId() {
        return facId;
    }

    public void setFacId(String facId) {
        this.facId = facId;
    }

    public String getPackageId() {
        return packageId;
    }

    public void setPackageId(String packageId) {
        this.packageId = packageId;
    }

    public String getPackageName() {
        return packageName;
    }

    public void setPackageName(String packageName) {
        this.packageName = packageName;
    }

    String batchSlotId;
    String facId;
    String packageId;
    String packageName;


}
