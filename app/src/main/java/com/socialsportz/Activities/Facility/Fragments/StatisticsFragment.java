package com.socialsportz.Activities.Facility.Fragments;

import android.graphics.Color;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.github.mikephil.charting.charts.BarChart;
import com.github.mikephil.charting.charts.PieChart;
import com.github.mikephil.charting.components.Legend;
import com.github.mikephil.charting.data.BarData;
import com.github.mikephil.charting.data.BarDataSet;
import com.github.mikephil.charting.data.BarEntry;
import com.github.mikephil.charting.data.Entry;
import com.github.mikephil.charting.data.PieData;
import com.github.mikephil.charting.data.PieDataSet;

import com.github.mikephil.charting.formatter.PercentFormatter;
import com.github.mikephil.charting.utils.ColorTemplate;

import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.Owner.StatisticsData;
import com.socialsportz.Models.Owner.StatisticsDataEvent;
import com.socialsportz.Models.Owner.TotalYearScedule;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.Toaster;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kYear;

public class StatisticsFragment extends Fragment implements View.OnClickListener {

	private int facId = 0;
	private int sportId = 0;
	private int offline=0;
	private int online=0;
	private String year="";
	private DropDownView dvSport, drop_year;
	private BarChart barChart;
	private PieChart chart;
	ArrayList<String> year_list;
	ArrayList<String> bar_list;
	ArrayList<Integer> pieList;
	TextView tv_sb_select, tv_event_select,eventstatisyics;
	ImageButton ib_search;
	LinearLayout ll_pie;
	private CustomLoaderView loaderView;

	String kjan="";
	String kfeb="";
	String kmar="";
	String kapr="";
	String kmay="";
	String kjune="";
	String kjuly="";
	String kaug="";
	String ksept="";
	String koct="";
	String knov="";
	String kdec="";

	int statusClick=0;
	ArrayList<BarEntry> entries;
	BarDataSet dataset;
	ArrayList<String> years;

	public StatisticsFragment() {
	}

	@Override
	public void onAttachFragment(@NonNull Fragment fragment) {
		super.onAttachFragment(fragment);
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
	}

	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View rootView = inflater.inflate(R.layout.fragment_statistics, container, false);
		loaderView=CustomLoaderView.initialize(getActivity());
		initView(rootView);
		setData();

		return rootView;
	}


	private static int getPreviousYear() {
		Calendar prevYear = Calendar.getInstance();
		prevYear.add(Calendar.YEAR, -1);
		return prevYear.get(Calendar.YEAR);
	}

	private static int getCurrentYear() {

		int year = Calendar.getInstance().get(Calendar.YEAR);
		return year;
	}


	private boolean validate(){
		boolean isOk=true;
		/*if(dvSport.getText().toString().isEmpty()){
			isOk = false;
			Toaster.customToast("Please select sports");
		} else */

			if(drop_year.getText().toString().isEmpty()){
			Toaster.customToast("Please select year");
			isOk = false;
		}
		return isOk;
	}

	private void initView(View rootView) {
		tv_sb_select = rootView.findViewById(R.id.tv_sb_select);
		tv_sb_select.setOnClickListener(this);
		tv_event_select = rootView.findViewById(R.id.tv_event_select);
		tv_event_select.setOnClickListener(this);
		ib_search=rootView.findViewById(R.id.ib_search);
		ib_search.setOnClickListener(this);
		dvSport = rootView.findViewById(R.id.drop_sport);
		drop_year = rootView.findViewById(R.id.drop_year);

		year_list = new ArrayList<>();
		year_list.add(String.valueOf(getCurrentYear()));
		year_list.add(String.valueOf(getPreviousYear()));
		ArrayList<DataModel> options = new ArrayList<>();
		for (int j = 0; j < year_list.size(); j++) {

			options.add(new DataModel(1, year_list.get(j)));

		}
		drop_year.setOptionList(options);
		drop_year.setText(options.get(0).getName());
		eventstatisyics=rootView.findViewById(R.id.eventstatisyics);
		ll_pie=rootView.findViewById(R.id.ll_pie);




		drop_year.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {

			}

			@Override
			public void onClickDone(int id, String name) {
				year=name;
			}

			@Override
			public void onDismiss() {

			}
		});


		barChart = rootView.findViewById(R.id.book_chart);
		chart = rootView.findViewById(R.id.chart1);
		dvSport.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
			}

			@Override
			public void onClickDone(int id, String name) {
				sportId = id;
				//setBarData(12, 100);
				//setPieData(3, 100);
			}

			@Override
			public void onDismiss() {
			}
		});
	}

	public void setData() {
		CurrentUser currentUser = ModelManager.modelManager().getCurrentUser();
		try {
			facId = currentUser.getSelectedFacId();
		} catch (Exception e) {
			e.printStackTrace();
		}
		InitBarChartSport();
		getBookingListing();

	}

	private void InitBarChartSport() {
		if (facId != 0) {
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
			options.add(new DataModel(0,getString(R.string.select_sportt)));
			for (int i = 0; i < sports.size(); i++) {
				for (int j = 0; j < list.size(); j++) {
					if (sports.get(i).getSportId() == list.get(j).getSportId()) {
						options.add(new DataModel(sports.get(i).getSportId(), sports.get(i).getSportName()));
						break;
					}
				}
			}



			dvSport.setOptionList(options);
			dvSport.setText(options.get(0).getName());
		}
	}


	@Override
	public void onClick(View view) {
		switch (view.getId()){
			case R.id.tv_event_select:


				tv_sb_select.setTextColor(getResources().getColor(R.color.black));
				tv_sb_select.setBackground(getResources().getDrawable(R.drawable.canvas_event_bottom_curve_bg_uncecked));


				tv_event_select.setTextColor(getResources().getColor(R.color.white));
				tv_event_select.setBackground(getResources().getDrawable(R.drawable.canvas_event_bottom_curve_bg_checcked));
				statusClick=1;

				chart.setVisibility(View.GONE);
				eventstatisyics.setVisibility(View.GONE);
				ll_pie.setVisibility(View.GONE);
				getBookingListingEvent();

			break;
			case R.id.tv_sb_select:
				tv_event_select.setTextColor(getResources().getColor(R.color.black));
				tv_event_select.setBackground(getResources().getDrawable(R.drawable.canvas_event_bottom_curve_bg_uncecked));

				tv_sb_select.setTextColor(getResources().getColor(R.color.white));
				tv_sb_select.setBackground(getResources().getDrawable(R.drawable.canvas_event_bottom_curve_bg_checcked));


				statusClick=2;
				chart.setVisibility(View.VISIBLE);
				eventstatisyics.setVisibility(View.VISIBLE);
				ll_pie.setVisibility(View.VISIBLE);
				getBookingListing();
				break;

			case R.id.ib_search:


				if(statusClick==1){
					getBookingListingEvent();
				}else if(statusClick==2){
					getBookingListing();
				}else{
					getBookingListing();
				}

				/*if(validate()){




				}*/
				break;
		}
	}


	private void getBookingListing(){
		loaderView.showLoader();
		HashMap<String ,Object> map = new HashMap<>();
		map.put(kSportId,sportId);
		if(ModelManager.modelManager().getCurrentUser().getSelectedFacId()==0){
			map.put(kFacId, 0);
		}else{
			map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
		}
		map.put(kYear,drop_year.getText());

		Log.e("Send",map.toString());
		ModelManager.modelManager().getStatictics(map,(Constants.Status iStatus, GenericResponse<StatisticsData> genericResponse) -> {

			try {
				loaderView.hideLoader();
				StatisticsData statisticsData= genericResponse.getObject();
                JSONObject totalYearScedules =statisticsData.getTotalYearScedules();

                TotalYearScedule totalYearScedule=new TotalYearScedule(totalYearScedules);
				offline=statisticsData.getBookingOrderCountOffline();
				online=statisticsData.getBookingOrderCountOnline();



				kjan=totalYearScedule.getkJan();

				kfeb=totalYearScedule.getkFeb();

				kmar=totalYearScedule.getkMar();

				kapr=totalYearScedule.getkApr();

				kmay=totalYearScedule.getkMay();

				kjune=totalYearScedule.getkJune();

				kjuly=totalYearScedule.getkJuly();

				kaug=totalYearScedule.getkAug();

				ksept=totalYearScedule.getkSept();

				koct=totalYearScedule.getkOct();

				knov=totalYearScedule.getkNov();

				kdec=totalYearScedule.getkDec();




				 entries = new ArrayList<>();
				years = new ArrayList<String>();
				entries.add(new BarEntry(Float.parseFloat(kjan),0));
				entries.add(new BarEntry(Float.parseFloat(kfeb),1));
				entries.add(new BarEntry( Float.parseFloat(kmar),2));
				entries.add(new BarEntry( Float.parseFloat(kapr),3));
				entries.add(new BarEntry( Float.parseFloat(kmay),4));
				entries.add(new BarEntry( Float.parseFloat(kjune),5));
				entries.add(new BarEntry(Float.parseFloat(kjuly),6));
				entries.add(new BarEntry(Float.parseFloat(kaug),7));
				entries.add(new BarEntry( Float.parseFloat(ksept),8));
				entries.add(new BarEntry(Float.parseFloat(koct),9));
				entries.add(new BarEntry(Float.parseFloat(knov),10));
				entries.add(new BarEntry( Float.parseFloat(kdec),11));
				 dataset = new BarDataSet(entries, "");



				years.add("Jan");
				years.add("Feb");
				years.add("Mar");
				years.add("Apr");
				years.add("May");
				years.add("June");
				years.add("July");
				years.add("Aug");
				years.add("Sept");
				years.add("Oct");
				years.add("Nov");
				years.add("Dec");



				Legend l = barChart.getLegend();
				l.setForm(Legend.LegendForm.SQUARE);
				l.setEnabled(false);
				BarData data = new BarData(years, dataset);
				barChart.setData(data); // set the data and list of lables into chart
				barChart.setDescription(null);
				barChart.notifyDataSetChanged();
				dataset.setColors(ColorTemplate.COLORFUL_COLORS);
				barChart.animateXY(5000, 5000);
				barChart.invalidate();

				InitPieChart(offline,online);

			} catch (Exception e){
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);

		});
	}


	private void getBookingListingEvent(){
		loaderView.showLoader();
		HashMap<String ,Object> map = new HashMap<>();
		map.put(kSportId,sportId);
		if(ModelManager.modelManager().getCurrentUser().getSelectedFacId()==0){
			map.put(kFacId, 1);
		}else{
			map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
		}
		map.put(kYear,drop_year.getText());

		Log.e("Send",map.toString());
		ModelManager.modelManager().getStaticticss(map,(Constants.Status iStatus, GenericResponse<StatisticsDataEvent> genericResponse) -> {

			try {
				loaderView.hideLoader();
				StatisticsDataEvent statisticsData= genericResponse.getObject();
				JSONObject totalYearScedules =statisticsData.getTotalYearScedules();

				TotalYearScedule totalYearScedule=new TotalYearScedule(totalYearScedules);

				kjan=totalYearScedule.getkJan();

				kfeb=totalYearScedule.getkFeb();

				kmar=totalYearScedule.getkMar();

				kapr=totalYearScedule.getkApr();

				kmay=totalYearScedule.getkMay();

				kjune=totalYearScedule.getkJune();

				kjuly=totalYearScedule.getkJuly();

				kaug=totalYearScedule.getkAug();

				ksept=totalYearScedule.getkSept();

				koct=totalYearScedule.getkOct();

				knov=totalYearScedule.getkNov();

				kdec=totalYearScedule.getkDec();




				entries = new ArrayList<>();
				years = new ArrayList<String>();
				entries.add(new BarEntry(Float.parseFloat(kjan),0));
				entries.add(new BarEntry(Float.parseFloat(kfeb),1));
				entries.add(new BarEntry( Float.parseFloat(kmar),2));
				entries.add(new BarEntry( Float.parseFloat(kapr),3));
				entries.add(new BarEntry( Float.parseFloat(kmay),4));
				entries.add(new BarEntry( Float.parseFloat(kjune),5));
				entries.add(new BarEntry(Float.parseFloat(kjuly),6));
				entries.add(new BarEntry(Float.parseFloat(kaug),7));
				entries.add(new BarEntry( Float.parseFloat(ksept),8));
				entries.add(new BarEntry(Float.parseFloat(koct),9));
				entries.add(new BarEntry(Float.parseFloat(knov),10));
				entries.add(new BarEntry( Float.parseFloat(kdec),11));
				dataset = new BarDataSet(entries, "");



				years.add("Jan");
				years.add("Feb");
				years.add("Mar");
				years.add("Apr");
				years.add("May");
				years.add("June");
				years.add("July");
				years.add("Aug");
				years.add("Sept");
				years.add("Oct");
				years.add("Nov");
				years.add("Dec");



				Legend l = barChart.getLegend();
				l.setForm(Legend.LegendForm.SQUARE);
				l.setEnabled(false);
				BarData data = new BarData(years, dataset);
				barChart.setData(data); // set the data and list of lables into chart
				barChart.setDescription(null);
				barChart.notifyDataSetChanged();
				dataset.setColors(ColorTemplate.COLORFUL_COLORS);
				barChart.animateXY(5000, 5000);
				barChart.invalidate();

			} catch (Exception e){
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);

		});
	}

	private void InitPieChart(int offline,int online) {
		chart.setUsePercentValues(true);
		setPieData(offline,online);
		chart.animateXY(5000, 5000);
	}

	private void setPieData(int offline,int online) {

		ArrayList<Entry> yvalues = new ArrayList<Entry>();
		yvalues.add(new Entry(offline, 0));
		yvalues.add(new Entry(online, 1));


		PieDataSet dataSet = new PieDataSet(yvalues, "");

		ArrayList<String> xVals = new ArrayList<String>();

		xVals.add("Offline Booking");
		xVals.add("Online Booking");


		PieData data = new PieData(xVals, dataSet);
		data.setValueFormatter(new PercentFormatter());
		chart.setData(data);
		if(offline==0 & online==0){
			chart.setCenterText("Bookings 0.0 %");
		}else{
			chart.setCenterText("Bookings");
		}
		chart.setDrawHoleEnabled(true);
		chart.setTransparentCircleRadius(45f);

		chart.setHoleRadius(45f);
		dataSet.setColors(ColorTemplate.VORDIPLOM_COLORS);
		data.setValueTextSize(11f);
		data.setValueTextColor(Color.DKGRAY);
		chart.setDescription(null);
		Legend leg = chart.getLegend();
		leg.setEnabled(false);
		chart.invalidate();
	}




}
