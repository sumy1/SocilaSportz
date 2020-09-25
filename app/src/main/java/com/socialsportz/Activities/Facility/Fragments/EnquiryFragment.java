package com.socialsportz.Activities.Facility.Fragments;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.os.Bundle;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.Facility.Adapters.EnquiryAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Enquires;
import com.socialsportz.R;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Objects;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kEndDate;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kPage;
import static com.socialsportz.Constants.Constants.kStartDate;

public class EnquiryFragment extends Fragment implements View.OnClickListener {

    private int facId=0;
    private TextView tvStDate, tvEdDate, tvClear;
    private ShimmerFrameLayout mShimmerViewContainer;
    private EnquiryAdapter enquiryAdapter;
    private RecyclerView rvList;
    private LinearLayout emptyLayout;

    private LinearLayoutManager mLayoutManager;
    private boolean loading=true;
    private int page;
    private int pageSize;
    private HashMap<String,Object> map = new HashMap<>();

    private Context context;
    public EnquiryFragment(){ }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        context = getActivity();
        View rootView = inflater.inflate(R.layout.fragment_enquires, container, false);

        initView(rootView);
        setRecyclerView();
        initData(0);

        return  rootView;
    }

    private void initView(View rootView){
        emptyLayout = rootView.findViewById(R.id.empty_view);
        mShimmerViewContainer = rootView.findViewById(R.id.shimmer_view_container);
        rvList = rootView.findViewById(R.id.rv_rate);
        //for date picker
        tvStDate =rootView.findViewById(R.id.tv_st_date_picker);
        tvEdDate =rootView.findViewById(R.id.tv_ed_date_picker);
        tvClear = rootView.findViewById(R.id.tv_clear);

        rootView.findViewById(R.id.st_date_layout).setOnClickListener(this);
        rootView.findViewById(R.id.ed_date_layout).setOnClickListener(this);
        rootView.findViewById(R.id.ib_search).setOnClickListener(this);
        rootView.findViewById(R.id.tv_clear).setOnClickListener(this);
    }

    public void initData(int pg){
        try{
            page = pg;
            facId =  ModelManager.modelManager().getCurrentUser().getSelectedFacId();
            getReviewListing();
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    private void setRecyclerView(){
        mLayoutManager=new LinearLayoutManager(context,RecyclerView.VERTICAL,false);
        enquiryAdapter =new EnquiryAdapter(context,new CopyOnWriteArrayList<>());
        rvList.setLayoutManager(mLayoutManager);
        rvList.addItemDecoration(new SpaceItemDecoration(25));
        rvList.setAdapter(enquiryAdapter);
        rvList.addOnScrollListener(onScrollListener);
        enquiryAdapter.setClickListener(this::viewFullEnquiry);
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
        rvList.setVisibility(View.GONE);
    }

    private void hideShimmerView(){
        mShimmerViewContainer.stopShimmerAnimation();
        mShimmerViewContainer.setVisibility(View.GONE);
        rvList.setVisibility(View.VISIBLE);
    }

    @Override
    public void onClick(View view) {
        if(view.getId() == R.id.st_date_layout){
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
                initData(0);
                tvClear.setVisibility(View.VISIBLE);
            }
        } else if(view.getId()== R.id.tv_clear){
            clearData();
        }
    }

    public void clearData(){
        map.clear();
        tvStDate.setText("");
        tvEdDate.setText("");
        initData(0);
        tvClear.setVisibility(View.GONE);
        loading=true;
    }

    private boolean validate(){
        boolean isOk=true;
        if(facId==0){
            isOk = false;
            Toaster.customToast("Please Add Facility/Academy");
        } else if(tvStDate.getText().toString().isEmpty() && tvEdDate.getText().toString().isEmpty()){
            Toaster.customToast("Select any data");
            isOk=false;
        }/* else if(!tvStDate.getText().toString().isEmpty() && tvEdDate.getText().toString().isEmpty()){
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
        }/* else if(enquiryAdapter.getItemCount()==0){
            isOk = false;
            Toaster.customToast("Review Yet to Be Submitted");
        }*/
        return isOk;
    }

    private void getReviewListing(){
        if(page==0)
            showShimmerView();
		if(ModelManager.modelManager().getCurrentUser().getSelectedFacId()==0){
			map.put(kFacId, 0);
		}else{
			map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
		}
        map.put(kPage,page);
        ModelManager.modelManager().userFacEnquiryList(map,(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Enquires>> genericResponse) -> {
            hideShimmerView();
            try {
                CopyOnWriteArrayList<Enquires> enquiries = genericResponse.getObject();
                if(page!=0){
                    enquiryAdapter.addData(enquiries);
                    loading = !genericResponse.getObject().isEmpty();
                }
                else{
                    enquiryAdapter.newData(enquiries);
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
        if(enquiryAdapter.getItemCount()==1)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
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

}