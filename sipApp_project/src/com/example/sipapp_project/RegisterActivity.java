package com.example.sipapp_project;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

public class RegisterActivity extends Activity {
	
	private Bundle bundle = new Bundle();
	private Button btnAccount;
	private ProgressBar loadingRegister;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_register);
			
		final EditText txtName = (EditText)findViewById(R.id.TxtName);
		final EditText txtLastName = (EditText)findViewById(R.id.TxtLastName);
		final EditText txtNewEmail = (EditText)findViewById(R.id.TxtNewEmail);
		final EditText txtUser = (EditText)findViewById(R.id.TxtUser);
		final EditText txtNewPassword = (EditText)findViewById(R.id.TxtNewPassword);
		final EditText txtVerifyPassword = (EditText)findViewById(R.id.TxtVerifyPassword);
		final EditText txtPhone = (EditText)findViewById(R.id.TxtPhone);
        btnAccount = (Button)findViewById(R.id.BtnAccount);
		loadingRegister = (ProgressBar)findViewById(R.id.loadingRegister);
		
        loadingRegister.setVisibility(View.GONE);
        
        btnAccount.setOnClickListener(new OnClickListener(){

			@Override
			public void onClick(View v) {
				
				
				if(	!txtName.getText().toString().equals("") &&
					!txtLastName.getText().toString().equals("") &&
					!txtNewEmail.getText().toString().equals("") &&
					!txtUser.getText().toString().equals("") &&
					!txtNewPassword.getText().toString().equals("") &&
					!txtVerifyPassword.getText().toString().equals("") &&
					!txtPhone.getText().toString().equals("")){
				
					if(txtNewPassword.getText().toString().equals(txtVerifyPassword.getText().toString())){
						
						if (isNetworkAvailable()) {
							loadingRegister.setVisibility(View.VISIBLE);
							btnAccount.setVisibility(View.GONE);
							
							TareaWSRegistrar tarea = new TareaWSRegistrar();
							tarea.execute(
								txtName.getText().toString(),
								txtLastName.getText().toString(),
								txtNewEmail.getText().toString(),
								txtUser.getText().toString(),
								txtNewPassword.getText().toString(),
								txtVerifyPassword.getText().toString(),
								txtPhone.getText().toString()
								
							);
						}else{
							Toast.makeText(RegisterActivity.this, "Su  dispositivo no tiene conexi—n a Internet en este momento", Toast.LENGTH_LONG).show();
						}
					} else {
	            		Toast.makeText(RegisterActivity.this, "Ambas contrase–as deben ser iguales", Toast.LENGTH_SHORT).show();
					}
				}else{
					Toast.makeText(RegisterActivity.this, "Por favor llene todos los campos", Toast.LENGTH_SHORT).show();
				}
			}
        });
	}
	
	private class TareaWSRegistrar extends AsyncTask<String,Integer,Boolean> {
		private String message = "";
		@Override
		protected Boolean doInBackground(String... params) {
			boolean result = false;
			
			String url = "http://www.hawasolutions.com/Violations2/public/api/api/clientes";
			String usu_nombre = params[0];		//txtName
			String usu_apellido = params[1];	//txtLastName
			String usu_email = params[2];		//txtNewEmail
			String usu_usuario = params[3];		//txtUser
			String usu_clave = params[4];		//txtPassword
			String cli_movil = params[5];		//txtPhone
			
	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpPost post = new HttpPost(url);
	    	
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "usu_nombre", usu_nombre ) );
			paramsArray.add( new BasicNameValuePair( "usu_apellido", usu_apellido ) );
			paramsArray.add( new BasicNameValuePair( "usu_email", usu_email ) );
			paramsArray.add( new BasicNameValuePair( "usu_usuario", usu_usuario ) );
			paramsArray.add( new BasicNameValuePair( "usu_clave", md5(usu_clave) ) );	
			paramsArray.add( new BasicNameValuePair( "cli_movil", cli_movil ) );	
			
			try{
				post.setEntity(new UrlEncodedFormEntity(paramsArray));
				HttpResponse response = httpClient.execute(post);
				int status = response.getStatusLine().getStatusCode();
				
				Log.v("status",""+status);
				
				switch (status){
					case 200: 	//case success
						String responseStr = EntityUtils.toString(response.getEntity());
						Log.v("resp",responseStr);
						if(!responseStr.equals("")){
							JSONObject responseJSON = new JSONObject(responseStr); 

							bundle.putString("ID", responseJSON.getString("cli_id"));
							bundle.putString("NOMBRE", responseJSON.getString("usu_nombre")+" "+responseJSON.getString("usu_apellido"));
							bundle.putString("SALDO", responseJSON.getString("cli_saldo"));
							
							result = true;
						}else{
							result = false;
							message = "Error al crear el cliente";
						}
					break;	
					case 409: //conflict	
						result = false;
						message = "El email — usuario ya existe";
					break;
					default:
						result = false;
						message = "Error al crear el cliente";
					break;	
				}

				
			} catch (UnsupportedEncodingException e) {
				e.printStackTrace();
			} catch (ClientProtocolException e) {
				e.printStackTrace();
			} catch (IOException e) {
				e.printStackTrace();
			} catch (JSONException e) {
				e.printStackTrace();
			}
			
			return result;
		}
	    @Override
		protected void onPostExecute(Boolean result) {
	    	loadingRegister.setVisibility(View.GONE);
	    	btnAccount.setVisibility(View.VISIBLE);
	    	if(result){
	    		Intent intent = new Intent(RegisterActivity.this, WelcomeActivity.class);
	    		intent.putExtras(bundle);
				startActivity(intent);	
	    	}else{
	    		Toast.makeText(RegisterActivity.this, message, Toast.LENGTH_SHORT).show();
	    	}
	    }
	    
	    protected String md5(String s) {
	    	 try {
	    	        // Create MD5 Hash
	    	        MessageDigest digest = java.security.MessageDigest
	    	                .getInstance("MD5");
	    	        digest.update(s.getBytes());
	    	        byte messageDigest[] = digest.digest();

	    	        // Create Hex String
	    	        StringBuilder hexString = new StringBuilder();
	    	        for (byte aMessageDigest : messageDigest) {
	    	            String h = Integer.toHexString(0xFF & aMessageDigest);
	    	            while (h.length() < 2)
	    	                h = "0" + h;
	    	            hexString.append(h);
	    	        }
	    	        return hexString.toString();

	    	    } catch (NoSuchAlgorithmException e) {
	    	        e.printStackTrace();
	    	    }
	    	    return "";
	    }	
	}
	private boolean isNetworkAvailable() {
	    ConnectivityManager connectivityManager 
	         = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
	    NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
	    return activeNetworkInfo != null;
	}
}
