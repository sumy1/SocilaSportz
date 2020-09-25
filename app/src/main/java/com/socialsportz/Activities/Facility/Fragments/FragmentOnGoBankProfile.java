package com.socialsportz.Activities.Facility.Fragments;

import android.Manifest;
import android.app.Dialog;
import android.content.Context;
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

import com.google.android.material.snackbar.Snackbar;
import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.FacBankModel;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.ImageCompressor;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.Validations;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Objects;

import androidx.annotation.NonNull;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSIONS_STORAGE;
import static com.socialsportz.Constants.Constants.kAccountName;
import static com.socialsportz.Constants.Constants.kAccountNumber;
import static com.socialsportz.Constants.Constants.kAccountType;
import static com.socialsportz.Constants.Constants.kBankBranch;
import static com.socialsportz.Constants.Constants.kBankId;
import static com.socialsportz.Constants.Constants.kBankName;
import static com.socialsportz.Constants.Constants.kCINImage;
import static com.socialsportz.Constants.Constants.kCINNumber;
import static com.socialsportz.Constants.Constants.kChequeImage;
import static com.socialsportz.Constants.Constants.kGSTImage;
import static com.socialsportz.Constants.Constants.kGSTNumber;
import static com.socialsportz.Constants.Constants.kIFSCCode;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kPANImage;
import static com.socialsportz.Constants.Constants.kPANNumber;
import static com.socialsportz.Constants.Constants.kProofImage;
import static com.socialsportz.Constants.Constants.kUserId;

public class FragmentOnGoBankProfile extends Fragment implements View.OnClickListener {

    public static final String TAG = FragmentOnGoBankProfile.class.getSimpleName();
    private EditText etIFSC,etBankName,etBankBranch,etAccountName,etAccountNumber,etGST,etPAN,etCIN;
    private DropDownView tvAccountType;
    private String imageType;
    private ImageView ivPAN,ivGST,ivCIN,ivDOC,ivCHQ;
    private String pathPAN="",pathGST="",pathCIN="",pathCHQ="",pathDOC="";
    private LinearLayout layPAN,layGST,layCIN,layDOC,layCHQ;
    private RelativeLayout rlPAN,rlGST,rlCIN,rlDOC,rlCHQ;
    private CustomLoaderView loaderView;
    private Context context;
    private Dialog dialog;
    private BankCompleteListener listener;

    public static FragmentOnGoBankProfile newInstance() {
        return new FragmentOnGoBankProfile();
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_ongo_bank_profile, container, false);
        context = getActivity();
        loaderView = CustomLoaderView.initialize(context);

        etIFSC = root.findViewById(R.id.et_ifsc_code);
        etBankName = root.findViewById(R.id.et_bank_name);
        etBankBranch = root.findViewById(R.id.et_bank_branch);
        etAccountName = root.findViewById(R.id.et_account_name);
        etAccountNumber = root.findViewById(R.id.et_account_no);
        etGST = root.findViewById(R.id.et_gst_no);
        etCIN = root.findViewById(R.id.et_cin_no);
        etPAN = root.findViewById(R.id.et_pan_no);

        ivGST = root.findViewById(R.id.iv_gst);
        ivPAN = root.findViewById(R.id.iv_pan);
        ivCIN = root.findViewById(R.id.iv_cin);
        ivDOC = root.findViewById(R.id.iv_doc);
        ivCHQ = root.findViewById(R.id.iv_chq);
        layGST = root.findViewById(R.id.lay_gst);
        rlGST = root.findViewById(R.id.rl_gst);
        layPAN = root.findViewById(R.id.lay_pan);
        rlPAN = root.findViewById(R.id.rl_pan);
        layCIN = root.findViewById(R.id.lay_cin);
        rlCIN = root.findViewById(R.id.rl_cin);
        layDOC = root.findViewById(R.id.lay_doc);
        rlDOC = root.findViewById(R.id.rl_doc);
        layCHQ = root.findViewById(R.id.lay_chq);
        rlCHQ = root.findViewById(R.id.rl_chq);
        root.findViewById(R.id.frame_gst).setOnClickListener(this);
        root.findViewById(R.id.frame_pan).setOnClickListener(this);
        root.findViewById(R.id.frame_cin).setOnClickListener(this);
        root.findViewById(R.id.frame_doc).setOnClickListener(this);
        root.findViewById(R.id.frame_chq).setOnClickListener(this);
        root.findViewById(R.id.bt_gst).setOnClickListener(this);
        root.findViewById(R.id.bt_pan).setOnClickListener(this);
        root.findViewById(R.id.bt_cin).setOnClickListener(this);
        root.findViewById(R.id.bt_chq).setOnClickListener(this);
        root.findViewById(R.id.bt_doc).setOnClickListener(this);

        ArrayList<DataModel> options = new ArrayList<>();
        options.add(new DataModel(1,"Saving"));
        options.add(new DataModel(2,"Current"));
        tvAccountType = root.findViewById(R.id.et_account_type);
        tvAccountType.setOptionList(options);

        InitData();
        root.findViewById(R.id.btn_save).setOnClickListener(view -> {
            if(validate())
                setUpdateProfile();
        });

        return root;
    }

    private void InitData(){
        try{
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            FacBankModel model = user.getUserBankDetails();
            if(model!=null){
                etIFSC.setText(model.getIfscCode());
                etBankName.setText(model.getBankName());
                etBankBranch.setText(model.getBankBranch());
                tvAccountType.setText(model.getAccountType());
                etAccountName.setText(model.getAccountName());
                etAccountNumber.setText(model.getAccountNumber());
                etGST.setText(model.getGSTNumber());
                etPAN.setText(model.getPANNumber());
                etCIN.setText(model.getCINNumber());

                pathPAN = model.getPANImage();
                setImageBackground(kPANImage,pathPAN,model,2);
                pathGST = model.getGSTImage();
                setImageBackground(kGSTImage,pathGST,model,2);
                pathCIN = model.getCINImage();
                setImageBackground(kCINImage,pathCIN,model,2);
                pathCHQ = model.getChequeImage();
                setImageBackground(kChequeImage,pathCHQ,model,2);
                pathDOC = model.getAddressImage();
                setImageBackground(kProofImage,pathDOC,model,2);
            }
        }catch (Exception e){
            e.printStackTrace();
        }
    }


    @Override
    public void onClick(View view) {
        if(view.getId()== R.id.frame_gst){
            imageType = kGSTImage;
            checkAndroidVersion();
        } else if(view.getId()== R.id.frame_pan){
            imageType = kPANImage;
            checkAndroidVersion();
        } else if(view.getId()== R.id.frame_cin){
            imageType = kCINImage;
            checkAndroidVersion();
        } else if(view.getId()== R.id.frame_doc){
            imageType = kProofImage;
            checkAndroidVersion();
        } else if(view.getId()== R.id.frame_chq){
            imageType = kChequeImage;
            checkAndroidVersion();
        } else if(view.getId() == R.id.bt_gst){
            pathGST = "";
            setEmptyPath(layGST,rlGST);
        } else if(view.getId() == R.id.bt_pan){
            pathPAN = "";
            setEmptyPath(layPAN,rlPAN);
        } else if(view.getId() == R.id.bt_cin){
            pathCIN = "";
            setEmptyPath(layCIN,rlCIN);
        } else if(view.getId() == R.id.bt_chq){
            pathCHQ = "";
            setEmptyPath(layCHQ,rlCHQ);
        } else if(view.getId() == R.id.bt_doc){
            pathDOC = "";
            setEmptyPath(layDOC,rlDOC);
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
                    switch (imageType) {
                        case kGSTImage:
                            pathGST = picturePath;
                            break;
                        case kPANImage:
                            pathPAN = picturePath;
                            break;
                        case kCINImage:
                            pathCIN = picturePath;
                            break;
                        case kProofImage:
                            pathDOC = picturePath;
                            break;
                        case kChequeImage:
                            pathCHQ = picturePath;
                            break;
                    }
                    setImageBackground(imageType,picturePath,null,1);
                }
            }
        } else if( requestCode == PERMISSIONS_REQUEST){
            if(checkSelfPermission()){
                dialog.dismiss();
            }
        }
    }

    private void setImageBackground(String imageType, String picPath, FacBankModel model, int type){
        final Transformation transformation = new MaskTransformation(Objects.requireNonNull(getActivity()), R.drawable.canvas_booking_details_img_bg);
        switch (imageType) {
            case kGSTImage:
                setPicture(layGST,rlGST);
                if(type==2){
                    String urlPath = kImageBaseUrl+model.getFolderName()+"/"+picPath;
                    Picasso.with(context).load(urlPath).placeholder(R.drawable.placeholder_300).into(ivGST);
                }else
                    Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivGST);
                break;
            case kPANImage:
                setPicture(layPAN,rlPAN);
                if(type==2){
                    String urlPath = kImageBaseUrl+model.getFolderName()+"/"+picPath;
                    Picasso.with(context).load(urlPath).placeholder(R.drawable.placeholder_300).into(ivPAN);
                }else
                    Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivPAN);
                break;
            case kCINImage:
                setPicture(layCIN,rlCIN);
                if(type==2){
                    String urlPath = kImageBaseUrl+model.getFolderName()+"/"+picPath;
                    Picasso.with(context).load(urlPath).placeholder(R.drawable.placeholder_300).into(ivCIN);
                }else
                    Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivCIN);
                break;
            case kProofImage:
                setPicture(layDOC,rlDOC);
                if(type==2){
                    String urlPath = kImageBaseUrl+model.getFolderName()+"/"+picPath;
                    Picasso.with(context).load(urlPath).placeholder(R.drawable.placeholder_300).into(ivDOC);
                }else
                    Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivDOC);
                break;
            case kChequeImage:
                setPicture(layCHQ,rlCHQ);
                if(type==2){
                    String urlPath = kImageBaseUrl+model.getFolderName()+"/"+picPath;
                    Picasso.with(context).load(urlPath).placeholder(R.drawable.placeholder_300).into(ivCHQ);
                }else
                    Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivCHQ);
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

    private boolean validate() {
        boolean isOk = true;

        if (Utils.getProperText(etIFSC).isEmpty()) {
            etIFSC.setError(getString(R.string.error_cannot_be_empty));
            etIFSC.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidIFSC(Utils.getProperText(etIFSC)))) {
            etIFSC.setError(getString(R.string.error_invalid_credential));
            etIFSC.requestFocus();
            isOk = false;
        }  else if (Utils.getProperText(etBankName).isEmpty()) {
            etBankName.setError(getString(R.string.error_cannot_be_empty));
            etBankName.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidName(Utils.getProperText(etBankName)))) {
            etBankName.setError(getString(R.string.error_invalid_credential));
            etBankName.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etBankBranch).isEmpty()) {
            etBankBranch.setError(getString(R.string.error_cannot_be_empty));
            etBankBranch.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(tvAccountType).isEmpty()) {
            Toaster.customToast("Account Type Invalid");
            isOk = false;
        } else if (Utils.getProperText(etAccountName).isEmpty()) {
            etAccountName.setError(getString(R.string.error_cannot_be_empty));
            etAccountName.requestFocus();
            isOk = false;
        }  else if (!(Validations.isValidName(Utils.getProperText(etAccountName)))) {
            etAccountName.setError(getString(R.string.error_invalid_credential));
            etAccountName.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etAccountNumber).isEmpty()) {
            etAccountNumber.setError(getString(R.string.error_cannot_be_empty));
            etAccountNumber.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etGST).isEmpty()) {
            etGST.setError(getString(R.string.error_cannot_be_empty));
            etGST.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidGST(Utils.getProperText(etGST)))) {
            etGST.setError(getString(R.string.error_invalid_credential));
            etGST.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etPAN).isEmpty()) {
            etPAN.setError(getString(R.string.error_cannot_be_empty));
            etPAN.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidPAN(Utils.getProperText(etPAN)))) {
            etPAN.setError(getString(R.string.error_invalid_credential));
            etPAN.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etCIN).isEmpty()) {
            etCIN.setError(getString(R.string.error_cannot_be_empty));
            etCIN.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidCIN(Utils.getProperText(etCIN)))) {
            etCIN.setError(getString(R.string.error_invalid_credential));
            etCIN.requestFocus();
            isOk = false;
        } else if (pathPAN.isEmpty()) {
            Toaster.customToast("PAN should be Uploaded");
            isOk = false;
        } else if (pathGST.isEmpty()) {
            Toaster.customToast("GST should be Uploaded");
            isOk = false;
        } else if (pathCIN.isEmpty()) {
            Toaster.customToast("CIN should be Uploaded");
            isOk = false;
        } else if (pathCHQ.isEmpty()) {
            Toaster.customToast("Can. Cheque should be Uploaded");
            isOk = false;
        } else if (pathDOC.isEmpty()) {
            Toaster.customToast("Address Proof should be Uploaded");
            isOk = false;
        }
        return isOk;
    }

    private HashMap<String,Object> getBankData(){
        HashMap<String ,Object> map=  new HashMap<>();
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        if(ModelManager.modelManager().getCurrentUser().getUserBankDetails()!=null){
            map.put(kBankId, ModelManager.modelManager().getCurrentUser().getUserBankDetails().getBankId());
        }
        map.put(kIFSCCode, Utils.getProperText(etIFSC));
        map.put(kBankName, Utils.getProperText(etBankName));
        map.put(kBankBranch, Utils.getProperText(etBankBranch));
        map.put(kAccountType, Utils.getProperText(tvAccountType));
        map.put(kAccountName, Utils.getProperText(etAccountName));
        map.put(kAccountNumber, Utils.getProperText(etAccountNumber));
        map.put(kGSTNumber, Utils.getProperText(etGST));
        map.put(kPANNumber, Utils.getProperText(etPAN));
        map.put(kCINNumber, Utils.getProperText(etCIN));
        if(pathGST.contains("/"))
            map.put(kGSTImage, ImageCompressor.compressFile(new File(pathGST),getActivity()));
        if(pathPAN.contains("/"))
            map.put(kPANImage, ImageCompressor.compressFile(new File(pathPAN),getActivity()));
        if(pathCIN.contains("/"))
            map.put(kCINImage, ImageCompressor.compressFile(new File(pathCIN),getActivity()));
        if(pathCHQ.contains("/"))
            map.put(kChequeImage, ImageCompressor.compressFile(new File(pathCHQ),getActivity()));
        if(pathDOC.contains("/"))
            map.put(kProofImage, ImageCompressor.compressFile(new File(pathDOC),getActivity()));

        return map;
    }

    private void setUpdateProfile(){
        loaderView.showLoader();
        HashMap<String ,Object> map = getBankData();
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userAddFacilityBank(map,
                (Constants.Status iStatus, GenericResponse<FacBankModel> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        FacBankModel bankDetails = genericResponse.getObject();
                        listener.bankComplete();
                        Log.e(TAG,bankDetails.toString());
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }

    public void setBankCompleteListener(BankCompleteListener callback) {
        this.listener = callback;
    }

    public interface BankCompleteListener{
        void bankComplete();
    }
}
