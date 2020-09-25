package com.socialsportz.Activities.Facility.Fragments;

import android.Manifest;
import android.app.Dialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.provider.MediaStore;
import android.provider.Settings;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
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
import com.google.android.material.snackbar.Snackbar;
import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.SwitchCompat;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;
import id.zelory.compressor.Compressor;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.DAY_TIME_RESULT;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_LOCATION;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSIONS_STORAGE;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel1;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacAddress;
import static com.socialsportz.Constants.Constants.kFacBanner;
import static com.socialsportz.Constants.Constants.kFacCity;
import static com.socialsportz.Constants.Constants.kFacCountry;
import static com.socialsportz.Constants.Constants.kFacDesc;
import static com.socialsportz.Constants.Constants.kFacGoogle;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacLat;
import static com.socialsportz.Constants.Constants.kFacLng;
import static com.socialsportz.Constants.Constants.kFacLogo;
import static com.socialsportz.Constants.Constants.kFacName;
import static com.socialsportz.Constants.Constants.kFacPincode;
import static com.socialsportz.Constants.Constants.kFacState;
import static com.socialsportz.Constants.Constants.kFacTiming;
import static com.socialsportz.Constants.Constants.kFacType;
import static com.socialsportz.Constants.Constants.kFlag;
import static com.socialsportz.Constants.Constants.kGCountry;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kLocality;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kPostalCode;
import static com.socialsportz.Constants.Constants.kUserId;

public class FragmentOnGoFacility extends Fragment implements View.OnClickListener {

    private static String TAG = FragmentOnGoFacility.class.getSimpleName();
    private PageChangeListener listener;
    private int facId=0;
    public int type=0;
    private SwitchCompat sFac,sAca;
    private TextView tvFacAcaName,etAddress;
    private EditText etFacAcaName,etPinCode,etDesc,etOpenClose,et_address_full,etCity;

    private ImageView ivLogo,ivBanner;
    private String imageType="";
    private String logoPath="",bannerPath="";
    private LinearLayout layLogo,layBanner;
    private RelativeLayout rlLogo,rlBanner;
    private String city="abc",state="abc",country = "India";
    private double latitude = 28.0 ,longitude = 73.0;
    private Dialog dialog;
    private CustomLoaderView loaderView;
    private CopyOnWriteArrayList<FacDayTime> list;
    private ViewGroup viewGroup;

    public static FragmentOnGoFacility newInstance() {
        return new FragmentOnGoFacility();
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle
            savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_ongo_facility, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());
        viewGroup = root.findViewById(R.id.form_view);
        list = new CopyOnWriteArrayList<>();

        initialize(root);

        root.findViewById(R.id.btn_save).setOnClickListener(this);
        return root;
    }

    private void initialize(View root){
        tvFacAcaName = root.findViewById(R.id.tv_fac_aca_name);
        etFacAcaName = root.findViewById(R.id.et_facility_name);
        etOpenClose = root.findViewById(R.id.et_open_close_time);
        etAddress = root.findViewById(R.id.et_address);
		etAddress.setOnClickListener(this);
        etPinCode = root.findViewById(R.id.et_pincode);
		et_address_full=root.findViewById(R.id.et_address_full);
        etCity = root.findViewById(R.id.et_city);
        etDesc = root.findViewById(R.id.et_description);
        ivLogo = root.findViewById(R.id.iv_logo);
        ivBanner = root.findViewById(R.id.iv_banner);
        root.findViewById(R.id.bt_logo).setOnClickListener(this);
        root.findViewById(R.id.bt_banner).setOnClickListener(this);
        layLogo = root.findViewById(R.id.lay_logo);
        rlLogo = root.findViewById(R.id.rl_logo);
        layBanner = root.findViewById(R.id.lay_banner);
        rlBanner = root.findViewById(R.id.rl_banner);

        etOpenClose.setOnClickListener(this);
        root.findViewById(R.id.frame_logo).setOnClickListener(this);
        root.findViewById(R.id.frame_banner).setOnClickListener(this);

        sFac = root.findViewById(R.id.switch_facility);
        sAca = root.findViewById(R.id.switch_academy);
        CheckChangeListener();
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
        if(type==1){
            clearForm(viewGroup);
            //new code..list.clear
            list.clear();
            type=0;
        }
    }

    private void CheckChangeListener(){
        sFac.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if(isChecked){
                sAca.setChecked(false);
                tvFacAcaName.setText(R.string.facility_name);
                etFacAcaName.setHint(R.string.facility_name_hint);
            }
        });
        sAca.setOnCheckedChangeListener((compoundButton, isChecked) -> {
            if(isChecked){
                sFac.setChecked(false);
                tvFacAcaName.setText(R.string.academy_name);
                etFacAcaName.setHint(R.string.academy_name_hint);
            }
        });
    }

    void insertData(Facility fac){
        try{
            facId = fac.getFacId();
            etFacAcaName.setText(fac.getFacName());
            if(fac.getFacType().equals(Constants.FacType.academy.toString()))
                sAca.setChecked(true);
            else
                sFac.setChecked(true);
            etDesc.setText(fac.getFacDesc());
            etAddress.setText(fac.getFacAddress());
			et_address_full.setText(fac.getFacGoogleAdd());
            etCity.setText(fac.getFacCity());
            city = fac.getFacCity();
            state = fac.getFacState();
            country = fac.getFacCountry();
            etPinCode.setText(fac.getFacPincode());
            latitude = Double.valueOf(fac.getFacLat());
            longitude = Double.valueOf(fac.getFacLng());

            //setImageBackground(kFacLogo,fac.getFacLogoImg(),2,fac);
			bannerPath =fac.getFacBannerImg();
            setImageBackground(kFacBanner,fac.getFacBannerImg(),2,fac);
            list = fac.getFacTimingList();

            Log.d("List",list.size()+"");
            setTimeText();
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    @Override
    public void onClick(View view) {
        if(view.getId()== R.id.et_address) { // City Google Place API
            List<Place.Field> fields = Arrays.asList(Place.Field.ID,Place.Field.NAME,
                    Place.Field.ADDRESS_COMPONENTS,Place.Field.ADDRESS,Place.Field.LAT_LNG,Place.Field.TYPES);

            Intent intent = new Autocomplete.IntentBuilder(
                    AutocompleteActivityMode.FULLSCREEN, fields)
                    .setCountry("IN")
                    .setTypeFilter(TypeFilter.REGIONS)
                    .build(Objects.requireNonNull(getActivity()));
            startActivityForResult(intent, REQUEST_LOCATION);
        }  else if(view.getId()== R.id.et_open_close_time){ // Facility Timing Intent
            DayTimeDialogFragment fragment = new DayTimeDialogFragment();
            Bundle bdl = new Bundle();
            bdl.putInt(KSCREENWIDTH, 0);
            bdl.putInt(KSCREENHEIGHT, 0);
            bdl.putInt(kFlag,0);
            bdl.putInt(kFacId,0);
            bdl.putSerializable(kData, Utils.getTimings(Objects.requireNonNull(getContext())));
            bdl.putSerializable(kFacTiming,list);
            fragment.setArguments(bdl);
            fragment.setTargetFragment(this, DAY_TIME_RESULT);
            assert getFragmentManager() != null;
            fragment.show(getFragmentManager(), "Dialog Fragment");
        } else if(view.getId() == R.id.frame_logo){// ivLogo
            imageType = kFacLogo;
            checkAndroidVersion();
        } else if(view.getId() == R.id.frame_banner){// ivBanner
            imageType = kFacBanner;
            checkAndroidVersion();
        } else if(view.getId() == R.id.bt_logo){
            logoPath="";
            layLogo.setVisibility(View.VISIBLE);
            rlLogo.setVisibility(View.GONE);
        } else if(view.getId() == R.id.bt_banner){
            bannerPath="";
            layBanner.setVisibility(View.VISIBLE);
            rlBanner.setVisibility(View.GONE);
        } else if(view.getId() == R.id.btn_save) {
            if(validate())
                setAddFacilityAcademy();
        }
    }

    private void checkAndroidVersion() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if(checkSelfPermission())
                galleryImage();
            else
                requestPermission();
        } else {
            galleryImage();
        }
    }

    private boolean checkSelfPermission(){
        return ActivityCompat.checkSelfPermission(Objects.requireNonNull(getContext()), Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED;
    }

    private void galleryImage(){
        Intent intent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
        startActivityForResult(intent, GALLERY_PIC_RESULT);
    }

    private void requestPermission(){
        //Method of Fragment
        requestPermissions(new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE}, REQUEST_PERMISSIONS_STORAGE);
    }


    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        if (requestCode == REQUEST_PERMISSIONS_STORAGE) {
            if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                galleryImage();
            } else if (ActivityCompat.shouldShowRequestPermissionRationale(Objects.requireNonNull(getActivity()),
                    Manifest.permission.READ_EXTERNAL_STORAGE)){
                Snackbar.make(getActivity().findViewById(android.R.id.content),
                        "Please Grant Permissions to upload photo",
                        Snackbar.LENGTH_SHORT).setAction("ENABLE",
                        v -> requestPermission()).show();
            } else if(!ActivityCompat.shouldShowRequestPermissionRationale(Objects.requireNonNull(getActivity()),
                    Manifest.permission.READ_EXTERNAL_STORAGE)){
                showDialog();
            }
        }
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == GALLERY_PIC_RESULT){
            if (resultCode == RESULT_OK) {
                Uri selectedImage = data.getData();
                String[] filePath = {MediaStore.Images.Media.DATA};
                assert selectedImage != null;
                Cursor c = Objects.requireNonNull(getActivity()).getContentResolver().query(selectedImage, filePath, null, null, null);
                assert c != null;
                c.moveToFirst();
                int columnIndex = c.getColumnIndex(filePath[0]);
                String picturePath = c.getString(columnIndex);
                c.close();

                Log.w(TAG, "picturePAth:" + picturePath );
                Bitmap bm = BitmapFactory.decodeFile(picturePath);
                ByteArrayOutputStream baos = new ByteArrayOutputStream();
                bm.compress(Bitmap.CompressFormat.JPEG, 100, baos); //bm is the bitmap object
                byte[] b = baos.toByteArray();
                if(b.length>1024*1024){
                    Toaster.customToast("File size should be less than 1MB");
                }else{
                    //String path = Base64.encodeToString(b, Base64.DEFAULT);
                    /*if(imageType.equals(kFacLogo))
                        logoPath = picturePath;
                    else if(imageType.equals(kFacBanner))
                        bannerPath = picturePath;*/


                    bannerPath =picturePath;
					Log.d("BnnerPath1",bannerPath);
                    setImageBackground(imageType,picturePath,1,null);
                }
            }
        } else if( requestCode == PERMISSIONS_REQUEST){
            if(checkSelfPermission()){
                dialog.dismiss();
            }
        } else if (requestCode == REQUEST_LOCATION) {
            if (resultCode == RESULT_OK) {
                Place place = Autocomplete.getPlaceFromIntent(data);

                LatLng ln = place.getLatLng();
                assert ln != null;
                latitude = ln.latitude;
                longitude = ln.longitude;

                List<AddressComponent> list = Objects.requireNonNull(place.getAddressComponents()).asList();
                for(int i=0;i<list.size();i++){
                    AddressComponent comp = list.get(i);
                    switch (comp.getTypes().get(0)) {
                        case kLocality:
                            city = comp.getName();
                            etCity.setText(city);
                            break;
                        case kAdministrativeAreaLevel1:
                            state = comp.getName();
                            break;
                        case kGCountry:
                            country = comp.getName();
                            break;
                        case kPostalCode:
                            etPinCode.setText(comp.getName());
                            break;
                    }
                }
                etAddress.setText(place.getAddress());
                Log.i(TAG, "Place Id: " + place.getId()+ ", Place: " + place.getAddress() + ", LatLng:"
                        +latitude+":"+longitude + ", city:" + city + ", state:" + state + ", country:" + country);
            }
            else if (resultCode == AutocompleteActivity.RESULT_ERROR) {
                Status status = Autocomplete.getStatusFromIntent(data);
                assert status.getStatusMessage() != null;
                Log.i(TAG, status.getStatusMessage());
            }
        } else if(requestCode == DAY_TIME_RESULT){
            list = (CopyOnWriteArrayList<FacDayTime>) data.getSerializableExtra(kData);
            assert list != null;
            JSONArray array = Utils.generateJsonArrayTimings(list);
            Log.e(TAG,array.toString());
            setTimeText();
        }
    }

    private void setTimeText(){
        boolean check = false;
        String time="";
        for(int i=0;i<list.size();i++){
            if(list.get(i).getDayStatus()==1){
                check = true;
                time = list.get(i).getDayOpenTime();
                break;
            }
        }
        String timeTxt="";
        if(check)
            timeTxt = "Opens at "+time;
        etOpenClose.setText(timeTxt);
    }

    private void setImageBackground(String imageType, String picPath, int type, Facility fac){ //1= add , 2=edit
        final Transformation transformation = new MaskTransformation(Objects.requireNonNull(getActivity()), R.drawable.canvas_booking_details_img_bg);
        if(imageType.equals(kFacLogo)){
            layLogo.setVisibility(View.GONE);
            rlLogo.setVisibility(View.VISIBLE);
            if(type==1)
                Picasso.with(getActivity()).load(new File(picPath)).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(ivLogo);
            else{
                String path = kImageBaseUrl+fac.getFacFolder()+"/"+picPath;
                Picasso.with(getActivity()).load(path).fit().placeholder(R.drawable.placeholder_300).transform(transformation).into(ivLogo);
            }
        }
        else if(imageType.equals(kFacBanner)){
            layBanner.setVisibility(View.GONE);
            rlBanner.setVisibility(View.VISIBLE);
            if(type==1)
                Picasso.with(getActivity()).load(new File(picPath)).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(ivBanner);
            else{
                String path = kImageBaseUrl+fac.getFacFolder()+"/"+picPath;
                Log.d("path",path);
                Picasso.with(getActivity()).load(path).fit().placeholder(R.drawable.placeholder_300).transform(transformation).into(ivBanner);
            }
        }
    }

    private void showDialog(){
        dialog = new Dialog(Objects.requireNonNull(getActivity()));
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

    private boolean validate(){
        boolean isOk = true;
        if (Utils.getProperText(etFacAcaName).isEmpty()) {
            etFacAcaName.setError(getString(R.string.error_cannot_be_empty));
            etFacAcaName.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etOpenClose).isEmpty()) {
            Toaster.customToast("Please input Open/Close Timing");
            isOk = false;
        } else if (Utils.getProperText(etAddress).isEmpty()) {
            etAddress.setError(getString(R.string.error_cannot_be_empty));
            etAddress.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etAddress).isEmpty()) {
            etAddress.setError(getString(R.string.error_cannot_be_empty));
            etAddress.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etCity).isEmpty()) {
            Toaster.toast("City Cannot be Empty");
            //etCity.setError(getString(R.string.error_cannot_be_empty));
            etCity.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etPinCode).isEmpty()) {
            etPinCode.setError(getString(R.string.error_cannot_be_empty));
            etPinCode.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etDesc).isEmpty()) {
            etDesc.setError(getString(R.string.error_cannot_be_empty));
            etDesc.requestFocus();
            isOk = false;
        }/* else if (logoPath.isEmpty()) {
            Toaster.customToast("Please input logo");
            isOk = false;
        }*/ else if (bannerPath.isEmpty()) {
            Toaster.customToast("Please input banner");
            isOk = false;
        } else if(!sFac.isChecked() && !sAca.isChecked()){
            Toaster.customToast("Please select type");
            isOk = false;
         }

        return isOk;
    }

    private HashMap<String,Object> getAddFacilityAcademy(){

    	Log.d("BnnerPath",bannerPath);
        HashMap<String,Object> map = new HashMap<>();
        map.put(kUserId,String.valueOf(ModelManager.modelManager().getCurrentUser().getUserId()));
        if(facId!=0){
            map.put(kFacId, String.valueOf(facId));
        }
        map.put(kFacName, Utils.getProperText(etFacAcaName));
        if(sFac.isChecked())
            map.put(kFacType, Constants.FacType.facility.toString());
        else
            map.put(kFacType, Constants.FacType.academy.toString());
        map.put(kFacDesc, Utils.getProperText(etDesc));
        /*if(logoPath.contains("/"))
            map.put(kFacLogo, ImageCompressor.compressFile(new File(logoPath),getActivity()));*/
        /*if(!bannerPath.isEmpty()){
            if(bannerPath.contains("/"))
                map.put(kFacBanner, ImageCompressor.compressFile(new File(bannerPath),getActivity()));
        }*/

		if(bannerPath.contains("/")) {
			try {
				map.put(kFacBanner, new Compressor(getActivity()).compressToFile(new File(bannerPath)));
			} catch (IOException e) {
				e.printStackTrace();
			}
		}



        map.put(kFacAddress, Utils.getProperText(etAddress));
        map.put(kFacCity,city);
        map.put(kFacState,state);
        map.put(kFacCountry,country);
        map.put(kFacPincode, Utils.getProperText(etPinCode));
        map.put(kFacGoogle,etCity.getText());
        map.put(kFacLat,String.valueOf(latitude));
        map.put(kFacLng,String.valueOf(longitude));
        map.put(kFacTiming, Utils.generateJsonArrayTimings(list));
        //map.put(kCreatedOn,Utils.getTimeStampDate(Calendar.getInstance().getTimeInMillis()) );
        return  map;
    }

    private void setAddFacilityAcademy(){
        loaderView.showLoader();
        HashMap<String ,Object> map = getAddFacilityAcademy();
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userAddFacilityProfile(map,
                (Constants.Status iStatus, GenericResponse<Facility> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        Facility facility = genericResponse.getObject();
                        Log.e(TAG,facility.toString());
                        Toaster.customToast("Facility/Academy Added");
                        clearForm(viewGroup);
                        listener.pageChange();
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }

    private void clearForm(ViewGroup group) {
        facId=0;
        imageType="";
        logoPath="";
        layLogo.setVisibility(View.VISIBLE);
        rlLogo.setVisibility(View.GONE);
        bannerPath="";
        layBanner.setVisibility(View.VISIBLE);
        rlBanner.setVisibility(View.GONE);
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
