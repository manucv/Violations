package com.example.sipapp_project;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;

public class CardActivity extends ParqueaderoActivity {
	
	private String cli_id;
	private String saldo;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_card);
        
        cli_id=super.getCli_id();		
        saldo=super.getSaldo();
        
		TextView txtSaldoCard = (TextView)findViewById(R.id.TxtSaldoCard);
        txtSaldoCard.setText("$" + Float.parseFloat(saldo));
	}
}
