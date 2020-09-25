package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.User.Activities.FacilityDetailActivity;
import com.socialsportz.Activities.User.Activities.UserCalaenderBookingActivity;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.StaggeredGridLayoutManager;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class FacilitySeeAllAdapter extends RecyclerView.Adapter<FacilitySeeAllAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserFacAca> mData;
    private boolean isCheck;

    public FacilitySeeAllAdapter(Context context, CopyOnWriteArrayList<UserFacAca> userReviewsData) {
        this.context = context;
        this.mData = userReviewsData;
    }

    @NonNull
    @Override
    public FacilitySeeAllAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_view_user_fav_item_seeall, parent, false);
        return new FacilitySeeAllAdapter.myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull FacilitySeeAllAdapter.myViewHolder myViewHolder, int position) {
		UserFacAca facility = mData.get(position);


		Log.d("value",mData.get(position).getFacAddress()+mData.get(position).getFacName());

		if(!facility.getFacBannerImg().isEmpty()){
			String imgPath = kImageBaseUrl+facility.getFacFolder()+"/"+facility.getFacBannerImg();
			Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
		}else{
			Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
		}


		myViewHolder.tvName.setText(facility.getFacName());
		myViewHolder.tvAdd.setText(facility.getFacGoogleAdd());


		if (facility.getRatingAvg().equalsIgnoreCase("0")) {
			myViewHolder.ll_rating.setVisibility(View.GONE);
		} else {
			myViewHolder.ll_rating.setVisibility(View.VISIBLE);
			myViewHolder.tvRating.setText(facility.getRatingAvg());
		}



		myViewHolder.ll_explore.setOnClickListener(view -> {


			Intent intent = new Intent(context, FacilityDetailActivity.class);
			intent.putExtra("bundleUserFac",facility);
			intent.putExtra("TYPE",capitizeString(facility.getFacType()));
			intent.putExtra("FROM","1");
			context.startActivity(intent);

		});

		myViewHolder.end_layout.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent in = new Intent(context, UserCalaenderBookingActivity.class);
				in.putExtra("Sports",facility.getFacSportList());
				in.putExtra("Id",facility.getFacId());
				in.putExtra("TYPE",facility.getFacType());
				in.putExtra("SPORTNAME","");
				in.putExtra("SPORTID","");
				in.putExtra("FROM","2");
				in.putExtra("FACNAME",facility.getFacName());
				context.startActivity(in);
			}
		});


		myViewHolder.rvSports.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL ));
		//myViewHolder.rvSports.addItemDecoration(new HorizontalSpaceItemDecoration(10));
		CopyOnWriteArrayList<Sport> list = facility.getFacSportList();
		CopyOnWriteArrayList<Sport> newList = new CopyOnWriteArrayList<>();
		if(list.size()>4){
			for(int i=0;i<4;i++){
				newList.add(list.get(i));
			}
		}else{
			newList.addAll(list);
		}
		SportListAdapter bookingListAdapter = new SportListAdapter(context,newList,list.size(),facility);
		myViewHolder.rvSports.setAdapter(bookingListAdapter);


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

    public void addData(CopyOnWriteArrayList<UserFacAca> list) {
		mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<UserFacAca> list){
		mData.clear();
		mData.addAll(list);
        notifyDataSetChanged();
    }


	class myViewHolder extends RecyclerView.ViewHolder {
		ImageView ivBanner;
		TextView tvName,tvAdd,tvRating,tvTime;
		RecyclerView rvSports;
		LinearLayout ll_explore,end_layout,ll_rating;
		private myViewHolder(View itemView) {
			super(itemView);
			ivBanner = itemView.findViewById(R.id.iv_banner);
			tvName = itemView.findViewById(R.id.tv_field);
			tvAdd = itemView.findViewById(R.id.tv_venue);
			tvRating = itemView.findViewById(R.id.tv_rating);
			tvTime = itemView.findViewById(R.id.tv_time);
			rvSports = itemView.findViewById(R.id.rv_sports);
			ll_explore=itemView.findViewById(R.id.ll_explore);
			end_layout=itemView.findViewById(R.id.end_layout);
			ll_rating=itemView.findViewById(R.id.rate_layout);
		}
	}


	class SportListAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {
		private Context context;
		private CopyOnWriteArrayList<Sport> mData;
		private int actualSize;
		private UserFacAca userFacAca;

		public SportListAdapter(Context context, CopyOnWriteArrayList<Sport> data, int size, UserFacAca userFacAca) {
			this.context = context;
			this.mData = data;
			this.actualSize = size;
			this.userFacAca = userFacAca;
		}

		@Override
		public int getItemViewType(int position) {
			if (position == mData.size()) {
				return 0;
			} else {
				return 1;
			}
		}

		@Override
		public int getItemCount() {
			return mData.size()+1;
		}

		@NonNull
		@Override
		public RecyclerView.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
			if (viewType == 1) {
				View layoutView = LayoutInflater.from(context)
					.inflate(R.layout.row_view_card_sports_list, parent, false);
				return new FacilitySeeAllAdapter.SportListAdapter.MyViewHolder(layoutView);
			} else {
				View layoutView = LayoutInflater.from(context)
					.inflate(R.layout.row_view_card_sport_number, parent, false);
				return new FacilitySeeAllAdapter.SportListAdapter.NumberHolder(layoutView);
			}
		}

		@Override
		public void onBindViewHolder(@NonNull RecyclerView.ViewHolder holder, int position) {
			if (position == mData.size()) {
				FacilitySeeAllAdapter.SportListAdapter.NumberHolder view = (FacilitySeeAllAdapter.SportListAdapter.NumberHolder) holder;
				if(position>4){
					view.tvSport.setVisibility(View.VISIBLE);
					view.tvSport.setText("+"+String.valueOf(actualSize-4));
				}else{
					view.tvSport.setVisibility(View.GONE);
				}
			} else {
				FacilitySeeAllAdapter.SportListAdapter.MyViewHolder myViewHolder = (FacilitySeeAllAdapter.SportListAdapter.MyViewHolder) holder;
				Sport model = myViewHolder.BindData(mData.get(position));
				myViewHolder.ivSport.setColorFilter(context.getResources().getColor(R.color.user_theme_color), android.graphics.PorterDuff.Mode.MULTIPLY);
				String path = kImageBaseUrl+mData.get(position).getFolderName()+"/"+mData.get(position).getSportIcon();
				Picasso.with(context).load(path).fit().placeholder(R.drawable.football_image).into(myViewHolder.ivSport);
			}
			//holder.itemView.setOnClickListener(v -> listener.onFacilityClick(userFacAca));
		}

		class MyViewHolder extends RecyclerView.ViewHolder {
			Sport model;
			ImageView ivSport;
			private MyViewHolder(View itemView) {
				super(itemView);
				ivSport=itemView.findViewById(R.id.iv_sport);
			}

			private Sport BindData(Sport model) {
				this.model = model;
				return model;
			}
		}

		class NumberHolder extends RecyclerView.ViewHolder {
			TextView tvSport;
			NumberHolder(View itemView) {
				super(itemView);
				tvSport = itemView.findViewById(R.id.tv_sport);
			}
		}
	}
}
