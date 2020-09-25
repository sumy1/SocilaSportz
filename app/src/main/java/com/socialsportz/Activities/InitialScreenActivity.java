package com.socialsportz.Activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageButton;

import com.socialsportz.CcAvenue.AvenuesParams;
import com.socialsportz.CcAvenue.ServiceUtility;
import com.socialsportz.R;
import com.socialsportz.Utils.Toaster;

public class InitialScreenActivity extends AppCompatActivity {

	private EditText accessCode, merchantId, currency, amount, orderId, rsaKeyUrl, redirectUrl, cancelUrl;

	ImageButton ib_back;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_initial_screen);



		init();
	}




	private void init(){

		accessCode = (EditText) findViewById(R.id.accessCode);

		merchantId = (EditText) findViewById(R.id.merchantId);

		orderId  = (EditText) findViewById(R.id.orderId);

		currency = (EditText) findViewById(R.id.currency);

		amount = (EditText) findViewById(R.id.amount);

		rsaKeyUrl = (EditText) findViewById(R.id.rsaUrl);

		redirectUrl = (EditText) findViewById(R.id.redirectUrl);

		cancelUrl = (EditText) findViewById(R.id.cancelUrl);

		ib_back=findViewById(R.id.ib_back);
		ib_back.setOnClickListener(v->{finish();});



	}

	public void onClick(View view) {

		//Mandatory parameters. Other parameters can be added if required.

		String vAccessCode = ServiceUtility.chkNull(accessCode.getText()).toString().trim();

		String vMerchantId = ServiceUtility.chkNull(merchantId.getText()).toString().trim();

		String vCurrency = ServiceUtility.chkNull(currency.getText()).toString().trim();

		String vAmount = ServiceUtility.chkNull(amount.getText()).toString().trim();

		if(!vAccessCode.equals("") && !vMerchantId.equals("") && !vCurrency.equals("") && !vAmount.equals("")){

			Intent intent = new Intent(this,WebViewActivity.class);

			intent.putExtra(AvenuesParams.ACCESS_CODE, ServiceUtility.chkNull(accessCode.getText()).toString().trim());

			intent.putExtra(AvenuesParams.MERCHANT_ID, ServiceUtility.chkNull(merchantId.getText()).toString().trim());

			intent.putExtra(AvenuesParams.ORDER_ID, ServiceUtility.chkNull(orderId.getText()).toString().trim());

			intent.putExtra(AvenuesParams.CURRENCY, ServiceUtility.chkNull(currency.getText()).toString().trim());

			intent.putExtra(AvenuesParams.AMOUNT, ServiceUtility.chkNull(amount.getText()).toString().trim());



			intent.putExtra(AvenuesParams.REDIRECT_URL, ServiceUtility.chkNull(redirectUrl.getText()).toString().trim());

			intent.putExtra(AvenuesParams.CANCEL_URL, ServiceUtility.chkNull(cancelUrl.getText()).toString().trim());

			intent.putExtra(AvenuesParams.RSA_KEY_URL, ServiceUtility.chkNull(rsaKeyUrl.getText()).toString().trim());





			startActivity(intent);

		}else{

			Toaster.customToast("All parameters are mandatory.");


		}

	}


	@Override

	protected void onStart() {

		super.onStart();

		//generating new order number for every transaction

		Integer randomNum = ServiceUtility.randInt(0, 9999999);

		orderId.setText(randomNum.toString());

	}
}
