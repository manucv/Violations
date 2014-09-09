package com.example.sipapp_project;

import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;

import android.content.Intent;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import org.apache.http.NameValuePair;

import org.json.JSONObject;
import android.os.AsyncTask;
import android.util.Log;

import java.net.URI;
import java.net.URISyntaxException;
import java.util.List;
import java.util.ArrayList;



public class MainActivity extends ActionBarActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
        final EditText txtEmail = (EditText)findViewById(R.id.TxtEmail);
        final EditText txtPassword = (EditText)findViewById(R.id.TxtPassword);
        final Button btnLogIn = (Button)findViewById(R.id.BtnLogIn);
        
        btnLogIn.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	
            	TareaWSLogin tarea = new TareaWSLogin();
				tarea.execute(txtEmail.getText().toString(),txtPassword.getText().toString() );            	

            }
       });
		/*if (savedInstanceState == null) {
			getSupportFragmentManager().beginTransaction()
					.add(R.id.container, new PlaceholderFragment()).commit();
		}*/
	}


	private class TareaWSLogin extends AsyncTask<String,Integer,Boolean> {
		
		private String email;
		private String passw;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
	        
			String email = params[0];
			String passw = params[1];
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/login";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "email", email ) );
			paramsArray.add( new BasicNameValuePair( "passw", passw ) );
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
		        	JSONObject respJSON = new JSONObject(respStr);
		        	
		        	if(respStr.length() > 0){
		                 //Creamos el Intent
		                 Intent intent =
		                         new Intent(MainActivity.this, WelcomeActivity.class);

		                 //Creamos la informaci—n a pasar entre actividades
		                 Bundle b = new Bundle();
		                 b.putString("ID", respJSON.getString("cli_id"));
		                 b.putString("NOMBRE", respJSON.getString("cli_nombre"));
		                 b.putString("SALDO", respJSON.getString("cli_saldo"));
		                 
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
	
}
