package com.example.sipapp_project;

import android.support.v7.app.ActionBarActivity;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.os.Handler;
import android.view.Gravity;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import org.apache.http.NameValuePair;

import org.json.JSONObject;
import android.os.AsyncTask;
import android.util.Log;

import java.net.URI;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.List;
import java.util.ArrayList;



public class MainActivity extends ActionBarActivity {
	private ProgressBar progressBar;
	private boolean doubleBackToExitPressedOnce=false;
	public static final String PREFS_NAME = "Preferencias";
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		
		requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
            WindowManager.LayoutParams.FLAG_FULLSCREEN);
        
		setContentView(R.layout.activity_main);
		
        final EditText txtEmail = (EditText)findViewById(R.id.TxtEmail);
        final EditText txtPassword = (EditText)findViewById(R.id.TxtPassword);
        final Button btnLogIn = (Button)findViewById(R.id.BtnLogIn);
        final TextView btnSignIn = (TextView)findViewById(R.id.LblSignIn);
        final TextView lblRecoverPass = (TextView)findViewById(R.id.LblRecoverPass);
        final Button lblSMS = (Button)findViewById(R.id.BtnSMS);
        
        progressBar = (ProgressBar)findViewById(R.id.loadingLogin);
        progressBar.setVisibility(View.GONE);
        
        SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
        int cli_id = settings.getInt("ID", 0);
        String nombre = settings.getString("NOMBRE", "");
        float saldo = settings.getFloat("SALDO", 0);
        
        Log.v("MsgMain",""+cli_id);
        
        if(cli_id>0){
        	if (isNetworkAvailable()) {
        		//Debemos hacer verificaci—n del usuario
                //Creamos el Intent
                Intent intent = new Intent(MainActivity.this, WelcomeActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                //Creamos la informaci—n a pasar entre actividades
                Bundle b = new Bundle();
                b.putString("ID", ""+cli_id);
                b.putString("NOMBRE", nombre);
                b.putString("SALDO", ""+saldo);
                
                //A–adimos la informaci—n al intent
                intent.putExtras(b);

                //Iniciamos la nueva actividad
                startActivity(intent);
                finish();
                System.exit(0);
                
        	}else{
				Toast toast=Toast.makeText(MainActivity.this, "No es posible verificar su identidad en este momento, necesita acceso a Internet", Toast.LENGTH_LONG);
				toast.setGravity(Gravity.TOP|Gravity.CENTER_HORIZONTAL, 0, 500);
				toast.show();        		
        	}
        }
        
        btnLogIn.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	
            	if(txtEmail.getText().toString().equals("") || txtPassword.getText().toString().equals("")){
            		
            		Toast.makeText(MainActivity.this, "Ingrese su Usuario y Contrase–a", Toast.LENGTH_SHORT).show();
                    
                    progressBar.setVisibility(View.GONE);
	                
            	}else{
            		 if (isNetworkAvailable()) {
            			 progressBar.setVisibility(View.VISIBLE);
            			 TareaWSLogin tarea = new TareaWSLogin();
            			 tarea.execute(txtEmail.getText().toString(),txtPassword.getText().toString() );
            		 }else{
            			 Toast toast=Toast.makeText(MainActivity.this, "Su  dispositivo no tiene conexi—n a Internet en este momento", Toast.LENGTH_LONG);
            			 toast.setGravity(Gravity.TOP|Gravity.CENTER_HORIZONTAL, 0, 500);
            			 toast.show();
            		 }	 
            	}
            }
       });
        
        btnSignIn.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, RegisterActivity.class);
                startActivity(intent);
            }
       });    
        
       lblSMS.setOnClickListener(new OnClickListener() {
           @Override
           public void onClick(View v) {

               Intent intent = new Intent(MainActivity.this, SMSActivity.class);
               intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
               startActivity(intent);
               finish();
               System.exit(0);
           }
      });    
       
      lblRecoverPass.setOnClickListener(new OnClickListener() {
           @Override
           public void onClick(View v) {
               Intent intent = new Intent(MainActivity.this, RecoverActivity.class);
               intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
               startActivity(intent);
           }
      });
      
      /*Message: Actualmente estamos disponibles solamente en Ibarra */
		Toast.makeText(MainActivity.this, "Actualmente estamos disponibles unicamente en Ibarra.", Toast.LENGTH_LONG).show();
	}


	private class TareaWSLogin extends AsyncTask<String,Integer,Boolean> {
		
		private String email;
		private String passw;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
	        
			String email = params[0];
			String passw = params[1];
			passw= md5(passw);
			
			
			//String url = "http://www.hawasolutions.com/Violations/public/api/api/login";
			String url = "http://www.hawasolutions.com/Violations2/public/api/api/login";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "email", email ) );
			paramsArray.add( new BasicNameValuePair( "passw", passw ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = new HttpGet(uri);
				del.setHeader("content-type", "application/json");
			
	        	HttpResponse resp = httpClient.execute(del);
	        	String respStr = EntityUtils.toString(resp.getEntity());

	        	if(!respStr.equals("")){
	        		Log.v("MsgMainJson",respStr);
	        		JSONObject respJSON = new JSONObject(respStr); 
		        	if(respStr.length() > 0){
		                 //Creamos el Intent
		        		
		                 Intent intent = new Intent(MainActivity.this, WelcomeActivity.class);
		                 intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		                 //Creamos la informaci—n a pasar entre actividades
		                 Bundle b = new Bundle();
		                 b.putString("ID", respJSON.getString("cli_id"));
		                 b.putString("NOMBRE", respJSON.getString("usu_nombre")+" "+respJSON.getString("usu_apellido"));
		                 b.putString("SALDO", respJSON.getString("cli_saldo"));
		                 
		                 /*Bloque preferencias compartidas*/
		                 SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
		                 SharedPreferences.Editor editor = settings.edit();
		                 
		                 editor.putInt("ID", Integer.parseInt(respJSON.getString("cli_id")));
		                 editor.putString("NOMBRE", respJSON.getString("usu_nombre")+" "+respJSON.getString("usu_apellido"));
		                 editor.putFloat("SALDO", Float.parseFloat(respJSON.getString("cli_saldo")));
		                 editor.putInt("ATTEMPT", 0);
		                 
		                 editor.commit();
		                 /*Fin Bloque preferencias compartidas*/
		                 
		                 //A–adimos la informaci—n al intent
		                 intent.putExtras(b);

		                 //Iniciamos la nueva actividad
		                 startActivity(intent);		
		                 
		                 finish();
		                 System.exit(0);
		        	}else{
		        		return false;
		        	}
	        	}else{
	        		return false;
	        	}
			}
		   catch(Exception ex)
		   {
		        	Log.e("ServicioRest","Error!", ex);
		        	resul = false;
		    }
	        return resul;
			//return true;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	
	    	if (result){
	    		Log.v("resultado", result.toString());
	    		//lblResultado.setText("" + idCli + "-" + nombCli + "-" + telefCli);
	    	}else{
	    		Toast.makeText(MainActivity.this, "Usuario o Contrasena Incorrectos", Toast.LENGTH_SHORT).show();
                
	    		SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
	    		int attempt = settings.getInt("ATTEMPT", 0);
	    		SharedPreferences.Editor editor = settings.edit();
	    		attempt=attempt+1;
                editor.putInt("ATTEMPT", attempt);
                editor.commit();
                
                if(attempt>=3){
                	//attempt=0;
                	//editor.putInt("ATTEMPT", attempt);
                	//editor.commit();
                    Intent intent = new Intent(MainActivity.this, RecoverActivity.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                
                progressBar.setVisibility(View.GONE);
	    	}
	    }
	    
	    protected String md5(String s) {
	    	 try {
	    	        // Create MD5 Hash
	    	        MessageDigest digest = java.security.MessageDigest
	    	                .getInstance("MD5");
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
	    
	}
	
	@Override
	public void onBackPressed() {
	    if (doubleBackToExitPressedOnce) {
	        super.onBackPressed();
	        finish();
	        return;
	    }

	    this.doubleBackToExitPressedOnce = true;
	    Toast.makeText(this, "Presiona ATRAS nuevamente para salir de la aplicaci—n", Toast.LENGTH_SHORT).show();
	    
	    new Handler().postDelayed(new Runnable() {
	    	
	        @Override
	        public void run() {
	            doubleBackToExitPressedOnce=false;                       
	        }
	    }, 2000);
	} 
	
	private boolean isNetworkAvailable() {
	    ConnectivityManager connectivityManager 
	         = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
	    NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
	    return activeNetworkInfo != null;
	}
	
	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
	    if ( keyCode == KeyEvent.KEYCODE_MENU ) {
	        // do nothing
	        return true;
	    }
	    return super.onKeyDown(keyCode, event);
	}   	

}
