package com.socialsportz.Activities.Facility.Adapters;

import android.app.Activity;
import android.content.Context;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.socialsportz.Models.Owner.TotalBookingView;
import com.socialsportz.R;

import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kTodayBooking;
import static com.socialsportz.Constants.Constants.kTodaysTransations;
import static com.socialsportz.Constants.Constants.kUpcomingBookingBatch;
import static com.socialsportz.Constants.Constants.kUpcomingBookingSlot;
import static com.socialsportz.Constants.Constants.kUpcomingTrialBooking;
import static com.socialsportz.Constants.Constants.kUpcomingcancelledBatchCount;
import static com.socialsportz.Constants.Constants.kUpcomingcancelledSlotCount;

public class TotalBookingViewAdapter extends RecyclerView.Adapter<TotalBookingViewAdapter.myViewHolder>{
    private Context context;
    private List<TotalBookingView> mData;
    private ItemClickListener listener;
    String facType;

    public TotalBookingViewAdapter(Context context, List<TotalBookingView> data, ItemClickListener listener,String facType) {
        this.context = context;
        this.mData = data;
        this.listener=listener;
        this.facType=facType;

		Log.d("fac",facType+"");
    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_design_dashboard_trial_listing, parent, false);
        return new myViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder holder, int i) {
        DisplayMetrics displayMetrics=new DisplayMetrics();
        ((Activity)context).getWindowManager().getDefaultDisplay().getMetrics(displayMetrics);
        holder.itemView.getLayoutParams().width = displayMetrics.widthPixels/3;

		TotalBookingView totalBookingView=mData.get(i);
        holder.totalNo.setText(String.valueOf(mData.get(i).getTotalNo()));
        holder.totalText.setText(mData.get(i).getTotalText());

        if(facType.equalsIgnoreCase("academy")){
			switch (mData.get(i).getTotalText()) {
				case kTodayBooking:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.blue));
					break;
				case kUpcomingTrialBooking:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.brown));
					break;
				case kTodaysTransations:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.green));
					break;
				case kUpcomingcancelledBatchCount:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.yellow));
					break;
				case kUpcomingBookingBatch:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.red));
					break;
			}
		}else{
			switch (mData.get(i).getTotalText()) {
				case kTodayBooking:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.blue));
					break;
				case kUpcomingTrialBooking:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.brown));
					break;
				case kTodaysTransations:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.green));
					break;
				case kUpcomingcancelledSlotCount:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.yellow));
					break;
				case kUpcomingBookingSlot:
					holder.totalNo.setTextColor(context.getResources().getColor(R.color.red));
					break;
			}
		}



        holder.itemView.setOnClickListener(view -> listener.buttonPress(totalBookingView));
    }

    @Override
    public int getItemCount() {
        return mData.size();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        TextView totalNo,totalText;
        private myViewHolder(View itemView) {
            super(itemView);
            totalNo=itemView.findViewById(R.id.total_no);
            totalText=itemView.findViewById(R.id.total_tv);

        }
    }

    public interface ItemClickListener{
        void buttonPress(TotalBookingView totalBookingView);
    }
}
