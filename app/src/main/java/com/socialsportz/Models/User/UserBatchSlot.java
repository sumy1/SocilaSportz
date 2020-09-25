package com.socialsportz.Models.User;

import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.BaseModel;
import com.socialsportz.Models.Owner.BatchSlotPrice;
import com.socialsportz.Models.Owner.BatchSlotWeekOff;
import com.socialsportz.Models.Owner.Facility;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserBatchSlot extends BaseModel implements Serializable {

    private int facId;
    private int sportId;
    private int typeId;
    private int packageId;
    private int batchSlotId;
    private String startTime;
    private String endTime;
    private String startDate;
    private String endDate;
    private String isTrial;
    private String isKit;
    private String kitPrice;
    private String courtType;
    private String courtDesc;
    private String maxBook;
    private String type;


    public String getPackagePrice() {
        return packagePrice;
    }

    public void setPackagePrice(String packagePrice) {
        this.packagePrice = packagePrice;
    }

    private String packagePrice;
    private CopyOnWriteArrayList<BatchSlotWeekOff> weekOffs;
    private CopyOnWriteArrayList<BatchSlotPrice> prices;

    private String sportName,weekOff, typeName,price;
    private String availability;
    private boolean checked;

    public UserBatchSlot(JSONObject jsonResponse){
        this.facId = Integer.valueOf(getValue(jsonResponse,kFacId,String.class));
        this.sportId = Integer.valueOf(getValue(jsonResponse,kSportId,String.class));
        this.typeId = Integer.valueOf(getValue(jsonResponse,kTypeId,String.class));
        this.packageId = Integer.valueOf(getValue(jsonResponse,kPackageId,String.class));
        this.batchSlotId = Integer.valueOf(getValue(jsonResponse,kBatchSlotId,String.class));
        this.startTime = getValue(jsonResponse,kStartTime,String.class);
        this.endTime = getValue(jsonResponse,kEndTime,String.class);
        this.startDate = getValue(jsonResponse,kStartDate,String.class);
        this.endDate = getValue(jsonResponse,kEndDate,String.class);
        this.isTrial = getValue(jsonResponse,kIsTrial,String.class);
        this.isKit = getValue(jsonResponse,kIsKit,String.class);
        this.kitPrice = getValue(jsonResponse,kKitPrice,String.class);
        this.courtType = getValue(jsonResponse,kCourtType,String.class);
        this.courtDesc=  getValue(jsonResponse,kCourtDesc,String.class);
        this.maxBook = getValue(jsonResponse,kMaxParticipants,String.class);
        this.packagePrice=getValue(jsonResponse,kPriceNo,String.class);
        //this.type = handleBatchSlot(this.facId);
        if(jsonResponse.has(kAvailability)){
            this.availability = getValue(jsonResponse,kAvailability,String.class);
        }else{
            this.availability = DefaultStatus.no.toString();
        }
        if(jsonResponse.has(kBatchSlotType)){
            this.typeName = getValue(jsonResponse,kBatchSlotType,String.class);
        }
        if(jsonResponse.has(kPriceNo)){
            this.price = getValue(jsonResponse,kPriceNo,String.class);
        }
        try {
            if(jsonResponse.has(kWeekOffs)){
                this.weekOffs = handleWeekOffs(getValue(jsonResponse,kWeekOffs, JSONArray.class));
            }
            if(jsonResponse.has(kPricing)){
                this.prices = handlePricing(getValue(jsonResponse,kPricing,JSONArray.class));
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }

    public UserBatchSlot(int facId, int sportId, String startTime, String endTime, String typeName,
						 String maxBook, String price, String type, CopyOnWriteArrayList<BatchSlotPrice> monthPrice, String availability) {
        this.facId = facId;
        this.sportId = sportId;
        this.startTime = startTime;
        this.endTime = endTime;
        this.typeName = typeName;
        this.maxBook = maxBook;
        this.price = price;
        this.type = type;
        this.prices = monthPrice;
        this.availability = availability;
    }

    private String handleBatchSlot(int facId){
        String type = "";
        CopyOnWriteArrayList<Facility> facilities = ModelManager.modelManager().getCurrentUser().getFacilities();
        for(int i=0;i<facilities.size();i++){
            if(facId==facilities.get(i).getFacId()){
                if(facilities.get(i).getFacType().equals(FacType.academy.toString()))
                    type = BatchSlotEnum.batch.toString();
                else if(facilities.get(i).getFacType().equals(FacType.facility.toString()))
                    type = BatchSlotEnum.slot.toString();
                break;
            }
        }
        return type;
    }

    private CopyOnWriteArrayList<BatchSlotWeekOff> handleWeekOffs(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<BatchSlotWeekOff> weekOffs = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            weekOffs.add(new BatchSlotWeekOff(jsonArray.getJSONObject(i)));
        }
        return weekOffs;
    }

    private CopyOnWriteArrayList<BatchSlotPrice> handlePricing(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<BatchSlotPrice> prices = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            prices.add(new BatchSlotPrice(jsonArray.getJSONObject(i)));
        }
        return prices;
    }

    public int getFacId() {
        return facId;
    }

    public void setFacId(int facId) {
        this.facId = facId;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public int getSportId() {
        return sportId;
    }

    public void setSportId(int sportId) {
        this.sportId = sportId;
    }

    public int getTypeId() {
        return typeId;
    }

    public void setTypeId(int typeId) {
        this.typeId = typeId;
    }

    public int getPackageId() {
        return packageId;
    }

    public void setPackageId(int packageId) {
        this.packageId = packageId;
    }

    public int getBatchSlotId() {
        return batchSlotId;
    }

    public void setBatchSlotId(int batchSlotId) {
        this.batchSlotId = batchSlotId;
    }

    public String getIsTrial() {
        return isTrial;
    }

    public void setIsTrial(String isTrial) {
        this.isTrial = isTrial;
    }

    public String getStartTime() {
        return startTime;
    }

    public void setStartTime(String startTime) {
        this.startTime = startTime;
    }

    public String getEndTime() {
        return endTime;
    }

    public void setEndTime(String endTime) {
        this.endTime = endTime;
    }

    public String getStartDate() {
        return startDate;
    }

    public void setStartDate(String startDate) {
        this.startDate = startDate;
    }

    public String getEndDate() {
        return endDate;
    }

    public void setEndDate(String endDate) {
        this.endDate = endDate;
    }

    public String getIsKit() {
        return isKit;
    }

    public void setIsKit(String isKit) {
        this.isKit = isKit;
    }

    public String getKitPrice() {
        return kitPrice;
    }

    public void setKitPrice(String kitPrice) {
        this.kitPrice = kitPrice;
    }

    public String getCourtType() {
        return courtType;
    }

    public void setCourtType(String courtType) {
        this.courtType = courtType;
    }

    public String getCourtDesc() {
        return courtDesc;
    }

    public void setCourtDesc(String courtDesc) {
        this.courtDesc = courtDesc;
    }

    public String getWeekOff() {
        return weekOff;
    }

    public void setWeekOff(String weekOff) {
        this.weekOff = weekOff;
    }

    public String getTypeName() {
        return typeName;
    }

    public void setTypeName(String typeName) {
        this.typeName = typeName;
    }

    public String getMaxBook() {
        return maxBook;
    }

    public void setMaxBook(String maxBook) {
        this.maxBook = maxBook;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public CopyOnWriteArrayList<BatchSlotWeekOff> getWeekOffs() {
        return weekOffs;
    }

    public void setWeekOffs(CopyOnWriteArrayList<BatchSlotWeekOff> weekOffs) {
        this.weekOffs = weekOffs;
    }

    public CopyOnWriteArrayList<BatchSlotPrice> getPrices() {
        return prices;
    }

    public void setPrices(CopyOnWriteArrayList<BatchSlotPrice> prices) {
        this.prices = prices;
    }

    public String getAvailability() {
        return availability;
    }

    public void setAvailability(String availability) {
        this.availability = availability;
    }

    public boolean isChecked() {
        return checked;
    }

    public void setChecked(boolean checked) {
        this.checked = checked;
    }
}
