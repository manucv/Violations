package com.sip.sipapp_project;

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

import com.sip.sipapp_project.R;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

public class AddContactActivity extends ParqueaderoActivity {
	
	private String cli_id;
	private String saldo;
	private TextView txtSearchContact;
	private ProgressBar progressBar;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_addcontact);
        
		super.txtSaldo = (TextView)findViewById(R.id.TxtSaldo);
        txtSearchContact = (TextView)findViewById(R.id.TxtSearchContact);
        progressBar = (ProgressBar)findViewById(R.id.loadingAddContact);
        
        progressBar.setVisibility(View.GONE);

        cli_id=super.getCli_id();		
        saldo=super.getSaldo();

        
		Button btnAddContact = (Button)findViewById(R.id.BtnAddContact);
		
		btnAddContact.setOnClickListener(new OnClickListener() {
	            @Override
	            public void onClick(View v) {
	            	progressBar.setVisibility(View.VISIBLE);
	            	TareaWSAgregarContacto tarea = new TareaWSAgregarContacto();
					tarea.execute(	cli_id, txtSearchContact.getText().toString());        
	            }
	    });
        
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

	    	String url = "http://54.69.247.99/Violations/public/api/api/relacion/"+cli_id;
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
		    		        	String cli_nombre = obj.getString("usu_nombre")+" "+obj.getString("usu_apellido");
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
            	progressBar.setVisibility(View.GONE);
                Intent intent = new Intent(AddContactActivity.this, RelatedActivity.class);
                intent.putExtra("ID",cli_id);
                intent.putExtra("SALDO",saldo);
                startActivity(intent);	
	    	}else{
            	progressBar.setVisibility(View.GONE);
	    		Toast.makeText(AddContactActivity.this, "Usuario no existe", Toast.LENGTH_SHORT).show();
	    	}
	    }
	}	
	public void onCancelAddContactClick (View pressed){
        Intent intent = new Intent(AddContactActivity.this, RelatedActivity.class);
        intent.putExtra("ID",cli_id);
        intent.putExtra("SALDO",saldo);
        startActivity(intent);
        finish();
	}	
}
