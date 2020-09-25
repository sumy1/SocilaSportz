package com.socialsportz.Activities.Facility.Fragments;

import android.app.Activity;
import android.app.Dialog;
import android.content.Intent;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;

import com.socialsportz.Activities.Facility.Adapters.AchievementDetailAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacAchievement;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.DialogFragment;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kDeleteMsg;
import static com.socialsportz.Constants.Constants.kFacId;

public class SeeAllAchievementDialogFragment extends DialogFragment {

    private static final String TAG = SeeAllAchievementDialogFragment.class.getSimpleName();
    private int facId;
    private RecyclerView recyclerView;
    private AchievementDetailAdapter achievementDetailAdapter;
    private LinearLayout emptyLayout;
    private CustomLoaderView loaderView;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth  = mArgs.getInt(KSCREENWIDTH);
        facId = mArgs.getInt(kFacId);
        Dialog d = getDialog();
        if (d!=null){
            Objects.requireNonNull(d.getWindow()).setLayout(pWidth-100, pHeight-100);
            d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
            Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
            d.getWindow().setBackgroundDrawable(drawable);
            //d.getWindow().addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            //d.getWindow().setStatusBarColor(getResources().getColor(R.color.theme_color));
        }
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_dialog_see_all_achievement, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());
        emptyLayout = view.findViewById(R.id.empty_view);

        recyclerView = view.findViewById(R.id.rv);
        LinearLayoutManager layoutManager=new LinearLayoutManager(getActivity(),RecyclerView.VERTICAL,false);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
        if (tabletSize)
            recyclerView.addItemDecoration(new SpaceItemDecoration(25));
        else
            recyclerView.addItemDecoration(new SpaceItemDecoration(20));

        getList();

        Toolbar toolbar = view.findViewById(R.id.toolbar);
        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());

        return view;
    }

    private void getList(){
        ModelManager.modelManager().userFacAchieveListing(facId,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacAchievement>> genericResponse) -> {
                    try {
                        CopyOnWriteArrayList<FacAchievement> achievements = genericResponse.getObject();
                        setListView(achievements);
                    } catch (Exception e){
                        e.printStackTrace();
                        setListView(new CopyOnWriteArrayList<>());
                    }
                }, (Constants.Status iStatus, String message) -> {
                    Toaster.customToast(message);
                    setListView(new CopyOnWriteArrayList<>());
                });
    }


    private void setListView(CopyOnWriteArrayList<FacAchievement> list){
        achievementDetailAdapter = new AchievementDetailAdapter(getActivity(), list, new AchievementDetailAdapter.clickInterface() {
            @Override
            public void onEdit(FacAchievement achievement) {
                Intent in = Objects.requireNonNull(getActivity()).getIntent();
                in.putExtra(kData, achievement);
                Objects.requireNonNull(getTargetFragment()).onActivityResult(getTargetRequestCode(), Activity.RESULT_OK,in);
                Objects.requireNonNull(getDialog()).dismiss();
            }

            @Override
            public void onDelete(FacAchievement achievement, int pos) {
                Utils.showAlertDialog(getContext(), "Alert", kDeleteMsg, (dialogInterface, i) -> setFacAchieveDelete(achievement,pos));
            }
        });
        recyclerView.setAdapter(achievementDetailAdapter);
        checkEmptyView();
    }

    private void setFacAchieveDelete(FacAchievement achievement, int pos){
        loaderView.showLoader();
        ModelManager.modelManager().userFacAchieveDelete(achievement, (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
            loaderView.hideLoader();
            try {
                String msg = genericResponse.getObject();
                Log.e(TAG,msg);
                achievementDetailAdapter.removeData(achievement);
                achievementDetailAdapter.notifyDataSetChanged();
                Toaster.customToast("Achievement Deleted");
                //achievementDetailAdapter.removeData(pos);
                checkEmptyView();
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }

    private void checkEmptyView(){
        if(achievementDetailAdapter.getItemCount()==0)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }

}
