package com.sip.sipapp_project;

import com.sip.sipapp_project.R;

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.view.Gravity;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.Window;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

public class ParqueaderoActivity extends AppCompatActivity {

	public static final String PREFS_NAME = "Preferencias";
	private SharedPreferences settings;
	Context context = this;

	//Common controls among all screens
		public ProgressBar loadingInfo;
		public TextView txtSaldo;

	//Common vars among all screens
		public int version;
		public boolean isMenuScreen = false;
		public String cli_id;
		public String saldo;

	private boolean doubleBackToExitPressedOnce=false;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

        ActionBar actionBar = getActionBar();
		try {
			this.getSupportActionBar().setDisplayShowHomeEnabled(true);
			this.getSupportActionBar().setLogo(R.drawable.ic_launcher);
			this.getSupportActionBar().setDisplayUseLogoEnabled(true);
			if(!isMenuScreen){
				this.getSupportActionBar().setDisplayHomeAsUpEnabled(true);

			}
		}catch(NullPointerException e){

		}

		try {
			PackageInfo packageInfo = context.getPackageManager()
					.getPackageInfo(context.getPackageName(), 0);
			version=packageInfo.versionCode;
		} catch (PackageManager.NameNotFoundException e) {
			// should never happen
			throw new RuntimeException("Could not get package name: " + e);
		}


		new TareaWSApp().execute();
		new TareaWSCliente().execute();

        //Recuperamos la informacion pasada en el intent
        Bundle bundle = this.getIntent().getExtras();

        //Construimos el mensaje a mostrar
       	cli_id=bundle.getString("ID");
      	this.saldo=bundle.getString("SALDO");

        //this.setSaldo(saldo);
        
        //Controlamos que exista conexion a internet
		 if (!isNetworkAvailable()) {
			 Toast toast=Toast.makeText(ParqueaderoActivity.this, "Su  dispositivo no tiene conexión a Internet en este momento", Toast.LENGTH_LONG);
			 toast.setGravity(Gravity.TOP|Gravity.CENTER_HORIZONTAL, 0, 500);
			 toast.show();
			 
             Intent intent = new Intent(ParqueaderoActivity.this, MainActivity.class);
             intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
             startActivity(intent);
		 }	 
        //Fin de control de acceso a Internet 
        
	}
	
	public void setSaldo(String saldo){ this.saldo=saldo; }
	public String getSaldo(){ return this.saldo; }
	
	public void setCli_id(String cli_id){ this.cli_id=cli_id; }
	public String getCli_id(){ return this.cli_id; }
	
    @Override
    public boolean onCreateOptionsMenu(Menu menu){
    	 MenuInflater inflater = getMenuInflater();
    	    inflater.inflate(R.menu.navigation, menu);
    	    return super.onCreateOptionsMenu(menu);    	
    }
    
    @Override
    public boolean onOptionsItemSelected(MenuItem item){
    	super.onOptionsItemSelected(item);
    	
    	Context context = getApplicationContext();
    	
    	Intent intent=null;
    	switch(item.getItemId()){
    		case R.id.ItemComprar:
                 intent = new Intent(context,ParkingActivity.class);
    		break;
    		case R.id.ItemCargar:
    			intent = new Intent(context,MethodActivity.class);
    		break;
    		case R.id.ItemContactos:
    			intent = new Intent(context,RelatedActivity.class);
    		break;
    		case R.id.ItemDisponibilidad:
    			intent = new Intent(context,MapActivity.class);
    		break;
    		case R.id.ItemMiCuenta:
    			intent = new Intent(context,HistoryActivity.class);
    		break;
//    		case R.id.ItemAcercaDe:
//    			intent = new Intent(context,InfoActivity.class);
//    		break;
    		case R.id.ItemSalir:
    			
			    AlertDialog.Builder alert = new AlertDialog.Builder(ParqueaderoActivity.this);
			    alert.setTitle("Salir");
		    	alert.setMessage("Esta seguro de que desea salir y cerrar sesión del sistema.");

			    alert.setPositiveButton("Salir", new DialogInterface.OnClickListener() {
			        @Override
					public void onClick(DialogInterface dialog, int whichButton) {
			        	
		                 /*Bloque preferencias compartidas*/
		                 SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
		                 SharedPreferences.Editor editor = settings.edit();
		                 
		                 editor.putInt("ID", 0);
		                 editor.putString("NOMBRE", "");
		                 editor.putFloat("SALDO", 0);
		                 
		                 editor.commit();
		                 /*Fin Bloque preferencias compartidas*/			        	
			        	
			        	Intent intent = new Intent(ParqueaderoActivity.this, MainActivity.class);
		                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);
						intent.addFlags(Intent.FLAG_ACTIVITY_NO_HISTORY);
		                startActivity(intent);

		                finish();
		                System.exit(0);
		    	        return;
			        }
			    });
			    
			    alert.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
		            @Override
					public void onClick(DialogInterface dialog, int whichButton) {
		            	//Do Nothing
		         }
	            });
			    
			    alert.show();    			
    			
    			
    		break;
    	    case android.R.id.home:
    	    	intent = new Intent(context,WelcomeActivity.class);
    	    break;
    		
    	}
    	if(intent != null){
    		intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
	    	Bundle b = new Bundle();
	        b.putString("ID", cli_id);
	        b.putString("SALDO", saldo);
	        intent.putExtras(b);                
	        startActivity(intent);

    	}
    	return super.onOptionsItemSelected(item);
    	
    }
    
	private boolean isNetworkAvailable() {
	    ConnectivityManager connectivityManager 
	         = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
	    NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
	    return activeNetworkInfo != null;
	}
	
	@Override
	public void onBackPressed()
	{
		if(!isMenuScreen){
			Intent intent = new Intent(context, WelcomeActivity.class);
			intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
			//Creamos la información a pasar entre actividades
			Bundle b = new Bundle();
			b.putString("NOMBRE", "");
			b.putString("SALDO", saldo);
			b.putString("ID", cli_id);

			intent.putExtras(b);

			//Iniciamos la nueva actividad
			startActivity(intent);

			finish();
			System.exit(0);
		}else{
			if (doubleBackToExitPressedOnce) {
				super.onBackPressed();
				finish();
				return;
			}

			this.doubleBackToExitPressedOnce = true;
			Toast.makeText(this, "Presiona ATRAS nuevamente para salir de la aplicación", Toast.LENGTH_SHORT).show();

			new Handler().postDelayed(new Runnable() {

				@Override
				public void run() {
					doubleBackToExitPressedOnce=false;
				}
			}, 2000);
		}

	}


	/******* ClientWS ********/
	private class TareaWSCliente extends AsyncTask<String,Integer,Boolean> {
		private int version_actual;
		@Override
		protected Boolean doInBackground(String... params) {

			boolean result = false;

			String url = "http://54.69.247.99/Violations/public/api/api/clientes/"+cli_id;
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

					editor.putInt("ID", Integer.parseInt(responseJSON.getString("cli_id")));
					editor.putString("NOMBRE", responseJSON.getString("usu_nombre") + " " + responseJSON.getString("usu_apellido"));
					editor.putFloat("SALDO", Float.parseFloat(responseJSON.getString("cli_saldo")));
					editor.putInt("ATTEMPT", 0);
					editor.commit();
					saldo = responseJSON.getString("cli_saldo");
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
				setSaldo(saldo);
				txtSaldo.setText("$"+saldo);
				loadingInfo.setVisibility(View.GONE);
				txtSaldo.setVisibility(View.VISIBLE);
			}
		}
	}

	/******* AppWS ********/
	public class TareaWSApp extends AsyncTask<String,Integer,Boolean> {
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
				setSaldo(saldo);
				txtSaldo.setText("$"+saldo);
				if(version != server_version){
				 	/*Bloque preferencias compartidas*/
					SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
					SharedPreferences.Editor editor = settings.edit();

					editor.putInt("ID", 0);
					editor.putString("NOMBRE", "");
					editor.putFloat("SALDO", 0);
					editor.putBoolean("OUTDATED", true);

					editor.commit();
				 	/*Fin Bloque preferencias compartidas*/

					Intent intent = new Intent(context, MainActivity.class);
					intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
					startActivity(intent);

					finish();
					System.exit(0);
					return;

				}
			}
		}
	}
}
