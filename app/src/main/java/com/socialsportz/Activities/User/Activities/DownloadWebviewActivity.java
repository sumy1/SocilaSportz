package com.socialsportz.Activities.User.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ImageButton;
import android.widget.TextView;

import com.socialsportz.R;

public class DownloadWebviewActivity extends AppCompatActivity {

	TextView tv_page_title;
	ImageButton ib_back;
	String from;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_download_webview);


		tv_page_title=findViewById(R.id.tv_page_title);
		tv_page_title.setText("Booking Details Pdf");
		ib_back=findViewById(R.id.ib_back);
		ib_back.setOnClickListener(v->{finish();});
		if (getIntent() != null) {
			Intent intent = getIntent();
			try{
				from = intent.getStringExtra("URL");

				Log.d("URL",from);
				WebView myWebView = (WebView) findViewById(R.id.webinfo);
				myWebView.loadUrl(from);
				myWebView.getSettings().setJavaScriptEnabled(true);

				//myWebView.loadUrl("http://someurl.com");
				myWebView.setWebViewClient(new WebViewClient() {
					public boolean shouldOverrideUrlLoading(WebView viewx, String urlx) {
						viewx.loadUrl(urlx);
						return false;
					}
				});
			}catch (Exception e){
				e.printStackTrace();
			}

			//Log.d("url",from.toString());
		}



	}
}
