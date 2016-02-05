package com.sip.sipapp_project;

import android.app.ActionBar;
import android.app.Activity;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.support.v7.app.ActionBarActivity;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import org.apache.http.NameValuePair;

import org.json.JSONException;
import org.json.JSONObject;

import com.sip.sipapp_project.R;

import android.os.AsyncTask;
import android.util.Log;

import java.io.IOException;
import java.net.URI;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.List;
import java.util.ArrayList;


public class MainActivity extends Activity {
	private ProgressBar progressBar;


	private boolean doubleBackToExitPressedOnce=false;
	public static final String PREFS_NAME = "Preferencias";
	private SharedPreferences settings;
	Context context = this;
	public int version;
	public String versionNumber;

	private EditText txtEmail;
	private EditText txtPassword;
	private Button btnLogIn;
	private TextView btnSignIn;
	private TextView lblRecoverPass;
	private Button lblSMS;
	private TextView lblVersion;
	private Button btnUpdate;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
//		requestWindowFeature(Window.FEATURE_NO_TITLE);
		try {
			PackageInfo packageInfo = context.getPackageManager()
					.getPackageInfo(context.getPackageName(), 0);
			version=packageInfo.versionCode;
			versionNumber=packageInfo.versionName;
		} catch (PackageManager.NameNotFoundException e) {
			// should never happen
			throw new RuntimeException("Could not get package name: " + e);
		}


		super.onCreate(savedInstanceState);

		setContentView(R.layout.activity_main);
		
        txtEmail = (EditText)findViewById(R.id.TxtEmail);
        txtPassword = (EditText)findViewById(R.id.TxtPassword);
        btnLogIn = (Button)findViewById(R.id.BtnLogIn);
		btnSignIn = (TextView)findViewById(R.id.LblSignIn);
        lblRecoverPass = (TextView)findViewById(R.id.LblRecoverPass);
        lblSMS = (Button)findViewById(R.id.BtnSMS);
		lblVersion = (TextView)findViewById(R.id.LblVersion);
		btnUpdate = (Button)findViewById(R.id.BtnUpdate);
		btnUpdate.setVisibility(View.GONE);
        progressBar = (ProgressBar) findViewById(R.id.loadingLogin);
        progressBar.setVisibility(View.GONE);
        
        settings = getSharedPreferences(PREFS_NAME, 0);
        int cli_id = settings.getInt("ID", 0);
        String nombre = settings.getString("NOMBRE", "");
        float saldo = settings.getFloat("SALDO", 0);
		boolean outdated = settings.getBoolean("OUTDATED", false);

		lblVersion.setText("Version "+versionNumber);


		if (isNetworkAvailable()) {
			new TareaWSApp().execute();
			if(cli_id>0){
        		//Debemos hacer verificación del usuario
                //Creamos el Intent
                Intent intent = new Intent(MainActivity.this, WelcomeActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                //Creamos la información a pasar entre actividades
                Bundle b = new Bundle();
                b.putString("ID", ""+cli_id);
                b.putString("NOMBRE", nombre);
                b.putString("SALDO", ""+saldo);
                
                //Añadimos la información al intent
                intent.putExtras(b);

                //Iniciamos la nueva actividad
                startActivity(intent);
                finish();
                System.exit(0);
			}
		}else{
			Helpers.getInstance().showMessage(context,"No es posible verificar su identidad en este momento, necesita acceso a Internet.");
		}

        
        btnLogIn.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	
            	if(txtEmail.getText().toString().equals("") || txtPassword.getText().toString().equals("")){
            		Helpers.getInstance().showMessage(context,"Ingrese su Usuario y Contraseña");
                    progressBar.setVisibility(View.GONE);
	                
            	}else{
            		 if (isNetworkAvailable()) {
            			 progressBar.setVisibility(View.VISIBLE);
            			 TareaWSLogin tarea = new TareaWSLogin();
            			 tarea.execute(txtEmail.getText().toString(),txtPassword.getText().toString() );
            		 }else{
            			 Helpers.getInstance().showMessage(context,"Su  dispositivo no tiene conexión a Internet en este momento");
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
      	//Helpers.getInstance().showMessage(context,"Actualmente estamos disponibles unicamente en Ibarra.");
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
			String url = "http://54.69.247.99/Violations/public/api/api/login";
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
		                 //Creamos la información a pasar entre actividades
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
		                 
		                 //Añadimos la información al intent
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
	    		
	    		Helpers.getInstance().showMessage(context,"Usuario o Contraseña Incorrectos");
                
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
			
			System.exit(0);
			finish();
			//super.onBackPressed();
	        return;
	    }

	    this.doubleBackToExitPressedOnce = true;
	    Helpers.getInstance().showMessage(context,"Presiona ATRAS nuevamente para salir de la aplicación");
	    
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

	public void onUpdateClick (View v) {
		Intent browserIntent = new Intent(Intent.ACTION_VIEW, Uri.parse("https://play.google.com/store/apps/details?id=com.sip.parqueo"));
		startActivity(browserIntent);
	}


	/******* AppWS *******/
	private class TareaWSApp extends AsyncTask<String,Integer,Boolean> {
		private int server_version;
		@Override
		protected Boolean doInBackground(String... params) {

			boolean result = false;

			String url = "http://54.69.247.99/Violations/public/api/api/app";
			HttpClient httpClient = new DefaultHttpClient();
			HttpGet get = new HttpGet(url);
			HttpResponse response;

			try {
				response = httpClient.execute(get);
				String responseStr = EntityUtils.toString(response.getEntity());
				if(!responseStr.equals("")){
					JSONObject responseJSON = new JSONObject(responseStr);

					settings = getSharedPreferences(PREFS_NAME, 0);
					SharedPreferences.Editor editor = settings.edit();
					editor.putInt("SERVER_VERSION", Integer.parseInt(responseJSON.getString("version")));
					server_version=Integer.parseInt(responseJSON.getString("version"));
					editor.commit();
				}

			} catch (ClientProtocolException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			return true;

		}

		@Override
		protected void onPostExecute(Boolean result) {
			if (result)
			{
				Log.v("version","Revisando Version");
				if(version < server_version){
					Log.v("version","Actualize la aplicacion");
					Helpers.getInstance().showMessage(context,"Version Desactualizada");
					txtEmail.setVisibility(View.GONE);
					txtPassword.setVisibility(View.GONE);
					btnLogIn.setVisibility(View.GONE);
					btnUpdate.setVisibility(View.VISIBLE);
				}
			}
		}
	}
	/** Fin AppWS **/
}
