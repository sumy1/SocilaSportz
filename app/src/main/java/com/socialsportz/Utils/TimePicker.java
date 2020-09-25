package com.socialsportz.Utils;

import android.app.TimePickerDialog;
import android.content.Context;
import android.util.Log;

import java.util.Calendar;

import androidx.appcompat.app.AppCompatActivity;

public class TimePicker {

    private Context context;
    private TimeSetListener timeSetListener;
    private int hour,minute;

    private TimePicker(Context context,int hour,int minute, TimeSetListener timeSetListener) {
        this.context = context;
        this.hour = hour;
        this.minute = minute;
        this.timeSetListener = timeSetListener;
    }

    public static TimePicker getInstance(Context context, int hour, int minute, TimeSetListener timeSetListener) {
        return new TimePicker(context,hour,minute,timeSetListener);
    }

    private TimePickerDialog.OnTimeSetListener onTimeSetListener = new TimePickerDialog.OnTimeSetListener() {
        @Override
        public void onTimeSet(android.widget.TimePicker view, int hourOfDay, int minute) {
            String time;
            //time = hourOfDay+":"+minute;

            String AM_PM ;
            if(hourOfDay < 12) {
                AM_PM = "am";
            }else if(hourOfDay == 12){
				AM_PM = "pm";
				hourOfDay =12;
			}
            else {
                AM_PM = "pm";
                hourOfDay = hourOfDay - 12;
            }

            if(minute==0 && hourOfDay == 0){
                time = "12:00" +" "+AM_PM;
				Log.d("Time1",time);
            }else if(minute<10 && hourOfDay==0){
				time = "12" + ":0" +minute+" "+AM_PM;
				Log.d("Time1",time);
			}else if(minute>10 && hourOfDay==0){
				time = "12" +":"+ minute+" "+AM_PM;
				Log.d("Time1",time);
			}
            else if(minute==0){
                time = hourOfDay + ":00"+" "+AM_PM;
				Log.d("Time2",time);
            }else if(minute<10){
				time = hourOfDay + ":0"+minute+" "+AM_PM;
				Log.d("Time3",time);
			}else if(hourOfDay==12 ){
				time = "12" + ":" +minute+" "+AM_PM;
				Log.d("Time4",time);
			}else if(hourOfDay<10){
				time = "0"+hourOfDay + ":"+minute+" "+AM_PM;
				Log.d("Time4",time);
			}

            else if(minute<10 && hourOfDay<12){
				time = "0"+hourOfDay + ":0"+minute+" "+AM_PM;

				Log.d("Time5",time);
			}
            else{

                time = hourOfDay + ":" + minute +" "+AM_PM;
				Log.d("Time",time);
            }
            /*if(hourOfDay>12){
                int hour = hourOfDay - 12;
                time = hour+":"+minute+" PM";
            }
            else if(hourOfDay==12)
                time = hourOfDay+":"+minute+" PM";
            else
                time = hourOfDay+":"+minute+" AM";*/
            timeSetListener.onTimeSet(time);
        }
    };

    private TimePickerDialog getTimePickerDialog(){
        Calendar newCalendar = Calendar.getInstance();
        if(hour==0 && minute==0)
            return new TimePickerDialog(context,onTimeSetListener,newCalendar.get(Calendar.HOUR_OF_DAY),newCalendar.get(Calendar.MINUTE),false);
        else
            return new TimePickerDialog(context,onTimeSetListener,hour,minute,false);
    }

    public interface TimeSetListener {
        void onTimeSet(String time);
    }

    public void showTimePickDialog() {
        if(!((AppCompatActivity)context).isFinishing()){
            getTimePickerDialog().show();
        }
    }
}
