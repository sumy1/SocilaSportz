package com.socialsportz.Activities.Facility.Fragments;

import android.app.Dialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
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
import com.google.android.material.textfield.TextInputEditText;
import com.socialsportz.Activities.Facility.Adapters.BookingDetailsAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.PaymentType;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.Validations;
import com.socialsportz.Utils.VerticalSpaceItemDecoration;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.RequiresApi;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static android.Manifest.permission.ACCESS_COARSE_LOCATION;
import static android.Manifest.permission.ACCESS_FINE_LOCATION;
import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_LOCATION;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSION_LOCATION;
import static com.socialsportz.Constants.Constants.kAddress;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel1;
import static com.socialsportz.Constants.Constants.kBookingArray;
import static com.socialsportz.Constants.Constants.kBookingTotal;
import static com.socialsportz.Constants.Constants.kCity;
import static com.socialsportz.Constants.Constants.kCountry;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kDate;
import static com.socialsportz.Constants.Constants.kEmail;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacType;
import static com.socialsportz.Constants.Constants.kGCountry;
import static com.socialsportz.Constants.Constants.kGender;
import static com.socialsportz.Constants.Constants.kLatitude;
import static com.socialsportz.Constants.Constants.kLocality;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kLongitude;
import static com.socialsportz.Constants.Constants.kPackageId;
import static com.socialsportz.Constants.Constants.kPaymentMethod;
import static com.socialsportz.Constants.Constants.kPhone;
import static com.socialsportz.Constants.Constants.kPincode;
import static com.socialsportz.Constants.Constants.kPostalCode;
import static com.socialsportz.Constants.Constants.kState;
import static com.socialsportz.Constants.Constants.kStreetAddress;
import static com.socialsportz.Constants.Constants.kUserField;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kUserName;

public class BatchSlotBookFragment extends Fragment {

    private static final String TAG = BatchSlotBookFragment.class.getSimpleName();
    private RecyclerView rvList;
    private DropDownView dvPaytype;
    private TextInputEditText etName,etEmail,etPhone,etArea,etPin;
    private RadioGroup typeRadioGrp;
    private RadioButton rbMale,rbFemale,rbOther;
    private String city = "",state = "",country = "",pincode="",street="";
    private Double lat=0.0,lng=0.0;
    private CopyOnWriteArrayList<HashMap<String,Object>> batchSlots;
    private CheckoutClickListener listener;
    private CurrentUser user;
    private int userId;
    private CustomLoaderView loaderView;
    private TextView tvPrice,tvDate,etCity;
    private int price =0;
	private Dialog dialog;
	LinearLayout cityLayout;
	private TextView tvCity,tvCityName;
	String packageId;
	int facId;
	String packageNamee;

   /* public static BatchSlotBookFragment newInstance() {
        return new BatchSlotBookFragment();
    }*/


   public BatchSlotBookFragment(String packagename,int facIdd){
	   packageNamee=packagename;
	   facId=facIdd;
   }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle
            savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_slot_batch_book_view, container, false);
        loaderView = CustomLoaderView.initialize(getContext());

        typeRadioGrp = view.findViewById(R.id.radio_group);
        rbMale = view.findViewById(R.id.radio_male);
        rbFemale = view.findViewById(R.id.radio_female);
        rbOther = view.findViewById(R.id.radio_trans);

        tvPrice = view.findViewById(R.id.tv_total_price);
        tvDate = view.findViewById(R.id.tv_booking_date);

        etName = view.findViewById(R.id.et_fullname);
        ImageView ivName = view.findViewById(R.id.iv_person);
        setFocusListener(etName, ivName);

        etEmail = view.findViewById(R.id.et_email);
        ImageView ivEmail = view.findViewById(R.id.iv_mail);
        setFocusListener(etEmail, ivEmail);

        etPhone = view.findViewById(R.id.et_phone);
        ImageView ivPhone = view.findViewById(R.id.iv_phone);
        setFocusListener(etPhone, ivPhone);

        etArea = view.findViewById(R.id.et_sub_ares);
        ImageView ivArea = view.findViewById(R.id.iv_area);
        setFocusListener(etArea, ivArea);

		tvCity =view.findViewById(R.id.tv_city);
		//tvCity.setOnClickListener(this);
		tvCityName =view.findViewById(R.id.tv_city_name);
		//tvCityName.setOnClickListener(this);
		cityLayout=view.findViewById(R.id.city_layout);



		cityLayout.setOnClickListener(v->{if (checkSelfPermission()) {
			detPlaces();
		}  else {
			if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
				requestPermission();
			}
		}});


		//setFocusListenerr(etCity, ivCity);

        etPin = view.findViewById(R.id.et_pincode);
        ImageView ivPin = view.findViewById(R.id.iv_pincode);
        setFocusListener(etPin, ivPin);

        LinearLayout detailView = view.findViewById(R.id.detail_view);
        TextView tvView = view.findViewById(R.id.tv_check);
        view.findViewById(R.id.booking_view).setOnClickListener(view1 -> {
            if(detailView.getVisibility()==View.VISIBLE){
                detailView.setVisibility(View.GONE);
                tvView.setText(Objects.requireNonNull(getContext()).getString(R.string.see));
            }else {
                detailView.setVisibility(View.VISIBLE);
                tvView.setText(Objects.requireNonNull(getContext()).getString(R.string.hide));
            }

        });

        rvList = view.findViewById(R.id.rv_details);
        LinearLayoutManager layoutManager = new LinearLayoutManager(getContext(),RecyclerView.VERTICAL,false);
        rvList.setLayoutManager(layoutManager);
        rvList.addItemDecoration(new VerticalSpaceItemDecoration(5));

        view.findViewById(R.id.btn_book).setOnClickListener(v -> {
            if(validate())
                setBookingCheckout();
        });

        tvDate.setText(Utils.getDate(Calendar.getInstance().getTimeInMillis()));
        InitBookingDetails();

        dvPaytype = view.findViewById(R.id.drop_pay_type);
        ImageView ivCat = view.findViewById(R.id.iv_type);
        TextView tvCat = view.findViewById(R.id.type_pay);
        View dividerCat = view.findViewById(R.id.divider_pay);
        CopyOnWriteArrayList<PaymentType> list = Utils.getPaymentTypes();
        ArrayList<DataModel> typeList = new ArrayList<>();
        for(int i=0;i<list.size();i++){
            typeList.add(new DataModel(list.get(i).getTypeId(),list.get(i).getTypeName()));
        }
        dvPaytype.setOptionList(typeList);
        dvPaytype.setClickListener(new DropDownView.onClickInterface() {
            @Override
            public void onClickAction() {
                setTypeFocus(ivCat,tvCat,dividerCat, R.color.theme_color,5);
            }

            @Override
            public void onClickDone(int id, String name) {
                setTypeFocus(ivCat,tvCat,dividerCat, R.color.dim_grey,3);
            }

            @Override
            public void onDismiss() {
                setTypeFocus(ivCat,tvCat,dividerCat, R.color.dim_grey,3);
            }
        });
        return  view;
    }



    private void detPlaces(){
		List<Place.Field> fields = Arrays.asList(Place.Field.ID,Place.Field.NAME,
			Place.Field.ADDRESS_COMPONENTS,Place.Field.ADDRESS,Place.Field.LAT_LNG,Place.Field.TYPES);

		// Start the autocomplete intent.
		Intent intent = new Autocomplete.IntentBuilder(
			AutocompleteActivityMode.OVERLAY, fields)
			.setCountry("IN")
			.setTypeFilter(TypeFilter.REGIONS)
			.build(getActivity());
		startActivityForResult(intent, REQUEST_LOCATION);
	}

	private boolean checkSelfPermission(){
		return ContextCompat.checkSelfPermission(getActivity(), ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED
			&& ContextCompat.checkSelfPermission(getActivity(), ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED;
	}

	@RequiresApi(api = Build.VERSION_CODES.M)
	private void requestPermission(){
		// We've never asked. Just do it.
		requestPermissions(new String[]{ACCESS_FINE_LOCATION, ACCESS_COARSE_LOCATION}, REQUEST_PERMISSION_LOCATION);
	}

	@RequiresApi(api = Build.VERSION_CODES.M)
	@Override
	public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
		if (requestCode == REQUEST_PERMISSION_LOCATION){
			if(grantResults[0] == PackageManager.PERMISSION_GRANTED
				&& grantResults[1] == PackageManager.PERMISSION_GRANTED) {
				detPlaces();
			}else if (ActivityCompat.shouldShowRequestPermissionRationale(getActivity(), ACCESS_FINE_LOCATION)
				&& ActivityCompat.shouldShowRequestPermissionRationale(getActivity(), ACCESS_COARSE_LOCATION)) {
				// We've been denied once before. Explain why we need the permission, then ask again.
				Utils.showDialog(getActivity(), getString(R.string.location_permission_required_text),
					getString(R.string.ask_permission_text), getString(R.string.discard_text),
					(dialog, which) -> {
						if (which == -1)
							requestPermission();
						else
							dialog.dismiss();
					});
			} else if (!ActivityCompat.shouldShowRequestPermissionRationale(getActivity(), ACCESS_FINE_LOCATION)
				&& !ActivityCompat.shouldShowRequestPermissionRationale(getActivity(), ACCESS_COARSE_LOCATION)) {
				// We've been denied for all. Explain why we need the permission, then ask again.
				showDialog();
			}
		}
	}

	private void showDialog(){
		dialog = new Dialog(getActivity());
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		dialog.setCancelable(false);
		dialog.setContentView(R.layout.dialog_permission_setting);

		TextView text =  dialog.findViewById(R.id.tv_dialog);
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
				lat = ln.latitude;
				lng = ln.longitude;
				List<AddressComponent> list = Objects.requireNonNull(place.getAddressComponents()).asList();
				for(int i=0;i<list.size();i++){
					AddressComponent comp = list.get(i);


					switch (comp.getTypes().get(0)) {
						case kLocality:
							city = comp.getName();
							street= comp.getShortName();
							break;
						case kAdministrativeAreaLevel1:
							state = comp.getName();
							break;
						case kGCountry:
							country = comp.getName();
							break;
						case kPostalCode:
							pincode = comp.getName();

							//Log.d("Pincode",pincode);

							break;
					}
				}
                etPin.setText(pincode);
				etArea.setText(street);
				tvCityName.setText(place.getAddress());
				Log.i(TAG, "Place Id: " + place.getId()+", Place: " + place.getAddress() + ", LatLng:"
					+lat+":"+lng + ", city:" + city + ", state:" + state + ", country:" + country+"pincode"+pincode);
			} else if (resultCode == AutocompleteActivity.RESULT_ERROR) {
				Status status = Autocomplete.getStatusFromIntent(data);
				assert status.getStatusMessage() != null;
				Log.i(TAG, status.getStatusMessage());
			}
		}

		/*else if( requestCode == PERMISSIONS_REQUEST){
			if(checkSelfPermission()){
				dialog.dismiss();
			}
		}*/
	}


	private void InitBookingDetails(){
        batchSlots = new CopyOnWriteArrayList<>();
        CopyOnWriteArrayList<HashMap<String,Object>> list = Utils.childItems;
        for(int i=0;i<list.size();i++){
            String date = (String)list.get(i).get(kDate);
			packageId= (String) list.get(i).get(kPackageId);

            CopyOnWriteArrayList<BatchSlot> items = (CopyOnWriteArrayList<BatchSlot>) list.get(i).get(kData);
            assert items != null;
            for(int j=0; j<items.size(); j++){
                if(items.get(j).isChecked()){
                    HashMap<String,Object> map = new HashMap<>();
                    map.put(kDate,date);
                    map.put(kData,items.get(j));
                    price = price + Integer.valueOf(items.get(j).getPrices().get(0).getPrice());
                    batchSlots.add(map);
                }
            }
        }
        BookingDetailsAdapter timeAdapter = new BookingDetailsAdapter(packageNamee,batchSlots, getContext(), (batchSlot, pos) -> {
            for(int i=0;i<batchSlots.size();i++){
                BatchSlot item = (BatchSlot)batchSlots.get(i).get(kData);
                assert item != null;
                if(item.getBatchSlotId()==batchSlot.getBatchSlotId()){
                    batchSlots.remove(item);
                    break;
                }
            }
            price = price - Integer.valueOf(batchSlot.getPrices().get(0).getPrice());
            tvPrice.setText(String.valueOf(price));
        });
        rvList.setAdapter(timeAdapter);
        tvPrice.setText(String.valueOf(price));
    }

    private void setUserData(CurrentUser user){
        if (user != null) {
            if(user.getGender().equals("M"))
                rbMale.setChecked(true);
            else if(user.getGender().equals("F"))
                rbFemale.setChecked(true);
            else
                rbOther.setChecked(true);
            userId=user.getUserId();
            etName.setText(user.getUsername());
            etEmail.setText(user.getEmail());

			if (user.getPhone().startsWith("+91")) {
				String number = user.getPhone().replace("+91", "");
				etPhone.setText(number);
			}else{
				etPhone.setText(user.getPhone());
			}


            etArea.setText(user.getUserAddress());
			tvCityName.setText(user.getUserGoogleAdd());
            etPin.setText(user.getUserPinCode());
            city = user.getUserCity();
            state = user.getUserState();
            country = user.getUserCountry();
            lat = Double.valueOf(user.getUserLat());
            lng = Double.valueOf(user.getUserLng());
        }
    }



    private void setFocusListener(TextInputEditText etFiled, ImageView ivImage){
        etFiled.setOnFocusChangeListener((view, b) -> {
            if (b){
                ivImage.setImageTintList(getResources().getColorStateList(R.color.theme_color));
             } else {
                ivImage.setImageTintList(getResources().getColorStateList(R.color.dim_grey));
                if(etFiled.getId()== R.id.et_email){
                    if(!Utils.getProperText(etEmail).isEmpty() && Validations.isValidEmail(Utils.getProperText(etEmail))){
                        getExistingUser(Utils.getProperText(etEmail));
                    }
                }
                if(etFiled.getId()== R.id.et_phone){
                    if(!Utils.getProperText(etPhone).isEmpty() && Validations.isValidPhone(Utils.getProperText(etPhone))){
                        getExistingUser(Utils.getProperText(etPhone));
                    }
                }
            }
        });
    }

	private void setFocusListenerr(TextView etFiled, ImageView ivImage){
		etFiled.setOnFocusChangeListener((view, b) -> {
			if (b){
				ivImage.setImageTintList(getResources().getColorStateList(R.color.theme_color));
			} else {
				ivImage.setImageTintList(getResources().getColorStateList(R.color.dim_grey));
				if(etFiled.getId()== R.id.et_email){
					if(!Utils.getProperText(etEmail).isEmpty() && Validations.isValidEmail(Utils.getProperText(etEmail))){
						getExistingUser(Utils.getProperText(etEmail));
					}
				}
				if(etFiled.getId()== R.id.et_phone){
					if(!Utils.getProperText(etPhone).isEmpty() && Validations.isValidPhone(Utils.getProperText(etPhone))){
						getExistingUser(Utils.getProperText(etPhone));
					}
				}
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
        } else if (Utils.getProperText(etEmail).isEmpty()) {
            etEmail.setError(getString(R.string.error_cannot_be_empty));
            etEmail.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidEmail(Utils.getProperText(etEmail)))) {
            etEmail.setError(getString(R.string.error_invalid_credential));
            etEmail.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etPhone).isEmpty()) {
            etPhone.setError(getString(R.string.error_cannot_be_empty));
            etPhone.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidPhone(Utils.getProperText(etPhone)))) {
            etPhone.setError(getString(R.string.error_invalid_credential));
            etPhone.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etArea).isEmpty()) {
            etArea.setError(getString(R.string.error_cannot_be_empty));
            etArea.requestFocus();
            isOk = false;
        }else if (Utils.getProperText(tvCityName).isEmpty()) {
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
        }

        return isOk;
    }

    private HashMap<String,Object> getBookingMap(){
        HashMap<String ,Object> map=  new HashMap<>();
        if(typeRadioGrp.getCheckedRadioButtonId()== R.id.rb_owner)
            map.put(kGender,"M");
        else if(typeRadioGrp.getCheckedRadioButtonId()== R.id.rb_owner)
            map.put(kGender,"F");
        else
            map.put(kGender,"T");
        if(userId!=0)
            map.put(kUserId,String.valueOf(userId));
        map.put(kEmail, Utils.getProperText(etEmail));
        map.put(kPhone, "+91"+Utils.getProperText(etPhone));
        map.put(kUserName, Utils.getProperText(etName));
        map.put(kAddress, Utils.getProperText(etArea));
        map.put(kStreetAddress, Utils.getProperText(tvCityName));
        map.put(kCity,city);
        map.put(kState,state);
        map.put(kCountry,country);
        map.put(kLatitude,String.valueOf(lat));
        map.put(kLongitude,String.valueOf(lng));
        map.put(kPincode, Utils.getProperText(etPin));
        map.put(kBookingTotal,tvPrice.getText().toString());
        map.put(kPaymentMethod,dvPaytype.getText().toString());
        map.put(kBookingArray, Utils.getBookingArray(batchSlots,packageId));
		map.put(kFacId,facId);
		map.put("payment_source","android");
        return map;
    }

    private void setBookingCheckout(){
        loaderView.showLoader();
        HashMap<String,Object> map = getBookingMap();
        Log.e("Offline",map.toString());
        ModelManager.modelManager().userOfflineCheckout(map,(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
            loaderView.hideLoader();
            try {
                String msg = genericResponse.getObject();
                Log.e(TAG,msg);
                listener.checkoutClick();
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }

    private void getExistingUser(String text){
        HashMap<String,Object> map = new HashMap<>();
        map.put(kUserField,"+91"+text);
        Log.e("sendPhone",map.toString());
        ModelManager.modelManager().userExistingDetail(map,(Constants.Status iStatus, GenericResponse<CurrentUser> genericResponse) -> {
            try {
                user = genericResponse.getObject();
                setUserData(user);
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> Log.e(TAG,message));
    }

    public void setClickListener(CheckoutClickListener callback) {
        this.listener = callback;
    }

    public interface CheckoutClickListener{
        void checkoutClick();
    }
}
