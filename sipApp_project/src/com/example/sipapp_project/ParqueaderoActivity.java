package com.example.sipapp_project;

import android.app.ActionBar;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;

public class ParqueaderoActivity extends Activity {
	
	private String cli_id;
	private String saldo;
	
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
                intent = new Intent(context, MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);		            	
                
                finish();
                System.exit(0);  
    		break;
    	    case android.R.id.home:
    	    	intent = new Intent(context,WelcomeActivity.class);
    	    break;
    		
    	}
    	if(intent != null){
	    	Bundle b = new Bundle();
	        b.putString("ID", cli_id);
	        b.putString("SALDO", saldo);
	        intent.putExtras(b);                
	        startActivity(intent);
    	}
    	return super.onOptionsItemSelected(item);
    	
    }
}
