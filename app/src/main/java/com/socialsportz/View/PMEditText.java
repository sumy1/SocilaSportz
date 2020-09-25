package com.socialsportz.View;

import android.content.Context;
import android.graphics.Typeface;
import android.util.AttributeSet;
import android.widget.EditText;

public class PMEditText extends EditText {
    public PMEditText(Context context) {
        super(context);
        createFont();
    }

    public PMEditText(Context context, AttributeSet attrs) {
        super(context, attrs);
        createFont();
    }



    public PMEditText(Context context, AttributeSet attrs, int defStyleAttr) {
        super(context, attrs, defStyleAttr);
        createFont();
    }

    public void createFont() {
        Typeface font = Typeface.createFromAsset(getContext().getAssets(), "fonts/poppins_medium.otf");
        setTypeface(font);
    }
}
