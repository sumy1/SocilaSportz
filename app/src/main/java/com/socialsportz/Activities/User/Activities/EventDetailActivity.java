package com.socialsportz.Activities.User.Activities;

import android.Manifest;
import android.annotation.TargetApi;
import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.graphics.drawable.Drawable;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.MotionEvent;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.material.tabs.TabLayout;
import com.socialsportz.Activities.User.Adapters.EventViewGallaryAdapter;
import com.socialsportz.Models.User.UserEventViewGallery;
import com.socialsportz.Utils.HorizontalSpaceItemDecoration;
import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.User.Adapters.EventAmenityAdapter;
import com.socialsportz.Activities.User.Adapters.TabLayoutEventAdapter;
import com.socialsportz.Activities.User.Adapters.TabLayoutEventAdapterr;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.EventListing;
import com.socialsportz.Models.User.UserEvent;
import com.socialsportz.Models.User.UserFacEventAmenities;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.NestedViewPager;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.cardview.widget.CardView;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.StaggeredGridLayoutManager;

import static com.socialsportz.Constants.Constants.kAction;
import static com.socialsportz.Constants.Constants.kEnquireMessage;
import static com.socialsportz.Constants.Constants.kEnquiryTitle;
import static com.socialsportz.Constants.Constants.kEventId;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kUserId;

public class EventDetailActivity extends AppCompatActivity implements OnMapReadyCallback {

	private static final String TAG = EventDetailActivity.class.getSimpleName();
	private TabLayout tabLayout;
	private NestedViewPager viewPager;
	private RecyclerView rvAmenity;
	private EventViewGallaryAdapter viewGallaryAdapter;
	private EventAmenityAdapter amenityAdapter;
	UserEvent userEvent;
	Button fab;

	Button btn_enquiry, btn_sport;
	;

	//..new code here..

	private CustomLoaderView loaderView;
	Dialog dialog;
	RecyclerView rv_amenity,rv_view_gallery;
	TextView tv_categories,tv_g, tv_agecategories, tv_award_prize, tv_field, tv_a, tv_venue, tv_price, tv_bookings, tv_sport_name, tv_name, tv_email, tv_phone, tv_start_date,
		tv_end_date, tv_st_enroll_date, tv_ed_enroll_date, tv_start_time, tv_end_time;

	RelativeLayout btn_amenities, bt_getDirection,bt_gallery;
	ImageView img_arrow_direc, iv_sport, img_arrow_amenities, img_arrow_direc_invisibale, img_arrow_amenities_invisibale;

	private GoogleMap mMap;
	CopyOnWriteArrayList<Sport> sports;

	CopyOnWriteArrayList<UserFacEventAmenities> mAmenities;
	ImageView img_banner,img_arrow_gallary,img_arrow_gallary_invisibale;
	LinearLayout layout_map, ll_categories, ll_agecategory, ll_awardprize;
	String fac_type;
	EventListing eventListing;
	Double lat = 28.5355161, lang = 77.3910265;
	private static final int LOCATION_REQUEST_CODE = 101;
	LinearLayout ll_amenities,ll_gallery;
	String SportName = "", datee = "", eventName = "", enrollEnddate = "", booking = "", maxParticipants = "", from = "", event_id = "", sportId = "", price = "";

	CardView cv_categories;
	Context context;
	@Override
	protected void onCreate(@Nullable Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_event_detail);
		setStatusBarGradient(EventDetailActivity.this);
		context=this;
		loaderView = CustomLoaderView.initialize(this);
		getCurrentDate();


		if (getIntent() != null) {

			if (getIntent().getStringExtra("FROM").equalsIgnoreCase("1")) {
				userEvent = (UserEvent) getIntent().getSerializableExtra("bundleUserFac");


				if (getIntent().getStringExtra("TYPE").isEmpty()) {

				} else {
					fac_type = getIntent().getStringExtra("TYPE");

					Log.d("facetype", fac_type);
				}
			} else if (getIntent().getStringExtra("FROM").equalsIgnoreCase("2")) {
				userEvent = (UserEvent) getIntent().getSerializableExtra("bundleUserFac");


				if (getIntent().getStringExtra("TYPE").isEmpty()) {

				} else {
					fac_type = getIntent().getStringExtra("TYPE");

					Log.d("facetype", fac_type);
				}
				SportName = getIntent().getStringExtra("SPORTNAME");

			} else if (getIntent().getStringExtra("FROM").equalsIgnoreCase("3")) {

				from = getIntent().getStringExtra("FROM");
				eventListing = (EventListing) getIntent().getSerializableExtra("bundleUserFac");


				if (getIntent().getStringExtra("TYPE").isEmpty()) {

				} else {
					fac_type = getIntent().getStringExtra("TYPE");

					Log.d("facetype", fac_type);
				}
			}

		}

		Toolbar toolbar = findViewById(R.id.detail_toolbar);
		setSupportActionBar(toolbar);
		Objects.requireNonNull(getSupportActionBar()).setDisplayHomeAsUpEnabled(true);
		getSupportActionBar().setDisplayShowHomeEnabled(true);

		inItView();

		initData();



       /* findViewById(R.id.fab).setOnClickListener(v -> {
            Intent in = new Intent(EventDetailActivity.this, UserBookSlotBatchActivity.class);
            in.putExtra("Sports", sports);
            in.putExtra("Id", userEvent.getFacId());
            startActivity(in);
            //finish();
        });*/


	}

	private void inItView() {
		tabLayout = findViewById(R.id.tabLayout);
		viewPager = findViewById(R.id.viewPager);
		rvAmenity = findViewById(R.id.rv_amenity);
		tv_a = findViewById(R.id.tv_a);
		iv_sport = findViewById(R.id.iv_sport);
		rvAmenity.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL));


		tv_g=findViewById(R.id.tv_gg);
		rv_view_gallery = findViewById(R.id.rv_view_galleryy);
		rv_view_gallery.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL ));
		rv_view_gallery.addItemDecoration(new HorizontalSpaceItemDecoration(10));
		rv_view_gallery.setHasFixedSize(true);
		bt_gallery = findViewById(R.id.bt_gallery);
		ll_gallery=findViewById(R.id.ll_gallery);
		bt_gallery.setOnClickListener(v ->
		{
			if (ll_gallery.getVisibility() == View.VISIBLE) {
				ll_gallery.setVisibility(View.GONE);
				img_arrow_gallary.setVisibility(View.VISIBLE);
				img_arrow_gallary_invisibale.setVisibility(View.GONE);
			} else {
				ll_gallery.setVisibility(View.VISIBLE);
				img_arrow_gallary.setVisibility(View.GONE);
				img_arrow_gallary_invisibale.setVisibility(View.VISIBLE);
			}
		});


		if (from.equalsIgnoreCase("3")) {
			CopyOnWriteArrayList<Amenity> amenities = eventListing.getAmenities();

			getAmenityData(amenities);

			CopyOnWriteArrayList<UserEventViewGallery> viewGallery=eventListing.getFacGalleryList();
			getGalleryData(viewGallery);
		} else {
			CopyOnWriteArrayList<Amenity> amenities = userEvent.getAmenities();

			getAmenityData(amenities);

			CopyOnWriteArrayList<UserEventViewGallery> viewGallery=userEvent.getFacGalleryList();
			getGalleryData(viewGallery);
		}


		cv_categories = findViewById(R.id.cv_categories);
		ll_categories = findViewById(R.id.ll_categories);
		img_arrow_gallary = findViewById(R.id.img_arrow_gallary);
		img_arrow_gallary_invisibale = findViewById(R.id.img_arrow_gallary_invisibale);
		ll_agecategory = findViewById(R.id.ll_agecategory);
		ll_awardprize = findViewById(R.id.ll_awardprize);
		tv_categories = findViewById(R.id.tv_categories);
		tv_agecategories = findViewById(R.id.tv_agecategories);
		tv_award_prize = findViewById(R.id.tv_award_prize);


		img_banner = findViewById(R.id.img_banner);
		tv_field = findViewById(R.id.tv_field);
		tv_venue = findViewById(R.id.tv_venue);
		tv_price = findViewById(R.id.tv_price);
		tv_bookings = findViewById(R.id.tv_bookings);
		tv_sport_name = findViewById(R.id.tv_sport_name);
		tv_name = findViewById(R.id.tv_name);
		tv_email = findViewById(R.id.tv_email);
		tv_phone = findViewById(R.id.tv_phone);
		tv_start_date = findViewById(R.id.tv_start_date);
		tv_end_date = findViewById(R.id.tv_end_date);
		tv_st_enroll_date = findViewById(R.id.tv_st_enroll_date);
		tv_ed_enroll_date = findViewById(R.id.tv_ed_enroll_date);
		tv_start_time = findViewById(R.id.tv_start_time);
		tv_end_time = findViewById(R.id.tv_end_time);
		SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
			.findFragmentById(R.id.map);
		mapFragment.getMapAsync(this);
		setStatusBarGradient(EventDetailActivity.this);
		bt_getDirection = findViewById(R.id.bt_getDirection);
		ll_amenities = findViewById(R.id.ll_amenities);
		img_arrow_direc = findViewById(R.id.img_arrow_direc);
		img_arrow_amenities = findViewById(R.id.img_arrow_amenities);
		img_arrow_direc_invisibale = findViewById(R.id.img_arrow_direc_invisibale);
		img_arrow_amenities_invisibale = findViewById(R.id.img_arrow_amenities_invisibale);

		layout_map = findViewById(R.id.layout_map);
		bt_getDirection.setOnClickListener(v ->
		{
			if (layout_map.getVisibility() == View.VISIBLE) {
				layout_map.setVisibility(View.GONE);
				img_arrow_direc.setVisibility(View.VISIBLE);
				img_arrow_direc_invisibale.setVisibility(View.GONE);
			} else {
				layout_map.setVisibility(View.VISIBLE);
				img_arrow_direc.setVisibility(View.GONE);
				img_arrow_direc_invisibale.setVisibility(View.VISIBLE);
			}
		});



		fab = findViewById(R.id.fab);
		btn_amenities = findViewById(R.id.btn_amenities);
		btn_amenities.setOnClickListener(v ->
		{
			if (ll_amenities.getVisibility() == View.VISIBLE) {
				ll_amenities.setVisibility(View.GONE);
				img_arrow_amenities.setVisibility(View.VISIBLE);
				img_arrow_amenities_invisibale.setVisibility(View.GONE);
			} else {
				ll_amenities.setVisibility(View.VISIBLE);
				img_arrow_amenities.setVisibility(View.GONE);
				img_arrow_amenities_invisibale.setVisibility(View.VISIBLE);

			}
		});


		if (from.equalsIgnoreCase("3")) {
			eventName = eventListing.getEventName();

			try {
				lat = Double.valueOf(eventListing.getEventLat());
				lang = Double.valueOf(eventListing.getEventLang());
			} catch (Exception e) {
				e.printStackTrace();
			}


			event_id = String.valueOf(eventListing.getEventId());
			sportId = eventListing.getSportId();
			price = eventListing.getPrice();
			if (!eventListing.getBanner().isEmpty()) {
				String imgPath = kImageBaseUrl + eventListing.getFacFolder() + "/" + eventListing.getBanner();
				Picasso.with(this).load(imgPath).placeholder(R.drawable.running_event).fit().into(img_banner);
			} else {
				Picasso.with(this).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(img_banner);
			}

			/*if (!eventListing.getSportIcon().isEmpty()) {
				String imgPath = kImageBaseUrl + eventListing.getFacFolder() + "/" + eventListing.getSportIcon();
				Picasso.with(this).load(imgPath).placeholder(R.drawable.football_image).fit().into(iv_sport);
			} else {
				Picasso.with(this).load(R.drawable.football_image).placeholder(R.drawable.football_image).fit().into(iv_sport);
			}*/
			tv_price.setText(eventListing.getPrice());
			tv_field.setText(eventListing.getEventName());
			tv_venue.setText(eventListing.getVenue());
			tv_price.setText(eventListing.getPrice());
			booking = String.valueOf(eventListing.getBooked());
			maxParticipants = eventListing.getParticipants();
			tv_bookings.setText("Booking" + " " + eventListing.getBooked() + "/" + eventListing.getParticipants());
			//tv_sport_name.setText(eventListing.getSportName());
			tv_email.setText(eventListing.getContactEmail());
			tv_name.setText(eventListing.getContactPerson());
			tv_start_date.setText(eventListing.getSdate());
			tv_end_date.setText(eventListing.getEdate());
			tv_st_enroll_date.setText(eventListing.getEnrollStart());
			enrollEnddate = eventListing.getEnrollEnd();
			tv_ed_enroll_date.setText(eventListing.getEnrollEnd());
			tv_start_time.setText(eventListing.getStime());
			tv_end_time.setText(eventListing.getEtime());
			tv_phone.setText(eventListing.getContactNumber());


			if(eventListing.getEventCategories().isEmpty() && eventListing.getEventAgeCategory().isEmpty() && eventListing.getEventAwardPrize().isEmpty()){
              cv_categories.setVisibility(View.GONE);
			}else{
				cv_categories.setVisibility(View.VISIBLE);


				if(eventListing.getEventCategories().isEmpty()){
					ll_categories.setVisibility(View.GONE);
				}else{
					ll_categories.setVisibility(View.VISIBLE);
					tv_categories.setText(eventListing.getEventCategories());
				}
				if(eventListing.getEventAgeCategory().isEmpty()){
					ll_agecategory.setVisibility(View.GONE);
				}else{
					ll_agecategory.setVisibility(View.VISIBLE);
					tv_agecategories.setText(eventListing.getEventAgeCategory());
				}
				if(eventListing.getEventAwardPrize().isEmpty()){
					ll_awardprize.setVisibility(View.GONE);
				}else{
					ll_awardprize.setVisibility(View.VISIBLE);
					tv_award_prize.setText(eventListing.getEventAwardPrize());
				}

			}


			if (eventListing.getBooked() < Integer.parseInt(eventListing.getParticipants()) || datee.compareTo(enrollEnddate) > 0) {
				Log.d("print", "da");
				fab.setVisibility(View.VISIBLE);

			} else {
				Log.d("da1", "da");
				fab.setVisibility(View.GONE);
			}
		} else {
			eventName = userEvent.getEventName();
			lat = Double.valueOf(userEvent.getEventLat());
			lang = Double.valueOf(userEvent.getEventLang());
			event_id = String.valueOf(userEvent.getEventId());
			sportId = String.valueOf(userEvent.getSportId());
			price = userEvent.getPrice();
			if (!userEvent.getBanner().isEmpty()) {
				String imgPath = kImageBaseUrl + userEvent.getFacFolder() + "/" + userEvent.getBanner();
				Picasso.with(this).load(imgPath).placeholder(R.drawable.running_event).fit().into(img_banner);
			} else {
				Picasso.with(this).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(img_banner);
			}
			tv_price.setText(userEvent.getPrice());
			tv_field.setText(userEvent.getEventName());
			tv_venue.setText(userEvent.getDesc());
			tv_price.setText(userEvent.getPrice());
			booking = String.valueOf(userEvent.getBooked());
			maxParticipants = userEvent.getParticipants();
			tv_phone.setText(userEvent.getContactNumber());
			tv_bookings.setText("Booking" + " " + userEvent.getBooked() + "/" + userEvent.getParticipants());
			tv_sport_name.setText(userEvent.getSportName());
			tv_email.setText(userEvent.getContactEmail());
			tv_name.setText(userEvent.getContactPerson());
			tv_start_date.setText(userEvent.getSdate());
			tv_end_date.setText(userEvent.getEdate());
			tv_st_enroll_date.setText(userEvent.getEnrollStart());
			enrollEnddate = userEvent.getEnrollEnd();
			tv_ed_enroll_date.setText(userEvent.getEnrollEnd());
			tv_start_time.setText(userEvent.getStime());
			tv_end_time.setText(userEvent.getEtime());
			if (userEvent.getBooked() < Integer.parseInt(userEvent.getParticipants()) || datee.compareTo(enrollEnddate) > 0) {
				Log.d("print", "da");
				fab.setVisibility(View.VISIBLE);

			} else {
				Log.d("da1", "da");
				fab.setVisibility(View.GONE);
			}
		}


		img_banner.setOnTouchListener(new View.OnTouchListener() {
			@Override
			public boolean onTouch(View v, MotionEvent event) {

				CongratsDialog();
				return false;
			}
		});

		btn_enquiry = findViewById(R.id.btn_enquiry);
		btn_enquiry.setOnClickListener(v -> {
			enquiryDialog();
		});

		fab.setOnClickListener(v -> {

			Intent intent = new Intent(EventDetailActivity.this, UserCalenderCheckoutActivity.class);
			intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
			intent.putExtra("TYPE", "Event");
			intent.putExtra("SportId", sportId);
			intent.putExtra("FROM", "1");
			intent.putExtra("EVENTID", event_id);
			startActivity(intent);
			//finish();

			//getBookingreguest();
		});

	}

	private void initData() {
		tabLayout.addTab(tabLayout.newTab().setText(getString(R.string.things_note)));
		tabLayout.addTab(tabLayout.newTab().setText(getString(R.string.description_tab)));
		tabLayout.addTab(tabLayout.newTab().setText(getString(R.string.rules_tab)));
		//tabLayout.setTabGravity(TabLayout.GRAVITY_FILL);

		if (from.equalsIgnoreCase("3")) {
			TabLayoutEventAdapterr adapter = new TabLayoutEventAdapterr(this, getSupportFragmentManager(), tabLayout.getTabCount(), eventListing);
			viewPager.setAdapter(adapter);

			viewPager.addOnPageChangeListener(new TabLayout.TabLayoutOnPageChangeListener(tabLayout));
			tabLayout.addOnTabSelectedListener(new TabLayout.OnTabSelectedListener() {
				@Override
				public void onTabSelected(TabLayout.Tab tab) {

					switch (tab.getPosition()) {
						case 0:
							/* Toast.makeText(context,)*/
							break;
						case 1:

							break;
						case 2:
							break;
					}

					viewPager.setCurrentItem(tab.getPosition());

				}

				@Override
				public void onTabUnselected(TabLayout.Tab tab) {

				}

				@Override
				public void onTabReselected(TabLayout.Tab tab) {

				}
			});
			viewPager.setPagingEnabled(true);
			viewPager.setPagingEnabled(false);
		} else {
			TabLayoutEventAdapter adapter = new TabLayoutEventAdapter(this, getSupportFragmentManager(), tabLayout.getTabCount(), userEvent);
			viewPager.setAdapter(adapter);

			viewPager.addOnPageChangeListener(new TabLayout.TabLayoutOnPageChangeListener(tabLayout));
			tabLayout.addOnTabSelectedListener(new TabLayout.OnTabSelectedListener() {
				@Override
				public void onTabSelected(TabLayout.Tab tab) {

					switch (tab.getPosition()) {
						case 0:
							/* Toast.makeText(context,)*/
							break;
						case 1:

							break;
						case 2:
							break;
					}

					viewPager.setCurrentItem(tab.getPosition());

				}

				@Override
				public void onTabUnselected(TabLayout.Tab tab) {

				}

				@Override
				public void onTabReselected(TabLayout.Tab tab) {

				}
			});
			viewPager.setPagingEnabled(true);
			viewPager.setPagingEnabled(false);
		}

	}


	private void CongratsDialog() {
		final Dialog dialog = new Dialog(this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_zoom);
		dialog.setCancelable(true);
		ImageView tv_msg=dialog.findViewById(R.id.img_banner);
		TextView img_cross = dialog.findViewById(R.id.iv_cross);
		img_cross.setOnClickListener(v -> {
			dialog.dismiss();
		});


		if (from.equalsIgnoreCase("3")) {

			if (!eventListing.getBanner().isEmpty()) {
				String imgPath = kImageBaseUrl + eventListing.getFacFolder() + "/" + eventListing.getBanner();
				Picasso.with(this).load(imgPath).placeholder(R.drawable.running_event).fit().into(tv_msg);
			} else {
				Picasso.with(this).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(tv_msg);
			}
		} else {
			if (!userEvent.getBanner().isEmpty()) {
				String imgPath = kImageBaseUrl + userEvent.getFacFolder() + "/" + userEvent.getBanner();
				Picasso.with(this).load(imgPath).placeholder(R.drawable.running_event).fit().into(tv_msg);
			} else {
				Picasso.with(this).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(tv_msg);
			}

		}


		dialog.show();
	}

	private void getCurrentDate() {
		Calendar startDate = Calendar.getInstance();

		SimpleDateFormat sdf = new SimpleDateFormat("yy-MM-dd");

		datee = sdf.format(startDate.getTime());

		Log.d("CDate", datee);
	}

   /* private void getAmenityData() {
        CopyOnWriteArrayList<Amenity> amenities = new CopyOnWriteArrayList<>();
        amenities.add(new Amenity(1, "Amenity", ""));
        amenities.add(new Amenity(1, "Amenity", ""));
        amenities.add(new Amenity(1, "Amenity", ""));
        amenities.add(new Amenity(1, "Amenity", ""));
        amenities.add(new Amenity(1, "Amenity", ""));
        setAmenityData(amenities);
        getAmenitiesData();
    }*/

	private void setAmenityData(CopyOnWriteArrayList<Amenity> list) {

		if (list.isEmpty()) {
			tv_a.setVisibility(View.VISIBLE);
			rvAmenity.setVisibility(View.GONE);

		} else {
			tv_a.setVisibility(View.GONE);
			rvAmenity.setVisibility(View.VISIBLE);
			amenityAdapter = new EventAmenityAdapter(this, list, () -> {
			});
			rvAmenity.setAdapter(amenityAdapter);
		}

	}
	private void getGalleryData(CopyOnWriteArrayList<UserEventViewGallery> viewGallery) {
		setGalleryData(viewGallery);
	}

	private void getAmenityData(CopyOnWriteArrayList<Amenity> amenities) {
		setAmenityData(amenities);
		//getAmenitiesData();

	}

	private void setGalleryData(CopyOnWriteArrayList<UserEventViewGallery> gallerylist){
		if(gallerylist.isEmpty()){
			tv_g.setVisibility(View.VISIBLE);
			rv_view_gallery.setVisibility(View.GONE);

		}else{
			tv_g.setVisibility(View.GONE);
			rv_view_gallery.setVisibility(View.VISIBLE);
			viewGallaryAdapter = new EventViewGallaryAdapter(context, gallerylist);
			rv_view_gallery.setAdapter(viewGallaryAdapter);
		}

	}

	private void getAmenitiesData() {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kAction, event_id);
		ModelManager.modelManager().userAmenities(parameters,
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Amenity>> genericResponse) -> {
				try {
					CopyOnWriteArrayList<Amenity> sports = genericResponse.getObject();
					amenityAdapter.newData(sports);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
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
	public boolean onSupportNavigateUp() {
		onBackPressed();
		return true;
	}

	//...new code here..

	private void enquiryDialog() {
		// dialog
		dialog = new Dialog(this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_enquiry);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
		EditText editText = dialog.findViewById(R.id.et_subject);
		EditText editText1 = dialog.findViewById(R.id.et_message);
		TextView tv_sport_name = dialog.findViewById(R.id.tv_sport_name);
		tv_sport_name.setText(eventName);
		dialog.findViewById(R.id.btn_submit).setOnClickListener(view -> {
			if (Utils.getProperText(editText).isEmpty())
				Toaster.customToast("Please enter subject");
			else if (Utils.getProperText(editText1).isEmpty())
				Toaster.customToast("Please enter message");
			else
				setEnquiry(Utils.getProperText(editText), Utils.getProperText(editText1));
		});
		dialog.show();
	}

	private void setEnquiry(String subject, String messagee) {
		dialog.dismiss();
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kEnquireMessage, messagee);
		map.put(kFacId, "2");
		map.put(kEventId, userEvent.getEventId());
		//map.put(kEnquireEmail,ModelManager.modelManager().getCurrentUser().getEmail());
		map.put(kEnquiryTitle, subject);
		//map.put(kEnquireName, ModelManager.modelManager().getCurrentUser().getUsername());
		//map.put(kEnguireContact, ModelManager.modelManager().getCurrentUser().getPhone());
		Log.e(TAG, "enquiry_: " + map.toString());
		ModelManager.modelManager().userSendEnquire(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();

				try {
					String msg = genericResponse.getObject();
					Toaster.customToast(msg);
					Log.e(TAG, "msg: " + msg);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}


	protected void requestPermission(String permissionType,
									 int requestCode) {

		ActivityCompat.requestPermissions(this,
			new String[]{permissionType}, requestCode
		);
	}


	@Override
	public void onRequestPermissionsResult(int requestCode,
										   String permissions[], int[] grantResults) {

		switch (requestCode) {
			case LOCATION_REQUEST_CODE: {

				if (grantResults.length == 0
					|| grantResults[0] !=
					PackageManager.PERMISSION_GRANTED) {
					Toast.makeText(this,
						"Unable to show location - permission required",
						Toast.LENGTH_LONG).show();
				} else {

					SupportMapFragment mapFragment =
						(SupportMapFragment) getSupportFragmentManager()
							.findFragmentById(R.id.map);
					mapFragment.getMapAsync(this);
				}
			}
		}
	}

	@Override
	public void onMapReady(GoogleMap googleMap) {


		mMap = googleMap;

		// Add a marker in Sydney and move the camera
		LatLng sydney = new LatLng(-34, 151);
		mMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sydney"));
		mMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));


		mMap.setMapType(GoogleMap.MAP_TYPE_TERRAIN);
		mMap.addMarker(new MarkerOptions()
//                    .position(new LatLng(28.5355161, 77.3910265))
			.position(new LatLng(lat, lang))
			.title(eventName)
			.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED)));

		mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(lat, lang), 14));


		if (mMap != null) {
			int permission = ContextCompat.checkSelfPermission(this,
				Manifest.permission.ACCESS_FINE_LOCATION);

			if (permission == PackageManager.PERMISSION_GRANTED) {
				mMap.setMyLocationEnabled(true);
			} else {
				requestPermission(
					Manifest.permission.ACCESS_FINE_LOCATION,
					LOCATION_REQUEST_CODE);
			}
		}


		/*if (ContextCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_FINE_LOCATION) ==
			PackageManager.PERMISSION_GRANTED &&
			ContextCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_COARSE_LOCATION) ==
				PackageManager.PERMISSION_GRANTED) {

			mMap = googleMap;
			mMap.setMyLocationEnabled(true);

			mMap.getUiSettings().setMyLocationButtonEnabled(true);

			// Add a marker in Sydney, Australia, and move the camera.



			Log.d("lat",lat+"/"+lang);

			mMap.setMapType(GoogleMap.MAP_TYPE_TERRAIN);
			mMap.addMarker(new MarkerOptions()
//                    .position(new LatLng(28.5355161, 77.3910265))
				.position(new LatLng(lat, lang))
				.title(eventName)
				.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED)));

			mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(lat, lang), 14));

		} else {
			Toast.makeText(this, "Please allow map permission", Toast.LENGTH_LONG).show();
		}
*/


	}

	/*private void getBookingreguest() {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kEventId, event_id);
		map.put(kSportId, sportId);
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kBookingTotal, price);
		map.put(kFacType, fac_type);
		map.put(kPaymentStatus, "Success");
		map.put(kBookingStatus, "Confirm");

		Log.e("sendcarat", map.toString());

		ModelManager.modelManager().userBooking(map, (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
			loaderView.hideLoader();
			try {
				String msg = genericResponse.getObject();
				Toaster.customToast(msg);

				Intent intent = new Intent(this, UserDashboardActivity.class);
				intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
				intent.putExtra("FRAG", "2");
				intent.putExtra("Value", "1");
				startActivity(intent);
				finish();


				//Log.e(TAG,"msg: " +msg);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});


	}*/
}
