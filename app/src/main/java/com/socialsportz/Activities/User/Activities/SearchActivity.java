package com.socialsportz.Activities.User.Activities;

import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.drawable.Drawable;
import android.location.Address;
import android.location.Geocoder;
import android.location.LocationManager;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;

import com.google.android.gms.common.api.Status;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.libraries.places.api.model.AddressComponent;
import com.google.android.libraries.places.api.model.Place;
import com.google.android.libraries.places.api.model.TypeFilter;
import com.google.android.libraries.places.widget.Autocomplete;
import com.google.android.libraries.places.widget.AutocompleteActivity;
import com.google.android.libraries.places.widget.model.AutocompleteActivityMode;
import com.socialsportz.Activities.User.Adapters.FavSportsSearchAdapter;
import com.socialsportz.Blocks.Block;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.DispatchQueue.DispatchQueue;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.UserEventdata;
import com.socialsportz.Models.User.UserFacility;
import com.socialsportz.R;
import com.socialsportz.Services.GPSTracker;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
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
import static com.socialsportz.Constants.Constants.kAddress;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel1;
import static com.socialsportz.Constants.Constants.kCity;
import static com.socialsportz.Constants.Constants.kCountry;
import static com.socialsportz.Constants.Constants.kFacLat;
import static com.socialsportz.Constants.Constants.kFacLng;
import static com.socialsportz.Constants.Constants.kGCountry;
import static com.socialsportz.Constants.Constants.kLocality;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kPincode;
import static com.socialsportz.Constants.Constants.kPostalCode;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kSportName;
import static com.socialsportz.Constants.Constants.kState;
import static com.socialsportz.Constants.Constants.kUserId;

public class SearchActivity extends AppCompatActivity {

    private static final String TAG = SearchActivity.class.getSimpleName();
    RecyclerView recyclerView;
    private double latitude = 0.0, longitude = 0.0;
    private String city = "", fullAddress="",state = "", country = "India", action = "", pincode = "",sportId="",sportsName="";
    private ProgressBar progressGPS;
    Dialog dialog;
    Context context;
    TextView tv_location;

    LocationManager locationManager;
    boolean GpsStatus;
    LinearLayout search_toolbar;
    RadioGroup radio_typeGroup;
    RadioButton radioButton_type;
    FavSportsSearchAdapter favSportsAdapter;
    private CustomLoaderView loaderView;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_search_user);
        setStatusBarGradient(SearchActivity.this);
        loaderView = CustomLoaderView.initialize(this);
        context = this;
        inItView();
    }

    public String getSelecedTypeResult() {
        int selectedId = radio_typeGroup.getCheckedRadioButtonId();

        // find the radiobutton by returned id
        radioButton_type = (RadioButton) findViewById(selectedId);

        action = radioButton_type.getText().toString();

        Log.d("action", action);
        return action;
    }

    public void inItView() {
        findViewById(R.id.ib_back).setOnClickListener(view -> finish());
        radio_typeGroup = findViewById(R.id.radio_typeGroup);
        recyclerView = findViewById(R.id.rv_sports);
        //recyclerView.addItemDecoration(new SpaceItemDecoration(20));
        recyclerView.setLayoutManager(new LinearLayoutManager(SearchActivity.this, RecyclerView.HORIZONTAL, false));
		getSportsData();


        findViewById(R.id.btn_search).setOnClickListener(v -> {

            if (validate()) {
                action = getSelecedTypeResult().toLowerCase();

                Log.d("action",action);

                if(action.equalsIgnoreCase("event")){
                    getEventSearchListing(action, latitude, longitude);
                }else{
                    getSearchListing(action, latitude, longitude);
                }

                Log.d("Action", action);

            }

        });

        findViewById(R.id.btn_find_location).setOnClickListener(v -> {
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M)
                checkGPSAccess();
            else
                getLocation();
        });


        findViewById(R.id.search_toolbar).setOnClickListener(v -> finish());

        tv_location = findViewById(R.id.tv_location);
        tv_location.setOnClickListener(v -> {
            chooseLocation();
        });

        progressGPS = findViewById(R.id.progressBar);
    }


    public void chooseLocation() {
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

                Log.d("Places",place.toString());

                LatLng ln = place.getLatLng();
                assert ln != null;
                latitude = ln.latitude;
                longitude = ln.longitude;

                List<AddressComponent> list = Objects.requireNonNull(place.getAddressComponents()).asList();
                for (int i = 0; i < list.size(); i++) {
                    AddressComponent comp = list.get(i);
                    switch (comp.getTypes().get(0)) {
                        case kLocality:
                            city = comp.getName();
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
				fullAddress=place.getAddress();
                tv_location.setText(place.getAddress());
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


    @SuppressLint("MissingPermission")
    private void getLocation() {
        showProgressBar(true);
        GPSTracker gps = new GPSTracker(this);
        // check if GPS enabled
        if (gps.canGetLocation()) {
            showProgressBar(false);
            latitude = gps.getLatitude();
            longitude = gps.getLongitude();

            Log.d("lat/Long", latitude + "/" + longitude);

            getAddress(latitude, longitude);
        } else {
            showProgressBar(false);
            Utils.showAlertDialog(this, "Error!",
                    "Sorry unable to get current location. Make sure your GPS is ON!",
                    (dialogInterface, i) -> {
                        /*Intent intent=new Intent("android.location.GPS_ENABLED_CHANGE");
                        intent.putExtra("enabled", true);
                        sendBroadcast(intent);*/
                        String provider = Settings.Secure.getString(getContentResolver(), Settings.Secure.LOCATION_PROVIDERS_ALLOWED);
                        if (!provider.contains("gps")) { //if gps is disabled
                            final Intent poke = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                            poke.setClassName("com.android.settings", "com.android.settings.widget.SettingsAppWidgetProvider");
                            poke.addCategory(Intent.CATEGORY_ALTERNATIVE);
                            poke.setData(Uri.parse("3"));
                            sendBroadcast(poke);
                        }
                    });
        }
    }

    public void getAddress(double latitude, double longitude) {
        showProgressBar(true);
        getFullAddress(latitude, longitude, (iStatus, response) -> {
            showProgressBar(false);
            HashMap<String, String> map = response.getObject();
            city = map.get(kCity);
            state = map.get(kState);
            country = map.get(kCountry);
            pincode = map.get(kPincode);
            tv_location.setText(map.get(kCity));
            Log.i(TAG, "getting address success");
        }, (iStatus, error) -> {
            showProgressBar(false);
            Toaster.kalaToast("Unable to Get Location. Check Connection");
        });

    }

    public void getFullAddress(double latitude, double longitude, Block.Success<HashMap<String, String>> success, Block.Failure failure) {
        ModelManager.modelManager().getDispatchQueue().async(() -> {
            try {
                String address;
                HashMap<String, String> map = new HashMap<>();
                Geocoder geocoder = new Geocoder(getApplicationContext(), Locale.getDefault());
                List<Address> listAddresses = geocoder.getFromLocation(latitude, longitude, 1);
                if (listAddresses != null && listAddresses.size() > 0) {
                    address = listAddresses.get(0).getLocality() + ", " + listAddresses.get(0).getAdminArea() + ", " + listAddresses.get(0).getCountryName();
                    map.put(kCity, listAddresses.get(0).getLocality());
                    map.put(kState, listAddresses.get(0).getAdminArea());
                    map.put(kCountry, listAddresses.get(0).getCountryName());
                    map.put(kPincode, listAddresses.get(0).getPostalCode());
                    map.put(kAddress, address);
                }
                GenericResponse<HashMap<String, String>> genericResponse = new GenericResponse<>(map);
                DispatchQueue.main(() -> success.iSuccess(Constants.Status.success, genericResponse));
            } catch (Exception e) {
                DispatchQueue.main(() -> failure.iFailure(Constants.Status.fail, e.getMessage()));
            }
        });
    }


    private void showProgressBar(boolean b) {
        if (b) {
            progressGPS.setVisibility(View.VISIBLE);
        } else {
            progressGPS.setVisibility(View.GONE);
        }
    }


    private boolean checkSelfPermission() {
        return ContextCompat.checkSelfPermission(this, ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED
                && ContextCompat.checkSelfPermission(this, ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED;
    }

    @TargetApi(Build.VERSION_CODES.M)
    @RequiresApi(api = Build.VERSION_CODES.M)
    private void checkGPSAccess() {
        if (checkSelfPermission()) {
            getLocation();
        } else {
            requestPermission();
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
                getLocation();
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
        dialog = new Dialog(SearchActivity.this);
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

    private void initRecyclerView(CopyOnWriteArrayList<Sport> sports) {


        Log.d("size",sports.size()+"");
        favSportsAdapter = new FavSportsSearchAdapter(SearchActivity.this, sports, new FavSportsSearchAdapter.OnItemClickListner() {
            @Override
            public void selectSport(String id, String name) {
                sportId=id;
                sportsName=name;
            }
        });
        recyclerView.setAdapter(favSportsAdapter);
    }

	private void getSportsData(){
		ModelManager.modelManager().userSports(
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Sport>> genericResponse) -> {
				try {
					CopyOnWriteArrayList<Sport> sports = genericResponse.getObject();
					initRecyclerView(sports);
					//statAdapter.newData(sports);

				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
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

    private boolean validate() {
        boolean isOk = true;

        if (Utils.getProperText(tv_location).isEmpty()) {
            Toaster.customToast("Please choose location!");
            isOk = false;
        } else if (favSportsAdapter.getSportsSelectionStatus()) {
            Toaster.customToast("Please select Sports!");
            isOk = false;
        }

        return isOk;
    }



    private void getSearchListing(String action, Double latitude, Double longitude){
        loaderView.showLoader();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kAction, action);
        map.put(kFacLat, latitude);
        map.put(kFacLng, longitude);
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        map.put(kSportId,sportId);
        map.put(kSportName,sportsName);
        map.put(kCity,city);
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userSearchList(map,
                (Constants.Status iStatus, GenericResponse<UserFacility> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        UserFacility dashBoardData = genericResponse.getObject();

                        Intent intent=new Intent(SearchActivity.this,SearchListingActivity.class);
                        intent.putExtra("bundleUserFac",dashBoardData);
                        intent.putExtra(kAction,action);
                        intent.putExtra(kSportName,sportsName);
                        intent.putExtra(kCity,fullAddress);
                        intent.putExtra("SPORTID",sportId);
                        startActivity(intent);
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                    loaderView.hideLoader();
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
    }

    private void getEventSearchListing(String action, Double latitude, Double longitude){
        loaderView.showLoader();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kAction, action);
        map.put(kFacLat, latitude);
        map.put(kFacLng, longitude);
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        map.put(kSportId,sportId);
        map.put(kSportName,sportsName);
        map.put(kCity,city);
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userEventSearchList(map,
                (Constants.Status iStatus, GenericResponse<UserEventdata> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        UserEventdata userEventdata = genericResponse.getObject();

                        Intent intent=new Intent(SearchActivity.this,SearchListingActivity.class);
                        intent.putExtra("bundleUserFac", userEventdata);
                        intent.putExtra(kAction,action);
                        intent.putExtra(kSportName,sportsName);
                        intent.putExtra(kCity,fullAddress);
                        intent.putExtra("SPORTID",sportId);
                        startActivity(intent);
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                    loaderView.hideLoader();
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
    }


}
