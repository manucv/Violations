package com.example.sipapp_project;

import android.os.Bundle;
import android.widget.TextView;

public class MethodActivity extends ParqueaderoActivity {
	
	private String cli_id;
	private String saldo;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_method);
        
		cli_id=super.getCli_id();
		saldo=super.getSaldo();
        
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldoMethod);
        txtSaldo.setText("$"+Float.parseFloat(saldo));
        
	}
}
