package com.socialsportz.Models.User;

public class DropDownRating {

    private int id;
    private String rating_name;

    public DropDownRating(int amenityId, String amenityName) {
        this.id = amenityId;
        this.rating_name = amenityName;

    }
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getRating_name() {
        return rating_name;
    }

    public void setRating_name(String rating_name) {
        this.rating_name = rating_name;
    }


}
