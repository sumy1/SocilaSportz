package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotWeekOff;
import com.socialsportz.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kWeekOffDay;
import static com.socialsportz.Constants.Constants.kWeekOffStatus;

public class WorkingDayAdapter extends RecyclerView.Adapter<WorkingDayAdapter.ViewHolder> {
	private CopyOnWriteArrayList<BatchSlotWeekOff> labels;
	private Context context;
	private BatchSlot batchSlot;
	boolean workingdays;
	boolean isLightOn;
	static JSONArray jsonArray;
	JSONObject integers;

	public WorkingDayAdapter(BatchSlot batchSlot,CopyOnWriteArrayList<BatchSlotWeekOff> day,boolean workingdays, Context context) {
		this.labels = day;
		this.context = context;
		this.batchSlot = batchSlot;
		this.workingdays=workingdays;
		jsonArray=new JSONArray();
		Log.d("Working",workingdays+"");
        /*labels = new ArrayList<>(count);
        for (int i = 0; i < count; ++i) {
            labels.add(String.valueOf(i));
        }*/
	}

	@NonNull
	@Override
	public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
		View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_working_day_view, parent, false);
		return new ViewHolder(view);
	}

	@Override
	public void onBindViewHolder( ViewHolder holder,  int position) {
		BatchSlotWeekOff day = labels.get(position);
		holder.btDay.setText(day.getWeekOffDay());

		//isLightOn=false;
		if(batchSlot!=null){
			if(workingdays==true){
				isLightOn=true;
				holder.btDay.setEnabled(false);

				integers = new JSONObject();
				try {
					integers.put(kWeekOffStatus,day.getWeekOffStatus());
					integers.put(kWeekOffDay,day.getWeekOffDay());
					jsonArray.put(integers);
				} catch (JSONException e) {
					e.printStackTrace();
				}
				holder.btDay.setText(day.getWeekOffDay());
				holder.btDay.setBackground(context.getResources().getDrawable(R.drawable.canvas_days_active_btn));


			}else{
				isLightOn=false;
				holder.btDay.setEnabled(true);

			}

			/*Log.d("status",day.getWeekOffStatus()+""+"/"+day.getWeekOffDay());
			if(day.getWeekOffStatus()==1){

				holder.btDay.setBackground(context.getResources().getDrawable(R.drawable.canvas_days_active_btn));
			}
			else{

			}*/

		}

		else{

			holder.btDay.setBackground(context.getResources().getDrawable(R.drawable.canvas_days_active_btn));
			integers = new JSONObject();
			try {
				integers.put(kWeekOffStatus,day.getWeekOffStatus());
				integers.put(kWeekOffDay,day.getWeekOffDay());
				jsonArray.put(integers);
			} catch (JSONException e) {
				e.printStackTrace();
			}
		}

		holder.btDay.setOnClickListener(view -> {
			int week=day.getWeekOffStatus();
			if(day.getWeekOffStatus()==0){
				isLightOn=true;
				day.setWeekOffStatus(1);
				//int pos=position;
				Log.d("Position",week+""+"/"+position);

				jsonArray=RemoveJSONArray(jsonArray,labels.get(position).getWeekOffDay());

				holder.btDay.setBackground(context.getResources().getDrawable(R.drawable.canvas_days_inactive_btn));
			}else {
				int pos=position;
				isLightOn=false;
				day.setWeekOffStatus(0);
				Log.d("Position",week+""+"/"+position);

				integers = new JSONObject();
				try {
					integers.put(kWeekOffStatus,day.getWeekOffStatus());
					integers.put(kWeekOffDay,day.getWeekOffDay());
					jsonArray.put(integers);
				} catch (JSONException e) {
					e.printStackTrace();
				}


				holder.btDay.setBackground(context.getResources().getDrawable(R.drawable.canvas_days_active_btn));
			}
		});
	}

	public CopyOnWriteArrayList<BatchSlotWeekOff> getCheckedList(){
		return labels;
	}

	public static JSONArray getAray(){
		return jsonArray;
	}



	public static JSONArray RemoveJSONArray( JSONArray jarray,String pos) {

		JSONArray Njarray=new JSONArray();
		try{
			for(int i=0;i<jarray.length();i++){

				Log.d("Post",jarray.getJSONObject(i).get(kWeekOffDay)+"/"+pos);
				if(jarray.getJSONObject(i).get(kWeekOffDay).equals(pos)){
					Njarray.remove(i);
				}else{
					Njarray.put(jarray.get(i));
				}

			}
		}catch (Exception e){e.printStackTrace();
		}

		Log.d("post",pos+"/"+Njarray.toString());
		return Njarray;

	}

	public static JSONArray add(JSONArray jarray,int pos) {
		JSONArray list = new JSONArray();

		try{
			for(int i=0;i<jarray.length();i++){
				if(i==pos)
					list.put(jarray.getJSONObject(i));
                 else
					list.put(jarray.getJSONObject(i));

			}
		}catch (Exception e){e.printStackTrace();}
		return list;
	}
	/*public boolean getEditStatus(){
		boolean status = false;
		for(int i=0;i<labels.size();i++){
			if(labels.get(i).getWeekOffStatus()==0){
				status = true;
				break;
			}
		}
		return status;
	}*/

	public boolean getEditStatus(){
		boolean status=false;
		Log.d("size",isLightOn+"");
		if(isLightOn==false){
			status=true;
		}
		return status;
	}
	@Override
	public int getItemCount() {
		return labels.size();
	}

	public static class ViewHolder extends RecyclerView.ViewHolder {
		Button btDay;

		public ViewHolder(View itemView) {
			super(itemView);
			btDay = itemView.findViewById(R.id.bt_day);
		}
	}

	public boolean getEditStatuss(){
		boolean status = false;

				if(jsonArray.length()==0){
					status = true;

				}
		return status;
		}


}
