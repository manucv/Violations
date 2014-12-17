package com.example.sipappwatch;

import java.net.URI;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONObject;

import android.support.v7.app.ActionBarActivity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

public class MainActivity extends ActionBarActivity {
	
	private ProgressBar progressBar;
	private EditText txtEmail;
	private EditText txtPassword;
	public static final String PREFS_NAME = "Preferencias";
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		
		//Creamos App pantalla completa
		requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		
        //Seteamos la actividad como main
		setContentView(R.layout.activity_main);
		
		//Definimos y ocultamos la barra de progreso
        progressBar = (ProgressBar)findViewById(R.id.loadingLogin);
        progressBar.setVisibility(View.GONE);
        
        //Aqu’ vamos a llamar a las funciones
        txtEmail = (EditText)findViewById(R.id.TxtEmail);
        txtPassword = (EditText)findViewById(R.id.TxtPassword);
        
	}
	
	public void onLoginClick (View pressed){
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
	
	private boolean isNetworkAvailable() {
	    ConnectivityManager connectivityManager = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
	    NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
	    return activeNetworkInfo != null;
	}	
	
	private class TareaWSLogin extends AsyncTask<String,Integer,Boolean> {
		
		private String email;
		private String passw;
		private String message = "";
		
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean result = false;
			
			String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/login";
			
			String email = params[0];
			String passw = params[1];
			
	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpPost post = new HttpPost(url);
			
	    	List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "email", email ) );
			paramsArray.add( new BasicNameValuePair( "passw", passw ) );
			
			try{
				post.setEntity(new UrlEncodedFormEntity(paramsArray));
				HttpResponse response = httpClient.execute(post);
				
				int status = response.getStatusLine().getStatusCode();
				switch (status){
					case 200: 	//case success
						String responseStr = EntityUtils.toString(response.getEntity());
						if(!responseStr.equals("")){
							JSONObject responseJSON = new JSONObject(responseStr);
							
							//Bloque preferencias compartidas
							SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
							SharedPreferences.Editor editor = settings.edit();
							 
							editor.putInt("ID", Integer.parseInt(responseJSON.getString("usu_id")));
							editor.putString("NOMBRE", responseJSON.getString("usu_nombre")+" "+responseJSON.getString("usu_apellido"));
							editor.putInt("ATTEMPT", 0);
							
							editor.commit();
							//Fin Bloque preferencias compartidas							
							
							result = true;
						}else{
							result = false;
							message = "Error al ingresar al sistema";
						}
					break;
					default:
						//Controlar caso default
						result = false;
						message = "Error al ingresar al sistema";
					break;	
				}
			}
			catch(Exception ex)
			{
				Log.e("ServicioRest","Error!", ex);
	        	result = false;
		    }
	        return result;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	if (result){
                //Creamos el Intent
                Intent intent = new Intent(MainActivity.this, ZonesActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);		                 
                startActivity(intent);
	    	}else{
	    		Toast.makeText(MainActivity.this, "Usuario o Contrasena Incorrectos", Toast.LENGTH_SHORT).show();
                
	    		SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
	    		int attempt = settings.getInt("ATTEMPT", 0);
	    		SharedPreferences.Editor editor = settings.edit();
	    		attempt=attempt+1;
                editor.putInt("ATTEMPT", attempt);
                editor.commit();
                
                if(attempt>=5){
                	//attempt=0;
                	//editor.putInt("ATTEMPT", attempt);
                	//editor.commit();
                	//AQUI DEBEMOS DARLE UNOS 5 INTENTOS LUEGO BLOQUEAR LA APP DESDE EL SISTEMA
                	/*
                    Intent intent = new Intent(MainActivity.this, RecoverActivity.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);*/
                }
                progressBar.setVisibility(View.GONE);
	    	}
	    }
	}	
}
