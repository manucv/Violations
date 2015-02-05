package com.example.sipapp_project;

import android.app.Activity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

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
        
        final TextView txtCard = (TextView)findViewById(R.id.TxtCard);
        final ImageView imgAmex = (ImageView) findViewById(R.id.ImgAmex);
        final ImageView imgDiners = (ImageView) findViewById(R.id.ImgDiners);
        final ImageView imgDiscover = (ImageView) findViewById(R.id.ImgDiscover);
        final ImageView imgMastercard = (ImageView) findViewById(R.id.ImgMastercard);
        final ImageView imgVisa = (ImageView) findViewById(R.id.ImgVisa);
        
        txtCard.addTextChangedListener(new TextWatcher(){

			@Override
			public void beforeTextChanged(CharSequence s, int start, int count,
					int after) {
				// TODO Auto-generated method stub
				
			}

			@Override
			public void onTextChanged(CharSequence s, int start, int before,
					int count) {
				// TODO Auto-generated method stub
				
			}

			@Override
			public void afterTextChanged(Editable s) {
				// TODO Auto-generated method stub
				imgVisa.setImageResource(R.drawable.card_visa_disabled);
				imgDiners.setImageResource(R.drawable.card_diners_disabled);
				imgMastercard.setImageResource(R.drawable.card_mastercard_disabled);
				imgAmex.setImageResource(R.drawable.card_amex_disabled);
				imgDiscover.setImageResource(R.drawable.card_discover_disabled);
				
				if(txtCard.getText().toString().length()>10){
					if(txtCard.getText().toString().matches("^4[0-9]{6,}$")){
						imgVisa.setImageResource(R.drawable.card_visa);
					}else{
						if(txtCard.getText().toString().matches("^3(?:0[0-5]|[68][0-9])[0-9]{4,}$")){
							imgDiners.setImageResource(R.drawable.card_diners);
						}else{
							if(txtCard.getText().toString().matches("^5[1-5][0-9]{5,}$")){
								imgMastercard.setImageResource(R.drawable.card_mastercard);
							}else{
								if(txtCard.getText().toString().matches("^3[47][0-9]{5,}$")){
									imgAmex.setImageResource(R.drawable.card_amex);
								}else{
									if(txtCard.getText().toString().matches("^6(?:011|5[0-9]{2})[0-9]{3,}$")){
										imgDiscover.setImageResource(R.drawable.card_discover);
									}
								}
							}	
						}
					}
					
					
					//progressBar.setVisibility(View.VISIBLE);
					//TareaWSBuscarParqueadero tarea = new TareaWSBuscarParqueadero();
					//tarea.execute();
				}else{
					//if(currentMarker != null)
					//	currentMarker.remove();
				}
			}
        	
        });

        //txtCard
        //matches
        
	}
}
