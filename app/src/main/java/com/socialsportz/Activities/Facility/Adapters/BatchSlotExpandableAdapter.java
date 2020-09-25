package com.socialsportz.Activities.Facility.Adapters;

import android.annotation.SuppressLint;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseExpandableListAdapter;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.socialsportz.Constants.Constants;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotAvail;
import com.socialsportz.R;
import com.socialsportz.Utils.Utils;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import static com.socialsportz.Constants.Constants.kData;

public class BatchSlotExpandableAdapter extends BaseExpandableListAdapter {

	private CopyOnWriteArrayList<HashMap<String, Object>> childItems;
	private CopyOnWriteArrayList<BatchSlotAvail> parentItems;
	private LayoutInflater inflater;
	private Context context;
	private String facType;

	public BatchSlotExpandableAdapter(String facType, Context activity, CopyOnWriteArrayList<BatchSlotAvail> parentList, CopyOnWriteArrayList<HashMap<String, Object>> childList) {
		this.parentItems = parentList;
		this.childItems = childList;
		this.context = activity;
		this.facType = facType;
		inflater = (LayoutInflater) activity.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
	}

	@Override
	public int getGroupCount() {
		return parentItems.size();
	}

	@Override
	public int getChildrenCount(int groupPosition) {
		CopyOnWriteArrayList<BatchSlot> list = (CopyOnWriteArrayList<BatchSlot>) childItems.get(groupPosition).get(kData);
		assert list != null;
		return list.size();
	}

	@Override
	public Object getGroup(int i) {
		return null;
	}

	@Override
	public Object getChild(int i, int i1) {
		return null;
	}

	@Override
	public long getGroupId(int i) {
		return 0;
	}

	@Override
	public long getChildId(int i, int i1) {
		return 0;
	}

	@Override
	public boolean hasStableIds() {
		return false;
	}

	@SuppressLint("InflateParams")
	@Override
	public View getGroupView(final int groupPosition, final boolean b, View convertView, ViewGroup viewGroup) {
		final ViewHolderParent viewHolderParent;
		BatchSlotAvail parent = parentItems.get(groupPosition);
		if (convertView == null) {
			convertView = inflater.inflate(R.layout.row_expandable_list_group, null);
			viewHolderParent = new ViewHolderParent();

			viewHolderParent.tvMainCategoryName = convertView.findViewById(R.id.tv_date);
			convertView.setTag(viewHolderParent);
		} else {
			viewHolderParent = (ViewHolderParent) convertView.getTag();
		}

		String date = Utils.changeDateNew(parent.getDate());
		viewHolderParent.tvMainCategoryName.setText(date);
		Utils.childItems = childItems;
		Utils.parentItems = parentItems;

		return convertView;
	}

	@SuppressLint("InflateParams")
	@Override
	public View getChildView(final int groupPosition, final int childPosition, final boolean b, View convertView, ViewGroup viewGroup) {

		final ViewHolderChild viewHolderChild;
		CopyOnWriteArrayList<BatchSlot> data = (CopyOnWriteArrayList<BatchSlot>) childItems.get(groupPosition).get(kData);
		assert data != null;
		BatchSlot child = data.get(childPosition);
		if (convertView == null) {
			convertView = inflater.inflate(R.layout.row_expandable_list_item, null);
			viewHolderChild = new ViewHolderChild();

			viewHolderChild.layout = convertView.findViewById(R.id.item_view);
			viewHolderChild.maxLayout = convertView.findViewById(R.id.max_layout);
			viewHolderChild.priceLayout = convertView.findViewById(R.id.price_layout);
			viewHolderChild.tvTime = convertView.findViewById(R.id.tv_time_slot_batch);
            viewHolderChild.tv_time_slot_des_type=convertView.findViewById(R.id.tv_time_slot_des_type);
			viewHolderChild.tv_time_slot_des=convertView.findViewById(R.id.tv_time_slot_des);
			viewHolderChild.tv_time_slot_available=convertView.findViewById(R.id.tv_time_slot_available);
			viewHolderChild.tv_time_slot_type=convertView.findViewById(R.id.tv_time_slot_type);
			viewHolderChild.v1=convertView.findViewById(R.id.v1);
			viewHolderChild.ll_des=convertView.findViewById(R.id.ll_des);

			viewHolderChild.tvMax = convertView.findViewById(R.id.tv_max);
			viewHolderChild.tvPrice = convertView.findViewById(R.id.tv_price);
			convertView.setTag(viewHolderChild);
		} else {
			viewHolderChild = (ViewHolderChild) convertView.getTag();
		}

       /* if(childPosition==0){
            ViewGroup.MarginLayoutParams params = (ViewGroup.MarginLayoutParams) convertView.getLayoutParams();
            params.topMargin = 100;
            convertView.setLayoutParams(params);
        }*/

		String time = child.getStartTime() + " - " + child.getEndTime();
		viewHolderChild.tvTime.setText(time);

		viewHolderChild.tv_time_slot_type.setText("("+child.getBatchSlotType()+")");

		if(child.getCourtDescription().isEmpty()){
			viewHolderChild.ll_des.setVisibility(View.GONE);
			viewHolderChild.v1.setVisibility(View.GONE);
		}else{
			viewHolderChild.v1.setVisibility(View.VISIBLE);
			viewHolderChild.ll_des.setVisibility(View.VISIBLE);
		}

		viewHolderChild.tv_time_slot_des.setText(child.getCourtDescription());
		String price = "";
		if (facType.equals(Constants.FacType.facility.toString()))
			price = context.getResources().getString(R.string.Rs) + child.getPrices().get(0).getPrice();

		else
			try{
				price = context.getResources().getString(R.string.Rs) + child.getPrices().get(groupPosition).getPrice();

			}catch (Exception e){
				e.printStackTrace();
			}
		viewHolderChild.tvPrice.setText(price);

			if(facType.equals(Constants.FacType.facility.toString())){
				viewHolderChild.tv_time_slot_des_type.setText("Slot Description");
			}else{
				viewHolderChild.tv_time_slot_des_type.setText("Batch Description");
			}

		if (child.getAvailability().equalsIgnoreCase(Constants.DefaultStatus.yes.toString())) {
			if (child.isChecked()) {
				viewHolderChild.tvTime.setTextColor(context.getResources().getColor(R.color.red));
				viewHolderChild.tvPrice.setTextColor(context.getResources().getColor(R.color.white));
				viewHolderChild.maxLayout.setBackground(context.getDrawable(R.drawable.canvas_round_corner_red));
				viewHolderChild.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.red));
				viewHolderChild.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.red));
				viewHolderChild.v1.setBackgroundColor(context.getResources().getColor(R.color.red));
				viewHolderChild.tv_time_slot_type.setTextColor(context.getResources().getColor(R.color.red));
				viewHolderChild.tv_time_slot_available.setTextColor(context.getResources().getColor(R.color.red));
				viewHolderChild.priceLayout.setBackground(context.getDrawable(R.drawable.canvas_round_corner_red));
				viewHolderChild.layout.setBackground(context.getResources().getDrawable(R.drawable.canvas_avail_red_bg));
			} else if (child.getFac_batch_slot_status().equalsIgnoreCase("inactive")) {
				viewHolderChild.tvTime.setTextColor(context.getResources().getColor(R.color.brown));
				viewHolderChild.tvPrice.setTextColor(context.getResources().getColor(R.color.white));
				viewHolderChild.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.brown));
				viewHolderChild.tv_time_slot_type.setTextColor(context.getResources().getColor(R.color.brown));
				viewHolderChild.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.brown));
				viewHolderChild.v1.setBackgroundColor(context.getResources().getColor(R.color.brown));
				viewHolderChild.tv_time_slot_available.setTextColor(context.getResources().getColor(R.color.brown));
				viewHolderChild.tv_time_slot_available.setText(child.getFac_batch_slot_status());
				viewHolderChild.maxLayout.setBackground(context.getDrawable(R.drawable.canvas_round_corner_lightyellow));
				viewHolderChild.priceLayout.setBackground(context.getDrawable(R.drawable.canvas_round_corner_lightyellow));
				viewHolderChild.layout.setBackground(context.getResources().getDrawable(R.drawable.canvas_avail_grey_bgg));
			} else {
				viewHolderChild.tvTime.setTextColor(context.getResources().getColor(R.color.green));
				viewHolderChild.tvPrice.setTextColor(context.getResources().getColor(R.color.white));
				viewHolderChild.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.green));
				viewHolderChild.tv_time_slot_type.setTextColor(context.getResources().getColor(R.color.green));
				viewHolderChild.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.green));
				viewHolderChild.v1.setBackgroundColor(context.getResources().getColor(R.color.green));
				viewHolderChild.tv_time_slot_available.setTextColor(context.getResources().getColor(R.color.green));
				viewHolderChild.maxLayout.setBackground(context.getDrawable(R.drawable.canvas_round_corner_green));
				viewHolderChild.priceLayout.setBackground(context.getDrawable(R.drawable.canvas_round_corner_green));
				viewHolderChild.layout.setBackground(context.getResources().getDrawable(R.drawable.canvas_avail_green_bg));
			}
			notifyDataSetChanged();
		} else {
			viewHolderChild.tvTime.setTextColor(context.getResources().getColor(R.color.dim_grey));
			viewHolderChild.tvPrice.setTextColor(context.getResources().getColor(R.color.white));
			viewHolderChild.tv_time_slot_des_type.setTextColor(context.getResources().getColor(R.color.dim_grey));
			viewHolderChild.tv_time_slot_type.setTextColor(context.getResources().getColor(R.color.dim_grey));
			viewHolderChild.tv_time_slot_available.setText("Not Available");
			viewHolderChild.v1.setBackgroundColor(context.getResources().getColor(R.color.dim_grey));
			viewHolderChild.tv_time_slot_des.setTextColor(context.getResources().getColor(R.color.dim_grey));
			viewHolderChild.tv_time_slot_available.setTextColor(context.getResources().getColor(R.color.dim_grey));
			viewHolderChild.maxLayout.setBackground(context.getDrawable(R.drawable.canvas_round_corner_grey));
			viewHolderChild.priceLayout.setBackground(context.getDrawable(R.drawable.canvas_round_corner_grey));
			viewHolderChild.layout.setBackground(context.getResources().getDrawable(R.drawable.canvas_avail_grey_bg));
		}

		viewHolderChild.layout.setOnClickListener(view -> {
			if (child.getAvailability().equalsIgnoreCase(Constants.DefaultStatus.yes.toString())) {
				if (child.isChecked()) {
					child.setChecked(false);
				} else if (child.getFac_batch_slot_status().equalsIgnoreCase("inactive")) {
					child.setChecked(false);
				} else {
					child.setChecked(true);
				}
				notifyDataSetChanged();
			}
			Utils.childItems = childItems;
			Utils.parentItems = parentItems;
		});

		return convertView;
	}

	@Override
	public boolean isChildSelectable(int i, int i1) {
		return false;
	}

	@Override
	public void onGroupCollapsed(int groupPosition) {
		super.onGroupCollapsed(groupPosition);
	}

	@Override
	public void onGroupExpanded(int groupPosition) {
		super.onGroupExpanded(groupPosition);
	}

	private class ViewHolderParent {
		TextView tvMainCategoryName;

	}

	private class ViewHolderChild {
		TextView tvTime, tvMax, tvPrice,tv_time_slot_des_type,tv_time_slot_des,tv_time_slot_available,tv_time_slot_type;
		RelativeLayout layout;
		LinearLayout maxLayout,ll_des;
		LinearLayout priceLayout;
		View v1;
	}

}
