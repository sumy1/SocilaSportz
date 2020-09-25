package com.socialsportz.Activities.User.Adapters;

import android.content.Context;

import com.socialsportz.Activities.User.Fragments.EventDesFragmentt;
import com.socialsportz.Activities.User.Fragments.EventRuleFragmentt;
import com.socialsportz.Activities.User.Fragments.ThingsKnowEventFragmentt;
import com.socialsportz.Models.User.EventListing;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;

public class TabLayoutEventAdapterr extends FragmentPagerAdapter {

    private Context context;
    private int totalTabs;
    EventListing userFacAca;

    public TabLayoutEventAdapterr(Context context, FragmentManager fm, int totalTabs, EventListing
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
				ThingsKnowEventFragmentt fragment = new ThingsKnowEventFragmentt(userFacAca);
                return fragment;
            case 1:
                EventDesFragmentt fragment1 = new EventDesFragmentt(userFacAca);

                return fragment1;
            case 2:
/*                ThingsKnowFragment fragment2 = new ThingsKnowFragment(userFacAca);
                return fragment2;*/
                EventRuleFragmentt fragment2 = new EventRuleFragmentt(userFacAca);
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
