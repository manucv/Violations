package com.example.sipapp_project;

import java.net.URI;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONObject;

import android.content.Context;
import android.content.Intent;

import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.Spinner;



public class LocationActivity extends ParqueaderoActivity {
	
	//private Spinner pai_id;
	private Spinner est_id;
	private Spinner ciu_id;
	private Spinner sec_id;

	private String cli_id;
	private String saldo;
	
	private String[] idSectores;
	
	private ProgressBar loadingLocation;
	private Button btnVerEpacios;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_location);
        
        est_id = (Spinner) findViewById(R.id.est_id);
        ciu_id = (Spinner) findViewById(R.id.ciu_id);
        sec_id = (Spinner) findViewById(R.id.sec_id);
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldoUbicacion);
        
        loadingLocation = (ProgressBar)findViewById(R.id.LoadingLocation);
        
		TareaWSListarEstados tareaEst = new TareaWSListarEstados();
		tareaEst.execute("63");  
		
		btnVerEpacios = (Button)findViewById(R.id.BtnVerEpacios);
        
		
		cli_id=super.getCli_id();
		saldo=super.getSaldo();
		
        txtSaldo.setText("$"+Float.parseFloat(saldo));
		
		btnVerEpacios.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	Log.v("click","click en categorias");
            	
                Intent intent =
                        new Intent(LocationActivity.this,ParkingActivity.class);
                
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                b.putString("SEC_ID", idSectores[sec_id.getSelectedItemPosition()] );
                b.putString("SALDO", saldo );
                
                intent.putExtras(b);                
                
                startActivity(intent);	
            	        	
            }
       });

   }
	
	private class TareaWSListarEstados extends AsyncTask<String,Integer,Boolean> {
		private String[] estados;
		private String[] idEstados;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();

	    	String pai_id = params[0];
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/estados";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "pai_id", pai_id ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = 
						new HttpGet(uri);
						
				del.setHeader("content-type", "application/json");	    	
	    				
				try
		        {			
		        	HttpResponse resp = httpClient.execute(del);
		        	String respStr = EntityUtils.toString(resp.getEntity());
		        	Log.v("query",respStr);
		        	JSONArray respJSON = new JSONArray(respStr);
		        	
		        	estados = new String[respJSON.length()];
		        	idEstados = new String[respJSON.length()];
		        			
		        	for(int i=0; i<respJSON.length(); i++)
		        	{
		        		JSONObject obj = respJSON.getJSONObject(i);
			        	String est_nombre = obj.getString("est_nombre_es").toUpperCase();
			        	String est_id = obj.getString("est_id");
			        	
			        	estados[i] = est_nombre;
			        	idEstados[i] = est_id;
		        	}
		        
		        }
		        catch(Exception ex)
		        {
		        	Log.e("ServicioRest","Error!", ex);
		        	resul = false;
		        }
			
			} catch (URISyntaxException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}			
	 
	        return resul;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	
	    	if (result)
	    	{
		    	//Rellenamos la lista con los nombres de los clientes
	    		//Rellenamos la lista con los resultados
	        	ArrayAdapter<String> adaptador =
	        		    new ArrayAdapter<String>(LocationActivity.this,
	        		        android.R.layout.simple_spinner_dropdown_item, estados);
	        		 
	        	est_id.setAdapter(adaptador);
	        	est_id.setOnItemSelectedListener(new OnItemSelectedListener() {

					@Override
					public void onItemSelected(AdapterView<?> parent,
							View view, int position, long id) {
						// TODO Auto-generated method stub
			        	loadingLocation.setVisibility(View.VISIBLE);
			        	btnVerEpacios.setVisibility(View.GONE);
						Log.v("click estados","clickee "+idEstados[position]);
						TareaWSListarCiudades tareaEst = new TareaWSListarCiudades();
						tareaEst.execute(idEstados[position]);   
						
						
					}

					@Override
					public void onNothingSelected(AdapterView<?> parent) {
						// TODO Auto-generated method stub
						
					}

	        	});
	    	}
	    }
	}	
	
	private class TareaWSListarCiudades extends AsyncTask<String,Integer,Boolean> {
		private String[] ciudades;
		private String[] idCiudades;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();

	    	String est_id = params[0];
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/ciudades";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "est_id", est_id ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = 
						new HttpGet(uri);
						
				del.setHeader("content-type", "application/json");	    	
	    				
				try
		        {			
		        	HttpResponse resp = httpClient.execute(del);
		        	String respStr = EntityUtils.toString(resp.getEntity());
		        	Log.v("query",respStr);
		        	JSONArray respJSON = new JSONArray(respStr);
		        	
		        	ciudades = new String[respJSON.length()];
		        	idCiudades = new String[respJSON.length()];
		        			
		        	for(int i=0; i<respJSON.length(); i++)
		        	{
		        		JSONObject obj = respJSON.getJSONObject(i);
			        	String ciu_nombre = obj.getString("ciu_nombre_es").toUpperCase();
			        	String ciu_id = obj.getString("ciu_id");
			        	
			        	ciudades[i] = ciu_nombre;
			        	idCiudades[i] = ciu_id;
		        	}
		        
		        }
		        catch(Exception ex)
		        {
		        	Log.e("ServicioRest","Error!", ex);
		        	resul = false;
		        }
			
			} catch (URISyntaxException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}			
	 
	        return resul;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	
	    	if (result)
	    	{
		    	//Rellenamos la lista con los nombres de los clientes
	    		//Rellenamos la lista con los resultados
	        	ArrayAdapter<String> adaptador =
	        		    new ArrayAdapter<String>(LocationActivity.this,
	        		        android.R.layout.simple_spinner_dropdown_item, ciudades);
	        		 
	        	ciu_id.setAdapter(adaptador);
	        	ciu_id.setOnItemSelectedListener(new OnItemSelectedListener() {

					@Override
					public void onItemSelected(AdapterView<?> parent,
							View view, int position, long id) {
						// TODO Auto-generated method stub
			        	loadingLocation.setVisibility(View.VISIBLE);
			        	btnVerEpacios.setVisibility(View.GONE);
						Log.v("click ciudades","clickee "+idCiudades[position]);
						TareaWSListarSectores tareaCiu = new TareaWSListarSectores();
						tareaCiu.execute(idCiudades[position]);   
						
						
					}

					@Override
					public void onNothingSelected(AdapterView<?> parent) {
						// TODO Auto-generated method stub
						
					}

	        	});
	    	}
	    }
	}
	
	
	private class TareaWSListarSectores extends AsyncTask<String,Integer,Boolean> {
		private String[] sectores;
		
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();

	    	String ciu_id = params[0];
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/sectores";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "ciu_id", ciu_id ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = 
						new HttpGet(uri);
						
				del.setHeader("content-type", "application/json");	    	
	    				
				try
		        {			
		        	HttpResponse resp = httpClient.execute(del);
		        	String respStr = EntityUtils.toString(resp.getEntity());
		        	Log.v("query",respStr);
		        	JSONArray respJSON = new JSONArray(respStr);
		        	
		        	sectores = new String[respJSON.length()];
		        	idSectores = new String[respJSON.length()];
		        			
		        	for(int i=0; i<respJSON.length(); i++)
		        	{
		        		JSONObject obj = respJSON.getJSONObject(i);
			        	String sec_nombre = obj.getString("sec_nombre").toUpperCase();
			        	String sec_id = obj.getString("sec_id");
			        	
			        	sectores[i] = sec_nombre;
			        	idSectores[i] = sec_id;
		        	}
		        
		        }
		        catch(Exception ex)
		        {
		        	Log.e("ServicioRest","Error!", ex);
		        	resul = false;
		        }
			
			} catch (URISyntaxException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}			
	 
	        return resul;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	
	    	if (result)
	    	{
		    	//Rellenamos la lista con los nombres de los clientes
	    		//Rellenamos la lista con los resultados
	        	ArrayAdapter<String> adaptador =
	        		    new ArrayAdapter<String>(LocationActivity.this,
	        		        android.R.layout.simple_spinner_dropdown_item, sectores);
	        		 
	        	sec_id.setAdapter(adaptador);
	        	
	        	if(sectores.length>0){
		        	loadingLocation.setVisibility(View.GONE);
		        	btnVerEpacios.setVisibility(View.VISIBLE);
	        	}else{
		        	
					Context context = getApplicationContext();
	                CharSequence text = "No Existen Sectores";
	                int duration = Toast.LENGTH_SHORT;

	                Toast toast = Toast.makeText(context, text, duration);
	                toast.show();
	        	}
	        
	        	
	        	sec_id.setOnItemSelectedListener(new OnItemSelectedListener() {

					@Override
					public void onItemSelected(AdapterView<?> parent,
							View view, int position, long id) {
						// TODO Auto-generated method stub
						Log.v("click sectores","clickee "+idSectores[position]);
						/*TareaWSListarEstados tareaEst = new TareaWSListarEstados();
						tareaEst.execute(idEstados[position]);*/   
						
						
					}

					@Override
					public void onNothingSelected(AdapterView<?> parent) {
						// TODO Auto-generated method stub
						
					}

	        	});
	    	}
	    }
	}

}
