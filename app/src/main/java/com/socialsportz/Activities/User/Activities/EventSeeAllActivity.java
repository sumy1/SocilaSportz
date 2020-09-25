package com.socialsportz.Activities.User.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.User.Adapters.EventSeeAllAdapter;
import com.socialsportz.Activities.User.Adapters.EventSeeAllList;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.User.EventListing;
import com.socialsportz.Models.User.UserNotification;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import static com.socialsportz.Constants.Constants.kType;

public class EventSeeAllActivity extends AppCompatActivity {

	private static final String TAG =NotificationActivity.class.getSimpleName() ;
	private Context context;
	private RecyclerView rv_myEnquire;
	private LinearLayoutManager mLayoutManager;
	private EventSeeAllAdapter userNotificationAdapter;
	private ShimmerFrameLayout mShimmerViewContainer;
	private LinearLayout emptyLayout;

	private CopyOnWriteArrayList<UserNotification> mdata;
	LinearLayout search_toolbar;
	CustomLoaderView loaderView;

	private boolean loading=true;
	private int page;
	private int pageSize;
	private int user_id=0;
	private HashMap<String,Object> map = new HashMap<>();
	TextView tv_page_title;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_event_see_all);

		context=this;

		inItView();
		getSearchListing();

		///initData(0);
	}


	public void inItView(){
		tv_page_title=findViewById(R.id.tv_page_title);
		tv_page_title.setText("Event");
		emptyLayout = findViewById(R.id.empty_view);
		mShimmerViewContainer = findViewById(R.id.shimmer_view_container);
		rv_myEnquire = findViewById(R.id.rv_myEnquire);

		mLayoutManager=new LinearLayoutManager(context, RecyclerView.VERTICAL,false);
		rv_myEnquire.setLayoutManager(mLayoutManager);
		rv_myEnquire.addItemDecoration(new SpaceItemDecoration(10));

		findViewById(R.id.ib_back).setOnClickListener(v -> finish());
	}

	private void getSearchListing() {
		showShimmerView();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kType, "event");

		Log.e(TAG, map.toString());
		ModelManager.modelManager().userEventSeeAllList(map,
			(Constants.Status iStatus, GenericResponse<EventSeeAllList> genericResponse) -> {
				hideShimmerView();
				try {
					//loaderView.hideLoader();
					EventSeeAllList dashBoardData = genericResponse.getObject();

					setRecyclerView(dashBoardData.getEventListing());
					//userNotificationAdapter.addData(dashBoardData.getFacilities());

				} catch (Exception e) {
					e.printStackTrace();
				}
				checkEmptyView();
			}, (Constants.Status iStatus, String message) -> {
				hideShimmerView();
				//Toaster.customToast(message);
				checkEmptyView();
			});
	}


	/*public void initData(int pg){
		try{
			page = pg;
			user_id =  ModelManager.modelManager().getCurrentUser().getUserId();
			getEnquireData();
		}catch (Exception e){
			e.printStackTrace();
		}
	}


	private RecyclerView.OnScrollListener onScrollListener = new RecyclerView.OnScrollListener() {
		@Override
		public void onScrollStateChanged(@NonNull RecyclerView recyclerView, int newState) {
			super.onScrollStateChanged(recyclerView, newState);
		}

		@Override
		public void onScrolled(@NonNull RecyclerView recyclerView, int dx, int dy) {
			if(dy > 0) //check for scroll down
			{
				int visibleItemCount = mLayoutManager.getChildCount();
				int totalItemCount = mLayoutManager.getItemCount();
				int firstVisibleItemPosition = mLayoutManager.findFirstVisibleItemPosition();

				if (loading)
				{
					if ( (visibleItemCount + firstVisibleItemPosition) >= totalItemCount
						&& firstVisibleItemPosition >= 0
						&& totalItemCount >= pageSize) {
						loading = false;
						++page;
						initData(page);
					}
				}
			}
		}
	};

	private void getEnquireData(){
		if(page==0)
			showShimmerView();
		map.put(kUserId,user_id);
		map.put(kPage,page);
		Log.e(TAG,map.toString());
		ModelManager.modelManager().userEnquire(map,(iStatus, response) -> {
			try {
				hideShimmerView();
				CopyOnWriteArrayList<UserEnquire> userFacAcaModel = response.getObject();
				if(page!=0){
					userNotificationAdapter.addData(userFacAcaModel);
					loading = !response.getObject().isEmpty();
				}
				else{
					userNotificationAdapter.newData(userFacAcaModel);
					pageSize = response.getObject().size();
				}
				checkEmptyView();
			}catch (Exception e){
				e.printStackTrace();
			}

		},(iStatus, error) -> {
			loaderView.hideLoader();
			// ::: Custom Toast
			hideShimmerView();
			Toaster.customToast(error);
			checkEmptyView();
		});
	}*/


	private void setRecyclerView(CopyOnWriteArrayList<EventListing> userReviewsData){
		userNotificationAdapter = new EventSeeAllAdapter(context, userReviewsData);
		rv_myEnquire.setAdapter(userNotificationAdapter);
		//rv_myEnquire.addOnScrollListener(onScrollListener);
	}

	private void showShimmerView(){
		mShimmerViewContainer.setVisibility(View.VISIBLE);
		emptyLayout.setVisibility(View.GONE);
		mShimmerViewContainer.startShimmerAnimation();
		rv_myEnquire.setVisibility(View.GONE);
	}

	private void hideShimmerView(){
		mShimmerViewContainer.stopShimmerAnimation();
		mShimmerViewContainer.setVisibility(View.GONE);
		rv_myEnquire.setVisibility(View.VISIBLE);
	}
	private void checkEmptyView(){
		try{
			if (userNotificationAdapter.getItemCount() == 0)
				emptyLayout.setVisibility(View.VISIBLE);
			else
				emptyLayout.setVisibility(View.GONE);
		}catch (Exception e){
			e.printStackTrace();
		}
	}
}
