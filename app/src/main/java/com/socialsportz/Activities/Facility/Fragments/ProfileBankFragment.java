package com.socialsportz.Activities.Facility.Fragments;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Transformation;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.FacBankModel;
import com.socialsportz.R;
import com.socialsportz.View.PMTextView;

import java.util.Objects;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import jp.wasabeef.picasso.transformations.MaskTransformation;

import static com.socialsportz.Constants.Constants.EDIT_BANK_RESULT;
import static com.socialsportz.Constants.Constants.KSCREENHEIGHT;
import static com.socialsportz.Constants.Constants.KSCREENWIDTH;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kImageBaseUrl;

public class ProfileBankFragment extends Fragment {

    public static String TAG = ProfileBankFragment.class.getSimpleName();
    private FacBankModel bankModel = null;
    private PMTextView tvIfsc, tvBankName, tvBranchName, tvAcType, tvAcNumber, tvAcName, tvGst, tvPan, tvCin;
    private ImageView ivGst, ivPan, ivCin, ivDoc, ivChq;

    public ProfileBankFragment() {
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.profile_bank_details, container, false);
        initView(rootView);
        setData();
        setUserBankUpdate();

        rootView.findViewById(R.id.bt_edit).setOnClickListener(view -> {
            EditBankDialogFragment fragment = new EditBankDialogFragment();
            Bundle bdl = new Bundle();
            bdl.putInt(KSCREENWIDTH, 0);
            bdl.putInt(KSCREENHEIGHT, 0);
            bdl.putSerializable(kData, null);
            fragment.setArguments(bdl);
            fragment.setTargetFragment(this, EDIT_BANK_RESULT);
            assert getFragmentManager() != null;
            fragment.show(getFragmentManager(), "Dialog Fragment");
        });

        return rootView;
    }

    private void initView(View view) {
        tvIfsc = view.findViewById(R.id.tv_ifsc);
        tvBankName = view.findViewById(R.id.tv_bank_name);
        tvBranchName = view.findViewById(R.id.tv_branch_name);
        tvAcType = view.findViewById(R.id.tv_ac_type);
        tvAcNumber = view.findViewById(R.id.tv_ac_number);
        tvAcName = view.findViewById(R.id.tv_ac_name);
        tvGst = view.findViewById(R.id.tv_gst);
        tvPan = view.findViewById(R.id.tv_pan);
        tvCin = view.findViewById(R.id.tv_cin);
        ivGst = view.findViewById(R.id.iv_gst);
        ivPan = view.findViewById(R.id.iv_pan);
        ivCin = view.findViewById(R.id.iv_cin);
        ivDoc = view.findViewById(R.id.iv_doc);
        ivChq = view.findViewById(R.id.iv_chq);
    }

    private void setData() {
        CurrentUser user = ModelManager.modelManager().getCurrentUser();
        if (user.getUserBankDetails() != null) {
            bankModel = user.getUserBankDetails();
        }
        if (bankModel != null) {
            tvIfsc.setText(bankModel.getIfscCode());
            tvBankName.setText(bankModel.getBankName());
            tvBranchName.setText(bankModel.getBankBranch());
            tvAcType.setText(bankModel.getAccountType());
            tvAcNumber.setText(bankModel.getAccountNumber());
            tvAcName.setText(bankModel.getAccountName());
            tvGst.setText(bankModel.getGSTNumber());
            tvPan.setText(bankModel.getPANNumber());
            tvCin.setText(bankModel.getCINNumber());
            final Transformation transformation = new MaskTransformation(Objects.requireNonNull(getContext()), R.drawable.canvas_booking_details_img_bg);
            Picasso.with(getContext()).load(kImageBaseUrl+bankModel.getFolderName()+"/"+bankModel.getGSTImage()).transform(transformation).fit().placeholder(R.drawable.placeholder_300).into(ivGst);
            Picasso.with(getContext()).load(kImageBaseUrl+bankModel.getFolderName()+"/"+bankModel.getPANImage()).transform(transformation).fit().placeholder(R.drawable.placeholder_300).into(ivPan);
            Picasso.with(getContext()).load(kImageBaseUrl+bankModel.getFolderName()+"/"+bankModel.getCINImage()).transform(transformation).fit().placeholder(R.drawable.placeholder_300).into(ivCin);
            Picasso.with(getContext()).load(kImageBaseUrl+bankModel.getFolderName()+"/"+bankModel.getAddressImage()).transform(transformation).fit().placeholder(R.drawable.placeholder_300).into(ivDoc);
            Picasso.with(getContext()).load(kImageBaseUrl+bankModel.getFolderName()+"/"+bankModel.getChequeImage()).transform(transformation).fit().placeholder(R.drawable.placeholder_300).into(ivChq);
        }
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == EDIT_BANK_RESULT) {
            setData();
        }
    }

    private void setUserBankUpdate() {
        ModelManager.modelManager().userFacBankUpdate(
                (Constants.Status iStatus, GenericResponse<FacBankModel> genericResponse) -> {
                    try {
                        setData();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> Log.e(TAG,"facility update error"));
    }
}
