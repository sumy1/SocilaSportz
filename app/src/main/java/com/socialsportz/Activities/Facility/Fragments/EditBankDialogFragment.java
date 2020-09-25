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

import com.google.android.material.snackbar.Snackbar;
import com.google.android.material.textfield.TextInputEditText;
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
import androidx.appcompat.widget.Toolbar;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.DialogFragment;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.EDIT_BANK_RESULT;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSIONS_STORAGE;
import static com.socialsportz.Constants.Constants.kAccountName;
import static com.socialsportz.Constants.Constants.kAccountNumber;
import static com.socialsportz.Constants.Constants.kAccountType;
import static com.socialsportz.Constants.Constants.kBankBranch;
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

public class EditBankDialogFragment extends DialogFragment implements View.OnClickListener {

    private TextInputEditText etIFSC, etBank, etBranch, etName, etNumber, etGST, etPAN, etCIN;
    private DropDownView dvType;
    private ImageView ivType, ivGST, ivPAN, ivCIN, ivDOC, ivCHQ;
    private LinearLayout layGST, layPAN, layCIN, layDOC, layCHQ;
    private RelativeLayout rlGST, rlPAN, rlCIN, rlDOC, rlCHQ;
    private String pathPAN = "", pathGST = "", pathCIN = "", pathCHQ = "", pathDOC = "";
    private TextView tvTypeHint;
    private View divider;
    private Dialog dialog;
    private String imageType;
    CustomLoaderView loaderView;
    Toolbar toolbar;
    private static String TAG = FragmentOnGoFacility.class.getSimpleName();

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth = mArgs.getInt(KSCREENWIDTH);
        Dialog d = getDialog();
        if (d != null) {
            Objects.requireNonNull(d.getWindow()).setLayout(pWidth - 100, pHeight - 100);
            d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
            Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
            d.getWindow().setBackgroundDrawable(drawable);
        }

    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_dialog_edit_bank, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());
        initView(view);
        initData();
        return view;
    }

    private void initView(View view) {
        ivGST = view.findViewById(R.id.iv_gst);
        ivPAN = view.findViewById(R.id.iv_pan);
        ivCIN = view.findViewById(R.id.iv_cin);
        ivDOC = view.findViewById(R.id.iv_doc);
        ivCHQ = view.findViewById(R.id.iv_chq);
        layGST = view.findViewById(R.id.lay_gst);
        rlGST = view.findViewById(R.id.rl_gst);
        layPAN = view.findViewById(R.id.lay_pan);
        rlPAN = view.findViewById(R.id.rl_pan);
        layCIN = view.findViewById(R.id.lay_cin);
        rlCIN = view.findViewById(R.id.rl_cin);
        layDOC = view.findViewById(R.id.lay_doc);
        rlDOC = view.findViewById(R.id.rl_doc);
        layCHQ = view.findViewById(R.id.lay_chq);
        rlCHQ = view.findViewById(R.id.rl_chq);
        view.findViewById(R.id.frame_gst).setOnClickListener(this);
        view.findViewById(R.id.frame_pan).setOnClickListener(this);
        view.findViewById(R.id.frame_cin).setOnClickListener(this);
        view.findViewById(R.id.frame_doc).setOnClickListener(this);
        view.findViewById(R.id.frame_chq).setOnClickListener(this);
        view.findViewById(R.id.bt_gst).setOnClickListener(this);
        view.findViewById(R.id.bt_pan).setOnClickListener(this);
        view.findViewById(R.id.bt_cin).setOnClickListener(this);
        view.findViewById(R.id.bt_chq).setOnClickListener(this);
        view.findViewById(R.id.bt_doc).setOnClickListener(this);

        etIFSC = view.findViewById(R.id.et_ifsc_code);
        ImageView ivIFSC = view.findViewById(R.id.iv_ifsc);
        setFocusListener(etIFSC, ivIFSC);

        etBank = view.findViewById(R.id.et_bank_name);
        ImageView ivBank = view.findViewById(R.id.iv_bank);
        setFocusListener(etBank, ivBank);

        etBranch = view.findViewById(R.id.et_bank_branch);
        ImageView ivBranch = view.findViewById(R.id.iv_branch);
        setFocusListener(etBranch, ivBranch);

        ArrayList<DataModel> options = new ArrayList<>();
        options.add(new DataModel(1, "Saving"));
        options.add(new DataModel(2, "Current"));
        dvType = view.findViewById(R.id.drop_type);
        ivType = view.findViewById(R.id.iv_type);
        tvTypeHint = view.findViewById(R.id.type_hint);
        divider = view.findViewById(R.id.divider);
        dvType.setOptionList(options);
        dvType.setClickListener(new DropDownView.onClickInterface() {
            @Override
            public void onClickAction() {
                setTypeFocus(ivType, tvTypeHint, divider, R.color.theme_color, 5);
            }

            @Override
            public void onClickDone(int id, String name) {
                setTypeFocus(ivType, tvTypeHint, divider, R.color.dim_grey, 3);
            }

            @Override
            public void onDismiss() {
                setTypeFocus(ivType, tvTypeHint, divider, R.color.dim_grey, 3);
            }
        });

        etName = view.findViewById(R.id.et_account_name);
        ImageView ivName = view.findViewById(R.id.iv_name);
        setFocusListener(etName, ivName);

        etNumber = view.findViewById(R.id.et_account_no);
        ImageView ivNumber = view.findViewById(R.id.iv_account);
        setFocusListener(etNumber, ivNumber);

        etGST = view.findViewById(R.id.et_gst_no);
        ImageView ivGST = view.findViewById(R.id.iv_gst_no);
        setFocusListener(etGST, ivGST);

        etPAN = view.findViewById(R.id.et_pan_no);
        ImageView ivPAN = view.findViewById(R.id.iv_pan_no);
        setFocusListener(etPAN, ivPAN);

        etCIN = view.findViewById(R.id.et_cin_no);
        ImageView ivCIN = view.findViewById(R.id.iv_cin_no);
        setFocusListener(etCIN, ivCIN);

        toolbar = view.findViewById(R.id.toolbar);
        toolbar.inflateMenu(R.menu.menu_day_time);

        // Set an OnMenuItemClickListener to handle menu item clicks
        toolbar.setOnMenuItemClickListener(menuItem -> {
            if (menuItem.getItemId() == R.id.action_done) {
                if (validate())
                    setUpdateProfile();
                return true;
            } else {
                return false;
            }
        });

        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> getDialog().dismiss());
    }

    private void setFocusListener(TextInputEditText etFiled, ImageView ivImage) {
        etFiled.setOnFocusChangeListener((view, b) -> {
            if (b) {
                ivImage.setImageTintList(getResources().getColorStateList(R.color.theme_color));
                //ivImage.setColorFilter(ContextCompat.getColor(getActivity(), R.color.theme_color), android.graphics.PorterDuff.Mode.MULTIPLY);
            } else {
                ivImage.setImageTintList(getResources().getColorStateList(R.color.dim_grey));
                //ivImage.setColorFilter(ContextCompat.getColor(getActivity(), R.color.dim_grey), android.graphics.PorterDuff.Mode.MULTIPLY);

            }
        });
    }

    private void setTypeFocus(ImageView ivImage, TextView text, View divider, int color, int height) {
        ivImage.setImageTintList(getResources().getColorStateList(color));
        text.setTextColor(ContextCompat.getColor(Objects.requireNonNull(getActivity()), color));
        divider.setBackgroundColor(ContextCompat.getColor(getActivity(), color));
        ViewGroup.LayoutParams params = divider.getLayoutParams();
        params.height = height;
        divider.setLayoutParams(params);
    }

    private void initData() {
        try {
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            FacBankModel model = user.getUserBankDetails();
            if (model != null) {
                etIFSC.setText(model.getIfscCode());
                etBank.setText(model.getBankName());
                etBranch.setText(model.getBankBranch());
                dvType.setText(model.getAccountType());
                etName.setText(model.getAccountName());
                etNumber.setText(model.getAccountNumber());
                etGST.setText(model.getGSTNumber());
                etPAN.setText(model.getPANNumber());
                etCIN.setText(model.getCINNumber());

                pathPAN = model.getPANImage();
                setPicture(layPAN, rlPAN);
                setImageUrl(model, pathPAN, ivPAN);
                pathGST = model.getGSTImage();
                setPicture(layGST, rlGST);
                setImageUrl(model, pathGST, ivGST);
                pathCIN = model.getCINImage();
                setPicture(layCIN, rlCIN);
                setImageUrl(model, pathCIN, ivCIN);
                pathCHQ = model.getChequeImage();
                setPicture(layCHQ, rlCHQ);
                setImageUrl(model, pathCHQ, ivCHQ);
                pathDOC = model.getAddressImage();
                setPicture(layDOC, rlDOC);
                setImageUrl(model, pathDOC, ivDOC);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void setImageUrl(FacBankModel model, String path, ImageView im) {
        String urlPath = kImageBaseUrl + model.getFolderName() + "/" + path;
        Picasso.with(getActivity()).load(urlPath).placeholder(R.drawable.placeholder_300).into(im);
    }


    @Override
    public void onClick(View view) {
        if (view.getId() == R.id.frame_gst) {
            imageType = kGSTImage;
            checkAndroidVersion();
        } else if (view.getId() == R.id.frame_pan) {
            imageType = kPANImage;
            checkAndroidVersion();
        } else if (view.getId() == R.id.frame_cin) {
            imageType = kCINImage;
            checkAndroidVersion();
        } else if (view.getId() == R.id.frame_doc) {
            imageType = kProofImage;
            checkAndroidVersion();
        } else if (view.getId() == R.id.frame_chq) {
            imageType = kChequeImage;
            checkAndroidVersion();
        } else if (view.getId() == R.id.bt_gst) {
            pathGST = "";
            setEmptyPath(layGST, rlGST);
        } else if (view.getId() == R.id.bt_pan) {
            pathPAN = "";
            setEmptyPath(layPAN, rlPAN);
        } else if (view.getId() == R.id.bt_cin) {
            pathCIN = "";
            setEmptyPath(layCIN, rlCIN);
        } else if (view.getId() == R.id.bt_chq) {
            pathCHQ = "";
            setEmptyPath(layCHQ, rlCHQ);
        } else if (view.getId() == R.id.bt_doc) {
            pathDOC = "";
            setEmptyPath(layDOC, rlDOC);
        }
    }

    private void setEmptyPath(LinearLayout lay, RelativeLayout rl) {
        lay.setVisibility(View.VISIBLE);
        rl.setVisibility(View.GONE);
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
                    setImageBackground(picturePath);
                }
            }
        } else if (requestCode == PERMISSIONS_REQUEST) {
            if (checkSelfPermission()) {
                dialog.dismiss();
            }
        }
    }

    private void setImageBackground(String picPath) {
        final Transformation transformation = new MaskTransformation(Objects.requireNonNull(getActivity()), R.drawable.canvas_booking_details_img_bg);
        switch (imageType) {
            case kGSTImage:
                setPicture(layGST, rlGST);
                Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivGST);
                break;
            case kPANImage:
                setPicture(layPAN, rlPAN);
                Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivPAN);
                break;
            case kCINImage:
                setPicture(layCIN, rlCIN);
                Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivCIN);
                break;
            case kProofImage:
                setPicture(layDOC, rlDOC);
                Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivDOC);
                break;
            case kChequeImage:
                setPicture(layCHQ, rlCHQ);
                Picasso.with(getActivity()).load(new File(picPath)).fit().transform(transformation).into(ivCHQ);
                break;
        }
    }

    private void setPicture(LinearLayout lay, RelativeLayout rl) {
        lay.setVisibility(View.GONE);
        rl.setVisibility(View.VISIBLE);
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

        if (Utils.getProperText(etIFSC).isEmpty()) {
            etIFSC.setError(getString(R.string.error_cannot_be_empty));
            etIFSC.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidIFSC(Utils.getProperText(etIFSC)))) {
            etIFSC.setError(getString(R.string.error_invalid_credential));
            etIFSC.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etBank).isEmpty()) {
            etBank.setError(getString(R.string.error_cannot_be_empty));
            etBank.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidName(Utils.getProperText(etBank)))) {
            etBank.setError(getString(R.string.error_invalid_credential));
            etBank.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etBranch).isEmpty()) {
            etBranch.setError(getString(R.string.error_cannot_be_empty));
            etBranch.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(dvType).isEmpty()) {
            Toaster.customToast("Account Type Invalid");
            isOk = false;
        } else if (Utils.getProperText(etName).isEmpty()) {
            etName.setError(getString(R.string.error_cannot_be_empty));
            etName.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidName(Utils.getProperText(etName)))) {
            etName.setError(getString(R.string.error_invalid_credential));
            etName.requestFocus();
            isOk = false;
        } else if (Utils.getProperText(etNumber).isEmpty()) {
            etNumber.setError(getString(R.string.error_cannot_be_empty));
            etNumber.requestFocus();
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

    private HashMap<String, Object> getBankData() {
        CurrentUser user= ModelManager.modelManager().getCurrentUser();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kUserId,user.getUserId());
        map.put(kIFSCCode, Utils.getProperText(etIFSC));
        map.put(kBankName, Utils.getProperText(etBank));
        map.put(kBankBranch, Utils.getProperText(etBranch));
        map.put(kAccountType, Utils.getProperText(dvType));
        map.put(kAccountName, Utils.getProperText(etName));
        map.put(kAccountNumber, Utils.getProperText(etNumber));
        map.put(kGSTNumber, Utils.getProperText(etGST));
        map.put(kPANNumber, Utils.getProperText(etPAN));
        map.put(kCINNumber, Utils.getProperText(etCIN));
        map.put(kGSTImage, ImageCompressor.compressFile(new File(pathGST),getActivity()));
        map.put(kPANImage, ImageCompressor.compressFile(new File(pathPAN),getActivity()));
        map.put(kCINImage, ImageCompressor.compressFile(new File(pathCIN),getActivity()));
        map.put(kChequeImage, ImageCompressor.compressFile(new File(pathCHQ),getActivity()));
        map.put(kProofImage, ImageCompressor.compressFile(new File(pathDOC),getActivity()));

        return map;
    }

    private void setUpdateProfile() {
        loaderView.showLoader();
        HashMap<String, Object> map = getBankData();
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userAddFacilityBank(map,
                (Constants.Status iStatus, GenericResponse<FacBankModel> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        FacBankModel bankDetails = genericResponse.getObject();
                        Intent in = Objects.requireNonNull(getActivity()).getIntent();
                        (Objects.requireNonNull(getTargetFragment())).onActivityResult(getTargetRequestCode(), EDIT_BANK_RESULT, in);
                        Objects.requireNonNull(getDialog()).dismiss();
                        Log.e(TAG, bankDetails.toString());
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }
}
