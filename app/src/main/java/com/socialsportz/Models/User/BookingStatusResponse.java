package com.socialsportz.Models.User;

public class BookingStatusResponse {

	public String getMsg() {
		return msg;
	}

	public void setMsg(String msg) {
		this.msg = msg;
	}

	public String getOrderId() {
		return orderId;
	}

	public void setOrderId(String orderId) {
		this.orderId = orderId;
	}

	private String msg;
	private String orderId;


	public BookingStatusResponse(String msg, String orderId){
		this.msg=msg;
		this.orderId=orderId;
	}

}
