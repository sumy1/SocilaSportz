package com.socialsportz.Activities;

import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.app.Dialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.location.Address;
import android.location.Geocoder;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.provider.Settings;
import android.text.method.HideReturnsTransformationMethod;
import android.text.method.PasswordTransformationMethod;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.google.android.gms.common.api.Status;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.libraries.places.api.model.AddressComponent;
import com.google.android.libraries.places.api.model.Place;
import com.google.android.libraries.places.api.model.TypeFilter;
import com.google.android.libraries.places.widget.Autocomplete;
import com.google.android.libraries.places.widget.AutocompleteActivity;
import com.google.android.libraries.places.widget.model.AutocompleteActivityMode;
import com.socialsportz.Activities.Facility.Adapters.MobileCodeAdapter;
import com.socialsportz.Activities.Facility.FacilityOnGoActivity;
import com.socialsportz.Activities.User.Activities.UserDashboardActivity;
import com.socialsportz.Blocks.Block;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.DispatchQueue.DispatchQueue;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.DataModel;
import com.socialsportz.R;
import com.socialsportz.Services.GPSTracker;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.Validations;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.Objects;

import androidx.annotation.NonNull;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.SwitchCompat;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static android.Manifest.permission.ACCESS_COARSE_LOCATION;
import static android.Manifest.permission.ACCESS_FINE_LOCATION;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_LOCATION;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSION_LOCATION;
import static com.socialsportz.Constants.Constants.kAddress;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel1;
import static com.socialsportz.Constants.Constants.kAuthToken;
import static com.socialsportz.Constants.Constants.kCity;
import static com.socialsportz.Constants.Constants.kCountry;
import static com.socialsportz.Constants.Constants.kCreatedOn;
import static com.socialsportz.Constants.Constants.kEmail;
import static com.socialsportz.Constants.Constants.kGCountry;
import static com.socialsportz.Constants.Constants.kGender;
import static com.socialsportz.Constants.Constants.kIsEmailVerified;
import static com.socialsportz.Constants.Constants.kIsMobileVerified;
import static com.socialsportz.Constants.Constants.kLatitude;
import static com.socialsportz.Constants.Constants.kLocality;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kLoginType;
import static com.socialsportz.Constants.Constants.kLongitude;
import static com.socialsportz.Constants.Constants.kPassword;
import static com.socialsportz.Constants.Constants.kPhone;
import static com.socialsportz.Constants.Constants.kPincode;
import static com.socialsportz.Constants.Constants.kPostalCode;
import static com.socialsportz.Constants.Constants.kRole;
import static com.socialsportz.Constants.Constants.kState;
import static com.socialsportz.Constants.Constants.kStreetAddress;
import static com.socialsportz.Constants.Constants.kUserName;
import static com.socialsportz.Constants.Constants.kUserStatus;

public class SignUpActivity extends AppCompatActivity implements View.OnClickListener {
	private final static String TAG = SignUpActivity.class.getSimpleName();

	private EditText etName,etEmail,etContact,etPassword;
	private TextView tvAddress;
	private SwitchCompat sMale,sFemale, sOther;
	private int role;
	private ImageButton visibilityBtn;
	private ProgressBar progressGPS;
	// private RadioGroup typeRadioGrp;
	private Integer OTP;
	private boolean OTPStatus;
	private String loginType;
	private Dialog dialog;
	private String authKey;
	private String city="",state="",country = "India",pincode = "";
	private double latitude = 0.0 ,longitude = 0.0;
	private TextView tvPhoneCode;
	private int phoneCode=0;
	private boolean otpVerified = false;

	private CustomLoaderView loaderView;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_sign_up);
		loaderView = CustomLoaderView.initialize(this);
		loginType = String.valueOf(getIntent().getIntExtra(kLoginType,1));
		authKey = getIntent().getStringExtra(kAuthToken);
		String name = getIntent().getStringExtra(kUserName);
		String email = getIntent().getStringExtra(kEmail);
		role = getIntent().getIntExtra(kRole,1);

		progressGPS = findViewById(R.id.progressBar);
		etName = findViewById(R.id.et_name);
		etEmail = findViewById(R.id.et_email);
		etContact = findViewById(R.id.et_phone);
		etPassword = findViewById(R.id.et_password);
		visibilityBtn = findViewById(R.id.ib_visible);
		visibilityBtn.setOnClickListener(this);
		visibilityBtn.setTag("InVisible");
		tvAddress = findViewById(R.id.tv_address);
		tvAddress.setOnClickListener(this);

		findViewById(R.id.ib_gps).setOnClickListener(this);
		findViewById(R.id.btn_signUp).setOnClickListener(this);

		sMale = findViewById(R.id.switch_male);
		sFemale = findViewById(R.id.switch_female);
		sOther = findViewById(R.id.switch_trans);
		sMale.setOnCheckedChangeListener((buttonView, isChecked) -> {
			if(isChecked){
				sFemale.setChecked(false);
				sOther.setChecked(false);
			}
		});
		sFemale.setOnCheckedChangeListener((compoundButton, isChecked) -> {
			if(isChecked){
				sMale.setChecked(false);
				sOther.setChecked(false);
			}
		});
		sOther.setOnCheckedChangeListener((compoundButton, isChecked) -> {
			if(isChecked){
				sFemale.setChecked(false);
				sMale.setChecked(false);
			}
		});

        /*typeRadioGrp = findViewById(R.id.type_radio_group);
        typeRadioGrp.setOnCheckedChangeListener((radioGroup, checkedId) -> {
            if(checkedId==R.id.rb_user){
                etName.setHint(R.string.fullname_hint);
                etEmail.setHint(R.string.email_hint);
                etContact.setHint(R.string.phone_hint);
            }else if(checkedId==R.id.rb_owner){
                etName.setHint(R.string.contact_person_name);
                etEmail.setHint(R.string.contact_person_email);
                etContact.setHint(R.string.contact_person_number);
            }
        });*/
		if(role==1){
			etName.setHint(R.string.fullname_hint);
			etEmail.setHint(R.string.email_hint);
			etContact.setHint(R.string.phone_hint);
		}else{
			etName.setHint(R.string.contact_person_name);
			etEmail.setHint(R.string.contact_person_email);
			etContact.setHint(R.string.contact_person_number);
		}

		etName.setText(name);
		etEmail.setText(email);


		tvPhoneCode = findViewById(R.id.tv_phone_code);
		tvPhoneCode.setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		if(v.getId()== R.id.tv_address){
			// Set the fields to specify which types of place data to
			// return after the user has made a selection.
			List<Place.Field> fields = Arrays.asList(Place.Field.ID,Place.Field.NAME,
				Place.Field.ADDRESS_COMPONENTS,Place.Field.ADDRESS,Place.Field.LAT_LNG,Place.Field.TYPES);

			// Start the autocomplete intent.
			Intent intent = new Autocomplete.IntentBuilder(
				AutocompleteActivityMode.OVERLAY, fields)
				.setCountry("IN")
				.setTypeFilter(TypeFilter.REGIONS)
				.build(this);
			startActivityForResult(intent, REQUEST_LOCATION);

            /*Intent intent = new Intent(this, AddressActivity.class);
            startActivityForResult(intent, REQUEST_LOCATION);*/

		}else if(v.getId()== R.id.ib_gps){
			if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M)
				checkGPSAccess();
			else
				getLocation();
		}else if(v.getId()== R.id.ib_visible){
			if (visibilityBtn.getTag().equals("InVisible")){
				etPassword.setTransformationMethod(HideReturnsTransformationMethod.getInstance());
				visibilityBtn.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility));
				visibilityBtn.setTag("Visible");
			} else {
				etPassword.setTransformationMethod(PasswordTransformationMethod.getInstance());
				visibilityBtn.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility_off));
				visibilityBtn.setTag("InVisible");
			}
		}else if(v.getId()== R.id.btn_signUp){
			if(validate()){
				if(otpVerified)
					setSignUp(getSignUpMap());
				else
					getOtp(Utils.getProperText(etContact),Utils.getProperText(etEmail),true);
			}

		} else if(v.getId()==R.id.tv_phone_code){
			CountryCodeDialog();
		}
	}

	@Override
	public void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode == REQUEST_LOCATION) {
            /*if(resultCode == RESULT_OK){
                // Get the user's selected place from the Intent.
                String id = data.getStringExtra("id");
                String address = data.getStringExtra("address");
                tvAddress.setText(address);
                tvAddress.setTag(id);
            }*/
			if (resultCode == RESULT_OK) {
				Place place = Autocomplete.getPlaceFromIntent(data);

				LatLng ln = place.getLatLng();
				assert ln != null;
				latitude = ln.latitude;
				longitude = ln.longitude;

				List<AddressComponent> list = Objects.requireNonNull(place.getAddressComponents()).asList();
				for(int i=0;i<list.size();i++){
					AddressComponent comp = list.get(i);
					switch (comp.getTypes().get(0)) {
						case kLocality:
							city = comp.getName();
							break;
						case kAdministrativeAreaLevel1:
							state = comp.getName();
							break;
						case kGCountry:
							country = comp.getName();
							break;
						case kPostalCode:
							pincode = comp.getName();
							break;
					}
				}

				tvAddress.setText(place.getAddress());
				Log.i(TAG, "Place Id: " + place.getId()+ ", Place: " + place.getAddress() + ", LatLng:"
					+latitude+":"+longitude + ", city:" + city + ", state:" + state + ", country:" + country);
			} else if (resultCode == AutocompleteActivity.RESULT_ERROR) {
				Status status = Autocomplete.getStatusFromIntent(data);
				assert status.getStatusMessage() != null;
				Log.i(TAG, status.getStatusMessage());
			}
		} else if( requestCode == PERMISSIONS_REQUEST){
			if(checkSelfPermission()){
				dialog.dismiss();
			}
		}
	}

	// Mobile OTP Dialog
	private void MobileOtpDialog(){
		final Dialog dialog = new Dialog(SignUpActivity.this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_mobile_otp_screen);
		dialog.setCancelable(false);

		EditText etOTP = dialog.findViewById(R.id.et_otp);
		TextView tvOTPTime = dialog.findViewById(R.id.tv_otp_time);
		Button btResend = dialog.findViewById(R.id.btn_resend);
		Button btVerify = dialog.findViewById(R.id.btn_verify);
		startTimer(tvOTPTime,btResend);

		btResend.setOnClickListener(view -> {
			getOtp(Utils.getProperText(etContact),Utils.getProperText(etEmail),false);
			startTimer(tvOTPTime,btResend);
		});

		btVerify.setOnClickListener(v -> {
			if(etOTP.getText().toString().isEmpty()){
				etOTP.setError("Please enter OTP");
			} else if(!OTPStatus && etOTP.getText().toString().equals(String.valueOf(OTP))){
				etOTP.setError("OTP has expired");
			} else if(OTPStatus && etOTP.getText().toString().equals(String.valueOf(OTP))){
				// set SignUp Data API
				otpVerified = true;
				setSignUp(getSignUpMap());
				dialog.dismiss();
			} else {
				etOTP.setError("Entered wrong OTP");
			}
		});

		dialog.show();
	}

	// Mobile OTP Dialog
	private void CountryCodeDialog(){
		final Dialog dialog = new Dialog(SignUpActivity.this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_mobile_code);
		dialog.setCancelable(true);

		String[] country = getResources().getStringArray(R.array.country_code);
		int[] codes = getResources().getIntArray(R.array.country_value);

		ArrayList<DataModel> facOptions = new ArrayList<>();
		for(int i=0;i<country.length;i++){
			facOptions.add(new DataModel(codes[i],country[i]));
		}
		RecyclerView rvList = dialog.findViewById(R.id.rv_codes);
		LinearLayoutManager mLayoutManager=new LinearLayoutManager(this,RecyclerView.VERTICAL,false);
		MobileCodeAdapter adapter =new MobileCodeAdapter(this, facOptions, data -> {
			phoneCode = data.getId();
			tvPhoneCode.setText("+"+String.valueOf(phoneCode));
			dialog.dismiss();
		});
		rvList.setLayoutManager(mLayoutManager);
		rvList.setAdapter(adapter);
		dialog.show();
	}

	// Start OTP Dialog Timer
	@SuppressLint("DefaultLocale")
	private void startTimer(TextView tvTime, Button btnResend){
		new CountDownTimer(120 *1000+1000, 1000) {

			public void onTick(long millisUntilFinished) {
				OTPStatus = true;
				btnResend.setVisibility(View.GONE);
				int seconds = (int) (millisUntilFinished / 1000);
				int minutes = seconds / 60;
				seconds = seconds % 60;
				String time = String.format("%02d", minutes)
					+ ":" + String.format("%02d", seconds);
				tvTime.setText(time);
			}

			public void onFinish() {
				String time = "00:00";
				tvTime.setText(time);
				OTPStatus = false;
				btnResend.setVisibility(View.VISIBLE);
			}

		}.start();
	}

	private void getOtp(String number,String email,boolean dialogOpen){
		loaderView.showLoader();

		HashMap<String,Object> map = new HashMap<>();
		map.put(kPhone,tvPhoneCode.getText().toString()+number);
		map.put(kEmail,email);
		Log.e(TAG,"number: " + map.toString());
		ModelManager.modelManager().userMobileVerification(map,
			(Constants.Status iStatus, GenericResponse<Integer> genericResponse) -> {
				loaderView.hideLoader();
				OTP = genericResponse.getObject();
				if(dialogOpen)
					MobileOtpDialog();
				//Toaster.customToast(String.valueOf(OTP));
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}

	private boolean validate() {
		boolean isOk = true;

		if (Utils.getProperText(etName).isEmpty()) {
			etName.setError(getString(R.string.error_cannot_be_empty));
			etName.requestFocus();
			isOk = false;
		} else if (!(Validations.isValidName(Utils.getProperText(etName)))) {
			etName.setError(getString(R.string.error_invalid_credential));
			etName.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEmail).isEmpty()) {
			etEmail.setError(getString(R.string.error_cannot_be_empty));
			etEmail.requestFocus();
			isOk = false;
		} else if (!(Validations.isValidEmail(Utils.getProperText(etEmail)))) {
			etEmail.setError(getString(R.string.error_invalid_credential));
			etEmail.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etContact).isEmpty()) {
			etContact.setError(getString(R.string.error_cannot_be_empty));
			etContact.requestFocus();
			isOk = false;
		}
       /* else if (!(Validations.isValidPhone(Utils.getProperText(etContact)))) {
            etContact.setError(getString(R.string.error_invalid_credential));
            etContact.requestFocus();
            isOk = false;
        } */
		else if (Utils.getProperText(tvAddress).isEmpty()) {
			Toaster.customToast("Address cannot be empty");
			isOk = false;
		} else if (Utils.getProperText(etPassword).isEmpty()) {
			etPassword.setError(getString(R.string.error_cannot_be_empty));
			etPassword.requestFocus();
			isOk = false;
		} else if (!Validations.isValidPassword(Utils.getProperText(etPassword))) {
			etPassword.setError(getString(R.string.error_invalid_password));
			etPassword.requestFocus();
			isOk = false;
		} else if(!sMale.isChecked() && !sFemale.isChecked() && !sOther.isChecked()){
			Toaster.customToast("Please select gender");
			isOk=false;
		}

		return isOk;
	}

	public HashMap<String, Object> getSignUpMap() {
		HashMap<String, Object> loginMap = new HashMap<>();
        /*if(typeRadioGrp.getCheckedRadioButtonId()==R.id.rb_owner)
            loginMap.put(kRole, String.valueOf(Constants.Role.Owner.getValue()));
        else
            loginMap.put(kRole, String.valueOf(Constants.Role.EndUser.getValue()));*/
		loginMap.put(kRole,role);
		loginMap.put(kUserName, Utils.getProperText(etName));
		loginMap.put(kEmail, Utils.getProperText(etEmail));
		loginMap.put(kPhone, tvPhoneCode.getText().toString()+Utils.getProperText(etContact));
		if(sMale.isChecked())
			loginMap.put(kGender,"M");
		else if(sFemale.isChecked())
			loginMap.put(kGender,"F");
		else
			loginMap.put(kGender,"T");
		loginMap.put(kPassword,Utils.getProperText(etPassword));
		loginMap.put(kAuthToken,authKey);

		loginMap.put(kAddress,tvAddress.getText());
		loginMap.put(kCity,city);
		loginMap.put(kState,state);
		loginMap.put(kPincode,pincode);
		loginMap.put(kCountry,country);
		loginMap.put(kStreetAddress,tvAddress.getText());
		loginMap.put(kLatitude,String.valueOf(latitude));
		loginMap.put(kLongitude,String.valueOf(longitude));

		loginMap.put(kLoginType,loginType);
		loginMap.put(kIsEmailVerified,"No");
		loginMap.put(kIsMobileVerified,"Yes");
		loginMap.put(kUserStatus,"enable");
		loginMap.put(kCreatedOn,Utils.getTimeStampDate(Calendar.getInstance().getTimeInMillis()));
		return loginMap;
	}

	private void setSignUp(HashMap<String, Object> map) {
		loaderView.showLoader();
		Log.e(TAG, map.toString());
		ModelManager.modelManager().userRegisterRequest(map,
			(Constants.Status iStatus, GenericResponse<CurrentUser> genericResponse) -> {
				loaderView.hideLoader();
				try {
					CurrentUser user = genericResponse.getObject();
					Log.e(TAG,user.toString());
					CongratsDialog(user);
				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}

	private boolean checkSelfPermission(){
		return ContextCompat.checkSelfPermission(this, ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED
			&& ContextCompat.checkSelfPermission(this, ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED;
	}

	@TargetApi(Build.VERSION_CODES.M)
	@RequiresApi(api = Build.VERSION_CODES.M)
	private void checkGPSAccess(){
		if (checkSelfPermission()) {
			getLocation();
		}  else {
			requestPermission();
		}
	}

	@RequiresApi(api = Build.VERSION_CODES.M)
	private void requestPermission(){
		// We've never asked. Just do it.
		requestPermissions(new String[]{ACCESS_FINE_LOCATION, ACCESS_COARSE_LOCATION}, REQUEST_PERMISSION_LOCATION);
	}

	@RequiresApi(api = Build.VERSION_CODES.M)
	@Override
	public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
		if (requestCode == REQUEST_PERMISSION_LOCATION){
			if(grantResults[0] == PackageManager.PERMISSION_GRANTED
				&& grantResults[1] == PackageManager.PERMISSION_GRANTED) {
				getLocation();
			}else if (ActivityCompat.shouldShowRequestPermissionRationale(this, ACCESS_FINE_LOCATION)
				&& ActivityCompat.shouldShowRequestPermissionRationale(this, ACCESS_COARSE_LOCATION)) {
				// We've been denied once before. Explain why we need the permission, then ask again.
				Utils.showDialog(this, getString(R.string.location_permission_required_text),
					getString(R.string.ask_permission_text), getString(R.string.discard_text),
					(dialog, which) -> {
						if (which == -1)
							requestPermission();
						else
							dialog.dismiss();
					});
			} else if (!ActivityCompat.shouldShowRequestPermissionRationale(this, ACCESS_FINE_LOCATION)
				&& !ActivityCompat.shouldShowRequestPermissionRationale(this, ACCESS_COARSE_LOCATION)) {
				// We've been denied for all. Explain why we need the permission, then ask again.
				showDialog();
			}
		}
	}

	// We were not granted permission this time, so don't try to show anything
	//super.onRequestPermissionsResult(requestCode, permissions, grantResults);

	private void showDialog(){
		dialog = new Dialog(SignUpActivity.this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		dialog.setCancelable(false);
		dialog.setContentView(R.layout.dialog_permission_setting);

		TextView text =  dialog.findViewById(R.id.tv_dialog);
		text.setText(kLocationPermissionMsg);

		Button dialogButton = dialog.findViewById(R.id.btn_dialog);
		dialogButton.setOnClickListener(v -> {
			Intent intent = new Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS);
			Uri uri = Uri.fromParts("package", getApplicationContext().getPackageName(), null);
			intent.setData(uri);
			startActivityForResult(intent, PERMISSIONS_REQUEST);
		});
		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

		dialog.show();
	}

	@SuppressLint("MissingPermission")
	private void getLocation(){
		showProgressBar(true);
		GPSTracker gps = new GPSTracker(this);
		// check if GPS enabled
		if (gps.canGetLocation()) {
			showProgressBar(false);
			latitude = gps.getLatitude();
			longitude = gps.getLongitude();
			getAddress(latitude,longitude);
		} else {
			showProgressBar(false);
			Utils.showAlertDialog(this, "Error!",
				"Sorry unable to get current location. Make sure your GPS is ON!",
				(dialogInterface, i) -> {

					String provider = Settings.Secure.getString(getContentResolver(), Settings.Secure.LOCATION_PROVIDERS_ALLOWED);
					if (!provider.contains("gps")) { //if gps is disabled
						final Intent poke = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
						poke.setClassName("com.android.settings", "com.android.settings.widget.SettingsAppWidgetProvider");
						poke.addCategory(Intent.CATEGORY_ALTERNATIVE);
						poke.setData(Uri.parse("3"));
						sendBroadcast(poke);
					}
				});

				/*	Intent intent=new Intent("android.location.GPS_ENABLED_CHANGE");
					intent.putExtra("enabled", true);
					sendBroadcast(intent);*/
                /*String provider = Settings.Secure.getString(getContentResolver(), Settings.Secure.LOCATION_PROVIDERS_ALLOWED);
                if(!provider.contains("gps")){ //if gps is disabled
                    final Intent poke = new Intent();
                    poke.setClassName("com.android.settings", "com.android.settings.widget.SettingsAppWidgetProvider");
                    poke.addCategory(Intent.CATEGORY_ALTERNATIVE);
                    poke.setData(Uri.parse("3"));
                    sendBroadcast(poke);
                }*/
				/*});*/
		}
	}

	private void showProgressBar(boolean b) {
		if (b) {
			progressGPS.setVisibility(View.VISIBLE);
		} else {
			progressGPS.setVisibility(View.GONE);
		}
	}

	public void getAddress(double latitude, double longitude){
		showProgressBar(true);
		getFullAddress(latitude,longitude,(iStatus, response) -> {
			showProgressBar(false);
			HashMap<String,String> map = response.getObject();
			city = map.get(kCity);
			state = map.get(kState);
			country = map.get(kCountry);
			pincode = map.get(kPincode);
			tvAddress.setText(map.get(kAddress));
			Log.i(TAG,"getting address success");
		},(iStatus, error) -> {
			showProgressBar(false);
			Toaster.kalaToast("Unable to Get Location. Check Connection");
		});

	}

	public void getFullAddress(double latitude, double longitude, Block.Success<HashMap<String,String>> success, Block.Failure failure) {
		ModelManager.modelManager().getDispatchQueue().async(() -> {
			try {
				String address ;
				HashMap<String,String> map=  new HashMap<>();
				Geocoder geocoder = new Geocoder(getApplicationContext(), Locale.getDefault());
				List<Address> listAddresses = geocoder.getFromLocation(latitude, longitude, 1);

				Log.d("Adres",listAddresses.toString());
				if(listAddresses!=null && listAddresses.size()>0){
					address = listAddresses.get(0).getFeatureName()+", "+listAddresses.get(0).getSubLocality()+", "+listAddresses.get(0).getSubAdminArea()+", "+listAddresses.get(0).getAdminArea();

					Log.d("CurrentAddress",address);
					map.put(kCity,listAddresses.get(0).getLocality());
					map.put(kState,listAddresses.get(0).getAdminArea());
					map.put(kCountry,listAddresses.get(0).getCountryName());
					map.put(kPincode,listAddresses.get(0).getPostalCode());
					map.put(kAddress,address);
				}
				GenericResponse<HashMap<String,String>> genericResponse = new GenericResponse<>(map);
				DispatchQueue.main(() -> success.iSuccess(Constants.Status.success,genericResponse));
			} catch (Exception e) {
				DispatchQueue.main(() -> failure.iFailure(Constants.Status.fail, e.getMessage()));
			}
		});
	}

	// Congratulations Dialog
	private void CongratsDialog(CurrentUser user){
		final Dialog dialog = new Dialog(this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_congrats_screen);
		dialog.setCancelable(false);
		TextView textView=dialog.findViewById(R.id.tv_player);

		if(user.getRole().equals(Constants.Role.EndUser.getValue())){
			textView.setVisibility(View.GONE);
		}else if(user.getRole().equals(Constants.Role.Owner.getValue())){
			textView.setVisibility(View.VISIBLE);
		}



		dialog.findViewById(R.id.btn_continue).setOnClickListener(v -> {
			dialog.dismiss();
			if(user.getRole().equals(Constants.Role.Owner.getValue())) {
				Intent in = new Intent(SignUpActivity.this, FacilityOnGoActivity.class);
				in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
				startActivity(in);
				finish();
			}else if(user.getRole().equals(Constants.Role.EndUser.getValue())){
				Intent in = new Intent(SignUpActivity.this, UserDashboardActivity.class);
				in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				in.putExtra("FRAG","1");
				in.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
				startActivity(in);
				finish();
			}
		});

		dialog.show();
	}

}
