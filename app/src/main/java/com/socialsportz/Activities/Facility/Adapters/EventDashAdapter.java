package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.Owner.Events;
import com.socialsportz.R;
import com.socialsportz.Utils.Utils;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class EventDashAdapter extends RecyclerView.Adapter<EventDashAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<Events> mData;
    private onItemClickListener listener;

    public EventDashAdapter(Context context, CopyOnWriteArrayList<Events> mData, onItemClickListener listener) {
        this.context = context;
        this.mData = mData;
        this.listener = listener;
    }

    @NonNull
    @Override
    public EventDashAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_event_view, parent, false);
        return new myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int position) {
        Events events = mData.get(position);
        String path = kImageBaseUrl + events.getFacFolder()+ "/"+events.getBanner();
        Picasso.with(context).load(path).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
        myViewHolder.field_name.setText(events.getEventName());
        myViewHolder.venue.setText(events.getVenue());
        myViewHolder.date.setText(Utils.changeDateNew(events.getSdate()));
        myViewHolder.status.setText(capitizeString(events.getStatus()));
        myViewHolder.participants.setText(events.getParticipants());
        //myViewHolder.booked.setText(events.getBooked());

		if(events.getEventApproved().equalsIgnoreCase("approved")){
			myViewHolder.tv_pstatus.setTextColor(context.getResources().getColor(R.color.green));
		}else if(events.getEventApproved().equalsIgnoreCase("rejected")){
			myViewHolder.tv_pstatus.setTextColor(context.getResources().getColor(R.color.dark_grey));
		}else if(events.getEventApproved().equalsIgnoreCase("pending")){
			myViewHolder.tv_pstatus.setTextColor(context.getResources().getColor(R.color.user_theme_color));
		}

		myViewHolder.tv_pstatus.setText(capitizeString(events.getEventApproved()));


        myViewHolder.itemView.setOnClickListener(view -> listener.onEventClick(events));
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

    public void newData(CopyOnWriteArrayList<Events> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView ivBanner;
        TextView field_name,venue,date,participants,booked,status,tv_pstatus;
        private myViewHolder(View itemView) {
            super(itemView);
            ivBanner = itemView.findViewById(R.id.iv_banner);
            field_name=itemView.findViewById(R.id.tv_field);
            venue=itemView.findViewById(R.id.tv_venue);
            date=itemView.findViewById(R.id.tv_start_date);
            status = itemView.findViewById(R.id.tv_status);
            participants=itemView.findViewById(R.id.tv_total_booking);
            booked=itemView.findViewById(R.id.tv_confirmed_booked);
			tv_pstatus=itemView.findViewById(R.id.tv_pstatus);
        }
    }

    public interface onItemClickListener{
        void onEventClick(Events events);
    }
}
