package com.socialsportz.Activities.User.Adapters;

import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.ImageView;
import android.widget.TextView;

import com.socialsportz.Models.User.UserEventViewGallery;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.R;
import com.socialsportz.Utils.HorizontalSpaceItemDecoration;
import com.squareup.picasso.Picasso;

import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.StaggeredGridLayoutManager;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventViewGallaryAdapter extends RecyclerView.Adapter<EventViewGallaryAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserEventViewGallery> mData;
    /*private onItemClickListener listener;*/
	EventViewGallaryAdapter viewGallaryAdapter;
	Dialog dialog;
	String newImage,folder;


    public EventViewGallaryAdapter(Context context, CopyOnWriteArrayList<UserEventViewGallery> mData) {
        this.context = context;
        this.mData = mData;

        Log.d("Size",mData.size()+"");
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
        	CongratsDialog(mData.get(position).getFolderName(),mData.get(position).getGalleryImg());
        });
    }


    @Override
    public int getItemCount() {
        return mData.size();
    }


	private void CongratsDialog(String folderName,String galleryImage){

    	newImage=galleryImage;
		folder=folderName;
		  dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_zoom);
		dialog.setCancelable(true);
		ImageView tv_msg=dialog.findViewById(R.id.img_banner);
		TextView img_cross=dialog.findViewById(R.id.iv_cross);
		RecyclerView rv_view_galleryy = dialog.findViewById(R.id.rv_view_galleryy);
		rv_view_galleryy.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL ));
		rv_view_galleryy.addItemDecoration(new HorizontalSpaceItemDecoration(10));
		rv_view_galleryy.setHasFixedSize(true);
		EventViewGallaryAdapterr viewGallaryAdapter = new EventViewGallaryAdapterr(context, mData, new ViewGallaryAdapterr.onItemClickListener() {
			@Override
			public void onGalleryClick(String folderpath,String image) {

				Log.d("NewImage",image);
				newImage=image;
				folder=folderpath;
				if(!newImage.isEmpty()){

					Log.d("name",folderName+"/"+newImage);

					String imagee=kImageBaseUrl+folder+"/"+newImage;
					Picasso.with(context).load(imagee).placeholder(R.drawable.running_event).fit().into(tv_msg);
				}else{
					Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(tv_msg);
				}
			}
		});
		rv_view_galleryy.setAdapter(viewGallaryAdapter);



		img_cross.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {
				dialog.dismiss();
				//imgPath="";
			}
		});

		if(!newImage.isEmpty()){

			Log.d("name",folderName+"/"+newImage);

			String image=kImageBaseUrl+folder+"/"+newImage;
			Picasso.with(context).load(image).placeholder(R.drawable.running_event).fit().into(tv_msg);
		}else{
			Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(tv_msg);
		}


		dialog.show();
	}

    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView iv_banner;
        private myViewHolder(View itemView) {
            super(itemView);
            iv_banner = itemView.findViewById(R.id.iv_banner);
        }
    }

    public interface onItemClickListener{
        void onFacilityClick(UserFacAca facAca);
    }
}
