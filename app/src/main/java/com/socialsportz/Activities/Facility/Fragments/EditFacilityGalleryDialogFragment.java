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
import android.widget.TextView;

import com.google.android.material.snackbar.Snackbar;
import com.socialsportz.Activities.Facility.Adapters.FacilityGalleryAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacGallery;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.ImageCompressor;
import com.socialsportz.Utils.Toaster;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.DialogFragment;
import androidx.recyclerview.widget.RecyclerView;

import static android.app.Activity.RESULT_OK;
import static com.facebook.FacebookSdk.getApplicationContext;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSIONS_STORAGE;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kGalleryId;
import static com.socialsportz.Constants.Constants.kGalleryImage;
import static com.socialsportz.Constants.Constants.kImageDeleteSuccessful;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;

public class EditFacilityGalleryDialogFragment extends DialogFragment{

    private static String TAG = FragmentOnGoFacility.class.getSimpleName();
    private CopyOnWriteArrayList<FacGallery> images;
    private int facId;
    private Dialog dialog;
    private String picturePath="";
    private FacilityGalleryAdapter adapter;
    private CustomLoaderView loaderView;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth  = mArgs.getInt(KSCREENWIDTH);
        facId = mArgs.getInt(kFacId);
        images = (CopyOnWriteArrayList<FacGallery>) mArgs.getSerializable(kData);
        Dialog d = getDialog();
        if (d!=null){
            Objects.requireNonNull(d.getWindow()).setLayout(pWidth-100, pHeight-100);
            d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
            Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
            d.getWindow().setBackgroundDrawable(drawable);
        }
    }

    @NonNull
    @Override
    public Dialog onCreateDialog(Bundle savedInstanceState) {
        return new Dialog(Objects.requireNonNull(getActivity()), getTheme()){
            @Override
            public void onBackPressed() {
                Intent in = Objects.requireNonNull(getActivity()).getIntent();
                (Objects.requireNonNull(getTargetFragment())).onActivityResult(getTargetRequestCode(),RESULT_OK,in);
                Objects.requireNonNull(getDialog()).dismiss();
            }
        };
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_dialog_edit_fac_gallery, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());

        RecyclerView recyclerView = view.findViewById(R.id.rv_event_gallery);
        adapter = new FacilityGalleryAdapter(getActivity(), images, facGallery -> setGalleryData(facGallery,""));
        recyclerView.setAdapter(adapter);

        view.findViewById(R.id.btn_add).setOnClickListener(view1 -> {
            if(adapter.getItemCount()==8){
                Toaster.customToast("Cannot add more than 8 pictures");
            }else if(adapter.getItemCount()<8){
                checkAndroidVersion();
            }
        });

        Toolbar toolbar = view.findViewById(R.id.toolbar);
        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> {
            Intent in = Objects.requireNonNull(getActivity()).getIntent();
            (Objects.requireNonNull(getTargetFragment())).onActivityResult(getTargetRequestCode(),RESULT_OK,in);
            Objects.requireNonNull(getDialog()).dismiss();
        });

        return view;
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
        if (resultCode == RESULT_OK) {
            if (requestCode == GALLERY_PIC_RESULT) {
                Uri selectedImage = data.getData();
                String[] filePath = {MediaStore.Images.Media.DATA};
                assert selectedImage != null;
                Cursor c = Objects.requireNonNull(getActivity()).getContentResolver().query(selectedImage, filePath, null, null, null);
                assert c != null;
                c.moveToFirst();
                int columnIndex = c.getColumnIndex(filePath[0]);
                picturePath = c.getString(columnIndex);
                c.close();
                Log.w(TAG,"picturePath" + picturePath);
                Bitmap bm = BitmapFactory.decodeFile(picturePath);
                ByteArrayOutputStream baos = new ByteArrayOutputStream();
                bm.compress(Bitmap.CompressFormat.JPEG, 100, baos); //bm is the bitmap object
                byte[] b = baos.toByteArray();
                if (b.length > 1024 * 1024) {
                    Toaster.customToast("File size should be less than 1MB");
                } else {
                    if(validate())
                        setGalleryData(null,picturePath);
                }
            } else if( requestCode == PERMISSIONS_REQUEST){
                if(checkSelfPermission()){
                    dialog.dismiss();
                }
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
        if (picturePath.isEmpty()) {
            Toaster.customToast("Invalidate Image");
            isOk = false;
        }

        return isOk;
    }

    private void setGalleryData(FacGallery facGallery, String path){
        HashMap<String,Object> map = new HashMap<>();
        map.put(kFacId,facId);
        if(!path.isEmpty())
            map.put(kGalleryImage, ImageCompressor.compressFile(new File(path),getActivity()));
        if(facGallery!=null)
            map.put(kGalleryId,facGallery.getGalleryId());
        loaderView.showLoader();
        ModelManager.modelManager().userFacAddEditGallery(map, (Constants.Status iStatus, GenericResponse<FacGallery> genericResponse) -> {
            loaderView.hideLoader();
            try {
                if(!path.isEmpty()){
                    FacGallery gallery = genericResponse.getObject();
                    adapter.addView(gallery);
                }else if(facGallery!=null){
                    adapter.deleteView(facGallery);
                    Toaster.customToast(kImageDeleteSuccessful);
                }
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }


}
