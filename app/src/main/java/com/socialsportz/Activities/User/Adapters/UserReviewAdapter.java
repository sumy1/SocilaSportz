package com.socialsportz.Activities.User.Adapters;

import android.app.Dialog;
import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.User.UserReview;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.Objects;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kRating;
import static com.socialsportz.Constants.Constants.kRatingId;
import static com.socialsportz.Constants.Constants.kratingMsg;

public class UserReviewAdapter extends RecyclerView.Adapter<UserReviewAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserReview> userReviewsData;
    boolean isCheck;
    Dialog dialog;
    private CustomLoaderView loaderView;
    String ratingId;
    TextView tv_alert;
	UserReviewAdapter userReviewAdapter;

    String rating_size;
	EditText editText1;
    public static final int MAX_LINES = 3;
	private OnRefreshViewListner mRefreshListner;

    public UserReviewAdapter(Context context, CopyOnWriteArrayList<UserReview> userReviewsData) {
        this.context = context;
        this.userReviewsData = userReviewsData;
        loaderView = CustomLoaderView.initialize(context);
		mRefreshListner = (OnRefreshViewListner)context;
	}

    @NonNull
    @Override
    public UserReviewAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.recycler_design_user_review, parent, false);
        return new UserReviewAdapter.myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull UserReviewAdapter.myViewHolder holder, int position) {
        UserReview model = userReviewsData.get(position);

        if(!model.getBannerImage().isEmpty()){
            //String imgPath = kImageBaseUrl+model.getFolderName()+"/"+model.getReviewImg();
            Picasso.with(context).load(model.getBannerImage()).placeholder(R.drawable.running_event).fit().into(holder.iv_profile);
        }else{
            Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(holder.iv_profile);
        }

        holder.review_tv_name.setText(model.getFacName());
        holder.review_tv_msg_text.setText(model.getReviewMesg());

        holder.tv_date_text.setText(convertUTCDateToLocalDate(model.getCreatedOn()));



        Log.d("rating",model.getRating());
        holder.rating_bar_review.setRating(Float.parseFloat(model.getRating()));


        holder.report_btn.setOnClickListener(v->{
            //ratingId=model.

            reviewDialog(model.getFacName(),model.getRatingId(),model.getRating(),model.getReviewMesg());
        });
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

    public void addData(CopyOnWriteArrayList<UserReview> list) {
        userReviewsData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<UserReview> list){
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
        Button report_btn;

        public myViewHolder(@NonNull View itemView) {
            super(itemView);
            iv_profile = itemView.findViewById(R.id.iv_profile);
            review_tv_name = itemView.findViewById(R.id.review_tv_name);
            review_tv_msg_text = itemView.findViewById(R.id.review_tv_msg_text);
            review_tv_mail = itemView.findViewById(R.id.review_tv_mail);
            tv_date_text = itemView.findViewById(R.id.tv_date_text);
            rating_bar_review = itemView.findViewById(R.id.rating_bar_review);
            report_btn=itemView.findViewById(R.id.report_btn);

        }
    }


    private void reviewDialog(String text,String ratingId,String reting,String msg) {
        // dialog
        dialog = new Dialog(context);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_review);

        dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
        RatingBar rating_bar_review=dialog.findViewById(R.id.rating_bar_review);
        rating_bar_review.setRating(Float.parseFloat(reting));
        rating_bar_review.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
            public void onRatingChanged(RatingBar ratingBar, float rating,
                                        boolean fromUser) {

                rating_size= String.valueOf(rating);
            }
        });
        TextView tv_sport_name=dialog.findViewById(R.id.tv_sport_name);
        tv_sport_name.setText(text);
         editText1 = dialog.findViewById(R.id.et_message);
        editText1.setText(msg);
        dialog.findViewById(R.id.btn_submit).setOnClickListener(view -> {
            rating_size= String.valueOf(rating_bar_review.getRating());

            if(validate()){
				setEnquiry(rating_size, Utils.getProperText(editText1),ratingId);
			}



        });
        dialog.show();
    }

	private boolean validate() {
		boolean isOk = true;
        if(Float.parseFloat(rating_size)==0){
			Toaster.customToast("Please add rating!");
			isOk = false;
		}
		 /*if (editText1.getText().toString().isEmpty()) {
			Toaster.customToast("Please type message!");
			isOk = false;
		}*/

		return isOk;
	}

    private void setEnquiry(String subject,String messagee,String ratingId){
        dialog.dismiss();
        loaderView.showLoader();
        HashMap<String,Object> map = new HashMap<>();
        map.put(kRatingId, ratingId);
        map.put(kRating,subject);
        map.put(kratingMsg, messagee);

        Log.e("map","reviews..: "+ map.toString());
        ModelManager.modelManager().userSendReview(map,
                (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
                    try {
                        loaderView.hideLoader();
                        String msg = genericResponse.getObject();
                        CongratsDialog(msg);
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                    loaderView.hideLoader();
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }


    private void CongratsDialog(String user){
        final Dialog dialog = new Dialog(context);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_congrats_screen_profile_update);
        dialog.setCancelable(false);
        TextView tv_msg=dialog.findViewById(R.id.tv_msg);
        tv_msg.setText(user);
        dialog.findViewById(R.id.btn_continue).setOnClickListener(v -> {
            dialog.dismiss();
			mRefreshListner.refreshView();


        });

        dialog.show();
    }

	public interface OnRefreshViewListner{

		public void refreshView();

	}
}
