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
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.google.android.material.snackbar.Snackbar;
import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.FacAchievement;
import com.socialsportz.Models.Owner.FacReward;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.ImageCompressor;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.DialogFragment;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSIONS_STORAGE;
import static com.socialsportz.Constants.Constants.kAchieveId;
import static com.socialsportz.Constants.Constants.kFacAchieve;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kImage1;
import static com.socialsportz.Constants.Constants.kImage2;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kRewardId;
import static com.socialsportz.Constants.Constants.kRewardTitle;

public class AddAchievementDialogFragment extends DialogFragment implements View.OnClickListener {

    private static String TAG = FragmentOnGoFacility.class.getSimpleName();
    private FacAchievement achievement;
    private int facId;
    private int rewardId;
    private DropDownView etFacRewardName;
    private EditText etFacRewardTitle;
    private ImageView ivImage1, ivImage2;
    private LinearLayout layImage1,layImage2;
    private RelativeLayout rlImage1,rlImage2;
    private CustomLoaderView loaderView;
    private String imageType;
    private String image1Path="",image2Path="";
    private Dialog dialog;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth  = mArgs.getInt(KSCREENWIDTH);
        facId =  mArgs.getInt(kFacId);
        achievement = (FacAchievement) mArgs.getSerializable(kFacAchieve);
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
        View view = inflater.inflate(R.layout.fragment_dialog_add_achievement, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());

        ivImage1 =view.findViewById(R.id.iv_image1);
        rlImage1 =view.findViewById(R.id.rl_image1);
        layImage1 =view.findViewById(R.id.lv_image1);
        view.findViewById(R.id.bt_image1).setOnClickListener(this);
        view.findViewById(R.id.frame_image1).setOnClickListener(this);
        ivImage2 =view.findViewById(R.id.iv_image2);
        rlImage2 =view.findViewById(R.id.rl_image2);
        layImage2 =view.findViewById(R.id.lv_image2);
        view.findViewById(R.id.bt_image2).setOnClickListener(this);
        view.findViewById(R.id.frame_image2).setOnClickListener(this);

        etFacRewardTitle = view.findViewById(R.id.et_achievement_title);
        etFacRewardName = view.findViewById(R.id.et_achievement_type);
        initReward();
        initData();

        Toolbar toolbar = view.findViewById(R.id.toolbar);
        toolbar.inflateMenu(R.menu.menu_day_time);

        // Set an OnMenuItemClickListener to handle menu item clicks
        toolbar.setOnMenuItemClickListener(menuItem -> {
            if(menuItem.getItemId()== R.id.action_done){
                if(validateAchieve())
                    setAddAchievement();
                return true;
            }else {
                return false;
            }
        });

        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());

        return view;
    }

    private void initReward(){
        CurrentUser user = ModelManager.modelManager().getCurrentUser();
        ArrayList<DataModel> options = new ArrayList<>();
        CopyOnWriteArrayList<FacReward> rewards = user.getRewards();
        for(FacReward rw:rewards){
            options.add(new DataModel(rw.getRewardId(),rw.getRewardName()));
        }
        etFacRewardName.setOptionList(options);
        etFacRewardName.setClickListener(new DropDownView.onClickInterface() {
            @Override
            public void onClickAction() { }

            @Override
            public void onClickDone(int id, String name) { rewardId = id;}

            @Override
            public void onDismiss() { }
        });
    }

    private void initData(){
        CurrentUser user = ModelManager.modelManager().getCurrentUser();
        if(achievement!=null){
            facId = achievement.getFacId();
            rewardId = achievement.getFacRewardId();
            etFacRewardTitle.setText(achievement.getFacRewardTitle());
            CopyOnWriteArrayList<FacReward> rewards = user.getRewards();
            for(FacReward rw:rewards){
                if(achievement.getFacRewardId()==rw.getRewardId()){
                    etFacRewardName.setText(rw.getRewardName());
                    break;
                }
            }
            if(!achievement.getFacAchieveImg1().isEmpty()){
                image1Path = achievement.getFacAchieveImg1();
                setImageBackground(kImage1,image1Path,2);
            }
            if(!achievement.getFacAchieveImg2().isEmpty()){
                image2Path = achievement.getFacAchieveImg2();
                setImageBackground(kImage2,image2Path,2);
            }
        }
    }

    @Override
    public void onClick(View view) {
        if(view.getId() == R.id.frame_image1){ // ivImage1
            imageType = kImage1;
            checkAndroidVersion();
        } else if(view.getId() == R.id.frame_image2){ // ivImage2
            imageType = kImage2;
            checkAndroidVersion();
        } else if(view.getId() == R.id.bt_image1){
            image1Path = "";
            setEmptyPath(layImage1,rlImage1);
        } else if(view.getId() == R.id.bt_image2){
            image2Path = "";
            setEmptyPath(layImage2,rlImage2);
        }
    }

    private void setEmptyPath(LinearLayout lay,RelativeLayout rl){
        lay.setVisibility(View.VISIBLE);
        rl.setVisibility(View.GONE);
    }

    private void checkAndroidVersion() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if(checkSelfPermission())
                galleryImage();
            else
                requestPermission();
        } else
            galleryImage();
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
                Log.w(TAG, "picturePAth:" + picturePath);
                Bitmap bm = BitmapFactory.decodeFile(picturePath);
                ByteArrayOutputStream baos = new ByteArrayOutputStream();
                bm.compress(Bitmap.CompressFormat.JPEG, 100, baos); //bm is the bitmap object
                byte[] b = baos.toByteArray();
                if (b.length > 1024 * 1024) {
                    Toaster.customToast("File size should be less than 1MB");
                } else {
                    if(imageType.equals(kImage1))
                        image1Path = picturePath;
                    else if(imageType.equals(kImage2))
                        image2Path = picturePath;
                    setImageBackground(imageType,picturePath,1);
                }
            }
        } else if( requestCode == PERMISSIONS_REQUEST){
            if(checkSelfPermission()){
                dialog.dismiss();
            }
        }
    }

    private void setImageBackground(String imageType,String picPath,int type){//1= add 2= edit
        final Transformation transformation = new MaskTransformation(Objects.requireNonNull(getActivity()), R.drawable.canvas_booking_details_img_bg);
        switch (imageType) {
            case kImage1:
                setPicture(layImage1,rlImage1);
                if(type==1){
                    Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivImage1);
                }else if(type==2){
                    String url = kImageBaseUrl+achievement.getFacFolder()+"/"+picPath;
                    Picasso.with(getActivity()).load(url).fit().transform(transformation).into(ivImage1);
                }
                break;
            case kImage2:
                setPicture(layImage2,rlImage2);
                if(type==1) {
                    Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivImage2);
                }
                else if(type==2){
                    String url = kImageBaseUrl+achievement.getFacFolder()+"/"+picPath;
                    Picasso.with(getActivity()).load(url).fit().transform(transformation).into(ivImage2);
                }
                break;
        }
    }

    private void setPicture(LinearLayout lay,RelativeLayout rl){
        lay.setVisibility(View.GONE);
        rl.setVisibility(View.VISIBLE);
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

    private Boolean validateAchieve(){
        boolean isOk = true;
        if (Utils.getProperText(etFacRewardTitle).isEmpty()) {
            etFacRewardTitle.setError(getString(R.string.error_cannot_be_empty));
            etFacRewardTitle.requestFocus();
            isOk = false;
        }else if (Utils.getProperText(etFacRewardName).isEmpty()) {
            etFacRewardName.setError(getString(R.string.error_cannot_be_empty));
            etFacRewardName.requestFocus();
            isOk = false;
        }
        return isOk;
    }


    private HashMap<String,Object> getAchieveData(){
        HashMap<String ,Object> map=  new HashMap<>();
        if(achievement!=null){
            map.put(kAchieveId,achievement.getFacAchieveId());
        }
        map.put(kFacId,facId);
        map.put(kRewardTitle, Utils.getProperText(etFacRewardTitle));
        map.put(kRewardId,rewardId);
        if(!image1Path.isEmpty()){
            if(image1Path.contains("/"))
                map.put(kImage1, ImageCompressor.compressFile(new File(image1Path),getActivity()));
        }
        if(!image2Path.isEmpty()) {
            if(image2Path.contains("/"))
                map.put(kImage2, ImageCompressor.compressFile(new File(image2Path),getActivity()));
        }
        return map;
    }

    private void setAddAchievement(){
        loaderView.showLoader();
        HashMap<String ,Object> map = getAchieveData();
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userAddFacilityAchieve(map,
                (Constants.Status iStatus, GenericResponse<FacAchievement> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        FacAchievement achieve = genericResponse.getObject();
                        Toaster.customToast("Achievement Updated");
                        Objects.requireNonNull(getDialog()).dismiss();
                        Log.e(TAG,achieve.toString());
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }

}
