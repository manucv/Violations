package com.example.sipapp_project;

import android.app.ActionBar;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.TextView;

public class WelcomeActivity extends Activity {
	private String cli_id;
	private String saldo;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);
        
        ActionBar actionBar = getActionBar();
        String dateString = "SIP                  Quito, "+android.text.format.DateFormat.format("dd 'de' MMM. yyyy", new java.util.Date()).toString();
        actionBar.setTitle(dateString);
        
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldo);
        Button btnCategorias = (Button)findViewById(R.id.BtnCategorias);
        Button btnMiCuenta = (Button)findViewById(R.id.BtnMiCuenta);
        Button btnComprar = (Button)findViewById(R.id.BtnComprar);
        Button btnPrestar = (Button)findViewById(R.id.BtnPrestar);
        Button btnInfo = (Button)findViewById(R.id.BtnInfo);
        Button btnSalir = (Button)findViewById(R.id.BtnSalir);
        Button btnEstado = (Button)findViewById(R.id.BtnEstado);
        
        
        //Recuperamos la informaci—n pasada en el intent
        Bundle bundle = this.getIntent().getExtras();
        
        //Construimos el mensaje a mostrar
        //txtSaludo.setText("Bienvenido " + bundle.getString("NOMBRE"));
        saldo=bundle.getString("SALDO");
        txtSaldo.setText("$" + Float.parseFloat(saldo));
        cli_id=bundle.getString("ID");
        
        btnCategorias.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	Log.v("click","click en categorias");
                //Intent intent = new Intent(WelcomeActivity.this,LocationActivity.class);
                Intent intent = new Intent(WelcomeActivity.this,ParkingActivity.class);
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                b.putString("SALDO", saldo);
                intent.putExtras(b);                
                
                startActivity(intent);	
            	        	
            }
       });

        btnMiCuenta.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	Log.v("click","click en mi cuenta");
                Intent intent =
                        new Intent(WelcomeActivity.this,HistoryActivity.class);
                
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                b.putString("SALDO", saldo);
                
                intent.putExtras(b);                
                
                startActivity(intent);	
            	        	
            }
       });
        
        btnComprar.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	Log.v("click","click en mi cuenta");
                Intent intent =
                        new Intent(WelcomeActivity.this,MethodActivity.class);
                
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                b.putString("SALDO", saldo);
                
                intent.putExtras(b);                
                
                startActivity(intent);	
            	        	
            }
       });  
        
       
        btnPrestar.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	Log.v("click","click en prestar");
                Intent intent =
                        new Intent(WelcomeActivity.this,RelatedActivity.class);
                
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                b.putString("SALDO", saldo);                
                
                intent.putExtras(b);                
                
                startActivity(intent);	
            	        	
            }
       });  
        
        btnEstado.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent intent = new Intent(WelcomeActivity.this,MapActivity.class);
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                b.putString("SALDO", saldo);
                intent.putExtras(b);                
                
                startActivity(intent);	            	        	
            }
       });
        
        btnInfo.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent intent = new Intent(WelcomeActivity.this,InfoActivity.class);
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                b.putString("SALDO", saldo);
                intent.putExtras(b);                
                
                startActivity(intent);	            	        	
            }
       });        
        
        btnSalir.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	
                Intent intent = new Intent(WelcomeActivity.this, MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);		            	
                
                finish();
                System.exit(0);  	
            }
       });           
         
   }
	
	@Override
	public void onBackPressed()
	{
		//return false;
	   // super.onBackPressed(); // Comment this super call to avoid calling finish()
	}	

}
