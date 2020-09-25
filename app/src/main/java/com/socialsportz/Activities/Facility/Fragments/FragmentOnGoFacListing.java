package com.socialsportz.Activities.Facility.Fragments;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.ProgressBar;

import com.socialsportz.Activities.Facility.Adapters.FacilityListingAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.FacAchievement;
import com.socialsportz.Models.Owner.Facility;
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

import static com.socialsportz.Constants.Constants.ACHIEVEMENT_RESULT;
import static com.socialsportz.Constants.Constants.EDIT_ACHIEVE_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kDeleteMsg;
import static com.socialsportz.Constants.Constants.kFacAchieve;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kUserId;

public class FragmentOnGoFacListing extends Fragment {

	private static final String TAG = FragmentOnGoFacListing.class.getSimpleName();
	private RecyclerView recyclerView;
	private LinearLayout emptyLayout;
	private Context context;
	private FacilityListingAdapter mAdapter;
	public  PageChangeListener listener;
	private ProgressBar progressBar;
	private Button btContinue;
	private CustomLoaderView loaderView;

	public static FragmentOnGoFacListing newInstance() {
		return new FragmentOnGoFacListing();
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
		boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
		if (tabletSize)
			recyclerView.addItemDecoration(new SpaceItemDecoration(25));
		else
			recyclerView.addItemDecoration(new SpaceItemDecoration(20));

		rootView.findViewById(R.id.btn_save).setOnClickListener(v-> {
			if(mAdapter.getItemCount()==0)
				Toaster.customToast("Please Add facility/Academy");
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
		ModelManager.modelManager().userFacAcademyListing(map,
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Facility>> genericResponse) -> {
				progressBar.setVisibility(View.GONE);
				setButtonActive();
				try {
					CopyOnWriteArrayList<Facility> facilities = genericResponse.getObject();
					if(!facilities.isEmpty()) {
						setListView(facilities);
					}else
						setListView(new CopyOnWriteArrayList<>());
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

	private void setListView(CopyOnWriteArrayList<Facility> list){
		mAdapter = new FacilityListingAdapter(context, list, new FacilityListingAdapter.clickInterface() {
			@Override
			public void onEdit(Facility facility) {
				listener.clickListEvent(facility);
			}

			@Override
			public void onDelete(Facility facility,int pos) {
				Utils.showAlertDialog(getContext(), "Alert", kDeleteMsg, (dialogInterface, i) -> setFacAcaDelete(facility, pos));
			}

			@Override
			public void onAddAchievement(int facId) {
				AddEditAchievement(facId,null);
			}

			@Override
			public void onSeeAchievement(int facId) {
				SeeAllAchievementDialogFragment fragment = new SeeAllAchievementDialogFragment();
				Bundle bdl = new Bundle();
				bdl.putInt(KSCREENWIDTH, 0);
				bdl.putInt(KSCREENHEIGHT, 0);
				bdl.putInt(kFacId,facId);
				fragment.setArguments(bdl);
				fragment.setTargetFragment(FragmentOnGoFacListing.this, EDIT_ACHIEVE_RESULT);
				assert getFragmentManager() != null;
				fragment.show(getFragmentManager(), "Dialog Fragment");
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

	private void AddEditAchievement(int facId, FacAchievement achievement){
		AddAchievementDialogFragment fragment = new AddAchievementDialogFragment();
		Bundle bdl = new Bundle();
		bdl.putInt(KSCREENWIDTH, 0);
		bdl.putInt(KSCREENHEIGHT, 0);
		bdl.putInt(kFacId,facId);
		bdl.putSerializable(kFacAchieve,achievement);
		fragment.setArguments(bdl);
		fragment.setTargetFragment(FragmentOnGoFacListing.this,ACHIEVEMENT_RESULT);
		assert getFragmentManager() != null;
		fragment.show(getFragmentManager(), "Dialog Fragment");
	}

	@Override
	public void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode == EDIT_ACHIEVE_RESULT){
			FacAchievement achievement = (FacAchievement) data.getSerializableExtra(kData);
			assert achievement != null;
			AddEditAchievement(achievement.getFacId(),achievement);
		}
	}

	private void setFacAcaDelete(Facility fac,int pos){
		loaderView.showLoader();
		ModelManager.modelManager().userFacAcaDelete(fac, (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
			loaderView.hideLoader();
			try {
				String msg = genericResponse.getObject();
				Log.e(TAG,msg);
				mAdapter.removeData(fac);
				mAdapter.notifyDataSetChanged();
				Toaster.customToast("Facility/Academy Deleted");
				checkEmptyView();
			} catch (Exception e){
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});
	}

	public void setPageChangeListener(PageChangeListener callback) {
		this.listener = callback;
	}

	public interface PageChangeListener{
		void clickListEvent(Facility facility);
		void clickSaveEvent();
	}
}
