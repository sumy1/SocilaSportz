package com.socialsportz.Activities.Facility.Fragments;

import android.Manifest;
import android.app.Dialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.Drawable;
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
import com.google.android.material.textfield.TextInputEditText;
import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.ImageCompressor;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.util.Arrays;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.DialogFragment;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_LOCATION;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSIONS_STORAGE;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel1;
import static com.socialsportz.Constants.Constants.kAdministrativeAreaLevel3;
import static com.socialsportz.Constants.Constants.kCreatedOn;
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
import static com.socialsportz.Constants.Constants.kGCountry;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kLocality;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kPostalCode;
import static com.socialsportz.Constants.Constants.kUserId;

public class EditFacilityDialogFragment extends DialogFragment implements View.OnClickListener {

    private static String TAG = FragmentOnGoFacility.class.getSimpleName();
    private Facility facility;
    private TextInputEditText etName, etAboutFac, etPin,et_address_full;
    private TextView tvCityName,etAddress;

    private String city = "test", state = "test", country = "India";
    private double latitude = 0.0, longitude = 0.0;
    private Dialog dialog;
    private CustomLoaderView loaderView;
    private CopyOnWriteArrayList<FacDayTime> list;

    private String imageType;
    private ImageView ivLogo, ivBanner;
    private String logoPath = "", bannerPath = "";
    private LinearLayout layLogo, layBanner;
    private RelativeLayout rlLogo, rlBanner;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth = mArgs.getInt(KSCREENWIDTH);
        facility = (Facility) mArgs.getSerializable(kData);
        Dialog d = getDialog();
        if (d != null) {
            Objects.requireNonNull(d.getWindow()).setLayout(pWidth - 100, pHeight - 100);
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
        View view = inflater.inflate(R.layout.fragment_dialoge_edit_facility, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());
        initView(view);
        insertData();

        return view;
    }

    private void initView(View view) {
        tvCityName = view.findViewById(R.id.tv_city_name);
        //view.findViewById(R.id.city_layoutt).setOnClickListener(this);
		et_address_full=view.findViewById(R.id.et_address_full);
        ivLogo = view.findViewById(R.id.iv_logo);
        layLogo = view.findViewById(R.id.lv_logo);
        rlLogo = view.findViewById(R.id.rl_logo);

        ivBanner = view.findViewById(R.id.iv_banner);
        layBanner = view.findViewById(R.id.lv_banner);
        rlBanner = view.findViewById(R.id.rl_banner);

        view.findViewById(R.id.bt_logo).setOnClickListener(this);
        view.findViewById(R.id.bt_banner).setOnClickListener(this);

        view.findViewById(R.id.frame_logo).setOnClickListener(this);
        view.findViewById(R.id.frame_banner).setOnClickListener(this);

        etName = view.findViewById(R.id.et_fullname);
        ImageView ivName = view.findViewById(R.id.iv_person);
        setFocusListener(etName, ivName);

        /*etOpenClose = view.findViewById(R.id.et_open_close);
        ImageView ivEmail = view.findViewById(R.id.iv_timing);
        setFocusListener(etOpenClose, ivEmail);
        etOpenClose.setOnClickListener(this);*/

        etAboutFac = view.findViewById(R.id.et_about_fac);
        ImageView ivPhone = view.findViewById(R.id.iv_about_fac);
        setFocusListener(etAboutFac, ivPhone);

        etAddress = view.findViewById(R.id.et_address);
		etAddress.setOnClickListener(this);
        ImageView ivArea = view.findViewById(R.id.iv_address);
        //setFocusListener(etAddress, ivArea);

        etPin = view.findViewById(R.id.et_pincode);
        ImageView ivPin = view.findViewById(R.id.iv_pincode);
        setFocusListener(etPin, ivPin);

        Toolbar toolbar = view.findViewById(R.id.toolbar);
        toolbar.inflateMenu(R.menu.menu_day_time);

        // Set an OnMenuItemClickListener to handle menu item clicks
        toolbar.setOnMenuItemClickListener(menuItem -> {
            if (menuItem.getItemId() == R.id.action_done) {
                if (validate()) {
                    setEditFacilityAcademy();
                }
                return true;
            } else {
                return false;
            }
        });

        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());
    }

    private void setFocusListener(TextInputEditText etFiled, ImageView ivImage) {
        etFiled.setOnFocusChangeListener((view, b) -> {
            if (b) {
                ivImage.setColorFilter(ContextCompat.getColor(Objects.requireNonNull(getActivity()), R.color.theme_color), android.graphics.PorterDuff.Mode.MULTIPLY);
            } else {
                ivImage.setColorFilter(ContextCompat.getColor(Objects.requireNonNull(getActivity()), R.color.dim_grey), android.graphics.PorterDuff.Mode.MULTIPLY);

            }
        });
    }

    private void insertData() {
        try {
            etName.setText(facility.getFacName());
            etAboutFac.setText(facility.getFacDesc());
            etAddress.setText(facility.getFacAddress());
            et_address_full.setText(facility.getFacGoogleAdd());
            if(facility.getFacGoogleAdd().isEmpty())
                tvCityName.setText(facility.getFacCity());
            if(!facility.getFacCity().isEmpty())
                city = facility.getFacCity();
			tvCityName.setText(city);
            if(!facility.getFacState().isEmpty())
                state = facility.getFacState();
            country = facility.getFacCountry();
            etPin.setText(facility.getFacPincode());
            if(!facility.getFacLat().isEmpty())
                latitude = Double.valueOf(facility.getFacLat());
            if(!facility.getFacLng().isEmpty())
                longitude = Double.valueOf(facility.getFacLng());

            /*logoPath = facility.getFacLogoImg();
            setImageBackground(kFacLogo, logoPath,2);*/
            bannerPath = facility.getFacBannerImg();
            setImageBackground(kFacBanner, bannerPath,2);
            list = facility.getFacTimingList();
            for(int i=0;i<list.size();i++){
                Log.e("time",list.get(i).getDayName()+list.get(i).getDayStatus());
            }
            //setTimeText();
        } catch (
                Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onClick(View view) {
        if (view.getId() == R.id.et_address) { // City Google Place API
            List<Place.Field> fields = Arrays.asList(Place.Field.ID, Place.Field.NAME,
                    Place.Field.ADDRESS_COMPONENTS, Place.Field.ADDRESS, Place.Field.LAT_LNG, Place.Field.TYPES);

            Intent intent = new Autocomplete.IntentBuilder(
                    AutocompleteActivityMode.FULLSCREEN, fields)
                    .setCountry("IN")
                    .setTypeFilter(TypeFilter.REGIONS)
                    .build(Objects.requireNonNull(getActivity()));
            startActivityForResult(intent, REQUEST_LOCATION);
        } /*else if (view.getId() == R.id.et_open_close) { // Facility Timing Intent
            DayTimeDialogFragment fragment = new DayTimeDialogFragment();
            Bundle bdl = new Bundle();
            bdl.putInt(KSCREENWIDTH, 0);
            bdl.putInt(KSCREENHEIGHT, 0);
            bdl.putSerializable(kData, list);
            fragment.setArguments(bdl);
            fragment.setTargetFragment(this, DAY_TIME_RESULT);
            assert getFragmentManager() != null;
            fragment.show(getFragmentManager(), "Dialog Fragment");
        }*/ else if (view.getId() == R.id.frame_logo) {// ivLogo
            imageType = kFacLogo;
            checkAndroidVersion();
        } else if (view.getId() == R.id.frame_banner) {// ivBanner
            imageType = kFacBanner;
            checkAndroidVersion();
        } else if (view.getId() == R.id.bt_logo) {
            logoPath = "";
            layLogo.setVisibility(View.VISIBLE);
            rlLogo.setVisibility(View.GONE);
        } else if (view.getId() == R.id.bt_banner) {
            bannerPath = "";
            layBanner.setVisibility(View.VISIBLE);
            rlBanner.setVisibility(View.GONE);
        }
    }

    private void checkAndroidVersion() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (checkSelfPermission())
                galleryImage();
            else
                requestPermission();
        } else {
            galleryImage();
        }
    }

    private boolean checkSelfPermission() {
        return ActivityCompat.checkSelfPermission(Objects.requireNonNull(getContext()), Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED;
    }

    private void galleryImage() {
        Intent intent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
        startActivityForResult(intent, GALLERY_PIC_RESULT);
    }

    private void requestPermission() {
        //Method of Fragment
        requestPermissions(new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE}, REQUEST_PERMISSIONS_STORAGE);
    }


    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        if (requestCode == REQUEST_PERMISSIONS_STORAGE) {
            if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                galleryImage();
            } else if (ActivityCompat.shouldShowRequestPermissionRationale(Objects.requireNonNull(getActivity()),
                    Manifest.permission.READ_EXTERNAL_STORAGE)) {
                Snackbar.make(getActivity().findViewById(android.R.id.content),
                        "Please Grant Permissions to upload photo",
                        Snackbar.LENGTH_SHORT).setAction("ENABLE",
                        v -> requestPermission()).show();
            } else if (!ActivityCompat.shouldShowRequestPermissionRationale(Objects.requireNonNull(getActivity()),
                    Manifest.permission.READ_EXTERNAL_STORAGE)) {
                showDialog();
            }
        }
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == GALLERY_PIC_RESULT) {
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
                Log.w(TAG, "picturePAth:" + picturePath);
                Bitmap bm = BitmapFactory.decodeFile(picturePath);
                ByteArrayOutputStream baos = new ByteArrayOutputStream();
                bm.compress(Bitmap.CompressFormat.JPEG, 100, baos); //bm is the bitmap object
                byte[] b = baos.toByteArray();
                if (b.length > 1024 * 1024) {
                    Toaster.customToast("File size should be less than 1MB");
                } else {
                    if (imageType.equals(kFacLogo)) {
                        logoPath = picturePath;
                    } else if (imageType.equals(kFacBanner)) {
                        bannerPath = picturePath;
                    }
                    setImageBackground(imageType, picturePath,1);
                }
            }
        } else if (requestCode == PERMISSIONS_REQUEST) {
            if (checkSelfPermission()) {
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

                Log.d("List",list.toString());
                for (int i = 0; i < list.size(); i++) {
                    AddressComponent comp = list.get(i);
                    switch (comp.getTypes().get(0)) {
                        case kLocality:
                            city = comp.getName();
                            tvCityName.setText(city);
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
				etAddress.setText(place.getAddress());
                Log.i(TAG, "Place Id: " + place.getId() + ", Place: " + place.getAddress() + ", LatLng:"
                        + latitude + ":" + longitude + ", city:" + city + ", state:" + state + ", country:" + country);
            } else if (resultCode == AutocompleteActivity.RESULT_ERROR) {
                Status status = Autocomplete.getStatusFromIntent(data);
                assert status.getStatusMessage() != null;
                Log.i(TAG, status.getStatusMessage());
            }
        } /*else if (requestCode == DAY_TIME_RESULT) {
            list = (CopyOnWriteArrayList<FacDayTime>) data.getSerializableExtra(kData);
            assert list != null;
            JSONArray array = Utils.generateJsonArrayTimings(list);
            Log.e(TAG, array.toString());
            setTimeText();
        }*/
    }

    /*private void setTimeText() {
        boolean check = false;
        String time = "";
        for (int i = 0; i < list.size(); i++) {
            if (list.get(i).getDayStatus() == 1) {
                check = true;
                time = list.get(i).getDayOpenTime();
                break;
            }
        }
        String timeTxt = "";
        if (check)
            timeTxt = "Opens at " + time;
        etOpenClose.setText(timeTxt);
    }*/

    private void setImageBackground(String imageType, String picPath, int type) { //1= add , 2=edit
        final Transformation transformation = new MaskTransformation(Objects.requireNonNull(getActivity()), R.drawable.canvas_booking_details_img_bg);
        if (imageType.equals(kFacLogo)) {
            layLogo.setVisibility(View.GONE);
            rlLogo.setVisibility(View.VISIBLE);
            if (type == 1)
                Picasso.with(getActivity()).load(new File(picPath)).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(ivLogo);
            else {
                String path = kImageBaseUrl + facility.getFacFolder() + "/" + picPath;
                Picasso.with(getActivity()).load(path).fit().placeholder(R.drawable.placeholder_300).transform(transformation).into(ivLogo);
            }
        } else if (imageType.equals(kFacBanner)) {
            layBanner.setVisibility(View.GONE);
            rlBanner.setVisibility(View.VISIBLE);
            if (type == 1)
                Picasso.with(getActivity()).load(new File(picPath)).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(ivBanner);
            else {
                String path = kImageBaseUrl + facility.getFacFolder() + "/" + picPath;
                Picasso.with(getActivity()).load(path).fit().placeholder(R.drawable.placeholder_300).transform(transformation).into(ivBanner);
            }
        }
    }

    private void showDialog() {
        dialog = new Dialog(Objects.requireNonNull(getActivity()));
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

    private boolean validate() {
        boolean isOk = true;
        if (Utils.getProperText(etName).isEmpty()) {
            etName.setError(getString(R.string.error_cannot_be_empty));
            etName.requestFocus();
            isOk = false;
        } /*else if (Utils.getProperText(etOpenClose).isEmpty()) {
            Toaster.customToast("Please input Open/Close Timing");
            etOpenClose.requestFocus();
            isOk = false;
        }*/ else if (Utils.getProperText(etAboutFac).isEmpty()) {
            etAboutFac.setError(getString(R.string.error_cannot_be_empty));
            etAboutFac.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etAddress).isEmpty()) {
            etAddress.setError(getString(R.string.error_cannot_be_empty));
            etAddress.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etPin).isEmpty()) {
            etPin.setError(getString(R.string.error_cannot_be_empty));
            etPin.requestFocus();
            isOk = false;
        }/* else if (logoPath.isEmpty()) {
            Toaster.customToast("Please input logo");
            isOk = false;
        }*/ else if (bannerPath.isEmpty()) {
            Toaster.customToast("Please input banner");
            isOk = false;
        }

        return isOk;
    }

    private HashMap<String, Object> getEditFacilityAcademy() {
        HashMap<String, Object> map = new HashMap<>();
        map.put(kUserId,facility.getUserId());
        map.put(kFacId,facility.getFacId());
        map.put(kFacName, Utils.getProperText(etName));
        map.put(kFacDesc, Utils.getProperText(etAboutFac));
        if (facility.getFacType().equals(Constants.FacType.facility.toString()))
            map.put(kFacType, Constants.FacType.facility.toString());
        else
            map.put(kFacType, Constants.FacType.academy.toString());
        /*if(logoPath.contains("/"))
            map.put(kFacLogo, ImageCompressor.compressFile(new File(logoPath),getActivity()));*/
        if(bannerPath.contains("/"))
            map.put(kFacBanner, ImageCompressor.compressFile(new File(bannerPath),getActivity()));
        map.put(kFacAddress, Utils.getProperText(etAddress));
        map.put(kFacCity, city);
        map.put(kFacState, state);
        map.put(kFacCountry, country);
        map.put(kFacPincode, Utils.getProperText(etPin));
        map.put(kFacGoogle, Utils.getProperText(et_address_full));
        map.put(kFacLat, String.valueOf(latitude));
        map.put(kFacLng, String.valueOf(longitude));

        if(list.isEmpty()){
			map.put(kFacTiming,Utils.generateJsonArrayTimingss());
		}else{
			map.put(kFacTiming, Utils.generateJsonArrayTimings(list).toString());
		}

        map.put(kCreatedOn, Utils.getTimeStampDate(Calendar.getInstance().getTimeInMillis()));
        return map;
    }

    private void setEditFacilityAcademy() {
        loaderView.showLoader();
        HashMap<String, Object> map = getEditFacilityAcademy();
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userAddFacilityProfile(map,
                (Constants.Status iStatus, GenericResponse<Facility> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        Facility facility = genericResponse.getObject();
                        Toaster.customToast("Facility/Academy Updated");
                        Intent in = Objects.requireNonNull(getActivity()).getIntent();
                        in.putExtra(kData,facility);
                        (Objects.requireNonNull(getTargetFragment())).onActivityResult(getTargetRequestCode(),RESULT_OK,in);
                        Objects.requireNonNull(getDialog()).dismiss();

                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }

}
