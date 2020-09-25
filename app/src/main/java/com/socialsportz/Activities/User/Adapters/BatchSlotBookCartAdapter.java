package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Models.User.UserAddcart;
import com.socialsportz.R;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class BatchSlotBookCartAdapter extends RecyclerView.Adapter<BatchSlotBookCartAdapter.myViewHolder>{
    private Context context;
    private CopyOnWriteArrayList<UserAddcart> mData;
    private ItemClickListener listener;
    boolean isLightOn = false;
	 String trial_status="";

	static ArrayList<String>trial_array;


    public BatchSlotBookCartAdapter(Context context, CopyOnWriteArrayList<UserAddcart> data, ItemClickListener listener) {
        this.context = context;
        this.mData = data;
        this.listener=listener;

		trial_array=new ArrayList<>();

    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_view_user_batch_slot_cart, parent, false);
        return new myViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder holder, int i) {
        UserAddcart batchSlot = mData.get(i);

        holder.tv_category_type.setText(batchSlot.getBatchSlotTyeTitle());

        if(batchSlot.getSportType().equalsIgnoreCase("Academy")){

        	holder.ll_weight.setWeightSum((float) 4.5);
        	holder.tv_price_set.setWeightSum((float) 0.9);
			holder.ll_plan.setVisibility(View.VISIBLE);
        	holder.tv_sb_name.setText(context.getString(R.string.batch));
			holder.tv_plan.setText(batchSlot.getPackageName());
			holder.ll_batchTime.setVisibility(View.VISIBLE);
			holder.tv_slot_time.setVisibility(View.GONE);

			holder.tv_batchStime.setText(getReminingTime(batchSlot.getStartTime()));
			holder.tv_batchEtime.setText(getReminingTime(batchSlot.getEndTime()));

			if(batchSlot.getIsTrial().equalsIgnoreCase("yes")){
				trial_status=batchSlot.getIsTrial();

				trial_array.add(trial_status);


				Log.d("arr",trial_array.size()+"");

				holder.tv_plan.setText("TRIAL");
				holder.tv_plan.setTextColor(context.getResources().getColor(R.color.green));
			}else{
				//trial_array=new ArrayList<>();
				//trial_array.remove(trial_status);
				//trial_status="";
				holder.tv_plan.setTextColor(context.getResources().getColor(R.color.user_theme_color));
				holder.tv_plan.setText(batchSlot.getPackageName());
			}
		}else{

			holder.ll_batchTime.setVisibility(View.GONE);
			holder.tv_slot_time.setVisibility(View.VISIBLE);
			holder.tv_slot_time.setText(getReminingTime(batchSlot.getStartTime())+"-"+getReminingTime(batchSlot.getEndTime()));
			holder.ll_weight.setWeightSum(3);
			holder.tv_price_set.setWeightSum((float) 0.8);
			holder.ll_plan.setVisibility(View.GONE);
			holder.tv_sb_name.setText(context.getString(R.string.slot));
		}


        holder.tv_price.setText(batchSlot.getSlotPacPrice());
        //holder.tv_slot_time.setText(batchSlot.getStartTime()+"-"+batchSlot.getEndTime());
        holder.tv_slote_date.setText(convertDate(batchSlot.getBookDate()));

        holder.img_delete.setOnClickListener(v->{
            listener.buttonPress(mData.get(i).getCardId(),i);
        });

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


	private String convertDate(String date1){
		DateFormat inputFormat = new SimpleDateFormat("yyyy-MM-dd");
		DateFormat outputFormat = new SimpleDateFormat("dd MMM yyyy");
		Date date = null;
		try {
			date = inputFormat.parse(date1);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		String outputDateStr = outputFormat.format(date);
    	return outputDateStr;
	}

    @Override
    public int getItemCount() {
        return mData.size();
    }

    public void addData(CopyOnWriteArrayList<UserAddcart> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<UserAddcart> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class myViewHolder extends RecyclerView.ViewHolder {

        TextView tv_slot_time,tv_slote_date,tv_category_type,tv_price,tv_sb_name,tv_plan,tv_batchStime,tv_batchEtime;
        ImageView img_delete;
        LinearLayout ll_weight,ll_plan,tv_price_set,ll_batchTime;
        private myViewHolder(View itemView) {
            super(itemView);
            tv_slot_time=itemView.findViewById(R.id.tv_slot_time);
            tv_slote_date=itemView.findViewById(R.id.tv_slote_date);
            tv_price=itemView.findViewById(R.id.tv_price);
            img_delete=itemView.findViewById(R.id.img_delete);
			tv_sb_name=itemView.findViewById(R.id.tv_sb_name);
			tv_plan=itemView.findViewById(R.id.tv_plan);
			ll_weight=itemView.findViewById(R.id.ll_weight);
			ll_plan=itemView.findViewById(R.id.ll_plan);
			tv_price_set=itemView.findViewById(R.id.tv_price_set);
			tv_batchStime=itemView.findViewById(R.id.tv_batchStime);
			tv_batchEtime=itemView.findViewById(R.id.tv_batchEtime);
			ll_batchTime=itemView.findViewById(R.id.ll_batchTime);
			tv_category_type=itemView.findViewById(R.id.tv_category_type);

        }
    }


 public static ArrayList<String> getTrial(){
	 //Log.d("arr",trial_array.size()+"");
    	return trial_array;
	}

    public interface ItemClickListener{
        void buttonPress(String cart_id, int pos);
    }

    public void setClickListener(ItemClickListener callback) {
        listener = callback;
    }
}
