package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Models.Owner.FacGallery;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class FacilityGalleryAdapter extends RecyclerView.Adapter<FacilityGalleryAdapter.MyViewHolder> {
    private CopyOnWriteArrayList<FacGallery> gallery;
    private Context context;
    private static ItemClickListener listener;

    public FacilityGalleryAdapter(Context context, CopyOnWriteArrayList<FacGallery> list , ItemClickListener callback) {
        this.gallery = list;
        this.context = context;
        listener= callback;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_event_gallery_view, parent, false);
        return new MyViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, final int position) {
        FacGallery label = gallery.get(position);

        final Transformation transformation = new MaskTransformation(context, R.drawable.canvas_booking_details_img_bg);
        if(label.getGalleryImg().isEmpty())
            Picasso.with(context).load(R.drawable.running_event)
                    .fit().transform(transformation).into(holder.imgView);
        else{
            String path = kImageBaseUrl+label.getFolderName()+"/"+label.getGalleryImg();
            Picasso.with(context).load(path)
                    .fit().transform(transformation).into(holder.imgView);
        }
        holder.btRemove.setOnClickListener(view -> {
            listener.imageDelete(label);
        });
    }

    /*public void addView(String path) {
        gallery.add(new FacGallery(21,"",path, Constants.GalleryStatus.active.toString()));
        notifyDataSetChanged();
    }*/

    public void addView(FacGallery facGallery){
        gallery.add(facGallery);
        notifyDataSetChanged();
    }

    public void deleteView(FacGallery facGallery){
        gallery.remove(facGallery);
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return gallery.size();
    }

    class MyViewHolder extends RecyclerView.ViewHolder {
        ImageView imgView;
        ImageButton btRemove;

        MyViewHolder(View itemView) {
            super(itemView);
            imgView = itemView.findViewById(R.id.iv_gallery);
            btRemove = itemView.findViewById(R.id.bt_close);
        }
    }

    public interface ItemClickListener{
        void imageDelete(FacGallery facGallery);
    }
}
