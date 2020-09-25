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
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.TextView;

import com.google.android.gms.common.api.Status;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.libraries.places.api.model.AddressComponent;
import com.google.android.libraries.places.api.model.Place;
import com.google.android.libraries.places.api.model.TypeFilter;
import com.google.android.libraries.places.widget.Autocomplete;
import com.google.android.libraries.places.widget.AutocompleteActivity;
import com.google.android.libraries.places.widget.model.AutocompleteActivityMode;
import com.google.android.material.textfield.TextInputEditText;
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
import androidx.appcompat.widget.Toolbar;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.DialogFragment;

import static android.app.Activity.RESULT_OK;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
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

public class EditProfileDialogFragment extends DialogFragment implements View.OnClickListener {

    private static String TAG = FragmentOnGoUserProfile.class.getSimpleName();
    private RadioButton sMale,sFemale,sOther;
    private TextInputEditText etName,etEmail,etPhone,etAddress,etArea,etCity,etPin;
    private String city = "",state = "",country = "";
    private Double lat=0.0,lng=0.0;
    private CustomLoaderView loaderView;
    private TextView tvCity,tvCityName;
    private LinearLayout cityLayout;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth  = mArgs.getInt(KSCREENWIDTH);
        Dialog d = getDialog();
        if (d!=null){
            Objects.requireNonNull(d.getWindow()).setLayout(pWidth-100, pHeight-100);
            d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
            Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
            d.getWindow().setBackgroundDrawable(drawable);
            //d.getWindow().addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            //d.getWindow().setStatusBarColor(getResources().getColor(R.color.theme_color));
        }

    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_dialog_edit_profile, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());

        tvCity =view.findViewById(R.id.tv_city);
        //tvCity.setOnClickListener(this);
        tvCityName =view.findViewById(R.id.tv_city_name);
        //tvCityName.setOnClickListener(this);
        cityLayout=view.findViewById(R.id.city_layout);
        cityLayout.setOnClickListener(this);

        sMale = view.findViewById(R.id.switch_male);
        sFemale = view.findViewById(R.id.switch_female);
        sOther = view.findViewById(R.id.switch_trans);
        switchListener();

        etName = view.findViewById(R.id.et_fullname);
        ImageView ivName = view.findViewById(R.id.iv_person);
        setFocusListener(etName, ivName);

        etEmail = view.findViewById(R.id.et_email);
        ImageView ivEmail = view.findViewById(R.id.iv_mail);
        setFocusListener(etEmail, ivEmail);

        etPhone = view.findViewById(R.id.et_phone);
        ImageView ivPhone = view.findViewById(R.id.iv_phone);
        setFocusListener(etPhone, ivPhone);

        etAddress = view.findViewById(R.id.et_address);
        ImageView ivAddress = view.findViewById(R.id.iv_address);
        setFocusListener(etAddress, ivAddress);

        etArea = view.findViewById(R.id.et_sub_ares);
        ImageView ivArea = view.findViewById(R.id.iv_area);
        setFocusListener(etArea, ivArea);

        /*etCity = view.findViewById(R.id.et_city);
        ImageView ivCity = view.findViewById(R.id.iv_city);
        setFocusListener(etCity, ivCity);*/

        etPin = view.findViewById(R.id.et_pincode);
        ImageView ivPin = view.findViewById(R.id.iv_pincode);
        setFocusListener(etPin, ivPin);

        insertData();

        Toolbar toolbar = view.findViewById(R.id.toolbar);
        toolbar.inflateMenu(R.menu.menu_day_time);

        // Set an OnMenuItemClickListener to handle menu item clicks
        toolbar.setOnMenuItemClickListener(menuItem -> {
            if(menuItem.getItemId()== R.id.action_done){
                if(validate()) {
                    setUpdateProfile();
                }
                return true;
            }else {
                return false;
            }
        });

        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> getDialog().dismiss());

        return view;
    }

    private void setFocusListener(TextInputEditText etFiled, ImageView ivImage){
        etFiled.setOnFocusChangeListener((view, b) -> {
            if (b){
                ivImage.setColorFilter(ContextCompat.getColor(getActivity(), R.color.theme_color), android.graphics.PorterDuff.Mode.MULTIPLY);
            } else {
                ivImage.setColorFilter(ContextCompat.getColor(getActivity(), R.color.dim_grey), android.graphics.PorterDuff.Mode.MULTIPLY);

            }
        });
    }

    private void insertData(){
        try{
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            if(user!=null){
                if(user.getGender().equals("M"))
                    sMale.setChecked(true);
                else if(user.getGender().equals("F"))
                    sFemale.setChecked(true);
                else
                    sOther.setChecked(true);
                etName.setText(user.getUsername());
                etEmail.setText(user.getEmail());
                etPhone.setText(user.getPhone());
                etAddress.setText(user.getUserAddress());
                etArea.setText(user.getUserSubArea());
                tvCityName.setText(user.getUserGoogleAdd());
                etPin.setText(user.getUserPinCode());
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
        } else if (Utils.getProperText(etAddress).isEmpty()) {
            etAddress.setError(getString(R.string.error_cannot_be_empty));
            etAddress.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etArea).isEmpty()) {
            etArea.setError(getString(R.string.error_cannot_be_empty));
            etArea.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(tvCityName).isEmpty()) {
            tvCity.setError(getString(R.string.error_cannot_be_empty));
            tvCity.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etPin).isEmpty()) {
            etPin.setError(getString(R.string.error_cannot_be_empty));
            etPin.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidPinCode(Utils.getProperText(etPin)))) {
            etPin.setError(getString(R.string.error_invalid_credential));
            etPin.requestFocus();
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
        map.put(kUserName, Utils.getProperText(etName));
        map.put(kPhone, Utils.getProperText(etPhone));
        map.put(kEmail, Utils.getProperText(etEmail));
        map.put(kAddress, Utils.getProperText(etAddress));
        map.put(kAddress2, Utils.getProperText(etArea));
        map.put(kStreetAddress, Utils.getProperText(tvCityName));
        map.put(kCity,city);
        //map.put(kState,state);
        map.put(kCountry,country);
        map.put(kLatitude,String.valueOf(lat));
        map.put(kLongitude,String.valueOf(lng));
        map.put(kPincode, Utils.getProperText(etPin));

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
                        Intent in = Objects.requireNonNull(getActivity()).getIntent();
                        (Objects.requireNonNull(getTargetFragment())).onActivityResult(getTargetRequestCode(),RESULT_OK,in);
                        Objects.requireNonNull(getDialog()).dismiss();
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
        if(view.getId()== R.id.city_layout){
            List<Place.Field> fields = Arrays.asList(Place.Field.ID,Place.Field.NAME,
                    Place.Field.ADDRESS_COMPONENTS,Place.Field.ADDRESS,Place.Field.LAT_LNG,Place.Field.TYPES);

            // Start the autocomplete intent.
            Intent intent = new Autocomplete.IntentBuilder(
                    AutocompleteActivityMode.FULLSCREEN, fields)
                    .setCountry("IN")
                    .setTypeFilter(TypeFilter.REGIONS)
                    .build(Objects.requireNonNull(getActivity()));
            startActivityForResult(intent, REQUEST_LOCATION);
        }/*else if(view.getId()==R.id.btn_save){
            //listener.profileComplete();
            if(validate())
                setUpdateProfile();
        }*/
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
                            etPin.setText(comp.getName());
                            break;
                    }
                }

                tvCityName.setText(place.getAddress());
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

}
