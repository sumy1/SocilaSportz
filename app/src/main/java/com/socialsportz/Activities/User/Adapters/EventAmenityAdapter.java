package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Constants.Constants;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.R;

import java.util.Random;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class EventAmenityAdapter extends RecyclerView.Adapter<EventAmenityAdapter.myViewHolder>{
    private Context context;
    private CopyOnWriteArrayList<Amenity> mData;
    private ItemClickListener listener;

    public EventAmenityAdapter(Context context, CopyOnWriteArrayList<Amenity> data, ItemClickListener listener) {
        this.context = context;
        this.mData = data;
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
        Amenity sport = mData.get(i);

        Log.d("Id",sport.getAmenityId()+"");
        holder.totalText.setText(sport.getAmenityName());
        holder.itemView.setOnClickListener(view -> listener.buttonPress());
        if(!sport.getAmenityIcon().isEmpty()){
            String path = Constants.kImageBaseUrl+sport.getFolderName()+"/"+sport.getAmenityIcon();
            Picasso.with(context).load(path).placeholder(R.drawable.amenities).into(holder.ivSport);
        }
        else
            Picasso.with(context).load(R.drawable.cricket).placeholder(R.drawable.amenities).into(holder.ivSport);
        int[] androidColors = context.getResources().getIntArray(R.array.android_colors);
        int randomAndroidColor = androidColors[new Random().nextInt(androidColors.length)];
        //holder.ivSport.setColorFilter(randomAndroidColor, android.graphics.PorterDuff.Mode.MULTIPLY);
        holder.ivSport.setColorFilter(context.getResources().getColor(R.color.dim_black), android.graphics.PorterDuff.Mode.MULTIPLY);
    }


    @Override
    public int getItemCount() {
        return mData.size();
    }

    public void addData(CopyOnWriteArrayList<Amenity> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<Amenity> list){
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
