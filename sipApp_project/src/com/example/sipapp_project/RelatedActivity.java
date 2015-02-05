package com.example.sipapp_project;


import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONObject;


import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
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

public class RelatedActivity extends ParqueaderoActivity {
	private String cli_id;
	private String saldo;
	private ListView lstContacts;
	private ProgressBar loadingContacts;
	private EditText txtBuscar;
	private ArrayAdapter<String> adaptador;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_related);
        loadingContacts = (ProgressBar)findViewById(R.id.LoadingContacts);
        lstContacts = (ListView)findViewById(R.id.LstContacts);
        
        cli_id=super.getCli_id();
        saldo=super.getSaldo();
        
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldoContactos);
        txtSaldo.setText("$"+Float.parseFloat(saldo));
        
        TareaWSListarContactos tarea = new TareaWSListarContactos();
		tarea.execute(cli_id);    
		
		
		txtBuscar = (EditText)findViewById(R.id.TxtBuscar);
        
		txtBuscar.addTextChangedListener(new TextWatcher(){

			@Override
			public void beforeTextChanged(CharSequence s, int start, int count, int after) { }

			@Override
			public void afterTextChanged(Editable s) { 
				try{
					adaptador.getFilter().filter(s);
				}catch(Exception e){
					Toast.makeText(RelatedActivity.this, "Debe agregar un contacto primero", Toast.LENGTH_SHORT).show();
				}
			}
				
			@Override
			public void onTextChanged(CharSequence s, int start, int before, int count) { }
			
		});

		Button btnAgregar = (Button)findViewById(R.id.BtnAgregar);
		
        btnAgregar.setOnClickListener(new OnClickListener() {
	            @Override
	            public void onClick(View v) {
	            		
                    Intent intent = new Intent(RelatedActivity.this, AddContactActivity.class);
                    
                    intent.putExtra("ID",cli_id);
                    intent.putExtra("SALDO",saldo);
                    
                    startActivity(intent);	
	            	
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
					new HttpGet("http://www.hawasolutions.com/Violations2/public/api/api/relacionados/"+cli_id);
			
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
	    		        	String cli_nombre = obj.getString("usu_nombre")+" "+obj.getString("usu_apellido");
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
		        	//adaptador = new ArrayAdapter<String>(RelatedActivity.this, android.R.layout.simple_list_item_1, contactos);
		        	adaptador = new ArrayAdapter<String>(RelatedActivity.this, R.layout.single_row, R.id.LnkTerms, contactos);	 	
		        	lstContacts.setAdapter(adaptador);
		        	lstContacts.setOnItemClickListener(new OnItemClickListener() {
		                 @Override
						public void onItemClick(AdapterView<?> parent, View view, int position,
		                         long id) {
		                	 
		                	
		                         Intent intent =
		                                 new Intent(RelatedActivity.this, TransferActivity.class);
		                         
		                         intent.putExtra("ID",cli_id);
		                         intent.putExtra("SALDO",saldo);
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
}
