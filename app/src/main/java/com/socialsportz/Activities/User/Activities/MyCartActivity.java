package com.socialsportz.Activities.User.Activities;

import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.socialsportz.Activities.User.Adapters.BatchSlotBookCartAdapter;
import com.socialsportz.Blocks.Block;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.User.UserAddcart;
import com.socialsportz.Models.User.UserAddcartList;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.kBatchSlotId;
import static com.socialsportz.Constants.Constants.kCartId;
import static com.socialsportz.Constants.Constants.kFacType;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kUserId;

public class MyCartActivity extends AppCompatActivity {

	private Context context;
	private BatchSlotBookCartAdapter batchSlotBookAdapter;
	private RecyclerView rv_list;
	RelativeLayout rv_cart, rv_list_top;
	private ImageButton ib_back;
	String fac_type = "", sportname = "", fac_id = "",facName="", sport_id = "",trial_status="",trial_statuss="";
	TextView tv_fac_aca_name, tv_sports, tv_amount, tv_add_charges, tv_total, tv_apply;
	EditText et_appy_coupan;
	UserAddcartList userAddcart;
	BatchSlotBookCartAdapter.ItemClickListener itemClickListener;
	CopyOnWriteArrayList<UserAddcart> mdata = new CopyOnWriteArrayList<>();
	int total_amunt = 0;
	JSONArray jsonArray_id = new JSONArray();
	JSONArray jsonArray_new;
	Dialog dialog;
	UserAddcartList userAddcartt;
	CustomLoaderView loaderView;
	TextView tv_amt, tv_cart_count;
	UserAddcart  newUserAddcart;
	int count;
	LinearLayout bottom_layout;
	Button btn_add_cart;
	ArrayList<String> trial_array=new ArrayList<>();
	TextView tv_page_title;
	TextView tv_select;


	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_my_cart);
		context = this;
		loaderView = CustomLoaderView.initialize(context);
		getIntentValue();
		inItView();


	}

	@Override
	protected void onResume() {
		super.onResume();
		total_amunt=0;

		getDeleteCart();
		//getDeleteCartt();
	}

	public void getIntentValue() {
		Bundle b = getIntent().getExtras();
		if (b != null)
			fac_type = b.getString("TYPE");
		fac_id = String.valueOf(b.getInt("ID"));
		sport_id = String.valueOf(b.getInt("SportId"));
		trial_status=b.getString("TRIAL");
		facName=b.getString("FACNAME");
		sportname = b.getString("SPORTNAME");

		Log.d("isTrial","/"+trial_status+"///"+trial_statuss+"/"+sportname+"/"+facName);

		/*String jsonArray = b.getString("Bundle");
		try {
			jsonArray_id = new JSONArray(jsonArray);

		} catch (JSONException e) {
			e.printStackTrace();
		}

		String jsondata = b.getString("Bundle1");

		try {
			jsonArray_new = new JSONArray(jsondata);
		} catch (JSONException e) {
			e.printStackTrace();
		}*/

		Log.d("json", jsonArray_id.toString() + "/" + sport_id + "/" + fac_id + sportname + "/" + fac_id);


	}

	private void inItView() {
		tv_select=findViewById(R.id.tv_select);
		rv_cart = findViewById(R.id.rv_cart);
		rv_list_top = findViewById(R.id.rv_list_top);
		bottom_layout=findViewById(R.id.bottom_layout);
		ib_back = findViewById(R.id.ib_back);
		ib_back.setOnClickListener(v -> {
			finish();
		});
		rv_list = findViewById(R.id.rv_list);
		tv_cart_count = findViewById(R.id.tv_cart_count);

		tv_page_title=findViewById(R.id.tv_page_title);
		if (fac_type.equalsIgnoreCase("Academy")) {
			tv_page_title.setText("Book Batch");
			tv_select.setText("Total Batch");
		} else {
			tv_page_title.setText("Book Slot");
			tv_select.setText("Total Slot");
		}
		tv_fac_aca_name = findViewById(R.id.tv_fac_aca_name);
		tv_fac_aca_name.setText(facName);

		tv_sports = findViewById(R.id.tv_sports);

		if (sportname.isEmpty()) {
			tv_sports.setVisibility(View.GONE);
		} else {
			tv_sports.setVisibility(View.VISIBLE);
			tv_sports.setText(sportname);
		}


		tv_sports = findViewById(R.id.tv_sports);
		tv_amount = findViewById(R.id.tv_amount);
		tv_add_charges = findViewById(R.id.tv_add_charges);
		tv_total = findViewById(R.id.tv_total);
		tv_apply = findViewById(R.id.tv_apply);
		et_appy_coupan = findViewById(R.id.et_appy_coupan);

		LinearLayoutManager mLayoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		rv_list.setLayoutManager(mLayoutManager);
		rv_list.addItemDecoration(new SpaceItemDecoration(20));
		/*batchSlotBookAdapter = new BatchSlotBookCartAdapter(context, mdata, itemClickListener);
		rv_list.setAdapter(batchSlotBookAdapter);*/


		tv_amt = findViewById(R.id.tv_amt);

		btn_add_cart=findViewById(R.id.btn_add_cart);

		btn_add_cart.setOnClickListener(v -> {

			trial_array=batchSlotBookAdapter.getTrial();


			for(int i=0;i<trial_array.size();i++){
				trial_status=trial_array.get(i);
				//Log.d("isTrial2","/"+trial_status+"///"+trial_array.size()+"");

			}

			Log.d("isTrial2","/"+trial_status+"///"+trial_array.size()+"");
			if(trial_status.equalsIgnoreCase("yes")){
				if(mdata.size()>1){
					Toaster.customToast("At a single time you can book a single trial or book batch.Please remove one trial");
				}else{
					Intent intent = new Intent(context, UserCalenderCheckoutActivity.class);
					intent.putExtra("TYPE", fac_type);
					intent.putExtra("ID", fac_id);
					intent.putExtra("SportId", sport_id);
					intent.putExtra("SPORTNAME", sportname);
					intent.putExtra("TRIAL",trial_status);
					intent.putExtra("FACNAME",facName);
					intent.putExtra("FROM","2");
					startActivity(intent);
				}
			}else{
				Intent intent = new Intent(context, UserCalenderCheckoutActivity.class);
				intent.putExtra("TYPE", fac_type);
				intent.putExtra("ID", fac_id);
				intent.putExtra("SportId", sport_id);
				intent.putExtra("SPORTNAME", sportname);
				intent.putExtra("TRIAL",trial_status);
				intent.putExtra("FACNAME",facName);
				intent.putExtra("FROM","2");
				startActivity(intent);
			}


		});

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
					for (int i = 0; i < mdata.size(); i++) {

						/*trial_array=new ArrayList<>();
						trial_array.add(mdata.get(i).getIsTrial());*/
						total_amunt += Integer.parseInt(mdata.get(i).getSlotPacPrice());
						tv_amt.setText(String.valueOf(total_amunt));
						/*if(trial_status.equalsIgnoreCase("Yes")){
							total_amunt=0;
							tv_amt.setText(String.valueOf(total_amunt));
						}else{
							tv_amt.setText(String.valueOf(total_amunt));
						}*/


					}


					/*if(trial_array.size()>1){
						trial_status="yes";
					}else{
						trial_status="";
					}*/
					batchSlotBookAdapter.notifyDataSetChanged();
					Toaster.customToast("Slot/Batch removed successfully");
					tv_cart_count.setText("(" + String.valueOf(mdata.size() + ")"));
					loaderView.hideLoader();

					if(mdata.size()==0){
						rv_list_top.setVisibility(View.GONE);
						bottom_layout.setVisibility(View.GONE);
						rv_cart.setVisibility(View.VISIBLE);
					}
				}else{

				}


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
		map.put(kFacType,fac_type);
		Log.e("e", map.toString());
		ModelManager.modelManager().getCartList(map,
			(Constants.Status iStatus, GenericResponse<UserAddcartList> genericResponse) -> {
				loaderView.hideLoader();
				try {
					userAddcartt = genericResponse.getObject();
					mdata = userAddcartt.getUserAddcart();

					if(mdata.size()==0){
						rv_list_top.setVisibility(View.GONE);
						bottom_layout.setVisibility(View.GONE);
						rv_cart.setVisibility(View.VISIBLE);
					}


					if (mdata.size() > 0) {
						tv_cart_count.setText("(" + String.valueOf(mdata.size() + ")"));
					}

					batchSlotBookAdapter = new BatchSlotBookCartAdapter(context, userAddcartt.getUserAddcart(), new BatchSlotBookCartAdapter.ItemClickListener() {
						@Override
						public void buttonPress(String cart_id, int pos) {

							reviewDialog(cart_id, pos);

						}

					});
					rv_list.setAdapter(batchSlotBookAdapter);
					for (int i = 0; i < mdata.size(); i++) {
						//trial_status=mdata.get(i).getIsTrial();
						trial_array=new ArrayList<>();
						trial_array.add(mdata.get(i).getIsTrial());
						total_amunt += Integer.parseInt(mdata.get(i).getSlotPacPrice());
						tv_amt.setText(String.valueOf(total_amunt));

						Log.d("isTrial3",trial_status+""+mdata.size());
					}


					Log.d("isTrial1",trial_status+""+mdata.size());





				} catch (Exception e) {
					e.printStackTrace();
				}
				loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				if(mdata.size()==0){
					rv_list_top.setVisibility(View.GONE);
					bottom_layout.setVisibility(View.GONE);
					rv_cart.setVisibility(View.VISIBLE);
				}
			//Toaster.customToast(message);
			});

	}

	private void getDeleteCartt() {
		//loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kSportId, sport_id);
		map.put(kFacType,fac_type);
		Log.e("e", map.toString());
		ModelManager.modelManager().getCartList(map,
			(Constants.Status iStatus, GenericResponse<UserAddcartList> genericResponse) -> {
				//loaderView.hideLoader();
				try {
					userAddcartt = genericResponse.getObject();
					mdata = userAddcartt.getUserAddcart();


					if(mdata.size()==0){
						rv_list_top.setVisibility(View.GONE);
						bottom_layout.setVisibility(View.GONE);
						rv_cart.setVisibility(View.VISIBLE);
					}

					Log.d("mdata",userAddcartt.toString()+"");

					if (mdata.size() > 0) {
						tv_cart_count.setText("(" + String.valueOf(mdata.size() + ")"));
					}

					batchSlotBookAdapter = new BatchSlotBookCartAdapter(context, userAddcartt.getUserAddcart(), new BatchSlotBookCartAdapter.ItemClickListener() {
						@Override
						public void buttonPress(String cart_id, int pos) {

							reviewDialog(cart_id, pos);

						}

					});
					rv_list.setAdapter(batchSlotBookAdapter);
					//loaderView.hideLoader();
					for (int i = 0; i < mdata.size(); i++) {
						//trial_status=mdata.get(i).getIsTrial();
						total_amunt += Integer.parseInt(mdata.get(i).getSlotPacPrice());
						tv_amt.setText(String.valueOf(total_amunt));

						/*if(trial_status.equalsIgnoreCase("Yes")){
							total_amunt=0;
							tv_amt.setText(String.valueOf(total_amunt));
						}else{
							tv_amt.setText(String.valueOf(total_amunt));
						}*/

						Log.d("ToatlAmt",trial_status+""+mdata.size());
					}




				} catch (Exception e) {
					e.printStackTrace();
				}
				//loaderView.hideLoader();
			}, (Constants.Status iStatus, String message) -> {
				//loaderView.hideLoader();
				if(mdata.size()==0){
					rv_list_top.setVisibility(View.GONE);
					bottom_layout.setVisibility(View.GONE);
					rv_cart.setVisibility(View.VISIBLE);
				}
				Toaster.customToast(message);
			});

	}
}
