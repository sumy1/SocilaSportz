package com.socialsportz;

import android.content.Context;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.pm.Signature;
import android.os.StrictMode;
import android.util.Base64;
import android.util.Log;

import com.google.android.libraries.places.api.Places;
import com.socialsportz.Broadcast.ReachableManager;
import com.socialsportz.ModelManager.ModelManager;
import com.socialsportz.R;

import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

import androidx.multidex.MultiDexApplication;

import static com.socialsportz.BuildConfig.THE_MOVIE_DB_API_TOKEN;

public class ApplicationManager extends MultiDexApplication {

	//Static Properties
	private static Context _Context;

	public static Context getContext() {
		return _Context;
	}

	public static ApplicationManager getInstance() {
		return (ApplicationManager) _Context;
	}

	@Override
	public void onCreate() {
		super.onCreate();
		//Fabric.with(this, new Crashlytics());
		_Context = getApplicationContext();

		//enableStrictMode();
		//printKeyHash(getContext());

		// Initialize the SDK
		Places.initialize(getApplicationContext(), THE_MOVIE_DB_API_TOKEN);
		// Create a new Places client instance
		Places.createClient(_Context);

		//We must initialize the ModelManager singleton object at the time of application launch.
		ModelManager.modelManager().initializeModelManager();
	}

	public static void setConnectivityListener(ReachableManager.ConnectivityReceiverListener listener) {
		ReachableManager._ConnectivityReceiverListener = listener;
	}

	/**
	 * detects things you might be doing by accident and brings them to your attention so you can fix them
	 * @link https://developer.android.com/reference/android/os/StrictMode.html
	 */
	private void enableStrictMode() {
		StrictMode.setThreadPolicy(new StrictMode.ThreadPolicy.Builder()
			.detectDiskReads()
			.detectDiskWrites()
			.detectNetwork()   // or .detectAll() for all detectable problems
			.penaltyLog()
			.build());
       /* StrictMode.setVmPolicy(new StrictMode.VmPolicy.Builder()
                .detectLeakedSqlLiteObjects()
                .detectLeakedClosableObjects()
                .penaltyLog()
                .penaltyDeath()
                .build());*/
	}

	public void printKeyHash(Context context) {
		PackageInfo packageInfo;
		String key = null;
		try {
			// getting application package name, as defined in manifest
			String packageName = context.getApplicationContext()
				.getPackageName();

			// Retriving package info
			packageInfo = context.getPackageManager().getPackageInfo(
				packageName, PackageManager.GET_SIGNATURES);

			Log.e("Package Name=", context.getApplicationContext()
				.getPackageName());

			for (Signature signature : packageInfo.signatures) {
				MessageDigest md = MessageDigest.getInstance("SHA");
				md.update(signature.toByteArray());
				key = new String(Base64.encode(md.digest(), 0));

				// String key = new String(Base64.encodeBytes(md.digest()));
				Log.e("Hash Key ==> ", key);
			}
		} catch (PackageManager.NameNotFoundException e1) {
			Log.e("Name not found", e1.toString());
		} catch (NoSuchAlgorithmException e) {
			Log.e("No such an algorithm", e.toString());
		} catch (Exception e) {
			Log.e("Exception", e.toString());
		}
	}


}
