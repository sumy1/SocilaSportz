package com.socialsportz.Activities.User.Adapters;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.TextView;

import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kAmenityId;

public class SearchSportsAdapter extends RecyclerView.Adapter<SearchSportsAdapter.myViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<Amenity> mData;
    int position=0;
    int count=1;
    int j=0;
    static ArrayList<Integer> integers=new ArrayList<>();
    static JSONArray array;


    public SearchSportsAdapter(Context context, CopyOnWriteArrayList<Amenity> mData ) {
        this.context = context;
        this.mData = mData;


        Log.d("size",mData.size()+"");

        for(int i=0;i<mData.size();i++){
            j++;
            if(j==4){
                j=0;
                count++;
            }

        }

    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_search_fav_sport, parent, false);
        return new myViewHolder(layoutView);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder myViewHolder, int i) {
        if(i<count) {
            if(position<=i)
            {
                position=i;
            }
            if(position<mData.size()){
                myViewHolder.tv1.setText(mData.get(position).getAmenityName());
                myViewHolder.cb1.setVisibility(View.VISIBLE);
                myViewHolder.cb1.setTag(mData.get(position).getAmenityId());
                myViewHolder.cb1.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                    @Override
                    public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                        if(isChecked){
                            integers.add(Integer.valueOf(myViewHolder.cb1.getTag().toString()));
                            array=generateJsonArraySports(integers);
                            Log.d("Id",myViewHolder.cb1.getTag().toString());
                        }else{
                            integers.remove(Integer.valueOf(myViewHolder.cb1.getTag().toString()));
                            array=removeList(integers);
                            Log.d("Id",myViewHolder.cb1.getTag().toString());
                        }

                    }
                });
                position++;

            }
            if(position<mData.size()) {

                myViewHolder.tv2.setText(mData.get(position).getAmenityName());
                myViewHolder.cb2.setVisibility(View.VISIBLE);
                myViewHolder.cb2.setTag(mData.get(position).getAmenityId());
                myViewHolder.cb2.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                    @Override
                    public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                        if(isChecked){
                            integers.add(Integer.valueOf(myViewHolder.cb2.getTag().toString()));
                            array=generateJsonArraySports(integers);
                        }else{
                            integers.remove(Integer.valueOf(myViewHolder.cb2.getTag().toString()));
                            array=removeList(integers);

                        }

                    }
                });

                position++;

            }
            if(position<mData.size()) {

                myViewHolder.tv3.setText(mData.get(position).getAmenityName());
                myViewHolder.cb3.setVisibility(View.VISIBLE);
                myViewHolder.cb3.setTag(mData.get(position).getAmenityId());

                myViewHolder.cb3.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                    @Override
                    public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                        if(isChecked){
                            integers.add(Integer.valueOf(myViewHolder.cb3.getTag().toString()));
                            array=generateJsonArraySports(integers);
                        }else{
                            integers.remove(Integer.valueOf(myViewHolder.cb3.getTag().toString()));
                            array=removeList(integers);
                        }

                    }
                });
                position++;

            }


        }else {

            return;
        }





    }

    @Override
    public int getItemCount() {
        return count;
    }

    public static JSONArray generateJsonArraySports(List<Integer> typeList) {
        JSONArray list = new JSONArray();
        for(Integer type:typeList){
            try {
                JSONObject obj = new JSONObject();
                obj.put(kAmenityId, Integer.parseInt(type.toString()));
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
            obj.remove(kAmenityId);
            list.put(obj);
        }
        return list;
    }

    public static JSONArray getAray(){
        return generateJsonArraySports(integers);
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        TextView tv1,tv2,tv3;
        CheckBox cb1,cb2,cb3;
        private myViewHolder(View itemView) {
            super(itemView);
            tv1=itemView.findViewById(R.id.tv_sp1);
            tv2=itemView.findViewById(R.id.tv_sp2);
            tv3=itemView.findViewById(R.id.tv_sp3);
            cb1=itemView.findViewById(R.id.cb1);
            cb2=itemView.findViewById(R.id.cb2);
            cb3=itemView.findViewById(R.id.cb3);
        }
    }





}
