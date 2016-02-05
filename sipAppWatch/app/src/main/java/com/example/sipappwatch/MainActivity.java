package com.example.sipappwatch;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.view.Gravity;
import android.view.KeyEvent;
import android.view.View;
import android.view.WindowManager;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONObject;

import java.io.File;
import java.util.ArrayList;
import java.util.List;

public class MainActivity extends Activity {

	private ProgressBar progressBar;
	private EditText txtEmail;
	private EditText txtPassword;
	private TextView lblImei;
	private TextView lblMessages;
	public static final String PREFS_NAME = "Configuration";

	Context context = this;
	DBHelper dbHelper;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		//Creamos App pantalla completa
		//supportRequestWindowFeature(0);//requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);

        //Seteamos la actividad como main
		setContentView(R.layout.activity_main);

		//Definimos y ocultamos la barra de progreso
        progressBar = (ProgressBar)findViewById(R.id.loadingLogin);
        //progressBar.setVisibility(View.GONE);

        //Aqui vamos a llamar a las funciones
        txtEmail = (EditText)findViewById(R.id.TxtEmail);
        txtPassword = (EditText)findViewById(R.id.TxtPassword);
		lblImei = (TextView) findViewById(R.id.lblImei);
		lblMessages = (TextView) findViewById(R.id.lblMessages);

		TelephonyManager telephonyManager = (TelephonyManager)getSystemService(Context.TELEPHONY_SERVICE);
		String imei = telephonyManager.getDeviceId();

		lblImei.setText("Id Dispositivo: "+imei);

		dbHelper = new DBHelper(context);

	}

	private boolean checkDB(Context context, String dbName){
		File dbFile = context.getDatabasePath(dbName);
		return dbFile.exists();
	}

	public void onLoginClick (View pressed){
		if(txtEmail.getText().toString().equals("") || txtPassword.getText().toString().equals("")){
			Toast.makeText(MainActivity.this, "Ingrese su Usuario y Contraseña", Toast.LENGTH_SHORT).show();
            progressBar.setVisibility(View.GONE);
    	}else{
    		if (isNetworkAvailable()) {
    			progressBar.setVisibility(View.VISIBLE);
    			TareaWSLogin tarea = new TareaWSLogin();
    			tarea.execute(txtEmail.getText().toString(),txtPassword.getText().toString() );
    		}else{
    			Toast toast=Toast.makeText(MainActivity.this, "Su  dispositivo no tiene conexión a Internet en este momento", Toast.LENGTH_LONG);
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

			String url = "http://54.69.247.99/Violations/public/api/vigilante/login";

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
	    	progressBar.setVisibility(View.GONE);
	    	if (result){
                //Creamos el Intent

                Intent intent = new Intent(MainActivity.this, ZonesActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);
                finish();
                System.exit(0);
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
	    	}
	    }
	}

	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
	    if ( keyCode == KeyEvent.KEYCODE_MENU ) {
	        // do nothing
	        return true;
	    }
	    return super.onKeyDown(keyCode, event);
	}

	@Override
	protected void onStart(){
		super.onStart();
		dbHelper.openDB();
		progressBar.setVisibility(View.GONE);
		if(dbHelper.isEmpty("sector")==0){
			Toast.makeText(context, "Tabla SECTORES está vacia, iniciando descarga", Toast.LENGTH_SHORT).show();
			Zone zone=new Zone();
			zone.lblMessage = lblMessages;
			zone.retrieveAll(dbHelper);
		}

		if(dbHelper.isEmpty("parqueadero")==0){
			Toast.makeText(context, "Tabla PARQUEADEROS está vacia, iniciando descarga", Toast.LENGTH_SHORT).show();
			Spot spot=new Spot();
			spot.lblMessage = lblMessages;
			spot.retrieveAll(dbHelper);
		}
		if(dbHelper.isEmpty("parqueadero_sector")==0){
			Toast.makeText(context, "Tabla PARQUEADEROS POR SECTOR está vacia, iniciando descarga", Toast.LENGTH_SHORT).show();
			ZoneSpot zoneSpot=new ZoneSpot();
			zoneSpot.lblMessage = lblMessages;
			zoneSpot.retrieveAll(dbHelper);
		}
		if(dbHelper.isEmpty("tipo_infraccion")==0){
			Toast.makeText(context, "Tabla TIPOS DE INFRACCION está vacia, iniciando descarga", Toast.LENGTH_SHORT).show();
			InfractionType infraction_type=new InfractionType();
			infraction_type.lblMessage = lblMessages;
			infraction_type.retrieveAll(dbHelper);
		}


		if(checkDB(context,"sip.db")){
		//	Toast toast=Toast.makeText(context, "Ya existe una base de datos", Toast.LENGTH_LONG);
		//	toast.setGravity(Gravity.TOP|Gravity.CENTER_HORIZONTAL, 0, 500);
		//	toast.show();
		}else{

			SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
			SharedPreferences.Editor editor = settings.edit();
			editor.putString("noted_plates", "");
			editor.commit();


			//Toast toast=Toast.makeText(context, "No se encontró la base de datos", Toast.LENGTH_LONG);
			//toast.setGravity(Gravity.TOP|Gravity.CENTER_HORIZONTAL, 0, 500);
			//toast.show();
			//progressBar.setVisibility(View.VISIBLE);
			//progressBar.setVisibility(View.GONE);
		}
	}

	@Override
	protected void onStop(){
		super.onStop();
		dbHelper.closeDB();
	}

	private void loadDB(){
				/* Actualizamos Sectores */

		Toast.makeText(context, "Recuperando Información de la base de Datos", Toast.LENGTH_SHORT).show();
		Toast.makeText(context, "Cargando Sectores", Toast.LENGTH_SHORT).show();
		Zone zone=new Zone();
		zone.retrieveAll(dbHelper);

		// Actualizamos Parqueaderos
		Toast.makeText(context, "Cargando Parqueaderos", Toast.LENGTH_SHORT).show();
		Spot spot=new Spot();
		spot.retrieveAll(dbHelper);

		// Actualizamos Parqueaderos por Sector
		Toast.makeText(context, "Cargando Parqueaderos Por Zona", Toast.LENGTH_SHORT).show();
		ZoneSpot zoneSpot=new ZoneSpot();
		zoneSpot.retrieveAll(dbHelper);

		// Actualizamos Tipos de Infracciones
		Toast.makeText(context, "Cargando Tipos de Infracción", Toast.LENGTH_SHORT).show();
		InfractionType infraction_type=new InfractionType();
		infraction_type.retrieveAll(dbHelper);

		Toast.makeText(context, "Diccionarios Actualizados Exitosamente", Toast.LENGTH_SHORT).show();

	}
}
