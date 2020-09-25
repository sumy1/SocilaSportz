package com.socialsportz.Activities.User.Fragments;

import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.net.Uri;
import android.os.Bundle;
import android.provider.Settings;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.User.Activities.MyEnquireActivity;
import com.socialsportz.Activities.User.Activities.MyReviewsActivity;
import com.socialsportz.Activities.User.Activities.NotificationActivity;
import com.socialsportz.Activities.User.Activities.UserDashboardActivity;
import com.socialsportz.Activities.User.Adapters.FavSportsAdapter;
import com.socialsportz.Activities.User.Adapters.FavSportsMasterAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.MasterSports;
import com.socialsportz.Models.User.UserProfile;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DividerItemRecyclerDecoration;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import de.hdodenhof.circleimageview.CircleImageView;

import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kUserId;

public class ProfileFragment extends Fragment {
	private static final String TAG = ProfileFragment.class.getSimpleName();
	private EventClickListener listener;
	private Context context;
	private RecyclerView rvTotal, rvSport, rv_sport_edit;
	private Button btn_review, btn_enquiry,btn_becom_partner;
	CustomLoaderView loaderView;
	private UserProfile userProfiles;
	private JSONObject bookingCount;
	Dialog dialog;
	TextView tv_name, tv_email,tv_gender, tv_phone, tv_address, total_no_myBooking, total_no_event_booking, total_no_myEnquiry, total_no_notifications, total_no_myReview;

	int myBooking, eventBooking, myEnquiry, notificatioc, review;
	ImageView img_edit_sports;
	CopyOnWriteArrayList<MasterSports> masterSports = new CopyOnWriteArrayList<>();
	CopyOnWriteArrayList<Sport> mdata = new CopyOnWriteArrayList<>();
	String sportId, profile_path,From="";

	JSONArray sportIdArray = new JSONArray();
	CircleImageView iv_profile;
	FavSportsMasterAdapter favSportsAdapter;
	LinearLayout ll_myBooking, ll_eventBooking, ll_myEnquiry, ll_notification, ll_myReview;
	BottomNavigationView navigation;

	public ProfileFragment() {
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
	}

	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
		View rootView = inflater.inflate(R.layout.fragment_user_profile, container, false);
		context = getActivity();
		loaderView = CustomLoaderView.initialize(context);
		inItView(rootView);
		getProfile();

		return rootView;
	}

	@Override
	public void onResume() {
		super.onResume();
		getProfile();

	}

	public void setdate(UserProfile userProfiles, JSONObject bookingCount) {

		tv_name.setText(userProfiles.getUserName());

		tv_email.setText(userProfiles.getUserEmail());

		tv_phone.setText(userProfiles.getUserPhone());

		tv_address.setText(userProfiles.getUseraddress());

		if(userProfiles.getUserGender().contains("M")){
			tv_gender.setText(getString(R.string.male));

			if (!userProfiles.getUserProfile().isEmpty()) {
				Picasso.with(context).load(userProfiles.getUserProfile()).placeholder(R.drawable.man).fit().into(iv_profile);
			} else {
				Picasso.with(context).load(userProfiles.getUserProfile()).placeholder(R.drawable.man).fit().into(iv_profile);
			}
		}else if(userProfiles.getUserGender().contains("F")){
			tv_gender.setText(getString(R.string.female));

			if (!userProfiles.getUserProfile().isEmpty()) {
				Picasso.with(context).load(userProfiles.getUserProfile()).placeholder(R.drawable.girl).fit().into(iv_profile);
			} else {
				Picasso.with(context).load(userProfiles.getUserProfile()).placeholder(R.drawable.girl).fit().into(iv_profile);
			}
		}else{
			tv_gender.setText(getString(R.string.male));
			if (!userProfiles.getUserProfile().isEmpty()) {
				Picasso.with(context).load(userProfiles.getUserProfile()).placeholder(R.drawable.man).fit().into(iv_profile);
			} else {
				Picasso.with(context).load(userProfiles.getUserProfile()).placeholder(R.drawable.man).fit().into(iv_profile);
			}
		}


		Log.d("Image", userProfiles.getUserProfile());



		try {
			myBooking = bookingCount.getInt(Constants.kMyBooking);
			total_no_myBooking.setText(Integer.toString(myBooking));
		} catch (JSONException e) {
			e.printStackTrace();
		}


		try {
			eventBooking = bookingCount.getInt(Constants.kEventBookin);
			total_no_event_booking.setText(Integer.toString(eventBooking));
			Log.d("Booking_count2", eventBooking + "");
		} catch (JSONException e) {
			e.printStackTrace();
		}


		try {
			myEnquiry = bookingCount.getInt(Constants.kMyEnquiry);
			total_no_myEnquiry.setText(Integer.toString(myEnquiry));
			Log.d("Booking_count3", myEnquiry + "");
		} catch (JSONException e) {
			e.printStackTrace();
		}


		try {
			notificatioc = bookingCount.getInt(Constants.kNotifications);
			total_no_notifications.setText(Integer.toString(notificatioc));
			Log.d("Booking_count4", notificatioc + "");
		} catch (JSONException e) {
			e.printStackTrace();
		}


		try {
			review = bookingCount.getInt(Constants.kMyReviews);
			total_no_myReview.setText(Integer.toString(review));
			Log.d("Booking_count5", review + "");
		} catch (JSONException e) {
			e.printStackTrace();
		}


	}

	public void inItView(View rootView) {

		ll_myBooking = rootView.findViewById(R.id.ll_myBooking);

		ll_myBooking.setOnClickListener(v-> {
				Intent intent = new Intent(context, UserDashboardActivity.class);
				intent.putExtra("FRAG", "2");
				intent.putExtra("Value", "0");
				startActivity(intent);
				getActivity().finish();

			});



		ll_eventBooking = rootView.findViewById(R.id.ll_eventBooking);

		ll_eventBooking.setOnClickListener(v->{
			Intent intent1=new Intent(context, UserDashboardActivity.class);
			intent1.putExtra("FRAG","2");
			intent1.putExtra("Value","1");
			startActivity(intent1);
			getActivity().finish();


		});

		ll_myEnquiry = rootView.findViewById(R.id.ll_myEnquiry);

		ll_myEnquiry.setOnClickListener(v->{startActivity(new Intent(context,MyEnquireActivity.class));});

		ll_notification = rootView.findViewById(R.id.ll_notification);

		ll_notification.setOnClickListener(v->{startActivity(new Intent(context, NotificationActivity.class));});

		ll_myReview = rootView.findViewById(R.id.ll_myReview);

		ll_myReview.setOnClickListener(v->{startActivity(new Intent(context, MyReviewsActivity.class));});

		btn_becom_partner=rootView.findViewById(R.id.btn_becom_partner);
		btn_becom_partner.setOnClickListener(v -> {
			becomAparterDialog();
		});


		iv_profile = rootView.findViewById(R.id.iv_profile);
		tv_name = rootView.findViewById(R.id.tv_name);
		tv_email = rootView.findViewById(R.id.tv_email);
		tv_phone = rootView.findViewById(R.id.tv_phone);
		tv_address = rootView.findViewById(R.id.tv_address);
		tv_gender=rootView.findViewById(R.id.tv_gender);
		total_no_myBooking = rootView.findViewById(R.id.total_no_myBooking);
		total_no_event_booking = rootView.findViewById(R.id.total_no_event_booking);
		total_no_myEnquiry = rootView.findViewById(R.id.total_no_myEnquiry);
		total_no_notifications = rootView.findViewById(R.id.total_no_notifications);
		total_no_myReview = rootView.findViewById(R.id.total_no_myReview);

		img_edit_sports = rootView.findViewById(R.id.img_edit_sports);
		img_edit_sports.setOnClickListener(v -> {
			editSportsDialog();
		});


		Button editButton = rootView.findViewById(R.id.btn_edit);
		editButton.setOnClickListener(view -> listener.eventClick(userProfiles));

		Button lgBtn = rootView.findViewById(R.id.btn_logout);
		lgBtn.setOnClickListener(view -> listener.logout());

		btn_review = rootView.findViewById(R.id.btn_review);
		btn_review.setOnClickListener(v -> {
			Intent intent = new Intent(context, MyReviewsActivity.class);
			startActivity(intent);
		});

		btn_enquiry = rootView.findViewById(R.id.btn_enquiry);
		btn_enquiry.setOnClickListener(v -> {
			Intent intent = new Intent(context, MyEnquireActivity.class);
			startActivity(intent);
		});


		rvSport = rootView.findViewById(R.id.rv_sport);
		rvSport.setLayoutManager(new GridLayoutManager(context, 3, GridLayoutManager.VERTICAL, false));
		rvSport.addItemDecoration(new SpaceItemDecoration(2));
		rvSport.setNestedScrollingEnabled(false);


	}





	private void setSportData(CopyOnWriteArrayList<Sport> mdata) {
		FavSportsAdapter favSportsAdapter = new FavSportsAdapter(context, mdata);
		rvSport.setAdapter(favSportsAdapter);
		favSportsAdapter.notifyDataSetChanged();
	}

	public void setEventClickListener(EventClickListener listener) {
		this.listener = listener;
	}


	public interface EventClickListener {
		void eventClick(UserProfile userProfile);

		void logout();

		void LogoutUser();
	}



	private void editSportsDialog() {
		// dialog
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_editsport);
		rv_sport_edit = dialog.findViewById(R.id.rv_sport_edit);
		rv_sport_edit.setLayoutManager(new GridLayoutManager(context, 2));
		rv_sport_edit.setNestedScrollingEnabled(false);
		rvSport.addItemDecoration(new DividerItemRecyclerDecoration(context));
		favSportsAdapter = new FavSportsMasterAdapter(context, masterSports, mdata
		);
		rv_sport_edit.setAdapter(favSportsAdapter);

		dialog.findViewById(R.id.btn_submit).setOnClickListener(view -> {




				sportIdArray = favSportsAdapter.getAray();


				if(favSportsAdapter.getSportsSelectionStatus()){
                 Toaster.customToast("Please select at least one sports");
				}else{
					fetUpdateSports(sportIdArray);
				}

				///...Log.d("id", sportIdArray + "");


			}
		);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
		dialog.show();
	}

	private void becomAparterDialog() {
		// dialog
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_become);


		dialog.findViewById(R.id.btn_yes).setOnClickListener(view -> {
			dialog.dismiss();
            listener.LogoutUser();

			}
		);

		dialog.findViewById(R.id.btn_no).setOnClickListener(view -> {
			dialog.dismiss();
			}
		);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
		dialog.show();
	}


	private void getProfile() {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		Log.e(TAG, map.toString());
		ModelManager.modelManager().userProfile(map, (iStatus, response) -> {
			try {
				loaderView.hideLoader();
				userProfiles = response.getObject();
				bookingCount = userProfiles.getBppkingCount();
				setdate(userProfiles, bookingCount);
				mdata = userProfiles.getSportListing();
				setSportData(mdata);
				masterSports = userProfiles.getMasterSports();

				Log.d("Master", masterSports.size() + "");

			} catch (Exception e) {
				e.printStackTrace();
			}

		}, (iStatus, error) -> {
			loaderView.hideLoader();
			// ::: Custom Toast
			Toast.makeText(context, error, Toast.LENGTH_SHORT).show();
		});
	}

	private void showDialog() {
		dialog = new Dialog(Objects.requireNonNull(getActivity()));
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		dialog.setCancelable(false);
		dialog.setContentView(R.layout.dialog_permission_setting);

		TextView text = dialog.findViewById(R.id.tv_dialog);
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


	private void fetUpdateSports(JSONArray sportId) {
		dialog.dismiss();
		loaderView.showLoader();

		HashMap<String, Object> map = new HashMap<>();
		map.put(kSportId, sportId);
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());

		Log.e("map", "enquiry_: " + map.toString());
		ModelManager.modelManager().userSendUpdateSports(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();

				try {
					String msg = genericResponse.getObject();
					Toaster.customToast("Sports updated successfully!");
					getProfile();
					// Log.e(TAG,"msg: " +msg);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}


}
