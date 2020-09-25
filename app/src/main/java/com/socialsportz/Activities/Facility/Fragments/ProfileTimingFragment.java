package com.socialsportz.Activities.Facility.Fragments;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;

import com.socialsportz.Activities.Facility.Adapters.TimingAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.R;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.VerticalSpaceItemDecoration;

import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.DAY_TIME_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacTiming;
import static com.socialsportz.Constants.Constants.kFlag;

public class ProfileTimingFragment extends Fragment implements View.OnClickListener {

    public static String TAG = ProfileTimingFragment.class.getSimpleName();
    private Context context;
    private RecyclerView rvList;
    private TimingAdapter timeAdapter;
    private LinearLayout emptyLayout;
    private CopyOnWriteArrayList<FacDayTime> list = new CopyOnWriteArrayList<>();

    public ProfileTimingFragment(){ }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        context = getActivity();
        View rootView = inflater.inflate(R.layout.profile_timings_layout, container, false);
        emptyLayout = rootView.findViewById(R.id.empty_view);

        rvList = rootView.findViewById(R.id.rv_timing);
        LinearLayoutManager layoutManager = new LinearLayoutManager(context,RecyclerView.VERTICAL,false);
        rvList.setLayoutManager(layoutManager);
        rvList.addItemDecoration(new VerticalSpaceItemDecoration(5));
        rootView.findViewById(R.id.img_btn_edit_time).setOnClickListener(this);

        setData();
        // Real Time Data
        getFacTimingData();
        return rootView;
    }

    private void setData(){
        try {
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            CopyOnWriteArrayList<Facility> facList = user.getFacilities();
            if(!facList.isEmpty()) {
                for (int i = 0; i < facList.size(); i++) {
                    if (user.getSelectedFacId() == facList.get(i).getFacId())
                        list = facList.get(i).getFacTimingList();
                }
            }
            timeAdapter = new TimingAdapter(context, list);
            rvList.setAdapter(timeAdapter);
            checkEmptyView();
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    @Override
    public void onClick(View view) {
        if(view.getId()== R.id.img_btn_edit_time){
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            CopyOnWriteArrayList<Facility> facList = user.getFacilities();
            if(!facList.isEmpty()){
                /*for(int i= 0;i<facList.size();i++){
                    if(user.getSelectedFacId()==facList.get(i).getFacId())
                        list = facList.get(i).getFacTimingList();
                }*/
                DayTimeDialogFragment fragment = new DayTimeDialogFragment();
                Bundle bdl = new Bundle();
                bdl.putInt(KSCREENWIDTH, 0);
                bdl.putInt(KSCREENHEIGHT, 0);
                bdl.putInt(kFlag,1);
                bdl.putInt(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
                bdl.putInt(kFacId,user.getSelectedFacId());
                bdl.putSerializable(kData, Utils.getTimings(Objects.requireNonNull(getContext())));
                bdl.putSerializable(kFacTiming,list);
                fragment.setArguments(bdl);
                fragment.setTargetFragment(ProfileTimingFragment.this, DAY_TIME_RESULT);
                assert getFragmentManager() != null;
                fragment.show(getFragmentManager(), "Dialog Fragment");
            }else {
                Toaster.customToast("Please Add Facility/Academy");
            }
        }
    }

    private void checkEmptyView(){
        if(timeAdapter.getItemCount()==0)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == DAY_TIME_RESULT){
            setData();
        }
    }

    private void getFacTimingData() {
        HashMap<String,Object> map = new HashMap<>();
        map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
        ModelManager.modelManager().userFacTimingUpdate(map,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacDayTime>> genericResponse) -> {
                    try {
                        list = genericResponse.getObject();
                        timeAdapter.newData(list);
                        checkEmptyView();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Log.e(TAG,"facility update error"));
    }
}
