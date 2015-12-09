package com.example.sipappwatch;

//import com.example.tscdll.TSCActivity;

import android.app.ActionBar;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class ConfigActivity extends Activity {
	public static final String PREFS_NAME = "Configuration";
	private Context context;
	private EditText txtPrinterMAC;
	private String printer_mac;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_config);
		ActionBar actionBar = getActionBar();    
		actionBar.setDisplayHomeAsUpEnabled(true);
		
		context=ConfigActivity.this;
		txtPrinterMAC = (EditText)findViewById(R.id.txtPrinterMAC);
		
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
			
//		TSCActivity TscDll;
//		try {
//			TscDll = new TSCActivity();
//			TscDll.openport(printer_mac);
//			TscDll.setup(55, 70, 2, 10, 0, 0, 0);
//			TscDll.clearbuffer();
//			TscDll.sendcommand("DIRECTION 0\n");
//			TscDll.sendcommand("TEXT 10,50,\"2\",0,1,1,\"SIP Parking Solution\"\n");
//			TscDll.sendcommand("TEXT 10,100,\"2\",0,1,1,\"GAD Ibarra Ecuador\"\n");
//			TscDll.sendcommand("TEXT 10,150,\"3\",0,1,1,\"Pagina de Prueba\"\n");
//			TscDll.sendcommand("TEXT 10,200,\"3\",0,1,1,\"Impresora:\"\n");
//			TscDll.sendcommand("TEXT 10,250,\"3\",0,1,1,\""+printer_mac+"\"\n");
//			//String status = TscDll.status();
//			TscDll.printlabel(1, 1);
//			TscDll.closeport();
//		} catch (Exception e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		}
		
		
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
}
