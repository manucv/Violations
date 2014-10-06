package com.example.sipapp_project;

import java.net.URI;
import java.net.URISyntaxException;
import java.text.SimpleDateFormat;
import java.util.Date;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONObject;
import android.app.Activity;
import android.content.Intent;
import android.net.ParseException;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.util.Log;
import android.widget.TextView;

public class WaitingActivity extends Activity {
	
	private String cli_id;
	private String tra_id;
	private String saldo;
	private String nombre;
	private long pagadas;
	private TextView lblTimer;
	private TextView lblTiempoContratado;
	private long restantes=0;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_waiting);
        
        Bundle bundle = this.getIntent().getExtras();
        cli_id=bundle.getString("ID");
        saldo=bundle.getString("SALDO");
        nombre=bundle.getString("NOMBRE");
        tra_id=bundle.getString("TRA_ID");
        
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldoWaiting);
        txtSaldo.setText("$"+saldo);
        
        lblTimer = (TextView)findViewById(R.id.LblTimer);
        lblTiempoContratado = (TextView)findViewById(R.id.LblTiempoContratado);
        
        TareaWSEstadoParqueo tarea = new TareaWSEstadoParqueo();
		tarea.execute();        
        
        //lblTimer = (TextView)findViewById(R.id.LblTimer);
        //lblTimer.setText(hora);
	}
	
	private class TareaWSEstadoParqueo extends AsyncTask<String,Integer,Boolean> {
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	HttpClient httpClient = new DefaultHttpClient();
			
			String url = "http://www.hawasolutions.com/Violations/public/api/api/estado/"+tra_id;

			URI uri = null;
			try {
				uri = new URI( url);
				HttpGet del = new HttpGet(uri);
				del.setHeader("content-type", "application/json");	    	
	    				
				try
		        {			
		        	HttpResponse resp = httpClient.execute(del);
		        	String respStr = EntityUtils.toString(resp.getEntity());
		        	
		        	JSONObject respJSON = new JSONObject(respStr);
		        	
		        	//Log.v("hora de ingreso",respJSON.getString("log_par_fecha_ingreso"));
		        	//Log.v("horas pagadas",);
		        	
		        	String hora = respJSON.getString("log_par_fecha_ingreso");
		        	pagadas = Integer.parseInt(respJSON.getString("log_par_horas_parqueo"))*3600;
		        	
		            SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		           		            
		            Date ingreso;
		            Date now = new Date();
		            try
		            {
		                ingreso = simpleDateFormat.parse(hora);
		                Log.v("ingreso",""+ingreso);
		                Log.v("fecha actual",""+now);
		                restantes = pagadas-(((now.getTime()-ingreso.getTime())/1000)-3600);
		                
	                	Log.v("segundos restantes",""+restantes);
		            }
		            catch (ParseException ex)
		            {
		                System.out.println("Exception "+ex);
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
	    		lblTiempoContratado.setText("Tiempo Contratado: "+(pagadas/3600));
	    		 long milliseconds=restantes*1000;
	    		 if(restantes > 0){ 
		    		 new CountDownTimer(milliseconds, 1000) {
	
		    		     @Override
						public void onTick(long millisUntilFinished) {
		    		    	long secondsUntilFinished=millisUntilFinished/1000;
			    	    	int hours = (int) secondsUntilFinished / 3600;
	    		    	    int remainder = (int) secondsUntilFinished - hours * 3600;
	    		    	    int mins = remainder / 60;
	    		    	    remainder = remainder - mins * 60;
	    		    	    int secs = remainder;
		    		    	 
		    		    	lblTimer.setText(String.format("%02d", hours)+":"+String.format("%02d", mins)+":"+String.format("%02d", secs));
		    		     }
	
		    		     @Override
						public void onFinish() {
		    		    	lblTimer.setText("Tu Tiempo Ha Expirado");
		    		     }
		    		  }.start();
	    		 }else{
	    			 lblTimer.setText("Tu Tiempo Ha Expirado");
	    		 }
	    	}
	    }
	}		
	
	@Override
	public void onBackPressed()
	{
		
        Intent intent =
                new Intent(WaitingActivity.this, WelcomeActivity.class);

        //Creamos la informaci—n a pasar entre actividades
        Bundle b = new Bundle();
        b.putString("NOMBRE", nombre);
        b.putString("SALDO", saldo);
        b.putString("ID", cli_id);
        
        intent.putExtras(b);

        //Iniciamos la nueva actividad
        startActivity(intent);		
		//return false;
	   // super.onBackPressed(); // Comment this super call to avoid calling finish()
	}	
}
