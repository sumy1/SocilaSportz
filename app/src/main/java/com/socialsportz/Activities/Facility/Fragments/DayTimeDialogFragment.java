package com.socialsportz.Activities.Facility.Fragments;

import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.util.SparseBooleanArray;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DividerItemRecyclerDecoration;
import com.socialsportz.Utils.TimePicker;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.DialogFragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kAppPreferences;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacTiming;
import static com.socialsportz.Constants.Constants.kFlag;

public class DayTimeDialogFragment extends DialogFragment {

	private static final String TAG = DayTimeDialogFragment.class.getSimpleName();
	private CopyOnWriteArrayList<FacDayTime> dayTimeList = new CopyOnWriteArrayList<>();
	private CopyOnWriteArrayList<FacDayTime> dayTimes = new CopyOnWriteArrayList<>();
	private int flag;
	private int facId;
	private CheckBox selectAll;
	private CustomLoaderView loaderView;
	private DayTimeAdapter dayTimeAdapter;
	boolean checked;
	String type = "";
	Calendar calendar;
	SharedPreferences sharedpreferences ;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
		Bundle mArgs = getArguments();
		assert mArgs != null;
		int pHeight = mArgs.getInt(KSCREENHEIGHT);
		int pWidth  = mArgs.getInt(KSCREENWIDTH);
		flag = mArgs.getInt(kFlag);
		facId = mArgs.getInt(kFacId);
		dayTimes =  (CopyOnWriteArrayList<FacDayTime>) mArgs.getSerializable(kFacTiming);
		dayTimeList = (CopyOnWriteArrayList<FacDayTime>) mArgs.getSerializable(kData);



		Dialog d = getDialog();
		if (d!=null){
			Objects.requireNonNull(d.getWindow()).setLayout(pWidth-100, pHeight-100);
			d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
			Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
			d.getWindow().setBackgroundDrawable(drawable);
			d.setCancelable(false);
			//d.getWindow().addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
			//d.getWindow().setStatusBarColor(getResources().getColor(R.color.theme_color));
		}
	}

	@Override
	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_dialog_date_select_option, container, false);
		loaderView = CustomLoaderView.initialize(getActivity());
		handleBatchSlot(facId);
		sharedpreferences = getActivity().getSharedPreferences(kAppPreferences, Context.MODE_PRIVATE);
		getCurrentDay();
		RecyclerView recyclerView = view.findViewById(R.id.rvDates);

		recyclerView.setHasFixedSize(true);
		recyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
		recyclerView.addItemDecoration(new DividerItemRecyclerDecoration(getActivity(), R.drawable.canvas_recycler_divider));

		if(dayTimes.isEmpty())
			dayTimeAdapter = new DayTimeAdapter(dayTimeList);
		else {
			for(int i=0;i<dayTimeList.size();i++){
				FacDayTime facDayTime = dayTimeList.get(i);
				for(int j=0;j<dayTimes.size();j++){
					FacDayTime time = dayTimes.get(j);
					if(facDayTime.getDayName().equals(time.getDayName())){
						facDayTime.setDayId(time.getDayId());
						facDayTime.setDayStatus(time.getDayStatus());
						facDayTime.setDayOpenTime(time.getDayOpenTime());
						facDayTime.setDayCloseTime(time.getDayCloseTime());
					}
				}

			}
			dayTimeAdapter = new DayTimeAdapter(dayTimeList);
		}




		recyclerView.setAdapter(dayTimeAdapter);

		Toolbar toolbar = view.findViewById(R.id.toolbar);
		toolbar.inflateMenu(R.menu.menu_day_time);

		// Set an OnMenuItemClickListener to handle menu item clicks
		toolbar.setOnMenuItemClickListener(menuItem -> {
			if(menuItem.getItemId()== R.id.action_done){
				if(flag==1){
					if(dayTimeAdapter.getStatus())
						setEditFacilityTiming();
					else
						Toaster.customToast("Please select day");
				}else{
					Intent in = Objects.requireNonNull(getActivity()).getIntent();
					in.putExtra(kData, dayTimeAdapter.getList());
					Objects.requireNonNull(getTargetFragment()).onActivityResult(getTargetRequestCode(),Activity.RESULT_OK,in);
					Objects.requireNonNull(getDialog()).dismiss();
				}
				return true;
			}else {
				return false;
			}
		});

		// Create an instance of the tab layout from the view.
		toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());

		selectAll = view.findViewById(R.id.ch_select);
		selectAll.setOnCheckedChangeListener((buttonView, isChecked) -> {
			if(isChecked){
				if(dayTimeAdapter.getStatus())
					dayTimeAdapter.setFirstCheckedSelectAll();
				else
					dayTimeAdapter.setDefaultCheckedSelectAll();
			}else{

				if(dayTimeAdapter.getStatuss()){
					//dayTimeAdapter.setDefaultCheckedSelectAll();
				}else{
					dayTimeAdapter.setDefaultCheckedDeselectAll();
				}

			}
		});

		if(dayTimeAdapter.getStatuss()){
			selectAll.setChecked(false);
		}else{
			selectAll.setChecked(true);
		}


		return view;
	}

	class DayTimeAdapter extends RecyclerView.Adapter<DayTimeAdapter.DayTimeHolder> {

		CopyOnWriteArrayList<FacDayTime> myItemList;
		DayTimeAdapter(CopyOnWriteArrayList<FacDayTime> itemsList) {
			this.myItemList = itemsList;
		}

		@NonNull
		@Override
		public DayTimeHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(getContext()).inflate(R.layout.row_date_select_view, parent, false);
			return new DayTimeHolder(view);
		}

		@Override
		public void onBindViewHolder(@NonNull DayTimeHolder holder, int position) {
			final FacDayTime item = myItemList.get(position);

			Log.d("List",myItemList.get(position).getDayStatus()+"");
			holder.bindContent(item);
			holder.tvName.setText(item.getDayName());
			if(item.getDayStatus()==1){
				holder.tvName.setChecked(true);
				String desc = item.getDayOpenTime()+" - "+item.getDayCloseTime();
				holder.tvDesc.setText(desc);
				holder.rlTime.setVisibility(View.VISIBLE);
			} else {
				holder.tvName.setChecked(false);
				holder.rlTime.setVisibility(View.GONE);
				holder.tvDesc.setText(R.string.closed);
			}
			holder.btOpenTime.setText(item.getDayOpenTime());
			holder.btCloseTime.setText(item.getDayCloseTime());



			if(item.getDayName().equalsIgnoreCase(getCurrentDay())){
				String time=item.getDayOpenTime();
				String newTime= null;
				try {

					newTime = increaseTime(item.getDayOpenTime());

					//holder.btCloseTime.setText(newTime);
				} catch (ParseException e) {
					e.printStackTrace();
				}
				Log.d("Time",item.getDayOpenTime()+"/"+newTime+"/"+item.getDayName()+"/"+getCurrentDay());


				if(item.getDayOpenTime().contains("am")){

					time=time.replace("am","AM");
				}else{
					time=time.replace("pm","PM");
				}

				Log.d("Type",type);
				if(type.equalsIgnoreCase("Academy")){
					SharedPreferences.Editor editor = sharedpreferences.edit();
					editor.putString("TIMEOPENN", time);
					editor.putString("CLOSETIMEE", newTime);
					editor.commit();
				}else{
					SharedPreferences.Editor editor = sharedpreferences.edit();
					editor.putString("TIMEOPEN", time);
					editor.putString("CLOSETIME", newTime);
					editor.commit();
				}


			}else{
				String time=item.getDayOpenTime();
				String newTime= null;
				try {
					newTime = increaseTime(time);

					//holder.btCloseTime.setText(newTime);
				} catch (ParseException e) {
					e.printStackTrace();
				}

				if(item.getDayOpenTime().contains("am")||item.getDayOpenTime().contains("PM")){

					time=time.replace("am","AM");
				}else{
					time=time.replace("pm","PM");
				}

				if(type.equalsIgnoreCase("Academy")){
					SharedPreferences.Editor editor = sharedpreferences.edit();
					editor.putString("TIMEOPENN",time);
					editor.putString("CLOSETIMEE", newTime);
					editor.commit();
				}else{
					SharedPreferences.Editor editor = sharedpreferences.edit();
					editor.putString("TIMEOPEN", time);
					editor.putString("CLOSETIME", newTime);
					editor.commit();
				}
			}


			holder.tvName.setOnCheckedChangeListener((buttonView, isChecked) -> {
				if(isChecked){
					String desc = item.getDayOpenTime()+" - "+item.getDayCloseTime();
					holder.tvDesc.setText(desc);
					item.setDayStatus(1);
					holder.rlTime.setVisibility(View.VISIBLE);
					checkItemStatus();
				} else{
					holder.tvDesc.setText(R.string.closed);
					item.setDayStatus(0);
					holder.rlTime.setVisibility(View.GONE);
					selectAll.setChecked(false);

				}
			});


			holder.btOpenTime.setOnClickListener(v -> {
				Calendar cldr = Calendar.getInstance();
				cldr = Utils.getTime(cldr,holder.btOpenTime.getText().toString());
				int hour = cldr.get(Calendar.HOUR_OF_DAY);
				int minutes = cldr.get(Calendar.MINUTE);
				TimePicker.getInstance(getContext(),hour,minutes, time -> {


					if(item.getDayName().equalsIgnoreCase(getCurrentDay())){
						holder.btOpenTime.setText(time);
						item.setDayOpenTime(time);
						String tm = holder.btOpenTime.getText()+" - "+holder.btCloseTime.getText();
						holder.tvDesc.setText(tm);

						String newTime= null;
						try {
							newTime = increaseTime(time);

							//holder.btCloseTime.setText(newTime);
						} catch (ParseException e) {
							e.printStackTrace();
						}
						Log.d("Time",time+"/"+newTime+"/"+item.getDayName()+"/"+getCurrentDay());


						if(time.contains("am")||time.contains("AM")){

							time=time.replace("am","AM");
						}else{
							time=time.replace("pm","PM");
						}

						Log.d("Type",type);
						if(type.equalsIgnoreCase("Academy")){
							SharedPreferences.Editor editor = sharedpreferences.edit();
							editor.putString("TIMEOPENN", time);
							editor.putString("CLOSETIMEE", newTime);
							editor.commit();
						}else{
							SharedPreferences.Editor editor = sharedpreferences.edit();
							editor.putString("TIMEOPEN", time);
							editor.putString("CLOSETIME", newTime);
							editor.commit();
						}


					}else{

						String newTime= null;
						try {
							newTime = increaseTime(time);

							//holder.btCloseTime.setText(newTime);
						} catch (ParseException e) {
							e.printStackTrace();
						}
						holder.btOpenTime.setText(time);
						item.setDayOpenTime(time);
						String tm = holder.btOpenTime.getText()+" - "+holder.btCloseTime.getText();
						holder.tvDesc.setText(tm);

						if(type.equalsIgnoreCase("Academy")){
							SharedPreferences.Editor editor = sharedpreferences.edit();
							editor.putString("TIMEOPENN", time);
							editor.putString("CLOSETIMEE", newTime);
							editor.commit();
						}else{
							SharedPreferences.Editor editor = sharedpreferences.edit();
							editor.putString("TIMEOPEN", time);
							editor.putString("CLOSETIME", newTime);
							editor.commit();
						}
					}


					//selectAll.setChecked(false);
				}).showTimePickDialog();



			});

			holder.btCloseTime.setOnClickListener(v -> {
				Calendar cldr = Calendar.getInstance();
				cldr = Utils.getTime(cldr,holder.btCloseTime.getText().toString());
				int hour = cldr.get(Calendar.HOUR_OF_DAY);
				int minutes = cldr.get(Calendar.MINUTE);
				TimePicker.getInstance(getContext(),hour,minutes, time -> {
					holder.btCloseTime.setText(time);
					item.setDayCloseTime(time);
					String tm = holder.btOpenTime.getText()+" - "+holder.btCloseTime.getText();
					holder.tvDesc.setText(tm);
					//selectAll.setChecked(false);
				}).showTimePickDialog();
			});
		}

		private void checkItemStatus(){
			boolean itemstaus=false;
			for(int i=0;i<myItemList.size();i++){
				if(myItemList.get(i).getDayStatus()==0){
					itemstaus=false;
					break;
				}else{
					itemstaus=true;
				}
			}
			if(itemstaus){
				selectAll.setChecked((true));
			}
		}




		@Override
		public int getItemCount() {
			return myItemList.size();
		}

		public CopyOnWriteArrayList<FacDayTime> getList(){
			return myItemList;
		}

		public boolean getStatus(){
			boolean status = false;
			for(int i=0;i<myItemList.size();i++){
				if(myItemList.get(i).getDayStatus()==1){
					status = true;
					break;
				}
			}
			return status;
		}


		public boolean getStatuss(){
			boolean status = false;
			for(int i=0;i<myItemList.size();i++){
				if(myItemList.get(i).getDayStatus()==0){
					status = true;
					break;
				}
			}
			return status;
		}

		private void setFirstCheckedSelectAll(){
			for(int i=0;i<myItemList.size();i++){
				if(myItemList.get(i).getDayStatus()==1){
					FacDayTime timeData = myItemList.get(i);
					for(int j=0;j<myItemList.size();j++){
						myItemList.get(j).setDayStatus(timeData.getDayStatus());
						myItemList.get(j).setDayOpenTime(timeData.getDayOpenTime());
						myItemList.get(j).setDayCloseTime(timeData.getDayCloseTime());
					}
					break;
				}
			}
			notifyDataSetChanged();
		}

		private void setDefaultCheckedSelectAll(){
			for(int j=0;j<myItemList.size();j++){
				myItemList.get(j).setDayStatus(1);
				myItemList.get(j).setDayOpenTime(getString(R.string.day_time_open));
				myItemList.get(j).setDayCloseTime(getString(R.string.day_time_close));
			}
			notifyDataSetChanged();
		}

		private void setDefaultCheckedDeselectAll(){
			for(int j=0;j<myItemList.size();j++){
				myItemList.get(j).setDayStatus(0);
				myItemList.get(j).setDayOpenTime(getString(R.string.day_time_open));
				myItemList.get(j).setDayCloseTime(getString(R.string.day_time_close));
			}
			notifyDataSetChanged();
		}


		class DayTimeHolder extends RecyclerView.ViewHolder {

			FacDayTime item;
			private CheckBox tvName;
			private TextView tvDesc;
			private RelativeLayout rlTime;
			private Button btOpenTime;
			private Button btCloseTime;

			DayTimeHolder(View itemView) {
				super(itemView);
				tvName = itemView.findViewById(R.id.ch_day);
				tvDesc = itemView.findViewById(R.id.tv_time);
				rlTime = itemView.findViewById(R.id.time_layout);
				btOpenTime = itemView.findViewById(R.id.btn_open_time);
				btCloseTime = itemView.findViewById(R.id.btn_close_time);
			}

			void bindContent(FacDayTime item) {
				this.item = item;
			}

            /*@OnClick(R.id.row_item)
            void itemSelected() {
                Intent in = getActivity().getIntent().putExtra("data",item.getName());
                in.putExtra("id",item.getId());
                getTargetFragment().onActivityResult(getTargetRequestCode(), Activity.RESULT_OK,in);
                dismiss();
            }*/
		}
	}

	private void setEditFacilityTiming(){
		loaderView.showLoader();
		ModelManager.modelManager().userFacTimingUpdate(facId, Utils.generateJsonArrayTimings(dayTimeList).toString(),
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacDayTime>> genericResponse) -> {
				loaderView.hideLoader();
				try {
					CopyOnWriteArrayList<FacDayTime> timings = genericResponse.getObject();
					Log.e(TAG,timings.toString());
					Intent in = Objects.requireNonNull(getActivity()).getIntent();
					in.putExtra(kData,timings);
					Objects.requireNonNull(getTargetFragment()).onActivityResult(getTargetRequestCode(),Activity.RESULT_OK,in);
					Objects.requireNonNull(getDialog()).dismiss();
				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
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


	private String handleBatchSlot(int facId){

		CopyOnWriteArrayList<Facility> facilities = ModelManager.modelManager().getCurrentUser().getFacilities();
		for(int i=0;i<facilities.size();i++){
			if(facId==facilities.get(i).getFacId()){
				if(facilities.get(i).getFacType().equals(Constants.FacType.academy.toString()))
					type = "Academy";
				else if(facilities.get(i).getFacType().equals(Constants.FacType.facility.toString()))
					type = "Facility";
				break;
			}
		}
		return type;
	}


}
