package com.socialsportz.Activities.User.Fragments;

import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.User.Adapters.UserBookingAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.User.UserEventBooked;
import com.socialsportz.Models.User.UserEventBookedItemList;
import com.socialsportz.R;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.KFilterType;
import static com.socialsportz.Constants.Constants.kUserId;

public class UserEventBookingFragment extends Fragment {

    private Context context;
    private RecyclerView rvList;
    private LinearLayoutManager mLayoutManager;
    private UserBookingAdapter bookingAdapter;
    private ShimmerFrameLayout mShimmerViewContainer;
    private LinearLayout emptyLayout;

    CopyOnWriteArrayList<UserEventBookedItemList>mdata;

    private boolean loading=true;
    private int page;
    private int pageSize;
	DropDownView booking_type_drop;
	String selectioName="";

    public UserEventBookingFragment(){ }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }



    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_user_booking_listt, container, false);
        context = getActivity();
		inItView(rootView);
		getUserFavData();

        return rootView;
    }


    private void inItView(View rootView){
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
		emptyLayout = rootView.findViewById(R.id.empty_vieww);
		mShimmerViewContainer = rootView.findViewById(R.id.shimmer_view_containerr);
		mLayoutManager=new LinearLayoutManager(context,RecyclerView.VERTICAL,false);
		rvList = rootView.findViewById(R.id.rv_booking_listt);
		rvList.setLayoutManager(mLayoutManager);
		rvList.addItemDecoration(new SpaceItemDecoration(20));
		///rvList.addOnScrollListener(onScrollListener);
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
                        //initData(page);
                    }
                }
            }
        }
    };



    private void getUserFavData(){

    	showShimmerView();
        HashMap<String,Object> map = new HashMap<>();
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(KFilterType,selectioName);

        Log.e("send request",map.toString());
        ModelManager.modelManager().userEventBookingListt(map,
                (Constants.Status iStatus, GenericResponse<UserEventBooked> genericResponse) -> {
                   hideShimmerView();
                    try {
                        UserEventBooked dashBoardData = genericResponse.getObject();
                        mdata=dashBoardData.getBookingEventList();

                        Log.d("size",mdata.size()+"");
                        bookingAdapter=new UserBookingAdapter(context, dashBoardData.getBookingEventList(), new UserBookingAdapter.onitemclick() {
							@Override
							public void refresh() {
								getUserFavData();
							}
						});
                        rvList.setAdapter(bookingAdapter);
                    } catch (Exception e){
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




	private void checkEmptyView(){
		try{
			if(bookingAdapter.getItemCount()==0)
				emptyLayout.setVisibility(View.VISIBLE);
			else
				emptyLayout.setVisibility(View.GONE);
		}catch (Exception e){
			e.printStackTrace();
		}
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

}
