package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.R;

import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.PopupMenu;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class FacilityListingAdapter extends RecyclerView.Adapter<FacilityListingAdapter.MyViewHolder> {

    private Context context;
    private List<Facility> itemsList;
    private clickInterface listener;

    public FacilityListingAdapter(Context context, List<Facility> list, clickInterface listener) {
        this.context = context;
        this.itemsList = list;
        this.listener = listener;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_fac_aca_listing, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(MyViewHolder holder, int position) {
        Facility item = itemsList.get(position);
        holder.facType.setText(capitizeString(item.getFacType()));

        holder.facName.setText(item.getFacName());
        holder.facAddress.setText(item.getFacAddress()+", "+item.getFacCity()+", "+item.getFacState()+" "+item.getFacPincode()+" "+item.getFacCountry());
        if(!item.getFacTimingList().isEmpty())
            setTimeText(item.getFacTimingList(),holder.facTiming);
        if(!item.getFacBannerImg().isEmpty()){
            String path = kImageBaseUrl + item.getFacFolder()+"/"+item.getFacBannerImg();
            Picasso.with(context).load(path).placeholder(R.drawable.placeholder_300).fit().into(holder.facImg);
        }
        holder.ibMore.setOnClickListener(view -> showPopupMenu(holder.ibMore,item,position));
        holder.addAchieve.setOnClickListener(v -> listener.onAddAchievement(item.getFacId()));
        holder.seeAchieve.setOnClickListener(v -> listener.onSeeAchievement(item.getFacId()));
    }
    private void setTimeText(CopyOnWriteArrayList<FacDayTime> list, TextView textView){
        boolean check = false;
        String open_time="";
        String close_time="";
        for(int i=0;i<list.size();i++){
            if(list.get(i).getDayStatus()==1){
                check = true;
                open_time = list.get(i).getDayOpenTime();
                close_time = list.get(i).getDayCloseTime();
                break;
            }
        }
        String timeTxt="";
        if(check)
            timeTxt = open_time + " - "+close_time ;
        textView.setText(timeTxt);
    }
	private String capitizeString(String name){
		String captilizedString="";
		if(!name.trim().equals("")){
			captilizedString = name.substring(0,1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
	}

    private void showPopupMenu(View view, Facility facility, int pos){
        //creating a popup menu
        PopupMenu popup = new PopupMenu(context, view);
        //inflating menu from xml resource
        popup.inflate(R.menu.option_menu);
        //adding click listener
        popup.setOnMenuItemClickListener(item -> {
            switch (item.getItemId()) {
                case R.id.action_edit:
                    //handle menu1 click
                    listener.onEdit(facility);
                    break;
                case R.id.action_delete:
                    //handle menu2 click
                    listener.onDelete(facility,pos);
                    break;
            }
            return false;
        });
        //displaying the popup
        popup.show();
    }

    @Override
    public int getItemCount() {
        return itemsList.size();
    }

    public void removeData(Facility facility){
        itemsList.remove(facility);
    }

    class MyViewHolder extends RecyclerView.ViewHolder {
        TextView facName, facAddress, facTiming,facType;
        ImageView facImg;
        ImageButton ibMore;
        Button addAchieve,seeAchieve;

        MyViewHolder(View view) {
            super(view);
            facType = view.findViewById(R.id.tv_fac_aca_type);
            facName = view.findViewById(R.id.tv_fac_aca_name);
            facAddress = view.findViewById(R.id.tv_fac_aca_address);
            facTiming = view.findViewById(R.id.tv_fac_aca_timing);
            facImg = view.findViewById(R.id.iv_fac_banner);
            ibMore = view.findViewById(R.id.ib_more);
            addAchieve = view.findViewById(R.id.btn_add_achievement);
            seeAchieve = view.findViewById(R.id.btn_view_achievement);
        }
    }

    public interface clickInterface{
        void onEdit(Facility facility);
        void onDelete(Facility facility, int pos);
        void onAddAchievement(int facId);
        void onSeeAchievement(int facId);
    }
}
