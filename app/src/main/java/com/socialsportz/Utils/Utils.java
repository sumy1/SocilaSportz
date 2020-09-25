package com.socialsportz.Utils;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.res.Resources;
import android.graphics.Bitmap;
import android.graphics.Canvas;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.os.Build;
import android.text.TextUtils;
import android.util.Base64;
import android.util.Log;
import android.util.TypedValue;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.TextView;

import com.socialsportz.Constants.Constants;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.Models.Owner.Amenity;
import com.socialsportz.Models.Owner.BatchPackage;
import com.socialsportz.Models.Owner.BatchSlot;
import com.socialsportz.Models.Owner.BatchSlotAvail;
import com.socialsportz.Models.Owner.BatchSlotPrice;
import com.socialsportz.Models.Owner.BatchSlotWeekOff;
import com.socialsportz.Models.Owner.BookingType;
import com.socialsportz.Models.Owner.Bookings;
import com.socialsportz.Models.Owner.Enquires;
import com.socialsportz.Models.Owner.EventGallery;
import com.socialsportz.Models.Owner.Events;
import com.socialsportz.Models.Owner.FacDayTime;
import com.socialsportz.Models.Owner.FacGallery;
import com.socialsportz.Models.Owner.Facility;
import com.socialsportz.Models.Owner.PaymentType;
import com.socialsportz.Models.Owner.SlotBookingDetails;
import com.socialsportz.Models.User.MasterSports;
import com.socialsportz.Models.User.UserBatchSlotAvailList;
import com.socialsportz.Models.User.UserEvent;
import com.socialsportz.Models.User.UserFacAca;
import com.socialsportz.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.InputStream;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.concurrent.CopyOnWriteArrayList;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import androidx.annotation.Nullable;
import androidx.annotation.StringRes;

import static com.socialsportz.Constants.Constants.kActualPrice;
import static com.socialsportz.Constants.Constants.kAmenityId;
import static com.socialsportz.Constants.Constants.kBatchSlotId;
import static com.socialsportz.Constants.Constants.kBatchSlotTypeName;
import static com.socialsportz.Constants.Constants.kCourtDesc;
import static com.socialsportz.Constants.Constants.kCourtType;
import static com.socialsportz.Constants.Constants.kData;
import static com.socialsportz.Constants.Constants.kDate;
import static com.socialsportz.Constants.Constants.kEndTime;
import static com.socialsportz.Constants.Constants.kFacCloseTime;
import static com.socialsportz.Constants.Constants.kFacDayName;
import static com.socialsportz.Constants.Constants.kFacDayStatus;
import static com.socialsportz.Constants.Constants.kFacId;
import static com.socialsportz.Constants.Constants.kFacOpenTime;
import static com.socialsportz.Constants.Constants.kFacTimingId;
import static com.socialsportz.Constants.Constants.kIsKit;
import static com.socialsportz.Constants.Constants.kIsTrial;
import static com.socialsportz.Constants.Constants.kKitPrice;
import static com.socialsportz.Constants.Constants.kMaxParticipants;
import static com.socialsportz.Constants.Constants.kPackageId;
import static com.socialsportz.Constants.Constants.kPriceId;
import static com.socialsportz.Constants.Constants.kPriceNo;
import static com.socialsportz.Constants.Constants.kSportId;
import static com.socialsportz.Constants.Constants.kStartDate;
import static com.socialsportz.Constants.Constants.kStartTime;
import static com.socialsportz.Constants.Constants.kTypeId;
import static com.socialsportz.Constants.Constants.kWeekOffDay;
import static com.socialsportz.Constants.Constants.kWeekOffId;
import static com.socialsportz.Constants.Constants.kWeekOffStatus;

public class Utils {

    private static final String TAG = Utils.class.getSimpleName();

    static ProgressDialog mProgressDialog;
    static String facid;

	public static final String downloadDirectory = "Androhub Downloads";
	public static final String mainUrl = "http://androhub.com/demo/";

    /**
     * Checks if the input parameter is a valid email.
     *
     * @param email
     * @return
     */
    public static boolean isValidEmail(String email) {
        if (email == null) {
            return false;
        }
        final String emailPattern = "^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
        Matcher matcher;
        Pattern pattern = Pattern.compile(emailPattern);

        matcher = pattern.matcher(email);

        return matcher.matches();
    }

    /**
     * Generate top layer progress indicator.
     * @param context    activity context
     * @param cancelable can be progress layer canceled
     * @return dialog
     */
    public static ProgressDialog generateProgressDialog(Context context, boolean cancelable) {
        ProgressDialog progressDialog =null ;
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP)
            progressDialog = new ProgressDialog(context, R.style.ProgressTheme);
        else
            progressDialog = new ProgressDialog(context, R.style.AlertDialog_Holo);
        progressDialog.setMessage("Loading..");
        progressDialog.setCancelable(false);
        return progressDialog;
    }

    /**
     * Hides the already popped up keyboard from the screen.
     *
     * @param context
     */
    public static void hideKeyboard(Context context) {
        try {
            InputMethodManager inputManager = (InputMethodManager) context.getSystemService(Context.INPUT_METHOD_SERVICE);
            inputManager.hideSoftInputFromWindow(((Activity) context).getCurrentFocus().getWindowToken(), 0);
        } catch (Exception e) {
            Log.e(TAG, "Sigh, cant even hide keyboard " + e.getMessage());
        }
    }

    /**
     * Force the keyboard for the view.
     * @param context
     */
    public static void showKeyboard(Context context,View view) {
        try {
            InputMethodManager inputManager = (InputMethodManager) context.getSystemService(Context.INPUT_METHOD_SERVICE);
            inputManager.showSoftInput(view,InputMethodManager.SHOW_FORCED);
        } catch (Exception e) {
            Log.e(TAG, "Sigh, cant show keyboard " + e.getMessage());
        }
    }

    /**
     *
     * @param textView = textview / editext from which value to be extracted
     * @return proper String value
     */
    public static String getProperText(TextView textView){
        return textView.getText().toString().trim();
    }

    @Nullable
    /**
     * Partially capitalizes the string from paramter start and offset.
     *
     * @param string String to be formatted
     * @param start  Starting position of the substring to be capitalized
     * @param offset Offset of characters to be capitalized
     * @return
     */
    public static String capitalizeString(String string, int start, int offset) {
        if (TextUtils.isEmpty(string)) {
            return null;
        }
        return string.substring(start, offset).toUpperCase() + string.substring(offset);
    }

    public static String  getFirstLetterInUpperCase(String str) {
        if(str.isEmpty())
            return str;
        return str.substring(0,1).toUpperCase() + str.substring(1);
    }



    public static String getTimeStampDate(long timeStamp){
        try{
            DateFormat sdf = new SimpleDateFormat("yyyy-MM-dd hh:mm:ss");
            Date netDate = (new Date(timeStamp));
            return sdf.format(netDate);
        }
        catch(Exception ex){
            return "xx";
        }
    }

    public static String getDate(long timeStamp){
        try{
            DateFormat sdf = new SimpleDateFormat("dd MMM yyyy");
            Date netDate = (new Date(timeStamp));
            return sdf.format(netDate);
        }
        catch(Exception ex){
            return "xx";
        }
    }

    public static String changeDateData(String date){

        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-d");
        Date sourceDate = null;
        try {
            sourceDate = dateFormat.parse(date);
        } catch (ParseException e) {
            e.printStackTrace();
        }

        SimpleDateFormat targetFormat = new SimpleDateFormat("yyyy-MM-dd");
        assert sourceDate != null;
        return targetFormat.format(sourceDate);
    }

    public static String changeDateFormat(String date){

        SimpleDateFormat dateFormat = new SimpleDateFormat("dd MMM yyyy");
        Date sourceDate = null;
        try {
            sourceDate = dateFormat.parse(date);
        } catch (ParseException e) {
            e.printStackTrace();
        }

        SimpleDateFormat targetFormat = new SimpleDateFormat("yyyy-MM-dd");
        assert sourceDate != null;
        return targetFormat.format(sourceDate);
    }

    public static String changeDateNew(String date){

        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        Date sourceDate = null;
        try {
            sourceDate = dateFormat.parse(date);
        } catch (ParseException e) {
            e.printStackTrace();
        }

        SimpleDateFormat targetFormat = new SimpleDateFormat("dd MMM yyyy");
        assert sourceDate != null;
        return targetFormat.format(sourceDate);
    }

    public static String changeDateTimeFormat(String date){
        if(!date.isEmpty()){
            SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd hh:mm:ss");
            Date sourceDate = null;
            try {
                sourceDate = dateFormat.parse(date);
            } catch (ParseException e) {
                e.printStackTrace();
            }

            SimpleDateFormat targetFormat = new SimpleDateFormat("dd MMM yyyy");
            assert sourceDate != null;
            return targetFormat.format(sourceDate);
        }else
            return "";
    }

    public static String getFurtherDate(String input){
        String time ;
        SimpleDateFormat sdf = new SimpleDateFormat("dd MMM yyyy");
        SimpleDateFormat sd = new SimpleDateFormat("yyyy-MM-dd");
        Date date = null;
        try {
            date = sdf.parse(input);
        } catch (ParseException e) {
            e.printStackTrace();
        }
        Calendar calendar = Calendar.getInstance();
        calendar.setTime(date);
        calendar.add(Calendar.DAY_OF_YEAR, +7);
        Date newDate = calendar.getTime();

        time = sd.format(newDate);
        return time;
    }

    public static String getDate(Calendar calendar){
        String myFormat = "dd MMM yyyy"; //In which you need put here
        SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.UK);
        return sdf.format(calendar.getTime());
    }

    public static Date getDate(String input){
        SimpleDateFormat sdf = new SimpleDateFormat("dd MMM yyyy", Locale.UK);
        //SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd",Locale.UK);
        Date date = null;
        try {
            date = sdf.parse(input);
        } catch (ParseException e) {
            e.printStackTrace();
        }
        return date;
    }

    public static String getTimeStampTime(long timeStamp){
        try{
            DateFormat sdf = new SimpleDateFormat("hh:mm", Locale.UK);
            Date netDate = (new Date(timeStamp));
            return sdf.format(netDate);
        }
        catch(Exception ex){
            return "xx";
        }
    }

    public static Calendar getTime(Calendar c,String sTime){
        SimpleDateFormat sdf = new SimpleDateFormat("hh:mm a",Locale.ENGLISH);
        Date date = null;
        try {
            date = sdf.parse(sTime);
			assert date != null;
			c.setTime(date);
        } catch (ParseException e) {
            e.printStackTrace();
        }

        return c;
    }

    public static String scheduleTimeStamp(String str_date){
        DateFormat formatter = new SimpleDateFormat("MMM, dd, yyyy hh:mm", Locale.UK);
        Date date;
        String timeStamp="";
        try {
            date = formatter.parse(str_date);
            timeStamp = String.valueOf(date.getTime());
        } catch (ParseException e) {
            e.printStackTrace();
        }
        return timeStamp;
    }

    public static Date scheduleDate(String str_date){
        DateFormat formatter = new SimpleDateFormat("MMM, dd, yyyy hh:mm", Locale.UK);
        Date date = null;
        try {
            date = formatter.parse(str_date);
        } catch (ParseException e) {
            e.printStackTrace();
        }
        return date;
    }


    public static boolean getDateCompare(String stDate,String edDate){
        boolean status = true;
        SimpleDateFormat sdf = new SimpleDateFormat("dd MMM yyyy");
        Date strDate = null,edrDate = null;
        try {
            strDate = sdf.parse(stDate);
            edrDate = sdf.parse(edDate);
        } catch (ParseException e) {
            e.printStackTrace();
        }

        if (strDate.getTime() > edrDate.getTime())
            status=false;

        return status;
    }


	public static boolean getDateComparee(String stDate,String edDate){
		boolean status = true;
		SimpleDateFormat sdf = new SimpleDateFormat("dd MMM yyyy");
		Date strDate = null,edrDate = null;
		try {
			strDate = sdf.parse(stDate);
			edrDate = sdf.parse(edDate);
		} catch (ParseException e) {
			e.printStackTrace();
		}

		if (strDate.getTime() > edrDate.getTime())
			status=false;

		return status;
	}



    public static long getMinDate(){
        long minDate;
        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd",Locale.UK);
        Date date = null;
        try {
            date = sdf.parse("2018-08-28");
        } catch (ParseException e) {
            e.printStackTrace();
        }
        Calendar myCalendar = Calendar.getInstance();
        assert date != null;
        myCalendar.setTime(date);

        minDate = myCalendar.getTimeInMillis();
        return minDate;
    }


    /**
     * Converting dp to pixel
     */
    public static int dpToPx(Context context,int dp) {
        Resources r = context.getResources();
        return Math.round(TypedValue.applyDimension(TypedValue.COMPLEX_UNIT_DIP, dp, r.getDisplayMetrics()));
    }



    /**
     * Shows an alert dialog with the OK button. When the user presses OK button, the dialog
     * dismisses.
     **/
    public static void showAlertDialog(Context context, @StringRes int titleResId, @StringRes int bodyResId) {
        showAlertDialog(context, context.getString(titleResId),
                context.getString(bodyResId), null);
    }

    /**
     * Shows an alert dialog with the OK button. When the user presses OK button, the dialog
     * dismisses.
     **/
    public static void showAlertDialog(Context context, String title, String body) {
        showAlertDialog(context, title, body, null);
    }

    /**
     * Shows an alert dialog with OK button
     **/
    public static void showAlertDialog(Context context, String title, String body, DialogInterface.OnClickListener okListener) {

        if (okListener == null) {
            okListener = (dialog, which) -> dialog.cancel();
        }

        AlertDialog.Builder builder = new AlertDialog.Builder(context)
                .setMessage(body).setPositiveButton("OK", okListener);

        if (!TextUtils.isEmpty(title)) {
            builder.setTitle(title);
        }

        builder.show();
    }

    /**
     * Serializes the Bitmap to Base64
     *
     * @return Base64 string value of a {@linkplain Bitmap} passed in as a parameter
     * @throws NullPointerException If the parameter bitmap is null.
     **/
    public static String toBase64(Bitmap bitmap) {

        if (bitmap == null) {
            throw new NullPointerException("Bitmap cannot be null");
        }

        String base64Bitmap = null;
        ByteArrayOutputStream stream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG, 100, stream);
        byte[] imageBitmap = stream.toByteArray();
        base64Bitmap = Base64.encodeToString(imageBitmap, Base64.DEFAULT);

        return base64Bitmap;
    }

    /**
     * Converts the passed in drawable to Bitmap representation
     *
     * @throws NullPointerException If the parameter drawable is null.
     **/
    public static Bitmap drawableToBitmap(Drawable drawable) {

        if (drawable == null) {
            throw new NullPointerException("Drawable to convert should NOT be null");
        }

        if (drawable instanceof BitmapDrawable) {
            return ((BitmapDrawable) drawable).getBitmap();
        }

        if (drawable.getIntrinsicWidth() <= 0 && drawable.getIntrinsicHeight() <= 0) {
            return null;
        }

        Bitmap bitmap = Bitmap.createBitmap(drawable.getIntrinsicWidth(), drawable.getIntrinsicHeight(), Bitmap.Config.ARGB_8888);
        Canvas canvas = new Canvas(bitmap);
        drawable.setBounds(0, 0, canvas.getWidth(), canvas.getHeight());
        drawable.draw(canvas);

        return bitmap;
    }

    /**
     * Converts the given bitmap to {@linkplain InputStream}.
     *
     * @throws NullPointerException If the parameter bitmap is null.
     **/
    public static InputStream bitmapToInputStream(Bitmap bitmap) throws NullPointerException {

        if (bitmap == null) {
            throw new NullPointerException("Bitmap cannot be null");
        }

        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG, 100, baos);
        InputStream inputstream = new ByteArrayInputStream(baos.toByteArray());

        return inputstream;
    }

    public static int getPixelFromDips(float pixels,Context context) {
        // Get the screen's density scale
        final float scale = context.getResources().getDisplayMetrics().density;
        // Convert the dps to pixels, based on density scale
        return (int) (pixels * scale + 0.2f);
    }

    /**
     * Shows a progress dialog with a spinning animation in it. This method must preferably called
     * from a UI thread.
     *
     * @param ctx           Activity context
     * @param title         Title of the progress dialog
     * @param body          Body/Message to be shown in the progress dialog
     * @param isCancellable True if the dialog can be cancelled on back button press, false otherwise
     **/
    public static void showProgressDialog(Context ctx, String title, String body, boolean isCancellable) {
        showProgressDialog(ctx, title, body, null, isCancellable);
    }

    /**
     * Shows a progress dialog with a spinning animation in it. This method must preferably called
     * from a UI thread.
     *
     * @param ctx           Activity context
     * @param title         Title of the progress dialog
     * @param body          Body/Message to be shown in the progress dialog
     * @param icon          Icon to show in the progress dialog. It can be null.
     * @param isCancellable True if the dialog can be cancelled on back button press, false otherwise
     **/
    public static void showProgressDialog(Context ctx, String title, String body, Drawable icon, boolean isCancellable) {

        if (ctx instanceof Activity) {
            if (!((Activity) ctx).isFinishing()) {
                mProgressDialog = ProgressDialog.show(ctx, title, body, true);
                mProgressDialog.setIcon(icon);
                mProgressDialog.setCancelable(isCancellable);
            }
        }
    }

    /**
     * Check if the {@link ProgressDialog} is visible in the UI.
     **/
    public static boolean isProgressDialogVisible() {
        return (mProgressDialog != null);
    }

    /**
     * Dismiss the progress dialog if it is visible.
     **/
    public static void dismissProgressDialog() {
        if (mProgressDialog != null) {
            mProgressDialog.dismiss();
        }

        mProgressDialog = null;
    }

    /**
     * Gives the device independent constant which can be used for scaling images, manipulating view
     * sizes and changing dimension and display pixels etc.
     **/
    public static float getDensityMultiplier(Context context) {
        return context.getResources().getDisplayMetrics().density;
    }

    /**
     * This method converts device specific pixels to density independent pixels.
     *
     * @param px      A value in px (pixels) unit. Which we need to convert into db
     * @param context Context to get resources and device specific display metrics
     * @return A int value to represent dp equivalent to px value
     */
    public static int getDip(int px, Context context) {
        final float scale = context.getResources().getDisplayMetrics().density;
        return (int) (px * scale + 0.5f);
    }

    /**
     * Creates a confirmation dialog with Yes-No Button. By default the buttons just dismiss the
     * dialog.
     *
     * @param ctx
     * @param message     Message to be shown in the dialog.
     * @param yesListener Yes click handler
     * @param noListener
     **/
    public static void showConfirmDialog(Context ctx, String message, DialogInterface.OnClickListener yesListener, DialogInterface.OnClickListener noListener) {
        showConfirmDialog(ctx, message, yesListener, noListener, "Yes", "No");
    }

    /**
     * Creates a confirmation dialog with Yes-No Button. By default the buttons just dismiss the
     * dialog.
     *
     * @param ctx
     * @param message     Message to be shown in the dialog.
     * @param yesListener Yes click handler
     * @param noListener
     * @param yesLabel    Label for yes button
     * @param noLabel     Label for no button
     **/
    public static void showConfirmDialog(Context ctx, String message, DialogInterface.OnClickListener yesListener, DialogInterface.OnClickListener noListener, String yesLabel, String noLabel) {

        AlertDialog.Builder builder = new AlertDialog.Builder(ctx);

        if (yesListener == null) {
            yesListener = (dialog, which) -> dialog.dismiss();
        }

        if (noListener == null) {
            noListener = (dialog, which) -> dialog.dismiss();
        }

        builder.setMessage(message).setPositiveButton(yesLabel, yesListener).setNegativeButton(noLabel, noListener).show();
    }

    public static String md5(String s) {
        /*try {
            // Create MD5 Hash
            MessageDigest digest = java.security.MessageDigest.getInstance("MD5");
            digest.update(s.getBytes());
            byte[] messageDigest = digest.digest();

            // Create Hex String
            StringBuilder hexString = new StringBuilder();
            for (byte b : messageDigest) hexString.append(Integer.toHexString(0xFF & b));

            return hexString.toString();
        }catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }
        return "";*/

        final String MD5 = "MD5";
        try {
            // Create MD5 Hash
            MessageDigest digest = MessageDigest
                    .getInstance(MD5);
            digest.update(s.getBytes());
            byte messageDigest[] = digest.digest();

            // Create Hex String
            StringBuilder hexString = new StringBuilder();
            for (byte aMessageDigest : messageDigest) {
                String h = Integer.toHexString(0xFF & aMessageDigest);
                while (h.length() < 2)
                    h = "0" + h;
                hexString.append(h);
            }
            return hexString.toString();
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }
        return "";
    }

    /**
     * Creates a confirmation dialog that show a pop-up with button labeled as parameters labels.
     *
     * @param ctx                 {@link Activity} {@link Context}
     * @param message             Message to be shown in the dialog.
     * @param dialogClickListener
     * @param positiveBtnLabel    For e.g. "Yes"
     * @param negativeBtnLabel    For e.g. "No"
     **/
    public static void showDialog(Context ctx, String message, String positiveBtnLabel, String negativeBtnLabel, DialogInterface.OnClickListener dialogClickListener) {

        if (dialogClickListener == null) {
            throw new NullPointerException("Action listener cannot be null");
        }

        AlertDialog.Builder builder = new AlertDialog.Builder(ctx);

        builder.setMessage(message).setPositiveButton(positiveBtnLabel, dialogClickListener).setNegativeButton(negativeBtnLabel, dialogClickListener).show();
    }


    public static JSONArray generateJsonArrayAmenities(List<Amenity> typeList) {
        JSONArray list = new JSONArray();
        for(Amenity type:typeList){
            try {
                JSONObject obj = new JSONObject();
                obj.put(kAmenityId, String.valueOf(type.getAmenityId()));
                list.put(obj);
            } catch (JSONException e1) {
                e1.printStackTrace();
            }
        }
        return list;
    }

    public static JSONArray generateJsonArraySports(List<MasterSports> typeList) {
        JSONArray list = new JSONArray();
        for(MasterSports type:typeList){
            try {
                JSONObject obj = new JSONObject();
                obj.put(kSportId, String.valueOf(type.getSportId()));
                list.put(obj);
            } catch (JSONException e1) {
                e1.printStackTrace();
            }
        }
        return list;
    }

    public static ArrayList<String> getTabTitles(){
        ArrayList<String> list = new ArrayList<>();
        list.add("Profile Summary");
        list.add("Facility/Academy Details");
        list.add("Sports Amenities Details");
        list.add("Opening & Closing Time");
        list.add("Facility/Academy Gallery");
        list.add("Bank Details");
        return list;
    }

    public static ArrayList<String> getUserTabTitles(){
        ArrayList<String> list = new ArrayList<>();
        list.add("Slot/Batch Bookings");
        list.add("Events Bookings");
        return list;
    }


	public static ArrayList<String> getBookingTitles(){
		ArrayList<String> list = new ArrayList<>();
		list.add("My Bookings");
		list.add("All Bookings");
		return list;
	}


	public static ArrayList<String> getEventBookingTitles(){
		ArrayList<String> list = new ArrayList<>();
		list.add("My Events");
		list.add("Event Bookings");
		return list;
	}

    public static CopyOnWriteArrayList<Amenity> getAmenities(){
        CopyOnWriteArrayList<Amenity> amenities = new CopyOnWriteArrayList<>();
        amenities.add(new Amenity(1,"Beverages"));
        amenities.add(new Amenity(2,"Dressing Rooms"));
        amenities.add(new Amenity(3,"First Aid Kit"));
        amenities.add(new Amenity(4,"Flood Lights"));
        amenities.add(new Amenity(5,"Lockers"));
        amenities.add(new Amenity(6,"Parking"));
        amenities.add(new Amenity(7,"Power Backup"));
        amenities.add(new Amenity(8,"Restrooms"));
        amenities.add(new Amenity(9,"Showers"));
        amenities.add(new Amenity(10,"Flood Lights"));
        return amenities;
    }

    public static CopyOnWriteArrayList<FacDayTime> getTimings(Context context){
        CopyOnWriteArrayList<FacDayTime> list = new CopyOnWriteArrayList<>();
        list.add(new FacDayTime(0,"Mon",0,context.getString(R.string.day_time_open),context.getString(R.string.day_time_close)));
        list.add(new FacDayTime(0,"Tue",0,context.getString(R.string.day_time_open),context.getString(R.string.day_time_close)));
        list.add(new FacDayTime(0,"Wed",0,context.getString(R.string.day_time_open),context.getString(R.string.day_time_close)));
        list.add(new FacDayTime(0,"Thu",0,context.getString(R.string.day_time_open),context.getString(R.string.day_time_close)));
        list.add(new FacDayTime(0,"Fri",0,context.getString(R.string.day_time_open),context.getString(R.string.day_time_close)));
        list.add(new FacDayTime(0,"Sat",0,context.getString(R.string.day_time_open),context.getString(R.string.day_time_close)));
        list.add(new FacDayTime(0,"Sun",0,context.getString(R.string.day_time_open),context.getString(R.string.day_time_close)));
        return list;
    }

	public static CopyOnWriteArrayList<BatchSlotWeekOff> getWeekOffs(){
		int facId = ModelManager.modelManager().getCurrentUser().getSelectedFacId();
		CopyOnWriteArrayList<Facility> facList = ModelManager.modelManager().getCurrentUser().getFacilities();
		CopyOnWriteArrayList<FacDayTime> dayList = new CopyOnWriteArrayList<>();
		for(int i=0;i<facList.size();i++){
			if(facList.get(i).getFacId()==facId){
				dayList = facList.get(i).getFacTimingList();
                /*CopyOnWriteArrayList<FacDayTime> times = facList.get(i).getFacTimingList();
                for(int j=0;j<times.size();j++){
                    if(times.get(i).getDayStatus()==1){
                        dayList.add(times.get(i));
                    }
                }*/
				break;
			}
		}

		CopyOnWriteArrayList<BatchSlotWeekOff> list = new CopyOnWriteArrayList<>();
		for(int j=0;j<dayList.size();j++){
			switch (dayList.get(j).getDayName()){
				case "Mon" : list.add(new BatchSlotWeekOff(0,"Mon",dayList.get(j).getDayStatus())); break;
				case "Tue" : list.add(new BatchSlotWeekOff(0,"Tue",dayList.get(j).getDayStatus())); break;
				case "Wed" : list.add(new BatchSlotWeekOff(0,"Wed",dayList.get(j).getDayStatus())); break;
				case "Thu" : list.add(new BatchSlotWeekOff(0,"Thu",dayList.get(j).getDayStatus())); break;
				case "Fri" : list.add(new BatchSlotWeekOff(0,"Fri",dayList.get(j).getDayStatus())); break;
				case "Sat" : list.add(new BatchSlotWeekOff(0,"Sat",dayList.get(j).getDayStatus())); break;
				case "Sun" : list.add(new BatchSlotWeekOff(0,"Sun",dayList.get(j).getDayStatus())); break;
			}
		}
		return list;
	}

    public static JSONArray generateJsonArrayTimings(CopyOnWriteArrayList<FacDayTime> typeList) {
        JSONArray list = new JSONArray();
        for(FacDayTime type: typeList){
            try {
                if(type.getDayStatus()==1){
                    JSONObject obj = new JSONObject();
                    if(type.getDayId()!=0)
                        obj.put(kFacTimingId, String.valueOf(type.getDayId()));
                    obj.put(kFacDayName, type.getDayName());
                    obj.put(kFacOpenTime,type.getDayOpenTime());
                    obj.put(kFacCloseTime,type.getDayCloseTime());
                    obj.put(kFacDayStatus,String.valueOf(type.getDayStatus()));
                    list.put(obj);
                }
            } catch (JSONException e1) {
                e1.printStackTrace();
            }
        }
        return list;
    }

	public static JSONArray generateJsonArrayTimingss() {
		JSONArray list = new JSONArray();
		JSONObject obj = new JSONObject();
		try {
			obj.put(kFacDayName, "Thu");
			obj.put(kFacOpenTime,"7:00 AM");
			obj.put(kFacCloseTime,"9:00 PM");
			obj.put(kFacDayStatus,"1");
			list.put(obj);
		} catch (JSONException e) {
			e.printStackTrace();
		}



		return list;
	}

    public static CopyOnWriteArrayList<FacGallery> getFacGallery(){
        CopyOnWriteArrayList<FacGallery> galleries = new CopyOnWriteArrayList<>();
        galleries.add(new FacGallery(21,"","", Constants.GalleryStatus.active.toString()));
        galleries.add(new FacGallery(21,"","", Constants.GalleryStatus.active.toString()));
        galleries.add(new FacGallery(21,"","", Constants.GalleryStatus.active.toString()));
        galleries.add(new FacGallery(21,"","", Constants.GalleryStatus.active.toString()));
        galleries.add(new FacGallery(21,"","", Constants.GalleryStatus.active.toString()));
        return galleries;
    }

    public static JSONArray generateJsonArrayWeekOffs(CopyOnWriteArrayList<BatchSlotWeekOff> typeList) {
        JSONArray list = new JSONArray();
        for(BatchSlotWeekOff type: typeList){
            try {
                JSONObject obj = new JSONObject();
                if(type.getWeekOffStatus()==1){
                    if(type.getWeekOffTypeId()!=0){
                        obj.put(kWeekOffId, String.valueOf(type.getWeekOffTypeId()));
                        obj.put(kBatchSlotId, String.valueOf(type.getBatchSlotId()));
                    }
                    obj.put(kWeekOffDay, type.getWeekOffDay());
                    obj.put(kWeekOffStatus,String.valueOf(type.getWeekOffStatus()));
                }
                list.put(obj);
            } catch (JSONException e1) {
                e1.printStackTrace();
            }
        }
        return list;
    }

    public static JSONArray generateJsonArrayPrices(CopyOnWriteArrayList<BatchSlotPrice> typeList) {
        JSONArray list = new JSONArray();
        for(BatchSlotPrice type: typeList){
            try {
                JSONObject obj = new JSONObject();
                if(type.getPriceId()!=0){
                    obj.put(kPriceId, String.valueOf(type.getPriceId()));
                    obj.put(kBatchSlotId, String.valueOf(type.getBatchSlotId()));
                }
                obj.put(kPackageId, String.valueOf(type.getPackageId()));
                obj.put(kPriceNo,type.getPrice());
                list.put(obj);
            } catch (JSONException e1) {
                e1.printStackTrace();
            }
        }
        return list;
    }

    public static HashMap<String,Object> generateMapGalleries(CopyOnWriteArrayList<EventGallery> typeList,Context context) {
        HashMap<String,Object > map = new HashMap<>();
        for(int i=0;i<typeList.size();i++){
            map.put("image_"+i, new File(typeList.get(i).getGalleryImg()));
        }
        return map;
    }

    public static JSONArray generateJsonArrayDeleteArray(CopyOnWriteArrayList<EventGallery> typeList) {
        JSONArray list = new JSONArray();
        for(EventGallery type: typeList){
            list.put(type.getGalleryImg());
        }
        return list;
    }

    public static CopyOnWriteArrayList<Events> getEventsList(){
        CopyOnWriteArrayList<Events> event_item=new CopyOnWriteArrayList<>();
        event_item.add(new Events(1,"Nehru Park Half Marathon","JLN Stadium, Noida","500","30 Jul 2019", "2 Aug 2019",
                "9 am ", "12 am","255","200"));
        event_item.add(new Events(1,"3 Way Cycling UserEvent","Noida Stadium, Noida","500","30 Jul 2019", "2 Aug 2019",
                "9 am ", "12 am","100","65"));
        event_item.add(new Events(1,"Base Cricket UserEvent","Noida Stadium, Noida","500","30 Jul 2019", "2 Aug 2019",
                "9 am ", "12 am","150","120"));
        return  event_item;
    }

    public static CopyOnWriteArrayList<Enquires> getEnquiries(){
        CopyOnWriteArrayList<Enquires> enq_item = new CopyOnWriteArrayList<>();
        enq_item.add(new Enquires(1,"Kavita","8292090011","shreebindia1202@gmail.com",
                "xyz","30 July,2019"));
        enq_item.add(new Enquires(1,"Kavita","8292090011","shreebindia1202@gmail.com",
                "xyz","30 July,2019"));
        enq_item.add(new Enquires(1,"Kavita","8292090011","shreebindia1202@gmail.com",
                "xyz","30 July,2019"));
        return enq_item;
    }

    public static CopyOnWriteArrayList<BatchSlot>  getBatchSlotList(){
        CopyOnWriteArrayList<BatchSlot> slot_item = new CopyOnWriteArrayList<>();
        slot_item.add(new BatchSlot(1,6,"9 am","11 am",
                "Normal","10","500",
                Constants.BatchSlotEnum.slot.toString(), getBatchPriceList(), Constants.DefaultStatus.yes.toString()));
        slot_item.add(new BatchSlot(1,6,"9 am","11 am",
                "Normal","12","500",
                Constants.BatchSlotEnum.slot.toString(), getBatchPriceList(), Constants.DefaultStatus.no.toString()));
        slot_item.add(new BatchSlot(1,6,"9 am","11 am",
                "Normal","5","500",
                Constants.BatchSlotEnum.slot.toString(), getBatchPriceList(), Constants.DefaultStatus.yes.toString()));
        slot_item.add(new BatchSlot(1,6,"9 am","11 am",
                "Normal","8","500",
                Constants.BatchSlotEnum.slot.toString(), getBatchPriceList(), Constants.DefaultStatus.no.toString()));
        slot_item.add(new BatchSlot(1,6,"9 am","11 am",
                "Normal","","500",
                Constants.BatchSlotEnum.slot.toString(), getBatchPriceList(), Constants.DefaultStatus.yes.toString()));
        return slot_item;
    }

    public static CopyOnWriteArrayList<Bookings> getBookingList(){
        CopyOnWriteArrayList<Bookings> bookings_item = new CopyOnWriteArrayList<>();
        bookings_item.add(new Bookings(1,"SSZ1000001570627907","Uphar","upharshivam@gmail.com","8292090012",
                "0","online", Utils.getBookingDetails()));
        bookings_item.add(new Bookings(1,"SSZ1000001570627908","Kavita","shreebindiya1202@gmail.com","8292090011",
                "1","offline", Utils.getBookingDetails()));
        //bookingAdapter.addData(bookings_item);
        return bookings_item;
    }


    public static CopyOnWriteArrayList<SlotBookingDetails> getBookingDetails(){
        CopyOnWriteArrayList<SlotBookingDetails> listRow = new CopyOnWriteArrayList<>();
        listRow.add(new SlotBookingDetails(1,"Football","01 Nov 2019","9 AM","11 AM"));
        return  listRow;
    }

    private static CopyOnWriteArrayList<BatchSlotPrice> getBatchPriceList(){
        CopyOnWriteArrayList<BatchSlotPrice> listRow = new CopyOnWriteArrayList<>();
        listRow.add(new BatchSlotPrice(0,"1 Month","1000"));
        listRow.add(new BatchSlotPrice(0,"3 Month","3000"));
        listRow.add(new BatchSlotPrice(0,"6 Month","6000"));
        return  listRow;
    }

    public static CopyOnWriteArrayList<BatchPackage> getBatchPackages(){
        CopyOnWriteArrayList<BatchPackage> packageData = new CopyOnWriteArrayList<>();
        packageData.add(new BatchPackage(1,"Monthly","1 Month"));
        packageData.add(new BatchPackage(2,"Quarterly","3 Month"));
        return packageData;
    }

    public static CopyOnWriteArrayList<PaymentType> getPaymentTypes(){
        CopyOnWriteArrayList<PaymentType> packageData = new CopyOnWriteArrayList<>();
        packageData.add(new PaymentType(1,"Cash"));
        packageData.add(new PaymentType(2,"PayTM"));
        packageData.add(new PaymentType(2,"Google Pay"));
        return packageData;
    }

    public static CopyOnWriteArrayList<BookingType> getBookingTypes(){
        CopyOnWriteArrayList<BookingType> packageData = new CopyOnWriteArrayList<>();
        packageData.add(new BookingType(1,"online"));
        packageData.add(new BookingType(2,"offline"));
        return packageData;
    }

    public static CopyOnWriteArrayList<BatchSlotAvail> getData() {
        CopyOnWriteArrayList<BatchSlotAvail> list = new CopyOnWriteArrayList<>();
        list.add(new BatchSlotAvail("2019-08-19",getBatchSlotList()));
        list.add(new BatchSlotAvail("2019-08-20",getBatchSlotList()));
        list.add(new BatchSlotAvail("2019-08-21",getBatchSlotList()));
        return list;
    }


	public static CopyOnWriteArrayList<UserBatchSlotAvailList> getDataa() {
		CopyOnWriteArrayList<UserBatchSlotAvailList> list = new CopyOnWriteArrayList<>();
		list.add(new UserBatchSlotAvailList("1","6","9 am","11 am",
			"Normal","10","500","Yes"));
		list.add(new UserBatchSlotAvailList("1","6","9 am","11 am",
			"Normal","10","500","Yes"));
		list.add(new UserBatchSlotAvailList("1","6","9 am","11 am",
			"Normal","10","500","Yes"));
		return list;
	}

    public static final String[] parties = new String[] {
            "Offline Booking", "Online Booking"
    };

    public static CopyOnWriteArrayList<HashMap<String,Object>> childItems = new CopyOnWriteArrayList<>();
    public static CopyOnWriteArrayList<BatchSlotAvail> parentItems = new CopyOnWriteArrayList<>();

    public static JSONArray getBookingArray(CopyOnWriteArrayList<HashMap<String,Object>> childItems,String packageId ){
        JSONArray list = new JSONArray();
        for(HashMap<String,Object> type: childItems){
            try {
                JSONObject obj = new JSONObject();
                BatchSlot batchSlot = (BatchSlot) type.get(kData);
                //obj.put(kDate,type.get(kDate));
                assert batchSlot != null;

                Log.d("packageId",batchSlot.getPackageId()+"");
                JSONObject batch = new JSONObject();
                obj.put(kBatchSlotId,batchSlot.getBatchSlotId());
                obj.put(kFacId,batchSlot.getFacId());
                obj.put(kSportId,batchSlot.getSportId());
                obj.put(kTypeId,batchSlot.getTypeId());
                obj.put(kPackageId,packageId);
                obj.put(kIsTrial,batchSlot.getIsTrial());
                obj.put(kStartTime,batchSlot.getStartTime());
                obj.put(kBatchSlotTypeName,batchSlot.getBatchSlotType());
                obj.put(kEndTime,batchSlot.getEndTime());
                obj.put(kStartDate,type.get(kDate));
                obj.put(kIsKit,batchSlot.getIsKit());
                obj.put(kKitPrice,batchSlot.getKitPrice());
                obj.put(kCourtType,batchSlot.getCourtType());
                obj.put(kCourtDesc,batchSlot.getCourtDesc());
                obj.put(kMaxParticipants,batchSlot.getMaxBook());
                obj.put(kActualPrice,batchSlot.getPrices().get(0).getPrice());
                //obj.put(kBatchSlotData,batch);
                list.put(obj);
            } catch (JSONException e1) {
                e1.printStackTrace();
            }
        }
        return list;
    }



    public static CopyOnWriteArrayList<UserFacAca> getFacData(){
        CopyOnWriteArrayList<UserFacAca> data = new CopyOnWriteArrayList<>();
        data.add(new UserFacAca(1, R.drawable.running_event));
        data.add(new UserFacAca(1, R.drawable.running_event));
        data.add(new UserFacAca(1, R.drawable.running_event));
        return data;
    }

    public static CopyOnWriteArrayList<UserFacAca> getAcaData(){
        CopyOnWriteArrayList<UserFacAca> data = new CopyOnWriteArrayList<>();
        data.add(new UserFacAca(1, R.drawable.running_event));
        data.add(new UserFacAca(1, R.drawable.running_event));
        data.add(new UserFacAca(1, R.drawable.running_event));
        return data;
    }

    public static CopyOnWriteArrayList<UserEvent> getEventData(){
        CopyOnWriteArrayList<UserEvent> data = new CopyOnWriteArrayList<>();
        data.add(new UserEvent(R.drawable.running_event));
        data.add(new UserEvent(R.drawable.running_event));
        data.add(new UserEvent(R.drawable.running_event));
        return data;
    }

}
