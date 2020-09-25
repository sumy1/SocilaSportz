package com.socialsportz.Activities.Facility;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.Models.Owner.EventBookingDetails;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Utils;

import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventBookingDetailActivity extends AppCompatActivity {

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_event_booking_details);
        Bookings booking = (Bookings) getIntent().getSerializableExtra(kData);
        assert booking != null;

        TextView title=findViewById(R.id.tv_title_toolbar);
        title.setText(getString(R.string.booking_details));

        ImageView imageView=findViewById(R.id.booking_iv);
        final Transformation transformation = new MaskTransformation(this, R.drawable.canvas_bd_img_bg_ttwo_cr);
        Picasso.with(this).load(R.drawable.ground_img).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(imageView);

        TextView tvName = findViewById(R.id.tv_name);
        tvName.setText(booking.getName());



		//..new code..here..
		ImageView profile_iv=findViewById(R.id.profile_iv);


		if(!booking.getUser_profile_image().isEmpty()){
			String imgPath = kImageBaseUrl+booking.getFolder_names()+"/"+booking.getUser_profile_image();
			Picasso.with(this).load(imgPath).placeholder(R.drawable.man).fit().into(profile_iv);
		}else{
			Picasso.with(this).load(R.drawable.man).placeholder(R.drawable.man).fit().into(profile_iv);
		}
		//Picasso.with(this).load(ModelManager.modelManager().getCurrentUser().getUserProfileImg()).placeholder(R.drawable.man).fit().into(profile_iv);


		ImageView booking_iv=findViewById(R.id.booking_iv);
		if(!booking.getFac_banner_image().isEmpty()){
			String imgPath = kImageBaseUrl+booking.getFacility_folder_name()+"/"+booking.getFac_banner_image();
			Picasso.with(this).load(imgPath).placeholder(R.drawable.ground_img).fit().into(booking_iv);
		}else{
			Picasso.with(this).load(R.drawable.ground_img).placeholder(R.drawable.ground_img).fit().into(booking_iv);
		}

        TextView tvPhone = findViewById(R.id.tv_phone);
        tvPhone.setText(booking.getMobile());

        TextView tvEmail = findViewById(R.id.tv_email);
        tvEmail.setText(booking.getMail());

        TextView tvAddress = findViewById(R.id.tv_address);

        ///old..code..+"\n"+booking.getCity()+", "+booking.getState()+"\n"+booking.getCountry()
        String add = booking.getAddress();
        tvAddress.setText(add);

        TextView tvBookOrder = findViewById(R.id.tv_booking_order);
        tvBookOrder.setText(booking.getBooking_order());

        TextView tvBookAmount = findViewById(R.id.tv_amount);
        tvBookAmount.setText(getResources().getString(R.string.Rs)+" "+booking.getFinal_amount());

        TextView tvBookTotal = findViewById(R.id.tv_total);
        tvBookTotal.setText(booking.getTotal_amount());

        RecyclerView bookingList=findViewById(R.id.rv_book_detail);
        CopyOnWriteArrayList<EventBookingDetails> list = new CopyOnWriteArrayList<>();
        list.add(booking.getEventBookingDetails());
        LinearLayoutManager layoutManager = new LinearLayoutManager(getApplicationContext(), RecyclerView.VERTICAL,false);
        RowBookingDetailAdapter rowBookingDetailAdapter = new RowBookingDetailAdapter(getApplicationContext(), list);
        bookingList.setLayoutManager(layoutManager);
        bookingList.addItemDecoration(new SpaceItemDecoration(30));
        bookingList.setAdapter(rowBookingDetailAdapter);
        bookingList.setNestedScrollingEnabled(false);

        findViewById(R.id.back_btn).setOnClickListener(view -> finish());
    }

    public class RowBookingDetailAdapter extends RecyclerView.Adapter<RowBookingDetailAdapter.myViewHolder> {

        private Context context;
        private List<EventBookingDetails> mData;
        CopyOnWriteArrayList<Sport> sports;

        RowBookingDetailAdapter(Context context, List<EventBookingDetails> mData) {
            this.context = context;
            this.mData = mData;
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            this.sports = user.getSports();
        }

        @NonNull
        @Override
        public RowBookingDetailAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
            View view = LayoutInflater.from(context).inflate(R.layout.row_view_event_booking_details, viewGroup, false);
            return new RowBookingDetailAdapter.myViewHolder(view);
        }

        @Override
        public void onBindViewHolder(@NonNull RowBookingDetailAdapter.myViewHolder myViewHolder, int pos) {
            for(int i=0;i<sports.size();i++){
                if(sports.get(i).getSportId()==mData.get(pos).getSportId()){
                    myViewHolder.tvSportName.setText(sports.get(i).getSportName());
                    break;
                }
            }
            myViewHolder.tvEventName.setText(mData.get(pos).getEventName());
            myViewHolder.tvEventVenue.setText("Noida Stadium, Noida");
            myViewHolder.tvSportDate.setText(Utils.changeDateNew(mData.get(pos).getStartDate()));
            myViewHolder.tvSlotPrice.setText(getResources().getString(R.string.Rs)+" "+mData.get(pos).getDetail_total_amount());
            String time = mData.get(pos).getStartTime()+ " - " +mData.get(pos).getEndTime();
            myViewHolder.tvSportTime.setText(time);
        }

        @Override
        public int getItemCount() {
            return mData.size();
        }

        class myViewHolder extends RecyclerView.ViewHolder {
            TextView tvEventName,tvEventVenue,tvSportName,tvSportDate,tvSportTime,tvSlotPrice;
            private myViewHolder(View itemView) {
                super(itemView);
                tvEventName=itemView.findViewById(R.id.tv_event_name);
                tvEventVenue=itemView.findViewById(R.id.tv_event_venue);
                tvSportName=itemView.findViewById(R.id.tv_sport);
                tvSportDate=itemView.findViewById(R.id.tv_sport_date);
                tvSportTime=itemView.findViewById(R.id.tv_sport_timing);
                tvSlotPrice=itemView.findViewById(R.id.tv_price);
            }
        }
    }
}
