package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.socialsportz.Models.DataModel;
import com.socialsportz.R;

import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class MobileCodeAdapter extends RecyclerView.Adapter<MobileCodeAdapter.MyViewHolder> {

    private Context context;
    private List<DataModel> itemsList;
    private onClickInterface listener;

    class MyViewHolder extends RecyclerView.ViewHolder {
        TextView textView;

        MyViewHolder(View view) {
            super(view);
            textView = view.findViewById(R.id.tv_country);
        }
    }

    public MobileCodeAdapter(Context context, List<DataModel> list, onClickInterface listener) {
        this.context = context;
        this.itemsList = list;
        this.listener = listener;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_country_code, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        DataModel item = itemsList.get(position);
        holder.textView.setText(String.valueOf(item.getName()));
        holder.itemView.setOnClickListener(v ->listener.onClick(item));
    }

    @Override
    public int getItemCount() {
        return itemsList.size();
    }

    public interface onClickInterface{
        void onClick(DataModel data);
    }
}
