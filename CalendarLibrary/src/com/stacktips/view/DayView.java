/*
 * Copyright (c) 2016 Stacktips {link: http://stacktips.com}.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package com.stacktips.view;

import android.content.Context;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.Build;
import android.preference.PreferenceManager;
import android.text.Html;
import android.util.AttributeSet;
import android.widget.TextView;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

public class DayView extends TextView {
    private Date date;
    private List<DayDecorator> decorators;

    public DayView(Context context) {
        this(context, null, 0);
    }

    public DayView(Context context, AttributeSet attrs) {
        this(context, attrs, 0);
    }

    public DayView(Context context, AttributeSet attrs, int defStyleAttr) {
        super(context, attrs, defStyleAttr);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.CUPCAKE) {
            if (isInEditMode())
                return;
        }
    }

    public void bind(Date date, List<DayDecorator> decorators) {
        this.date = date;
        this.decorators = decorators;
        SharedPreferences mSharedPreference1 = PreferenceManager.getDefaultSharedPreferences(getContext());

        final SimpleDateFormat df = new SimpleDateFormat("d");
        int day = Integer.parseInt(df.format(date));
        try {
            int size = mSharedPreference1.getInt("booked_seats_size", 0);
            if(size != 0) {
                String[] booked_seats_array = new String[size];
                for (int i = 0; i < size; i++) {
                    booked_seats_array[i] = mSharedPreference1.getString("booked_seats_" + i, null);
                }

                String next1 = "<font color='#000000'><br/>" + booked_seats_array[day - 1] + "</font>";
                setText(Html.fromHtml(String.valueOf(day) + next1));
            }else{
                setText(String.valueOf(day));
            }
        } catch (ArrayIndexOutOfBoundsException e) {
            e.printStackTrace();
        }
    }

    public void decorate() {
        //Set custom decorators
        if (null != decorators) {
            for (DayDecorator decorator : decorators) {
                decorator.decorate(this);
            }
        }
    }

    public Date getDate() {
//        Date date1 = null;
//        String dateStr = "2017-09-11";
//        SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd");
//        try {
//            date1 = format.parse(dateStr);
//        }catch (ParseException ex){
//            ex.printStackTrace();
//        }
//        SimpleDateFormat timeFormat = new SimpleDateFormat("dd-mm-yyyy");
//        String formatedDate = timeFormat.format(date);
        return date;
    }

    public String getStringDate() {
        SimpleDateFormat timeFormat = new SimpleDateFormat("dd-mm-yyyy");
        String stringDate = timeFormat.format(date);
        return stringDate;
    }
}