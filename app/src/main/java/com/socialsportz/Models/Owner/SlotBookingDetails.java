package com.socialsportz.Models.Owner;

import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class SlotBookingDetails extends BaseModel implements Serializable {
    private int id,bookingId,facId,sportId;
    private String sportName, facName, startDate, startTime,endTime;
    private int batch_slot_id,packageId;
    private String typeId;
    private String packageName,typeName,isTrail;
    private String detail_total_amount,detail_discount,detail_final_amount,detail_status;
	private String booking_detail_id;

	public String getCategoryType() {
		return categoryType;
	}

	public void setCategoryType(String categoryType) {
		this.categoryType = categoryType;
	}

	private String categoryType;

	public String getBs_cancel_on() {
		return bs_cancel_on;
	}

	public void setBs_cancel_on(String bs_cancel_on) {
		this.bs_cancel_on = bs_cancel_on;
	}

	public String getBs_cancel_status() {
		return bs_cancel_status;
	}

	public void setBs_cancel_status(String bs_cancel_status) {
		this.bs_cancel_status = bs_cancel_status;
	}

	public String getBs_cancel_reason() {
		return bs_cancel_reason;
	}

	public void setBs_cancel_reason(String bs_cancel_reason) {
		this.bs_cancel_reason = bs_cancel_reason;
	}

	public String getBs_cancel_charges() {
		return bs_cancel_charges;
	}

	public void setBs_cancel_charges(String bs_cancel_charges) {
		this.bs_cancel_charges = bs_cancel_charges;
	}

	public String getBs_other_charges() {
		return bs_other_charges;
	}

	public void setBs_other_charges(String bs_other_charges) {
		this.bs_other_charges = bs_other_charges;
	}

	public String getBs_refund_amount() {
		return bs_refund_amount;
	}

	public void setBs_refund_amount(String bs_refund_amount) {
		this.bs_refund_amount = bs_refund_amount;
	}

	private String bs_cancel_on;
	private String bs_cancel_status;
	private String bs_cancel_reason;
	private String bs_cancel_charges;
	private String bs_other_charges;
	private String bs_refund_amount;

	public String getBooking_detail_id() {
		return booking_detail_id;
	}

	public void setBooking_detail_id(String booking_detail_id) {
		this.booking_detail_id = booking_detail_id;
	}

	public SlotBookingDetails(JSONObject jsonResponse){
        this.id = Integer.valueOf(getValue(jsonResponse,kBookingDetailId,String.class));
        this.bookingId = Integer.valueOf(getValue(jsonResponse,kBookingId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResponse,kFacId,String.class));
        this.sportId = Integer.valueOf(getValue(jsonResponse,kSportId,String.class));
        //this.facName = getValue(jsonResponse,kFacName,String.class);
        this.sportName = getSportName(this.sportId);
        if(getValue(jsonResponse,kBookingTrial,String.class).equals(DefaultStatus.yes.toString()))
            this.isTrail = DefaultStatus.yes.toString();
        else
            this.isTrail = DefaultStatus.no.toString();
        this.startDate = getValue(jsonResponse,kBookingStartDate,String.class);
        this.startTime = getValue(jsonResponse,kBookingStartTime,String.class);
        this.endTime = getValue(jsonResponse,kBookingEndTime,String.class);
		this.booking_detail_id=getValue(jsonResponse,kBookingDetailId,String.class);
        //this.packageId = Integer.parseInt(getValue(jsonResponse,kPackageId,String.class));
        this.packageName = getValue(jsonResponse,kPackageName,String.class);
        this.typeId = getValue(jsonResponse,kTypeId,String.class);
        this.typeName = getValue(jsonResponse,kTypeName,String.class);
        this.categoryType=getValue(jsonResponse,kBatchSlotTypeName,String.class);
        this.detail_total_amount = getValue(jsonResponse,kBookingDetailTotal,String.class);
        this.detail_discount = getValue(jsonResponse,kBookingDetailDiscount,String.class);
        this.detail_final_amount = getValue(jsonResponse,kBookingDetailFinal,String.class);
        this.detail_status = getValue(jsonResponse,kBookingDetailStatus,String.class);
		this.bs_cancel_charges=getValue(jsonResponse,kcancelCharges,String.class);
		this.bs_cancel_on=getValue(jsonResponse,kcancelOn,String.class);
		this.bs_cancel_reason=getValue(jsonResponse,kCancelResion,String.class);
		this.bs_cancel_status=getValue(jsonResponse,kCancelStatus,String.class);
		this.bs_other_charges=getValue(jsonResponse,kOtherCharges,String.class);
		this.bs_refund_amount=getValue(jsonResponse,krefaundAmt,String.class);
    }

    public SlotBookingDetails(int id, String sportName, String startDate, String startTime, String endTime) {
        this.id = id;
        this.sportName = sportName;
        this.startDate = startDate;
        this.startTime = startTime;
        this.endTime = endTime;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public String getStartDate() {
        return startDate;
    }

    public void setStartDate(String startDate) {
        this.startDate = startDate;
    }

    public String getStartTime() {
        return startTime;
    }

    public void setStartTime(String startTime) {
        this.startTime = startTime;
    }

    public int getBookingId() {
        return bookingId;
    }

    public void setBookingId(int bookingId) {
        this.bookingId = bookingId;
    }

    public int getFacId() {
        return facId;
    }

    public void setFacId(int facId) {
        this.facId = facId;
    }

    public int getSportId() {
        return sportId;
    }

    public void setSportId(int sportId) {
        this.sportId = sportId;
    }

    public String getFacName() {
        return facName;
    }

    public void setFacName(String facName) {
        this.facName = facName;
    }

    public String getEndTime() {
        return endTime;
    }

    public void setEndTime(String endTime) {
        this.endTime = endTime;
    }

    public int getBatch_slot_id() {
        return batch_slot_id;
    }

    public void setBatch_slot_id(int batch_slot_id) {
        this.batch_slot_id = batch_slot_id;
    }

    public int getPackageId() {
        return packageId;
    }

    public void setPackageId(int packageId) {
        this.packageId = packageId;
    }

    public String getTypeId() {
        return typeId;
    }

    public void setTypeId(String typeId) {
        this.typeId = typeId;
    }

    public String getPackageName() {
        return packageName;
    }

    public void setPackageName(String packageName) {
        this.packageName = packageName;
    }

    public String getTypeName() {
        return typeName;
    }

    public void setTypeName(String typeName) {
        this.typeName = typeName;
    }

    public String getIsTrail() {
        return isTrail;
    }

    public void setIsTrail(String isTrail) {
        this.isTrail = isTrail;
    }

    public String getDetail_total_amount() {
        return detail_total_amount;
    }

    public void setDetail_total_amount(String detail_total_amount) {
        this.detail_total_amount = detail_total_amount;
    }

    public String getDetail_discount() {
        return detail_discount;
    }

    public void setDetail_discount(String detail_discount) {
        this.detail_discount = detail_discount;
    }

    public String getDetail_final_amount() {
        return detail_final_amount;
    }

    public void setDetail_final_amount(String detail_final_amount) {
        this.detail_final_amount = detail_final_amount;
    }

    public String getDetail_status() {
        return detail_status;
    }

    public void setDetail_status(String detail_status) {
        this.detail_status = detail_status;
    }

    private String getSportName(int sportId){
        String name = "";
        try{
            CopyOnWriteArrayList<Sport> sports = ModelManager.modelManager().getCurrentUser().getSports();
            if(!sports.isEmpty()){
                for(int i=0;i<sports.size();i++){
                    if(sports.get(i).getSportId()==sportId){
                        name = sports.get(i).getSportName();
                        break;
                    }
                }
            }
        }catch (Exception e){
            e.printStackTrace();
            return kEmptyString;
        }
        return name;
    }
}
