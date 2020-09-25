package com.socialsportz.Utils;

public class Validations {
    public final static String NUMBER_PATTERN = "^[0-9]$";
    public final static String ALL_PATTERN = "^[a-zA-Z0-9!@#$&()\\\\-`.+,/\\\"]*$";
    public final static String ALPHABET_PATTERN = "^[a-zA-Z\\s]+$ ";
    public final static String EMAIL_PATTERN = "[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,6}";
    public final static String PHONE_NO_PATTERN = "^(?:(?:\\+|0{0,2})91(\\s*[\\ -]\\s*)?|[0]?)?[789]\\d{9}|(\\d[ -]?){10}\\d$";

    public static boolean isValidNickname(String nickname) {
        if(nickname==null) nickname="";
        String regexSt= "^[a-zA-Z0-9]+([a-zA-Z0-9](_|.| )[a-zA-Z0-9])*[a-zA-Z0-9]+$"; //with digit
        return nickname.matches(regexSt);
    }

    public static boolean isAlphaNumeric(String s){
        String pattern= "^[a-zA-Z0-9]*$";
        return s.matches(pattern);
    }

    public static boolean isValidName(String name) {
        String regexSt="^[a-zA-Z\\s]+$";
        return name != null && name.length() > 2 && name.matches(regexSt);
    }

    public static boolean isValidPhone(String phone) {
        String regexStr = "^(?:(?:\\+|0{0,2})91(\\s*[\\ -]\\s*)?|[0]?)?[789]\\d{9}|(\\d[ -]?){10}\\d$";
        return phone.matches(regexStr);
    }

    public static boolean isValidEmail(String email) {
        String EMAIL_PATTERN = "[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,6}";
        return email.matches(EMAIL_PATTERN);
    }

    public static boolean isValidIFSC(String ifsc){
        String IFSC_PATTERN = "^[A-Za-z]{4}[a-zA-Z0-9]{7}$";
        return  ifsc.matches(IFSC_PATTERN);
    }

    public static boolean isValidGST(String gst){
        //String GST_PATTERN = "/^([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-7]{1})([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$";
        String GST_PATTERN = "\\d{2}[A-Z]{5}\\d{4}[A-Z]{1}[A-Z\\d]{1}[Z]{1}[A-Z\\d]{1}";
        return gst.matches(GST_PATTERN);
    }

    public static boolean isValidPAN(String pan){
        String PAN_PATTERN = "[A-Za-z]{5}\\d{4}[A-Za-z]{1}";
        return  pan.matches(PAN_PATTERN);
    }

    public static boolean isValidCIN(String cin){
        String CIN_PATTERN = "^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$";
        return  cin.matches(CIN_PATTERN);
    }

    public static boolean isValidPassword(String testString) {
        return (testString.length()>=3);
    }

	public static boolean isValidPasswordd(String testString) {
		return (testString.length()>=6 && testString.length()<=16);
	}

    public static boolean isValidPinCode(String code){
        String PIN_PATTERN = "^[1-9][0-9]{5}$";
        return  code.matches(PIN_PATTERN);
    }
}
