package com.socialsportz.Activities.Facility.Adapters;

import android.content.ActivityNotFoundException;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Handler;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.Facility.EventBookingDetailActivity;
import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.Models.Owner.EventBookingDetails;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLinearLayoutManager;
import com.socialsportz.Utils.Utils;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventBookingAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<Bookings> mData;
    private int pageSize;

    public EventBookingAdapter(Context context, CopyOnWriteArrayList<Bookings> data) {
        this.context = context;
        this.mData = data;
        this.pageSize = mData.size();
    }

    @Override
    public int getItemViewType(int position) {
        if (position == mData.size()) {
            return 0;
        } else {
            return 1;
        }
    }

    @NonNull
    @Override
    public RecyclerView.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        if (viewType == 1) {
            View layoutView = LayoutInflater.from(context)
                    .inflate(R.layout.row_event_booking_ticket_view, parent, false);
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
            if(mData.isEmpty()|| mData.size()<8){
                view.progressBar.setVisibility(View.GONE);
            }
            else if (mData.size() >= pageSize) {
                view.progressBar.setVisibility(View.VISIBLE);
                new Handler().postDelayed(() -> {
                    //Hide the refresh after 2sec
                    ((FacilityDashboardActivity) context).runOnUiThread(
                            () -> view.progressBar.setVisibility(View.GONE));
                }, 2000);
            }

        } else {
            MyViewHolder myViewHolder = (MyViewHolder) holder;
            final Bookings model = myViewHolder.BindData(mData.get(position));
            //myViewHolder.ivSport.setImageResource(R.drawable.man);
            myViewHolder.id.setText(model.getBooking_order());
            myViewHolder.name.setText(model.getName());
            myViewHolder.mail.setText(model.getMail());
            myViewHolder.contact.setText(model.getMobile());
            myViewHolder.type.setText(model.getType());
            //myViewHolder.academy.setText(mData.get(i).getAcademy());
            String value = model.getStatus();
            if(value.equals(Constants.BookingStatus.confirm.toString())){
                myViewHolder.status.setTextColor(context.getResources().getColor(R.color.green));
                myViewHolder.status.setText(context.getResources().getString(R.string.payment_done));
            }else if(value.equals(Constants.BookingStatus.pending.toString())){
                myViewHolder.status.setTextColor(context.getResources().getColor(R.color.red));
                myViewHolder.status.setText(context.getResources().getString(R.string.payment_pending));
            }

            CopyOnWriteArrayList<EventBookingDetails> list = new CopyOnWriteArrayList<>();
            list.add(model.getEventBookingDetails());

            Log.d("CancelOn",model.getEventcancelDate()+"/"+model.getEventCancelRegStatus());

            CustomLinearLayoutManager layoutManager = new CustomLinearLayoutManager(context,RecyclerView.VERTICAL,false);
            BookingListAdapter bookingListAdapter = new BookingListAdapter(context,model.getEventCancelRegStatus(),model.getEventcancelDate(),model,list);
            myViewHolder.rvBookList.setLayoutManager(layoutManager);
            myViewHolder.rvBookList.setAdapter(bookingListAdapter);

            myViewHolder.itemView.setOnClickListener(view -> {
                Intent in = new Intent(context, EventBookingDetailActivity.class);
                in.putExtra(kData,model);
                context.startActivity(in);
            });



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


    @Override
    public int getItemCount() {
        return mData.size()+1;
    }

    public void addData(CopyOnWriteArrayList<Bookings> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<Bookings> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }


    class MyViewHolder extends RecyclerView.ViewHolder {
        Bookings model;
        TextView id,name, mail, contact, status,type;
        RecyclerView rvBookList;
		RelativeLayout rv_type;
        MyViewHolder(View itemView) {
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
            rvBookList=itemView.findViewById(R.id.rv_booking_list);

        }

        private Bookings BindData(Bookings model) {
            this.model = model;
            return model;
        }
    }

    public class ProgressHolder extends RecyclerView.ViewHolder {

        ProgressBar progressBar;

        ProgressHolder(View itemView) {
            super(itemView);
            progressBar = itemView.findViewById(R.id.progress_bar);
        }
    }

    class BookingListAdapter extends RecyclerView.Adapter<BookingListAdapter.myViewHolder> {

        Context context;
        CopyOnWriteArrayList<EventBookingDetails> mData;
        CopyOnWriteArrayList<Sport> sports;
        Bookings model;
        String cancel_status,cancen_on;

        BookingListAdapter(Context context,String cancel_status,String cancen_on, Bookings booking, CopyOnWriteArrayList<EventBookingDetails> data) {
            this.context = context;
			this.cancel_status=cancel_status;
			this.cancen_on=cancen_on;
            this.mData = data;
            this.model = booking;
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            this.sports = user.getSports();
        }

        @NonNull
        @Override
        public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
            View view = LayoutInflater.from(context).inflate(R.layout.row_event_booking_fields_layout, parent, false);
            return new myViewHolder(view);
        }

        @Override
        public void onBindViewHolder(@NonNull final myViewHolder holder, int pos) {
            EventBookingDetails modal = mData.get(pos);
            for(int i=0;i<sports.size();i++){
                if(sports.get(i).getSportId()==modal.getSportId()){
                    holder.tvSportName.setText(sports.get(i).getSportName());
                    String path = kImageBaseUrl+sports.get(i).getFolderName()+"/"+sports.get(i).getSportImg();
                    Picasso.with(context).load(path).placeholder(R.drawable.football_image).into(holder.ivSport);
                    break;
                }
            }
            holder.tvEventName.setText(modal.getEventName());
            holder.tvSportDate.setText(Utils.changeDateNew(modal.getStartDate()));
            String time = modal.getStartTime()+ " to "+modal.getEndTime();
            holder.tvSportTime.setText(time);
            holder.itemView.setOnClickListener(v->{
                Intent in = new Intent(context, EventBookingDetailActivity.class);
                in.putExtra(kData,model);
                context.startActivity(in);
            });
            if (pos==getItemCount()-1){
                holder.div.setVisibility(View.GONE);
            }

			if(cancel_status.equalsIgnoreCase("fully_cancel")){
				//holder.div.setVisibility(View.VISIBLE);
				if(cancel_status.equals("")){
					///holder.div.setVisibility(View.GONE);
					holder.tv_cancel_status.setVisibility(View.GONE);

				}else{
					//holder.div.setVisibility(View.VISIBLE);
					holder.tv_cancel_status.setVisibility(View.VISIBLE);

					holder.tv_cancel_status.setText("Cancelled"+"("+convertUTCDateToLocalDateeCancel(cancen_on)+")");
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
            TextView tvEventName,tvSportName, tvSportDate, tvSportTime,tv_cancel_status;
            View div;

            private myViewHolder(View itemView) {
                super(itemView);
                ivSport = itemView.findViewById(R.id.iv_sport);
                tvEventName = itemView.findViewById(R.id.recycler_booking_tv_event);
                tvSportName = itemView.findViewById(R.id.recycler_booking_tv_sports);
                tvSportDate = itemView.findViewById(R.id.recycler_booking_tv_date);
                tvSportTime = itemView.findViewById(R.id.recycler_booking_tv_time);
                div=itemView.findViewById(R.id.div_view);
				tv_cancel_status=itemView.findViewById(R.id.tv_cancel_status);

            }
        }

    }
}
