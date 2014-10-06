package com.example.sipapp_project;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
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
import android.os.AsyncTask;
import android.os.Bundle;
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
					!txtVerifyPassword.getText().toString().equals("") ){
				
					if(txtNewPassword.getText().toString().equals(txtVerifyPassword.getText().toString())){
						loadingRegister.setVisibility(View.VISIBLE);
						btnAccount.setVisibility(View.GONE);
						
						TareaWSRegistrar tarea = new TareaWSRegistrar();
						tarea.execute(
							txtName.getText().toString(),
							txtLastName.getText().toString(),
							txtNewEmail.getText().toString(),
							txtUser.getText().toString(),
							txtNewPassword.getText().toString(),
							txtVerifyPassword.getText().toString()
						);
					} else {
						Context context = getApplicationContext();
						int duration = Toast.LENGTH_SHORT;
		                CharSequence text = "Ambas contrase–as deben ser iguales";
		                Toast toast = Toast.makeText(context, text, duration);
		                toast.show();
					}
				}else{
					Context context = getApplicationContext();
					int duration = Toast.LENGTH_SHORT;
	                CharSequence text = "Por favor llene todos los campos";
	                Toast toast = Toast.makeText(context, text, duration);
	                toast.show();
				}
			}
        });
	}
	
	private class TareaWSRegistrar extends AsyncTask<String,Integer,Boolean> {
		private String message = "";
		@Override
		protected Boolean doInBackground(String... params) {
			boolean result = false;
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/clientes";
			String cli_nombre = params[0];		//txtName
			String cli_apellido = params[1];	//txtLastName
			String cli_email = params[2];		//txtNewEmail
			String cli_user = params[3];		//txtUser
			String cli_passw = params[4];		//txtPassword
			
	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpPost post = new HttpPost(url);
	    	
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "cli_nombre", cli_nombre ) );
			paramsArray.add( new BasicNameValuePair( "cli_apellido", cli_apellido ) );
			paramsArray.add( new BasicNameValuePair( "cli_email", cli_email ) );
			paramsArray.add( new BasicNameValuePair( "cli_user", cli_user ) );
			paramsArray.add( new BasicNameValuePair( "cli_passw", cli_passw ) );	
			
			try{
				post.setEntity(new UrlEncodedFormEntity(paramsArray));
				HttpResponse response = httpClient.execute(post);
				int status = response.getStatusLine().getStatusCode();
				switch (status){
					case 200: 	//case success
						String responseStr = EntityUtils.toString(response.getEntity());
						if(!responseStr.equals("")){
							JSONObject responseJSON = new JSONObject(responseStr); 

							bundle.putString("ID", responseJSON.getString("cli_id"));
							bundle.putString("NOMBRE", responseJSON.getString("cli_nombre"));
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
	    		Context context = getApplicationContext();
				int duration = Toast.LENGTH_SHORT;
                CharSequence text = message;
                Toast toast = Toast.makeText(context, text, duration);
                toast.show();
	    	}
	    }
	}
}
