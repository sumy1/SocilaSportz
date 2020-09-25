package com.socialsportz.Models.User;

import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.BaseModel;
import com.socialsportz.Models.Owner.Facility;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserBatchSlotAvailList extends BaseModel implements Serializable {

    private String facId;
    private String sportId;
    private String typeId;
    private String packageId;
    private String batchSlotId;
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

	public String getBatchSloTypeName() {
		return batchSloTypeName;
	}

	public void setBatchSloTypeName(String batchSloTypeName) {
		this.batchSloTypeName = batchSloTypeName;
	}

	private String batchSloTypeName;

	public String getFacName() {
		return facName;
	}

	public void setFacName(String facName) {
		this.facName = facName;
	}

	private String facName;

	public String getPackagename() {
		return packagename;
	}

	public void setPackagename(String packagename) {
		this.packagename = packagename;
	}

	private String packagename;

	public String getAvailable_cart() {
		return available_cart;
	}

	public void setAvailable_cart(String available_cart) {
		this.available_cart = available_cart;
	}

	private String available_cart;

    public String getSlotPacpriceId() {
        return slotPacpriceId;
    }

    public void setSlotPacpriceId(String slotPacpriceId) {
        this.slotPacpriceId = slotPacpriceId;
    }

    private String slotPacpriceId;


    public String getCreatedOn() {
        return createdOn;
    }

    public void setCreatedOn(String createdOn) {
        this.createdOn = createdOn;
    }

    private String createdOn;
    public String getCreateOn() {
        return createOn;
    }

    public void setCreateOn(String createOn) {
        this.createOn = createOn;
    }

    public String getUpdateOn() {
        return updateOn;
    }

    public void setUpdateOn(String updateOn) {
        this.updateOn = updateOn;
    }

    private String createOn;
    private String updateOn;

    public String getBatchSlotstatus() {
        return batchSlotstatus;
    }

    public void setBatchSlotstatus(String batchSlotstatus) {
        this.batchSlotstatus = batchSlotstatus;
    }

    private String batchSlotstatus;

    public String getActualPrice() {
        return actualPrice;
    }

    public void setActualPrice(String actualPrice) {
        this.actualPrice = actualPrice;
    }

    private String actualPrice;


    public String getPackagePrice() {
        return packagePrice;
    }

    public void setPackagePrice(String packagePrice) {
        this.packagePrice = packagePrice;
    }

    private String packagePrice;
    private CopyOnWriteArrayList<UserBatchSlotPricing> prices;

    private String sportName, weekOff, typeName, price;
    private String availability;
    private boolean checked;

    public UserBatchSlotAvailList(JSONObject jsonResponse) {
        this.facId = getValue(jsonResponse, kFacId, String.class);
        this.sportId = getValue(jsonResponse, kSportId, String.class);
        this.typeId = getValue(jsonResponse, kTypeId, String.class);
        this.packageId = getValue(jsonResponse, kPackageId, String.class);
        this.batchSlotId = getValue(jsonResponse, kBatchSlotId, String.class);
        this.startTime = getValue(jsonResponse, kStartTime, String.class);
        this.endTime = getValue(jsonResponse, kEndTime, String.class);
        this.startDate = getValue(jsonResponse, kStartDate, String.class);
        this.endDate = getValue(jsonResponse, kEndDate, String.class);
        this.isTrial = getValue(jsonResponse, kIsTrial, String.class);
        this.isKit = getValue(jsonResponse, kIsKit, String.class);
        this.kitPrice = getValue(jsonResponse, kKitPrice, String.class);
        this.courtType = getValue(jsonResponse, kCourtType, String.class);
        this.courtDesc = getValue(jsonResponse, kCourtDesc, String.class);
        this.maxBook = getValue(jsonResponse, kMaxParticipants, String.class);
        this.packagePrice = getValue(jsonResponse, kPriceNo, String.class);
        this.actualPrice = getValue(jsonResponse, kActualPrice, String.class);
        this.batchSlotstatus = getValue(jsonResponse, kBatchSlotStatus, String.class);
        this.createOn = getValue(jsonResponse, kCreateOn, String.class);
        this.updateOn = getValue(jsonResponse, kUpdateOn, String.class);
        this.available_cart=getValue(jsonResponse,kavilcart,String.class);
        this.packagename=getValue(jsonResponse,kPackageName,String.class);
        this.facName=getValue(jsonResponse,kFacType,String.class);
        this.batchSloTypeName=getValue(jsonResponse,kTypeName,String.class);

        this.slotPacpriceId=getValue(jsonResponse,kPriceId,String.class);
        this.createdOn=getValue(jsonResponse,kCreatedOn,String.class);
        //this.type = handleBatchSlot(this.facId);
		this.availability = getValue(jsonResponse, kAvailability, String.class);
        /*if (jsonResponse.has(kAvailability)) {

        } else {
            this.availability = DefaultStatus.no.toString();
        }*/
        if (jsonResponse.has(kBatchSlotType)) {
            this.typeName = getValue(jsonResponse, kBatchSlotType, String.class);
        }
        if (jsonResponse.has(kPriceNo)) {
            this.price = getValue(jsonResponse, kPriceNo, String.class);
        }
        try {

            if (jsonResponse.has(kPricing)) {
                this.prices = handlePricing(getValue(jsonResponse, kPricing, JSONArray.class));
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }

    public UserBatchSlotAvailList(String facId, String sportId, String startTime, String endTime, String typeName,
								  String maxBook, String price, String availability) {
        this.facId = facId;
        this.sportId = sportId;
        this.startTime = startTime;
        this.endTime = endTime;
        this.typeName = typeName;
        this.maxBook = maxBook;
        this.price = price;
        this.availability = availability;
    }

    private String handleBatchSlot(int facId) {
        String type = "";
        CopyOnWriteArrayList<Facility> facilities = ModelManager.modelManager().getCurrentUser().getFacilities();
        for (int i = 0; i < facilities.size(); i++) {
            if (facId == facilities.get(i).getFacId()) {
                if (facilities.get(i).getFacType().equals(FacType.academy.toString()))
                    type = BatchSlotEnum.batch.toString();
                else if (facilities.get(i).getFacType().equals(FacType.facility.toString()))
                    type = BatchSlotEnum.slot.toString();
                break;
            }
        }
        return type;
    }


    private CopyOnWriteArrayList<UserBatchSlotPricing> handlePricing(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<UserBatchSlotPricing> prices = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            prices.add(new UserBatchSlotPricing(jsonArray.getJSONObject(i)));
        }
        return prices;
    }

    public String getFacId() {
        return facId;
    }

    public void setFacId(String facId) {
        this.facId = facId;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public String getSportId() {
        return sportId;
    }

    public void setSportId(String sportId) {
        this.sportId = sportId;
    }

    public String getTypeId() {
        return typeId;
    }

    public void setTypeId(String typeId) {
        this.typeId = typeId;
    }

    public String getPackageId() {
        return packageId;
    }

    public void setPackageId(String packageId) {
        this.packageId = packageId;
    }

    public String getBatchSlotId() {
        return batchSlotId;
    }

    public void setBatchSlotId(String batchSlotId) {
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


    public CopyOnWriteArrayList<UserBatchSlotPricing> getPrices() {
        return prices;
    }

    public void setPrices(CopyOnWriteArrayList<UserBatchSlotPricing> prices) {
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
