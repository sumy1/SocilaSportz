package com.socialsportz.Activities.Facility.Fragments;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.flyco.tablayout.SegmentTabLayout;
import com.flyco.tablayout.listener.OnTabSelectListener;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomViewPager;

import java.util.List;
import java.util.Objects;
import java.util.Vector;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.viewpager.widget.ViewPager;

public class FragmentOnGoSportsProfile extends Fragment implements FragmentOnGoSports.PageChangeListener,FragmentOnGoSportListing.PageChangeListener {

    private String[] mTitles = {"Sports"," Listing"};
    private SegmentTabLayout mTabLayout;
    private CustomViewPager mViewPager;
    private MyPagerAdapter adapter;
    private SportCompleteListener listener;

    @Override
    public void onAttachFragment(@NonNull Fragment fragment) {
        super.onAttachFragment(fragment);
        if (fragment instanceof FragmentOnGoSports) {
            FragmentOnGoSports todayFragment = (FragmentOnGoSports) fragment;
            todayFragment.setPageChangeListener(this);
        } else if(fragment instanceof FragmentOnGoSportListing){
            FragmentOnGoSportListing todayFragment = (FragmentOnGoSportListing) fragment;
            todayFragment.setPageChangeListener(this);
        }
    }

    public static FragmentOnGoSportsProfile newInstance() {
        return new FragmentOnGoSportsProfile();
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_ongo_sport_profile, container, false);

        mTabLayout = root.findViewById(R.id.segment_tab_layout);
        mTabLayout.setTabData(mTitles);

        mViewPager = root.findViewById( R.id.page_view_pager);
        List<Fragment> fragments = new Vector<>();
        fragments.add(Fragment.instantiate(Objects.requireNonNull(getContext()), FragmentOnGoSports.class.getName()));
        fragments.add(Fragment.instantiate(Objects.requireNonNull(getContext()), FragmentOnGoSportListing.class.getName()));
        adapter = new MyPagerAdapter(getChildFragmentManager(),fragments);
        mViewPager.setAdapter(adapter);
        mViewPager.setOffscreenPageLimit(0);
        mViewPager.addOnPageChangeListener(pageListener);
        mViewPager.setPagingEnabled(false);

        mTabLayout.setOnTabSelectListener(new OnTabSelectListener() {
            @Override
            public void onTabSelect(int position) {
                mViewPager.setCurrentItem(position);
            }

            @Override
            public void onTabReselect(int position) { }
        });

        return root;
    }

    private ViewPager.OnPageChangeListener pageListener = new ViewPager.OnPageChangeListener() {
        @Override
        public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) { }

        @Override
        public void onPageSelected(int position) {
            mTabLayout.setCurrentTab(position);
        }

        @Override
        public void onPageScrollStateChanged(int state) { }
    };

    @Override
    public void setUserVisibleHint(boolean isVisibleToUser) {
        super.setUserVisibleHint(isVisibleToUser);
        //Code executes EVERY TIME user views the fragment
        if (isVisibleToUser && isResumed())
        {
            //Only manually call onResume if fragment is already visible
            //Otherwise allow natural fragment lifecycle
            onResume();
        }
    }

    @Override
    public void onResume() {
        super.onResume();
        if (!getUserVisibleHint()) {
            return;
        }
        ((FragmentOnGoSports) adapter.getItem(0)).getFacData();
    }

    @Override
    public void pageChange() {
        mViewPager.setCurrentItem(1);
        listener.sportComplete();
        //getChildFragmentManager().findFragmentByTag("android:switcher:" + R.id.container + ":" + mViewPager.getCurrentItem());
        //FragmentOnGoSportListing frag = (FragmentOnGoSportListing)adapter.getItem(mViewPager.getCurrentItem());
        //frag.getList();
    }

    @Override
    public void clickListEvent(FacSport facSport) {
        mViewPager.setCurrentItem(0);
        FragmentOnGoSports frag = (FragmentOnGoSports)adapter.getItem(mViewPager.getCurrentItem());
        //getChildFragmentManager().findFragmentByTag("android:switcher:" + R.id.container + ":" + mViewPager.getCurrentItem());
        frag.insertData(facSport);
    }

    @Override
    public void clickSaveEvent() {
     listener.sportForward();
    }

    public class MyPagerAdapter extends FragmentPagerAdapter {

        private List<Fragment> mFragments;

        MyPagerAdapter(FragmentManager fm, List<Fragment> fragments) {
            super(fm);
            mFragments = fragments;
        }

        @Override
        public int getCount() {
            return mFragments.size();
        }

        @NonNull
        @Override
        public Fragment getItem(int position) {
            return mFragments.get(position);
        }
    }

    public void setSportCompleteListener(SportCompleteListener callback) {
        this.listener = callback;
    }

    public interface SportCompleteListener{
        void sportComplete();
        void sportForward();
    }
}
