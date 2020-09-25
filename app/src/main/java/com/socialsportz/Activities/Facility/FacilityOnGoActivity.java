package com.socialsportz.Activities.Facility;

import android.annotation.SuppressLint;
import android.app.Dialog;
import android.content.Intent;
import android.content.IntentFilter;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.shuhart.stepview.StepView;
import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Activities.Facility.Fragments.FragmentOnGoAmenityProfile;
import com.socialsportz.Activities.Facility.Fragments.FragmentOnGoBankProfile;
import com.socialsportz.Activities.Facility.Fragments.FragmentOnGoFacilityProfile;
import com.socialsportz.Activities.Facility.Fragments.FragmentOnGoSportsProfile;
import com.socialsportz.Activities.Facility.Fragments.FragmentOnGoUserProfile;
import com.socialsportz.ApplicationManager;
import com.socialsportz.Broadcast.ReachableManager;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomViewPager;
import com.socialsportz.Utils.ProgressUtil;

import java.util.ArrayList;
import java.util.Objects;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;
import androidx.core.content.res.ResourcesCompat;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.viewpager.widget.ViewPager;
import jp.wasabeef.picasso.transformations.MaskTransformation;

public class FacilityOnGoActivity extends AppCompatActivity implements View.OnClickListener, ReachableManager.ConnectivityReceiverListener
        , FragmentOnGoUserProfile.ProfileCompleteListener,FragmentOnGoFacilityProfile.FacilityCompleteListener,
        FragmentOnGoSportsProfile.SportCompleteListener,FragmentOnGoAmenityProfile.AmenityCompleteListener,
        FragmentOnGoBankProfile.BankCompleteListener{

    //private static final String TAG = FacilityOnGoActivity.class.getSimpleName();

    private CustomViewPager viewPager;
    private Button btPrev;
    private RelativeLayout inactiveView;
    private StepView stepView;
    private TextView tvSkip;
    private ProgressBar profileBar;
    private TextView tvProgress;
    private int progress;
    private MyAdapter viewPagerAdapter;

    private ReachableManager receiver;
    private RelativeLayout overlayConnectivity;

    private int[] layouts = new int[] {
            R.layout.fragment_ongo_user_profile, R.layout.fragment_ongo_facility_profile, R.layout.fragment_ongo_user_profile,
            R.layout.fragment_ongo_user_profile, R.layout.fragment_ongo_user_profile};

    @Override
    public void onAttachFragment(@NonNull Fragment fragment) {
        super.onAttachFragment(fragment);
        if (fragment instanceof FragmentOnGoUserProfile) {
            FragmentOnGoUserProfile todayFragment = (FragmentOnGoUserProfile) fragment;
            todayFragment.setProfileCompleteListener(this);
        } else if(fragment instanceof FragmentOnGoFacilityProfile){
            FragmentOnGoFacilityProfile todayFragment = (FragmentOnGoFacilityProfile) fragment;
            todayFragment.setFacilityCompleteListener(this);
        } else if(fragment instanceof FragmentOnGoSportsProfile){
            FragmentOnGoSportsProfile todayFragment = (FragmentOnGoSportsProfile) fragment;
            todayFragment.setSportCompleteListener(this);
        } else if(fragment instanceof FragmentOnGoAmenityProfile){
            FragmentOnGoAmenityProfile todayFragment = (FragmentOnGoAmenityProfile) fragment;
            todayFragment.setAmenityCompleteListener(this);
        } else if(fragment instanceof FragmentOnGoBankProfile){
            FragmentOnGoBankProfile todayFragment = (FragmentOnGoBankProfile) fragment;
            todayFragment.setBankCompleteListener(this);
        }
    }

    @SuppressLint("ClickableViewAccessibility")
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ongo_facility);
        Window window = getWindow();
        window.clearFlags(WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS);
        window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
        window.setStatusBarColor(Color.TRANSPARENT);  // transparent
        window.getDecorView().setSystemUiVisibility(View.SYSTEM_UI_FLAG_LAYOUT_FULLSCREEN | View.SYSTEM_UI_FLAG_LAYOUT_STABLE);
        overlayConnectivity = findViewById(R.id.overlay_connectivity);

        profileBar = findViewById(R.id.profileBar);
        tvProgress = findViewById(R.id.tv_progress);
        progress = 15;
        profileBar.setProgress(progress);
        tvProgress.setText(String.valueOf(progress));

        btPrev = findViewById(R.id.btn_prev);
        btPrev.setOnClickListener(this);
        tvSkip = findViewById(R.id.tv_skip);
        tvSkip.setOnClickListener(this);
        inactiveView = findViewById(R.id.inactive_lay);


        stepView = findViewById(R.id.step_view);
        viewPager = findViewById(R.id.view_pager);
        //addBottomDots(0);    // adding bottom dots

        viewPagerAdapter = new MyAdapter(getSupportFragmentManager());
        viewPager.setAdapter(viewPagerAdapter);
        viewPager.addOnPageChangeListener(viewPagerPageChangeListener);
        viewPager.setOffscreenPageLimit(0);
        //viewPager.setPageTransformer(true, new RotateUpTransformer());
        viewPager.setPagingEnabled(false);

        boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
        if (tabletSize) {
            setStepView(R.dimen.margin_20dp, R.dimen.text_size_regular, R.dimen.text_size_large);
        } else {
            setStepView(R.dimen.margin_10dp, R.dimen.text_size_ideal, R.dimen.text_size_small);
        }

        ImageView topImgView = findViewById(R.id.top_img_view);
        final Transformation transformation = new MaskTransformation(this, R.drawable.canvas_top_bar_bg);
        Picasso.with(this).load(R.drawable.top_bg).placeholder(R.drawable.placeholder_300).transform(transformation).into(topImgView);
    }

    @Override
    protected void onResume() {
        super.onResume();
        // register connection status listener
        ApplicationManager.setConnectivityListener(this);
        IntentFilter filter = new IntentFilter("android.net.conn.CONNECTIVITY_CHANGE");
        registerReceiver(receiver, filter);
    }

    private void setStepView(int circleRadius, int textSize, int numberSize){
        stepView.getState()
                .selectedTextColor(ContextCompat.getColor(this, R.color.theme_color))
                .animationType(StepView.ANIMATION_ALL)
                .selectedCircleColor(ContextCompat.getColor(this, R.color.theme_color))
                .selectedCircleRadius(getResources().getDimensionPixelSize(circleRadius))
                .selectedStepNumberColor(ContextCompat.getColor(this, R.color.white))
                .doneCircleColor(ContextCompat.getColor(this, R.color.theme_color))
                .doneTextColor(ContextCompat.getColor(this, R.color.dark_grey))
                // You should specify only stepsNumber or steps array of strings.
                // In case you specify both steps array is chosen.
                .steps(new ArrayList<String>() {{
                    add("Profile");
                    add("Details");
                    add("Sports");
                    add("Amenities");
                    add("Bank Details");
                }})
                .stepsNumber(5)
                .animationDuration(getResources().getInteger(android.R.integer.config_shortAnimTime))
                .stepLineWidth(getResources().getDimensionPixelSize(R.dimen.margin_1dp))
                .textSize(getResources().getDimensionPixelSize(textSize))
                .stepNumberTextSize(getResources().getDimensionPixelSize(numberSize))
                .typeface(ResourcesCompat.getFont(this, R.font.roboto_medium))
                // other state methods are equal to the corresponding xml attributes
                .commit();
    }

    @Override
    public void onClick(View v) {
        if(v.getId()== R.id.btn_prev){
            // checking for last page
            // if last page home screen will be launched
            int current = getItem(-1);
            stepView.go(current,true);
            if (current < layouts.length) {
                // move to next screen
                viewPager.setCurrentItem(current);
            }
        } else if(v.getId()== R.id.tv_skip){
            int current = getItem(1);
            if(current==layouts.length){
                WelcomeDialog();
            }else{
                viewPager.setCurrentItem(layouts.length);
                btPrev.setClickable(false);
                btPrev.setEnabled(false);
                inactiveView.setVisibility(View.VISIBLE);
                for(int i=current;i<=5;i++){
                    stepView.go(i,false);
                }
            }
        }
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
            WelcomeDialog();
        }
    }

    //	viewpager change listener
    ViewPager.OnPageChangeListener viewPagerPageChangeListener =
            new ViewPager.OnPageChangeListener() {
                @Override public void onPageSelected(int position) {
                    //addBottomDots(position);

                    // changing the next button text 'NEXT' / 'GOT IT'
                    if(position == 0){
                        btPrev.setClickable(false);
                        btPrev.setEnabled(false);
                        inactiveView.setVisibility(View.VISIBLE);
                        tvSkip.setVisibility(View.GONE);
                    }
                    /*else if (position == layouts.length - 1) {
                        // last page. make button text to GOT IT
                        btNext.setText("DONE");
                    }*/ else {
                        // still pages are left
                        btPrev.setClickable(true);
                        btPrev.setEnabled(true);
                        tvSkip.setVisibility(View.VISIBLE);
                        inactiveView.setVisibility(View.GONE);
                    }
                }

                @Override public void onPageScrolled(int arg0, float arg1, int arg2) { }

                @Override public void onPageScrollStateChanged(int arg0) { }
            };

    /*private void addBottomDots(int currentPage) {
        TextView[] dots = new TextView[layouts.length];

        int[] colorsActive = getResources().getIntArray(R.array.array_dot_active);
        int[] colorsInactive = getResources().getIntArray(R.array.array_dot_inactive);

        dotsLayout.removeAllViews();
        for (int i = 0; i < dots.length; i++) {
            dots[i] = new TextView(this);
            dots[i].setText(Html.fromHtml("&#8226;"));
            dots[i].setTextSize(35);
            dots[i].setTextColor(colorsInactive[currentPage]);
            dotsLayout.addView(dots[i]);O
        }

        if (dots.length > 0) {
            dots[currentPage].setTextColor(colorsActive[currentPage]);
        }
    }*/

    private int getItem(int i) {
        return viewPager.getCurrentItem() + i;
    }

    private void WelcomeDialog(){
        // dialog
        final Dialog dialog = new Dialog(FacilityOnGoActivity.this);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_welcome_dashboard);
        dialog.setCancelable(false);

        dialog.findViewById(R.id.btn_continue).setOnClickListener(v -> {
            dialog.dismiss();
            Intent in = new Intent(FacilityOnGoActivity.this,FacilityDashboardActivity.class);
            startActivity(in);
            finish();
        });
        dialog.show();
    }

    @Override
    public void amenityComplete() {
        if(Integer.valueOf(tvProgress.getText().toString())<80 && Integer.valueOf(tvProgress.getText().toString())!=80){
            progress = progress + 10;
            profileBar.setProgress(progress);
            tvProgress.setText(String.valueOf(progress));
        }
        moveForward();
    }

    @Override
    public void bankComplete() {
        if(Integer.valueOf(tvProgress.getText().toString())<90 && Integer.valueOf(tvProgress.getText().toString())!=90) {
            progress = progress + 10;
            profileBar.setProgress(progress);
            tvProgress.setText(String.valueOf(progress));
        }
        WelcomeDialog();
    }

    @Override
    public void facilityComplete() {
        if(Integer.valueOf(tvProgress.getText().toString())<50 && Integer.valueOf(tvProgress.getText().toString())!=50) {
            progress = progress + 30;
            profileBar.setProgress(progress);
            tvProgress.setText(String.valueOf(progress));
        }
    }

    @Override
    public void facilityForward() {
        if(Integer.valueOf(tvProgress.getText().toString())<50 && Integer.valueOf(tvProgress.getText().toString())!=50) {
            progress = progress + 30;
            profileBar.setProgress(progress);
            tvProgress.setText(String.valueOf(progress));
        }
        moveForward();
    }

    @Override
    public void sportComplete() {
        if(Integer.valueOf(tvProgress.getText().toString())<70 && Integer.valueOf(tvProgress.getText().toString())!=70) {
            progress = progress + 20;
            profileBar.setProgress(progress);
            tvProgress.setText(String.valueOf(progress));
        }
    }

    @Override
    public void sportForward() {
        if(Integer.valueOf(tvProgress.getText().toString())<70 && Integer.valueOf(tvProgress.getText().toString())!=70) {
            progress = progress + 20;
            profileBar.setProgress(progress);
            tvProgress.setText(String.valueOf(progress));
        }
        moveForward();
    }

    @Override
    public void profileComplete() {
        if(Integer.valueOf(tvProgress.getText().toString())<20){
            progress = progress + 5;
            profileBar.setProgress(progress);
            tvProgress.setText(String.valueOf(progress));
        }
        moveForward();
    }

    @Override
    public void onNetworkConnectionChanged(boolean isConnected) {
        showSnack(isConnected);
    }

    // Showing the status in Snackbar
    private void showSnack(boolean isConnected) {
        if (!isConnected) {
            ProgressUtil.animateView(overlayConnectivity, View.VISIBLE, 1, 200);
        } else {
            ProgressUtil.animateView(overlayConnectivity, View.GONE, 0, 200);
        }
    }

    /**
     * View pager fragment adapter
     */
    public class MyAdapter extends FragmentPagerAdapter
    {
        static final int NUM_ITEMS = 5;
        private Fragment mFragmentAtPos0;

        MyAdapter(FragmentManager fm) {
            super(fm);
        }

        @NonNull
        @Override
        public Fragment getItem(int position)
        {
            switch (position){
                case 0: mFragmentAtPos0 = FragmentOnGoUserProfile.newInstance();
                    break;
                case 1: mFragmentAtPos0 = FragmentOnGoFacilityProfile.newInstance();
                    break;
                case 2: mFragmentAtPos0 = FragmentOnGoSportsProfile.newInstance();
                    break;
                case 3: mFragmentAtPos0 = FragmentOnGoAmenityProfile.newInstance();
                    break;
                case 4: mFragmentAtPos0 = FragmentOnGoBankProfile.newInstance();
                    break;
            }
            return mFragmentAtPos0;
        }

        @Override
        public int getCount() {
            return NUM_ITEMS;
        }

        @Override
        public int getItemPosition(@NonNull Object object) {
            if (object instanceof FragmentOnGoUserProfile && mFragmentAtPos0 instanceof FragmentOnGoAmenityProfile)
                return POSITION_NONE;
            return POSITION_UNCHANGED;
        }
    }
}
