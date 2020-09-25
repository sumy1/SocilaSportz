package com.socialsportz.Activities;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;

import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
import com.socialsportz.Activities.Facility.FacilityOnGoActivity;
import com.socialsportz.Activities.User.Activities.UserDashboardActivity;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.appcompat.app.AppCompatActivity;

public class SplashActivity extends AppCompatActivity {

    private static int SPLASH_TIME_OUT = 2000;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);

        new Handler().postDelayed(() -> {
            CurrentUser currentUser = ModelManager.modelManager().getCurrentUser();


            if (currentUser == null) {
                Intent loginIntent = new Intent(SplashActivity.this, WelcomeActivity.class);
                startActivity(loginIntent);
                finish();
            } else if(currentUser.getRole().equals(Constants.Role.Owner.getValue()) && currentUser.ismFirstLogin()){
                Intent loginIntent = new Intent(SplashActivity.this, FacilityOnGoActivity.class);
                startActivity(loginIntent);
                finish();
            } else if(currentUser.getRole().equals(Constants.Role.Owner.getValue()) && !currentUser.ismFirstLogin()){
                CopyOnWriteArrayList<Facility> list = ModelManager.modelManager().getCurrentUser().getFacilities();
                if(!list.isEmpty()){
                    ModelManager.modelManager().setFacilitySelectData(list.get(0).getFacId());
                }
                Intent loginIntent = new Intent(SplashActivity.this, FacilityDashboardActivity.class);
                startActivity(loginIntent);
                finish();
            }else if(currentUser.getRole().equals(Constants.Role.EndUser.getValue())){
                Intent loginIntent = new Intent(SplashActivity.this, UserDashboardActivity.class);
                loginIntent.putExtra("FRAG","1");
                startActivity(loginIntent);
                finish();
            }else{
                Intent loginIntent = new Intent(SplashActivity.this, WelcomeActivity.class);
                startActivity(loginIntent);
                finish();
            }

        }, SPLASH_TIME_OUT);
    }
}
