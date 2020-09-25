package com.socialsportz.Activities.Facility;

import android.annotation.SuppressLint;
import android.app.Dialog;
import android.graphics.Color;
import android.graphics.drawable.Animatable;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ImageView;
import android.widget.TextView;

import com.shuhart.stepview.StepView;
import com.socialsportz.Activities.Facility.Fragments.AddAchievementFragment;
import com.socialsportz.Activities.Facility.Fragments.AddFacilityAcademyFragment;
import com.socialsportz.Activities.Facility.Fragments.AddSportsFragment;
import com.socialsportz.Constants.Constants;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomViewPager;

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;
import java.util.Vector;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;
import androidx.core.content.res.ResourcesCompat;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.viewpager.widget.ViewPager;

import static com.socialsportz.Constants.Constants.kData;

public class FacAcaAddingActivity extends AppCompatActivity implements AddFacilityAcademyFragment.AddFacilityCompleteListener,
        AddAchievementFragment.AddAchievementCompleteListener, AddSportsFragment.AddSportsCompleteListener {

    private CustomViewPager viewPager;
    private MyAdapter viewPagerAdapter;
    private StepView stepView;
    String type;

    private int[] layouts = new int[]{
            R.layout.fragment_add_facility_academy, /*R.layout.fragment_add_achievement,*/ R.layout.fragment_add_sports};
    @Override
    public void onAttachFragment(@NonNull Fragment fragment) {
        super.onAttachFragment(fragment);
        if (fragment instanceof AddFacilityAcademyFragment) {
            AddFacilityAcademyFragment todayFragment = (AddFacilityAcademyFragment) fragment;
            todayFragment.setAddFacilityCompleteListener(this);
        } /*else if(fragment instanceof AddAchievementFragment){
            AddAchievementFragment todayFragment = (AddAchievementFragment) fragment;
            todayFragment.setAddAchievementCompleteListener(this);
        }*/ else if(fragment instanceof AddSportsFragment){
            AddSportsFragment todayFragment = (AddSportsFragment) fragment;
            todayFragment.setAddSportsCompleteListener(this);
        }
    }


    @SuppressLint("ClickableViewAccessibility")
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_fac_aca_adding_view);
        Window window = getWindow();
        window.clearFlags(WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS);
        window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
        window.setStatusBarColor(Color.TRANSPARENT);  // transparent
        window.getDecorView().setSystemUiVisibility(View.SYSTEM_UI_FLAG_LAYOUT_FULLSCREEN | View.SYSTEM_UI_FLAG_LAYOUT_STABLE);

        type = getIntent().getStringExtra(kData);

        stepView = findViewById(R.id.step_view);
        viewPager = findViewById(R.id.view_pager);
        //addBottomDots(0);    // adding bottom dots

        List<Fragment> fragments = new Vector<>();
        fragments.add(Fragment.instantiate(Objects.requireNonNull(this), AddFacilityAcademyFragment.class.getName()));
        //fragments.add(Fragment.instantiate(Objects.requireNonNull(this), AddAchievementFragment.class.getName()));
        fragments.add(Fragment.instantiate(Objects.requireNonNull(this), AddSportsFragment.class.getName()));
        viewPagerAdapter = new MyAdapter(getSupportFragmentManager(),fragments);
        viewPager.setAdapter(viewPagerAdapter);
        viewPager.setOffscreenPageLimit(1);
        viewPager.addOnPageChangeListener(viewPagerPageChangeListener);
        //viewPager.setPageTransformer(true, new RotateUpTransformer());
        viewPager.setPagingEnabled(false);

        boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
        if (tabletSize) {
            setStepView(R.dimen.margin_15dp, R.dimen.text_size_small, R.dimen.text_size_regular);
        } else {
            setStepView(R.dimen.margin_10dp, R.dimen.text_size_ideal, R.dimen.text_size_small);
        }
    }

    private void setStepView(int circleRadius, int textSize, int numberSize) {
        stepView.getState()
                .selectedTextColor(ContextCompat.getColor(this, R.color.white   ))
                .animationType(StepView.ANIMATION_ALL)
                .selectedCircleColor(ContextCompat.getColor(this, R.color.theme_color))
                .selectedCircleRadius(getResources().getDimensionPixelSize(circleRadius))
                .selectedStepNumberColor(ContextCompat.getColor(this, R.color.white))
                .doneCircleColor(ContextCompat.getColor(this, R.color.theme_color))
                .doneTextColor(ContextCompat.getColor(this, R.color.white))
                // You should specify only stepsNumber or steps array of strings.
                // In case you specify both steps array is chosen.
                .steps(new ArrayList<String>() {{
                    if(type.equals(Constants.FacType.facility.toString())) {
                        add("Facility");
                    }else{
                        add("Academy");
                    }
                    //add("Achievement");
                    add("Sports");
                }})
                .stepsNumber(3)
                .animationDuration(getResources().getInteger(android.R.integer.config_shortAnimTime))
                .stepLineWidth(getResources().getDimensionPixelSize(R.dimen.margin_1dp))
                .textSize(getResources().getDimensionPixelSize(textSize))
                .stepNumberTextSize(getResources().getDimensionPixelSize(numberSize))
                .typeface(ResourcesCompat.getFont(this, R.font.roboto_medium))
                // other state methods are equal to the corresponding xml attributes
                .commit();
    }


    public void moveForward(){
        // checking for last page
        // if last page home screen will be launched
        int current = getItem(+1);
        stepView.go(current,true);
        if (current < layouts.length) {
            // move to next screen
            viewPager.setCurrentItem(current);
        } else {
            addedInformationDialog();
        }
    }

    //	viewpager change listener
    ViewPager.OnPageChangeListener viewPagerPageChangeListener =
            new ViewPager.OnPageChangeListener() {
                @Override
                public void onPageSelected(int position) {
                    //addBottomDots(position);
                }

                @Override
                public void onPageScrolled(int arg0, float arg1, int arg2) {
                }

                @Override
                public void onPageScrollStateChanged(int arg0) {
                }
            };

    private int getItem(int i) {
        return viewPager.getCurrentItem() + i;
    }

    private void addedInformationDialog() {
        // dialog
        final Dialog dialog = new Dialog(FacAcaAddingActivity.this);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_added_fac_academy);
        ImageView checkView = dialog.findViewById(R.id.imageView);
        TextView tv_dialog=dialog.findViewById(R.id.tv_dialog);
        ((Animatable) checkView.getDrawable()).start();
        dialog.setCancelable(false);
        dialog.findViewById(R.id.btn_ok).setOnClickListener(v -> {
            dialog.dismiss();
            finish();
        });
        dialog.show();
    }

    @Override
    public void completeAddAchievement(int facId) {
        moveForward();
        AddSportsFragment fragment = (AddSportsFragment) viewPagerAdapter.getItem(viewPager.getCurrentItem());
        fragment.getFacId(facId,type);

    }

    @Override
    public void completeFacility(int facId,String factype) {
        moveForward();
        AddSportsFragment fragment = (AddSportsFragment) viewPagerAdapter.getItem(viewPager.getCurrentItem());
        fragment.getFacId(facId,factype);
        /*AddAchievementFragment fragment=(AddAchievementFragment)viewPagerAdapter.getItem(viewPager.getCurrentItem());
        fragment.getFacId(facId);*/

    }

    @Override
    public void completeAddSport() {
        moveForward();
    }


    /**
     * View pager adapter
     */
    public class MyAdapter extends FragmentPagerAdapter {

        private List<Fragment> mFragments;

        MyAdapter(FragmentManager fm, List<Fragment> fragments) {
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
            if(position==0){
                Bundle bundle = new Bundle();
                bundle.putString(kData,type);
                mFragments.get(0).setArguments(bundle);
            }
            return mFragments.get(position);
        }
    }

    @Override
    public void onBackPressed() {
        finish();
    }

}
