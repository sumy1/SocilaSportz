package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.util.concurrent.CopyOnWriteArrayList;

public class Events extends BaseModel implements Serializable {

    private int eventId;
    private int facId;
    private int sportId;
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
    private String banner;
    private String participants;
    private String booked;

	public String getArchieveStatus() {
		return archieveStatus;
	}

	public void setArchieveStatus(String archieveStatus) {
		this.archieveStatus = archieveStatus;
	}

	public String getArchieveComment() {
		return archieveComment;
	}

	public void setArchieveComment(String archieveComment) {
		this.archieveComment = archieveComment;
	}

	public String getArchieveBy() {
		return archieveBy;
	}

	public void setArchieveBy(String archieveBy) {
		this.archieveBy = archieveBy;
	}

	private String archieveStatus;
	private String archieveComment;
	private String archieveBy;

	public String getEventCategory() {
		return eventCategory;
	}

	public void setEventCategory(String eventCategory) {
		this.eventCategory = eventCategory;
	}

	public String getEventAgecategory() {
		return eventAgecategory;
	}

	public void setEventAgecategory(String eventAgecategory) {
		this.eventAgecategory = eventAgecategory;
	}

	public String getEventawardPrize() {
		return eventawardPrize;
	}

	public void setEventawardPrize(String eventawardPrize) {
		this.eventawardPrize = eventawardPrize;
	}

	private String eventCategory;
    private String eventAgecategory;
    private String eventawardPrize;

	public String getEventlat() {
		return eventlat;
	}

	public void setEventlat(String eventlat) {
		this.eventlat = eventlat;
	}

	public String getEventlong() {
		return eventlong;
	}

	public void setEventlong(String eventlong) {
		this.eventlong = eventlong;
	}

	private String eventlat;
    private String eventlong;



	public String getAvailable_slot_count() {
		return available_slot_count;
	}

	public void setAvailable_slot_count(String available_slot_count) {
		this.available_slot_count = available_slot_count;
	}

	private String available_slot_count;
    private String contactPerson;
    private String contactEmail;
    private String contactNumber;
    private String status;
    private CopyOnWriteArrayList<EventGallery> galleries;
    private CopyOnWriteArrayList<EventAmenity> amenities;
    private String facFolder;
    private String galleryFolder;

	public String getEventApproved() {
		return eventApproved;
	}

	public void setEventApproved(String eventApproved) {
		this.eventApproved = eventApproved;
	}

	private String eventApproved;

    public Events(JSONObject jsonResonse){
        this.eventId = Integer.valueOf(getValue(jsonResonse,kEventId,String.class));
        this.facId = Integer.valueOf(getValue(jsonResonse,kFacId,String.class));
        this.sportId = Integer.valueOf(getValue(jsonResonse,kSportId,String.class));
        this.eventName = getValue(jsonResonse,kEventName,String.class);
        this.desc = getValue(jsonResonse,kEventDesc,String.class);
        this.rules = getValue(jsonResonse,kEventRules,String.class);
        this.sdate =  getValue(jsonResonse,kEventStartDate,String.class);
        this.edate = getValue(jsonResonse,kEventEndDate,String.class);
        this.stime = getValue(jsonResonse,kEventStartTime,String.class);
        this.etime = getValue(jsonResonse,kEventEndTime,String.class);
        this.enrollStart = getValue(jsonResonse,kEventStartEnroll,String.class);
        this.enrollEnd = getValue(jsonResonse,kEventEndEnroll,String.class);
        this.participants = getValue(jsonResonse,kEventMax,String.class);
		this.booked = getValue(jsonResonse,kBookedEvent,String.class);
		this.available_slot_count=getValue(jsonResonse,kEventAvailableBooked,String.class);
        this.price = getValue(jsonResonse,kEventPrice,String.class);
        this.venue = getValue(jsonResonse,kEventVenue,String.class);
        this.city = getValue(jsonResonse,kEventCity,String.class);
        this.banner = getValue(jsonResonse,kEventBanner,String.class);
        this.status = getValue(jsonResonse,kEventStatus,String.class);
        this.eventApproved=getValue(jsonResonse,kEventApproval,String.class);
        this.eventAgecategory=getValue(jsonResonse,kEventAgeCategory,String.class);
        this.eventawardPrize=getValue(jsonResonse,kEventAwardPrize,String.class);
        this.eventCategory=getValue(jsonResonse,kEventCategory,String.class);
        this.eventlat=getValue(jsonResonse,kEventLat,String.class);
        this.eventlong=getValue(jsonResonse,kEventLog,String.class);

        this.contactPerson = getValue(jsonResonse,kEventContact,String.class);
        this.contactEmail = getValue(jsonResonse,kEventEmail,String.class);
        this.contactNumber = getValue(jsonResonse,kEventPhone,String.class);
        this.facFolder = getValue(jsonResonse,kFolderName,String.class);
        this.galleryFolder = getValue(jsonResonse,kGalleryFolder,String.class);
		this.archieveBy=getValue(jsonResonse,karchieveBy,String.class);
		this.archieveComment=getValue(jsonResonse,kArchiveComment,String.class);
		this.archieveStatus=getValue(jsonResonse,kArchiveStatus,String.class);

        try {
            if(jsonResonse.has(kEventGallery))
                this.galleries = handleGalleries(getValue(jsonResonse,kEventGallery,JSONArray.class));
            else
                this.galleries = new CopyOnWriteArrayList<>();
            if(jsonResonse.has(kEventAmenities))
                this.amenities = handleAmenities(getValue(jsonResonse, kEventAmenities, JSONArray.class));
            else
                this.amenities = new CopyOnWriteArrayList<>();
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public Events(int eventId, String eventName, String venue, String price, String sdate, String edate, String stime, String etime, String participants, String booked) {
        this.eventId = eventId;
        this.eventName = eventName;
        this.venue = venue;
        this.price = price;
        this.sdate = sdate;
        this.edate = edate;
        this.stime = stime;
        this.etime = etime;
        this.participants = participants;
        this.booked = booked;
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

    public int getEventId() {
        return eventId;
    }

    public void setEventId(int eventId) {
        this.eventId = eventId;
    }

    public String getEventName() {
        return eventName;
    }

    public void setEventName(String eventName) {
        this.eventName = eventName;
    }

    public String getVenue() {
        return venue;
    }

    public void setVenue(String venue) {
        this.venue = venue;
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

    public String getStime() {
        return stime;
    }

    public void setStime(String stime) {
        this.stime = stime;
    }

    public String getEdate() {
        return edate;
    }

    public void setEdate(String edate) {
        this.edate = edate;
    }

    public String getEtime() {
        return etime;
    }

    public void setEtime(String etime) {
        this.etime = etime;
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

    public String getBooked() {
        return booked;
    }

    public void setBooked(String booked) {
        this.booked = booked;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
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

    public String getFacFolder() {
        return facFolder;
    }

    public void setFacFolder(String facFolder) {
        this.facFolder = facFolder;
    }

    public String getGalleryFolder() {
        return galleryFolder;
    }

    public void setGalleryFolder(String galleryFolder) {
        this.galleryFolder = galleryFolder;
    }

    private CopyOnWriteArrayList<EventGallery> handleGalleries(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<EventGallery> galleries = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            galleries.add(new EventGallery(jsonArray.getJSONObject(i)));
        }
        return galleries;
    }

    private CopyOnWriteArrayList<EventAmenity> handleAmenities(JSONArray jsonArray) throws JSONException {
        CopyOnWriteArrayList<EventAmenity> galleries = new CopyOnWriteArrayList<>();
        for (int i = 0; i < jsonArray.length(); i++) {
            galleries.add(new EventAmenity(jsonArray.getJSONObject(i)));
        }
        return galleries;
    }

    public CopyOnWriteArrayList<EventGallery> getGalleries() {
        return galleries;
    }

    public void setGalleries(CopyOnWriteArrayList<EventGallery> galleries) {
        this.galleries = galleries;
    }

    public CopyOnWriteArrayList<EventAmenity> getAmenities() {
        return amenities;
    }

    public void setAmenities(CopyOnWriteArrayList<EventAmenity> amenities) {
        this.amenities = amenities;
    }
}
