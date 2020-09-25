package com.socialsportz.Activities.Facility;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.Fragments.BatchSlotAvailFragment;
import com.socialsportz.Activities.Facility.Fragments.BatchSlotBookFragment;
import com.socialsportz.R;
import com.socialsportz.Utils.Toaster;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kStartDate;

public class FacilityBookActivity extends AppCompatActivity implements BatchSlotAvailFragment.BookClickListener, BatchSlotBookFragment.CheckoutClickListener{

    private int facId,sportId;
    private String sDate,FacType="";
    String packageNamee;

    @Override
    public void onAttachFragment(@NonNull Fragment fragment) {
        super.onAttachFragment(fragment);
        if (fragment instanceof BatchSlotAvailFragment) {
            BatchSlotAvailFragment facFragment = (BatchSlotAvailFragment) fragment;
            facFragment.setClickListener(this);
        } else if(fragment instanceof BatchSlotBookFragment) {
            BatchSlotBookFragment facFragment = (BatchSlotBookFragment) fragment;
            facFragment.setClickListener(this);
        }
    }

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_offline_booking);
        facId = getIntent().getIntExtra(kFacId,0);
        sportId = getIntent().getIntExtra(kSportId,0);
        sDate = getIntent().getStringExtra(kStartDate);
		FacType=getIntent().getStringExtra("FacType");
		TextView title = findViewById(R.id.tv_title_toolbar);

		if(FacType.equals("facility")){
			title.setText(getString(R.string.select_slot));
		}else{
			title.setText(getString(R.string.select_batch));
		}


        findViewById(R.id.back_btn).setOnClickListener(view -> {
            Intent returnIntent = new Intent();
            setResult(Activity.RESULT_CANCELED, returnIntent);
            finish();
        });

        loadFragmentAvail();
    }

    public void loadFragmentAvail() {
        FragmentManager fragmentManager = getSupportFragmentManager();
        Fragment fragmentAvail = fragmentManager.findFragmentByTag("frag1");
        if (fragmentAvail == null) {
            Bundle bundle = new Bundle();
            bundle.putInt(kFacId,facId);
            bundle.putInt(kSportId,sportId);
            bundle.putString(kStartDate, sDate);
            fragmentAvail = BatchSlotAvailFragment.newInstance();
            fragmentAvail.setArguments(bundle);
        }
        FragmentTransaction transaction = fragmentManager.beginTransaction();
        transaction.add(R.id.frame_layout, fragmentAvail, "frag1");
        transaction.commit();
    }

    public void loadFragmentBook(String packageName,int facId) {
        // Replace whatever is in the fragment_container view with this fragment,
        // and add the transaction to the back stack so the user can navigate back
        FragmentManager fragmentManager = getSupportFragmentManager();
        Fragment fragmentBook = fragmentManager.findFragmentByTag("frag2");

        if (fragmentBook == null) {
            fragmentBook = new BatchSlotBookFragment(packageName,facId);
        }
        FragmentTransaction transaction = fragmentManager.beginTransaction();
        transaction.replace(R.id.frame_layout, fragmentBook, "frag2");
        transaction.setTransition(FragmentTransaction.TRANSIT_FRAGMENT_OPEN); //setting animation for fragment transaction
        //transaction.addToBackStack(null);
        transaction.commit();
    }

    @Override
    public void bookingClick(String packageName) {
    	packageNamee=packageName;
        loadFragmentBook(packageNamee, facId);
    }

    @Override
    public void checkoutClick() {
        Toaster.customToast("Booking Completed");
        Intent returnIntent = new Intent();
        returnIntent.putExtra("result","done");
        setResult(Activity.RESULT_OK,returnIntent);
        finish();
    }
}
