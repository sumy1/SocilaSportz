package com.socialsportz.Activities.User.Activities;

import android.Manifest;
import android.annotation.TargetApi;
import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.graphics.drawable.Drawable;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.MotionEvent;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.material.tabs.TabLayout;
import com.socialsportz.Activities.User.Adapters.UserReviewAdapterr;
import com.socialsportz.Models.User.UserReviews;
import com.squareup.picasso.Picasso;
import com.socialsportz.Activities.User.Adapters.DashFacilityAdapter;
import com.socialsportz.Activities.User.Adapters.FacilityAmenityAdapter;
import com.socialsportz.Activities.User.Adapters.FacilitySportAdapter;
import com.socialsportz.Activities.User.Adapters.TabLayoutAdapter;
import com.socialsportz.Activities.User.Adapters.TimeAdapter;
import com.socialsportz.Activities.User.Adapters.ViewGallaryAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.FavModelChecked;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.Models.User.UserFacTimings;
import com.socialsportz.Models.User.UserFacViewGallery;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.HorizontalSpaceItemDecoration;
import com.socialsportz.Utils.NestedViewPager;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.VerticalSpaceItemDecoration;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.cardview.widget.CardView;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.StaggeredGridLayoutManager;

import static com.socialsportz.Constants.Constants.kEnquireMessage;
import static com.socialsportz.Constants.Constants.kEnquiryTitle;
import static com.socialsportz.Constants.Constants.kEventId;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kfavrouteId;

public class AcademyDetailActivity extends AppCompatActivity implements DashFacilityAdapter.onItemClickListener,OnMapReadyCallback {
    private static final String TAG = AcademyDetailActivity.class.getSimpleName();
    private Intent i;
    private TabLayout tabLayout;
    private NestedViewPager viewPager;
    private RecyclerView rvList,rvSports,rvAmenity,rv_view_gallery;
    private FacilitySportAdapter sportAdapter;
    private FacilityAmenityAdapter amenityAdapter;
    private ViewGallaryAdapter viewGallaryAdapter;
    private CopyOnWriteArrayList<Sport> mData;
	private UserReviewAdapterr userReviewAdapter;
    UserFacAca userFacAca;
    TextView tv_field,tv_venue, tv_fac_description,tv_rating, tv_review  ;
//    ImageView img_banner ;
    ImageView img_banner;
    CheckBox ch_favorite ;
    Button btn_enquiry;

	RelativeLayout bt_getDirection, bt_gallery, btn_sport, btn_amenities, bt_timing;
	ImageView img_arrow_direc, img_arrow_gallary, img_arrow_timing, img_arrow_sport, img_arrow_amenities, img_arrow_direc_invisibale, img_arrow_gallary_invisibale, img_arrow_timing_invisibale, img_arrow_sport_invisibale, img_arrow_amenities_invisibale;

    LinearLayout layout_map;
    SupportMapFragment mapFragment;
    private GoogleMap mMap;
    CopyOnWriteArrayList<Sport> sports;
    ArrayList<Sport>sports_list;

    Context context;
    CopyOnWriteArrayList<UserFacViewGallery> gallery;
    String fac_type;
    String SportName="",SportId,fac_count;

	TextView tv_sportAdedd,tv_g,tv_a;
	LinearLayout ll_rating,ll_gallery,ll_sport,ll_amenities;
    //..new code here..

    private CustomLoaderView loaderView;
    TextView tv_alert_message;
     Dialog dialog;
    Sport sport;
    int fav_id;
	private static final int LOCATION_REQUEST_CODE = 101;
	CardView review_layout;


    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_academy_detail);
        context=this;
        loaderView = CustomLoaderView.initialize(this);
        ///.........Bundle Get herebundleUserFac

        if(getIntent()!=null){


            if(getIntent().getStringExtra("FROM").equalsIgnoreCase("1")){
                userFacAca=(UserFacAca) getIntent().getSerializableExtra("bundleUserFac");
				fac_count= String.valueOf(userFacAca.getIsFav());

				if(userFacAca.getFavouriteId().equalsIgnoreCase("")){

				}else{
					fav_id= Integer.parseInt(userFacAca.getFavouriteId());
				}


				Log.d("favId",fav_id+"");

                if(getIntent().getStringExtra("TYPE").isEmpty()){

                }else{
                    fac_type=getIntent().getStringExtra("TYPE");

                    Log.d("facetype",fac_type);
                }
            }else if(getIntent().getStringExtra("FROM").equalsIgnoreCase("2")){
                userFacAca=(UserFacAca) getIntent().getSerializableExtra("bundleUserFac");
				fac_count= String.valueOf(userFacAca.getIsFav());
				if(userFacAca.getFavouriteId().equalsIgnoreCase("")){

				}else{
					fav_id= Integer.parseInt(userFacAca.getFavouriteId());
				}

				Log.d("favId",fav_id+"");
                if(getIntent().getStringExtra("TYPE").isEmpty()){

                }else{
                    fac_type=getIntent().getStringExtra("TYPE");

                    Log.d("facetype",fac_type);
                }
                SportName=getIntent().getStringExtra("SPORTNAME");
                SportId=getIntent().getStringExtra("SPORTID");

                Log.d("id",SportName+"/"+SportId);

				Log.d("iddd",SportName+"/"+SportId+fac_count);

            }

        }


        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
        setStatusBarGradient(AcademyDetailActivity.this);

        Toolbar toolbar = findViewById(R.id.detail_toolbar);
        setSupportActionBar(toolbar);
        Objects.requireNonNull(getSupportActionBar()).setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        tabLayout = findViewById(R.id.tabLayout);
        viewPager = findViewById(R.id.viewPager);

        /*toolbar.setNavigationIcon(getResources().getDrawable(R.drawable.));
        toolbar.setNavigationOnClickListener(v -> {
            //What to do on back clicked
        });*/

        initData();

        rvList = findViewById(R.id.rv_timing);
        rvList.setLayoutManager(new LinearLayoutManager(this,RecyclerView.VERTICAL,false));
        rvList.addItemDecoration(new VerticalSpaceItemDecoration(5));
		getTiming();
		tv_sportAdedd=findViewById(R.id.tv_sportAdedd);
        rvSports=findViewById(R.id.rv_sports);
        rvSports.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL ));
        //rvSports.addItemDecoration(new HorizontalSpaceItemDecoration(5));
        getSportData();
		tv_a=findViewById(R.id.tv_a);
        rvAmenity=findViewById(R.id.rv_amenity);
        rvAmenity.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL ));
        //rvAmenity.addItemDecoration(new HorizontalSpaceItemDecoration(5));
        getAmenityData();
		tv_g=findViewById(R.id.tv_g);
        rv_view_gallery = findViewById(R.id.rv_view_gallery);
        rv_view_gallery.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.HORIZONTAL ));
        rv_view_gallery.addItemDecoration(new HorizontalSpaceItemDecoration(10));
		rv_view_gallery.setHasFixedSize(true);
        getGalleryData();
        initViews();





        findViewById(R.id.fab).setOnClickListener(v -> {
            Intent in = new Intent(AcademyDetailActivity.this, UserCalaenderBookingActivity.class);
            in.putExtra("Sports",sports_list);
            in.putExtra("Id",userFacAca.getFacId());
            in.putExtra("TYPE",fac_type);
            in.putExtra("SPORTNAME",SportName);
            in.putExtra("SPORTID",SportId);
            in.putExtra("FACNAME",userFacAca.getFacName());

            Log.d("1",sports_list+"/"+userFacAca.getFacId()+"/"+fac_type+"/"+SportName+"/"+SportId+userFacAca.getFacName());
            startActivity(in);
            //finish();
        });
    }


    public void initViews(){
        tv_field = findViewById(R.id.tv_field);
        tv_field.setText(userFacAca.getFacName());

        tv_venue = findViewById(R.id.tv_venue);
        tv_venue.setText(userFacAca.getFacGoogleAdd());

        tv_fac_description = findViewById(R.id.tv_fac_description);
        tv_fac_description.setText(userFacAca.getFacDesc());
		tv_rating = findViewById(R.id.tv_rating);

		tv_review = findViewById(R.id.tv_review);
		ll_rating=findViewById(R.id.ll_rating);
		review_layout=findViewById(R.id.review_layout);
		if(userFacAca.getRatingAvg().equalsIgnoreCase("0")){
			ll_rating.setVisibility(View.GONE);
		}else{
			ll_rating.setVisibility(View.VISIBLE);
			tv_rating.setText(String.valueOf(userFacAca.getRatingAvg()));
		}


		tv_review = findViewById(R.id.tv_review);
		tv_review.setOnClickListener(v -> {
			reviewDialog();
		});
		if(userFacAca.getRatingAvg().equalsIgnoreCase("0")){
			review_layout.setVisibility(View.GONE);
		}else{
			review_layout.setVisibility(View.VISIBLE);
			tv_review.setText(String.valueOf(userFacAca.getRating())+" Reviews");
		}




        img_banner = findViewById(R.id.img_banner);
        if(!userFacAca.getFacBannerImg().isEmpty()){
            String imgPath = kImageBaseUrl+userFacAca.getFacFolder()+"/"+userFacAca.getFacBannerImg();
            Picasso.with(this).load(imgPath).placeholder(R.drawable.running_event).fit().into(img_banner);
        }else{
            Picasso.with(this).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(img_banner);
        }

        img_banner.setOnTouchListener(new View.OnTouchListener() {
			@Override
			public boolean onTouch(View v, MotionEvent event) {

				CongratsDialog();
				return false;
			}
		});


		ll_gallery=findViewById(R.id.ll_gallery);
		ll_sport=findViewById(R.id.ll_sport);
		ll_amenities=findViewById(R.id.ll_amenities);
		img_arrow_direc = findViewById(R.id.img_arrow_direc);
		img_arrow_gallary = findViewById(R.id.img_arrow_gallary);
		img_arrow_timing = findViewById(R.id.img_arrow_timing);
		img_arrow_sport = findViewById(R.id.img_arrow_sport);
		img_arrow_amenities = findViewById(R.id.img_arrow_amenities);

		img_arrow_direc_invisibale = findViewById(R.id.img_arrow_direc_invisibale);
		img_arrow_gallary_invisibale = findViewById(R.id.img_arrow_gallary_invisibale);
		img_arrow_timing_invisibale = findViewById(R.id.img_arrow_timing_invisibale);
		img_arrow_sport_invisibale = findViewById(R.id.img_arrow_sport_invisibale);
		img_arrow_amenities_invisibale = findViewById(R.id.img_arrow_amenities_invisibale);


		bt_getDirection = findViewById(R.id.bt_getDirection);
		layout_map = findViewById(R.id.layout_map);
		bt_getDirection.setOnClickListener(v ->
		{
			if (layout_map.getVisibility() == View.VISIBLE) {
				layout_map.setVisibility(View.GONE);
				img_arrow_direc.setVisibility(View.VISIBLE);
				img_arrow_direc_invisibale.setVisibility(View.GONE);
			} else {
				layout_map.setVisibility(View.VISIBLE);
				img_arrow_direc.setVisibility(View.GONE);
				img_arrow_direc_invisibale.setVisibility(View.VISIBLE);
			}
		});

		bt_gallery = findViewById(R.id.bt_gallery);
		bt_gallery.setOnClickListener(v ->
		{
			if (ll_gallery.getVisibility() == View.VISIBLE) {
				ll_gallery.setVisibility(View.GONE);
				img_arrow_gallary.setVisibility(View.VISIBLE);
				img_arrow_gallary_invisibale.setVisibility(View.GONE);
			} else {
				ll_gallery.setVisibility(View.VISIBLE);
				img_arrow_gallary.setVisibility(View.GONE);
				img_arrow_gallary_invisibale.setVisibility(View.VISIBLE);
			}
		});

		bt_timing = findViewById(R.id.bt_timing);
		bt_timing.setOnClickListener(v -> {
			if (rvList.getVisibility() == View.VISIBLE) {
				rvList.setVisibility(View.GONE);
				img_arrow_timing.setVisibility(View.VISIBLE);
				img_arrow_timing_invisibale.setVisibility(View.GONE);
			} else {
				rvList.setVisibility(View.VISIBLE);
				img_arrow_timing.setVisibility(View.GONE);
				img_arrow_timing_invisibale.setVisibility(View.VISIBLE);

			}
		});


		btn_sport = findViewById(R.id.btn_sport);
		btn_sport.setOnClickListener(v ->
		{
			if (ll_sport.getVisibility() == View.VISIBLE) {
				ll_sport.setVisibility(View.GONE);
				img_arrow_sport.setVisibility(View.VISIBLE);
				img_arrow_sport_invisibale.setVisibility(View.GONE);
			} else {
				ll_sport.setVisibility(View.VISIBLE);
				img_arrow_sport.setVisibility(View.GONE);
				img_arrow_sport_invisibale.setVisibility(View.VISIBLE);
			}
		});


		btn_amenities = findViewById(R.id.btn_amenities);
		btn_amenities.setOnClickListener(v ->
		{
			if (ll_amenities.getVisibility() == View.VISIBLE) {
				ll_amenities.setVisibility(View.GONE);
				img_arrow_amenities.setVisibility(View.VISIBLE);
				img_arrow_amenities_invisibale.setVisibility(View.GONE);
			} else {
				ll_amenities.setVisibility(View.VISIBLE);
				img_arrow_amenities.setVisibility(View.GONE);
				img_arrow_amenities_invisibale.setVisibility(View.VISIBLE);

			}
		});



        ch_favorite = findViewById(R.id.ch_favorite);

        if(fac_count.equalsIgnoreCase("1")){
			ch_favorite.setChecked(true);
		}else{
			ch_favorite.setChecked(false);
		}

		ch_favorite.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
			@Override
			public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
				if(buttonView.isChecked()){
					getFav();
				}else {
					getdeleteItemfav();
				}
			}
		});



        btn_enquiry = findViewById(R.id.btn_enquiry);
        btn_enquiry.setOnClickListener(v -> {
            enquiryDialog();

        });
    }


	private void CongratsDialog(){
		final Dialog dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_zoom);
		dialog.setCancelable(true);
		ImageView tv_msg=dialog.findViewById(R.id.img_banner);
		TextView img_cross=dialog.findViewById(R.id.iv_cross);
		img_cross.setOnClickListener(v->{dialog.dismiss();});

		if(!userFacAca.getFacBannerImg().isEmpty()){
			String imgPath = kImageBaseUrl+userFacAca.getFacFolder()+"/"+userFacAca.getFacBannerImg();
			Picasso.with(this).load(imgPath).placeholder(R.drawable.running_event).fit().into(tv_msg);
		}else{
			Picasso.with(this).load(R.drawable.running_event).placeholder(R.drawable.running_event).fit().into(tv_msg);
		}


		dialog.show();
	}

	private void getdeleteItemfav() {
		//loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kfavrouteId, fav_id);
		Log.e("send carat", map.toString());

		ModelManager.modelManager().userUnfav(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();

				try {
					String msg = genericResponse.getObject();
					Toaster.customToast("Removed from your favourites");
					ch_favorite.setChecked(false);


				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();

				Toaster.customToast(message);
			});


	}

    /*@Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
    }
*/

    private void getGalleryData() {
        CopyOnWriteArrayList<UserFacViewGallery> viewGallery;
        viewGallery = userFacAca.getViewGalleryList();
        setGalleryData(viewGallery);
    }

	private void getTiming(){
		CopyOnWriteArrayList<UserFacTimings>userFacTimings;
		userFacTimings=userFacAca.getFacTimingList();
		setTiming(userFacTimings);

	}

	private void setTiming(CopyOnWriteArrayList<UserFacTimings>userFacTimings){
		TimeAdapter timeAdapter = new TimeAdapter(this, userFacTimings);
		rvList.setAdapter(timeAdapter);
	}

    private void setGalleryData(CopyOnWriteArrayList<UserFacViewGallery> gallerylist){
    	if(gallerylist.isEmpty()){
    		tv_g.setVisibility(View.VISIBLE);
			rv_view_gallery.setVisibility(View.GONE);

		}else{
			tv_g.setVisibility(View.GONE);
			rv_view_gallery.setVisibility(View.VISIBLE);
			viewGallaryAdapter = new ViewGallaryAdapter(context, gallerylist);
			rv_view_gallery.setAdapter(viewGallaryAdapter);
		}


    }


    private void initData(){
        tabLayout.addTab(tabLayout.newTab().setText(getString(R.string.things_note)));
        tabLayout.addTab(tabLayout.newTab().setText(getString(R.string.achievement_tab)));
        tabLayout.addTab(tabLayout.newTab().setText(getString(R.string.review_tab)));
        //tabLayout.setTabGravity(TabLayout.GRAVITY_FILL);

        TabLayoutAdapter adapter = new TabLayoutAdapter(this,getSupportFragmentManager(), tabLayout.getTabCount(),userFacAca);
        viewPager.setAdapter(adapter);

        viewPager.addOnPageChangeListener(new TabLayout.TabLayoutOnPageChangeListener(tabLayout));
        tabLayout.addOnTabSelectedListener(new TabLayout.OnTabSelectedListener() {
            @Override
            public void onTabSelected(TabLayout.Tab tab) {

                switch (tab.getPosition()){
                    case 0:
                       /* Toast.makeText(context,)*/
                        break;
                    case 1:

                        break;
                    case 2:
                        break;
                }

                viewPager.setCurrentItem(tab.getPosition());

            }

            @Override
            public void onTabUnselected(TabLayout.Tab tab) {

            }

            @Override
            public void onTabReselected(TabLayout.Tab tab) {

            }
        });
        viewPager.setPagingEnabled(true);
    }

/*  :::::::: Static Content
    private void getSportData(){
        CopyOnWriteArrayList<Sport> favSport=new CopyOnWriteArrayList<>();
        favSport.add(new Sport(1,"Sports",""));
        favSport.add(new Sport(1,"Sports",""));
        favSport.add(new Sport(1,"Sports",""));
        favSport.add(new Sport(1,"Sports",""));
        favSport.add(new Sport(1,"Sports",""));
        setData(favSport);
        getSportsData();
    }
*/

    private void getSportData(){
        CopyOnWriteArrayList<Sport> sports;
        sports = userFacAca.getFacSportList();
        sports_list=new ArrayList<>();
        for(int i=0;i<sports.size();i++){
            sport=new Sport(sports.get(i).getSportId(),sports.get(i).getSportName());
            sports_list.add(sport);
        }
        setData(sports);
    }

    private void setData(CopyOnWriteArrayList<Sport> list){

    	if(list.isEmpty()){
    		tv_sportAdedd.setVisibility(View.VISIBLE);
			rvSports.setVisibility(View.GONE);
		}else{
			tv_sportAdedd.setVisibility(View.GONE);
			rvSports.setVisibility(View.VISIBLE);
			sportAdapter = new FacilitySportAdapter(this, list, () -> {
			});
			rvSports.setAdapter(sportAdapter);
		}


    }


    /*private void getAmenityData(){
        CopyOnWriteArrayList<Amenity> amenities =new CopyOnWriteArrayList<>();
        amenities.add(new Amenity(1,"Amenity",""));
        amenities.add(new Amenity(1,"Amenity",""));
        amenities.add(new Amenity(1,"Amenity",""));
        amenities.add(new Amenity(1,"Amenity",""));
        amenities.add(new Amenity(1,"Amenity",""));
        setAmenityData(amenities);
        getAmenitiesData();
    }*/


    /*::::::::::::::  For Setting Dynamic Content*/

    private void getAmenityData(){
      CopyOnWriteArrayList<Amenity> amenities;
        amenities = userFacAca.getFacAmenitiesList();
        setAmenityData(amenities);
        //getAmenitiesData();
    }


    private void setAmenityData(CopyOnWriteArrayList<Amenity> list){

    	if(list.isEmpty()){
    		tv_a.setVisibility(View.VISIBLE);
			rvAmenity.setVisibility(View.GONE);
		}else{
			tv_a.setVisibility(View.GONE);
			rvAmenity.setVisibility(View.VISIBLE);
			amenityAdapter = new FacilityAmenityAdapter(this, list, () -> {
			});
			rvAmenity.setAdapter(amenityAdapter);
		}


    }

 /*   private void getAmenitiesData(){
        HashMap<String,Object> parameters = new HashMap<>();
        parameters.put(kAction, userFacAca.getFacId());
        ModelManager.modelManager().userAmenities(parameters,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Amenity>> genericResponse) -> {
                    try {
                        CopyOnWriteArrayList<Amenity> sports = genericResponse.getObject();
                        amenityAdapter.newData(sports);
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
    }*/

    @TargetApi(Build.VERSION_CODES.LOLLIPOP)
    public static void setStatusBarGradient(Activity activity) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            Window window = activity.getWindow();
            Drawable background = activity.getResources().getDrawable(R.drawable.canvas_red_gradient);
            window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            window.setStatusBarColor(activity.getResources().getColor(android.R.color.transparent));
            window.setNavigationBarColor(activity.getResources().getColor(android.R.color.transparent));
            window.setBackgroundDrawable(background);
        }
    }

    @Override
    public boolean onSupportNavigateUp() {
        onBackPressed();
        return true;
    }

    @Override
    public void onFacilityClick(UserFacAca facAca) {

    }

	protected void requestPermission(String permissionType,
									 int requestCode) {

		ActivityCompat.requestPermissions(this,
			new String[]{permissionType}, requestCode
		);
	}


	@Override
	public void onRequestPermissionsResult(int requestCode,
										   String permissions[], int[] grantResults) {

		switch (requestCode) {
			case LOCATION_REQUEST_CODE: {

				if (grantResults.length == 0
					|| grantResults[0] !=
					PackageManager.PERMISSION_GRANTED) {
					Toast.makeText(this,
						"Unable to show location - permission required",
						Toast.LENGTH_LONG).show();
				} else {

					SupportMapFragment mapFragment =
						(SupportMapFragment) getSupportFragmentManager()
							.findFragmentById(R.id.map);
					mapFragment.getMapAsync(this);
				}
			}
		}
	}


    @Override
    public void onMapReady(GoogleMap googleMap) {


		mMap = googleMap;

		// Add a marker in Sydney and move the camera
		LatLng sydney = new LatLng(-34, 151);
		mMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sydney"));
		mMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));

		double lat=Double.valueOf(userFacAca.getFacLat());
		double lan=Double.valueOf(userFacAca.getFacLng());

		mMap.setMapType(GoogleMap.MAP_TYPE_TERRAIN);
		mMap.addMarker(new MarkerOptions()
//                    .position(new LatLng(28.5355161, 77.3910265))
			.position(new LatLng(lat, lan))
			.title(userFacAca.getFacName())
			.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED)));

		mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(lat, lan), 14));


		if (mMap != null) {
			int permission = ContextCompat.checkSelfPermission(this,
				Manifest.permission.ACCESS_FINE_LOCATION);

			if (permission == PackageManager.PERMISSION_GRANTED) {
				mMap.setMyLocationEnabled(true);
			} else {
				requestPermission(
					Manifest.permission.ACCESS_FINE_LOCATION,
					LOCATION_REQUEST_CODE);
			}
		}


		/*if (ContextCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_FINE_LOCATION) ==
			PackageManager.PERMISSION_GRANTED &&
			ContextCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_COARSE_LOCATION) ==
				PackageManager.PERMISSION_GRANTED) {

			mMap = googleMap;
			mMap.setMyLocationEnabled(true);

			mMap.getUiSettings().setMyLocationButtonEnabled(true);


			// Add a marker in Sydney, Australia, and move the camera.
			LatLng sydney = new LatLng(-34, 151);
			mMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sydney"));
			mMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));

			double lat=Double.valueOf(userFacAca.getFacLat());
			double lan=Double.valueOf(userFacAca.getFacLng());

			mMap.setMapType(GoogleMap.MAP_TYPE_TERRAIN);
			mMap.addMarker(new MarkerOptions()
//                    .position(new LatLng(28.5355161, 77.3910265))
				.position(new LatLng(lat, lan))
				.title(userFacAca.getFacName())
				.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED)));

			mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(lat, lan), 14));

		} else {
			Toast.makeText(this, "Please allow map permission", Toast.LENGTH_LONG).show();
		}
*/
    }


    //...new code here..

    private void enquiryDialog(){
        // dialog
         dialog = new Dialog(this);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_enquiry);

        dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
        EditText editText = dialog.findViewById(R.id.et_subject);
        EditText editText1=dialog.findViewById(R.id.et_message);
        TextView tv_sport_name=dialog.findViewById(R.id.tv_sport_name);
        tv_sport_name.setText(userFacAca.getFacName());
        dialog.findViewById(R.id.btn_submit).setOnClickListener(view -> {
            if(Utils.getProperText(editText).isEmpty())
                Toaster.customToast("Please enter subject");
            else if(Utils.getProperText(editText1).isEmpty())
                Toaster.customToast("Please enter message");
            else
                setEnquiry(Utils.getProperText(editText), Utils.getProperText(editText1));
        });
        dialog.show();
    }

    private void setEnquiry(String subject,String messagee){
        dialog.dismiss();
        loaderView.showLoader();
        HashMap<String,Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kEnquireMessage,messagee);
		map.put(kFacId,userFacAca.getFacId());
		map.put(kEventId,"");
		//map.put(kEnquireEmail,ModelManager.modelManager().getCurrentUser().getEmail());
		map.put(kEnquiryTitle,subject);
		//map.put(kEnquireName, ModelManager.modelManager().getCurrentUser().getUsername());
		//map.put(kEnguireContact, ModelManager.modelManager().getCurrentUser().getPhone());
        Log.e(TAG,"enquiry_: "+ map.toString());
        ModelManager.modelManager().userSendEnquire(map,
                (Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
                    loaderView.hideLoader();

                    try {
                        String msg = genericResponse.getObject();
                        Toaster.customToast(msg);
                        Log.e(TAG,"msg: " +msg);
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }


	private void reviewDialog() {
		// dialog
		dialog = new Dialog(this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_review_show);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

		RecyclerView rc_review=dialog.findViewById(R.id.rc_review);
		LinearLayout empty_view=dialog.findViewById(R.id.empty_view);
		rc_review.setLayoutManager(new StaggeredGridLayoutManager(1, RecyclerView.VERTICAL));
		rc_review.addItemDecoration(new VerticalSpaceItemDecoration(10));


		CopyOnWriteArrayList<UserReviews> userReviewsList ;
		userReviewsList = userFacAca.getUserReviewsList();

		if(userReviewsList.isEmpty()){
			empty_view.setVisibility(View.VISIBLE);
			rc_review.setVisibility(View.GONE);
		}else{
			empty_view.setVisibility(View.GONE);
			rc_review.setVisibility(View.VISIBLE);
			setAchievementData(userReviewsList,rc_review);
		}

		dialog.show();
	}
	private void setAchievementData(CopyOnWriteArrayList<UserReviews> userReviewsList,RecyclerView recyclerView) {
		userReviewAdapter = new UserReviewAdapterr(context, userReviewsList);
		recyclerView.setAdapter(userReviewAdapter);
	}

	private void getFav() {
		//loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kFacId,userFacAca.getFacId());
		ModelManager.modelManager().userFav(map,
			(Constants.Status iStatus, GenericResponse<FavModelChecked> genericResponse) -> {
				loaderView.hideLoader();

				try {
					FavModelChecked msg = genericResponse.getObject();
					fav_id=msg.getRes();
					Toaster.customToast("Added to your favourites");

					ch_favorite.setTag(userFacAca.getFavouriteId());
					ch_favorite.setChecked(true);


				} catch (Exception e){
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();

				Toaster.customToast(message);
			});


	}


}
