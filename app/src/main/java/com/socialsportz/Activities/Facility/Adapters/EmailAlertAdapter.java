package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.os.Handler;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
import com.socialsportz.Models.Owner.EmailAlerts;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class EmailAlertAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {

    private Context context;
    private CopyOnWriteArrayList<EmailAlerts> mData;
    private int pageSize;

    public EmailAlertAdapter(Context context, CopyOnWriteArrayList<EmailAlerts> data) {
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
                    .inflate(R.layout.row_view_email_alert, parent, false);
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
            final EmailAlerts model = mData.get(position);
            myViewHolder.eSubject.setText(model.getTitle());
            myViewHolder.eMsg.setText(model.getMsg());
            myViewHolder.eTime.setText(model.getTime());
        }
    }

    @Override
    public int getItemCount() {
        return mData.size()+1;
    }

    public void addData(CopyOnWriteArrayList<EmailAlerts> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<EmailAlerts> list) {
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        TextView eSubject,eMsg,eTime;
        private myViewHolder(View itemView) {
            super(itemView);
            eSubject=itemView.findViewById(R.id.tv_e_subject);
            eMsg=itemView.findViewById(R.id.tv_e_msg);
            eTime=itemView.findViewById(R.id.tv_e_time);
        }
    }

    class ProgressHolder extends RecyclerView.ViewHolder {

        ProgressBar progressBar;

        ProgressHolder(View itemView) {
            super(itemView);
            progressBar = itemView.findViewById(R.id.progress_bar);
        }
    }
}
