package com.example.sipappwatch;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

public class ZonesActivity extends Activity {
	
	public static final String PREFS_NAME = "Preferencias";
	private int usu_id;
	private String nombre; 
	private boolean doubleBackToExitPressedOnce=false;
	
	Map<String, Integer> sectores = new HashMap<String, Integer>();
	
	private Spinner spnSectores;
	private TextView txtWelcome;
	private Context context ;
	
	private View dialogExit;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_zones);
		context = ZonesActivity.this;
		
		//Preferencias y Variables Globales
		SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
        nombre = settings.getString("NOMBRE", "(Sin Nombre)");
        usu_id = settings.getInt("ID", 0);

        //Controles
        spnSectores=(Spinner) findViewById(R.id.SpnSectores);
        txtWelcome=(TextView) findViewById(R.id.TxtWelcome);

        txtWelcome.setText("Bienvenido "+nombre);        
        
        TareaWSSectoresXVigilante tareaSectoresXVigilante = new TareaWSSectoresXVigilante();
        tareaSectoresXVigilante.execute();

	}
	
	public void onSelectClick (View pressed){
		System.out.println(sectores.entrySet());
		Intent intent = new Intent(ZonesActivity.this,ParkingActivity.class);
        Bundle b = new Bundle();
        b.putString("SEC_NOMBRE", spnSectores.getSelectedItem().toString());
        b.putInt("SEC_ID", sectores.get(spnSectores.getSelectedItem()));
        intent.putExtras(b);
        startActivity(intent);
	}
	
	private class TareaWSSectoresXVigilante extends AsyncTask<String,Integer,Boolean> {
		boolean result = false;
		private String message;
		
		
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://54.69.247.99/Violations/public/api/vigilante/vigilantes/"+usu_id+"/sectores";
			
	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpGet get = new HttpGet(url);
			
			try {

				HttpResponse response = httpClient.execute(get);
				int status = response.getStatusLine().getStatusCode();
				
				switch (status){
					case 200: 	//case success
						String responseStr = EntityUtils.toString(response.getEntity());
						if(!responseStr.equals("")){
							JSONArray responseJSON = new JSONArray(responseStr); 
				        	for(int i=0; i<responseJSON.length(); i++)
				        	{
				        		JSONObject obj = responseJSON.getJSONObject(i);
				        		Integer sec_id = obj.getInt("sec_id");
					        	String sec_nombre = obj.getString("sec_nombre").toUpperCase();
				        		sectores.put(sec_nombre, sec_id);
				        	}
							
							result = true;
						}else{
							result = false;
							message = "Error al consultar los sectores";
						}
					break;
					default:
						result = false;
						message = "Error al consultar los sectores";			
					break;
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
	 
	        return result;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	
	    	if (result)
	    	{
	    		
	    		List listaSectores = new ArrayList<String>();
	    		
	    	    Iterator it = sectores.entrySet().iterator();
	    	    while (it.hasNext()) {
	    	        Map.Entry pairs = (Map.Entry)it.next();
	    	        //Log.v("mapa",pairs.getKey() + " = " + pairs.getValue());
	    	        listaSectores.add(pairs.getKey());
	    	        //it.remove(); // avoids a ConcurrentModificationException
	    	    }
	    		
		    	//Rellenamos la lista con los nombres de los clientes
	    		//Rellenamos la lista con los resultados
	        	ArrayAdapter<String> adaptador =
	        		    new ArrayAdapter<String>(ZonesActivity.this,
	        		        android.R.layout.simple_spinner_dropdown_item, listaSectores );
	        	
	        	spnSectores.setAdapter(adaptador);
	    	}
	    }
	}	
	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
	    MenuInflater inflater = getMenuInflater();
	    inflater.inflate(R.menu.main, menu);
	    return true;
	}
	
	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
	    // Handle item selection
		
		Intent intent;

	    switch (item.getItemId()) {
 
		case R.id.action_settings:
	        	intent = new Intent(context, ConfigActivity.class);
            	intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
 	            startActivity(intent);
 	            finish();
                System.exit(0);
	            return true;
		case R.id.action_logout:
	        	
	        	Builder dialog = new AlertDialog.Builder(context);
	            dialog.setMessage("Está seguro de que desea salir del sistema?" );
	            dialog.setPositiveButton("Salir", new DialogInterface.OnClickListener() {
	                 @Override
	                 public void onClick(DialogInterface paramDialogInterface, int paramInt) {
	                     // TODO Auto-generated method stub
	                	Intent intent = new Intent(context, MainActivity.class);
	                	intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
	     	            startActivity(intent);
	     	            finish();
		                System.exit(0);
	                    //startActivityForResult(new Intent(android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS),100);//android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS), 100);
	                 }
	             });
	             dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
	                 @Override
	                 public void onClick(DialogInterface paramDialogInterface, int paramInt) {
	                     // TODO Auto-generated method stub

	                 }
	             });
	             dialog.show();
	             return true;
			
		case R.id.action_plate:
        	intent = new Intent(context, PlateActivity.class);
        	intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
	            startActivity(intent);
	            finish();
            System.exit(0);
            return true;
            
	        default:
	            return super.onOptionsItemSelected(item);
	    }
	}
	
	@Override
	public void onBackPressed()
	{
		//return false;
	   // super.onBackPressed(); // Comment this super call to avoid calling finish()
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
