package com.socialsportz.Activities.Facility.Fragments;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.facebook.shimmer.ShimmerFrameLayout;
import com.google.android.material.textfield.TextInputEditText;
import com.socialsportz.Activities.Facility.Adapters.ArchiveBatchSlotAdapter;
import com.socialsportz.Activities.Facility.Adapters.BatchPriceAdapter;
import com.socialsportz.Activities.Facility.Adapters.BatchSlotAdapter;
import com.socialsportz.Activities.Facility.Adapters.WorkingDayAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.DataModel;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotPrice;
import com.socialsportz.Models.Owner.BatchSlotType;
import com.socialsportz.Models.Owner.BatchSlotWeekOff;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.DropDownView;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.TimePicker;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.text.ParseException;
import java.text.SimpleDateFormat;
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
import androidx.core.content.ContextCompat;
import androidx.fragment.app.DialogFragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static android.app.Activity.RESULT_OK;
import static com.socialsportz.Constants.Constants.BATCH_SLOT_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kAppPreferences;
import static com.socialsportz.Constants.Constants.kArchiveComment;
import static com.socialsportz.Constants.Constants.kArchiveStatus;
import static com.socialsportz.Constants.Constants.kBatchSlotId;
import static com.socialsportz.Constants.Constants.kBatchSlotStatus;
import static com.socialsportz.Constants.Constants.kCourtDesc;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kEndDate;
import static com.socialsportz.Constants.Constants.kEndTime;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kIsTrial;
import static com.socialsportz.Constants.Constants.kMaxParticipants;
import static com.socialsportz.Constants.Constants.kPage;
import static com.socialsportz.Constants.Constants.kPricing;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kStartDate;
import static com.socialsportz.Constants.Constants.kStartTime;
import static com.socialsportz.Constants.Constants.kTypeId;
import static com.socialsportz.Constants.Constants.kWeekOffs;
import static com.socialsportz.Constants.Constants.karchiveBy;

public class ArchieveSlotBatchDialogFragment extends DialogFragment implements View.OnClickListener {

	private int facId = 0;
	private int sportId = 0;
	private TextView tvStDate, tvEdDate, tvClear, tv_Inactive, tv_active, tv_total;
	private DropDownView dvSport,drop_archive;
	private ShimmerFrameLayout mShimmerViewContainer;
	private RecyclerView rvList;
	private ArchiveBatchSlotAdapter mAdapter;
	private LinearLayout emptyLayout,ll_archieve;

	private LinearLayoutManager mLayoutManager;
	private boolean loading = true;
	private int page;
	private int pageSize;
	private HashMap<String, Object> map = new HashMap<>();

	private Context context;
	String archiveBy="";
	ImageView iv_cross;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
		Bundle mArgs = getArguments();
		assert mArgs != null;
		int pHeight = mArgs.getInt(KSCREENHEIGHT);
		int pWidth = mArgs.getInt(KSCREENWIDTH);
		facId = mArgs.getInt(kFacId);
		Dialog d = getDialog();
		if (d != null) {
			Objects.requireNonNull(d.getWindow()).setLayout(pWidth - 100, pHeight - 100);
			d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
			Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
			d.getWindow().setBackgroundDrawable(drawable);
		}
	}

	@Override
	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		context = getActivity();
		View view = inflater.inflate(R.layout.fragment_dialog_archieve, container, false);

		initView(view);
		initData(0);

		iv_cross = view.findViewById(R.id.iv_cross);
		iv_cross.setOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());
		return view;
	}

	private void initView(View rootView) {
		emptyLayout = rootView.findViewById(R.id.empty_view);
		mShimmerViewContainer = rootView.findViewById(R.id.shimmer_view_container);
		rvList = rootView.findViewById(R.id.rv_slott);
		tvStDate = rootView.findViewById(R.id.tv_st_date_picker);
		tvEdDate = rootView.findViewById(R.id.tv_ed_date_picker);
		tvClear = rootView.findViewById(R.id.tv_clear);




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

		drop_archive=rootView.findViewById(R.id.drop_archivee);

		drop_archive.setClickListener(new DropDownView.onClickInterface() {
			@Override
			public void onClickAction() {
			}

			@Override
			public void onClickDone(int id, String name) {
				if(id==0){
					archiveBy="manual";
				}else if(id==1){
					archiveBy="disabled";
				}else{
					archiveBy="pastdate";
				}

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

			setSportsData();
			setEventStatus();
			if (ModelManager.modelManager().getCurrentUser().getBatchPackages() == null &&
				ModelManager.modelManager().getCurrentUser().getBatchSlotTypes() == null) {

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

	private void setEventStatus() {
		ArrayList<DataModel> options = new ArrayList<>();
		options.add(new DataModel(0, "Manual Archive"));
		options.add(new DataModel(1, "Disabled Archive"));
		options.add(new DataModel(2, "Past Date Archive"));
		drop_archive.setOptionList(options);
	}


	private void setRecyclerView() {
		mAdapter = new ArchiveBatchSlotAdapter(context, new CopyOnWriteArrayList<>(), batchSlot -> {
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

	private void AddEditSlot(int facId, BatchSlot data) {
		ArchiveFacSlotDialogFragment fragment = new ArchiveFacSlotDialogFragment();
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
		ArchiveAcaBatchDialogFragment fragment = new ArchiveAcaBatchDialogFragment();
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
		}
	}

	public void clearData() {
		map.clear();
		tvStDate.setText("");
		tvEdDate.setText("");
		dvSport.setText("");
		drop_archive.setText("");
		archiveBy="";
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
		} else if (archiveBy.equalsIgnoreCase("")) {
			Toaster.customToast("Please Select Archive");
			isOk = false;
		}/* else if(!tvStDate.getText().toString().isEmpty() && tvEdDate.getText().toString().isEmpty()){
            Toaster.customToast("Select End Date");
            isOk=false;
        } else if(tvStDate.getText().toString().isEmpty() && !tvEdDate.getText().toString().isEmpty()){
            Toaster.customToast("Select Start Date");
            isOk=false;
        }*/ /*else if (!tvStDate.getText().toString().isEmpty() && !tvEdDate.getText().toString().isEmpty()) {
			if (!Utils.getDateCompare(tvStDate.getText().toString(), tvEdDate.getText().toString())) {
				Toaster.customToast("Start Date should be lower than End Date");
				isOk = false;
			}
		}*/ /*else if(mAdapter.getItemCount()==0){
            isOk = false;
            Toaster.customToast("Please Add Batch/Slot");
        }*/
		return isOk;
	}


	@Override
	public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode == BATCH_SLOT_RESULT) {
			if (resultCode == RESULT_OK) {
				initData(0);
			}
		}
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
		map.put(kFacId, facId);
		map.put(kPage, page);
		map.put(karchiveBy,archiveBy);
		Log.e("Send",map.toString());
		ModelManager.modelManager().userAcaBatchSlotArchiveListing(map, (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<BatchSlot>> genericResponse) -> {
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
