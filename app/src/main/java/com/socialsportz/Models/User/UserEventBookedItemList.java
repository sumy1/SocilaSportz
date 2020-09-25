package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserEventBookedItemList extends BaseModel implements Serializable {

    private String userId;
    private String bookedOrdeNo;
    private String bookingID;
    private String bookingStatus;
    private String userNmae;
    private  String bookingOn;
    private String bokingFor;
    private String facId;
    private String facName;
    private String facSlug;
    private String facType;
    private String facDes;
    private String facShotDes;
    private String facCity;
    private String facState;
    private String facCountry;
    private String facAddress;
    private String facGoogleAddess;
    private String facPin;
    private String facLat;
    private String facLang;
    private String facBaImage;
    private String facLogoImg;
    private String facmetaTitle;
    private String facMetaDes;
    private String facMetakeywd;
    private String facStatus;
    private String adminAproved;
    private String isHome;
    private String adminAproAmnt;
    private String createdOn;
    private String updatedOn;
    private String createBytype;
    private String updateBytype;
    private String eventVenue;
    private String eventgoogleAddes;
    private String eventBanner;
    private String sportName;
    private String foldername;

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

	private String eventcancelDate;
    private String eventCancelresion;
    private String eventcancelCharge="";
    private String eventCancelOtherCharge="";
    private String eventCancelRefundAmnt;
    private String eventRefundStatus;


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

	private String EventConveniencefee;
    private String EventConveniencetax;

	public String getEventCancelRegStatus() {
		return eventCancelRegStatus;
	}

	public void setEventCancelRegStatus(String eventCancelRegStatus) {
		this.eventCancelRegStatus = eventCancelRegStatus;
	}

	private String eventCancelRegStatus;






	public String getDownloadReceipt() {
		return downloadReceipt;
	}

	public void setDownloadReceipt(String downloadReceipt) {
		this.downloadReceipt = downloadReceipt;
	}

	private String downloadReceipt;

	public String getEventendDate() {
		return eventendDate;
	}

	public void setEventendDate(String eventendDate) {
		this.eventendDate = eventendDate;
	}

	private String eventendDate;

	public String getTotalAmt() {
		return totalAmt;
	}

	public void setTotalAmt(String totalAmt) {
		this.totalAmt = totalAmt;
	}

	public String getDisAmt() {
		return disAmt;
	}

	public void setDisAmt(String disAmt) {
		this.disAmt = disAmt;
	}

	public String getFinalAmt() {
		return finalAmt;
	}

	public void setFinalAmt(String finalAmt) {
		this.finalAmt = finalAmt;
	}

	public String getBookingStartdate() {
		return bookingStartdate;
	}

	public void setBookingStartdate(String bookingStartdate) {
		this.bookingStartdate = bookingStartdate;
	}

	public String getBatchSlotETime() {
		return batchSlotETime;
	}

	public void setBatchSlotETime(String batchSlotETime) {
		this.batchSlotETime = batchSlotETime;
	}

	public String getBatchSlotSTime() {
		return batchSlotSTime;
	}

	public void setBatchSlotSTime(String batchSlotSTime) {
		this.batchSlotSTime = batchSlotSTime;
	}

	public String getBooking_type() {
		return booking_type;
	}

	public void setBooking_type(String booking_type) {
		this.booking_type = booking_type;
	}

	private String totalAmt;
	private String disAmt;
	private String finalAmt;
	private String bookingStartdate;
	private String batchSlotETime;
	private String batchSlotSTime;
	private String booking_type;

	public String getPaymentStatus() {
		return paymentStatus;
	}

	public void setPaymentStatus(String paymentStatus) {
		this.paymentStatus = paymentStatus;
	}

	private String paymentStatus;


	public String getSportIcon() {
		return SportIcon;
	}

	public void setSportIcon(String sportIcon) {
		SportIcon = sportIcon;
	}

	public String getSportFolderName() {
		return SportFolderName;
	}

	public void setSportFolderName(String sportFolderName) {
		SportFolderName = sportFolderName;
	}

	private String SportIcon;
	private String SportFolderName;


    public UserEventBookedItemList(JSONObject jsonObject){
        this.adminAproAmnt=getValue(jsonObject,kAdminApprovedCmt,String.class);
        this.userId=getValue(jsonObject,kUserId,String.class);
        this.foldername=getValue(jsonObject,kFolderName,String.class);
        this.sportName=getValue(jsonObject,kSportName,String.class);
        this.eventBanner=getValue(jsonObject,kEventBanner,String.class);
        this.eventgoogleAddes=getValue(jsonObject,kEventGoogleADDress,String.class);
        this.eventVenue=getValue(jsonObject,kEventVenue,String.class);
        this.updateBytype=getValue(jsonObject,kUpdatedBy,String.class);
        this.createBytype=getValue(jsonObject,kCreateBy,String.class);
        this.updatedOn=getValue(jsonObject,kUpdatedOn,String.class);
        this.createdOn=getValue(jsonObject,kCreatedOn,String.class);
        this.isHome=getValue(jsonObject,kIsHome,String.class);
        this.adminAproved=getValue(jsonObject,kAdminApproved,String.class);
		this.totalAmt=getValue(jsonObject,kBookingTotal,String.class);
		this.disAmt=getValue(jsonObject,kBookingDiscount,String.class);
		this.finalAmt=getValue(jsonObject,kBookingFinal,String.class);
        this.facStatus=getValue(jsonObject,kFacStatus,String.class);
        this.facMetakeywd=getValue(jsonObject,kfavMetaKeywd,String.class);
        this.facMetaDes=getValue(jsonObject,kFacMetadEs,String.class);
        this.facmetaTitle=getValue(jsonObject,kfacmetaTile,String.class);
        this.facCountry=getValue(jsonObject,kFacCountry,String.class);
        this.facBaImage=getValue(jsonObject,kFacBanner,String.class);
        this.facLang=getValue(jsonObject,kFacLng,String.class);
        this.facLat=getValue(jsonObject,kFacLat,String.class);
        this.facPin=getValue(jsonObject,kFacPincode,String.class);
		this.booking_type=getValue(jsonObject,kBookingType,String.class);
		this.eventendDate=getValue(jsonObject,kEventEndDate,String.class);
		this.downloadReceipt=getValue(jsonObject,kUDownloadReceipt,String.class);

        this.facGoogleAddess=getValue(jsonObject,kFacGoogle,String.class);
        this.facAddress=getValue(jsonObject,kFacAddress,String.class);
        this.facState=getValue(jsonObject,kFacState,String.class);
        this.facCity=getValue(jsonObject,kFacCity,String.class);
        this.facShotDes=getValue(jsonObject,kFacShort,String.class);
        this.facType=getValue(jsonObject,kFacType,String.class);
        this.facSlug=getValue(jsonObject,kfacSlug,String.class);
        this.facName=getValue(jsonObject,kFacName,String.class);
        this.facId=getValue(jsonObject,kFacId,String.class);
        this.bokingFor=getValue(jsonObject,kBookingFor,String.class);
        this.bookingOn=getValue(jsonObject,kBookingDate,String.class);
        this.userNmae=getValue(jsonObject,kUserName,String.class);
        this.bookingStatus=getValue(jsonObject,kBookingStatus,String.class);
		this.batchSlotSTime=getValue(jsonObject,kEventStartTime,String.class);
		this.bookingStartdate=getValue(jsonObject,kEventStartDate,String.class);
		this.SportIcon=getValue(jsonObject,kSportIcon,String.class);
		this.SportFolderName=getValue(jsonObject,kSpotsFolderBanner,String.class);
		this.batchSlotETime=getValue(jsonObject,kEventEndTime,String.class);

		this.SportIcon=getValue(jsonObject,kSportIcon,String.class);
		this.SportFolderName=getValue(jsonObject,kSpotsFolderBanner,String.class);

        this.bookingID=getValue(jsonObject,kBookingId,String.class);
        this.bookedOrdeNo=getValue(jsonObject,kBookingOrder,String.class);;
		this.paymentStatus=getValue(jsonObject,kPaymentStatus,String.class);
		this.eventcancelCharge=getValue(jsonObject,kEventCancelCharge,String.class);
		this.eventCancelOtherCharge=getValue(jsonObject,kEventOtherCharge,String.class);
		this.eventCancelRefundAmnt=getValue(jsonObject,kEventCancelRefundAmnt,String.class);
		this.eventcancelDate=getValue(jsonObject,kEventCanceldate,String.class);
		this.eventCancelresion=getValue(jsonObject,kEventCancelReason,String.class);
		this.eventRefundStatus=getValue(jsonObject,kEventCancelRefundStatus,String.class);
		this.eventCancelRegStatus=getValue(jsonObject,kEventCancelReqStatus,String.class);
		this.EventConveniencetax=getValue(jsonObject,kconveniensTexes,String.class);
		this.EventConveniencefee=getValue(jsonObject,kCovenienceFee,String.class);

    }


    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getBookedOrdeNo() {
        return bookedOrdeNo;
    }

    public void setBookedOrdeNo(String bookedOrdeNo) {
        this.bookedOrdeNo = bookedOrdeNo;
    }

    public String getBookingID() {
        return bookingID;
    }

    public void setBookingID(String bookingID) {
        this.bookingID = bookingID;
    }

    public String getBookingStatus() {
        return bookingStatus;
    }

    public void setBookingStatus(String bookingStatus) {
        this.bookingStatus = bookingStatus;
    }

    public String getUserNmae() {
        return userNmae;
    }

    public void setUserNmae(String userNmae) {
        this.userNmae = userNmae;
    }

    public String getBookingOn() {
        return bookingOn;
    }

    public void setBookingOn(String bookingOn) {
        this.bookingOn = bookingOn;
    }

    public String getBokingFor() {
        return bokingFor;
    }

    public void setBokingFor(String bokingFor) {
        this.bokingFor = bokingFor;
    }

    public String getFacId() {
        return facId;
    }

    public void setFacId(String facId) {
        this.facId = facId;
    }

    public String getFacName() {
        return facName;
    }

    public void setFacName(String facName) {
        this.facName = facName;
    }

    public String getFacSlug() {
        return facSlug;
    }

    public void setFacSlug(String facSlug) {
        this.facSlug = facSlug;
    }

    public String getFacType() {
        return facType;
    }

    public void setFacType(String facType) {
        this.facType = facType;
    }

    public String getFacDes() {
        return facDes;
    }

    public void setFacDes(String facDes) {
        this.facDes = facDes;
    }

    public String getFacShotDes() {
        return facShotDes;
    }

    public void setFacShotDes(String facShotDes) {
        this.facShotDes = facShotDes;
    }

    public String getFacCity() {
        return facCity;
    }

    public void setFacCity(String facCity) {
        this.facCity = facCity;
    }

    public String getFacState() {
        return facState;
    }

    public void setFacState(String facState) {
        this.facState = facState;
    }

    public String getFacCountry() {
        return facCountry;
    }

    public void setFacCountry(String facCountry) {
        this.facCountry = facCountry;
    }

    public String getFacAddress() {
        return facAddress;
    }

    public void setFacAddress(String facAddress) {
        this.facAddress = facAddress;
    }

    public String getFacGoogleAddess() {
        return facGoogleAddess;
    }

    public void setFacGoogleAddess(String facGoogleAddess) {
        this.facGoogleAddess = facGoogleAddess;
    }

    public String getFacPin() {
        return facPin;
    }

    public void setFacPin(String facPin) {
        this.facPin = facPin;
    }

    public String getFacLat() {
        return facLat;
    }

    public void setFacLat(String facLat) {
        this.facLat = facLat;
    }

    public String getFacLang() {
        return facLang;
    }

    public void setFacLang(String facLang) {
        this.facLang = facLang;
    }

    public String getFacBaImage() {
        return facBaImage;
    }

    public void setFacBaImage(String facBaImage) {
        this.facBaImage = facBaImage;
    }

    public String getFacLogoImg() {
        return facLogoImg;
    }

    public void setFacLogoImg(String facLogoImg) {
        this.facLogoImg = facLogoImg;
    }

    public String getFacmetaTitle() {
        return facmetaTitle;
    }

    public void setFacmetaTitle(String facmetaTitle) {
        this.facmetaTitle = facmetaTitle;
    }

    public String getFacMetaDes() {
        return facMetaDes;
    }

    public void setFacMetaDes(String facMetaDes) {
        this.facMetaDes = facMetaDes;
    }

    public String getFacMetakeywd() {
        return facMetakeywd;
    }

    public void setFacMetakeywd(String facMetakeywd) {
        this.facMetakeywd = facMetakeywd;
    }

    public String getFacStatus() {
        return facStatus;
    }

    public void setFacStatus(String facStatus) {
        this.facStatus = facStatus;
    }

    public String getAdminAproved() {
        return adminAproved;
    }

    public void setAdminAproved(String adminAproved) {
        this.adminAproved = adminAproved;
    }

    public String getIsHome() {
        return isHome;
    }

    public void setIsHome(String isHome) {
        this.isHome = isHome;
    }

    public String getAdminAproAmnt() {
        return adminAproAmnt;
    }

    public void setAdminAproAmnt(String adminAproAmnt) {
        this.adminAproAmnt = adminAproAmnt;
    }

    public String getCreatedOn() {
        return createdOn;
    }

    public void setCreatedOn(String createdOn) {
        this.createdOn = createdOn;
    }

    public String getUpdatedOn() {
        return updatedOn;
    }

    public void setUpdatedOn(String updatedOn) {
        this.updatedOn = updatedOn;
    }

    public String getCreateBytype() {
        return createBytype;
    }

    public void setCreateBytype(String createBytype) {
        this.createBytype = createBytype;
    }

    public String getUpdateBytype() {
        return updateBytype;
    }

    public void setUpdateBytype(String updateBytype) {
        this.updateBytype = updateBytype;
    }

    public String getEventVenue() {
        return eventVenue;
    }

    public void setEventVenue(String eventVenue) {
        this.eventVenue = eventVenue;
    }

    public String getEventgoogleAddes() {
        return eventgoogleAddes;
    }

    public void setEventgoogleAddes(String eventgoogleAddes) {
        this.eventgoogleAddes = eventgoogleAddes;
    }

    public String getEventBanner() {
        return eventBanner;
    }

    public void setEventBanner(String eventBanner) {
        this.eventBanner = eventBanner;
    }

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public String getFoldername() {
        return foldername;
    }

    public void setFoldername(String foldername) {
        this.foldername = foldername;
    }












}
