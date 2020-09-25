package com.socialsportz.Activities.Facility.Fragments;

import android.app.Dialog;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;

import com.socialsportz.Activities.Facility.Adapters.BookingAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.R;
import com.socialsportz.Utils.SpaceItemDecoration;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;

import java.util.HashMap;
import java.util.Objects;
import java.util.concurrent.CopyOnWriteArrayList;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.DialogFragment;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kBatchSlotId;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kDate;
import static com.socialsportz.Constants.Constants.kStartDate;

public class BookingDetailDialogFragment extends DialogFragment {

    private static final String TAG = SeeAllAchievementDialogFragment.class.getSimpleName();
    private BatchSlot batchSlot;
    private String date;
    private RecyclerView recyclerView;
    private BookingAdapter bookingAdapter;
    private ProgressBar progressBar;
	BookingAdapter.onitemclick onitemclick;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setStyle(DialogFragment.STYLE_NORMAL, R.style.MY_DIALOG);
        Bundle mArgs = getArguments();
        assert mArgs != null;
        batchSlot = (BatchSlot) mArgs.getSerializable(kData);
        date = mArgs.getString(kDate);
        int pHeight = mArgs.getInt(KSCREENHEIGHT);
        int pWidth  = mArgs.getInt(KSCREENWIDTH);
        Dialog d = getDialog();
        if (d!=null){
            Objects.requireNonNull(d.getWindow()).setLayout(pWidth-100, pHeight-100);
            d.getWindow().getAttributes().windowAnimations = R.style.MaterialDialogSheetAnimation;
            Drawable drawable = getResources().getDrawable(R.drawable.canvas_dialog_bg);
            d.getWindow().setBackgroundDrawable(drawable);
        }
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_dialog_booking_detail, container, false);
        progressBar = view.findViewById(R.id.progress_bar);

        recyclerView = view.findViewById(R.id.rv);
        LinearLayoutManager layoutManager=new LinearLayoutManager(getActivity(),RecyclerView.VERTICAL,false);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
        if (tabletSize)
            recyclerView.addItemDecoration(new SpaceItemDecoration(25));
        else
            recyclerView.addItemDecoration(new SpaceItemDecoration(20));
        /*bookingAdapter = new BookingAdapter(getContext(),list());
        recyclerView.setAdapter(bookingAdapter);*/
        getList();

        Toolbar toolbar = view.findViewById(R.id.toolbar);
        // Create an instance of the tab layout from the view.
        toolbar.setNavigationOnClickListener(v -> Objects.requireNonNull(getDialog()).dismiss());

        return view;
    }

    private void getList(){
        progressBar.setVisibility(View.VISIBLE);
        HashMap<String,Object> map = new HashMap<>();
        map.put(kBatchSlotId,batchSlot.getBatchSlotId());
        map.put(kStartDate,date);
        ModelManager.modelManager().userCalendarBookingList(map,
                (Constants.Status iStatus, GenericResponse<CopyOnWriteArrayList<Bookings>> genericResponse) -> {
            progressBar.setVisibility(View.GONE);
            try {
                CopyOnWriteArrayList<Bookings> bookings = genericResponse.getObject();
                bookingAdapter = new BookingAdapter(getContext(), bookings, new BookingAdapter.onitemclick() {
					@Override
					public void refresh() {
						getList();
					}
				});
                recyclerView.setAdapter(bookingAdapter);
            } catch (Exception e){
                e.printStackTrace();
            }
        }, (Constants.Status iStatus, String message) -> {
            progressBar.setVisibility(View.GONE);
            Toaster.customToast(message);
        });
    }

    public CopyOnWriteArrayList<Bookings> list(){
        CopyOnWriteArrayList<Bookings> bookings_item = new CopyOnWriteArrayList<>();
        bookings_item.add(new Bookings(1,"SSZ1000001570627907","Uphar","upharshivam@gmail.com","8292090012",
                "0","online", Utils.getBookingDetails()));
        //bookingAdapter.addData(bookings_item);
        return bookings_item;
    }

}
