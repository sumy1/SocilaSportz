package com.socialsportz.Activities.Facility.Fragments;

import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.text.method.HideReturnsTransformationMethod;
import android.text.method.PasswordTransformationMethod;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;

import com.socialsportz.Activities.Facility.Adapters.ProfileStatusAdapter;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.ProfileStatus;
import com.socialsportz.Models.Owner.ProfileSummyStatus;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.View.PMTextView;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Objects;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import static com.socialsportz.Constants.Constants.EDIT_PROFILE_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kNewPassword;
import static com.socialsportz.Constants.Constants.kOldPassword;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.R.drawable.canvas_completed_status_bg;
import static com.socialsportz.R.drawable.canvas_notfound_status_bg;
import static com.socialsportz.R.drawable.canvas_pending_status_bg;

public class ProfileSummaryFragment extends Fragment {
	String TAG = ProfileSummaryFragment.class.getSimpleName();
	private CurrentUser currentUser;
	private Context context;
	private PMTextView tv_pendngSports, tv_pendingAmenity, tv_pendingTiming, tv_pendinguGallery, tvName, tvGender, tvMail, tvMobile, tvAddress, tv_pendingp, tv_pendingf, tv_pendingb, tv_pendingu;
	private RecyclerView recyclerView;
	private Dialog dialog;
	private EditText etOld, etNew, etCon;
	private ImageButton visibilityBtn1, visibilityBtn2;
	private ProfileUpdateListener listener;
	private profileSummaryItemclick profileSummaryItemclick;
	private Fragment currentFragment;

	public ProfileSummaryFragment() {
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
	}

	public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		context = getActivity();
		View rootView = inflater.inflate(R.layout.profile_summary, container, false);
		currentUser = ModelManager.modelManager().getCurrentUser();

		initView(rootView);
		setData();
		setProfileUpdate();
		getProfileSummayStatus();
		//setRecyclerView();

		rootView.findViewById(R.id.bt_edit).setOnClickListener(view -> {
			EditProfileDialogFragment fragment = new EditProfileDialogFragment();
			Bundle bdl = new Bundle();
			bdl.putInt(KSCREENWIDTH, 0);
			bdl.putInt(KSCREENHEIGHT, 0);
			bdl.putSerializable(kData, null);
			fragment.setArguments(bdl);
			fragment.setTargetFragment(this, EDIT_PROFILE_RESULT);
			assert getFragmentManager() != null;
			fragment.show(getFragmentManager(), "Dialog Fragment");
		});

		rootView.findViewById(R.id.tv_change_pass).setOnClickListener(view -> resetDialog());
		return rootView;
	}

	private void rejectedMsgDialogue() {
		// dialog
		final Dialog dialog = new Dialog(Objects.requireNonNull(getActivity()));
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(getResources().getDrawable(R.drawable.canvas_booking_details_img_bg));
		dialog.setContentView(R.layout.dialog_rejected_bank_detail);
		dialog.setCancelable(false);
		TextView ok = dialog.findViewById(R.id.ok);

		ok.setOnClickListener(v -> dialog.dismiss());

		dialog.show();
	}


	private void initView(View view) {
		tvName = view.findViewById(R.id.tv_name);
		tvGender = view.findViewById(R.id.tv_gender);
		tvMobile = view.findViewById(R.id.tv_mobile);
		tvMail = view.findViewById(R.id.tv_email);
		tvAddress = view.findViewById(R.id.tv_address);
		//recyclerView = view.findViewById(R.id.rv_status);

		tv_pendingp = view.findViewById(R.id.tv_pendingp);


		tv_pendingp.setOnClickListener(v -> {

		});
		tv_pendingf = view.findViewById(R.id.tv_pendingf);
		tv_pendingf.setOnClickListener(v -> {

			profileSummaryItemclick.itemClick(1);


		});
		tv_pendingb = view.findViewById(R.id.tv_pendingb);
		tv_pendingb.setOnClickListener(v -> {
			profileSummaryItemclick.itemClick(5);
		});


		tv_pendingu = view.findViewById(R.id.tv_pendingu);

		tv_pendingu.setOnClickListener(v -> {
			profileSummaryItemclick.itemClick(5);
		});

		tv_pendngSports = view.findViewById(R.id.tv_pendngSports);
		tv_pendngSports.setOnClickListener(v -> {
			profileSummaryItemclick.itemClick(2);
		});

		tv_pendingAmenity = view.findViewById(R.id.tv_pendingAmenity);

		tv_pendingAmenity.setOnClickListener(v -> {
			profileSummaryItemclick.itemClick(2);
		});

		tv_pendingTiming = view.findViewById(R.id.tv_pendingTiming);


		tv_pendingTiming.setOnClickListener(v -> {
			profileSummaryItemclick.itemClick(3);
		});

		tv_pendinguGallery = view.findViewById(R.id.tv_pendinguGallery);

		tv_pendinguGallery.setOnClickListener(v -> {
			profileSummaryItemclick.itemClick(4);
		});

	}



	private void setData() {
		tvName.setText(currentUser.getUsername());
		switch (currentUser.getGender()) {
			case "M":
				tvGender.setText(R.string.male);
				break;
			case "F":
				tvGender.setText(R.string.female);
				break;
			case "T":
				tvGender.setText(R.string.other);
				break;
		}
		tvMail.setText(currentUser.getEmail());
		tvMobile.setText(currentUser.getPhone());
		String address = currentUser.getUserAddress() + "\n"
			+ currentUser.getUserSubArea() + "\n" + currentUser.getUserGoogleAdd()
			+ " " + currentUser.getUserPinCode();
		tvAddress.setText(address);

	}

	private void setRecyclerView() {
		ArrayList<ProfileStatus> statusList = new ArrayList<>();
		statusList.add(new ProfileStatus(1, "Profile", "1"));
		statusList.add(new ProfileStatus(1, "Facility/Academy Details", "2"));
		statusList.add(new ProfileStatus(1, "Bank Details", "3"));
		statusList.add(new ProfileStatus(1, "Upcoming Documents", "1"));
		statusList.add(new ProfileStatus(1, "Opening & Closing status", "2"));
		statusList.add(new ProfileStatus(1, "My Sports Gallery", "3"));
		LinearLayoutManager layoutManager = new LinearLayoutManager(context, RecyclerView.VERTICAL, false);
		ProfileStatusAdapter profileStatusAdapter = new ProfileStatusAdapter(context, statusList);
		recyclerView.setLayoutManager(layoutManager);
		//recyclerView.addItemDecoration(new SpaceItemDecoration(10));
		recyclerView.setAdapter(profileStatusAdapter);
		recyclerView.setNestedScrollingEnabled(false);
		profileStatusAdapter.setItemClickListener(model -> rejectedMsgDialogue());
	}

	@Override
	public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode == EDIT_PROFILE_RESULT) {
			setData();
			listener.profileUpdate();
		}
	}

	private void resetDialog() {
		// dialog
		dialog = new Dialog(Objects.requireNonNull(getActivity()));
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_reset_password);

		etOld = dialog.findViewById(R.id.et_old_pass);
		etNew = dialog.findViewById(R.id.et_new_pass);
		etCon = dialog.findViewById(R.id.et_confirm_pass);

		visibilityBtn1 = dialog.findViewById(R.id.iv_visible);
		visibilityBtn1.setTag("InVisible");
		visibilityBtn1.setOnClickListener(v -> {
			if (visibilityBtn1.getTag().equals("InVisible")) {
				etOld.setTransformationMethod(HideReturnsTransformationMethod.getInstance());
				visibilityBtn1.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility));
				visibilityBtn1.setTag("Visible");
			} else {
				etOld.setTransformationMethod(PasswordTransformationMethod.getInstance());
				visibilityBtn1.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility_off));
				visibilityBtn1.setTag("InVisible");
			}
		});

		visibilityBtn2 = dialog.findViewById(R.id.ib_visible);
		visibilityBtn2.setTag("InVisible");
		visibilityBtn2.setOnClickListener(v -> {
			if (visibilityBtn2.getTag().equals("InVisible")) {
				etNew.setTransformationMethod(HideReturnsTransformationMethod.getInstance());
				visibilityBtn2.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility));
				visibilityBtn2.setTag("Visible");
			} else {
				etNew.setTransformationMethod(PasswordTransformationMethod.getInstance());
				visibilityBtn2.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility_off));
				visibilityBtn2.setTag("InVisible");
			}
		});

		Button btnReset = dialog.findViewById(R.id.btn_submit);
		btnReset.setOnClickListener(view -> {
			Log.e("old Password md5", Utils.md5(etOld.getText().toString()));
			Log.e("Old password user", currentUser.getPassword());
			if (Utils.getProperText(etOld).isEmpty())
				Toaster.customToast("Please enter old password");
			else if (!Utils.md5(etOld.getText().toString()).equals(currentUser.getPassword()))
				Toaster.customToast("Invalid Old Password");
			else if (Utils.getProperText(etNew).isEmpty())
				Toaster.customToast("Please enter new password");
			else if (Utils.getProperText(etCon).isEmpty())
				Toaster.customToast("Please re-enter your password");
			else if (!Utils.getProperText(etCon).equals(Utils.getProperText(etNew)))
				Toaster.customToast("Field must match with new password");
			else
				setChangePassword(Utils.getProperText(etNew));
		});

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
		dialog.show();
	}

	private void setChangePassword(String newPassword) {
		CustomLoaderView loaderView = CustomLoaderView.initialize(getActivity());
		loaderView.showLoader();
		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, currentUser.getUserId());
		map.put(kOldPassword, currentUser.getPassword());
		map.put(kNewPassword, newPassword);
		ModelManager.modelManager().userChangePassword(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();
				try {
					String msg = genericResponse.getObject();
					Log.e(TAG, "msg: " + msg);
					Toaster.customToast("Password Changed Successfully");
					dialog.dismiss();
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}

	private void setProfileUpdate() {
		ModelManager.modelManager().userProfileUpdate(
			(Constants.Status iStatus, GenericResponse<CurrentUser> genericResponse) -> {
				Log.e(TAG, "user updated");
				setData();
				listener.profileRealTime();
			}, (Constants.Status iStatus, String message) -> Log.e(TAG, "user not updated"));
	}

	private void getProfileSummayStatus() {

		ModelManager.modelManager().userprofileSummyStatus(
			(Constants.Status iStatus, GenericResponse<ProfileSummyStatus> genericResponse) -> {
				try {
					ProfileSummyStatus profileSummyStatus = genericResponse.getObject();
					Log.d("profileall", genericResponse.getObject().getBankStatus());

					if (profileSummyStatus.getProfileStatus().equalsIgnoreCase("Completed")) {
						tv_pendingp.setText(profileSummyStatus.getProfileStatus());
						tv_pendingp.setBackground(context.getDrawable(canvas_completed_status_bg));
						tv_pendingp.setTextColor(context.getResources().getColor(R.color.white));

					} else if (profileSummyStatus.getProfileStatus().equalsIgnoreCase("Pending")) {
						tv_pendingp.setText(profileSummyStatus.getProfileStatus());
						tv_pendingp.setBackground(context.getDrawable(canvas_pending_status_bg));
						tv_pendingp.setTextColor(context.getResources().getColor(R.color.white));
					}


					if (profileSummyStatus.getFacilityStatus().equalsIgnoreCase("Completed")) {
						tv_pendingf.setText(profileSummyStatus.getFacilityStatus());
						tv_pendingf.setBackground(context.getDrawable(canvas_completed_status_bg));
						tv_pendingf.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getFacilityStatus().equalsIgnoreCase("Pending")) {
						tv_pendingf.setText(profileSummyStatus.getFacilityStatus());
						tv_pendingf.setBackground(context.getDrawable(canvas_pending_status_bg));
						tv_pendingf.setTextColor(context.getResources().getColor(R.color.white));
					}


					if (profileSummyStatus.getBankStatus().equalsIgnoreCase("Completed")) {
						tv_pendingb.setText(profileSummyStatus.getBankStatus());
						tv_pendingb.setBackground(context.getDrawable(canvas_completed_status_bg));
						tv_pendingb.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getBankStatus().equalsIgnoreCase("Pending")) {
						tv_pendingb.setText(profileSummyStatus.getBankStatus());
						tv_pendingb.setBackground(context.getDrawable(canvas_pending_status_bg));
						tv_pendingb.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getBankStatus().equalsIgnoreCase("Not Found")) {
						tv_pendingb.setText(profileSummyStatus.getBankStatus());
						tv_pendingb.setBackground(context.getDrawable(canvas_notfound_status_bg));
						tv_pendingb.setTextColor(context.getResources().getColor(R.color.white));
					}


					if (profileSummyStatus.getDocumentsStatus().equalsIgnoreCase("Completed")) {
						tv_pendingu.setText(profileSummyStatus.getDocumentsStatus());
						tv_pendingu.setBackground(context.getDrawable(canvas_completed_status_bg));
						tv_pendingu.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getDocumentsStatus().equalsIgnoreCase("Pending")) {
						tv_pendingu.setText(profileSummyStatus.getDocumentsStatus());
						tv_pendingu.setBackground(context.getDrawable(canvas_pending_status_bg));
						tv_pendingu.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getDocumentsStatus().equalsIgnoreCase("Not Found")) {
						tv_pendingu.setText(profileSummyStatus.getDocumentsStatus());
						tv_pendingu.setBackground(context.getDrawable(canvas_notfound_status_bg));
						tv_pendingu.setTextColor(context.getResources().getColor(R.color.white));
					}


					//...new code hare..


					if (profileSummyStatus.getSportStatus().equalsIgnoreCase("Completed")) {
						tv_pendngSports.setText(profileSummyStatus.getSportStatus());
						tv_pendngSports.setBackground(context.getDrawable(canvas_completed_status_bg));
						tv_pendngSports.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getSportStatus().equalsIgnoreCase("Pending")) {
						tv_pendngSports.setText(profileSummyStatus.getSportStatus());
						tv_pendngSports.setBackground(context.getDrawable(canvas_pending_status_bg));
						tv_pendngSports.setTextColor(context.getResources().getColor(R.color.white));
					}

					if (profileSummyStatus.getAmenityStatus().equalsIgnoreCase("Completed")) {
						tv_pendingAmenity.setText(profileSummyStatus.getAmenityStatus());
						tv_pendingAmenity.setBackground(context.getDrawable(canvas_completed_status_bg));
						tv_pendingAmenity.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getAmenityStatus().equalsIgnoreCase("Pending")) {
						tv_pendingAmenity.setText(profileSummyStatus.getAmenityStatus());
						tv_pendingAmenity.setBackground(context.getDrawable(canvas_pending_status_bg));
						tv_pendingAmenity.setTextColor(context.getResources().getColor(R.color.white));
					}

					if (profileSummyStatus.getTimingStatus().equalsIgnoreCase("Completed")) {
						tv_pendingTiming.setText(profileSummyStatus.getTimingStatus());
						tv_pendingTiming.setBackground(context.getDrawable(canvas_completed_status_bg));
						tv_pendingTiming.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getTimingStatus().equalsIgnoreCase("Pending")) {
						tv_pendingTiming.setText(profileSummyStatus.getTimingStatus());
						tv_pendingTiming.setBackground(context.getDrawable(canvas_pending_status_bg));
						tv_pendingTiming.setTextColor(context.getResources().getColor(R.color.white));
					}


					if (profileSummyStatus.getGalleryStatus().equalsIgnoreCase("Completed")) {
						tv_pendinguGallery.setText(profileSummyStatus.getGalleryStatus());
						tv_pendinguGallery.setBackground(context.getDrawable(canvas_completed_status_bg));
						tv_pendinguGallery.setTextColor(context.getResources().getColor(R.color.white));
					} else if (profileSummyStatus.getGalleryStatus().equalsIgnoreCase("Pending")) {
						tv_pendinguGallery.setText(profileSummyStatus.getGalleryStatus());
						tv_pendinguGallery.setBackground(context.getDrawable(canvas_pending_status_bg));
						tv_pendinguGallery.setTextColor(context.getResources().getColor(R.color.white));
					}

				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> Toaster.customToast(message));


	}

	public void setProfileUpdateListener(ProfileUpdateListener listener) {
		this.listener = listener;
	}


	public void setProfileitemListener(profileSummaryItemclick listener) {
		this.profileSummaryItemclick = listener;
	}

	public interface ProfileUpdateListener {
		void profileUpdate();

		void profileRealTime();
	}

	public interface profileSummaryItemclick{

		void itemClick(int position);
	}
}
