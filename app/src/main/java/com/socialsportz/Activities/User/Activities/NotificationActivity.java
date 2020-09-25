package com.socialsportz.Activities.User.Activities;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.LinearLayout;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.User.Adapters.UserNotificationAdapter;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.User.UserNotification;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kUserId;

public class NotificationActivity extends AppCompatActivity {

    private static final String TAG = NotificationActivity.class.getSimpleName() ;
    private Context context;
    private RecyclerView rv_notification;
    private LinearLayoutManager mLayoutManager;
    private UserNotificationAdapter userNotificationAdapter;
    private ShimmerFrameLayout mShimmerViewContainer;
    private LinearLayout emptyLayout;

    private CopyOnWriteArrayList<UserNotification>mdata;
    LinearLayout search_toolbar;
    CustomLoaderView loaderView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notification);
        loaderView = CustomLoaderView.initialize(NotificationActivity.this);
        context=this;

		inItView();
		setRecyclerView();
        getNotificationData();

    }


	public void inItView(){
		emptyLayout = findViewById(R.id.empty_view);
		mShimmerViewContainer = findViewById(R.id.shimmer_view_container);
		rv_notification = findViewById(R.id.rv_notification);

		mLayoutManager=new LinearLayoutManager(context,RecyclerView.VERTICAL,false);
		rv_notification.setLayoutManager(mLayoutManager);
		rv_notification.addItemDecoration(new SpaceItemDecoration(10));

		findViewById(R.id.ib_back).setOnClickListener(v -> finish());
	}

	private void setRecyclerView(){
		CopyOnWriteArrayList<UserNotification> userEnquires = new CopyOnWriteArrayList<>();
		userNotificationAdapter = new UserNotificationAdapter(context, userEnquires);
		rv_notification.setAdapter(userNotificationAdapter);
	}



    private void getNotificationData(){
        showShimmerView();
        HashMap<String,Object> map = new HashMap<>();
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        Log.e(TAG,map.toString());
        ModelManager.modelManager().userNotification(map,(iStatus, response) -> {
            try {
                hideShimmerView();
                CopyOnWriteArrayList<UserNotification> userFacAcaModel = response.getObject();
				userNotificationAdapter.newData(userFacAcaModel);
                checkEmptyView();
            }catch (Exception e){
                e.printStackTrace();
            }

        },(iStatus, error) -> {
            loaderView.hideLoader();
            // ::: Custom Toast
			hideShimmerView();
			//Toaster.customToast(error);
			checkEmptyView();
        });
    }

    private void setNotificationData(CopyOnWriteArrayList<UserNotification> userReviewsList) {
        userNotificationAdapter = new UserNotificationAdapter(context, userReviewsList);
        rv_notification.setAdapter(userNotificationAdapter);
    }


    private void showShimmerView(){
        mShimmerViewContainer.setVisibility(View.VISIBLE);
        emptyLayout.setVisibility(View.GONE);
        mShimmerViewContainer.startShimmerAnimation();
        rv_notification.setVisibility(View.GONE);
    }

    private void hideShimmerView(){
        mShimmerViewContainer.stopShimmerAnimation();
        mShimmerViewContainer.setVisibility(View.GONE);
        rv_notification.setVisibility(View.VISIBLE);
    }
    private void checkEmptyView(){
        if(userNotificationAdapter.getItemCount()==0)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }
}
