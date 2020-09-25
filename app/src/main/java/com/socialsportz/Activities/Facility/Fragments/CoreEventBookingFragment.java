package com.socialsportz.Activities.Facility.Fragments;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.flyco.tablayout.SlidingTabLayout;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.R;
import com.socialsportz.Utils.Utils;

import java.util.ArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.viewpager.widget.ViewPager;


public class CoreEventBookingFragment extends Fragment {

	private ViewPager vp;
	private SlidingTabLayout tabLayout;
	private View view;
	private ArrayList<Fragment> mFragments = new ArrayList<>();
	MyPagerAdapter mAdapter;
	private Context mContext;
	private int facId = 0;
	public CoreEventBookingFragment() {
		// Required empty public constructor
	}




	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		// Inflate the layout for this fragment

		view=inflater.inflate(R.layout.fragment_eventbooking, container, false);
		mContext=getActivity();

		setData();
		//initTabLayout(view);

		return view;

	}



	private void initTabLayout(View view){
		vp = view.findViewById(R.id.vp);
		tabLayout = view.findViewById(R.id.tabLayout);
		tabLayout.setTabSpaceEqual(true);
		addFragments();
		mAdapter = new MyPagerAdapter(getChildFragmentManager(),mFragments);
		vp.setAdapter(mAdapter);
		tabLayout.setViewPager(vp);
		vp.setCurrentItem(0);
		vp.setOffscreenPageLimit(1);
	}

	private void addFragments() {
		mFragments.clear();
		mFragments.add(0, new EventsFragment());
		mFragments.add(1, new EventBookingFragment());


	}




	private class MyPagerAdapter extends FragmentPagerAdapter {
		ArrayList<Fragment> list;
		ArrayList<String> pages;
		MyPagerAdapter(FragmentManager fm, ArrayList<Fragment> list) {
			super(fm);
			this.list = list;
			this.pages = Utils.getEventBookingTitles();
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


	public void setData() {
		CurrentUser currentUser = ModelManager.modelManager().getCurrentUser();
		try {
			facId = currentUser.getSelectedFacId();
			EventsFragment.facidd=facId;
			EventBookingFragment.faciddd=facId;

		} catch (Exception e) {
			e.printStackTrace();
		}
		initTabLayout(view);

	}

	@Override
	public void onAttach(Context context) {
		super.onAttach(context);

	}

	@Override
	public void onDetach() {
		super.onDetach();

	}


}
