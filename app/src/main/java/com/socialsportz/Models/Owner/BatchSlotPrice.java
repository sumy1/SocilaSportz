package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class BatchSlotPrice extends BaseModel implements Serializable {

    private int priceId;
    private int packageId;
    private String packageDuration;
    private int batchSlotId;
    private String price;

    public BatchSlotPrice(JSONObject jsonResponse){
        this.batchSlotId = Integer.valueOf(getValue(jsonResponse,kBatchSlotId,String.class));
        if(!getValue(jsonResponse,kPackageId,String.class).equals(kEmptyString))
            this.packageId = Integer.valueOf(getValue(jsonResponse,kPackageId,String.class));
        this.priceId = Integer.valueOf(getValue(jsonResponse,kPriceId,String.class));
        this.price = getValue(jsonResponse,kPriceNo,String.class);
    }

    public BatchSlotPrice(int id, String type, String price) {
        this.packageId = id;
        this.packageDuration = type;
        this.price = price;
    }

    public int getPriceId() {
        return priceId;
    }

    public void setPriceId(int priceId) {
        this.priceId = priceId;
    }

    public int getPackageId() {
        return packageId;
    }

    public void setPackageId(int packageId) {
        this.packageId = packageId;
    }

    public String getPackageDuration() {
        return packageDuration;
    }

    public void setPackageDuration(String packageDuration) {
        this.packageDuration = packageDuration;
    }

    public int getBatchSlotId() {
        return batchSlotId;
    }

    public void setBatchSlotId(int batchSlotId) {
        this.batchSlotId = batchSlotId;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }
}
