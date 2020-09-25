package com.socialsportz.Activities.Facility.Adapters;

import android.annotation.SuppressLint;
import android.content.Context;
import android.os.Handler;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotPrice;
import com.socialsportz.Models.Owner.BatchSlotType;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLinearLayoutManager;
import com.socialsportz.Utils.Utils;
import com.squareup.picasso.Picasso;

import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.core.content.ContextCompat;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class ArchiveBatchSlotAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> {
    private Context context;
    private CopyOnWriteArrayList<BatchSlot> mData;
    private onClickListener listener;
    private CopyOnWriteArrayList<Sport> sports;
    private CopyOnWriteArrayList<BatchPackage> packages;
    private CopyOnWriteArrayList<BatchSlotType> types;
    private int pageSize;

    public ArchiveBatchSlotAdapter(Context context, CopyOnWriteArrayList<BatchSlot> data, onClickListener listener) {
        this.context = context;
        this.mData = data;
        this.listener = listener;
        this.pageSize = data.size();
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
                    .inflate(R.layout.archivebatch_slot_design, parent, false);
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
            if(mData.isEmpty()|| mData.size()<8){
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
            final BatchSlot model = myViewHolder.BindData(mData.get(position));
            for(int i=0;i<sports.size();i++){
                if(sports.get(i).getSportId()==model.getSportId()){
                    myViewHolder.sportName.setText(sports.get(i).getSportName());
                    String path = kImageBaseUrl+sports.get(i).getFolderName()+"/"+sports.get(i).getSportImg();
                    Picasso.with(context).load(path).placeholder(R.drawable.football_image).into(myViewHolder.ivSport);
                    break;
                }
            }
            myViewHolder.stDate.setText(Utils.changeDateNew(model.getStartDate()));
            myViewHolder.edDate.setText(Utils.changeDateNew(model.getEndDate()));
            myViewHolder.maxBook.setText(model.getMaxBook());
            myViewHolder.tv_archive_comment.setText(model.getArchieveComment());
            myViewHolder.tv_status.setText(capitizeString(model.getFac_batch_slot_status()));

            if (model.getType().equals(Constants.BatchSlotEnum.slot.toString())){
                myViewHolder.priceTagLayout.setVisibility(View.VISIBLE);
                myViewHolder.dividerView.setVisibility(View.VISIBLE);
                myViewHolder.layoutPriceMonth.setVisibility(View.GONE);

                myViewHolder.price.setText(context.getResources().getString(R.string.Rs)+" "+model.getPrices().get(0).getPrice());
                for(int i=0;i<types.size();i++){
                    if(model.getTypeId()== types.get(i).getTypeId()){
                        myViewHolder.typeTag.setText(types.get(i).getTypeName());
                        break;
                    }
                }
                if (model.getTypeId()==1){
                    myViewHolder.typeTag.setBackgroundTintList(ContextCompat.getColorStateList(context, R.color.green));
                }else if (model.getTypeId()==2){
                    myViewHolder.typeTag.setBackgroundTintList(ContextCompat.getColorStateList(context, R.color.blue));
                }else {
                    myViewHolder.typeTag.setBackgroundTintList(ContextCompat.getColorStateList(context, R.color.red));
                }
            }else if(model.getType().equals(Constants.BatchSlotEnum.batch.toString())){
                myViewHolder.priceTagLayout.setVisibility(View.VISIBLE);
                myViewHolder.dividerView.setVisibility(View.GONE);
                myViewHolder.layoutPriceMonth.setVisibility(View.VISIBLE);
				myViewHolder.price.setText(context.getResources().getString(R.string.Rs)+" "+model.getPrices().get(0).getPrice());
				for(int i=0;i<types.size();i++){
					if(model.getTypeId()== types.get(i).getTypeId()){
						myViewHolder.typeTag.setText(types.get(i).getTypeName());
						break;
					}
				}
				if (model.getTypeId()==1){
					myViewHolder.typeTag.setBackgroundTintList(ContextCompat.getColorStateList(context, R.color.green));
				}else if (model.getTypeId()==2){
					myViewHolder.typeTag.setBackgroundTintList(ContextCompat.getColorStateList(context, R.color.blue));
				}else {
					myViewHolder.typeTag.setBackgroundTintList(ContextCompat.getColorStateList(context, R.color.red));
				}

                // insert into main view
                CustomLinearLayoutManager layoutManager = new CustomLinearLayoutManager(context,RecyclerView.VERTICAL,false);
                BatchPriceAdapter batchSlotAdapter = new BatchPriceAdapter(context,model.getPrices());
                myViewHolder.rvBatchPrice.setLayoutManager(layoutManager);
                myViewHolder.rvBatchPrice.setAdapter(batchSlotAdapter);
                //inflateEditRow(context,myViewHolder,model);

            }

            myViewHolder.editButton.setOnClickListener(view -> listener.onItemClick(model));
        }
    }


	private String capitizeString(String name){
		String captilizedString="";
		if(!name.trim().equals("")){
			captilizedString = name.substring(0,1).toUpperCase() + name.substring(1);
		}
		return captilizedString;
	}

    // Helper for inflating a row
    @SuppressLint("InflateParams")
    /*private void inflateEditRow(Context context,myViewHolder myViewHolder,BatchSlot model) {

        for(int j=0;j<model.getMonthPrice().size();j++){
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            assert inflater != null;
            final View rowView = inflater.inflate(R.layout.row_design_for_batch, null);
            TextView durMonth = rowView.findViewById(R.id.dur_month);
            TextView batchPrice = rowView.findViewById(R.id.batch_price);
            durMonth.setText(model.getMonthPrice().get(j).getType());
            batchPrice.setText(model.getMonthPrice().get(j).getPrice());
            LinearLayout.LayoutParams lp = new LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT,
                    LinearLayout.LayoutParams.WRAP_CONTENT);
            lp.setMargins(10, 0, 10, 5);
            rowView.setLayoutParams(lp);
            myViewHolder.layoutPriceMonth.addView(rowView);
        }
    }*/

    @Override
    public int getItemCount() {
        return mData.size()+1;
    }

    public void newData(CopyOnWriteArrayList<BatchSlot> list){
        CurrentUser user = ModelManager.modelManager().getCurrentUser();
        this.sports = user.getSports();
        this.packages = user.getBatchPackages();
        this.types = user.getBatchSlotTypes();

        mData.clear();
        mData.addAll(list);
        notifyDataSetChanged();
    }

    public void addData(CopyOnWriteArrayList<BatchSlot> list){
        mData.addAll(list);
        notifyDataSetChanged();
    }

    class myViewHolder extends RecyclerView.ViewHolder {
        BatchSlot model;
        ImageView ivSport;
        ImageButton editButton;
        TextView sportName,stDate,edDate, typeTag,maxBook,price,tv_status,tv_archive_comment;
        RelativeLayout priceTagLayout;
        LinearLayout layoutPriceMonth;
        RecyclerView rvBatchPrice;
        View dividerView;

        private myViewHolder(View itemView) {
            super(itemView);
            ivSport =itemView.findViewById(R.id.iv_sport);
            sportName=itemView.findViewById(R.id.tv_sport_name);
            editButton =itemView.findViewById(R.id.slot_batch_edit_btn);
            stDate=itemView.findViewById(R.id.tv_start_date);
            edDate=itemView.findViewById(R.id.tv_end_date);
            typeTag =itemView.findViewById(R.id.tag);
            maxBook=itemView.findViewById(R.id.tv_max_booking);
            price=itemView.findViewById(R.id.price);
            layoutPriceMonth=itemView.findViewById(R.id.layout_price_month);
            priceTagLayout=itemView.findViewById(R.id.price_tag_layout);
            dividerView=itemView.findViewById(R.id.divider_view);
            rvBatchPrice = itemView.findViewById(R.id.rv_batch_price);
			tv_status=itemView.findViewById(R.id.tv_status);
			tv_archive_comment=itemView.findViewById(R.id.tv_archive_comment);
        }

        private BatchSlot BindData(BatchSlot model){
            this.model = model;
            return model;
        }
    }

    class ProgressHolder extends RecyclerView.ViewHolder {

        ProgressBar progressBar;

        ProgressHolder(View itemView) {
            super(itemView);
            progressBar = itemView.findViewById(R.id.progress_bar);
        }
    }

    public class BatchPriceAdapter extends RecyclerView.Adapter<BatchPriceAdapter.myViewHolder> {

        Context context;
        List<BatchSlotPrice> mData;

        BatchPriceAdapter(Context context, CopyOnWriteArrayList<BatchSlotPrice> data) {
            this.context = context;
            this.mData = data;
        }

        @NonNull
        @Override
        public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
            View view = LayoutInflater.from(context).inflate(R.layout.row_design_for_batch, parent, false);
            return new myViewHolder(view);
        }

        @Override
        public void onBindViewHolder(@NonNull final myViewHolder myViewHolder, int pos) {
            BatchSlotPrice priceType =  mData.get(pos);
            for(int i=0;i<packages.size();i++){
                if(packages.get(i).getPackageId()==priceType.getPackageId()){
                    myViewHolder.name.setText(packages.get(i).getPackageName());
                    break;
                }
            }
            myViewHolder.price.setText(priceType.getPrice());
        }

        @Override
        public int getItemCount() {
            return mData.size();
        }

        class myViewHolder extends RecyclerView.ViewHolder {
            TextView name,price;
            private myViewHolder(View itemView) {
                super(itemView);
                name=itemView.findViewById(R.id.dur_month);
                price=itemView.findViewById(R.id.batch_price);
            }
        }

    }

    public interface onClickListener{
        void onItemClick(BatchSlot batchSlot);
    }
}
