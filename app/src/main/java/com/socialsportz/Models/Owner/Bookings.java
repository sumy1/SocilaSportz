package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class Bookings extends BaseModel implements Serializable {
    private int booking_id;
    private int user_id;
    private String booking_order,taxes,coupon,discount,total_amount,final_amount;
    private String pay_transaction_id;
	private String pay_transaction_other;
	private String pay_status;
	private String pay_method;

	public String getCancelOn() {
		return cancelOn;
	}

	public void setCancelOn(String cancelOn) {
		this.cancelOn = cancelOn;
	}

	private String cancelOn;
    private String name;
	private String mail;
	private String mobile;
	private String city;
	private String address;
	private String state;
	private String country;
	private String status;
	private String type;
	private String date;

	public String getBatch_slot_type_name() {
		return batch_slot_type_name;
	}

	public void setBatch_slot_type_name(String batch_slot_type_name) {
		this.batch_slot_type_name = batch_slot_type_name;
	}

	private String batch_slot_type_name;

	public String getEventcancelDate() {
		return eventcancelDate;
	}

	public void setEventcancelDate(String eventcancelDate) {
		this.eventcancelDate = eventcancelDate;
	}

	public String getEventCancelresion() {
		return eventCancelresion;
	}

	public void setEventCancelresion(String eventCancelresion) {
		this.eventCancelresion = eventCancelresion;
	}

	public String getEventcancelCharge() {
		return eventcancelCharge;
	}

	public void setEventcancelCharge(String eventcancelCharge) {
		this.eventcancelCharge = eventcancelCharge;
	}

	public String getEventCancelOtherCharge() {
		return eventCancelOtherCharge;
	}

	public void setEventCancelOtherCharge(String eventCancelOtherCharge) {
		this.eventCancelOtherCharge = eventCancelOtherCharge;
	}

	public String getEventCancelRefundAmnt() {
		return eventCancelRefundAmnt;
	}

	public void setEventCancelRefundAmnt(String eventCancelRefundAmnt) {
		this.eventCancelRefundAmnt = eventCancelRefundAmnt;
	}

	public String getEventRefundStatus() {
		return eventRefundStatus;
	}

	public void setEventRefundStatus(String eventRefundStatus) {
		this.eventRefundStatus = eventRefundStatus;
	}

	public String getEventCancelRegStatus() {
		return eventCancelRegStatus;
	}

	public void setEventCancelRegStatus(String eventCancelRegStatus) {
		this.eventCancelRegStatus = eventCancelRegStatus;
	}

	public String getEventConveniencefee() {
		return EventConveniencefee;
	}

	public void setEventConveniencefee(String eventConveniencefee) {
		EventConveniencefee = eventConveniencefee;
	}

	public String getEventConveniencetax() {
		return EventConveniencetax;
	}

	public void setEventConveniencetax(String eventConveniencetax) {
		EventConveniencetax = eventConveniencetax;
	}

	private String eventcancelDate;
	private String eventCancelresion;
	private String eventcancelCharge="";
	private String eventCancelOtherCharge="";
	private String eventCancelRefundAmnt;
	private String eventRefundStatus;
	private String eventCancelRegStatus;
	private String EventConveniencefee;
	private String EventConveniencetax;

	public String getPackageName() {
		return packageName;
	}

	public void setPackageName(String packageName) {
		this.packageName = packageName;
	}

	private String packageName;

	public String getBokingFor() {
		return bokingFor;
	}

	public void setBokingFor(String bokingFor) {
		this.bokingFor = bokingFor;
	}

	private String bokingFor;

	public String getBookingStartDate() {
		return BookingStartDate;
	}

	public void setBookingStartDate(String bookingStartDate) {
		BookingStartDate = bookingStartDate;
	}

	private String BookingStartDate;

	public String getBatchSlotETime() {
		return batchSlotETime;
	}

	public void setBatchSlotETime(String batchSlotETime) {
		this.batchSlotETime = batchSlotETime;
	}

	private String batchSlotETime;

	public String getBatchSlotSTime() {
		return batchSlotSTime;
	}

	public void setBatchSlotSTime(String batchSlotSTime) {
		this.batchSlotSTime = batchSlotSTime;
	}

	private String batchSlotSTime;

	public String getSportName() {
		return sportName;
	}

	public void setSportName(String sportName) {
		this.sportName = sportName;
	}

	private String sportName;

	public String getFacility_folder_name() {
		return facility_folder_name;
	}

	public void setFacility_folder_name(String facility_folder_name) {
		this.facility_folder_name = facility_folder_name;
	}

	private String facility_folder_name;

	public String getFolder_name() {
		return folder_name;
	}

	public void setFolder_name(String folder_name) {
		this.folder_name = folder_name;
	}

	private String folder_name;

	public String getFac_banner_image() {
		return fac_banner_image;
	}

	public void setFac_banner_image(String fac_banner_image) {
		this.fac_banner_image = fac_banner_image;
	}

	private String fac_banner_image;

	public String getUser_profile_image() {
		return user_profile_image;
	}

	public void setUser_profile_image(String user_profile_image) {
		this.user_profile_image = user_profile_image;
	}

	public String getFolder_names() {
		return folder_names;
	}

	public void setFolder_names(String folder_names) {
		this.folder_names = folder_names;
	}

	private String user_profile_image,folder_names;
    private CopyOnWriteArrayList<SlotBookingDetails> bookingListModels;
    private EventBookingDetails eventBookingDetails;

	public String getDownloadReceipt() {
		return downloadReceipt;
	}

	public void setDownloadReceipt(String downloadReceipt) {
		this.downloadReceipt = downloadReceipt;
	}

	private String downloadReceipt;

    public Bookings(JSONObject jsonResponse){
        this.booking_id = Integer.valueOf(getValue(jsonResponse,kBookingId,String.class));
        this.booking_order = getValue(jsonResponse,kBookingOrder,String.class);

        this.user_id = Integer.valueOf(getValue(jsonResponse,kUserId,String.class));
        this.name = getValue(jsonResponse,kBookingName,String.class);
        this.mail = getValue(jsonResponse,kBookingEmail,String.class);
        this.mobile = getValue(jsonResponse,kBookingMobile,String.class);
		this.downloadReceipt=getValue(jsonResponse,kUDownloadReceipt,String.class);
        this.address = getValue(jsonResponse,kBookingAddress,String.class);
        this.city = getValue(jsonResponse,kBookingCity,String.class);
        //this.state = getValue(jsonResponse,kBookingState,String.class);
        //this.country = getValue(jsonResponse,kBookingCountry,String.class);
		this.sportName=getValue(jsonResponse,kSportName,String.class);
		this.batchSlotSTime=getValue(jsonResponse,kBookingStartTime,String.class);
		this.batchSlotETime=getValue(jsonResponse,kBookingEndTime,String.class);
		this.BookingStartDate=getValue(jsonResponse,kBookingStartDate,String.class);

        this.total_amount = getValue(jsonResponse,kBookingTotal,String.class);
        this.batch_slot_type_name=getValue(jsonResponse,kBatchSlotTypeName,String.class);
        this.taxes = getValue(jsonResponse,kBookingTaxes,String.class);
        this.coupon = getValue(jsonResponse,kBookingCoupon,String.class);
        this.discount = getValue(jsonResponse,kBookingDiscount,String.class);
        this.final_amount = getValue(jsonResponse,kBookingFinal,String.class);
		this.bokingFor=getValue(jsonResponse,kBookingFor,String.class);
        this.pay_transaction_id = getValue(jsonResponse,kPaymentTranId,String.class);
        this.pay_transaction_other = getValue(jsonResponse,kPaymentTranOther,String.class);
        this.pay_status = getValue(jsonResponse,kPaymentStatus,String.class);
        this.pay_method = getValue(jsonResponse,kPaymentMethod,String.class);
        this.user_profile_image=getValue(jsonResponse,kReviewUserImage,String.class);
        this.folder_names=getValue(jsonResponse,kFolderNames,String.class);
        this.fac_banner_image=getValue(jsonResponse,kFacBanner,String.class);
        this.folder_name=getValue(jsonResponse,kFolderName,String.class);
        this.facility_folder_name=getValue(jsonResponse,kfacFolderName,String.class);
        this.type = getValue(jsonResponse,kBookingType,String.class);
        this.status = getValue(jsonResponse,kBookingStatus,String.class);

		this.eventcancelCharge=getValue(jsonResponse,kEventCancelCharge,String.class);
		this.eventCancelOtherCharge=getValue(jsonResponse,kEventOtherCharge,String.class);
		this.eventCancelRefundAmnt=getValue(jsonResponse,kEventCancelRefundAmnt,String.class);
		this.eventcancelDate=getValue(jsonResponse,kEventCanceldate,String.class);
		this.eventCancelresion=getValue(jsonResponse,kEventCancelReason,String.class);
		this.eventRefundStatus=getValue(jsonResponse,kEventCancelRefundStatus,String.class);
		this.eventCancelRegStatus=getValue(jsonResponse,kEventCancelReqStatus,String.class);
		this.EventConveniencetax=getValue(jsonResponse,kconveniensTexes,String.class);
		this.EventConveniencefee=getValue(jsonResponse,kCovenienceFee,String.class);
		this.packageName=getValue(jsonResponse,kPackageName,String.class);


        this.date = Utils.changeDateTimeFormat(getValue(jsonResponse,kBookingDate,String.class));
        if(jsonResponse.has(kBookingDetails)){
            try {
                this.bookingListModels = handleBookingDetails(getValue(jsonResponse,kBookingDetails,JSONArray.class));
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        if(jsonResponse.has(kEventBookingDetails)){
            try {
                this.eventBookingDetails = new EventBookingDetails(jsonResponse.getJSONObject(kEventBookingDetails));
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

    public Bookings(int booking_id,String booking_order, String name, String mail, String mobile,
                    String status,String type,CopyOnWriteArrayList<SlotBookingDetails> bookingListModels) {
        this.booking_id = booking_id;
        this.booking_order = booking_order;
        this.name = name;
        this.mail = mail;
        this.mobile = mobile;
        this.status = status;
        this.type = type;
        this.bookingListModels=bookingListModels;
    }

    public int getBooking_id() {
        return booking_id;
    }

    public void setBooking_id(int booking_id) {
        this.booking_id = booking_id;
    }

    public int getUser_id() {
        return user_id;
    }

    public void setUser_id(int user_id) {
        this.user_id = user_id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getMail() {
        return mail;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }

    public String getMobile() {
        return mobile;
    }

    public void setMobile(String mobile) {
        this.mobile = mobile;
    }

    public String getBooking_order() {
        return booking_order;
    }

    public void setBooking_order(String booking_order) {
        this.booking_order = booking_order;
    }

    public String getTaxes() {
        return taxes;
    }

    public void setTaxes(String taxes) {
        this.taxes = taxes;
    }

    public String getCoupon() {
        return coupon;
    }

    public void setCoupon(String coupon) {
        this.coupon = coupon;
    }

    public String getDiscount() {
        return discount;
    }

    public void setDiscount(String discount) {
        this.discount = discount;
    }

    public String getTotal_amount() {
        return total_amount;
    }

    public void setTotal_amount(String total_amount) {
        this.total_amount = total_amount;
    }

    public String getFinal_amount() {
        return final_amount;
    }

    public void setFinal_amount(String final_amount) {
        this.final_amount = final_amount;
    }

    public String getPay_transaction_id() {
        return pay_transaction_id;
    }

    public void setPay_transaction_id(String pay_transaction_id) {
        this.pay_transaction_id = pay_transaction_id;
    }

    public String getPay_transaction_other() {
        return pay_transaction_other;
    }

    public void setPay_transaction_other(String pay_transaction_other) {
        this.pay_transaction_other = pay_transaction_other;
    }

    public String getPay_status() {
        return pay_status;
    }

    public void setPay_status(String pay_status) {
        this.pay_status = pay_status;
    }

    public String getPay_method() {
        return pay_method;
    }

    public void setPay_method(String pay_method) {
        this.pay_method = pay_method;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getCountry() {
        return country;
    }

    public void setCountry(String country) {
        this.country = country;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public CopyOnWriteArrayList<SlotBookingDetails> getBookingListModels() {
        return bookingListModels;
    }

    public void setBookingListModels(CopyOnWriteArrayList<SlotBookingDetails> bookingListModels) {
        this.bookingListModels = bookingListModels;
    }

    private CopyOnWriteArrayList<SlotBookingDetails> handleBookingDetails(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<SlotBookingDetails> bookings = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            bookings.add(new SlotBookingDetails(jsonArray.getJSONObject(i)));
        }
        return bookings;
    }

    public EventBookingDetails getEventBookingDetails() {
        return eventBookingDetails;
    }

    public void setEventBookingDetails(EventBookingDetails eventBookingDetails) {
        this.eventBookingDetails = eventBookingDetails;
    }
}
