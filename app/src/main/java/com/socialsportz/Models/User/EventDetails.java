package com.socialsportz.Models.User;

import org.json.JSONObject;

import static com.socialsportz.Constants.Constants.kEventDesc;
import static com.socialsportz.Constants.Constants.kEventEndDate;
import static com.socialsportz.Constants.Constants.kEventEndTime;
import static com.socialsportz.Constants.Constants.kEventId;
import static com.socialsportz.Constants.Constants.kEventMax;
import static com.socialsportz.Constants.Constants.kEventName;
import static com.socialsportz.Constants.Constants.kEventPrice;
import static com.socialsportz.Constants.Constants.kEventRules;
import static com.socialsportz.Constants.Constants.kEventStartDate;
import static com.socialsportz.Constants.Constants.kEventStartTime;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacName;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kSportName;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.keventAvailable;
import static com.socialsportz.Models.BaseModel.getValue;

public class EventDetails {

	public String getEventId() {
		return eventId;
	}

	public void setEventId(String eventId) {
		this.eventId = eventId;
	}

	public String getFacId() {
		return facId;
	}

	public void setFacId(String facId) {
		this.facId = facId;
	}

	public String getSportId() {
		return sportId;
	}

	public void setSportId(String sportId) {
		this.sportId = sportId;
	}

	public String getUserId() {
		return userId;
	}

	public void setUserId(String userId) {
		this.userId = userId;
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

	public String getMaxCapicity() {
		return maxCapicity;
	}

	public void setMaxCapicity(String maxCapicity) {
		this.maxCapicity = maxCapicity;
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

	public String getFacFolder() {
		return facFolder;
	}

	public void setFacFolder(String facFolder) {
		this.facFolder = facFolder;
	}

	public String getImage() {
		return image;
	}

	public void setImage(String image) {
		this.image = image;
	}

	private String  eventId;
	private String  facId;
	private String sportId;
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
	private int booked;
	private String contactPerson;
	private String contactEmail;
	private String contactNumber;
	private String thingNote;
	private String status;
	private String facFolder;
	private String image;

	public String getEventavailable() {
		return eventavailable;
	}

	public void setEventavailable(String eventavailable) {
		this.eventavailable = eventavailable;
	}

	private String eventavailable;



	public EventDetails(JSONObject jsonResonse) {
		this.eventId = getValue(jsonResonse, kEventId, String.class);
		this.facId = getValue(jsonResonse, kFacId, String.class);
		this.userId = getValue(jsonResonse, kUserId, String.class);
		this.facName = getValue(jsonResonse, kFacName, String.class);
		this.sportId = getValue(jsonResonse, kSportId, String.class);
		this.sportName = getValue(jsonResonse, kSportName, String.class);
		this.eventName = getValue(jsonResonse, kEventName, String.class);
		this.desc = getValue(jsonResonse, kEventDesc, String.class);
		this.rules = getValue(jsonResonse, kEventRules, String.class);
		this.sdate = getValue(jsonResonse, kEventStartDate, String.class);
		this.edate = getValue(jsonResonse, kEventEndDate, String.class);
		this.stime = getValue(jsonResonse, kEventStartTime, String.class);
		this.etime = getValue(jsonResonse, kEventEndTime, String.class);
		this.participants = getValue(jsonResonse, kEventMax, String.class);
		this.price=getValue(jsonResonse,kEventPrice,String.class);
		this.eventavailable=getValue(jsonResonse,keventAvailable,String.class);



	}


}
