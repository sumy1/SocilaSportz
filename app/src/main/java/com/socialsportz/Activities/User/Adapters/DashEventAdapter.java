package com.socialsportz.Activities.User.Adapters;

import android.app.Activity;
import android.content.Context;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.User.UserEvent;
import com.socialsportz.R;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class DashEventAdapter extends RecyclerView.Adapter<DashEventAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserEvent> mData;
    private onItemClickListener listener;

    public DashEventAdapter(Context context, CopyOnWriteArrayList<UserEvent> mData, onItemClickListener listener) {
        this.context = context;
        this.mData = mData;
        this.listener = listener;
    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_view_user_event, parent, false);
        return new myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int position) {
		UserEvent events = mData.get(position);
        DisplayMetrics displayMetrics=new DisplayMetrics();
        ((Activity)context).getWindowManager().getDefaultDisplay().getMetrics(displayMetrics);
        myViewHolder.itemView.getLayoutParams().width = (int)(displayMetrics.widthPixels/2);

        //String daet=events.getSdate();
        //String eDate=events.getEdate();

        //String time1=events.getStime().replace("am", "AM").replace("pm","PM");
		///String time2=events.getStime().replace("am", "AM").replace("pm","PM");
		//String time = time1+ " to "+time2;
		myViewHolder.tv_timingg.setText(events.getStime()+" to "+events.getEtime());




		myViewHolder.tv_name.setText(events.getEventName());
		myViewHolder.tv_price.setText(events.getPrice());

		if(!events.getBanner().isEmpty()){
			String imgPath = kImageBaseUrl+events.getFacFolder()+"/"+events.getBanner();
			Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
		}else{
			Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
		}
        myViewHolder.ll_explore.setOnClickListener(view -> listener.onEventClick(events));


		//String d=convertUTCDateToLocalDate(events.getSdate());
		//String d1=convertUTCDateToLocalDate(events.getEdate());
		myViewHolder.tv_datee.setText(events.getSdate());
    }


    @Override
    public int getItemCount() {
        return mData.size();
    }

    public void newData(CopyOnWriteArrayList<UserEvent> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }


	public String getReminingTime(String time) {
		try {
			SimpleDateFormat inFormat = new SimpleDateFormat("hh:mm a");
			Date date = inFormat.parse(time);
			SimpleDateFormat outFormat = new SimpleDateFormat("hh:mm a");
			String goal = outFormat.format(date);


			return goal.replace("am", "AM").replace("pm","PM");
		} catch (ParseException e) {
			e.printStackTrace();
			return "";
		}

	}


	private String convertDate(String date1) {
		DateFormat inputFormat = new SimpleDateFormat("yyyy-MM-dd");
		DateFormat outputFormat = new SimpleDateFormat("dd MMM yyyy");
		Date date = null;
		try {
			date = inputFormat.parse(date1);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		String outputDateStr = outputFormat.format(date);
		return outputDateStr;
	}

	public String convertUTCDateToLocalDate(String date_string) {
		if (date_string.isEmpty()){
			return "";
		}
		SimpleDateFormat oldFormatter = new SimpleDateFormat("dd-MM-yyyy");
		//oldFormatter.setTimeZone(TimeZone.getTimeZone("UTC"));
		Date value = null;
		String dueDateAsNormal ="";
		try {
			value = oldFormatter.parse(date_string);
			SimpleDateFormat newFormatter = new SimpleDateFormat("dd MMM yyyy");

			newFormatter.setTimeZone(TimeZone.getDefault());
			dueDateAsNormal = newFormatter.format(value);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		Log.d("date",dueDateAsNormal);

		return dueDateAsNormal;
	}

    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView ivBanner;
		LinearLayout ll_explore;
		TextView tv_datee,tv_timingg,tv_name,tv_price;
        private myViewHolder(View itemView) {
            super(itemView);
            ivBanner = itemView.findViewById(R.id.iv_banner);
			ll_explore=itemView.findViewById(R.id.ll_explore);
			tv_datee=itemView.findViewById(R.id.tv_datee);
			tv_timingg=itemView.findViewById(R.id.tv_timingg);
			tv_name=itemView.findViewById(R.id.tv_name);
			tv_price=itemView.findViewById(R.id.tv_price);
        }
    }

    public interface onItemClickListener{
        void onEventClick(UserEvent events);
    }
}
