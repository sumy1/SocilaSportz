package com.socialsportz.Activities.Facility.Fragments;

import android.app.Dialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.Animatable;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.FacAcaAddingActivity;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import static com.socialsportz.Activities.Facility.FacilityDashboardActivity.TAG;
import static com.socialsportz.Constants.Constants.EDIT_SPORT_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacCourt;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacIndoor;
import static com.socialsportz.Constants.Constants.kFacOutdoor;
import static com.socialsportz.Constants.Constants.kFacSportId;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kUserId;

public class AddSportsFragment extends Fragment implements View.OnClickListener {
    private FacSport facSport;
    private int facId, sportId;
    String type;
    private DropDownView tvSportName;
    private EditText etCourt,etIndoor,etOutdoor;
    private CustomLoaderView loaderView;
    private AddSportsCompleteListener listener;
    private ViewGroup viewGroup;
    public static AddSportsFragment newInstance() {
        return new AddSportsFragment();
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle
            savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_add_sports, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());
        viewGroup = root.findViewById(R.id.form_view);
        etCourt = root.findViewById(R.id.et_no_courts);
        etIndoor = root.findViewById(R.id.et_indoor_no);
        etOutdoor = root.findViewById(R.id.et_outdoor_no);
        tvSportName = root.findViewById(R.id.et_sport_name);
        root.findViewById(R.id.tv_see_all).setOnClickListener(this);
        root.findViewById(R.id.btn_add).setOnClickListener(this);
        root.findViewById(R.id.btn_done).setOnClickListener(this);

        tvSportName.setClickListener(new DropDownView.onClickInterface() {
            @Override
            public void onClickAction() { }

            @Override
            public void onClickDone(int id, String name) {
                sportId = id;
            }

            @Override
            public void onDismiss() { }
        });

        return root;
    }

    public void getFacId(int facID,String factype){
        facId = facID;
		type=factype;
        setSportData();
    }
    
    private void setSportData(){
        List<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
        List<Integer> sportCheckList = new ArrayList<>();
        for(int j=0;j<facList.size();j++){
            if(facList.get(j).getFacId()==facId){
                List<FacSport> facSports = facList.get(j).getFacSportList();
                if(!facSports.isEmpty()){
                    for(FacSport sport: facSports){
                        if(facSport!= null){
                            if(sport.getSportId()!=facSport.getSportId())
                                sportCheckList.add(sport.getSportId());
                        }else{
                            sportCheckList.add(sport.getSportId());
                        }
                    }
                }
            }
        }

        List<Sport> list = ModelManager.modelManager().getCurrentUser().getSports();
        ArrayList<DataModel> options = new ArrayList<>();
        for(int i=0;i<list.size();i++){
            if(sportCheckList.isEmpty())
                options.add(new DataModel(list.get(i).getSportId(),list.get(i).getSportName()));
            else{
                boolean found = false;
                for(Integer checklist : sportCheckList){
                    if(list.get(i).getSportId()==checklist){
                        found=true;
                        break;
                    }
                }
                if(!found)
                    options.add(new DataModel(list.get(i).getSportId(),list.get(i).getSportName()));
            }
        }
        tvSportName.setOptionList(options);
    }

    @Override
    public void onClick(View view) {
        if(view.getId()== R.id.btn_add){
            if(validate())
                setAddFacSport();
        }else if(view.getId()== R.id.btn_done){

			addedInformationDialog();
           // listener.completeAddSport();
        }else if(view.getId()== R.id.tv_see_all){
            SportsListingDialogFragment fragment=new SportsListingDialogFragment();
            Bundle bdl = new Bundle();
            bdl.putInt(KSCREENWIDTH, 0);
            bdl.putInt(KSCREENHEIGHT, 0);
            bdl.putSerializable(kData, facId);
            fragment.setArguments(bdl);
            fragment.setTargetFragment(AddSportsFragment.this, EDIT_SPORT_RESULT);
            assert getFragmentManager() != null;
            fragment.show(getFragmentManager(), "Dialog Fragment");
        }
    }
	private void addedInformationDialog() {
		// dialog
		final Dialog dialog = new Dialog(getActivity());
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_added_fac_academy);
		ImageView checkView = dialog.findViewById(R.id.imageView);
		TextView tv_dialog=dialog.findViewById(R.id.tv_dialog);

		if(type.equalsIgnoreCase("Facility")){
			tv_dialog.setText("Facility has been added");
		}else{
			tv_dialog.setText("Academy has been added");
		}

		((Animatable) checkView.getDrawable()).start();
		dialog.setCancelable(false);
		dialog.findViewById(R.id.btn_ok).setOnClickListener(v -> {
			dialog.dismiss();
			getActivity().finish();
		});
		dialog.show();
	}
    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if(requestCode == EDIT_SPORT_RESULT){
            FacSport sport = (FacSport) data.getSerializableExtra(kData);
            assert sport != null;
            facSport = sport;
            setData(facSport);
        }
    }

    private boolean validate() {
        boolean isOk = true;
        if(Utils.getProperText(tvSportName).isEmpty()) {
            Toaster.customToast("Select any Sports");
            isOk = false;
        } else if(Utils.getProperText(etCourt).isEmpty()) {
            etCourt.setError(getString(R.string.error_cannot_be_empty));
            etCourt.requestFocus();
            isOk = false;
        } else if(Utils.getProperText(etIndoor).isEmpty()) {
            etIndoor.setError(getString(R.string.error_cannot_be_empty));
            etIndoor.requestFocus();
            isOk = false;
        } else if(Utils.getProperText(etOutdoor).isEmpty()) {
            etIndoor.setError(getString(R.string.error_cannot_be_empty));
            etIndoor.requestFocus();
            isOk = false;
        } else if(!Utils.getProperText(etOutdoor).isEmpty() &&!Utils.getProperText(etIndoor).isEmpty() && !Utils.getProperText(etCourt).isEmpty() ){
            int indoor = Integer.parseInt(Utils.getProperText(etIndoor));
            int outdoor = Integer.parseInt(Utils.getProperText(etOutdoor));
            int court = Integer.parseInt(Utils.getProperText(etCourt));
            if(court>(indoor+outdoor) || court<(indoor+outdoor)){
                Toaster.customToast("Court values doesn't add up");
                isOk = false;
            }
        }

        return isOk;
    }

    private void setData(FacSport sport){
        try{
            facId = sport.getFacId();
            sportId = sport.getSportId();
            etCourt.setText(String.valueOf(sport.getSportCourt()));
            etIndoor.setText(String.valueOf(sport.getSportIndoor()));
            etOutdoor.setText(String.valueOf(sport.getSportOutdoor()));
            setSportData();
            CopyOnWriteArrayList<Sport> spList = ModelManager.modelManager().getCurrentUser().getSports();
            for(Sport sports:spList){
                if(sports.getSportId()==sportId){
                    tvSportName.setText(sports.getSportName());
                    break;
                }
            }
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    private HashMap<String,Object> getFacSportData(){
        HashMap<String ,Object> map=  new HashMap<>();
        if(facSport!=null)
            map.put(kFacSportId,facSport.getFacSportId());
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        map.put(kFacId, facId);
        map.put(kSportId,sportId);
        map.put(kFacCourt, Utils.getProperText(etCourt));
        map.put(kFacIndoor, Utils.getProperText(etIndoor));
        map.put(kFacOutdoor, Utils.getProperText(etOutdoor));
        return map;
    }

    private void setAddFacSport(){
        loaderView.showLoader();
        HashMap<String ,Object> map = getFacSportData();
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userAddFacilitySports(map,
                (Constants.Status iStatus, GenericResponse<FacSport> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        FacSport sport = genericResponse.getObject();
                        //clearForm(viewGroup);
						etCourt.setText("");
						etIndoor.setText("");
						etOutdoor.setText("");
						tvSportName.setText("");
                        Log.e(TAG,sport.toString());
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                    Toaster.customToast("Sports Added");
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }

    private void clearForm(ViewGroup group) {
        for (int i = 0, count = group.getChildCount(); i < count; ++i) {
            View view = group.getChildAt(i);
            if (view instanceof EditText) {
                ((EditText)view).setText("");
            }else if (view instanceof TextView) {
                ((TextView)view).setText("");
            }
            if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
                clearForm((ViewGroup)view);
        }
    }

    public void setAddSportsCompleteListener(AddSportsCompleteListener callBack){
        this.listener=callBack;
    }


    public interface AddSportsCompleteListener{
        void completeAddSport();
    }
}
