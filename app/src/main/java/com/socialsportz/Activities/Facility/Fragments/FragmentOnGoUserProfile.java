package com.socialsportz.Activities.Facility.Fragments;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.TextView;

import com.google.android.gms.common.api.Status;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.libraries.places.api.model.AddressComponent;
import com.google.android.libraries.places.api.model.Place;
import com.google.android.libraries.places.api.model.TypeFilter;
import com.google.android.libraries.places.widget.Autocomplete;
import com.google.android.libraries.places.widget.AutocompleteActivity;
import com.google.android.libraries.places.widget.model.AutocompleteActivityMode;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.Validations;

import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.SwitchCompat;
import androidx.fragment.app.Fragment;

import static android.app.Activity.RESULT_OK;
import static com.socialsportz.Constants.Constants.REQUEST_LOCATION;
import static com.socialsportz.Constants.Constants.kAddress;
import static com.socialsportz.Constants.Constants.kAddress2;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel1;
import static com.socialsportz.Constants.Constants.kCity;
import static com.socialsportz.Constants.Constants.kCountry;
import static com.socialsportz.Constants.Constants.kEmail;
import static com.socialsportz.Constants.Constants.kGCountry;
import static com.socialsportz.Constants.Constants.kGender;
import static com.socialsportz.Constants.Constants.kLatitude;
import static com.socialsportz.Constants.Constants.kLocality;
import static com.socialsportz.Constants.Constants.kLongitude;
import static com.socialsportz.Constants.Constants.kPhone;
import static com.socialsportz.Constants.Constants.kPincode;
import static com.socialsportz.Constants.Constants.kPostalCode;
import static com.socialsportz.Constants.Constants.kStreetAddress;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kUserName;

public class FragmentOnGoUserProfile extends Fragment implements View.OnClickListener {

    private static String TAG = FragmentOnGoUserProfile.class.getSimpleName();
    private SwitchCompat sMale,sFemale,sOther;
    private EditText etName,etEmail,etContact, etAddress,etSubarea,etPincode;
    private TextView etCity;
    private String city = "",state = "",country = "";
    private Double lat=0.0,lng=0.0;
    private CustomLoaderView loaderView;
    private ProfileCompleteListener listener;

    public static FragmentOnGoUserProfile newInstance() {
        return new FragmentOnGoUserProfile();
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        //Log.d("DEBUG", "onCreateView");
        View root = inflater.inflate(R.layout.fragment_ongo_user_profile, container, false);
        CurrentUser user = ModelManager.modelManager().getCurrentUser();
        loaderView = CustomLoaderView.initialize(getActivity());

        etName = root.findViewById(R.id.et_fullname);
        etEmail = root.findViewById(R.id.et_email);
        etContact = root.findViewById(R.id.et_contact);
        etAddress = root.findViewById(R.id.et_address);
        etSubarea = root.findViewById(R.id.et_sub_ares);
        etCity = root.findViewById(R.id.et_city);
        etPincode = root.findViewById(R.id.et_pincode);
        etCity.setOnClickListener(this);

        sMale = root.findViewById(R.id.switch_male);
        sFemale = root.findViewById(R.id.switch_female);
        sOther = root.findViewById(R.id.switch_trans);
        switchListener();

        insertData(user);

        root.findViewById(R.id.btn_save).setOnClickListener(this);
        return root;
    }

    private void insertData(CurrentUser user){
        try{
            if(user!=null){
                if(user.getGender().equals("M"))
                    sMale.setChecked(true);
                else if(user.getGender().equals("F"))
                    sFemale.setChecked(true);
                else
                    sOther.setChecked(true);
                etName.setText(user.getUsername());
                etEmail.setText(user.getEmail());
                etContact.setText(user.getPhone());
                etAddress.setText(user.getUserAddress());
                etSubarea.setText(user.getUserSubArea());
                etCity.setText(user.getUserGoogleAdd());
                etPincode.setText(user.getUserPinCode());
                city = user.getUserCity();
                state = user.getUserState();
                country = user.getUserCountry();
                lat = Double.valueOf(user.getUserLat());
                lng = Double.valueOf(user.getUserLng());
            }
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    private void switchListener(){
        sMale.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if(isChecked){
                sFemale.setChecked(false);
                sOther.setChecked(false);
            }
        });
        sFemale.setOnCheckedChangeListener((compoundButton, isChecked) -> {
            if(isChecked){
                sMale.setChecked(false);
                sOther.setChecked(false);
            }
        });
        sOther.setOnCheckedChangeListener((compoundButton,isChecked) -> {
            if(isChecked){
                sFemale.setChecked(false);
                sMale.setChecked(false);
            }
        });
    }

    private boolean validate() {
        boolean isOk = true;

        if (Utils.getProperText(etName).isEmpty()) {
            etName.setError(getString(R.string.error_cannot_be_empty));
            etName.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidName(Utils.getProperText(etName)))) {
            etName.setError(getString(R.string.error_invalid_credential));
            etName.requestFocus();
            isOk = false;
        }  else if (Utils.getProperText(etAddress).isEmpty()) {
            etAddress.setError(getString(R.string.error_cannot_be_empty));
            etAddress.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etSubarea).isEmpty()) {
            etSubarea.setError(getString(R.string.error_cannot_be_empty));
            etSubarea.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etCity).isEmpty()) {
            etCity.setError(getString(R.string.error_cannot_be_empty));
            etCity.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etPincode).isEmpty()) {
            etPincode.setError(getString(R.string.error_cannot_be_empty));
            etPincode.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidPinCode(Utils.getProperText(etPincode)))) {
            etPincode.setError(getString(R.string.error_invalid_credential));
            etPincode.requestFocus();
            isOk = false;
        } else if(!sMale.isChecked() && !sFemale.isChecked() &&  !sOther.isChecked()){
            Toaster.customToast("please select gender");
            isOk = false;
        }

        return isOk;
    }

    private HashMap<String,Object> getProfileData(){
        CurrentUser user = ModelManager.modelManager().getCurrentUser();
        HashMap<String ,Object> map=  new HashMap<>();
        if(sMale.isChecked())
            map.put(kGender,"M");
        else if(sFemale.isChecked())
            map.put(kGender,"F");
        else
            map.put(kGender,"T");
        map.put(kUserId,String.valueOf(user.getUserId()));
        map.put(kEmail, Utils.getProperText(etEmail));
        map.put(kPhone, Utils.getProperText(etContact));
        map.put(kUserName, Utils.getProperText(etName));
        map.put(kAddress, Utils.getProperText(etAddress));
        map.put(kAddress2, Utils.getProperText(etSubarea));
        map.put(kStreetAddress, Utils.getProperText(etCity));
        map.put(kCity,city);
        //map.put(kState,state);
        map.put(kCountry,country);
        map.put(kLatitude,String.valueOf(lat));
        map.put(kLongitude,String.valueOf(lng));
        map.put(kPincode, Utils.getProperText(etPincode));

        return map;
    }

    private void setUpdateProfile(){
        loaderView.showLoader();
        HashMap<String ,Object> map = getProfileData();
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userFacilityProfile(map,
                (Constants.Status iStatus, GenericResponse<CurrentUser> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        CurrentUser user = genericResponse.getObject();
                        listener.profileComplete();
                        Log.e(TAG,user.toString());
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }

    @Override
    public void onClick(View view) {
        if(view.getId()== R.id.et_city){
            List<Place.Field> fields = Arrays.asList(Place.Field.ID,Place.Field.NAME,
                    Place.Field.ADDRESS_COMPONENTS,Place.Field.ADDRESS,Place.Field.LAT_LNG,Place.Field.TYPES);

            // Start the autocomplete intent.
            Intent intent = new Autocomplete.IntentBuilder(
                    AutocompleteActivityMode.FULLSCREEN, fields)
                    .setCountry("IN")
                    .setTypeFilter(TypeFilter.REGIONS)
                    .build(Objects.requireNonNull(getActivity()));
            startActivityForResult(intent, REQUEST_LOCATION);
        } else if(view.getId()== R.id.btn_save){
            //listener.profileComplete();
            if(validate())
                setUpdateProfile();
        }
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == REQUEST_LOCATION) {
            if (resultCode == RESULT_OK) {
                Place place = Autocomplete.getPlaceFromIntent(data);

                LatLng ln = place.getLatLng();
                assert ln != null;
                lat = ln.latitude;
                lng = ln.longitude;

                List<AddressComponent> list = Objects.requireNonNull(place.getAddressComponents()).asList();

				Log.d("List",list.toString());
                for(int i=0;i<list.size();i++){
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
                            etPincode.setText(comp.getName());

                            Log.d("PostalCode",comp.getName());
                            break;
                    }
                }

                etCity.setText(place.getAddress());
                Log.i(TAG, "Place Id: " + place.getId()+ ", Place: " + place.getAddress() + ", LatLng:"
                        +lat+":"+lng + ", city:" + city + ", state:" + state + ", country:" + country);
            }
            else if (resultCode == AutocompleteActivity.RESULT_ERROR) {
                Status status = Autocomplete.getStatusFromIntent(data);
                assert status.getStatusMessage() != null;
                Log.i(TAG, status.getStatusMessage());
            }
        }
    }

    public void setProfileCompleteListener(ProfileCompleteListener callback) {
        this.listener = callback;
    }

    public interface ProfileCompleteListener{
        void profileComplete();
    }
}
