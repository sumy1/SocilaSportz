 package com.socialsportz.Activities.Facility.Adapters;

 import android.content.Context;
 import android.os.Handler;
 import android.view.LayoutInflater;
 import android.view.View;
 import android.view.ViewGroup;
 import android.widget.ImageView;
 import android.widget.LinearLayout;
 import android.widget.ProgressBar;
 import android.widget.TextView;

 import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
 import com.socialsportz.Models.Owner.Events;
 import com.socialsportz.R;
 import com.socialsportz.Utils.Utils;
 import com.squareup.picasso.Picasso;

 import java.util.concurrent.CopyOnWriteArrayList;

 import androidx.annotation.NonNull;
 import androidx.recyclerview.widget.RecyclerView;

 import static com.socialsportz.Constants.Constants.kImageBaseUrl;

 public class EventaArchiveAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<Events> mData;
    private onItemClickListener listener;
    private int pageSize;

    public EventaArchiveAdapter(Context context, CopyOnWriteArrayList<Events> mData, onItemClickListener listener) {
        this.context = context;
        this.mData = mData;
        this.listener = listener;
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
                     .inflate(R.layout.row_event_view_archive, parent, false);
             return new myViewHolder(layoutView);
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
             if(mData.isEmpty()|| mData.size()<5){
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
             myViewHolder myViewHolder = (myViewHolder) holder;
             Events events = mData.get(position);
             String path = kImageBaseUrl + events.getFacFolder()+ "/"+events.getBanner();
             Picasso.with(context).load(path).placeholder(R.drawable.running_event).fit().into(myViewHolder.ivBanner);
             myViewHolder.field_name.setText(events.getEventName());
             myViewHolder.venue.setText(events.getVenue());
             myViewHolder.date.setText(Utils.changeDateNew(events.getSdate()));
             myViewHolder.status.setText(capitizeString(events.getStatus()));
             myViewHolder.participants.setText(events.getParticipants());

             if(events.getArchieveComment().isEmpty()){
             	myViewHolder.ll_archive.setVisibility(View.GONE);
			 }else {
				 myViewHolder.tv_archive.setText(events.getArchieveComment());
				 myViewHolder.ll_archive.setVisibility(View.VISIBLE);
			 }

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
     }

    @Override
    public int getItemCount() {
        return mData.size()+1;
    }

    public void addData(CopyOnWriteArrayList<Events> list) {
        mData.addAll(list);
        notifyDataSetChanged();
    }
	 private String capitizeString(String name) {
		 String captilizedString = "";
		 if (!name.trim().equals("")) {
			 captilizedString = name.substring(0, 1).toUpperCase() + name.substring(1);
		 }
		 return captilizedString;
	 }
    public void newData(CopyOnWriteArrayList<Events> list){
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        ImageView ivBanner;
        LinearLayout ll_archive;
        TextView field_name,venue,date,participants,booked,status,tv_pstatus,tv_archive;
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
			tv_archive=itemView.findViewById(R.id.tv_archive);
			ll_archive=itemView.findViewById(R.id.ll_archive);
        }
    }

     class ProgressHolder extends RecyclerView.ViewHolder {

         ProgressBar progressBar;

         ProgressHolder(View itemView) {
             super(itemView);
             progressBar = itemView.findViewById(R.id.progress_bar);
         }
     }

    public interface onItemClickListener{
        void onEventClick(Events events);
    }
}
