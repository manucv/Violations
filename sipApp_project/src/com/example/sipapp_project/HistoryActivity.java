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
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.AdapterView.OnItemSelectedListener;

public class HistoryActivity extends Activity {
	private String cli_id;
	private ListView lstHistory;
	private ProgressBar loadingHistory;
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_history);

        loadingHistory = (ProgressBar)findViewById(R.id.loadingHistory);
        
        
        lstHistory = (ListView)findViewById(R.id.LstHistory);
        
        Bundle bundle = this.getIntent().getExtras();
        cli_id=bundle.getString("ID");
        
        TareaWSListarHistorial tarea = new TareaWSListarHistorial();
		tarea.execute(cli_id);
		
   }
	
	private class TareaWSListarHistorial extends AsyncTask<String,Integer,Boolean> {
		private String[] transacciones;
		private String[] idTransacciones;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	String cli_id=params[0];
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
			
			HttpGet del = 
					new HttpGet("http://www.hawasolutions.com/Violations/public/api/api/historial/"+cli_id);
			
			del.setHeader("content-type", "application/json");
			
			try
	        {			
	        	HttpResponse resp = httpClient.execute(del);
	        	String respStr = EntityUtils.toString(resp.getEntity());
	        	
	        	if(!respStr.equals("")){
	        		JSONArray respJSON = new JSONArray(respStr);
	        		if(respJSON.length() > 0){
	        			
	        			transacciones = new String[respJSON.length()];
	        			
	    	        	for(int i=0; i<respJSON.length(); i++)
	    	        	{
	    	        		JSONObject obj = respJSON.getJSONObject(i);
	    		        	String tra_valor = obj.getString("tra_valor");
	    		        	String par_id = obj.getString("par_id");
	    		        	String aut_placa = obj.getString("aut_placa");
	    		        	String sec_nombre = obj.getString("sec_nombre");
	    		        	String ciu_nombre = obj.getString("ciu_nombre");
	    		        	//String est_nombre = obj.getString("est_nombre");
	    		        	//String pai_nombre = obj.getString("pai_nombre");
	    		        	
	    		        	
	    		        	transacciones[i] = "Costo $" + tra_valor +".00\n"+
	    		        					ciu_nombre.toUpperCase()+" - "+sec_nombre.toUpperCase()+"\n" +
	    		        					"Espacio: "+par_id.toUpperCase()+" Placa:"+aut_placa.toUpperCase();
	    		        	
	    		        }	        			
	        		}
	        	}
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
	    	if (result)
	    	{
		    	//Rellenamos la lista con los nombres de los clientes
	    		//Rellenamos la lista con los resultados
	        	ArrayAdapter<String> adaptador =
	        		    new ArrayAdapter<String>(HistoryActivity.this,
	        		        android.R.layout.simple_list_item_1, transacciones);
	        		 	
	        	lstHistory.setAdapter(adaptador);
	        	loadingHistory.setVisibility(View.GONE);

	    	}
	    }
	}
}
