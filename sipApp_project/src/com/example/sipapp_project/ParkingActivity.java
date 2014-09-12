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


import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.AdapterView.OnItemSelectedListener;

public class ParkingActivity extends Activity {
	private String cli_id;
	private String sec_id;
	private Spinner par_id;
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_parking);
        
        final EditText txtAut_placa = (EditText)findViewById(R.id.TxtAut_placa);
        final Spinner spnLog_par_horas_parqueo = (Spinner)findViewById(R.id.SpnLog_par_horas_parqueo);
        par_id = (Spinner) findViewById(R.id.SpnPar_id);
        
        Bundle bundle = this.getIntent().getExtras();
        cli_id=bundle.getString("ID");
        sec_id=bundle.getString("SEC_ID");
        
        TareaWSListarParqueaderos tarea = new TareaWSListarParqueaderos();
		tarea.execute(sec_id);
        
        Button btnComprarParqueadero = (Button)findViewById(R.id.BtnComprarParqueadero);
        
        btnComprarParqueadero.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	Log.v("click","click en categorias");
            	TareaWSComprar tarea = new TareaWSComprar();
            	
				tarea.execute(	par_id.getSelectedItem().toString(),
								txtAut_placa.getText().toString(), 
								spnLog_par_horas_parqueo.getSelectedItemPosition()+1+"" );        
            }
       });
	} 

	private class TareaWSComprar extends AsyncTask<String,Integer,Boolean> {
		
		private String par_id;
		private String aut_placa;
		private String log_par_horas_parqueo;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
	        
			String par_id=params[0];
			String aut_placa=params[1];
			String log_par_horas_parqueo=params[2];	    	
			
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/comprar/"+cli_id;
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "par_id", par_id ) );
			paramsArray.add( new BasicNameValuePair( "aut_placa", aut_placa ) );
			paramsArray.add( new BasicNameValuePair( "log_par_horas_parqueo", log_par_horas_parqueo ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = 
						new HttpGet(uri);
						Log.v("lleg—",uri.toString());
				del.setHeader("content-type", "application/json");
				
				try
		        {			
		        	HttpResponse resp = httpClient.execute(del);
		        	String respStr = EntityUtils.toString(resp.getEntity());		        	
		        	JSONObject respJSON = new JSONObject(respStr);
		        	
		        	if(respStr.length() > 0){
		                 //Creamos el Intent
		                 Intent intent =
		                         new Intent(ParkingActivity.this, WelcomeActivity.class);

		                 //Creamos la informaci—n a pasar entre actividades
		                 Bundle b = new Bundle();
		                 b.putString("NOMBRE", respJSON.getString("cli_nombre"));
		                 b.putString("SALDO", respJSON.getString("cli_saldo"));
		                 b.putString("ID", respJSON.getString("cli_id"));
		                 //A–adimos la informaci—n al intent
		                 intent.putExtras(b);

		                 //Iniciamos la nueva actividad
		                 startActivity(intent);		
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
			//return true;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	
	    	if (result)
	    	{
	    		
	    		//lblResultado.setText("" + idCli + "-" + nombCli + "-" + telefCli);
	    	}
	    }
	}
	
	private class TareaWSListarParqueaderos extends AsyncTask<String,Integer,Boolean> {
		private String[] parqueaderos;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();

	    	String sec_id = params[0];
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/parqueaderos";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "sec_id", sec_id ) );
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
		        	
		        	parqueaderos = new String[respJSON.length()];
		        			
		        	for(int i=0; i<respJSON.length(); i++)
		        	{
		        		JSONObject obj = respJSON.getJSONObject(i);
			        	String par_id = obj.getString("par_id");
			        	
			        	parqueaderos[i] = par_id;
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
	        		    new ArrayAdapter<String>(ParkingActivity.this,
	        		        android.R.layout.simple_spinner_dropdown_item, parqueaderos);
	        		 
	        	par_id.setAdapter(adaptador);
	        	par_id.setOnItemSelectedListener(new OnItemSelectedListener() {

					@Override
					public void onItemSelected(AdapterView<?> parent,
							View view, int position, long id) {
						// TODO Auto-generated method stub
						Log.v("click parqueadero","clickee "+parqueaderos[position]);
						
						
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
