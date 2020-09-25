package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class UserReview extends BaseModel implements Serializable {
    
    private String facId;
    private String userId;
    private String facName;

	public String getCreatedOn() {
		return createdOn;
	}

	public void setCreatedOn(String createdOn) {
		this.createdOn = createdOn;
	}

	private String createdOn;

    public String getRating() {
        return rating;
    }

    public void setRating(String rating) {
        this.rating = rating;
    }

    private String rating;

    public String getRatingId() {
        return ratingId;
    }

    public void setRatingId(String ratingId) {
        this.ratingId = ratingId;
    }

    private String ratingId;

    public String getBannerImage() {
        return bannerImage;
    }

    public void setBannerImage(String bannerImage) {
        this.bannerImage = bannerImage;
    }

    public String getReviewMesg() {
        return reviewMesg;
    }

    public void setReviewMesg(String reviewMesg) {
        this.reviewMesg = reviewMesg;
    }

    private String bannerImage;
    private String reviewMesg;


    public UserReview(JSONObject jsonObject){
        this.facId=getValue(jsonObject,kFacId,String.class);
        this.userId=getValue(jsonObject,kUserId,String.class);
        this.reviewMesg=getValue(jsonObject,kReviewMsg,String.class);
        this.facName=getValue(jsonObject,kFacName,String.class);
        this.bannerImage=getValue(jsonObject,kFacBanner,String.class);
        this.ratingId=getValue(jsonObject,kRatingId,String.class);
        this.rating=getValue(jsonObject,kRating,String.class);
        this.createdOn=getValue(jsonObject,kReviewDate,String.class);
    }




    public String getFacId() {
        return facId;
    }

    public void setFacId(String facId) {
        this.facId = facId;
    }

    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }



    public String getFacName() {
        return facName;
    }

    public void setFacName(String facName) {
        this.facName = facName;
    }



}
