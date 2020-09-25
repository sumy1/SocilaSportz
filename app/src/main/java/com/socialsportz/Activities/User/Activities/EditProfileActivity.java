package com.socialsportz.Activities.User.Activities;

import android.Manifest;
import android.annotation.TargetApi;
import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.graphics.PorterDuff;
import android.graphics.drawable.ColorDrawable;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.provider.MediaStore;
import android.provider.Settings;
import android.text.method.HideReturnsTransformationMethod;
import android.text.method.PasswordTransformationMethod;
import android.util.Log;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;

import com.google.android.gms.common.api.Status;
import com.google.android.libraries.places.api.model.Place;
import com.google.android.libraries.places.api.model.TypeFilter;
import com.google.android.libraries.places.widget.Autocomplete;
import com.google.android.libraries.places.widget.AutocompleteActivity;
import com.google.android.libraries.places.widget.model.AutocompleteActivityMode;
import com.squareup.picasso.Picasso;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.R;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.ImageCompressor;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.Validations;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Objects;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import static android.Manifest.permission.ACCESS_COARSE_LOCATION;
import static android.Manifest.permission.ACCESS_FINE_LOCATION;
import static com.socialsportz.Constants.Constants.GALLERY_PIC_RESULT;
import static com.socialsportz.Constants.Constants.PERMISSIONS_REQUEST;
import static com.socialsportz.Constants.Constants.REQUEST_LOCATION;
import static com.socialsportz.Constants.Constants.REQUEST_PERMISSIONS_STORAGE;
import static com.socialsportz.Constants.Constants.kAddress;
import static com.socialsportz.Constants.Constants.kEmail;
import static com.socialsportz.Constants.Constants.kGender;
import static com.socialsportz.Constants.Constants.kLocationPermissionMsg;
import static com.socialsportz.Constants.Constants.kNewPassword;
import static com.socialsportz.Constants.Constants.kOldPassword;
import static com.socialsportz.Constants.Constants.kPhone;
import static com.socialsportz.Constants.Constants.kProfile;
import static com.socialsportz.Constants.Constants.kUserId;
import static com.socialsportz.Constants.Constants.kUserName;

public class EditProfileActivity extends AppCompatActivity {

    private static final String TAG = EditProfileActivity.class.getSimpleName();
    private ImageView profile_img;
    private EditText et_full_name, et_email, et_address, et_phone;
    private RadioGroup radioGroup;
    private RadioButton radio_btn_male, radio_btn_female,radio_sex_button;
    private Button btn_create;
    private Context context;
    private CustomLoaderView loaderView;

    private String fullName, address, email, phone, gender,profile_path="",profile_pathh,from="";
    private LinearLayout profile_toolbar;
    Dialog dialog;
    ImageButton ib_visible_old,ib_visible_new,ib_visible_con;
	EditText editOldPass,editNewPass,editConfirmPass;


    public EditProfileActivity() {

    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_edit_profile);
        setStatusBarGradient(this);
        context = this;
        loaderView = CustomLoaderView.initialize(context);
        getInValue();
        inItView();

    }


    public void getInValue() {


        if (getIntent() != null) {
            Intent intent = getIntent();
            from=intent.getStringExtra("From");
            fullName = intent.getStringExtra(Constants.kUserName);

            address = intent.getStringExtra(Constants.kAddress);

            email = intent.getStringExtra(Constants.kEmail);

            phone = intent.getStringExtra(Constants.kPhone);

            gender = intent.getStringExtra(Constants.kGender);
			profile_path=intent.getStringExtra(Constants.kImage);

			/*try {
				Uri uri=Uri.parse(profile_path);
				ImageCompressor.getThumbnail(uri,context);

				Log.d("profile_path",ImageCompressor.getThumbnail(uri,context)+"");

			} catch (IOException e) {
				e.printStackTrace();
			}*/






		}


    }

    private void inItView() {
        profile_img = findViewById(R.id.profile_img);
		radio_btn_male = findViewById(R.id.radio_btn_male);
		radio_btn_female = findViewById(R.id.radio_btn_female);

		if (gender.equals("M")) {
			radio_btn_male.setChecked(true);

			if (!profile_path.isEmpty()) {
				Picasso.with(context).load(profile_path).placeholder(R.drawable.man).fit().into(profile_img);
			} else {
				Picasso.with(context).load(profile_path).placeholder(R.drawable.man).fit().into(profile_img);
			}

		} else if (gender.equals("F")) {
			radio_btn_female.setChecked(true);

			if (!profile_path.isEmpty()) {
				Picasso.with(context).load(profile_path).placeholder(R.drawable.girl).fit().into(profile_img);
			} else {
				Picasso.with(context).load(profile_path).placeholder(R.drawable.girl).fit().into(profile_img);
			}
		}



        profile_img.setOnClickListener(v->{
            checkAndroidVersion();
        });
        et_full_name = findViewById(R.id.et_full_name);
        et_full_name.setText(fullName);
        et_email = findViewById(R.id.et_email);
        et_email.setText(email);
        et_email.setFocusable(false);
        et_address = findViewById(R.id.et_address);
        et_address.setText(address);


        et_address.setOnClickListener(v->{

			List<Place.Field> fields = Arrays.asList(Place.Field.ID,Place.Field.NAME,
				Place.Field.ADDRESS_COMPONENTS,Place.Field.ADDRESS,Place.Field.LAT_LNG,Place.Field.TYPES);

			// Start the autocomplete intent.
			Intent intent = new Autocomplete.IntentBuilder(
				AutocompleteActivityMode.OVERLAY, fields)
				.setCountry("IN")
				.setTypeFilter(TypeFilter.REGIONS)
				.build(this);
			startActivityForResult(intent, REQUEST_LOCATION);
		});
        et_phone = findViewById(R.id.et_phone);
        et_phone.setText(phone);
        et_phone.setFocusable(false);
        radioGroup=findViewById(R.id.radio_group);


       /* if (gender.equals("M")) {
            radio_btn_male.setChecked(true);
        } else if (gender.equals("F")) {
            radio_btn_female.setChecked(true);
        }*/

        btn_create=findViewById(R.id.btn_create);

        btn_create.setOnClickListener(v->{
            if(validate())
               //address=et_address.getText().toString().trim();
                setSignUp(getSignUpMap());
        });

        findViewById(R.id.tv_changePassword).setOnClickListener(v->{
			changepasswordDialog();

		});

        findViewById(R.id.ib_back).setOnClickListener(v->{finish();});

    }

    @TargetApi(Build.VERSION_CODES.LOLLIPOP)
    public static void setStatusBarGradient(Activity activity) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            Window window = activity.getWindow();
            Drawable background = activity.getResources().getDrawable(R.drawable.canvas_red_gradient);
            window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            window.setStatusBarColor(activity.getResources().getColor(android.R.color.transparent));
            window.setNavigationBarColor(activity.getResources().getColor(android.R.color.transparent));
            window.setBackgroundDrawable(background);
        }
    }


	private boolean checkSelfPermissionn(){
		return ContextCompat.checkSelfPermission(this, ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED
			&& ContextCompat.checkSelfPermission(this, ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED;
	}



    private void checkAndroidVersion() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (checkSelfPermission())
                galleryImage();
            else
                requestPermission();
        } else {
            galleryImage();
        }
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == GALLERY_PIC_RESULT) {
            if (resultCode == RESULT_OK) {
                Uri selectedImage = data.getData();
                from="0";


                String[] filePath = {MediaStore.Images.Media.DATA};
                assert selectedImage != null;
                Cursor c = Objects.requireNonNull(context).getContentResolver().query(selectedImage, filePath, null, null, null);
                assert c != null;
                c.moveToFirst();
                int columnIndex = c.getColumnIndex(filePath[0]);
                String picturePath = c.getString(columnIndex);
                c.close();

                Log.w(TAG, "picturePAth:" + picturePath );
                Bitmap bm = BitmapFactory.decodeFile(picturePath);
                ByteArrayOutputStream baos = new ByteArrayOutputStream();
                bm.compress(Bitmap.CompressFormat.JPEG, 100, baos); //bm is the bitmap object
                byte[] b = baos.toByteArray();
                if(b.length>1024*1024){
                    Toaster.customToast("File size should be less than 1MB");
                }else{
                    //String path = Base64.encodeToString(b, Base64.DEFAULT);

                    if(picturePath.isEmpty()){
                        profile_path="";
                    }else{
                        profile_path=picturePath;
                    }

                    if(!profile_path.isEmpty()){
                        Picasso.with(context).load(new File(profile_path)).fit().into(profile_img);
                    }


                }
            }
        }
			else if (requestCode == REQUEST_LOCATION) {
				if (resultCode == RESULT_OK) {
					Place place = Autocomplete.getPlaceFromIntent(data);

					/*LatLng ln = place.getLatLng();
					assert ln != null;
					latitude = ln.latitude;
					longitude = ln.longitude;

					List<AddressComponent> list = Objects.requireNonNull(place.getAddressComponents()).asList();
					for(int i=0;i<list.size();i++){
						AddressComponent comp = list.get(i);
						switch (comp.getTypes().get(0)) {
							case kLocality:
								city = comp.getName();
								break;
							case kAdministrativeAreaLevel1:
								state = comp.getName();
								break;
							case kGCountry:
								country = comp.getName();
								break;
							case kPostalCode:
								pincode = comp.getName();
								break;
						}
					}*/

					et_address.setText(place.getAddress());
				} else if (resultCode == AutocompleteActivity.RESULT_ERROR) {
					Status status = Autocomplete.getStatusFromIntent(data);
					assert status.getStatusMessage() != null;
					Log.i(TAG, status.getStatusMessage());
				}
			} else if( requestCode == PERMISSIONS_REQUEST){
				if(checkSelfPermission()||checkSelfPermissionn()){
					dialog.dismiss();
				}
			}

    }
    private boolean checkSelfPermission(){
		return ActivityCompat.checkSelfPermission(Objects.requireNonNull(context), Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED;
	}

    private void galleryImage(){
        Intent intent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
        intent.putExtra("FROM","0");
        startActivityForResult(intent, GALLERY_PIC_RESULT);
    }

    private void requestPermission(){
        //Method of Fragment
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            requestPermissions(new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE}, REQUEST_PERMISSIONS_STORAGE);
        }
    }


    private void showDialog(){
        dialog = new Dialog(Objects.requireNonNull(context));
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        dialog.setCancelable(false);
        dialog.setContentView(R.layout.dialog_permission_setting);

        TextView text =  dialog.findViewById(R.id.tv_dialog);
        text.setText(kLocationPermissionMsg);

        Button dialogButton = dialog.findViewById(R.id.btn_dialog);
        dialogButton.setOnClickListener(v -> {
            Intent intent = new Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS);
            Uri uri = Uri.fromParts("package", getApplicationContext().getPackageName(), null);
            intent.setData(uri);
            startActivityForResult(intent, PERMISSIONS_REQUEST);
        });
        dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());

        dialog.show();
    }

    private boolean validate() {
        boolean isOk = true;
        if (Utils.getProperText(et_full_name).isEmpty()) {
            et_full_name.setError(getString(R.string.error_cannot_be_empty));
            et_full_name.requestFocus();
            isOk = false;
        }
        /*else if (!(Validations.isValidName(Utils.getProperText(et_full_name)))) {
            et_full_name.setError(getString(R.string.error_invalid_credential));
            et_full_name.requestFocus();
            isOk = false;
        }*/

        else if (Utils.getProperText(et_address).isEmpty()) {
			et_address.setError("Address cannot be empty");
			et_address.requestFocus();
            isOk = false;
        }
        else if(!radio_btn_male.isChecked() && !radio_btn_female.isChecked() ){
            Toaster.customToast("Please select gender");
			//et_full_name.requestFocus();
            isOk=false;
        }



        return isOk;
    }


     /* else if (Utils.getProperText(et_email).isEmpty()) {
            et_email.setError(getString(R.string.error_cannot_be_empty));
            et_email.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidEmail(Utils.getProperText(et_email)))) {
            et_email.setError(getString(R.string.error_invalid_credential));
            et_email.requestFocus();
            isOk = false;
        }
        else if (Utils.getProperText(et_phone).isEmpty()) {
            et_phone.setError(getString(R.string.error_cannot_be_empty));
            et_phone.requestFocus();
            isOk = false;
        } else if (!(Validations.isValidPhone(Utils.getProperText(et_phone)))) {
            et_phone.setError(getString(R.string.error_invalid_credential));
            et_phone.requestFocus();
            isOk = false;
        }*/

    public HashMap<String, Object> getSignUpMap() {
        HashMap<String, Object> loginMap = new HashMap<>();
        loginMap.put(kUserName, Utils.getProperText(et_full_name));

        if(from.equalsIgnoreCase("1")){
			loginMap.put(kProfile,profile_path);
		}else if(from.equalsIgnoreCase("0")){
			loginMap.put(kProfile,ImageCompressor.compressFile(new File(profile_path),context));
		}


        loginMap.put(kEmail, Utils.getProperText(et_email));
        loginMap.put(kPhone, Utils.getProperText(et_phone));
        if(radio_btn_male.isChecked())
            loginMap.put(kGender,"M");
        else if(radio_btn_female.isChecked())
            loginMap.put(kGender,"F");
        loginMap.put(kAddress,Utils.getProperText(et_address));
        loginMap.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());

        return loginMap;
    }

    private void setSignUp(HashMap<String, Object> map) {
        loaderView.showLoader();
        Log.e(TAG, map.toString());
        ModelManager.modelManager().userEditProfile(map,
                (Constants.Status iStatus, GenericResponse<CurrentUser> genericResponse) -> {
                    loaderView.hideLoader();
                    try {
                        CurrentUser user = genericResponse.getObject();
                        Log.e(TAG,user.toString());
                        CongratsDialog(user);
                    } catch (Exception e){
                        e.printStackTrace();
                    }
                }, (Constants.Status iStatus, String message) -> {
                    loaderView.hideLoader();
                    Toaster.customToast(message);
                });
    }

    private void CongratsDialog(CurrentUser user){
        final Dialog dialog = new Dialog(this);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        dialog.setContentView(R.layout.dialog_congrats_screen_profile_update);
        dialog.setCancelable(false);

        dialog.findViewById(R.id.btn_continue).setOnClickListener(v -> {

          /*  ProfileFragment fragmentObject=new ProfileFragment();
            FragmentTransaction ft = getSupportFragmentManager().beginTransaction();
            ft.replace(R.id.content_main, fragmentObject);
            ft.commit();*/

            dialog.dismiss();
            finish();
            /*if(user.getRole().equals(Constants.Role.Owner.getValue())) {
                Intent in = new Intent(SignUpActivity.this, FacilityOnGoActivity.class);
                in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(in);
                finish();
            }*/
        });

        dialog.show();
    }


	private void changepasswordDialog() {
		// dialog
		 dialog = new Dialog(this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_change_password);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
		 editOldPass = dialog.findViewById(R.id.et_oldpass);
		 editNewPass = dialog.findViewById(R.id.et_newPass);
		 editConfirmPass = dialog.findViewById(R.id.et_confirm_pass);

		ib_visible_old = dialog.findViewById(R.id.ib_visible_old);
		ib_visible_old.setTag("InVisible");
		ib_visible_old.setOnClickListener(v->{

			if (ib_visible_old.getTag().equals("InVisible")){
				editOldPass.setTransformationMethod(HideReturnsTransformationMethod.getInstance());
				ib_visible_old.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility));
				ib_visible_old.setColorFilter(getResources().getColor(R.color.green), PorterDuff.Mode.SRC_ATOP);
				ib_visible_old.setTag("Visible");
			} else {
				editOldPass.setTransformationMethod(PasswordTransformationMethod.getInstance());
				ib_visible_old.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility_off));
				ib_visible_old.setColorFilter(getResources().getColor(R.color.dark_grey), PorterDuff.Mode.SRC_ATOP);
				ib_visible_old.setTag("InVisible");
			}
		});
		ib_visible_new = dialog.findViewById(R.id.ib_visible_new);
		ib_visible_new.setTag("InVisible");

		ib_visible_new.setOnClickListener(v->{

			if (ib_visible_new.getTag().equals("InVisible")){
				editNewPass.setTransformationMethod(HideReturnsTransformationMethod.getInstance());
				ib_visible_new.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility));
				ib_visible_new.setColorFilter(getResources().getColor(R.color.green), PorterDuff.Mode.SRC_ATOP);
				ib_visible_new.setTag("Visible");
			} else {
				editNewPass.setTransformationMethod(PasswordTransformationMethod.getInstance());
				ib_visible_new.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility_off));
				ib_visible_new.setColorFilter(getResources().getColor(R.color.dark_grey), PorterDuff.Mode.SRC_ATOP);
				ib_visible_new.setTag("InVisible");
			}
		});

		ib_visible_con = dialog.findViewById(R.id.ib_visible_con);
		ib_visible_con.setTag("InVisible");

		ib_visible_con.setOnClickListener(v->{

			if (ib_visible_con.getTag().equals("InVisible")){
				editConfirmPass.setTransformationMethod(HideReturnsTransformationMethod.getInstance());
				ib_visible_con.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility));
				ib_visible_con.setColorFilter(getResources().getColor(R.color.green), PorterDuff.Mode.SRC_ATOP);
				ib_visible_con.setTag("Visible");
			} else {
				editConfirmPass.setTransformationMethod(PasswordTransformationMethod.getInstance());
				ib_visible_con.setImageDrawable(getResources().getDrawable(R.drawable.ic_visibility_off));
				ib_visible_con.setColorFilter(getResources().getColor(R.color.dark_grey), PorterDuff.Mode.SRC_ATOP);
				ib_visible_con.setTag("InVisible");
			}
		});

		dialog.findViewById(R.id.btn_submit).setOnClickListener(view -> {

			if(validatee()){
				setChangePassword(Utils.getProperText(editOldPass),Utils.getProperText(editNewPass));
			}

		});
		dialog.show();
	}

	private boolean validatee() {
		boolean isOk = true;

		if (Utils.getProperText(editOldPass).isEmpty()) {
			editOldPass.setError(getString(R.string.error_cannot_be_empty));
			editOldPass.requestFocus();
			isOk = false;
		} else if (!Validations.isValidPasswordd(Utils.getProperText(editOldPass))) {
			editOldPass.setError(getString(R.string.error_invalid_password));
			editOldPass.requestFocus();
			isOk = false;
		}  else if (Utils.getProperText(editNewPass).isEmpty()) {
			editNewPass.setError(getString(R.string.error_cannot_be_empty));
			editNewPass.requestFocus();
			isOk = false;
		} else if (!Validations.isValidPasswordd(Utils.getProperText(editNewPass))) {
			editNewPass.setError(getString(R.string.error_invalid_password));
			editNewPass.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(editConfirmPass).isEmpty()) {
			editConfirmPass.setError(getString(R.string.error_cannot_be_empty));
			editConfirmPass.requestFocus();
			isOk = false;
		} else if (!Validations.isValidPasswordd(Utils.getProperText(editConfirmPass))) {
			editConfirmPass.setError(getString(R.string.error_invalid_password));
			editConfirmPass.requestFocus();
			isOk = false;
		}else if (!(Utils.getProperText(editConfirmPass).equalsIgnoreCase(Utils.getProperText(editNewPass)))) {
			Toaster.customToast(getResources().getString(R.string.error_password_not_match));
			isOk = false;
		}

		return isOk;
	}

	private void setChangePassword(String oldPass,String newPass) {
		loaderView.showLoader();

		HashMap<String, Object> map = new HashMap<>();
		map.put(kUserId, ModelManager.modelManager().getCurrentUser().getUserId());
		map.put(kOldPassword, oldPass);
		map.put(kNewPassword, newPass);
		Log.e(TAG, "email_registered: " +map.toString());
		ModelManager.modelManager().userChangePasswrd(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();
				try {
					String msg = genericResponse.getObject();
					Toaster.customToast(msg);
					dialog.dismiss();
					Log.e(TAG, "msg: " + msg);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}
}
