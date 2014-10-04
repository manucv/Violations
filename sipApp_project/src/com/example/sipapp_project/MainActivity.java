package com.example.sipapp_project;

import android.support.v7.app.ActionBarActivity;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import android.content.Context;
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
	private ProgressBar progressBar;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
        final EditText txtEmail = (EditText)findViewById(R.id.TxtEmail);
        final EditText txtPassword = (EditText)findViewById(R.id.TxtPassword);
        final Button btnLogIn = (Button)findViewById(R.id.BtnLogIn);
        final Button btnSignIn = (Button)findViewById(R.id.BtnSignIn);
        
        final TextView lblSMS = (TextView)findViewById(R.id.LblSMS);
        
        progressBar = (ProgressBar)findViewById(R.id.loadingLogin);
        progressBar.setVisibility(View.GONE);
        btnLogIn.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	
            	if(txtEmail.getText().toString().equals("") || txtPassword.getText().toString().equals("")){
            		
            		Context context = getApplicationContext();
                    CharSequence text = "Ingrese su usuario y contrase–a";
                    int duration = Toast.LENGTH_SHORT;

                    Toast toast = Toast.makeText(context, text, duration);
                    toast.show();
                    
                    progressBar.setVisibility(View.GONE);
	                
            	}else{
            		progressBar.setVisibility(View.VISIBLE);
            		
	            	TareaWSLogin tarea = new TareaWSLogin();
					tarea.execute(txtEmail.getText().toString(),txtPassword.getText().toString() );
            	}

            }
       });
        
        btnSignIn.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, RegisterActivity.class);
                startActivity(intent);
            }
       });    
        
       lblSMS.setOnClickListener(new OnClickListener() {
           @Override
           public void onClick(View v) {
        	   Intent sendIntent = new Intent(Intent.ACTION_VIEW);         
        	   sendIntent.setData(Uri.parse("sms:"));
        	   sendIntent.setType("vnd.android-dir/mms-sms"); 
        	   sendIntent.putExtra("address", "0995867216");
        	   sendIntent.putExtra("sms_body", "PARQUEO"); 
        	   startActivity(sendIntent);
           }
      });    

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
			
			//String url = "http://www.hawasolutions.com/Violations/public/api/api/login";
			String url = "http://www.hawasolutions.com/Violations/public/api/api/login";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "email", email ) );
			paramsArray.add( new BasicNameValuePair( "passw", passw ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = 
						new HttpGet(uri);
				Log.v("query",uri.toString());
				del.setHeader("content-type", "application/json");
				
				try
		        {			
		        	HttpResponse resp = httpClient.execute(del);
		        	String respStr = EntityUtils.toString(resp.getEntity());
		        	Log.v("result",respStr);
		        	if(!respStr.equals("")){
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
			        	}else{
			        		return false;
			        	}
		        	}else{
		        		return false;
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
	    	
	    	if (result){
	    		Log.v("resultado", result.toString());
	    		//lblResultado.setText("" + idCli + "-" + nombCli + "-" + telefCli);
	    	}else{
				Context context = getApplicationContext();
                CharSequence text = "Usuario o Contrasena Incorrectos";
                int duration = Toast.LENGTH_SHORT;

                Toast toast = Toast.makeText(context, text, duration);
                toast.show();
                
                progressBar.setVisibility(View.GONE);
	    	}
	    }
	}
	
	@Override
	public void onBackPressed()
	{
        //finish();
	}
}
