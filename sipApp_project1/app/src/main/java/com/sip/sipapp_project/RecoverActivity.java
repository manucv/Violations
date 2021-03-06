package com.sip.sipapp_project;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import com.sip.sipapp_project.R;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

public class RecoverActivity extends Activity {
	private Button btnRecover;
	private ProgressBar loadRecover;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_recover);
		
		final EditText txtRecoverPassword = (EditText)findViewById(R.id.TxtRecoverPassword);
        btnRecover = (Button)findViewById(R.id.BtnRecoverPassword);
		loadRecover = (ProgressBar)findViewById(R.id.loading);

        btnRecover.setOnClickListener(new OnClickListener(){

 			@Override
 			public void onClick(View v) {
 				if(	!txtRecoverPassword.getText().toString().equals("") ){
 					if (isNetworkAvailable()) {
						loadRecover.setVisibility(View.VISIBLE);
						btnRecover.setVisibility(View.GONE);
 						TareaWSRecover tarea = new TareaWSRecover();
 						tarea.execute(txtRecoverPassword.getText().toString());
 					}else{
 						Toast.makeText(RecoverActivity.this, "Su  dispositivo no tiene conexión a Internet en este momento", Toast.LENGTH_LONG).show();
 					}	
 				}else{
 					Toast.makeText(RecoverActivity.this, "Debes ingresar tu usuario o contraseña", Toast.LENGTH_SHORT).show();
 				}
 			}
 		});
		
		
	}
	
	private class TareaWSRecover extends AsyncTask<String,Integer,Boolean> {
		
		private String email;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = false;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
	        
			String email = params[0];
			
			String url = "http://54.69.247.99/Violations/public/api/api/recover";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "email", email ) );
			
			try {

				HttpPost post = new HttpPost(url);
				
				post.setEntity(new UrlEncodedFormEntity(paramsArray));
				HttpResponse resp = httpClient.execute(post);
				
	        	String respStr = EntityUtils.toString(resp.getEntity());
	        	Log.v("result","ejemplo");
	        	Log.v("result",respStr);
	        	
	        	return true;
	        	/*
	        	if(!respStr.equals("")){
	        		JSONObject respJSON = new JSONObject(respStr); 
		        	if(respStr.length() > 0){ 
		        		
		        	}else{
		        		return false;
		        	}
	        	}else{
	        		return false;
	        	}*/
			}
			catch(Exception ex)
		   	{
				Log.e("ServicioRest","Error!", ex);
	        	resul = false;
		   	}
			return resul;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
			loadRecover.setVisibility(View.GONE);
	    	if (result){
				Toast toast= Toast.makeText(getApplicationContext(),
						"Un mensaje fue enviado a su correo electrónico registrado con instrucciones para recuperar su contraseña.", Toast.LENGTH_LONG);
				toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
				toast.show();

				Intent intent = new Intent(RecoverActivity.this, MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivity(intent);	
	    	}else{
	    		
	    	}
	    }	        
	}	
	private boolean isNetworkAvailable() {
	    ConnectivityManager connectivityManager 
	         = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
	    NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
	    return activeNetworkInfo != null;
	}
}
