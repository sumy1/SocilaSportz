package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class FavSportsAdapter extends RecyclerView.Adapter<FavSportsAdapter.myViewHolder> {

    Context context;
    CopyOnWriteArrayList<Sport> mData;
    int position=0;

    int j=0;
	int count=1;

    public FavSportsAdapter(Context context, CopyOnWriteArrayList<Sport> data) {
        this.context = context;
        this.mData = data;

         //Log.d("Size",mData.size()+"");


      /*  for(int i=1;i<mData.size();i++){
            j++;
            if(j>=3){
                j=0;
                count++;
            }

        }*/

     /* for(int i=1;i<mData.size();i++){
      	   count=1;
      	    if(i>3){
      	    	count++;
			}

	  }*/

      /*if(mData.size()==1){
      	count=1;
	  }else {
		  if(mData.size()%3==0) {
			  count = mData.size()/3;
			  //count++;

		  }else {
			  count = mData.size()/2;

		  }
	  }*/





    }

    @NonNull
    @Override
    public FavSportsAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_design_fav_sport, parent, false);
        return new myViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int i) {

    	Sport sport=mData.get(i);

		if(!sport.getSportIcon().isEmpty()){
			Picasso.with(context).load(sport.getSportIcon()).placeholder(R.drawable.running_event).fit().into(myViewHolder.iv1);
		}else{
			Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(myViewHolder.iv1);
		}

		myViewHolder.tv1.setText(sport.getSportName());


        /*if(i<count) {
            if(position<=i)
            {
                position=i;
            }
            if(position<mData.size()){

                if(!mData.get(position).getSportIcon().isEmpty()){
                    Picasso.with(context).load(mData.get(position).getSportIcon()).placeholder(R.drawable.football_image).fit().into(myViewHolder.iv1);
                }else{
                    Picasso.with(context).load(R.drawable.stadium_imgg).placeholder(R.drawable.football_image).fit().into(myViewHolder.iv1);
                }

                myViewHolder.tv1.setText(mData.get(position).getSportName());
                position++;
            }
            if(position<mData.size()) {
                if(!mData.get(position).getSportIcon().isEmpty()){
                    Picasso.with(context).load(mData.get(position).getSportIcon()).placeholder(R.drawable.football_image).fit().into(myViewHolder.iv2);
                }else{
                    Picasso.with(context).load(R.drawable.stadium_imgg).placeholder(R.drawable.football_image).fit().into(myViewHolder.iv2);
                }
                myViewHolder.tv2.setText(mData.get(position).getSportName());
                position++;
            }
            if(position<mData.size()) {
                if(!mData.get(position).getSportIcon().isEmpty()){
                    Picasso.with(context).load(mData.get(position).getSportIcon()).placeholder(R.drawable.football_image).fit().into(myViewHolder.iv3);
                }else{
                    Picasso.with(context).load(R.drawable.stadium_imgg).placeholder(R.drawable.football_image).fit().into(myViewHolder.iv3);
                }
                myViewHolder.tv3.setText(mData.get(position).getSportName());
                position++;
            }
        }else {
            return;
        }*/
    }

    @Override
    public int getItemCount() {
        return  mData == null ? 0 : mData.size();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        TextView tv1,tv2,tv3;
        ImageView iv1,iv2,iv3;
        private myViewHolder(View itemView) {
            super(itemView);
            tv1=itemView.findViewById(R.id.tv_sp1);
            /*tv2=itemView.findViewById(R.id.tv_sp2);
            tv3=itemView.findViewById(R.id.tv_sp3);*/
            iv1=itemView.findViewById(R.id.iv_sp1);
           /* iv2=itemView.findViewById(R.id.iv_sp2);
            iv3=itemView.findViewById(R.id.iv_sp3);*/
        }
    }



    public void newData(CopyOnWriteArrayList<Sport> list) {
        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }
}
