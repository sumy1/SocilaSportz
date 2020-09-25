package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.R;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kDate;
import static com.socialsportz.Constants.Constants.kDeleteMsg;

public class BookingDetailsAdapter extends RecyclerView.Adapter<BookingDetailsAdapter.ViewHolder> {
    private CopyOnWriteArrayList<HashMap<String ,Object>> labels;
    private Context context;
    private onItemClickListener listener;
	String packageName;


    public BookingDetailsAdapter(String packageName,CopyOnWriteArrayList<HashMap<String ,Object>> day, Context context,onItemClickListener listener) {
        this.packageName=packageName;

        //Log.d("package",packageName);
        this.labels = day;
        this.context = context;
        this.listener = listener;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_booking_details, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull final ViewHolder holder, final int position) {
        final HashMap<String ,Object> map = labels.get(position);
        String date = (String) map.get(kDate);
        BatchSlot item = (BatchSlot) map.get(kData);
        CopyOnWriteArrayList<BatchPackage>batchPackages= ModelManager.modelManager().getCurrentUser().getBatchPackages();


        for(int i=0;i<batchPackages.size();i++){

        	if(batchPackages.get(i).getPackageId()==item.getPackageId()){
				Log.d("packageName",batchPackages.get(i).getPackageName());
			}

		}

        assert item != null;
        if(item.getType().equals(Constants.BatchSlotEnum.slot.toString())){
            String time = item.getStartTime() + " - " + item.getEndTime();
            holder.tvTime.setText(time);
			holder.slot_layout.setVisibility(View.VISIBLE);
			holder.batch_layout.setVisibility(View.GONE);
			holder.tv_type.setText(item.getBatchSlotType());

        }else if(item.getType().equals(Constants.BatchSlotEnum.batch.toString())){
			holder.slot_layout.setVisibility(View.GONE);
			holder.batch_layout.setVisibility(View.VISIBLE);
			String time = item.getStartTime() + " - " + item.getEndTime();
			holder.tvTime.setText(time);
			holder.tv_type_batch.setText(item.getBatchSlotType());
			holder.tv_package_name.setText(packageName);

		}
        if(item.getPrices().size()==1){
            String price = item.getPrices().get(0).getPrice();
            holder.etPrice.setText(price);
        }
        holder.tvDate.setText(date);

        holder.btDelete.setOnClickListener(view -> {
            if(labels.size()==1){
                Toaster.customToast("Cannot Delete All Data");
            }else{
                Utils.showAlertDialog(context,"Alert!",kDeleteMsg,(dialog, which) -> {
                    listener.onDelete(item,position);
                    onDelete(map,position);
                });
            }
        });
    }

    public void onDelete(HashMap<String,Object> map,int position){
        labels.remove(position);
        notifyItemRemoved(position);
        notifyItemRangeRemoved(position,labels.size());
    }

    @Override
    public int getItemCount() {
        return labels.size();
    }


    public static class ViewHolder extends RecyclerView.ViewHolder {
        TextView tvTime;
        TextView tvDate;
        TextView etPrice,tv_type,tv_type_batch,tv_package_name;
        ImageButton btDelete;
        LinearLayout slot_layout;
        RelativeLayout batch_layout;

        public ViewHolder(View itemView) {
            super(itemView);
            tvTime = itemView.findViewById(R.id.tv_timing);
            tvDate = itemView.findViewById(R.id.tv_date);
            etPrice = itemView.findViewById(R.id.tv_price);
            btDelete = itemView.findViewById(R.id.bt_delete);
			tv_type=itemView.findViewById(R.id.tv_type);
			slot_layout=itemView.findViewById(R.id.slot_layout);
			batch_layout=itemView.findViewById(R.id.batch_layout);
			tv_type_batch=itemView.findViewById(R.id.tv_type_batch);
			tv_package_name=itemView.findViewById(R.id.tv_package_name);
        }
    }

    public interface onItemClickListener{
        void onDelete(BatchSlot batchSlot, int pos);
    }
}
