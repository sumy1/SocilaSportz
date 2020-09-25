package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Constants.Constants;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class DashSportAdapter extends RecyclerView.Adapter<DashSportAdapter.myViewHolder>{
    private Context context;
    private CopyOnWriteArrayList<Sport> mData;
    private ItemClickListener listener;

    public DashSportAdapter(Context context, CopyOnWriteArrayList<Sport> data, ItemClickListener listener) {
        this.context = context;
        this.mData = data;
        this.listener=listener;
    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_view_user_sports, parent, false);
        return new myViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder holder, int i) {
        Sport sport = mData.get(i);
        holder.totalText.setText(sport.getSportName());
        holder.itemView.setOnClickListener(view -> listener.buttonPress());
        if(!sport.getSportIcon().isEmpty()){
            String path = Constants.kImageBaseUrl+sport.getFolderName()+"/"+sport.getSportIcon();
            Picasso.with(context).load(path).placeholder(R.drawable.cricket).into(holder.ivSport);
        }
        else
            Picasso.with(context).load(R.drawable.cricket).placeholder(R.drawable.cricket).into(holder.ivSport);
    }

    @Override
    public int getItemCount() {
        return mData.size();
    }

    public void addData(CopyOnWriteArrayList<Sport> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<Sport> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView ivSport;
        TextView totalText;
        private myViewHolder(View itemView) {
            super(itemView);
            ivSport=itemView.findViewById(R.id.iv_sport);
            totalText=itemView.findViewById(R.id.total_tv);
        }
    }

    public interface ItemClickListener{
        void buttonPress();
    }
}
