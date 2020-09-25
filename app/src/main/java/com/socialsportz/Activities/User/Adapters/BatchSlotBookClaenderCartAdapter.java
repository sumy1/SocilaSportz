package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Models.User.UserAddcart;
import com.socialsportz.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class BatchSlotBookClaenderCartAdapter extends RecyclerView.Adapter<BatchSlotBookClaenderCartAdapter.myViewHolder>{
    private Context context;
    private CopyOnWriteArrayList<UserAddcart> mData;
    private ItemClickListener listener;
    boolean isLightOn = false;
	JSONObject jsonBatchId;
	static JSONArray batchIdArray;


    public BatchSlotBookClaenderCartAdapter(Context context, CopyOnWriteArrayList<UserAddcart> data,ItemClickListener listener) {
        this.context = context;
        this.mData = data;
        this.listener=listener;

		batchIdArray=new JSONArray();
    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_view_user_batch_slot_cart_caender, parent, false);
        return new myViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder holder, int i) {
        UserAddcart batchSlot = mData.get(i);

		jsonBatchId=new JSONObject();

		holder.tv_category_type.setText(batchSlot.getBatchSlotTyeTitle());


		if(batchSlot.getSlotAvailable().equalsIgnoreCase("Booked")){
			holder.tv_booked.setVisibility(View.VISIBLE);
			holder.tv_booked.setText("This is no longer available");
		}else{
			holder.tv_booked.setVisibility(View.GONE);
		}

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
				holder.tv_plan.setText("TRIAL");
				holder.tv_plan.setTextColor(context.getResources().getColor(R.color.green));
			}else{
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


		if(mData.size()>1){
           holder.img_delete.setVisibility(View.VISIBLE);
		}else{
			holder.img_delete.setVisibility(View.GONE);
		}

        holder.tv_price.setText(batchSlot.getSlotPacPrice());

        holder.tv_slote_date.setText(convertDate(batchSlot.getBookDate()));

		try {
			jsonBatchId.put("cart_id",mData.get(i).getCardId());
		} catch (JSONException e) {
			e.printStackTrace();
		}

		batchIdArray.put(jsonBatchId);

        holder.img_delete.setOnClickListener(v->{
            listener.buttonPress(mData.get(i).getCardId(),i);
        });

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

	private String getReminingTime(String time) {
		try {
			SimpleDateFormat inFormat = new SimpleDateFormat("hh:mm a");
			Date date = inFormat.parse(time);
			SimpleDateFormat outFormat = new SimpleDateFormat("hh:mm a");
			String goal = outFormat.format(date);


			return goal.replace("am", "AM").replace("pm","PM");
		} catch (ParseException e) {
			e.printStackTrace();
			return "";
		}

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

        TextView tv_slot_time,tv_booked,tv_slote_date,tv_category_type,tv_price,tv_sb_name,tv_plan,tv_batchStime,tv_batchEtime;
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
			tv_booked=itemView.findViewById(R.id.tv_booked);

        }
    }


	public static JSONArray getArayId(){
		return batchIdArray;
	}

	public static JSONArray removeList(JSONArray jarray,int cartId) {
		JSONArray list = new JSONArray();

		try{
			for(int i=0;i<jarray.length();i++){
				if(i!=cartId)
					list.put(jarray.get(i));
			}
		}catch (Exception e){e.printStackTrace();}
		return list;
	}

    public interface ItemClickListener{
        void buttonPress(String cart_id, int pos);
    }

    public void setClickListener(ItemClickListener callback) {
        listener = callback;
    }
}
