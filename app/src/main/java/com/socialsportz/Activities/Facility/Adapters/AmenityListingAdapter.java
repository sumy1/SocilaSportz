package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.R;

import java.util.ArrayList;
import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class AmenityListingAdapter extends RecyclerView.Adapter<AmenityListingAdapter.MyViewHolder> {

    private Context context;
    private List<Amenity> itemsList;

    class MyViewHolder extends RecyclerView.ViewHolder {
        CheckBox chAmenity;
        ImageView ivAmenity;

        MyViewHolder(View view) {
            super(view);
            chAmenity = view.findViewById(R.id.ch_amenity);
            ivAmenity = view.findViewById(R.id.iv_amenity);
        }
    }

    public AmenityListingAdapter(Context context, List<Amenity> list) {
        this.context = context;
        this.itemsList = list;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_fac_amenity_listing, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Amenity item = itemsList.get(position);
        holder.chAmenity.setText(item.getAmenityName());
        String path = kImageBaseUrl+item.getFolderName()+"/"+item.getAmenityIcon();
        Picasso.with(context).load(path).placeholder(R.drawable.amenities).into(holder.ivAmenity);
        if(item.isStatus())
            holder.chAmenity.setChecked(true);
        holder.chAmenity.setOnCheckedChangeListener((compoundButton, b) -> {
            if(b)
                item.setStatus(true);
            else
                item.setStatus(false);
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
