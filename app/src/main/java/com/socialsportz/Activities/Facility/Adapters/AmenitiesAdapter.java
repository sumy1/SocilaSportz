package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.R;

import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class AmenitiesAdapter extends RecyclerView.Adapter<AmenitiesAdapter.MyViewHolder>{

    private Context context;
    private List<Amenity> itemsList;

    class MyViewHolder extends RecyclerView.ViewHolder {
        ImageView ivImage;

        MyViewHolder(View view) {
            super(view);
            ivImage = view.findViewById(R.id.iv_amenity);
        }
    }

    public AmenitiesAdapter(Context context, List<Amenity> list) {
        this.context = context;
        this.itemsList = list;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_amenity_view, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Amenity item = itemsList.get(position);
        String path = kImageBaseUrl+item.getFolderName()+"/"+item.getAmenityIcon();
        Picasso.with(context).load(path).placeholder(R.drawable.amenities).into(holder.ivImage);
        /*holder.ivImage.setImageResource(R.drawable.first_aid);
        String path = kImageBaseUrl + item.getFolderName() +"/" + item.getAmenityIcon();
        Picasso.with(context).load(path).fit().into(holder.ivImage);*/
    }

    @Override
    public int getItemCount() {
        return itemsList.size();
    }
}
