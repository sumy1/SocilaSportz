package com.socialsportz.Activities.Facility.Adapters;

import android.app.Dialog;
import android.content.ActivityNotFoundException;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.net.Uri;
import android.os.Handler;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.Facility.BatchSlotBookingDetailActivity;
import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
import com.socialsportz.Activities.User.Adapters.BatchSlotListcancelOwnerAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.Models.Owner.SlotBookingDetails;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLinearLayoutManager;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Locale;
import java.util.Objects;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kBookingId;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kEventCancelCharge;
import static com.socialsportz.Constants.Constants.kEventCancelReason;
import static com.socialsportz.Constants.Constants.kEventCancelRefundAmnt;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kOptioOneStartDate;
import static com.socialsportz.Constants.Constants.kOptionOneCharge;
import static com.socialsportz.Constants.Constants.kOptionOneEndday;
import static com.socialsportz.Constants.Constants.kOptionThreeCharge;
import static com.socialsportz.Constants.Constants.kOptionThreeEndDay;
import static com.socialsportz.Constants.Constants.kOptionThreeStartDay;
import static com.socialsportz.Constants.Constants.kOptionTwoCharge;
import static com.socialsportz.Constants.Constants.kOptionTwoStartDay;
import static com.socialsportz.Constants.Constants.kOptiontwoEndday;
import static com.socialsportz.Constants.Constants.kSelectAll;
import static com.socialsportz.Constants.Constants.kUserBatchSlotIds;
import static com.socialsportz.Constants.Constants.kconveniensTexes;

public class BookingAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {
	private Context context;
	private CopyOnWriteArrayList<Bookings> mData;
	private int pageSize;
	Dialog dialog;
	String OneStartDay = "", OneEndday = "", OneCharge = "", twoStartDay = "", twoEndday = "", twoCharge = "", threeStartDay = "", threeEndDay = "", threeCharge = "";
	BatchSlotListcancelOwnerAdapter batchSlotListAdapter;
	int printRefundCancel, printCancelofTotal, discount_amnt, total_refund_amount;
	int total_amnt_list_item, total_cancel_list_item, total_refund_list_item;
	CustomLoaderView loaderView;
	String SelectAll = "";
	JSONArray batchSlotids;
	onitemclick onitemclick;
	ArrayList<String> cancel_status;
	ArrayList<Long> date_list;
	CopyOnWriteArrayList<SlotBookingDetails> batchSlotLists;
	long DiffDays;
	String formattedDate = "", sDate = "", sTime, cTime = "";
	String categoryType;

	public BookingAdapter(Context context, CopyOnWriteArrayList<Bookings> data, onitemclick onitemclick) {
		this.context = context;
		this.mData = data;
		this.pageSize = mData.size();
		this.onitemclick = onitemclick;

		getUserCancellationCharge();
		loaderView = CustomLoaderView.initialize(context);
		Log.d("allConcentvalue", OneStartDay + "/" + OneEndday + "/" + OneCharge + "/" + twoStartDay + "/" + twoEndday + "/" + twoCharge + "/" + threeStartDay + "/" + threeEndDay + "/" + threeCharge);
	}


	private void getUserCancellationCharge() {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());

		Log.e("send", parameters.toString());
		ModelManager.modelManager().usergetCancellationCharge(parameters,
			(Constants.Status iStatus, GenericResponse<JSONObject> genericResponse) -> {
				try {
					JSONObject jsonObject = genericResponse.getObject();

					OneStartDay = jsonObject.getString(kOptioOneStartDate);
					OneEndday = jsonObject.getString(kOptionOneEndday);
					OneCharge = jsonObject.getString(kOptionOneCharge);
					twoStartDay = jsonObject.getString(kOptionTwoStartDay);
					twoEndday = jsonObject.getString(kOptiontwoEndday);
					twoCharge = jsonObject.getString(kOptionTwoCharge);
					threeStartDay = jsonObject.getString(kOptionThreeStartDay);
					threeEndDay = jsonObject.getString(kOptionThreeEndDay);
					threeCharge = jsonObject.getString(kOptionThreeCharge);


					Log.d("Cancellation", "OneSDay" + ".." + OneStartDay + ".." + "OneDayEnd" + ".." +
						OneEndday + ".." + "OneCharge" + ".." + OneCharge + ".." + "TwoSday" + ".." + twoStartDay + ".." +
						"twoEndDay" + ".." + twoEndday + ".." + "twoCharge" + ".." + twoCharge + ".." +
						"threeSDay" + ".." + threeStartDay + ".." + "ThreeEndday" + ".." + threeEndDay + ".." +
						"threeCharge" + ".." + threeCharge);

					//printConvesnies=

				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));


	}

	@Override
	public int getItemViewType(int position) {
		if (position == mData.size()) {
			return 0;
		} else {
			return 1;
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

	@NonNull
	@Override
	public RecyclerView.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		if (viewType == 1) {
			View layoutView = LayoutInflater.from(context)
				.inflate(R.layout.row_booking_ticket_view, parent, false);
			return new MyViewHolder(layoutView);
		} else {
			View layoutView = LayoutInflater.from(context)
				.inflate(R.layout.row_progress_view, parent, false);
			return new ProgressHolder(layoutView);
		}
	}

	@Override
	public void onBindViewHolder(@NonNull RecyclerView.ViewHolder holder, int position) {
		if (position == mData.size()) {
			ProgressHolder view = (ProgressHolder) holder;
			if (mData.isEmpty() || mData.size() < 8) {
				view.progressBar.setVisibility(View.GONE);
			} else if (mData.size() >= pageSize) {
				view.progressBar.setVisibility(View.VISIBLE);
				new Handler().postDelayed(() -> {
					//Hide the refresh after 2sec
					((FacilityDashboardActivity) context).runOnUiThread(
						() -> view.progressBar.setVisibility(View.GONE));
				}, 2000);
			}

		} else {
			MyViewHolder myViewHolder = (MyViewHolder) holder;
			 Bookings model = myViewHolder.BindData(mData.get(position));
			batchSlotLists = mData.get(position).getBookingListModels();
			categoryType=model.getBatch_slot_type_name();
			//myViewHolder.ivSport.setImageResource(R.drawable.man);
			myViewHolder.id.setText(model.getBooking_order());
			myViewHolder.name.setText(model.getName());
			myViewHolder.mail.setText(model.getMail());
			myViewHolder.contact.setText(model.getMobile());
			myViewHolder.type.setText(capitizeString(model.getType()));
			myViewHolder.category_type.setText(categoryType);

			cancel_status = new ArrayList<>();
			date_list = new ArrayList<>();


			for (int i = 0; i < batchSlotLists.size(); i++) {
				myViewHolder.category_type.setText(batchSlotLists.get(i).getCategoryType());
				categoryType=batchSlotLists.get(i).getCategoryType();
				DiffDays = Daybetween(convertDate(batchSlotLists.get(i).getStartDate()), currentDate(), "dd MMM yyyy");

				if (DiffDays <=0) {
					date_list.add(DiffDays);
				} else {

				}


			}

			for (int i = 0; i < batchSlotLists.size(); i++) {
				if (batchSlotLists.get(i).getBs_cancel_status().equalsIgnoreCase("yes")) {
					cancel_status.add(batchSlotLists.get(i).getBs_cancel_status());
				} else {

				}
			}





			//myViewHolder.academy.setText(mData.get(i).getAcademy());
			String value = model.getStatus();
			if (value.equals(Constants.BookingStatus.confirm.toString())) {
				myViewHolder.status.setTextColor(context.getResources().getColor(R.color.green));
				myViewHolder.status.setText(context.getResources().getString(R.string.payment_done));
			} else if (value.equals(Constants.BookingStatus.pending.toString())) {
				myViewHolder.status.setTextColor(context.getResources().getColor(R.color.red));
				myViewHolder.status.setText(context.getResources().getString(R.string.payment_pending));
			}

			CustomLinearLayoutManager layoutManager = new CustomLinearLayoutManager(context, RecyclerView.VERTICAL, false);
			BookingListAdapter bookingListAdapter = new BookingListAdapter(context, model, model.getBookingListModels());
			myViewHolder.rvBookList.setLayoutManager(layoutManager);
			myViewHolder.rvBookList.setAdapter(bookingListAdapter);

			myViewHolder.itemView.setOnClickListener(view -> {
				Intent in = new Intent(context, BatchSlotBookingDetailActivity.class);
				in.putExtra(kData, model);
				context.startActivity(in);
			});


               String status=model.getType();
			if (status.equals("offline")) {
				myViewHolder.tv_cancel.setVisibility(View.VISIBLE);
				myViewHolder.tv_cancel.setOnClickListener(v -> {
					//int pos=position;
					detailsDilaogg(mData.get(position).getBookingListModels(), model.getEventcancelCharge(), model.getEventConveniencetax(), model.getEventCancelRefundAmnt(), model.getEventCancelresion(), model.getType(), model.getBokingFor(), String.valueOf(model.getBooking_id()), model.getDate(), model.getSportName(), model.getBatchSlotSTime(), model.getBatchSlotETime(), model.getBookingStartDate(), model.getPackageName(), model.getTotal_amount(), model.getDiscount(), model.getFinal_amount());

					Log.d("tax", model.getEventConveniencetax());

				});


				if (cancel_status.size() == batchSlotLists.size()) {

					myViewHolder.tv_cancel.setVisibility(View.GONE);

				} else if (date_list.size() == batchSlotLists.size()) {

					myViewHolder.tv_cancel.setVisibility(View.GONE);

				} else {
					myViewHolder.tv_cancel.setVisibility(View.VISIBLE);

				}


			} else {
				myViewHolder.tv_cancel.setVisibility(View.GONE);
			}

			Log.d("Size",cancel_status.size()+"/"+batchSlotLists.size());


			myViewHolder.rv_type.setTag(model.getDownloadReceipt());
			myViewHolder.rv_type.setOnClickListener(v -> {

				if (!model.getDownloadReceipt().isEmpty()) {

					String path = model.getDownloadReceipt();


					Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(path));
					intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
					intent.setPackage("com.android.chrome");
					try {
						context.startActivity(intent);
					} catch (ActivityNotFoundException ex) {
						// Chrome browser presumably not installed so allow user to choose instead
						intent.setPackage(null);
						context.startActivity(intent);
					}

				} else {

				}

			});

		}

	}

	public String currentDate() {
		Date c = Calendar.getInstance().getTime();

		SimpleDateFormat df = new SimpleDateFormat("dd MMM yyyy");
		formattedDate = df.format(c.getTime());

		Log.d("date", formattedDate + "/" + sDate);
		return formattedDate;
	}

	private String convertDate(String date1) {
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

	private void detailsDilaogg(CopyOnWriteArrayList<SlotBookingDetails> batchSlotLists, String cancelCharge, String tax, String refund_amnt, String cancelresion, String bookingType, String boookingFor, String bookingId, String transDate, String sportName, String slotSTime, String slotETime, String packageName, String slotDate, String totalAmnt, String discountAmt, String final_amnt) {
		// dialog
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.cancel_dialog);
		RecyclerView rv_details = dialog.findViewById(R.id.rv_detailss);
		LinearLayoutManager mLayoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		rv_details.setLayoutManager(mLayoutManager);
		rv_details.addItemDecoration(new SpaceItemDecoration(10));
		LinearLayout ll_cancel_total_msg = dialog.findViewById(R.id.ll_cancel_total_msg);

		TextView tv_total_amnt = dialog.findViewById(R.id.tv_total_amnt);
		TextView tv_total_cancelletion_charge_amnt = dialog.findViewById(R.id.tv_total_cancelletion_charge_amnt);
		TextView tv_coupan_amt = dialog.findViewById(R.id.tv_coupan_amt);
		EditText editText = dialog.findViewById(R.id.et_message);
		TextView tv_submit = dialog.findViewById(R.id.tv_submit);

		TextView tv_batchSlot_time = dialog.findViewById(R.id.tv_batchSlot_time);


		if (boookingFor.equalsIgnoreCase("facility")) {
			tv_batchSlot_time.setText("Slot Time");
		} else {
			tv_batchSlot_time.setText("Batch Time");
		}

		if (Integer.parseInt(discountAmt) > 0) {
			tv_coupan_amt.setVisibility(View.VISIBLE);
			tv_coupan_amt.setText(context.getString(R.string.Rs) + " " + discountAmt);
		} else {
			tv_coupan_amt.setText(context.getString(R.string.Rs) + " " + "0");
			tv_coupan_amt.setVisibility(View.VISIBLE);
		}
		TextView tv_total_refund_amnt = dialog.findViewById(R.id.tv_total_refund_amnt);

		TextView tv_offline_msg = dialog.findViewById(R.id.tv_offline_msg);
		RelativeLayout rl_online_msg = dialog.findViewById(R.id.rl_online_msg);

		CheckBox cb_main = dialog.findViewById(R.id.cb_main);
		/*if (bookingType.equalsIgnoreCase("Offline")) {
			tv_offline_msg.setVisibility(View.VISIBLE);
			rl_online_msg.setVisibility(View.GONE);
			rv_details.setVisibility(View.GONE);
		} else {
			tv_offline_msg.setVisibility(View.GONE);
		}*/

		rl_online_msg.setVisibility(View.VISIBLE);
		rv_details.setVisibility(View.VISIBLE);
		View v1 = dialog.findViewById(R.id.v3);
		v1.setLayerType(View.LAYER_TYPE_SOFTWARE, null);


		batchSlotListAdapter = new BatchSlotListcancelOwnerAdapter(context, batchSlotLists, ll_cancel_total_msg,
			OneStartDay, OneEndday, OneCharge, twoStartDay, twoEndday, twoCharge, threeStartDay, threeEndDay, threeCharge, new BatchSlotListcancelOwnerAdapter.itemClikListner() {
			@Override
			public void itemAdd(ArrayList<Integer> integers, ArrayList<String> totalAmt, ArrayList<String> totalCancellist, ArrayList<String> totalRefundAmtList, JSONArray batchslotid) {

				total_amnt_list_item = 0;
				total_cancel_list_item = 0;
				total_refund_list_item = 0;
				batchSlotids = batchslotid;

				/*if (batchslotid.length() == batchSlotLists.size()) {
					SelectAll = "yes";
				} else {
					SelectAll = "no";
				}*/

				Log.d("integre", integers.size() + "");

				for (int i = 0; i < totalAmt.size(); i++) {


					Log.d("price", totalAmt.size() + "");
					total_amnt_list_item += Integer.parseInt(totalAmt.get(i));
					tv_total_amnt.setText(context.getString(R.string.Rs) + " " + total_amnt_list_item);

				}

				for (int i = 0; i < totalCancellist.size(); i++) {

					total_cancel_list_item += Integer.parseInt(totalCancellist.get(i));
					tv_total_cancelletion_charge_amnt.setText(context.getString(R.string.Rs) + " " + total_cancel_list_item);

				}

				for (int i = 0; i < totalRefundAmtList.size(); i++) {

					total_refund_list_item += Integer.parseInt(totalRefundAmtList.get(i));


				}


				total_refund_amount = total_refund_list_item - Integer.parseInt(discountAmt);

				if (total_refund_amount < Integer.parseInt(discountAmt)) {
					total_refund_amount = 0;
					tv_total_refund_amnt.setText(context.getString(R.string.Rs) + " " + total_refund_amount);
				} else {
					tv_total_refund_amnt.setText(context.getString(R.string.Rs) + " " + total_refund_amount);
				}


				if (integers.isEmpty()) {
					ll_cancel_total_msg.setVisibility(View.GONE);
				} else {
					ll_cancel_total_msg.setVisibility(View.VISIBLE);
						/*if (batchSlotLists.size() == integers.size()) {
							cb_main.setChecked(true);
						} else {
							cb_main.setChecked(false);
						}*/
				}

			}

		});


		rv_details.setAdapter(batchSlotListAdapter);


		tv_submit.setOnClickListener(v -> {
			//dialog.dismiss();
			if (editText.getText().toString().equalsIgnoreCase("")) {
				Toaster.customToast("Please Enter reason for cancellation");
			} else if (batchSlotListAdapter.getSportsSelectionStatus()) {
				Toaster.customToast("Please Select Event for Cancel");
			} else {
				getBookingCancelreguest(bookingId, String.valueOf(total_cancel_list_item), tax, String.valueOf(total_refund_amount), editText.getText().toString(), SelectAll, batchSlotids,boookingFor);
				//bookingIdd,String.valueOf(printCancelofTotal), tax,String.valueOf(printRefundCancel),editText.getText().toString()
			}

		});

		///}
			/*cb_main.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					if (cb_main.isChecked()) {
						batchSlotListAdapter.selectAll();
						//cb_main.setChecked(true);
					} else {
						batchSlotListAdapter.unselectall();

						//cb_main.setChecked(false);
					}


				}
			});*/


		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

		dialog.show();
		//}
	}

	private void getBookingCancelreguest(String bookingId, String cancelCharge, String tax, String refundAmnt, String resion, String selectAll, JSONArray batchSlotIds,String boookingFor) {
		//String bookingId,String cancelCharge,String tax,String refundAmnt,String resion

		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kBookingId, bookingId);
		map.put(kEventCancelCharge, cancelCharge);
		map.put(kconveniensTexes, tax);
		map.put(kEventCancelRefundAmnt, refundAmnt);
		map.put(kEventCancelReason, resion);
		map.put(kSelectAll, selectAll);
		map.put(kUserBatchSlotIds, batchSlotIds);


		Log.e("sendcarat", map.toString());

		ModelManager.modelManager().userBookingBatchSlotCancel(map, (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
			loaderView.hideLoader();
			try {
				String msg = genericResponse.getObject();
				//Toaster.customToast(msg);
				dialog.dismiss();
				CongratsDialogg(boookingFor,msg);

				//Log.e(TAG,"msg: " +msg);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});


	}

	private void CongratsDialogg(String boookingFor,String user) {
		final Dialog dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_congrats_screen_cancel);
		dialog.setCancelable(false);
		TextView tv_msg = dialog.findViewById(R.id.tv_msg);
		if(boookingFor.equalsIgnoreCase("facility")){
			tv_msg.setText("Slot has been cancelled successfully");
		}else {
			tv_msg.setText("Batch has been cancelled successfully");
		}
		dialog.findViewById(R.id.btn_continue).setOnClickListener(v -> {
			dialog.dismiss();
			//mRefreshListner.refreshView();
			onitemclick.refresh();

		});

		dialog.show();
	}

	private String capitizeString(String name) {
		String captilizedString = "";
		if (!name.trim().equals("")) {
			captilizedString = name.substring(0, 1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
	}

	public interface onitemclick {
		void refresh();
	}

	@Override
	public int getItemCount() {
		return mData.size() + 1;
	}

	public void addData(CopyOnWriteArrayList<Bookings> list) {
		mData.addAll(list);
		notifyDataSetChanged();
	}

	public void newData(CopyOnWriteArrayList<Bookings> list) {
		mData.clear();
		mData.addAll(list);
		notifyDataSetChanged();
	}


	class MyViewHolder extends RecyclerView.ViewHolder {
		Bookings model;
		TextView id, name, mail, contact, tv_cancel_status, status, type, tv_cancel,category_type;
		RecyclerView rvBookList;
		RelativeLayout rv_type;

		private MyViewHolder(View itemView) {
			super(itemView);
			//ivSport=itemView.findViewById(R.id.iv_profile);
			id = itemView.findViewById(R.id.tv_booking_id);
			name = itemView.findViewById(R.id.recycler_booking_tv_name);
			contact = itemView.findViewById(R.id.recycler_booking_tv_contact);
			mail = itemView.findViewById(R.id.recycler_booking_tv_mail);
			//academy=itemView.findViewById(R.id.recycler_booking_tv_academy);
			status = itemView.findViewById(R.id.recycler_booking_tv_payment_status);
			type = itemView.findViewById(R.id.tv_booking_type);
			rv_type = itemView.findViewById(R.id.rv_type);
			//btnView=itemView.findViewById(R.id.btn_booking_view);
			rvBookList = itemView.findViewById(R.id.rv_booking_list);
			tv_cancel = itemView.findViewById(R.id.tv_cancel);
			tv_cancel_status = itemView.findViewById(R.id.tv_cancel_status);
			category_type=itemView.findViewById(R.id.category_type);
		}

		private Bookings BindData(Bookings model) {
			this.model = model;
			return model;
		}
	}

	class ProgressHolder extends RecyclerView.ViewHolder {

		ProgressBar progressBar;

		ProgressHolder(View itemView) {
			super(itemView);
			progressBar = itemView.findViewById(R.id.progress_bar);
		}
	}

	class BookingListAdapter extends RecyclerView.Adapter<BookingListAdapter.myViewHolder> {

		Context context;
		CopyOnWriteArrayList<SlotBookingDetails> mData;
		CopyOnWriteArrayList<Sport> sports;
		Bookings model;
		ArrayList<String> cancel_status;
		ArrayList<Long> date_list;
		long DiffDays;

		BookingListAdapter(Context context, Bookings booking, CopyOnWriteArrayList<SlotBookingDetails> data) {
			this.context = context;
			this.mData = data;
			this.model = booking;
			CurrentUser user = ModelManager.modelManager().getCurrentUser();
			this.sports = user.getSports();
		}

		@NonNull
		@Override
		public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(context).inflate(R.layout.row_booking_fields_layout, parent, false);
			return new myViewHolder(view);
		}

		@Override
		public void onBindViewHolder(@NonNull final myViewHolder holder, int pos) {
			SlotBookingDetails modal = mData.get(pos);
			cancel_status=new ArrayList<>();
			date_list=new ArrayList<>();
			DiffDays=Daybetween(convertDate(modal.getStartDate()),currentDate(),"dd MMM yyyy");
			for (int i = 0; i < sports.size(); i++) {
				if (sports.get(i).getSportId() == modal.getSportId()) {
					holder.tvSportName.setText(sports.get(i).getSportName());
					String path = kImageBaseUrl + sports.get(i).getFolderName() + "/" + sports.get(i).getSportImg();
					Picasso.with(context).load(path).placeholder(R.drawable.football_image).into(holder.ivSport);
					break;
				}
			}
			holder.tvSportDate.setText(Utils.changeDateNew(modal.getStartDate()));
			String time = modal.getStartTime() + " to " + modal.getEndTime();
			holder.tvSportTime.setText(time);
			if (!modal.getPackageName().isEmpty()) {
				holder.tvBatchType.setVisibility(View.VISIBLE);
				holder.tvBatchType.setText(modal.getPackageName());
			}

			holder.itemView.setOnClickListener(v -> {
				Intent in = new Intent(context, BatchSlotBookingDetailActivity.class);
				in.putExtra(kData, model);
				context.startActivity(in);
			});
			if (pos == getItemCount() - 1) {
				holder.div.setVisibility(View.GONE);
			}




			if(modal.getBs_cancel_status().equalsIgnoreCase("yes") || DiffDays <=0){
				//holder.div.setVisibility(View.VISIBLE);
				if(modal.getBs_cancel_on().equals("")){
					///holder.div.setVisibility(View.GONE);
					holder.tv_cancel_status.setVisibility(View.GONE);

				}else{
					//holder.div.setVisibility(View.VISIBLE);
					holder.tv_cancel_status.setVisibility(View.VISIBLE);
					holder.tv_cancel_status.setText("Cancelled"+"("+convertUTCDateToLocalDateeCancel(modal.getBs_cancel_on())+")");
				}

			}else{
				//holder.div.setVisibility(View.GONE);
				holder.tv_cancel_status.setVisibility(View.GONE);


			}
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

		@Override
		public int getItemCount() {
			return mData.size();
		}

		class myViewHolder extends RecyclerView.ViewHolder {
			ImageView ivSport;
			TextView tvSportName, tvBatchType,tv_cancel_status, tvSportDate, tvSportTime;
			View div;

			private myViewHolder(View itemView) {
				super(itemView);
				ivSport = itemView.findViewById(R.id.iv_sport);
				tvSportName = itemView.findViewById(R.id.recycler_booking_tv_sports);
				tvSportDate = itemView.findViewById(R.id.recycler_booking_tv_date);
				tvSportTime = itemView.findViewById(R.id.recycler_booking_tv_time);
				tvBatchType = itemView.findViewById(R.id.recycler_booking_tv_batch);
				div = itemView.findViewById(R.id.div_view);
				tv_cancel_status=itemView.findViewById(R.id.tv_cancel_status);
			}
		}

	}
}
