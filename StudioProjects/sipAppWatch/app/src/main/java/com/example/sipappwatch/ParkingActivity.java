package com.example.sipappwatch;

import android.app.ActionBar;
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
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.provider.MediaStore.MediaColumns;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.Gravity;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup.LayoutParams;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import com.example.tscdll.TSCActivity;

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
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

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
import java.util.Timer;
import java.util.TimerTask;

public class ParkingActivity extends ActionBarActivity implements LocationListener {

	private static final int TOTAL_COLS=8;
	static final int ANPR_REQUEST = 1;
	static final int REQUEST_IMAGE_CAPTURE = 2;
	static final int REQUEST_ENABLE_BT = 3;
	static final int ANPR_SEARCH = 4;
	public static final String PREFS_NAME = "Configuration";

	Context context = this;

	static String IMG_PATH; //= context.getExternalFilesDir(Environment.DIRECTORY_PICTURES); //"/sdcard/sdk/example/images/";
	private int sec_id;
	private String sec_nombre;
	private int totalSpots=0;

	private TextView txtZone;
	public TextView lblLastUpdate;

	private TableLayout tableParking;

	public LinkedHashMap<String, Spot> parqueaderos = new LinkedHashMap<String, Spot>();

	private View dialogViolation;
	private View dialogFree;
	private View dialogSelect;
	private View dialogTicket;
	private View dialogNote;
	private View dialogSelectInfraction;

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
	public String par_id;
	public Button current_spot_button;

	File proofImage1;
	File proofImage2;
	File proofImage3;

	public String aut_placa;
	public String nro_ticket;
	public String hora_ini;
	public String minutos_ini;
	public String log_par_horas_parqueo;
	public int log_par_discount = 0;

	public AlertDialog dialogHandler;

	public SharedPreferences settings;
	public String noted_plates;

	DBHelper dbHelper;

	public Timer timer = new Timer();
	public TimerTask task;

	TareaWSRegistroInfraccion registrarInfraccion;

	public boolean firstTimeLoad = false;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_parking);

		dbHelper = new DBHelper(context);

		settings = getSharedPreferences(PREFS_NAME, 0);

		noted_plates = settings.getString("noted_plates","");
		Log.v("Placas Anotadas", noted_plates);
		//tiposInfraccion.put("-- Seleccione el Tipo de Infracción --", 0);

		IMG_PATH = context.getExternalFilesDir(Environment.DIRECTORY_PICTURES).toString()+"/"; //"/sdcard/sdk/example/images/";

		//Controles
        ActionBar actionBar = getActionBar();
		try{
        	actionBar.setDisplayHomeAsUpEnabled(true);
		} catch(NullPointerException e){

		}

        txtZone = (TextView) findViewById(R.id.TxtZone);
		lblLastUpdate = (TextView) findViewById(R.id.LblLastUpdate);
        tableParking = (TableLayout) findViewById(R.id.TableParking);
        //Informacion del Intent Anterior
        Bundle bundle = this.getIntent().getExtras();
        sec_id=bundle.getInt("SEC_ID");
        sec_nombre=bundle.getString("SEC_NOMBRE");

        txtZone.setText("Sector: " + sec_nombre);


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
		if(!firstTimeLoad){
			Zone sectores = new Zone();
			parqueaderos = (LinkedHashMap<String, Spot>) sectores.getSpots(dbHelper,sec_id);

			//tableParking.removeAllViews();

			int rows=(int) Math.ceil(totalSpots/TOTAL_COLS);
			int currentCol=0;

			Iterator it = parqueaderos.entrySet().iterator();

			TableRow tableRow = null;

			while (it.hasNext()) {
				final Map.Entry pairs = (Map.Entry)it.next();

				if(currentCol==TOTAL_COLS){
					currentCol=0;
				}

				if(currentCol==0){
					tableRow = new TableRow(context);
					tableRow.setLayoutParams(new TableLayout.LayoutParams(
							LayoutParams.MATCH_PARENT,
							LayoutParams.MATCH_PARENT,
							1.0f
					));
					tableParking.addView(tableRow);
				}

				View buttonSpot = ((Spot) pairs.getValue()).createView(context);
				tableRow.addView(buttonSpot); //button
				currentCol++;
			}
		}
		firstTimeLoad=true;

		/*llamamos a la función para poblar los ocupados*/
		TareaWSOcupadosXSector tareaOcupadosXSector = new TareaWSOcupadosXSector();
		tareaOcupadosXSector.execute();

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
		}else{
			if (!mBluetoothAdapter.isEnabled()) {
				Intent enableBtIntent = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
				startActivityForResult(enableBtIntent, REQUEST_ENABLE_BT);
			}
		}
	}

	private boolean verificarDatos() {
		ConnectivityManager connectivityManager = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
		NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
		return activeNetworkInfo != null;
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

		intent.putExtra("TitleText", "SIP Vigilante");	// text on titlebar

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

	public void onBtnSearchPlateClick(View pressed){
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

		intent.putExtra("TitleText", "SIP Vigilante");	// text on titlebar

		try
		{
			startActivityForResult(intent, ANPR_SEARCH);	// call ANPR app with intent
		}
		catch (ActivityNotFoundException e)		// if ANPR intent not found (not installed)
		{
			Toast toast = Toast.makeText(ParkingActivity.this, "The ANPR not installed!", Toast.LENGTH_LONG);
			toast.show();
		}
	}

	public void onBtnSpotClick(View pressed){
    	Button button = (Button)pressed;
		current_spot_button = button;
    	par_id = button.getText().toString();
    	String par_estado_string = parqueaderos.get(par_id).getPar_estado();
    	final int inf_id = parqueaderos.get(par_id).getInf_id();
    	char[] par_estado_char=par_estado_string.toCharArray();
    	char par_estado = par_estado_char[0];

    	String par_tipo_string = parqueaderos.get(par_id).getPar_tipo();
    	char[] par_tipo_char=par_tipo_string.toCharArray();
    	char par_tipo = par_tipo_char[0];

		AlertDialog.Builder dialog = new AlertDialog.Builder(context);

        proofCount=0;
		aut_placa = "";
		switch(par_estado){
			case 'O':
				aut_placa = parqueaderos.get(par_id).getAut_placa();
				dialog.setTitle("Qué desea realizar?");
				dialogSelect = View.inflate(context, R.layout.dialog_select_parked, null);
				dialog.setView(dialogSelect);
				dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
					@Override
					public void onClick(DialogInterface paramDialogInterface, int paramInt) {
						// TODO Auto-generated method stub
					}
				});
				dialogHandler = dialog.create();
				dialogHandler.show();
			break;
    		case 'D':
			case 'X':
    			switch(par_tipo){
    				case 'V':
    					violationDialog();
					break;
    				default:
    	    			dialog.setTitle("Qué desea realizar?");
    	    			dialogSelect = View.inflate(context, R.layout.dialog_select, null);
    	    			dialog.setView(dialogSelect);

						Button btnNote = (Button) dialogSelect.findViewById(R.id.btnNote);
						Button btnFree = (Button) dialogSelect.findViewById(R.id.btnFree);

						if(par_estado=='D'){
							btnFree.setVisibility(View.GONE);
							btnNote.setVisibility(View.VISIBLE);
						} else {
							btnFree.setVisibility(View.VISIBLE);
							btnNote.setVisibility(View.GONE);
						}

    					dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
    						@Override
    						public void onClick(DialogInterface paramDialogInterface, int paramInt) {
    						      // TODO Auto-generated method stub
    						}
    					});
						dialogHandler = dialog.create();
						dialogHandler.show();
					break;
    			}

    		break;
    		case 'R':
			case 'L':

				dialog.setTitle("Qué desea realizar?");
				dialogSelectInfraction = View.inflate(context, R.layout.dialog_select_infraction, null);
				dialog.setView(dialogSelectInfraction);
				dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
					@Override
					public void onClick(DialogInterface paramDialogInterface, int paramInt) {
						// TODO Auto-generated method stub
					}
				});
				dialogHandler = dialog.create();
				dialogHandler.show();

        	break;
        	default:
        	break;
    	}
    }

    public void onViolationClick(View pressed){
    	violationDialog();
    }

	public void onNoteClick(View pressed) {

		Builder  dialog = new AlertDialog.Builder(context);
		dialog.setTitle("Anotar Infractor");
		dialogNote = View.inflate(ParkingActivity.this, R.layout.dialog_note, null);

		txtPlateNumber = (EditText) dialogNote.findViewById(R.id.TxtPlateNumber);
		lblPar_id = (TextView) dialogNote.findViewById(R.id.LblPar_id);
		dialog.setView(dialogNote);
		lblPar_id.setText(par_id);

		dialog.setPositiveButton("Anotar", new DialogInterface.OnClickListener() {

			@Override
			public void onClick(DialogInterface paramDialogInterface, int paramInt) {
				String aut_placa = txtPlateNumber.getText().toString();
				if(!aut_placa.equals("")){
					dialogHandler.dismiss();
					parqueaderos.get(par_id).note(dbHelper, aut_placa);

				}else{
					Toast toast= Toast.makeText(getApplicationContext(),
							"DEBE INGRESAR UNA PLACA VALIDA", Toast.LENGTH_LONG);
					toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
					toast.show();
				}
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

	public void onReleaseNoteClick(View pressed){
		dialogHandler.dismiss();
		parqueaderos.get(par_id).release(dbHelper);
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

		/* Load Zone information for Spinner */
		InfractionType tipo_infraccion=new InfractionType();
		tiposInfraccion = tipo_infraccion.getAll(dbHelper);

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

		spnContravencion.setOnItemSelectedListener(new OnItemSelectedListener() {

			@Override
			public void onItemSelected(AdapterView<?> parent, View view,
									   int position, long id) {
				// TODO Auto-generated method stub
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

				   dialogHandler.dismiss();
				   if(task!=null){
					   task.cancel();
				   }
				   String aut_placa = txtPlateNumber.getText().toString();
				   parqueaderos.get(par_id).addInfraction(dbHelper,aut_placa);

				   if(registrarInfraccion!=null){
					   registrarInfraccion.cancel(true);
				   }
				   if(verificarDatos()) {
					   registrarInfraccion = new TareaWSRegistroInfraccion();
					   registrarInfraccion.execute();
				   }else{
					   Toast.makeText(ParkingActivity.this, "Reinicie su conexión a internet", Toast.LENGTH_LONG).show();
				   }
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

    public void printTicket(int inf_id){
	    Calendar c = Calendar.getInstance();
	    SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
	    String formattedDate = df.format(c.getTime());

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

					TscDll.setup(55, 205, 2, 10, 0, 0, 0);
					TscDll.clearbuffer();
					int lnCount=0;
					int lnSize=50;
					int prntStart=250;

					TscDll.sendcommand("DIRECTION 0\n");
					TscDll.sendcommand("PUTBMP 100,10,\"mono_ibarra6.bmp\",8,100\n");
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"GAD San Miguel de Ibarra\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"SIP Parking Solution\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Fecha: "+formattedDate+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Placa: "+txtPlateNumber.getText().toString()+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Parqueadero: "+par_id+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Infraccion: "+inf_id+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Agente: \"\n");
					lnCount++;
					String nombre = settings.getString("NOMBRE", "(Sin Nombre)");
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\""+nombre+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Motivo:\"\n");
					lnCount++;
					TscDll.sendcommand("BLOCK 10,"+(prntStart+(lnSize*lnCount))+",420,50,\"2\",0,1,1,\""+type+"\"\n");
					lnCount++;
					TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Base Legal:\"\n");
					lnCount++;
					TscDll.sendcommand("BLOCK 10,"+(prntStart+(lnSize*lnCount))+",420,700,\"2\",0,1,1,\""+type_obj.getTip_inf_legal()+"\"\n");
					lnCount++;
					int blkSize = 700;
					TscDll.sendcommand("PUTBMP 0,"+(prntStart+(lnSize*lnCount)+blkSize)+",\"sismert2.BMP\",8,100\n");
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

	public void onRePrintClick(View pressed){
		//TareaWSConsultaInfraccion
		final String inf_id = ""+parqueaderos.get(par_id).getInf_id();
		Log.v("Infraccion", inf_id + "");
		TareaWSConsultaInfraccion consultaInfraccion = new TareaWSConsultaInfraccion();
		consultaInfraccion.execute(inf_id);

	}

    public void onTicketClick(View pressed){

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

		final LinearLayout lyHora = (LinearLayout) dialogTicket.findViewById(R.id.lyHora);
		final LinearLayout lyHoras = (LinearLayout) dialogTicket.findViewById(R.id.lyHoras);
		final LinearLayout lyHoraIni = (LinearLayout) dialogTicket.findViewById(R.id.lyHoraIni);
		final LinearLayout lyHoraFin = (LinearLayout) dialogTicket.findViewById(R.id.lyHoraFin);

		Spinner spnParkingType  = (Spinner) dialogTicket.findViewById(R.id.spnParkingType);
		spnParkingType.setOnItemSelectedListener(new OnItemSelectedListener() {
			@Override
			public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
				switch(position){
					case 0:
						lyHora.setVisibility(View.VISIBLE);
						lyHoras.setVisibility(View.VISIBLE);
						lyHoraIni.setVisibility(View.GONE);
						lyHoraFin.setVisibility(View.GONE);
					break;
					case 1:
						lyHora.setVisibility(View.GONE);
						lyHoras.setVisibility(View.GONE);
						lyHoraIni.setVisibility(View.VISIBLE);
						lyHoraFin.setVisibility(View.VISIBLE);
					break;
				}
			}

			@Override
			public void onNothingSelected(AdapterView<?> parent) {

			}
		});

		txtPlateNumber = (EditText) dialogTicket.findViewById(R.id.txtPlate);
		txtPlateNumber.setText(aut_placa);

		dialog.setPositiveButton("Ingresar", new DialogInterface.OnClickListener() {
           @Override
           public void onClick(DialogInterface paramDialogInterface, int paramInt) {
			   dialogHandler.dismiss();


			   TextView lblParId = (TextView) dialogTicket.findViewById(R.id.lblParId);
			   EditText txtPlate = (EditText) dialogTicket.findViewById(R.id.txtPlate);
			   Spinner spnHours = (Spinner) dialogTicket.findViewById(R.id.spnHours);
			   Spinner spnMinutes  = (Spinner) dialogTicket.findViewById(R.id.spnMinutes);
			   Spinner spnParkingHours  = (Spinner) dialogTicket.findViewById(R.id.spnParkingHours);
			   EditText txtTicket = (EditText) dialogTicket.findViewById(R.id.txtTicket);
			   CheckBox chkDiscount = (CheckBox) dialogTicket.findViewById(R.id.chkDiscount);
			   Spinner spnParkingType  = (Spinner) dialogTicket.findViewById(R.id.spnParkingType);

			   if(spnParkingType.getSelectedItemPosition()==0){
				   hora_ini = spnHours.getSelectedItem().toString();
				   minutos_ini = spnMinutes.getSelectedItem().toString();
				   log_par_horas_parqueo = spnParkingHours.getSelectedItem().toString();
			   }else{
				   EditText txtStartHour = (EditText) dialogTicket.findViewById(R.id.txtStartHour);
				   EditText txtStartMinute = (EditText) dialogTicket.findViewById(R.id.txtStartMinute);
				   EditText txtEndHour = (EditText) dialogTicket.findViewById(R.id.txtEndHour);
				   EditText txtEndMinute = (EditText) dialogTicket.findViewById(R.id.txtEndMinute);
				   int start = Integer.parseInt(txtStartHour.getText().toString())*60+Integer.parseInt(txtStartMinute.getText().toString());
				   int end = Integer.parseInt(txtEndHour.getText().toString())*60+Integer.parseInt(txtEndMinute.getText().toString());
				   log_par_horas_parqueo = String.valueOf(end - start);
				   hora_ini=txtStartHour.getText().toString();
				   minutos_ini=txtStartMinute.getText().toString();
			   }

			   log_par_discount = 0;
			   if(chkDiscount.isChecked()){
				   log_par_discount = 1;
			   }

			   chkDiscount.setChecked(false);

			   par_id = lblParId.getText().toString();
			   aut_placa = txtPlate.getText().toString();
			   nro_ticket = txtTicket.getText().toString();

			   parqueaderos.get(par_id).park(dbHelper,aut_placa);

			   TareaWSRegistroTicket registrarTicket;

			   /*
			   if(registrarTicket!=null){
				   registrarTicket.cancel(true);
			   }
			   */

			   if(verificarDatos()){
				   registrarTicket = new TareaWSRegistroTicket();
				   registrarTicket.execute();
			   }else{
				   Toast.makeText(ParkingActivity.this, "Reinicie su conexión a internet", Toast.LENGTH_LONG).show();
			   }
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

	public void onFreeClick(View pressed){
		parqueaderos.get(par_id).release(dbHelper);
		TareaWSLiberarParqueadero liberarParqueadero = new TareaWSLiberarParqueadero();
		liberarParqueadero.execute(par_id, "Auto se retiro de la plaza");
		dialogHandler.dismiss();
	}

    public void onProofClick(View pressed){
        Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);

        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            startActivityForResult(takePictureIntent, REQUEST_IMAGE_CAPTURE);
        }
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
			case ANPR_SEARCH:
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
							txtPlateNumber.setText(s);
						}
					}
				}
			break;
        }
    }
	/* Web Services */

	private class TareaWSOcupadosXSector extends AsyncTask<String,Integer,Boolean> {
		boolean result = false;
		private String message;

		Map<String, Spot> ocupados = new LinkedHashMap<String, Spot>();

	    @Override
		protected Boolean doInBackground(String... params) {

			String url = "http://54.69.247.99/Violations/public/api/vigilante/sectores/"+sec_id+"/ocupados"; //?par_estado=O

	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpGet get = new HttpGet(url);

			try {

				HttpResponse response = httpClient.execute(get);
				int status = response.getStatusLine().getStatusCode();

				switch (status){
					case 200: 	//case success
						String responseStr = EntityUtils.toString(response.getEntity());
						if(!responseStr.equals("")){
							Log.v("response",responseStr);
							JSONArray responseJSON = new JSONArray(responseStr);

							totalSpots=responseJSON.length();

							for(int i=0; i<totalSpots; i++)
				        	{
				        		JSONObject obj = responseJSON.getJSONObject(i);

				        		String par_id = obj.getString("par_id");
					        	String par_estado = obj.getString("par_estado").toUpperCase();
					        	String aut_placa = obj.getString("aut_placa").toUpperCase();
								String par_tipo_compra = obj.getString("par_tipo_compra").toUpperCase();
					        	String par_fecha_ingreso_string = obj.getString("par_fecha_ingreso");
					        	int par_horas_parqueo = obj.getInt("par_horas_parqueo");

								Spot parqueadero = new Spot();

								parqueadero.setPar_tipo_compra(par_tipo_compra);
								parqueadero.setPar_estado(par_estado);
								parqueadero.setAut_placa(aut_placa);
								parqueadero.setPar_horas_parqueo(par_horas_parqueo);

					        	if(!par_fecha_ingreso_string.equals("0000-00-00 00:00:00")){
					        		DateFormat format = new SimpleDateFormat("yyyy-MM-d H:m:s", Locale.ENGLISH);
						        	Date par_fecha_ingreso;
									try {
										par_fecha_ingreso = format.parse(par_fecha_ingreso_string);
										parqueadero.setPar_fecha_ingreso(par_fecha_ingreso);
										//Date current = new Date();
										//long diff = current.getTime() - serverAdjust.getTime();
									} catch (ParseException e) {
										// TODO Auto-generated catch block
										e.printStackTrace();
									}
					        	}else{
									parqueadero.setPar_fecha_ingreso(null);
					        	}

								ocupados.put(par_id,parqueadero);

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

				String par_id = ((Spot) pairs.getValue()).getPar_id();

				Spot ocupado = ocupados.get(par_id);
				if(ocupado != null) {
					((Spot) pairs.getValue()).setPar_tipo_compra(ocupado.getPar_tipo_compra());
					((Spot) pairs.getValue()).setPar_estado(ocupado.getPar_estado());
					((Spot) pairs.getValue()).setAut_placa(ocupado.getAut_placa());
					((Spot) pairs.getValue()).setPar_horas_parqueo(ocupado.getPar_horas_parqueo());
					((Spot) pairs.getValue()).setPar_fecha_ingreso(ocupado.getPar_fecha_ingreso());

				}else{

					if(!((Spot) pairs.getValue()).getPar_estado().equals("X")){
						((Spot) pairs.getValue()).setPar_estado("D");
						((Spot) pairs.getValue()).setAut_placa(null);
						((Spot) pairs.getValue()).setPar_fecha_ingreso(null);
						((Spot) pairs.getValue()).setPar_horas_parqueo(0);
					}else{
						((Spot) pairs.getValue()).setPar_fecha_ingreso(((Spot) pairs.getValue()).getPar_fecha_ingreso());
					}

				}
    	    }

	    	if (result)
	    	{

	    	}

			/*Actualizamos la hora de la última actualización*/
			Calendar c = Calendar.getInstance();
			SimpleDateFormat df = new SimpleDateFormat("HH:mm:ss");
			String formattedDate = df.format(c.getTime());
			lblLastUpdate.setText("Última Actualización: " + formattedDate);

    	    /*Let's See*/
			if(task!=null){
				task.cancel();
			}
			task = new TimerTask() {
				@Override
				public void run() {
					TareaWSOcupadosXSector tareaOcupadosXSector = new TareaWSOcupadosXSector();
					tareaOcupadosXSector.execute();
				}
			};
			try{
				timer.schedule(task, 15000);
			}catch(Exception e){

			}
	    }
	}

	private class TareaWSRegistroInfraccion extends AsyncTask<String,Integer,Boolean> {

		private int error_status=0;
		public int inf_id;
		public Violation violation;


		@Override
		protected Boolean doInBackground(String... params) {

	    	boolean result = false;

			//String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/infracciones";
	    	String url = "http://54.69.247.99/Violations/public/api/vigilante/infracciones";

			final HttpParams httpParams = new BasicHttpParams();
			HttpConnectionParams.setConnectionTimeout(httpParams, 30000);

	    	HttpClient httpClient = new DefaultHttpClient(httpParams);
	    	HttpPost post = new HttpPost(url);

			try{

				MultipartEntityBuilder multipartEntity = MultipartEntityBuilder.create();
		        /*
				if(proofImage1!=null){
		        	multipartEntity.addBinaryBody("image", proofImage1, ContentType.create("image/jpeg"), proofImage1.getName());
		        }
		        if(proofImage2!=null){
		        	multipartEntity.addBinaryBody("image2", proofImage2, ContentType.create("image/jpeg"), proofImage2.getName());
		        }
		        if(proofImage3!=null){
		        	multipartEntity.addBinaryBody("image3", proofImage3, ContentType.create("image/jpeg"), proofImage3.getName());
		        }
				*/

				multipartEntity.addTextBody("par_id", lblPar_id.getText().toString());
				multipartEntity.addTextBody("aut_placa", txtPlateNumber.getText().toString());
				multipartEntity.addTextBody("inf_latitud", String.valueOf(latitude));
				multipartEntity.addTextBody("inf_longitud", String.valueOf(longitude));
				multipartEntity.addTextBody("usu_id", String.valueOf(settings.getInt("ID",0)));

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
				Log.v("inf_response_status",""+status);
				Log.v("inf_response",responseStr);
				switch (status){
					case 200: 	//case success
						if(!responseStr.equals("")){
							JSONObject responseJSON = new JSONObject(responseStr);
							String par_id = responseJSON.getString("par_id");
							inf_id = responseJSON.getInt("inf_id");
							parqueaderos.get(par_id).setInf_id(inf_id);


						}else{

						}
						result=true;
					break;
					case 403:
						Log.v("Lista Blanca","No está permitido");
						result=false;
						error_status=1; //PLACA RESTRINGIDA
					break;
					case 500:
						result=false;
						error_status=2; //ERROR AL GUARDAR
						break;
					default:

					break;

				}


			} catch(Exception ex)
			{
				Log.v("inf_response_exception",ex.getMessage());
				Log.e("ServicioRest", "Error!", ex);
	        	result = false;
				error_status=3; //ERROR X O TIEMPO DE ESPERA AGOTADO
		    }
	        return result;
		}

	    @Override
		protected void onPostExecute(Boolean result) {
			Log.v("inf_response_post","finalizo ejecución");
			Toast toast;
	    	if (result)
	    	{
				current_spot_button.setBackgroundResource(R.drawable.violation);
	    		printTicket(inf_id);
				TareaWSRegistroFotos registroFotos = new TareaWSRegistroFotos();
				registroFotos.execute(String.valueOf(inf_id));

	    	}else{
				current_spot_button.setBackgroundResource(R.drawable.empty_error);
				switch(error_status){
					case 1:
						 toast= Toast.makeText(getApplicationContext(),
							"PLACA RESTRINGIDA, NO SE PUEDE MULTAR", Toast.LENGTH_LONG);
							toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
							toast.show();
					break;
					case 2:
						toast= Toast.makeText(getApplicationContext(),
								"ERROR AL INGRESAR, INTENTE NUEVAMENTE", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
					break;
					case 3:
						 toast= Toast.makeText(getApplicationContext(),
								 "ERROR AL INGRESAR, TIEMPO DE ESPERA SUPERADO, REINICIE SU CONEXIÓN E INTENTE NUEVAMENTE", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
					break;
				}
	    	}
			/*llamamos a la función para poblar los ocupados*/
			TareaWSOcupadosXSector tareaOcupadosXSector = new TareaWSOcupadosXSector();
			tareaOcupadosXSector.execute();
	    }
	}

	private class TareaWSRegistroFotos extends AsyncTask<String,Integer,Boolean> {

		private int error_status=0;
		//public int inf_id;
		//public Violation violation;

		@Override
		protected Boolean doInBackground(String... params) {

			Log.v("inf_foto_response","Iniciando");
			String inf_id = params[0];
			boolean result = false;

			String url = "http://54.69.247.99/Violations/public/api/vigilante/fotos/"+inf_id;

			final HttpParams httpParams = new BasicHttpParams();
			HttpConnectionParams.setConnectionTimeout(httpParams, 300000);

			HttpClient httpClient = new DefaultHttpClient(httpParams);
			HttpPost post = new HttpPost(url);

			try{

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

				post.setEntity(multipartEntity.build());

				HttpResponse response = httpClient.execute(post);
				int status = response.getStatusLine().getStatusCode();

				String responseStr = EntityUtils.toString(response.getEntity());
				Log.v("inf_foto_response_status",""+status);
				Log.v("inf_foto_response",responseStr);
				switch (status){
					case 200: 	//case success
						if(!responseStr.equals("")){
							JSONObject responseJSON = new JSONObject(responseStr);
						}else{

						}
						result=true;
					break;
					case 500:
						result=false;
						error_status=2; //ERROR AL GUARDAR
						break;
					default:

					break;

				}


			} catch(Exception ex)
			{
				result = false;
				error_status=3; //ERROR X O TIEMPO DE ESPERA AGOTADO
			}
			return result;
		}

		@Override
		protected void onPostExecute(Boolean result) {
			Toast toast;
			if (result)
			{

			}else{
				current_spot_button.setBackgroundResource(R.drawable.empty_error);
				switch(error_status){
					case 2:
						toast= Toast.makeText(getApplicationContext(),
								"ERROR AL INGRESAR IMAGENES, REVISE SU CONEXIÓN", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
						break;
					case 3:
						toast= Toast.makeText(getApplicationContext(),
								"ERROR AL INGRESAR IMAGENES, REVISE SU CONEXIÓN", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
						break;
				}
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
							result = true;
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

		@Override
		protected void onPostExecute(Boolean result) {
			if (result)
			{
				current_spot_button.setBackgroundResource(R.drawable.empty);
			}else{

			}
		}

	}

	/* Carga de Ticket-Carton del vigilante en el sistema directamente */
	private class TareaWSRegistroTicket extends AsyncTask<String,Integer,Boolean> {
		public int error_status=0;
		@Override
		protected Boolean doInBackground(String... params) {

	    	boolean result = false;

			//String url = "http://www.hawasolutions.com/Violations2/public/api/vigilante/infracciones";
	    	String url = "http://54.69.247.99/Violations/public/api/vigilante/tickets";

			final HttpParams httpParams = new BasicHttpParams();
			HttpConnectionParams.setConnectionTimeout(httpParams, 25000);

	    	HttpClient httpClient = new DefaultHttpClient(httpParams);
	    	HttpPost post = new HttpPost(url);

			try{

				MultipartEntityBuilder multipartEntity = MultipartEntityBuilder.create();

				multipartEntity.addTextBody("par_id", par_id);
				multipartEntity.addTextBody("aut_placa", aut_placa);
				multipartEntity.addTextBody("nro_ticket", nro_ticket);
				multipartEntity.addTextBody("hora_ini", hora_ini);
				multipartEntity.addTextBody("minutos_ini", minutos_ini);
				multipartEntity.addTextBody("log_par_horas_parqueo", log_par_horas_parqueo);
				multipartEntity.addTextBody("log_par_discount", "" + log_par_discount);
				multipartEntity.addTextBody("usu_id", String.valueOf(settings.getInt("ID",0)));

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
						result=true;
					break;
					case 403:
						result=false;
						error_status=1; //PLACA RESTRINGIDA
					break;
					case 500:
						result=false;
						error_status=2;
					break;
				}


			} catch(Exception ex)
			{
				Log.e("ServicioRest","Error!", ex);
	        	result = false;
				error_status=3;
		    }
	        return result;
		}

		@Override
		protected void onPostExecute(Boolean result) {
			Toast toast;
			if (result)
			{
				current_spot_button.setBackgroundResource(R.drawable.occupied);

			}else{
				switch(error_status){
					case 1:
						//Error 403 placa restringida
						toast= Toast.makeText(getApplicationContext(),
								"NUMERO DE TARJETA REUTILIZADO, REPORTAR", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
					break;
					case 2:
						//Error 500 error al ingresar
						toast= Toast.makeText(getApplicationContext(),
								"ERROR AL INGRESAR, INTENTE NUEVAMENTE", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
					break;
					case 3:
						//Error 500 error al ingresar
						toast= Toast.makeText(getApplicationContext(),
								"ERROR AL INGRESAR, TIEMPO DE ESPERA AGOTADO, REVISE SU CONEXIÓN E INTENTE NUEVAMENTE", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
					break;
				}
			}
		}

	}

	private class TareaWSConsultaInfraccion extends AsyncTask<String,Integer,Boolean> {
		public String inf_id;
		public String inf_fecha;
		public String aut_placa;
		public String parqueadero;
		public String agente;
		public String tip_inf_descripcion;
		public String tip_inf_legal;

		@Override
		protected Boolean doInBackground(String... params) {
			inf_id = params[0];

			String url = "http://54.69.247.99/Violations/public/api/vigilante/infraccion/"+inf_id;
			HttpClient httpClient = new DefaultHttpClient();
			HttpGet get = new HttpGet(url);

			try {

				HttpResponse response = httpClient.execute(get);
				int status = response.getStatusLine().getStatusCode();

				switch (status) {
					case 200:    //case success
						String responseStr = EntityUtils.toString(response.getEntity());
						if(!responseStr.equals("")) {
							JSONObject responseJSON = new JSONObject(responseStr);
							inf_fecha = responseJSON.getString("inf_fecha");
							aut_placa = responseJSON.getString("aut_placa");
							parqueadero = responseJSON.getString("parqueadero");
							tip_inf_descripcion = responseJSON.getString("tip_inf_descripcion");
							agente = responseJSON.getString("agente");
							tip_inf_legal = responseJSON.getString("tip_inf_legal");
						}
						return true;
					case 404:    //case success

					return false;
				}
			} catch (Exception e){
				return false;
			}

			return false;
		}
		@Override
		protected void onPostExecute(Boolean result) {
			dialogHandler.dismiss();
			if(result){
				Toast toast= Toast.makeText(getApplicationContext(),
						"Reimprimiendo Infracción "+inf_id, Toast.LENGTH_LONG);
				toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
				toast.show();

				Log.v("Infraccion Data", "inf_id:" + inf_id);
				Log.v("Infraccion Data", "inf_fecha:" + inf_fecha);
				Log.v("Infraccion Data", "aut_placa:"+aut_placa);
				Log.v("Infraccion Data", "parqueadero:"+parqueadero);
				Log.v("Infraccion Data", "agente:"+agente);
				Log.v("Infraccion Data", "tip_inf_descripcion:"+tip_inf_descripcion);
				Log.v("Infraccion Data", "tip_inf_legal:"+tip_inf_legal);

				String printer_mac = settings.getString("printer_mac","");

				TSCActivity TscDll;

				try {
					TscDll = new TSCActivity();
					TscDll.openport(printer_mac);
					if(TscDll!=null){
						//String status = TscDll.status();
						//Toast.makeText(context, status, Toast.LENGTH_LONG).show();

						//TscDll.downloadbmp("mono_ibarra6.bmp");

						TscDll.setup(55, 205, 2, 10, 0, 0, 0);
						TscDll.clearbuffer();
						int lnCount=0;
						int lnSize=50;
						int prntStart=250;

						TscDll.sendcommand("DIRECTION 0\n");
						TscDll.sendcommand("PUTBMP 100,10,\"mono_ibarra6.bmp\",8,100\n");
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"GAD San Miguel de Ibarra\"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"SIP Parking Solution\"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Fecha: "+inf_fecha+"\"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Placa: "+aut_placa+"\"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Parqueadero: "+parqueadero+"\"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Infraccion: "+inf_id+"\"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Agente: \"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\""+agente+"\"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Motivo:\"\n");
						lnCount++;
						TscDll.sendcommand("BLOCK 10,"+(prntStart+(lnSize*lnCount))+",420,50,\"2\",0,1,1,\""+tip_inf_descripcion+"\"\n");
						lnCount++;
						TscDll.sendcommand("TEXT 10,"+(prntStart+(lnSize*lnCount))+",\"2\",0,1,1,\"Base Legal:\"\n");
						lnCount++;
						TscDll.sendcommand("BLOCK 10,"+(prntStart+(lnSize*lnCount))+",420,700,\"2\",0,1,1,\""+tip_inf_legal+"\"\n");
						lnCount++;
						int blkSize = 700;
						TscDll.sendcommand("PUTBMP 0,"+(prntStart+(lnSize*lnCount)+blkSize)+",\"sismert2.BMP\",8,100\n");
						//String status = TscDll.status();
						TscDll.printlabel(1, 1);
						TscDll.closeport();
					}
				} catch (Exception e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
					Toast.makeText(context, "Error al Imprimir el Ticket, Por Favor Revise la Impresora", Toast.LENGTH_LONG).show();
				}


			}else{
				Toast toast= Toast.makeText(getApplicationContext(),
						"No se encontró la Infracción "+inf_id, Toast.LENGTH_LONG);
				toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
				toast.show();
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

    private String getPath(Uri uri) {
        String[] projection = { MediaColumns.DATA };
        Cursor cursor = getContentResolver().query(uri, projection, null, null,null);
        int column_index = cursor.getColumnIndexOrThrow(MediaColumns.DATA);
        cursor.moveToFirst();
        return cursor.getString(column_index);
    }

	@Override
	protected void onStart(){
		super.onStart();
		dbHelper.openDB();
		cargarParqueaderos();
	}

	@Override
	protected void onStop(){
		super.onStop();
		dbHelper.closeDB();
	}

	@Override
	protected void onDestroy(){
		super.onDestroy();
		if(registrarInfraccion!=null){
			registrarInfraccion.cancel(true);
		}
		if(registrarInfraccion!=null){
			registrarInfraccion.cancel(true);
		}
		if(task!=null){
			task.cancel();
		}
		timer.cancel();
	}
}
