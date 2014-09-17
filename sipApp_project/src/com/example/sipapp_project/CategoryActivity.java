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
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

public class CategoryActivity extends Activity {
	private ListView lstEstablecimientos;
	private String cat_id;
	private String cli_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_category);
        
        TextView lblCategoria = (TextView)findViewById(R.id.LblCategoria);
        
        Bundle bundle = this.getIntent().getExtras();

        //Construimos el mensaje a mostrar
        lblCategoria.setText(bundle.getString("CAT_NOMBRE"));
        cat_id=bundle.getString("CAT_ID");
        cli_id=bundle.getString("ID");
        lstEstablecimientos = (ListView)findViewById(R.id.LstEstablecimientos);
        

        TareaWSListarEstablecimiento tarea = new TareaWSListarEstablecimiento();
		tarea.execute(bundle.getString("CAT_ID"));    
   }
	
	private class TareaWSListarEstablecimiento extends AsyncTask<String,Integer,Boolean> {
		
		private String[] establecimientos;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
			
			HttpGet del = 
					new HttpGet("http://www.hawasolutions.com/Violations/public/api/api/categorias/"+params[0]);
			
			del.setHeader("content-type", "application/json");
			
			try
	        {			
	        	HttpResponse resp = httpClient.execute(del);
	        	String respStr = EntityUtils.toString(resp.getEntity());
	        	
	        	JSONArray respJSON = new JSONArray(respStr);
	        	
	        	establecimientos = new String[respJSON.length()];
	        			
	        	for(int i=0; i<respJSON.length(); i++)
	        	{
	        		JSONObject obj = respJSON.getJSONObject(i);
		        	String est_nombre = obj.getString("est_nombre");
		        	
		        	establecimientos[i] = "" + est_nombre;
		        	Log.v("campo",est_nombre);
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
	        		    new ArrayAdapter<String>(CategoryActivity.this,
	        		        android.R.layout.simple_list_item_1, establecimientos);
	        		 
	        	lstEstablecimientos.setAdapter(adaptador);
	        	lstEstablecimientos.setOnItemClickListener(new OnItemClickListener() {
	                 @Override
					public void onItemClick(AdapterView<?> parent, View view, int position,
	                         long id) {
	                	 Log.v("click","click parqueadero"+cat_id+"-"+position);
	                	 if(cat_id.equals("1") && position==0){
	                		 Log.v("click","entro");
	                         Intent intent =
	                                 new Intent(CategoryActivity.this, ParkingActivity.class);
	                         
	                         intent.putExtra("ID",cli_id);
	                         
	                         startActivity(intent);	
	                	 }
	                 }
	             });
	    	}
	    }
	}	
}
