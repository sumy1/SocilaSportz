package com.socialsportz.Activities.User.Fragments;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.flyco.tablayout.SlidingTabLayout;
import com.flyco.tablayout.listener.OnTabSelectListener;
import com.socialsportz.R;
import com.socialsportz.Utils.Utils;

import java.util.ArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.viewpager.widget.ViewPager;

public class UserBookingFragment  extends Fragment implements OnTabSelectListener {

    private Context context;
    private ViewPager vp;
    private SlidingTabLayout tabLayout;
    private ArrayList<Fragment> mFragments = new ArrayList<>();
    MyPagerAdapter mAdapter;
    int  from;
    int id;

    public UserBookingFragment(int form){
    	this.from=form;
	}

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_user_bookings, container, false);
        context = getActivity();

		Bundle bundle=getArguments();

		//here is your list array

		/*if(bundle.getInt("FROM")==1){
			from=bundle.getInt("FROM");
		}else{

		}*/



        vp = rootView.findViewById(R.id.vp);
        tabLayout = rootView.findViewById(R.id.tabLayout);
        //tabLayout.setTextsize(getResources().getDimension(R.dimen._12sdp));
        tabLayout.setTabSpaceEqual(true);

        initTabLayout();

        return rootView;
    }

    private void initTabLayout(){


        addFragments();
        mAdapter = new MyPagerAdapter(getChildFragmentManager(),mFragments);
        vp.setAdapter(mAdapter);
        tabLayout.setViewPager(vp);

        if(from==1){
			vp.setCurrentItem(1);
		}else{
			vp.setCurrentItem(0);
		}


        vp.setOffscreenPageLimit(1);
    }

    private void addFragments() {
        //mFragments.clear();
        mFragments.add(0, new UserBatchSlotBookingFragment());
        mFragments.add(1, new UserEventBookingFragment());


    }


    @Override
    public void onTabSelect(int position) {

    }

    @Override
    public void onTabReselect(int position) {

    }

    private class MyPagerAdapter extends FragmentPagerAdapter {
        ArrayList<Fragment> list;
        ArrayList<String> pages;
        MyPagerAdapter(FragmentManager fm, ArrayList<Fragment> list) {
            super(fm);
            this.list = list;
            this.pages = Utils.getUserTabTitles();
        }

        @Override
        public int getCount() {
            return list.size();
        }

        @Override
        public CharSequence getPageTitle(int position) {
            return pages.get(position);
        }

        @NonNull
        @Override
        public Fragment getItem(int position) {
            return list.get(position);
        }
    }
}
