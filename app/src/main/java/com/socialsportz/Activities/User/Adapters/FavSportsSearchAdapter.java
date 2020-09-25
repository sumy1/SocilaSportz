package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class FavSportsSearchAdapter extends RecyclerView.Adapter<FavSportsSearchAdapter.myViewHolder> {

    private Context context;
    private CopyOnWriteArrayList<Sport> mData;
    private int row_index=-1;
    int count;
    OnItemClickListner onItemClickListner;

    public FavSportsSearchAdapter(Context context, CopyOnWriteArrayList<Sport> data, OnItemClickListner onItemClickListner) {
        this.context = context;
        this.mData = data;
        this.onItemClickListner=onItemClickListner;
    }

    @NonNull
    @Override
    public FavSportsSearchAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_design_user_sport_list, parent, false);
        return new myViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int i) {

        myViewHolder.tv.setText(mData.get(i).getSportName());
        if(!mData.get(i).getSportIcon().isEmpty()){
            String path = kImageBaseUrl+mData.get(i).getFolderName()+"/"+mData.get(i).getSportIcon();
            Picasso.with(context).load(path).placeholder(R.drawable.football_image).into(myViewHolder.img);
        }else{
            Picasso.with(context).load(R.drawable.football_image).placeholder(R.drawable.football_image).into(myViewHolder.img);
        }

        myViewHolder.itemView.setOnClickListener(view -> {
            row_index=i;
            Log.d("row_index",i+"");
            notifyDataSetChanged();
        });

        if(row_index==i){
            onItemClickListner.selectSport(String.valueOf(mData.get(i).getSportId()),mData.get(i).getSportName());
            myViewHolder.frameLayout.setBackground(context.getResources().getDrawable(R.drawable.canvas_red_border_img_bg));
        }
        else
        {
            myViewHolder.frameLayout.setBackground(context.getResources().getDrawable(R.drawable.canvas_booking_details_img_bg));
        }
    }

    @Override
    public int getItemCount() {
        return mData.size();
    }

    public boolean getSportsSelectionStatus(){
        boolean status=false;

        if(row_index==-1){
            status=true;
        }
        return status;
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        TextView tv;
        ImageView img;
        FrameLayout frameLayout;
        private myViewHolder(View itemView) {
            super(itemView);
            tv=itemView.findViewById(R.id.sport_name);
            img=itemView.findViewById(R.id.iv_sport);
            frameLayout=itemView.findViewById(R.id.layout);
        }
    }

    public interface OnItemClickListner{
         void selectSport(String id, String name);
    }
}
