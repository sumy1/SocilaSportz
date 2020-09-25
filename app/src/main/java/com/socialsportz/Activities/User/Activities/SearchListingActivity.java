package com.socialsportz.Activities.User.Activities;

import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.google.android.gms.common.api.Status;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.libraries.places.api.model.AddressComponent;
import com.google.android.libraries.places.api.model.Place;
import com.google.android.libraries.places.api.model.TypeFilter;
import com.google.android.libraries.places.widget.Autocomplete;
import com.google.android.libraries.places.widget.AutocompleteActivity;
import com.google.android.libraries.places.widget.model.AutocompleteActivityMode;
import com.google.android.material.chip.Chip;
import com.google.android.material.chip.ChipGroup;
import com.mancj.slideup.SlideUp;
import com.mancj.slideup.SlideUpBuilder;
import com.socialsportz.Activities.User.Adapters.SearchEventAdapter;
import com.socialsportz.Activities.User.Adapters.SearchFacAcaAdapter;
import com.socialsportz.Activities.User.Adapters.SearchSportsAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.DropDownRating;
import com.socialsportz.Models.User.EventListing;
import com.socialsportz.Models.User.UserEvent;
import com.socialsportz.Models.User.UserEventdata;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.Models.User.UserFacility;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static android.Manifest.permission.ACCESS_COARSE_LOCATION;
import static android.Manifest.permission.ACCESS_FINE_LOCATION;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_LOCATION;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSION_LOCATION;
import static com.socialsportz.Constants.Constants.kAction;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel1;
import static com.socialsportz.Constants.Constants.kAmenityId;
import static com.socialsportz.Constants.Constants.kAmenityIds;
import static com.socialsportz.Constants.Constants.kCity;
import static com.socialsportz.Constants.Constants.kFacLat;
import static com.socialsportz.Constants.Constants.kFacLng;
import static com.socialsportz.Constants.Constants.kGCountry;
import static com.socialsportz.Constants.Constants.kLocality;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kPostalCode;
import static com.socialsportz.Constants.Constants.kRating;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kSportName;
import static com.socialsportz.Constants.Constants.kUserId;

public class SearchListingActivity extends AppCompatActivity {
    private static final String TAG = SearchListingActivity.class.getSimpleName();
    private ChipGroup chipGroup;
    private String City = "", Action = "", SportsName = "";
    private int ratingId,SposrtId,amenitiesId;
    //private String[] chipArray = new String[3];;


    private ArrayList<String>chipArray=new ArrayList<>();;
    private RecyclerView rvList;
    private SlideUp slideUp;
    private View dim, rootView;
    private View slideView;
    Bundle bundle;
    UserFacility userFacility;
    CopyOnWriteArrayList<UserFacAca> mdata = new CopyOnWriteArrayList<>();
    DropDownView drop_sport, drop_ameneties, drop_rating, drop_location;
    ArrayList<DataModel> options_sport = new ArrayList<>();
    ArrayList<DataModel> options_amenities = new ArrayList<>();
    ArrayList<DataModel> options_rating = new ArrayList<>();
    private double latitude = 0.0, longitude = 0.0;
    private String city = "", state = "", country = "India", action = "", pincode = "",sportId="",sportsName="";
    private ProgressBar progressGPS;
    Dialog dialog;
    TextView tv_location,tv_cart_name;
    CustomLoaderView loaderView;
    Context context;
    RecyclerView rv_amenities;
    SearchSportsAdapter favSportsAdapter;
    JSONArray jsonArray;
    UserEventdata userEventdata;
    CopyOnWriteArrayList<EventListing> eventListings = new CopyOnWriteArrayList<>();
    RelativeLayout rv_cart;
    private Chip chip1,chip2,chip3;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_listing);
        setStatusBarGradient(SearchListingActivity.this);
        context=this;
        loaderView= CustomLoaderView.initialize(this);
        getIntentvalue();


        inItView();
        getSportsData();
        getAmenitiesData();



    }


	public static JSONArray generateJsonArraySports() {
		JSONArray list = new JSONArray();

		try {
			JSONObject obj = new JSONObject();
			obj.put(kAmenityId, "");
			list.put(obj);
		} catch (JSONException e1) {
			e1.printStackTrace();
		}

		return list;
	}

    @SuppressLint("WrongViewCast")
	private void inItView(){


		chipGroup = findViewById(R.id.chip_group);
		chip1=findViewById(R.id.chip1);
		chip1.setCloseIconEnabled(false);;
		chip2=findViewById(R.id.chip2);
		chip2.setCloseIconEnabled(false);;
		chip3=findViewById(R.id.chip3);
		chip3.setCloseIconEnabled(false);;
		chip1.setText(City);

		chip2.setText(Action);

		chip3.setText(SportsName);



		/*chipArray.add(City);
		chipArray.add(Action);
		chipArray.add(SportsName);*/
/*		chipArray[0] = City;
		chipArray[1] = Action;
		chipArray[2] = SportsName;*/
		//addChipSet();
		rv_cart=findViewById(R.id.rv_cart);
		tv_cart_name=findViewById(R.id.tv_cart_name);
        findViewById(R.id.ib_back).setOnClickListener(v -> finish());

      /*  findViewById(R.id.lay_sort).setOnClickListener(v -> {
            RoundBottomSheetDialogFragment bottomSheetFragment = new RoundBottomSheetDialogFragment();
            bottomSheetFragment.show(getSupportFragmentManager(), bottomSheetFragment.getTag());
        });*/

        findViewById(R.id.lay_filter).setOnClickListener(v -> {
            slideUp.show();
        });

        rvList = findViewById(R.id.rv_filter);
        rvList.setLayoutManager(new LinearLayoutManager(this, RecyclerView.VERTICAL, false));
        rvList.addItemDecoration(new SpaceItemDecoration(20));

        if(Action.equalsIgnoreCase("event")){

			if(eventListings.size()==0){
				rv_cart.setVisibility(View.VISIBLE);

				tv_cart_name.setText("Coming soon in your city"+"\n"+"("+City+")");

				rvList.setVisibility(View.GONE);
			}else{
				rv_cart.setVisibility(View.GONE);
				rvList.setVisibility(View.VISIBLE);
				setEventData();
			}


        }else{

			if(mdata.size()==0){
				rv_cart.setVisibility(View.VISIBLE);
				tv_cart_name.setText("Coming soon in your city"+"\n"+"("+City+")");
				rvList.setVisibility(View.GONE);
			}else{
				rv_cart.setVisibility(View.GONE);
				rvList.setVisibility(View.VISIBLE);
				setFacilityData();
			}


        }


        //setEventData();

        rootView = findViewById(R.id.root_view);
        slideView = findViewById(R.id.slideView);

        //.......add sports..
        drop_sport = findViewById(R.id.drop_sport);

		options_sport.add(new DataModel(SposrtId,SportsName));
		drop_sport.setText(SportsName);
		//drop_sport.setOptionList(options_sport);
        setSportDropDown(drop_sport);

        //.........add amenities..

        rv_amenities = findViewById(R.id.rv_amenities);
        rv_amenities.setLayoutManager(new LinearLayoutManager(context, RecyclerView.VERTICAL, false));
        rv_amenities.addItemDecoration(new SpaceItemDecoration(5));
        rv_amenities.setHasFixedSize(true);

        drop_rating = findViewById(R.id.drop_rating);

        setRatingDropDown(drop_rating);


        tv_location = findViewById(R.id.tv_location);
        tv_location.setOnClickListener(v -> {
            chooseLocation();
        });



        findViewById(R.id.btn_apply).setOnClickListener(v->{
            jsonArray=favSportsAdapter.getAray();

            //jsonArray=generateJsonArraySports();

            Log.d("jsonarray",jsonArray.toString());

			if(Action.equalsIgnoreCase("event")){
				getSearchListingg();
			}else{
				getSearchListing();
			}

            Log.d("array",jsonArray+"");



         /*   if (validate()) {

                if(Action.equalsIgnoreCase("event")){
                    getSearchListingg();
                }else{
                    getSearchListing();
                }


            }*/

        });

        dim = findViewById(R.id.dim);

        //slideUp.hideImmediately();
        slideUp = new SlideUpBuilder(slideView)
                .withListeners(new SlideUp.Listener.Events() {
                    @Override
                    public void onSlide(float percent) {
                        dim.setAlpha(1 - (percent / 100));
                        if (percent < 100) {
                            // slideUp started showing

                        }
                    }

                    @Override
                    public void onVisibilityChanged(int visibility) {
                        if (visibility == View.GONE) {
                        }
                    }
                })
                .withStartGravity(Gravity.BOTTOM)
                .withLoggingEnabled(true)
                .withStartState(SlideUp.State.HIDDEN)
                .withSlideFromOtherView(rootView)
                .build();

		tv_location.setText(City);


    }



	private void getIntentvalue(){
        if (getIntent() != null) {
            City = getIntent().getStringExtra(Constants.kCity);
            Action = capitizeString(getIntent().getStringExtra(Constants.kAction));
            SportsName = getIntent().getStringExtra(Constants.kSportName);
            SposrtId= Integer.parseInt(getIntent().getStringExtra("SPORTID"));

            latitude= Double.parseDouble(ModelManager.modelManager().getCurrentUser().getUserLat());
            longitude= Double.parseDouble(ModelManager.modelManager().getCurrentUser().getUserLng());
			//City=ModelManager.modelManager().getCurrentUser().getUserCity();

            Log.d("event",Action);

            if(Action.equalsIgnoreCase("event")){

                userEventdata=(UserEventdata) getIntent().getSerializableExtra("bundleUserFac");
                eventListings=userEventdata.getEventListing();




            }else{
                userFacility = (UserFacility) getIntent().getSerializableExtra("bundleUserFac");
                mdata = userFacility.getFacilities();
            }


            ;

            Log.d("SportId",SposrtId+"");

        }
    }

    private String capitizeString(String name){
        String captilizedString="";
        if(!name.trim().equals("")){
            captilizedString = name.substring(0,1).toUpperCase() + name.substring(1);
        }
        return captilizedString;
    }

    private void addChipSet() {
        for (int i = 0; i < chipArray.size(); i++) {
            Chip chip = new Chip(this);
            chip.setText(chipArray.get(i));
            chip.setCloseIconEnabled(false);
            chip.setChipBackgroundColorResource(R.color.black_light_transparent);
            chip.setTextSize(13f);
            chip.setElevation(5);
            //chip.setCheckedIconVisible(false);

            chipGroup.addView(chip);
        }
    }


    private void setFacilityData() {
        SearchFacAcaAdapter facilityAdapter = new SearchFacAcaAdapter(this, mdata,SportsName,String.valueOf(SposrtId),Action);
        rvList.setAdapter(facilityAdapter);
    }

    private void setEventData() {
        SearchEventAdapter eventAdapter = new SearchEventAdapter(this, eventListings);
        rvList.setAdapter(eventAdapter);
    }

    private CopyOnWriteArrayList<UserEvent> getEventData() {
        CopyOnWriteArrayList<UserEvent> data = new CopyOnWriteArrayList<>();
        data.add(new UserEvent(R.drawable.running_event));
        data.add(new UserEvent(R.drawable.running_event));
        data.add(new UserEvent(R.drawable.running_event));
        return data;
    }

    @TargetApi(Build.VERSION_CODES.LOLLIPOP)
    public static void setStatusBarGradient(Activity activity) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            Window window = activity.getWindow();
            Drawable background = activity.getResources().getDrawable(R.drawable.canvas_red_gradient);
            window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            window.setStatusBarColor(activity.getResources().getColor(android.R.color.transparent));
            window.setNavigationBarColor(activity.getResources().getColor(android.R.color.transparent));
            window.setBackgroundDrawable(background);
        }
    }




    @RequiresApi(api = Build.VERSION_CODES.M)
    private void requestPermission() {
        // We've never asked. Just do it.
        requestPermissions(new String[]{ACCESS_FINE_LOCATION, ACCESS_COARSE_LOCATION}, REQUEST_PERMISSION_LOCATION);
    }

    @RequiresApi(api = Build.VERSION_CODES.M)
    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        if (requestCode == REQUEST_PERMISSION_LOCATION) {
            if (grantResults[0] == PackageManager.PERMISSION_GRANTED
                    && grantResults[1] == PackageManager.PERMISSION_GRANTED) {
                chooseLocation();
            } else if (ActivityCompat.shouldShowRequestPermissionRationale(this, ACCESS_FINE_LOCATION)
                    && ActivityCompat.shouldShowRequestPermissionRationale(this, ACCESS_COARSE_LOCATION)) {
                // We've been denied once before. Explain why we need the permission, then ask again.
                Utils.showDialog(this, getString(R.string.location_permission_required_text),
                        getString(R.string.ask_permission_text), getString(R.string.discard_text),
                        (dialog, which) -> {
                            if (which == -1)
                                requestPermission();
                            else
                                dialog.dismiss();
                        });
            } else if (!ActivityCompat.shouldShowRequestPermissionRationale(this, ACCESS_FINE_LOCATION)
                    && !ActivityCompat.shouldShowRequestPermissionRationale(this, ACCESS_COARSE_LOCATION)) {
                // We've been denied for all. Explain why we need the permission, then ask again.
                showDialog();
            }
        }
    }

    private void showDialog() {
        dialog = new Dialog(SearchListingActivity.this);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        dialog.setCancelable(false);
        dialog.setContentView(R.layout.dialog_permission_setting);

        TextView text = dialog.findViewById(R.id.tv_dialog);
        text.setText(kLocationPermissionMsg);

        Button dialogButton = dialog.findViewById(R.id.btn_dialog);
        dialogButton.setOnClickListener(v -> {
            Intent intent = new Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS);
            Uri uri = Uri.fromParts("package", getApplicationContext().getPackageName(), null);
            intent.setData(uri);
            startActivityForResult(intent, PERMISSIONS_REQUEST);
        });
        dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

        dialog.show();
    }

    private boolean checkSelfPermission() {
        return ContextCompat.checkSelfPermission(this, ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED
                && ContextCompat.checkSelfPermission(this, ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED;
    }

    public void chooseLocation() {

    	ModelManager.modelManager().getCurrentUser().getAmenities();
        List<Place.Field> fields = Arrays.asList(Place.Field.ID, Place.Field.NAME,
                Place.Field.ADDRESS_COMPONENTS, Place.Field.ADDRESS, Place.Field.LAT_LNG, Place.Field.TYPES);

        // Start the autocomplete intent.
        Intent intent = new Autocomplete.IntentBuilder(
                AutocompleteActivityMode.OVERLAY, fields)
                .setCountry("IN")
                .setTypeFilter(TypeFilter.REGIONS)
                .build(this);
        startActivityForResult(intent, REQUEST_LOCATION);
    }
    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == REQUEST_LOCATION) {
            /*if(resultCode == RESULT_OK){
                // Get the user's selected place from the Intent.
                String id = data.getStringExtra("id");
                String address = data.getStringExtra("address");
                tvAddress.setText(address);
                tvAddress.setTag(id);
            }*/
            if (resultCode == RESULT_OK) {
                Place place = Autocomplete.getPlaceFromIntent(data);

                LatLng ln = place.getLatLng();
                assert ln != null;
                latitude = ln.latitude;
                longitude = ln.longitude;

                List<AddressComponent> list = Objects.requireNonNull(place.getAddressComponents()).asList();
                for (int i = 0; i < list.size(); i++) {
                    AddressComponent comp = list.get(i);
                    switch (comp.getTypes().get(0)) {
                        case kLocality:
							//City = comp.getName();
                            break;
                        case kAdministrativeAreaLevel1:
                            state = comp.getName();
                            break;
                        case kGCountry:
                            country = comp.getName();
                            break;
                        case kPostalCode:
                            pincode = comp.getName();
                            break;
                    }
                }

                tv_location.setText(place.getAddress());


				//chipArray.set(0,City);
				//chipArray[1] = Action;
				//chipArray[2] = SportsName;
				//addChipSet();
				chip1.setText(place.getAddress());
				City=place.getAddress();
                Log.i(TAG, "Place Id: " + place.getId() + ", Place: " + place.getAddress() + ", LatLng:"
                        + latitude + ":" + longitude + ", city:" + city + ", state:" + state + ", country:" + country);
            } else if (resultCode == AutocompleteActivity.RESULT_ERROR) {
                Status status = Autocomplete.getStatusFromIntent(data);
                assert status.getStatusMessage() != null;
                Log.i(TAG, status.getStatusMessage());
            }
        } else if (requestCode == PERMISSIONS_REQUEST) {
            if (checkSelfPermission()) {
                dialog.dismiss();
            }
        }
    }


    private void getSportsData(){
        ModelManager.modelManager().userSports(
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Sport>> genericResponse) -> {
                    try {
                        CopyOnWriteArrayList<Sport> sports = genericResponse.getObject();
                        //statAdapter.newData(sports);


                        for(int i=0;i<sports.size();i++){
                            options_sport.add(new DataModel(sports.get(i).getSportId(),sports.get(i).getSportName()));
                        }
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
    }


    private void getAmenitiesData(){
        ModelManager.modelManager().userMasterAmenities(
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Amenity>> genericResponse) -> {
                    try {
                        CopyOnWriteArrayList<Amenity> sports = genericResponse.getObject();

                        setSportData(sports);
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
    }




    private void setSportDropDown(DropDownView rootView){

        rootView.setOptionList(options_sport);
        rootView.setClickListener(new DropDownView.onClickInterface() {
            @Override
            public void onClickAction() { }

            @Override
            public void onClickDone(int id, String name) {

                SposrtId=id;
                SportsName=name;
				chip3.setText(SportsName);

				/*chipArray[0] = City;
				chipArray[1] = Action;*/
				//chipArray.set(chipArray.indexOf(SportsName),SportsName);
				//addChipSet();
                Log.e("SposrtId",SposrtId+"");


            }

            @Override
            public void onDismiss() { }
        });

    }


    private void addRating(){
        CopyOnWriteArrayList<DropDownRating> dropDownRatings=new CopyOnWriteArrayList<>();
        dropDownRatings.add(new DropDownRating(5,"5 stars"));
        dropDownRatings.add(new DropDownRating(4,"4 stars & above"));
        dropDownRatings.add(new DropDownRating(3,"3 stars & above"));
        dropDownRatings.add(new DropDownRating(2,"2 stars & above "));
        dropDownRatings.add(new DropDownRating(1,"1 star & above"));
        for(int i=0;i<dropDownRatings.size();i++){
            options_rating.add(new DataModel(dropDownRatings.get(i).getId(),dropDownRatings.get(i).getRating_name()));
        }

    }

    private void setRatingDropDown(DropDownView rootView){
        addRating();
        rootView.setOptionList(options_rating);
        rootView.setClickListener(new DropDownView.onClickInterface() {
            @Override
            public void onClickAction() { }

            @Override
            public void onClickDone(int id, String name) {
                ratingId=id;
                Log.e("ratingId",ratingId+"");


            }

            @Override
            public void onDismiss() { }
        });
    }

    private void setSportData(CopyOnWriteArrayList<Amenity>mdata) {
         favSportsAdapter = new SearchSportsAdapter(context, mdata);
        rv_amenities.setAdapter(favSportsAdapter);


    }
    private boolean validate() {
        boolean isOk = true;

        if (drop_sport.getText().toString().isEmpty()) {
            Toaster.customToast("Please select Sports!");
            isOk = false;
        } /*else if (jsonArray.length()==0) {
            Toaster.customToast("Please select Amenities!");
            isOk = false;
        }else if(drop_rating.getText().toString().isEmpty()){
            Toaster.customToast("Please select Rating!");
            isOk = false;
        }else if(tv_location.getText().toString().isEmpty()){
            Toaster.customToast("Please choose Location!");
            isOk = false;
        }*/

        return isOk;
    }

    private void getSearchListing(){
        loaderView.showLoader();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kAction, Action);
        map.put(kFacLat, latitude);
        map.put(kFacLng, longitude);
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        map.put(kSportId,SposrtId);
        map.put(kSportName,SportsName);
        map.put(kCity,City);
		if(jsonArray.length()==0){
			jsonArray=generateJsonArraySports();
			Log.d("log",jsonArray+"");
			map.put(kAmenityIds,generateJsonArraySports());

		}else{
			map.put(kAmenityIds,jsonArray);
		}
        map.put(kRating,ratingId);
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userSearchList(map,
                (Constants.Status iStatus, GenericResponse<UserFacility> genericResponse) -> {

                    try {
                        loaderView.hideLoader();
                        UserFacility dashBoardData = genericResponse.getObject();
                        mdata=dashBoardData.getFacilities();

						//chipArray.set(chipArray.indexOf(Action),Action);


                        setFacilityData();

                        //Log.d("size",mdata.size()+"");

						if(mdata.size()==0){
							rv_cart.setVisibility(View.VISIBLE);

							tv_cart_name.setText("Coming soon in your city"+"\n"+"("+City+")");
							rvList.setVisibility(View.GONE);
						}
                        slideUp.hide();
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                    loaderView.hideLoader();
                }, (Constants.Status iStatus, String message) -> {});
    }

    private void getSearchListingg(){
        loaderView.showLoader();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kAction, Action);
        map.put(kFacLat, latitude);
        map.put(kFacLng, longitude);
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        map.put(kSportId,SposrtId);
        map.put(kSportName,SportsName);
        map.put(kCity,City);

		if(jsonArray.length()==0){
            jsonArray=generateJsonArraySports();
			Log.d("log",jsonArray+"");
			map.put(kAmenityIds,generateJsonArraySports());

		}else{
			map.put(kAmenityIds,jsonArray);
		}

        map.put(kRating,ratingId);
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userEventSearchList(map,
                (Constants.Status iStatus, GenericResponse<UserEventdata> genericResponse) -> {

                    try {
                        loaderView.hideLoader();
                        UserEventdata dashBoardData = genericResponse.getObject();
                        eventListings=dashBoardData.getEventListing();
                        setEventData();
						//chipArray.set(chipArray.indexOf(Action),Action);


						if(eventListings.size()==0){
							rv_cart.setVisibility(View.VISIBLE);

							tv_cart_name.setText("Coming soon in your city"+"\n"+"("+City+")");


							rvList.setVisibility(View.GONE);
						}
                        slideUp.hide();
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                    loaderView.hideLoader();
                }, (Constants.Status iStatus, String message) -> {});
    }




}
