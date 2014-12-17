package com.example.sipappwatch;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ActionBar;
import android.app.Activity;
import android.content.res.Resources;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;

public class ParkingActivity extends Activity {
	
	private static final int TOTAL_COLS=10;
	
	private int sec_id;
	private String sec_nombre;
	private int totalSpots=0;
	
	private TextView txtZone;
	private TableLayout tableParking; 
	
	Map<String, String> parqueaderos = new HashMap<String, String>();

	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_parking);
		
		//Controles
        ActionBar actionBar = getActionBar();
        actionBar.setDisplayHomeAsUpEnabled(true);
        txtZone = (TextView) findViewById(R.id.TxtZone);
        tableParking = (TableLayout) findViewById(R.id.TableParking);
        
        //Informaci—n del Intent Anterior
        Bundle bundle = this.getIntent().getExtras();
        sec_id=bundle.getInt("SEC_ID");		
        sec_nombre=bundle.getString("SEC_NOMBRE");
        
        txtZone.setText("Sector: "+sec_nombre);
		
        cargarParqueaderos();
	}

	private void cargarParqueaderos() {
		// TODO Auto-generated method stub
		TareaWSParqueaderosXSector tareaParqueaderosXSector = new TareaWSParqueaderosXSector();
		tareaParqueaderosXSector.execute();
		
		
	}	
	
	private class TareaWSParqueaderosXSector extends AsyncTask<String,Integer,Boolean> {
		boolean result = false;
		private String message;
		
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/sectores/"+sec_id+"/parqueaderos";
			
	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpGet get = new HttpGet(url);
			
			try {

				HttpResponse response = httpClient.execute(get);
				int status = response.getStatusLine().getStatusCode();
				
				switch (status){
					case 200: 	//case success
						String responseStr = EntityUtils.toString(response.getEntity());
						if(!responseStr.equals("")){
							JSONArray responseJSON = new JSONArray(responseStr); 
							
							totalSpots=responseJSON.length();
				        	
							for(int i=0; i<totalSpots; i++)
				        	{
				        		JSONObject obj = responseJSON.getJSONObject(i);
				        		String par_id = obj.getString("par_id");
					        	String par_estado = obj.getString("par_estado").toUpperCase();
					        	
					        	//Crearemos objetos m‡s adelante
				        		parqueaderos.put(par_id, par_estado);
				        	}
							
							result = true;
						}else{
							result = false;
							message = "Error al consultar los sectores";
						}
					break;
					default:
						result = false;
						message = "Error al consultar los sectores";			
					break;
				}

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
	 
	        return result;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
	    	if (result)
	    	{	
	    		int rows=(int) Math.ceil(totalSpots/TOTAL_COLS);
	    		int currentCol=0;
	    	    Iterator it = parqueaderos.entrySet().iterator();
	    	    
	    	    TableRow tableRow = null;
	    	    
	    	    while (it.hasNext()) {
	    	        Map.Entry pairs = (Map.Entry)it.next();
	    	        System.out.println(pairs.getKey() + " = " + pairs.getValue());
	    	        it.remove(); // avoids a ConcurrentModificationException
	    	        	
	    	        if(currentCol==TOTAL_COLS){
    	        		currentCol=0;
    	        	}
	    	        	
    	        	if(currentCol==0){
    	        		tableRow = new TableRow(ParkingActivity.this);
    	        		tableRow.setLayoutParams(new TableLayout.LayoutParams(
    	        				TableLayout.LayoutParams.MATCH_PARENT,
    	        				TableLayout.LayoutParams.MATCH_PARENT,
    	        				1.0f
    	        				));
    	        		tableParking.addView(tableRow);
    	        	}
	    	        
    	        	Button button=new Button(ParkingActivity.this);
    	        	button.setLayoutParams(new TableRow.LayoutParams(
    	        			TableRow.LayoutParams.MATCH_PARENT,
    	        			TableRow.LayoutParams.MATCH_PARENT,
	        				1.0f
	        				));
    	        	
    	        	button.setText(""+pairs.getKey());
    	        	if(pairs.getValue().equals("D")){
    	        		button.setBackgroundResource(R.drawable.empty);
    	        	}else{
    	        		button.setBackgroundResource(R.drawable.occupied);
    	        	}
    	        	
    	        	//Funciona desde el API 16
    	        	/*int newWidth=button.getWidth();
    	        	int newHeight=button.getHeight();
    	        	Bitmap originalBitmap = BitmapFactory.decodeResource(getResources(), R.drawable.empty);
    	        	Bitmap scaledBitmap = Bitmap.createScaledBitmap(originalBitmap, newWidth, newHeight, true);
    	        	Resources resource = getResources();
    	        	button.setBackground(new BitmapDrawable(resource,scaledBitmap));*/
    	        	
    	        	button.setOnClickListener(new View.OnClickListener() {
						
						@Override
						public void onClick(View v) {
							// TODO Auto-generated method stub
							
						}
					});
    	        	tableRow.addView(button);
	    	        
    	        	currentCol++;	
	    	    }
	    	}
	    }
	}		
}
