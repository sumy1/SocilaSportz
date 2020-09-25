package com.socialsportz.Models.User;

import android.util.Log;

import com.socialsportz.Models.BaseModel;
import com.socialsportz.Models.Owner.Amenity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class UserEvent extends BaseModel implements Serializable {
    private int eventId;
    private int facId;
    private int sportId;

    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    private String userId;
    private String sportName;
    private String facName;
    private String eventName;
    private String desc;
    private String rules;
    private String price;
    private String sdate;
    private String edate;
    private String stime;
    private String etime;
    private String enrollStart;
    private String enrollEnd;
    private String venue;
    private String city;
    private String maxCapicity;
    private String eventLat;
    private String eventLang;
    private String banner;
    private String participants;
    private Integer booked;
    private String contactPerson;
    private String contactEmail;
    private String contactNumber;
    private String thingNote;
    private String status;
    private CopyOnWriteArrayList<Amenity> amenities;
    private String facFolder;
    private int image;

	public CopyOnWriteArrayList<UserEventViewGallery> getFacGalleryList() {
		return facGalleryList;
	}

	public void setFacGalleryList(CopyOnWriteArrayList<UserEventViewGallery> facGalleryList) {
		this.facGalleryList = facGalleryList;
	}

	private CopyOnWriteArrayList<UserEventViewGallery> facGalleryList;

	public String getEventCategories() {
		return eventCategories;
	}

	public void setEventCategories(String eventCategories) {
		this.eventCategories = eventCategories;
	}

	public String getEventAgeCategory() {
		return eventAgeCategory;
	}

	public void setEventAgeCategory(String eventAgeCategory) {
		this.eventAgeCategory = eventAgeCategory;
	}

	public String getEventAwardPrize() {
		return eventAwardPrize;
	}

	public void setEventAwardPrize(String eventAwardPrize) {
		this.eventAwardPrize = eventAwardPrize;
	}

	private String eventCategories;
    private String eventAgeCategory;
    private String eventAwardPrize;


    public UserEvent(JSONObject jsonResonse){
        this.eventId = Integer.valueOf(getValue(jsonResonse,kEventId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResonse,kFacId,String.class));
        this.userId=getValue(jsonResonse,kUserId,String.class);
        this.facName = getValue(jsonResonse,kFacName,String.class);
        this.sportId = Integer.valueOf(getValue(jsonResonse,kSportId,String.class));
        this.sportName = getValue(jsonResonse,kSportName,String.class);
        this.eventName = getValue(jsonResonse,kEventName,String.class);
        this.desc = getValue(jsonResonse,kEventDesc,String.class);
        this.rules = getValue(jsonResonse,kEventRules,String.class);
        this.sdate =  getValue(jsonResonse,kEventStartDate,String.class);
        this.edate = getValue(jsonResonse,kEventEndDate,String.class);
        this.stime = getValue(jsonResonse,kEventStartTime,String.class);
        this.etime = getValue(jsonResonse,kEventEndTime,String.class);
        this.enrollStart = getValue(jsonResonse,kEventStartEnroll,String.class);
        this.enrollEnd = getValue(jsonResonse,kEventEndEnroll,String.class);
        this.booked = getValue(jsonResonse,kEventBookings,Integer.class);
        this.participants = getValue(jsonResonse,kEventMax,String.class);
        this.price = getValue(jsonResonse,kEventPrice,String.class);
        this.venue = getValue(jsonResonse,kEventVenue,String.class);
        this.city = getValue(jsonResonse,kEventCity,String.class);
        this.eventLat = getValue(jsonResonse,kEventLat,String.class);
        this.eventLang = getValue(jsonResonse,kEventLog,String.class);
        this.banner = getValue(jsonResonse,kEventBanner,String.class);
        this.status = getValue(jsonResonse,kEventStatus,String.class);
        this.thingNote = getValue(jsonResonse,kThingNote,String.class);
        this.contactPerson = getValue(jsonResonse,kEventContact,String.class);
        this.contactEmail = getValue(jsonResonse,kEventEmail,String.class);
        this.contactNumber = getValue(jsonResonse,kEventPhone,String.class);
        this.facFolder = getValue(jsonResonse,kFolderName,String.class);
        this.eventAgeCategory=getValue(jsonResonse,kEventAgeCategory,String.class);
        this.eventAwardPrize=getValue(jsonResonse,kEventAwardPrize,String.class);
        this.eventCategories=getValue(jsonResonse,kEventCategory,String.class);
		if(jsonResonse.has(kGalleryList)) {
			try {
				this.facGalleryList = handleEventViewGallery(getValue(jsonResonse, kGalleryList, JSONArray.class));
			} catch (JSONException e) {
				e.printStackTrace();
			}
		}
		else
			this.facGalleryList = new CopyOnWriteArrayList<>();
        try {
            if(jsonResonse.has(kAminities))
                this.amenities = handleAmenities(getValue(jsonResonse, kAminities, JSONArray.class));
            else
                this.amenities = new CopyOnWriteArrayList<>();

            Log.d("sizeA",amenities.size()+"");
        } catch (JSONException e) {
            e.printStackTrace();
        }


    }

    public UserEvent(int image){
        this.image = image;
        this.banner = "";
    }

    public String getMaxCapicity() {
        return maxCapicity;
    }

    public String getEventLat() {
        return eventLat;
    }

    public void setEventLat(String eventLat) {
        this.eventLat = eventLat;
    }

    public String getEventLang() {
        return eventLang;
    }

    public void setEventLang(String eventLang) {
        this.eventLang = eventLang;
    }

    public void setMaxCapicity(String maxCapicity) {
        this.maxCapicity = maxCapicity;
    }

    public int getEventId() {
        return eventId;
    }

    public void setEventId(int eventId) {
        this.eventId = eventId;
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

    public String getSportName() {
        return sportName;
    }

    public void setSportName(String sportName) {
        this.sportName = sportName;
    }

    public String getFacName() {
        return facName;
    }

    public void setFacName(String facName) {
        this.facName = facName;
    }

    public String getEventName() {
        return eventName;
    }

    public void setEventName(String eventName) {
        this.eventName = eventName;
    }

    public String getDesc() {
        return desc;
    }

    public void setDesc(String desc) {
        this.desc = desc;
    }

    public String getRules() {
        return rules;
    }

    public void setRules(String rules) {
        this.rules = rules;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }

    public String getSdate() {
        return sdate;
    }

    public void setSdate(String sdate) {
        this.sdate = sdate;
    }

    public String getEdate() {
        return edate;
    }

    public void setEdate(String edate) {
        this.edate = edate;
    }

    public String getStime() {
        return stime;
    }

    public void setStime(String stime) {
        this.stime = stime;
    }

    public String getEtime() {
        return etime;
    }

    public void setEtime(String etime) {
        this.etime = etime;
    }

    public String getEnrollStart() {
        return enrollStart;
    }

    public void setEnrollStart(String enrollStart) {
        this.enrollStart = enrollStart;
    }

    public String getEnrollEnd() {
        return enrollEnd;
    }

    public void setEnrollEnd(String enrollEnd) {
        this.enrollEnd = enrollEnd;
    }

    public String getVenue() {
        return venue;
    }

    public void setVenue(String venue) {
        this.venue = venue;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getBanner() {
        return banner;
    }

    public void setBanner(String banner) {
        this.banner = banner;
    }

    public String getParticipants() {
        return participants;
    }

    public void setParticipants(String participants) {
        this.participants = participants;
    }

    public int getBooked() {
        return booked;
    }

    public void setBooked(int booked) {
        this.booked = booked;
    }

    public String getContactPerson() {
        return contactPerson;
    }

    public void setContactPerson(String contactPerson) {
        this.contactPerson = contactPerson;
    }

    public String getContactEmail() {
        return contactEmail;
    }

    public void setContactEmail(String contactEmail) {
        this.contactEmail = contactEmail;
    }

    public String getContactNumber() {
        return contactNumber;
    }

    public void setContactNumber(String contactNumber) {
        this.contactNumber = contactNumber;
    }

    public String getThingNote() {
        return thingNote;
    }

    public void setThingNote(String thingNote) {
        this.thingNote = thingNote;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public CopyOnWriteArrayList<Amenity> getAmenities() {
        return amenities;
    }

    public void setAmenities(CopyOnWriteArrayList<Amenity> amenities) {
        this.amenities = amenities;
    }

    public String getFacFolder() {
        return facFolder;
    }

    public void setFacFolder(String facFolder) {
        this.facFolder = facFolder;
    }

    public int getImage() {
        return image;
    }

    public void setImage(int image) {
        this.image = image;
    }


    private CopyOnWriteArrayList<Amenity> handleAmenities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<Amenity> galleries = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            galleries.add(new Amenity(jsonArray.getJSONObject(i)));
        }
        return galleries;
    }


	private CopyOnWriteArrayList<UserEventViewGallery> handleEventViewGallery(JSONArray jsonArray) throws JSONException {
		CopyOnWriteArrayList<UserEventViewGallery> facSports = new CopyOnWriteArrayList<>();
		for (int i = 0; i < jsonArray.length(); i++) {
			facSports.add(new UserEventViewGallery(jsonArray.getJSONObject(i)));
		}
		return facSports;
	}
}
