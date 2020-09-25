package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.socialsportz.Models.User.UserEnquire;
import com.socialsportz.R;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class UserEnquireAdapter extends RecyclerView.Adapter<UserEnquireAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserEnquire> userReviewsData;
    private boolean isCheck;

    public UserEnquireAdapter(Context context, CopyOnWriteArrayList<UserEnquire> userReviewsData) {
        this.context = context;
        this.userReviewsData = userReviewsData;
    }

    @NonNull
    @Override
    public UserEnquireAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.raw_userenquire, parent, false);
        return new UserEnquireAdapter.myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull UserEnquireAdapter.myViewHolder holder, int position) {
        UserEnquire model = userReviewsData.get(position);

        holder.en_fac_name.setText(model.getFacName());
        holder.en_subject.setText(model.getQueryTitle());
        holder.review_tv_msg_text.setText(model.getQuiryMessage());
        holder.tv_date_text.setText(convertUTCDateToLocalDate(model.getCreatedOn()));

    }

    @Override
    public int getItemCount() {
        return userReviewsData.size();
    }

    public void addData(CopyOnWriteArrayList<UserEnquire> list) {
        userReviewsData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<UserEnquire> list){
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
        TextView en_fac_name,en_subject, review_tv_msg_text,tv_date_text;
        ImageView iv_profile;

        public myViewHolder(@NonNull View itemView) {
            super(itemView);
            en_fac_name = itemView.findViewById(R.id.en_fac_name);
            en_subject = itemView.findViewById(R.id.en_subject);
            review_tv_msg_text = itemView.findViewById(R.id.review_tv_msg_text);
            tv_date_text = itemView.findViewById(R.id.tv_date_text);

        }
    }
}
