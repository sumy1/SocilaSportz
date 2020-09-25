package com.socialsportz.Activities.Facility.Fragments;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.text.Html;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.GridLayout;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.stacktips.view.CalendarListener;
import com.stacktips.view.CustomCalendarView;
import com.stacktips.view.DayDecorator;
import com.stacktips.view.DayView;
import com.socialsportz.Activities.Facility.Adapters.EnquiryAdapter;
import com.socialsportz.Activities.Facility.Adapters.EventDashAdapter;
import com.socialsportz.Activities.Facility.Adapters.TotalBookingViewAdapter;
import com.socialsportz.Activities.Facility.EventDetailActivity;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.CalendarData;
import com.socialsportz.Models.Owner.DashboardData;
import com.socialsportz.Models.Owner.Enquires;
import com.socialsportz.Models.Owner.Events;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.Owner.TotalBookingView;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.HorizontalSpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.VerticalSpaceItemDecoration;

import java.text.DecimalFormat;
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
import java.util.concurrent.atomic.AtomicReference;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.StaggeredGridLayoutManager;

import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.EDIT_EVENT_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kHyhen;
import static com.socialsportz.Constants.Constants.kMonth;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kType;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kYear;

public class FacDashboardFragment extends Fragment {

    private Context context;
    private EventClickListener listener;
    private TextView tvRating,tvReview;
    private TextView tvRating1,tvRating2,tvRating3,tvRating4,tvRating5;
    private RelativeLayout datePicker;
    private TextView datePicked;
    private Button btnSearch;
    private DropDownView dvSportBook,dvCalSport;
    private TextView tvFacAcaName;
    private RecyclerView rvTotal,rvEnquiry,rvEvent;
    //private RatingReviews ratingReviews;
    private CustomLoaderView loaderView;
    private DashboardData dashboardData;
    private LinearLayout eventEmpty,enquiryEmpty;

    private CustomCalendarView calendarView;
    private TextView tvHint;
    private GridLayout legend;
    private int calSportId=0;
    private String facType;
    private int month=0,year=0;
    private HashMap<String, String> bookedSeatMap;

    private RelativeLayout progresslayout;
    private TextView tvProgress;
	SharedPreferences sharedPref;
    private ProgressBar profileBar;

	TotalBookingView totalBookingView;


    public FacDashboardFragment(){ }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_fac_dashboard, container, false);
        context = getActivity();
        loaderView = CustomLoaderView.initialize(getActivity());

        initViews(rootView);
        getProfileStatus();
        getNotificationCount();
        getList();
        /*if(ModelManager.modelManager().getCurrentUser().getDashData()!=null){
            dashboardData = ModelManager.modelManager().getCurrentUser().getDashData();
            initData();
        }else{
            if(!ModelManager.modelManager().getCurrentUser().getFacilities().isEmpty())
                getDashBoardData();
        }*/
        //if(!ModelManager.modelManager().getCurrentUser().getFacilities().isEmpty())
            getDashBoardData();

        return  rootView;
    }

	@Override
	public void onResume() {
		super.onResume();
	}






	private void initViews(View rootView){
        // View Initialization
        progresslayout = rootView.findViewById(R.id.status_layout);
        tvProgress = rootView.findViewById(R.id.tv_progress_status);
        profileBar = rootView.findViewById(R.id.profileBar);

        datePicker = rootView.findViewById(R.id.date_picker);
        datePicked = rootView.findViewById(R.id.tv_date);
        btnSearch = rootView.findViewById(R.id.btn_search);
        dvSportBook = rootView.findViewById(R.id.drop_sport);
        dvCalSport = rootView.findViewById(R.id.drop_dash_sport);

        calendarView = rootView.findViewById(R.id.calenderView);
        tvHint = rootView.findViewById(R.id.tv_hint);
        legend = rootView.findViewById(R.id.legend_grid);
        tvRating1 = rootView.findViewById(R.id.tv_rating_1);
        tvRating2 = rootView.findViewById(R.id.tv_rating_2);
        tvRating3 = rootView.findViewById(R.id.tv_rating_3);
        tvRating4 = rootView.findViewById(R.id.tv_rating_4);
        tvRating5 = rootView.findViewById(R.id.tv_rating_5);
        //ratingReviews = rootView.findViewById(R.id.rating_reviews);
        tvRating = rootView.findViewById(R.id.tv_average_rating);
        tvReview = rootView.findViewById(R.id.tv_total_reviews);

        tvFacAcaName  = rootView.findViewById(R.id.tv_fac_aca_name);
        rvTotal=rootView.findViewById(R.id.trial_rv);
        rvTotal.addItemDecoration(new HorizontalSpaceItemDecoration(10));

        rvEnquiry = rootView.findViewById(R.id.rv_enquiries);
        rvEnquiry.setLayoutManager(new LinearLayoutManager(context,RecyclerView.VERTICAL,false));
        rvEnquiry.addItemDecoration(new VerticalSpaceItemDecoration(20));
        eventEmpty = rootView.findViewById(R.id.empty_view_event);

        rvEvent = rootView.findViewById(R.id.rv_events);
        enquiryEmpty = rootView.findViewById(R.id.empty_view_enquiry);
        rvEvent.setLayoutManager(new LinearLayoutManager(context,LinearLayoutManager.HORIZONTAL,false));
        boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
        if (tabletSize)
            rvEvent.addItemDecoration(new HorizontalSpaceItemDecoration(20));
        else
            rvEvent.addItemDecoration(new HorizontalSpaceItemDecoration(30));

        // OnClick Listeners for various elements
        rootView.findViewById(R.id.btn_profile).setOnClickListener(view -> listener.profileClick());
        rootView.findViewById(R.id.tv_enquiry_see).setOnClickListener(view -> listener.enquiryClick());
        rootView.findViewById(R.id.tv_event_see).setOnClickListener(view -> listener.eventClick());
        rootView.findViewById(R.id.rating_view).setOnClickListener(view -> listener.ratingClick());
    }

    public void initData(){
        //total booking view

        totalBookingView();
        // Book Slot View
        InitSlotBatchBook();
        // Enquiry Recycler View
        InitEnquiry();
        // UserEvent Recycler View
        InitEvent();
        // Rating Review View
        setRatingReviews();
        // Calendar View();
        initCalendar();
    }

    private void totalBookingView(){


        if(dashboardData!=null) {
            rvTotal.setLayoutManager(new StaggeredGridLayoutManager(1,RecyclerView.HORIZONTAL ));
            TotalBookingViewAdapter totalBookingViewAdapter = new TotalBookingViewAdapter(context, dashboardData.getNumberList(), totalBookingView -> listener.bookingClick(totalBookingView),dashboardData.getFacType());
            rvTotal.setAdapter(totalBookingViewAdapter);
        }
    }

    public static void getType(){

	}

    private void InitSlotBatchBook(){
        //for date picker
        AtomicReference<String> dt= new AtomicReference<>("");

        datePicker.setOnClickListener(v -> {
            Calendar calendar = Calendar.getInstance();
            int eYear = Calendar.YEAR,eMonth = Calendar.MONTH,eDay = Calendar.DAY_OF_MONTH;
            Date edDate = Utils.getDate(datePicked.getText().toString());
            if(edDate!=null){
                calendar.setTime(edDate);
                eYear = calendar.get(Calendar.YEAR);
                eMonth = calendar.get(Calendar.MONTH);
                eDay = calendar.get(Calendar.DAY_OF_MONTH);
            }
            DatePickerDialog dateDialog = new DatePickerDialog(Objects.requireNonNull(getContext()),
                    (datePicker,year,monthOfYear, dayOfMonth) -> {
                        calendar.set(Calendar.YEAR, year);
                        calendar.set(Calendar.MONTH, monthOfYear);
                        calendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
                        dt.set(Utils.getDate(calendar));
                        datePicked.setText(Utils.getDate(calendar));
                    }, eYear, eMonth, eDay);
            dateDialog.getDatePicker().setMinDate(Calendar.getInstance().getTimeInMillis());
            dateDialog.show();
            /*DatePicker.getInstance(getActivity(), 2, date -> {
                                dt.set(date);
                                datePicked.setText(date);
                            }).showDatePickDialog();*/
        });
        int facId = ModelManager.modelManager().getCurrentUser().getSelectedFacId();
        if(facId!=0){
            int[] sportId = {0};
            String[] sportName = {""};
            // Sport Spinner View
            CopyOnWriteArrayList<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
            List<FacSport> list = new ArrayList<>();
            for(int i=0;i<facList.size();i++){
                if(facList.get(i).getFacId()==facId){
                    list = facList.get(i).getFacSportList();
                    tvFacAcaName.setText(facList.get(i).getFacName());
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
            dvSportBook.setOptionList(options);
            dvSportBook.setClickListener(new DropDownView.onClickInterface() {
                @Override
                public void onClickAction() { }

                @Override
                public void onClickDone(int id, String name) {
                    sportId[0] = id;
                    sportName[0] = name;
                }

                @Override
                public void onDismiss() { }
            });
            dvCalSport.setOptionList(options);
            dvCalSport.setClickListener(new DropDownView.onClickInterface() {
                @Override
                public void onClickAction() { }

                @Override
                public void onClickDone(int id, String name) {
                    calSportId = id;
                    tvHint.setVisibility(View.GONE);
                    getCalendarData(month,year);
                }

                @Override
                public void onDismiss() { }
            });
            btnSearch.setOnClickListener(view1 -> {
                if(sportId[0]==0){
                    Toaster.customToast("Select Any Sport");
                    return;
                }
                if(datePicked.getText().toString().isEmpty()){
                    Toaster.customToast("Select Any Date");
                    return;
                }
                datePicked.setText("");
                dvSportBook.setText("");
                listener.slotBatchAvail(facId,sportId[0],sportName[0], dt.get(),facType);
            });
        }
    }

    private void InitEvent(){
        if(dashboardData!=null) {
            EventDashAdapter eventAdapter=new EventDashAdapter(context, dashboardData.getUpcomingEvents(), events -> {
                Intent intent = new Intent(context, EventDetailActivity.class);
                intent.putExtra(kData,events);
                startActivityForResult(intent,1);
            });
            rvEvent.setAdapter(eventAdapter);
            checkEmptyEvents(eventAdapter);
        }
    }

    private void InitEnquiry(){
        if(dashboardData!=null) {
            EnquiryAdapter enquiryAdapter = new EnquiryAdapter(context, dashboardData.getLatestEnquiries());
            rvEnquiry.setAdapter(enquiryAdapter);
            enquiryAdapter.setClickListener(this::viewFullEnquiry);
            checkEmptyEnquiry(enquiryAdapter);
        }
    }

    private void setRatingReviews(){
        if (dashboardData != null) {
            float total = dashboardData.getTotal_1_rating()+dashboardData.getTotal_2_rating()+dashboardData.getTotal_3_rating()+dashboardData.getTotal_4_rating()+dashboardData.getTotal_5_rating();

            tvRating1.setText(String.valueOf(dashboardData.getTotal_1_rating()));
            tvRating2.setText(String.valueOf(dashboardData.getTotal_2_rating()));
            tvRating3.setText(String.valueOf(dashboardData.getTotal_3_rating()));
            tvRating4.setText(String.valueOf(dashboardData.getTotal_4_rating()));
            tvRating5.setText(String.valueOf(dashboardData.getTotal_5_rating()));
            /*int[] raters = new int[]{
                    dashboardData.getTotal_1_rating(),
                    dashboardData.getTotal_2_rating(),
                    dashboardData.getTotal_3_rating(),
                    dashboardData.getTotal_4_rating(),
                    dashboardData.getTotal_5_rating()
            };
            ratingReviews.createRatingBars((int)total, BarLabels.STYPE1, context.getResources().getColor(R.color.theme_color), raters);*/

            float star1per = ((float)dashboardData.getTotal_1_rating()*1);
            float star2per = ((float)dashboardData.getTotal_2_rating()*2);
            float star3per = ((float)dashboardData.getTotal_3_rating()*3);
            float star4per = ((float)dashboardData.getTotal_4_rating()*4);
            float star5per = ((float)dashboardData.getTotal_5_rating()*5);

            float average = (star1per+star2per+star3per+star4per+star5per)/total;
			DecimalFormat f = new DecimalFormat("0.0");

            Log.d("Total",average+""+total);
            if(total!=0.0)
                tvRating.setText(String.valueOf(f.format(average)));
            else
                tvRating.setText("0");
            tvReview.setText(String.valueOf(dashboardData.getReviewCount()));
        }
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if(requestCode==1){
            if(resultCode==RESULT_OK){
                assert data != null;
                openEventDialog((Events)data.getSerializableExtra(kData));
            }
        }else if(requestCode==EDIT_EVENT_RESULT){
            if(resultCode==RESULT_OK){
                getDashBoardData();
            }
        }
    }

    private void openEventDialog(Events events){
        AddEventDialogFragment fragment = new AddEventDialogFragment();
        Bundle bdl = new Bundle();
        bdl.putInt(KSCREENWIDTH, 0);
        bdl.putInt(KSCREENHEIGHT, 0);
        bdl.putInt(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
        bdl.putSerializable(kData,events);
        fragment.setArguments(bdl);
        fragment.setTargetFragment(this, EDIT_EVENT_RESULT);
        assert getFragmentManager() != null;
        fragment.show(getFragmentManager(), "Dialog Fragment");
    }



    public void getDashBoardData(){
        loaderView.showLoader();
        HashMap<String,Object > map = new HashMap<>();

        if(ModelManager.modelManager().getCurrentUser().getSelectedFacId()==0){
			map.put(kFacId, 1);
		}else{
			map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
		}


        Log.e("Send",map.toString());
        ModelManager.modelManager().userFacDashBoard(map,(Constants.Status iStatus, GenericResponse<DashboardData> genericResponse) -> {
            loaderView.hideLoader();
            try {
                dashboardData = genericResponse.getObject();
                initData();
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            Toaster.customToast(message);
            loaderView.hideLoader();
        });
    }

    private void initCalendar(){
        try {
            dvCalSport.setText("");
            tvHint.setVisibility(View.VISIBLE);
            legend.setVisibility(View.GONE);
            SharedPreferences sp = PreferenceManager.getDefaultSharedPreferences(getActivity());
            SharedPreferences.Editor mEdit1 = sp.edit();
            mEdit1.putInt("booked_seats_size", 0);
            mEdit1.commit();
            //Handling custom calendar events
            calendarView.setCalendarListener(new CalendarListener() {
                @Override
                public void onDateSelected(Date date,String data) { }

                @Override
                public void onMonthChanged(Date date) {
                    SimpleDateFormat df = new SimpleDateFormat("MM-yyyy");
                    String format = df.format(date);
                    String[] array = format.split(kHyhen);
                    year = Integer.parseInt(array[1]);
                    month = Integer.parseInt(array[0]);

                    if(calSportId!=0)
                        getCalendarData(month,year);
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
        }
        SharedPreferences sp = PreferenceManager.getDefaultSharedPreferences(getActivity());
        SharedPreferences.Editor mEdit1 = sp.edit();
        //sKey is an array
        mEdit1.putInt("booked_seats_size", booked_seats.length);

        Log.d("booked_seats_size",booked_seats.length+"");

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

    private void getCalendarData(int m,int y){
        loaderView.showLoader();
        if(m==0 && y==0){
            Calendar calendar = Calendar.getInstance(TimeZone.getDefault());
            year = calendar.get(Calendar.YEAR);
            month = calendar.get(Calendar.MONTH)+1;
        }
        HashMap<String,Object> map = new HashMap<>();
        map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
        map.put(kType,facType);
        map.put(kSportId,calSportId);
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

    private void viewFullEnquiry(Enquires enquires){
        // dialog
        final Dialog dialog = new Dialog(context);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(getResources().getDrawable(R.drawable.canvas_booking_details_img_bg));
        dialog.setContentView(R.layout.dialog_read_full_enquiry);
        dialog.setCancelable(false);

        TextView tvName = dialog.findViewById(R.id.tv_name);
        tvName.setText(enquires.getUser_name());

        TextView tvDesc = dialog.findViewById(R.id.tv_description);
        String desc = "<div style='text-align:center'><center>"+enquires.getMessage()+"</center></div>";
        tvDesc.setText(Html.fromHtml(desc));

        TextView tvDate = dialog.findViewById(R.id.tv_date);
        tvDate.setText(enquires.getDate());

        dialog.findViewById(R.id.close_dialogue).setOnClickListener(v -> dialog.dismiss());

        dialog.show();
    }

    private void checkEmptyEvents(EventDashAdapter adapter){
        if(adapter.getItemCount()==0)
            eventEmpty.setVisibility(View.VISIBLE);
        else
            eventEmpty.setVisibility(View.GONE);
    }

    private void checkEmptyEnquiry(EnquiryAdapter adapter){
        if(adapter.getItemCount()==0)
            enquiryEmpty.setVisibility(View.VISIBLE);
        else
            enquiryEmpty.setVisibility(View.GONE);
    }

    private void getList(){
        HashMap<String ,Object> map = new HashMap<>();
        map.put(kUserId, String.valueOf(ModelManager.modelManager().getCurrentUser().getUserId()));
        ModelManager.modelManager().userFacAcademyListUpdate(map,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Facility>> genericResponse) -> {
                    try {
                        listener.facilityData();
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Log.e("facility_list",message));
    }

    private void getProfileStatus(){
        ModelManager.modelManager().userProfileStatus(
                (Constants.Status iStatus, GenericResponse<Integer> genericResponse) -> {
                    int progress = genericResponse.getObject();
                    if(progress==100)
                        progresslayout.setVisibility(View.GONE);
                    else{
                        progresslayout.setVisibility(View.VISIBLE);
                        String progess = context.getString(R.string.profile_is)+" "+progress+"% " +context.getString(R.string.profile_to);
                        tvProgress.setText(progess);
                        profileBar.setProgress(progress);
                    }
                }, (Constants.Status iStatus, String message) -> Log.e("user_progress",message));
    }

    private void getNotificationCount(){
        HashMap<String,Object> map = new HashMap<>();
        if(ModelManager.modelManager().getCurrentUser().getSelectedFacId()==0)
            map.put(kFacId,0);
        else
            map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        ModelManager.modelManager().userNotificationCount(map,
                (Constants.Status iStatus) -> listener.notificationAlertData(), (Constants.Status iStatus, String message) -> Log.e("not_alert_count",message));
    }

    public void setEventListener(EventClickListener callback) {
        this.listener = callback;
    }

    public interface EventClickListener{
        void profileClick();
        void bookingClick(TotalBookingView totalBookingView);
        void eventClick();
        void enquiryClick();
        void ratingClick();
        void facilityData();
        void notificationAlertData();
        void slotBatchAvail(int facId, int sportId, String sportName, String sDate,String facType);
    }
}
