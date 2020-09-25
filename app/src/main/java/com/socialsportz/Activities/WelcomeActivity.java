package com.socialsportz.Activities;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.widget.Button;

import com.socialsportz.Constants.Constants;
import com.socialsportz.R;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import androidx.core.app.ActivityCompat;

import static com.socialsportz.Constants.Constants.kAuthToken;
import static com.socialsportz.Constants.Constants.kEmail;
import static com.socialsportz.Constants.Constants.kLoginType;
import static com.socialsportz.Constants.Constants.kRole;
import static com.socialsportz.Constants.Constants.kUserName;

public class WelcomeActivity extends AppCompatActivity {



	CardView cv;
	Button btn_login_with_palyer,btn_login_with_partner;
	boolean isClick;
	public static final int REQUEST_CODE_PERMISSIONS = 101;
	AlertDialog.Builder builder;
	@Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome_screen);

		//requestLocationPermission();
		//builder = new AlertDialog.Builder(this);




		cv=findViewById(R.id.cv);
		btn_login_with_palyer=findViewById(R.id.btn_login_with_palyer);
		btn_login_with_partner=findViewById(R.id.btn_login_with_partner);






        findViewById(R.id.btn_signIn).setOnClickListener(v ->{



			Intent intent=new Intent(WelcomeActivity.this,SignInActivity.class);
			intent.putExtra("FROM","1");
			startActivity(intent);

			/*Animation slideUp = AnimationUtils.loadAnimation(getApplicationContext(), R.anim.slide_up);
			Animation slideDown = AnimationUtils.loadAnimation(getApplicationContext(), R.anim.slide_down);

        	if(isClick==false){
				cv.startAnimation(slideUp);
				cv.setVisibility(View.VISIBLE);
				isClick=true;
			}else{
				cv.startAnimation(slideDown);
				isClick=false;

				new Handler().postDelayed(new Runnable() {
					@Override
					public void run() {
						cv.setVisibility(View.GONE);
					}
				},300);

			}*/
		});

		/*btn_login_with_palyer.setOnClickListener(v->{
			isClick=false;
			cv.setVisibility(View.GONE);
			Intent intent=new Intent(WelcomeActivity.this,SignInActivity.class);
			intent.putExtra("FROM","1");
			startActivity(intent);
		});

		btn_login_with_partner.setOnClickListener(v->{
			isClick=false;
			cv.setVisibility(View.GONE);
			Intent intent=new Intent(WelcomeActivity.this,SignInActivity.class);
			intent.putExtra("FROM","2");
			startActivity(intent);
		});*/

        findViewById(R.id.btn_signUp_user).setOnClickListener(v -> setSignUpIntent(Constants.Role.EndUser.getValue()));

        findViewById(R.id.btn_signUp_owner).setOnClickListener(v -> setSignUpIntent(Constants.Role.Owner.getValue()));
    }

    private void setSignUpIntent(int role){
        Intent in = new Intent(WelcomeActivity.this,SignUpActivity.class);
        in.putExtra(kLoginType,Constants.LoginType.Normal.getValue());
        in.putExtra(kAuthToken,"");
        in.putExtra(kUserName,"");
        in.putExtra(kEmail,"");
        in.putExtra(kRole, role);
        startActivity(in);
    }


	private void requestLocationPermission() {

		boolean foreground = ActivityCompat.checkSelfPermission(this,
			Manifest.permission.ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED;

		if (foreground) {
			boolean background = ActivityCompat.checkSelfPermission(this,
				Manifest.permission.ACCESS_BACKGROUND_LOCATION) == PackageManager.PERMISSION_GRANTED;

			if (background) {
				handleLocationUpdates();
			} else {
				ActivityCompat.requestPermissions(this,
					new String[]{Manifest.permission.ACCESS_BACKGROUND_LOCATION}, REQUEST_CODE_PERMISSIONS);
			}
		} else {
			ActivityCompat.requestPermissions(this,
				new String[]{Manifest.permission.ACCESS_COARSE_LOCATION,
					Manifest.permission.ACCESS_BACKGROUND_LOCATION}, REQUEST_CODE_PERMISSIONS);
		}
	}

	@Override
	public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
		super.onRequestPermissionsResult(requestCode, permissions, grantResults);
		if (requestCode == REQUEST_CODE_PERMISSIONS) {

			boolean foreground = false, background = false;

			for (int i = 0; i < permissions.length; i++) {
				if (permissions[i].equalsIgnoreCase(Manifest.permission.ACCESS_COARSE_LOCATION)) {
					//foreground permission allowed
					if (grantResults[i] >= 0) {
						foreground = true;
						//Toast.makeText(getApplicationContext(), "Foreground location permission allowed", Toast.LENGTH_SHORT).show();
						continue;
					} else {
						//Toast.makeText(getApplicationContext(), "Location Permission denied", Toast.LENGTH_SHORT).show();
						break;
					}
				}

				if (permissions[i].equalsIgnoreCase(Manifest.permission.ACCESS_BACKGROUND_LOCATION)) {
					if (grantResults[i] >= 0) {
						foreground = true;
						background = true;
						//Toast.makeText(getApplicationContext(), "Background location location permission allowed", Toast.LENGTH_SHORT).show();
					} else {
						//Toast.makeText(getApplicationContext(), "Background location location permission denied", Toast.LENGTH_SHORT).show();
					}

				}
			}

			if (foreground) {
				if (background) {
					handleLocationUpdates();
				} else {
					handleForegroundLocationUpdates();
				}
			}
		}
	}

	private void handleLocationUpdates() {
		//foreground and background
		//Toast.makeText(getApplicationContext(),"Start Foreground and Background Location Updates",Toast.LENGTH_SHORT).show();
	}

	private void handleForegroundLocationUpdates() {
		//handleForeground Location Updates
		//Toast.makeText(getApplicationContext(),"Start foreground location updates",Toast.LENGTH_SHORT).show();
	}
}
