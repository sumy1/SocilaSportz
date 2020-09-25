package com.socialsportz.Activities.User.Adapters;

import android.content.Context;

import com.socialsportz.Activities.User.Fragments.AchievementFragment;
import com.socialsportz.Activities.User.Fragments.ThingsKnowFragment;
import com.socialsportz.Activities.User.Fragments.UserReviewFragment;
import com.socialsportz.Models.User.UserFacAca;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;

public class TabLayoutAdapter extends FragmentPagerAdapter {

    private Context context;
    private int totalTabs;
    UserFacAca userFacAca;

    public TabLayoutAdapter(Context context, FragmentManager fm, int totalTabs, UserFacAca
                             userFacAca) {
        super(fm);
        this.context = context;
        this.totalTabs = totalTabs;
        this.userFacAca=userFacAca;
    }

    // this is for fragment tabs
    @NonNull
    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                ThingsKnowFragment fragment = new ThingsKnowFragment(userFacAca);
                return fragment;
            case 1:
                AchievementFragment fragment1 = new AchievementFragment(userFacAca);
                return fragment1;
            case 2:
                UserReviewFragment fragment2 = new UserReviewFragment(userFacAca);
                return fragment2;
            default:
                return null;
        }
    }

    // this counts total number of tabs
    @Override
    public int getCount() {
        return totalTabs;
    }
}
