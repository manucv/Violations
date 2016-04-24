package com.example.sipappwatch;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;

public class ZonesActivity extends Activity {

	public static final String PREFS_NAME = "Configuration";
	private int usu_id;
	private String nombre;
	private boolean doubleBackToExitPressedOnce = false;

	Map<String, Integer> sectores = new LinkedHashMap<String, Integer>();

	private Spinner spnSectores;
	private TextView txtWelcome;
	private Context context;

	private View dialogExit;

	DBHelper dbHelper;

	@Override
	protected void onCreate(Bundle savedInstanceState) {

		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_zones);
		context = ZonesActivity.this;

		dbHelper = new DBHelper(context);


		//Preferencias y Variables Globales
		SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
		nombre = settings.getString("NOMBRE", "(Sin Nombre)");
		usu_id = settings.getInt("ID", 0);

		//Controles
		spnSectores = (Spinner) findViewById(R.id.SpnSectores);
		txtWelcome = (TextView) findViewById(R.id.TxtWelcome);

		txtWelcome.setText("Bienvenido " + nombre);

	}

	public void onSelectClick(View pressed) {
		System.out.println(sectores.entrySet());
		Intent intent = new Intent(context, ParkingActivity.class);
		Bundle b = new Bundle();
		b.putString("SEC_NOMBRE", spnSectores.getSelectedItem().toString());
		b.putInt("SEC_ID", sectores.get(spnSectores.getSelectedItem()));
		intent.putExtras(b);
		startActivity(intent);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		MenuInflater inflater = getMenuInflater();
		inflater.inflate(R.menu.main, menu);
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
	    // Handle item selection
		
		Intent intent;

	    switch (item.getItemId()) {
 
		case R.id.action_settings:
	        	intent = new Intent(context, ConfigActivity.class);
            	intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
 	            startActivity(intent);
			finish();
                System.exit(0);
	            return true;
		case R.id.action_logout:
	        	
	        	Builder dialog = new AlertDialog.Builder(context);
	            dialog.setMessage("Está seguro de que desea salir del sistema?" );
	            dialog.setPositiveButton("Salir", new DialogInterface.OnClickListener() {
	                 @Override
	                 public void onClick(DialogInterface paramDialogInterface, int paramInt) {
	                     // TODO Auto-generated method stub
	                	Intent intent = new Intent(context, MainActivity.class);
	                	intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
	     	            startActivity(intent);
	     	            finish();
		                System.exit(0);
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
	             return true;
			
		case R.id.action_plate:
        	intent = new Intent(context, PlateActivity.class);
        	intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
	            startActivity(intent);
	            finish();
            System.exit(0);
            return true;
            
	        default:
	            return super.onOptionsItemSelected(item);
	    }
	}
	
	@Override
	public void onBackPressed() {
		//return false;
	   // super.onBackPressed(); // Comment this super call to avoid calling finish()
	    if (doubleBackToExitPressedOnce) {
	        super.onBackPressed();
	        finish();
	        return;
	    }

	    this.doubleBackToExitPressedOnce = true;
	    Toast.makeText(this, "Presiona ATRAS nuevamente para salir de la aplicación", Toast.LENGTH_SHORT).show();
	    
	    new Handler().postDelayed(new Runnable() {

			@Override
			public void run() {
				doubleBackToExitPressedOnce = false;
			}
		}, 2000);
	}

	@Override
	protected void onStart(){
		super.onStart();
		dbHelper.openDB();

		/* Load Zone information for Spinner */
		Zone zone=new Zone();
		sectores = zone.getAll(dbHelper);

		List listaSectores = new ArrayList<String>();
		Iterator it = sectores.entrySet().iterator();
		while (it.hasNext()) {
			Map.Entry pairs = (Map.Entry) it.next();
			Log.v("mapa", pairs.getKey() + " = " + pairs.getValue());
			listaSectores.add(pairs.getKey());
		}

		ArrayAdapter<String> adaptador =
				new ArrayAdapter<String>(ZonesActivity.this,
						android.R.layout.simple_spinner_dropdown_item, listaSectores);

		spnSectores.setAdapter(adaptador);
	}

	@Override
	protected void onStop(){
		super.onStop();
		dbHelper.closeDB();
	}

}
