package com.socialsportz.Activities.User.Adapters;

import android.app.Activity;
import android.content.Context;
import android.util.DisplayMetrics;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class DashFacilityAdapter  extends RecyclerView.Adapter<DashFacilityAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserFacAca> mData;
    private onItemClickListener listener;

    public DashFacilityAdapter(Context context, CopyOnWriteArrayList<UserFacAca> mData, onItemClickListener listener) {
        this.context = context;
        this.mData = mData;
        this.listener = listener;
    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_view_user_facility, parent, false);
        return new myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int position) {
        DisplayMetrics displayMetrics=new DisplayMetrics();
        ((Activity)context).getWindowManager().getDefaultDisplay().getMetrics(displayMetrics);
        myViewHolder.itemView.getLayoutParams().width = (int)(displayMetrics.widthPixels/2);
        UserFacAca facility = mData.get(position);
        if(!facility.getFacBannerImg().isEmpty()){
            String imgPath = kImageBaseUrl+facility.getFacFolder()+"/"+facility.getFacBannerImg();

            Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
        }else{
            Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
        }
        myViewHolder.tvName.setText(facility.getFacName());
        myViewHolder.tvAdd.setText(facility.getFacCity());



		if(String.valueOf(facility.getRatingAvg()).equals("0")){
			myViewHolder.rate_layout.setVisibility(View.GONE);
		}else{
			myViewHolder.rate_layout.setVisibility(View.VISIBLE);
			myViewHolder.tvRating.setText(String.valueOf(facility.getRatingAvg()));
		}



        myViewHolder.ll_explore.setOnClickListener(view -> listener.onFacilityClick(facility));
    }

    @Override
    public int getItemCount() {
        return mData.size();
    }

    public void newData(CopyOnWriteArrayList<UserFacAca> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView ivBanner;
        TextView tvName,tvAdd,tvRating;
        LinearLayout rate_layout;
		LinearLayout ll_explore;
        private myViewHolder(View itemView) {
            super(itemView);
            ivBanner = itemView.findViewById(R.id.iv_banner);
            tvName = itemView.findViewById(R.id.tv_field);
            tvAdd = itemView.findViewById(R.id.tv_venue);
            tvRating = itemView.findViewById(R.id.tv_rating);
			rate_layout=itemView.findViewById(R.id.rate_layout);
			ll_explore=itemView.findViewById(R.id.ll_explore);
        }
    }

    public interface onItemClickListener{
        void onFacilityClick(UserFacAca facAca);
    }
}
