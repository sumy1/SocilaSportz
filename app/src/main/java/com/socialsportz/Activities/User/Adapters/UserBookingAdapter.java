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
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.Models.User.UserEventBookedItemList;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.FileDownloader;
import com.socialsportz.Utils.Toaster;

import org.json.JSONObject;

import java.io.File;
import java.io.IOException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
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
import static com.socialsportz.Constants.Constants.kconveniensTexes;

public class UserBookingAdapter extends RecyclerView.Adapter<UserBookingAdapter.MyViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<UserEventBookedItemList> mData;
    private int pageSize;
	Dialog dialog;
	String rating_size,formattedDate="";
	CustomLoaderView loaderView;
	long DiffDays;
	int dayDiff;
	int  printRefundCancel,printCancelofTotal ;
	boolean isCbChecked;
	private ProgressDialog progressDialog;
	onitemclick onitemclick;
	String OneStartDay = "", OneEndday = "", OneCharge = "", twoStartDay = "", twoEndday = "", twoCharge = "", threeStartDay = "", threeEndDay = "", threeCharge = "";
    public UserBookingAdapter(Context context, CopyOnWriteArrayList<UserEventBookedItemList> data,onitemclick onitemclick) {

        this.context = context;
        this.mData = data;
        this.onitemclick=onitemclick;

		getUserCancellationCharge();

		Log.d("allConcentvalue",OneStartDay +"/"+ OneEndday +"/"+OneCharge +"/"+twoStartDay+"/"+twoEndday+"/"+ twoCharge +"/"+ threeStartDay+"/"+ threeEndDay+"/"+threeCharge);
        //this.pageSize = mData.size();

		loaderView = CustomLoaderView.initialize(context);
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

					Log.d("Cancellation1","OneSDay"+".."+OneStartDay+".."+"OneDayEnd"+".."+
						OneEndday+".."+"OneCharge"+".."+OneCharge+".."+"TwoSday"+".."+twoStartDay+".."+
						"twoEndDay"+".."+twoEndday+".."+"twoCharge"+".."+twoCharge+".."+
						"threeSDay"+".."+threeStartDay+".."+"ThreeEndday"+".."+threeEndDay+".."+
						"threeCharge"+".."+threeCharge);

					//printConvesnies=

				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));


	}


    @NonNull
    @Override
    public UserBookingAdapter.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context)
                .inflate(R.layout.row_view_user_batch_slot_booking, parent, false);
        return new MyViewHolder(layoutView);
    }


    @Override
    public void onBindViewHolder(@NonNull UserBookingAdapter.MyViewHolder holder, int position) {

        UserEventBookedItemList userEventBookedItemList=mData.get(position);
		DiffDays=Daybetween(convertDate(mData.get(position).getBookingStartdate()),currentDate(),"dd MMM yyyy");


		Log.d("Eventdate",DiffDays+"");
        if(!userEventBookedItemList.getEventBanner().isEmpty()){
            String imgPath = kImageBaseUrl+userEventBookedItemList.getFoldername()+"/"+userEventBookedItemList.getEventBanner();
            Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(holder.iv_banner);
        }else{
            Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(holder.iv_banner);
        }

		if(!userEventBookedItemList.getSportIcon().isEmpty()){
			String imgPath = kImageBaseUrl+userEventBookedItemList.getSportFolderName()+"/"+userEventBookedItemList.getSportIcon();
			Picasso.with(context).load(imgPath).placeholder(R.drawable.cricket).fit().into(holder.img);
		}else{
			Picasso.with(context).load(R.drawable.cricket).placeholder(R.drawable.cricket).fit().into(holder.img);
		}


		holder.tv_sDate.setText(convertUTCDateToLocalDatee(userEventBookedItemList.getBookingStartdate()));
		holder.tv_eDate.setText(convertUTCDateToLocalDatee(userEventBookedItemList.getEventendDate()));
		holder.tv_sTime.setText(getReminingTime(userEventBookedItemList.getBatchSlotSTime()));
		holder.tv_eTime.setText(getReminingTime(userEventBookedItemList.getBatchSlotETime()));



		if(userEventBookedItemList.getBookingStatus().equalsIgnoreCase("confirm")){

			holder.tv_ostatus.setText(capitizeString(userEventBookedItemList.getBookingStatus()));
			holder.tv_ostatus.setTextColor(context.getResources().getColor(R.color.green_drak));
		}else{
			holder.tv_ostatus.setText(capitizeString(userEventBookedItemList.getBookingStatus()));
			holder.tv_ostatus.setTextColor(context.getResources().getColor(R.color.white));
		}

		if(userEventBookedItemList.getPaymentStatus().equalsIgnoreCase("success")){

			holder.tv_pstatus.setText(capitizeString(userEventBookedItemList.getPaymentStatus()));
			holder.tv_pstatus.setTextColor(context.getResources().getColor(R.color.green_drak));
		}else{
			holder.tv_pstatus.setText(capitizeString(userEventBookedItemList.getPaymentStatus()));
			holder.tv_pstatus.setTextColor(context.getResources().getColor(R.color.white));
		}

        holder.id.setText(userEventBookedItemList.getBookedOrdeNo());

        if(userEventBookedItemList.getEventgoogleAddes().isEmpty()){

		}else{
			holder.address.setText(userEventBookedItemList.getEventgoogleAddes());
		}

        holder.name.setText(userEventBookedItemList.getEventVenue());
        holder.sport.setText(userEventBookedItemList.getSportName());
		holder.tv_order_date.setText(convertUTCDateToLocalDate(userEventBookedItemList.getBookingOn()));


		holder.ll_bookingId.setOnClickListener(v->{detailsDilaog(userEventBookedItemList.getEventCancelRegStatus(),userEventBookedItemList.getEventcancelDate(),userEventBookedItemList.getEventConveniencefee(),userEventBookedItemList.getEventConveniencetax(),userEventBookedItemList.getBookedOrdeNo(),userEventBookedItemList.getBookingOn(),userEventBookedItemList.getBooking_type(),userEventBookedItemList.getSportIcon(),userEventBookedItemList.getSportFolderName(),userEventBookedItemList.getSportName(),userEventBookedItemList.getBatchSlotSTime(),userEventBookedItemList.getBatchSlotETime(),userEventBookedItemList.getBookingStartdate(),userEventBookedItemList.getEventendDate(),userEventBookedItemList.getTotalAmt(),userEventBookedItemList.getDisAmt(),userEventBookedItemList.getFinalAmt());});


		if(userEventBookedItemList.getEventCancelRegStatus().equalsIgnoreCase("no_cancel")&& DiffDays > 0){
			holder.tv_cancel.setVisibility(View.VISIBLE);
			holder.tv_cancel_status.setVisibility(View.GONE);
		}else{
			holder.tv_cancel.setVisibility(View.GONE);
			if(DiffDays<=0){
				holder.tv_cancel_status.setVisibility(View.GONE);
				//holder.tv_cancel_status.setText("Cancelled");
			}else{
				holder.tv_cancel_status.setVisibility(View.VISIBLE);
				holder.tv_cancel_status.setText("Cancelled"+"("+convertUTCDateToLocalDateeCancel(userEventBookedItemList.getEventcancelDate())+")");
			}




		}


		holder.tv_cancel.setOnClickListener(v->{int pos=position;
			detailsDilaogg(userEventBookedItemList.getBookingID(),userEventBookedItemList.getEventcancelCharge(),userEventBookedItemList.getEventConveniencetax(),userEventBookedItemList.getEventCancelRefundAmnt(),userEventBookedItemList.getEventCancelresion(),userEventBookedItemList.getBookedOrdeNo(),userEventBookedItemList.getBookingOn(),userEventBookedItemList.getBooking_type(),userEventBookedItemList.getSportIcon(),userEventBookedItemList.getSportFolderName(),userEventBookedItemList.getSportName(),userEventBookedItemList.getBatchSlotSTime(),userEventBookedItemList.getBatchSlotETime(),userEventBookedItemList.getBookingStartdate(),userEventBookedItemList.getEventendDate(),userEventBookedItemList.getTotalAmt(),userEventBookedItemList.getDisAmt(),userEventBookedItemList.getFinalAmt(),OneCharge,twoCharge,threeCharge);});


		holder.rv_type.setOnClickListener(v->{

			if(!userEventBookedItemList.getDownloadReceipt().isEmpty()){


				String path=userEventBookedItemList.getDownloadReceipt();
				Intent intent = new Intent(Intent.ACTION_VIEW,Uri.parse(path));
				intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
				intent.setPackage("com.android.chrome");
				try {
					context.startActivity(intent);
				} catch (ActivityNotFoundException ex) {
					// Chrome browser presumably not installed so allow user to choose instead
					intent.setPackage(null);
					context.startActivity(intent);
				}

				Log.d("path",path);
				//new DownloadFile().execute(userEventBookedItemList.getDownloadReceipt(), "socialsport.pdf");
			}else{


				//new DownloadTask(context,"");
			}





		});


	/*	holder.tv_review.setOnClickListener(v->{
			//ratingId=model.

			reviewDialog(userEventBookedItemList.getFacId(),userEventBookedItemList.getBookingID());
		});*/


		holder.itemView.setOnClickListener(v->{
			/*Intent intent = new Intent(new Intent(context, EventDetailActivity.class));
			intent.putExtra("bundleUserFac",userEventBookedItemList);
			intent.putExtra("TYPE","Event");
			intent.putExtra("FROM","3");
			context.startActivity(intent);*/
		});

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
			String fileName = strings[1];  // -> maven.pdf
			String extStorageDirectory = Environment.getExternalStorageDirectory().toString();
			File folder = new File(extStorageDirectory, "SocialSports");
			folder.mkdir();

			File pdfFile = new File(folder, fileName);

			try{
				pdfFile.createNewFile();
			}catch (IOException e){
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


			alertDialogBuilder.setNegativeButton("Open receipt",new DialogInterface.OnClickListener() {
				public void onClick(DialogInterface dialog, int id) {
					File pdfFile = new File(Environment.getExternalStorageDirectory() + "/SocialSports/" + "socialsport.pdf");  // -> filename = maven.pdf
					Uri path = Uri.fromFile(pdfFile);
					Uri apkURI = FileProvider.getUriForFile(
						context,
						context.getApplicationContext()
							.getPackageName() + ".provider", pdfFile);
					Intent pdfIntent = new Intent(Intent.ACTION_VIEW);
					pdfIntent.setDataAndType(apkURI, "application/pdf");
					pdfIntent.addFlags(Intent.FLAG_GRANT_READ_URI_PERMISSION);
					pdfIntent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP|Intent.FLAG_ACTIVITY_NEW_TASK);

					try{
						context.startActivity(pdfIntent);
					}catch(ActivityNotFoundException e){
						Toast.makeText(context, "No Application available to view PDF", Toast.LENGTH_SHORT).show();
					}
				}
			});
			alertDialogBuilder.show();



		}
	}

	/*private void reviewDialog(String facId,String orderId) {
		// dialog
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_review);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
		RatingBar rating_bar_review=dialog.findViewById(R.id.rating_bar_review);
		rating_bar_review.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
			public void onRatingChanged(RatingBar ratingBar, float rating,
										boolean fromUser) {

				rating_size= String.valueOf(rating);
			}
		});
		TextView tv_sport_name=dialog.findViewById(R.id.tv_sport_name);
		//tv_sport_name.setText(sport_name);
		EditText editText1 = dialog.findViewById(R.id.et_message);
		dialog.findViewById(R.id.btn_submit).setOnClickListener(view -> {
			rating_size= String.valueOf(rating_bar_review.getRating());
			setEnquiry(rating_size, Utils.getProperText(editText1),facId,orderId);

		});
		dialog.show();
	}*/

	private String capitizeString(String name){
		String captilizedString="";
		if(!name.trim().equals("")){
			captilizedString = name.substring(0,1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
	}

	private void detailsDilaog(String cancelSttaus,String eventCancelDtae,String convenienceFee,String convenienceTax,String bookingId,String transDate,String bookingMode,String img,String folder,String sportName,String slotSTime,String slotETime,String slotDate,String edate,String totalAmnt,String discountAmt,String paidAmt) {
		// dialog
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_details_event);


		View v1=dialog.findViewById(R.id.v1);
		v1.setLayerType(View.LAYER_TYPE_SOFTWARE, null);

		View v2=dialog.findViewById(R.id.v2);
		v2.setLayerType(View.LAYER_TYPE_SOFTWARE, null);

		TextView  textBookingId=dialog.findViewById(R.id.tv_booking_order);
		textBookingId.setText(bookingId);

		TextView tv_transationDate=dialog.findViewById(R.id.tv_transationDate);
		tv_transationDate.setText(convertUTCDateToLocalDate(transDate));

		TextView tv_booking_mode=dialog.findViewById(R.id.tv_booking_mode);
		tv_booking_mode.setText(capitizeString(bookingMode));


		/*TextView tv_slotN=dialog.findViewById(R.id.tv_slotN);
		tv_slotN.setText("Event");*/

		ImageView imgg=dialog.findViewById(R.id.imgg);
		if(!img.isEmpty()){
			String imgPath = kImageBaseUrl+folder+"/"+img;
			Picasso.with(context).load(imgPath).placeholder(R.drawable.cricket).fit().into(imgg);
		}else{
			Picasso.with(context).load(R.drawable.cricket).placeholder(R.drawable.cricket).fit().into(imgg);
		}


		TextView tv_sport_namee=dialog.findViewById(R.id.tv_sport_namee);
		tv_sport_namee.setText(sportName);

		TextView tv_slot_time=dialog.findViewById(R.id.tv_slot_time);
		tv_slot_time.setText(getReminingTime(slotSTime)+"-"+ getReminingTime(slotETime));

		TextView tv_slote_date=dialog.findViewById(R.id.tv_slote_date);
		tv_slote_date.setText(convertDate(slotDate)+"-"+convertDate(edate));

		TextView tv_price=dialog.findViewById(R.id.tv_price);
		tv_price.setText(context.getString(R.string.Rs)+" "+totalAmnt);

		TextView tv_total_amnt=dialog.findViewById(R.id.tv_total_amnt);
		tv_total_amnt.setText(context.getString(R.string.Rs)+" "+totalAmnt);

		TextView tv_coupanDiscount=dialog.findViewById(R.id.tv_coupanDiscount);

		if(discountAmt.isEmpty()){
			tv_coupanDiscount.setText("(-)" +context.getString(R.string.Rss)+" "+"0");
		}else{
			tv_coupanDiscount.setText("(-)" +context.getString(R.string.Rs)+" "+discountAmt);
		}

		TextView tv_conveniensfee=dialog.findViewById(R.id.tv_conveniensfee);

		tv_conveniensfee.setText("(+)" +context.getString(R.string.Rs)+" "+convenienceFee);

		TextView tv_conveniencetax=dialog.findViewById(R.id.tv_conveniencetax);
		tv_conveniencetax.setText("(+)" +context.getString(R.string.Rs)+" "+convenienceTax);

		TextView tv_cancel_status=dialog.findViewById(R.id.tv_cancel_status);
		if(cancelSttaus.equalsIgnoreCase("no_cancel")){
			tv_cancel_status.setVisibility(View.GONE);
		}else{
			tv_cancel_status.setVisibility(View.VISIBLE);

			tv_cancel_status.setText("Cancelled"+"("+convertUTCDateToLocalDateeCancel(eventCancelDtae)+")");


		}

		TextView tv_paid_amnt=dialog.findViewById(R.id.tv_paid_amnt);
		tv_paid_amnt.setText(context.getString(R.string.Rs)+" "+paidAmt);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

		dialog.show();
	}

	public String currentDate(){
		Date c = Calendar.getInstance().getTime();

		SimpleDateFormat df = new SimpleDateFormat("dd MMM yyyy");
		formattedDate = df.format(c.getTime());

		Log.d("date",formattedDate);
		return formattedDate;
	}
	private void detailsDilaogg(String bookingIdd,String cancelCharge,String tax,String refundAmnt,String resion,String bookingId,String transDate,String bookingMode,String img,String folder,String sportName,String slotSTime,String slotETime,String slotDate,String edate,String totalAmnt,String discountAmt,String paidAmt,String OneCharge,String twoCharge,String threeCharge) {
		// dialogString bookingId,String transDate,String bookingMode,String img,String folder,String sportName,String slotSTime,String slotETime,String slotDate,String edate,String totalAmnt,String discountAmt,String paidAmt
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.cancel_dialog_event);


		TextView tv_offline_msg=dialog.findViewById(R.id.tv_offline_msg);
		RelativeLayout rl_online_msg=dialog.findViewById(R.id.rl_online_msg);
		EditText editText=dialog.findViewById(R.id.et_message);
		TextView tv_submit=dialog.findViewById(R.id.tv_submit);

		if(bookingMode.equalsIgnoreCase("Offline")){
			tv_offline_msg.setVisibility(View.VISIBLE);
			rl_online_msg.setVisibility(View.GONE);
		}else{
			tv_offline_msg.setVisibility(View.GONE);
			rl_online_msg.setVisibility(View.VISIBLE);
			View v2 = dialog.findViewById(R.id.v3);
			v2.setLayerType(View.LAYER_TYPE_SOFTWARE, null);

			View v4 = dialog.findViewById(R.id.v4);
			v4.setLayerType(View.LAYER_TYPE_SOFTWARE, null);

            TextView tv_event_cancel_charge_amnt=dialog.findViewById(R.id.tv_event_cancel_charge_amnt);
            TextView tv_slot_refund_amnt=dialog.findViewById(R.id.tv_slot_refund_amnt);
            TextView tv_total_cancelletion_charge_amnt=dialog.findViewById(R.id.tv_total_cancelletion_charge_amnt);
            TextView tv_total_amnt=dialog.findViewById(R.id.tv_total_amnt);
            TextView tv_total_refund_amnt=dialog.findViewById(R.id.tv_total_refund_amnt);
			LinearLayout ll_disamnt=dialog.findViewById(R.id.ll_disamnt);
			TextView tv_coupan_amt=dialog.findViewById(R.id.tv_coupan_amt);


			if(discountAmt.equalsIgnoreCase("0")){

			}else{
				ll_disamnt.setVisibility(View.VISIBLE);

			}

			CheckBox cb=dialog.findViewById(R.id.cb);
			LinearLayout ll_cancel_msg=dialog.findViewById(R.id.ll_cancel_msg);
			LinearLayout ll_cancel_total_msg=dialog.findViewById(R.id.ll_cancel_total_msg);
			DiffDays=Daybetween(convertDate(slotDate),currentDate(),"dd MMM yyyy");
			Log.d("StartDate",convertDate(slotDate)+"/"+".."+currentDate()+"/"+DiffDays);




			cb.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
				@Override
				public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {

					if(isChecked){
						isCbChecked=true;
						ll_cancel_msg.setVisibility(View.GONE);
						ll_cancel_total_msg.setVisibility(View.VISIBLE);


						dayDiff=(int)DiffDays;
						if(dayDiff>=Integer.parseInt(OneStartDay) && dayDiff<=Integer.parseInt(OneEndday) && dayDiff>0){

							Log.d("Total",totalAmnt+"/"+OneCharge);

							if(OneCharge.equalsIgnoreCase("")){

							}else{
								printCancelofTotal = (int) Math.floor(((Integer.parseInt(totalAmnt)) * Integer.parseInt(OneCharge))/100); // gives 2

								tv_event_cancel_charge_amnt.setText("(-)"+context.getString(R.string.Rs)+" "+printCancelofTotal);
								printRefundCancel=Integer.parseInt(totalAmnt)-printCancelofTotal;
								tv_slot_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);
								tv_total_amnt.setText(context.getString(R.string.Rs)+" "+totalAmnt);
								tv_total_cancelletion_charge_amnt.setText("(-)"+context.getString(R.string.Rs)+" "+printCancelofTotal);
								tv_coupan_amt.setText(context.getString(R.string.Rs)+" "+discountAmt);

								if(Integer.parseInt(discountAmt)>0){
									printRefundCancel=printRefundCancel-Integer.parseInt(discountAmt);

									tv_total_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);


								}else{
									tv_total_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);
								}


								Log.d("cancelcharge",printCancelofTotal+"/"+printRefundCancel);
							}




						}else if(dayDiff>=Integer.parseInt(twoStartDay) && dayDiff<=Integer.parseInt(twoEndday)){

							if(twoCharge.equalsIgnoreCase("")){

							}else{
								Log.d("Total",totalAmnt+"/"+twoCharge);
								printCancelofTotal = (int) Math.floor(((Integer.parseInt(totalAmnt)) * Integer.parseInt(twoCharge))/100); // gives 2

								tv_event_cancel_charge_amnt.setText("(-)"+context.getString(R.string.Rs)+" "+printCancelofTotal);
								printRefundCancel=Integer.parseInt(totalAmnt)-printCancelofTotal;
								tv_slot_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);
								tv_total_amnt.setText(context.getString(R.string.Rs)+" "+totalAmnt);
								tv_total_cancelletion_charge_amnt.setText("(-)"+context.getString(R.string.Rs)+" "+printCancelofTotal);
								tv_total_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);
								Log.d("cancelcharge",printCancelofTotal+"/"+printRefundCancel);

								tv_coupan_amt.setText(context.getString(R.string.Rs)+" "+discountAmt);

								if(Integer.parseInt(discountAmt)>0){
									printRefundCancel=printRefundCancel-Integer.parseInt(discountAmt);

									tv_total_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);


								}else{
									tv_total_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);
								}
							}



						}else if(dayDiff>=Integer.parseInt(threeStartDay)){

							if(threeCharge.equalsIgnoreCase("")){

							}else{
								Log.d("Total",totalAmnt+"/"+threeCharge);
								printCancelofTotal = (int) Math.floor(((Integer.parseInt(totalAmnt)) * Integer.parseInt(threeCharge))/100); // gives 2

								tv_event_cancel_charge_amnt.setText("(-)"+context.getString(R.string.Rs)+" "+printCancelofTotal);
								printRefundCancel=Integer.parseInt(totalAmnt)-printCancelofTotal;
								tv_slot_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);
								tv_total_amnt.setText(context.getString(R.string.Rs)+" "+totalAmnt);
								tv_total_cancelletion_charge_amnt.setText("(-)"+context.getString(R.string.Rs)+" "+printCancelofTotal);
								tv_total_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);

								tv_coupan_amt.setText(context.getString(R.string.Rs)+" "+discountAmt);

								if(Integer.parseInt(discountAmt)>0){
									printRefundCancel=printRefundCancel-Integer.parseInt(discountAmt);

									tv_total_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);


								}else{
									tv_total_refund_amnt.setText(context.getString(R.string.Rs)+" "+printRefundCancel);
								}
								Log.d("cancelcharge",printCancelofTotal+"/"+printRefundCancel);
							}


						}


						//...code here...


					}else{
						isCbChecked=false;
						ll_cancel_msg.setVisibility(View.GONE);
						ll_cancel_total_msg.setVisibility(View.GONE);
					}
				}
			});


			TextView tv_slot_time=dialog.findViewById(R.id.tv_slot_time);
			tv_slot_time.setText(getReminingTime(slotSTime)+"-"+ getReminingTime(slotETime));

			TextView tv_slote_date=dialog.findViewById(R.id.tv_slote_date);
			tv_slote_date.setText(convertDate(slotDate)+"-"+convertDate(edate));

			TextView tv_price=dialog.findViewById(R.id.tv_price);
			tv_price.setText(context.getString(R.string.Rs)+" "+totalAmnt);


			tv_submit.setOnClickListener(v->{
               dialog.dismiss();
				if(editText.getText().toString().equalsIgnoreCase("")){
					Toaster.customToast("Please Enter reason for cancellation");
				}else if(isCbChecked==false){
					Toaster.customToast("Please Select Event for Cancel");
				}else{
					getBookingCancelreguest(bookingIdd,String.valueOf(printCancelofTotal), tax,String.valueOf(printRefundCancel),editText.getText().toString());

				}

			});

		}






		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

		dialog.show();
	}


	private void getBookingCancelreguest(String bookingId,String cancelCharge,String tax,String refundAmnt,String resion) {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
        map.put(kBookingId,bookingId);
        map.put(kEventCancelCharge,cancelCharge);
        map.put(kconveniensTexes,tax);
        map.put(kEventCancelRefundAmnt,refundAmnt);
        map.put(kEventCancelReason,resion);


		Log.e("sendcarat", map.toString());

		ModelManager.modelManager().userBookingEventCancel(map, (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
			loaderView.hideLoader();
			try {
				String msg = genericResponse.getObject();
				//Toaster.customToast(msg);
				CongratsDialog(msg);

				//Log.e(TAG,"msg: " +msg);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});


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
	/*private void setEnquiry(String subject,String messagee,String facId,String orderId){
		dialog.dismiss();
		loaderView.showLoader();
		HashMap<String,Object> map = new HashMap<>();
		map.put(kRating,subject);
		map.put(kratingMsg, messagee);
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kBookingId, orderId);
		map.put(kFacId, facId);

		Log.e("map","reviews..: "+ map.toString());
		ModelManager.modelManager().userInsertReview(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				try {
					loaderView.hideLoader();
					String msg = genericResponse.getObject();
					CongratsDialog(msg);
				} catch (Exception e){
					e.printStackTrace();
				}
				loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}*/

	private void CongratsDialog(String user){
		final Dialog dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_congrats_screen_cancel);
		dialog.setCancelable(false);
		TextView tv_msg=dialog.findViewById(R.id.tv_msg);
		tv_msg.setText(user);
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


	public String convertUTCDateToLocalDate(String date_string) {
		if (date_string.isEmpty()){
			return "";
		}

		SimpleDateFormat oldFormatter = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		//oldFormatter.setTimeZone(TimeZone.getTimeZone("UTC"));
		Date value = null;
		String dueDateAsNormal ="";
		try {
			value = oldFormatter.parse(date_string);
			SimpleDateFormat newFormatter = new SimpleDateFormat("dd MMM yyyy (hh:mm a)");

			newFormatter.setTimeZone(TimeZone.getDefault());
			dueDateAsNormal = newFormatter.format(value);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		Log.d("date",dueDateAsNormal);

		return dueDateAsNormal;
	}
    @Override
    public int getItemCount() {
        return mData.size();
    }

    public void addData(CopyOnWriteArrayList<UserEventBookedItemList> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<UserEventBookedItemList> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class MyViewHolder extends RecyclerView.ViewHolder {
        Bookings model;
        ImageView iv_banner,img;
        TextView id,name, address,sport,tv_cancel_status,tv_cancel, status,tv_order_date,tv_review,tv_bookid,tv_pstatus,tv_ostatus,tv_sDate, tv_eDate, tv_sTime, tv_eTime;
		RelativeLayout rv_type;
		LinearLayout ll_bookingId,ll_status;
        private MyViewHolder(View itemView) {
            super(itemView);
            id = itemView.findViewById(R.id.tv_booking_order);
            name = itemView.findViewById(R.id.tv_field);
            address = itemView.findViewById(R.id.tv_address);
            sport = itemView.findViewById(R.id.tv_sport);
            iv_banner=itemView.findViewById(R.id.iv_banner);
            tv_order_date=itemView.findViewById(R.id.tv_order_date);
			rv_type=itemView.findViewById(R.id.rv_type);
			//tv_review=itemView.findViewById(R.id.tv_review);
			img=itemView.findViewById(R.id.img);
			ll_bookingId=itemView.findViewById(R.id.ll_bookingId);
			tv_bookid=itemView.findViewById(R.id.tv_bookid);
			tv_ostatus=itemView.findViewById(R.id.tv_ostatus);
			tv_pstatus=itemView.findViewById(R.id.tv_pstatus);

			tv_sDate = itemView.findViewById(R.id.tv_sDate);
			tv_eDate = itemView.findViewById(R.id.tv_eDate);
			tv_sTime = itemView.findViewById(R.id.tv_sTime);
			tv_eTime = itemView.findViewById(R.id.tv_eTime);
			tv_cancel=itemView.findViewById(R.id.tv_cancel);
			tv_cancel_status=itemView.findViewById(R.id.tv_cancel_status);

        }

       /* private Bookings BindData(Bookings model) {
            this.model = model;
            return model;
        }*/
    }

    public interface onitemclick{
		void refresh();
	}

}
