package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.os.Parcelable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.R;

import java.util.ArrayList;

import androidx.annotation.NonNull;
import androidx.viewpager.widget.PagerAdapter;
import jp.wasabeef.picasso.transformations.MaskTransformation;

public class FacilityGalleryImageAdapter extends PagerAdapter {
    private ArrayList<Integer> IMAGES;
    private LayoutInflater inflater;
    private Context context;
    private ClickListner listener;


    public FacilityGalleryImageAdapter(Context context,ArrayList<Integer> IMAGES,ClickListner listener) {
        this.context = context;
        this.IMAGES=IMAGES;
        this.listener = listener;
        inflater = LayoutInflater.from(context);
    }

    @Override
    public void destroyItem(ViewGroup container, int position, Object object) {
        container.removeView((View) object);
    }

    @Override
    public int getCount() {
        return IMAGES.size();
    }

    @NonNull
    @Override
    public Object instantiateItem(ViewGroup view, int position) {
        View imageLayout = inflater.inflate(R.layout.facility_gallery_vp_design, view, false);

        assert imageLayout != null;
        final ImageView imageView = imageLayout.findViewById(R.id.gallery_iv);
        final Transformation transformation = new MaskTransformation(context, R.drawable.canvas_booking_details_img_bg);
        Picasso.with(context).load(IMAGES.get(position)).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(imageView);
        //ivSport.setImageResource(IMAGES.get(position));
        imageView.setOnClickListener(view1 -> listener.clickEvent(position));

        view.addView(imageLayout, 0);

        return imageLayout;
    }

    @Override
    public boolean isViewFromObject(View view, Object object) {
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

    public interface ClickListner{
        void clickEvent(int pos);
    }

}
