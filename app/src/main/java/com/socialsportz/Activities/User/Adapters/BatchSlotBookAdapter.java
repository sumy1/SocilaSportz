package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.User.UserBatchSlotAvailList;
import com.socialsportz.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.cardview.widget.CardView;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kBatchSlotId;
import static com.socialsportz.Constants.Constants.kBatchSlotTypeName;
import static com.socialsportz.Constants.Constants.kBookDate;
import static com.socialsportz.Constants.Constants.kEndTime;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacType;
import static com.socialsportz.Constants.Constants.kIsTrial;
import static com.socialsportz.Constants.Constants.kPackageId;
import static com.socialsportz.Constants.Constants.kPackageName;
import static com.socialsportz.Constants.Constants.kPriceNo;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kStartTime;
import static com.socialsportz.Constants.Constants.kTypeId;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kbatchSloTypeTitle;

public class BatchSlotBookAdapter extends RecyclerView.Adapter<BatchSlotBookAdapter.myViewHolder> {
	private Context context;
	private CopyOnWriteArrayList<UserBatchSlotAvailList> mData;
	boolean isLightOn;
	JSONObject integers;
	JSONObject jsonBatchId;
	private String trial_status;

	static JSONArray array;
	String facType = "", PackageName = "", Bookdate = "";

	static ArrayList<HashMap<String, String>[]> finallist;
	static JSONArray jsonArray;
	static JSONArray batchIdArray;
	HashMap<String, String> new_array[];

	public BatchSlotBookAdapter(Context context, CopyOnWriteArrayList<UserBatchSlotAvailList> data, String facType, String PackageName, String Bookdate, String trial_status) {
		this.context = context;
		this.mData = data;
		this.facType = facType;
		this.PackageName = PackageName;
		this.Bookdate = Bookdate;
		this.trial_status = trial_status;

		jsonArray = new JSONArray();

		batchIdArray = new JSONArray();

	}

	@NonNull
	@Override
	public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View view = LayoutInflater.from(context).inflate(R.layout.row_view_user_batch_slot, parent, false);
		return new myViewHolder(view);
	}

	@Override
	public void onBindViewHolder(@NonNull myViewHolder holder, int i) {

		//Log.d("index",i+"");
		UserBatchSlotAvailList batchSlot = mData.get(i);

		final int pos = i;

		if (batchSlot.getFacName().equalsIgnoreCase("facility")) {

			if(batchSlot.getTypeName().equalsIgnoreCase("")){
				holder.rv_type.setVisibility(View.GONE);
			}else{
				holder.rv_type.setVisibility(View.VISIBLE);
				holder.tv_plan.setText(batchSlot.getTypeName());
			}

			if(batchSlot.getCourtDesc().equalsIgnoreCase("")){
				holder.ll_des.setVisibility(View.GONE);
			}else{
				holder.ll_des.setVisibility(View.VISIBLE);
				holder.tv_time_slot_des_type.setText("Slot Description");
				holder.tv_time_slot_des.setText(batchSlot.getCourtDesc());
			}



			if (batchSlot.getAvailable_cart().equalsIgnoreCase("No")) {
				holder.cv.setCardBackgroundColor(context.getResources().getColor(R.color.blue_semi_transparentt));
				//holder.tv_kit_price.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_sport_timing.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_sport_max.setTextColor(context.getResources().getColor(R.color.white));
				//holder.img_rupees_kit_price.setColorFilter(context.getResources().getColor(R.color.white));

				//tv_kit_des.setTextColor(context.getResources().getColor(R.color.white));
				holder.chekbox.setChecked(true);
				/*if (batchSlot.getIsKit().equalsIgnoreCase("yes")) {
					holder.lv_kit.setVisibility(View.VISIBLE);
					holder.tv_kit_avail.setTextColor(context.getResources().getColor(R.color.white));
					holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.white));
					holder.img_rupees_kit_p.setVisibility(View.VISIBLE);
					holder.img_rupees_kit_p.setColorFilter(context.getResources().getColor(R.color.white));
					if (batchSlot.getKitPrice().equalsIgnoreCase("")) {
						holder.tv_kit_p.setText("0");
					} else {
						holder.tv_kit_p.setText(batchSlot.getKitPrice());
					}
				} else {
					holder.tv_kit_avail.setTextColor(context.getResources().getColor(R.color.white));
					holder.lv_kit.setVisibility(View.VISIBLE);
					holder.tv_kit_p.setText("No");
					holder.img_rupees_kit_p.setVisibility(View.GONE);
					holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.white));
				}*/
				//try {
					/*integers.put(kUserId,String.valueOf(ModelManager.modelManager().getCurrentUser().getUserId()));
					integers.put(kFacId,mData.get(i).getFacId());
					integers.put(kSportId,mData.get(i).getSportId());
					integers.put(kFacType,facType);
					integers.put(kBatchSlotId,mData.get(i).getBatchSlotId());
					integers.put(kPackageName,PackageName);
					integers.put(kPriceNo,mData.get(i).getPackagePrice());
					integers.put(kStartTime,mData.get(i).getStartTime());
					integers.put(kEndTime,mData.get(i).getEndTime());
					integers.put(kIsTrial,mData.get(i).getIsTrial());
					integers.put(kPackageId,mData.get(i).getPackageId());
					integers.put(kBookDate,Bookdate);
					integers.put(kPackageName,"");

					jsonBatchId.put(kBatchSlotId,mData.get(i).getBatchSlotId());

					batchIdArray.put(jsonBatchId);
					//integers.put(kCartId,mData.get(i))


					Log.d("print",integers+""+i+"");

					jsonArray.put(integers);



					Log.d("print_json","/"+jsonArray+"");


				} catch (JSONException e) {
					e.printStackTrace();
				}*/

			} else {
				isLightOn = false;
				holder.cv.setCardBackgroundColor(context.getResources().getColor(R.color.white));
				//holder.tv_kit_price.setTextColor(context.getResources().getColor(R.color.user_theme_color));
				holder.tv_sport_timing.setTextColor(context.getResources().getColor(R.color.black));
				holder.tv_sport_max.setTextColor(context.getResources().getColor(R.color.dim_grey));
				//holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.dim_grey));
				//holder.tv_kit_des.setTextColor(context.getResources().getColor(R.color.dim_grey));

				/*if (batchSlot.getIsKit().equalsIgnoreCase("yes")) {
					holder.lv_kit.setVisibility(View.VISIBLE);
					holder.tv_kit_avail.setTextColor(context.getResources().getColor(R.color.dim_grey));
					holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.dim_grey));
					holder.img_rupees_kit_p.setVisibility(View.VISIBLE);
					holder.img_rupees_kit_p.setColorFilter(context.getResources().getColor(R.color.dim_grey));
					if (batchSlot.getKitPrice().equalsIgnoreCase("")) {
						holder.tv_kit_p.setText("0");
					} else {
						holder.tv_kit_p.setText(batchSlot.getKitPrice());
					}
				} else {
					holder.tv_kit_avail.setTextColor(context.getResources().getColor(R.color.dim_grey));
					holder.lv_kit.setVisibility(View.VISIBLE);
					holder.tv_kit_p.setText("No");
					holder.img_rupees_kit_p.setVisibility(View.GONE);
					holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.dim_grey));
				}*/

				holder.chekbox.setChecked(false);

				/*jsonArray=removeList(jsonArray,pos);

				batchIdArray=removeListId(batchIdArray,pos);*/
			}


		} else if (batchSlot.getFacName().equalsIgnoreCase("academy")) {

			if(batchSlot.getTypeName().equalsIgnoreCase("")){
				holder.rv_type.setVisibility(View.GONE);
			}else{
				holder.rv_type.setVisibility(View.VISIBLE);
				holder.tv_plan.setText(batchSlot.getTypeName());
			}
			holder.lv_kit.setVisibility(View.GONE);
			if(batchSlot.getCourtDesc().equalsIgnoreCase("")){
				holder.ll_des.setVisibility(View.GONE);
			}else{
				holder.ll_des.setVisibility(View.VISIBLE);
				holder.tv_time_slot_des_type.setText("Batch Description");
				holder.tv_time_slot_des.setText(batchSlot.getCourtDesc());
			}

			if (batchSlot.getAvailable_cart().equalsIgnoreCase("No")) {
				//isLightOn=true;
				holder.cv.setCardBackgroundColor(context.getResources().getColor(R.color.blue_semi_transparentt));
				//holder.tv_kit_price.setTextColor(context.getResources().getColor(R.color.white));
				//holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_sport_timing.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_sport_max.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.white));
				//holder.img_rupees_kit_price.setColorFilter(context.getResources().getColor(R.color.white));
				/*if(batchSlot.getIsTrial().equalsIgnoreCase("yes")){
					holder.lv_is_trila.setVisibility(View.VISIBLE);
					holder.tv_is_trila.setText(capitizeString(batchSlot.getIsTrial()));
					holder.tv_is_trila.setTextColor(context.getResources().getColor(R.color.white));
				}else{
					holder.lv_is_trila.setVisibility(View.GONE);

				}*/
				holder.lv_is_trila.setVisibility(View.GONE);
				holder.tv_is_trila.setText(capitizeString(batchSlot.getIsTrial()));
				holder.tv_is_trila.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_trila.setTextColor(context.getResources().getColor(R.color.white));
				holder.chekbox.setChecked(true);


			} else {
				//isLightOn=false;
				if (batchSlot.getIsTrial().equalsIgnoreCase("yes")) {
					holder.lv_is_trila.setVisibility(View.GONE);
					holder.tv_is_trila.setText(capitizeString(batchSlot.getIsTrial()));
					holder.tv_is_trila.setTextColor(context.getResources().getColor(R.color.black));

				} else {
					holder.lv_is_trila.setVisibility(View.GONE);
					holder.tv_is_trila.setText(capitizeString(batchSlot.getIsTrial()));
					holder.tv_is_trila.setTextColor(context.getResources().getColor(R.color.black));

				}

				if(batchSlot.getTypeName().equalsIgnoreCase("")){
					holder.rv_type.setVisibility(View.GONE);
				}else{
					holder.rv_type.setVisibility(View.VISIBLE);
					holder.tv_plan.setText(batchSlot.getTypeName());
				}
				holder.cv.setCardBackgroundColor(context.getResources().getColor(R.color.white));
				//holder.tv_kit_price.setTextColor(context.getResources().getColor(R.color.user_theme_color));
				holder.tv_sport_timing.setTextColor(context.getResources().getColor(R.color.black));
				holder.tv_sport_max.setTextColor(context.getResources().getColor(R.color.dim_grey));
				//holder.tv_is_trila.setTextColor(context.getResources().getColor(R.color.dim_grey));
				holder.tv_trila.setTextColor(context.getResources().getColor(R.color.black));
				holder.chekbox.setChecked(false);
				/*jsonArray=removeList(jsonArray,pos);

				batchIdArray=removeListId(batchIdArray,pos);*/
			}

        	/*if(batchSlot.getIsTrial().equalsIgnoreCase("Yes")){

			}else{
				holder.lv_is_trila.setVisibility(View.VISIBLE);
				holder.tv_is_trila.setText(batchSlot.getIsTrial());
				holder.rv_type.setVisibility(View.GONE);
				holder.lv_kit.setVisibility(View.GONE);
			}*/

		}


		//holder.tv_plan.setText(batchSlot.getKitPrice());
		holder.tv_kit_price.setText(batchSlot.getPackagePrice());
		holder.tv_sport_timing.setText(getReminingTime(batchSlot.getStartTime()) + "-" + getReminingTime(batchSlot.getEndTime()));
		holder.tv_sport_max.setText("(Max person: " + batchSlot.getMaxBook() + ")");

		if (batchSlot.getAvailability().equalsIgnoreCase("No")) {
			isLightOn = false;
			holder.chekbox.setVisibility(View.GONE);
			holder.tv_booked.setVisibility(View.VISIBLE);


			if (batchSlot.getFacName().equalsIgnoreCase("facility")) {
				holder.lv_is_trila.setVisibility(View.GONE);
				/*if (batchSlot.getIsKit().equalsIgnoreCase("yes")) {
					holder.lv_kit.setVisibility(View.VISIBLE);
					holder.tv_kit_avail.setTextColor(context.getResources().getColor(R.color.white));
					holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.white));
					holder.img_rupees_kit_p.setVisibility(View.VISIBLE);
					holder.img_rupees_kit_p.setColorFilter(context.getResources().getColor(R.color.white));
					if (batchSlot.getKitPrice().equalsIgnoreCase("")) {
						holder.tv_kit_p.setText("0");
					} else {
						holder.tv_kit_p.setText( batchSlot.getKitPrice());
					}
				} else {
					holder.lv_kit.setVisibility(View.VISIBLE);
					holder.tv_kit_avail.setTextColor(context.getResources().getColor(R.color.white));
					holder.lv_kit.setVisibility(View.VISIBLE);
					holder.tv_kit_p.setText("No");
					holder.img_rupees_kit_p.setVisibility(View.GONE);
					holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.white));


				}*/
			} else if (facType.equalsIgnoreCase("Academy")) {
				if(batchSlot.getTypeName().equalsIgnoreCase("")){
					holder.rv_type.setVisibility(View.GONE);
				}else{
					holder.rv_type.setVisibility(View.VISIBLE);
					holder.tv_plan.setText(batchSlot.getTypeName());
				}
				holder.lv_kit.setVisibility(View.GONE);
				holder.lv_is_trila.setVisibility(View.GONE);
				holder.tv_is_trila.setText(capitizeString(batchSlot.getIsTrial()));
				holder.tv_is_trila.setTextColor(context.getResources().getColor(R.color.white));
				holder.tv_trila.setTextColor(context.getResources().getColor(R.color.white));
			}

			holder.cv.setCardBackgroundColor(context.getResources().getColor(R.color.trans_grey));
			holder.tv_kit_price.setTextColor(context.getResources().getColor(R.color.white));
			holder.img_rupees_kit_price.setColorFilter(context.getResources().getColor(R.color.white));
			holder.tv_sport_timing.setTextColor(context.getResources().getColor(R.color.white));
			holder.tv_sport_max.setTextColor(context.getResources().getColor(R.color.white));
			holder.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.white));
			holder.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.white));

			/// holder.tv_kit_des.setTextColor(context.getResources().getColor(R.color.white));

		} else {
			holder.chekbox.setVisibility(View.VISIBLE);
			holder.tv_booked.setVisibility(View.GONE);



			holder.chekbox.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {

				@Override
				public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
					integers = new JSONObject();
					jsonBatchId = new JSONObject();
					int pos = i;
					isLightOn = isChecked;
					if (isLightOn) {
						holder.cv.setCardBackgroundColor(context.getResources().getColor(R.color.blue_semi_transparentt));
						//holder.tv_kit_price.setTextColor(context.getResources().getColor(R.color.white));
						//holder.img_rupees_kit_price.setColorFilter(context.getResources().getColor(R.color.white));
						holder.tv_sport_timing.setTextColor(context.getResources().getColor(R.color.white));
						holder.tv_sport_max.setTextColor(context.getResources().getColor(R.color.white));
						//holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.white));
						holder.img_rupees_kit_p.setColorFilter(context.getResources().getColor(R.color.white));
						holder.tv_is_trila.setTextColor(context.getResources().getColor(R.color.white));
						holder.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.white));
						holder.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.white));
						holder.tv_trila.setTextColor(context.getResources().getColor(R.color.white));
						//holder.tv_kit_avail.setTextColor(context.getResources().getColor(R.color.white));
						//holder.tv_kit_des.setTextColor(context.getResources().getColor(R.color.white));
						try {
							integers.put(kUserId, String.valueOf(ModelManager.modelManager().getCurrentUser().getUserId()));
							integers.put(kFacId, mData.get(i).getFacId());
							integers.put(kSportId, mData.get(i).getSportId());
							integers.put(kFacType, facType);
							integers.put(kBatchSlotId, mData.get(i).getBatchSlotId());
							integers.put(kPackageName, mData.get(i).getPackagename());
							integers.put(kPriceNo, mData.get(i).getPackagePrice());
							integers.put(kStartTime, mData.get(i).getStartTime());
							integers.put(kEndTime, mData.get(i).getEndTime());
							integers.put(kIsTrial, trial_status);
							integers.put(kPackageId, mData.get(i).getPackageId());
							integers.put(kBookDate, Bookdate);
							integers.put(kbatchSloTypeTitle, mData.get(i).getBatchSloTypeName());
							integers.put(kTypeId, mData.get(i).getTypeId());

							jsonBatchId.put(kBatchSlotId, mData.get(i).getBatchSlotId());

							batchIdArray.put(jsonBatchId);
							//integers.put(kCartId,mData.get(i))


							Log.d("print", integers + "" + i + "");

							jsonArray.put(integers);


							Log.d("print_json", "/" + jsonArray + "");

						  /*if(mData.get(i).getIsTrial().equalsIgnoreCase("yes")){
						  	trial_status="yes";
						  }else{
							  trial_status="no";
						  }*/


						} catch (JSONException e) {
							e.printStackTrace();
						}

					} else {

					 /* if(mData.get(i).getIsTrial().equalsIgnoreCase("yes")){
						  trial_status="";
					  }else{
						  trial_status="";
					  }*/

						holder.cv.setCardBackgroundColor(context.getResources().getColor(R.color.white));
						//holder.tv_kit_price.setTextColor(context.getResources().getColor(R.color.user_theme_color));
						holder.tv_sport_timing.setTextColor(context.getResources().getColor(R.color.black));
						holder.tv_sport_max.setTextColor(context.getResources().getColor(R.color.dim_grey));
						//holder.tv_kit_p.setTextColor(context.getResources().getColor(R.color.dim_grey));
						holder.tv_is_trila.setTextColor(context.getResources().getColor(R.color.dim_grey));
						holder.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.black));
						holder.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.dim_grey));
						holder.tv_trila.setTextColor(context.getResources().getColor(R.color.black));
						holder.tv_kit_avail.setTextColor(context.getResources().getColor(R.color.black));
						//holder.img_rupees_kit_p.setColorFilter(context.getResources().getColor(R.color.dim_grey));
						//holder.img_rupees_kit_price.setColorFilter(context.getResources().getColor(R.color.user_theme_color));
						// holder.tv_kit_des.setTextColor(context.getResources().getColor(R.color.dim_grey));
						jsonArray = removeList(jsonArray, pos);

						batchIdArray = removeListId(batchIdArray, pos);
					}

				}
			});
		}


	}

	private String getReminingTime(String time) {
		try {
			SimpleDateFormat inFormat = new SimpleDateFormat("hh:mm a");
			Date date = inFormat.parse(time);
			SimpleDateFormat outFormat = new SimpleDateFormat("hh:mm a");
			String goal = outFormat.format(date);


			return goal.replace("am", "AM").replace("pm", "PM");
		} catch (ParseException e) {
			e.printStackTrace();
			return "";
		}

	}

	@Override
	public int getItemCount() {
		return mData.size();
	}

	public void addData(CopyOnWriteArrayList<UserBatchSlotAvailList> list) {
		mData.addAll(list);
		notifyDataSetChanged();
	}

	public void newData(CopyOnWriteArrayList<UserBatchSlotAvailList> list) {
		mData.clear();
		mData.addAll(list);
		notifyDataSetChanged();
	}

	private String capitizeString(String name) {
		String captilizedString = "";
		if (!name.trim().equals("")) {
			captilizedString = name.substring(0, 1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
	}

	class myViewHolder extends RecyclerView.ViewHolder {

		TextView tv_plan, tv_kit_des, tv_time_slot_des_type, tv_time_slot_des, tv_kit_avail, tv_kit_price, tv_sport_timing, tv_sport_max, tv_booked, tv_kit_p, tv_is_trila, tv_trila;
		CardView cv;
		CheckBox chekbox;
		LinearLayout lv_kit, lv_is_trila,ll_des;
		RelativeLayout rv_type;
		ImageView img_rupees_kit_price,img_rupees_kit_p;

		private myViewHolder(View itemView) {
			super(itemView);
			tv_plan = itemView.findViewById(R.id.tv_plan);
			tv_kit_price = itemView.findViewById(R.id.tv_kit_price);
			tv_sport_timing = itemView.findViewById(R.id.tv_sport_timing);
			tv_sport_max = itemView.findViewById(R.id.tv_sport_max);
			tv_booked = itemView.findViewById(R.id.tv_booked);
			cv = itemView.findViewById(R.id.cv);
			chekbox = itemView.findViewById(R.id.chekbox);
			lv_kit = itemView.findViewById(R.id.lv_kit);
			tv_kit_avail = itemView.findViewById(R.id.tv_kit_avail);
			tv_kit_p = itemView.findViewById(R.id.tv_kit_p);
			rv_type = itemView.findViewById(R.id.rv_type);
			lv_is_trila = itemView.findViewById(R.id.lv_is_trila);
			tv_trila = itemView.findViewById(R.id.tv_trila);
			tv_is_trila = itemView.findViewById(R.id.tv_is_trila);
			tv_time_slot_des_type = itemView.findViewById(R.id.tv_time_slot_des_type);
			tv_time_slot_des = itemView.findViewById(R.id.tv_time_slot_des);
			ll_des=itemView.findViewById(R.id.ll_des);
			img_rupees_kit_price=itemView.findViewById(R.id.img_rupees_kit_price);
			img_rupees_kit_p=itemView.findViewById(R.id.img_rupees_kit_p);
			//=itemView.findViewById(R.id.tv_kit_des);

		}
	}


	public static JSONArray generateJsonArraySports(HashMap<String, String>[] list_array) {
		JSONArray list = new JSONArray();

		for (int i = 0; i < list_array.length; i++) {
			list.put(list_array[i]);

		}


		return list;
	}

	public boolean getSportsSelectionStatus() {
		boolean status = false;

		Log.d("size", isLightOn + "");

		if (isLightOn == false) {
			status = true;
		}
		return status;
	}

	public static JSONArray removeList(JSONArray jarray, int pos) {
		JSONArray list = new JSONArray();

		try {
			for (int i = 0; i < jarray.length(); i++) {
				if (i != pos)
					list.put(jarray.get(i));
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}

	public static JSONArray removeListId(JSONArray jarray, int pos) {
		JSONArray list = new JSONArray();

		try {
			for (int i = 0; i < jarray.length(); i++) {
				if (i != pos)
					list.put(jarray.get(i));
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}

	public static JSONArray getAray() {
		return jsonArray;
	}

   /* public static String getTrial(){
    	return trial_status;
	}*/

	public static JSONArray getArayId() {
		return batchIdArray;
	}
}
