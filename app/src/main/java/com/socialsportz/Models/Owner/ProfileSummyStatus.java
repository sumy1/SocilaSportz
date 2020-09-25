package com.socialsportz.Models.Owner;

import com.socialsportz.Constants.Constants;
import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

import static com.socialsportz.Constants.Constants.kAmenityStatus;

public class ProfileSummyStatus extends BaseModel implements Serializable{


	public String getProfileStatus() {
		return ProfileStatus;
	}

	public void setProfileStatus(String profileStatus) {
		ProfileStatus = profileStatus;
	}

	public String getFacilityStatus() {
		return FacilityStatus;
	}

	public void setFacilityStatus(String facilityStatus) {
		FacilityStatus = facilityStatus;
	}

	public String getBankStatus() {
		return BankStatus;
	}

	public void setBankStatus(String bankStatus) {
		BankStatus = bankStatus;
	}

	public String getDocumentsStatus() {
		return documentsStatus;
	}

	public void setDocumentsStatus(String documentsStatus) {
		this.documentsStatus = documentsStatus;
	}

	private String ProfileStatus;
    private String FacilityStatus;
    private String BankStatus;
    private String documentsStatus;

	public String getAmenityStatus() {
		return amenityStatus;
	}

	public void setAmenityStatus(String amenityStatus) {
		this.amenityStatus = amenityStatus;
	}

	public String getSportStatus() {
		return SportStatus;
	}

	public void setSportStatus(String sportStatus) {
		SportStatus = sportStatus;
	}

	public String getGalleryStatus() {
		return GalleryStatus;
	}

	public void setGalleryStatus(String galleryStatus) {
		GalleryStatus = galleryStatus;
	}

	public String getTimingStatus() {
		return TimingStatus;
	}

	public void setTimingStatus(String timingStatus) {
		TimingStatus = timingStatus;
	}

	private String amenityStatus;
    private String SportStatus;
    private String GalleryStatus;
    private String TimingStatus;








    public ProfileSummyStatus(JSONObject jsonResponse) {
    	this.BankStatus=getValue(jsonResponse,kbankStatus,String.class);
    	this.documentsStatus=getValue(jsonResponse,kDocumentsStatus,String.class);
    	this.FacilityStatus=getValue(jsonResponse,kfacilityStatus,String.class);
    	this.ProfileStatus=getValue(jsonResponse,kProfileSattuss,String.class);
    	this.amenityStatus=getValue(jsonResponse,kAmenityStatuss,String.class);
    	this.GalleryStatus=getValue(jsonResponse,kGalleryStatuss,String.class);
    	this.TimingStatus=getValue(jsonResponse,kTimingStatus,String.class);
    	this.SportStatus=getValue(jsonResponse,kSportsStatus,String.class);

    }


}
