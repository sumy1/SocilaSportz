package com.socialsportz.Activities.Facility.Fragments;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.text.Html;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Activities.Facility.Adapters.ProfileAchievementAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.FacAchievement;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static android.app.Activity.RESULT_OK;
import static com.socialsportz.Constants.Constants.EDIT_ACHIEVE_RESULT;
import static com.socialsportz.Constants.Constants.EDIT_FACILITY_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kAceivementId;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class ProfileFacilityAcademyFragment extends Fragment implements View.OnClickListener {

    public static String TAG = ProfileFacilityAcademyFragment.class.getSimpleName();
    private Context context;
    private TextView tvHeading,tvDesc,tvFacName,tvCity,tvArea,tvPin;
    private ImageView ivFac;
    private RecyclerView rvAchievement;
    private ProfileAchievementAdapter achievementDetailAdapter;
    private LinearLayout facilityView;
    private LinearLayout emptyLayout;
    private CustomLoaderView loaderView;
    String facType;


    public ProfileFacilityAcademyFragment(){ }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        context = getActivity();
        View rootView = inflater.inflate(R.layout.fragment_facility_academy_details, container, false);
        loaderView = CustomLoaderView.initialize(context);
        initView(rootView);

        rootView.findViewById(R.id.ib_edit_facility).setOnClickListener(this);
        rootView.findViewById(R.id.btn_achievement).setOnClickListener(this);
        return rootView;
    }




	private void initView(View view){
        facilityView =view.findViewById(R.id.facility_layout);
        tvHeading = view.findViewById(R.id.detail_heading);
        tvFacName=view.findViewById(R.id.tv_fac_name);
        tvDesc = view.findViewById(R.id.tv_fac_aca_desc);
        ivFac =view.findViewById(R.id.fac_iv);
        tvCity=view.findViewById(R.id.tv_city);
        tvArea=view.findViewById(R.id.tv_area);
        tvPin=view.findViewById(R.id.tv_pin);

        emptyLayout =view.findViewById(R.id.empty_view);
        rvAchievement =view.findViewById(R.id.rv);
        LinearLayoutManager layoutManager=new LinearLayoutManager(context,RecyclerView.VERTICAL,false);
        rvAchievement.setNestedScrollingEnabled(false);
        rvAchievement.setLayoutManager(layoutManager);
        rvAchievement.addItemDecoration(new SpaceItemDecoration(25));

        checkFacilityData();
    }

    private void checkFacilityData(){
        CurrentUser user = ModelManager.modelManager().getCurrentUser();
        CopyOnWriteArrayList<Facility> facList = user.getFacilities();

        if(!facList.isEmpty()){
            facilityView.setVisibility(View.VISIBLE);
            for(int i=0;i<facList.size();i++){
                if(facList.get(i).getFacId()==user.getSelectedFacId()){
                    setFacilityData(facList.get(i),true);
					facType=facList.get(i).getFacType();

                }
            }
        }
        //Real time data
        //getFacAchievementData();
    }

    private void setFacilityData(Facility fac, boolean type){//true= first time false=dialog edit
        if(fac.getFacType().equals(Constants.FacType.facility.toString()))
            tvHeading.setText(getString(R.string.fc_detail));
        else
            tvHeading.setText(getString(R.string.ac_detail));
        tvFacName.setText(fac.getFacName());
        tvDesc.setText(Html.fromHtml(fac.getFacDesc()),null);
        tvCity.setText(fac.getFacCity());
        tvArea.setText(fac.getFacState());
        tvPin.setText(fac.getFacPincode());

        final Transformation transformation = new MaskTransformation(context, R.drawable.canvas_booking_details_img_bg);
        String path = kImageBaseUrl+fac.getFacFolder()+"/"+fac.getFacBannerImg();
        Picasso.with(getActivity()).load(path)
                .placeholder(R.drawable.placeholder_300).fit()
                .transform(transformation).into(ivFac);
        if(type){
            if(!fac.getAchieveList().isEmpty()) {

				setAchievementData(fac.getAchieveList());
			}else{
				getFacAchievementList();
			}

        }
    }

    private void setAchievementData(CopyOnWriteArrayList<FacAchievement> list){
        achievementDetailAdapter=new ProfileAchievementAdapter(context,facType, list, this::AddEditAchievement, new ProfileAchievementAdapter.ondeleteListner() {
			@Override
			public void onDelete(String factype,String aceivementid, int pos) {
				getFacAchievementData(factype,aceivementid,pos);
			}
		});
        rvAchievement.setAdapter(achievementDetailAdapter);
        checkEmptyView();
    }

    private void checkEmptyView(){
        if(achievementDetailAdapter.getItemCount()==0)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }

    @Override
    public void onClick(View view) {
        if(view.getId()== R.id.ib_edit_facility){
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            CopyOnWriteArrayList<Facility> facList = user.getFacilities();
            if(!facList.isEmpty()){
                for(int i=0;i<facList.size();i++){
                    if(facList.get(i).getFacId()==user.getSelectedFacId()){
                        EditFacilityDialogFragment fragment = new EditFacilityDialogFragment();
                        Bundle bdl = new Bundle();
                        bdl.putInt(KSCREENWIDTH, 0);
                        bdl.putInt(KSCREENHEIGHT, 0);
                        bdl.putSerializable(kData,facList.get(i));
                        fragment.setArguments(bdl);
                        fragment.setTargetFragment(ProfileFacilityAcademyFragment.this, EDIT_FACILITY_RESULT);
                        assert getFragmentManager() != null;
                        fragment.show(getFragmentManager(), "Dialog Fragment");
                    }
                }
            }else{
                Toaster.customToast("Please Add Facility/Academy");
            }
        }
        else if(view.getId() == R.id.btn_achievement){
            //AddEditAchievement(null);
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            CopyOnWriteArrayList<Facility> facList = user.getFacilities();
            if(!facList.isEmpty()){
                for(int i=0;i<facList.size();i++){
                    if(facList.get(i).getFacId()==user.getSelectedFacId())
                        AddEditAchievement(null);
                }
            }else{
                Toaster.customToast("Please Add Facility/Academy");
            }
        }
    }

    private void AddEditAchievement(FacAchievement achievement){
        EditAchievementDialogFragment fragment = new EditAchievementDialogFragment();
        Bundle bdl = new Bundle();
        bdl.putInt(KSCREENWIDTH, 0);
        bdl.putInt(KSCREENHEIGHT, 0);
        bdl.putInt(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
        bdl.putSerializable(kData,achievement);
        fragment.setArguments(bdl);
        fragment.setTargetFragment(ProfileFacilityAcademyFragment.this, EDIT_ACHIEVE_RESULT);
        assert getFragmentManager() != null;
        fragment.show(getFragmentManager(), "Dialog Fragment");
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if(requestCode == EDIT_FACILITY_RESULT && resultCode == RESULT_OK){
            Facility fac = (Facility) data.getSerializableExtra(kData);
            assert fac != null;
            setFacilityData(fac,false);
        } else if(requestCode ==EDIT_ACHIEVE_RESULT && resultCode == RESULT_OK){
            getFacAchievementList();
        }
    }

    private void getFacAchievementList() {
        ModelManager.modelManager().userFacAchieveListing(ModelManager.modelManager().getCurrentUser().getSelectedFacId(),
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacAchievement>> genericResponse) -> {
                    try {
                        CopyOnWriteArrayList<FacAchievement> achievements = genericResponse.getObject();
                        setAchievementData(achievements);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
    }

    private void getFacAchievementDataa() {
        HashMap<String,Object> map = new HashMap<>();
        map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
        ModelManager.modelManager().userFacilityUpdate(map,
                (Constants.Status iStatus, GenericResponse<Facility> genericResponse) -> {
                    try {
                        Facility fac = genericResponse.getObject();
                        setFacilityData(fac,false);
                        if(!fac.getAchieveList().isEmpty())
                            setAchievementData(fac.getAchieveList());
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Log.e(TAG,"facility update error"));
    }


	private void getFacAchievementData(String facType,String acheivementId,int pos) {
		loaderView.showLoader();
		HashMap<String,Object> map = new HashMap<>();
		map.put(kAceivementId, acheivementId);

		Log.e("send..request",map.toString());
		ModelManager.modelManager().userAcheivementDelete(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();
				try {
					String msg=genericResponse.getObject();

					if(facType.equalsIgnoreCase("Academy")){
						Toaster.customToast("Academy Achievement  delete successfully");
					}else{
						Toaster.customToast("Facility Achievement  delete successfully");
					}


					Log.d("Position",pos+"");
					achievementDetailAdapter.removeData(pos);



				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {Toaster.customToast(message);
				loaderView.hideLoader();});
	}
}
