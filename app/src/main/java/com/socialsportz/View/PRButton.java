package com.socialsportz.View;

import android.content.Context;
import android.graphics.Typeface;
import android.util.AttributeSet;
import android.widget.Button;

public class PRButton extends Button {
    public PRButton(Context context) {
        super(context);
        createFont();
    }

    public PRButton(Context context, AttributeSet attrs) {
        super(context, attrs);
        createFont();
    }



    public PRButton(Context context, AttributeSet attrs, int defStyleAttr) {
        super(context, attrs, defStyleAttr);
        createFont();
    }

    public void createFont() {
        Typeface font = Typeface.createFromAsset(getContext().getAssets(), "fonts/poppins_regular.otf");
        setTypeface(font);
    }
}
