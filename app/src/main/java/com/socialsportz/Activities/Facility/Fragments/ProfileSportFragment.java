package com.socialsportz.Activities.Facility.Fragments;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.Adapters.AmenitiesAdapter;
import com.socialsportz.Activities.Facility.Adapters.SportsAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.FacAmenity;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.HorizontalSpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.VerticalSpaceItemDecoration;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.EDIT_AMENITY_RESULT;
import static com.socialsportz.Constants.Constants.EDIT_SPORT_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kSportList;
import static com.socialsportz.Constants.Constants.kUserId;

public class ProfileSportFragment extends Fragment implements View.OnClickListener {

    private static final String TAG = ProfileSportFragment.class.getSimpleName();
    private Context context;
    private RecyclerView rvSport, rvAmenity;
    private CurrentUser currentUser;
    private SportsAdapter sportAdapter;
    private LinearLayout emptyLayout;
    private AmenitiesAdapter amenitiesAdapter;
    private TextView emptyTextView;
    private CopyOnWriteArrayList<FacSport> sports;
    private CustomLoaderView loaderView;

    public ProfileSportFragment() {
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        context = getActivity();
        View rootView = inflater.inflate(R.layout.profile_sport_amenities, container, false);
        loaderView = CustomLoaderView.initialize(context);
        currentUser = ModelManager.modelManager().getCurrentUser();

        emptyLayout = rootView.findViewById(R.id.empty_view);
        emptyTextView=rootView.findViewById(R.id.tv_empty_amenity);

        rvSport = rootView.findViewById(R.id.rv_sport);
        rvSport.setLayoutManager(new LinearLayoutManager(context, RecyclerView.VERTICAL, false));
        rvSport.addItemDecoration(new VerticalSpaceItemDecoration(20));

        rvAmenity = rootView.findViewById(R.id.rv_amenity);
        rvAmenity.setLayoutManager(new LinearLayoutManager(context, LinearLayoutManager.HORIZONTAL, false));
        rvAmenity.addItemDecoration(new HorizontalSpaceItemDecoration(5));

        initData();
        rootView.findViewById(R.id.ib_edit_amenity).setOnClickListener(this);
        rootView.findViewById(R.id.btn_sport).setOnClickListener(this);

        return rootView;
    }

    private void initData(){
        setAmenityList();
        setSportList();
        getFacSportList();
        setFacAmenityUpdate();
    }

    @Override
    public void onClick(View view) {
        if (view.getId() == R.id.btn_sport) {
            CopyOnWriteArrayList<Facility> facList = currentUser.getFacilities();
            if (!facList.isEmpty()) {
                AddEditSport(null);
            } else {
                Toaster.customToast("Please Add Facility/Academy");
            }
        } else if (view.getId() == R.id.ib_edit_amenity) {
            if (!currentUser.getFacilities().isEmpty()) {
                CopyOnWriteArrayList<FacAmenity> list = new CopyOnWriteArrayList<>();
                if(!currentUser.getMyAmenities().isEmpty())
                    list = currentUser.getMyAmenities();

                for(FacAmenity am:list){
                    Log.e(TAG,String.valueOf(am.getAmenityId()));
                }
                AmenityDialogFragment fragment = new AmenityDialogFragment();
                Bundle bdl = new Bundle();
                bdl.putInt(KSCREENWIDTH, 0);
                bdl.putInt(KSCREENHEIGHT, 0);
                bdl.putSerializable(kData, list);
                fragment.setArguments(bdl);
                fragment.setTargetFragment(ProfileSportFragment.this, EDIT_AMENITY_RESULT);
                assert getFragmentManager() != null;
                fragment.show(getFragmentManager(), "Dialog Fragment");
            } else {
                Toaster.customToast("Please Add Facility/Academy");
            }
        }
    }

    /*private void editData(FacSport facSport){
        CopyOnWriteArrayList<Facility> facList = currentUser.getFacilities();
        CopyOnWriteArrayList<FacSport> list = new CopyOnWriteArrayList<>();
        for (int i = 0; i < facList.size(); i++) {
            if (currentUser.getSelectedFacId() == facList.get(i).getFacId())
                if (facList.get(i).getFacSportList() != null) {
                    list = facList.get(i).getFacSportList();
                    break;
                }
        }
        //AddEditSport();
    }*/

    private void AddEditSport(FacSport facSport){
        EditCreateSportDialogFragment fragment = new EditCreateSportDialogFragment();
        Bundle bdl = new Bundle();
        bdl.putInt(KSCREENWIDTH, 0);
        bdl.putInt(KSCREENHEIGHT, 0);
        bdl.putInt(kFacId,currentUser.getSelectedFacId());
        bdl.putSerializable(kSportList,sports);
        bdl.putSerializable(kData, facSport);
        fragment.setArguments(bdl);
        fragment.setTargetFragment(ProfileSportFragment.this, EDIT_SPORT_RESULT);
        assert getFragmentManager() != null;
        fragment.show(getFragmentManager(), "Dialog Fragment");
    }

    private void setSportList() {
        CopyOnWriteArrayList<FacSport> sports = new CopyOnWriteArrayList<>();
        if (!currentUser.getFacilities().isEmpty()) {
            CopyOnWriteArrayList<Facility> facList = currentUser.getFacilities();
            for(int i=0;i<facList.size();i++){
                if (currentUser.getSelectedFacId() == facList.get(i).getFacId()){
                    if(!facList.get(i).getFacSportList().isEmpty()){
                        sports = facList.get(i).getFacSportList();
                        break;
                    }
                }
            }
        }
        sportAdapter = new SportsAdapter(context, sports, this::AddEditSport);
        rvSport.setAdapter(sportAdapter);
        checkEmptyView();
    }

    private void checkEmptyView() {
        if (sportAdapter.getItemCount() == 0)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }

    private void setAmenityList() {
        CopyOnWriteArrayList<Amenity> amenity = new CopyOnWriteArrayList<>();
        if (currentUser.getMyAmenities() != null) {
            CopyOnWriteArrayList<Amenity> amenityList = currentUser.getAmenities();
            CopyOnWriteArrayList<FacAmenity> myAmenityList = currentUser.getMyAmenities();
            for (int i = 0; i < amenityList.size(); i++) {
                for (int j = 0; j < myAmenityList.size(); j++) {
                    if (myAmenityList.get(j).getAmenityId() == amenityList.get(i).getAmenityId())
                        amenity.add(amenityList.get(i));
                }
            }
        }

        amenitiesAdapter = new AmenitiesAdapter(context, amenity);
        rvAmenity.setAdapter(amenitiesAdapter);
        checkAmenityEmptyView();
    }

    private void checkAmenityEmptyView() {
        if (amenitiesAdapter.getItemCount() == 0)
            emptyTextView.setVisibility(View.VISIBLE);
        else
            emptyTextView.setVisibility(View.GONE);
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == EDIT_AMENITY_RESULT) {
            setAmenityList();
        }else if (requestCode == EDIT_SPORT_RESULT) {
            getFacSportList();
        }
    }

    private void getFacSportList() {
        ModelManager.modelManager().userFacSportUpdate(ModelManager.modelManager().getCurrentUser().getSelectedFacId(),
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacSport>> genericResponse) -> {
                    try {
                        sports = genericResponse.getObject();
                        sportAdapter.newData(sports);
                        checkEmptyView();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
    }

    private void setFacAmenityUpdate() {
        HashMap<String,Object> map = new HashMap<>();
        map.put(kUserId, String.valueOf(ModelManager.modelManager().getCurrentUser().getUserId()));
        ModelManager.modelManager().userFacAmenityUpdate(map,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacAmenity>> genericResponse) -> {
                    try {
                        setAmenityList();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Log.e(TAG,"Amenity update error"));
    }
}
