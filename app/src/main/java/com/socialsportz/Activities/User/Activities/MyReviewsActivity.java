package com.socialsportz.Activities.User.Activities;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.LinearLayout;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.User.Adapters.UserReviewAdapter;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.User.UserReview;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kPage;
import static com.socialsportz.Constants.Constants.kUserId;

public class MyReviewsActivity extends AppCompatActivity implements UserReviewAdapter.OnRefreshViewListner {
    private static final String TAG = MyReviewsActivity.class.getSimpleName() ;
    private Context context;
    private RecyclerView rvList;
    private LinearLayoutManager mLayoutManager;
    private UserReviewAdapter userReviewAdapter;
    private ShimmerFrameLayout mShimmerViewContainer;
    private LinearLayout emptyLayout;
    LinearLayout search_toolbar;
    private boolean loading=true;
    private int page;
    private int pageSize;
    private int user_id=0;
    private HashMap<String,Object> map = new HashMap<>();
    CustomLoaderView loaderView;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_reviews2);
        context=this;
        loaderView = CustomLoaderView.initialize(MyReviewsActivity.this);
        inItView();
        setRecyclerView();
        initData(0);


    }



    public void inItView(){

        emptyLayout = findViewById(R.id.empty_view);
        mShimmerViewContainer = findViewById(R.id.shimmer_view_container);
        rvList = findViewById(R.id.rv_myReviews);

        mLayoutManager=new LinearLayoutManager(context,RecyclerView.VERTICAL,false);
        rvList.setLayoutManager(mLayoutManager);
        rvList.addItemDecoration(new SpaceItemDecoration(10));

		findViewById(R.id.ib_back).setOnClickListener(v -> finish());
        
       
    }


    public void initData(int pg){
        try{
            page = pg;
            user_id =  ModelManager.modelManager().getCurrentUser().getUserId();
            getReviewData();
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

    private void getReviewData(){
        if(page==0)
            showShimmerView();
        map.put(kUserId,user_id);
        map.put(kPage,page);
        Log.e(TAG,map.toString());
        ModelManager.modelManager().userReviewList(map,(iStatus, response) -> {
            try {
                hideShimmerView();
                CopyOnWriteArrayList<UserReview> userFacAcaModel = response.getObject();
                if(page!=0){
                    userReviewAdapter.addData(userFacAcaModel);
                    loading = !response.getObject().isEmpty();
                    userReviewAdapter.notifyDataSetChanged();
                }
                else{
                    userReviewAdapter.newData(userFacAcaModel);
                    pageSize = response.getObject().size();
                    userReviewAdapter.notifyDataSetChanged();
                }
                checkEmptyView();
            }catch (Exception e){
                e.printStackTrace();
            }

        },(iStatus, error) -> {

            // ::: Custom Toast
			hideShimmerView();
			//Toaster.customToast(error);
			checkEmptyView();
        });
    }



    private void setRecyclerView(){
        CopyOnWriteArrayList<UserReview> userEnquires = new CopyOnWriteArrayList<>();
        userReviewAdapter = new UserReviewAdapter(context, userEnquires);
        rvList.setAdapter(userReviewAdapter);
        rvList.addOnScrollListener(onScrollListener);
    }

    private void showShimmerView(){
        mShimmerViewContainer.setVisibility(View.VISIBLE);
        emptyLayout.setVisibility(View.GONE);
        mShimmerViewContainer.startShimmerAnimation();
        rvList.setVisibility(View.GONE);
    }

    private void hideShimmerView(){
        mShimmerViewContainer.stopShimmerAnimation();
        mShimmerViewContainer.setVisibility(View.GONE);
        rvList.setVisibility(View.VISIBLE);
    }
    private void checkEmptyView(){
        if(userReviewAdapter.getItemCount()==0)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }

	@Override
	public void refreshView() {
		getReviewData();
	}

   /* @Override
    public void onWindowFocusChanged(boolean hasFocus) {
        super.onWindowFocusChanged(hasFocus);
        getReviewData();
        userReviewAdapter.notifyDataSetChanged();

    }*/




}
