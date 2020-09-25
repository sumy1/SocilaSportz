package com.socialsportz.Activities.Facility.Fragments;

import android.app.Dialog;
import android.content.Intent;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.google.android.material.textfield.TextInputEditText;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
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
import androidx.appcompat.widget.Toolbar;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.DialogFragment;

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
import static com.socialsportz.Constants.Constants.kSportList;
import static com.socialsportz.Constants.Constants.kUserId;

public class EditCreateSportDialogFragment extends DialogFragment {

	private static final String TAG = EditCreateSportDialogFragment.class.getSimpleName();
	private FacSport facSport;
	private TextInputEditText etCourts,etIndoor,etOutdoor;
	private DropDownView tvSport;
	private ImageView ivSportType;
	private TextView tvSportHint;
	private View divider;
	private CustomLoaderView loaderView;
	private int facId=0,sportId=0,facSportId=0;
	private CopyOnWriteArrayList<FacSport> sports;
	private CopyOnWriteArrayList<Sport> sports_list;
	private CurrentUser user;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
		Bundle mArgs = getArguments();
		assert mArgs != null;
		int pHeight = mArgs.getInt(KSCREENHEIGHT);
		int pWidth  = mArgs.getInt(KSCREENWIDTH);
		facId = mArgs.getInt(kFacId);
		facSport = (FacSport) mArgs.getSerializable(kData);
		sports = (CopyOnWriteArrayList<FacSport>) mArgs.getSerializable(kSportList);
		Dialog d = getDialog();
		if (d!=null){
			Objects.requireNonNull(d.getWindow()).setLayout(pWidth-100, pHeight-100);
			d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
			Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
			d.getWindow().setBackgroundDrawable(drawable);
		}
	}

	@Override
	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_dialog_edit_sport, container, false);
		user= ModelManager.modelManager().getCurrentUser();
		loaderView= CustomLoaderView.initialize(getActivity());

		tvSport = view.findViewById(R.id.drop_type);
		ivSportType = view.findViewById(R.id.iv_type);
		tvSportHint = view.findViewById(R.id.type_hint);
		divider = view.findViewById(R.id.divider);

		etCourts = view.findViewById(R.id.et_no_courts);
		ImageView ivCourt = view.findViewById(R.id.iv_court);
		setFocusListener(etCourts, ivCourt);

		etIndoor = view.findViewById(R.id.et_indoor);
		ImageView ivIndoor = view.findViewById(R.id.iv_indoor);
		setFocusListener(etIndoor, ivIndoor);

		etOutdoor = view.findViewById(R.id.et_outdoor);
		ImageView ivOutdoor = view.findViewById(R.id.iv_outdoor);
		setFocusListener(etOutdoor, ivOutdoor);

		Toolbar toolbar = view.findViewById(R.id.toolbar);
		toolbar.inflateMenu(R.menu.menu_day_time);
		setSportData(facId);
		//getSportsData();
		insertData(facSport);

		tvSport.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
				setTypeFocus(ivSportType, tvSportHint,divider, R.color.theme_color,5);
			}

			@Override
			public void onClickDone(int id, String name) {
				sportId = id;
				setTypeFocus(ivSportType, tvSportHint,divider, R.color.dim_grey,3);
			}

			@Override
			public void onDismiss() {
				setTypeFocus(ivSportType, tvSportHint,divider, R.color.dim_grey,3);
			}
		});

		// Set an OnMenuItemClickListener to handle menu item clicks
		toolbar.setOnMenuItemClickListener(menuItem -> {
			if(menuItem.getItemId()== R.id.action_done){
				if(validate())
					setAddFacSport();
				return true;
			}else {
				return false;
			}
		});

		// Create an instance of the tab layout from the view.
		toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());

		return view;
	}

	private void setSportData(int facId){
		//List<String> list = Arrays.asList(getResources().getStringArray(R.array.sports));
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

		tvSport.setOptionList(options);
	}


	private void getSportsData(){

		ModelManager.modelManager().userSports(
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Sport>> genericResponse) -> {
				//progress_bar.setVisibility(View.GONE);
				try {
					sports_list = genericResponse.getObject();
					//setSportData(facId,sports_list);
				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {Toaster.customToast(message);
			});
	}


	private void insertData(FacSport sport){
		try{
			facSportId = sport.getFacSportId();
			facId = sport.getFacId();
			sportId = sport.getSportId();
			etCourts.setText(String.valueOf(sport.getSportCourt()));
			etIndoor.setText(String.valueOf(sport.getSportIndoor()));
			etOutdoor.setText(String.valueOf(sport.getSportOutdoor()));
			CopyOnWriteArrayList<Sport> spList = ModelManager.modelManager().getCurrentUser().getSports();
			for(Sport sports:spList){
				if(sport.getSportId()==sports.getSportId())
					tvSport.setText(sports.getSportName());
			}
		}catch (Exception e){
			e.printStackTrace();
		}
	}
	private boolean validate() {
		boolean isOk = true;

		if(Utils.getProperText(tvSport).isEmpty()) {
			Toaster.customToast("Select any Sports");
			isOk = false;
		} else if(Utils.getProperText(etCourts).isEmpty()) {
			etCourts.setError(getString(R.string.error_cannot_be_empty));
			etCourts.requestFocus();
			isOk = false;
		} else if(Utils.getProperText(etIndoor).isEmpty()) {
			etIndoor.setError(getString(R.string.error_cannot_be_empty));
			etIndoor.requestFocus();
			isOk = false;
		} else if(Utils.getProperText(etOutdoor).isEmpty()) {
			etOutdoor.setError(getString(R.string.error_cannot_be_empty));
			etOutdoor.requestFocus();
			isOk = false;
		} else if(!Utils.getProperText(etOutdoor).isEmpty() &&!Utils.getProperText(etIndoor).isEmpty() && !Utils.getProperText(etCourts).isEmpty() ){
			int indoor = Integer.parseInt(Utils.getProperText(etIndoor));
			int outdoor = Integer.parseInt(Utils.getProperText(etOutdoor));
			int court = Integer.parseInt(Utils.getProperText(etCourts));
			if(court>(indoor+outdoor) || court<(indoor+outdoor)){
				Toaster.customToast("Court values doesn't add up");
				isOk = false;
			}
		}

		return isOk;
	}
	private HashMap<String,Object> getFacSportData(){
		HashMap<String ,Object> map=  new HashMap<>();
		if(facSportId!=0)
			map.put(kFacSportId,facSportId);
		map.put(kUserId,user.getUserId());
		map.put(kFacId, facId);
		map.put(kSportId,sportId);
		map.put(kFacCourt, Utils.getProperText(etCourts));
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
					Toaster.customToast("Sports Updated");
					Intent in = Objects.requireNonNull(getActivity()).getIntent();
					(Objects.requireNonNull(getTargetFragment())).onActivityResult(getTargetRequestCode(),EDIT_SPORT_RESULT,in);
					Objects.requireNonNull(getDialog()).dismiss();
					Log.e(TAG,sport.toString());
				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}
	private void setFocusListener(TextInputEditText etFiled, ImageView ivImage){
		etFiled.setOnFocusChangeListener((view, b) -> {
			if (b){
				ivImage.setImageTintList(getResources().getColorStateList(R.color.theme_color));
				//ivImage.setColorFilter(ContextCompat.getColor(getActivity(), R.color.theme_color), android.graphics.PorterDuff.Mode.MULTIPLY);
			} else {
				ivImage.setImageTintList(getResources().getColorStateList(R.color.dim_grey));
				//ivImage.setColorFilter(ContextCompat.getColor(getActivity(), R.color.dim_grey), android.graphics.PorterDuff.Mode.MULTIPLY);
			}
		});
	}

	private void setTypeFocus(ImageView ivImage, TextView text, View divider, int color, int height){
		ivImage.setImageTintList(getResources().getColorStateList(color));
		text.setTextColor(ContextCompat.getColor(Objects.requireNonNull(getActivity()), color));
		divider.setBackgroundColor(ContextCompat.getColor(getActivity(), color));
		ViewGroup.LayoutParams params = divider.getLayoutParams();
		params.height = height;
		divider.setLayoutParams(params);
	}
}
