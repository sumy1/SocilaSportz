package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.socialsportz.Models.User.DashStatsData;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;


public class DashStatAdapter extends RecyclerView.Adapter<DashStatAdapter.myViewHolder>{
    private Context context;
    private CopyOnWriteArrayList<DashStatsData> mData;
    private ItemClickListener listener;

    public DashStatAdapter(Context context, CopyOnWriteArrayList<DashStatsData> data, ItemClickListener listener) {
        this.context = context;
        this.mData = data;
        this.listener=listener;
    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_view_user_stat_data, parent, false);
        return new myViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder holder, int i) {
        /*DisplayMetrics displayMetrics=new DisplayMetrics();
        ((Activity)context).getWindowManager().getDefaultDisplay().getMetrics(displayMetrics);
        holder.itemView.getLayoutParams().width = displayMetrics.widthPixels/3;*/
        holder.totalNo.setText(String.valueOf(mData.get(i).getCount()));
        holder.totalText.setText(mData.get(i).getTitle());
        /*switch (mData.get(i).getTotalText()) {
            case kTodayBooking:
                holder.totalNo.setTextColor(context.getResources().getColor(R.color.blue));
                break;
            case kTrialBooking:
                holder.totalNo.setTextColor(context.getResources().getColor(R.color.brown));
                break;
            case kTotalBooking:
                holder.totalNo.setTextColor(context.getResources().getColor(R.color.green));
                break;
            case kConfirmedBooking:
                holder.totalNo.setTextColor(context.getResources().getColor(R.color.yellow));
                break;
            case kPendingBooking:
                holder.totalNo.setTextColor(context.getResources().getColor(R.color.red));
                break;
        }*/
        holder.itemView.setOnClickListener(view -> listener.buttonPress());
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
        void buttonPress();
    }
}
