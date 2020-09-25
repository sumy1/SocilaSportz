package com.socialsportz.Activities.Facility.Fragments;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.provider.MediaStore;
import android.provider.Settings;
import android.text.method.ScrollingMovementMethod;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.google.android.gms.common.api.Status;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.libraries.places.api.model.AddressComponent;
import com.google.android.libraries.places.api.model.Place;
import com.google.android.libraries.places.api.model.TypeFilter;
import com.google.android.libraries.places.widget.Autocomplete;
import com.google.android.libraries.places.widget.AutocompleteActivity;
import com.google.android.libraries.places.widget.model.AutocompleteActivityMode;
import com.google.android.material.snackbar.Snackbar;
import com.google.android.material.textfield.TextInputEditText;
import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Activities.Facility.Adapters.EventAmenitiesAdapter;
import com.socialsportz.Activities.Facility.Adapters.EventGalleryAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.EventAmenity;
import com.socialsportz.Models.Owner.EventGallery;
import com.socialsportz.Models.Owner.Events;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.HorizontalSpaceItemDecoration;
import com.socialsportz.Utils.TimePicker;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.Validations;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.DialogFragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_LOCATION;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSIONS_STORAGE;
import static com.socialsportz.Constants.Constants.kAction;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel1;
import static com.socialsportz.Constants.Constants.kArchiveComment;
import static com.socialsportz.Constants.Constants.kArchiveStatus;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kEventAgeCategory;
import static com.socialsportz.Constants.Constants.kEventAmenities;
import static com.socialsportz.Constants.Constants.kEventAwardPrize;
import static com.socialsportz.Constants.Constants.kEventBanner;
import static com.socialsportz.Constants.Constants.kEventCategory;
import static com.socialsportz.Constants.Constants.kEventCity;
import static com.socialsportz.Constants.Constants.kEventContact;
import static com.socialsportz.Constants.Constants.kEventDeleteGallery;
import static com.socialsportz.Constants.Constants.kEventDesc;
import static com.socialsportz.Constants.Constants.kEventEmail;
import static com.socialsportz.Constants.Constants.kEventEndDate;
import static com.socialsportz.Constants.Constants.kEventEndEnroll;
import static com.socialsportz.Constants.Constants.kEventEndTime;
import static com.socialsportz.Constants.Constants.kEventGallery;
import static com.socialsportz.Constants.Constants.kEventId;
import static com.socialsportz.Constants.Constants.kEventLat;
import static com.socialsportz.Constants.Constants.kEventLog;
import static com.socialsportz.Constants.Constants.kEventMax;
import static com.socialsportz.Constants.Constants.kEventName;
import static com.socialsportz.Constants.Constants.kEventPhone;
import static com.socialsportz.Constants.Constants.kEventPrice;
import static com.socialsportz.Constants.Constants.kEventRules;
import static com.socialsportz.Constants.Constants.kEventStartDate;
import static com.socialsportz.Constants.Constants.kEventStartEnroll;
import static com.socialsportz.Constants.Constants.kEventStartTime;
import static com.socialsportz.Constants.Constants.kEventStatus;
import static com.socialsportz.Constants.Constants.kEventVenue;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kGCountry;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kLocality;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kUserId;

public class AddEventDialogFragment extends DialogFragment implements View.OnClickListener {

	private final static String TAG = AddEventDialogFragment.class.getSimpleName();
	private Events event;
	private int facId, sportId, value;
	private TextView etStDate, etEdDate, etStTime, etEdTime, etStEnroll, etEdEnroll, tvEventCity;
	private TextInputEditText etEventName, et_event_categories, et_event_age_categories, et_event_award_price, etEventDesc, etEventPrice,
		etEventMax, etEventVenue, etEventRules, etName, etMail, etPhone,et_resion_for_archive;
	private RecyclerView rvEventGallery;
	private EventGalleryAdapter mGalleryAdapter;
	private RecyclerView rvAmenity;
	private EventAmenitiesAdapter mAmenityAdapter;

	private String bannerPath = "";
	private LinearLayout layBanner;
	private RelativeLayout rlBanner;
	private ImageView ivBanner;
	private String imageType;

	private DropDownView dvSports, drop_type_status;
	private ImageView ivType, iv_cross, iv_done,iv_resion_for_archive;
	;
	private TextView tvTypeHint;
	private View divider, dividerr;
	private Dialog dialog;
	private CustomLoaderView loaderView;
	CopyOnWriteArrayList<Amenity> amenities;

	//New code..here...
	ImageView iv_type_status;
	TextView type_hint_status;
	String eventStatus = "";
	int eventStatusId;
	LinearLayout ll_enable;
	double latitude;
	double longitude;

	LinearLayout ll_check_archive,ll_reason_archive;
	CheckBox ch_isArchive;
	String archive_status="";


	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
		Bundle mArgs = getArguments();
		assert mArgs != null;
		int pHeight = mArgs.getInt(KSCREENHEIGHT);
		int pWidth = mArgs.getInt(KSCREENWIDTH);
		event = (Events) mArgs.getSerializable(kData);
		facId = mArgs.getInt(kFacId);


		Dialog d = getDialog();
		if (d != null) {
			Objects.requireNonNull(d.getWindow()).setLayout(pWidth - 100, pHeight - 100);
			d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
			Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
			d.getWindow().setBackgroundDrawable(drawable);
			//d.getWindow().addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
			//d.getWindow().setStatusBarColor(getResources().getColor(R.color.theme_color));
		}
	}

	@Override
	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_dialog_edit_event, container, false);
		loaderView = CustomLoaderView.initialize(getContext());
		initView(view);
		setData();


		iv_cross = view.findViewById(R.id.iv_cross);
		iv_cross.setOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());
		iv_done = view.findViewById(R.id.iv_done);

		iv_done.setOnClickListener(v -> {
			if (validate()) {
				setEventData();
			}
		});

		/*Toolbar toolbar = view.findViewById(R.id.toolbar);
		toolbar.inflateMenu(R.menu.menu_day_time);

		// Set an OnMenuItemClickListener to handle menu item clicks
		toolbar.setOnMenuItemClickListener(menuItem -> {
			if (menuItem.getItemId() == R.id.action_done) {
				if (validate())
					setEventData();
				return true;
			} else {
				return false;
			}
		});

		// Create an instance of the tab layout from the view.
		toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());*/

		return view;
	}

	private void initView(View view) {


		ch_isArchive=view.findViewById(R.id.ch_isArchive);
		ll_check_archive=view.findViewById(R.id.ll_check_archive);
		ll_reason_archive=view.findViewById(R.id.ll_reason_archive);


		ch_isArchive.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
			@Override
			public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
				if(isChecked){
					archive_status="yes";
					ll_reason_archive.setVisibility(View.VISIBLE);
				}else{
					archive_status="no";
					ll_reason_archive.setVisibility(View.GONE);
				}
			}
		});

		et_resion_for_archive=view.findViewById(R.id.et_resion_for_archive);
		iv_resion_for_archive=view.findViewById(R.id.iv_resion_for_archive);
		setFocusListener(et_resion_for_archive, iv_resion_for_archive);

		ivBanner = view.findViewById(R.id.iv_banner);
		layBanner = view.findViewById(R.id.lay_banner);
		rlBanner = view.findViewById(R.id.rl_banner);
		view.findViewById(R.id.bt_banner).setOnClickListener(this);
		view.findViewById(R.id.frame_banner).setOnClickListener(this);
		rvEventGallery = view.findViewById(R.id.rv_event_gallery);
		view.findViewById(R.id.btn_add).setOnClickListener(this);

		rvAmenity = view.findViewById(R.id.rv_amenity);
		rvAmenity.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.HORIZONTAL, false));
		rvAmenity.addItemDecoration(new HorizontalSpaceItemDecoration(5));

		etStDate = view.findViewById(R.id.et_st_date);
		etEdDate = view.findViewById(R.id.et_ed_date);
		etStTime = view.findViewById(R.id.et_st_time);
		etEdTime = view.findViewById(R.id.et_ed_time);
		etStEnroll = view.findViewById(R.id.et_st_enroll);
		etEdEnroll = view.findViewById(R.id.et_ed_enroll);
		view.findViewById(R.id.st_date_view).setOnClickListener(this);
		view.findViewById(R.id.ed_date_view).setOnClickListener(this);
		view.findViewById(R.id.st_time_view).setOnClickListener(this);
		view.findViewById(R.id.ed_time_view).setOnClickListener(this);
		view.findViewById(R.id.st_enroll_view).setOnClickListener(this);
		view.findViewById(R.id.ed_enroll_view).setOnClickListener(this);
		etName = view.findViewById(R.id.et_name);
		//New code here..
		ll_enable = view.findViewById(R.id.ll_enable);
		drop_type_status = view.findViewById(R.id.drop_type_status);
		iv_type_status = view.findViewById(R.id.iv_type_status);
		type_hint_status = view.findViewById(R.id.type_hint_status);
		dividerr = view.findViewById(R.id.dividerr);


		drop_type_status.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
				setTypeFocus(iv_type_status, type_hint_status, dividerr, R.color.theme_color, 5);
			}

			@Override
			public void onClickDone(int id, String name) {
				eventStatus = name;
				eventStatusId = id;
				setTypeFocus(iv_type_status, type_hint_status, dividerr, R.color.dim_grey, 3);
			}

			@Override
			public void onDismiss() {
				setTypeFocus(iv_type_status, type_hint_status, dividerr, R.color.dim_grey, 3);
			}
		});


//....End New code..here..
		dvSports = view.findViewById(R.id.drop_type);
		ivType = view.findViewById(R.id.iv_type);
		tvTypeHint = view.findViewById(R.id.type_hint);
		divider = view.findViewById(R.id.divider);
		dvSports.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
				setTypeFocus(ivType, tvTypeHint, divider, R.color.theme_color, 5);
			}

			@Override
			public void onClickDone(int id, String name) {
				sportId = id;
				setTypeFocus(ivType, tvTypeHint, divider, R.color.dim_grey, 3);
			}

			@Override
			public void onDismiss() {
				setTypeFocus(ivType, tvTypeHint, divider, R.color.dim_grey, 3);
			}
		});


		ImageView ivName = view.findViewById(R.id.iv_name);
		setFocusListener(etName, ivName);

		etMail = view.findViewById(R.id.et_email);
		ImageView ivMail = view.findViewById(R.id.iv_email);
		setFocusListener(etMail, ivMail);

		etPhone = view.findViewById(R.id.et_contact);
		ImageView ivPhone = view.findViewById(R.id.iv_phone);
		setFocusListener(etPhone, ivPhone);

		etEventName = view.findViewById(R.id.et_event_name);
		ImageView ivEvent = view.findViewById(R.id.iv_event_name);
		setFocusListener(etEventName, ivEvent);

		etEventDesc = view.findViewById(R.id.et_event_desc);
		ImageView ivDesc = view.findViewById(R.id.iv_desc);
		setFocusListener(etEventDesc, ivDesc);
		setScrollMultilineEditText(etEventDesc);

		etEventPrice = view.findViewById(R.id.et_event_price);
		ImageView ivPrice = view.findViewById(R.id.iv_price);
		setFocusListener(etEventPrice, ivPrice);

		etEventMax = view.findViewById(R.id.et_event_max);
		ImageView ivMax = view.findViewById(R.id.iv_max);
		setFocusListener(etEventMax, ivMax);

		etEventVenue = view.findViewById(R.id.et_event_venue);
		ImageView ivVenue = view.findViewById(R.id.iv_venue);
		setFocusListener(etEventVenue, ivVenue);


		et_event_categories = view.findViewById(R.id.et_event_categories);
		ImageView iv_categories = view.findViewById(R.id.iv_categories);
		setFocusListener(et_event_categories, iv_categories);

		et_event_age_categories = view.findViewById(R.id.et_event_age_categories);
		ImageView iv_age_categories = view.findViewById(R.id.iv_age_categories);
		setFocusListener(et_event_age_categories, iv_age_categories);


		et_event_award_price = view.findViewById(R.id.et_event_award_price);
		ImageView iv_award_price = view.findViewById(R.id.iv_award_price);
		setFocusListener(et_event_award_price, iv_award_price);

		etEventRules = view.findViewById(R.id.et_event_rules);
		ImageView ivRules = view.findViewById(R.id.iv_rules);
		setFocusListener(etEventRules, ivRules);
		setScrollMultilineEditText(etEventRules);

		tvEventCity = view.findViewById(R.id.tv_city_name);
		view.findViewById(R.id.city_layout).setOnClickListener(this);
	}

	private void setData() {
		if (event == null) {
			ll_enable.setVisibility(View.GONE);
			ll_check_archive.setVisibility(View.GONE);
		} else {
			try {
				facId = event.getFacId();
				sportId = event.getSportId();
				latitude=Double.parseDouble(event.getEventlat());
				longitude=Double.parseDouble(event.getEventlong());
				etEventName.setText(event.getEventName());
				etEventDesc.setText(event.getDesc());
				etEventRules.setText(event.getRules());
				etStDate.setText(Utils.changeDateNew(event.getSdate()));
				etEdDate.setText(Utils.changeDateNew(event.getEdate()));
				etStTime.setText(event.getStime());
				etEdTime.setText(event.getEtime());
				et_event_age_categories.setText(event.getEventAgecategory());
				et_event_categories.setText(event.getEventCategory());
				et_event_award_price.setText(event.getEventawardPrize());
				etStEnroll.setText(Utils.changeDateNew(event.getEnrollStart()));
				etEdEnroll.setText(Utils.changeDateNew(event.getEnrollEnd()));
				etEventPrice.setText(event.getPrice());
				etEventMax.setText(event.getParticipants());
				etEventVenue.setText(event.getVenue());
				tvEventCity.setText(event.getCity());
				bannerPath = kImageBaseUrl + event.getFacFolder() + "/" + event.getBanner();
				setImageBackground(bannerPath, 2);
				etName.setText(event.getContactPerson());
				etMail.setText(event.getContactEmail());
				etPhone.setText(event.getContactNumber());
				drop_type_status.setText(event.getStatus());
				ll_enable.setVisibility(View.VISIBLE);

				ll_check_archive.setVisibility(View.VISIBLE);

				if(event.getArchieveStatus().equalsIgnoreCase("yes")){
					ch_isArchive.setChecked(true);

					ll_reason_archive.setVisibility(View.VISIBLE);
					et_resion_for_archive.setText(event.getArchieveComment());
				}else{
					ch_isArchive.setChecked(false);
					ll_reason_archive.setVisibility(View.GONE);
				}


			} catch (Exception e) {
				e.printStackTrace();
			}
		}
		setSportsData();
		setEventStatus();
		initGalleryView();
		getAmenitiesData();
	}

	private void setSportsData() {
		CopyOnWriteArrayList<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
		List<FacSport> list = new ArrayList<>();
		for (int i = 0; i < facList.size(); i++) {
			if (facList.get(i).getFacId() == facId) {
				list = facList.get(i).getFacSportList();
				break;
			}
		}
		CopyOnWriteArrayList<Sport> sports = ModelManager.modelManager().getCurrentUser().getSports();
		ArrayList<DataModel> options = new ArrayList<>();
		for (int i = 0; i < sports.size(); i++) {
			for (int j = 0; j < list.size(); j++) {
				if (sports.get(i).getSportId() == list.get(j).getSportId()) {
					options.add(new DataModel(sports.get(i).getSportId(), sports.get(i).getSportName()));
					if (event != null) {
						if (sports.get(i).getSportId() == sportId)
							dvSports.setText(sports.get(i).getSportName());
					}
					break;
				}
			}
		}
		dvSports.setOptionList(options);
	}


	//new code..here..for status enabled..

	private void setEventStatus() {
		ArrayList<DataModel> options = new ArrayList<>();
		options.add(new DataModel(1, "Enable"));
		options.add(new DataModel(1, "Disable"));
		drop_type_status.setOptionList(options);
	}


	private void initGalleryView() {
		CopyOnWriteArrayList<EventGallery> list = new CopyOnWriteArrayList<>();
		if (event != null) {
			if (!event.getGalleries().isEmpty())
				list = event.getGalleries();
		}
		mGalleryAdapter = new EventGalleryAdapter(list, getContext(), event);
		rvEventGallery.setAdapter(mGalleryAdapter);
	}

	private void initAmenities(CopyOnWriteArrayList<Amenity> amenities) {
		//CopyOnWriteArrayList<Amenity> amenity = ModelManager.modelManager().getCurrentUser().getAmenities();
		if (event != null) {
			CopyOnWriteArrayList<EventAmenity> myAmenityList = event.getAmenities();
			for (int i = 0; i < amenities.size(); i++) {
				for (int j = 0; j < myAmenityList.size(); j++) {
					if (myAmenityList.get(j).getAmenityId() == amenities.get(i).getAmenityId()) {
						amenities.get(i).setStatus(true);
						break;
					}
				}
			}
		}
		mAmenityAdapter = new EventAmenitiesAdapter(getContext(), amenities);
		rvAmenity.setAdapter(mAmenityAdapter);
	}


	private void getAmenitiesData() {
		//progress_bar.setVisibility(View.VISIBLE);
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kAction, "test");

		Log.e("send", parameters.toString());
		ModelManager.modelManager().userAmenities(parameters,
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Amenity>> genericResponse) -> {
				//progress_bar.setVisibility(View.GONE);
				try {
					amenities = genericResponse.getObject();
					initAmenities(amenities);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				Toaster.customToast(message);
			});
	}

	private void setFocusListener(TextInputEditText etFiled, ImageView ivImage) {
		etFiled.setOnFocusChangeListener((view, b) -> {
			if (b) {
				ivImage.setImageTintList(getResources().getColorStateList(R.color.theme_color));
			} else {
				ivImage.setImageTintList(getResources().getColorStateList(R.color.dim_grey));
			}
		});
	}

	private void setTypeFocus(ImageView ivImage, TextView text, View divider, int color, int height) {
		ivImage.setImageTintList(getResources().getColorStateList(color));
		text.setTextColor(ContextCompat.getColor(Objects.requireNonNull(getActivity()), color));
		divider.setBackgroundColor(ContextCompat.getColor(getActivity(), color));
		ViewGroup.LayoutParams params = divider.getLayoutParams();
		params.height = height;
		divider.setLayoutParams(params);
	}

	@SuppressLint("ClickableViewAccessibility")
	private void setScrollMultilineEditText(EditText editText) {
		editText.setVerticalScrollBarEnabled(true);
		editText.setOverScrollMode(View.OVER_SCROLL_ALWAYS);
		editText.setScrollBarStyle(View.SCROLLBARS_INSIDE_INSET);
		editText.setMovementMethod(ScrollingMovementMethod.getInstance());

		editText.setOnTouchListener((view, motionEvent) -> {
			view.getParent().requestDisallowInterceptTouchEvent(true);
			if ((motionEvent.getAction() & MotionEvent.ACTION_UP) != 0 && (motionEvent.getActionMasked() & MotionEvent.ACTION_UP) != 0)
				view.getParent().requestDisallowInterceptTouchEvent(false);
			return false;
		});
	}

	@Override
	public void onClick(View view) {
		switch (view.getId()) {
			case R.id.st_date_view:

				Calendar myCalendar = Calendar.getInstance();
				int sYear = Calendar.YEAR, sMonth = Calendar.MONTH, sDay = Calendar.DAY_OF_MONTH;
				Date stDate = Utils.getDate(etStDate.getText().toString());
				if (stDate != null) {
					myCalendar.setTime(stDate);
					sYear = myCalendar.get(Calendar.YEAR);
					sMonth = myCalendar.get(Calendar.MONTH);
					sDay = myCalendar.get(Calendar.DAY_OF_MONTH);
				}
				DatePickerDialog dialog = new DatePickerDialog(Objects.requireNonNull(getContext()),
					(datePicker, year, monthOfYear, dayOfMonth) -> {
						myCalendar.set(Calendar.YEAR, year);
						myCalendar.set(Calendar.MONTH, monthOfYear);
						myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
						etStDate.setText(Utils.getDate(myCalendar));
					}, sYear, sMonth, sDay);
				dialog.getDatePicker().setMinDate(Calendar.getInstance().getTimeInMillis());
				dialog.show();

				break;
			case R.id.ed_date_view:

				Calendar calendar = Calendar.getInstance();
				int eYear = Calendar.YEAR, eMonth = Calendar.MONTH, eDay = Calendar.DAY_OF_MONTH;
				Date edDate = Utils.getDate(etEdDate.getText().toString());
				if (edDate != null) {
					calendar.setTime(edDate);
					eYear = calendar.get(Calendar.YEAR);
					eMonth = calendar.get(Calendar.MONTH);
					eDay = calendar.get(Calendar.DAY_OF_MONTH);
				}
				DatePickerDialog dateDialog = new DatePickerDialog(Objects.requireNonNull(getContext()),
					(datePicker, year, monthOfYear, dayOfMonth) -> {
						calendar.set(Calendar.YEAR, year);
						calendar.set(Calendar.MONTH, monthOfYear);
						calendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
						etEdDate.setText(Utils.getDate(calendar));
					}, eYear, eMonth, eDay);
				dateDialog.getDatePicker().setMinDate(Calendar.getInstance().getTimeInMillis());
				dateDialog.show();
				break;
			case R.id.st_time_view:
				Calendar cldr = Calendar.getInstance();
				if (!Objects.requireNonNull(etStTime.getText().toString().isEmpty()))
					cldr = Utils.getTime(cldr, Objects.requireNonNull(etStTime.getText().toString()));
				int hour = cldr.get(Calendar.HOUR_OF_DAY);
				int minutes = cldr.get(Calendar.MINUTE);
				TimePicker.getInstance(getContext(), hour, minutes, time -> etStTime.setText(time)).showTimePickDialog();
				break;
			case R.id.ed_time_view:
				Calendar cld = Calendar.getInstance();
				if (!Objects.requireNonNull(etEdTime.getText().toString().isEmpty()))
					cld = Utils.getTime(cld, Objects.requireNonNull(etEdTime.getText()).toString());
				int hr = cld.get(Calendar.HOUR_OF_DAY);
				int min = cld.get(Calendar.MINUTE);
				TimePicker.getInstance(getContext(), hr, min, time -> etEdTime.setText(time)).showTimePickDialog();
				break;

			case R.id.st_enroll_view:

				Calendar stCalendar = Calendar.getInstance();
				int stYear = Calendar.YEAR, stMonth = Calendar.MONTH, stDay = Calendar.DAY_OF_MONTH;
				Date sDate = Utils.getDate(etStEnroll.getText().toString());
				if (sDate != null) {
					stCalendar.setTime(sDate);
					stYear = stCalendar.get(Calendar.YEAR);
					stMonth = stCalendar.get(Calendar.MONTH);
					stDay = stCalendar.get(Calendar.DAY_OF_MONTH);
				}
				DatePickerDialog dialog1 = new DatePickerDialog(Objects.requireNonNull(getContext()),
					(datePicker, year, monthOfYear, dayOfMonth) -> {
						stCalendar.set(Calendar.YEAR, year);
						stCalendar.set(Calendar.MONTH, monthOfYear);
						stCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
						etStEnroll.setText(Utils.getDate(stCalendar));
					}, stYear, stMonth, stDay);
				dialog1.getDatePicker().setMinDate(Calendar.getInstance().getTimeInMillis());
				dialog1.show();

				break;
			case R.id.ed_enroll_view:

				Calendar edCalendar = Calendar.getInstance();
				int edYear = Calendar.YEAR, edMonth = Calendar.MONTH, edDay = Calendar.DAY_OF_MONTH;
				Date etDate = Utils.getDate(etEdEnroll.getText().toString());
				if (etDate != null) {
					edCalendar.setTime(etDate);
					edYear = edCalendar.get(Calendar.YEAR);
					edMonth = edCalendar.get(Calendar.MONTH);
					edDay = edCalendar.get(Calendar.DAY_OF_MONTH);
				}
				DatePickerDialog dialog2 = new DatePickerDialog(Objects.requireNonNull(getContext()),
					(datePicker, year, monthOfYear, dayOfMonth) -> {
						edCalendar.set(Calendar.YEAR, year);
						edCalendar.set(Calendar.MONTH, monthOfYear);
						edCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
						etEdEnroll.setText(Utils.getDate(edCalendar));
					}, edYear, edMonth, edDay);
				dialog2.getDatePicker().setMinDate(Calendar.getInstance().getTimeInMillis());
				dialog2.show();
				break;
			case R.id.city_layout:// City Google Place API
				List<Place.Field> fields = Arrays.asList(Place.Field.ID, Place.Field.NAME,
					Place.Field.ADDRESS_COMPONENTS, Place.Field.ADDRESS, Place.Field.LAT_LNG, Place.Field.TYPES);

				Intent intent = new Autocomplete.IntentBuilder(
					AutocompleteActivityMode.FULLSCREEN, fields)
					.setCountry("IN")
					.setTypeFilter(TypeFilter.REGIONS)
					.build(Objects.requireNonNull(getActivity()));
				startActivityForResult(intent, REQUEST_LOCATION);
				break;
			case R.id.frame_banner: // ivBanner
				imageType = kEventBanner;
				checkAndroidVersion();
				break;
			case R.id.bt_banner:
				bannerPath = "";
				layBanner.setVisibility(View.VISIBLE);
				rlBanner.setVisibility(View.GONE);
				break;
			case R.id.btn_add:
				imageType = kEventGallery;
				checkAndroidVersion();
				break;
		}
	}

	private void checkAndroidVersion() {
		if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
			if (checkSelfPermission())
				galleryImage();
			else
				requestPermission();
		} else {
			galleryImage();
		}
	}

	private boolean checkSelfPermission() {
		return ActivityCompat.checkSelfPermission(Objects.requireNonNull(getContext()), Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED;
	}

	private void galleryImage() {
		Intent intent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
		startActivityForResult(intent, GALLERY_PIC_RESULT);
	}

	private void requestPermission() {
		//Method of Fragment
		requestPermissions(new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE}, REQUEST_PERMISSIONS_STORAGE);
	}

	@Override
	public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
		if (requestCode == REQUEST_PERMISSIONS_STORAGE) {
			if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
				galleryImage();
			} else if (ActivityCompat.shouldShowRequestPermissionRationale(Objects.requireNonNull(getActivity()),
				Manifest.permission.READ_EXTERNAL_STORAGE)) {
				Snackbar.make(getActivity().findViewById(android.R.id.content),
					"Please Grant Permissions to upload photo",
					Snackbar.LENGTH_SHORT).setAction("ENABLE",
					v -> requestPermission()).show();
			} else if (!ActivityCompat.shouldShowRequestPermissionRationale(Objects.requireNonNull(getActivity()),
				Manifest.permission.READ_EXTERNAL_STORAGE)) {
				showDialog();
			}
		}
	}

	@Override
	public void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode == GALLERY_PIC_RESULT) {
			if (resultCode == RESULT_OK) {
				Uri selectedImage = data.getData();
				String[] filePath = {MediaStore.Images.Media.DATA};
				assert selectedImage != null;
				Cursor c = Objects.requireNonNull(getActivity()).getContentResolver().query(selectedImage, filePath, null, null, null);
				assert c != null;
				c.moveToFirst();
				int columnIndex = c.getColumnIndex(filePath[0]);
				String picturePath = c.getString(columnIndex);
				c.close();
				Log.w(TAG, "picturePAth:" + picturePath);
				Bitmap bm = BitmapFactory.decodeFile(picturePath);
				ByteArrayOutputStream baos = new ByteArrayOutputStream();
				bm.compress(Bitmap.CompressFormat.PNG, 100, baos); //bm is the bitmap object
				byte[] b = baos.toByteArray();
				if (b.length > 1024 * 1024) {
					Toaster.customToast("File size should be less than 1MB");
				} else {
					if (imageType.equals(kEventBanner)) {
						bannerPath = picturePath;
						setImageBackground(picturePath, 1);
					} else if (imageType.equals(kEventGallery)) {

						Log.d("ImageName", picturePath);
						mGalleryAdapter.addView(picturePath);
					}
				}
			}
		} else if (requestCode == PERMISSIONS_REQUEST) {
			if (checkSelfPermission()) {
				dialog.dismiss();
			}
		} else if (requestCode == REQUEST_LOCATION) {
			if (resultCode == RESULT_OK) {
				Place place = Autocomplete.getPlaceFromIntent(data);

				String city = "", state = "", country = "";
				LatLng ln = place.getLatLng();
				assert ln != null;
				latitude = ln.latitude;
				longitude = ln.longitude;

				List<AddressComponent> list = Objects.requireNonNull(place.getAddressComponents()).asList();
				for (int i = 0; i < list.size(); i++) {
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
					}
				}
				//String tvCity = city+", "+state+", "+country;
				tvEventCity.setText(place.getAddress());
				Log.i(TAG, "Place Id: " + place.getId() + ", Place: " + place.getAddress() + ", LatLng:"
					+ latitude + ":" + longitude + ", city:" + city + ", state:" + state + ", country:" + country);
			} else if (resultCode == AutocompleteActivity.RESULT_ERROR) {
				Status status = Autocomplete.getStatusFromIntent(data);
				assert status.getStatusMessage() != null;
				Log.i(TAG, status.getStatusMessage());
			}
		}
	}

	private void setImageBackground(String picPath, int type) {//1= add 2= edit
		final Transformation transformation = new MaskTransformation(Objects.requireNonNull(getActivity()), R.drawable.canvas_booking_details_img_bg);
		layBanner.setVisibility(View.GONE);
		rlBanner.setVisibility(View.VISIBLE);
		if (type == 1) {
			Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivBanner);
		} else if (type == 2) {
			Picasso.with(getActivity()).load(picPath).fit().placeholder(R.drawable.running_event).transform(transformation).into(ivBanner);
		}
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

	private Boolean validate() {
		boolean isOk = true;
		if (Utils.getProperText(etEventName).isEmpty()) {
			etEventName.setError(getString(R.string.error_cannot_be_empty));
			etEventName.requestFocus();
			isOk = false;
		} else if (dvSports.getText().toString().isEmpty()) {
			Toaster.customToast("Please select sport");
			dvSports.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEventDesc).isEmpty()) {
			etEventDesc.setError(getString(R.string.error_cannot_be_empty));
			etEventDesc.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etStDate).isEmpty()) {
			Toaster.customToast("Please select date");
			etStDate.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEdDate).isEmpty()) {
			Toaster.customToast("Please select date");
			etEdDate.requestFocus();
			isOk = false;
		} else if (!Utils.getDateCompare(etStDate.getText().toString(), etEdDate.getText().toString())) {
			Toaster.customToast("Start Date should be lower than End Date");
			isOk = false;
		} else if (Utils.getProperText(etStTime).isEmpty()) {
			Toaster.customToast("Please select time");
			etStTime.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEdTime).isEmpty()) {
			Toaster.customToast("Please select time");
			etEdTime.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etStEnroll).isEmpty()) {
			Toaster.customToast("Please select enroll start");
			etStEnroll.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEdEnroll).isEmpty()) {
			Toaster.customToast("Please select enroll end");
			etEdEnroll.requestFocus();
			isOk = false;
		} else if (!Utils.getDateCompare(etStEnroll.getText().toString(), etEdEnroll.getText().toString())) {
			Toaster.customToast("Start Enroll should be lower than End Enroll");
			isOk = false;
		} else if (!Utils.getDateComparee(etEdEnroll.getText().toString(), etEdDate.getText().toString())) {
			Toaster.customToast("Enroll end date should be lower than Event end date");
			isOk = false;
		} else if (Utils.getProperText(etEventPrice).isEmpty()) {
			etEventPrice.setError(getString(R.string.error_cannot_be_empty));
			etEventPrice.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEventMax).isEmpty()) {
			etEventMax.setError(getString(R.string.error_cannot_be_empty));
			etEventMax.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEventVenue).isEmpty()) {
			etEventVenue.setError(getString(R.string.error_cannot_be_empty));
			etEventVenue.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(tvEventCity).isEmpty()) {
			Toaster.customToast("Please select event city");
			tvEventCity.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEventVenue).isEmpty()) {
			etEventVenue.setError(getString(R.string.error_cannot_be_empty));
			etEventVenue.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etName).isEmpty()) {
			etName.setError(getString(R.string.error_cannot_be_empty));
			etName.requestFocus();
			isOk = false;
		} else if (!Validations.isValidName(Utils.getProperText(etName))) {
			etName.setError(getString(R.string.error_invalid_credential));
			etName.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etMail).isEmpty()) {
			etMail.setError(getString(R.string.error_cannot_be_empty));
			etMail.requestFocus();
			isOk = false;
		} else if (!Validations.isValidEmail(Utils.getProperText(etMail))) {
			etMail.setError(getString(R.string.error_invalid_email));
			etMail.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etPhone).isEmpty()) {
			etPhone.setError(getString(R.string.error_cannot_be_empty));
			etPhone.requestFocus();
			isOk = false;
		} else if (!Validations.isValidPhone(Utils.getProperText(etPhone))) {
			etPhone.setError(getString(R.string.error_invalid_phone));
			etPhone.requestFocus();
			isOk = false;
		} else if (bannerPath.isEmpty()) {
			Toaster.customToast("Please insert event banner");
			isOk = false;
		} else if (mGalleryAdapter.getAddedList().size() > 8) {
			Toaster.customToast("You can add only eight gallery image. Please remove one gallery image");
			isOk = false;
		} else if (mAmenityAdapter.getCheckedList().size() == 0) {
			Toaster.customToast("Please select few amenities");
			isOk = false;
		}


		else if(ch_isArchive.isChecked()){
			if (Utils.getProperText(et_resion_for_archive).isEmpty()) {
				et_resion_for_archive.setError(getString(R.string.error_cannot_be_empty));
				et_resion_for_archive.requestFocus();
				isOk=false;
			}else{

			}

		}
		return isOk;
	}

	private HashMap<String, Object> getMap() {
		HashMap<String, Object> map = new HashMap<>();
		if (event != null)
			map.put(kEventId, event.getEventId());
		map.put(kFacId, facId);
		map.put(kSportId, sportId);
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kEventName, Utils.getProperText(etEventName));
		map.put(kEventDesc, Utils.getProperText(etEventDesc));
		map.put(kEventStartDate, Utils.changeDateFormat(Utils.getProperText(etStDate)));
		map.put(kEventEndDate, Utils.changeDateFormat(Utils.getProperText(etEdDate)));
		map.put(kEventStartTime, Utils.getProperText(etStTime));
		map.put(kEventEndTime, Utils.getProperText(etEdTime));
		map.put(kEventStartEnroll, Utils.changeDateFormat(Utils.getProperText(etStEnroll)));
		map.put(kEventEndEnroll, Utils.changeDateFormat(Utils.getProperText(etEdEnroll)));
		map.put(kEventPrice, Utils.getProperText(etEventPrice));
		map.put(kEventMax, Utils.getProperText(etEventMax));
		map.put(kEventRules, Utils.getProperText(etEventRules));
		map.put(kEventVenue, Utils.getProperText(etEventVenue));
		map.put(kEventCategory, Utils.getProperText(et_event_categories));
		map.put(kEventAgeCategory, Utils.getProperText(et_event_age_categories));
		map.put(kEventAwardPrize, Utils.getProperText(et_event_award_price));
		map.put(kEventCity, Utils.getProperText(tvEventCity));
		map.put(kEventContact, Utils.getProperText(etName));
		map.put(kEventEmail, Utils.getProperText(etMail));
		map.put(kEventPhone, Utils.getProperText(etPhone));
		map.put(kEventStatus, drop_type_status.getText().toString());
		map.put(kEventLat, latitude);
		map.put(kEventLog, longitude);
		map.put(kArchiveStatus,archive_status);

		if(ch_isArchive.isChecked()){
			map.put(kArchiveComment,Utils.getProperText(et_resion_for_archive));
		}else{
			map.put(kArchiveComment,"");
		}



		map.put(kEventAmenities, Utils.generateJsonArrayAmenities(mAmenityAdapter.getCheckedList()));
		if (bannerPath.contains("/"))
			map.put(kEventBanner, new File(bannerPath));
		if (mGalleryAdapter.getItemCount() != 0 && mGalleryAdapter.getAddedList().size() != 0)
			map.putAll(Utils.generateMapGalleries(mGalleryAdapter.getAddedList(), getActivity()));
		if (event != null && !mGalleryAdapter.getDeleteList().isEmpty())
			map.put(kEventDeleteGallery, Utils.generateJsonArrayDeleteArray(mGalleryAdapter.getDeleteList()));
		return map;
	}

	private void setEventData() {
		HashMap<String, Object> map = getMap();
		Log.e(TAG, map.toString());
		loaderView.showLoader();
		ModelManager.modelManager().userFacAddEditEvent(map, (Constants.Status iStatus, GenericResponse<Events> genericResponse) -> {
			loaderView.hideLoader();
			try {
				Events events = genericResponse.getObject();
				Log.e(TAG, "id" + events.getEventId() + " &" + events.toString());
				Toaster.customToast("UserEvent Updated");
				Intent in = Objects.requireNonNull(getActivity()).getIntent();
				in.putExtra(kData, events);
				(Objects.requireNonNull(getTargetFragment())).onActivityResult(getTargetRequestCode(), RESULT_OK, in);
				Objects.requireNonNull(getDialog()).dismiss();
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});
	}
}
