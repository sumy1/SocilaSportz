package com.socialsportz.Activities.Facility.Fragments;

import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;

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
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

import static com.socialsportz.Constants.Constants.kFacCourt;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacIndoor;
import static com.socialsportz.Constants.Constants.kFacOutdoor;
import static com.socialsportz.Constants.Constants.kFacSportId;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kUserId;

public class FragmentOnGoSports extends Fragment {

	public static String TAG = FragmentOnGoSports.class.getSimpleName();
	private FacSport sportData;
	private PageChangeListener listener;
	private int facId=0, sportId=0, facSportId=0;
	private DropDownView tvFacName,tvSportName;
	private EditText etCourt,etIndoor,etOutdoor;
	private CustomLoaderView loaderView;
	private ViewGroup viewGroup;

	public static FragmentOnGoSports newInstance() {
		return new FragmentOnGoSports();
	}

	@Override
	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
		View root = inflater.inflate(R.layout.fragment_ongo_sports, container, false);
		loaderView = CustomLoaderView.initialize(getActivity());

		viewGroup = root.findViewById(R.id.form_view);
		etCourt = root.findViewById(R.id.et_no_courts);
		etIndoor = root.findViewById(R.id.et_indoor_no);
		etOutdoor = root.findViewById(R.id.et_outdoor_no);

		tvFacName = root.findViewById(R.id.et_fac_name);
		tvSportName = root.findViewById(R.id.et_sport_name);

		root.findViewById(R.id.btn_save).setOnClickListener(v -> {
			if(validate())
				setAddFacSport();
		});

		return root;
	}

	@Override
	public void setUserVisibleHint(boolean isVisibleToUser) {
		super.setUserVisibleHint(isVisibleToUser);
		//Code executes EVERY TIME user views the fragment
		if (isVisibleToUser && isResumed())
		{
			//Only manually call onResume if fragment is already visible
			//Otherwise allow natural fragment lifecycle
			onResume();
		}

	}

	@Override
	public void onResume() {
		super.onResume();
		if (!getUserVisibleHint()) {
			return;
		}
		clearForm(viewGroup);
		getFacData();
		ArrayList<DataModel> facOptions = new ArrayList<>();
		List<Facility> list = ModelManager.modelManager().getCurrentUser().getFacilities();
		for(int i=0;i<list.size();i++){
			facOptions.add(new DataModel(list.get(i).getFacId(),list.get(i).getFacName()));
		}
		try{
			tvFacName.setOptionList(facOptions);
			DropDownListeners();
		}catch (Exception e){
			e.printStackTrace();
		}

	}

	public void getFacData(){
		ArrayList<DataModel> facOptions = new ArrayList<>();
		List<Facility> list = ModelManager.modelManager().getCurrentUser().getFacilities();
		for(int i=0;i<list.size();i++){
			facOptions.add(new DataModel(list.get(i).getFacId(),list.get(i).getFacName()));
		}
        try{
			tvFacName.setOptionList(facOptions);
			DropDownListeners();
		}catch (Exception e){
        	e.printStackTrace();
		}


	}


	private void DropDownListeners(){
		try{
			tvFacName.setClickListener(new DropDownView.onClickInterface() {
				@Override
				public void onClickAction() { }

				@Override
				public void onClickDone(int id, String name) {
					facId = id;
					setSportData(facId);
				}

				@Override
				public void onDismiss() { }
			});
		}catch(Exception e){
			e.printStackTrace();

		}


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
						if(sportData!= null){
							if(sport.getSportId()!=sportData.getSportId())
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

	void insertData(FacSport sport){
		try{
			sportData = sport;
			facSportId = sport.getFacSportId();
			facId = sport.getFacId();
			sportId = sport.getSportId();
			etCourt.setText(String.valueOf(sport.getSportCourt()));
			etIndoor.setText(String.valueOf(sport.getSportIndoor()));
			etOutdoor.setText(String.valueOf(sport.getSportOutdoor()));
			setSportData(facId);
			CopyOnWriteArrayList<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
			for(Facility fac:facList){
				if(fac.getFacId()==sport.getFacId()){
					tvFacName.setText(fac.getFacName());
					break;
				}
			}
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

	private boolean validate() {
		boolean isOk = true;

		if (Utils.getProperText(tvFacName).isEmpty()) {
			Toaster.customToast("Select any Facility/Academy");
			isOk = false;
		} else if(Utils.getProperText(tvSportName).isEmpty()) {
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
			etOutdoor.setError(getString(R.string.error_cannot_be_empty));
			etOutdoor.requestFocus();
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

	private HashMap<String,Object> getFacSportData(){
		HashMap<String ,Object> map=  new HashMap<>();
		if(facSportId!=0)
			map.put(kFacSportId,facSportId);
		map.put(kUserId,ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kFacId, facId);
		map.put(kSportId,sportId);
		map.put(kFacCourt,Utils.getProperText(etCourt));
		map.put(kFacIndoor,Utils.getProperText(etIndoor));
		map.put(kFacOutdoor,Utils.getProperText(etOutdoor));
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
					Log.e(TAG,sport.toString());
				} catch (Exception e){
					e.printStackTrace();
				}
				clearForm(viewGroup);
				listener.pageChange();
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}

	private void clearForm(ViewGroup group) {
		tvSportName.setText("");
		tvFacName.setText("");
		tvFacName.setOptionList(new ArrayList<>());
		tvSportName.setOptionList(new ArrayList<>());
		for (int i = 0, count = group.getChildCount(); i < count; ++i) {
			View view = group.getChildAt(i);
			if (view instanceof EditText) {
				((EditText)view).setText("");
			}
			if(view instanceof ViewGroup && (((ViewGroup)view).getChildCount() > 0))
				clearForm((ViewGroup)view);
		}
	}

	void setPageChangeListener(PageChangeListener callback) {
		this.listener = callback;
	}

	public interface PageChangeListener{
		void pageChange();
	}
}
