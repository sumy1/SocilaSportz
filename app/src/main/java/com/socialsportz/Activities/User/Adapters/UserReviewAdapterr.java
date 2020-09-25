package com.socialsportz.Activities.User.Adapters;

import android.app.Dialog;
import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.User.UserReviews;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class UserReviewAdapterr extends RecyclerView.Adapter<UserReviewAdapterr.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserReviews> userReviewsData;
    boolean isCheck;
    Dialog dialog;
    private CustomLoaderView loaderView;
    String ratingId;
    TextView tv_alert;
	UserReviewAdapterr userReviewAdapter;

    String rating_size;
	EditText editText1;
    public static final int MAX_LINES = 3;


    public UserReviewAdapterr(Context context, CopyOnWriteArrayList<UserReviews> userReviewsData) {
        this.context = context;
        this.userReviewsData = userReviewsData;
        loaderView = CustomLoaderView.initialize(context);

	}

    @NonNull
    @Override
    public UserReviewAdapterr.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.recycler_design_user_revieww, parent, false);
        return new UserReviewAdapterr.myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull UserReviewAdapterr.myViewHolder holder, int position) {
		UserReviews model = userReviewsData.get(position);

        if(!model.getReviewImg().isEmpty()){
            String imgPath = kImageBaseUrl+model.getFolderName()+"/"+model.getReviewImg();
            Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(holder.iv_profile);
        }else{
            Picasso.with(context).load(R.drawable.man).placeholder(R.drawable.man).fit().into(holder.iv_profile);
        }

		/*if (model.) {
			radio_btn_male.setChecked(true);

			if (!profile_path.isEmpty()) {
				Picasso.with(context).load(profile_path).placeholder(R.drawable.man).fit().into(profile_img);
			} else {
				Picasso.with(context).load(profile_path).placeholder(R.drawable.man).fit().into(profile_img);
			}

		} else if (gender.equals("F")) {
			radio_btn_female.setChecked(true);

			if (!profile_path.isEmpty()) {
				Picasso.with(context).load(profile_path).placeholder(R.drawable.girl).fit().into(profile_img);
			} else {
				Picasso.with(context).load(profile_path).placeholder(R.drawable.girl).fit().into(profile_img);
			}
		}*/

        holder.review_tv_name.setText(model.getUserName());
        holder.review_tv_msg_text.setText(model.getReviewMessage());

        holder.tv_date_text.setText(convertUTCDateToLocalDate(model.getReviewDate()));

        holder.rating_bar_review.setRating(Float.parseFloat(String.valueOf(model.getRatingBar())));



    }


	public String convertUTCDateToLocalDate(String date_string) {
		if (date_string.isEmpty()){
			return "";
		}
		SimpleDateFormat oldFormatter = new SimpleDateFormat("yyyy-mm-dd");
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

    public void addData(CopyOnWriteArrayList<UserReviews> list) {
        userReviewsData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<UserReviews> list){
        userReviewsData.clear();
        userReviewsData.addAll(list);
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return userReviewsData.size();
    }


    class myViewHolder extends RecyclerView.ViewHolder {
        TextView review_tv_name,review_tv_msg_text, tv_date_text,review_tv_mail;
        ImageView iv_profile;
        RatingBar rating_bar_review;

        public myViewHolder(@NonNull View itemView) {
            super(itemView);
            iv_profile = itemView.findViewById(R.id.iv_profile);
            review_tv_name = itemView.findViewById(R.id.review_tv_name);
            review_tv_msg_text = itemView.findViewById(R.id.review_tv_msg_text);
            review_tv_mail = itemView.findViewById(R.id.review_tv_mail);
            tv_date_text = itemView.findViewById(R.id.tv_date_text);
            rating_bar_review = itemView.findViewById(R.id.rating_bar_review);


        }
    }



}
