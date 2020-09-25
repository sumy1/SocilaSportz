package com.socialsportz.Activities.User.Fragments;

import android.app.Dialog;
import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.User.Adapters.FavFacilityAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kfavrouteId;

public class UserFavoritesFragment extends Fragment {
    private UserDashboardFragment.EventClickListener listener;

    private Context context;
    private RecyclerView rvList;
    private CopyOnWriteArrayList<UserFacAca> mData=new CopyOnWriteArrayList<>();
    TextView tv_fav_count;
    CustomLoaderView loaderView;
    FavFacilityAdapter facilityAdapter;
    TextView tv_fav_clesr;
    Dialog dialog;
	private ShimmerFrameLayout mShimmerViewContainer;
	private LinearLayout emptyLayout;
	RelativeLayout rv_cart, rv_list_top;
    public UserFavoritesFragment(){ }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_user_favorites, container, false);
        context=getActivity();
		/*emptyLayout = rootView.findViewById(R.id.empty_vieww);
		mShimmerViewContainer=rootView.findViewById(R.id.shimmer_view_containerr);*/
        loaderView = CustomLoaderView.initialize(context);

   /*     SportLoadingView loadingView = rootView.findViewById(R.id.loading_circle);
        loadingView.setBackground(context.getResources().getColor(R.color.black_semi_transparent));
        loadingView.startLoading();*/
		rv_cart = rootView.findViewById(R.id.rv_cart);
		rv_list_top = rootView.findViewById(R.id.rv_list_top);
        rvList = rootView.findViewById(R.id.rv_fav_list);
        rvList.setLayoutManager(new LinearLayoutManager(context, RecyclerView.VERTICAL,false));
        rvList.addItemDecoration(new SpaceItemDecoration(20));
        tv_fav_count=rootView.findViewById(R.id.tv_fav_count);

        tv_fav_clesr=rootView.findViewById(R.id.tv_fav_clesr);
/*
        setFacilityData();
*/
        getUserFavData();

        tv_fav_clesr.setOnClickListener(v->{

        	if(mData.size()==0){

			}else{
				reviewDialogg(String.valueOf(ModelManager.modelManager().getCurrentUser().getUserId()));
			}



        });
        return rootView;
    }


	@Override
	public void onResume() {
		super.onResume();

		getUserFavDataa();
	}

	private void getUserFavData(){
		loaderView.showLoader();
        HashMap<String,Object> map = new HashMap<>();
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());

        Log.e("send request",map.toString());
        ModelManager.modelManager().userFavourite(map,(iStatus, response) -> {
			loaderView.hideLoader();
        	try {
				mData = response.getObject();

				if(mData.size()==0){
					rv_list_top.setVisibility(View.GONE);
					rv_cart.setVisibility(View.VISIBLE);
				}else{

					facilityAdapter=new FavFacilityAdapter(context, mData, new FavFacilityAdapter.ItemClickListener() {
						@Override
						public void buttonPress(String fav_id, int pos,String fac) {
							reviewDialog(fav_id,pos,fac);
						}
					});

					rvList.setAdapter(facilityAdapter);
					tv_fav_count.setText(String.valueOf(mData.size())+" "+"Favorites");
				}

               // mData=new CopyOnWriteArrayList<>();


                Log.d("size",mData.size()+"");

				//checkEmptyView();
            }catch (Exception e){
                e.printStackTrace();
            }

        },(iStatus, error) -> {
            // ::: Custom Toast
			loaderView.hideLoader();
			rv_list_top.setVisibility(View.GONE);
			rv_cart.setVisibility(View.VISIBLE);
        });
}

	private void getUserFavDataa(){
		//loaderView.showLoader();
		HashMap<String,Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());

		Log.e("send request",map.toString());
		ModelManager.modelManager().userFavourite(map,(iStatus, response) -> {
			//loaderView.hideLoader();
			try {
				mData = response.getObject();

				if(mData.size()==0){
					rv_list_top.setVisibility(View.GONE);
					rv_cart.setVisibility(View.VISIBLE);
				}else{

					facilityAdapter=new FavFacilityAdapter(context, mData, new FavFacilityAdapter.ItemClickListener() {
						@Override
						public void buttonPress(String fav_id, int pos,String fac) {
							reviewDialog(fav_id,pos,fac);
						}
					});

					rvList.setAdapter(facilityAdapter);
					tv_fav_count.setText(String.valueOf(mData.size())+" "+"Favorites");
				}

				// mData=new CopyOnWriteArrayList<>();


				Log.d("size",mData.size()+"");

				//checkEmptyView();
			}catch (Exception e){
				e.printStackTrace();
			}

		},(iStatus, error) -> {
			// ::: Custom Toast
			//loaderView.hideLoader();
			tv_fav_count.setText(0+" "+"Favorites");
			rv_list_top.setVisibility(View.GONE);
			rv_cart.setVisibility(View.VISIBLE);
		});
	}


    private void getdeleteItemfav(String  cart_id,int pos,String facType) {
        loaderView.showLoader();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kfavrouteId, cart_id);
        Log.e("send carat", map.toString());

        ModelManager.modelManager().userSendFavAll(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();

				try {
					String msg = genericResponse.getObject();

					if(facType.equalsIgnoreCase("facility")){
						Toaster.customToast("Facility removed from favorites");
					}else{
						Toaster.customToast("Academy removed from favorites");
					}



					if(mData.size()>0){
						mData.remove(pos);
						facilityAdapter.notifyDataSetChanged();
						tv_fav_count.setText(String.valueOf(mData.size())+" "+"Favorites");
						//Toaster.customToast("Favourite Delete Sucessfully");

						if(mData.size()==0){
							rv_list_top.setVisibility(View.GONE);
							rv_cart.setVisibility(View.VISIBLE);
						}
					}
				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				rv_list_top.setVisibility(View.GONE);
				rv_cart.setVisibility(View.VISIBLE);
				Toaster.customToast(message);
			});





		/*	(map, new Block.Status() {
            @Override
            public void iStatus(Constants.Status iStatus) {
                loaderView.hideLoader();

                if(mData.size()>0){
                    mData.remove(pos);
                    facilityAdapter.notifyDataSetChanged();
					tv_fav_count.setText(String.valueOf(mData.size())+" "+"Favorites");
                    Toaster.customToast("Favourite Delete Sucessfully");

					if(mData.size()==0){
						rv_list_top.setVisibility(View.GONE);
						rv_cart.setVisibility(View.VISIBLE);
					}
                }

            }
        }, new Block.Failure() {
            @Override
            public void iFailure(Constants.Status iStatus, String error) {
                loaderView.hideLoader();
				rv_list_top.setVisibility(View.GONE);
				rv_cart.setVisibility(View.VISIBLE);
                Toaster.customToast("Something went wrong");
            }
        });*/


    }


    private void getdeletetListfav(String  cart_id) {
        loaderView.showLoader();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kUserId, cart_id);
        Log.e("send carat", map.toString());

        ModelManager.modelManager().userSendFav(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();

				try {
					String msg = genericResponse.getObject();
					Toaster.customToast("Favorites list cleared successfully");
					facilityAdapter.notifyDataSetChanged();
					tv_fav_count.setText(String.valueOf(mData.size())+" "+"Favorites");
					//Toaster.customToast("Favourite Delete Sucessfully");
					rv_list_top.setVisibility(View.GONE);
					rv_cart.setVisibility(View.VISIBLE);
				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				rv_list_top.setVisibility(View.GONE);
				rv_cart.setVisibility(View.VISIBLE);
				Toaster.customToast(message);
			});









			/*(map, new Block.Status() {
            @Override
            public void iStatus(Constants.Status iStatus) {
                loaderView.hideLoader();

				facilityAdapter.notifyDataSetChanged();
				tv_fav_count.setText(String.valueOf(mData.size())+" "+"Favorites");
				Toaster.customToast("Favourite Delete Sucessfully");
				rv_list_top.setVisibility(View.GONE);
				rv_cart.setVisibility(View.VISIBLE);

             *//*   if(mData.size()>0){
                    //mData.clear();
                    mData.removeAll(mData);
                    facilityAdapter.notifyDataSetChanged();
					tv_fav_count.setText(String.valueOf(mData.size())+" "+"Favorites");
                    Toaster.customToast("Favourite Delete Sucessfully");
					if(mData.size()==0){
						rv_list_top.setVisibility(View.GONE);
						rv_cart.setVisibility(View.VISIBLE);
					}

                }*//*

            }
        }, new Block.Failure() {
            @Override
            public void iFailure(Constants.Status iStatus, String error) {
                loaderView.hideLoader();
				rv_list_top.setVisibility(View.GONE);
				rv_cart.setVisibility(View.VISIBLE);
                Toaster.customToast("Something went wrong");
            }
        });*/


    }

    private void reviewDialog(String cart_id,int pos,String facType) {
        // dialog
        dialog = new Dialog(context);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_alert);

        dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

        dialog.findViewById(R.id.btn_remove).setOnClickListener(v->{
            dialog.dismiss();
            getdeleteItemfav(cart_id,pos,facType);});

        dialog.findViewById(R.id.btn_cancel).setOnClickListener(v->{dialog.dismiss();});

        dialog.show();
    }


    private void reviewDialogg(String user_id) {
        // dialog
        dialog = new Dialog(context);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_alert);

        dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

        dialog.findViewById(R.id.btn_remove).setOnClickListener(v->{
            dialog.dismiss();

            if(mData.size()>0){
                mData.clear();
                mData.removeAll(mData);
                facilityAdapter.notifyDataSetChanged();
                //Toaster.customToast("Favourite Delete Sucessfully");
            }
            getdeletetListfav(user_id);});

        dialog.findViewById(R.id.btn_cancel).setOnClickListener(v->{dialog.dismiss();});

        dialog.show();
    }


	/*private void showShimmerView(){
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
		if(facilityAdapter.getItemCount()==0)
			emptyLayout.setVisibility(View.VISIBLE);
		else
			emptyLayout.setVisibility(View.GONE);
	}*/
}
