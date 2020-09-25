package com.socialsportz.Utils;

import android.app.DatePickerDialog;
import android.content.Context;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

import androidx.appcompat.app.AppCompatActivity;

public class DatePicker {
    private Context context;
    private DateSetListener dateSetListener;
    private int type;
    private int date,month,year;

    private DatePicker(Context context, int type , DateSetListener dateSetListener) {
        this.context = context;
        this.dateSetListener = dateSetListener;
        this.type = type;
    }

    private DatePicker(Context context, int date,int month,int year, DateSetListener dateSetListener) {
        this.context = context;
        this.dateSetListener = dateSetListener;
        this.date = date;
        this.month = month;
        this.year = year;
    }

    public static DatePicker getInstance(Context context, int type, DateSetListener dateSetListener) {
        return new DatePicker(context, type, dateSetListener);
    }

    public static DatePicker getInstance(Context context, int date, int month, int year, DateSetListener dateSetListener) {
        return new DatePicker(context, date,month,year, dateSetListener);
    }

    private static SimpleDateFormat getSimplerDateFormat() {
        return new SimpleDateFormat("dd MMM yyyy", Locale.UK);
    }

    private DatePickerDialog.OnDateSetListener onDateSetListener = new DatePickerDialog.OnDateSetListener() {
        @Override
        public void onDateSet(android.widget.DatePicker view, int year, int month, int dayOfMonth) {
            Calendar newDate = Calendar.getInstance();
            newDate.set(year, month, dayOfMonth);
            String date = getSimplerDateFormat().format(newDate.getTime());
            dateSetListener.onDateSet(date);
        }
    };


    private DatePickerDialog getDatePickerDialog() {
        Calendar newCalendar = Calendar.getInstance();
        DatePickerDialog datePickerDialog = new DatePickerDialog(context, onDateSetListener, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DATE));
        long now = System.currentTimeMillis();
        if(type==1){
            long limit = now - 410227200000L;//for 13 year back set max date
            datePickerDialog.getDatePicker().setMaxDate(limit);
        }else
            datePickerDialog.getDatePicker().setMinDate(now );
        return datePickerDialog;
    }

    private DatePickerDialog setDatePickerDialog(){
        Calendar newCalendar = Calendar.getInstance();
        DatePickerDialog datePickerDialog;
        if(date!=0 && month!=0 && year!=0)
            datePickerDialog = new DatePickerDialog(context, onDateSetListener, year, month, date);
        else
            datePickerDialog = new DatePickerDialog(context, onDateSetListener, newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DATE));
        long now = System.currentTimeMillis();
        datePickerDialog.getDatePicker().setMinDate(now);
        return datePickerDialog;
    }

    public interface DateSetListener {
        void onDateSet(String date);
    }

    public void callDatePickerDialog(){
        if(!((AppCompatActivity)context).isFinishing()){
            setDatePickerDialog().show();
        }
    }

    public void showDatePickDialog() {
        if(!((AppCompatActivity)context).isFinishing()){
            getDatePickerDialog().show();
        }
    }



}

