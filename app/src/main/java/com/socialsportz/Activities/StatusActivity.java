package com.socialsportz.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import com.socialsportz.R;

public class StatusActivity extends AppCompatActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_status);

		Intent mainIntent = getIntent();

		TextView tv4 = (TextView) findViewById(R.id.textView1);

		Log.d("status",mainIntent.getStringExtra("transStatus"));

		String status=mainIntent.getStringExtra("transStatus");
		Log.d("status",status);
		//tv4.setText(mainIntent.getStringExtra("transStatus"));


		showToast(mainIntent.getStringExtra("transStatus"));
	}

	public void showToast(String msg) {

		Log.d("Status",msg);
		Toast.makeText(this, "Toast: " + msg, Toast.LENGTH_LONG).show();

	}
}
