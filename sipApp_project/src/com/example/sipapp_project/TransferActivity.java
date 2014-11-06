package com.example.sipapp_project;

import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

public class TransferActivity extends ParqueaderoActivity {
	private String cli_id;
	private String saldo;
	private String cli_id_ref;
	private String cli_id_ref_nombre;
	private ProgressBar loadingTransfer;
	private EditText txtTransferValue;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_transfer);
        
		Bundle bundle = this.getIntent().getExtras();
        cli_id=bundle.getString("ID");
        cli_id_ref=bundle.getString("CLI_ID_REF");
        cli_id_ref_nombre=bundle.getString("CLI_ID_REF_NOMBRE");
        loadingTransfer = (ProgressBar)findViewById(R.id.LoadingTransfer);
        loadingTransfer.setVisibility(View.GONE);
        TextView lblReferencedClient = (TextView)findViewById(R.id.LblReferencedClient);
        lblReferencedClient.setText(cli_id_ref_nombre);
        
        Button btnTransfer = (Button)findViewById(R.id.BtnTransfer);
        txtTransferValue = (EditText)findViewById(R.id.TxtTransferValue);
        
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldoTransfer);
        cli_id=super.getCli_id();		
        saldo=super.getSaldo();
        
        txtSaldo.setText("$"+Float.parseFloat(saldo));
        
        btnTransfer.setOnClickListener(new OnClickListener() {
	            @Override
	            public void onClick(View v) {
	            	if(Float.parseFloat(txtTransferValue.getText().toString())>0 && Float.parseFloat(txtTransferValue.getText().toString())<Float.parseFloat(saldo)){
	            		loadingTransfer.setVisibility(View.VISIBLE);
		            	TareaWSTransferirSaldo tarea = new TareaWSTransferirSaldo();
						tarea.execute(	cli_id_ref, txtTransferValue.getText().toString());        
	            	}else{
	            		Toast.makeText(TransferActivity.this, "Tu saldo debe ser superior al valor a transferir", Toast.LENGTH_SHORT).show();
	            	}
	            }
	       });
        
	}
	
	private class TareaWSTransferirSaldo extends AsyncTask<String,Integer,Boolean> { 
		
		@Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	String cli_id_para=params[0];
	    	String tra_sal_valor=params[1];
	    	
	    	HttpClient httpClient = new DefaultHttpClient();

	    	String url = "http://www.hawasolutions.com/Violations2/public/api/api/transferir/"+cli_id;
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "cli_id_para", cli_id_para ) );
			paramsArray.add( new BasicNameValuePair( "tra_sal_valor", tra_sal_valor ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = 
						new HttpGet(uri);
						del.setHeader("content-type", "application/json");	    	
						Log.v("query",uri.toString());
						
	        	HttpResponse resp = httpClient.execute(del);
	        	String respStr = EntityUtils.toString(resp.getEntity());		        	
	        	JSONObject respJSON = new JSONObject(respStr);
	        	
	        	if(respStr.length() > 0){
	                 //Creamos el Intent
	                 Intent intent =
	                         new Intent(TransferActivity.this, WelcomeActivity.class);

	                 //Creamos la informaci—n a pasar entre actividades
	                 Bundle b = new Bundle();
	                 b.putString("NOMBRE", respJSON.getString("usu_nombre")+" "+respJSON.getString("usu_apellido"));
	                 b.putString("SALDO", respJSON.getString("cli_saldo"));
	                 b.putString("ID", respJSON.getString("cli_id"));
	                 //A–adimos la informaci—n al intent
	                 intent.putExtras(b);

	                 //Iniciamos la nueva actividad
	                 startActivity(intent);		
	        	}
	
			} catch (URISyntaxException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (ClientProtocolException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	 
	 
	        return resul;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	loadingTransfer.setVisibility(View.GONE);
	    }
	}			
}
