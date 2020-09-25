package com.socialsportz.Activities.User.Activities;

import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.util.Log;
import android.view.KeyEvent;
import android.view.View;
import android.view.Window;
import android.view.inputmethod.EditorInfo;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.socialsportz.Activities.User.Adapters.BatchSlotBookClaenderCartAdapter;
import com.socialsportz.Activities.WebViewActivity;
import com.socialsportz.Blocks.Block;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.CcAvenue.AvenuesParams;
import com.socialsportz.CcAvenue.ServiceUtility;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.User.BookingStatusResponse;
import com.socialsportz.Models.User.EventDetails;
import com.socialsportz.Models.User.UserAddcart;
import com.socialsportz.Models.User.UserAddcartList;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kBatchSlotId;
import static com.socialsportz.Constants.Constants.kBookingStatus;
import static com.socialsportz.Constants.Constants.kBookingTotal;
import static com.socialsportz.Constants.Constants.kCartId;
import static com.socialsportz.Constants.Constants.kConvenicesPersantage;
import static com.socialsportz.Constants.Constants.kConvenienceTaxes;
import static com.socialsportz.Constants.Constants.kCoupanAmount;
import static com.socialsportz.Constants.Constants.kCoupanCode;
import static com.socialsportz.Constants.Constants.kCovenienceFee;
import static com.socialsportz.Constants.Constants.kEventId;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacType;
import static com.socialsportz.Constants.Constants.kPaymentStatus;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kconvenienceTyep;
import static com.socialsportz.Constants.Constants.kconveniencemaxfees;
import static com.socialsportz.Constants.Constants.kconveniensTexes;

public class UserCalenderCheckoutActivity extends AppCompatActivity {

	private Context context;
	private BatchSlotBookClaenderCartAdapter batchSlotBookAdapter;
	private RecyclerView rv_book_detail;
	private Button btn_paynow;
	private ImageButton ib_back;
	String fac_type = "", FROM = "", sportname = "", fac_id = "", eventId = "", facName = "", sport_id = "", coupancode = "", final_amount = "";
	int total_amunt = 0, total_amuntt, total_amnt_dis, convenience_final_fee, coupan_amoun;
	TextView tv_fac_name,tv_eventAvailable, tv_with_tax, tv_coupan_applyed, tv_convenience_fee, tv_convenience_taxes, tv_sports, tv_amount, tv_sport_event, tv_add_charges, tv_total, tv_apply, tv_start_date, tv_end_date, tv_start_time, tv_end_time, tve_price;
	EditText et_appy_coupan;
	UserAddcartList userAddcartt;
	CopyOnWriteArrayList<UserAddcart> mdata;
	CustomLoaderView loaderView;
	UserAddcart userAddcart;
	Dialog dialog;
	JSONArray jsonArray_id = new JSONArray();
	JSONArray jsonArray_new;
	LinearLayout ll_event_details;
	String orderId;
	String vAccessCode = "", vMerchantId = "", vCurrency = "", vAmount = "", trial_status = "", transStatus = "";

	//...convenience chargees.

	String conveniencePersantage = "", conveFees = "", coneType = "", conveTexes = "",
	userName="",address="",email="",pincode="",country="",state="",phone="",city="",booked_slot="";
	int printConvesnies, printConveTexes, printconperofTotal;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_user_calender_checkout);
		context = this;
		loaderView = CustomLoaderView.initialize(context);
		getIntentValue();
		inItView();
	}




	public void getIntentValue() {
		Bundle b = getIntent().getExtras();
		if (b != null)


			FROM = b.getString("FROM");
		if (FROM.equalsIgnoreCase("1")) {
			fac_type = b.getString("TYPE");
			sport_id = b.getString("SportId");
			eventId = b.getString("EVENTID");

			if (fac_type.equalsIgnoreCase("Event")) {
				getEventDetails();
			} else {
				getDeleteCart();
			}

		} else if (FROM.equalsIgnoreCase("2")) {
			fac_type = b.getString("TYPE");
			fac_id = b.getString("ID");
			sport_id = b.getString("SportId");
			sportname = b.getString("SPORTNAME");
			trial_status = b.getString("TRIAL");
			facName = b.getString("FACNAME");

			if (fac_type.equalsIgnoreCase("Event")) {
				getEventDetails();
			} else {
				getDeleteCart();
			}
		} else if (FROM.equalsIgnoreCase("3")) {

			transStatus = b.getString("transStatus");

			Log.d("transStatus", transStatus);
			CongratsDialog(transStatus);
		}


	}

	public JSONArray generateArray(CopyOnWriteArrayList<UserAddcart> mdata) {

		JSONArray array = new JSONArray();
		JSONObject jsonObject;
		for (int i = 0; i < mdata.size(); i++) {
			jsonObject = new JSONObject();

			Log.d("data", mdata.get(i).getBatchSlotId());
			try {
				jsonObject.put(kBatchSlotId, mdata.get(i).getBatchSlotId());
			} catch (JSONException e) {
				e.printStackTrace();
			}
			array.put(jsonObject);
		}


		Log.d("arry", array.toString());
		return array;
	}

	private void inItView() {
		ib_back = findViewById(R.id.ib_back);
		ib_back.setOnClickListener(v -> {
			mdata.clear();
			finish();
		});
		rv_book_detail = findViewById(R.id.rv_book_detail);
		tv_eventAvailable=findViewById(R.id.tv_eventAvailable);

		ll_event_details = findViewById(R.id.ll_event_details);
		tv_start_date = findViewById(R.id.tv_start_date);
		tv_end_date = findViewById(R.id.tv_end_date);
		tv_start_time = findViewById(R.id.tv_start_time);
		tv_end_time = findViewById(R.id.tv_end_time);
		tve_price = findViewById(R.id.tve_price);
		tv_sport_event = findViewById(R.id.tv_sport_event);
		tv_with_tax = findViewById(R.id.tv_with_tax);


		tv_convenience_fee = findViewById(R.id.tv_convenience_fee);
		tv_convenience_taxes = findViewById(R.id.tv_convenience_taxes);

		ImageButton back = findViewById(R.id.ib_back);
		back.setOnClickListener(view -> finish()
		);
		btn_paynow = findViewById(R.id.btn_paynow);
		btn_paynow.setOnClickListener(v -> {

			//payNow();
			if (fac_type.equalsIgnoreCase("Event")) {
				getEventDetailss();
			} else {
				getDeleteCartt();
			}




		});

		tv_fac_name = findViewById(R.id.tv_fac_name);
		tv_fac_name.setText(facName);
		tv_sports = findViewById(R.id.tv_sports);

		if (sportname.isEmpty()) {
			tv_sport_event.setVisibility(View.GONE);
			tv_sports.setVisibility(View.GONE);
		} else {
			tv_sport_event.setVisibility(View.VISIBLE);
			tv_sports.setVisibility(View.VISIBLE);
			tv_sports.setText(sportname);
		}


		tv_amount = findViewById(R.id.tv_amount);

		tv_add_charges = findViewById(R.id.tv_add_charges);

		//...add..coupan value
		tv_total = findViewById(R.id.tv_total);

		tv_apply = findViewById(R.id.tv_apply);
		et_appy_coupan = findViewById(R.id.et_appy_coupan);
		tv_coupan_applyed = findViewById(R.id.tv_coupan_applyed);



		et_appy_coupan.setOnEditorActionListener(new TextView.OnEditorActionListener() {
			public boolean onEditorAction(TextView v, int actionId, KeyEvent event) {
				if ((event != null && (event.getKeyCode() == KeyEvent.KEYCODE_ENTER)) || (actionId == EditorInfo.IME_ACTION_DONE)) {

					if (et_appy_coupan.getText().toString().isEmpty()) {
						Toaster.customToast("Please Enter Coupan Code !");
					} else {
						coupancode = et_appy_coupan.getText().toString();
						getApplyCoupan();
					}

				}
				return false;
			}
		});

		tv_apply.setOnClickListener(v -> {
			if (et_appy_coupan.getText().toString().isEmpty()) {
				Toaster.customToast("Please Enter Coupan Code !");
			} else {
				coupancode = et_appy_coupan.getText().toString();
				getApplyCoupan();
			}
		});


		LinearLayoutManager mLayoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		rv_book_detail.setLayoutManager(mLayoutManager);
		rv_book_detail.addItemDecoration(new SpaceItemDecoration(5));
		rv_book_detail.setHasFixedSize(true);
		batchSlotBookAdapter = new BatchSlotBookClaenderCartAdapter(context, mdata, new BatchSlotBookClaenderCartAdapter.ItemClickListener() {
			@Override
			public void buttonPress(String cart_id, int pos) {
				reviewDialog(cart_id, pos);
			}
		});

	}

	public void payNow() {

		//Mandatory parameters. Other parameters can be added if required.


		Log.d("Name",ModelManager.modelManager().getCurrentUser().getUsername()+"?"+
			ModelManager.modelManager().getCurrentUser().getUserGoogleAdd()+"/"+
			ModelManager.modelManager().getCurrentUser().getUserCity()+"/"+
			ModelManager.modelManager().getCurrentUser().getUserPinCode()+"/"+
			ModelManager.modelManager().getCurrentUser().getEmail()+"/"+
			ModelManager.modelManager().getCurrentUser().getUserState()+"/"+
			ModelManager.modelManager().getCurrentUser().getUserCountry()+"/"+
			ModelManager.modelManager().getCurrentUser().getPhone());
		vAccessCode = ServiceUtility.chkNull(getResources().getString(R.string.access_code)).toString().trim();

		vMerchantId = ServiceUtility.chkNull(getResources().getString(R.string.merchant_id)).toString().trim();
		vCurrency = ServiceUtility.chkNull(getResources().getString(R.string.currency)).toString().trim();

		vAmount = ServiceUtility.chkNull(total_amuntt).toString().trim();

		userName=ServiceUtility.chkNull(ModelManager.modelManager().getCurrentUser().getUsername()).toString().trim();
			address=ServiceUtility.chkNull(ModelManager.modelManager().getCurrentUser().getUserGoogleAdd()).toString().trim();
			email= ServiceUtility.chkNull(ModelManager.modelManager().getCurrentUser().getEmail()).toString().trim();
			pincode= ServiceUtility.chkNull(ModelManager.modelManager().getCurrentUser().getUserPinCode()).toString().trim();
			country= ServiceUtility.chkNull(ModelManager.modelManager().getCurrentUser().getUserCountry()).toString().trim();
			state= ServiceUtility.chkNull(ModelManager.modelManager().getCurrentUser().getUserState()).toString().trim();
			phone= ServiceUtility.chkNull(ModelManager.modelManager().getCurrentUser().getPhone()).toString().trim();
			city= ServiceUtility.chkNull(ModelManager.modelManager().getCurrentUser().getUserCity()).toString().trim();

		if (!vAccessCode.equals("") && !vMerchantId.equals("") && !vCurrency.equals("") && !vAmount.equals("")) {


			/*&&
			!userName.equals("")&& !address.equals("") && !email.equals("")&& !pincode.equals("")&& !country.equals("")
				&& !phone.equals("")&& !city.equals("")&& !state.equals("")*/

			//&& !state.equals("") add when .in api clall..
			Intent intent = new Intent(context, WebViewActivity.class);

			intent.putExtra(AvenuesParams.ACCESS_CODE, vAccessCode);

			intent.putExtra(AvenuesParams.MERCHANT_ID, vMerchantId);

			intent.putExtra(AvenuesParams.ORDER_ID, orderId);
			intent.putExtra(AvenuesParams.UBILLING_NAME,userName);
			intent.putExtra(AvenuesParams.UBILLING_ADDRESS,address);
			intent.putExtra(AvenuesParams.UBILLING_CITY,city);
			intent.putExtra(AvenuesParams.UBILLING_ZIP,pincode);
			intent.putExtra(AvenuesParams.UBILLING_EMAIL,email);
			intent.putExtra(AvenuesParams.UBILLING_STATE,state);
			intent.putExtra(AvenuesParams.UBILLING_COUNTRY,country);
			intent.putExtra(AvenuesParams.UBILLING_TEL,phone);

			intent.putExtra(AvenuesParams.CURRENCY, "INR");//...Currency will be changed as per client requirement

			intent.putExtra(AvenuesParams.AMOUNT, vAmount);//...here amount will be passed at generate signed apk

			intent.putExtra(AvenuesParams.REDIRECT_URL, "https://www.socialsportz.com/ccavenuemobile/ccavResponseHandler.php");

			intent.putExtra(AvenuesParams.CANCEL_URL, "https://www.socialsportz.com/ccavenuemobile/ccavResponseHandler.php");

			intent.putExtra(AvenuesParams.RSA_KEY_URL, "https://www.socialsportz.com/ccavenuemobile/GetRSA.php");
			startActivity(intent);

		} else {

			Toaster.customToast("All parameters are mandatory.");


		}

	}

    /*private void reviewDialog(String cart_id,int pos) {
        // dialog
        dialog = new Dialog(context);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_alert);

        dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

        dialog.findViewById(R.id.btn_remove).setOnClickListener(v->{
            dialog.dismiss();
            getDeleteItemCart(cart_id,pos);});

        dialog.findViewById(R.id.btn_cancel).setOnClickListener(v->{dialog.dismiss();});

        dialog.show();
    }

    private void getDeleteItemCart(String  cart_id,int pos) {
        loaderView.showLoader();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kCartId, cart_id);
        ModelManager.modelManager().userCartDelete(map, new Block.Status() {
            @Override
            public void iStatus(Constants.Status iStatus) {

                if(mdata.size()>0){
                    mdata.remove(pos);
                    batchSlotBookAdapter.notifyDataSetChanged();
                    Toaster.customToast("Cart Delete Sucessfully");
                    loaderView.hideLoader();
                }



            }
        }, new Block.Failure() {
            @Override
            public void iFailure(Constants.Status iStatus, String error) {
                loaderView.hideLoader();
                Toaster.customToast("Something went wrong");
            }
        });


    }*/



	private void getBookingreguest() {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();

		if (fac_type.equalsIgnoreCase("Event")) {
			map.put(kEventId, eventId);
		} else {
			map.put(kFacId, fac_id);
			map.put("cart_id", batchSlotBookAdapter.getArayId());
		}
		map.put(kSportId, sport_id);
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kCoupanCode, coupancode);
		map.put(kCoupanAmount, coupan_amoun);

		if (coupan_amoun == 0) {
			map.put(kBookingTotal, total_amunt);
		} else {
			map.put(kBookingTotal, total_amnt_dis);
		}

		map.put(kFacType, fac_type.toLowerCase());


		map.put(kPaymentStatus, "Success");
		map.put(kBookingStatus, "Confirm");
        map.put("payment_source","android");

		map.put(kCovenienceFee, convenience_final_fee);
		map.put(kConvenienceTaxes, printConveTexes);


		Log.e("sendcarat", map.toString());

		ModelManager.modelManager().userBooking(map, (Constants.Status iStatus, GenericResponse<BookingStatusResponse> genericResponse) -> {
			loaderView.hideLoader();
			try {
				BookingStatusResponse msg = genericResponse.getObject();
				//Toaster.customToast(msg);
				//CongratsDialog(msg.getMsg());
				orderId = msg.getOrderId();
				payNow();

				Log.d("OrderId", orderId);
				//Log.e(TAG,"msg: " +msg);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);
		});


	}


	private void CongratsDialog(String user) {
		final Dialog dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_congrats_screen_trans_sucess);
		dialog.setCancelable(false);
		TextView tv_msg = dialog.findViewById(R.id.tv_msg);
		tv_msg.setText(user);
		dialog.findViewById(R.id.btn_continue).setOnClickListener(v -> {
			dialog.dismiss();

			//changeFragment(new UserBookingFragment(), false, false, getString(R.string.book));

			Intent intent = new Intent(context, UserDashboardActivity.class);
			intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
			intent.putExtra("FRAG", "2");
			intent.putExtra("Value", "3");
			startActivity(intent);
			finish();


		});

		dialog.show();
	}


	private void getApplyCoupan() {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put("coupon_code", coupancode);
		map.put("coupon_price", total_amunt);
		Log.e("send carat", map.toString());

		ModelManager.modelManager().userApplyCoupan(map, (Constants.Status iStatus, GenericResponse<JSONObject> genericResponse) -> {
			loaderView.hideLoader();
			try {
				JSONObject jsonObject = genericResponse.getObject();
				coupan_amoun = Integer.parseInt(jsonObject.getString("coupon_flat_amount"));
				tv_add_charges.setText(coupan_amoun);
				et_appy_coupan.setText("");
				tv_coupan_applyed.setVisibility(View.VISIBLE);
				if (coupan_amoun == 0) {
					tv_add_charges.setText("0");
				} else {
					total_amnt_dis = total_amunt;
					total_amunt = total_amunt - coupan_amoun;

					//tv_amount.setText(getResources().getString(R.string.Rs) + String.valueOf(total_amunt));

					getProfileSummayStatus();

					//tv_total.setText(total_amuntt-coupan_amoun);

					Log.d("finalamount", total_amunt + "/" + total_amuntt + "");
				}

				//Toaster.customToast(msg);
				//Log.e(TAG,"msg: " +msg);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			loaderView.hideLoader();
			Toaster.customToast(message);

			coupan_amoun = 0;
			//tv_add_charges.setText(coupan_amoun);
			total_amunt = 0;
			if (fac_type.equalsIgnoreCase("Event")) {
				getEventDetails();
			} else {
				getDeleteCart();
			}
			Log.d("finalamount", total_amunt + "/" + total_amuntt + "");
			getProfileSummayStatus();
			//tv_amount.setText(getResources().getString(R.string.Rs) + String.valueOf(total_amunt));

			//getProfileSummayStatus();

			//tv_total.setText(total_amuntt-coupan_amoun);


			et_appy_coupan.setText("");
			tv_coupan_applyed.setVisibility(View.GONE);
		});


	}

    /*private void getDeleteCart(JSONArray array) {
        loaderView.showLoader();
        HashMap<String, Object> map = new HashMap<>();
        map.put(kaddcart, array);
        Log.e("e", map.toString());
        ModelManager.modelManager().userAddtocart(map,
                (Constants.Status iStatus, GenericResponse<UserAddcartList> genericResponse) -> {
                    //loaderView.hideLoader();
                    try {
                        userAddcartt = genericResponse.getObject();
                        mdata=userAddcartt.getUserAddcart();
                        batchSlotBookAdapter=new BatchSlotBookClaenderCartAdapter(context, mdata);
                        rv_book_detail.setAdapter(batchSlotBookAdapter);
                        batchSlotBookAdapter.notifyDataSetChanged();
                        loaderView.hideLoader();
                        for(int i=0;i<mdata.size();i++){
                            total_amunt+=Integer.parseInt(mdata.get(i).getSlotPacPrice());

							if(trial_status.equalsIgnoreCase("Yes")){
								total_amunt=0;
								tv_amount.setText(getResources().getString(R.string.Rs) +String.valueOf(total_amunt));
								tv_total.setText(getResources().getString(R.string.Rs) +String.valueOf(total_amunt));
							}else{
								tv_amount.setText(getResources().getString(R.string.Rs)+String.valueOf(total_amunt));
								tv_total.setText(getResources().getString(R.string.Rs)+String.valueOf(total_amunt));
							}


                        }


                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                    loaderView.hideLoader();
                }, (Constants.Status iStatus, String message) -> Toaster.customToast(message));
    }*/

	private void getProfileSummayStatus() {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId,"");

		Log.e("send", parameters.toString());
		ModelManager.modelManager().usergetConvenienceCharge(parameters,
			(Constants.Status iStatus, GenericResponse<JSONObject> genericResponse) -> {
				try {
					JSONObject jsonObject = genericResponse.getObject();

					conveniencePersantage = jsonObject.getString(kConvenicesPersantage);
					conveFees = jsonObject.getString(kconveniencemaxfees);
					conveTexes = jsonObject.getString(kconveniensTexes);
					coneType = jsonObject.getString(kconvenienceTyep);


					printconperofTotal = (int) Math.floor(((total_amunt) * Integer.parseInt(conveniencePersantage)) / 100); // gives 2
					convenience_final_fee = (int) Math.floor(((printconperofTotal) / 1.18));
					Log.d("persantage", printconperofTotal + "");

					if (convenience_final_fee > Integer.parseInt(conveFees)) {
						convenience_final_fee = 0;
						convenience_final_fee = Integer.parseInt(conveFees);
						// gives 2
						printConveTexes = (int) Math.floor(((convenience_final_fee) * Integer.parseInt(conveTexes)) / 100);

						Log.d("persantage1", convenience_final_fee + "");
						Log.d("persantage2", printConveTexes + "");// gives 2
					} else {
						Log.d("persantage1", convenience_final_fee + "");

						printConveTexes = (int) Math.floor(((convenience_final_fee) * Integer.parseInt(conveTexes)) / 100);

						Log.d("persantage2", printConveTexes + "");// gives 2
					}


					//printConvesnies=convenience_final_fee-printConveTexes;


					tv_convenience_fee.setText(String.valueOf(convenience_final_fee));

					tv_with_tax.setText("GST On Convenience Fee" + "(" + conveTexes + "%" + ")");

					tv_convenience_taxes.setText(String.valueOf(printConveTexes));

					total_amuntt = total_amunt + convenience_final_fee + printConveTexes;

					tv_total.setText(String.valueOf(total_amuntt));

					Log.d("conve", "Per" + conveniencePersantage + ".." + "fees" + conveFees + ".." + "conTexes" + conveTexes + ".." + "conType" + coneType + "....." + "finalPers" + printconperofTotal + "/" + printConveTexes + "/" + printConvesnies);


					//printConvesnies=

				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));


	}

	private void reviewDialog(String cart_id, int pos) {
		// dialog
		dialog = new Dialog(context);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_alert);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

		dialog.findViewById(R.id.btn_remove).setOnClickListener(v -> {
			dialog.dismiss();
			getDeleteItemCart(cart_id, pos);
		});

		dialog.findViewById(R.id.btn_cancel).setOnClickListener(v -> {
			dialog.dismiss();
		});

		dialog.show();
	}

	private void getDeleteItemCart(String cart_id, int pos) {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kCartId, cart_id);
		ModelManager.modelManager().userCartDelete(map, new Block.Status() {
			@Override
			public void iStatus(Constants.Status iStatus) {

				if (mdata.size() > 0) {
					mdata.remove(pos);
					total_amunt = 0;
					booked_slot="";
					getDeleteCart();

					for (int i = 0; i < mdata.size(); i++) {
						//total_amunt += Integer.parseInt(mdata.get(i).getSlotPacPrice());
						//tv_amount.setText(getResources().getString(R.string.Rs) + String.valueOf(total_amunt));
						//tv_total.setText(String.valueOf(total_amunt));
						if(mdata.get(i).getSlotAvailable().equalsIgnoreCase("booked")){
							booked_slot=mdata.get(i).getSlotAvailable();
						}else{
							//booked_slot="";
						}
					}

					if (coupan_amoun == 0) {

					} else {

						if (total_amunt > 0) {
							total_amunt = total_amunt - coupan_amoun;
							//tv_amount.setText(getResources().getString(R.string.Rs) + String.valueOf(total_amunt));
						} else {
							total_amunt = 0;
						}


					}

					/*if(trial_status.equalsIgnoreCase("Yes")){
							total_amunt=0;
							tv_amount.setText(getResources().getString(R.string.Rs)+String.valueOf(total_amunt));
							tv_total.setText(String.valueOf(total_amunt));
						}else{
						}*/





					Toaster.customToast("Slot/Batch removed successfully");
					//tv_cart_count.setText("(" + String.valueOf(mdata.size() + ")"));
					loaderView.hideLoader();
					/*if(mdata.size()==0){
						rv_list_top.setVisibility(View.GONE);
						rv_cart.setVisibility(View.VISIBLE);
					}*/
				} else {

				}
				getProfileSummayStatus();

			}
		}, new Block.Failure() {
			@Override
			public void iFailure(Constants.Status iStatus, String error) {
				loaderView.hideLoader();
				Toaster.customToast("Something went wrong");
			}
		});


	}

	private void getDeleteCart() {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kSportId, sport_id);
		map.put(kFacType, fac_type);
		Log.e("e", map.toString());
		ModelManager.modelManager().getCartList(map,
			(Constants.Status iStatus, GenericResponse<UserAddcartList> genericResponse) -> {
				//loaderView.hideLoader();
				try {
					userAddcartt = genericResponse.getObject();
					mdata = userAddcartt.getUserAddcart();
					batchSlotBookAdapter = new BatchSlotBookClaenderCartAdapter(context, mdata, new BatchSlotBookClaenderCartAdapter.ItemClickListener() {
						@Override
						public void buttonPress(String cart_id, int pos) {
							reviewDialog(cart_id, pos);
						}
					});
					rv_book_detail.setAdapter(batchSlotBookAdapter);
					batchSlotBookAdapter.notifyDataSetChanged();
					loaderView.hideLoader();


					for (int i = 0; i < mdata.size(); i++) {
						total_amunt += Integer.parseInt(mdata.get(i).getSlotPacPrice());
						tv_amount.setText(String.valueOf(total_amunt));
						//tv_total.setText(String.valueOf(total_amunt));

						if(mdata.get(i).getSlotAvailable().equalsIgnoreCase("booked")){
							booked_slot=mdata.get(i).getSlotAvailable();
						}else{

						}

						Log.d("Booked",booked_slot);

					}

					getProfileSummayStatus();



				} catch (Exception e) {
					e.printStackTrace();
				}
				loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			}


		);
	}

	private void getEventDetails() {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kEventId, eventId);

		Log.e("e", map.toString());
		ModelManager.modelManager().getEventDetails(map,
			(Constants.Status iStatus, GenericResponse<EventDetails> genericResponse) -> {
				//loaderView.hideLoader();
				try {
					EventDetails eventDetails = genericResponse.getObject();

					rv_book_detail = findViewById(R.id.rv_book_detail);
					rv_book_detail.setVisibility(View.GONE);
					ll_event_details = findViewById(R.id.ll_event_details);
					ll_event_details.setVisibility(View.VISIBLE);
					fac_id = eventDetails.getFacId();
					sport_id = eventDetails.getSportId();
					tv_start_date.setText(eventDetails.getSdate());
					tv_end_date.setText(eventDetails.getEdate());
					tv_start_time.setText(eventDetails.getStime());
					tv_end_time.setText(eventDetails.getEtime());
					//tve_price.setText(getResources().getString(R.string.Rs) + " " + eventDetails.getPrice());
					tv_sport_event.setVisibility(View.VISIBLE);
					tv_sport_event.setText("Event: ");
					tv_fac_name.setText(eventDetails.getFacName());
					tv_sports.setVisibility(View.VISIBLE);
					tv_sports.setText(eventDetails.getEventName());
					total_amunt = Integer.parseInt(eventDetails.getPrice());
					tv_amount.setText(eventDetails.getPrice());
					tv_total.setText(eventDetails.getPrice());

					booked_slot=eventDetails.getEventavailable();

					Log.d("booked_slot",eventDetails.getEventavailable());

					if(booked_slot.equalsIgnoreCase("booked")){
						tv_eventAvailable.setVisibility(View.VISIBLE);
						tv_eventAvailable.setText("This is no longer available");
					}else{
						tv_eventAvailable.setVisibility(View.GONE);
					}


					getProfileSummayStatus();

				} catch (Exception e) {
					e.printStackTrace();
				}
				loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			}


		);
	}

	private void getDeleteCartt() {
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kSportId, sport_id);
		map.put(kFacType, fac_type);
		Log.e("e", map.toString());
		ModelManager.modelManager().getCartList(map,
			(Constants.Status iStatus, GenericResponse<UserAddcartList> genericResponse) -> {
				loaderView.hideLoader();
				try {
					userAddcartt = genericResponse.getObject();
					mdata = userAddcartt.getUserAddcart();
					batchSlotBookAdapter.newData(mdata);
					rv_book_detail.setAdapter(batchSlotBookAdapter);
					batchSlotBookAdapter.notifyDataSetChanged();
					loaderView.hideLoader();


					for (int i = 0; i < mdata.size(); i++) {
						//total_amunt += Integer.parseInt(mdata.get(i).getSlotPacPrice());
						//tv_amount.setText(getResources().getString(R.string.Rs) + String.valueOf(total_amunt));
						//tv_total.setText(String.valueOf(total_amunt));

						if(mdata.get(i).getSlotAvailable().equalsIgnoreCase("booked")){
							booked_slot=mdata.get(i).getSlotAvailable();
							break;
						}else{
							//booked_slot="";
							/*total_amunt += Integer.parseInt(mdata.get(i).getSlotPacPrice());
							tv_amount.setText(getResources().getString(R.string.Rs) + String.valueOf(total_amunt));*/
						}

					}

					if(booked_slot.equalsIgnoreCase("booked")){


					}else{
						getBookingreguest();
					}
					//getProfileSummayStatus();



				} catch (Exception e) {
					e.printStackTrace();
				}
				//loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			}


		);
	}

	private void getEventDetailss() {
		//loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kEventId, eventId);

		Log.e("e", map.toString());
		ModelManager.modelManager().getEventDetails(map,
			(Constants.Status iStatus, GenericResponse<EventDetails> genericResponse) -> {
				//loaderView.hideLoader();
				try {
					EventDetails eventDetails = genericResponse.getObject();

					rv_book_detail = findViewById(R.id.rv_book_detail);
					rv_book_detail.setVisibility(View.GONE);
					ll_event_details = findViewById(R.id.ll_event_details);
					ll_event_details.setVisibility(View.VISIBLE);
					fac_id = eventDetails.getFacId();
					sport_id = eventDetails.getSportId();
					tv_start_date.setText(eventDetails.getSdate());
					tv_end_date.setText(eventDetails.getEdate());
					tv_start_time.setText(eventDetails.getStime());
					tv_end_time.setText(eventDetails.getEtime());
					//tve_price.setText(getResources().getString(R.string.Rs) + " " + eventDetails.getPrice());
					tv_sport_event.setVisibility(View.VISIBLE);
					tv_sport_event.setText("Event: ");
					tv_fac_name.setText(eventDetails.getFacName());
					tv_sports.setVisibility(View.VISIBLE);
					tv_sports.setText(eventDetails.getEventName());
					total_amunt = Integer.parseInt(eventDetails.getPrice());
					tv_amount.setText(eventDetails.getPrice());
					tv_total.setText(eventDetails.getPrice());

					booked_slot=eventDetails.getEventavailable();

					Log.d("booked_slot",eventDetails.getEventavailable());

					if(booked_slot.equalsIgnoreCase("booked")){
						tv_eventAvailable.setVisibility(View.VISIBLE);
						tv_eventAvailable.setText("This is no longer available");
					}else{
						tv_eventAvailable.setVisibility(View.GONE);
						getBookingreguest();
					}

					getProfileSummayStatus();

				} catch (Exception e) {
					e.printStackTrace();
				}
				//loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				//loaderView.hideLoader();
				Toaster.customToast(message);
			}


		);
	}

}
