package com.socialsportz.Activities.Facility.Fragments;

import android.app.DatePickerDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.socialsportz.Activities.Facility.Adapters.BatchSlotAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotType;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;
import java.util.TimeZone;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static android.app.Activity.RESULT_OK;
import static com.socialsportz.Constants.Constants.BATCH_SLOT_ARCHIVE;
import static com.socialsportz.Constants.Constants.BATCH_SLOT_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kActive;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kEndDate;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kInactive;
import static com.socialsportz.Constants.Constants.kPage;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kStartDate;
import static com.socialsportz.Constants.Constants.kTotal;

public class BatchSlotFragment extends Fragment implements View.OnClickListener {

	private int facId = 0;
	private int sportId = 0;
	private TextView tvStDate, tvEdDate, tvClear, tv_Inactive, tv_active, tv_total;
	private DropDownView dvSport;
	private ShimmerFrameLayout mShimmerViewContainer;
	private RecyclerView rvList;
	private BatchSlotAdapter mAdapter;
	private LinearLayout emptyLayout,ll_archieve;

	private LinearLayoutManager mLayoutManager;
	private boolean loading = true;
	private int page;
	private int pageSize;
	private HashMap<String, Object> map = new HashMap<>();

	private Context context;

	public BatchSlotFragment() {
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
	}

	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
		context = getActivity();
		View rootView = inflater.inflate(R.layout.fragment_batch_slot, container, false);

		initView(rootView);
		initData(0);


		return rootView;
	}

	private void initView(View rootView) {
		emptyLayout = rootView.findViewById(R.id.empty_view);
		mShimmerViewContainer = rootView.findViewById(R.id.shimmer_view_container);
		rvList = rootView.findViewById(R.id.rv_slot);
		tvStDate = rootView.findViewById(R.id.tv_st_date_picker);
		tvEdDate = rootView.findViewById(R.id.tv_ed_date_picker);
		tvClear = rootView.findViewById(R.id.tv_clear);

		tv_Inactive = rootView.findViewById(R.id.tv_Inactive);
		tv_active = rootView.findViewById(R.id.tv_active);
		tv_total = rootView.findViewById(R.id.tv_total);

		ll_archieve=rootView.findViewById(R.id.ll_archieve);
		ll_archieve.setOnClickListener(this);

		rootView.findViewById(R.id.fab).setOnClickListener(this);
		rootView.findViewById(R.id.st_date_layout).setOnClickListener(this);
		rootView.findViewById(R.id.ed_date_layout).setOnClickListener(this);
		rootView.findViewById(R.id.ib_search).setOnClickListener(this);
		rootView.findViewById(R.id.tv_clear).setOnClickListener(this);

		mLayoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		rvList.setLayoutManager(mLayoutManager);
		rvList.addItemDecoration(new SpaceItemDecoration(25));
		rvList.addOnScrollListener(onScrollListener);

		dvSport = rootView.findViewById(R.id.drop_sport);
		dvSport.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
			}

			@Override
			public void onClickDone(int id, String name) {
				sportId = id;
			}

			@Override
			public void onDismiss() {
			}
		});
		setRecyclerView();
	}

	public void initData(int pg) {
		try {
			page = pg;
			facId = ModelManager.modelManager().getCurrentUser().getSelectedFacId();
			getProfileSummayStatus();
			setSportsData();
			if (ModelManager.modelManager().getCurrentUser().getBatchPackages() == null &&
				ModelManager.modelManager().getCurrentUser().getBatchSlotTypes() == null) {
				getPackagesData();
			} else {
				getBatchSlotListing();
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	private void setSportsData() {
		if (facId != 0) {
			CopyOnWriteArrayList<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
			List<FacSport> list = new ArrayList<>();
			for (int i = 0; i < facList.size(); i++) {
				if (facList.get(i).getFacId() == facId) {
					list = facList.get(i).getFacSportList();
					break;
				}
			}
			CopyOnWriteArrayList<Sport> sports = ModelManager.modelManager().getCurrentUser().getSports();
			ArrayList<DataModel> options = new ArrayList<>();
			for (int i = 0; i < sports.size(); i++) {
				for (int j = 0; j < list.size(); j++) {
					if (sports.get(i).getSportId() == list.get(j).getSportId()) {
						options.add(new DataModel(sports.get(i).getSportId(), sports.get(i).getSportName()));
						break;
					}
				}
			}
			dvSport.setOptionList(options);
		}
	}

	private void getProfileSummayStatus() {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());

		Log.e("send",parameters.toString());
		ModelManager.modelManager().usergetSlotCountFacility(parameters,
			(Constants.Status iStatus, GenericResponse<JSONObject> genericResponse) -> {
				try {
					JSONObject jsonObject = genericResponse.getObject();

					tv_Inactive.setText(jsonObject.getString(kInactive));
					tv_active.setText(jsonObject.getString(kActive));
					tv_total.setText(jsonObject.getString(kTotal));

				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));


	}

	private void setRecyclerView() {
		mAdapter = new BatchSlotAdapter(context, new CopyOnWriteArrayList<>(), batchSlot -> {
			if (batchSlot.getType().equals(Constants.BatchSlotEnum.batch.toString()))
				AddEditBatch(batchSlot.getFacId(), batchSlot);
			else if (batchSlot.getType().equals(Constants.BatchSlotEnum.slot.toString()))
				AddEditSlot(batchSlot.getFacId(), batchSlot);
		});
		rvList.setAdapter(mAdapter);
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
						initData(page);
					}
				}
			}
		}
	};

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


	@Override
	public void onClick(View view) {
		if (view.getId() == R.id.fab) {
			CopyOnWriteArrayList<Facility> facilities = ModelManager.modelManager().getCurrentUser().getFacilities();
			if (facilities.isEmpty()) {
				Toaster.customToast("Please Add Facility/Academy");
			} else {
				for (int i = 0; i < facilities.size(); i++) {
					if (facId == facilities.get(i).getFacId()) {
						if (facilities.get(i).getFacSportList().isEmpty())
							Toaster.customToast("Please add sports");
						else {
							if (facilities.get(i).getFacType().equals(Constants.FacType.academy.toString()))
								AddEditBatch(facId, null);
							else if (facilities.get(i).getFacType().equals(Constants.FacType.facility.toString()))
								AddEditSlot(facId, null);
						}
						break;
					}
				}
			}
		} else if (view.getId() == R.id.st_date_layout) {
			Calendar myCalendar = Calendar.getInstance(TimeZone.getDefault());
			int sYear = myCalendar.get(Calendar.YEAR), sMonth = myCalendar.get(Calendar.MONTH), sDay = myCalendar.get(Calendar.DATE);
			Date stDate = Utils.getDate(tvStDate.getText().toString());
			if (stDate != null) {
				myCalendar.setTime(stDate);
				sYear = myCalendar.get(Calendar.YEAR);
				sMonth = myCalendar.get(Calendar.MONTH);
				sDay = myCalendar.get(Calendar.DAY_OF_MONTH);
			}
			DatePickerDialog dialog = new DatePickerDialog(Objects.requireNonNull(getContext()),
				(datePicker, year, monthOfYear, dayOfMonth) -> {
					myCalendar.set(Calendar.YEAR, year);
					myCalendar.set(Calendar.MONTH, monthOfYear);
					myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
					tvStDate.setText(Utils.getDate(myCalendar));
				}, sYear, sMonth, sDay);
			dialog.getDatePicker().setMinDate(Utils.getMinDate());
			dialog.show();
		} else if (view.getId() == R.id.ed_date_layout) {
			Calendar calendar = Calendar.getInstance(TimeZone.getDefault());
			int eYear = calendar.get(Calendar.YEAR), eMonth = calendar.get(Calendar.MONTH), eDay = calendar.get(Calendar.DATE);
			Date edDate = Utils.getDate(tvEdDate.getText().toString());
			if (edDate != null) {
				calendar.setTime(edDate);
				eYear = calendar.get(Calendar.YEAR);
				eMonth = calendar.get(Calendar.MONTH);
				eDay = calendar.get(Calendar.DAY_OF_MONTH);
			}
			DatePickerDialog dateDialog = new DatePickerDialog(Objects.requireNonNull(getContext()),
				(datePicker, year, monthOfYear, dayOfMonth) -> {
					calendar.set(Calendar.YEAR, year);
					calendar.set(Calendar.MONTH, monthOfYear);
					calendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
					tvEdDate.setText(Utils.getDate(calendar));
				}, eYear, eMonth, eDay);
			dateDialog.getDatePicker().setMinDate(Utils.getMinDate());
			dateDialog.show();
		} else if (view.getId() == R.id.ib_search) {
			if (validate()) {
				map.clear();
				if (!tvStDate.getText().toString().isEmpty())
					map.put(kStartDate, Utils.changeDateFormat(tvStDate.getText().toString()));
				if (!tvEdDate.getText().toString().isEmpty())
					map.put(kEndDate, Utils.changeDateFormat(tvEdDate.getText().toString()));
				if (sportId != 0)
					map.put(kSportId, sportId);
				initData(0);
				tvClear.setVisibility(View.VISIBLE);
			}
		} else if (view.getId() == R.id.tv_clear) {
			clearData();
		}else if(view.getId()==R.id.ll_archieve){
			showarchieve(facId);


		}
	}

	public void clearData() {
		map.clear();
		tvStDate.setText("");
		tvEdDate.setText("");
		dvSport.setText("");
		sportId = 0;
		initData(0);
		tvClear.setVisibility(View.GONE);
		loading = true;
	}

	private boolean validate() {
		boolean isOk = true;
		if (facId == 0) {
			isOk = false;
			Toaster.customToast("Please Add Facility/Academy");
		} else if (tvStDate.getText().toString().isEmpty() && tvEdDate.getText().toString().isEmpty()
			&& dvSport.getText().toString().isEmpty()) {
			Toaster.customToast("Select any data");
			isOk = false;
		}/* else if(!tvStDate.getText().toString().isEmpty() && tvEdDate.getText().toString().isEmpty()){
            Toaster.customToast("Select End Date");
            isOk=false;
        } else if(tvStDate.getText().toString().isEmpty() && !tvEdDate.getText().toString().isEmpty()){
            Toaster.customToast("Select Start Date");
            isOk=false;
        }*/ else if (!tvStDate.getText().toString().isEmpty() && !tvEdDate.getText().toString().isEmpty()) {
			if (!Utils.getDateCompare(tvStDate.getText().toString(), tvEdDate.getText().toString())) {
				Toaster.customToast("Start Date should be lower than End Date");
				isOk = false;
			}
		} /*else if(mAdapter.getItemCount()==0){
            isOk = false;
            Toaster.customToast("Please Add Batch/Slot");
        }*/
		return isOk;
	}

	private void AddEditSlot(int facId, BatchSlot data) {
		AddFacSlotDialogFragment fragment = new AddFacSlotDialogFragment();
		Bundle bdl = new Bundle();
		bdl.putInt(KSCREENWIDTH, 0);
		bdl.putInt(KSCREENHEIGHT, 0);
		bdl.putInt(kFacId, facId);
		bdl.putSerializable(kData, data);
		fragment.setArguments(bdl);
		fragment.setTargetFragment(this, BATCH_SLOT_RESULT);
		assert getFragmentManager() != null;
		fragment.show(getFragmentManager(), "Dialog Fragment");
	}

	private void AddEditBatch(int facId, BatchSlot data) {
		AddAcaBatchDialogFragment fragment = new AddAcaBatchDialogFragment();
		Bundle bdl = new Bundle();
		bdl.putInt(KSCREENWIDTH, 0);
		bdl.putInt(KSCREENHEIGHT, 0);
		bdl.putInt(kFacId, facId);
		bdl.putSerializable(kData, data);
		fragment.setArguments(bdl);
		fragment.setTargetFragment(this, BATCH_SLOT_RESULT);
		assert getFragmentManager() != null;
		fragment.show(getFragmentManager(), "Dialog Fragment");


	}

	private void showarchieve(int facId){
		ArchieveSlotBatchDialogFragment fragment = new ArchieveSlotBatchDialogFragment();
		Bundle bdl = new Bundle();
		bdl.putInt(KSCREENWIDTH, 0);
		bdl.putInt(KSCREENHEIGHT, 0);
		bdl.putInt(kFacId, facId);
		fragment.setArguments(bdl);
		fragment.setTargetFragment(this, BATCH_SLOT_ARCHIVE);
		assert getFragmentManager() != null;
		fragment.show(getFragmentManager(), "Dialog Fragment");
	}

	@Override
	public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode == BATCH_SLOT_RESULT) {
			if (resultCode == RESULT_OK) {
				initData(0);
			}
		}else if(requestCode==BATCH_SLOT_ARCHIVE){
			if (resultCode == RESULT_OK) {
				initData(0);
			}
		}
	}

	private void getPackagesData() {
		showShimmerView();
		ModelManager.modelManager().userFacAcaPackages((Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchPackage>> genericResponse) -> {
			try {
				getBatchTypeData();
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			hideShimmerView();
			Toaster.customToast(message);
		});
	}

	private void getBatchTypeData() {
		ModelManager.modelManager().userFacAcaTypes((Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchSlotType>> genericResponse) -> {
			try {
				setRecyclerView();
				getBatchSlotListing();
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			hideShimmerView();
			Toaster.customToast(message);
		});
	}

	private void getBatchSlotListing() {
		if (page == 0)
			showShimmerView();
		if(ModelManager.modelManager().getCurrentUser().getSelectedFacId()==0){
			map.put(kFacId, 0);
		}else{
			map.put(kFacId, ModelManager.modelManager().getCurrentUser().getSelectedFacId());
		}
		map.put(kPage, page);
		ModelManager.modelManager().userAcaBatchSlotListing(map, (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchSlot>> genericResponse) -> {
			hideShimmerView();
			try {
				CopyOnWriteArrayList<BatchSlot> batchSlots = genericResponse.getObject();
				if (page != 0) {
					mAdapter.addData(batchSlots);
					loading = !genericResponse.getObject().isEmpty();
				} else {
					mAdapter.newData(batchSlots);
					pageSize = genericResponse.getObject().size();
				}
				checkEmptyView();
			} catch (Exception e) {
				e.printStackTrace();
			}
		}, (Constants.Status iStatus, String message) -> {
			hideShimmerView();
			Toaster.customToast(message);
			checkEmptyView();
		});

	}

	private void checkEmptyView() {
		if (mAdapter.getItemCount() == 1)
			emptyLayout.setVisibility(View.VISIBLE);
		else
			emptyLayout.setVisibility(View.GONE);
	}
}
