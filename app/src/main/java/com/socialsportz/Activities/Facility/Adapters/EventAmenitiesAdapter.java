package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.R;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventAmenitiesAdapter extends RecyclerView.Adapter<EventAmenitiesAdapter.MyViewHolder>{

    private Context context;
    private CopyOnWriteArrayList<Amenity> itemsList;

    class MyViewHolder extends RecyclerView.ViewHolder {
        ImageView ivImage;
        ImageView ivTick;

        MyViewHolder(View view) {
            super(view);
            ivImage = view.findViewById(R.id.iv_amenity);
            ivTick = view.findViewById(R.id.tickView);
        }
    }

    public EventAmenitiesAdapter(Context context, CopyOnWriteArrayList<Amenity> list) {
        this.context = context;
        this.itemsList = list;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_event_amenity_view, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Amenity item = itemsList.get(position);
        if(item.isStatus())
            holder.ivTick.setVisibility(View.VISIBLE);
        String path = kImageBaseUrl + item.getFolderName() +"/" + item.getAmenityIcon();
        Picasso.with(context).load(path).fit().placeholder(R.drawable.amenities).into(holder.ivImage);
        //holder.ivImage.setImageResource(item.getAmenityImage());

        holder.itemView.setOnClickListener(view -> {
            if(item.isStatus()){
                item.setStatus(false);
                holder.ivTick.setVisibility(View.GONE);
            }else{
                item.setStatus(true);
                holder.ivTick.setVisibility(View.VISIBLE);
            }
        });
    }

    public List<Amenity> getCheckedList(){
        ArrayList<Amenity> list = new ArrayList<>();
        for(Amenity items:itemsList){
            if(items.isStatus())
                list.add(items);
        }
        return list;
    }

    @Override
    public int getItemCount() {
        return itemsList.size();
    }
}
