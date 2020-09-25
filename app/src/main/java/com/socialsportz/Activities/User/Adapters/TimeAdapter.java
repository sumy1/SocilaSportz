package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Models.User.UserFacTimings;
import com.socialsportz.R;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class TimeAdapter extends RecyclerView.Adapter<TimeAdapter.MyViewHolder> {

    private Context context;
    private CopyOnWriteArrayList<UserFacTimings> itemsList;

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

    public TimeAdapter(Context context, CopyOnWriteArrayList<UserFacTimings> list) {
        this.context = context;
        this.itemsList = list;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_fac_time_view, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
		UserFacTimings item = itemsList.get(position);
        holder.itemView.setBackground(context.getDrawable(R.drawable.canvas_time_active_row_bg));
        holder.colorView.setBackground(context.getDrawable(R.drawable.canvas_green_divider_bg));
        holder.facDay.setTextColor(context.getResources().getColor(R.color.dim_black));
        holder.facOpening.setTextColor(context.getResources().getColor(R.color.dim_black));
        holder.facClosing.setTextColor(context.getResources().getColor(R.color.dim_black));

        holder.facDay.setText(item.getDay());
        holder.facOpening.setText(item.getOpenTime());
        holder.facClosing.setText(getReminingTime(item.getCloseTime()));
    }

    public void addData(CopyOnWriteArrayList<UserFacTimings> list) {
        itemsList.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<UserFacTimings> list){
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
