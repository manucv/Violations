package com.example.sipappwatch;

import java.io.File;
import java.io.IOException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.ContentType;
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
import android.bluetooth.BluetoothAdapter;
import android.content.ActivityNotFoundException;
import android.content.ComponentName;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.provider.MediaStore.MediaColumns;
import android.util.Log;
import android.view.Gravity;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup.LayoutParams;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import com.example.sipappwatch.Spot;
import com.example.tscdll.TSCActivity;

public class ParkingActivity extends Activity implements LocationListener {
	
	private static final int TOTAL_COLS=8;
	static final int ANPR_REQUEST = 1;
	static final int REQUEST_IMAGE_CAPTURE = 2;
	static final int REQUEST_ENABLE_BT = 3;
	public static final String PREFS_NAME = "Configuration";


	Context context = this;
	
	static String IMG_PATH; //= context.getExternalFilesDir(Environment.DIRECTORY_PICTURES); //"/sdcard/sdk/example/images/";
	private int sec_id;
	private String sec_nombre;
	private int totalSpots=0;
	
	private TextView txtZone;
	private TableLayout tableParking; 
	
	private LinkedHashMap<String, Spot> parqueaderos = new LinkedHashMap<String, Spot>();
	
	private View dialogViolation;
	private View dialogFree;
	private View dialogSelect;
	private View dialogTicket;
	
	private EditText txtPlateNumber;
	private TextView lblPar_id;
	private String captura;
	private TextView lblHora;
	private Spinner spnContravencion;
	
	private double latitude;
	private double longitude;
	
	private EditText txtObservation;
	Map<String, InfractionType> tiposInfraccion = new LinkedHashMap<String, InfractionType>();
	String mCurrentPhotoPath;
	private int proofCount=0;
	String par_id;
	
	File proofImage1;
	File proofImage2;
	File proofImage3;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_parking);
		
		//tiposInfraccion.put("-- Seleccione el Tipo de Infracción --", 0);
		
		IMG_PATH = context.getExternalFilesDir(Environment.DIRECTORY_PICTURES).toString()+"/"; //"/sdcard/sdk/example/images/";
		
		//Controles
        //ActionBar actionBar = getSupportActionBar();
        //actionBar.setDisplayHomeAsUpEnabled(true);
        txtZone = (TextView) findViewById(R.id.TxtZone);
        tableParking = (TableLayout) findViewById(R.id.TableParking);
        //Informacion del Intent Anterior
        Bundle bundle = this.getIntent().getExtras();
        sec_id=bundle.getInt("SEC_ID");		
        sec_nombre=bundle.getString("SEC_NOMBRE");
        
        txtZone.setText("Sector: "+sec_nombre);
		
        cargarParqueaderos();
        verificarGPS();
        verificarBluetooth();
	}
	
    @Override
    public boolean onOptionsItemSelected(MenuItem item){
    	super.onOptionsItemSelected(item);
    	Intent intent=null;
    	switch(item.getItemId()){
		    case android.R.id.home:
		    	intent = new Intent(context,ZonesActivity.class);
		    break;
    	}
    	if(intent != null){
    		intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);            
	        startActivity(intent);
	        finish();
    	}
    	return super.onOptionsItemSelected(item);    	
    	
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
            dialog.setMessage("Desea Activar los servicios de localización?" );
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
	
	private void verificarBluetooth(){
		BluetoothAdapter mBluetoothAdapter = BluetoothAdapter.getDefaultAdapter();
		if (mBluetoothAdapter == null) {
			Toast.makeText(context, "El dispositivo no cuenta con bluetooth", Toast.LENGTH_LONG).show();
		}
		if (!mBluetoothAdapter.isEnabled()) {
		    Intent enableBtIntent = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
		    startActivityForResult(enableBtIntent, REQUEST_ENABLE_BT);
		}
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
    	par_id = button.getText().toString();
    	String par_estado_string = parqueaderos.get(par_id).getPar_estado();
    	final int inf_id = parqueaderos.get(par_id).getInf_id();
    	char[] par_estado_char=par_estado_string.toCharArray();
    	char par_estado = par_estado_char[0];
    	
    	String par_tipo_string = parqueaderos.get(par_id).getPar_tipo();
    	char[] par_tipo_char=par_tipo_string.toCharArray();
    	char par_tipo = par_tipo_char[0];
    	
    	AlertDialog.Builder  dialog = new AlertDialog.Builder(context);
        proofCount=0;
        
    	
		switch(par_estado){
    		case 'D':
    			switch(par_tipo){
    				case 'V':
    					violationDialog();
					break;
    				default:
    	    			dialog.setTitle("Qué desea realizar?");
    	    			dialogSelect = View.inflate(context, R.layout.dialog_select, null);    			
    	    			dialog.setView(dialogSelect);
    					dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
    						@Override
    						public void onClick(DialogInterface paramDialogInterface, int paramInt) {
    						      // TODO Auto-generated method stub
    						}
    					});	
    					dialog.show();
    	    				
					break;	
    			}

    		break;
    		case 'R':
 
				dialogFree = View.inflate(ParkingActivity.this, R.layout.dialog_free, null);
				txtObservation = (EditText) dialogFree.findViewById(R.id.TxtObservation);
				
				dialog.setTitle("Liberar Parqueadero");
				
				dialog.setView(dialogFree);
				dialog.setPositiveButton("Reportar", new DialogInterface.OnClickListener() {
				
					@Override
				    public void onClick(DialogInterface paramDialogInterface, int paramInt) {
						//Toast.makeText(ParkingActivity.this, ">"+inf_if, Toast.LENGTH_LONG).show();

						// TODO Auto-generated method stub
				   	 	//Toast.makeText(ParkingActivity.this, "Se dio click en reportar", Toast.LENGTH_LONG).show();
				   	 	TareaWSLiberarParqueadero liberarParqueadero = new TareaWSLiberarParqueadero();
				   	 	liberarParqueadero.execute(par_id,txtObservation.getText().toString());	//Revisar
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
    
    public void onViolationClick(View pressed){
    	violationDialog();
    }	
    public void violationDialog(){
        Builder  dialog = new AlertDialog.Builder(context);
        dialog.setTitle("Registrar Infracción");
	    dialogViolation = View.inflate(ParkingActivity.this, R.layout.dialog_violation, null);
	      
	   	txtPlateNumber = (EditText) dialogViolation.findViewById(R.id.TxtPlateNumber);
	   	lblPar_id = (TextView) dialogViolation.findViewById(R.id.LblPar_id);
	   	lblHora = (TextView) dialogViolation.findViewById(R.id.LblHora);		                    
	
	   	dialog.setView(dialogViolation);
	      
   		lblPar_id.setText(par_id);
   		String currentDateTimeString = DateFormat.getDateTimeInstance().format(new Date());
		lblHora.setText(currentDateTimeString);	  
		
		spnContravencion = (Spinner)dialogViolation.findViewById(R.id.SpnContravencion);
		
		// Carga los tipos de infracciones
		TareaWSTiposInfracciones cargarTiposInfraccion = new TareaWSTiposInfracciones();
		cargarTiposInfraccion.execute();
		
		
		spnContravencion.setOnItemSelectedListener(new OnItemSelectedListener() {

			@Override
			public void onItemSelected(AdapterView<?> parent, View view,
					int position, long id) {
				// TODO Auto-generated method stub
//				if(position > 0){
//					String type = spnContravencion.getSelectedItem().toString();
//					InfractionType type_obj = tiposInfraccion.get(type);
//					TextView lblLegal = (TextView) dialogViolation.findViewById(R.id.lblLegal);
//					lblLegal.setText(type_obj.getTip_inf_legal());
//					//Toast.makeText(context, type_obj.getTip_inf_legal(), Toast.LENGTH_LONG).show();
//				}
			}

			@Override
			public void onNothingSelected(AdapterView<?> parent) {
				// TODO Auto-generated method stub
			}
			
		});
	      
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
     	//Toast.makeText(context, "Click en Ticket", Toast.LENGTH_LONG).show();

    }
    
    public void printTicket(){
    	
	    Calendar c = Calendar.getInstance();
	    SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
	    String formattedDate = df.format(c.getTime());
	    
		SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
		String printer_mac = settings.getString("printer_mac","");
		 
		String type = spnContravencion.getSelectedItem().toString();
		InfractionType type_obj = tiposInfraccion.get(type);


		TSCActivity TscDll;
		try {
			TscDll = new TSCActivity();
			TscDll.openport(printer_mac);
			if(TscDll!=null){
					//String status = TscDll.status();
					//Toast.makeText(context, status, Toast.LENGTH_LONG).show();
					
					//TscDll.downloadbmp("mono_ibarra6.bmp");
					
					TscDll.setup(55, 170, 2, 10, 0, 0, 0);
					TscDll.clearbuffer();	
					int lnCount=0;
					int lnSize=50;
					int prntStart=250;
					
					TscDll.sendcommand("DIRECTION 0\n");
					TscDll.sendcommand("PUTBMP 100,10,\"mono_ibarra6.bmp\",8,100\n");
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"SIP Parking Solution\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"GAD Ibarra Ecuador\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Fecha: "+formattedDate+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Placa: "+txtPlateNumber.getText().toString()+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Parqueadero: "+par_id+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Motivo:\"\n");
					lnCount++;
					TscDll.sendcommand("BLOCK 10,"+(prntStart+(lnSize*lnCount))+",420,50,\"2\",0,1,1,\""+type+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Base Legal:\"\n");
					lnCount++;
					TscDll.sendcommand("BLOCK 10,"+(prntStart+(lnSize*lnCount))+",420,600,\"2\",0,1,1,\""+type_obj.getTip_inf_legal()+"\"\n");
					lnCount++;
					int blkSize = 600;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount)+blkSize)+",\"2\",0,1,1,\"Valor a Pagar: $"+type_obj.getTip_inf_valor()+"\"\n");
					
					//String status = TscDll.status();
					TscDll.printlabel(1, 1);
					TscDll.closeport();
			}
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			Toast.makeText(context, "Error al Imprimir el Ticket, Por Favor Revise la Impresora", Toast.LENGTH_LONG).show();
		}
    }
        
    public void onTicketClick(View pressed){
//		Toast.makeText(context, "Click en violation", Toast.LENGTH_LONG).show();
		Builder  dialog = new AlertDialog.Builder(context);
		dialog.setTitle("Registrar Ticket SISMERT");
	    dialogTicket = View.inflate(ParkingActivity.this, R.layout.dialog_ticket, null);
	    dialog.setView(dialogTicket);
	    
	    TextView lblCurrentDate;
	    lblCurrentDate = (TextView) dialogTicket.findViewById(R.id.lblCurrentDate);
	    
	    TextView lblPar_id;
	    lblPar_id = (TextView) dialogTicket.findViewById(R.id.lblParId);
	    
	    lblPar_id.setText(par_id);
	    
	    Calendar c = Calendar.getInstance();
	    SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy");
	    String formattedDate = df.format(c.getTime());
	    
	    lblCurrentDate.setText(formattedDate);
	    
	    dialog.setPositiveButton("Ingresar", new DialogInterface.OnClickListener() {
           @Override
           public void onClick(DialogInterface paramDialogInterface, int paramInt) {
        	   TareaWSRegistroTicket registrarTicket = new TareaWSRegistroTicket();
        	   registrarTicket.execute();
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
    
    public void onProofClick(View pressed){
        Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        
        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            startActivityForResult(takePictureIntent, REQUEST_IMAGE_CAPTURE);
        }
    }
    
    private File createImageFile() throws IOException {
        // Create an image file name
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String imageFileName = "JPEG_" + timeStamp + "_";
        
        //context.getExternalFilesDir(Environment.DIRECTORY_PICTURES)
        
        File storageDir = context.getExternalFilesDir(
                Environment.DIRECTORY_PICTURES);
        File image = File.createTempFile(
            imageFileName,  /* prefix */
            ".jpg",         /* suffix */
            storageDir      /* directory */
        );

        // Save a file: path for use with ACTION_VIEW intents
        mCurrentPhotoPath = "file:" + image.getAbsolutePath();
        return image;
    }    
    
	/*Proceso despues del software ANPR */
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data){	// this called when ANPR app finished
    	switch(requestCode)	// ANPR app id 
        {
    		case ANPR_REQUEST:
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
	        	    		
	        	    		txtPlateNumber.setText(s);
	        	    		captura=name;
	        	    		
		    			    Bitmap bitmap = BitmapFactory.decodeFile(name);
		    			    if (bitmap != null)
		    			    {
			    			    ImageView imageView = (ImageView)dialogViolation.findViewById(R.id.ImgProof1);
			    			    imageView.setImageBitmap(bitmap);
		    			    }
		    			    
		    			    proofCount++;
		    			    proofImage1 = new File(captura);
		    			    
		    			    
	        	    	}
	        	    }
	            }
	        break;
    		case REQUEST_IMAGE_CAPTURE:
	            if (resultCode == RESULT_OK)	// if ANPR app terminated normally 
	            {
	            	proofCount++;
	            	
	                Bundle extras = data.getExtras();
	                Uri u = data.getData();
	                String selectedImagePath = getPath(u);
	                Toast.makeText(ParkingActivity.this, selectedImagePath, Toast.LENGTH_LONG).show();
	                
	                Bitmap imageBitmap = (Bitmap) extras.get("data");

	                if(proofCount==1){
	                	proofImage1 = new File(selectedImagePath);
	                	ImageView imgProof1 = (ImageView)dialogViolation.findViewById(R.id.ImgProof1);
	                	imgProof1.setImageBitmap(imageBitmap);
	                }else if(proofCount==2){
	                	proofImage2 = new File(selectedImagePath);
	                	ImageView imgProof2 = (ImageView)dialogViolation.findViewById(R.id.ImgProof2);
	                	imgProof2.setImageBitmap(imageBitmap);
	                }else if(proofCount==3){
	                	proofImage3 = new File(selectedImagePath);
	                	ImageView imgProof3 = (ImageView)dialogViolation.findViewById(R.id.ImgProof3);
	                	imgProof3.setImageBitmap(imageBitmap);
	                }
	            }
    		break;	
    		case REQUEST_ENABLE_BT:
    			
    		break;
        }
    }    
    
	/* Web Services */
	private class TareaWSParqueaderosXSector extends AsyncTask<String,Integer,Boolean> {
		boolean result = false;
		private String message;
		
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://54.69.247.99/Violations/public/api/vigilante/sectores/"+sec_id+"/parqueaderos";
			
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
				        		
				        		System.out.println(obj);
				        		
				        		String par_id = obj.getString("par_id");
					        	String par_estado = obj.getString("par_estado").toUpperCase();
					        	String par_tipo = obj.getString("par_tipo").toUpperCase();
					        	String aut_placa = obj.getString("aut_placa").toUpperCase();
					        	String par_fecha_ingreso_string = obj.getString("par_fecha_ingreso");
					        	int inf_id = obj.getInt("inf_id");
					        	int par_horas_parqueo = obj.getInt("par_horas_parqueo");
					        	
					        	//Crearemos objetos más adelante
					        	Spot spot= new Spot(par_id,par_estado,par_tipo,aut_placa);
					        	spot.setPar_horas_parqueo(par_horas_parqueo);
					        	spot.setInf_id(inf_id);
					        	if(!par_fecha_ingreso_string.equals("0000-00-00 00:00:00")){
					        		DateFormat format = new SimpleDateFormat("yyyy-MM-d H:m:s", Locale.ENGLISH);
						        	Date par_fecha_ingreso;
									try {
										par_fecha_ingreso = format.parse(par_fecha_ingreso_string);
										spot.setPar_fecha_ingreso(par_fecha_ingreso);

									} catch (ParseException e) {
										// TODO Auto-generated catch block
										e.printStackTrace();
									}
					        	}else{
					        		spot.setPar_fecha_ingreso(null);
					        	}

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
    	        				LayoutParams.MATCH_PARENT,
    	        				LayoutParams.MATCH_PARENT,
    	        				1.0f
    	        				));
    	        		tableParking.addView(tableRow);
    	        	}
	    	        
    	        	View buttonSpot = View.inflate(context, R.layout.button_spot, null);
    	        	Button btnSpot = (Button) buttonSpot.findViewById(R.id.BtnSpot);
    	        	TextView txtInfo=(TextView)buttonSpot.findViewById(R.id.TxtInfo);
    	        	TextView txtTimer=(TextView)buttonSpot.findViewById(R.id.TxtTimer);
    	        	
    	        	btnSpot.setText(pairs.getKey().toString());
    	        	
    	        	txtInfo.setText(((Spot) pairs.getValue()).getAut_placa());
    	        	txtTimer.setText(((Spot) pairs.getValue()).getRemainingTime());
    	        	
    	        	//txtTimer.setText(((Spot) pairs.getValue()).getPar_fecha_ingreso());
    	        	
    	        	if(((Spot) pairs.getValue()).getPar_estado().equals("D")){
    	        		if(((Spot) pairs.getValue()).getPar_tipo().equals("N")){
    	        			btnSpot.setBackgroundResource(R.drawable.empty);
    	        		}else{
    	        			if(((Spot) pairs.getValue()).getPar_tipo().equals("V")){
	    	        			btnSpot.setBackgroundResource(R.drawable.empty_forbidden);
	    	        		}else{
	    	        			btnSpot.setBackgroundResource(R.drawable.empty_handicap);
	    	        		}
    	        		}
    	        	}else{
    	        		if(((Spot) pairs.getValue()).getPar_estado().equals("O")){
    	        			btnSpot.setBackgroundResource(R.drawable.occupied);
    	        		}else{
    	        			btnSpot.setBackgroundResource(R.drawable.violation);
    	        		}
    	        	}    	        	
    	        	
    	        	((Spot) pairs.getValue()).setView(buttonSpot);
    	        	
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
	    	
			String url = "http://54.69.247.99/Violations/public/api/vigilante/sectores/"+sec_id+"/parqueaderos"; //?par_estado=O
			
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
					        	String par_fecha_ingreso_string = obj.getString("par_fecha_ingreso");
					        	int par_horas_parqueo = obj.getInt("par_horas_parqueo");
					        	
					        	parqueaderos.get(par_id).setPar_estado(par_estado);
					        	parqueaderos.get(par_id).setAut_placa(aut_placa);
					        	parqueaderos.get(par_id).setPar_horas_parqueo(par_horas_parqueo);
					        	
					        	if(!par_fecha_ingreso_string.equals("0000-00-00 00:00:00")){
					        		DateFormat format = new SimpleDateFormat("yyyy-MM-d H:m:s", Locale.ENGLISH);
						        	Date par_fecha_ingreso;
									try {
										par_fecha_ingreso = format.parse(par_fecha_ingreso_string);
										parqueaderos.get(par_id).setPar_fecha_ingreso(par_fecha_ingreso);
										//Date current = new Date();
										//long diff = current.getTime() - serverAdjust.getTime();
									} catch (ParseException e) {
										// TODO Auto-generated catch block
										e.printStackTrace();
									}
					        	}else{
					        		parqueaderos.get(par_id).setPar_fecha_ingreso(null);
					        	}					        	
					        	
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
    	        View buttonSpot = ((Spot) pairs.getValue()).getView();
    	        Button btnSpot = (Button) buttonSpot.findViewById(R.id.BtnSpot);
    	        TextView txtInfo=(TextView)buttonSpot.findViewById(R.id.TxtInfo);
    	        TextView txtTimer=(TextView)buttonSpot.findViewById(R.id.TxtTimer);
    	        
    	        txtInfo.setText(((Spot) pairs.getValue()).getAut_placa());
    	        txtTimer.setText(((Spot) pairs.getValue()).getRemainingTime());
    	        
    	        if(((Spot) pairs.getValue()).getPar_estado().equals("O")){
    	        	btnSpot.setBackgroundResource(R.drawable.occupied);
    	        	
    	        }else{
    	        	if(((Spot) pairs.getValue()).getPar_estado().equals("R")){
    	        		btnSpot.setBackgroundResource(R.drawable.violation);
    	        	}else{
    	        		if(((Spot) pairs.getValue()).getPar_tipo().equals("N")){
    	        			btnSpot.setBackgroundResource(R.drawable.empty);
    	        		}else{
    	        			if(((Spot) pairs.getValue()).getPar_tipo().equals("V")){
	    	        			btnSpot.setBackgroundResource(R.drawable.empty_forbidden);
	    	        		}else{
	    	        			btnSpot.setBackgroundResource(R.drawable.empty_handicap);
	    	        		}
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
		
		private int error_status=0;
		@Override
		protected Boolean doInBackground(String... params) {
			
	    	boolean result = false;
			
			//String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/infracciones";
	    	String url = "http://54.69.247.99/Violations/public/api/vigilante/infracciones";

	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpPost post = new HttpPost(url);
			
			try{
				
				//File file = new File(captura);
				
				MultipartEntityBuilder multipartEntity = MultipartEntityBuilder.create();
		        if(proofImage1!=null){
		        	multipartEntity.addBinaryBody("image", proofImage1, ContentType.create("image/jpeg"), proofImage1.getName());
		        }
		        if(proofImage2!=null){
		        	multipartEntity.addBinaryBody("image2", proofImage2, ContentType.create("image/jpeg"), proofImage2.getName());
		        }
		        if(proofImage3!=null){
		        	multipartEntity.addBinaryBody("image3", proofImage3, ContentType.create("image/jpeg"), proofImage3.getName());
		        }
				
				multipartEntity.addTextBody("par_id", lblPar_id.getText().toString());
				multipartEntity.addTextBody("aut_placa", txtPlateNumber.getText().toString());
				multipartEntity.addTextBody("inf_latitud", String.valueOf(latitude));
				multipartEntity.addTextBody("inf_longitud", String.valueOf(longitude));
				
			    Calendar c = Calendar.getInstance();
			    SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
			    String formattedDate = df.format(c.getTime());
			    
			    String type = spnContravencion.getSelectedItem().toString();
			    InfractionType type_obj = tiposInfraccion.get(type);
				
				multipartEntity.addTextBody("inf_fecha", formattedDate);
				multipartEntity.addTextBody("tip_inf_id", String.valueOf(type_obj.getTip_inf_id())); //stand by
				
				post.setEntity(multipartEntity.build());
				
				HttpResponse response = httpClient.execute(post);
				int status = response.getStatusLine().getStatusCode();
				
				String responseStr = EntityUtils.toString(response.getEntity());

				Log.v("response",responseStr);
				switch (status){
					case 200: 	//case success		
						if(!responseStr.equals("")){
							JSONObject responseJSON = new JSONObject(responseStr);
							String par_id = responseJSON.getString("par_id");
							int inf_id = responseJSON.getInt("inf_id");
							parqueaderos.get(par_id).setInf_id(inf_id);
						}else{
							
						}
					break;
					case 403:
						Log.v("Lista Blanca","No está permitido");
						result=false;
						error_status=1; //PLACA RESTRINGIDA
					break;
						
				}
				
				
			} catch(Exception ex)
			{
				Log.e("ServicioRest","Error!", ex);
	        	result = false;
		    }
	        return result;
		}
		
	    @Override
		protected void onPostExecute(Boolean result) {
	    	
	    	if (result)
	    	{
	    		printTicket();

	    	}else{
	    		if(error_status==1){
	    			Toast toast= Toast.makeText(getApplicationContext(), 
	    				"PLACA RESTRINGIDA, NO SE PUEDE MULTAR", Toast.LENGTH_LONG);  
	    				toast.setGravity(Gravity.TOP|Gravity.CENTER_HORIZONTAL, 0, 0);
	    				toast.show();
	    		}		
	    	}
	    }
		
	}

	private class TareaWSTiposInfracciones extends AsyncTask<String,Integer,Boolean> {
		boolean result = false;
		private String message;
		
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://54.69.247.99/Violations/public/api/vigilante/categoria_infracciones/1/tipo_infracciones";
			
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
				        		Integer cat_inf_id = obj.getInt("cat_inf_id");
					        	String tip_inf_descripcion = obj.getString("tip_inf_descripcion");
					        	String tip_inf_legal = obj.getString("tip_inf_legal");
					        	Double tip_inf_valor = obj.getDouble("tip_inf_valor");
					        	
					        	InfractionType type= new InfractionType(tip_inf_id,cat_inf_id,tip_inf_descripcion,tip_inf_legal,tip_inf_valor); 
					        	
					        	tiposInfraccion.put(tip_inf_descripcion,type);
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
	    		listaTiposInfraccion.add("-- Seleccione el tipo de Contravensión --");
	    	    Iterator it = tiposInfraccion.entrySet().iterator();
	    	    while (it.hasNext()) {
	    	        Map.Entry pairs = (Map.Entry)it.next();
	    	        listaTiposInfraccion.add(pairs.getKey());
	    	        
	    	    }
	    		
	    		//Rellenamos la lista con los resultados
	        	ArrayAdapter<String> adaptador =
	        		    new ArrayAdapter<String>(context,
	        		        android.R.layout.simple_spinner_dropdown_item, listaTiposInfraccion );
	        	
	        	spnContravencion.setAdapter(adaptador);
	        	
	    	}
	    }
	}
	
	private class TareaWSLiberarParqueadero extends AsyncTask<String,Integer,Boolean> {

		@Override
		protected Boolean doInBackground(String... params) {
			
	    	boolean result = false;
	    	String par_id = params[0];
	    	String observation = params[1];
			//String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/infracciones";
	    	
	    	String url = "http://54.69.247.99/Violations/public/api/vigilante/infracciones/"+par_id+"/liberar";
	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpPost post = new HttpPost(url);
	    	
	    	List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "observation", observation ) );
	    	
			try{
				
				post.setEntity(new UrlEncodedFormEntity(paramsArray));
				
				HttpResponse response = httpClient.execute(post);
				int status = response.getStatusLine().getStatusCode();
				
				String responseStr = EntityUtils.toString(response.getEntity());
				switch (status){
					case 200: 	//case success		
						if(!responseStr.equals("")){
							System.out.println(responseStr);
							/*JSONObject responseJSON = new JSONObject(responseStr);
							String par_id = responseJSON.getString("par_id");
							((Spot) parqueaderos.get(par_id)).setInf_id(0);
							((Spot) parqueaderos.get(par_id)).setAut_placa("");*/
						}
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
	
	/* Carga de Ticket-Carton del vigilante en el sistema directamente */
	private class TareaWSRegistroTicket extends AsyncTask<String,Integer,Boolean> {

		@Override
		protected Boolean doInBackground(String... params) {
			
	    	boolean result = false;
			
			//String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/infracciones";
	    	String url = "http://54.69.247.99/Violations/public/api/vigilante/tickets";

	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpPost post = new HttpPost(url);
			
			try{
				
				MultipartEntityBuilder multipartEntity = MultipartEntityBuilder.create();
				
				TextView lblParId = (TextView) dialogTicket.findViewById(R.id.lblParId);
				EditText txtPlate = (EditText) dialogTicket.findViewById(R.id.txtPlate);
				Spinner spnHours = (Spinner) dialogTicket.findViewById(R.id.spnHours);
				Spinner spnMinutes  = (Spinner) dialogTicket.findViewById(R.id.spnHours);
				Spinner spnParkingHours  = (Spinner) dialogTicket.findViewById(R.id.spnParkingHours);
				
				EditText txtTicket = (EditText) dialogTicket.findViewById(R.id.txtTicket);
				
				String par_id = lblParId.getText().toString();
				String aut_placa = txtPlate.getText().toString();
				String nro_ticket = txtTicket.getText().toString();
				String hora_ini = spnHours.getSelectedItem().toString();
				String minutos_ini = spnMinutes.getSelectedItem().toString();
				String log_par_horas_parqueo = spnParkingHours.getSelectedItem().toString();
			
				multipartEntity.addTextBody("par_id", par_id);
				multipartEntity.addTextBody("aut_placa", aut_placa);
				multipartEntity.addTextBody("nro_ticket", nro_ticket);
				multipartEntity.addTextBody("hora_ini", hora_ini);
				multipartEntity.addTextBody("minutos_ini", minutos_ini);
				multipartEntity.addTextBody("log_par_horas_parqueo", log_par_horas_parqueo);			    
				
				Log.v("par_id",par_id);
				Log.v("aut_placa",aut_placa);
				Log.v("nro_ticket",nro_ticket);
				Log.v("hora_ini",hora_ini);
				Log.v("minutos_ini",minutos_ini);
				Log.v("log_par_horas_parqueo",log_par_horas_parqueo);
				
				
				post.setEntity(multipartEntity.build());
				
				HttpResponse response = httpClient.execute(post);
				int status = response.getStatusLine().getStatusCode();
				
				String responseStr = EntityUtils.toString(response.getEntity());
				switch (status){
					case 200: 	//case success		
						if(!responseStr.equals("")){
//							JSONObject responseJSON = new JSONObject(responseStr);
//							String par_id = responseJSON.getString("par_id");
//							int inf_id = responseJSON.getInt("inf_id");
//							parqueaderos.get(par_id).setInf_id(inf_id);
						}else{
							
						}
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

    private String getPath(Uri uri) {
        String[] projection = { MediaColumns.DATA };
        Cursor cursor = getContentResolver().query(uri, projection, null, null,null);
        int column_index = cursor.getColumnIndexOrThrow(MediaColumns.DATA);
        cursor.moveToFirst();
        return cursor.getString(column_index);
    }
	
}
