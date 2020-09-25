package com.socialsportz.Activities.Facility.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacAchievement;
import com.socialsportz.Models.Owner.FacReward;
import com.socialsportz.R;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.PopupMenu;
import androidx.recyclerview.widget.RecyclerView;
import androidx.viewpager.widget.PagerAdapter;
import androidx.viewpager.widget.ViewPager;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class ProfileAchievementAdapter extends RecyclerView.Adapter<ProfileAchievementAdapter.MyViewHolder> {

	private Context context;
	private List<FacAchievement> itemsList;
	private clickInterface listener;
	private ondeleteListner ondeleteListner;
	private CopyOnWriteArrayList<FacReward> rewards;
	String facType;

	public ProfileAchievementAdapter(Context context,String facType, List<FacAchievement> list, clickInterface listener,ondeleteListner ondeleteListner ) {
		this.context = context;
		this.facType=facType;
		this.itemsList = list;
		this.listener = listener;
		this.ondeleteListner=ondeleteListner;
		this.rewards = ModelManager.modelManager().getCurrentUser().getRewards();

	}

	@NonNull
	@Override
	public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View itemView = LayoutInflater.from(parent.getContext())
			.inflate(R.layout.row_design_achevement_detail, parent, false);

		return new MyViewHolder(itemView);
	}

	@Override
	public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
		final FacAchievement item = itemsList.get(position);
		holder.tvTitle.setText(item.getFacRewardTitle());
		for(FacReward rw:rewards){
			if(item.getFacRewardId()==rw.getRewardId()){
				holder.tvType.setText(rw.getRewardName());
				break;
			}
		}

		holder.ibMore.setOnClickListener(view -> showPopupMenu(holder.ibMore,item,position));

		if(item.getFacAchieveImg1().isEmpty() && item.getFacAchieveImg2().isEmpty()){
			holder.rightNav.setVisibility(View.GONE);
		}else{
			holder.emptyImage.setVisibility(View.GONE);
			ArrayList<String> mList = new ArrayList<>();
			if(!item.getFacAchieveImg1().isEmpty())
				mList.add(item.getFacAchieveImg1());
			if(!item.getFacAchieveImg2().isEmpty())
				mList.add(item.getFacAchieveImg2());

			CustomPagerAdapter viewpagerAdapter = new CustomPagerAdapter(mList);
			holder.viewPager.setAdapter(viewpagerAdapter);
			if(mList.size()==1)
				holder.rightNav.setVisibility(View.GONE);
			holder.viewPager.addOnPageChangeListener(new ViewPager.OnPageChangeListener() {
				@Override
				public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {
					if(position==0){
						holder.leftNav.setVisibility(View.GONE);
						holder.rightNav.setVisibility(View.VISIBLE);
					} else{
						holder.leftNav.setVisibility(View.VISIBLE);
						holder.rightNav.setVisibility(View.GONE);
					}
				}

				@Override
				public void onPageSelected(int position) {
					if(position==0){
						holder.leftNav.setVisibility(View.GONE);
						holder.rightNav.setVisibility(View.VISIBLE);
					} else{
						holder.leftNav.setVisibility(View.VISIBLE);
						holder.rightNav.setVisibility(View.GONE);
					}
				}

				@Override
				public void onPageScrollStateChanged(int state) { }
			});

			holder.leftNav.setOnClickListener(v -> {
				int tab =holder.viewPager.getCurrentItem();
				holder.viewPager.setCurrentItem(--tab);
			});

			// Images right navigatin
			holder.rightNav.setOnClickListener(v -> {
				int tab =holder.viewPager.getCurrentItem();
				holder.viewPager.setCurrentItem(++tab);
			});
		}

		holder.img_delete.setOnClickListener(v->{

			int pos=position;
			ondeleteListner.onDelete(facType,String.valueOf(item.getFacAchieveId()),pos);});


	}

	private void showPopupMenu(View view, FacAchievement achievement,int pos){
		//creating a popup menu
		PopupMenu popup = new PopupMenu(context, view);
		//inflating menu from xml resource
		popup.inflate(R.menu.option_data);
		//adding click listener
		popup.setOnMenuItemClickListener(item -> {
			switch (item.getItemId()) {
				case R.id.action_edit:
					//handle menu1 click
					listener.onEdit(achievement);
					break;
			}
			return false;
		});
		//displaying the popup
		popup.show();
	}

	 public void removeData(int pos){
         itemsList.remove(pos);
         notifyItemRemoved(pos);
         notifyItemRangeChanged(pos,itemsList.size());
     }
	public void removeData(FacAchievement achievement){
		itemsList.remove(achievement);
	}

	@Override
	public int getItemCount() {
		return itemsList.size();
	}

	class MyViewHolder extends RecyclerView.ViewHolder {
		TextView tvTitle,tvType;
		ViewPager viewPager;
		ImageButton rightNav,leftNav;
		ImageButton ibMore;
		ImageView emptyImage,img_delete;

		MyViewHolder(View view) {
			super(view);
			tvTitle = view.findViewById(R.id.tv_title);
			tvType = view.findViewById(R.id.tv_type);
			viewPager = view.findViewById(R.id.viewpager);
			rightNav=view.findViewById(R.id.right_nav);
			leftNav=view.findViewById(R.id.left_nav);
			ibMore = view.findViewById(R.id.ib_more);
			emptyImage = view.findViewById(R.id.empty_view);
			img_delete=view.findViewById(R.id.img_delete);
		}
	}


	class CustomPagerAdapter extends PagerAdapter {

		private ArrayList<String> list;
		private LayoutInflater mLayoutInflater;

		CustomPagerAdapter(ArrayList<String> list) {
			this.list = list;
			mLayoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
		}

		@Override
		public int getCount() {
			return list.size();
		}

		@Override
		public boolean isViewFromObject(@NonNull View view, @NonNull Object object) {
			return view == (object);
		}

		@NonNull
		@Override
		public Object instantiateItem(@NonNull ViewGroup container, int position) {
			View itemView = mLayoutInflater.inflate(R.layout.vp_design_achievement_detail, container, false);

			ImageView achIv = itemView.findViewById(R.id.ach_iv);
			final Transformation transformation = new MaskTransformation(context, R.drawable.canvas_booking_details_img_bg);
			String path = kImageBaseUrl+itemsList.get(0).getFacFolder()+"/"+list.get(position);
			Picasso.with(context).load(path).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(achIv);

			container.addView(itemView);

			return itemView;
		}

		@Override
		public void destroyItem(@NonNull ViewGroup container, int position, @NonNull Object object) {
			container.removeView((LinearLayout) object);
		}
	}

	public interface clickInterface{
		void onEdit(FacAchievement achievement);
		//void onDelete();
	}

	public interface ondeleteListner{
		void onDelete(String faceType,String aceivementid,int pos);
	}
}
