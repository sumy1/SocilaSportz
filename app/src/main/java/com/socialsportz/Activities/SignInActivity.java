package com.socialsportz.Activities;

import android.app.Dialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.Typeface;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.text.Spannable;
import android.text.SpannableString;
import android.text.TextPaint;
import android.text.method.LinkMovementMethod;
import android.text.style.ClickableSpan;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.facebook.login.LoginManager;
import com.google.android.gms.auth.api.Auth;
import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInResult;
import com.socialsportz.Activities.Facility.FacilityDashboardActivity;
import com.socialsportz.Activities.User.Activities.UserDashboardActivity;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Broadcast.ReachableManager;
import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.R;
import com.socialsportz.SocialManager.FacebookManager;
import com.socialsportz.SocialManager.GoogleManager;
import com.socialsportz.Utils.CustomLoaderView;
import com.socialsportz.Utils.Toaster;
import com.socialsportz.Utils.Utils;
import com.socialsportz.Utils.Validations;

import org.json.JSONObject;

import java.util.Collections;
import java.util.HashMap;
import java.util.Objects;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import static com.socialsportz.Constants.Constants.kAuthToken;
import static com.socialsportz.Constants.Constants.kDataUnsuccessful;
import static com.socialsportz.Constants.Constants.kEmail;
import static com.socialsportz.Constants.Constants.kError;
import static com.socialsportz.Constants.Constants.kFacebookEmail;
import static com.socialsportz.Constants.Constants.kFacebookFirstName;
import static com.socialsportz.Constants.Constants.kFacebookGender;
import static com.socialsportz.Constants.Constants.kFacebookId;
import static com.socialsportz.Constants.Constants.kFacebookLastName;
import static com.socialsportz.Constants.Constants.kLoginType;
import static com.socialsportz.Constants.Constants.kPassword;
import static com.socialsportz.Constants.Constants.kRegisteredEmail;
import static com.socialsportz.Constants.Constants.kRole;
import static com.socialsportz.Constants.Constants.kUserName;
import static com.socialsportz.Models.BaseModel.getValue;

public class SignInActivity extends AppCompatActivity implements View.OnClickListener {
	private final static String TAG = SignInActivity.class.getSimpleName();
	private GoogleManager googleManager;
	private FacebookManager facebookManager;

	private EditText etEmail, etPassword;
	private CustomLoaderView loaderView;
	String from = "";
	LinearLayout sign_layout;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_sign_in);
		loaderView = CustomLoaderView.initialize(this);
		sign_layout = findViewById(R.id.sign_layout);

		/*if (getIntent() != null) {
			from = getIntent().getStringExtra("FROM");

			if (from.equalsIgnoreCase("1")) {
				sign_layout.setVisibility(View.VISIBLE);
			} else if (from.equalsIgnoreCase("2")) {
				sign_layout.setVisibility(View.GONE);
			}

		}*/

		etEmail = findViewById(R.id.et_email);
		etPassword = findViewById(R.id.et_password);

		findViewById(R.id.btn_google).setOnClickListener(this);
		findViewById(R.id.btn_facebook).setOnClickListener(this);
		findViewById(R.id.btn_login).setOnClickListener(this);

		// Forgot Password Click Listener
		findViewById(R.id.tv_forgot).setOnClickListener(v -> forgotDialog());

		// Spannable Text for the SignUp Activity
		TextView tvSignUp = findViewById(R.id.tv_signup);
		String firstWord = getResources().getString(R.string.login_have_account) + " ";
		String lastWord = getResources().getString(R.string.signup_txt);
		Spannable spannable = new SpannableString(firstWord + lastWord);
		spannable.setSpan(spanListener, firstWord.length(), firstWord.length() + lastWord.length(), Spannable.SPAN_EXCLUSIVE_EXCLUSIVE);
		tvSignUp.setText(spannable);
		tvSignUp.setMovementMethod(LinkMovementMethod.getInstance());

		googleManager = new GoogleManager(SignInActivity.this, googleManagerListener);
		//googleManager.getLastLogin();

		facebookManager = new FacebookManager(this, facebookManagerListener);
		LoginManager.getInstance().registerCallback(facebookManager.getCallbackManager(),
			facebookManager.getFacebookCallback());
	}

	// Span Listener for SignUp Activity
	ClickableSpan spanListener = new ClickableSpan() {
		@Override
		public void onClick(@NonNull View widget) {
			setSignUpIntent(Constants.LoginType.Normal.getValue(), "", "", "");
		}

		@Override
		public void updateDrawState(@NonNull TextPaint ds) {
			super.updateDrawState(ds);
			ds.setUnderlineText(false);
			boolean tabletSize = getResources().getBoolean(R.bool.isTablet);
			if (tabletSize)
				ds.setTextSize(30);
			else
				ds.setTextSize(45);
			ds.setTypeface(Typeface.DEFAULT_BOLD);
			ds.setColor(getResources().getColor(R.color.theme_light));
		}
	};

	@Override
	public void onClick(View v) {
		if (v.getId() == R.id.btn_google) {
			if (ReachableManager.getNetworkStatus()) {
				Utils.showAlertDialog(this, "Login Failed!",
					"Sorry, Login Failed to reach Google servers. Please check your network or try again later.");
				return;
			}
			googleManager.signIn();
		} else if (v.getId() == R.id.btn_facebook) {
			if (ReachableManager.getNetworkStatus()) {
				Utils.showAlertDialog(this, "Login Failed!",
					"Sorry, Login Failed to reach Google servers. Please check your network or try again later.");
				return;
			}
			LoginManager.getInstance().logInWithReadPermissions(this, Collections.singletonList("email"));
		} else if (v.getId() == R.id.btn_login) {
			//googleManager.signOut();
			//facebookManager.onLogout();
			// checking for validation



			if (validate())
				setLoginn(etEmail.getText().toString(), etPassword.getText().toString());

			/*if (from.equalsIgnoreCase("1")) {
				if (validate())
					setLoginn(etEmail.getText().toString(), etPassword.getText().toString());
			} else if (from.equalsIgnoreCase("2")) {
				if (validate())
					setLogin(etEmail.getText().toString(), etPassword.getText().toString());
			}*/


		}
	}

	GoogleManager.GoogleManagerInterface googleManagerListener = new GoogleManager.GoogleManagerInterface() {
		@Override
		public void success(GoogleSignInAccount acct) {
			if (acct != null) {
				String personName = acct.getDisplayName();
				String personEmail = acct.getEmail();
				String personId = acct.getId();
				//Uri personPhoto = acct.getPhotoUrl();
				Log.e("Google Login", personId + "," + personName + "," + personEmail);
				setSocialLogin(Constants.LoginType.Google.getValue(), personName, personEmail, personId);
			}
		}

		@Override
		public void failure() {
			Utils.showAlertDialog(SignInActivity.this, kError,
				"Error Completing Google authentication. Please try again, or if the issue persists, sign in using your email and password");
		}
	};

	FacebookManager.FacebookManagerInterface facebookManagerListener = new FacebookManager.FacebookManagerInterface() {
		@Override
		public void success(JSONObject socialUser) {
			String id = getValue(socialUser, kFacebookId, String.class);
			String firstName = getValue(socialUser, kFacebookFirstName, String.class);
			String lastName = getValue(socialUser, kFacebookLastName, String.class);
			String gender = getValue(socialUser, kFacebookGender, String.class);
			String email = getValue(socialUser, kFacebookEmail, String.class);
			String name = firstName + " " + lastName;
			Log.e("Facebook Login", id + "," + name + "," + gender + "," + email);
			if (email.isEmpty()) {
				Utils.showAlertDialog(SignInActivity.this, kError,
					"Error Completing Facebook authentication. Please try again, or if the issue persists, sign in using your email and password");
			} else
				setSocialLogin(Constants.LoginType.Facebook.getValue(), name, email, id);
		}

		@Override
		public void failure(String s) {
			Utils.showAlertDialog(SignInActivity.this, kError,
				"Error Completing Facebook authentication. Please try again, or if the issue persists, sign in using your email and password");
		}
	};

	private void forgotDialog() {
		// dialog
		final Dialog dialog = new Dialog(this);
		dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
		Objects.requireNonNull(dialog.getWindow()).setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
		dialog.setContentView(R.layout.dialog_forgot_password);

		dialog.findViewById(R.id.btn_close).setOnClickListener(v -> dialog.dismiss());
		EditText editText = dialog.findViewById(R.id.et_email);
		dialog.findViewById(R.id.btn_submit).setOnClickListener(view -> {
			if (Utils.getProperText(editText).isEmpty())
				Toaster.customToast("Please enter email address");
			else if (!Validations.isValidEmail(Utils.getProperText(editText)))
				Toaster.customToast("Please enter valid email");
			else
				setForgotPassword(Utils.getProperText(editText));
		});
		dialog.show();
	}

	private void setForgotPassword(String email) {
		loaderView.showLoader();
		Log.e(TAG, "email_registered: " + email);
		HashMap<String, Object> map = new HashMap<>();
		map.put(kRegisteredEmail, email);
		ModelManager.modelManager().userForgotPassword(map,
			(Constants.Status iStatus, GenericResponse<String> genericResponse) -> {
				loaderView.hideLoader();
				try {
					String msg = genericResponse.getObject();
					Toaster.customToast(msg);
					Log.e(TAG, "msg: " + msg);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}

	private boolean validate() {
		boolean isOk = true;

		if (Utils.getProperText(etEmail).isEmpty()) {
			etEmail.setError(getString(R.string.error_cannot_be_empty));
			etEmail.requestFocus();
			isOk = false;
		} else if (!(Validations.isValidEmail(Utils.getProperText(etEmail)))) {
			etEmail.setError(getString(R.string.error_invalid_credential));
			etEmail.requestFocus();
			isOk = false;
		} else if (Utils.getProperText(etPassword).isEmpty()) {
			etPassword.setError(getString(R.string.error_cannot_be_empty));
			etPassword.requestFocus();
			isOk = false;
		} else if (!Validations.isValidPassword(Utils.getProperText(etPassword))) {
			etPassword.setError(getString(R.string.error_invalid_password));
			etPassword.requestFocus();
			isOk = false;
		}

		return isOk;
	}

	private void setLogin(String email, String password) {
		loaderView.showLoader();
		Log.e(TAG, "username: " + email + ",password: " + password);
		HashMap<String, Object> map = new HashMap<>();
		map.put(kEmail, email);
		map.put(kPassword, password);

		Log.e("request", map.toString());
		ModelManager.modelManager().userLoginRequest(map,
			(Constants.Status iStatus, GenericResponse<CurrentUser> genericResponse) -> {
				loaderView.hideLoader();
				try {
					CurrentUser user = genericResponse.getObject();
					Log.e(TAG, user.toString());
					if (user.getRole().equals(Constants.Role.Owner.getValue())) {
						Intent in = new Intent(SignInActivity.this, FacilityDashboardActivity.class);
						in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
						in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
						startActivity(in);
						finish();
					} else {
						Toaster.customToast("Login email and password did not match");
					}

                        	/*if(user.getRole().equals(Constants.Role.EndUser.getValue())){
                            Intent in = new Intent(SignInActivity.this, UserDashboardActivity.class);
							in.putExtra("FRAG","1");
							in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
							in.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                            startActivity(in);
                            finish();
                        }*/
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}


	private void setLoginn(String email, String password) {
		loaderView.showLoader();
		Log.e(TAG, "username: " + email + ",password: " + password);
		HashMap<String, Object> map = new HashMap<>();
		map.put(kEmail, email);
		map.put(kPassword, password);

		Log.e("request", map.toString());
		ModelManager.modelManager().userLoginRequest(map,
			(Constants.Status iStatus, GenericResponse<CurrentUser> genericResponse) -> {
				loaderView.hideLoader();
				try {
					CurrentUser user = genericResponse.getObject();



					Log.e(TAG, user.toString());
					if(user.getRole().equals(Constants.Role.Owner.getValue())) {
						Intent in = new Intent(SignInActivity.this, FacilityDashboardActivity.class);
						in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
						in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
						startActivity(in);
						finish();
					}else if (user.getRole().equals(Constants.Role.EndUser.getValue())) {
						Intent in = new Intent(SignInActivity.this, UserDashboardActivity.class);
						in.putExtra("FRAG", "1");
						in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
						in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
						startActivity(in);
						finish();
					}

					 else {
						Toaster.customToast("Login email and password did not match");
					}
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				Toaster.customToast(message);
			});
	}


	private void setSocialLogin(int loginType, String name, String email, String authId) {
		loaderView.showLoader();
		Log.e("Social Login", "username: " + email);
		HashMap<String, Object> map = new HashMap<>();
		map.put(kEmail, email);
		ModelManager.modelManager().userSocialLoginRequest(map,
			(Constants.Status iStatus, GenericResponse<CurrentUser> genericResponse) -> {
				loaderView.hideLoader();
				try {
					CurrentUser user = genericResponse.getObject();
					Log.e(TAG, user.toString());
                        /*if(user.getRole().equals(Constants.Role.Owner.getValue())) {
                            Intent in = new Intent(SignInActivity.this, FacilityDashboardActivity.class);
                            in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                            in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                            startActivity(in);
                            finish();
                        }else*/

					if (user.getRole().equals(Constants.Role.EndUser.getValue())) {
						Intent in = new Intent(SignInActivity.this, UserDashboardActivity.class);
						in.putExtra("FRAG", "1");
						in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
						in.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
						startActivity(in);
						finish();
					} else {
						Toaster.customToast("Login email and password did not match");
					}
				} catch (Exception e) {
					e.printStackTrace();
				}
			}, (Constants.Status iStatus, String message) -> {
				loaderView.hideLoader();
				if (message.equals(kDataUnsuccessful)) {
					setSignUpIntent(loginType, authId, name, email);
				} else {
					Toaster.customToast(message);
				}
			});
	}

	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		facebookManager.getCallbackManager().onActivityResult(requestCode, resultCode, data);
		if (requestCode == GoogleManager.RC_SIGN_IN) {
            /*Task<GoogleSignInAccount> task = GoogleSignIn.getSignedInAccountFromIntent(data);
            googleManager.handleSignInResult(task);*/
			GoogleSignInResult result = Auth.GoogleSignInApi.getSignInResultFromIntent(data);
			googleManager.handleSignInResult(result);
		}
	}

	private void setSignUpIntent(int loginType, String id, String name, String email) {
		Intent in = new Intent(SignInActivity.this, SignUpActivity.class);
		in.putExtra(kLoginType, loginType);
		in.putExtra(kAuthToken, id);
		in.putExtra(kUserName, name);
		in.putExtra(kEmail, email);
		in.putExtra(kRole, Constants.Role.EndUser.getValue());
		startActivity(in);
		finish();
	}
}
