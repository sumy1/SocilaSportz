package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.os.Handler;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RatingBar;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
import com.socialsportz.Models.Owner.Rating;
import com.socialsportz.R;
import com.socialsportz.Utils.Toaster;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class RatingAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {

    private Context context;
    private CopyOnWriteArrayList<Rating> mData;
    private int pageSize;
    private ItemClickListener listener;

    public RatingAdapter(Context context, CopyOnWriteArrayList<Rating> data, ItemClickListener listener) {
        this.context = context;
        this.mData = data;
        this.pageSize = mData.size();
        this.listener = listener;
        setHasStableIds(true);
    }

    @Override
    public int getItemViewType(int position) {
        if (position == mData.size()) {
            return 0;
        } else {
            return 1;
        }
    }

    @NonNull
    @Override
    public RecyclerView.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        if (viewType == 1) {
            View layoutView = LayoutInflater.from(context)
                    .inflate(R.layout.recycler_design_for_rate_review, parent, false);
            return new myViewHolder(layoutView);
        } else {
            View layoutView = LayoutInflater.from(context)
                    .inflate(R.layout.row_progress_view, parent, false);
            return new ProgressHolder(layoutView);
        }
    }

    @Override
    public void onBindViewHolder(@NonNull RecyclerView.ViewHolder holder, int position) {
        if (position == mData.size()) {
            ProgressHolder view = (ProgressHolder) holder;
            if(mData.isEmpty()|| mData.size()<8){
                view.progressBar.setVisibility(View.GONE);
            }
            else if (mData.size() >= pageSize) {
                view.progressBar.setVisibility(View.VISIBLE);
                new Handler().postDelayed(() -> {
                    //Hide the refresh after 2sec
                    ((FacilityDashboardActivity) context).runOnUiThread(
                            () -> view.progressBar.setVisibility(View.GONE));
                }, 2000);
            }

        } else {
            final myViewHolder myViewHolder = (myViewHolder) holder;
            final Rating rating = mData.get(position);
            myViewHolder.bindData(rating);
            /*myViewHolder.imageView.setImageResource(R.drawable.man);
            myViewHolder.name.setText(rating.getUser_name());
            myViewHolder.mail.setText(rating.getUser_email());
            myViewHolder.date.setText(rating.getDate());
            myViewHolder.ratingBar.setRating(rating.getRating());
            if(rating.getAbuse()==1){
                myViewHolder.reportButton.setText("Review Reported");
                myViewHolder.reportButton.setTextColor(context.getResources().getColor(R.color.white));
                myViewHolder.reportButton.setBackgroundTintList((context.getResources().getColorStateList(R.color.dim_grey)));
            }

            if(!rating.getRecycleReviews().isEmpty()){
                myViewHolder.reviewLayout.setVisibility(View.VISIBLE);
                for(int i=0;i<rating.getRecycleReviews().size();i++){
                    if(i==0)
                        myViewHolder.review.setText(rating.getRecycleReviews().get(i).getRev_msg());
                }
            }else{
                myViewHolder.reviewLayout.setVisibility(View.GONE);
            }

            myViewHolder.reportButton.setOnClickListener(view -> {
                if(rating.getAbuse()==0){
                    listener.onClick(rating,position);
                }
                else{
                    Toaster.customToast("Report already submitted");
                }
            });*/
        }
    }

    public void updateData(Rating rating, int pos){
        rating.setAbuse(1);
        mData.set(pos,rating);
        notifyItemChanged(pos);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public int getItemCount() {
        return mData.size()+1;
    }

    public void addData(CopyOnWriteArrayList<Rating> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<Rating> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }


    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView imageView;
        TextView name,mail,review,date;
        RatingBar ratingBar;
        Button reportButton;
        LinearLayout reviewLayout;
        private myViewHolder(View itemView) {
            super(itemView);
            imageView=itemView.findViewById(R.id.iv_profile);
            name=itemView.findViewById(R.id.recycler_rate_tv_name);
            mail=itemView.findViewById(R.id.recycler_rate_tv_mail);
            review=itemView.findViewById(R.id.recycler_rate_tv_review_text);
            date=itemView.findViewById(R.id.recycler_rate_tv_date_text);
            ratingBar=itemView.findViewById(R.id.rating_bar_review);
            reportButton=itemView.findViewById(R.id.report_btn);
            reviewLayout = itemView.findViewById(R.id.review_layout);
        }

        private void bindData(Rating rating){
            imageView.setImageResource(R.drawable.man);
            name.setText(rating.getUser_name());
            mail.setText(rating.getUser_email());
            date.setText(rating.getDate());
            ratingBar.setRating(rating.getRating());
            if(rating.getAbuse()==1){
                reportButton.setText("Review Reported");
                reportButton.setTextColor(context.getResources().getColor(R.color.white));
                reportButton.setBackgroundTintList((context.getResources().getColorStateList(R.color.dim_grey)));
            }

            if(!rating.getRecycleReviews().isEmpty()){
                reviewLayout.setVisibility(View.VISIBLE);
                for(int i=0;i<rating.getRecycleReviews().size();i++){
                    if(i==0)
                        review.setText(rating.getRecycleReviews().get(i).getRev_msg());
                }
            }else{
                reviewLayout.setVisibility(View.GONE);
            }

            reportButton.setOnClickListener(v -> {
                if(rating.getAbuse()==0){
                    listener.onClick(rating,getAdapterPosition());
                }
                else{
                    Toaster.customToast("Report already submitted");
                }
            });
        }
    }

    class ProgressHolder extends RecyclerView.ViewHolder {

        ProgressBar progressBar;

        ProgressHolder(View itemView) {
            super(itemView);
            progressBar = itemView.findViewById(R.id.progress_bar);
        }
    }

    public interface ItemClickListener{
        void onClick(Rating rating, int pos);
    }

}
