package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.R;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class TimingAdapter extends RecyclerView.Adapter<TimingAdapter.MyViewHolder> {

    private Context context;
    private CopyOnWriteArrayList<FacDayTime> itemsList;

    class MyViewHolder extends RecyclerView.ViewHolder {
        TextView facDay, facOpening, facClosing;
        LinearLayout rowView;
        View colorView;

        MyViewHolder(View view) {
            super(view);
            rowView = view.findViewById(R.id.item_view);
            colorView = view.findViewById(R.id.color_view);
            facDay = view.findViewById(R.id.tv_day);
            facOpening = view.findViewById(R.id.tv_opening_time);
            facClosing = view.findViewById(R.id.tv_closing_time);
        }
    }

    public TimingAdapter(Context context, CopyOnWriteArrayList<FacDayTime> list) {
        this.context = context;
        this.itemsList = list;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_timing_view, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        FacDayTime item = itemsList.get(position);
        holder.itemView.setBackground(context.getDrawable(R.drawable.canvas_timing_active_row_bg));
        holder.colorView.setBackground(context.getDrawable(R.drawable.canvas_green_divider_bg));
        holder.facDay.setTextColor(context.getResources().getColor(R.color.dim_black));
        holder.facOpening.setTextColor(context.getResources().getColor(R.color.dim_black));
        holder.facClosing.setTextColor(context.getResources().getColor(R.color.dim_black));
        /*if(item.getDayStatus()==1){
            holder.itemView.setBackground(context.getDrawable(R.drawable.canvas_timing_active_row_bg));
            holder.colorView.setBackground(context.getDrawable(R.drawable.canvas_green_divider_bg));
            holder.facDay.setTextColor(context.getResources().getColor(R.color.dim_black));
            holder.facOpening.setTextColor(context.getResources().getColor(R.color.dim_black));
            holder.facClosing.setTextColor(context.getResources().getColor(R.color.dim_black));
        }
        else{
            holder.itemView.setBackground(context.getDrawable(R.drawable.canvas_timing_inactive_row_bg));
            holder.colorView.setBackground(context.getDrawable(R.drawable.canvas_red_divider_bg));
            holder.facDay.setTextColor(context.getResources().getColor(R.color.dark_grey));
            holder.facOpening.setTextColor(context.getResources().getColor(R.color.dark_grey));
            holder.facClosing.setTextColor(context.getResources().getColor(R.color.dark_grey));
        }*/
        holder.facDay.setText(item.getDayName());
        holder.facOpening.setText(item.getDayOpenTime());
        holder.facClosing.setText(getReminingTime(item.getDayCloseTime()));
    }

    public void addData(CopyOnWriteArrayList<FacDayTime> list) {
        itemsList.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<FacDayTime> list){
        itemsList.clear();
        itemsList.addAll(list);
        notifyDataSetChanged();
    }


	private String getReminingTime(String time) {
		try {
			SimpleDateFormat inFormat = new SimpleDateFormat("hh:mm a");
			Date date = inFormat.parse(time);
			SimpleDateFormat outFormat = new SimpleDateFormat("hh:mm a");
			String goal = outFormat.format(date);
			return goal;
		} catch (ParseException e) {
			e.printStackTrace();
			return "";
		}

	}
    @Override
    public int getItemCount() {
        return itemsList.size();
    }
}
