package com.socialsportz.Activities.Facility.Fragments;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.google.android.material.textfield.TextInputEditText;
import com.socialsportz.Activities.Facility.Adapters.BatchPriceAdapter;
import com.socialsportz.Activities.Facility.Adapters.WorkingDayAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotPrice;
import com.socialsportz.Models.Owner.BatchSlotType;
import com.socialsportz.Models.Owner.BatchSlotWeekOff;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.TimePicker;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.DialogFragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static android.app.Activity.RESULT_OK;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kAppPreferences;
import static com.socialsportz.Constants.Constants.kArchiveComment;
import static com.socialsportz.Constants.Constants.kArchiveStatus;
import static com.socialsportz.Constants.Constants.kBatchSlotId;
import static com.socialsportz.Constants.Constants.kBatchSlotStatus;
import static com.socialsportz.Constants.Constants.kCourtDesc;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kEndDate;
import static com.socialsportz.Constants.Constants.kEndTime;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kIsTrial;
import static com.socialsportz.Constants.Constants.kMaxParticipants;
import static com.socialsportz.Constants.Constants.kPricing;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kStartDate;
import static com.socialsportz.Constants.Constants.kStartTime;
import static com.socialsportz.Constants.Constants.kTypeId;
import static com.socialsportz.Constants.Constants.kWeekOffs;

public class ArchiveAcaBatchDialogFragment extends DialogFragment implements View.OnClickListener {

	private final static String TAG = ArchiveAcaBatchDialogFragment.class.getSimpleName();
	private int facId;
	private int sportId;
	private int packageId;
	private int categoryId;
	private BatchSlot batchSlot;
	private TextView etStDate, etEdDate, etStTime, etEdTime,desc_count;
	private TextInputEditText etBatchPrice, etBatchMax,etCourtDesc,et_resion_for_archive;
	private DropDownView dvSport, dvCategory,dvType, drop_type_status;
	private CheckBox isTrialAvail;
	private CopyOnWriteArrayList<BatchPackage> packageData = new CopyOnWriteArrayList<>();
	private CopyOnWriteArrayList<BatchPackage> packagesUpdates = new CopyOnWriteArrayList<>();

	private RecyclerView rvWeekOff, rvBatch;
	private WorkingDayAdapter adapter;
	private BatchPriceAdapter batchPriceAdapter;
	private CustomLoaderView loaderView;

	//New code..here...
	ImageView iv_type_status, iv_cross, iv_done,iv_resion_for_archive;
	TextView type_hint_status;
	String eventStatus;
	int eventStatusId;
	LinearLayout ll_enable;
	private View dividerr;
	LinearLayout st_date_view, ed_date_view, st_time_view, ed_time_view;
	boolean workingdays;
	SharedPreferences sharedpreferences ;
	String sTime,ETime;
    CopyOnWriteArrayList<Facility>facilities=new CopyOnWriteArrayList<>();
	CopyOnWriteArrayList<FacDayTime>facDayTimes=new CopyOnWriteArrayList<>();
	Calendar calendar;

	//..new code here..on..27-07-20

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
		facId = mArgs.getInt(kFacId);
		batchSlot = (BatchSlot) mArgs.getSerializable(kData);
		Dialog d = getDialog();
		if (d != null) {
			Objects.requireNonNull(d.getWindow()).setLayout(pWidth - 100, pHeight - 100);
			d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
			Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
			d.getWindow().setBackgroundDrawable(drawable);
		}
	}

	@Override
	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_dialog_add_batch_archive, container, false);
		loaderView = CustomLoaderView.initialize(getActivity());
		sharedpreferences = getActivity().getSharedPreferences(kAppPreferences, Context.MODE_PRIVATE);





		if(sharedpreferences.getString("TIMEOPENN","").equalsIgnoreCase("") &&sharedpreferences.getString("CLOSETIMEE","").equalsIgnoreCase("") ){
			facilities=ModelManager.modelManager().getCurrentUser().getFacilities();

			Log.d("Size",facilities.size()+"");

			for(int i=0;i<facilities.size();i++){

				if(facilities.get(i).getFacId()==facId){
					facDayTimes=facilities.get(i).getFacTimingList();
				}
			}

			for(int i=0;i<facDayTimes.size();i++){

				Log.d("Day1",facDayTimes.get(i).getDayName()+"/"+getCurrentDay());
				if(facDayTimes.get(i).getDayName().equalsIgnoreCase(getCurrentDay())){
					sTime=facDayTimes.get(i).getDayOpenTime();
					ETime=facDayTimes.get(i).getDayCloseTime();


					try {
						ETime=increaseTime(sTime);
					} catch (ParseException e) {
						e.printStackTrace();
					}

					sTime=sTime.replace("am","AM");
					ETime=ETime.replace("am","AM");
					sTime=sTime.replace("pm","PM");
					ETime=ETime.replace("pm","PM");
				}

			}
			Log.d("Size",facilities.size()+"/"+facDayTimes.size()+"/"+sTime+"/"+ETime+"/"+getCurrentDay());
		}else{
			sTime=sharedpreferences.getString("TIMEOPENN","");
			ETime=sharedpreferences.getString("CLOSETIMEE","");
		}


		initEditTextView(view);
		setData();

		iv_cross = view.findViewById(R.id.iv_cross);
		iv_cross.setOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());
		iv_done = view.findViewById(R.id.iv_done);
		iv_done.setVisibility(View.GONE);




		/*iv_done.setOnClickListener(v -> {
			if (validate()) {
				setBatchData();
			}
		});*/

        /*Toolbar toolbar = view.findViewById(R.id.toolbar);
        toolbar.inflateMenu(R.menu.menu_day_time);

        // Set an OnMenuItemClickListener to handle menu item clicks
        toolbar.setOnMenuItemClickListener(menuItem -> {
            if(menuItem.getItemId()== R.id.action_done){
                if(validate())
                    setBatchData();
                return true;
            }else {
                return false;
            }
        });

        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());*/

		return view;
	}

	private String getCurrentDay(){

		calendar = Calendar.getInstance();
//Day of Name in full form like,"Saturday", or if you need the first three characters you have to put "EEE" in the date format and your result will be "Sat".
		SimpleDateFormat sdf_ = new SimpleDateFormat("EEE");
		Date date = new Date();
		String dayName = sdf_.format(date);
		Log.d("Day" ,dayName );

		return dayName;
	}


	private String increaseTime(String currentTimee) throws ParseException {
		SimpleDateFormat sdf = new SimpleDateFormat("h:mm a");
		Date date = sdf.parse(currentTimee);
		Calendar calendar = Calendar.getInstance();
		calendar.setTime(date);
		calendar.add(Calendar.HOUR, 1);
		String time="";
		int hourOfDay=calendar.get(Calendar.HOUR);
		int minute=calendar.get(Calendar.MINUTE);

		String AM_PM ;
		if(hourOfDay < 12) {
			//AM_PM = "am";
		}
		else {
			//AM_PM = "pm";
			hourOfDay = hourOfDay - 12;
		}

		if(minute==0 && hourOfDay == 0){
			time = "12:00";
			Log.d("Time1",time);
		}else if(minute<10 && hourOfDay==0){
			time = "12" + ":0";
			Log.d("Time1",time);
		}else if(minute>10 && hourOfDay==0){
			time = "12" +":"+ minute;
			Log.d("Time1",time);
		}
		else if(minute==0){
			time = hourOfDay + ":00";
			Log.d("Time2",time);
		}else if(minute<10){
			time = hourOfDay + ":0"+minute;
			Log.d("Time3",time);
		}else if(hourOfDay==12 ){
			time = "12" + ":" +minute;
			Log.d("Time4",time);
		}else if(hourOfDay<10){
			time = "0"+hourOfDay + ":"+minute;
			Log.d("Time4",time);
		}

		else if(minute<10 && hourOfDay<12){
			time = "0"+hourOfDay + ":0"+minute;

			Log.d("Time5",time);
		}
		else{

			time = hourOfDay + ":" + minute;
			Log.d("Time",time);
		}

		if(currentTimee.contains("am")||currentTimee.contains("AM")){
			time=time+" "+"AM";
		}else{
			time=time+" "+"PM";
		}

		if(currentTimee.equalsIgnoreCase("11:00 am") ){
			time="";
			time="12:00"+" "+"PM";
		}else if(currentTimee.equalsIgnoreCase("11:00 pm")){
			time="";
			time="12:00"+" "+"AM";

		}

		Log.d("timenew",time+"/"+currentTimee+"/"+hourOfDay);
		return time;
	}

	private void initEditTextView(View view) {
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
		et_resion_for_archive.addTextChangedListener(mTextEditorWatcher);
		setFocusListener(et_resion_for_archive, iv_resion_for_archive);


		rvWeekOff = view.findViewById(R.id.rv_working_days);
		rvWeekOff.setHasFixedSize(true);
		rvBatch = view.findViewById(R.id.rv_batch_type);
		rvBatch.setLayoutManager(new LinearLayoutManager(getContext(), RecyclerView.VERTICAL, false));
		rvBatch.setHasFixedSize(false);
		view.findViewById(R.id.btn_add).setOnClickListener(this);
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

		dvCategory = view.findViewById(R.id.drop_categories);
		ImageView ivCat = view.findViewById(R.id.iv_category);
		TextView tvCat = view.findViewById(R.id.type_categories);
		View dividerCat = view.findViewById(R.id.divider_categories);
		dvCategory.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
				setTypeFocus(ivCat, tvCat, dividerCat, R.color.theme_color, 5);
			}

			@Override
			public void onClickDone(int id, String name) {
				categoryId = id;
				setTypeFocus(ivCat, tvCat, dividerCat, R.color.dim_grey, 3);
			}

			@Override
			public void onDismiss() {
				setTypeFocus(ivCat, tvCat, dividerCat, R.color.dim_grey, 3);
			}
		});

		isTrialAvail = view.findViewById(R.id.ch_trial);
		etStDate = view.findViewById(R.id.et_st_date);
		etEdDate = view.findViewById(R.id.et_ed_date);
		etStTime = view.findViewById(R.id.et_st_time);
		etStTime.setText(sTime);
		etEdTime = view.findViewById(R.id.et_ed_time);
		etEdTime.setText(ETime);

		st_date_view = view.findViewById(R.id.st_date_view);
		st_date_view.setOnClickListener(this);
		ed_date_view = view.findViewById(R.id.ed_date_view);
		ed_date_view.setOnClickListener(this);
		st_time_view = view.findViewById(R.id.st_time_view);
		st_time_view.setOnClickListener(this);
		ed_time_view = view.findViewById(R.id.ed_time_view);
		ed_time_view.setOnClickListener(this);

        /*view.findViewById(R.id.st_date_view).setOnClickListener(this);
        view.findViewById(R.id.ed_date_view).setOnClickListener(this);
        view.findViewById(R.id.st_time_view).setOnClickListener(this);
        view.findViewById(R.id.ed_time_view).setOnClickListener(this);*/

		etBatchMax = view.findViewById(R.id.et_batch_max);
		ImageView ivMax = view.findViewById(R.id.iv_max);
		setFocusListener(etBatchMax, ivMax);

		etBatchPrice = view.findViewById(R.id.et_batch_price);

		dvSport = view.findViewById(R.id.drop_sport);
		ImageView ivSport = view.findViewById(R.id.iv_sport);
		TextView tvSport = view.findViewById(R.id.type_sport);
		View dividerSport = view.findViewById(R.id.divider_sport);
		dvSport.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
				setTypeFocus(ivSport, tvSport, dividerSport, R.color.theme_color, 5);
			}

			@Override
			public void onClickDone(int id, String name) {
				sportId = id;
				setTypeFocus(ivSport, tvSport, dividerSport, R.color.dim_grey, 3);
			}

			@Override
			public void onDismiss() {
				setTypeFocus(ivSport, tvSport, dividerSport, R.color.dim_grey, 3);
			}
		});

		dvType = view.findViewById(R.id.drop_type);
		ImageView ivType = view.findViewById(R.id.iv_type);
		TextView tvType = view.findViewById(R.id.type_batch);
		View dividerType = view.findViewById(R.id.divider_type);
		dvType.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
				setTypeFocus(ivType, tvType, dividerType, R.color.theme_color, 5);
			}

			@Override
			public void onClickDone(int id, String name) {
				packageId = id;
				setTypeFocus(ivType, tvType, dividerType, R.color.dim_grey, 3);
			}

			@Override
			public void onDismiss() {
				setTypeFocus(ivType, tvType, dividerType, R.color.dim_grey, 3);
			}
		});

		desc_count=view.findViewById(R.id.desc_count);
		etCourtDesc = view.findViewById(R.id.et_court_desc);
		etCourtDesc.addTextChangedListener(mTextEditorWatcher);
		ImageView ivDesc = view.findViewById(R.id.iv_desc);
		setFocusListener(etCourtDesc, ivDesc);

	}




	private void setData() {

		if (batchSlot == null) {
			ll_enable.setVisibility(View.GONE);
			ll_check_archive.setVisibility(View.GONE);
		} else {
				try {
					facId = batchSlot.getFacId();
					sportId = batchSlot.getSportId();
					etStDate.setText(Utils.changeDateNew(batchSlot.getStartDate()));
					etStDate.setClickable(true);
					etStDate.setFocusable(false);
					st_date_view.setClickable(false);
					etEdDate.setText(Utils.changeDateNew(batchSlot.getEndDate()));
					etEdDate.setClickable(true);
					etEdDate.setFocusable(false);
					ed_date_view.setClickable(false);
					etStTime.setText(batchSlot.getStartTime());
					etStTime.setClickable(true);
					etStTime.setFocusable(false);
					st_time_view.setClickable(false);
					etEdTime.setText(batchSlot.getEndTime());
					etEdTime.setClickable(true);
					etEdTime.setFocusable(false);
					ed_time_view.setClickable(false);
					etBatchMax.setText(batchSlot.getMaxBook());
					etBatchMax.setClickable(true);
					etBatchMax.setFocusable(false);
					dvSport.setClickable(false);
					etCourtDesc.setText(batchSlot.getCourtDesc());
					drop_type_status.setText(batchSlot.getFac_batch_slot_status());
					if (batchSlot.getIsTrial().equals("yes")) {
						isTrialAvail.setChecked(true);
					} else
						isTrialAvail.setChecked(false);
					ll_enable.setVisibility(View.VISIBLE);
					ll_check_archive.setVisibility(View.VISIBLE);

					if(batchSlot.getArchieveStatus().equalsIgnoreCase("yes")){
                      ch_isArchive.setChecked(true);

						ll_reason_archive.setVisibility(View.VISIBLE);
						et_resion_for_archive.setText(batchSlot.getArchieveComment());
					}else{
						ch_isArchive.setChecked(false);
						ll_reason_archive.setVisibility(View.GONE);
					}

				} catch (Exception e) {
					e.printStackTrace();
				}
				workingdays=true;
		}

		setCategoryData();
		getPackagesData();
		setEventStatus();
		setSportsData();
		initWeekOffData(workingdays);
	}

	private void setCategoryData() {
		loaderView.showLoader();
		ModelManager.modelManager().userFacAcaTypes((Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchSlotType>> genericResponse) -> {
			loaderView.hideLoader();
			try {
				CopyOnWriteArrayList<BatchSlotType> list = genericResponse.getObject();
                /*list.add(new BatchSlotType(1,"Normal"));
                list.add(new BatchSlotType(2,"Discounted"));
                list.add(new BatchSlotType(3,"Premium"));*/
				ArrayList<DataModel> options = new ArrayList<>();
				for (int i = 0; i < list.size(); i++) {
					options.add(new DataModel(list.get(i).getTypeId(), list.get(i).getTypeName()));
					if (batchSlot != null) {
						if (batchSlot.getTypeId() == list.get(i).getTypeId())
							dvCategory.setText(list.get(i).getTypeName());
						categoryId=batchSlot.getTypeId();
					}
				}
				dvCategory.setOptionList(options);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});
	}

	private final TextWatcher mTextEditorWatcher=new TextWatcher() {

		@Override
		public void onTextChanged(CharSequence s, int start, int before, int count) {
			// TODO Auto-generated method stub



		}

		@Override
		public void beforeTextChanged(CharSequence s, int start, int count,
									  int after) {
			// TODO Auto-generated method stub

		}

		@Override
		public void afterTextChanged(Editable s) {
			// TODO Auto-generated method stub

			Log.d("length",s.length()+"");
			if(s.length()>300){
				desc_count.setEnabled(false);
				desc_count.setClickable(false);
				desc_count.setFocusable(false);
				desc_count.setFocusableInTouchMode(false);
				desc_count.setText(String.valueOf(0)+" "+"Character(s)Remaining");
			}else{
				desc_count.setText(String.valueOf(300-s.length())+" "+"Character(s)Remaining");
			}
		}
	};


	//new code..here..for status enabled..

	private void setEventStatus() {
		ArrayList<DataModel> options = new ArrayList<>();
		options.add(new DataModel(0, "Active"));
		options.add(new DataModel(1, "InActive"));
		drop_type_status.setOptionList(options);
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
					if (batchSlot != null) {
						if (sports.get(i).getSportId() == sportId)
							dvSport.setText(sports.get(i).getSportName());
					}
					break;
				}
			}
		}
		dvSport.setOptionList(options);
	}

	private void setCategoryData(CopyOnWriteArrayList<BatchPackage> list) {
		ArrayList<DataModel> options = new ArrayList<>();
		for (int i = 0; i < list.size(); i++) {
			options.add(new DataModel(list.get(i).getPackageId(), list.get(i).getPackageName()));
		}
		dvType.setOptionList(options);
	}


	private void initWeekOffData(boolean workingdays) {
		CopyOnWriteArrayList<BatchSlotWeekOff> list;
		if (batchSlot != null)
			list = batchSlot.getWeekOffs();
		else
			list = Utils.getWeekOffs();
		adapter = new WorkingDayAdapter(batchSlot, list,workingdays, getContext());
		rvWeekOff.setAdapter(adapter);
	}

	private void initBatchRecycler(CopyOnWriteArrayList<BatchPackage> packages) {
		CopyOnWriteArrayList<BatchSlotPrice> list = new CopyOnWriteArrayList<>();
		if (batchSlot != null)
			list = batchSlot.getPrices();
		batchPriceAdapter = new BatchPriceAdapter(list, packages, getContext(), packageId -> {
			for (BatchPackage pck : packageData) {
				if (packageId == pck.getPackageId()) {
					packagesUpdates.add(pck);
					break;
				}
			}
			setCategoryData(packagesUpdates);
		});
		rvBatch.setAdapter(batchPriceAdapter);
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
				if (!Objects.requireNonNull(etStTime.getText().toString().isEmpty())) {
					Utils.getTime(cldr, Objects.requireNonNull(etStTime.getText().toString()));
				}
				int hour = cldr.get(Calendar.HOUR_OF_DAY);
				int minutes = cldr.get(Calendar.MINUTE);
				TimePicker.getInstance(getContext(), hour, minutes, time -> etStTime.setText(time)).showTimePickDialog();
				break;
			case R.id.ed_time_view:
				Calendar cld = Calendar.getInstance();
				if (!Objects.requireNonNull(etEdTime.getText().toString().isEmpty())) {
					Utils.getTime(cld, Objects.requireNonNull(etEdTime.getText()).toString());
				}
				int hr = cld.get(Calendar.HOUR_OF_DAY);
				int min = cld.get(Calendar.MINUTE);
				TimePicker.getInstance(getContext(), hr, min, time -> etEdTime.setText(time)).showTimePickDialog();
				break;

			case R.id.btn_add:
				if (validateTypePrice()) {
					batchPriceAdapter.addItem(new BatchSlotPrice(packageId, dvType.getText().toString(),
						Objects.requireNonNull(etBatchPrice.getText()).toString()));
					dvType.setText("");
					etBatchPrice.setText("");
					for (BatchPackage pck : packageData) {
						if (packageId == pck.getPackageId()) {
							packagesUpdates.remove(pck);
							break;
						}
					}
					setCategoryData(packagesUpdates);
				}

		}
	}

	private Boolean validateTypePrice() {
		boolean isOk = true;
		if (dvType.getText().toString().isEmpty()) {
			Toaster.customToast("Please select type");
			dvType.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etBatchPrice).isEmpty()) {
			etBatchPrice.setError(getString(R.string.error_cannot_be_empty));
			etBatchPrice.requestFocus();
			isOk = false;
		}
		return isOk;
	}

	private Boolean validate() {
		boolean isOk = true;
		if (dvSport.getText().toString().isEmpty()) {
			Toaster.customToast("Please select sport");
			dvSport.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etStDate).isEmpty()) {
			Toaster.customToast("Please select date");
			etStDate.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEdDate).isEmpty()) {
			Toaster.customToast("Please select date");
			etEdDate.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etStTime).isEmpty()) {
			Toaster.customToast("Please select time");
			etStTime.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etEdTime).isEmpty()) {
			Toaster.customToast("Please select time");
			etEdTime.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etBatchMax).isEmpty()) {
			etBatchMax.setError(getString(R.string.error_cannot_be_empty));
			etBatchMax.requestFocus();
			isOk = false;
		} else if (batchPriceAdapter.getItemCount() == 0) {
			Toaster.customToast("Please insert batch price");
			isOk = false;
		}

		else if (batchPriceAdapter.getEditStatus()) {
			Toaster.customToast("Please check batch price");
			isOk = false;
		}
		else if (adapter.getEditStatuss()) {
			Toaster.customToast("Please select at least one working day");
			isOk = false;
		}
		else if (!etStDate.getText().toString().isEmpty() && !etEdDate.getText().toString().isEmpty()) {
			if (!Utils.getDateCompare(etStDate.getText().toString(), etEdDate.getText().toString())) {
				Toaster.customToast("Start Date should be lower than End Date");
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

		}

		return isOk;
	}

	private HashMap<String, Object> getMap() {
		HashMap<String, Object> map = new HashMap<>();
		if (batchSlot != null)
			map.put(kBatchSlotId, batchSlot.getBatchSlotId());
		map.put(kFacId, facId);
		map.put(kSportId, sportId);
		map.put(kTypeId, categoryId);
		map.put(kStartDate, Utils.changeDateFormat(Utils.getProperText(etStDate)));
		map.put(kEndDate, Utils.changeDateFormat(Utils.getProperText(etEdDate)));
		map.put(kStartTime, Utils.getProperText(etStTime));
		map.put(kEndTime, Utils.getProperText(etEdTime));
		map.put(kMaxParticipants, Utils.getProperText(etBatchMax));
		map.put(kCourtDesc, Utils.getProperText(etCourtDesc));
		map.put(kBatchSlotStatus, drop_type_status.getText().toString());
		if (isTrialAvail.isChecked())
			map.put(kIsTrial, "yes");
		else
			map.put(kIsTrial, "no");
		map.put(kWeekOffs, adapter.getAray());
		map.put(kPricing, Utils.generateJsonArrayPrices(batchPriceAdapter.getCheckedList()));
		map.put(kArchiveStatus,archive_status);
		map.put(kArchiveComment,Utils.getProperText(et_resion_for_archive));
		return map;
	}

	private void setBatchData() {
		HashMap<String, Object> map = getMap();
		Log.e(TAG+"Addbatch", map.toString());
		loaderView.showLoader();
		ModelManager.modelManager().userAcaAddEditBatch(map, (Constants.Status iStatus, GenericResponse<BatchSlot> genericResponse) -> {
			loaderView.hideLoader();
			try {
				BatchSlot batchSlot = genericResponse.getObject();
				Log.e(TAG, "id" + batchSlot.getBatchSlotId() + " &" + batchSlot.toString());
				Toaster.customToast("Batch Updated");
				Intent in = Objects.requireNonNull(getActivity()).getIntent();
				in.putExtra(kData, batchSlot);
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


	private void getPackagesData() {
		packageData = new CopyOnWriteArrayList<>();
		loaderView.showLoader();
		ModelManager.modelManager().userFacAcaPackages((Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchPackage>> genericResponse) -> {
			loaderView.hideLoader();
			try {
				packageData = genericResponse.getObject();
                /*packageData.add(new BatchPackage(1,"Monthly","1 Month"));
                packageData.add(new BatchPackage(2,"Quarterly","3 Month"));*/
				packagesUpdates.addAll(packageData);
				setBatchRecycler();
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});
	}

	private void setBatchRecycler() {
		if (batchSlot != null)
			initBatchRecycler(packageData);
		else
			initBatchRecycler(new CopyOnWriteArrayList<>());
		filterData();
	}

	private void filterData() {
		if (batchSlot != null) {
			for (BatchPackage pck : packageData) {
				CopyOnWriteArrayList<BatchSlotPrice> prices = batchSlot.getPrices();
				boolean found = false;
				for (int j = 0; j < prices.size(); j++) {
					if (pck.getPackageId() == prices.get(j).getPackageId()) {
						found = true;
						break;
					}
				}
				if (found)
					packagesUpdates.remove(pck);
			}
			setCategoryData(packagesUpdates);
		} else {
			setCategoryData(packageData);
		}
	}

}
