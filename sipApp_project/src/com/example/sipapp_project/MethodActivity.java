package com.example.sipapp_project;

import java.math.BigDecimal;

import com.paypal.android.sdk.payments.PayPalConfiguration;
import com.paypal.android.sdk.payments.PayPalPayment;
import com.paypal.android.sdk.payments.PayPalService;
import com.paypal.android.sdk.payments.PaymentActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class MethodActivity extends ParqueaderoActivity {
	
	private String cli_id;
	private String saldo;
	
	private static final String CONFIG_ENVIRONMENT = PayPalConfiguration.ENVIRONMENT_NO_NETWORK;
	private static final String CONFIG_CLIENT_ID = "credential from developer.paypal.com";
    private static final int REQUEST_CODE_PAYMENT = 1;
    
    private static PayPalConfiguration config = new PayPalConfiguration()
    .environment(CONFIG_ENVIRONMENT)
    .clientId(CONFIG_CLIENT_ID)
    // The following are only used in PayPalFuturePaymentActivity.
    .merchantName("Hipster Store")
    .merchantPrivacyPolicyUri(Uri.parse("https://www.example.com/privacy"))
    .merchantUserAgreementUri(Uri.parse("https://www.example.com/legal"));
	
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_method);
        
		cli_id=super.getCli_id();
		saldo=super.getSaldo();
        
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldoMethod);
        txtSaldo.setText("$"+Float.parseFloat(saldo));
   
        Intent intent = new Intent(this, PayPalService.class);
        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);
        startService(intent);
        
	}
	
    public void onPaypalClick(View pressed) {
        /* 
         * PAYMENT_INTENT_SALE will cause the payment to complete immediately.
         * Change PAYMENT_INTENT_SALE to 
         *   - PAYMENT_INTENT_AUTHORIZE to only authorize payment and capture funds later.
         *   - PAYMENT_INTENT_ORDER to create a payment for authorization and capture
         *     later via calls from your server.
         * 
         * Also, to include additional payment details and an item list, see getStuffToBuy() below.
         */
        PayPalPayment thingToBuy = getThingToBuy(PayPalPayment.PAYMENT_INTENT_SALE);

        /*
         * See getStuffToBuy(..) for examples of some available payment options.
         */

        Intent intent = new Intent(MethodActivity.this, PaymentActivity.class);

        intent.putExtra(PaymentActivity.EXTRA_PAYMENT, thingToBuy);

        startActivityForResult(intent, REQUEST_CODE_PAYMENT);
    }	
    
    private PayPalPayment getThingToBuy(String paymentIntent) {
        return new PayPalPayment(new BigDecimal("10"), "USD", "USD 10.00 Saldo",
                paymentIntent);
    }
    
    public void onPichinchaClick(View pressed) {
    	String url = "https://www.pichincha.com";
    	Intent i = new Intent(Intent.ACTION_VIEW);
    	i.setData(Uri.parse(url));
    	startActivityForResult(i,1);
    }
    
    public void onCardClick(View pressed) {
	    Intent intent = new Intent(MethodActivity.this,CardActivity.class);
	    Bundle b = new Bundle();
	    b.putString("ID", cli_id);
	    b.putString("SALDO", saldo);
	    intent.putExtras(b);
	    
	    startActivity(intent);
    }
}
