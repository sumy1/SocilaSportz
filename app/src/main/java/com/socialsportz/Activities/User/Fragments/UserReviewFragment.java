package com.socialsportz.Activities.User.Fragments;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;

import com.socialsportz.Activities.User.Adapters.UserReviewAdapterr;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.Models.User.UserReviews;
import com.socialsportz.R;
import com.socialsportz.Utils.VerticalSpaceItemDecoration;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.StaggeredGridLayoutManager;


public class UserReviewFragment extends Fragment {
    private Context context;
    private UserFacAca mUserFacAca;
    private RecyclerView rvUserReview;
    private UserReviewAdapterr userReviewAdapter;
    LinearLayout empty_view;


    public UserReviewFragment(UserFacAca userFacAca) {
        this.mUserFacAca = userFacAca;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }


    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_user_review, container, false);
        context = getActivity();

        rvUserReview = rootView.findViewById(R.id.rv_user_review);
        rvUserReview.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.VERTICAL));
        rvUserReview.addItemDecoration(new VerticalSpaceItemDecoration(10));
		empty_view=rootView.findViewById(R.id.empty_view);
        getUserReviewData();
        return rootView;
    }

    private void getUserReviewData() {
        CopyOnWriteArrayList<UserReviews> userReviewsList ;
        userReviewsList = mUserFacAca.getUserReviewsList();

        if(userReviewsList.isEmpty()){
			empty_view.setVisibility(View.VISIBLE);
			rvUserReview.setVisibility(View.GONE);
		}else{
			empty_view.setVisibility(View.GONE);
			rvUserReview.setVisibility(View.VISIBLE);
			setAchievementData(userReviewsList);
		}


		//Log.d("Size....2",userReviewsList.size()+"");

    }

    private void setAchievementData(CopyOnWriteArrayList<UserReviews> userReviewsList) {

		Log.d("Size",userReviewsList.size()+"");
        userReviewAdapter = new UserReviewAdapterr(context, userReviewsList);
        rvUserReview.setAdapter(userReviewAdapter);
    }
}
