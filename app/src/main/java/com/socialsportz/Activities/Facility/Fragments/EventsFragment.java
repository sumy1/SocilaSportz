package com.socialsportz.Activities.Facility.Fragments;

import android.app.DatePickerDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.Facility.Adapters.EventAdapter;
import com.socialsportz.Activities.Facility.EventDetailActivity;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.Events;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static android.app.Activity.RESULT_OK;
import static com.socialsportz.Constants.Constants.EDIT_EVENT_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kEndDate;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kPage;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kStartDate;

public class EventsFragment extends Fragment implements View.OnClickListener {

    private int facId=0;
    public static int facidd;
    private int sportId=0;
    private DropDownView dvSport;
    private TextView tvStDate, tvEdDate, tvClear;
    private EditText searchEdit;
    private ShimmerFrameLayout mShimmerViewContainer;
    private RecyclerView rvEvent;
    private EventAdapter eventAdapter;
    private LinearLayout emptyLayout;

    private LinearLayoutManager mLayoutManager;
    private boolean loading=true;
    private int page;
    private int pageSize;
    private HashMap<String,Object> map = new HashMap<>();

    private Context context;
    LinearLayout ll_archiev;
    public EventsFragment(){ }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        context = getActivity();
        View rootView = inflater.inflate(R.layout.fragment_events, container, false);

        initView(rootView);
        setRecyclerView();
        initData(0);

        return  rootView;
    }

    private void initView(View rootView){
		ll_archiev=rootView.findViewById(R.id.ll_archiev);
		ll_archiev.setOnClickListener(this);
        emptyLayout = rootView.findViewById(R.id.empty_view);
        mShimmerViewContainer = rootView.findViewById(R.id.shimmer_view_container);
        searchEdit=rootView.findViewById(R.id.search_edit);
        rvEvent = rootView.findViewById(R.id.rv_rate);
        //for date picker
        tvStDate =rootView.findViewById(R.id.tv_st_date_picker);
        tvEdDate =rootView.findViewById(R.id.tv_ed_date_picker);
        tvClear = rootView.findViewById(R.id.tv_clear);

        rootView.findViewById(R.id.fab).setOnClickListener(this);
        rootView.findViewById(R.id.st_date_layout).setOnClickListener(this);
        rootView.findViewById(R.id.ed_date_layout).setOnClickListener(this);
        rootView.findViewById(R.id.ib_search).setOnClickListener(this);
        rootView.findViewById(R.id.tv_clear).setOnClickListener(this);

        dvSport = rootView.findViewById(R.id.drop_sport);
        dvSport.setClickListener(new DropDownView.onClickInterface() {
            @Override
            public void onClickAction() { }

            @Override
            public void onClickDone(int id, String name) {
                sportId = id;
            }

            @Override
            public void onDismiss() { }
        });
    }

    public void initData(int pg){
        try{
            page = pg;
            facId =  facidd;
            setSportsData();
            getEventListing();
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    private void setSportsData(){
        if(facId!=0){
            CopyOnWriteArrayList<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
            List<FacSport> list = new ArrayList<>();
            for(int i=0;i<facList.size();i++){
                if(facList.get(i).getFacId()==facId){
                    list = facList.get(i).getFacSportList();
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
        }
    }

    private void setRecyclerView(){
        mLayoutManager=new LinearLayoutManager(context,RecyclerView.VERTICAL,false);
        eventAdapter=new EventAdapter(context, new CopyOnWriteArrayList<>(), events -> {
            Intent intent = new Intent(context, EventDetailActivity.class);
            intent.putExtra(kData,events);
            startActivityForResult(intent,1);
        });
        rvEvent.setLayoutManager(mLayoutManager);
        rvEvent.addItemDecoration(new SpaceItemDecoration(25));
        rvEvent.setAdapter(eventAdapter);
        rvEvent.addOnScrollListener(onScrollListener);
    }

    private RecyclerView.OnScrollListener onScrollListener = new RecyclerView.OnScrollListener() {
        @Override
        public void onScrollStateChanged(@NonNull RecyclerView recyclerView, int newState) {
            super.onScrollStateChanged(recyclerView, newState);
        }

        @Override
        public void onScrolled(@NonNull RecyclerView recyclerView, int dx, int dy) {
            if(dy > 0) //check for scroll down
            {
                int visibleItemCount = mLayoutManager.getChildCount();
                int totalItemCount = mLayoutManager.getItemCount();
                int firstVisibleItemPosition = mLayoutManager.findFirstVisibleItemPosition();

                if (loading)
                {
                    if ( (visibleItemCount + firstVisibleItemPosition) >= totalItemCount
                            && firstVisibleItemPosition >= 0
                            && totalItemCount >= pageSize) {
                        loading = false;
                        ++page;
                        initData(page);
                    }
                }
            }
        }
    };

    private void showShimmerView(){
        mShimmerViewContainer.setVisibility(View.VISIBLE);
        emptyLayout.setVisibility(View.GONE);
        mShimmerViewContainer.startShimmerAnimation();
        rvEvent.setVisibility(View.GONE);
    }

    private void hideShimmerView(){
        mShimmerViewContainer.stopShimmerAnimation();
        mShimmerViewContainer.setVisibility(View.GONE);
        rvEvent.setVisibility(View.VISIBLE);
    }

    @Override
    public void onClick(View view) {
        if(view.getId()== R.id.fab){
            AddEventDialogFragment fragment = new AddEventDialogFragment();
            Bundle bdl = new Bundle();
            bdl.putInt(KSCREENWIDTH, 0);
            bdl.putInt(KSCREENHEIGHT, 0);
            bdl.putInt(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
            bdl.putSerializable(kData,null);
            fragment.setArguments(bdl);
            fragment.setTargetFragment(this, EDIT_EVENT_RESULT);
            assert getFragmentManager() != null;
            fragment.show(getFragmentManager(), "Dialog Fragment");
        }else if(view.getId() == R.id.st_date_layout){
            Calendar myCalendar = Calendar.getInstance(TimeZone.getDefault());
            int sYear = myCalendar.get(Calendar.YEAR),sMonth = myCalendar.get(Calendar.MONTH),sDay = myCalendar.get(Calendar.DATE);
            Date stDate = Utils.getDate(tvStDate.getText().toString());
            if(stDate!=null){
                myCalendar.setTime(stDate);
                sYear = myCalendar.get(Calendar.YEAR);
                sMonth = myCalendar.get(Calendar.MONTH);
                sDay = myCalendar.get(Calendar.DAY_OF_MONTH);
            }
            DatePickerDialog dialog = new DatePickerDialog(Objects.requireNonNull(getContext()),
                    (datePicker,year,monthOfYear, dayOfMonth) -> {
                        myCalendar.set(Calendar.YEAR, year);
                        myCalendar.set(Calendar.MONTH, monthOfYear);
                        myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
                        tvStDate.setText(Utils.getDate(myCalendar));
                    }, sYear, sMonth, sDay);
            dialog.getDatePicker().setMinDate(Utils.getMinDate());
            dialog.show();
        } else if(view.getId() == R.id.ed_date_layout){
            Calendar calendar = Calendar.getInstance(TimeZone.getDefault());
            int eYear = calendar.get(Calendar.YEAR),eMonth = calendar.get(Calendar.MONTH),eDay = calendar.get(Calendar.DATE);
            Date edDate = Utils.getDate(tvEdDate.getText().toString());
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
                        tvEdDate.setText(Utils.getDate(calendar));
                    }, eYear, eMonth, eDay);
            dateDialog.getDatePicker().setMinDate(Utils.getMinDate());
            dateDialog.show();
        } else if(view.getId()== R.id.ib_search){
            if(validate()){
                map.clear();
                if(!tvStDate.getText().toString().isEmpty())
                    map.put(kStartDate, Utils.changeDateFormat(tvStDate.getText().toString()));
                if(!tvEdDate.getText().toString().isEmpty())
                    map.put(kEndDate, Utils.changeDateFormat(tvEdDate.getText().toString()));
                if(sportId!=0)
                    map.put(kSportId,sportId);
                initData(0);
                tvClear.setVisibility(View.VISIBLE);
            }
        } else if(view.getId()== R.id.tv_clear){
            clearData();
        }else if(view.getId()==R.id.ll_archiev){
			openEventArchiveDialog();
		}
    }

    public void clearData(){
        map.clear();
        tvStDate.setText("");
        tvEdDate.setText("");
        dvSport.setText("");
        sportId=0;
        initData(0);
        tvClear.setVisibility(View.GONE);
        loading=true;
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
                initData(0);
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

	private void openEventArchiveDialog(){
		ArchieveEventDialogFragment fragment = new ArchieveEventDialogFragment();
		Bundle bdl = new Bundle();
		bdl.putInt(KSCREENWIDTH, 0);
		bdl.putInt(KSCREENHEIGHT, 0);
		bdl.putInt(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
		fragment.setArguments(bdl);
		fragment.setTargetFragment(this, EDIT_EVENT_RESULT);
		assert getFragmentManager() != null;
		fragment.show(getFragmentManager(), "Dialog Fragment");
	}





    private boolean validate(){
        boolean isOk=true;
        if(facId==0){
            isOk = false;
            Toaster.customToast("Please Add Facility/Academy");
        }else if(tvStDate.getText().toString().isEmpty() && tvEdDate.getText().toString().isEmpty()
                && dvSport.getText().toString().isEmpty()){
            Toaster.customToast("Select any data");
            isOk=false;
        } /*else if(!tvStDate.getText().toString().isEmpty() && tvEdDate.getText().toString().isEmpty()){
            Toaster.customToast("Select End Date");
            isOk=false;
        } else if(tvStDate.getText().toString().isEmpty() && !tvEdDate.getText().toString().isEmpty()){
            Toaster.customToast("Select Start Date");
            isOk=false;
        }*/ else if(!tvStDate.getText().toString().isEmpty() && !tvEdDate.getText().toString().isEmpty()){
            if(!Utils.getDateCompare(tvStDate.getText().toString(), tvEdDate.getText().toString())){
                Toaster.customToast("Start Date should be lower than End Date");
                isOk=false;
            }
        }/*else if(eventAdapter.getItemCount()==0){
            isOk = false;
            Toaster.customToast("Please Add UserEvent");
        }*/
        return isOk;
    }

    private void getEventListing(){
        if(page==0)
            showShimmerView();
		if(ModelManager.modelManager().getCurrentUser().getSelectedFacId()==0){
			map.put(kFacId, 0);
		}else{
			map.put(kFacId, facId);
		}
        map.put(kPage,page);
        ModelManager.modelManager().userFacEventListing(map,(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Events>> genericResponse) -> {
            hideShimmerView();
            try {
                CopyOnWriteArrayList<Events> events = genericResponse.getObject();
                if(page!=0){
                    eventAdapter.addData(events);
                    loading = !genericResponse.getObject().isEmpty();
                }
                else{
                    eventAdapter.newData(events);
                    pageSize = genericResponse.getObject().size();
                }
                checkEmptyView();
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            hideShimmerView();
            Toaster.customToast(message);
            checkEmptyView();
        });
    }

    private void checkEmptyView(){
        if(eventAdapter.getItemCount()==1)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }
}

