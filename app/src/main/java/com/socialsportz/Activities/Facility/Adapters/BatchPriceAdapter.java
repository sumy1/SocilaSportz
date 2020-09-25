package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;

import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlotPrice;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class BatchPriceAdapter extends RecyclerView.Adapter<BatchPriceAdapter.ViewHolder> {
    private CopyOnWriteArrayList<BatchSlotPrice> labels;
    private CopyOnWriteArrayList<BatchPackage> packages;
    private Context context;
    private onDeleteListener listener;

    public BatchPriceAdapter(CopyOnWriteArrayList<BatchSlotPrice> day,
                             CopyOnWriteArrayList<BatchPackage> packages,
                             Context context,onDeleteListener listener) {
        this.labels = day;
        this.packages = packages;
        this.context = context;
        this.listener = listener;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_batch_rate_view, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull final ViewHolder holder, final int position) {
        final BatchSlotPrice rate = labels.get(position);
        holder.packageId = rate.getPackageId();
		if(!packages.isEmpty()){
			for(int i=0;i<packages.size();i++){
				if(packages.get(i).getPackageId()==rate.getPackageId()){
					holder.tvBatch.setText(packages.get(i).getPackageName());
					break;
				}
			}
		} else
			holder.tvBatch.setText(rate.getPackageDuration());
        holder.etPrice.setText(rate.getPrice());


        holder.btDelete.setOnClickListener(view -> {
            listener.onDelete(holder.packageId);
            labels.remove(position);
            notifyItemRemoved(position);
            notifyItemRangeRemoved(position,labels.size());
        });
        holder.etPrice.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int i, int i1, int i2) { }

            @Override
            public void onTextChanged(CharSequence s, int i, int i1, int i2) {
                if(s.length() != 0)
                    rate.setPrice(s.toString());
                else
                    rate.setPrice("");
            }

            @Override
            public void afterTextChanged(Editable editable) { }
        });
    }

    public void addItem(BatchSlotPrice model){
        labels.add(model);
        notifyDataSetChanged();
    }

    public CopyOnWriteArrayList<BatchSlotPrice> getCheckedList(){
        return labels;
    }

    public boolean getEditStatus(){
        boolean status = false;
        for(int i=0;i<labels.size();i++){
            if(labels.get(i).getPrice().isEmpty()){
                status = true;
                break;
            }
        }
        return status;
    }


    @Override
    public int getItemCount() {
        return labels.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        int packageId;
        TextView tvBatch;
        EditText etPrice;
        ImageButton btDelete;

        public ViewHolder(View itemView) {
            super(itemView);
            tvBatch = itemView.findViewById(R.id.tv_batch_type);
            etPrice = itemView.findViewById(R.id.et_batch_price);
            btDelete = itemView.findViewById(R.id.bt_delete);
        }
    }

    public interface onDeleteListener{
        void onDelete(int packageId);
    }
}
