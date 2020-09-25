package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.os.Build;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.MasterSports;
import com.socialsportz.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.RequiresApi;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kSportId;

public class FavSportsMasterAdapter extends RecyclerView.Adapter<FavSportsMasterAdapter.myViewHolder> {

    Context context;
    CopyOnWriteArrayList<MasterSports> mData;
    CopyOnWriteArrayList<Sport> favroutesSports;
    String sportId;
	boolean isLightOn;


    static ArrayList<Integer> integers;
    JSONArray array;


    public FavSportsMasterAdapter(Context context, CopyOnWriteArrayList<MasterSports> data, CopyOnWriteArrayList<Sport> favroutesSports) {
        this.context = context;
        this.mData = data;
        this.favroutesSports = favroutesSports;

        integers = new ArrayList<>();
    }

    @NonNull
    @Override
    public FavSportsMasterAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_design_fav_sport_edit, parent, false);
        return new myViewHolder(view);
    }

    @RequiresApi(api = Build.VERSION_CODES.N)
    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int position) {
        MasterSports masterSports = mData.get(position);
        myViewHolder.sport_id = masterSports.getSportId();


        if (favroutesSports!=null) {
            for (int i = 0; i < favroutesSports.size(); i++) {
                if (favroutesSports.get(i).getSportId() == Integer.parseInt(masterSports.getSportId())) {
                    if (!favroutesSports.isEmpty()) {
                        Picasso.with(context).load(favroutesSports.get(i).getSportIcon()).placeholder(R.drawable.running_event).fit().into(myViewHolder.iv1);
                    } else {
                        Picasso.with(context).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(myViewHolder.iv1);
                    }

                    myViewHolder.cb3.setChecked(true);
					isLightOn=true;
                    myViewHolder.cb3.setTag(favroutesSports.get(i).getSportId());

                   // myViewHolder.ly1.setBackground(context.getResources().getDrawable(R.drawable.canvas_avail_red_bg));
                    myViewHolder.tv1.setText(favroutesSports.get(i).getSportName());
                    integers.add(Integer.valueOf(myViewHolder.cb3.getTag().toString()));
                    array = generateJsonArraySports(integers);
                    break;
                }

            }
        }

            Log.d("Image", masterSports.getSportIcon() + "/" + masterSports.getSportName());
        Picasso.with(context).load(masterSports.getSportIcon()).placeholder(R.drawable.football_image).fit().into(myViewHolder.iv1);
        myViewHolder.tv1.setText(mData.get(position).getSportName());


        myViewHolder.cb3.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if(isChecked==true){
                	isLightOn=true;
                    integers.add(Integer.valueOf(mData.get(position).getSportId()));
                    array=generateJsonArraySports(integers);
                    //Log.d("Id",myViewHolder.cb3.getTag().toString());
                }else{
					isLightOn=false;
                    integers.remove(Integer.valueOf(mData.get(position).getSportId()));
                    array=removeList(integers);
                    //Log.d("Id",myViewHolder.cb3.getTag().toString());
                }

                Log.d("Status",isLightOn+"");
            }
        });

        //...click..

        /*myViewHolder.ly1.setOnClickListener(v->{

            if (icClick == false) {


                myViewHolder.ly1.setBackground(context.getResources().getDrawable(R.drawable.canvas_avail_red_bg));
                icClick = true;
                integers.add(Integer.parseInt(myViewHolder.sport_id));
                array = generateJsonArraySports(integers);
                Log.d("size",integers.size()+"");
            } else if (icClick == true) {

                for(int i=0;i<integers.size();i++){
                    if(i==position){
                        integers.remove(mData.get(position).getSportId());
                        array = removeList(integers);
                    }


                }

                Log.d("size1",integers.size()+"");

                myViewHolder.ly1.setBackground(null);
                icClick = false;


            }
        });*/







    }

    @Override
    public int getItemCount() {
        return mData.size();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        String sport_id;
        TextView tv1, tv2, tv3;
        ImageView iv1, iv2, iv3;
        CheckBox cb3;
        LinearLayout ly1, ly2, ly3;

        private myViewHolder(View itemView) {
            super(itemView);
            tv1 = itemView.findViewById(R.id.tv_sp1);
            tv2 = itemView.findViewById(R.id.tv_sp2);
            tv3 = itemView.findViewById(R.id.tv_sp3);
            iv1 = itemView.findViewById(R.id.iv_sp1);
            iv2 = itemView.findViewById(R.id.iv_sp2);
            iv3 = itemView.findViewById(R.id.iv_sp3);
            cb3 = itemView.findViewById(R.id.cb3);
            /*ly2 = itemView.findViewById(R.id.ly2);
            ly3 = itemView.findViewById(R.id.ly3);*/
        }
    }

	public boolean getSportsSelectionStatus(){
		boolean status=false;

		Log.d("size",isLightOn+"");

		if(array.length()==0){
			status=true;
		}
		return status;
	}

    public static JSONArray generateJsonArraySports(List<Integer> typeList) {
        JSONArray list = new JSONArray();
        for (Integer type : typeList) {
            try {
                JSONObject obj = new JSONObject();
                obj.put(kSportId, Integer.parseInt(type.toString()));
                list.put(obj);
            } catch (JSONException e1) {
                e1.printStackTrace();
            }
        }
        return list;
    }

    public static JSONArray removeList(List<Integer> typeList) {
        JSONArray list = new JSONArray();

        for(int i=0;i<typeList.size();i++){
            JSONObject obj = new JSONObject();
            obj.remove(kSportId);
            list.put(obj);
        }
        return list;
    }

    public static JSONArray getAray(){
        return generateJsonArraySports(integers);
    }


}
