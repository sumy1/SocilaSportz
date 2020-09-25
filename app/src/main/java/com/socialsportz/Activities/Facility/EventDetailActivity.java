package com.socialsportz.Activities.Facility;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Events;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.Utils;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.PopupMenu;

import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventDetailActivity extends AppCompatActivity implements View.OnClickListener{

    private Events events;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_event_details);
        TextView title=findViewById(R.id.tv_title_toolbar);
        title.setText(R.string.event_details);

        events = (Events)getIntent().getSerializableExtra(kData);
        findViewById(R.id.back_btn).setOnClickListener(view -> finish());

        TextView tvName = findViewById(R.id.tv_event_name);
        assert events != null;
        tvName.setText(events.getEventName());

        TextView tvStatus = findViewById(R.id.tv_status);
        tvStatus.setText(capitizeString(events.getStatus()));

        ImageView imageView=findViewById(R.id.iv_banner);
        String path = kImageBaseUrl + events.getFacFolder()+ "/"+events.getBanner();
        Picasso.with(this).load(path).placeholder(R.drawable.running_event).fit().into(imageView);

        TextView stEnrollDate = findViewById(R.id.tv_st_enroll_date);
        stEnrollDate.setText(Utils.changeDateNew(events.getEnrollStart()));

        TextView edEnrollDate = findViewById(R.id.tv_ed_enroll_date);
        edEnrollDate.setText(Utils.changeDateNew(events.getEnrollEnd()));

        TextView startDate = findViewById(R.id.tv_start_date);
        startDate.setText(Utils.changeDateNew(events.getSdate()));

        TextView endDate = findViewById(R.id.tv_end_date);
        endDate.setText(Utils.changeDateNew(events.getEdate()));

        TextView startTime = findViewById(R.id.tv_start_time);
        startTime.setText(events.getStime());

        TextView endTime = findViewById(R.id.tv_end_time);
        endTime.setText(events.getEtime());

        TextView sport = findViewById(R.id.tv_sport);
        CopyOnWriteArrayList<Sport> sports = ModelManager.modelManager().getCurrentUser().getSports();
        for(int i=0;i<sports.size();i++){
            if(sports.get(i).getSportId()==events.getSportId()){
                sport.setText(sports.get(i).getSportName());
                break;
            }
        }

        TextView maxBooking = findViewById(R.id.tv_max_booking);
        maxBooking.setText(String.valueOf(events.getParticipants()));

        TextView venue = findViewById(R.id.tv_venue);
        venue.setText(events.getVenue());

        TextView fees = findViewById(R.id.tv_fees);
        fees.setText(getResources().getString(R.string.Rs)+" "+events.getPrice());

        findViewById(R.id.bt_edit).setOnClickListener(this);
    }


	private String capitizeString(String name) {
		String captilizedString = "";
		if (!name.trim().equals("")) {
			captilizedString = name.substring(0, 1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
	}
    @Override
    public void onClick(View v) {
        if(v.getId()== R.id.bt_edit){
            showPopupMenu(v,events);
        }
    }

    private void showPopupMenu(View view, Events events){
        //creating a popup menu
        PopupMenu popup = new PopupMenu(EventDetailActivity.this, view);
        //inflating menu from xml resource
        popup.inflate(R.menu.option_data);
        //adding click listener
        popup.setOnMenuItemClickListener(item -> {
            switch (item.getItemId()) {
                case R.id.action_edit:
                    //handle menu1 click


                    Intent returnIntent = new Intent();
                    returnIntent.putExtra(kData,events);
                    setResult(Activity.RESULT_OK,returnIntent);
                    finish();
                    break;
            }
            return false;
        });
        //displaying the popup
        popup.show();
    }
}
