package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.os.Build;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Models.User.BatchSlotList;
import com.socialsportz.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kBatchSlotId;

public class BatchSlotListcancelAdapter extends RecyclerView.Adapter<BatchSlotListcancelAdapter.MyViewHolder> {

	private Context context;
	private CopyOnWriteArrayList<BatchSlotList> itemsList;
	private String booking_for;
	LinearLayout ll_cancel_total_msg;
	long DiffDays;
	int dayDiff;
	int printRefundCancel, printCancelofTotal;
	String formattedDate = "";
	String OneStartDay = "", OneEndday = "", OneCharge = "", twoStartDay = "", twoEndday = "", twoCharge = "", threeStartDay = "", threeEndDay = "", threeCharge = "";
	boolean isSelectedAll;
	CheckBox cb_main;
	ArrayList<Integer> cahcek_list;
	ArrayList<String> totalAmt_list;
	ArrayList<String> totalCancel_list;
	ArrayList<String> totalRefund_list;
	itemClikListner itemClikListner;
	JSONObject jsonBatchId;
	static JSONArray batchIdArray;
	boolean isLightOn;
	String datee;


	public BatchSlotListcancelAdapter(Context context, CopyOnWriteArrayList<BatchSlotList> list, CheckBox cb_main, String booking_for, LinearLayout ll_cancel_total_msg
		, String OneStartDay, String OneEndday, String OneCharge, String twoStartDay, String twoEndday, String twoCharge, String threeStartDay, String threeEndDay, String threeCharge, itemClikListner itemClikListner) {
		this.context = context;
		this.itemsList = list;
		this.booking_for = booking_for;
		this.ll_cancel_total_msg = ll_cancel_total_msg;
		this.OneStartDay = OneStartDay;
		this.OneEndday = OneEndday;
		this.OneCharge = OneCharge;
		this.twoStartDay = twoStartDay;
		this.twoEndday = twoEndday;
		this.twoCharge = twoCharge;
		this.threeStartDay = threeStartDay;
		this.threeEndDay = threeEndDay;
		this.threeCharge = threeCharge;
		this.cb_main = cb_main;
		this.itemClikListner = itemClikListner;
		cahcek_list = new ArrayList<>();
		totalAmt_list = new ArrayList<>();
		totalCancel_list = new ArrayList<>();
		totalRefund_list = new ArrayList<>();
		batchIdArray = new JSONArray();
		getCurrentDate();
		currentDate();

	}

	@NonNull
	@Override
	public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View itemView = LayoutInflater.from(parent.getContext())
			.inflate(R.layout.batchslotlist_raw_view_cancel, parent, false);
		return new MyViewHolder(itemView);
	}


	public String currentDate() {
		Date c = Calendar.getInstance().getTime();

		SimpleDateFormat df = new SimpleDateFormat("dd MMM yyyy");
		formattedDate = df.format(c.getTime());

		Log.d("date", formattedDate);
		return formattedDate;
	}

	@Override
	public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
		BatchSlotList item = itemsList.get(position);
		holder.tv_sportname.setText(item.getSport_name());
		holder.tv_slote_date.setText(convertDate(item.getStart_date()));
		holder.tv_slot_time.setText(item.getBatch_slot_start_time() + "-" + item.getBatch_slot_end_time());
		holder.tv_price.setText(item.getBooking_detail_total_amount());
		DiffDays = Daybetween(convertDate(item.getStart_date()), currentDate(), "dd MMM yyyy");
		Log.d("date", datee + "/" + item.getStart_date() + "/" + item.getBs_cancel_on() + datee.compareTo(item.getStart_date()) + "/" + DiffDays);
		if (item.getBs_cancel_status().equalsIgnoreCase("yes") || DiffDays <= 0) {
			holder.cb.setVisibility(View.GONE);

			if (DiffDays <= 0) {
				holder.tv_cancel_status.setVisibility(View.GONE);
			} else {
				holder.tv_cancel_status.setVisibility(View.VISIBLE);
				holder.tv_cancel_status.setText("Cancelled" + "(" + convertUTCDateToLocalDateeCancel(item.getBs_cancel_on()) + ")");
			}
		} else {
			holder.cb.setVisibility(View.VISIBLE);
			holder.tv_cancel_status.setVisibility(View.GONE);
		}

		holder.cb.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
			@Override
			public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
				if (isChecked) {
					DiffDays = Daybetween(convertDate(item.getStart_date()), currentDate(), "dd MMM yyyy");
					isLightOn = true;
					jsonBatchId = new JSONObject();
					holder.ll_cancel_msg.setVisibility(View.VISIBLE);
					if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
						dayDiff = Math.toIntExact(DiffDays);
					}

					Log.d("StartDate", convertDate(item.getStart_date()) + "/" + ".." + currentDate() + "/" + dayDiff);

					if(OneStartDay.equalsIgnoreCase("")||OneEndday.equalsIgnoreCase("")||twoStartDay.equalsIgnoreCase("")||twoEndday.equalsIgnoreCase("")||threeStartDay.equalsIgnoreCase("")){

					}else{
						if (dayDiff >= Integer.parseInt(OneStartDay) && dayDiff <= Integer.parseInt(OneEndday)) {
							printCancelofTotal = (int) Math.floor(((Integer.parseInt(item.getBooking_detail_total_amount())) * Integer.parseInt(OneCharge)) / 100); // gives 2
							printRefundCancel = Integer.parseInt(item.getBooking_detail_total_amount()) - printCancelofTotal;
							holder.tv_slot_cancel_charge_amnt.setText("(-)" + context.getString(R.string.Rs) + " " + printCancelofTotal);
						} else if (dayDiff >= Integer.parseInt(twoStartDay) && dayDiff <= Integer.parseInt(twoEndday)) {
							printCancelofTotal = (int) Math.floor(((Integer.parseInt(item.getBooking_detail_total_amount())) * Integer.parseInt(twoCharge)) / 100); // gives 2
							holder.tv_slot_cancel_charge_amnt.setText("(-)" + context.getString(R.string.Rs) + " " + printCancelofTotal);
							printRefundCancel = Integer.parseInt(item.getBooking_detail_total_amount()) - printCancelofTotal;
						} else if (dayDiff >= Integer.parseInt(threeStartDay)) {
							printCancelofTotal = (int) Math.floor(((Integer.parseInt(item.getBooking_detail_total_amount())) * Integer.parseInt(threeCharge)) / 100); // gives 2
							holder.tv_slot_cancel_charge_amnt.setText("(-)" + context.getString(R.string.Rs) + " " + printCancelofTotal);
							printRefundCancel = Integer.parseInt(item.getBooking_detail_total_amount()) - printCancelofTotal;
						}
					}


					int pos = position;
					cahcek_list.add(pos);
					totalAmt_list.add(item.getBooking_detail_total_amount());
					totalCancel_list.add(String.valueOf(printCancelofTotal));
					totalRefund_list.add(String.valueOf(printRefundCancel));
					try {
						jsonBatchId.put(kBatchSlotId, item.getBooking_detail_id());
					} catch (JSONException e) {
						e.printStackTrace();
					}

					batchIdArray.put(jsonBatchId);
					itemClikListner.itemAdd(cahcek_list, totalAmt_list, totalCancel_list, totalRefund_list, batchIdArray);

				} else {

					//cb_main.setChecked(false);
					isLightOn = false;
					int pos = position;
					cahcek_list = removeList(cahcek_list, pos);
					totalAmt_list = removeTotalAmntList(totalAmt_list, pos);
					totalCancel_list = removeTotalCancelAmntList(totalCancel_list, pos);
					totalRefund_list = removeRefundAmntList(totalRefund_list, pos);
					batchIdArray = removeBatchSlotId(batchIdArray, pos);

					itemClikListner.itemAdd(cahcek_list, totalAmt_list, totalCancel_list, totalRefund_list, batchIdArray);
					holder.ll_cancel_msg.setVisibility(View.GONE);
					//ll_cancel_total_msg.setVisibility(View.GONE);
				}


			}
		});



	}


	class MyViewHolder extends RecyclerView.ViewHolder {
		CheckBox cb;
		TextView tv_sportname, tv_cancel_status, tv_canceled_sports, tv_slot_time, tv_slote_date, tv_price, tv_slot_cancel_charge_amnt, tv_slot_refund_amnt;
		LinearLayout ll_cancel_msg, ll_cancel_total_msg;


		MyViewHolder(View view) {
			super(view);
			cb = view.findViewById(R.id.cb);
			tv_sportname = view.findViewById(R.id.tv_sportname);
			tv_canceled_sports = view.findViewById(R.id.tv_canceled_sports);
			tv_slot_time = view.findViewById(R.id.tv_slot_time);
			tv_slote_date = view.findViewById(R.id.tv_slote_date);
			tv_price = view.findViewById(R.id.tv_price);
			tv_slot_cancel_charge_amnt = view.findViewById(R.id.tv_slot_cancel_charge_amnt);
			tv_slot_refund_amnt = view.findViewById(R.id.tv_slot_refund_amnt);
			ll_cancel_msg = view.findViewById(R.id.ll_cancel_msg);
			tv_cancel_status = view.findViewById(R.id.tv_cancel_status);

			View v1 = view.findViewById(R.id.v1);
			v1.setLayerType(View.LAYER_TYPE_SOFTWARE, null);

		}
	}

	public long Daybetween(String date1, String date2, String pattern) {
		SimpleDateFormat sdf = new SimpleDateFormat(pattern, Locale.ENGLISH);
		Date Date1 = null, Date2 = null;
		try {
			Date1 = sdf.parse(date1);
			Date2 = sdf.parse(date2);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return (Date1.getTime() - Date2.getTime()) / (24 * 60 * 60 * 1000);
	}


	public void selectAll() {
		isSelectedAll = true;
		notifyDataSetChanged();
	}

	public void unselectall() {
		isSelectedAll = false;
		notifyDataSetChanged();
	}


	public interface itemClikListner {
		void itemAdd(ArrayList<Integer> integers, ArrayList<String> totalAmt, ArrayList<String> totalCancellist, ArrayList<String> totalRefundAmtList, JSONArray jsonArray);
	}

	private void getCurrentDate() {
		Calendar startDate = Calendar.getInstance();

		SimpleDateFormat sdf = new SimpleDateFormat("yy-MM-dd");

		datee = sdf.format(startDate.getTime());

		Log.d("CDate", datee);
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

	public boolean getSportsSelectionStatus() {
		boolean status = false;

		Log.d("size", isLightOn + "");

		if (isLightOn == false) {
			status = true;
		}
		return status;
	}

	public static ArrayList removeList(ArrayList<Integer> integers, int pos) {
		ArrayList<Integer> list = new ArrayList<>();

		try {
			for (int i = 0; i < integers.size(); i++) {
				if (i != pos)
					list.add(integers.get(i));

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}

	public static JSONArray removeBatchSlotId(JSONArray jarray, int pos) {
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


	public static ArrayList removeTotalAmntList(ArrayList<String> integers, int pos) {
		ArrayList<String> list = new ArrayList<>();

		try {
			for (int i = 0; i < integers.size(); i++) {
				if (i != pos)
					list.add(integers.get(i));

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}

	public static ArrayList removeTotalCancelAmntList(ArrayList<String> integers, int pos) {
		ArrayList<String> list = new ArrayList<>();

		try {
			for (int i = 0; i < integers.size(); i++) {
				if (i != pos)
					list.add(integers.get(i));

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}

	public static ArrayList removeRefundAmntList(ArrayList<String> integers, int pos) {
		ArrayList<String> list = new ArrayList<>();

		try {
			for (int i = 0; i < integers.size(); i++) {
				if (i != pos)
					list.add(integers.get(i));

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}


	public static ArrayList removeTotalAmntListt(ArrayList<String> integers) {
		ArrayList<String> list = new ArrayList<>();

		try {
			for (int i = 0; i < integers.size(); i++) {
				list.add(integers.get(i));


			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}

	public static ArrayList removeTotalCancelAmntListt(ArrayList<String> integers) {
		ArrayList<String> list = new ArrayList<>();

		try {
			for (int i = 0; i < integers.size(); i++) {
				list.add(integers.get(i));

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}

	public static ArrayList removeRefundAmntListt(ArrayList<String> integers) {
		ArrayList<String> list = new ArrayList<>();

		try {
			for (int i = 0; i < integers.size(); i++) {
				list.add(integers.get(i));

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return list;
	}


	private String convertDate(String date1) {
		DateFormat inputFormat = new SimpleDateFormat("yyyy-MM-dd");
		DateFormat outputFormat = new SimpleDateFormat("dd MMM yyyy");
		Date date = null;
		String outputDateStr = null;
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
}
