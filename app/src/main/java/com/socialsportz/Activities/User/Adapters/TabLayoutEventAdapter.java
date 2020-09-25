package com.socialsportz.Activities.User.Adapters;

import android.content.Context;

import com.socialsportz.Activities.User.Fragments.EventDesFragment;
import com.socialsportz.Activities.User.Fragments.EventRuleFragment;
import com.socialsportz.Activities.User.Fragments.ThingsKnowEventFragment;
import com.socialsportz.Models.User.UserEvent;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;

public class TabLayoutEventAdapter extends FragmentPagerAdapter {

    private Context context;
    private int totalTabs;
    UserEvent userFacAca;

    public TabLayoutEventAdapter(Context context, FragmentManager fm, int totalTabs, UserEvent
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
                ThingsKnowEventFragment fragment = new ThingsKnowEventFragment(userFacAca);
                return fragment;
            case 1:
                EventDesFragment fragment1 = new EventDesFragment(userFacAca);

                return fragment1;
            case 2:
/*                ThingsKnowFragment fragment2 = new ThingsKnowFragment(userFacAca);
                return fragment2;*/
                EventRuleFragment fragment2 = new EventRuleFragment(userFacAca);
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
