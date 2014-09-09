package com.example.sipapp_project;


import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.ListView;


public class CategoriesActivity extends Activity{
	private ListView lstCategorias;
	private String cli_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_categories);
        
        lstCategorias = (ListView)findViewById(R.id.LstCategorias);
        
        //Recuperamos la informaci—n pasada en el intent
        Bundle bundle = this.getIntent().getExtras();
        cli_id=bundle.getString("ID");
        TareaWSListar tarea = new TareaWSListar();
		tarea.execute();
   }
	
	private class TareaWSListar extends AsyncTask<String,Integer,Boolean> {
		
		private String[] categorias;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
			
			HttpGet del = 
					new HttpGet("http://www.hawasolutions.com/Violations/public/api/api/categorias");
			
			del.setHeader("content-type", "application/json");
			
			try
	        {			
	        	HttpResponse resp = httpClient.execute(del);
	        	String respStr = EntityUtils.toString(resp.getEntity());
	        	
	        	JSONArray respJSON = new JSONArray(respStr);
	        	
	        	categorias = new String[respJSON.length()];
	        			
	        	for(int i=0; i<respJSON.length(); i++)
	        	{
	        		JSONObject obj = respJSON.getJSONObject(i);
		        	String cat_nombre = obj.getString("cat_nombre");
		        	
		        	categorias[i] = "" + cat_nombre;
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
	        		    new ArrayAdapter<String>(CategoriesActivity.this,
	        		        android.R.layout.simple_list_item_1, categorias);
	        		 
	        	lstCategorias.setAdapter(adaptador);
	        	lstCategorias.setOnItemClickListener(new OnItemClickListener() {
	                 @Override
					public void onItemClick(AdapterView<?> parent, View view, int position,
	                         long id) {
	                     Intent intent = new Intent(CategoriesActivity.this, CategoryActivity.class);
	                     String cat_id = Integer.toString(position+1);
	                     intent.putExtra("CAT_ID", cat_id);
	                     intent.putExtra("CAT_NOMBRE", parent.getItemAtPosition(position).toString());
	                     intent.putExtra("ID",cli_id);
	                     startActivity(intent);

	                 }
	             });
	    	}
	    }
	}	
}
