package com.socialsportz.ModelManager;

import android.util.Log;

import com.socialsportz.APIManager.ApiInterface;
import com.socialsportz.APIManager.ApiManager;
import com.socialsportz.Activities.User.Adapters.EventSeeAllList;
import com.socialsportz.BaseManager.BaseManager;
import com.socialsportz.Blocks.Block;
import com.socialsportz.Blocks.GenericResponse;
import com.socialsportz.Broadcast.ReachableManager;
import com.socialsportz.Constants.Constants;
import com.socialsportz.DispatchQueue.DispatchQueue;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.BaseModel;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotAvail;
import com.socialsportz.Models.Owner.BatchSlotType;
import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.Models.Owner.CalendarData;
import com.socialsportz.Models.CurrentUser;
import com.socialsportz.Models.Owner.DashboardData;
import com.socialsportz.Models.Owner.EmailAlerts;
import com.socialsportz.Models.Owner.Enquires;
import com.socialsportz.Models.Owner.Events;
import com.socialsportz.Models.Owner.FacAchievement;
import com.socialsportz.Models.Owner.FacAmenity;
import com.socialsportz.Models.Owner.FacBankModel;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.FacGallery;
import com.socialsportz.Models.Owner.FacReward;
import com.socialsportz.Models.Owner.FacSport;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.NotificationAlert;
import com.socialsportz.Models.Owner.ProfileSummyStatus;
import com.socialsportz.Models.Owner.Rating;
import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.Models.Owner.StatisticsData;
import com.socialsportz.Models.Owner.StatisticsDataEvent;
import com.socialsportz.Models.User.BookingStatusResponse;
import com.socialsportz.Models.User.CartCount;
import com.socialsportz.Models.User.EventDetails;
import com.socialsportz.Models.User.FavModelChecked;
import com.socialsportz.Models.User.UserAddcartList;
import com.socialsportz.Models.User.UserBatchSlotAvail;
import com.socialsportz.Models.User.UserDashBoard;
import com.socialsportz.Models.User.UserEnquire;
import com.socialsportz.Models.User.UserEventBooked;
import com.socialsportz.Models.User.UserEventdata;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.Models.User.UserFacility;
import com.socialsportz.Models.User.UserFacilityAcademyBooked;
import com.socialsportz.Models.User.UserNotification;
import com.socialsportz.Models.User.UserPackage;
import com.socialsportz.Models.User.UserProfile;
import com.socialsportz.Models.User.UserReview;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.concurrent.CopyOnWriteArrayList;

import static com.socialsportz.APIManager.ApiInterface.kLogout;

/**
 * Singleton class to manage all models in projects. this is basically provide data to view in the
 * form of models
 */

public class ModelManager extends BaseManager implements Constants {

	private final static String TAG = ModelManager.class.getSimpleName();
	//Static Properties
	private static ModelManager _ModelManager;

	//Instance variables
	private static CurrentUser mCurrentUser = null;
	private DispatchQueue dispatchQueue =
		new DispatchQueue("com.queue.serial.modelmanager", DispatchQueue.QoS.userInitiated);

	/**
	 * private constructor make it to be Singleton class
	 */
	private ModelManager() {
	}

	/**
	 * method to create a threadsafe singleton class instance
	 *
	 * @return a thread safe singleton object of model manager
	 */
	public static synchronized ModelManager modelManager() {
		if (_ModelManager == null) {
			_ModelManager = new ModelManager();
			mCurrentUser = getDataFromPreferences(kCurrentUser, CurrentUser.class);
			Log.e(TAG, mCurrentUser + " ");
		}
		return _ModelManager;
	}

	public DispatchQueue getDispatchQueue() {
		return dispatchQueue;
	}

	/**
	 * to initialize the singleton object
	 */
	public void initializeModelManager() {
		System.out.println("ModelManager object initialized.");
	}

	/**
	 * getter and setter method for current user
	 *
	 * @return {@link CurrentUser} if user already logged in, null otherwise
	 */
	public synchronized CurrentUser getCurrentUser() {
		return mCurrentUser;
	}

	public synchronized void setCurrentUser(CurrentUser o) {
		mCurrentUser = o;
		archiveCurrentUser();
	}

	public synchronized void setFirstLoginDone() {
		mCurrentUser.setmFirstLogin(false);
		archiveCurrentUser();
	}

	public synchronized void setFacilitySelectData(int facId) {
		mCurrentUser.setSelectedFacId(facId);
		mCurrentUser.setDashData(null);
		archiveCurrentUser();
	}

	/**
	 * set response to @User
	 *
	 * @param genricResponse contains JSONObject with user information in it
	 */
	private void setupCurrentUser(GenericResponse<JSONObject> genricResponse, int status) {
		try {
			if (status == 1) {
				mCurrentUser = new CurrentUser(genricResponse.getObject().getJSONObject(kResponse), 1);
				mCurrentUser.setmFirstLogin(true);
			} else {
				mCurrentUser = new CurrentUser(genricResponse.getObject().getJSONObject(kResponse), 0);
				if (mCurrentUser.getRole().equals(Role.Owner.getValue())) {
					if (!mCurrentUser.getFacilities().isEmpty())
						mCurrentUser.setSelectedFacId(mCurrentUser.getFacilities().get(0).getFacId());
				}
			}

		} catch (JSONException e) {
			e.printStackTrace();
		}
		archiveCurrentUser();
	}

	private void UpdateFacility(FacSport facSport) {
		CopyOnWriteArrayList<Facility> list = mCurrentUser.getFacilities();
		for (int i = 0; i < list.size(); i++) {
			Facility fac = list.get(i);
			if (fac.getFacId() == facSport.getFacId()) {
				CopyOnWriteArrayList<FacSport> sports = fac.getFacSportList();
				if (!sports.isEmpty()) {
					for (int j = 0; j < sports.size(); j++) {
						if (sports.get(j).getSportId() == facSport.getSportId()) {
							sports.remove(sports.get(j));
						}
					}
				}
			}
		}
		archiveCurrentUser();
		Log.e("User", mCurrentUser.toString());
	}

	/**
	 * Stores {@link CurrentUser} to the share preferences and synchronize sharedpreferece
	 */
	private synchronized void archiveCurrentUser() {
		saveDataIntoPreferences(mCurrentUser, BaseModel.kCurrentUser);
	}

	//User API

	/**
	 * method will be called when user login through system eg. with email and password
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition11
	 */
	public void userLoginRequest(HashMap<String, Object> parameters, Block.Success<CurrentUser> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserLogin, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					try {
						setupCurrentUser(genricResponse, 0);
					} catch (Exception e) {
						e.printStackTrace();
					}
					GenericResponse<CurrentUser> generic = new GenericResponse<>(mCurrentUser);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Login", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when user login through system eg. with email and password
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition11
	 */
	public void userSocialLoginRequest(HashMap<String, Object> parameters, Block.Success<CurrentUser> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserSocial, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject jsonObject = genricResponse.getObject().getJSONObject(kResponse);
					if (jsonObject.has(kTag)) {
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kDataUnsuccessful));
					} else {
						try {
							setupCurrentUser(genricResponse, 0);
						} catch (Exception e) {
							e.printStackTrace();
						}
						GenericResponse<CurrentUser> generic = new GenericResponse<>(mCurrentUser);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					}
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Login", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when user register through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userRegisterRequest(HashMap<String, Object> parameters, Block.Success<CurrentUser> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserReg, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					try {
						setupCurrentUser(genricResponse, 1);
					} catch (Exception e) {
						e.printStackTrace();
					}
					GenericResponse<CurrentUser> generic = new GenericResponse<>(mCurrentUser);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("SignUp", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userEditProfile(HashMap<String, Object> parameters, Block.Success<CurrentUser> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserEditProfile, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					try {
						setupCurrentUser(genricResponse, 1);
					} catch (Exception e) {
						e.printStackTrace();
					}
					GenericResponse<CurrentUser> generic = new GenericResponse<>(mCurrentUser);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("SignUp", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when user mobile Verification through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userMobileVerification(HashMap<String, Object> parameters, Block.Success<Integer> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kMobileVerify, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject object = genricResponse.getObject().getJSONObject(kResponse);
					Integer mobileOTP = object.getInt(kMobileVerify);
					GenericResponse<Integer> generic = new GenericResponse<>(mobileOTP);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Mobile Verification", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userSendEnquire(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserEnquiry, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);

					if (msg.equals("1")) {
						String mes_res = genricResponse.getObject().getString(kResponseMessage);
						GenericResponse<String> generic = new GenericResponse<>(mes_res);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {

					}

				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void usergetNotCount(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kuserNotificationCount, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject object = genricResponse.getObject().getJSONObject(kResponse);
					String mobileOTP = object.getString(kuserActivityCount);
					GenericResponse<String> generic = new GenericResponse<>(mobileOTP);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Mobile Verification", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}




	public void userSendFav(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserFavouriteListDelete, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);


					if (msg.equals("1")) {
						String mes_res = genricResponse.getObject().getString(kResponseMessage);
						GenericResponse<String> generic = new GenericResponse<>(mes_res);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {

					}

				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userSendFavAll(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserFavouriteDelete, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);


					if (msg.equals("1")) {
						String mes_res = genricResponse.getObject().getString(kResponseMessage);
						GenericResponse<String> generic = new GenericResponse<>(mes_res);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {

					}

				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userSendReview(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kratingUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					//String msg = genricResponse.getObject().getString(kResponseMessage);
					String mes_res = genricResponse.getObject().getString(kResponseMessage);
					GenericResponse<String> generic = new GenericResponse<>(mes_res);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));


				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userInsertReview(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserInsertReview, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					//String msg = genricResponse.getObject().getString(kResponseMessage);
					String mes_res = genricResponse.getObject().getString(kResponseMessage);
					GenericResponse<String> generic = new GenericResponse<>(mes_res);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));


				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userSendUpdateSports(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUpdateSports, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String mes_res = genricResponse.getObject().getString(kResponseMessage);
					GenericResponse<String> generic = new GenericResponse<>(mes_res);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));

				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when user forgot Password through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userForgotPassword(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kForgotPassword, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);
					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userChangePasswrd(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kChangePassword, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponseMessage);
					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when user change password through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userChangePassword(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kChangePassword, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject object = genricResponse.getObject().getJSONObject(kResponse);
					String new_password = object.getString(kNewPassword);
					mCurrentUser.setPassword(new_password);
					archiveCurrentUser();
					GenericResponse<String> generic = new GenericResponse<>(new_password);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Change Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be to logout user from application
	 *
	 * @param status  Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void getLogout(Block.Status status, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kUserId, getCurrentUser().getUserId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(kLogout, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					DispatchQueue.main(() -> status.iStatus(iStatus));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Logout", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	//Facility API

	/**
	 * method will be called when facility profile through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userFacilityProfile(HashMap<String, Object> parameters, Block.Success<CurrentUser> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacilityProfile, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject jsonObject = genricResponse.getObject().getJSONObject(kResponse);
					getCurrentUser().setUsername(jsonObject.getString(kUserName));
					getCurrentUser().setUserAddress(jsonObject.getString(kAddress));
					getCurrentUser().setUserSubArea(jsonObject.getString(kAddress2));
					getCurrentUser().setUserGoogleAdd(jsonObject.getString(kStreetAddress));
					getCurrentUser().setUserCity(jsonObject.getString(kCity));
					getCurrentUser().setUserCountry(jsonObject.getString(kCountry));
					getCurrentUser().setUserLat(jsonObject.getString(kLatitude));
					getCurrentUser().setUserLng(jsonObject.getString(kLongitude));
					getCurrentUser().setUserPinCode(jsonObject.getString(kPincode));
					getCurrentUser().setGender(jsonObject.getString(kGender));
					archiveCurrentUser();
					GenericResponse<CurrentUser> generic = new GenericResponse<>(mCurrentUser);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userAddFacilityProfile(HashMap<String, Object> parameters, Block.Success<Facility> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacilityAddProfile, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					Facility mFacility = new Facility(genricResponse.getObject().getJSONObject(kResponse));
					if (mCurrentUser.getFacilities().isEmpty()) {
						mCurrentUser.getFacilities().add(mFacility);
					} else {
						CopyOnWriteArrayList<Facility> facilities = mCurrentUser.getFacilities();
						boolean found = false;
						for (int i = 0; i < facilities.size(); i++) {
							if (facilities.get(i).getFacId() == mFacility.getFacId()) {
								facilities.get(i).setData(genricResponse.getObject().getJSONObject(kResponse));
								found = true;
								break;
							}
						}
						if (!found)
							mCurrentUser.getFacilities().add(mFacility);
					}
					archiveCurrentUser();
					GenericResponse<Facility> generic = new GenericResponse<>(mFacility);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userAddFacilityAchieve(HashMap<String, Object> parameters, Block.Success<FacAchievement> success, Block.Failure failure) {
		//int facId = (Integer) parameters.get(kFacId);
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacilityAddAchieve, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					FacAchievement mAchieve = new FacAchievement(genricResponse.getObject().getJSONObject(kResponse));
                        /*CopyOnWriteArrayList<Facility> facList = mCurrentUser.getFacilities();
                        for(int i=0;i<facList.size();i++){
                            if(facList.get(i).getFacId()==facId){
                                facList.get(i).getAchieveList().add(mAchieve);
                            }
                        }*/
					GenericResponse<FacAchievement> generic = new GenericResponse<>(mAchieve);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userAddFacilitySports(HashMap<String, Object> parameters, Block.Success<FacSport> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacilityAddSports, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					FacSport mSport = new FacSport(genricResponse.getObject().getJSONObject(kResponse));
					GenericResponse<FacSport> generic = new GenericResponse<>(mSport);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userAddFacilityAmenities(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<FacAmenity>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacilityAddAmenities, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<FacAmenity> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new FacAmenity((JSONObject) array.get(i)));
					}
					mCurrentUser.setMyAmenities(list);
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<FacAmenity>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param parameters include user info provided by user
	 * @param success    Block passed as callback for success condition
	 * @param failure    Block passed as callback for failure condition
	 */
	public void userAddFacilityBank(HashMap<String, Object> parameters, Block.Success<FacBankModel> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacilityAddBank, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject object = genricResponse.getObject().getJSONObject(kResponse);
					FacBankModel model = new FacBankModel(object);
					mCurrentUser.setUserBankDetails(model);
					archiveCurrentUser();
					GenericResponse<FacBankModel> generic = new GenericResponse<>(model);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userSports(Block.Success<CopyOnWriteArrayList<Sport>> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kAction, kMessage);
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kMasterSports, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Sport> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Sport((JSONObject) array.get(i)));
					}
					mCurrentUser.setSports(list);
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<Sport>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userAmenities(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Amenity>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kMasterAmenities, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Amenity> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Amenity((JSONObject) array.get(i)));
					}
					mCurrentUser.setAmenities(list);
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<Amenity>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userMasterAmenities(Block.Success<CopyOnWriteArrayList<Amenity>> success, Block.Failure failure) {
		HashMap < String, Object > parameters = new HashMap<>();
		parameters.put(kAction, kMessage);
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kMasterAmenities,parameters ,(Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Amenity> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Amenity((JSONObject) array.get(i)));
					}
					mCurrentUser.setAmenities(list);
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<Amenity>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userRewards(Block.Success<CopyOnWriteArrayList<FacReward>> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kAction, kMessage);
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kMasterRewards, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<FacReward> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new FacReward((JSONObject) array.get(i)));
					}
					mCurrentUser.setRewards(list);
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<FacReward>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAcademyListing(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Facility>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacAcaListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Facility> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					if (array.length() != 0) {
						for (int i = 0; i < array.length(); i++) {
							list.add(new Facility((JSONObject) array.get(i)));
						}
					}
					mCurrentUser.setFacilities(list);
					if (!list.isEmpty())
						mCurrentUser.setSelectedFacId(list.get(0).getFacId());
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<Facility>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAchieveListing(int facId, Block.Success<CopyOnWriteArrayList<FacAchievement>> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId, facId);
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacAchieveListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<FacAchievement> list = new CopyOnWriteArrayList<>();
					CopyOnWriteArrayList<Facility> facList = mCurrentUser.getFacilities();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new FacAchievement((JSONObject) array.get(i)));
					}
					for (int j = 0; j < facList.size(); j++) {
						if (facList.get(j).getFacId() == facId)
							facList.get(j).setAchieveList(list);
					}
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<FacAchievement>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacSportListing(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<FacSport>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacSportsListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<FacSport> list = new CopyOnWriteArrayList<>();
					CopyOnWriteArrayList<Facility> facList = mCurrentUser.getFacilities();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					if (array.length() != 0) {
                            /*for(int i=0;i<array.length();i++){
                                list.add(new FacSport((JSONObject)array.get(i)));
                                for(int j=0;j<facList.size();j++){
                                    if(facList.get(j).getFacId()==list.get(i).getFacId()){
                                        facList.get(j).getFacSportList().add(new FacSport((JSONObject)array.get(i)));
                                    }
                                }
                            }*/
						for (int i = 0; i < array.length(); i++) {
							list.add(new FacSport((JSONObject) array.get(i)));
							for (int j = 0; j < facList.size(); j++) {
								if (facList.get(j).getFacId() == list.get(i).getFacId()) {
									CopyOnWriteArrayList<FacSport> sports = facList.get(j).getFacSportList();
									if (!sports.isEmpty()) {
										sports.clear();
										facList.get(j).getFacSportList().add(new FacSport((JSONObject) array.get(i)));
									} else {
										facList.get(j).getFacSportList().add(new FacSport((JSONObject) array.get(i)));
									}
								}
							}
						}
					}
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<FacSport>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAcaDelete(Facility facility, Block.Success<String> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId, facility.getFacId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacAcaDelete, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);
					CopyOnWriteArrayList<Facility> list = mCurrentUser.getFacilities();
					for (int i = 0; i < list.size(); i++) {
						if (list.get(i).getFacId() == facility.getFacId())
							list.remove(facility);
					}
					archiveCurrentUser();
					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAchieveDelete(FacAchievement facAchievement, Block.Success<String> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId, facAchievement.getFacId());
		parameters.put(kAchieveId, facAchievement.getFacAchieveId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacAchieveDelete, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);
					CopyOnWriteArrayList<Facility> list = mCurrentUser.getFacilities();
					for (int i = 0; i < list.size(); i++) {
						if (list.get(i).getFacId() == facAchievement.getFacId())
							list.get(i).getAchieveList().remove(facAchievement);
					}
					archiveCurrentUser();
					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacSportDelete(FacSport facSport, Block.Success<String> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId, facSport.getFacId());
		parameters.put(kFacSportId, facSport.getFacSportId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacSportDelete, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);
					UpdateFacility(facSport);
					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacTimingUpdate(int facId, String dayTimeList, Block.Success<CopyOnWriteArrayList<FacDayTime>> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kFacId, facId);
		parameters.put(kFacTiming, dayTimeList);
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacTimingUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<FacDayTime> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					CopyOnWriteArrayList<Facility> facList = mCurrentUser.getFacilities();
					for (int i = 0; i < array.length(); i++) {
						list.add(new FacDayTime(array.getJSONObject(i)));
					}
					for (int j = 0; j < facList.size(); j++) {
						if (facId == facList.get(j).getFacId())
							facList.get(j).setFacTimingList(list);
					}
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<FacDayTime>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAcaTypes(Block.Success<CopyOnWriteArrayList<BatchSlotType>> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kAction, kMessage);
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kBatchSlotTypes, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<BatchSlotType> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new BatchSlotType((JSONObject) array.get(i)));
					}
					mCurrentUser.setBatchSlotTypes(list);
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<BatchSlotType>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAcaPackages(Block.Success<CopyOnWriteArrayList<BatchPackage>> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kAction, kMessage);
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacBatchPackages, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<BatchPackage> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new BatchPackage((JSONObject) array.get(i)));
					}
					mCurrentUser.setBatchPackages(list);
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<BatchPackage>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAddEditSlot(HashMap<String, Object> parameters, Block.Success<BatchSlot> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacAddEditSlot, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					BatchSlot batchSlot = new BatchSlot(genricResponse.getObject().getJSONObject(kResponse));
                        /*CopyOnWriteArrayList<Facility> list = mCurrentUser.getFacilities();
                        for(int i=0;i<list.size();i++){
                            if(list.get(i).getFacId()==facSport.getFacId())
                                list.get(i).getFacSportList().remove(facSport);
                        }
                        archiveCurrentUser();*/
					GenericResponse<BatchSlot> generic = new GenericResponse<>(batchSlot);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userAcaAddEditBatch(HashMap<String, Object> parameters, Block.Success<BatchSlot> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kAcaAddEditBatch, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					BatchSlot batchSlot = new BatchSlot(genricResponse.getObject().getJSONObject(kResponse));
                        /*CopyOnWriteArrayList<Facility> list = mCurrentUser.getFacilities();
                        for(int i=0;i<list.size();i++){
                            if(list.get(i).getFacId()==facSport.getFacId())
                                list.get(i).getFacSportList().remove(facSport);
                        }
                        archiveCurrentUser();*/
					GenericResponse<BatchSlot> generic = new GenericResponse<>(batchSlot);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userAcaBatchSlotListing(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<BatchSlot>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacBatchSlotList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<BatchSlot> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new BatchSlot((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<BatchSlot>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userAcaBatchSlotArchiveListing(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<BatchSlot>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kfacbatcharciveList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<BatchSlot> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new BatchSlot((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<BatchSlot>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAddEditEvent(HashMap<String, Object> parameters, Block.Success<Events> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacAddEditEvent, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					Events event = new Events(genricResponse.getObject().getJSONObject(kResponse));
                        /*CopyOnWriteArrayList<Facility> list = mCurrentUser.getFacilities();
                        for(int i=0;i<list.size();i++){
                            if(list.get(i).getFacId()==facSport.getFacId())
                                list.get(i).getFacSportList().remove(facSport);
                        }
                        archiveCurrentUser();*/
					GenericResponse<Events> generic = new GenericResponse<>(event);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacEventListing(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Events>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacEventList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Events> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Events((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<Events>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userFacEventArcListing(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Events>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kEventArchiveList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Events> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Events((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<Events>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAddEditGallery(HashMap<String, Object> parameters, Block.Success<FacGallery> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacAddEditGallery, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					FacGallery gallery = null;
					if (!genricResponse.getObject().getJSONObject(kResponse).has(kTag))
						gallery = new FacGallery(genricResponse.getObject().getJSONObject(kResponse));
                        /*CopyOnWriteArrayList<Facility> list = mCurrentUser.getFacilities();
                        for(int i=0;i<list.size();i++){
                            if(list.get(i).getFacId()==facSport.getFacId())
                                list.get(i).getFacSportList().remove(facSport);
                        }
                        archiveCurrentUser();*/
					GenericResponse<FacGallery> generic = new GenericResponse<>(gallery);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacGalleryListing(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<FacGallery>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacGalleryList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<FacGallery> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new FacGallery((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<FacGallery>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacBookingList(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Bookings>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacBookingListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Bookings> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					//JSONArray arr = array.getJSONArray(0);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Bookings((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<Bookings>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userEventBookingList(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Bookings>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kEventBookingListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Bookings> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					//JSONArray arr = array.getJSONArray(0);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Bookings((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<Bookings>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacReviewList(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Rating>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacReviewListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Rating> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Rating((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<Rating>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userReviewList(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<UserReview>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacReviewListingg, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<UserReview> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new UserReview((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<UserReview>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacEnquiryList(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Enquires>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacEnquiryListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Enquires> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Enquires((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<Enquires>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacNotificationList(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<NotificationAlert>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacNotificationListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<NotificationAlert> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new NotificationAlert((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<NotificationAlert>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacEmailAlertList(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<EmailAlerts>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacEmailAlertListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<EmailAlerts> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new EmailAlerts((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<EmailAlerts>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacDashBoard(HashMap<String, Object> parameters, Block.Success<DashboardData> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacDashBoard, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					DashboardData data = new DashboardData(genricResponse.getObject().getJSONObject(kResponse));
					mCurrentUser.setDashData(data);
					archiveCurrentUser();
					GenericResponse<DashboardData> generic = new GenericResponse<>(data);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}



	public void getStatictics(HashMap<String, Object> parameters, Block.Success<StatisticsData> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacStaticticsSlot, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					StatisticsData data = new StatisticsData(genricResponse.getObject().getJSONObject(kResponse));

					GenericResponse<StatisticsData> generic = new GenericResponse<>(data);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void getStaticticss(HashMap<String, Object> parameters, Block.Success<StatisticsDataEvent> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacStaticticsEvent, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					StatisticsDataEvent data = new StatisticsDataEvent(genricResponse.getObject().getJSONObject(kResponse));

					GenericResponse<StatisticsDataEvent> generic = new GenericResponse<>(data);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAvailBookings(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<BatchSlotAvail>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kAvailableBooking, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<BatchSlotAvail> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						if (((JSONArray) array.getJSONObject(i).get(kBatchSlotData)).length() != 0)
							list.add(new BatchSlotAvail(array.getJSONObject(i)));
					}
					GenericResponse<CopyOnWriteArrayList<BatchSlotAvail>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userExistingDetail(HashMap<String, Object> parameters, Block.Success<CurrentUser> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserDetails, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject object = genricResponse.getObject().getJSONObject(kResponse);
					if (object.has(kTag)) {
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kDataUnsuccessful));
					} else {
						CurrentUser user = new CurrentUser(object, 3);
						GenericResponse<CurrentUser> generic = new GenericResponse<>(user);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					}
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userOfflineCheckout(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kBookingCheckout, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);
					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacCalendarData(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<CalendarData>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacCalendarData, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<CalendarData> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new CalendarData((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<CalendarData>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacCalendarDetails(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<BatchSlot>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kCalendarSlotBatchDetail, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<BatchSlot> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						list.add(new BatchSlot((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<BatchSlot>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userCalendarBookingList(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Bookings>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kCalendarBookingList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Bookings> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					//JSONArray arr = array.getJSONArray(0);
					for (int i = 0; i < array.length(); i++) {
						list.add(new Bookings((JSONObject) array.get(i)));
					}
					GenericResponse<CopyOnWriteArrayList<Bookings>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userProfileStatus(Block.Success<Integer> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kUserId, mCurrentUser.getUserId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserProfileStatus, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				int profileStatus;
				try {
					profileStatus = genricResponse.getObject().getJSONObject(kResponse).getInt(kProfileStatus);
					mCurrentUser.setProfileStatus(profileStatus);
					archiveCurrentUser();
					GenericResponse<Integer> generic = new GenericResponse<>(profileStatus);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}

			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userNotificationCount(HashMap<String, Object> parameters, Block.Status success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserNotificationCount, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				int notificationCount, emailCount;
				try {
					notificationCount = genricResponse.getObject().getJSONObject(kResponse).getInt(kNotificationCount);
					emailCount = genricResponse.getObject().getJSONObject(kResponse).getInt(kEmailAlertCount);
					mCurrentUser.setNotificationCount(notificationCount);
					mCurrentUser.setEmailAlertCount(emailCount);
					archiveCurrentUser();
					DispatchQueue.main(() -> success.iStatus(iStatus));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userNotificationUpdate(HashMap<String, Object> parameters, Block.Status success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserNotificationUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				Log.e("Notification", "Update Successful");
				DispatchQueue.main(() -> success.iStatus(iStatus));
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userEmailAlertUpdate(Block.Status success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kUserId, mCurrentUser.getUserId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserEmailAlertUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				Log.e("Email Alert", "Update Successful");
				DispatchQueue.main(() -> success.iStatus(iStatus));
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userProfileUpdate(Block.Success<CurrentUser> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kUserId, mCurrentUser.getUserId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserProfileUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject jsonObject = genricResponse.getObject().getJSONObject(kResponse);
					getCurrentUser().setUsername(jsonObject.getString(kUserName));
					getCurrentUser().setPassword(jsonObject.getString(kPassword));
					getCurrentUser().setUserAddress(jsonObject.getString(kAddress));
					getCurrentUser().setUserSubArea(jsonObject.getString(kAddress2));
					getCurrentUser().setUserGoogleAdd(jsonObject.getString(kStreetAddress));
					getCurrentUser().setUserCity(jsonObject.getString(kCity));
					getCurrentUser().setUserCountry(jsonObject.getString(kCountry));
					getCurrentUser().setUserLat(jsonObject.getString(kLatitude));
					getCurrentUser().setUserLng(jsonObject.getString(kLongitude));
					getCurrentUser().setUserPinCode(jsonObject.getString(kPincode));
					getCurrentUser().setGender(jsonObject.getString(kGender));
					getCurrentUser().setEmailVerified(jsonObject.getString(kIsEmailVerified).equals("yes"));
					getCurrentUser().setPhoneVerified(jsonObject.getString(kIsMobileVerified).equals("yes"));
					archiveCurrentUser();
					GenericResponse<CurrentUser> generic = new GenericResponse<>(mCurrentUser);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userprofileSummyStatus(Block.Success<ProfileSummyStatus> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kUserId, mCurrentUser.getUserId());
		try {
			parameters.put(kFacId,mCurrentUser.getSelectedFacId());
		} catch (Exception e) {
			e.printStackTrace();
		}

		Log.e("Send param",parameters.toString());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kuserfacilityStatus, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {

				ProfileSummyStatus profileSummyStatus;

				try {
					 profileSummyStatus=new ProfileSummyStatus(genricResponse.getObject().getJSONObject(kResponse).getJSONObject(kProfileStatus));
					GenericResponse<ProfileSummyStatus> generic = new GenericResponse<>(profileSummyStatus);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void usergetSlotCountFacility(HashMap<String, Object> parameters,Block.Success<JSONObject> success, Block.Failure failure) {

		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserfacSlotcount, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {

				try {
					JSONObject msg=genricResponse.getObject().getJSONObject(kResponse);
					GenericResponse<JSONObject> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void usergetConvenienceCharge(HashMap<String, Object> parameters,Block.Success<JSONObject> success, Block.Failure failure) {

		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserCovenienceCharge, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {

				try {
					JSONObject msg=genricResponse.getObject().getJSONObject(kResponse);
					GenericResponse<JSONObject> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void usergetCancellationCharge(HashMap<String, Object> parameters,Block.Success<JSONObject> success, Block.Failure failure) {

		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kusercancellationCharge, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {

				try {
					JSONObject msg=genricResponse.getObject().getJSONObject(kResponse);
					GenericResponse<JSONObject> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacilityUpdate(HashMap<String, Object> parameters, Block.Success<Facility> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserFacilityUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				Facility facility;
				try {
					CopyOnWriteArrayList<Facility> facList = mCurrentUser.getFacilities();
					facility = new Facility(genricResponse.getObject().getJSONObject(kResponse));
					for (int j = 0; j < facList.size(); j++) {
						if (facList.get(j).getFacId() == ModelManager.modelManager().getCurrentUser().getSelectedFacId()) {
							facList.set(j, facility);
							break;
						}
					}
					archiveCurrentUser();
					GenericResponse<Facility> generic = new GenericResponse<>(facility);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userAcheivementDelete(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserAcheivemnetDellete, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {

				try {
					String msg=genricResponse.getObject().getString(kResponseMessage);

					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacBankUpdate(Block.Success<FacBankModel> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kUserId, mCurrentUser.getUserId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserBankDetails, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				FacBankModel bank;
				try {
					bank = new FacBankModel(genricResponse.getObject().getJSONObject(kResponse));
					mCurrentUser.setUserBankDetails(bank);
					archiveCurrentUser();
					GenericResponse<FacBankModel> generic = new GenericResponse<>(bank);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacTimingUpdate(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<FacDayTime>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserFacTimingUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				CopyOnWriteArrayList<FacDayTime> dayList = new CopyOnWriteArrayList<>();
				try {

					CopyOnWriteArrayList<Facility> facList = mCurrentUser.getFacilities();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						dayList.add(new FacDayTime(array.getJSONObject(i)));
					}
					for (int j = 0; j < facList.size(); j++) {
						if (facList.get(j).getFacId() == ModelManager.modelManager().getCurrentUser().getSelectedFacId()) {
							facList.get(j).setFacTimingList(dayList);
							break;
						}
					}
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<FacDayTime>> generic = new GenericResponse<>(dayList);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAmenityUpdate(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<FacAmenity>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserAmenityUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				CopyOnWriteArrayList<FacAmenity> amenities = new CopyOnWriteArrayList<>();
				try {
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					for (int i = 0; i < array.length(); i++) {
						amenities.add(new FacAmenity(array.getJSONObject(i)));
					}
					mCurrentUser.setMyAmenities(amenities);
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<FacAmenity>> generic = new GenericResponse<>(amenities);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (JSONException e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacAcademyListUpdate(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<Facility>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacAcaListingNew, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<Facility> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					if (array.length() != 0) {
						for (int i = 0; i < array.length(); i++) {
							list.add(new Facility((JSONObject) array.get(i)));
						}
						mCurrentUser.setFacilities(list);
						archiveCurrentUser();
						GenericResponse<CopyOnWriteArrayList<Facility>> generic = new GenericResponse<>(list);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {
						DispatchQueue.main(() -> failure.iFailure(Status.fail, "Fac/Aca Empty List"));
					}
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userReportAbuseReview(HashMap<String, Object> parameters, Block.Status success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kRatingAbuseUpdate, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				Log.e("Review Abuse", "Update Successful");
				DispatchQueue.main(() -> success.iStatus(iStatus));
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userEmailVerification(Block.Status success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kUserId, mCurrentUser.getUserId());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserEmailVerification, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				Log.e("Email Link", "Update Successful");
				DispatchQueue.main(() -> success.iStatus(iStatus));
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFacSportUpdate(int facId, Block.Success<CopyOnWriteArrayList<FacSport>> success, Block.Failure failure) {
		HashMap<String, Object> parameters = new HashMap<>();
		parameters.put(kUserId, mCurrentUser.getUserId());
		parameters.put(kFacId, facId);
		Log.e("Send",parameters.toString());
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kFacSportsListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<FacSport> list = new CopyOnWriteArrayList<>();
					CopyOnWriteArrayList<Facility> facList = mCurrentUser.getFacilities();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					if (array.length() != 0) {
						for (int i = 0; i < array.length(); i++) {
							list.add(new FacSport((JSONObject) array.get(i)));
						}
						for (int j = 0; j < facList.size(); j++) {
							if (facList.get(j).getFacId() == facId) {
								facList.get(j).setFacSportList(list);
								break;
							}
						}
					}
					archiveCurrentUser();
					GenericResponse<CopyOnWriteArrayList<FacSport>> generic = new GenericResponse<>(list);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */

	public void userSearchList(HashMap<String, Object> parameters, Block.Success<UserFacility> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kSearchListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					UserFacility userSearchList = new UserFacility(genricResponse.getObject().getJSONObject(kResponse));
					GenericResponse<UserFacility> generic = new GenericResponse<>(userSearchList);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userFacilityAllList(HashMap<String, Object> parameters, Block.Success<UserFacility> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.uUserFacilityAll, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					UserFacility userSearchList = new UserFacility(genricResponse.getObject().getJSONObject(kResponse));
					GenericResponse<UserFacility> generic = new GenericResponse<>(userSearchList);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userEventSearchList(HashMap<String, Object> parameters, Block.Success<UserEventdata> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kSearchListing, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					UserEventdata userSearchList = new UserEventdata(genricResponse.getObject().getJSONObject(kResponse));
					GenericResponse<UserEventdata> generic = new GenericResponse<>(userSearchList);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userEventSeeAllList(HashMap<String, Object> parameters, Block.Success<EventSeeAllList> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.uUserFacilityAll, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					EventSeeAllList userSearchList = new EventSeeAllList(genricResponse.getObject().getJSONObject(kResponse));
					GenericResponse<EventSeeAllList> generic = new GenericResponse<>(userSearchList);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userDashBoard(HashMap<String, Object> parameters, Block.Success<UserDashBoard> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserDashBoard, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					UserDashBoard data = new UserDashBoard(genricResponse.getObject().getJSONObject(kResponse));
					mCurrentUser.setUserDashBoardData(data);
					archiveCurrentUser();
					GenericResponse<UserDashBoard> generic = new GenericResponse<>(data);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * method will be called when User Favourite through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void userFavourite(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<UserFacAca>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserFavourite, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<UserFacAca> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					if (array.length() != 0) {
						for (int i = 0; i < array.length(); i++) {
							list.add(new UserFacAca((JSONObject) array.get(i)));
						}
						GenericResponse<CopyOnWriteArrayList<UserFacAca>> generic = new GenericResponse<>(list);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {
						DispatchQueue.main(() -> failure.iFailure(iStatus,"Favorite Empty List" ));
					}
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	/**
	 * method will be called when facility profile through system
	 *
	 * @param success Block passed as callback for success condition
	 * @param failure Block passed as callback for failure condition
	 */
	public void calenderBooking(HashMap<String, Object> parameters, Block.Success<UserBatchSlotAvail> success, Block.Failure failure) {
		try {
			dispatchQueue.async(() ->
				ApiManager.ApiClient().processFormRequest(ApiInterface.kUserAvailableSlot, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
					try {
						UserBatchSlotAvail userBatchSlotAvail = new UserBatchSlotAvail(genricResponse.getObject().getJSONObject(kResponse));
						GenericResponse<UserBatchSlotAvail> generic = new GenericResponse<>(userBatchSlotAvail);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} catch (Exception e) {
						e.printStackTrace();
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
					}
				}, (Status statusFail, String message) -> {
					if (!ReachableManager.getNetworkStatus())
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
					else
						DispatchQueue.main(() -> failure.iFailure(statusFail, message));
				}));
		}
		catch (Exception e){
			e.printStackTrace();
		}
	}


	public void getCartList(HashMap<String, Object> parameters, Block.Success<UserAddcartList> success, Block.Failure failure) {
		try {
			dispatchQueue.async(() ->
				ApiManager.ApiClient().processFormRequest(ApiInterface.kuserCartList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
					try {
						UserAddcartList userBatchSlotAvail = new UserAddcartList(genricResponse.getObject().getJSONObject(kResponse));
						GenericResponse<UserAddcartList> generic = new GenericResponse<>(userBatchSlotAvail);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} catch (Exception e) {
						e.printStackTrace();
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
					}
				}, (Status statusFail, String message) -> {
					if (ReachableManager.getNetworkStatus())
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
					else
						DispatchQueue.main(() -> failure.iFailure(statusFail, message));
				}));
		}
		catch (Exception e){
			e.printStackTrace();
		}
	}

	public void getDeletecart(HashMap<String, Object> parameters, Block.Success<JSONObject> success, Block.Failure failure) {
		try {
			dispatchQueue.async(() ->
				ApiManager.ApiClient().processFormRequest(ApiInterface.kuserDeletecart, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
					try {
						JSONObject jsonObject=genricResponse.getObject();
						GenericResponse<JSONObject> generic = new GenericResponse<>(jsonObject);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} catch (Exception e) {
						e.printStackTrace();
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
					}
				}, (Status statusFail, String message) -> {
					if (ReachableManager.getNetworkStatus())
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
					else
						DispatchQueue.main(() -> failure.iFailure(statusFail, message));
				}));
		}
		catch (Exception e){
			e.printStackTrace();
		}
	}


	public void getCartCountre(HashMap<String, Object> parameters, Block.Success<CartCount> success, Block.Failure failure) {
		try {
			dispatchQueue.async(() ->
				ApiManager.ApiClient().processFormRequest(ApiInterface.kUserCount, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
					try {
						CartCount userBatchSlotAvail = new CartCount(genricResponse.getObject().getJSONObject(kResponse));
						GenericResponse<CartCount> generic = new GenericResponse<>(userBatchSlotAvail);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} catch (Exception e) {
						e.printStackTrace();
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
					}
				}, (Status statusFail, String message) -> {
					if (ReachableManager.getNetworkStatus())
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
					else
						DispatchQueue.main(() -> failure.iFailure(statusFail, message));
				}));
		}
		catch (Exception e){
			e.printStackTrace();
		}
	}



	public void getEventDetails(HashMap<String, Object> parameters, Block.Success<EventDetails> success, Block.Failure failure) {
		try {
			dispatchQueue.async(() ->
				ApiManager.ApiClient().processFormRequest(ApiInterface.kEventCheckOut, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
					try {
						EventDetails userBatchSlotAvail = new EventDetails(genricResponse.getObject().getJSONObject(kResponse));
						GenericResponse<EventDetails> generic = new GenericResponse<>(userBatchSlotAvail);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} catch (Exception e) {
						e.printStackTrace();
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
					}
				}, (Status statusFail, String message) -> {
					if (ReachableManager.getNetworkStatus())
						DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
					else
						DispatchQueue.main(() -> failure.iFailure(statusFail, message));
				}));
		}
		catch (Exception e){
			e.printStackTrace();
		}
	}


	/**
	 * @param parameters
	 * @param success
	 * @param failure
	 */


	public void userNotification(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<UserNotification>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserNotification, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<UserNotification> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					if (array.length() != 0) {
						for (int i = 0; i < array.length(); i++) {
							list.add(new UserNotification((JSONObject) array.get(i)));
						}
						GenericResponse<CopyOnWriteArrayList<UserNotification>> generic = new GenericResponse<>(list);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {
						DispatchQueue.main(() -> failure.iFailure(Status.fail, "User Notification Empty List"));
					}
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * @param parameters
	 * @param success
	 * @param failure
	 */
	public void userProfile(HashMap<String, Object> parameters, Block.Success<UserProfile> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserProfile, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					UserProfile data = new UserProfile(genricResponse.getObject().getJSONObject(kResponse));
					;
					GenericResponse<UserProfile> generic = new GenericResponse<>(data);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	/**
	 * @param parameters
	 * @param success
	 * @param failure
	 */
	public void userEnquire(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<UserEnquire>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserEnquireList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<UserEnquire> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					if (array.length() != 0) {
						for (int i = 0; i < array.length(); i++) {
							list.add(new UserEnquire((JSONObject) array.get(i)));
						}
						GenericResponse<CopyOnWriteArrayList<UserEnquire>> generic = new GenericResponse<>(list);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {
						DispatchQueue.main(() -> failure.iFailure(Status.fail, "Enquiries not available"));
					}
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void usergetpackage(HashMap<String, Object> parameters, Block.Success<CopyOnWriteArrayList<UserPackage>> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserPakageList, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					CopyOnWriteArrayList<UserPackage> list = new CopyOnWriteArrayList<>();
					JSONArray array = genricResponse.getObject().getJSONArray(kResponse);
					if (array.length() != 0) {
						for (int i = 0; i < array.length(); i++) {
							list.add(new UserPackage((JSONObject) array.get(i)));
						}
						GenericResponse<CopyOnWriteArrayList<UserPackage>> generic = new GenericResponse<>(list);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {
						DispatchQueue.main(() -> failure.iFailure(Status.fail, "User Package Empty List"));
					}
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userAddtocart(HashMap<String, Object> parameters, Block.Success<UserAddcartList> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserAddtocart, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					UserAddcartList userAddcartList = new UserAddcartList(genricResponse.getObject().getJSONObject(kResponse));
					GenericResponse<UserAddcartList> generic = new GenericResponse<>(userAddcartList);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userCartDelete(HashMap<String, Object> parameters,Block.Status success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserDeleteCart, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				Log.e("Email Link", "Update Successful");
				DispatchQueue.main(() -> success.iStatus(iStatus));
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userFav(HashMap<String, Object> parameters, Block.Success<FavModelChecked> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kuserAddfav, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					//String msg = genricResponse.getObject().getString(kResponse);

					FavModelChecked favModelChecked=new FavModelChecked(genricResponse.getObject());


					//String mes_res = genricResponse.getObject().getString(kResponseMessage);
					GenericResponse<FavModelChecked> generic = new GenericResponse<>(favModelChecked);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					/*if (msg.equals("1")) {

					} else {

					}*/

				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));

	}



	public void userFListDelete(HashMap<String, Object> parameters,Block.Status success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserFavouriteListDelete, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				Log.e("Email Link", "Update Successful");
				DispatchQueue.main(() -> success.iStatus(iStatus));
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userFItemDelete(HashMap<String, Object> parameters,Block.Status success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserFavouriteDelete, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				Log.e("Email Link", "Update Successful");
				DispatchQueue.main(() -> success.iStatus(iStatus));
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userUnfav(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserDeactivateFav, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponse);


					if (msg.equals("1")) {
						String mes_res = genricResponse.getObject().getString(kResponseMessage);
						GenericResponse<String> generic = new GenericResponse<>(mes_res);
						DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
					} else {

					}

				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userBooking(HashMap<String, Object> parameters, Block.Success<BookingStatusResponse> success, Block.Failure failure) {
		dispatchQueue.async(() -> {
			ApiManager.ApiClient().processFormRequest(ApiInterface.kuserBooking, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString("response_messege");
					String orderId = genricResponse.getObject().getString("order_id");

					BookingStatusResponse bookingStatusResponse = new BookingStatusResponse(msg, orderId);
					GenericResponse<BookingStatusResponse> generic = new GenericResponse<>(bookingStatusResponse);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			});
		});
	}


	public void userBookingEventCancel(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserEventCancel, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponseMessage);
					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userBookingBatchSlotCancel(HashMap<String, Object> parameters, Block.Success<String> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kuserBatchSlotCancel, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					String msg = genricResponse.getObject().getString(kResponseMessage);
					GenericResponse<String> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}

	public void userApplyCoupan(HashMap<String, Object> parameters, Block.Success<JSONObject> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kUserApplyCoupan, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					JSONObject msg = genricResponse.getObject().getJSONObject(kResponse);
					GenericResponse<JSONObject> generic = new GenericResponse<>(msg);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				Log.e("Forgot Password", message);
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userEventBookingListt(HashMap<String, Object> parameters, Block.Success<UserEventBooked> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kuserbookinglist, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					UserEventBooked data = new UserEventBooked(genricResponse.getObject().getJSONObject(kResponse));

					GenericResponse<UserEventBooked> generic = new GenericResponse<>(data);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}


	public void userFacilityBookingListtt(HashMap<String, Object> parameters, Block.Success<UserFacilityAcademyBooked> success, Block.Failure failure) {
		dispatchQueue.async(() ->
			ApiManager.ApiClient().processFormRequest(ApiInterface.kuserfacilityBooking, parameters, (Status iStatus, GenericResponse<JSONObject> genricResponse) -> {
				try {
					UserFacilityAcademyBooked data = new UserFacilityAcademyBooked(genricResponse.getObject().getJSONObject(kResponse));

					GenericResponse<UserFacilityAcademyBooked> generic = new GenericResponse<>(data);
					DispatchQueue.main(() -> success.iSuccess(iStatus, generic));
				} catch (Exception e) {
					e.printStackTrace();
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageInternalInconsistency));
				}
			}, (Status statusFail, String message) -> {
				if (ReachableManager.getNetworkStatus())
					DispatchQueue.main(() -> failure.iFailure(Status.fail, kMessageNetworkError));
				else
					DispatchQueue.main(() -> failure.iFailure(statusFail, message));
			}));
	}





}
