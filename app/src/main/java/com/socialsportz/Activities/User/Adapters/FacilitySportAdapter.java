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

import java.util.Random;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class FacilitySportAdapter extends RecyclerView.Adapter<FacilitySportAdapter.myViewHolder>{
    private Context context;
    private CopyOnWriteArrayList<Sport> mDataSport;
    private ItemClickListener listener;


    public FacilitySportAdapter(Context context, CopyOnWriteArrayList<Sport> mDataSport, ItemClickListener listener) {
        this.context = context;
        this.mDataSport = mDataSport;
        this.listener=listener;
    }


    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_view_facility_sports, parent, false);
        return new myViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder holder, int i) {
        Sport sport = mDataSport.get(i);
        holder.totalText.setText(sport.getSportName());
        holder.itemView.setOnClickListener(view -> listener.buttonPress());
        if(!sport.getSportIcon().isEmpty()){
            String path = Constants.kImageBaseUrl+sport.getFolderName()+"/"+sport.getSportIcon();
            Picasso.with(context).load(path).placeholder(R.drawable.cricket).into(holder.ivSport);
        }
        else
            Picasso.with(context).load(R.drawable.cricket).placeholder(R.drawable.cricket).into(holder.ivSport);
        int[] androidColors = context.getResources().getIntArray(R.array.android_colors);
        int randomAndroidColor = androidColors[new Random().nextInt(androidColors.length)];
        //holder.ivSport.setColorFilter(randomAndroidColor, android.graphics.PorterDuff.Mode.MULTIPLY);
        holder.ivSport.setColorFilter(context.getResources().getColor(R.color.dim_black), android.graphics.PorterDuff.Mode.MULTIPLY);
    }

    @Override
    public int getItemCount() {
        return mDataSport.size();
    }

    public void addData(CopyOnWriteArrayList<Sport> list) {
        mDataSport.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<Sport> list){
        mDataSport.clear();
        mDataSport.addAll(list);
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
