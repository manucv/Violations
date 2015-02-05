package com.example.sipapp_project;

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.view.Gravity;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.Toast;


public class ParqueaderoActivity extends Activity {
	
	private String cli_id;
	private String saldo;
	public static final String PREFS_NAME = "Preferencias";
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		
		super.onCreate(savedInstanceState);
        ActionBar actionBar = getActionBar();
        actionBar.setDisplayHomeAsUpEnabled(true);
        
        //Recuperamos la informaci—n pasada en el intent
        Bundle bundle = this.getIntent().getExtras();
        
        //Construimos el mensaje a mostrar
        cli_id=bundle.getString("ID");		
        saldo=bundle.getString("SALDO");
        
        this.setSaldo(saldo);
        
        //Controlamos que exista conexi—n a internet
		 if (!isNetworkAvailable()) {
			 Toast toast=Toast.makeText(ParqueaderoActivity.this, "Su  dispositivo no tiene conexi—n a Internet en este momento", Toast.LENGTH_LONG);
			 toast.setGravity(Gravity.TOP|Gravity.CENTER_HORIZONTAL, 0, 500);
			 toast.show();
			 
             Intent intent = new Intent(ParqueaderoActivity.this, MainActivity.class);
             intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
             startActivity(intent);
		 }	 
        //Fin de control de acceso a Internet 
        
	}
	
	public void setSaldo(String saldo){ this.saldo=saldo; }
	public String getSaldo(){ return this.saldo; }
	
	public void setCli_id(String cli_id){ this.cli_id=cli_id; }
	public String getCli_id(){ return this.cli_id; }
	
    @Override
    public boolean onCreateOptionsMenu(Menu menu){
    	 MenuInflater inflater = getMenuInflater();
    	    inflater.inflate(R.menu.navigation, menu);
    	    return super.onCreateOptionsMenu(menu);    	
    }
    
    @Override
    public boolean onOptionsItemSelected(MenuItem item){
    	super.onOptionsItemSelected(item);
    	
    	Context context = getApplicationContext();
    	
    	Intent intent=null;
    	switch(item.getItemId()){
    		case R.id.ItemComprar:
                 intent = new Intent(context,ParkingActivity.class);
    		break;
    		case R.id.ItemCargar:
    			intent = new Intent(context,MethodActivity.class);
    		break;
    		case R.id.ItemContactos:
    			intent = new Intent(context,RelatedActivity.class);
    		break;
    		case R.id.ItemDisponibilidad:
    			intent = new Intent(context,MapActivity.class);
    		break;
    		case R.id.ItemMiCuenta:
    			intent = new Intent(context,HistoryActivity.class);
    		break;
    		case R.id.ItemAcercaDe:
    			intent = new Intent(context,InfoActivity.class);
    		break;
    		case R.id.ItemSalir:
                /*intent = new Intent(context, MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);		            	
                
                finish();
                System.exit(0);  */
    			
			    AlertDialog.Builder alert = new AlertDialog.Builder(ParqueaderoActivity.this);
			    alert.setTitle("Salir");
		    	alert.setMessage("Esta seguro de que desea salir y cerrar sesi—n del sistema.");

			    alert.setPositiveButton("Salir", new DialogInterface.OnClickListener() {
			        @Override
					public void onClick(DialogInterface dialog, int whichButton) {
			        	
		                 /*Bloque preferencias compartidas*/
		                 SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
		                 SharedPreferences.Editor editor = settings.edit();
		                 
		                 editor.putInt("ID", 0);
		                 editor.putString("NOMBRE", "");
		                 editor.putFloat("SALDO", 0);
		                 
		                 editor.commit();
		                 /*Fin Bloque preferencias compartidas*/			        	
			        	
			        	Intent intent = new Intent(ParqueaderoActivity.this, MainActivity.class);
		                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		                startActivity(intent);
		                
		                finish();
		                System.exit(0);
		    	        return;
			        }
			    });
			    
			    alert.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
		            @Override
					public void onClick(DialogInterface dialog, int whichButton) {
		            	//Do Nothing
		            }
	            });
			    
			    alert.show();    			
    			
    			
    		break;
    	    case android.R.id.home:
    	    	intent = new Intent(context,WelcomeActivity.class);
    	    break;
    		
    	}
    	if(intent != null){
    		intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
	    	Bundle b = new Bundle();
	        b.putString("ID", cli_id);
	        b.putString("SALDO", saldo);
	        intent.putExtras(b);                
	        startActivity(intent);
	        finish();
    	}
    	return super.onOptionsItemSelected(item);
    	
    }
    
	private boolean isNetworkAvailable() {
	    ConnectivityManager connectivityManager 
	         = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
	    NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
	    return activeNetworkInfo != null;
	}
	
	@Override
	public void onBackPressed()
	{
        Intent intent = new Intent(ParqueaderoActivity.this, WelcomeActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        //Creamos la informaci—n a pasar entre actividades
        Bundle b = new Bundle();
        b.putString("NOMBRE", "");
        b.putString("SALDO", saldo);
        b.putString("ID", cli_id);
        
        intent.putExtras(b);

        //Iniciamos la nueva actividad
        startActivity(intent);	
	}	
}
