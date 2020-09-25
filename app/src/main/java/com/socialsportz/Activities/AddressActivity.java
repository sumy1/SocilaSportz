package com.socialsportz.Activities;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.google.gson.JsonObject;
import com.socialsportz.APIManager.ApiInterface;
import com.socialsportz.APIManager.ApiManager;
import com.socialsportz.R;
import com.socialsportz.Utils.DividerItemRecyclerDecoration;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

import static com.socialsportz.Constants.Constants.kDescription;
import static com.socialsportz.Constants.Constants.kId;
import static com.socialsportz.Constants.Constants.kStatus;

public class AddressActivity extends AppCompatActivity implements View.OnClickListener{

    private static final String TAG = AddressActivity.class.getSimpleName();

    private EditText mSearchEditText;
    private ImageView mClear;
    private ProgressBar progressBar;
    private AddressAdapter addressAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        overridePendingTransition(R.anim.activity_open_translate, R.anim.activity_close_scale);
        setContentView(R.layout.activity_location_change_layout);
        progressBar = findViewById(R.id.progress_bar);

        RecyclerView mRecyclerView = findViewById(R.id.list_search);
        mSearchEditText = findViewById(R.id.search_et);

        addressAdapter = new AddressAdapter(new ArrayList<>());
        mRecyclerView.setHasFixedSize(false);
        mRecyclerView.setLayoutManager(new LinearLayoutManager(this));
        RecyclerView.ItemDecoration itemDecoration = new DividerItemRecyclerDecoration(this, R.drawable.canvas_recycler_divider);
        //recyclerView.addItemDecoration(new ItemOffsetDecoration(getContext(), R.dimen.item_offset));
        mRecyclerView.addItemDecoration(itemDecoration);
        mRecyclerView.setAdapter(addressAdapter);
        // adding text change listener to search
        mSearchEditText.addTextChangedListener(textWatcher);


        mClear = findViewById(R.id.clear);
        mClear.setOnClickListener(this);
    }

    TextWatcher textWatcher = new TextWatcher() {
        long lastChange = 0;
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) { }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count) {

            if (s.length() > 0) {
                new Handler().postDelayed(() -> {
                    if (System.currentTimeMillis() - lastChange >= 300) {
                        //send request
                        requestPlaces(s.toString());
                    }
                }, 300);
                lastChange = System.currentTimeMillis();

            }
            if (count > 0) {
                mClear.setVisibility(View.VISIBLE);
            } else {
                mClear.setVisibility(View.GONE);
                addressAdapter.clearList();
            }
        }

        @Override
        public void afterTextChanged(Editable s) {
            /*String input = s.toString().trim();
            if (!input.isEmpty()) {
                requestPlaces(input);
            }*/
        }
    };

    private void showProgressBar(boolean b) {
        if (b) {
            progressBar.setVisibility(View.VISIBLE);
        } else {
            progressBar.setVisibility(View.GONE);
        }
    }

    //https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJ9xeBIK_6DDkRPW6lI9ppQZs&key=AIzaSyA6kQor07K5xtlcb0PjiuPkLJomPobRxeI
    public void requestPlaces(String input) {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(ApiManager.kGoogleMapsBaseURL)
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        showProgressBar(true);
        ApiInterface service = retrofit.create(ApiInterface.class);
        service.getPlaces(input, getString(R.string.google_key),"country:IN")
                .enqueue(new Callback<JsonObject>() {
                    @Override
                    public void onResponse(Call<JsonObject> call, Response<JsonObject> response) {
                        try {
                            showProgressBar(false);
                            List<HashMap<String, String>> maps = new ArrayList<>();
                            JsonObject jsonObject = response.body();
                            JSONObject jsonResponse = new JSONObject(jsonObject.toString());
                            String status = jsonResponse.getString(kStatus);
                            if (status.equals("OK")) {
                                JSONArray jsonArray = jsonResponse.getJSONArray("predictions");
                                for (int i = 0; i < jsonArray.length(); i++) {
                                    JSONObject jO = jsonArray.getJSONObject(i);
                                    HashMap<String, String> addressmap = new HashMap<>();
                                    String address = jO.getString("description");
                                    String id = jO.getString("place_id");
                                    addressmap.put(kDescription, address);
                                    addressmap.put(kId, id);
                                    maps.add(addressmap);
                                }
                                addressAdapter.clearList();
                                addressAdapter.addItems(maps);
                                Log.i(TAG, jsonResponse.toString(4) + " " + maps.size());
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }

                    @Override
                    public void onFailure(Call<JsonObject> call, Throwable t) {
                        showProgressBar(false);
                        Log.i(TAG, t.toString());
                    }
                });
    }


    @Override
    protected void onPause() {
        super.onPause();
        overridePendingTransition(R.anim.activity_open_scale, R.anim.activity_close_translate);
    }

    @Override
    public void onClick(View v) {
        if(v.getId()== R.id.clear){
            mSearchEditText.setText("");
            if(addressAdapter!=null){
                addressAdapter.clearList();
            }
        }
    }

    class AddressAdapter extends RecyclerView.Adapter<AddressAdapter.ViewHolder> {

        private List<HashMap<String, String>> list;

        AddressAdapter(List<HashMap<String, String>> list) {
            this.list = list;
        }

        /* Clear List items */
        void clearList(){
            if(list!=null && list.size()>0){
                list.clear();
            }
            notifyDataSetChanged();
        }

        void addItems(List<HashMap<String, String>> mapslist){
            list.addAll(mapslist);
            notifyDataSetChanged();
        }

        @NonNull
        @Override
        public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
            View layoutView = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_placesearch, parent, false);
            return new ViewHolder(layoutView);
        }

        @Override
        public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
            HashMap<String, String> address = list.get(position);
            holder.bindView(address);
            String id = address.get(kId);
            String addressText = address.get(kDescription);
            holder.tvAddress.setTag(id);
            holder.tvAddress.setText(addressText);
            holder.tvAddress.setOnClickListener(v -> {
                Intent data = new Intent();
                data.putExtra("id", id);
                data.putExtra("address", addressText);
                setResult(AddressActivity.RESULT_OK, data);
                finish();
                //hashMaps.clear();
                //notifyDataSetChanged();
            });
        }

        @Override
        public int getItemCount() {
            return list.size();
        }

        class ViewHolder extends RecyclerView.ViewHolder {

            HashMap<String, String> map;
            TextView tvAddress;

            ViewHolder(View itemView) {
                super(itemView);
                tvAddress = itemView.findViewById(R.id.tv_address);
            }

            void bindView(HashMap<String, String> addressMap) {
                this.map = addressMap;
            }
        }
    }

}
