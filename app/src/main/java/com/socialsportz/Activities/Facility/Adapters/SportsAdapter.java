package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;

import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.PopupMenu;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class SportsAdapter extends RecyclerView.Adapter<SportsAdapter.MyViewHolder> {

    private Context context;
    private List<FacSport> itemsList;
    private onClickInterface listener;

    class MyViewHolder extends RecyclerView.ViewHolder {
        TextView sportName, courtNo, indoorNo, outdoorNo;
        ImageView sportImg;
        ImageButton ibMore;

        MyViewHolder(View view) {
            super(view);
            sportName = view.findViewById(R.id.tv_fac_aca_sport);
            courtNo = view.findViewById(R.id.tv_fac_aca_court);
            indoorNo = view.findViewById(R.id.tv_indoor);
            outdoorNo = view.findViewById(R.id.tv_outdoor);
            sportImg = view.findViewById(R.id.iv_sport);
            ibMore = view.findViewById(R.id.ib_more);
        }
    }

    public SportsAdapter(Context context, List<FacSport> list, onClickInterface listener) {
        this.context = context;
        this.itemsList = list;
        this.listener = listener;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.row_sport_view, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        FacSport item = itemsList.get(position);
        setSport(item,holder.sportName,holder.sportImg);
        holder.courtNo.setText(String.valueOf(item.getSportCourt()));
        holder.indoorNo.setText(String.valueOf(item.getSportIndoor()));
        holder.outdoorNo.setText(String.valueOf(item.getSportOutdoor()));
        holder.ibMore.setOnClickListener(view -> showPopupMenu(holder.ibMore,item,position));
    }

    private void setSport(FacSport item, TextView name, ImageView img){
        List<Sport> list = ModelManager.modelManager().getCurrentUser().getSports();
        for(int i=0;i<list.size();i++){
            if(list.get(i).getSportId()==item.getSportId()){
                name.setText(list.get(i).getSportName());
                String path = kImageBaseUrl+list.get(i).getFolderName()+"/"+list.get(i).getSportIcon();
                Picasso.with(context).load(path).placeholder(R.drawable.cricket).into(img);
                break;
            }
        }
    }

    private void showPopupMenu(View view, FacSport facSport, int pos){
        //creating a popup menu
        PopupMenu popup = new PopupMenu(context, view);
        //inflating menu from xml resource
        popup.inflate(R.menu.option_data);
        //adding click listener
        popup.setOnMenuItemClickListener(item -> {
            switch (item.getItemId()) {
                case R.id.action_edit:
                    //handle menu1 click
                    listener.onEdit(facSport);
                    break;
            }
            return false;
        });
        //displaying the popup
        popup.show();
    }

    public void removeView(FacSport sport){
        itemsList.remove(sport);
        notifyDataSetChanged();
    }

    public void addData(CopyOnWriteArrayList<FacSport> list) {
        itemsList.addAll(list);
        notifyDataSetChanged();
    }

    public void newData(CopyOnWriteArrayList<FacSport> list){
        itemsList.clear();
        itemsList.addAll(list);
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        return itemsList.size();
    }

    public interface onClickInterface{
        void onEdit(FacSport facSport);
    }

}
