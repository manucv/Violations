package com.example.sipapp_project;

import java.net.URI;
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
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

public class SMSActivity extends Activity {
	
	private Button btnSendSMS;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sms);
		final EditText txtPlaca = (EditText)findViewById(R.id.TxtSMSPlaca);
		final EditText txtParqueadero = (EditText)findViewById(R.id.TxtSMSParqueadero);
		final Spinner spnHoras = (Spinner)findViewById(R.id.SpnSMSHoras);
		
		btnSendSMS = (Button)findViewById(R.id.BtnSMSEnviar);
		
		btnSendSMS.setOnClickListener(new OnClickListener(){

			@Override
			public void onClick(View v) {
			      Log.i("Send SMS", "");

			      String phoneNo = "0995661449";
			      String message = txtPlaca.getText().toString()+"\n"+txtParqueadero.getText().toString()+"\n"+spnHoras.getSelectedItem().toString();

			      try {
			         SmsManager smsManager = SmsManager.getDefault();
			         smsManager.sendTextMessage(phoneNo, null, message, null, null);
			         Toast.makeText(getApplicationContext(), "SMS Enviado.",
			         Toast.LENGTH_LONG).show();
			         
			         TareaWSComprarSMS tarea = new TareaWSComprarSMS();
		            	
						tarea.execute(  txtParqueadero.getText().toString(),
										txtPlaca.getText().toString(),
										spnHoras.getSelectedItem().toString());       			         
			         
			      	} catch (Exception e) {
			         Toast.makeText(getApplicationContext(),
			         "Hubo un error en el env’o del SMS.",
			         Toast.LENGTH_LONG).show();
			         e.printStackTrace();
			      	}
			}
        });
	}
	
	private class TareaWSComprarSMS extends AsyncTask<String,Integer,Boolean> {
		
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
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/comprar";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "par_id", par_id ) );
			paramsArray.add( new BasicNameValuePair( "aut_placa", aut_placa ) );
			paramsArray.add( new BasicNameValuePair( "log_par_horas_parqueo", log_par_horas_parqueo ) );
			URI uri = null;
			
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = new HttpGet(uri);
				del.setHeader("content-type", "application/json");
		
	        	HttpResponse resp = httpClient.execute(del);
	        	String respStr = EntityUtils.toString(resp.getEntity());		        	
	        	JSONObject respJSON = new JSONObject(respStr);
		        	
	        	if(respStr.length() > 0){
	                 //Creamos el Intent
	                 Intent intent = new Intent(SMSActivity.this, MainActivity.class);
	                 //Iniciamos la nueva actividad
	                 startActivity(intent);		
	        	}
		        	
	        } catch(Exception ex) {
	        	Log.e("ServicioRest","Error!", ex);
	        	resul = false;
			}
	 
	        return resul;
			//return true;
	    }
	}	
}
