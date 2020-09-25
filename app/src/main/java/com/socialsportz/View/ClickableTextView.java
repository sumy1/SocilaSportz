package com.socialsportz.View;

import android.content.Context;
import android.graphics.Typeface;
import android.util.AttributeSet;
import android.view.MotionEvent;
import android.view.View;
import android.widget.TextView;

public class ClickableTextView extends TextView implements View.OnTouchListener {
	public ClickableTextView(Context context, AttributeSet attrs,
							 int defStyle) {
		super(context, attrs, defStyle);
		setup();
	}

	public ClickableTextView(Context context, AttributeSet attrs) {
		super(context, attrs);
		setup();
	}

	public ClickableTextView(Context context, int checkableId) {
		super(context);
		setup();
	}

	public ClickableTextView(Context context) {
		super(context);
		setup();
	}

	public void createFont() {
		Typeface font = Typeface.createFromAsset(getContext().getAssets(), "fonts/poppins_medium.otf");
		setTypeface(font);
	}

	private void setup() {
		setOnTouchListener(this);
	}

	@Override
	public boolean onTouch(View v, MotionEvent event) {
		if (hasOnClickListeners()) {
			switch (event.getAction()) {
				case MotionEvent.ACTION_DOWN:
					setSelected(true);
					break;
				case MotionEvent.ACTION_UP:
				case MotionEvent.ACTION_CANCEL:
					setSelected(false);
					break;
			}
		}

		// allow target view to handle click
		return false;
	}


}
