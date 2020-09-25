package com.socialsportz.Activities.Facility.Fragments;

import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;

import com.socialsportz.Activities.Facility.Adapters.FacSportAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacSport;
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

public class SportsListingDialogFragment extends DialogFragment {

    private static final String TAG = SportsListingDialogFragment.class.getSimpleName();
    private int facId;
    private LinearLayout emptyLayout;
    private Context context;
    private CustomLoaderView loaderView;
    private RecyclerView rvSport;
    private FacSportAdapter sportAdapter;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth  = mArgs.getInt(KSCREENWIDTH);
        facId = mArgs.getInt(kData);
        Dialog d = getDialog();
        if (d!=null){
            Objects.requireNonNull(d.getWindow()).setLayout(pWidth-100, pHeight-100);
            d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
            Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
            d.getWindow().setBackgroundDrawable(drawable);
        }
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_dialog_sports_listing, container, false);
        context=getActivity();
        loaderView = CustomLoaderView.initialize(getActivity());
        emptyLayout = view.findViewById(R.id.empty_view);

        rvSport = view.findViewById(R.id.rv_sport);
        rvSport.setLayoutManager(new LinearLayoutManager(context,RecyclerView.VERTICAL,false));
        rvSport.setItemAnimator(new DefaultItemAnimator());
        boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
        if (tabletSize)
            rvSport.addItemDecoration(new SpaceItemDecoration(25));
        else
            rvSport.addItemDecoration(new SpaceItemDecoration(20));
        getList();

        Toolbar toolbar = view.findViewById(R.id.toolbar);
        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());

        return view;
    }

    private void getList(){
        ModelManager.modelManager().userFacSportUpdate(facId,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacSport>> genericResponse) -> {
                    try {
                        CopyOnWriteArrayList<FacSport> facilities = genericResponse.getObject();
                        setListView(facilities);
                    } catch (Exception e){
                        e.printStackTrace();
                        setListView(new CopyOnWriteArrayList<>());
                    }
                }, (Constants.Status iStatus, String message) -> {
                    Toaster.customToast(message);
                    setListView(new CopyOnWriteArrayList<>());
                });
    }

    private void setListView(CopyOnWriteArrayList<FacSport> list){
        sportAdapter = new FacSportAdapter(context, list, new FacSportAdapter.onClickInterface() {
            @Override
            public void onEdit(FacSport facSport) {
                Intent in = Objects.requireNonNull(getActivity()).getIntent();
                in.putExtra(kData, facSport);
                Objects.requireNonNull(getTargetFragment()).onActivityResult(getTargetRequestCode(), Activity.RESULT_OK,in);
                Objects.requireNonNull(getDialog()).dismiss();
            }

            @Override
            public void onDelete(FacSport facSport, int pos) {
                Utils.showAlertDialog(getContext(), "Alert", kDeleteMsg, (dialogInterface, i) -> setFacSportDelete(facSport,pos));
            }
        });
        rvSport.setAdapter(sportAdapter);
        checkEmptyView();
    }

    private void checkEmptyView(){
        if(sportAdapter.getItemCount()==0)
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
                sportAdapter.removeView(facSport);
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
}
