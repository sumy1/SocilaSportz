package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.socialsportz.Models.Owner.ProfileStatus;
import com.socialsportz.R;

import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.R.drawable.canvas_completed_status_bg;
import static com.socialsportz.R.drawable.canvas_pending_status_bg;
import static com.socialsportz.R.drawable.canvas_rejected_status_bg;

public class ProfileStatusAdapter extends RecyclerView.Adapter<ProfileStatusAdapter.MyViewHolder> {
    Context context;
    List<ProfileStatus> mData;
    private ItemClickListener listener;

    public ProfileStatusAdapter(Context context, List<ProfileStatus> mData) {
        this.context = context;
        this.mData = mData;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_design_profile_status, parent, false);
        return new MyViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ProfileStatusAdapter.MyViewHolder holder, int position) {
        ProfileStatus model=mData.get(position);
        holder.tvName.setText(mData.get(position).getName());
        switch (mData.get(position).getStatus()) {
            case "1":
                holder.tvComplete.setBackground(context.getDrawable(canvas_completed_status_bg));
                holder.tvComplete.setTextColor(context.getResources().getColor(R.color.white));
                break;
            case "2":
                holder.tvPending.setBackground(context.getDrawable(canvas_pending_status_bg));
                holder.tvPending.setTextColor(context.getResources().getColor(R.color.white));
                break;
            case "3":
                holder.tvRejected.setBackground(context.getDrawable(canvas_rejected_status_bg));
                holder.tvRejected.setTextColor(context.getResources().getColor(R.color.white));
                holder.tvRejected.setOnClickListener(view -> listener.clickOnReject(model));
                break;
        }
    }

    @Override
    public int getItemCount() {
        return mData.size();
    }

    class MyViewHolder extends RecyclerView.ViewHolder {
        TextView tvName,tvComplete,tvPending,tvRejected;
        MyViewHolder(@NonNull View itemView) {
            super(itemView);
            tvName =itemView.findViewById(R.id.tv_status_name);
            tvComplete=itemView.findViewById(R.id.tv_complete);
            tvPending=itemView.findViewById(R.id.tv_pending);
            tvRejected=itemView.findViewById(R.id.tv_rejected);
        }
    }
    public void setItemClickListener(ItemClickListener callBack){
        this.listener=callBack;
    }
    public interface ItemClickListener{
        void clickOnReject(ProfileStatus model);
    }
}
