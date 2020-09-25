package com.socialsportz.Models.Owner;

import com.socialsportz.Models.BaseModel;

import org.json.JSONObject;

import java.io.Serializable;

public class BatchSlotType extends BaseModel implements Serializable {

    private int typeId;
    private String typeName;

    public BatchSlotType (JSONObject jsonResponse){
        this.typeId = Integer.valueOf(getValue(jsonResponse,kTypeId,String.class));
        this.typeName = getValue(jsonResponse,kTypeName,String.class);
    }

    public BatchSlotType (int id,String name){
        this.typeId = id;
        this.typeName = name;
    }

    public int getTypeId() {
        return typeId;
    }

    public void setTypeId(int typeId) {
        this.typeId = typeId;
    }

    public String getTypeName() {
        return typeName;
    }

    public void setTypeName(String typeName) {
        this.typeName = typeName;
    }
}