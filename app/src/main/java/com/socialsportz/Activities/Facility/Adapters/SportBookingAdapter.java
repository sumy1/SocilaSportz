package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Constants.Constants;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class SportBookingAdapter extends RecyclerView.Adapter<SportBookingAdapter.MyViewHolder> {

    private Context context;
    private CopyOnWriteArrayList<BatchSlot> itemsList;
    private String facType;
    private onItemClickListener listener;

    class MyViewHolder extends RecyclerView.ViewHolder {
        TextView tvTime, tvMax, tvPrice;
        LinearLayout layout;

        MyViewHolder(View view) {
            super(view);
            tvTime = view.findViewById(R.id.tv_time_slot_batch);
            tvMax = view.findViewById(R.id.tv_max);
            tvPrice = view.findViewById(R.id.tv_price);
            layout = view.findViewById(R.id.item_view);
        }
    }

    public SportBookingAdapter(Context context, String facType, CopyOnWriteArrayList<BatchSlot> list, onItemClickListener listener) {
        this.context = context;
        this.itemsList = list;
        this.listener = listener;
        this.facType = facType;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_batch_slot_book_view, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        BatchSlot item = itemsList.get(position);
        String time = item.getStartTime()+ " - "+item.getEndTime();
        holder.tvTime.setText(time);
        String max = "Max : "+item.getMaxBook();
        holder.tvMax.setText(max);
        if(item.getType().equalsIgnoreCase(Constants.BatchSlotEnum.slot.toString())){
            String price = context.getResources().getString(R.string.Rs)+ item.getPrices().get(0).getPrice();
            holder.tvPrice.setText(price);
        }
        if(facType.equals(Constants.FacType.academy.toString())){
            holder.tvPrice.setVisibility(View.GONE);
        }

        if (item.getAvailability().equalsIgnoreCase(Constants.DefaultStatus.yes.toString())) {
            holder.tvTime.setTextColor(context.getResources().getColor(R.color.green));
            holder.tvPrice.setTextColor(context.getResources().getColor(R.color.green));
            holder.tvMax.setTextColor(context.getResources().getColor(R.color.green));
            holder.layout.setBackground(context.getResources().getDrawable(R.drawable.canvas_avail_green_bg));
        } else {
            holder.tvTime.setTextColor(context.getResources().getColor(R.color.red));
            holder.tvPrice.setTextColor(context.getResources().getColor(R.color.red));
            holder.tvMax.setTextColor(context.getResources().getColor(R.color.red));
            holder.layout.setBackground(context.getResources().getDrawable(R.drawable.canvas_avail_red_bg));
        }
        holder.itemView.setOnClickListener(v -> {
            if(item.getAvailability().equalsIgnoreCase(Constants.DefaultStatus.no.toString()))
                listener.onClick(item);
        });
    }


    @Override
    public int getItemCount() {
        return itemsList.size();
    }

    public interface onItemClickListener{
        void onClick(BatchSlot item);
    }


}
