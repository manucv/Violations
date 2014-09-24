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
import android.content.Context;
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
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.AdapterView.OnItemClickListener;

public class RelatedActivity extends Activity {
	private String cli_id;
	private String saldo;
	private ListView lstContacts;
	private ProgressBar loadingContacts;
	private EditText txtBuscar;
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_related);
        loadingContacts = (ProgressBar)findViewById(R.id.LoadingContacts);
        lstContacts = (ListView)findViewById(R.id.LstContacts);
        
        Bundle bundle = this.getIntent().getExtras();
        cli_id=bundle.getString("ID");
        saldo=bundle.getString("SALDO");
        
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldoContactos);
        txtSaldo.setText("$"+Float.parseFloat(saldo));
        
        TareaWSListarContactos tarea = new TareaWSListarContactos();
		tarea.execute(cli_id);    
		
		
		txtBuscar = (EditText)findViewById(R.id.TxtBuscar);
        Button btnAgregar = (Button)findViewById(R.id.BtnAgregar);
		
        btnAgregar.setOnClickListener(new OnClickListener() {
	            @Override
	            public void onClick(View v) {
	            	loadingContacts.setVisibility(View.VISIBLE);
	            	Log.v("click","click en categorias");
	            	TareaWSAgregarContacto tarea = new TareaWSAgregarContacto();
	            	
					tarea.execute(	cli_id,
									txtBuscar.getText().toString());        
	            }
	       });	
	}
	
	private class TareaWSListarContactos extends AsyncTask<String,Integer,Boolean> {
		private String[] contactos;
		private String[] idContactos;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	String cli_id=params[0];
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
			
			HttpGet del = 
					new HttpGet("http://www.hawasolutions.com/Violations/public/api/api/relacionados/"+cli_id);
			
			del.setHeader("content-type", "application/json");
			
			try
	        {			
	        	HttpResponse resp = httpClient.execute(del);
	        	String respStr = EntityUtils.toString(resp.getEntity());
	        	
	        	if(!respStr.equals("")){
	        		JSONArray respJSON = new JSONArray(respStr);
	        		if(respJSON.length() > 0){
	        			
	        			contactos = new String[respJSON.length()];
	        			idContactos = new String[respJSON.length()];
	        			
	    	        	for(int i=0; i<respJSON.length(); i++)
	    	        	{
	    	        		JSONObject obj = respJSON.getJSONObject(i);
	    		        	String cli_nombre = obj.getString("cli_nombre");
	    		        	String cli_id_relacionado = obj.getString("cli_id_relacionado");
	    		        	
	    		        	contactos[i] = ""+cli_nombre;
	    		        	idContactos[i] = ""+cli_id_relacionado;
	    		        	
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
	    		if(contactos != null && contactos.length > 0){
		        	ArrayAdapter<String> adaptador =
		        		    new ArrayAdapter<String>(RelatedActivity.this,
		        		        android.R.layout.simple_list_item_1, contactos);
		        		 	
		        	lstContacts.setAdapter(adaptador);
		        	lstContacts.setOnItemClickListener(new OnItemClickListener() {
		                 @Override
						public void onItemClick(AdapterView<?> parent, View view, int position,
		                         long id) {
		                	 
		                	
		                         Intent intent =
		                                 new Intent(RelatedActivity.this, TransferActivity.class);
		                         
		                         intent.putExtra("ID",cli_id);
		                         intent.putExtra("CLI_ID_REF",idContactos[position]);
		                         intent.putExtra("CLI_ID_REF_NOMBRE",contactos[position]);
		                         startActivity(intent);	
		                	 
		                 }
		             });        	
	    		}
	        	loadingContacts.setVisibility(View.GONE);

	    	}
	    }
	}	
	
	
	private class TareaWSAgregarContacto extends AsyncTask<String,Integer,Boolean> { 
		private String[] contactos;
		private String[] idContactos;
		
		@Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	String cli_id=params[0];
	    	String cli_email=params[1];
	    	
	    	HttpClient httpClient = new DefaultHttpClient();

	    	String url = "http://www.hawasolutions.com/Violations/public/api/api/relacion/"+cli_id;
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "par_id", cli_id ) );
			paramsArray.add( new BasicNameValuePair( "cli_email", cli_email ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = 
						new HttpGet(uri);
						del.setHeader("content-type", "application/json");	    	
						Log.v("query",uri.toString());
				try
		        {			
		        	HttpResponse resp = httpClient.execute(del);
		        	String respStr = EntityUtils.toString(resp.getEntity());		        	
		        	if(!respStr.equals("")){
		        		JSONArray respJSON = new JSONArray(respStr);
		        		if(respJSON.length() > 0){
		        			
		        			contactos = new String[respJSON.length()];
		        			idContactos = new String[respJSON.length()];
		        			
		    	        	for(int i=0; i<respJSON.length(); i++)
		    	        	{
		    	        		JSONObject obj = respJSON.getJSONObject(i);
		    		        	String cli_nombre = obj.getString("cli_nombre");
		    		        	String cli_id_relacionado = obj.getString("cli_id_relacionado");
		    		        	
		    		        	contactos[i] = ""+cli_nombre;
		    		        	idContactos[i] = ""+cli_id_relacionado;
		    		        	
		    		        }	        			
		        		}else{
		        			return false;
		        		}
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
	        		    new ArrayAdapter<String>(RelatedActivity.this,
	        		        android.R.layout.simple_list_item_1, contactos);
	        		 	
	        	lstContacts.setAdapter(adaptador);
	        	lstContacts.setOnItemClickListener(new OnItemClickListener() {
	                 @Override
					public void onItemClick(AdapterView<?> parent, View view, int position,
	                         long id) {
	                	 
	                	
	                         Intent intent =
	                                 new Intent(RelatedActivity.this, TransferActivity.class);
	                         
	                         intent.putExtra("ID",cli_id);
	                         intent.putExtra("CLI_ID_REF",idContactos[position]);
	                         intent.putExtra("CLI_ID_REF_NOMBRE",contactos[position]);
	                         startActivity(intent);	
	                	 
	                 }
	             });   
	        	loadingContacts.setVisibility(View.GONE);
	        	txtBuscar.setText("");
	        	
	        	
	        	

	    	}else{
				Context context = getApplicationContext();
                CharSequence text = "Usuario no existe";
                int duration = Toast.LENGTH_SHORT;

                Toast toast = Toast.makeText(context, text, duration);
                toast.show();
                
                loadingContacts.setVisibility(View.GONE);
	    	}
	    }
	}		
}
