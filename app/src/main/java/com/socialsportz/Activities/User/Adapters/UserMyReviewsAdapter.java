package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class UserMyReviewsAdapter extends RecyclerView.Adapter<UserMyReviewsAdapter.MyViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<Bookings> mData;
    private int pageSize;

    public UserMyReviewsAdapter(Context context, CopyOnWriteArrayList<Bookings> data) {
        this.context = context;
        this.mData = data;
        this.pageSize = mData.size();
    }


    @NonNull
    @Override
    public UserMyReviewsAdapter.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context)
                .inflate(R.layout.row_view_user_myreviews, parent, false);
        return new MyViewHolder(layoutView);
    }


    @Override
    public void onBindViewHolder(@NonNull UserMyReviewsAdapter.MyViewHolder holder, int position) {

        MyViewHolder myViewHolder = (MyViewHolder) holder;
        final Bookings model = myViewHolder.BindData(mData.get(position));
        //myViewHolder.ivSport.setImageResource(R.drawable.man);

        myViewHolder.itemView.setOnClickListener(view -> {

        });
    }


    @Override
    public int getItemCount() {
        return mData.size();
    }

    public void addData(CopyOnWriteArrayList<Bookings> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<Bookings> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }


    class MyViewHolder extends RecyclerView.ViewHolder {
        Bookings model;
        TextView id,name, address,sport, status;
        private MyViewHolder(View itemView) {
            super(itemView);
            id = itemView.findViewById(R.id.tv_booking_order);
            name = itemView.findViewById(R.id.tv_field);
            address = itemView.findViewById(R.id.tv_address);
            sport = itemView.findViewById(R.id.tv_sport);
            status = itemView.findViewById(R.id.tv_status);
        }

        private Bookings BindData(Bookings model) {
            this.model = model;
            return model;
        }
    }

}
