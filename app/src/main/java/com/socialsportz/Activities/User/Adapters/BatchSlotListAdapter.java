package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Models.User.BatchSlotList;
import com.socialsportz.R;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class BatchSlotListAdapter extends RecyclerView.Adapter<BatchSlotListAdapter.MyViewHolder> {

    private Context context;
    private CopyOnWriteArrayList<BatchSlotList> itemsList;
    private String booking_for;
	long DiffDays;
	int dayDiff;
	String datee;
	String formattedDate="";

    class MyViewHolder extends RecyclerView.ViewHolder {
        TextView tv_slotN, tv_slot_time,tv_category_type, tv_slote_date,tv_plan,tv_price,tv_batchStime,tv_batchEtime,tv_cancel_status;
        LinearLayout main,ll_plan,ll_batchTime;


        MyViewHolder(View view) {
            super(view);
			tv_slotN = view.findViewById(R.id.tv_slotN);
			tv_slot_time = view.findViewById(R.id.tv_slot_time);
			tv_slote_date = view.findViewById(R.id.tv_slote_date);
			tv_plan = view.findViewById(R.id.tv_plan);
			tv_price = view.findViewById(R.id.tv_price);
			main = view.findViewById(R.id.main);
			ll_plan = view.findViewById(R.id.ll_plan);
			tv_batchStime=view.findViewById(R.id.tv_batchStime);
			tv_batchEtime=view.findViewById(R.id.tv_batchEtime);
			ll_batchTime=view.findViewById(R.id.ll_batchTime);
			tv_cancel_status=view.findViewById(R.id.tv_cancel_status);
			tv_category_type=view.findViewById(R.id.tv_category_type);

        }
    }

    public BatchSlotListAdapter(Context context, CopyOnWriteArrayList<BatchSlotList> list,String booking_for) {
        this.context = context;
        this.itemsList = list;
        this.booking_for=booking_for;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.batchslotlist_raw_view, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
		BatchSlotList item = itemsList.get(position);
		DiffDays=Daybetween(convertDate(item.getStart_date()),currentDate(),"dd MMM yyyy");

		holder.tv_category_type.setText(item.getBatchSlotType());

		if(booking_for.equalsIgnoreCase("facility")){
			holder.main.setWeightSum(3);
			holder.ll_plan.setVisibility(View.GONE);
			holder.tv_slotN.setText("Slot");
			holder.ll_batchTime.setVisibility(View.GONE);
			holder.tv_slot_time.setVisibility(View.VISIBLE);
			holder.tv_slote_date.setText(convertDate(item.getStart_date()));
			holder.tv_slot_time.setText(getReminingTime(item.getBatch_slot_start_time()) + "-" + getReminingTime(item.getBatch_slot_end_time()));
			holder.tv_price.setText(item.getBooking_detail_total_amount());
		}else{
			holder.main.setWeightSum(4);
			holder.ll_plan.setVisibility(View.VISIBLE);
			holder.tv_slote_date.setText(convertDate(item.getStart_date())+" - "+convertDate(item.getEnd_date()));
			holder.tv_plan.setText(item.getPackage_name());

			holder.ll_batchTime.setVisibility(View.VISIBLE);
			holder.tv_slot_time.setVisibility(View.GONE);

			holder.tv_batchStime.setText(getReminingTime(item.getBatch_slot_start_time()));
			holder.tv_batchEtime.setText(getReminingTime(item.getBatch_slot_end_time()));
			holder.tv_price.setText(item.getBooking_detail_total_amount());
			holder.tv_slotN.setText("Batch");
		}

		if(item.getBs_cancel_status().equalsIgnoreCase("yes") || DiffDays < 0){
			holder.tv_cancel_status.setVisibility(View.VISIBLE);
			holder.tv_cancel_status.setText("Cancelled"+"("+convertUTCDateToLocalDateeCancel(item.getBs_cancel_on())+")");

		}else{
			holder.tv_cancel_status.setVisibility(View.GONE);


		}



    }
	public long Daybetween(String date1,String date2,String pattern)
	{
		SimpleDateFormat sdf = new SimpleDateFormat(pattern, Locale.ENGLISH);
		Date Date1 = null,Date2 = null;
		try{
			Date1 = sdf.parse(date1);
			Date2 = sdf.parse(date2);
		}catch(Exception e)
		{
			e.printStackTrace();
		}
		return (Date1.getTime() - Date2.getTime())/(24*60*60*1000);
	}

	public String convertUTCDateToLocalDateeCancel(String date_string) {
		if (date_string.isEmpty()) {
			return "";
		}

		SimpleDateFormat oldFormatter = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		//oldFormatter.setTimeZone(TimeZone.getTimeZone("UTC"));
		Date value = null;
		String dueDateAsNormal = "";
		try {
			value = oldFormatter.parse(date_string);
			SimpleDateFormat newFormatter = new SimpleDateFormat("dd-MMM-yyyy");

			newFormatter.setTimeZone(TimeZone.getDefault());
			dueDateAsNormal = newFormatter.format(value);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		Log.d("date", dueDateAsNormal);

		return dueDateAsNormal;
	}

	public String currentDate(){
		Date c = Calendar.getInstance().getTime();

		SimpleDateFormat df = new SimpleDateFormat("dd MMM yyyy");
		formattedDate = df.format(c.getTime());

		Log.d("date",formattedDate);
		return formattedDate;
	}
	private String convertDate(String date1) {
		DateFormat inputFormat = new SimpleDateFormat("yyyy-MM-dd");
		DateFormat outputFormat = new SimpleDateFormat("dd MMM yyyy");
		Date date = null;
		String outputDateStr=null;
		try {
			date = inputFormat.parse(date1);
			 outputDateStr = outputFormat.format(date);
		} catch (ParseException e) {
			e.printStackTrace();
		}

		return outputDateStr;
	}

    @Override
    public int getItemCount() {
        return itemsList.size();
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
}
