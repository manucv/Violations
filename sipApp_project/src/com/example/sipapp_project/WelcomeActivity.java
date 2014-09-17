package com.example.sipapp_project;

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
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);
        
        TextView txtSaludo = (TextView)findViewById(R.id.TxtSaludo);
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldo);
        Button btnCategorias = (Button)findViewById(R.id.BtnCategorias);
        Button btnMiCuenta = (Button)findViewById(R.id.BtnMiCuenta);
        Button btnComprar = (Button)findViewById(R.id.BtnComprar);
        Button btnPrestar = (Button)findViewById(R.id.BtnPrestar);
        
        
        //Recuperamos la informaci—n pasada en el intent
        Bundle bundle = this.getIntent().getExtras();
        
        //Construimos el mensaje a mostrar
        txtSaludo.setText("Bienvenido " + bundle.getString("NOMBRE"));
        txtSaldo.setText("$" + bundle.getString("SALDO"));
        cli_id=bundle.getString("ID");
        
        btnCategorias.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	Log.v("click","click en categorias");
                Intent intent =
                        new Intent(WelcomeActivity.this,LocationActivity.class);
                
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                
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
                
                intent.putExtras(b);                
                
                startActivity(intent);	
            	        	
            }
       });
        
        btnComprar.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	Log.v("click","click en mi cuenta");
                Intent intent =
                        new Intent(WelcomeActivity.this,BuyActivity.class);
                
                Bundle b = new Bundle();
                b.putString("ID", cli_id);
                
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
                
                intent.putExtras(b);                
                
                startActivity(intent);	
            	        	
            }
       });          
         
   }

}
