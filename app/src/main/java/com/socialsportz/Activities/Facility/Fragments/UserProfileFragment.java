package com.socialsportz.Activities.Facility.Fragments;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.flyco.tablayout.listener.OnTabSelectListener;
import com.github.clans.fab.FloatingActionMenu;
import com.ogaclejapan.smarttablayout.SmartTabLayout;
import com.socialsportz.Activities.Facility.FacAcaAddingActivity;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.ArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.viewpager.widget.ViewPager;

import static com.socialsportz.Constants.Constants.kData;

public class UserProfileFragment extends Fragment implements OnTabSelectListener, ProfileSummaryFragment.ProfileUpdateListener,ProfileSummaryFragment.profileSummaryItemclick, View.OnClickListener {

    private FloatingActionMenu fam;
    private ArrayList<Fragment> mFragments = new ArrayList<>();
    private int facId;
    private TextView tvName, tvMail, tvMobile, tvStatus,tvEmailVerify;
    private ProgressBar progressBar;
    private ViewPager vp;
    private SmartTabLayout tabLayout_9;
    private CustomLoaderView loaderView;
    private Activity context;
    private OnUpdateListener listener;
    int clickPosition;

    public UserProfileFragment() { }

    @Override
    public void onAttachFragment(@NonNull Fragment fragment) {
        super.onAttachFragment(fragment);
        if (fragment instanceof ProfileSummaryFragment) {
            ProfileSummaryFragment facFragment = (ProfileSummaryFragment) fragment;
            facFragment.setProfileUpdateListener(this);
            facFragment.setProfileitemListener(this);
        }
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.my_profile, container, false);
        context = getActivity();
        loaderView =  CustomLoaderView.initialize(getActivity()) ;

        initView(rootView);
        setData(0);

        return rootView;
    }

    private void initView(View view) {
        vp = view.findViewById(R.id.vp);
        tabLayout_9 = view.findViewById(R.id.tl_9);

        tvName = view.findViewById(R.id.tv_name);
        tvMail = view.findViewById(R.id.tv_mail);
        tvMobile = view.findViewById(R.id.tv_mobile);
        tvStatus = view.findViewById(R.id.tv_status);
        progressBar = view.findViewById(R.id.progress_bar);
        tvEmailVerify = view.findViewById(R.id.tv_email_verify);
        tvEmailVerify.setOnClickListener(this);
        fam = view.findViewById(R.id.fam);
        view.findViewById(R.id.fab1).setOnClickListener(this);
        view.findViewById(R.id.fab2).setOnClickListener(this);
    }

    public void setData(int type){//0 = re-load fragments
        CurrentUser currentUser = ModelManager.modelManager().getCurrentUser();
        try{
            facId=currentUser.getSelectedFacId();
        }catch (Exception e){
            e.printStackTrace();
        }
        tvName.setText(currentUser.getUsername());
        tvMail.setText(currentUser.getEmail());
        tvMobile.setText(currentUser.getPhone());
        if(currentUser.isEmailVerified()){
            tvEmailVerify.setText(context.getResources().getString(R.string.email_verified));
            tvEmailVerify.setTextColor(context.getResources().getColor(R.color.green));
        }else{
            tvEmailVerify.setText(context.getResources().getString(R.string.email_unverified));
            tvEmailVerify.setTextColor(context.getResources().getColor(R.color.red));
        }

        if(type==0){
            addFragments();
            MyPagerAdapter mAdapter = new MyPagerAdapter(getChildFragmentManager(),mFragments);
            vp.setAdapter(mAdapter);

            tabLayout_9.setViewPager(vp);
            vp.setCurrentItem(0);
            vp.setOffscreenPageLimit(1);
            getProfileStatus();
        }
    }

    private void addFragments() {
        mFragments.clear();
        mFragments.add(0, new ProfileSummaryFragment());
        mFragments.add(1, new ProfileFacilityAcademyFragment());
        mFragments.add(2, new ProfileSportFragment());
        mFragments.add(3, new ProfileTimingFragment());
        mFragments.add(4, new ProfileGalleryFragment());
        mFragments.add(5, new ProfileBankFragment());
    }

    @Override
    public void onTabSelect(int position) {
        //Toast.makeText(getActivity(), "onTabSelect&position--->" + position, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onTabReselect(int position) {
        //Toast.makeText(getActivity(), "onTabReselect&position--->" + position, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void profileUpdate() {
        setData(0);
    }

    @Override
    public void profileRealTime() {
        setData(1);
        listener.onUpdate();
    }

    @Override
    public void onClick(View view) {
		if(view.getId()== R.id.fab2){
			fam.toggle(true);
			Intent intent = new Intent(getActivity(), FacAcaAddingActivity.class);
			intent.putExtra(kData, Constants.FacType.facility.toString());
			startActivity(intent);

		} else if(view.getId()== R.id.fab1){
			fam.toggle(true);
			Intent intent = new Intent(getActivity(), FacAcaAddingActivity.class);
			intent.putExtra(kData, Constants.FacType.academy.toString());
			startActivity(intent);

		} else if(view.getId()== R.id.tv_email_verify){
			if(!ModelManager.modelManager().getCurrentUser().isEmailVerified()){
				getEmailVerified();
			}
		}
    }

	@Override
	public void itemClick(int position) {
		clickPosition=position;

		switch (position){
			case 1:
				vp.setCurrentItem(1);
				break;
			case 2:
				vp.setCurrentItem(2);
				break;
			case 3:

				vp.setCurrentItem(3);
				break;
			case 4:
				vp.setCurrentItem(4);

				break;
			case 5:
				vp.setCurrentItem(5);

				break;

		}

		Log.d("Position",position+"");
	}

	private class MyPagerAdapter extends FragmentPagerAdapter {
        ArrayList<Fragment> list;
        ArrayList<String> pages;
        MyPagerAdapter(FragmentManager fm,ArrayList<Fragment> list) {
            super(fm);
            this.list = list;
            this.pages = Utils.getTabTitles();
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

    private void getProfileStatus(){
        ModelManager.modelManager().userProfileStatus(
                (Constants.Status iStatus, GenericResponse<Integer> genericResponse) -> {
                    int progress = genericResponse.getObject();
                    progressBar.setProgress(progress);
                    try{
                        String prog = getString(R.string.profile_is)+" "+progress+"% " +getString(R.string.profile_to);
                        tvStatus.setText(prog);
                    }catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Log.e("user_progress",message));
    }

    private void getEmailVerified(){
        loaderView.showLoader();
        ModelManager.modelManager().userEmailVerification((Constants.Status iStatus) -> {
            loaderView.hideLoader();
            Toaster.customToast("verification link has been send");
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }

    public void setProfileUpdateListener(OnUpdateListener listener){
        this.listener =  listener;
    }

    public interface OnUpdateListener{
        void onUpdate();
    }
}
