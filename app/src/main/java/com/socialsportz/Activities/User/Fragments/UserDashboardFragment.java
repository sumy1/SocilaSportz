package com.socialsportz.Activities.User.Fragments;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.socialsportz.Activities.User.Activities.AcademySeeAllActivity;
import com.socialsportz.Activities.User.Activities.EventSeeAllActivity;
import com.socialsportz.Activities.User.Activities.FacilitySeeAllActivity;
import com.socialsportz.Activities.User.Adapters.DashAcademyAdapter;
import com.socialsportz.Activities.User.Adapters.DashEventAdapter;
import com.socialsportz.Activities.User.Adapters.DashFacilityAdapter;
import com.socialsportz.Activities.User.Adapters.DashSportAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.UserDashBoard;
import com.socialsportz.Models.User.UserEvent;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.HorizontalSpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONObject;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.StaggeredGridLayoutManager;

import static com.socialsportz.Constants.Constants.kFacLat;
import static com.socialsportz.Constants.Constants.kFacLng;
import static com.socialsportz.Constants.Constants.kResponseMessage;
import static com.socialsportz.Constants.Constants.kUserId;


public class UserDashboardFragment extends Fragment {
	private Context context;
	private CustomLoaderView loaderView;
	private RecyclerView rvSports, rvEvent, rvFacility, rvAcademy;
	private DashFacilityAdapter facilityAdapter;
	private DashAcademyAdapter academyAdapter;
	private DashEventAdapter eventAdapter;
	private DashSportAdapter statAdapter;
	private EventClickListener listener;
	TextView tv_facility, tv_event, tv_academy;
	RelativeLayout rel_facSeeAll, rel_eventSeeAll, rel_academySeeALL, rv_academy, rv_event, rv_facility;

	public UserDashboardFragment() {
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
	}

	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
		View rootView = inflater.inflate(R.layout.fragment_user_dashboard, container, false);
		context = getActivity();
		loaderView = CustomLoaderView.initialize(context);

      /*  rvSports=rootView.findViewById(R.id.rv_sports);
        rvSports.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL ));
        rvSports.addItemDecoration(new HorizontalSpaceItemDecoration(10));*/
		//getSportData();


		/*boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
		if (tabletSize) {
			new AlertDialog.Builder(context)
				.setTitle("Alert!")
				.setMessage("This app is not supported on tablet, You want to go inside ?")
				// Specifying a listener allows you to take an action before dismissing the dialog.
				// The dialog is automatically dismissed when a dialog button is clicked.
				.setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
					public void onClick(DialogInterface dialog, int which) {
						//Toaster.customToast("Please LogIn!");
						// Continue with delete operation
					}
				})
				// A null listener allows the button to dismiss the dialog and take no further action.
				.setNegativeButton(android.R.string.no, null)
				.setIcon(android.R.drawable.ic_dialog_alert)
				.show();
		}
		else {

		}*/

		rv_academy = rootView.findViewById(R.id.rv_academy);
		rv_event = rootView.findViewById(R.id.rv_event);
		rv_facility = rootView.findViewById(R.id.rv_facility);
		rvEvent = rootView.findViewById(R.id.rv_events);

		tv_facility = rootView.findViewById(R.id.tv_facility);
		tv_event = rootView.findViewById(R.id.tv_event);
		tv_academy = rootView.findViewById(R.id.tv_academy);

		rel_eventSeeAll = rootView.findViewById(R.id.rel_eventSeeAll);
		rel_eventSeeAll.setOnClickListener(V -> {
			Intent intent = new Intent(context, EventSeeAllActivity.class);
			startActivity(intent);
		});
		rvEvent.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL));
		rvEvent.addItemDecoration(new HorizontalSpaceItemDecoration(10));
		setEventData(Utils.getEventData());

		rvFacility = rootView.findViewById(R.id.rv_fac);
		rel_facSeeAll = rootView.findViewById(R.id.rel_facSeeAll);

		rel_facSeeAll.setOnClickListener(v -> {
			Intent intent = new Intent(context, FacilitySeeAllActivity.class);
			startActivity(intent);
		});


		rvFacility.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL));
		rvFacility.addItemDecoration(new HorizontalSpaceItemDecoration(10));
		loaderView.showLoader();
		setFacilityData(Utils.getFacData());
		loaderView.hideLoader();

		rvAcademy = rootView.findViewById(R.id.rv_aca);
		rel_academySeeALL = rootView.findViewById(R.id.rel_academySeeALL);

		rel_academySeeALL.setOnClickListener(v -> {
			Intent intent = new Intent(context, AcademySeeAllActivity.class);
			startActivity(intent);
		});
		rvAcademy.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL));
		rvAcademy.addItemDecoration(new HorizontalSpaceItemDecoration(10));
		setAcademyData(Utils.getAcaData());

		getDashData();
		getDeleteCart();
		return rootView;
	}

	@Override
	public void onResume() {
		super.onResume();
		getDashDataa();
	}

	private void setEventData(CopyOnWriteArrayList<UserEvent> eventList) {

		eventAdapter = new DashEventAdapter(context, eventList, events -> {
			listener.eventClick(events);
		});
		rvEvent.setAdapter(eventAdapter);

	}


	private void setFacilityData(CopyOnWriteArrayList<UserFacAca> facilityList) {

		facilityAdapter = new DashFacilityAdapter(context, facilityList, facility -> {
			listener.facilityClick(facility);
		});
		rvFacility.setAdapter(facilityAdapter);


	}

	private void setAcademyData(CopyOnWriteArrayList<UserFacAca> academyList) {
		academyAdapter = new DashAcademyAdapter(context, academyList, academy -> {
			listener.acadimyClick(academy);
		});
		rvAcademy.setAdapter(academyAdapter);

	}

    /*private void getSportData(){
        CopyOnWriteArrayList<Sport> favSport=new CopyOnWriteArrayList<>();
        favSport.add(new Sport(1,"Football",""));
        favSport.add(new Sport(1,"Cricket",""));
        favSport.add(new Sport(1,"Tennis",""));
        favSport.add(new Sport(1,"Hockey",""));
        favSport.add(new Sport(1,"Badminton",""));
        setData(favSport);
        getSportsData();
    }*/

    /*private void setData(CopyOnWriteArrayList<Sport> list){
        statAdapter = new DashSportAdapter(context, list, () -> {
        });
        rvSports.setAdapter(statAdapter);
    }*/

	private void getSportsData() {
		ModelManager.modelManager().userSports(
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Sport>> genericResponse) -> {
				try {
					CopyOnWriteArrayList<Sport> sports = genericResponse.getObject();
					statAdapter.newData(sports);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
	}

	private void getDashData() {

		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
//        map.put(kAction,"dashbord");
		map.put(kFacLat, ModelManager.modelManager().getCurrentUser().getUserLat());
		map.put(kFacLng, ModelManager.modelManager().getCurrentUser().getUserLng());
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());

		Log.d("send request", map.toString());
		ModelManager.modelManager().userDashBoard(map,
			(Constants.Status iStatus, GenericResponse<UserDashBoard> genericResponse) -> {
				try {
					loaderView.hideLoader();
					UserDashBoard dashBoardData = genericResponse.getObject();


					if (dashBoardData.getAcademies().isEmpty()) {
						rv_academy.setVisibility(View.VISIBLE);


						if(ModelManager.modelManager().getCurrentUser().getUserState().isEmpty()){
							tv_academy.setText("Coming soon in your city"+"\n"+"("+ ModelManager.modelManager().getCurrentUser().getUserCity()+","+ModelManager.modelManager().getCurrentUser().getUserCountry()+")");
						}else{
							tv_academy.setText("Coming soon in your city"+"\n"+"("+ ModelManager.modelManager().getCurrentUser().getUserCity()+","+ModelManager.modelManager().getCurrentUser().getUserState()+","+ModelManager.modelManager().getCurrentUser().getUserCountry()+")");
						}


						rvAcademy.setVisibility(View.GONE);
					} else {
						academyAdapter.newData(dashBoardData.getAcademies());
						rv_academy.setVisibility(View.GONE);
						rvAcademy.setVisibility(View.VISIBLE);

					}


					if (dashBoardData.getFacilities().isEmpty()) {
						rv_facility.setVisibility(View.VISIBLE);

						if(ModelManager.modelManager().getCurrentUser().getUserState().isEmpty()){
							tv_facility.setText("Coming soon in your city"+"\n"+"("+ ModelManager.modelManager().getCurrentUser().getUserCity()+","+ModelManager.modelManager().getCurrentUser().getUserCountry()+")");
						}else{
							tv_facility.setText("Coming soon in your city"+"\n"+"("+ ModelManager.modelManager().getCurrentUser().getUserCity()+","+ModelManager.modelManager().getCurrentUser().getUserState()+","+ModelManager.modelManager().getCurrentUser().getUserCountry()+")");
						}


						rvFacility.setVisibility(View.GONE);
					} else {
						facilityAdapter.newData(dashBoardData.getFacilities());
						rv_facility.setVisibility(View.GONE);
						rvFacility.setVisibility(View.VISIBLE);
					}

					if (dashBoardData.getEvents().isEmpty()) {
						rv_event.setVisibility(View.VISIBLE);


						if(ModelManager.modelManager().getCurrentUser().getUserState().isEmpty()){
							tv_event.setText("Coming soon in your city"+"\n"+"("+ ModelManager.modelManager().getCurrentUser().getUserCity()+","+ModelManager.modelManager().getCurrentUser().getUserCountry()+")");
						}else{
							tv_event.setText("Coming soon in your city"+"\n"+"("+ ModelManager.modelManager().getCurrentUser().getUserCity()+","+ModelManager.modelManager().getCurrentUser().getUserState()+","+ModelManager.modelManager().getCurrentUser().getUserCountry()+")");
						}

						rvEvent.setVisibility(View.GONE);
					} else {
						eventAdapter.newData(dashBoardData.getEvents());
						rv_event.setVisibility(View.GONE);
						rvEvent.setVisibility(View.VISIBLE);
					}

				} catch (Exception e) {
					e.printStackTrace();
				}
				loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			}
		);
	}


	private void getDashDataa() {

		//loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
//        map.put(kAction,"dashbord");
		map.put(kFacLat, ModelManager.modelManager().getCurrentUser().getUserLat());
		map.put(kFacLng, ModelManager.modelManager().getCurrentUser().getUserLng());
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());

		Log.d("send request", map.toString());
		ModelManager.modelManager().userDashBoard(map,
			(Constants.Status iStatus, GenericResponse<UserDashBoard> genericResponse) -> {
				try {
					//loaderView.hideLoader();
					UserDashBoard dashBoardData = genericResponse.getObject();

					facilityAdapter.newData(dashBoardData.getFacilities());
					academyAdapter.newData(dashBoardData.getAcademies());
					eventAdapter.newData(dashBoardData.getEvents());
				} catch (Exception e) {
					e.printStackTrace();
				}
				//loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {//loaderView.hideLoader();
				Toaster.customToast(message);
			}
		);
	}

	public void setEventClickListener(EventClickListener listener) {
		this.listener = listener;
	}

	public interface EventClickListener {
		void facilityClick(UserFacAca model);

		void acadimyClick(UserFacAca model);

		void eventClick(UserEvent event);
	}


	private void getDeleteCart() {

		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		Log.e("e", map.toString());
		ModelManager.modelManager().getDeletecart(map,
			(Constants.Status iStatus, GenericResponse<JSONObject> genericResponse) -> {
				loaderView.hideLoader();
				try {
					String msg=genericResponse.getObject().getString(kResponseMessage);
					//Toaster.customToast(msg);

				} catch (Exception e) {
					e.printStackTrace();
				}

			}, (Constants.Status iStatus, String message) -> {
				Toaster.customToast(message);
			});


	}
}
