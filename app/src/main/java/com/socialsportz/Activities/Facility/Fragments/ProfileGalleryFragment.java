package com.socialsportz.Activities.Facility.Fragments;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.os.Parcelable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacGallery;
import com.socialsportz.R;
import com.socialsportz.Utils.Toaster;

import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.viewpager.widget.PagerAdapter;
import androidx.viewpager.widget.ViewPager;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static android.app.Activity.RESULT_OK;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class ProfileGalleryFragment extends Fragment implements View.OnClickListener{
    private static ViewPager mPager;
    private ImageView galleryIv;
    private CopyOnWriteArrayList<FacGallery> imagesList = new CopyOnWriteArrayList<>();
    private int facId=0;

    public ProfileGalleryFragment(){ }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_facility_gallery, container, false);
        mPager = rootView.findViewById(R.id.pager);
        galleryIv=rootView.findViewById(R.id.iv_fac);
        init();
        rootView.findViewById(R.id.ib_edit_gallery).setOnClickListener(this);
        return rootView;
    }


    private void init() {
        setGalleryData();
    }

    private void setGalleryData(){
        try{
            facId = ModelManager.modelManager().getCurrentUser().getSelectedFacId();
            if(facId!=0){
                HashMap<String,Object> map = new HashMap<>();
                map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
                ModelManager.modelManager().userFacGalleryListing(map, (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacGallery>> genericResponse) -> {
                    try {
                        imagesList = genericResponse.getObject();
                        mPager.setAdapter(new FacilityGalleryImageAdapter(getActivity(), imagesList));
                        if(!imagesList.isEmpty()){
                            FacGallery facGallery = imagesList.get(0);
                            Transformation transformation = new MaskTransformation(Objects.requireNonNull(getContext()),
                                    R.drawable.canvas_booking_details_img_bg);
                            String path = kImageBaseUrl+facGallery.getFolderName()+"/"+facGallery.getGalleryImg();
                            Picasso.with(getActivity()).load(path).placeholder(R.drawable.placeholder_300)
                                    .fit().transform(transformation).into(galleryIv);
                        }else{
                            Transformation transformation = new MaskTransformation(Objects.requireNonNull(getContext()),
                                    R.drawable.canvas_booking_details_img_bg);
                            Picasso.with(getActivity()).load(R.drawable.placeholder_300)
                                    .fit().transform(transformation).into(galleryIv);
                        }
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
            }
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    @Override
    public void onClick(View view) {
        if(view.getId()== R.id.ib_edit_gallery){
            if(facId!=0){
                EditFacilityGalleryDialogFragment fragment = new EditFacilityGalleryDialogFragment();
                Bundle bdl = new Bundle();
                bdl.putInt(KSCREENWIDTH, 0);
                bdl.putInt(KSCREENHEIGHT, 0);
                bdl.putInt(kFacId,facId);
                bdl.putSerializable(kData,imagesList);
                fragment.setArguments(bdl);
                fragment.setTargetFragment(this, GALLERY_PIC_RESULT);
                assert getFragmentManager() != null;
                fragment.show(getFragmentManager(), "Dialog Fragment");
            }else{
                Toaster.customToast("Please Add Facility/Academy");
            }
        }
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if(requestCode==GALLERY_PIC_RESULT){
            if(resultCode==RESULT_OK){
                setGalleryData();
            }
        }
    }

    class FacilityGalleryImageAdapter extends PagerAdapter {
        private CopyOnWriteArrayList<FacGallery> images;
        private Context context;

        FacilityGalleryImageAdapter(Context context, CopyOnWriteArrayList<FacGallery> images) {
            this.context = context;
            this.images = images;
        }

        @NonNull
        @Override
        public Object instantiateItem(@NonNull ViewGroup view, int position) {
            LayoutInflater inflater = LayoutInflater.from(context);
            View imageLayout = inflater.inflate(R.layout.facility_gallery_vp_design, view, false);
            FacGallery facGallery = images.get(position);
            assert imageLayout != null;
            ImageView imageView = imageLayout.findViewById(R.id.gallery_iv);
            Transformation transformation = new MaskTransformation(context, R.drawable.canvas_booking_details_img_bg);
            String path = kImageBaseUrl+facGallery.getFolderName()+"/"+facGallery.getGalleryImg();
            Picasso.with(getActivity()).load(path).placeholder(R.drawable.placeholder_300)
                    .fit().transform(transformation).into(imageView);
            imageView.setOnClickListener(view1 -> Picasso.with(getActivity()).load(path)
                    .placeholder(R.drawable.placeholder_300)
                    .fit().into(galleryIv));
            view.addView(imageLayout, 0);

            return imageLayout;
        }

        @Override
        public void destroyItem(ViewGroup container, int position, @NonNull Object object) {
            container.removeView((View) object);
        }

        @Override
        public int getCount() {
            return images.size();
        }

        @Override
        public boolean isViewFromObject(View view, @NonNull Object object) {
            return view.equals(object);
        }

        @Override
        public void restoreState(Parcelable state, ClassLoader loader) {
        }

        @Override
        public Parcelable saveState() {
            return null;
        }

        @Override
        public float getPageWidth(int position) {
            return 0.3f;
        }

    }

}
