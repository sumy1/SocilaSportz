package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.User.Activities.AcademyDetailActivity;
import com.socialsportz.Activities.User.Activities.FacilityDetailActivity;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class FavFacilityAdapter extends RecyclerView.Adapter<FavFacilityAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserFacAca> mData;
    private ItemClickListener listener;


    public FavFacilityAdapter(Context context, CopyOnWriteArrayList<UserFacAca> mData, ItemClickListener listener) {
        this.context = context;
        this.mData = mData;
        this.listener = listener;
    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_view_user_fav_item, parent, false);
        return new myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int position) {
		UserFacAca facility = mData.get(position);

//        :::: Below method is only for for Static Image
        if(!facility.getFacBannerImg().isEmpty()){
            String imgPath = kImageBaseUrl+facility.getFacFolder()+"/"+facility.getFacBannerImg();
            Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
        }else{
            Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
        }

		if(String.valueOf(facility.getRatingAvg()).equals("0")){
			myViewHolder.rate_layout.setVisibility(View.GONE);
		}else{
			myViewHolder.rate_layout.setVisibility(View.VISIBLE);
			myViewHolder.tvRating.setText(String.valueOf(facility.getRatingAvg()));
		}

        myViewHolder.tvName.setText(facility.getFacName());
        myViewHolder.tvAdd.setText(facility.getFacGoogleAdd());

        myViewHolder.ll_explore.setOnClickListener(V->{

        	if(facility.getFacType().equalsIgnoreCase("facility")){
				Intent intent = new Intent(context, FacilityDetailActivity.class);
				intent.putExtra("bundleUserFac",facility);
				intent.putExtra("TYPE",capitizeString(facility.getFacType()));
				intent.putExtra("FROM","1");
				context.startActivity(intent);
			}else if(facility.getFacType().equalsIgnoreCase("academy")) {
				Intent intent = new Intent(context, AcademyDetailActivity.class);
				intent.putExtra("bundleUserFac", facility);
				intent.putExtra("TYPE", capitizeString(facility.getFacType()));
				intent.putExtra("FROM", "1");
				context.startActivity(intent);
			}

		});







        myViewHolder.img_delete.setOnClickListener(v->listener.buttonPress(mData.get(position).getFavouriteId(),position,mData.get(position).getFacType()));




    }

	private String capitizeString(String name){
		String captilizedString="";
		if(!name.trim().equals("")){
			captilizedString = name.substring(0,1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
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
        ImageView ivBanner,img_delete;
        TextView tvName,tvAdd,tvRating,tvTime;
		LinearLayout ll_explore,rate_layout;
        private myViewHolder(View itemView) {
            super(itemView);
            ivBanner = itemView.findViewById(R.id.iv_banner);
            tvName = itemView.findViewById(R.id.tv_field);
            tvAdd = itemView.findViewById(R.id.tv_venue);
            tvRating = itemView.findViewById(R.id.tv_rating);
            tvTime = itemView.findViewById(R.id.tv_time);
			rate_layout=itemView.findViewById(R.id.rate_layout);
            img_delete=itemView.findViewById(R.id.img_delete);
			ll_explore=itemView.findViewById(R.id.ll_explore);
        }
    }

    public interface ItemClickListener{
        void buttonPress(String fav_id, int pos,String facType);
    }

    public void setClickListener(ItemClickListener callback) {
        listener = callback;
    }


}
