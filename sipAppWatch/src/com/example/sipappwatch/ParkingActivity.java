package com.example.sipappwatch;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;

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
import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.content.ActivityNotFoundException;
import android.content.ComponentName;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.Resources;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

public class ParkingActivity extends Activity {
	
	private static final int TOTAL_COLS=10;
	static int ANPR_REQUEST = 1;
	private int sec_id;
	private String sec_nombre;
	private int totalSpots=0;
	
	private TextView txtZone;
	private TableLayout tableParking; 
	
	private LinkedHashMap<String, spot> parqueaderos = new LinkedHashMap<String, spot>();
	
	private View dialogViolation;
	
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
	
	private class spot{
		private String par_id;
		private String par_estado;
		private String par_tipo;
		private Button button; 
		
		public spot(String par_id,String par_estado,String par_tipo){
			this.par_id=par_id;
			this.par_estado=par_estado;
			this.par_tipo=par_tipo;
		}
		
		public String getPar_tipo() {
			return par_tipo;
		}

		public void setPar_tipo(String par_tipo) {
			this.par_tipo = par_tipo;
		}

		public Button getButton() {
			return button;
		}

		public void setButton(Button button) {
			this.button = button;
		}

		public String getPar_id() {
			return par_id;
		}

		public void setPar_id(String par_id) {
			this.par_id = par_id;
		}

		public String getPar_estado() {
			return par_estado;
		}

		public void setPar_estado(String par_estado) {
			this.par_estado = par_estado;
		}
		
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
					        	String par_tipo = obj.getString("par_tipo").toUpperCase();
					        						        	
					        	//Crearemos objetos m‡s adelante
				        		parqueaderos.put(par_id, new spot(par_id,par_estado,par_tipo));
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
	    	       	//System.out.println(pairs.getKey() + " = " + pairs.getValue());
	    	        //it.remove(); // avoids a ConcurrentModificationException
	    	        	
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
    	        	
    	        	if(((spot) pairs.getValue()).getPar_estado().equals("D")){
    	        		if(((spot) pairs.getValue()).getPar_tipo().equals("N")){
    	        			button.setBackgroundResource(R.drawable.empty);
    	        		}else{
    	        			button.setBackgroundResource(R.drawable.empty_handicap);
    	        		}
    	        	}else{
    	        		button.setBackgroundResource(R.drawable.occupied);
    	        	}
    	        	
    	        	((spot) pairs.getValue()).setButton(button);
    	        	
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
		            		
		                    dialogViolation = View.inflate(ParkingActivity.this, R.layout.dialog_violation, null);

		                    Builder  dialog = new AlertDialog.Builder(ParkingActivity.this);
		                    dialog.setView(dialogViolation);
		                    //dialog.setView(layout);
		                    dialog.setMessage("Reportar este lugar, ingrese la placa" );
		                    dialog.setPositiveButton("Reportar", new DialogInterface.OnClickListener() {

		                         @Override
		                         public void onClick(DialogInterface paramDialogInterface, int paramInt) {
		                             // TODO Auto-generated method stub
		                             //startActivityForResult(new Intent(android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS),100);//android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS), 100);
		                         }
		                     });
		                     dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {

		                         @Override
		                         public void onClick(DialogInterface paramDialogInterface, int paramInt) {
		                             // TODO Auto-generated method stub

		                         }
		                     });
		                     dialog.show();	   							
							// TODO Auto-generated method stub
							
						}
					});
    	        	tableRow.addView(button);
	    	        
    	        	currentCol++;	
	    	    }
	    	    
	    	    
	    	    //Adicional a esto crear rutina que este constantemente monitoreando los cambios en el mapa de puestos
	    	    /*Let's See*/
	    	    new java.util.Timer().schedule( 
	    	            new java.util.TimerTask() {
	    	                @Override
	    	                public void run() {
	    	                	
		    		    	    TareaWSOcupadosXSector tareaOcupadosXSector = new TareaWSOcupadosXSector();
		    		    	    tareaOcupadosXSector.execute();
	    	                }
	    	            }, 
	    	           5000 
	    	    );

	    	    
	    	}
	    }
	}	
	
	private class TareaWSOcupadosXSector extends AsyncTask<String,Integer,Boolean> {
		boolean result = false;
		private String message;
		
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/sectores/"+sec_id+"/parqueaderos?par_estado=O";
			
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
					        	((spot) parqueaderos.get(par_id)).setPar_estado("O");
					        	
					        	//Button button = ((spot) parqueaderos.get(par_id)).getButton();
					        	//button.setBackgroundResource(R.drawable.occupied);
					        	
					        	//Crearemos objetos m‡s adelante
				        		//parqueaderos.put(par_id, par_estado);
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
	    	
    	    Iterator it = parqueaderos.entrySet().iterator();
    	    
    	    TableRow tableRow = null;
    	    
    	    while (it.hasNext()) {
    	        Map.Entry pairs = (Map.Entry)it.next();
    	        Button button = ((spot) pairs.getValue()).getButton();
    	        if(((spot) pairs.getValue()).getPar_estado().equals("O")){
	    	        button.setBackgroundResource(R.drawable.occupied);
    	        }else{
	        		if(((spot) pairs.getValue()).getPar_tipo().equals("N")){
	        			button.setBackgroundResource(R.drawable.empty);
	        		}else{
	        			button.setBackgroundResource(R.drawable.empty_handicap);
	        		}
    	        }
    	        //	System.out.println(pairs.getKey() + " = " + pairs.getValue());
    	    }     
	    	
	    	if (result)
	    	{
	    		
	    	}
    	    /*Let's See*/
    	    new java.util.Timer().schedule( 
    	           new java.util.TimerTask() {
    	                @Override
    	                public void run() {
	    		    	    TareaWSOcupadosXSector tareaOcupadosXSector = new TareaWSOcupadosXSector();
	    		    	    tareaOcupadosXSector.execute();
    	                }
    	           }, 
    	           5000 
    	    );
	    }
	}
	
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data)	// this called when ANPR app finished
    {
    	if (requestCode == ANPR_REQUEST)	// ANPR app id 
        {
            if (resultCode == RESULT_OK)	// if ANPR app terminated normally 
            {
            	Bundle b = data.getExtras();	// result of ANPR app  (a Bundle var)
        	    if (b != null)
        	    {
        	    	String error = b.getString("Errors");	// in bundle the recognized string
        	    	String s = b.getString("PlateNums");	// in bundle the error string
        	    	if (s != null)
        	    	{
				     	Toast.makeText(ParkingActivity.this, "Placa Indentificada: "+s, Toast.LENGTH_LONG).show();
				     	EditText txtPlateNumber = (EditText) dialogViolation.findViewById(R.id.TxtPlateNumber);
				     	txtPlateNumber.setText(s);
        	    	}
        	    }
            }
        }
    }
    
    public void onBtnCamaraClick(View pressed){
		Intent intent = new Intent("android.intent.action.SEND");
		intent.addCategory("android.intent.category.DEFAULT");
		intent.setComponent(new ComponentName("com.birdorg.anpr.sdk.simple.camera", "com.birdorg.anpr.sdk.simple.camera.ANPRSimpleCameraSDK"));
				    
		intent.putExtra("Orientation", "landscape");
		intent.putExtra("FullScreen", true);
		intent.putExtra("MaxRecognizeNumber", 1);
		
		intent.putExtra("SoundEnable", true);
		intent.putExtra("ResolutionWidth", 960);
		intent.putExtra("ResolutionHeight", 720);
		intent.putExtra("ImageSaveDirectory", "/sdcard/sdk/example/images/");
		
	    try
		{
		    startActivityForResult(intent, ANPR_REQUEST);	// call ANPR app with intent
		}
		catch (ActivityNotFoundException e)		// if ANPR intent not found (not installed)
		{
	     	Toast toast = Toast.makeText(ParkingActivity.this, "The ANPR not installed!", Toast.LENGTH_LONG);
	    	toast.show();    
		}
    }
}
