package com.socialsportz.Activities.User.Adapters;

import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.ActivityNotFoundException;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Environment;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RatingBar;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.User.Activities.MyReviewsActivity;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.Models.User.BatchSlotList;
import com.socialsportz.Models.User.FacilityAcademyBookListItem;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.FileDownloader;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.File;
import java.io.IOException;
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
import androidx.appcompat.app.AlertDialog;
import androidx.core.content.FileProvider;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kBookingId;
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
import static com.socialsportz.Constants.Constants.kRating;
import static com.socialsportz.Constants.Constants.kSelectAll;
import static com.socialsportz.Constants.Constants.kUserBatchSlotIds;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kconveniensTexes;
import static com.socialsportz.Constants.Constants.kratingMsg;

public class UserFacilityBookingAdapter extends RecyclerView.Adapter<UserFacilityBookingAdapter.MyViewHolder> {
	private Context context;
	private CopyOnWriteArrayList<FacilityAcademyBookListItem> mData;
	Dialog dialog;
	String rating_size;
	CustomLoaderView loaderView;
	private ProgressDialog progressDialog;
	EditText editText1;
	String formattedDate = "", sDate = "", sTime, cTime = "";
	BatchSlotListcancelAdapter batchSlotListAdapter;
	long DiffDays;
	boolean isCbChecked;
	int dayDiff;
	int printRefundCancel, printCancelofTotal, discount_amnt, total_refund_amount;
	String OneStartDay = "", OneEndday = "", OneCharge = "", twoStartDay = "", twoEndday = "", twoCharge = "", threeStartDay = "", threeEndDay = "", threeCharge = "";
	CopyOnWriteArrayList<BatchSlotList> batchSlotLists;
	String SelectAll="";
	JSONArray batchSlotids;
	onitemclick onitemclick;
	ArrayList<String>cancel_status;
	ArrayList<Long>date_list;

	int total_amnt_list_item, total_cancel_list_item, total_refund_list_item;


	public UserFacilityBookingAdapter(Context context, CopyOnWriteArrayList<FacilityAcademyBookListItem> data, onitemclick onitemclick) {
		this.context = context;
		this.mData = data;
		this.onitemclick=onitemclick;
		getUserCancellationCharge();

		loaderView = CustomLoaderView.initialize(context);

		//currentDate();
		//getCurrentTime();

	}

	public interface onitemclick{
		void refresh();
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
	public UserFacilityBookingAdapter.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View layoutView = LayoutInflater.from(context)
			.inflate(R.layout.row_view_user_batch_slot_booking_facility, parent, false);
		return new MyViewHolder(layoutView);
	}

	@Override
	public void onBindViewHolder(@NonNull UserFacilityBookingAdapter.MyViewHolder holder, int position) {
		cancel_status=new ArrayList<>();
		date_list=new ArrayList<>();
		FacilityAcademyBookListItem userEventBookedItemList = mData.get(position);
		batchSlotLists=userEventBookedItemList.getBatchSlotLists();


		if (!userEventBookedItemList.getFacBaImage().isEmpty()) {
			String imgPath = kImageBaseUrl + userEventBookedItemList.getFoldername() + "/" + userEventBookedItemList.getFacBaImage();
			Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(holder.iv_banner);
		} else {
			Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(holder.iv_banner);
		}

		for(int i=0;i<batchSlotLists.size();i++){
			DiffDays=Daybetween(convertDate(batchSlotLists.get(i).getStart_date()),currentDate(),"dd MMM yyyy");

			if(DiffDays <=0){
				date_list.add(DiffDays);
			}else{

			}
		}


		for(int i=0;i<batchSlotLists.size();i++){
			if(batchSlotLists.get(i).getBs_cancel_status().equalsIgnoreCase("yes")){
				cancel_status.add(batchSlotLists.get(i).getBs_cancel_status());
			}else {

			}
		}


		Log.d("Size",cancel_status.size()+"/"+mData.size()+"");
		if(cancel_status.size()==batchSlotLists.size()){
			holder.tv_cancel.setVisibility(View.GONE);
			holder.tv_cancel_status.setVisibility(View.GONE);
			holder.tv_cancel_status.setText("Cancelled");

		}else if(date_list.size()==batchSlotLists.size()) {
			holder.tv_cancel.setVisibility(View.GONE);
			holder.tv_cancel_status.setVisibility(View.GONE);
			holder.tv_cancel_status.setText("Cancelled");

		}else {
			holder.tv_cancel.setVisibility(View.VISIBLE);
			holder.tv_cancel_status.setVisibility(View.GONE);


		}

		LinearLayoutManager mLayoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		BookingListAdapter bookingListAdapter = new BookingListAdapter(context,userEventBookedItemList,userEventBookedItemList.getBatchSlotLists(),userEventBookedItemList.getSportFolderName() );
		holder.rvBookList.setLayoutManager(mLayoutManager);
		//holder.rvBookList.addItemDecoration(new SpaceItemDecoration(10));
		holder.rvBookList.setAdapter(bookingListAdapter);





		holder.id.setText(userEventBookedItemList.getBookedOrdeNo());
		holder.address.setText(userEventBookedItemList.getFacName());
		holder.name.setText(capitizeString(userEventBookedItemList.getBokingFor()));

		sDate = convertUTCDateToLocalDate(userEventBookedItemList.getsDate());
		//sTime=getReminingTime(userEventBookedItemList.getBatchSlotSTime());
		/*if (userEventBookedItemList.getBokingFor().equalsIgnoreCase("facility")) {
			holder.rl_batch.setVisibility(View.GONE);
			holder.rl_slot.setVisibility(View.VISIBLE);

			holder.tv_sDate_fac.setText(convertUTCDateToLocalDatee(userEventBookedItemList.getsDate()));
			holder.tv_sTime_f.setText(getReminingTime(userEventBookedItemList.getBatchSlotSTime()));
			holder.tv_eTime_f.setText(getReminingTime(userEventBookedItemList.getBatchSlotETime()));


		} else {
			holder.rl_batch.setVisibility(View.VISIBLE);
			holder.rl_slot.setVisibility(View.GONE);

			holder.tv_sDate.setText(convertUTCDateToLocalDatee(userEventBookedItemList.getsDate()));
			holder.tv_eDate.setText(convertUTCDateToLocalDatee(userEventBookedItemList.geteDate()));
			holder.tv_sTime.setText(getReminingTime(userEventBookedItemList.getBatchSlotSTime()));
			holder.tv_eTime.setText(getReminingTime(userEventBookedItemList.getBatchSlotETime()));
			holder.tv_ePlan.setText("( " + userEventBookedItemList.getPackagename() + " )");
		}*/


		//holder.sport.setText(userEventBookedItemList.getSportName());

		if (userEventBookedItemList.getBookingStatus().equalsIgnoreCase("confirm")) {

			holder.tv_ostatus.setText(capitizeString(userEventBookedItemList.getBookingStatus()));
			holder.tv_ostatus.setTextColor(context.getResources().getColor(R.color.green_drak));
		} else {
			holder.tv_ostatus.setText(capitizeString(userEventBookedItemList.getBookingStatus()));
			holder.tv_ostatus.setTextColor(context.getResources().getColor(R.color.white));
		}

		if (userEventBookedItemList.getPaymentStatus().equalsIgnoreCase("success")) {

			holder.tv_pstatus.setText(capitizeString(userEventBookedItemList.getPaymentStatus()));
			holder.tv_pstatus.setTextColor(context.getResources().getColor(R.color.green_drak));
		} else {
			holder.tv_pstatus.setText(capitizeString(userEventBookedItemList.getPaymentStatus()));
			holder.tv_pstatus.setTextColor(context.getResources().getColor(R.color.white));
		}





		holder.tv_order_date.setText(convertUTCDateToLocalDate(userEventBookedItemList.getBookingOn()));


		holder.ll_bookingId.setOnClickListener(v -> {
			int pos = position;

			Log.d("position", pos + "");



			detailsDilaog(userEventBookedItemList.getEventConveniencefee(),userEventBookedItemList.getEventConveniencetax(),mData.get(pos).getBatchSlotLists(), userEventBookedItemList.getBokingFor(), userEventBookedItemList.getBookedOrdeNo(), userEventBookedItemList.getBookingOn(), userEventBookedItemList.getBooking_type(), userEventBookedItemList.getSportIcon(), userEventBookedItemList.getSportFolderName(), userEventBookedItemList.getSportName(), userEventBookedItemList.getBatchSlotSTime(), userEventBookedItemList.getBatchSlotETime(), userEventBookedItemList.getBookingStartdate(), userEventBookedItemList.geteDate(), userEventBookedItemList.getPackagename(), userEventBookedItemList.getTotalAmt(), userEventBookedItemList.getDisAmt(), userEventBookedItemList.getFinalAmt());
		});

		holder.tv_cancel.setOnClickListener(v -> {
			//int pos=position;


			detailsDilaogg(mData.get(position).getBatchSlotLists(),userEventBookedItemList.getEventcancelCharge(),userEventBookedItemList.getEventConveniencetax(),userEventBookedItemList.getEventCancelRefundAmnt(),userEventBookedItemList.getEventCancelresion(), userEventBookedItemList.getBooking_type(), userEventBookedItemList.getBokingFor(), userEventBookedItemList.getBookingID(), userEventBookedItemList.getBookingOn(), userEventBookedItemList.getSportIcon(), userEventBookedItemList.getSportFolderName(), userEventBookedItemList.getSportName(), userEventBookedItemList.getBatchSlotSTime(), userEventBookedItemList.getBatchSlotETime(), userEventBookedItemList.getBookingStartdate(), userEventBookedItemList.geteDate(), userEventBookedItemList.getPackagename(), userEventBookedItemList.getTotalAmt(), userEventBookedItemList.getDisAmt(), userEventBookedItemList.getFinalAmt());

		});


		if (userEventBookedItemList.getRating().equals("No")) {
			holder.tv_review.setVisibility(View.GONE);
		} else {
			holder.tv_review.setVisibility(View.VISIBLE);
		}


		holder.tv_review.setOnClickListener(v -> {
			reviewDialog(userEventBookedItemList.getFacId(), userEventBookedItemList.getBookingID());
		});


		holder.rv_type.setTag(userEventBookedItemList.getDwnloadReceipt());
		holder.rv_type.setOnClickListener(v -> {
			if (!userEventBookedItemList.getDwnloadReceipt().isEmpty()) {

				String path = userEventBookedItemList.getDwnloadReceipt();


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


       /*if(formattedDate.compareTo(sDate) > 0){
       	holder.tv_review.setVisibility(View.GONE);
	   }else{
		   holder.tv_review.setVisibility(View.VISIBLE);
	   }*/


		holder.itemView.setOnClickListener(v -> {

			/*if(capitizeString(userEventBookedItemList.getBokingFor()).equalsIgnoreCase("Facility")){
				Intent intent = new Intent(context, FacilityDetailActivity.class);
				intent.putExtra("bundleUserFac",userEventBookedItemList);
				intent.putExtra("TYPE",capitizeString(userEventBookedItemList.getBokingFor()));
				intent.putExtra("FROM","2");
				intent.putExtra("SPORTNAME",userEventBookedItemList.getSportName());
				intent.putExtra("SPORTID",userEventBookedItemList.getSportId());
				context.startActivity(intent);
			}else if(capitizeString(userEventBookedItemList.getBokingFor()).equalsIgnoreCase("Academy")){
				Intent intent = new Intent(context, AcademyDetailActivity.class);
				intent.putExtra("bundleUserFac",userEventBookedItemList);
				intent.putExtra("TYPE",capitizeString(userEventBookedItemList.getBokingFor()));
				intent.putExtra("FROM","2");
				intent.putExtra("SPORTNAME",userEventBookedItemList.getSportName());
				intent.putExtra("SPORTID",userEventBookedItemList.getSportId());
				context.startActivity(intent);
			}*/

		});

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


	public String currentDate() {
		Date c = Calendar.getInstance().getTime();

		SimpleDateFormat df = new SimpleDateFormat("dd MMM yyyy");
		formattedDate = df.format(c.getTime());

		Log.d("date", formattedDate + "/" + sDate);
		return formattedDate;
	}

	/*public String getCurrentTime(){
		DateFormat df = new SimpleDateFormat("hh:mm a");
		cTime = df.format(Calendar.getInstance().getTime());

		Log.d("timee",cTime+"/"+sTime);

		return cTime;
	}*/

	private boolean validate() {
		boolean isOk = true;

		if (Float.parseFloat(rating_size) == 0) {
			Toaster.customToast("Please add rating!");
			isOk = false;
		}

		return isOk;
	}


	private class DownloadFile extends AsyncTask<String, Void, Void> {

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			progressDialog = new ProgressDialog(context);
			progressDialog.setMessage("Downloading...");
			progressDialog.setCancelable(false);
			progressDialog.show();
		}

		@Override
		protected Void doInBackground(String... strings) {
			String fileUrl = strings[0];   // -> http://maven.apache.org/maven-1.x/maven.pdf
			String fileName = strings[1];

			Log.d("url", fileUrl + "////" + fileName);
			// -> maven.pdf
			String extStorageDirectory = Environment.getExternalStorageDirectory().toString();
			File folder = new File(extStorageDirectory, "SocialSports");
			folder.mkdir();

			File pdfFile = new File(folder, fileName);

			try {
				pdfFile.createNewFile();
			} catch (IOException e) {
				e.printStackTrace();
			}
			FileDownloader.downloadFile(fileUrl, pdfFile);
			return null;
		}

		@Override
		protected void onPostExecute(Void aVoid) {
			super.onPostExecute(aVoid);

			progressDialog.dismiss();
			//ContextThemeWrapper ctw = new ContextThemeWrapper();
			final AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(context);
			alertDialogBuilder.setTitle("Document  ");
			alertDialogBuilder.setMessage("Document Downloaded Successfully ");
			alertDialogBuilder.setCancelable(false);
			alertDialogBuilder.setPositiveButton("Cancel", new DialogInterface.OnClickListener() {
				public void onClick(DialogInterface dialog, int id) {


				}
			});


			alertDialogBuilder.setNegativeButton("Open receipt", new DialogInterface.OnClickListener() {
				public void onClick(DialogInterface dialog, int id) {
					File pdfFile = new File(Environment.getExternalStorageDirectory() + "/SocialSports/" + "socialsport.pdf");  // -> filename = maven.pdf

					Uri path = Uri.fromFile(pdfFile);


					/*Uri apkURI = FileProvider.getUriForFile(
						context,
						context.getApplicationContext()
							.getPackageName() + ".provider", pdfFile);
					Intent pdfIntent = new Intent(Intent.ACTION_VIEW);
					pdfIntent.setDataAndType(apkURI, "application/pdf");
					pdfIntent.addFlags(Intent.FLAG_GRANT_READ_URI_PERMISSION);
					pdfIntent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);*//*
					Intent pdfIntent=new Intent(context, DownloadWebviewActivity.class);
					pdfIntent.putExtra("URL",path);*/

					//Uri path = Uri.fromFile(pdfFile);


					Uri apkURI = FileProvider.getUriForFile(
						context,
						context.getApplicationContext()
							.getPackageName() + ".provider", pdfFile);
					Intent pdfIntent = new Intent(Intent.ACTION_VIEW);
					pdfIntent.setDataAndType(apkURI, "application/pdf");
					pdfIntent.addFlags(Intent.FLAG_GRANT_READ_URI_PERMISSION);
					pdfIntent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
					try {
						context.startActivity(pdfIntent);
					} catch (ActivityNotFoundException e) {
						Toast.makeText(context, "No Application available to view PDF", Toast.LENGTH_SHORT).show();
					}
				}
			});
			alertDialogBuilder.show();


		}
	}


	private void reviewDialog(String facId, String orderId) {
		// dialog
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_review);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
		RatingBar rating_bar_review = dialog.findViewById(R.id.rating_bar_review);
		rating_bar_review.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
			public void onRatingChanged(RatingBar ratingBar, float rating,
										boolean fromUser) {

				rating_size = String.valueOf(rating);
			}
		});
		TextView tv_sport_name = dialog.findViewById(R.id.tv_sport_name);
		//tv_sport_name.setText(sport_name);
		editText1 = dialog.findViewById(R.id.et_message);
		dialog.findViewById(R.id.btn_submit).setOnClickListener(view -> {
			rating_size = String.valueOf(rating_bar_review.getRating());

			if (validate()) {
				setEnquiry(rating_size, Utils.getProperText(editText1), facId, orderId);
			}


		});
		dialog.show();
	}

	private void detailsDilaog(String concenienceFee,String convTaxfee,CopyOnWriteArrayList<BatchSlotList> batchSlotLists, String boookingFor, String bookingId, String transDate, String bookingMode, String img, String folder, String sportName, String slotSTime, String slotETime, String slotDate, String eDate, String packagename, String totalAmnt, String discountAmt, String paidAmt) {
		// dialog
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_details);
		RecyclerView rv_details = dialog.findViewById(R.id.rv_details);
		TextView tv_feesatx=dialog.findViewById(R.id.tv_feesatx);
		TextView tv_conveniencetax=dialog.findViewById(R.id.tv_conveniencetax);
		TextView tv_conveniensfee=dialog.findViewById(R.id.tv_conveniensfee);
		tv_conveniensfee.setText(concenienceFee);
		tv_conveniencetax.setText(convTaxfee);
		tv_feesatx.setText("GST On Convenience Fee("+"18"+"%"+"): ");

		LinearLayoutManager mLayoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		rv_details.setLayoutManager(mLayoutManager);
		rv_details.addItemDecoration(new SpaceItemDecoration(10));
		rv_details.setVerticalScrollBarEnabled(true);
		BatchSlotListAdapter batchSlotListAdapter = new BatchSlotListAdapter(context, batchSlotLists, boookingFor);

		rv_details.setAdapter(batchSlotListAdapter);






		View v1 = dialog.findViewById(R.id.v1);
		v1.setLayerType(View.LAYER_TYPE_SOFTWARE, null);

		View v2 = dialog.findViewById(R.id.v2);
		v2.setLayerType(View.LAYER_TYPE_SOFTWARE, null);
		/*LinearLayout ll_plan=dialog.findViewById(R.id.ll_plan);
		TextView tv_plan=dialog.findViewById(R.id.tv_plan);
		LinearLayout main=dialog.findViewById(R.id.main);
		TextView tv_slote_date = dialog.findViewById(R.id.tv_slote_date);*/

		TextView textBookingId = dialog.findViewById(R.id.tv_booking_order);
		textBookingId.setText(bookingId);

		TextView tv_transationDate = dialog.findViewById(R.id.tv_transationDate);
		tv_transationDate.setText(convertUTCDateToLocalDate(transDate));

		TextView tv_booking_mode = dialog.findViewById(R.id.tv_booking_mode);
		tv_booking_mode.setText(capitizeString(bookingMode));

		ImageView imgg = dialog.findViewById(R.id.imgg);
		if (!img.isEmpty()) {
			String imgPath = kImageBaseUrl + folder + "/" + img;
			Picasso.with(context).load(imgPath).placeholder(R.drawable.cricket).fit().into(imgg);
		} else {
			Picasso.with(context).load(R.drawable.cricket).placeholder(R.drawable.cricket).fit().into(imgg);
		}


		TextView tv_sport_namee = dialog.findViewById(R.id.tv_sport_namee);
		tv_sport_namee.setText(sportName);

		/*TextView tv_slot_time = dialog.findViewById(R.id.tv_slot_time);
		tv_slot_time.setText(getReminingTime(slotSTime) + "-" + getReminingTime(slotETime));*/


		//TextView tv_price = dialog.findViewById(R.id.tv_price);


		TextView tv_total_amnt = dialog.findViewById(R.id.tv_total_amnt);
		tv_total_amnt.setText(totalAmnt);

		TextView tv_coupanDiscount = dialog.findViewById(R.id.tv_coupanDiscount);

		if (discountAmt.isEmpty()) {
			tv_coupanDiscount.setText("0");
		} else {
			tv_coupanDiscount.setText(discountAmt);
		}


		TextView tv_paid_amnt = dialog.findViewById(R.id.tv_paid_amnt);
		tv_paid_amnt.setText(paidAmt);


		/*if(bookinFor.equalsIgnoreCase("facility")){
			main.setWeightSum(3);
			ll_plan.setVisibility(View.GONE);
			tv_slote_date.setText(convertDate(slotDate));
			tv_price.setText(context.getString(R.string.Rs) + " " + totalAmnt);
		}else{
			main.setWeightSum(4);
			ll_plan.setVisibility(View.VISIBLE);
			tv_slote_date.setText(convertDate(slotDate)+" - "+convertDate(eDate));
			tv_plan.setText(packagename);
			tv_price.setText(context.getString(R.string.Rs) + " " + totalAmnt);
		}*/


		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

		dialog.show();
	}


	private void getBookingCancelreguest(String bookingFor,String bookingId,String cancelCharge,String tax,String refundAmnt,String resion,String selectAll,JSONArray batchSlotIds) {
		//String bookingId,String cancelCharge,String tax,String refundAmnt,String resion

		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kBookingId,bookingId);
		map.put(kEventCancelCharge,cancelCharge);
		map.put(kconveniensTexes,tax);
		map.put(kEventCancelRefundAmnt,refundAmnt);
		map.put(kEventCancelReason,resion);
		map.put(kSelectAll,selectAll);
		map.put(kUserBatchSlotIds,batchSlotIds);



		Log.e("sendcarat", map.toString());

		ModelManager.modelManager().userBookingBatchSlotCancel(map, (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
			loaderView.hideLoader();
			try {
				String msg = genericResponse.getObject();
				//Toaster.customToast(msg);
				dialog.dismiss();
				CongratsDialogg(bookingFor,msg);

				//Log.e(TAG,"msg: " +msg);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});


	}

	private void detailsDilaogg(CopyOnWriteArrayList<BatchSlotList> batchSlotLists,String cancelCharge,String tax,String refundAmnt,String resion, String bookingType, String boookingFor, String bookingIdd, String transDate, String bookingMode, String folder, String sportName, String slotSTime, String slotETime, String slotDate, String eDate, String packagename, String totalAmnt, String discountAmt, String paidAmt) {
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
		EditText editText=dialog.findViewById(R.id.et_message);
		TextView tv_submit=dialog.findViewById(R.id.tv_submit);


		TextView tv_batchSlot_time=dialog.findViewById(R.id.tv_batchSlot_time);


		if(boookingFor.equalsIgnoreCase("facility")){
			tv_batchSlot_time.setText("Slot Time");
		}else{
			tv_batchSlot_time.setText("Batch Time");
		}

		if (Integer.parseInt(discountAmt) > 0) {
			tv_coupan_amt.setVisibility(View.VISIBLE);
			tv_coupan_amt.setText(discountAmt);
		} else {
			tv_coupan_amt.setText("0");
			tv_coupan_amt.setVisibility(View.VISIBLE);
		}
		TextView tv_total_refund_amnt = dialog.findViewById(R.id.tv_total_refund_amnt);

		TextView tv_offline_msg = dialog.findViewById(R.id.tv_offline_msg);
		RelativeLayout rl_online_msg = dialog.findViewById(R.id.rl_online_msg);

		CheckBox cb_main = dialog.findViewById(R.id.cb_main);
		if (bookingType.equalsIgnoreCase("Offline")) {
			tv_offline_msg.setVisibility(View.VISIBLE);
			rl_online_msg.setVisibility(View.GONE);
			rv_details.setVisibility(View.GONE);
		} else {
			tv_offline_msg.setVisibility(View.GONE);
			rl_online_msg.setVisibility(View.VISIBLE);
			rv_details.setVisibility(View.VISIBLE);
			View v1 = dialog.findViewById(R.id.v3);
			v1.setLayerType(View.LAYER_TYPE_SOFTWARE, null);

			batchSlotListAdapter = new BatchSlotListcancelAdapter(context, batchSlotLists, cb_main, boookingFor, ll_cancel_total_msg,
				OneStartDay, OneEndday, OneCharge, twoStartDay, twoEndday, twoCharge, threeStartDay, threeEndDay, threeCharge, new BatchSlotListcancelAdapter.itemClikListner() {
				@Override
			public void itemAdd(ArrayList<Integer> integers, ArrayList<String> totalAmt, ArrayList<String> totalCancellist, ArrayList<String> totalRefundAmtList, JSONArray batchslotid) {
				total_amnt_list_item = 0;
				total_cancel_list_item = 0;
				total_refund_list_item = 0;


				Log.d("integre", integers.size() + "");

					batchSlotids=batchslotid;

				if(batchslotid.length()==batchSlotLists.size()){
					SelectAll="yes";
				}else{
					SelectAll="no";
				}


				for (int i = 0; i < totalAmt.size(); i++) {
					total_amnt_list_item += Integer.parseInt(totalAmt.get(i));
					tv_total_amnt.setText(String.valueOf(total_amnt_list_item));

				}

				for (int i = 0; i < totalCancellist.size(); i++) {

					total_cancel_list_item += Integer.parseInt(totalCancellist.get(i));
					tv_total_cancelletion_charge_amnt.setText(String.valueOf(total_cancel_list_item));

				}

				for (int i = 0; i < totalRefundAmtList.size(); i++) {

					total_refund_list_item += Integer.parseInt(totalRefundAmtList.get(i));


				}


				total_refund_amount = total_refund_list_item - Integer.parseInt(discountAmt);

				if (total_refund_amount < Integer.parseInt(discountAmt)) {
					total_refund_amount = 0;
					tv_total_refund_amnt.setText(String.valueOf(total_refund_amount));
				} else {
					tv_total_refund_amnt.setText(String.valueOf(total_refund_amount));
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

			Log.d("Tax",tax);
			rv_details.setAdapter(batchSlotListAdapter);

		}

		tv_submit.setOnClickListener(v->{
			//dialog.dismiss();
			if(editText.getText().toString().equalsIgnoreCase("")){
				Toaster.customToast("Please Enter reason for cancellation");
			}else if(batchSlotListAdapter.getSportsSelectionStatus()){
				Toaster.customToast("Please Select Slot/Batch for Cancel");
			}else{
				getBookingCancelreguest(boookingFor,bookingIdd,String.valueOf(total_cancel_list_item), tax,String.valueOf(total_refund_amount),editText.getText().toString(),SelectAll,batchSlotids);
				//bookingIdd,String.valueOf(printCancelofTotal), tax,String.valueOf(printRefundCancel),editText.getText().toString()
			}

		});


		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

		dialog.show();
		//}
	}

	private void setEnquiry(String subject, String messagee, String facId, String orderId) {
		dialog.dismiss();
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kRating, subject);
		map.put(kratingMsg, messagee);
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kBookingId, orderId);
		map.put(kFacId, facId);

		Log.e("map", "reviews..: " + map.toString());
		ModelManager.modelManager().userInsertReview(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				try {
					loaderView.hideLoader();
					String msg = genericResponse.getObject();

					CongratsDialog(msg);
				} catch (Exception e) {
					e.printStackTrace();
				}
				loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}

	private void CongratsDialog(String user) {
		final Dialog dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_congrats_screen_cancel);
		dialog.setCancelable(false);
		TextView tv_msg = dialog.findViewById(R.id.tv_msg);
		tv_msg.setText(context.getResources().getString(R.string.thanks_descc));
		dialog.findViewById(R.id.btn_continue).setOnClickListener(v -> {
			dialog.dismiss();


			Intent intent = new Intent(context, MyReviewsActivity.class);
			context.startActivity(intent);

			//mRefreshListner.refreshView();


		});

		dialog.show();
	}


	private void CongratsDialogg(String bookingFor,String user) {
		final Dialog dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_congrats_screen_cancel);
		dialog.setCancelable(false);
		TextView tv_msg = dialog.findViewById(R.id.tv_msg);

		if(bookingFor.equalsIgnoreCase("facility")){
			tv_msg.setText(user);
		}else {
			tv_msg.setText(user);
		}


		dialog.findViewById(R.id.btn_continue).setOnClickListener(v -> {
			dialog.dismiss();
			//mRefreshListner.refreshView();
			onitemclick.refresh();

		});

		dialog.show();
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


	public String convertUTCDateToLocalDate(String date_string) {
		if (date_string.isEmpty()) {
			return "";
		}

		SimpleDateFormat oldFormatter = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		//oldFormatter.setTimeZone(TimeZone.getTimeZone("UTC"));
		Date value = null;
		String dueDateAsNormal = "";
		try {
			value = oldFormatter.parse(date_string);
			SimpleDateFormat newFormatter = new SimpleDateFormat("dd MMM yyyy (hh:mm a)");

			newFormatter.setTimeZone(TimeZone.getDefault());
			dueDateAsNormal = newFormatter.format(value);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		Log.d("date", dueDateAsNormal);

		return dueDateAsNormal;
	}


	public String convertUTCDateToLocalDatee(String date_string) {
		if (date_string.isEmpty()) {
			return "";
		}

		SimpleDateFormat oldFormatter = new SimpleDateFormat("yyyy-MM-dd");
		//oldFormatter.setTimeZone(TimeZone.getTimeZone("UTC"));
		Date value = null;
		String dueDateAsNormal = "";
		try {
			value = oldFormatter.parse(date_string);
			SimpleDateFormat newFormatter = new SimpleDateFormat("dd MMM yyyy");

			newFormatter.setTimeZone(TimeZone.getDefault());
			dueDateAsNormal = newFormatter.format(value);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		Log.d("date", dueDateAsNormal);

		return dueDateAsNormal;
	}


	private String capitizeString(String name) {
		String captilizedString = "";
		if (!name.trim().equals("")) {
			captilizedString = name.substring(0, 1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
	}

	@Override
	public int getItemCount() {
		return mData.size();
	}

	public void addData(CopyOnWriteArrayList<FacilityAcademyBookListItem> list) {
		mData.addAll(list);
		notifyDataSetChanged();
	}

	public void newData(CopyOnWriteArrayList<FacilityAcademyBookListItem> list) {
		mData.clear();
		mData.addAll(list);
		notifyDataSetChanged();
	}


	class MyViewHolder extends RecyclerView.ViewHolder {
		Bookings model;
		ImageView iv_banner, img;
		TextView id, name, address, sport,tv_cancel_status, tv_cancel, tv_order_date, tv_ePlan, tv_review, tv_bookid, tv_pstatus, tv_ostatus, tv_sDate_fac, tv_sTime_f, tv_eTime_f, tv_sDate, tv_eDate, tv_sTime, tv_eTime;
		RelativeLayout rv_type, rl_slot;
		LinearLayout ll_bookingId, rl_batch;
		RecyclerView rvBookList;

		private MyViewHolder(View itemView) {
			super(itemView);
			id = itemView.findViewById(R.id.tv_booking_order);
			name = itemView.findViewById(R.id.tv_field);
			address = itemView.findViewById(R.id.tv_address);
			sport = itemView.findViewById(R.id.tv_sport);
			iv_banner = itemView.findViewById(R.id.iv_banner);
			tv_order_date = itemView.findViewById(R.id.tv_order_date);
			rv_type = itemView.findViewById(R.id.rv_type);
			tv_review = itemView.findViewById(R.id.tv_review);
			ll_bookingId = itemView.findViewById(R.id.ll_bookingId);
			tv_bookid = itemView.findViewById(R.id.tv_bookid);
			//img = itemView.findViewById(R.id.img);
			tv_ostatus = itemView.findViewById(R.id.tv_ostatus);
			tv_pstatus = itemView.findViewById(R.id.tv_pstatus);
			rl_batch = itemView.findViewById(R.id.rl_batch);
			rl_slot = itemView.findViewById(R.id.rl_slot);
			tv_sDate_fac = itemView.findViewById(R.id.tv_sDate_fac);
			tv_sTime_f = itemView.findViewById(R.id.tv_sTime_f);
			tv_eTime_f = itemView.findViewById(R.id.tv_eTime_f);
			//tv_sDate = itemView.findViewById(R.id.tv_sDate);
			//tv_eDate = itemView.findViewById(R.id.tv_eDate);
			//tv_sTime = itemView.findViewById(R.id.tv_sTime);
			//tv_eTime = itemView.findViewById(R.id.tv_eTime);
			//tv_ePlan = itemView.findViewById(R.id.tv_ePlan);
			tv_cancel = itemView.findViewById(R.id.tv_cancel);
			tv_cancel_status=itemView.findViewById(R.id.tv_cancel_status);
			rvBookList=itemView.findViewById(R.id.rv_booking_list);

		}

       /* private Bookings BindData(Bookings model) {
            this.model = model;
            return model;
        }*/
	}


	class BookingListAdapter extends RecyclerView.Adapter<BookingListAdapter.myViewHolder> {

		Context context;
		CopyOnWriteArrayList<BatchSlotList> mData;
		FacilityAcademyBookListItem model;
		ArrayList<String>cancel_status;
		ArrayList<Long>date_list;
		String folderName;
		long DiffDays;
		int dayDiff;

		BookingListAdapter(Context context, FacilityAcademyBookListItem booking, CopyOnWriteArrayList<BatchSlotList> data,String folderName) {
			this.context = context;
			this.mData = data;
			this.model = booking;
			this.folderName=folderName;
		}

		@NonNull
		@Override
		public BookingListAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
			View view = LayoutInflater.from(context).inflate(R.layout.rowuser_booking_fields_layout, parent, false);
			return new BookingListAdapter.myViewHolder(view);
		}

		@Override
		public void onBindViewHolder(@NonNull final BookingListAdapter.myViewHolder holder, int pos) {
			BatchSlotList modal = mData.get(pos);
			cancel_status=new ArrayList<>();
			date_list=new ArrayList<>();
			holder.tvSportName.setText(modal.getSport_name());
			String path = kImageBaseUrl+folderName+"/"+modal.getSport_icon();
			Picasso.with(context).load(path).placeholder(R.drawable.football_image).into(holder.ivSport);
			DiffDays=Daybetween(convertDate(modal.getStart_date()),currentDate(),"dd MMM yyyy");
			holder.tvSportDate.setText(convertUTCDateToLocalDatee(modal.getStart_date()));
			String time = getReminingTime(modal.getBatch_slot_start_time())+ " to "+getReminingTime(modal.getBatch_slot_end_time());
			holder.tvSportTime.setText(time);
			if(!modal.getPackage_name().isEmpty()){
				holder.tvBatchType.setVisibility(View.VISIBLE);
				holder.tvBatchType.setText(modal.getPackage_name());
			}else{
				holder.ll_sport.setGravity(Gravity.CENTER);
			}




			if(modal.getBs_cancel_status().equalsIgnoreCase("yes") || DiffDays <= 0){

				if(modal.getBs_cancel_on().equals("")){
					holder.div.setVisibility(View.GONE);
					holder.tv_cancel_status.setVisibility(View.GONE);

				}else{
					holder.div.setVisibility(View.VISIBLE);
					holder.tv_cancel_status.setVisibility(View.VISIBLE);
					holder.tv_cancel_status.setText("Cancelled"+"("+convertUTCDateToLocalDateeCancel(modal.getBs_cancel_on())+")");
				}



			}else{
				holder.div.setVisibility(View.GONE);
				holder.tv_cancel_status.setVisibility(View.GONE);


			}
		}

		@Override
		public int getItemCount() {
			return mData.size();
		}

		class myViewHolder extends RecyclerView.ViewHolder {
			ImageView ivSport;
			TextView tvSportName,tvBatchType,tv_cancel_status,tvSportDate, tvSportTime;
			View div;
			LinearLayout ll_sport;

			private myViewHolder(View itemView) {
				super(itemView);
				ivSport = itemView.findViewById(R.id.iv_sport);
				tvSportName = itemView.findViewById(R.id.recycler_booking_tv_sports);
				tvSportDate = itemView.findViewById(R.id.recycler_booking_tv_date);
				tvSportTime = itemView.findViewById(R.id.recycler_booking_tv_time);
				tvBatchType = itemView.findViewById(R.id.recycler_booking_tv_batch);
				div=itemView.findViewById(R.id.div_view);
				tv_cancel_status=itemView.findViewById(R.id.tv_cancel_status);
				ll_sport=itemView.findViewById(R.id.ll_sport);
			}
		}

	}

}
