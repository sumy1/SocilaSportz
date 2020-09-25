package com.socialsportz.Activities.Facility;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.Configuration;
import android.os.Bundle;
import android.os.PersistableBundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.PopupWindow;
import android.widget.SimpleAdapter;
import android.widget.TextView;

import com.facebook.AccessToken;
import com.google.android.material.internal.NavigationMenuView;
import com.google.android.material.navigation.NavigationView;
import com.socialsportz.Activities.Facility.Fragments.BatchSlotFragment;
import com.socialsportz.Activities.Facility.Fragments.BookingFragment;
import com.socialsportz.Activities.Facility.Fragments.CoreBookingFragment;
import com.socialsportz.Activities.Facility.Fragments.CoreEventBookingFragment;
import com.socialsportz.Activities.Facility.Fragments.EmailAlertFragment;
import com.socialsportz.Activities.Facility.Fragments.EnquiryFragment;
import com.socialsportz.Activities.Facility.Fragments.EventBookingFragment;
import com.socialsportz.Activities.Facility.Fragments.EventsFragment;
import com.socialsportz.Activities.Facility.Fragments.FacDashboardFragment;
import com.socialsportz.Activities.Facility.Fragments.NotificationsFragment;
import com.socialsportz.Activities.Facility.Fragments.RatingReviewFragment;
import com.socialsportz.Activities.Facility.Fragments.SportBookingFragment;
import com.socialsportz.Activities.Facility.Fragments.StatisticsFragment;
import com.socialsportz.Activities.Facility.Fragments.UserProfileFragment;
import com.socialsportz.Activities.WelcomeActivity;
import com.socialsportz.ApplicationManager;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.BaseModel;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.TotalBookingView;
import com.socialsportz.R;
import com.socialsportz.SocialManager.FacebookManager;
import com.socialsportz.SocialManager.GoogleManager;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.Toaster;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import static com.socialsportz.Constants.Constants.kCurrentUser;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kId;
import static com.socialsportz.Constants.Constants.kImage;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kSportName;
import static com.socialsportz.Constants.Constants.kStartDate;
import static com.socialsportz.Constants.Constants.kTitle;
import static com.socialsportz.Constants.Constants.kTodayBooking;
import static com.socialsportz.Constants.Constants.kTodaysTransations;
import static com.socialsportz.Constants.Constants.kUpcomingBookingBatch;
import static com.socialsportz.Constants.Constants.kUpcomingTrialBooking;
import static com.socialsportz.Constants.Constants.kUpcomingcancelledBatchCount;

public class FacilityDashboardActivity extends AppCompatActivity implements View.OnClickListener, NavigationView.OnNavigationItemSelectedListener, FacDashboardFragment.EventClickListener, UserProfileFragment.OnUpdateListener {

	public static String TAG = FacilityDashboardActivity.class.getSimpleName();
	Toolbar toolbar;
	private DrawerLayout drawer;
	private ActionBarDrawerToggle toggle;
	private NavigationView navigationView;
	private Fragment currentFragment;
	private TextView tvTitle;
	private DropDownView tvFacAcaName;
	private int facId;
	public  String factype;
	private CurrentUser user;
	private GoogleManager googleManager;
	private FacebookManager facebookManager;
	private CustomLoaderView loaderView;
	private TextView tvNotCount, tvAlertCount;

	ImageView img_drop;
	TotalBookingView totalBookingView;



	@Override
	public void onAttachFragment(@NonNull Fragment fragment) {
		super.onAttachFragment(fragment);
		if (fragment instanceof FacDashboardFragment) {
			FacDashboardFragment facFragment = (FacDashboardFragment) fragment;
			facFragment.setEventListener(this);
		} else if (fragment instanceof UserProfileFragment) {
			UserProfileFragment facFragment = (UserProfileFragment) fragment;
			facFragment.setProfileUpdateListener(this);
		}
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.facility_dashboard_main);

		loaderView = CustomLoaderView.initialize(this);
		tvTitle = findViewById(R.id.tv_title_toolbar);
		tvNotCount = findViewById(R.id.tv_not_count);
		tvAlertCount = findViewById(R.id.tv_alert_count);
		CurrentUser user = ModelManager.modelManager().getCurrentUser();
		tvFacAcaName = findViewById(R.id.tv_select_name);
		img_drop = findViewById(R.id.img_drop);
		ModelManager.modelManager().setFirstLoginDone();
		CopyOnWriteArrayList<Facility> list = ModelManager.modelManager().getCurrentUser().getFacilities();


		if (list.isEmpty()) {
			img_drop.setVisibility(View.GONE);
			tvFacAcaName.setText("Add Facility/Academy");
		} else {
			img_drop.setVisibility(View.VISIBLE);
			tvFacAcaName.setOnClickListener(view -> showListMenu(tvFacAcaName));
			if (!list.isEmpty()) {
				int facId = ModelManager.modelManager().getCurrentUser().getSelectedFacId();
				for (int i = 0; i < list.size(); i++) {
					if (list.get(i).getFacId() == facId) {
						tvFacAcaName.setText(list.get(i).getFacName());
						break;
					}
				}
			}
		}

		//CopyOnWriteArrayList<Facility> list = ModelManager.modelManager().getCurrentUser().getFacilities();


		drawer = findViewById(R.id.drawer_layout);
		toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
		drawer.addDrawerListener(toggle);
		toggle.syncState();

		findViewById(R.id.iv_menu).setOnClickListener(v -> {
			if (drawer.isDrawerVisible(GravityCompat.START)) {
				drawer.closeDrawer(GravityCompat.START);
			} else {
				drawer.openDrawer(GravityCompat.START);
			}
		});

		navigationView = findViewById(R.id.nav_view);
		navigationView.setNavigationItemSelectedListener(this);
		// Hide Navigation View ScrollBar
		NavigationMenuView navigationMenuView = (NavigationMenuView) navigationView.getChildAt(0);
		if (navigationMenuView != null) {
			navigationMenuView.setVerticalScrollBarEnabled(false);
		}


		// Get and Save Instance for Fragment
		if (savedInstanceState == null) {
			// on first time display view for first nav row_banner_item
			changeFragment(new FacDashboardFragment(), false, false, getString(R.string.app_name));
			navigationView.setCheckedItem(R.id.action_dash);
			drawer.setDrawerTitle(GravityCompat.START, "Home");
		} else {
			//Restore the fragment's instance
			currentFragment = getSupportFragmentManager().getFragment(savedInstanceState, "myFragmentName");
		}


		LinearLayout view = (LinearLayout) LayoutInflater.from(this).inflate(R.layout.facility_nav_header_main, null);
		TextView tvUserName = view.findViewById(R.id.tv_user_name);
		TextView tvUserMail = view.findViewById(R.id.tv_user_mail);
		tvUserName.setText(user.getUsername());
		//tvUserMail.setText(user.getEmail());
		navigationView.addHeaderView(view);

		findViewById(R.id.iv_notify).setOnClickListener(this);
		findViewById(R.id.iv_mail).setOnClickListener(this);

		googleManager = new GoogleManager(FacilityDashboardActivity.this);
		facebookManager = new FacebookManager(FacilityDashboardActivity.this);
	}

	@SuppressLint("InflateParams")
	private void showListMenu(final DropDownView anchor) {
		CopyOnWriteArrayList<Facility> list = ModelManager.modelManager().getCurrentUser().getFacilities();
		if (!list.isEmpty()) {
			List<HashMap<String, Object>> data = new ArrayList<>();
			for (int i = 0; i < list.size(); i++) {
				HashMap<String, Object> map = new HashMap<>();
				map.put(kId, list.get(i).getFacId());
				map.put(kTitle, list.get(i).getFacName());
				map.put(kImage, R.drawable.ic_games_black_24dp);
				data.add(map);
			}

			// Create SimpleAdapter that will be used by short message list view.
			ListAdapter adapter = new SimpleAdapter(
				this, data, R.layout.row_fac_listing_design,
				new String[]{kTitle, kImage, kId}, // These are just the keys that the data uses (constant strings)
				new int[]{R.id.select_text, R.id.select_icon}); // The view ids to map the data to view
			// Get list popup view.
			View popupView = getLayoutInflater().inflate(R.layout.fac_dashboard_listing_menu_design, null);
			ListView listView = popupView.findViewById(R.id.popupWindowSmsList);
			listView.setAdapter(adapter);

			// Create popup window.
			PopupWindow popupWindow = new PopupWindow(popupView, ViewGroup.LayoutParams.WRAP_CONTENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			popupWindow.setBackgroundDrawable(getResources().getDrawable(R.drawable.canvas_card_window_background));
			popupWindow.setFocusable(true);
			popupWindow.setElevation(5);
			popupWindow.setOutsideTouchable(true);
			popupWindow.update();
			// Show popup window offset 1,1 to tvFacAcaName.
			popupWindow.showAsDropDown(anchor, 5, 1);

			//ClickListener to ListItem
			listView.setOnItemClickListener((adapterView, view, index, l) -> {
				facId = (int) data.get(index).get(kId);
				anchor.setText((String) data.get(index).get(kTitle));
				ModelManager.modelManager().setFacilitySelectData(facId);
				Log.e(TAG, "FacId:" + facId + ",FacName:" + anchor.getText().toString() );
				popupWindow.dismiss();
				checkNavigationItem();
			});
		}
	}




	private void checkNavigationItem() {
		if (navigationView.getMenu().findItem(R.id.action_dash).isChecked()) {
			FacDashboardFragment fragment = (FacDashboardFragment) currentFragment;
			fragment.getDashBoardData();
		} else if (navigationView.getMenu().findItem(R.id.action_account).isChecked()) {
			UserProfileFragment fragment = (UserProfileFragment) currentFragment;
			fragment.setData(0);
		} else if (navigationView.getMenu().findItem(R.id.action_slot_batch).isChecked()) {
			BatchSlotFragment fragment = (BatchSlotFragment) currentFragment;
			fragment.clearData();
		}
		/*else if (navigationView.getMenu().findItem(R.id.action_sport).isChecked()) {
			SportBookingFragment fragment = (SportBookingFragment) currentFragment;
			fragment.setData();
		}*/
		else if (navigationView.getMenu().findItem(R.id.action_booking).isChecked()) {
			CoreBookingFragment fragment = (CoreBookingFragment) currentFragment;
			fragment.setData();
		} else if (navigationView.getMenu().findItem(R.id.action_event_booking).isChecked()) {
			CoreEventBookingFragment fragment = (CoreEventBookingFragment) currentFragment;
			fragment.setData();
		}
		/*else if (navigationView.getMenu().findItem(R.id.action_events).isChecked()) {
			EventsFragment fragment = (EventsFragment) currentFragment;
			fragment.clearData();
		} */
		else if (navigationView.getMenu().findItem(R.id.action_enquiry).isChecked()) {
			EnquiryFragment fragment = (EnquiryFragment) currentFragment;
			fragment.clearData();
		} else if (navigationView.getMenu().findItem(R.id.action_rating).isChecked()) {
			RatingReviewFragment fragment = (RatingReviewFragment) currentFragment;
			fragment.clearData();
		} else if (navigationView.getMenu().findItem(R.id.action_email).isChecked()) {
			EmailAlertFragment fragment = (EmailAlertFragment) currentFragment;
			fragment.clearData();
		} else if (navigationView.getMenu().findItem(R.id.action_notification).isChecked()) {
			NotificationsFragment fragment = (NotificationsFragment) currentFragment;
			fragment.clearData();
		} else if (navigationView.getMenu().findItem(R.id.action_stats).isChecked()) {
			StatisticsFragment fragment = (StatisticsFragment) currentFragment;
			fragment.setData();
		}
	}

	@Override
	public void onSaveInstanceState(@NonNull Bundle state) {
		super.onSaveInstanceState(state);
		getSupportFragmentManager().putFragment(state, "myFragmentName", currentFragment);
	}

	@Override
	public void onPostCreate(@Nullable Bundle savedInstanceState, @Nullable PersistableBundle persistentState) {
		super.onPostCreate(savedInstanceState, persistentState);
		toggle.syncState();
	}

	@Override
	public void onConfigurationChanged(@NonNull Configuration newConfig) {
		super.onConfigurationChanged(newConfig);
		toggle.onConfigurationChanged(newConfig);
	}

	@Override
	public boolean onOptionsItemSelected(@NonNull MenuItem item) {
		return toggle.onOptionsItemSelected(item) || super.onOptionsItemSelected(item);
	}


	@Override
	public void onClick(View view) {
		if (view.getId() == R.id.iv_notify) {
			tvTitle.setText(R.string.notifications);
			navigationView.setCheckedItem(R.id.action_notification);
			changeFragment(new NotificationsFragment(), true, true, getString(R.string.notifications));
		} else if (view.getId() == R.id.iv_mail) {
			tvTitle.setText(R.string.email_alert);
			navigationView.setCheckedItem(R.id.action_email);
			changeFragment(new EmailAlertFragment(), true, true, getString(R.string.email_alert));
		}
	}

	@Override
	public boolean onNavigationItemSelected(MenuItem item) {
		switch (item.getItemId()) {
			case R.id.action_dash:
				tvTitle.setText(R.string.app_name);
				changeFragment(new FacDashboardFragment(), true, true, getString(R.string.app_name));
				break;
			case R.id.action_account:
				tvTitle.setText(R.string.account_info);
				changeFragment(new UserProfileFragment(), true, true, getString(R.string.account_info));
				break;
		/*	case R.id.action_sport:
				tvTitle.setText(R.string.sport_booking);
				changeFragment(new SportBookingFragment(), true, true, getString(R.string.sport_booking));
				break;*/
			case R.id.action_booking:
				tvTitle.setText(R.string.booking_detail);
				changeFragment(new CoreBookingFragment(), true, true, getString(R.string.booking_detail));
				break;
			case R.id.action_event_booking:
				tvTitle.setText(R.string.event_booking);
				changeFragment(new CoreEventBookingFragment(), true, true, getString(R.string.event_booking));
				break;
			/*case R.id.action_events:
				tvTitle.setText(R.string.my_events);
				changeFragment(new EventsFragment(), true, true, getString(R.string.my_events));
				break;*/
			case R.id.action_enquiry:
				tvTitle.setText(R.string.enquiry);
				changeFragment(new EnquiryFragment(), true, true, getString(R.string.enquiry));
				break;
			case R.id.action_rating:
				tvTitle.setText(R.string.rating_n_review);
				changeFragment(new RatingReviewFragment(), true, true, getString(R.string.rating_n_review));
				break;
			case R.id.action_slot_batch:
				tvTitle.setText(R.string.batch_slot);
				changeFragment(new BatchSlotFragment(), true, true, getString(R.string.batch_slot));
				break;
			case R.id.action_email:
				tvTitle.setText(R.string.email_alert);
				changeFragment(new EmailAlertFragment(), true, true, getString(R.string.email_alert));
				break;
			case R.id.action_notification:
				tvTitle.setText(R.string.notifications);
				changeFragment(new NotificationsFragment(), true, true, getString(R.string.notifications));
				break;
			case R.id.action_stats:
				tvTitle.setText(R.string.statistics);
				changeFragment(new StatisticsFragment(), true, true, getString(R.string.statistics));
				break;
			case R.id.action_logout:
				logoutData();
				break;
		}
		drawer.closeDrawer(GravityCompat.START);
		return true;
	}

	@Override
	protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode == 1) {
			if (resultCode == RESULT_OK) {
				bookingClick(totalBookingView);
			}
		}
	}

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

	public void logoutData() {
		loaderView.showLoader();
		ModelManager.modelManager().getLogout(iStatus -> {
			loaderView.hideLoader();
			clearContent();
		}, (iStatus, error) -> {
			loaderView.hideLoader();
			Toaster.customToast(error);
		});
	}

	private void clearContent() {
		SharedPreferences preferences = ApplicationManager.getContext()
			.getSharedPreferences(BaseModel.kAppPreferences, Context.MODE_PRIVATE);
		SharedPreferences.Editor editor = preferences.edit();
		editor.clear();
		editor.remove(kCurrentUser);
		editor.apply();
		{
			ModelManager.modelManager().setCurrentUser(null);
		}

		if (googleManager.getAlreadyLogin() != null)
			googleManager.signOut();
		if (AccessToken.getCurrentAccessToken() != null)
			facebookManager.onLogout();
		setIntent();
	}

	private void setIntent() {
		Intent in = new Intent(FacilityDashboardActivity.this, WelcomeActivity.class);
		in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
		startActivity(in);
		finish();
	}

	@Override
	public void profileClick() {
		tvTitle.setText(R.string.account_info);
		changeFragment(new UserProfileFragment(), true, true, getString(R.string.account_info));
		navigationView.setCheckedItem(R.id.action_account);
	}

	@Override
	public void bookingClick(TotalBookingView totalBookingView) {

		try{
			if(totalBookingView.getTotalText().equalsIgnoreCase(kUpcomingTrialBooking)){
				tvTitle.setText(R.string.enquiry);
				changeFragment(new EnquiryFragment(), true, true, getString(R.string.booking_detail));
				navigationView.setCheckedItem(R.id.action_booking);
			}else{
				tvTitle.setText(R.string.booking_detail);
				changeFragment(new CoreBookingFragment(), true, true, getString(R.string.booking_detail));
				navigationView.setCheckedItem(R.id.action_booking);
			}
		}catch(Exception e){
			e.printStackTrace();
		}



			/*switch (totalBookingView.getTotalText()) {
				case kTodayBooking:

					break;
				case kUpcomingTrialBooking:

					break;
				case kTodaysTransations:

					break;
				case kUpcomingcancelledBatchCount:

					break;
				case kUpcomingBookingBatch:

					break;
			}*/
		}



	/*@Override
	public void bookingClick(mData) {
		tvTitle.setText(R.string.booking_detail);
		changeFragment(new BookingFragment(), true, true, getString(R.string.booking_detail));
		navigationView.setCheckedItem(R.id.action_booking);
	}*/

	@Override
	public void eventClick() {
		/*tvTitle.setText(R.string.my_events);
		changeFragment(new EventsFragment(), true, true, getString(R.string.my_events));
		navigationView.setCheckedItem(R.id.action_events);*/
	}

	@Override
	public void enquiryClick() {
		tvTitle.setText(R.string.enquiry);
		changeFragment(new EnquiryFragment(), true, true, getString(R.string.enquiry));
		navigationView.setCheckedItem(R.id.action_enquiry);
	}

	@Override
	public void ratingClick() {
		tvTitle.setText(R.string.rating_n_review);
		changeFragment(new RatingReviewFragment(), true, true, getString(R.string.rating_n_review));
		navigationView.setCheckedItem(R.id.action_rating);
	}

	@Override
	public void facilityData() {

	}

	@Override
	public void notificationAlertData() {
		int nCount = ModelManager.modelManager().getCurrentUser().getNotificationCount();
		int aCount = ModelManager.modelManager().getCurrentUser().getEmailAlertCount();
		if (nCount != 0) {
			tvNotCount.setVisibility(View.VISIBLE);
			tvNotCount.setText(String.valueOf(nCount));
		} else
			tvNotCount.setVisibility(View.INVISIBLE);

		if (aCount != 0) {
			tvAlertCount.setVisibility(View.VISIBLE);
			tvAlertCount.setText(String.valueOf(aCount));
		} else
			tvAlertCount.setVisibility(View.INVISIBLE);

	}

	@Override
	public void slotBatchAvail(int facId, int sportId, String sportName, String date, String facType) {
		Intent in = new Intent(FacilityDashboardActivity.this, FacilityBookActivity.class);
		in.putExtra(kFacId, facId);
		in.putExtra(kSportId, sportId);
		in.putExtra(kSportName, sportName);
		in.putExtra(kStartDate, date);
		in.putExtra("FacType", facType);
		startActivityForResult(in, 1);
		//finish();
	}

	@Override
	public void onBackPressed() {
		if (drawer.isDrawerOpen(GravityCompat.START)) {
			drawer.closeDrawer(GravityCompat.START);
		} else {
			assert currentFragment.getTag() != null;
			if (currentFragment.getTag().equals(getString(R.string.app_name))) {
				getSupportFragmentManager().popBackStack(null, FragmentManager.POP_BACK_STACK_INCLUSIVE);
				super.onBackPressed();
			} else {
				getSupportFragmentManager().popBackStack(null, FragmentManager.POP_BACK_STACK_INCLUSIVE);
				changeFragment(new FacDashboardFragment(), false, false, getString(R.string.app_name));
				navigationView.setCheckedItem(R.id.action_dash);
				tvTitle.setText(R.string.app_name);
			}
		}
	}

	@Override
	public void onUpdate() {
		CurrentUser user = ModelManager.modelManager().getCurrentUser();
		View view = navigationView.getHeaderView(0);
		TextView tvUserName = view.findViewById(R.id.tv_user_name);
		TextView tvUserMail = view.findViewById(R.id.tv_user_mail);
		tvUserName.setText(user.getUsername());
		tvUserMail.setText(user.getEmail());
	}


}
