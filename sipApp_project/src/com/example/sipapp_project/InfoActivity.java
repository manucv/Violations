package com.example.sipapp_project;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;

public class InfoActivity extends Activity {
	private String cli_id;
	private String saldo;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_info);
		TextView txtSaldoInfo = (TextView)findViewById(R.id.TxtSaldoInfo);

		Bundle bundle = this.getIntent().getExtras();
        saldo=bundle.getString("SALDO");
        txtSaldoInfo.setText("$" + Float.parseFloat(saldo));
        cli_id=bundle.getString("ID");
	}
}
