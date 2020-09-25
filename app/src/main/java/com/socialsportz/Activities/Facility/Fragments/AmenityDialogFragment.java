package com.socialsportz.Activities.Facility.Fragments;

import android.app.Dialog;
import android.content.Intent;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.ImageView;
import android.widget.ProgressBar;

import com.squareup.picasso.Picasso;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.FacAmenity;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DividerItemRecyclerDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.DialogFragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.EDIT_AMENITY_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kAction;
import static com.socialsportz.Constants.Constants.kAmenities;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;
import static com.socialsportz.Constants.Constants.kUserId;

public class AmenityDialogFragment extends DialogFragment {

    private static final String TAG = AmenityDialogFragment.class.getSimpleName();
    private AmenityAdapter mAdapter;
    private RecyclerView recyclerView;
    private CustomLoaderView loaderView;
    private List<FacAmenity> amenityList;
	CopyOnWriteArrayList<Amenity> amenities;
	ProgressBar progress_bar;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth  = mArgs.getInt(KSCREENWIDTH);
        amenityList = (List<FacAmenity>) mArgs.getSerializable(kData);
        Dialog d = getDialog();
        if (d!=null){
            Objects.requireNonNull(d.getWindow()).setLayout(pWidth-100, pHeight-100);
            d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
            Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
            d.getWindow().setBackgroundDrawable(drawable);
            //d.getWindow().addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            //d.getWindow().setStatusBarColor(getResources().getColor(R.color.theme_color));
        }

    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_dialog_edit_amenity, container, false);
        loaderView = CustomLoaderView.initialize(getActivity());
		progress_bar=view.findViewById(R.id.progress_bar);
        recyclerView = view.findViewById(R.id.rvListing);
        recyclerView.setHasFixedSize(true);
        recyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
        recyclerView.addItemDecoration(new DividerItemRecyclerDecoration(getActivity(), R.drawable.canvas_recycler_divider));

        Toolbar toolbar = view.findViewById(R.id.toolbar);
        toolbar.inflateMenu(R.menu.menu_day_time);

        // Set an OnMenuItemClickListener to handle menu item clicks
        toolbar.setOnMenuItemClickListener(menuItem -> {
            if(menuItem.getItemId()== R.id.action_done){
                if(mAdapter.getCheckedList().isEmpty())
                    Toaster.customToast("Please select any choice");
                else {
                    setFacAmenities();
                }
                return true;
            }else {
                return false;
            }
        });

        toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());
		getAmenitiesData();

        return view;
    }

    private void setList(CopyOnWriteArrayList<Amenity> amenities){
        //CopyOnWriteArrayList<Amenity> amenities = ModelManager.modelManager().getCurrentUser().getAmenities();
        for (int i=0;i<amenities.size();i++){
            for(int j=0;j<amenityList.size();j++){
                if(amenities.get(i).getAmenityId()==amenityList.get(j).getAmenityId()){
					amenities.get(i).setStatus(true);
                    Log.e(TAG,String.valueOf(amenities.get(i).getAmenityId()));
                    break;
                }
            }
        }

        mAdapter = new AmenityAdapter(amenities);
        recyclerView.setAdapter(mAdapter);
    }

    private void getAmenitiesData(){
		progress_bar.setVisibility(View.VISIBLE);
        HashMap<String,Object> parameters = new HashMap<>();
        parameters.put(kAction, "test");

        Log.e("send",parameters.toString());
        ModelManager.modelManager().userAmenities(parameters,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Amenity>> genericResponse) -> {
					progress_bar.setVisibility(View.GONE);
        	try {
						amenities = genericResponse.getObject();
						setList(amenities);
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {progress_bar.setVisibility(View.GONE);;Toaster.customToast(message);
        });
    }

    private void setFacAmenities(){
        loaderView.showLoader();
        JSONArray array = Utils.generateJsonArrayAmenities(mAdapter.getCheckedList());
        Log.e(TAG,array.toString());

        HashMap<String,Object> map = new HashMap<>();
        map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
        map.put(kAmenities,array);
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userAddFacilityAmenities(map,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<FacAmenity>> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        CopyOnWriteArrayList<FacAmenity> list = genericResponse.getObject();
                        Intent in = Objects.requireNonNull(getActivity()).getIntent();
                        (Objects.requireNonNull(getTargetFragment())).onActivityResult(getTargetRequestCode(),EDIT_AMENITY_RESULT,in);
                        Objects.requireNonNull(getDialog()).dismiss();
                        Log.e(TAG,list.toString());
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                    Toaster.customToast("Successfully Added");
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }

    class AmenityAdapter extends RecyclerView.Adapter<AmenityAdapter.AmenityHolder> {

        List<Amenity> myItemList;

        AmenityAdapter(List<Amenity> itemsList) {
            this.myItemList = itemsList;
        }

        @NonNull
        @Override
        public AmenityDialogFragment.AmenityAdapter.AmenityHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
            View view = LayoutInflater.from(getContext()).inflate(R.layout.row_fac_amenity_listing, parent, false);
            return new AmenityDialogFragment.AmenityAdapter.AmenityHolder(view);
        }

        @Override
        public void onBindViewHolder(@NonNull AmenityDialogFragment.AmenityAdapter.AmenityHolder holder, int position) {
            Amenity item = myItemList.get(position);
            holder.bindContent(item);
            holder.chAmenity.setText(item.getAmenityName());
            String path = kImageBaseUrl+item.getFolderName()+"/"+item.getAmenityIcon();
            Picasso.with(getActivity()).load(path).placeholder(R.drawable.amenities).into(holder.ivAmenity);
            if(item.isStatus())
                holder.chAmenity.setChecked(true);
            holder.chAmenity.setOnCheckedChangeListener((compoundButton, b) -> {
                if(b)
                    item.setStatus(true);
                else
                    item.setStatus(false);
            });
        }

        @Override
        public int getItemCount() {
            return myItemList.size();
        }

        List<Amenity> getCheckedList(){
            ArrayList<Amenity> list = new ArrayList<>();
            for(Amenity items:myItemList){
                if(items.isStatus())
                    list.add(items);
            }
            return list;
        }

        class AmenityHolder extends RecyclerView.ViewHolder {

            Amenity item;
            private CheckBox chAmenity;
            private ImageView ivAmenity;

            AmenityHolder(View itemView) {
                super(itemView);
                chAmenity = itemView.findViewById(R.id.ch_amenity);
                ivAmenity = itemView.findViewById(R.id.iv_amenity);
            }

            void bindContent(Amenity item) {
                this.item = item;
            }

        }
    }
}
