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
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;

import android.support.v4.app.NotificationCompat;
import android.support.v4.app.TaskStackBuilder;
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
			    	  if(!txtPlaca.getText().toString().equals("") && !txtParqueadero.getText().toString().equals("")){
			    		  
			    		  SmsManager smsManager = SmsManager.getDefault();
			    		  smsManager.sendTextMessage(phoneNo, null, message, null, null);
			    		  
			    		  Toast.makeText(SMSActivity.this, "Su SMS fue enviado exitosamente.", Toast.LENGTH_SHORT).show();
			    		  
			    		  /*Este bloque se debe quitar más adelante*/
			    		  TareaWSComprarSMS tarea = new TareaWSComprarSMS();
			            	
			    		  tarea.execute(  txtParqueadero.getText().toString(),
											txtPlaca.getText().toString(),
											spnHoras.getSelectedItem().toString());
			    		  /*Fin del bloque*/	
			    		  
			    		  /*Envío de Notificación al teléfono*/
			    		  
			    		  	NotificationCompat.Builder mBuilder =
			    			        new NotificationCompat.Builder(SMSActivity.this)
			    			        .setSmallIcon(R.drawable.ic_launcher)
			    			        .setContentTitle("Parqueo Exitoso")
			    			        .setContentText("Tu parqueadero expira en "+spnHoras.getSelectedItem().toString()+" horas");

			    			Intent resultIntent = new Intent(SMSActivity.this, MainActivity.class);

			    			TaskStackBuilder stackBuilder = TaskStackBuilder.create(SMSActivity.this);
			    			stackBuilder.addParentStack(MainActivity.class);
			    			stackBuilder.addNextIntent(resultIntent);
			    			PendingIntent resultPendingIntent =
			    			        stackBuilder.getPendingIntent(
			    			            0,
			    			            PendingIntent.FLAG_UPDATE_CURRENT
			    			        );
			    			mBuilder.setContentIntent(resultPendingIntent);
			    			NotificationManager mNotificationManager =
			    			    (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);
			    			mNotificationManager.notify(001, mBuilder.build());		    		  
			    		  
			    		  /*Fin de Envío de notificación*/
			    		  
			    		  
			    	  }else{
			    		  Toast.makeText(SMSActivity.this, "Debe llenar todos los campos", Toast.LENGTH_SHORT).show();
			    	  }
			         
			      	} catch (Exception e) {
			      		Toast.makeText(SMSActivity.this, "Hubo un error al enviar su SMS.", Toast.LENGTH_SHORT).show();
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
			
			String url = "http://www.hawasolutions.com/Violations2/public/api/api/comprar";
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
	        	
	        	
	        	if(respStr.equals("true")){
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
