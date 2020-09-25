package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Models.Owner.EventGallery;
import com.socialsportz.Models.Owner.Events;
import com.socialsportz.R;

import java.io.File;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventGalleryAdapter extends RecyclerView.Adapter<EventGalleryAdapter.ViewHolder> {
    private CopyOnWriteArrayList<EventGallery> labels;
    private Context context;
    private CopyOnWriteArrayList<EventGallery> deleteList;
    private Events events;

    public EventGalleryAdapter(CopyOnWriteArrayList<EventGallery> list, Context context, Events events) {
        this.labels = list;
        this.context = context;
        this.deleteList = new CopyOnWriteArrayList<>();
        this.events = events;

    }
    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_event_gallery_view, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull final ViewHolder holder, final int position) {
        final EventGallery label = labels.get(position);
        final Transformation transformation = new MaskTransformation(context, R.drawable.canvas_achievement_img_bg);
        if(label.getGalleryImg().contains("/")){
            Picasso.with(context).load(new File(label.getGalleryImg()))
                    .placeholder(R.drawable.placeholder_300).fit()
                    .transform(transformation).into(holder.imgView);
        }
        else{
            String path = kImageBaseUrl+events.getGalleryFolder()+"/"+label.getGalleryImg();
            Picasso.with(context).load(path)
                    .placeholder(R.drawable.placeholder_300).fit()
                    .transform(transformation).into(holder.imgView);
        }

        holder.btRemove.setOnClickListener(view -> {
            labels.remove(position);
            notifyItemRemoved(position);
            notifyItemRangeChanged(position,labels.size());
            if(!label.getGalleryImg().contains("/"))
                deleteList.add(label);
        });

    }

    public void addView(String path){
        labels.add(new EventGallery(path));
        notifyDataSetChanged();
    }

    public CopyOnWriteArrayList<EventGallery> getDeleteList(){
        return deleteList;
    }

    public CopyOnWriteArrayList<EventGallery> getAddedList(){
        CopyOnWriteArrayList<EventGallery> list = new CopyOnWriteArrayList<>();
        for(int i=0;i<labels.size();i++){
            if(labels.get(i).getGalleryImg().contains("/"))
                list.add(new EventGallery(labels.get(i).getGalleryImg()));
        }
        return list;
    }

    @Override
    public int getItemCount() {
        return labels.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        ImageView imgView;
        ImageButton btRemove;

        public ViewHolder(View itemView) {
            super(itemView);
            imgView = itemView.findViewById(R.id.iv_gallery);
            btRemove = itemView.findViewById(R.id.bt_close);
        }
    }
}
