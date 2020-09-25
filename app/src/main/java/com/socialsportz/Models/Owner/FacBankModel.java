package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class FacBankModel extends BaseModel implements Serializable {
    private String ifscCode;
    private Integer bankId;
    private String bankName;
    private String bankBranch;
    private String accountType;
    private String accountName;
    private String accountNumber;
    private String GSTNumber;
    private String PANNumber;
    private String CINNumber;
    private String PANImage,GSTImage,CINImage,ChequeImage,AddressImage;
    private String folderName;

    public FacBankModel(JSONObject jsonResponse){
        this.bankId = Integer.valueOf(getValue(jsonResponse,kBankId,String.class));
        this.ifscCode = getValue(jsonResponse,kIFSCCode,String.class);
        this.bankName = getValue(jsonResponse,kBankName,String.class);
        this.bankBranch = getValue(jsonResponse,kBankBranch,String.class);
        this.accountType = getValue(jsonResponse,kAccountType,String.class);
        this.accountName = getValue(jsonResponse,kAccountName,String.class);
        this.accountNumber = getValue(jsonResponse,kAccountNumber,String.class);
        this.GSTNumber = getValue(jsonResponse,kGSTNumber,String.class);
        this.PANNumber = getValue(jsonResponse,kPANNumber,String.class);
        this.CINNumber = getValue(jsonResponse,kCINNumber,String.class);
        this.PANImage = getValue(jsonResponse,kPANImage,String.class);
        this.GSTImage = getValue(jsonResponse,kGSTImage,String.class);
        this.CINImage = getValue(jsonResponse,kCINImage,String.class);
        this.ChequeImage = getValue(jsonResponse,kChequeImage,String.class);
        this.AddressImage = getValue(jsonResponse,kProofImage,String.class);
        this.folderName = getValue(jsonResponse, kFolderName,String.class);
    }

    public Integer getBankId() {
        return bankId;
    }

    public void setBankId(Integer bankId) {
        this.bankId = bankId;
    }

    public String getIfscCode() {
        return ifscCode;
    }

    public void setIfscCode(String ifscCode) {
        this.ifscCode = ifscCode;
    }

    public String getBankName() {
        return bankName;
    }

    public void setBankName(String bankName) {
        this.bankName = bankName;
    }

    public String getBankBranch() {
        return bankBranch;
    }

    public void setBankBranch(String bankBranch) {
        this.bankBranch = bankBranch;
    }

    public String getAccountType() {
        return accountType;
    }

    public void setAccountType(String accountType) {
        this.accountType = accountType;
    }

    public String getAccountName() {
        return accountName;
    }

    public void setAccountName(String accountName) {
        this.accountName = accountName;
    }

    public String getAccountNumber() {
        return accountNumber;
    }

    public void setAccountNumber(String accountNumber) {
        this.accountNumber = accountNumber;
    }

    public String getGSTNumber() {
        return GSTNumber;
    }

    public void setGSTNumber(String GSTNumber) {
        this.GSTNumber = GSTNumber;
    }

    public String getPANNumber() {
        return PANNumber;
    }

    public void setPANNumber(String PANNumber) {
        this.PANNumber = PANNumber;
    }

    public String getCINNumber() {
        return CINNumber;
    }

    public void setCINNumber(String CINNumber) {
        this.CINNumber = CINNumber;
    }

    public String getPANImage() {
        return PANImage;
    }

    public void setPANImage(String PANImage) {
        this.PANImage = PANImage;
    }

    public String getGSTImage() {
        return GSTImage;
    }

    public void setGSTImage(String GSTImage) {
        this.GSTImage = GSTImage;
    }

    public String getCINImage() {
        return CINImage;
    }

    public void setCINImage(String CINImage) {
        this.CINImage = CINImage;
    }

    public String getChequeImage() {
        return ChequeImage;
    }

    public void setChequeImage(String chequeImage) {
        ChequeImage = chequeImage;
    }

    public String getAddressImage() {
        return AddressImage;
    }

    public void setAddressImage(String addressImage) {
        AddressImage = addressImage;
    }

    public String getFolderName() {
        return folderName;
    }

    public void setFolderName(String folderName) {
        this.folderName = folderName;
    }
}
