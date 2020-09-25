package com.socialsportz.Activities.User.Adapters;

import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.User.Activities.EventDetailActivity;
import com.socialsportz.Activities.User.Activities.UserCalenderCheckoutActivity;
import com.socialsportz.Models.User.EventListing;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventSeeAllAdapter extends RecyclerView.Adapter<EventSeeAllAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<EventListing> userReviewsData;
    private boolean isCheck;
    String enrollEnddate="",datee="";
	private CustomLoaderView loaderView;
	Dialog dialog;

    public EventSeeAllAdapter(Context context, CopyOnWriteArrayList<EventListing> userReviewsData) {
        this.context = context;
        this.userReviewsData = userReviewsData;
		loaderView = CustomLoaderView.initialize(context);
    }

    @NonNull
    @Override
    public EventSeeAllAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_view_user_event_search, parent, false);
        return new EventSeeAllAdapter.myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull EventSeeAllAdapter.myViewHolder holder, int position) {
        EventListing model = userReviewsData.get(position);

        if(!model.getBanner().isEmpty()){
			String imgPath = kImageBaseUrl+model.getFacFolder()+"/"+model.getBanner();
			Picasso.with(context).load(imgPath).placeholder(R.drawable.running_event).fit().into(holder.iv_banner);
		}else{
			Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(holder.iv_banner);
		}

		holder.tv_time.setText(getReminingTime(model.getStime())+"-"+getReminingTime(model.getEtime()));
        holder.tv_date.setText(convertUTCDateToLocalDate(model.getSdate())+" To "+convertUTCDateToLocalDate(model.getEdate()));

        holder.tv_field.setText(model.getEventName());
        holder.tv_price.setText(model.getPrice());
        holder.tv_venue.setText(model.getVenue());

		enrollEnddate=model.getEnrollEnd();
		datee=model.getEnrollStart();
        holder.ll_explore.setOnClickListener(v->{
			Intent intent = new Intent(new Intent(context, EventDetailActivity.class));
			intent.putExtra("bundleUserFac",model);
			intent.putExtra("TYPE","Event");
			intent.putExtra("FROM","3");
			context.startActivity(intent);
		});



		if(model.getBooked()<Integer.parseInt(model.getParticipants()) || datee.compareTo(enrollEnddate) > 0){
			Log.d("print","da");
			holder.end_layout.setVisibility(View.VISIBLE);

		}else{
			Log.d("da1","da");
			holder.end_layout.setVisibility(View.GONE);
		}

		holder.end_layout.setOnClickListener(v->{

			Intent intent=new Intent(context, UserCalenderCheckoutActivity.class);
			intent.setFlags( Intent.FLAG_ACTIVITY_CLEAR_TASK |Intent.FLAG_ACTIVITY_CLEAR_TOP);
			intent.putExtra("TYPE","Event");
			intent.putExtra("SportId",model.getSportId());
			intent.putExtra("FROM","1");
			intent.putExtra("EVENTID",model.getEventId());
			context.startActivity(intent);


			//getBookingreguest(model.getEventId(),model.getSportId(),model.getPrice(),model.getFacName());

		});

    }

	/*private void getBookingreguest(String event_id,String sport_id,String total_amount,String facType) {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kEventId, event_id);
		map.put(kSportId, sport_id);
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kBookingTotal, total_amount);
		map.put(kFacType, "Event");
		map.put(kPaymentStatus,"Success");
		map.put(kBookingStatus,"Confirm");

		Log.e("sendcarat", map.toString());

		ModelManager.modelManager().userBooking(map,(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
			loaderView.hideLoader();
			try {
				String msg = genericResponse.getObject();
				Toaster.customToast(msg);

				Intent intent=new Intent(context,UserDashboardActivity.class);
				intent.setFlags( Intent.FLAG_ACTIVITY_CLEAR_TASK |Intent.FLAG_ACTIVITY_CLEAR_TOP);
				intent.putExtra("FRAG","2");
				intent.putExtra("Value","1");
				context.startActivity(intent);
				((Activity)context).finish();


				//Log.e(TAG,"msg: " +msg);
			} catch (Exception e){
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});


	}*/

	public String convertUTCDateToLocalDate(String date_string) {
		if (date_string.isEmpty()){
			return "";
		}

		SimpleDateFormat oldFormatter = new SimpleDateFormat("yyyy-MM-dd");
		//oldFormatter.setTimeZone(TimeZone.getTimeZone("UTC"));
		Date value = null;
		String dueDateAsNormal ="";
		try {
			value = oldFormatter.parse(date_string);

			Calendar cal= Calendar.getInstance();


			SimpleDateFormat newFormatter = new SimpleDateFormat("dd MMM");
			//String month_name = newFormatter.format(cal.getTime());
			newFormatter.setTimeZone(TimeZone.getDefault());
			dueDateAsNormal = newFormatter.format(value);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		Log.d("date",dueDateAsNormal);

		return dueDateAsNormal;
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

    @Override
    public int getItemCount() {
        return userReviewsData.size();
    }

    public void addData(CopyOnWriteArrayList<EventListing> list) {
        userReviewsData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<EventListing> list){
        userReviewsData.clear();
        userReviewsData.addAll(list);
        notifyDataSetChanged();
    }


	class myViewHolder extends RecyclerView.ViewHolder {
		TextView tv_field, tv_venue,tv_date,tv_price,tv_book,tv_time;
		ImageView iv_banner;
		LinearLayout ll_explore,end_layout;
		public myViewHolder(@NonNull View itemView) {
			super(itemView);
			tv_field = itemView.findViewById(R.id.tv_field);
			tv_venue = itemView.findViewById(R.id.tv_venue);
			tv_date=itemView.findViewById(R.id.tv_date);
			tv_price=itemView.findViewById(R.id.tv_price);
			tv_book=itemView.findViewById(R.id.tv_book);
			tv_time=itemView.findViewById(R.id.tv_time);
			iv_banner=itemView.findViewById(R.id.iv_banner);
			ll_explore=itemView.findViewById(R.id.ll_explore);
			end_layout=itemView.findViewById(R.id.end_layout);

		}
	}
}
