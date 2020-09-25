package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.socialsportz.Models.User.UserNotification;
import com.socialsportz.R;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class UserNotificationAdapter extends RecyclerView.Adapter<UserNotificationAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserNotification> userReviewsData;


    public UserNotificationAdapter(Context context, CopyOnWriteArrayList<UserNotification> userReviewsData) {
        this.context = context;
        this.userReviewsData = userReviewsData;
    }

    @NonNull
    @Override
    public UserNotificationAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.raw_notification, parent, false);
        return new UserNotificationAdapter.myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull UserNotificationAdapter.myViewHolder holder, int position) {
        UserNotification model = userReviewsData.get(position);

        holder.tv_des.setText(model.getDescription());
        holder.tv_time.setText(convertUTCDateToLocalDate(model.getActivity_time()));
        holder.tv_n_name.setText(model.getFac_name());
        holder.tv_sport.setText(model.getSport_name());

    }

    @Override
    public int getItemCount() {
        return userReviewsData.size();
    }

    public void newData(CopyOnWriteArrayList<UserNotification> list){
        userReviewsData.clear();
        userReviewsData.addAll(list);
        notifyDataSetChanged();
    }


	public String convertUTCDateToLocalDate(String date_string) {
		if (date_string.isEmpty()){
			return "";
		}

		SimpleDateFormat oldFormatter = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		//oldFormatter.setTimeZone(TimeZone.getTimeZone("UTC"));
		Date value = null;
		String dueDateAsNormal ="";
		try {
			value = oldFormatter.parse(date_string);
			SimpleDateFormat newFormatter = new SimpleDateFormat("dd MMM yyyy (hh:mm a)");

			newFormatter.setTimeZone(TimeZone.getDefault());
			dueDateAsNormal = newFormatter.format(value);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		Log.d("date",dueDateAsNormal);

		return dueDateAsNormal;
	}


    class myViewHolder extends RecyclerView.ViewHolder {
        TextView tv_des,tv_time, tv_n_name,tv_sport;


        public myViewHolder(@NonNull View itemView) {
            super(itemView);
            tv_des = itemView.findViewById(R.id.tv_des);
            tv_time = itemView.findViewById(R.id.tv_time);
            tv_n_name = itemView.findViewById(R.id.tv_n_name);
            tv_sport = itemView.findViewById(R.id.tv_sport);

        }
    }
}
