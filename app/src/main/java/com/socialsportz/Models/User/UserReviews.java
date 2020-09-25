package com.socialsportz.Models.User;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;


public class UserReviews extends BaseModel implements Serializable {
    private String userName, userEmail, reviewDate, reviewImg, folderName;
    private String reviewMessage;
    private String rating;

	public String getImage() {
		return image;
	}

	public void setImage(String image) {
		this.image = image;
	}

	private String image;


    public UserReviews(JSONObject jsonResponse) {
        this.userName = getValue(jsonResponse,kUserName,String.class);
        this.rating = getValue(jsonResponse,kRating,String.class);
        this.reviewMessage = getValue(jsonResponse,kReviewMsg,String.class);
        this.userEmail = getValue(jsonResponse,kEmail,String.class);

        if(jsonResponse.has(kReviewUserImage))
            this.reviewImg = getValue(jsonResponse,kReviewUserImage,String.class);
        this.folderName = getValue(jsonResponse,kFolderName,String.class);

        this.reviewDate = getValue(jsonResponse,kReviewDate,String.class);

    }

    public String getReviewImg() {
        return reviewImg;
    }

    public void setReviewImg(String galleryImg) {
        this.reviewImg = reviewImg;
    }


    public String getFolderName() {
        return folderName;
    }

    public void setFolderName(String folderName) {
        this.folderName = folderName;
    }


    public String getUserName() { return userName; }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getRatingBar() { return rating; }

    public void setRatingBar(String rating) {
        this.rating = rating;
    }


    public String getReviewMessage() { return reviewMessage; }

    public void setReviewMessage(String reviewMessage) {
        this.reviewMessage = reviewMessage;
    }


    public String getUserEmail() { return userEmail; }

    public void setUserEmail(String userEmail) {
        this.userEmail = userEmail;
    }

    public String getReviewDate() { return reviewDate; }

    public void setReviewDate(String reviewDate) {
        this.reviewDate = reviewDate;
    }

}
