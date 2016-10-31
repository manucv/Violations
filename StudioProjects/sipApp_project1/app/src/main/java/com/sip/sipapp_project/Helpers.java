package com.sip.sipapp_project;

import android.content.Context;
import android.view.Gravity;
import android.widget.Toast;

public class Helpers {
    private static Helpers mInstance = null;
 
    public static Helpers getInstance(){
        if(mInstance == null)
        {
            mInstance = new Helpers();
        }
        return mInstance;
    }
 
    public void showMessage(Context context, String message){
    	Toast toast=Toast.makeText(context, message, Toast.LENGTH_LONG);
		toast.setGravity(Gravity.TOP|Gravity.CENTER_HORIZONTAL, 0, 500);
		toast.show();
    }
    
}
