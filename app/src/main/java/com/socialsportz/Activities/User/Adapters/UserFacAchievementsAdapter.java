package com.socialsportz.Activities.User.Adapters;

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
import com.socialsportz.Models.User.UserFacAchievements;
import com.socialsportz.R;

import java.util.ArrayList;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import androidx.viewpager.widget.PagerAdapter;
import androidx.viewpager.widget.ViewPager;
import br.com.felix.imagezoom.ImageZoom;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class UserFacAchievementsAdapter extends RecyclerView.Adapter<UserFacAchievementsAdapter.myViewHolder> {

    private Context context;
    private CopyOnWriteArrayList<UserFacAchievements> mData;
    private AchiImagePagerAdapter achiImagePagerAdapter;


    public UserFacAchievementsAdapter(Context context, CopyOnWriteArrayList<UserFacAchievements> mData) {
        this.context = context;
        this.mData = mData;
    }


    @NonNull
    @Override
    public UserFacAchievementsAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layoutView = LayoutInflater.from(context).inflate(R.layout.row_user_achievement_detail, parent, false);
        return new UserFacAchievementsAdapter.myViewHolder(layoutView);
    }


    @Override
    public void onBindViewHolder(@NonNull UserFacAchievementsAdapter.myViewHolder holder, int position) {
        UserFacAchievements ach = mData.get(position);

        holder.tv_title.setText(ach.getFacRewardTitle());
        holder.tv_type.setText(ach.getFacRewardName());


        if(ach.getFacAchieveImg1().isEmpty() && ach.getFacAchieveImg2().isEmpty()){
            holder.rightNav.setVisibility(View.GONE);
        }else{
//            holder.emptyImage.setVisibility(View.GONE);
            ArrayList<String> mList = new ArrayList<>();
            if(!ach.getFacAchieveImg1().isEmpty())
                mList.add(ach.getFacAchieveImg1());
            if(!ach.getFacAchieveImg2().isEmpty())
                mList.add(ach.getFacAchieveImg2());

            achiImagePagerAdapter = new AchiImagePagerAdapter(mList);
            holder.viewpager.setAdapter(achiImagePagerAdapter);
            if(mList.size()==1)
                holder.rightNav.setVisibility(View.GONE);
            holder.viewpager.addOnPageChangeListener(new ViewPager.OnPageChangeListener() {
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
                int tab =holder.viewpager.getCurrentItem();
                holder.viewpager.setCurrentItem(--tab);
            });

            // Images right navigatin
            holder.rightNav.setOnClickListener(v -> {
                int tab =holder.viewpager.getCurrentItem();
                holder.viewpager.setCurrentItem(++tab);
            });
        }

    }

    @Override
    public int getItemCount() {
        return mData.size();
    }


    class myViewHolder extends RecyclerView.ViewHolder {

        TextView tv_title, tv_type;
        ViewPager viewpager;
        ImageButton rightNav,leftNav;
        ImageView emptyImage;

        public myViewHolder(@NonNull View itemView) {
            super(itemView);
            tv_title = itemView.findViewById(R.id.tv_title);
            tv_type = itemView.findViewById(R.id.tv_type);
            viewpager = itemView.findViewById(R.id.viewpager);
            rightNav=itemView.findViewById(R.id.right_nav);
            leftNav=itemView.findViewById(R.id.left_nav);
            emptyImage = itemView.findViewById(R.id.empty_view);
        }
    }


    class AchiImagePagerAdapter extends PagerAdapter {

        private ArrayList<String> list;
        private LayoutInflater mLayoutInflater;

        AchiImagePagerAdapter(ArrayList<String> list) {
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
            ImageZoom achIv = itemView.findViewById(R.id.ach_iv);
            final Transformation transformation = new MaskTransformation(context, R.drawable.canvas_booking_details_img_bg);
            String path = kImageBaseUrl+mData.get(0).getFacFolder()+"/"+list.get(position);
            Picasso.with(context).load(path).placeholder(R.drawable.placeholder_300).fit().transform(transformation).into(achIv);

            container.addView(itemView);
            return itemView;
        }

        @Override
        public void destroyItem(@NonNull ViewGroup container, int position, @NonNull Object object) {
            container.removeView((LinearLayout) object);
        }
    }


}



