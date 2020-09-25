package com.socialsportz.Activities.User.Activities;

import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.drawable.Drawable;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ImageButton;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.facebook.AccessToken;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.socialsportz.Activities.SignUpActivity;
import com.socialsportz.Activities.User.Fragments.ProfileFragment;
import com.socialsportz.Activities.User.Fragments.UserBookingFragment;
import com.socialsportz.Activities.User.Fragments.UserDashboardFragment;
import com.socialsportz.Activities.User.Fragments.UserFavoritesFragment;
import com.socialsportz.Activities.WelcomeActivity;
import com.socialsportz.ApplicationManager;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.BaseModel;
import com.socialsportz.Models.User.UserEvent;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.Models.User.UserProfile;
import com.socialsportz.R;
import com.socialsportz.SocialManager.FacebookManager;
import com.socialsportz.SocialManager.GoogleManager;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;

import java.util.HashMap;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.kAuthToken;
import static com.socialsportz.Constants.Constants.kCurrentUser;
import static com.socialsportz.Constants.Constants.kEmail;
import static com.socialsportz.Constants.Constants.kLoginType;
import static com.socialsportz.Constants.Constants.kMessageNetworkError;
import static com.socialsportz.Constants.Constants.kRole;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kUserName;

public class UserDashboardActivity extends AppCompatActivity implements ProfileFragment.EventClickListener,UserDashboardFragment.EventClickListener {

    private Fragment currentFragment;
    private TextView tvTitle;
    private RelativeLayout toolbar;
    private GoogleManager googleManager;
    private FacebookManager facebookManager;
    private CustomLoaderView loaderView;
    TextView tv_count;
    String frag,count;

    @Override
    public void onAttachFragment(@NonNull Fragment fragment) {
        super.onAttachFragment(fragment);
        if (fragment instanceof ProfileFragment) {
            ProfileFragment profileFragment = (ProfileFragment) fragment;
            profileFragment.setEventClickListener(this);
        }else if (fragment instanceof UserDashboardFragment) {
            UserDashboardFragment userDashboardFragment = (UserDashboardFragment) fragment;
            userDashboardFragment.setEventClickListener(this);
        }
    }

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_dashboard);
        setStatusBarGradient(UserDashboardActivity.this);
        loaderView = CustomLoaderView.initialize(UserDashboardActivity.this);

        if(getIntent()!=null){
			frag=getIntent().getStringExtra("FRAG");
			Log.d("frag",frag);
		}


		//String strtext=getArguments().getString("message");

        toolbar=findViewById(R.id.toolbar_layout);
        tvTitle=findViewById(R.id.tv_title_toolbar);
		tv_count=findViewById(R.id.tv_count);
        ImageButton ivSearch=findViewById(R.id.iv_search);
        ivSearch.setOnClickListener(view -> {
            Intent intent=new Intent(UserDashboardActivity.this, SearchActivity.class);
            startActivity(intent);
        });
        ImageButton iv_notify=findViewById(R.id.iv_notify);
        iv_notify.setOnClickListener(v->{
            Intent intent=new Intent(UserDashboardActivity.this,NotificationActivity.class);
            startActivity(intent);
        });

        BottomNavigationView navigation = findViewById(R.id.navigation);


        navigation.setOnNavigationItemSelectedListener(mOnNavigationItemSelectedListener);

        // Get and Save Instance for Fragment
        if (savedInstanceState == null) {


			if(frag.equalsIgnoreCase("2")){

				if(getIntent().getStringExtra("Value").equalsIgnoreCase("1")){
					navigation.setSelectedItemId(R.id.action_book);
					changeFragment(new UserBookingFragment(1),false,false,getString(R.string.book));
				}else if(getIntent().getStringExtra("Value").equalsIgnoreCase("0")){
					navigation.setSelectedItemId(R.id.action_book);
					changeFragment(new UserBookingFragment(0),false,false,getString(R.string.book));
				}else if(getIntent().getStringExtra("Value").equalsIgnoreCase("3")){
					navigation.setSelectedItemId(R.id.action_book);
					changeFragment(new UserBookingFragment(0),false,false,getString(R.string.book));
				}


			}else{
				changeFragment(new UserDashboardFragment(),false,false,getString(R.string.app_name));
			}

            // on first time display view for first nav row_banner_item
            //changeFragment(new UserDashboardFragment(),false,false,getString(R.string.app_name));
        }else{
            //Restore the fragment's instance
            //currentFragment = getSupportFragmentManager().getFragment(savedInstanceState, "myFragmentName");
        }

        googleManager = new GoogleManager(UserDashboardActivity.this);
        facebookManager = new FacebookManager(UserDashboardActivity.this);
    }

	@Override
	protected void onResume() {
		super.onResume();
		setEnquiry();
	}

	private BottomNavigationView.OnNavigationItemSelectedListener mOnNavigationItemSelectedListener =
            item -> {
                switch (item.getItemId()) {
                    case R.id.action_dashboard:
                        toolbar.setElevation(0f);
                        changeFragment(new UserDashboardFragment(),false,false,getString(R.string.app_name));
                        return true;
                    case R.id.action_book:
                        changeFragment(new UserBookingFragment(0), false, false, getString(R.string.book));
                        return true;
                    case R.id.action_favorite:
                        changeFragment(new UserFavoritesFragment(), false, false, getString(R.string.favorites));
                        return true;
                    case R.id.action_profile:
                        toolbar.setElevation(20f);
                        changeFragment(new ProfileFragment(), false, false, getString(R.string.profile));
                        return true;
                }
                return false;
            };

    public void changeFragment(Fragment fragment, boolean addToBackStack, boolean animate, String tag) {
        currentFragment = fragment;
        FragmentManager manager = getSupportFragmentManager();
        FragmentTransaction ft = manager.beginTransaction();
        if (animate) {
            ft.setCustomAnimations(R.anim.enter_from_right, R.anim.exit_to_left, R.anim.enter_from_left, R.anim.exit_to_right);
        }
        if (addToBackStack) {
            ft.addToBackStack(tag);
        }
        ft.replace(R.id.content_main, fragment, tag);
        ft.commitAllowingStateLoss();
    }

    @Override
    public void eventClick(UserProfile userProfile) {
        Intent intent=new Intent(UserDashboardActivity.this, EditProfileActivity.class);
        intent.putExtra(Constants.kUserName,userProfile.getUserName());
        intent.putExtra("From","1");
        intent.putExtra(Constants.kEmail,userProfile.getUserEmail());

        if(userProfile.getUseGoogleAddress().isEmpty()){
			intent.putExtra(Constants.kAddress,userProfile.getUseraddress());
		}else{
			intent.putExtra(Constants.kAddress,userProfile.getUseGoogleAddress());
		}



        intent.putExtra(Constants.kPhone,userProfile.getUserPhone());
        intent.putExtra(Constants.kGender,userProfile.getUserGender());
        intent.putExtra(Constants.kImage,userProfile.getUserImage());
        startActivity(intent);

    }

    @Override
    public void logout() {
        logoutData();
    }

	@Override
	public void LogoutUser() {
		logoutDataUser();
	}


	@TargetApi(Build.VERSION_CODES.LOLLIPOP)
    public static void setStatusBarGradient(Activity activity) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            Window window = activity.getWindow();
            Drawable background = activity.getResources().getDrawable(R.drawable.canvas_red_gradient);
            window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            window.setStatusBarColor(activity.getResources().getColor(android.R.color.transparent));
            window.setNavigationBarColor(activity.getResources().getColor(android.R.color.transparent));
            window.setBackgroundDrawable(background);
        }
    }

    @Override
    public void facilityClick(UserFacAca model) {


		if (isConnected()) {
			Intent intent = new Intent(new Intent(UserDashboardActivity.this, FacilityDetailActivity.class));
			intent.putExtra("bundleUserFac",model);
			intent.putExtra("TYPE","Facility");
			intent.putExtra("FROM","1");
			startActivity(intent);
		} else {
			Toaster.customToast(kMessageNetworkError);
		}


        ;
    }

    @Override
    public void acadimyClick(UserFacAca model) {


		if (isConnected()) {
			Intent intent = new Intent(new Intent(UserDashboardActivity.this, AcademyDetailActivity.class));
			intent.putExtra("bundleUserFac",model);
			intent.putExtra("TYPE","Academy");
			intent.putExtra("FROM","1");
			startActivity(intent);
		} else {
			Toaster.customToast(kMessageNetworkError);
		}


    }

    @Override
    public void eventClick(UserEvent event) {


		if (isConnected()) {
			Intent intent = new Intent(new Intent(UserDashboardActivity.this,EventDetailActivity.class));
			intent.putExtra("bundleUserFac",event);
			intent.putExtra("TYPE","Event");
			intent.putExtra("FROM","1");
			startActivity(intent);
		} else {
			Toaster.customToast(kMessageNetworkError);
		}


    }



	public boolean isConnected() {
		boolean connected = false;
		try {
			ConnectivityManager cm = (ConnectivityManager)getApplicationContext().getSystemService(Context.CONNECTIVITY_SERVICE);
			NetworkInfo nInfo = cm.getActiveNetworkInfo();
			connected = nInfo != null && nInfo.isAvailable() && nInfo.isConnected();
			return connected;
		} catch (Exception e) {
			Log.e("Connectivity Exception", e.getMessage());
		}
		return connected;
	}

    public void logoutData(){
        loaderView.showLoader();
        ModelManager.modelManager().getLogout(iStatus -> {
            loaderView.hideLoader();
            clearContent();
        },(iStatus, error) -> {
            loaderView.hideLoader();
            Toaster.customToast(error);
        });
    }

	public void logoutDataUser(){
		loaderView.showLoader();
		ModelManager.modelManager().getLogout(iStatus -> {
			loaderView.hideLoader();
			clearContentUser();
		},(iStatus, error) -> {
			loaderView.hideLoader();
			Toaster.customToast(error);
		});
	}

    private void clearContent() {
        SharedPreferences preferences = ApplicationManager.getContext()
                .getSharedPreferences(BaseModel.kAppPreferences, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
		editor.remove(kCurrentUser);
        editor.apply();{
            ModelManager.modelManager().setCurrentUser(null);
        }

        if(googleManager.getAlreadyLogin()!=null)
            googleManager.signOut();
        if(AccessToken.getCurrentAccessToken()!=null)
            facebookManager.onLogout();
        setIntent();
    }

	private void clearContentUser() {
		SharedPreferences preferences = ApplicationManager.getContext()
			.getSharedPreferences(BaseModel.kAppPreferences, Context.MODE_PRIVATE);
		SharedPreferences.Editor editor = preferences.edit();
		editor.remove(kCurrentUser);
		editor.apply();{
			ModelManager.modelManager().setCurrentUser(null);
		}

		if(googleManager.getAlreadyLogin()!=null)
			googleManager.signOut();
		if(AccessToken.getCurrentAccessToken()!=null)
			facebookManager.onLogout();
		setIntentPartner();
	}

    private void setIntent(){
        Intent in = new Intent(UserDashboardActivity.this, WelcomeActivity.class);
        in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(in);
        finish();
    }

	private void setIntentPartner(){
		Intent in = new Intent(UserDashboardActivity.this, SignUpActivity.class);
		in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
		in.putExtra(kLoginType,Constants.LoginType.Normal.getValue());
		in.putExtra(kAuthToken,"");
		in.putExtra(kUserName,"");
		in.putExtra(kEmail,"");
		in.putExtra(kRole, Constants.Role.Owner.getValue());
		startActivity(in);
		startActivity(in);
		finish();
	}


	private void setEnquiry() {
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		Log.e( "enquiry_: " ,map.toString());
		ModelManager.modelManager().usergetNotCount(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();

				try {
					count= genericResponse.getObject();

					if(count.isEmpty()){
						tv_count.setVisibility(View.GONE);
					}else{
						tv_count.setVisibility(View.VISIBLE);
						tv_count.setText(count);
					}
					/*Toaster.customToast(msg);
					Log.e(TAG, "msg: " + msg);*/
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}

}
