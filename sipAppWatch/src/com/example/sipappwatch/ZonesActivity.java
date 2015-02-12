package com.example.sipappwatch;

import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.AdapterView.OnItemSelectedListener;

public class ZonesActivity extends Activity {
	
	public static final String PREFS_NAME = "Preferencias";
	private int usu_id;
	private String nombre; 
	
	Map<String, Integer> sectores = new HashMap<String, Integer>();
	
	private Spinner spnSectores;
	private TextView txtWelcome;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_zones);
		
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
	    	
			String url = "http://54.209.66.42/violations/public/api/vigilante/vigilantes/"+usu_id+"/sectores";
			
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
	
}
