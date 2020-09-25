package com.socialsportz.Activities.Facility.Fragments;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.GridLayout;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.stacktips.view.CalendarListener;
import com.stacktips.view.CustomCalendarView;
import com.stacktips.view.DayDecorator;
import com.stacktips.view.DayView;
import com.socialsportz.Activities.Facility.Adapters.SportBookingAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.CalendarData;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
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
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.EDIT_ACHIEVE_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kDate;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kHyhen;
import static com.socialsportz.Constants.Constants.kMonth;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kType;
import static com.socialsportz.Constants.Constants.kYear;

public class SportBookingFragment extends Fragment {
    private Context context;
    public static int facId=0;

    public static int facidd;
    private int sportId=0;
    private String facType;
    private RecyclerView rvList;
    private SportBookingAdapter adapter;
    private LinearLayout emptyLayout;
    private CustomLoaderView loaderView;

    private DropDownView dvSport;
    private TextView tvHint;
    private GridLayout legend;
    private CustomCalendarView calendarView;
    private int month=0,year=0;
    private HashMap<String, String> bookedSeatMap;

    public SportBookingFragment(){
	}

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        context = getActivity();
        View rootView = inflater.inflate(R.layout.fragment_sport_wise_layout, container, false);
        loaderView = CustomLoaderView.initialize(context);
        InitViews(rootView);
        return  rootView;
    }

    private void InitViews(View view){
        dvSport = view.findViewById(R.id.drop_sport);
        calendarView = view.findViewById(R.id.calenderView);
        tvHint = view.findViewById(R.id.tv_hint);
        legend = view.findViewById(R.id.legend_grid);

        emptyLayout = view.findViewById(R.id.empty_view);
        rvList = view.findViewById(R.id.rv_info);
        setData();
    }

    public void setData(){
        try{
            facId = facidd;

			Log.d("SportfacId",facId+"");
            InitSportData();
            initCalendar();
            tvHint.setVisibility(View.VISIBLE);
            legend.setVisibility(View.GONE);
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    private void InitSportData(){
        if(facId!=0){
            dvSport.setText("");
            CopyOnWriteArrayList<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
            List<FacSport> list = new ArrayList<>();
            for(int i=0;i<facList.size();i++){
                if(facList.get(i).getFacId()==facId){
                    list = facList.get(i).getFacSportList();
                    facType = facList.get(i).getFacType();
                    break;
                }
            }
            CopyOnWriteArrayList<Sport> sports = ModelManager.modelManager().getCurrentUser().getSports();
            ArrayList<DataModel> options = new ArrayList<>();
            for(int i=0;i<sports.size();i++){
                for(int j=0;j<list.size();j++){
                    if(sports.get(i).getSportId()==list.get(j).getSportId()){
                        options.add(new DataModel(sports.get(i).getSportId(),sports.get(i).getSportName()));
                        break;
                    }
                }
            }
            dvSport.setOptionList(options);
            // Sport Select Listener from DropDown
            dvSport.setClickListener(new DropDownView.onClickInterface() {
                @Override
                public void onClickAction() { }

                @Override
                public void onClickDone(int id, String name) {
                    sportId = id;
                    tvHint.setVisibility(View.GONE);
                    getCalendarData(month,year);
                }

                @Override
                public void onDismiss() { }
            });
        }
    }

    private void initCalendar(){
        try {
            SharedPreferences sp = PreferenceManager.getDefaultSharedPreferences(getActivity());
            SharedPreferences.Editor mEdit1 = sp.edit();
            mEdit1.putInt("booked_seats_size", 0);
            mEdit1.commit();
            adapter = new SportBookingAdapter(context, facType,new CopyOnWriteArrayList<>(), item -> { });
            rvList.setAdapter(adapter);
            checkEmptyView();
            //Handling custom calendar events
            calendarView.setCalendarListener(new CalendarListener() {
                @Override
                public void onDateSelected(Date date,String data) {
                    SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd");
                    String format = df.format(date);
                    if(sportId!=0){
                        if(!data.equals("0/0")){
                            getBatchSlotData(format);
                        }
                        else {
                            adapter = new SportBookingAdapter(context,facType ,new CopyOnWriteArrayList<>(), item -> {});
                            rvList.setAdapter(adapter);
                            checkEmptyView();
                        }
                    }
                }

                @Override
                public void onMonthChanged(Date date) {
                    SimpleDateFormat df = new SimpleDateFormat("MM-yyyy");
                    String format = df.format(date);
                    String[] array = format.split(kHyhen);
                    year = Integer.parseInt(array[1]);
                    month = Integer.parseInt(array[0]);

                    if(sportId!=0)
                        getCalendarData(month,year);
                    adapter = new SportBookingAdapter(context, facType,new CopyOnWriteArrayList<>(), item -> { });
                    rvList.setAdapter(adapter);
                    checkEmptyView();

                    /*Calendar c = Calendar.getInstance();
                    Date mDate = c.getTime();
                    int current_month = c.get(Calendar.MONTH);

                    if(current_month+1 != month)
                    {
                        adapter = new ViewSlotCustomListAdapter(ViewBookingActivity.this, new String[0], new Integer[0], new Integer[0], new String[0]);
                        viewSlotlist.setAdapter(adapter);
                    }else{
                        callListOfSports(id, session_key, mDate.toString());
                    }*/
                }
            });
            //Initialize calendar with date
            Calendar currentCalendar = Calendar.getInstance();

            //Show/hide overflow days of a month
            calendarView.setShowOverflowDate(false);

            //adding calendar day decorators
            List<DayDecorator> decorators = new ArrayList<>();
            calendarView.setDecorators(decorators);

            //Show Monday as first date of week
            //calendarView.setFirstDayOfWeek(Calendar.MONDAY);
            calendarView.refreshCalendar(currentCalendar);

        }catch (Exception e){
            e.printStackTrace();
        }
    }

    private void setCalendarData(CopyOnWriteArrayList<CalendarData> list){
        String[] date = new String[31];
        int[] total_seats = new int[31];
        int[] available_seats = new int[31];
        String[] booked_seats = new String[31];
        bookedSeatMap = new HashMap<>();

        SharedPreferences sp = PreferenceManager.getDefaultSharedPreferences(getActivity());
        SharedPreferences.Editor mEdit1 = sp.edit();
        for (int i = 0; i < list.size(); i++) {
            if(i<list.size()){
                date[i] = Utils.changeDateData(list.get(i).getDate());
            }else{
                date[i] = list.get(i).getDate();
            }
            total_seats[i] = list.get(i).getTotal_seats();
            available_seats[i] = list.get(i).getAvailable_seats();
            booked_seats[i] = available_seats[i] + "/" + total_seats[i];
            bookedSeatMap.put(date[i], booked_seats[i]);
            mEdit1.putString(date[i], booked_seats[i]);
        }

        //sKey is an array
        mEdit1.putInt("booked_seats_size", booked_seats.length);
        for (int i = 0; i < booked_seats.length; i++) {
            mEdit1.remove("booked_seats_" + i);
            mEdit1.putString("booked_seats_" + i, booked_seats[i]);
        }
        mEdit1.commit();

        //adding calendar day decorators
        List<DayDecorator> decorators = new ArrayList<>();
        decorators.add(new DisabledColorDecorator());

        calendarView.setDecorators(decorators);
        calendarView.refreshCalendar();
    }

    private class DisabledColorDecorator implements DayDecorator {
        @Override
        public void decorate(DayView dayView) {
            String dayViewDate = null;
            SimpleDateFormat sf = new SimpleDateFormat("yyyy-MM-dd");
            SimpleDateFormat sdf = new SimpleDateFormat("EEE MMM dd HH:mm:ss zzz yyyy");
            try {
                Date date = Objects.requireNonNull(sdf.parse(dayView.getDate().toString()));
                dayViewDate = sf.format(date);
            } catch (ParseException e) {
                e.printStackTrace();
            }

            try{
                if (bookedSeatMap.containsKey(dayViewDate)) {
                    String value = bookedSeatMap.get(dayViewDate);
                    assert value != null;
                    int booked = Integer.parseInt(value.substring(0, value.indexOf("/")));
                    int total = Integer.parseInt(value.substring(value.indexOf("/") + 1));
                    if (booked == 0 && total > 0) {
                        dayView.setBackgroundColor(getResources().getColor(R.color.green));
                    } else if ((booked == total) && booked > 0) {
                        dayView.setBackgroundColor(getResources().getColor(R.color.red));
                    } else if (booked < total && booked > 0) {
                        dayView.setBackgroundColor(getResources().getColor(R.color.orange));
                    }
                }
            }catch (Exception e){
                e.printStackTrace();
            }

        }
    }

    private void getBatchSlotData(String date){
        loaderView.showLoader();
        HashMap<String,Object> map = new HashMap<>();
		if(ModelManager.modelManager().getCurrentUser().getSelectedFacId()==0){
			map.put(kFacId, 0);
		}else{
			map.put(kFacId, facId);
		}
        map.put(kSportId,sportId);
        map.put(kDate,date);
        ModelManager.modelManager().userFacCalendarDetails(map,(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchSlot>> genericResponse) -> {
            loaderView.hideLoader();
            try {
                rvList.setVisibility(View.VISIBLE);
                CopyOnWriteArrayList<BatchSlot> list = genericResponse.getObject();
                adapter = new SportBookingAdapter(context,facType ,list, item -> getAllBookings(item,date));
                rvList.setAdapter(adapter);
                checkEmptyView();
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }

    private void getAllBookings(BatchSlot batchSlot, String date){
        BookingDetailDialogFragment fragment = new BookingDetailDialogFragment();
        Bundle bdl = new Bundle();
        bdl.putInt(KSCREENWIDTH, 0);
        bdl.putInt(KSCREENHEIGHT, 0);
        bdl.putSerializable(kData,batchSlot);
        bdl.putString(kDate,date);
        fragment.setArguments(bdl);
        fragment.setTargetFragment(SportBookingFragment.this, EDIT_ACHIEVE_RESULT);
        assert getFragmentManager() != null;
        fragment.show(getFragmentManager(), "Dialog Fragment");
    }

    private void getCalendarData(int m,int y){
        loaderView.showLoader();
        if(m==0 && y==0){
            Calendar calendar = Calendar.getInstance(TimeZone.getDefault());
            year = calendar.get(Calendar.YEAR);
            month = calendar.get(Calendar.MONTH)+1;
        }
        HashMap<String,Object> map = new HashMap<>();
        map.put(kFacId,facId);
        map.put(kType,facType);
        map.put(kSportId,sportId);
        map.put(kMonth,month);
        map.put(kYear,year);
        ModelManager.modelManager().userFacCalendarData(map,(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<CalendarData>> genericResponse) -> {
            loaderView.hideLoader();
            try {
                CopyOnWriteArrayList<CalendarData> list = genericResponse.getObject();
                legend.setVisibility(View.VISIBLE);
                setCalendarData(list);
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }

    private void checkEmptyView(){
        if(adapter.getItemCount()==0)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }


}
