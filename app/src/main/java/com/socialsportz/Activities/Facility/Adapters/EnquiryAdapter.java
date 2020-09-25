package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.os.Handler;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
import com.socialsportz.Models.Owner.Enquires;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class EnquiryAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {

    private onClickListener mCallBack;
    private Context context;
    private CopyOnWriteArrayList<Enquires> mData;
    private int pageSize;

    public EnquiryAdapter(Context context, CopyOnWriteArrayList<Enquires> data) {
        this.context = context;
        this.mData = data;
        this.pageSize = mData.size();
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
                    .inflate(R.layout.recycler_design_for_enquires, parent, false);
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
            myViewHolder myViewHolder = (myViewHolder) holder;
            Enquires enquiry = mData.get(position);
            myViewHolder.imageView.setImageResource(R.drawable.man);
            myViewHolder.name.setText(enquiry.getUser_name());
            myViewHolder.mail.setText(enquiry.getUser_email());
            myViewHolder.contact.setText(enquiry.getUser_mobile());
            myViewHolder.date.setText(enquiry.getDate());
            myViewHolder.message.setText(enquiry.getMessage());
            myViewHolder.itemView.setOnClickListener(view -> mCallBack.callViewMethod(enquiry));
        }
    }


    @Override
    public int getItemCount() {
        return mData.size()+1;
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView imageView;
        TextView name,mail,contact,message,date;
        private myViewHolder(View itemView) {
            super(itemView);
            imageView=itemView.findViewById(R.id.iv_profile);
            name=itemView.findViewById(R.id.recycler_enq_tv_name);
            contact=itemView.findViewById(R.id.recycler_enq_tv_contact);
            mail=itemView.findViewById(R.id.recycler_enq_tv_mail);
            message=itemView.findViewById(R.id.recycler_enq_tv_message);
            date=itemView.findViewById(R.id.recycler_enq_tv_date);
        }
    }

    public void addData(CopyOnWriteArrayList<Enquires> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<Enquires> list) {
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class ProgressHolder extends RecyclerView.ViewHolder {

        ProgressBar progressBar;

        ProgressHolder(View itemView) {
            super(itemView);
            progressBar = itemView.findViewById(R.id.progress_bar);
        }
    }

    public interface onClickListener{
        void callViewMethod(Enquires enquiry);
    }

    public void setClickListener(onClickListener listener){
        this.mCallBack = listener;
    }
}
