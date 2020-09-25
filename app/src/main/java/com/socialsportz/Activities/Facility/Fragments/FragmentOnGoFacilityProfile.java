package com.socialsportz.Activities.Facility.Fragments;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.flyco.tablayout.SegmentTabLayout;
import com.flyco.tablayout.listener.OnTabSelectListener;
import com.socialsportz.Models.Owner.Facility;
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

public class FragmentOnGoFacilityProfile extends Fragment implements FragmentOnGoFacility.PageChangeListener,FragmentOnGoFacListing.PageChangeListener {

    private String[] mTitles = {"Facility/Academy"," Listing"};
    private SegmentTabLayout mTabLayout;
    private CustomViewPager mViewPager;
    private MyPagerAdapter adapter;
    private FacilityCompleteListener listener;

    @Override
    public void onAttachFragment(@NonNull Fragment fragment) {
        super.onAttachFragment(fragment);
        if (fragment instanceof FragmentOnGoFacility) {
            FragmentOnGoFacility todayFragment = (FragmentOnGoFacility) fragment;
            todayFragment.setPageChangeListener(this);
        } else if(fragment instanceof FragmentOnGoFacListing){
            FragmentOnGoFacListing todayFragment = (FragmentOnGoFacListing) fragment;
            todayFragment.setPageChangeListener(this);
        }
    }

    public static FragmentOnGoFacilityProfile newInstance() {
        return new FragmentOnGoFacilityProfile();
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        //Log.d("DEBUG", "onCreateView");
        View root = inflater.inflate(R.layout.fragment_ongo_facility_profile, container, false);

        mTabLayout = root.findViewById(R.id.segment_tab_layout);
        mTabLayout.setTabData(mTitles);

        mViewPager = root.findViewById( R.id.page_view_pager);
        List<Fragment> fragments = new Vector<>();
        fragments.add(Fragment.instantiate(Objects.requireNonNull(getContext()), FragmentOnGoFacility.class.getName()));
        fragments.add(Fragment.instantiate(Objects.requireNonNull(getContext()), FragmentOnGoFacListing.class.getName()));
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
            if(position!=0){
                FragmentOnGoFacility frag = (FragmentOnGoFacility)adapter.getItem(0);
                frag.type=1;
            }
        }

        @Override
        public void onPageScrollStateChanged(int state) { }
    };

    @Override
    public void pageChange() {
        mViewPager.setCurrentItem(1);
        listener.facilityComplete();
        //getChildFragmentManager().findFragmentByTag("android:switcher:" + R.id.container + ":" + mViewPager.getCurrentItem());
        //FragmentOnGoFacListing frag = (FragmentOnGoFacListing)adapter.getItem(mViewPager.getCurrentItem());
        //frag.getList();
    }

    @Override
    public void clickListEvent(Facility facility) {
        mViewPager.setCurrentItem(0);
        FragmentOnGoFacility frag = (FragmentOnGoFacility)adapter.getItem(mViewPager.getCurrentItem());
        /*FragmentOnGoFacility frag = (FragmentOnGoFacility)getChildFragmentManager()
                .findFragmentByTag("android:switcher:" + R.id.container + ":" + mViewPager.getCurrentItem());*/
        frag.insertData(facility);
    }

    @Override
    public void clickSaveEvent() {
        listener.facilityForward();
    }

    /**
     * View pager adapter
     */
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

    public void setFacilityCompleteListener(FacilityCompleteListener callback) {
        this.listener = callback;
    }

    public interface FacilityCompleteListener{
        void facilityComplete();
        void facilityForward();
    }
}
