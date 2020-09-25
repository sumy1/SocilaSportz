package com.socialsportz.Activities.Facility.Fragments;

import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;

import com.socialsportz.Activities.Facility.Adapters.AmenityListingAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.FacAmenity;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kAction;
import static com.socialsportz.Constants.Constants.kAmenities;
import static com.socialsportz.Constants.Constants.kUserId;

public class FragmentOnGoAmenityProfile extends Fragment {

    private static final String TAG = FragmentOnGoAmenityProfile.class.getSimpleName();
    private AmenityListingAdapter mAdapter;
    private RecyclerView recyclerView;
    private CustomLoaderView loaderView;
    private AmenityCompleteListener listener;
	ProgressBar progress_bar;
	CopyOnWriteArrayList<Amenity> amenities;
	CurrentUser user;
    public static FragmentOnGoAmenityProfile newInstance() {
        return new FragmentOnGoAmenityProfile();
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_ongo_amenity_profile, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());
         user = ModelManager.modelManager().getCurrentUser();
		progress_bar=rootView.findViewById(R.id.progress_bar);
        recyclerView = rootView.findViewById(R.id.rvListing);
        RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(getActivity());
        recyclerView.setLayoutManager(mLayoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());

        rootView.findViewById(R.id.btn_save).setOnClickListener(v -> {
            if(mAdapter.getCheckedList().isEmpty())
                Toaster.customToast("Please select any choice");
            else
                setFacAmenities(user);
        });

		getAmenitiesData();
        return rootView;
    }

    private void getList(CurrentUser user,CopyOnWriteArrayList<Amenity> amenities){

        //CopyOnWriteArrayList<Amenity> amenities = user.getAmenities();
        try{
            if(amenities!=null){
                CopyOnWriteArrayList<FacAmenity> list =  user.getMyAmenities();
                if(!list.isEmpty()) {
                    for(int i=0;i<amenities.size();i++){
                        for (int j=0;j<list.size();j++){
                            if(list.get(j).getAmenityId()==amenities.get(i).getAmenityId()){
                                Log.e(TAG,String.valueOf(list.get(j).getAmenityId()));
                                amenities.get(i).setStatus(true);
                                break;
                            }
                        }
                    }
                }
            }
        }catch (Exception e){
            e.printStackTrace();
        }
        mAdapter = new AmenityListingAdapter(getActivity(), amenities);
        recyclerView.setAdapter(mAdapter);
    }


	private void getAmenitiesData(){
		progress_bar.setVisibility(View.VISIBLE);
		HashMap<String,Object> parameters = new HashMap<>();
		parameters.put(kAction, "test");

		Log.e("send",parameters.toString());
		ModelManager.modelManager().userAmenities(parameters,
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Amenity>> genericResponse) -> {
				progress_bar.setVisibility(View.GONE);
				try {
					amenities = genericResponse.getObject();
					getList(user,amenities);
				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {progress_bar.setVisibility(View.GONE);;Toaster.customToast(message);
			});
	}


    private void setFacAmenities(CurrentUser user){
        loaderView.showLoader();
        JSONArray array = Utils.generateJsonArrayAmenities(mAdapter.getCheckedList());
        Log.e(TAG,array.toString());

        HashMap<String,Object> map = new HashMap<>();
        map.put(kUserId,user.getUserId());
        map.put(kAmenities,array);
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userAddFacilityAmenities(map,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacAmenity>> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        CopyOnWriteArrayList<FacAmenity> list = genericResponse.getObject();
                        listener.amenityComplete();
                        Log.e(TAG,list.toString());
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                    Toaster.customToast("Successfully Added");
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
     }

    public void setAmenityCompleteListener(AmenityCompleteListener callback) {
        this.listener = callback;
    }

    public interface AmenityCompleteListener{
        void amenityComplete();
    }
}
