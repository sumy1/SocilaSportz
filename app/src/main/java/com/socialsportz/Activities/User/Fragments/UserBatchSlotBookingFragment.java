package com.socialsportz.Activities.User.Fragments;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.User.Adapters.UserFacilityBookingAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.User.UserEventBookedItemList;
import com.socialsportz.Models.User.UserFacilityAcademyBooked;
import com.socialsportz.R;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.KFilterType;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kOptioOneStartDate;
import static com.socialsportz.Constants.Constants.kOptionOneCharge;
import static com.socialsportz.Constants.Constants.kOptionOneEndday;
import static com.socialsportz.Constants.Constants.kOptionThreeCharge;
import static com.socialsportz.Constants.Constants.kOptionThreeEndDay;
import static com.socialsportz.Constants.Constants.kOptionThreeStartDay;
import static com.socialsportz.Constants.Constants.kOptionTwoCharge;
import static com.socialsportz.Constants.Constants.kOptionTwoStartDay;
import static com.socialsportz.Constants.Constants.kOptiontwoEndday;
import static com.socialsportz.Constants.Constants.kUserId;

public class UserBatchSlotBookingFragment extends Fragment {

	private Context context;
	private RecyclerView rvList;
	private LinearLayoutManager mLayoutManager;
	private UserFacilityBookingAdapter bookingAdapter;
	private ShimmerFrameLayout mShimmerViewContainer;
	private LinearLayout emptyLayout;

	private boolean loading = true;
	private int page;
	private int pageSize;
	CopyOnWriteArrayList<UserEventBookedItemList> mdata;
	DropDownView booking_type_drop;
	String selectioName="";


	//...Cancellation charge..
	String OneStartDay = "", OneEndday = "", OneCharge = "", twoStartDay = "", twoEndday = "", twoCharge = "", threeStartDay = "", threeEndDay = "", threeCharge = "";


	public UserBatchSlotBookingFragment() {
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
	}

	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
		View rootView = inflater.inflate(R.layout.fragment_user_booking_list, container, false);
		context = getActivity();
		inItView(rootView);
		getUserFavData();

		return rootView;
	}


	@Override
	public void onResume() {
		super.onResume();
		getUserFavData();
	}

	private void inItView(View rootView) {
		booking_type_drop = rootView.findViewById(R.id.booking_type_drop);
		ArrayList<DataModel> courts = new ArrayList<>();
		courts.add(new DataModel(1, "Today's Booking"));
		courts.add(new DataModel(2, "Upcoming Booking"));
		courts.add(new DataModel(3, "Past Booking"));
		booking_type_drop.setOptionList(courts);

		booking_type_drop.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
			}

			@Override
			public void onClickDone(int id, String name) {

				if(id==1){
					selectioName="todays";

				}else if(id==2){
					selectioName="upcomming";

				}else if(id==3){
					selectioName="past";

				}else{

				}
				getUserFavData();

			}

			@Override
			public void onDismiss() {
			}
		});


		emptyLayout = rootView.findViewById(R.id.empty_view);
		mShimmerViewContainer = rootView.findViewById(R.id.shimmer_view_container);
		mLayoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		rvList = rootView.findViewById(R.id.rv_booking_list);
		rvList.setLayoutManager(mLayoutManager);
		rvList.addItemDecoration(new SpaceItemDecoration(20));
		///rvList.addOnScrollListener(onScrollListener);
	}


	private void getUserCancellationCharge() {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());

		Log.e("send", parameters.toString());
		ModelManager.modelManager().usergetCancellationCharge(parameters,
			(Constants.Status iStatus, GenericResponse<JSONObject> genericResponse) -> {
				try {
					JSONObject jsonObject = genericResponse.getObject();


					OneStartDay = jsonObject.getString(kOptioOneStartDate);
					OneEndday = jsonObject.getString(kOptionOneEndday);
					OneCharge = jsonObject.getString(kOptionOneCharge);
					twoStartDay = jsonObject.getString(kOptionTwoStartDay);
					twoEndday = jsonObject.getString(kOptiontwoEndday);
					twoCharge = jsonObject.getString(kOptionTwoCharge);
					threeStartDay = jsonObject.getString(kOptionThreeStartDay);
					threeEndDay = jsonObject.getString(kOptionThreeEndDay);
					threeCharge = jsonObject.getString(kOptionThreeCharge);

					Log.d("Cancellation","OneSDay"+".."+OneStartDay+".."+"OneDayEnd"+".."+
						OneEndday+".."+"OneCharge"+".."+OneCharge+".."+"TwoSday"+".."+twoStartDay+".."+
						"twoEndDay"+".."+twoEndday+".."+"twoCharge"+".."+twoCharge+".."+
						"threeSDay"+".."+threeStartDay+".."+"ThreeEndday"+".."+threeEndDay+".."+
						"threeCharge"+".."+threeCharge);

				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));


	}


	private RecyclerView.OnScrollListener onScrollListener = new RecyclerView.OnScrollListener() {
		@Override
		public void onScrollStateChanged(@NonNull RecyclerView recyclerView, int newState) {
			super.onScrollStateChanged(recyclerView, newState);
		}

		@Override
		public void onScrolled(@NonNull RecyclerView recyclerView, int dx, int dy) {
			if (dy > 0) //check for scroll down
			{
				int visibleItemCount = mLayoutManager.getChildCount();
				int totalItemCount = mLayoutManager.getItemCount();
				int firstVisibleItemPosition = mLayoutManager.findFirstVisibleItemPosition();

				if (loading) {
					if ((visibleItemCount + firstVisibleItemPosition) >= totalItemCount
						&& firstVisibleItemPosition >= 0
						&& totalItemCount >= pageSize) {
						loading = false;
						++page;
						//initData(page);
					}
				}
			}
		}
	};


	private void getUserFavData() {
		showShimmerView();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(KFilterType,selectioName);

		Log.e("send request", map.toString());
		ModelManager.modelManager().userFacilityBookingListtt(map,
			(Constants.Status iStatus, GenericResponse<UserFacilityAcademyBooked> genericResponse) -> {
				hideShimmerView();
				try {
					UserFacilityAcademyBooked dashBoardData = genericResponse.getObject();
					//mdata=dashBoardData.getBookingfacilityAcademyList();
					bookingAdapter = new UserFacilityBookingAdapter(context, dashBoardData.getBookingfacilityAcademyList(), new UserFacilityBookingAdapter.onitemclick() {
						@Override
						public void refresh() {
							getUserFavData();
						}
					});
					rvList.setAdapter(bookingAdapter);

					getUserCancellationCharge();
				} catch (Exception e) {
					e.printStackTrace();
				}
				checkEmptyView();
			}, (Constants.Status iStatus, String message) ->
			{
				hideShimmerView();
				Toaster.customToast(message);
				checkEmptyView();
			});

	}


	private void checkEmptyView() {
		try {
			if (bookingAdapter.getItemCount() == 0)
				emptyLayout.setVisibility(View.VISIBLE);
			else
				emptyLayout.setVisibility(View.GONE);
		} catch (Exception e) {
			e.printStackTrace();
		}

	}

	private void showShimmerView() {
		mShimmerViewContainer.setVisibility(View.VISIBLE);
		emptyLayout.setVisibility(View.GONE);
		mShimmerViewContainer.startShimmerAnimation();
		rvList.setVisibility(View.GONE);
	}

	private void hideShimmerView() {
		mShimmerViewContainer.stopShimmerAnimation();
		mShimmerViewContainer.setVisibility(View.GONE);
		rvList.setVisibility(View.VISIBLE);
	}
}
