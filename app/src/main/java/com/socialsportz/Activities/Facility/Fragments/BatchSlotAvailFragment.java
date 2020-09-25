package com.socialsportz.Activities.Facility.Fragments;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ExpandableListView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.Facility.Adapters.BatchSlotExpandableAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotAvail;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kDate;
import static com.socialsportz.Constants.Constants.kEndDate;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacType;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kPackageId;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kStartDate;

public class BatchSlotAvailFragment extends Fragment implements View.OnClickListener {
    private BookClickListener listener;
    private int facId,sportId,packageId;
    private String facType,date,last;
    private ImageView ivSport;
    private TextView facName,sportName;
    private TextView sDate,eDate;
    private DropDownView dvPackage;
    private LinearLayout packageLayout;
    private CustomLoaderView loaderView;
    private ExpandableListView expandableListView;
    String packageName;

    public static BatchSlotAvailFragment newInstance() {
        return new BatchSlotAvailFragment();
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Bundle bundle = getArguments();
        assert bundle != null;
        facId = bundle.getInt(kFacId);
        sportId = bundle.getInt(kSportId);
        date = bundle.getString(kStartDate);
        last = Utils.getFurtherDate(date);
        packageId=0;
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle
            savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_slot_batch_availability, container, false);
        loaderView = CustomLoaderView.initialize(getContext());

        expandableListView = root.findViewById(R.id.expandableListView);
        DisplayMetrics metrics = new DisplayMetrics();
        Objects.requireNonNull(getActivity()).getWindowManager().getDefaultDisplay().getMetrics(metrics);
        int width = metrics.widthPixels;
        expandableListView.setIndicatorBounds(width - Utils.getPixelFromDips(60, Objects.requireNonNull(getContext())),
                width - Utils.getPixelFromDips(15,getContext()));

        facName = root.findViewById(R.id.tv_fac_aca_name);
        sportName = root.findViewById(R.id.tv_sport_name);
        ivSport = root.findViewById(R.id.iv_sport);
        sDate = root.findViewById(R.id.tv_st_date);
        eDate = root.findViewById(R.id.tv_ed_date);
        packageLayout = root.findViewById(R.id.package_lay);
        dvPackage = root.findViewById(R.id.drop_type);
        root.findViewById(R.id.st_date_layout).setOnClickListener(this);
        root.findViewById(R.id.ed_date_layout).setOnClickListener(this);
        root.findViewById(R.id.btn_book).setOnClickListener(this);
        root.findViewById(R.id.ib_filter).setOnClickListener(this);
        initData();
        return  root;
    }

    private void initData(){
        CopyOnWriteArrayList<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
        for(int i=0;i< facList.size();i++){
            if(facList.get(i).getFacId()==facId){
                facName.setText(facList.get(i).getFacName());
                facType = facList.get(i).getFacType();
                break;
            }
        }
        CopyOnWriteArrayList<Sport> sportList = ModelManager.modelManager().getCurrentUser().getSports();
        for(int i=0;i< sportList.size();i++){
            if(sportList.get(i).getSportId()==sportId){
                String path = kImageBaseUrl+sportList.get(i).getFolderName()+"/"+sportList.get(i).getSportImg();
                Picasso.with(getContext()).load(path).placeholder(R.drawable.football_image).into(ivSport);
                sportName.setText(sportList.get(i).getSportName());
                break;
            }
        }
        sDate.setText(date.trim());
        if(facType.equals(Constants.FacType.academy.toString())){
            packageLayout.setVisibility(View.VISIBLE);
            getPackagesData();
            dvPackage.setClickListener(new DropDownView.onClickInterface() {
                @Override
                public void onClickAction() { }

                @Override
                public void onClickDone(int id, String name) {
                    packageId = id;
					packageName=name;
                    getAvailableBookings();
                }

                @Override
                public void onDismiss() { }
            });
        }else {
            getAvailableBookings();
        }
    }

    private void InitSlotsBatchView(CopyOnWriteArrayList<BatchSlotAvail> list,String packageId){
        Utils.parentItems = new CopyOnWriteArrayList<>();
        Utils.parentItems = list;
        Utils.childItems = new CopyOnWriteArrayList<>();
        for(int i=0;i<list.size();i++){
            HashMap<String,Object> map = new HashMap<>();
            map.put(kDate,list.get(i).getDate());
            map.put(kData,list.get(i).getBatchSlot());
            map.put(kPackageId,packageId);
            Utils.childItems.add(map);
        }
        CopyOnWriteArrayList<HashMap<String,Object>> childList = Utils.childItems;
        BatchSlotExpandableAdapter expandableAdapter = new BatchSlotExpandableAdapter(facType,Objects.requireNonNull(getContext()), list,childList);
        expandableListView.setAdapter(expandableAdapter);
        expandableListView.expandGroup(0,true);

        expandableListView.setOnGroupExpandListener(groupPosition -> {});
        expandableListView.setOnGroupCollapseListener(groupPosition -> {});
        expandableListView.setOnChildClickListener((parent, v, groupPosition, childPosition, id) -> false);
    }

    private void getAvailableBookings(){
        loaderView.showLoader();
        HashMap<String,Object> map = new HashMap<>();
        map.put(kFacId,facId);
        map.put(kSportId,sportId);
        map.put(kStartDate, Utils.changeDateFormat(sDate.getText().toString()));
        map.put(kFacType,facType);
        if(packageId!=0){
            map.put(kPackageId,packageId);
        }else{
            map.put(kEndDate, Utils.getFurtherDate(sDate.getText().toString()));
        }
        if(!eDate.getText().toString().isEmpty())
            map.put(kEndDate, Utils.changeDateFormat(eDate.getText().toString()));

		Log.e("request",map.toString());
        ModelManager.modelManager().userFacAvailBookings(map,(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchSlotAvail>> genericResponse) -> {
            loaderView.hideLoader();
            try {
                CopyOnWriteArrayList<BatchSlotAvail> list = genericResponse.getObject();

                InitSlotsBatchView(list, String.valueOf(packageId));
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }

    private void getPackagesData(){
        loaderView.showLoader();
        ModelManager.modelManager().userFacAcaPackages( (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchPackage>> genericResponse) -> {
            try {
                CopyOnWriteArrayList<BatchPackage> packageData = genericResponse.getObject();
                ArrayList<DataModel> options = new ArrayList<>();
                for(int i=0;i<packageData.size();i++){
                    options.add(new DataModel(packageData.get(i).getPackageId(),packageData.get(i).getPackageName()));
                }
                packageId = packageData.get(0).getPackageId();
                dvPackage.setOptionList(options);
                dvPackage.setText(packageData.get(0).getPackageName());
                packageName=packageData.get(0).getPackageName();
                getAvailableBookings();
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }

    public void setClickListener(BookClickListener callback) {
        this.listener = callback;
    }

    @Override
    public void onClick(View view) {
        if(view.getId() == R.id.st_date_layout){
            Calendar myCalendar = Calendar.getInstance();
            int sYear = Calendar.YEAR,sMonth = Calendar.MONTH,sDay = Calendar.DAY_OF_MONTH;
            Date stDate = Utils.getDate(sDate.getText().toString());
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
                        sDate.setText(Utils.getDate(myCalendar));
                    }, sYear, sMonth, sDay);
            dialog.getDatePicker().setMinDate(Calendar.getInstance().getTimeInMillis());
            dialog.show();
        } else if(view.getId() == R.id.ed_date_layout){
            Calendar calendar = Calendar.getInstance();
            int eYear = Calendar.YEAR,eMonth = Calendar.MONTH,eDay = Calendar.DAY_OF_MONTH;
            Date edDate = Utils.getDate(eDate.getText().toString());
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
                        eDate.setText(Utils.getDate(calendar));
                    }, eYear, eMonth, eDay);
            dateDialog.getDatePicker().setMinDate(Calendar.getInstance().getTimeInMillis());
            dateDialog.show();
        } else if(view.getId()== R.id.btn_book){
            boolean found=false;
            CopyOnWriteArrayList<HashMap<String,Object>> list = Utils.childItems;
            for(int i=0;i<list.size();i++){
                CopyOnWriteArrayList<BatchSlot> batchSlots = (CopyOnWriteArrayList<BatchSlot>) list.get(i).get(kData);
                assert batchSlots != null;
                for(int j = 0; j<batchSlots.size(); j++){
                    if(batchSlots.get(j).isChecked()){
                         found = true;
                         break;
                    }
                }
            }
            if(found)
                listener.bookingClick(packageName);
            else
                Toaster.customToast("Please Select Slots/Batch");
        } else if(view.getId()== R.id.ib_filter){
            getAvailableBookings();
        }
    }

    public interface BookClickListener{
        void bookingClick(String packageName);
    }
}
