package com.socialsportz.Models.Owner;

import org.json.JSONObject;

import java.io.Serializable;

import static com.socialsportz.Constants.Constants.kapr;
import static com.socialsportz.Constants.Constants.kaug;
import static com.socialsportz.Constants.Constants.kdec;
import static com.socialsportz.Constants.Constants.kfeb;
import static com.socialsportz.Constants.Constants.kjan;
import static com.socialsportz.Constants.Constants.kjuly;
import static com.socialsportz.Constants.Constants.kjune;
import static com.socialsportz.Constants.Constants.kmar;
import static com.socialsportz.Constants.Constants.kmay;
import static com.socialsportz.Constants.Constants.knov;
import static com.socialsportz.Constants.Constants.koct;
import static com.socialsportz.Constants.Constants.ksept;
import static com.socialsportz.Models.BaseModel.getValue;

public class TotalYearScedule implements Serializable {


	public String getkJan() {
		return kJan;
	}

	public void setkJan(String kJan) {
		this.kJan = kJan;
	}

	public String getkFeb() {
		return kFeb;
	}

	public void setkFeb(String kFeb) {
		this.kFeb = kFeb;
	}

	public String getkMar() {
		return kMar;
	}

	public void setkMar(String kMar) {
		this.kMar = kMar;
	}

	public String getkApr() {
		return kApr;
	}

	public void setkApr(String kApr) {
		this.kApr = kApr;
	}

	public String getkMay() {
		return kMay;
	}

	public void setkMay(String kMay) {
		this.kMay = kMay;
	}

	public String getkJune() {
		return kJune;
	}

	public void setkJune(String kJune) {
		this.kJune = kJune;
	}

	public String getkJuly() {
		return kJuly;
	}

	public void setkJuly(String kJuly) {
		this.kJuly = kJuly;
	}

	public String getkAug() {
		return kAug;
	}

	public void setkAug(String kAug) {
		this.kAug = kAug;
	}

	public String getkSept() {
		return kSept;
	}

	public void setkSept(String kSept) {
		this.kSept = kSept;
	}

	public String getkOct() {
		return kOct;
	}

	public void setkOct(String kOct) {
		this.kOct = kOct;
	}

	public String getkNov() {
		return kNov;
	}

	public void setkNov(String kNov) {
		this.kNov = kNov;
	}

	public String getkDec() {
		return kDec;
	}

	public void setkDec(String kDec) {
		this.kDec = kDec;
	}

	private String kJan;
	private String kFeb;
	private String kMar;
	private String kApr;
	private String kMay;
	private String kJune;
	private String kJuly;
	private String kAug;
	private String kSept;
	private String kOct;
	private String kNov;
	private String kDec;





    public TotalYearScedule(JSONObject jsonObject) {
       this.kJan=getValue(jsonObject,kjan,String.class);
		this.kFeb=getValue(jsonObject,kfeb,String.class);
		this.kMar=getValue(jsonObject,kmar,String.class);
		this.kApr=getValue(jsonObject,kapr,String.class);
		this.kMay=getValue(jsonObject,kmay,String.class);
		this.kJune=getValue(jsonObject,kjune,String.class);
		this.kJuly=getValue(jsonObject,kjuly,String.class);
		this.kAug=getValue(jsonObject,kaug,String.class);
		this.kSept=getValue(jsonObject,ksept,String.class);
		this.kOct=getValue(jsonObject,koct,String.class);
		this.kNov=getValue(jsonObject,knov,String.class);
		this.kDec=getValue(jsonObject,kdec,String.class);
    }


}
