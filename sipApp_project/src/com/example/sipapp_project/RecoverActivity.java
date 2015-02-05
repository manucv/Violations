package com.example.sipapp_project;

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
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class RecoverActivity extends Activity {
	private Button btnRecover;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_recover);
		
		final EditText txtRecoverPassword = (EditText)findViewById(R.id.TxtRecoverPassword);
        btnRecover = (Button)findViewById(R.id.BtnRecoverPassword);

        btnRecover.setOnClickListener(new OnClickListener(){

 			@Override
 			public void onClick(View v) {
 				if(	!txtRecoverPassword.getText().toString().equals("") ){
 					if (isNetworkAvailable()) {
 						TareaWSRecover tarea = new TareaWSRecover();
 						tarea.execute(txtRecoverPassword.getText().toString());
 					}else{
 						Toast.makeText(RecoverActivity.this, "Su  dispositivo no tiene conexi—n a Internet en este momento", Toast.LENGTH_LONG).show();
 					}	
 				}else{
 					Toast.makeText(RecoverActivity.this, "Debes ingresar tu usuario o contrase–a", Toast.LENGTH_SHORT).show();
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
			
			String url = "http://192.168.1.169/Hawa/Violations/public/api/api/recover";
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
	    	
	    	if (result){
	    		Toast.makeText(RecoverActivity.this, "Un mensaje fue enviado a su correo electr—nico registrado con instrucciones para recuperar su contrase–a.", Toast.LENGTH_LONG).show();
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
