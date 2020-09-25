package com.socialsportz.Activities.User.Activities;

import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.SignUpActivity;
import com.socialsportz.Activities.User.Adapters.BatchSlotBookAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.User.CartCount;
import com.socialsportz.Models.User.UserAddcart;
import com.socialsportz.Models.User.UserAddcartList;
import com.socialsportz.Models.User.UserBatchSlotAvail;
import com.socialsportz.Models.User.UserBatchSlotAvailList;
import com.socialsportz.Models.User.UserPackage;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import devs.mulham.horizontalcalendar.HorizontalCalendar;
import devs.mulham.horizontalcalendar.HorizontalCalendarView;
import devs.mulham.horizontalcalendar.utils.HorizontalCalendarListener;

import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacType;
import static com.socialsportz.Constants.Constants.kMessageNetworkError;
import static com.socialsportz.Constants.Constants.kResponseMessage;
import static com.socialsportz.Constants.Constants.kReturnPackageId;
import static com.socialsportz.Constants.Constants.kReturnistrial;
import static com.socialsportz.Constants.Constants.kSDate;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kaddcart;

public class UserCalaenderBookingActivity extends AppCompatActivity implements AdapterView.OnItemSelectedListener {

	private final static String TAG = UserCalaenderBookingActivity.class.getSimpleName();
	private Context context;
	private BatchSlotBookAdapter batchSlotBookAdapter;
	private RecyclerView rvList;
	private HorizontalCalendar horizontalCalendar;
     String countt;
	DropDownView dropDownView,dropDownVieww, drop_package;
	CopyOnWriteArrayList<UserBatchSlotAvailList> batchSlots;
	ArrayList<Sport> sports;
	private int sports_id;
	private String datee = "";
	private int fac_id;
	private Button btn_add_cartt;
	String fac_type = "", package_id = "", trial_status = "", SportId, facname = "", packagename;
	String Sportname = "";
	CheckBox cb_coldfusion;
	RelativeLayout header_layoutt,header_layout;
	ImageButton bell;
	TextView tv_fac_aca_name,tv_selectt;
	JSONArray slotdataarray = new JSONArray();
	JSONArray batchIdArry = new JSONArray();
	UserAddcartList object;
	CopyOnWriteArrayList<UserAddcart> mdata;
	CustomLoaderView loaderView;
	private ShimmerFrameLayout mShimmerViewContainer;
	private LinearLayout emptyLayout;
	private static int SPLASH_TIME_OUT = 2000;
	TextView tv_count, tv_select, tv_description,tv_page_title,tv_textt;
    LinearLayout empty_vieww;
	int count;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_user_calaender_booking);
		context = this;
		loaderView = CustomLoaderView.initialize(context);

		getIntentValue();
		initialDate();
		inItView();


	}

	@Override
	protected void onResume() {
		super.onResume();
		getCartCount();
		//getDeleteCart();
	}

	public void getIntentValue() {
		Bundle b = getIntent().getExtras();
		if (b != null)
			sports = (ArrayList<Sport>) b.getSerializable("Sports");
		fac_type = b.getString("TYPE");
		fac_id = b.getInt("Id");
		facname = b.getString("FACNAME");


		if (!b.getString("SPORTNAME").isEmpty() & !b.getString("SPORTNAME").isEmpty()) {
			Sportname = b.getString("SPORTNAME");
			if (!b.getString("SPORTID").isEmpty()) {
				sports_id = Integer.parseInt(b.getString("SPORTID"));
			}
		}

		Log.d("Hello", sports + "/" + fac_id + "/" + fac_type + "/" + Sportname + "/" + SportId + facname);

	}


	private void inItView() {
		emptyLayout = findViewById(R.id.empty_view);
		mShimmerViewContainer = findViewById(R.id.shimmer_view_container);
		rvList = findViewById(R.id.rv_list);
		LinearLayoutManager mLayoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		rvList.setLayoutManager(mLayoutManager);
		rvList.addItemDecoration(new SpaceItemDecoration(20));
		tv_fac_aca_name = findViewById(R.id.tv_fac_aca_name);
		tv_fac_aca_name.setText(facname);
		tv_count = findViewById(R.id.tv_count);
		empty_vieww=findViewById(R.id.empty_vieww);
		bell = findViewById(R.id.bell);
		btn_add_cartt = findViewById(R.id.btn_add_cartt);

		header_layout=findViewById(R.id.header_layout);
		tv_selectt=findViewById(R.id.tv_selectt);

		tv_page_title=findViewById(R.id.tv_page_title);
		tv_textt=findViewById(R.id.tv_textt);
		tv_select = findViewById(R.id.tv_select);
		tv_description = findViewById(R.id.tv_description);
		/*if (fac_type.equalsIgnoreCase("Academy")) {
			header_layout.setVisibility(View.GONE);
			tv_selectt.setVisibility(View.VISIBLE);
			*//*tv_page_title.setText("Book Batch");
			tv_select.setText(getString(R.string.select_batch));*//*
			tv_description.setVisibility(View.GONE);
		} else {
			tv_page_title.setText("Book Slot");
			tv_select.setText(getString(R.string.select_slot));
			tv_description.setVisibility(View.VISIBLE);
		}*/


		drop_package = findViewById(R.id.drop_package);

		dropDownView = findViewById(R.id.drop_sport);
		dropDownVieww = findViewById(R.id.drop_sportt);

		ImageButton back = findViewById(R.id.ib_back);
		back.setOnClickListener(view -> {
			if (countt.equalsIgnoreCase("0") || countt.equalsIgnoreCase("")) {
				finish();
			} else {
				MobileOtpDialog();
			}
		});
		header_layoutt = findViewById(R.id.header_layoutt);
		if (fac_type.equalsIgnoreCase("Academy")) {
			getPackage();
			header_layoutt.setVisibility(View.VISIBLE);
			header_layout.setVisibility(View.GONE);
			tv_selectt.setVisibility(View.VISIBLE);

		} else {
			header_layoutt.setVisibility(View.GONE);
			header_layout.setVisibility(View.VISIBLE);
			tv_selectt.setVisibility(View.GONE);
		}
		cb_coldfusion = findViewById(R.id.cb_coldfusion);
		cb_coldfusion.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
			@Override
			public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
				if (isChecked == true) {
					trial_status = "yes";

					Log.d("trial_status", trial_status);

					if (validatee()) {
						getDashData();
					}

				} else {
					trial_status = "";
					if (validatee()) {
						getDashData();
					}
				}
			}
		});
		ArrayList<DataModel> options = new ArrayList<>();
		for (int i = 0; i < sports.size(); i++) {
			options.add(new DataModel(sports.get(i).getSportId(), sports.get(i).getSportName()));
		}

		if (Sportname.isEmpty()) {
			dropDownView.setOptionList(options);
			dropDownVieww.setOptionList(options);
		} else {
			dropDownView.setText(Sportname);
			dropDownView.setOptionList(options);
			dropDownVieww.setText(Sportname);
			dropDownVieww.setOptionList(options);
			getDashData();

		}


		dropDownView.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
			}

			@Override
			public void onClickDone(int id, String name) {
				sports_id = id;
				Sportname = name;

				Log.d("all", sports_id + "/ " + Sportname);

				/*if (fac_type.equalsIgnoreCase("Academy")) {
					tv_textt.setText("Please Select package !");
				} else {
					tv_page_title.setText("Book Slot");
					tv_select.setText(getString(R.string.select_slot));
					tv_description.setVisibility(View.VISIBLE);
				}*/



				empty_vieww.setVisibility(View.GONE);
				rvList.setVisibility(View.VISIBLE);


				if (validatee()) {

					if(isConnected()){
						getDashData();
						getCartCount();
					}else{
						Toaster.customToast(kMessageNetworkError);
					}


				}

                /*if (fac_type.equalsIgnoreCase("Academy")) {
					//getDashData();
                } else {
                    getDashData();
                }*/

			}

			@Override
			public void onDismiss() {
			}
		});


		dropDownVieww.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
			}

			@Override
			public void onClickDone(int id, String name) {
				sports_id = id;
				Sportname = name;

				Log.d("all", sports_id + "/ " + Sportname);

				/*if (fac_type.equalsIgnoreCase("Academy")) {
					tv_textt.setText("Please Select package !");
				} else {
					tv_page_title.setText("Book Slot");
					tv_select.setText(getString(R.string.select_slot));
					tv_description.setVisibility(View.VISIBLE);
				}*/



				empty_vieww.setVisibility(View.GONE);
				rvList.setVisibility(View.VISIBLE);


				if (validate()) {

					if(isConnected()){
						getDashData();
						getCartCount();
					}else{
						Toaster.customToast(kMessageNetworkError);
					}


				}

                /*if (fac_type.equalsIgnoreCase("Academy")) {
					//getDashData();
                } else {
                    getDashData();
                }*/

			}

			@Override
			public void onDismiss() {
			}
		});


		drop_package.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
			}

			@Override
			public void onClickDone(int id, String name) {
				package_id = String.valueOf(id);
				packagename = name;


                if(isConnected()){
					getDashData();
				}else{
                	Toaster.customToast(kMessageNetworkError);
				}


			}

			@Override
			public void onDismiss() {
			}
		});


		//...
		btn_add_cartt.setOnClickListener(v -> {

			slotdataarray = batchSlotBookAdapter.getAray();

			batchIdArry = batchSlotBookAdapter.getArayId();


			//trial_status = batchSlotBookAdapter.getTrial();


			Log.d("id", slotdataarray + "/" + mdata);
			if (fac_type.equalsIgnoreCase("Academy")) {
				if (validate()) {

					if (validatead()) {

						getAddToCart(slotdataarray);

						/*if (trial_status.equalsIgnoreCase("yes")) {

							if (slotdataarray.length() > 1) {
								Toaster.customToast("At a single time you can book a single trial or book batch.Please remove one trial");
							} else {
								getAddToCart(slotdataarray);
							}

						} else {

						}*/



						/*Intent intent = new Intent(context, MyCartActivity.class);
						intent.putExtra("TYPE", fac_type);
						intent.putExtra("ID",fac_id);
						intent.putExtra("SportId",sports_id);
						intent.putExtra("SPORTNAME",Sportname);
						intent.putExtra("TRIAL",trial_status);
						intent.putExtra("Bundle",batchIdArry.toString());
						intent.putExtra("Bundle1",slotdataarray.toString());
						startActivity(intent);

						//getAddToCart(slotdataarray);*/
					}

				}
			} else {
				if (validatee()) {
					if (validatead()) {

						getAddToCart(slotdataarray);

						/*Intent intent = new Intent(context, MyCartActivity.class);
						intent.putExtra("TYPE", fac_type);
						intent.putExtra("ID",fac_id);
						intent.putExtra("SportId",sports_id);
						intent.putExtra("SPORTNAME",Sportname);
						intent.putExtra("TRIAL",trial_status);
						intent.putExtra("Bundle",batchIdArry.toString());
						intent.putExtra("Bundle1",slotdataarray.toString());
						startActivity(intent);*/


						Log.d("Iddd", Sportname + "/" + sports_id + "/" + fac_id + "/" + fac_type);

						//getAddToCart(slotdataarray);
					}
				}
			}


		});

		bell.setOnClickListener(V -> {

			/*slotdataarray = batchSlotBookAdapter.getAray();

			batchIdArry = batchSlotBookAdapter.getArayId();

			Log.d("id", slotdataarray + "/" + batchIdArry);*/


				if (fac_type.equalsIgnoreCase("Academy")) {


					Intent intent = new Intent(context, MyCartActivity.class);
					intent.putExtra("TYPE", fac_type);
					intent.putExtra("ID", fac_id);
					intent.putExtra("SportId", sports_id);
					intent.putExtra("SPORTNAME", Sportname);
					intent.putExtra("TRIAL", trial_status);
					intent.putExtra("FACNAME",facname);
					startActivity(intent);

					/*if (slotdataarray.length() > 1) {
						Toaster.customToast("At a single time you can book a single trial or book batch.Please remove one trial");
					} else {

					}*/



             /*   if (validate()) {

                    if (validatead()) {
                        Intent intent = new Intent(context, MyCartActivity.class);
                        intent.putExtra("TYPE", fac_type);
                        intent.putExtra("ID",fac_id);
                        intent.putExtra("SportId",sports_id);
                        intent.putExtra("SPORTNAME",Sportname);
						intent.putExtra("TRIAL",trial_status);
                        intent.putExtra("Bundle",batchIdArry.toString());
                        intent.putExtra("Bundle1",slotdataarray.toString());
                        startActivity(intent);

                        //getAddToCart(slotdataarray);
                    }

                }*/
				} else {

					Intent intent = new Intent(context, MyCartActivity.class);
					intent.putExtra("TYPE", fac_type);
					intent.putExtra("ID", fac_id);
					intent.putExtra("SportId", sports_id);
					intent.putExtra("SPORTNAME", Sportname);
					intent.putExtra("TRIAL", trial_status);
					intent.putExtra("FACNAME",facname);
					startActivity(intent);


				}



		});

	}


	public boolean isConnected() {
		boolean connected = false;
		try {
			ConnectivityManager cm = (ConnectivityManager)getApplicationContext().getSystemService(Context.CONNECTIVITY_SERVICE);
			NetworkInfo nInfo = cm.getActiveNetworkInfo();
			connected = nInfo != null && nInfo.isAvailable() && nInfo.isConnected();
			return connected;
		} catch (Exception e) {
			Log.e("Connectivity Exception", e.getMessage());
		}
		return connected;
	}


	private boolean validate() {
		boolean isOk = true;

		if (dropDownVieww.getText().toString().isEmpty()) {
			Toaster.customToast("Please select Sports!");
			isOk = false;
		} else if (drop_package.getText().toString().isEmpty()) {
			Toaster.customToast("Please select Package!");
			isOk = false;
		}

		return isOk;
	}

	private boolean validatead() {
		boolean isOk = true;

		Log.d("itemcount", batchSlotBookAdapter.getItemCount() + "");
		if (batchSlotBookAdapter.getSportsSelectionStatus()) {
			Toaster.customToast("Please select Slots!");
			isOk = false;
		}

		return isOk;
	}

	private boolean validatee() {
		boolean isOk = true;

		if (dropDownView.getText().toString().isEmpty()) {
			Toaster.customToast("Please select Sports!");
			isOk = false;
		}

		return isOk;
	}

	private void initialDate() {
		Calendar startDate = Calendar.getInstance();

		SimpleDateFormat sdf = new SimpleDateFormat("yy-MM-dd");

		datee = sdf.format(startDate.getTime());

		startDate.add(Calendar.MONTH, 0);

		/* ends after 1 month from now */
		Calendar endDate = Calendar.getInstance();
		endDate.add(Calendar.MONTH, 2);

		horizontalCalendar = new HorizontalCalendar.Builder(this, R.id.calendarView)
			.range(startDate, endDate)
			.datesNumberOnScreen(5)
			.build();
		horizontalCalendar.setCalendarListener(new HorizontalCalendarListener() {
			@Override
			public void onDateSelected(Calendar date, int position) {

				Date mDate1 = date.getTime();
				datee = sdf.format(mDate1);

				if (fac_type.equalsIgnoreCase("Academy")) {
					if (validate()) {
						getDashData();
					}
				} else {
					if (validatee()) {
						getDashData();
					}
				}




               /* if(fac_type.equalsIgnoreCase("Academy")){
					if(validate()){
						getDashData();
					}
				}else{

				}*/

			}

			@Override
			public void onCalendarScroll(HorizontalCalendarView calendarView,
										 int dx, int dy) {

			}

			@Override
			public boolean onDateLongClicked(Calendar date, int position) {
				return true;
			}
		});
	}

	private void getCartCount() {

		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kSportId, sports_id);
		map.put(kFacId,fac_id);
		Log.e("e", map.toString());
		ModelManager.modelManager().getCartCountre(map,
			(Constants.Status iStatus, GenericResponse<CartCount> genericResponse) -> {
				loaderView.hideLoader();
				try {
					CartCount userAddcartt = genericResponse.getObject();

					countt=userAddcartt.getCart_count();
					Log.d("count",userAddcartt.getCart_count()+"");

					tv_count.setText(userAddcartt.getCart_count());

				} catch (Exception e) {
					e.printStackTrace();
				}
				loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				Toaster.customToast(message);
			});

	}


	@Override
	public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

	}

	@Override
	public void onNothingSelected(AdapterView<?> parent) {

	}


	private void getDashData() {
		showShimmerView();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kSDate, datee);
		map.put(kSportId, sports_id);
		map.put(kFacId, fac_id);
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());

		if (fac_type.equalsIgnoreCase("Academy")) {
			map.put(kReturnPackageId, package_id);
			map.put(kReturnistrial, trial_status);
		} else {
			map.put(kReturnPackageId, package_id);
			map.put(kReturnistrial, trial_status);
		}

		Log.e(TAG, map.toString());
		ModelManager.modelManager().calenderBooking(map,
			(Constants.Status iStatus, GenericResponse<UserBatchSlotAvail> genericResponse) -> {
				hideShimmerView();
				try {

					/*if(packagename.isEmpty()){
						btn_add_cartt.setVisibility(View.VISIBLE);
					}
					else{
						btn_add_cartt.setVisibility(View.VISIBLE);
					}*/

					btn_add_cartt.setVisibility(View.VISIBLE);

					empty_vieww.setVisibility(View.GONE);
					rvList.setVisibility(View.VISIBLE);
					UserBatchSlotAvail object = genericResponse.getObject();
					batchSlots = object.getBatchSlot();
					batchSlotBookAdapter = new BatchSlotBookAdapter(context, batchSlots, fac_type.toLowerCase(), packagename, datee, trial_status);
					rvList.setAdapter(batchSlotBookAdapter);
				} catch (Exception e) {
					e.printStackTrace();
				}
				checkEmptyView();
			}, (Constants.Status iStatus, String message) ->
			{
				btn_add_cartt.setVisibility(View.GONE);
				hideShimmerView();
				Toaster.customToast(message);
				checkEmptyView();
			});
	}

	private void getPackage() {
		HashMap<String, Object> map = new HashMap<>();

		if (fac_type.equalsIgnoreCase("Academy")) {
			map.put(kFacId, fac_id);
		} else {
			map.put(kFacId, "0");
		}

		Log.e(TAG, map.toString());
		ModelManager.modelManager().usergetpackage(map,
			(Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<UserPackage>> genericResponse) -> {
				try {
					CopyOnWriteArrayList<UserPackage> object = genericResponse.getObject();
					ArrayList<DataModel> options_package = new ArrayList<>();
					for (int i = 0; i < object.size(); i++) {
						options_package.add(new DataModel(Integer.parseInt(object.get(i).getPackageId()), object.get(i).getPackageName()));
					}
					drop_package.setOptionList(options_package);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
	}

	private void checkEmptyView() {
		if (batchSlotBookAdapter.getItemCount() == 0)
			emptyLayout.setVisibility(View.VISIBLE);
		else
			emptyLayout.setVisibility(View.GONE);
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

	private void getAddToCart(JSONArray array) {

		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kaddcart, array);
		Log.e(TAG, map.toString());
		ModelManager.modelManager().userAddtocart(map,
			(Constants.Status iStatus, GenericResponse<UserAddcartList> genericResponse) -> {

				try {
					object = genericResponse.getObject();

					/*CopyOnWriteArrayList<UserAddcartList>userAddcartLists=new CopyOnWriteArrayList<>();
					userAddcartLists.add(object);
					count= String.valueOf(userAddcartLists.size());
					tv_count.setText(count);*/
					Intent intent = new Intent(context, MyCartActivity.class);
					intent.putExtra("TYPE", fac_type);
					intent.putExtra("ID", fac_id);
					intent.putExtra("SportId", sports_id);
					intent.putExtra("SPORTNAME", Sportname);
					intent.putExtra("TRIAL", trial_status);
					intent.putExtra("FACNAME",facname);
					startActivity(intent);
					loaderView.hideLoader();


				} catch (Exception e) {
					e.printStackTrace();
				}
				loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
	}


	private void getDeleteCart() {

		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		Log.e("e", map.toString());
		ModelManager.modelManager().getDeletecart(map,
			(Constants.Status iStatus, GenericResponse<JSONObject> genericResponse) -> {
				loaderView.hideLoader();
				try {
					String msg=genericResponse.getObject().getString(kResponseMessage);
					Toaster.customToast(msg);
					finish();
				} catch (Exception e) {
					e.printStackTrace();
				}

			}, (Constants.Status iStatus, String message) -> {
				Toaster.customToast(message);
			});


	}


	// Mobile OTP Dialog
	private void MobileOtpDialog(){
		final Dialog dialog = new Dialog(UserCalaenderBookingActivity.this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_alert_delete);
		dialog.setCancelable(false);

		Button btn_yes=dialog.findViewById(R.id.btn_yes);

		btn_yes.setOnClickListener(v -> {
			getDeleteCart();
		});
		Button btn_no=dialog.findViewById(R.id.btn_no);

		btn_no.setOnClickListener(v -> {
			dialog.dismiss();

		});



		dialog.show();
	}


	@Override
	public void onBackPressed() {

		if(countt.equalsIgnoreCase("0")||countt.equalsIgnoreCase("")){
			finish();
		}else{
			MobileOtpDialog();
		}

	}
}

