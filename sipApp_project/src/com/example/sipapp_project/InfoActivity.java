package com.example.sipapp_project;

import android.os.Bundle;
import android.widget.TextView;

public class InfoActivity extends ParqueaderoActivity {
	private String cli_id;
	private String saldo;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_info);
		
		cli_id=super.getCli_id();
		saldo=super.getSaldo();
		
		TextView txtSaldoInfo = (TextView)findViewById(R.id.TxtSaldoInfo);
        txtSaldoInfo.setText("$" + Float.parseFloat(saldo));
	}
}
