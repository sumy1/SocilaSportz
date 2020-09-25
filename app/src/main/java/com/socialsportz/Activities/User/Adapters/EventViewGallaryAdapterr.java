package com.socialsportz.Activities.User.Adapters;

import android.app.Activity;
import android.content.Context;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.socialsportz.Models.User.UserEventViewGallery;
import com.socialsportz.R;
import com.squareup.picasso.Picasso;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventViewGallaryAdapterr extends RecyclerView.Adapter<EventViewGallaryAdapterr.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserEventViewGallery> mData;
	private ViewGallaryAdapterr.onItemClickListener listener;





	public EventViewGallaryAdapterr(Context context, CopyOnWriteArrayList<UserEventViewGallery> mData, ViewGallaryAdapterr.onItemClickListener listener) {
		this.context = context;
		this.mData = mData;
		this.listener=listener;
	}


	@NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_view_image_gallery, parent, false);
        return new myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int position) {
        DisplayMetrics displayMetrics=new DisplayMetrics();
        ((Activity)context).getWindowManager().getDefaultDisplay().getMetrics(displayMetrics);
        myViewHolder.itemView.getLayoutParams().width = (int)(displayMetrics.widthPixels/2.5);

		UserEventViewGallery viewGallery = mData.get(position);
        if(!viewGallery.getGalleryImg().isEmpty()){
			String imgPath = kImageBaseUrl+viewGallery.getFolderName()+"/"+viewGallery.getGalleryImg();
            Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(myViewHolder.iv_banner);
        }else{
            Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(myViewHolder.iv_banner);
        }

        myViewHolder.iv_banner.setOnClickListener(v->{

        	Log.d("Click","Image");

        	listener.onGalleryClick(viewGallery.getFolderName(),viewGallery.getGalleryImg());

        });
    }


    @Override
    public int getItemCount() {
        return mData.size();
    }


    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView iv_banner;
        private myViewHolder(View itemView) {
            super(itemView);
            iv_banner = itemView.findViewById(R.id.iv_banner);
        }
    }

    public interface onItemClickListener{
        void onGalleryClick(String folderpath, String image);
    }
}
