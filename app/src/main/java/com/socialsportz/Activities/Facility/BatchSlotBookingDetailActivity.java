package com.socialsportz.Activities.Facility;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
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
import com.socialsportz.Models.Owner.SlotBookingDetails;
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

public class BatchSlotBookingDetailActivity extends AppCompatActivity {

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking_details);
        Bookings booking = (Bookings) getIntent().getSerializableExtra(kData);
        //String category=getIntent().getStringExtra("Type");
        assert booking != null;

        TextView title=findViewById(R.id.tv_title_toolbar);
        title.setText(getString(R.string.booking_details));

        ImageView imageView=findViewById(R.id.booking_iv);
        final Transformation transformation = new MaskTransformation(this, R.drawable.canvas_bd_img_bg_ttwo_cr);
        Picasso.with(this).load(R.drawable.ground_img).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(imageView);

        TextView tvName = findViewById(R.id.tv_name);
        tvName.setText(booking.getName());

        TextView tvPhone = findViewById(R.id.tv_phone);
        tvPhone.setText(booking.getMobile());

        //TextView category_type=findViewById(R.id.category_type);

		//category_type.setText(booking.getBatch_slot_type_name());


//..new code..here..
        ImageView profile_iv=findViewById(R.id.profile_iv);

		Log.d("image",booking.getUser_profile_image()+booking.getMobile());

		if(!booking.getUser_profile_image().isEmpty()){
			String imgPath = kImageBaseUrl+booking.getFolder_names()+"/"+booking.getUser_profile_image();
			Picasso.with(this).load(imgPath).placeholder(R.drawable.man).fit().into(profile_iv);
		}else{
			Picasso.with(this).load(R.drawable.man).placeholder(R.drawable.man).fit().into(profile_iv);
		}


		ImageView booking_iv=findViewById(R.id.booking_iv);
		if(!booking.getFac_banner_image().isEmpty()){
			String imgPath = kImageBaseUrl+booking.getFacility_folder_name()+"/"+booking.getFac_banner_image();
			Picasso.with(this).load(imgPath).placeholder(R.drawable.ground_img).into(booking_iv);
		}else{
			Picasso.with(this).load(R.drawable.ground_img).placeholder(R.drawable.ground_img).into(booking_iv);
		}
		//Picasso.with(this).load(ModelManager.modelManager().getCurrentUser().getUserProfileImg()).placeholder(R.drawable.man).fit().into(profile_iv);

        TextView tvEmail = findViewById(R.id.tv_email);
        tvEmail.setText(booking.getMail());

        TextView tvAddress = findViewById(R.id.tv_address);
		///old..code..+"\n"+booking.getCity()+", "+booking.getState()+"\n"+booking.getCountry()
		String add = booking.getAddress();
		tvAddress.setText(add);

        TextView tvBookType = findViewById(R.id.tv_booking_type);

        tvBookType.setText(capitizeString(booking.getType()));

        TextView tvBookOrder = findViewById(R.id.tv_booking_order);
        tvBookOrder.setText(booking.getBooking_order());

        TextView tvBookAmount = findViewById(R.id.tv_amount);
        tvBookAmount.setText(booking.getFinal_amount());

        TextView tvBookTotal = findViewById(R.id.tv_total);
        tvBookTotal.setText(booking.getTotal_amount());

        //new code here..


	/*	TextView tvTransactionDate=findViewById(R.id.tv_booking_transitiondate);
		tvTransactionDate.setVisibility(View.GONE);
		tvTransactionDate.setText(booking.getDate());*/
		//..end..here


        RecyclerView bookingList=findViewById(R.id.rv_book_detail);
        LinearLayoutManager layoutManager = new LinearLayoutManager(getApplicationContext(), RecyclerView.VERTICAL,false);
        RowBookingDetailAdapter rowBookingDetailAdapter = new RowBookingDetailAdapter(getApplicationContext(), booking.getBookingListModels());
        bookingList.setLayoutManager(layoutManager);
        bookingList.addItemDecoration(new SpaceItemDecoration(30));
        bookingList.setAdapter(rowBookingDetailAdapter);
        bookingList.setNestedScrollingEnabled(false);

        findViewById(R.id.back_btn).setOnClickListener(view -> finish());
    }

	private String capitizeString(String name) {
		String captilizedString = "";
		if (!name.trim().equals("")) {
			captilizedString = name.substring(0, 1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
	}

    public class RowBookingDetailAdapter extends RecyclerView.Adapter<RowBookingDetailAdapter.myViewHolder> {

        private Context context;
        private List<SlotBookingDetails> mData;
        CopyOnWriteArrayList<Sport> sports;

        RowBookingDetailAdapter(Context context, List<SlotBookingDetails> mData) {
            this.context = context;
            this.mData = mData;
            CurrentUser user = ModelManager.modelManager().getCurrentUser();
            this.sports = user.getSports();
        }

        @NonNull
        @Override
        public RowBookingDetailAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
            View view = LayoutInflater.from(context).inflate(R.layout.row_view_slot_booking_details, viewGroup, false);
            return new myViewHolder(view);
        }

        @Override
        public void onBindViewHolder(@NonNull RowBookingDetailAdapter.myViewHolder myViewHolder, int pos) {
            for(int i=0;i<sports.size();i++){
                if(sports.get(i).getSportId()==mData.get(pos).getSportId()){
                    myViewHolder.tvSportName.setText(sports.get(i).getSportName());
                    break;
                }
            }
            if(mData.get(pos).getPackageId()!=0){
                String pac = mData.get(pos).getPackageName()+" Batch";
                myViewHolder.tvType.setText(pac);
            }else{
                String pac = mData.get(pos).getTypeName()+" Slot";
                myViewHolder.tvType.setText(pac);
            }
            myViewHolder.tvSportDate.setText(Utils.changeDateNew(mData.get(pos).getStartDate()));
            myViewHolder.tvSlotPrice.setText(mData.get(pos).getDetail_total_amount());
            String time = mData.get(pos).getStartTime()+ " - " +mData.get(pos).getEndTime();
            myViewHolder.tvSportTime.setText(time);
            myViewHolder.category_type.setText(mData.get(pos).getCategoryType());
        }

        @Override
        public int getItemCount() {
            return mData.size();
        }

        class myViewHolder extends RecyclerView.ViewHolder {
            TextView tvType,tvSportName,tvSportDate,tvSportTime,tvSlotPrice,category_type;
            private myViewHolder(View itemView) {
                super(itemView);
                tvType=itemView.findViewById(R.id.tv_type);
                tvSportName=itemView.findViewById(R.id.tv_sport);
                tvSportDate=itemView.findViewById(R.id.tv_sport_date);
                tvSportTime=itemView.findViewById(R.id.tv_sport_timing);
                tvSlotPrice=itemView.findViewById(R.id.tv_price);
				category_type=itemView.findViewById(R.id.category_type);
            }
        }
    }

}
