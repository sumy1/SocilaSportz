package com.socialsportz.Activities.Facility.Fragments;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.Adapters.SportsListingAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kDeleteMsg;
import static com.socialsportz.Constants.Constants.kUserId;

public class FragmentOnGoSportListing extends Fragment {

    private static final String TAG = FragmentOnGoSportListing.class.getSimpleName();
    private RecyclerView recyclerView;
    private LinearLayout emptyLayout;
    private SportsListingAdapter mAdapter;
    private Context context;
    public PageChangeListener listener;
    private ProgressBar progressBar;
    private Button btContinue;
    private CustomLoaderView loaderView;

    public static FragmentOnGoSportListing newInstance() {
        return new FragmentOnGoSportListing();
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle
            savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_ongo_listing, container, false);
        context = getActivity();
        loaderView = CustomLoaderView.initialize(getActivity());
        progressBar = rootView.findViewById(R.id.progress_bar);
        emptyLayout = rootView.findViewById(R.id.empty_view);
        btContinue = rootView.findViewById(R.id.btn_save);

        recyclerView = rootView.findViewById(R.id.rvListing);
        recyclerView.setLayoutManager(new LinearLayoutManager(context,RecyclerView.VERTICAL,false));
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        TextView tvText = rootView.findViewById(R.id.tv_text);
        tvText.setText(getString(R.string.sports_empty));
        boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
        if (tabletSize)
            recyclerView.addItemDecoration(new SpaceItemDecoration(25));
        else
            recyclerView.addItemDecoration(new SpaceItemDecoration(20));

        rootView.findViewById(R.id.btn_save).setOnClickListener(v-> {
            if(mAdapter.getItemCount()==0)
                Toaster.customToast("Please Add Sports");
            else
                listener.clickSaveEvent();
        });
        return rootView;
    }

    @Override
    public void setUserVisibleHint(boolean isVisibleToUser) {
        super.setUserVisibleHint(isVisibleToUser);
        //Code executes EVERY TIME user views the fragment
        if (isVisibleToUser && isResumed()) {
            getList();
        }
    }

    private void getList(){
        progressBar.setVisibility(View.VISIBLE);
        setButtonActive();
        HashMap<String ,Object> map = new HashMap<>();
        map.put(kUserId, String.valueOf(ModelManager.modelManager().getCurrentUser().getUserId()));
        ModelManager.modelManager().userFacSportListing(map,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacSport>> genericResponse) -> {
                    progressBar.setVisibility(View.GONE);
                    setButtonActive();
                    try {
                        CopyOnWriteArrayList<FacSport> sports = genericResponse.getObject();
                        setListView(sports);
                    } catch (Exception e){
                        e.printStackTrace();
                        setListView(new CopyOnWriteArrayList<>());
                    }
                }, (Constants.Status iStatus, String message) -> {
                    progressBar.setVisibility(View.GONE);
                    setButtonActive();
                    Toaster.customToast(message);
                    setListView(new CopyOnWriteArrayList<>());
                });
    }

    private void setButtonActive(){
        if(progressBar.getVisibility()==View.VISIBLE){
            btContinue.setClickable(false);
            btContinue.setFocusable(false);
        }else{
            btContinue.setClickable(true);
            btContinue.setFocusable(true);
        }
    }

    private void setListView(CopyOnWriteArrayList<FacSport> list){
        mAdapter = new SportsListingAdapter(context, list, new SportsListingAdapter.clickInterface() {
            @Override
            public void onEdit(FacSport facSport) {
                listener.clickListEvent(facSport);
            }

            @Override
            public void onDelete(FacSport facSport, int pos) {
                Utils.showAlertDialog(getContext(), "Alert", kDeleteMsg, (dialogInterface, i) -> setFacSportDelete(facSport,pos));
            }
        });
        recyclerView.setAdapter(mAdapter);
        checkEmptyView();
    }

    private void checkEmptyView(){
        if(mAdapter.getItemCount()==0)
            emptyLayout.setVisibility(View.VISIBLE);
        else
            emptyLayout.setVisibility(View.GONE);
    }

    private void setFacSportDelete(FacSport facSport, int pos){
        loaderView.showLoader();
        ModelManager.modelManager().userFacSportDelete(facSport, (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
            loaderView.hideLoader();
            try {
                String msg = genericResponse.getObject();
                Log.e(TAG,msg);
                //mAdapter.removeData(pos);
                mAdapter.removeData(facSport);
                mAdapter.notifyDataSetChanged();
                Toaster.customToast("Sport Deleted");
                checkEmptyView();
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            loaderView.hideLoader();
            Toaster.customToast(message);
        });
    }

    void setPageChangeListener(PageChangeListener callback) {
        this.listener = callback;
    }

    public interface PageChangeListener{
        void clickListEvent(FacSport facSport);
        void clickSaveEvent();
    }
}
