package com.example.sipappwatch;

import android.app.ActionBar;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.tscdll.TSCActivity;

public class ConfigActivity extends ActionBarActivity {
	public static final String PREFS_NAME = "Configuration";
	private Context context;
	private EditText txtPrinterMAC;
	private String printer_mac;
	private TextView lblMessages;
	DBHelper dbHelper;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_config);
		ActionBar actionBar = getActionBar();    
		//actionBar.setDisplayHomeAsUpEnabled(true);
		
		context=ConfigActivity.this;
		dbHelper = new DBHelper(context);

		txtPrinterMAC = (EditText)findViewById(R.id.txtPrinterMAC);
		lblMessages = (TextView) findViewById(R.id.lblMessages);
		
		SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
		printer_mac = settings.getString("printer_mac","");
		txtPrinterMAC.setText(printer_mac);
		
		Toast.makeText(context, printer_mac, Toast.LENGTH_SHORT).show();
	}
	
	public void onSaveClick (View pressed){

		SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
	    SharedPreferences.Editor editor = settings.edit();
	    editor.putString("printer_mac", txtPrinterMAC.getText().toString());
	    editor.commit();
	    
		Toast.makeText(context, "Configuración Guardada Exitosamente", Toast.LENGTH_SHORT).show();
	}
	
	public void onPrintClick (View pressed){
			
		TSCActivity TscDll;
		try {
			TscDll = new TSCActivity();
			TscDll.openport(printer_mac);
			TscDll.setup(55, 70, 2, 10, 0, 0, 0);
			TscDll.clearbuffer();
			TscDll.sendcommand("DIRECTION 0\n");
			TscDll.sendcommand("TEXT 10,50,\"2\",0,1,1,\"SIP Parking Solution\"\n");
			TscDll.sendcommand("TEXT 10,100,\"2\",0,1,1,\"GAD Ibarra Ecuador\"\n");
			TscDll.sendcommand("TEXT 10,150,\"3\",0,1,1,\"Pagina de Prueba\"\n");
			TscDll.sendcommand("TEXT 10,200,\"3\",0,1,1,\"Impresora:\"\n");
			TscDll.sendcommand("TEXT 10,250,\"3\",0,1,1,\""+printer_mac+"\"\n");
			//String status = TscDll.status();
			TscDll.printlabel(1, 1);
			TscDll.closeport();
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		Toast.makeText(context, "Conectando a Impresora", Toast.LENGTH_SHORT).show();
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

	@Override
	public void onBackPressed() {

		Intent intent = null;
		intent = new Intent(context, ZonesActivity.class);
		intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		startActivity(intent);
		finish();
	}

	public void onUpdateClick (View pressed){
		/* Actualizamos Sectores */

		Toast.makeText(context, "Recuperando Información de la base de Datos", Toast.LENGTH_SHORT).show();
		Toast.makeText(context, "Cargando Sectores", Toast.LENGTH_SHORT).show();

		Toast.makeText(context, "Tabla SECTORES está vacia, iniciando descarga", Toast.LENGTH_SHORT).show();
		Zone zone=new Zone();
		zone.lblMessage = lblMessages;
		zone.retrieveAll(dbHelper);

		Toast.makeText(context, "Tabla PARQUEADEROS está vacia, iniciando descarga", Toast.LENGTH_SHORT).show();
		Spot spot=new Spot();
		spot.lblMessage = lblMessages;
		spot.retrieveAll(dbHelper);

		Toast.makeText(context, "Tabla PARQUEADEROS POR SECTOR está vacia, iniciando descarga", Toast.LENGTH_SHORT).show();
		ZoneSpot zoneSpot=new ZoneSpot();
		zoneSpot.lblMessage = lblMessages;
		zoneSpot.retrieveAll(dbHelper);

		Toast.makeText(context, "Tabla TIPOS DE INFRACCION está vacia, iniciando descarga", Toast.LENGTH_SHORT).show();
		InfractionType infraction_type=new InfractionType();
		infraction_type.lblMessage = lblMessages;
		infraction_type.retrieveAll(dbHelper);

	}

	@Override
	protected void onStart(){
		super.onStart();
		dbHelper.openDB();
	}

	@Override
	protected void onStop(){
		super.onStop();
		dbHelper.closeDB();
	}
}
