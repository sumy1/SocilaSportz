package com.socialsportz.Activities.User.Fragments;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;

import com.socialsportz.Activities.User.Adapters.UserFacAchievementsAdapter;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.Models.User.UserFacAchievements;
import com.socialsportz.R;
import com.socialsportz.Utils.HorizontalSpaceItemDecoration;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.StaggeredGridLayoutManager;

public class AchievementFragment extends Fragment {

    private Context context;
    private UserFacAca userFacAca;
    private RecyclerView rvAchievement;
    private UserFacAchievementsAdapter achievementsAdapter;
	LinearLayout empty_view;


    public AchievementFragment(UserFacAca userFacAca) {
        this.userFacAca = userFacAca;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }


    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_achievement, container, false);
        context = getActivity();

        rvAchievement = rootView.findViewById(R.id.rv_achievement);
        rvAchievement.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL));
        rvAchievement.addItemDecoration(new HorizontalSpaceItemDecoration(10));
		empty_view=rootView.findViewById(R.id.empty_view);
        getAchievementData();
        return rootView;
    }

    private void getAchievementData() {
        CopyOnWriteArrayList<UserFacAchievements> achie ;
        achie = userFacAca.getAchieveList();


		if(achie.isEmpty()){
			empty_view.setVisibility(View.VISIBLE);
			rvAchievement.setVisibility(View.GONE);
		}else{
			empty_view.setVisibility(View.GONE);
			rvAchievement.setVisibility(View.VISIBLE);
			setAchievementData(achie);
		}

    }

    private void setAchievementData(CopyOnWriteArrayList<UserFacAchievements> achieList) {
        achievementsAdapter = new UserFacAchievementsAdapter(context, achieList);
        rvAchievement.setAdapter(achievementsAdapter);
    }

}



