package com.example.sipappwatch;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.ContentType;
import org.apache.http.entity.InputStreamEntity;
import org.apache.http.entity.mime.MultipartEntityBuilder;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
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
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.Resources;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.GridLayout;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import com.example.sipappwatch.spot;

public class ParkingActivity extends Activity implements LocationListener {
	
	private static final int TOTAL_COLS=8;
	static int ANPR_REQUEST = 1;
	
	Context context = this;
	
	static String IMG_PATH; //= context.getExternalFilesDir(Environment.DIRECTORY_PICTURES); //"/sdcard/sdk/example/images/";
	private int sec_id;
	private String sec_nombre;
	private int totalSpots=0;
	
	private TextView txtZone;
	private TableLayout tableParking; 
	
	private LinkedHashMap<String, spot> parqueaderos = new LinkedHashMap<String, spot>();
	
	private View dialogViolation;
	private View dialogFree;
	
	private EditText txtPlateNumber;
	private TextView lblPar_id;
	private TextView lblCaptura;
	private TextView lblHora;
	private TextView lblLatitud;
	private TextView lblLongitud;
	
	private double latitude;
	private double longitude;
		
	Map<String, Integer> tiposInfraccion = new HashMap<String, Integer>();
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_parking);
		
		IMG_PATH = context.getExternalFilesDir(Environment.DIRECTORY_PICTURES).toString()+"/"; //"/sdcard/sdk/example/images/";
		
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
        verificarGPS();
        
        
	}

	private void cargarParqueaderos() {
		// TODO Auto-generated method stub
		TareaWSParqueaderosXSector tareaParqueaderosXSector = new TareaWSParqueaderosXSector();
		tareaParqueaderosXSector.execute();
	}	

	private void verificarGPS(){
        LocationManager locationManager = (LocationManager) getSystemService(LOCATION_SERVICE); // Getting LocationManager object from System Service LOCATION_SERVICE
        
        Boolean gps_enabled = null;
        Boolean network_enabled = null;
        try{
            gps_enabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);
        }catch(Exception ex){}
        try{
        	network_enabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
        }catch(Exception ex){}
        
        
        if(!gps_enabled || !network_enabled){
            Builder dialog = new AlertDialog.Builder(this);
            dialog.setMessage("Desea Activar los servicios de localizaci—n?" );
             dialog.setPositiveButton("Ir", new DialogInterface.OnClickListener() {

                 @Override
                 public void onClick(DialogInterface paramDialogInterface, int paramInt) {
                     // TODO Auto-generated method stub
                     startActivityForResult(new Intent(android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS),100);//android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS), 100);
                 }
             });
             dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {

                 @Override
                 public void onClick(DialogInterface paramDialogInterface, int paramInt) {
                     // TODO Auto-generated method stub

                 }
             });
             dialog.show();

        }            
        
        Criteria criteria = new Criteria(); // Creating a criteria object to retrieve provider
        String provider = locationManager.getBestProvider(criteria, true); // Getting the name of the best provider
        Location location = locationManager.getLastKnownLocation(provider); // Getting Current Location
        
        if(location!=null){
            onLocationChanged(location);
        }
        
        locationManager.requestLocationUpdates(provider, 20000, 0, this);
	}
	
    /*Dispara Software ANPR (Reconocimiento de Placas) */
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
		intent.putExtra("ImageSaveDirectory", IMG_PATH);
		
		intent.putExtra("TitleText", "SIP Vigia");	// text on titlebar 
		
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
    
    public void onBtnSpotClick(View pressed){
    	Button button = (Button)pressed;
        String par_id = button.getText().toString();
    	String par_estado_string = parqueaderos.get(par_id).getPar_estado(); 
    	char[] par_estado_char=par_estado_string.toCharArray();
    	char par_estado = par_estado_char[0];
    	
        Builder  dialog = new AlertDialog.Builder(ParkingActivity.this);
    	
    	switch(par_estado){
    		case 'D':
                dialogViolation = View.inflate(ParkingActivity.this, R.layout.dialog_violation, null);
                
		     	txtPlateNumber = (EditText) dialogViolation.findViewById(R.id.TxtPlateNumber);
		     	lblPar_id = (TextView) dialogViolation.findViewById(R.id.LblPar_id);
		     	lblCaptura = (TextView) dialogViolation.findViewById(R.id.LblCaptura);
		     	lblHora = (TextView) dialogViolation.findViewById(R.id.LblHora);
		     	lblLatitud = (TextView) dialogViolation.findViewById(R.id.LblLatitud);
		     	lblLongitud = (TextView) dialogViolation.findViewById(R.id.LblLongitud);		                    

                dialog.setView(dialogViolation);
                
                lblPar_id.setText(par_id);
	    		lblLatitud.setText(String.valueOf(latitude));
	    		lblLongitud.setText(String.valueOf(longitude));	  

	    		// Carga los tipos de infracciones
	    		TareaWSTiposInfracciones cargarTiposInfraccion = new TareaWSTiposInfracciones();
	    		cargarTiposInfraccion.execute();
                
                dialog.setPositiveButton("Reportar", new DialogInterface.OnClickListener() {
                	
                     @Override
                     public void onClick(DialogInterface paramDialogInterface, int paramInt) {
                         // TODO Auto-generated method stub
                    	 TareaWSRegistroInfraccion registrarInfraccion = new TareaWSRegistroInfraccion();
                    	 registrarInfraccion.execute();
                     }
                 });
                 dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {

                     @Override
                     public void onClick(DialogInterface paramDialogInterface, int paramInt) {
                         // TODO Auto-generated method stub

                     }
                 });		                    	 
            	 dialog.show();    			
    		break;
    		case 'R':
 
				dialogFree = View.inflate(ParkingActivity.this, R.layout.dialog_free, null);
				 
				dialog.setView(dialogFree);
				dialog.setPositiveButton("Reportar", new DialogInterface.OnClickListener() {
				
					@Override
				    public void onClick(DialogInterface paramDialogInterface, int paramInt) {
						// TODO Auto-generated method stub
				   	 	//Toast.makeText(ParkingActivity.this, "Se dio click en reportar", Toast.LENGTH_LONG).show();
				   	 	//TareaWSRegistroInfraccion registrarInfraccion = new TareaWSRegistroInfraccion();
				   	 	//registrarInfraccion.execute();
					}
				});
				dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
				    @Override
				    public void onClick(DialogInterface paramDialogInterface, int paramInt) {
				    	// TODO Auto-generated method stub
				       	 
				    }
				});		                    		 
				 
				dialog.show();
        	break;
        	default:
        	break;
    	}
    }
    
	/*Proceso despues del software ANPR */
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data){	// this called when ANPR app finished
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

        	    		String name = IMG_PATH + s + ".jpg";	// photo file on the SD card
        	    		String currentDateTimeString = DateFormat.getDateTimeInstance().format(new Date());
        	    		
        	    		txtPlateNumber.setText(s);
        	    		lblCaptura.setText(name);
        	    		lblHora.setText(currentDateTimeString);
        	    		
	    			    Bitmap bitmap = BitmapFactory.decodeFile(name);
	    			    if (bitmap != null)
	    			    {
		    			    ImageView imageView = (ImageView)dialogViolation.findViewById(R.id.ImgPlate);
		    			    imageView.setImageBitmap(bitmap);
	    			    }
        	    	}
        	    }
            }
        }
    }    
    
	/* Web Services */
	private class TareaWSParqueaderosXSector extends AsyncTask<String,Integer,Boolean> {
		boolean result = false;
		private String message;
		
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://54.209.66.42/violations/public/api/vigilante/sectores/"+sec_id+"/parqueaderos";
			
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
					        	String aut_placa = obj.getString("aut_placa").toUpperCase();
					        	String par_fecha_ingreso = obj.getString("par_fecha_ingreso");
					        	
					        	if(!par_fecha_ingreso.equals("0000-00-00 00:00:00")){
					        		DateFormat format = new SimpleDateFormat("yyyy-MM-d H:m:s", Locale.ENGLISH);
						        	Date date;
									try {
										date = format.parse(par_fecha_ingreso);
										System.out.println("fecha_server "+par_id+"-"+date.toString());
										
										Calendar cal = Calendar.getInstance();
										cal.setTime(date);
										cal.add(Calendar.HOUR, 2);
										Date serverAdjust = cal.getTime();
										
										System.out.println("fecha_ajustada "+par_id+"-"+serverAdjust.toString());
										
										Date current = new Date();
										long diff = current.getTime() - serverAdjust.getTime();
										System.out.println("diferencia "+par_id+"-"+diff);
									} catch (ParseException e) {
										// TODO Auto-generated catch block
										e.printStackTrace();
									}
					        	}
					        					        	
					        	//Crearemos objetos m‡s adelante
					        	spot spot= new spot(par_id,par_estado,par_tipo,aut_placa);
					        	//spot.set
				        		parqueaderos.put(par_id, spot);
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
	    	        final Map.Entry pairs = (Map.Entry)it.next();
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
	    	        
    	        	View buttonSpot = View.inflate(context, R.layout.button_spot, null);
    	        	Button btnSpot = (Button) buttonSpot.findViewById(R.id.BtnSpot);
    	        	TextView txtInfo=(TextView)buttonSpot.findViewById(R.id.TxtInfo);
    	        	
    	        	btnSpot.setText(pairs.getKey().toString());
    	        	
    	        	txtInfo.setText(((spot) pairs.getValue()).getAut_placa());
    	        	if(((spot) pairs.getValue()).getPar_estado().equals("D")){
    	        		if(((spot) pairs.getValue()).getPar_tipo().equals("N")){
    	        			btnSpot.setBackgroundResource(R.drawable.empty);
    	        		}else{
    	        			btnSpot.setBackgroundResource(R.drawable.empty_handicap);
    	        		}
    	        	}else{
    	        		if(((spot) pairs.getValue()).getPar_estado().equals("O")){
    	        			btnSpot.setBackgroundResource(R.drawable.occupied);
    	        		}else{
    	        			btnSpot.setBackgroundResource(R.drawable.violation);
    	        		}
    	        	}    	        	
    	        	
    	        	((spot) pairs.getValue()).setView(buttonSpot);
    	        	
    	        	tableRow.addView(buttonSpot); //button
	    	        
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
	    	
			String url = "http://54.209.66.42/violations/public/api/vigilante/sectores/"+sec_id+"/parqueaderos"; //?par_estado=O
			
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
					        	String aut_placa = obj.getString("aut_placa").toUpperCase();
					        	((spot) parqueaderos.get(par_id)).setPar_estado(par_estado);
					        	((spot) parqueaderos.get(par_id)).setAut_placa(aut_placa);
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
    	        View buttonSpot = ((spot) pairs.getValue()).getView();
    	        Button btnSpot = (Button) buttonSpot.findViewById(R.id.BtnSpot);
    	        TextView txtInfo=(TextView)buttonSpot.findViewById(R.id.TxtInfo);
    	        txtInfo.setText(((spot) pairs.getValue()).getAut_placa());
    	        
    	        if(((spot) pairs.getValue()).getPar_estado().equals("O")){
    	        	btnSpot.setBackgroundResource(R.drawable.occupied);
    	        	
    	        }else{
    	        	if(((spot) pairs.getValue()).getPar_estado().equals("R")){
    	        		btnSpot.setBackgroundResource(R.drawable.violation);
    	        	}else{
    	        		if(((spot) pairs.getValue()).getPar_tipo().equals("N")){
    	        			btnSpot.setBackgroundResource(R.drawable.empty);
    	        		}else{
    	        			btnSpot.setBackgroundResource(R.drawable.empty_handicap);
    	        		}
    	        	}
    	        }
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

	private class TareaWSRegistroInfraccion extends AsyncTask<String,Integer,Boolean> {

		@Override
		protected Boolean doInBackground(String... params) {
			
	    	boolean result = false;
			
			//String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/infracciones";
	    	String url = "http://54.209.66.42/violations/public/api/vigilante/infracciones";

	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpPost post = new HttpPost(url);
			
			try{
				
				File file = new File(lblCaptura.getText().toString());
				
				MultipartEntityBuilder multipartEntity = MultipartEntityBuilder.create();
				multipartEntity.addBinaryBody("image", file, ContentType.create("image/jpeg"), file.getName());
				multipartEntity.addTextBody("par_id", lblPar_id.getText().toString());
				multipartEntity.addTextBody("aut_placa", txtPlateNumber.getText().toString());
				multipartEntity.addTextBody("inf_latitud", lblLatitud.getText().toString());
				multipartEntity.addTextBody("inf_longitud", lblLongitud.getText().toString());
				multipartEntity.addTextBody("inf_fecha", lblHora.getText().toString());
				multipartEntity.addTextBody("tip_inf_id", "3"); //stand by
				
				post.setEntity(multipartEntity.build());
				
				HttpResponse response = httpClient.execute(post);
				int status = response.getStatusLine().getStatusCode();
				
				String responseStr = EntityUtils.toString(response.getEntity());
				
				switch (status){
					case 200: 	//case success		
						
					break;
				}
				
				
			} catch(Exception ex)
			{
				Log.e("ServicioRest","Error!", ex);
	        	result = false;
		    }
	        return result;
		}
		
	}

	private class TareaWSTiposInfracciones extends AsyncTask<String,Integer,Boolean> {
		boolean result = false;
		private String message;
		
		
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://54.209.66.42/violations/public/api/vigilante/categoria_infracciones/1/tipo_infracciones";
			
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
				        	for(int i=0; i<responseJSON.length(); i++)
				        	{
				        		JSONObject obj = responseJSON.getJSONObject(i);
				        		Integer tip_inf_id = obj.getInt("tip_inf_id");
					        	String tip_inf_descripcion = obj.getString("tip_inf_descripcion");
					        	tiposInfraccion.put(tip_inf_descripcion, tip_inf_id);
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
	    		List listaTiposInfraccion = new ArrayList<String>();
	    		
	    	    Iterator it = tiposInfraccion.entrySet().iterator();
	    	    while (it.hasNext()) {
	    	        Map.Entry pairs = (Map.Entry)it.next();
	    	        listaTiposInfraccion.add(pairs.getKey());
	    	    }
	    		
		    	//Rellenamos la lista con los nombres de los clientes
	    		//Rellenamos la lista con los resultados
	        	ArrayAdapter<String> adaptador =
	        		    new ArrayAdapter<String>(context,
	        		        android.R.layout.simple_spinner_dropdown_item, listaTiposInfraccion );
	        	
	        	Spinner spnContravencion = (Spinner)dialogViolation.findViewById(R.id.SpnContravencion);
	        	spnContravencion.setAdapter(adaptador);
	        	
	    	}
	    }
	}
	
	/*Funciones LocationListener*/
	@Override
	public void onLocationChanged(Location location) {
        latitude = location.getLatitude(); 				// Getting latitude of the current location
        longitude = location.getLongitude(); 			// Getting longitude of the current location	                    
        
	}
	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub
		
	}
	@Override
	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub
		
	}
	@Override
	public void onProviderDisabled(String provider) {
		// TODO Auto-generated method stub
		
	}

}
