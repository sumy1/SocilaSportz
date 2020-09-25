package com.socialsportz.Models.User;

import org.json.JSONObject;

import static com.socialsportz.Constants.Constants.kBatchSlotId;
import static com.socialsportz.Constants.Constants.kBatchSlotTypeName;
import static com.socialsportz.Constants.Constants.kBookingDetailDiscount;
import static com.socialsportz.Constants.Constants.kBookingDetailFinal;
import static com.socialsportz.Constants.Constants.kBookingDetailId;
import static com.socialsportz.Constants.Constants.kBookingDetailStatus;
import static com.socialsportz.Constants.Constants.kBookingDetailTotal;
import static com.socialsportz.Constants.Constants.kBookingEndTime;
import static com.socialsportz.Constants.Constants.kBookingId;
import static com.socialsportz.Constants.Constants.kBookingStartTime;
import static com.socialsportz.Constants.Constants.kCancelResion;
import static com.socialsportz.Constants.Constants.kCancelStatus;
import static com.socialsportz.Constants.Constants.kCreatedOn;
import static com.socialsportz.Constants.Constants.kEndDate;
import static com.socialsportz.Constants.Constants.kEventCancelReqStatus;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFolderName;
import static com.socialsportz.Constants.Constants.kIsTrial;
import static com.socialsportz.Constants.Constants.kOtherCharges;
import static com.socialsportz.Constants.Constants.kPackageId;
import static com.socialsportz.Constants.Constants.kPackageName;
import static com.socialsportz.Constants.Constants.kSportIcon;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kSportName;
import static com.socialsportz.Constants.Constants.kStartDate;
import static com.socialsportz.Constants.Constants.kTypeId;
import static com.socialsportz.Constants.Constants.kUpdatedOn;
import static com.socialsportz.Constants.Constants.kcancelCharges;
import static com.socialsportz.Constants.Constants.kcancelOn;
import static com.socialsportz.Constants.Constants.kfacilityApporval;
import static com.socialsportz.Constants.Constants.krefaundAmt;
import static com.socialsportz.Models.BaseModel.getValue;

public class BatchSlotList {



	public BatchSlotList(JSONObject jsonObject){
		this.batch_slot_end_time=getValue(jsonObject,kBookingEndTime,String.class);
		this.batch_slot_start_time=getValue(jsonObject,kBookingStartTime,String.class);
		this.batch_slot_id=getValue(jsonObject,kBatchSlotId,String.class);
		this.batch_slot_type_id=getValue(jsonObject,kTypeId,String.class);
		this.batch_slot_type_name=getValue(jsonObject,kBatchSlotTypeName,String.class);
		this.booking_detail_discount=getValue(jsonObject,kBookingDetailDiscount,String.class);
		this.booking_detail_final_amount=getValue(jsonObject,kBookingDetailFinal,String.class);
		this.booking_detail_id=getValue(jsonObject,kBookingDetailId,String.class);
		this.booking_detail_status=getValue(jsonObject,kBookingDetailStatus,String.class);
		this.booking_detail_total_amount=getValue(jsonObject,kBookingDetailTotal,String.class);
		this.booking_order_id=getValue(jsonObject,kBookingId,String.class);
		this.bs_cancel_charges=getValue(jsonObject,kcancelCharges,String.class);
		this.bs_cancel_on=getValue(jsonObject,kcancelOn,String.class);
		this.bs_cancel_reason=getValue(jsonObject,kCancelResion,String.class);
		this.bs_cancel_status=getValue(jsonObject,kCancelStatus,String.class);
		this.bs_other_charges=getValue(jsonObject,kOtherCharges,String.class);
		this.bs_refund_amount=getValue(jsonObject,krefaundAmt,String.class);
		this.created_on=getValue(jsonObject,kCreatedOn,String.class);
		this.end_date=getValue(jsonObject,kEndDate,String.class);
		this.fac_id=getValue(jsonObject,kFacId,String.class);
		this.facility_approval=getValue(jsonObject,kfacilityApporval,String.class);
		this.is_trial=getValue(jsonObject,kIsTrial,String.class);
		this.package_id=getValue(jsonObject,kPackageId,String.class);
		this.package_name=getValue(jsonObject,kPackageName,String.class);
		this.sport_icon=getValue(jsonObject,kSportIcon,String.class);
		this.sport_id=getValue(jsonObject,kSportId,String.class);
		this.sport_name=getValue(jsonObject,kSportName,String.class);
		this.start_date=getValue(jsonObject,kStartDate,String.class);
		this.updated_on=getValue(jsonObject,kUpdatedOn,String.class);
		this.batchSlotType=getValue(jsonObject,kBatchSlotTypeName,String.class);
		this.eventCancelRegStatus=getValue(jsonObject,kEventCancelReqStatus,String.class);
		this.folderName = getValue(jsonObject,kFolderName,String.class);


	}

	public String getBooking_detail_id() {
		return booking_detail_id;
	}

	public void setBooking_detail_id(String booking_detail_id) {
		this.booking_detail_id = booking_detail_id;
	}

	public String getBooking_order_id() {
		return booking_order_id;
	}

	public void setBooking_order_id(String booking_order_id) {
		this.booking_order_id = booking_order_id;
	}

	public String getIs_trial() {
		return is_trial;
	}

	public void setIs_trial(String is_trial) {
		this.is_trial = is_trial;
	}

	public String getFac_id() {
		return fac_id;
	}

	public void setFac_id(String fac_id) {
		this.fac_id = fac_id;
	}

	public String getSport_id() {
		return sport_id;
	}

	public void setSport_id(String sport_id) {
		this.sport_id = sport_id;
	}

	public String getBatch_slot_id() {
		return batch_slot_id;
	}

	public void setBatch_slot_id(String batch_slot_id) {
		this.batch_slot_id = batch_slot_id;
	}

	public String getBatch_slot_start_time() {
		return batch_slot_start_time;
	}

	public void setBatch_slot_start_time(String batch_slot_start_time) {
		this.batch_slot_start_time = batch_slot_start_time;
	}

	public String getBatch_slot_end_time() {
		return batch_slot_end_time;
	}

	public void setBatch_slot_end_time(String batch_slot_end_time) {
		this.batch_slot_end_time = batch_slot_end_time;
	}

	public String getPackage_id() {
		return package_id;
	}

	public void setPackage_id(String package_id) {
		this.package_id = package_id;
	}

	public String getPackage_name() {
		return package_name;
	}

	public void setPackage_name(String package_name) {
		this.package_name = package_name;
	}

	public String getBatch_slot_type_id() {
		return batch_slot_type_id;
	}

	public void setBatch_slot_type_id(String batch_slot_type_id) {
		this.batch_slot_type_id = batch_slot_type_id;
	}

	public String getBatch_slot_type_name() {
		return batch_slot_type_name;
	}

	public void setBatch_slot_type_name(String batch_slot_type_name) {
		this.batch_slot_type_name = batch_slot_type_name;
	}

	public String getStart_date() {
		return start_date;
	}

	public void setStart_date(String start_date) {
		this.start_date = start_date;
	}

	public String getEnd_date() {
		return end_date;
	}

	public void setEnd_date(String end_date) {
		this.end_date = end_date;
	}

	public String getBooking_detail_total_amount() {
		return booking_detail_total_amount;
	}

	public void setBooking_detail_total_amount(String booking_detail_total_amount) {
		this.booking_detail_total_amount = booking_detail_total_amount;
	}

	public String getBooking_detail_discount() {
		return booking_detail_discount;
	}

	public void setBooking_detail_discount(String booking_detail_discount) {
		this.booking_detail_discount = booking_detail_discount;
	}

	public String getBooking_detail_final_amount() {
		return booking_detail_final_amount;
	}

	public void setBooking_detail_final_amount(String booking_detail_final_amount) {
		this.booking_detail_final_amount = booking_detail_final_amount;
	}

	public String getBooking_detail_status() {
		return booking_detail_status;
	}

	public void setBooking_detail_status(String booking_detail_status) {
		this.booking_detail_status = booking_detail_status;
	}

	public String getFacility_approval() {
		return facility_approval;
	}

	public void setFacility_approval(String facility_approval) {
		this.facility_approval = facility_approval;
	}

	public String getCreated_on() {
		return created_on;
	}

	public void setCreated_on(String created_on) {
		this.created_on = created_on;
	}

	public String getUpdated_on() {
		return updated_on;
	}

	public void setUpdated_on(String updated_on) {
		this.updated_on = updated_on;
	}

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

	public String getSport_name() {
		return sport_name;
	}

	public void setSport_name(String sport_name) {
		this.sport_name = sport_name;
	}

	public String getSport_icon() {
		return sport_icon;
	}

	public void setSport_icon(String sport_icon) {
		this.sport_icon = sport_icon;
	}

	private String booking_detail_id;
	private String booking_order_id;
	private String is_trial;
	private String fac_id;
	private String sport_id;
	private String batch_slot_id;
	private String batch_slot_start_time;
	private String batch_slot_end_time;
	private String package_id;
	private String package_name;
	private String batch_slot_type_id;
	private String batch_slot_type_name;
	private String start_date;
	private String end_date;
	private String booking_detail_total_amount;
	private String booking_detail_discount;
	private String booking_detail_final_amount;
	private String booking_detail_status;
	private String facility_approval;
	private String created_on;
	private String updated_on;
	private String bs_cancel_on;
	private String bs_cancel_status;
	private String bs_cancel_reason;
	private String bs_cancel_charges;
	private String bs_other_charges;
	private String bs_refund_amount;
	private String sport_name;
	private String sport_icon;
	private String folderName;

	public String getBatchSlotType() {
		return batchSlotType;
	}

	public void setBatchSlotType(String batchSlotType) {
		this.batchSlotType = batchSlotType;
	}

	private String batchSlotType;

	public String getFolderName() {
		return folderName;
	}

	public void setFolderName(String folderName) {
		this.folderName = folderName;
	}

	public boolean isSelected() {
		return isSelected;
	}

	public void setSelected(boolean selected) {
		isSelected = selected;
	}

	private boolean isSelected;

	public String getEventCancelRegStatus() {
		return eventCancelRegStatus;
	}

	public void setEventCancelRegStatus(String eventCancelRegStatus) {
		this.eventCancelRegStatus = eventCancelRegStatus;
	}

	private String eventCancelRegStatus;


}

