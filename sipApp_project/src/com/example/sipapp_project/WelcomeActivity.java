package com.example.sipapp_project;

import java.io.IOException;
import java.io.InputStream;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.os.Handler;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

public class WelcomeActivity extends Activity {
	private String cli_id;
	private String saldo;
	public static final String PREFS_NAME = "Preferencias";
	private boolean doubleBackToExitPressedOnce=false;
	private String pub_link = "";
	private TextView lblParking;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);
        
        TextView txtSaldo = (TextView)findViewById(R.id.TxtSaldo);
        //TextView txtWelcome = (TextView)findViewById(R.id.TxtWelcome);
        lblParking = (TextView)findViewById(R.id.LblParking);
        lblParking.setVisibility(View.GONE);
        Button btnCategorias = (Button)findViewById(R.id.BtnCategorias);
        Button btnMiCuenta = (Button)findViewById(R.id.BtnMiCuenta);
        Button btnComprar = (Button)findViewById(R.id.BtnComprar);
        Button btnPrestar = (Button)findViewById(R.id.BtnPrestar);
        Button btnInfo = (Button)findViewById(R.id.BtnInfo);
        Button btnSalir = (Button)findViewById(R.id.BtnSalir);
        Button btnEstado = (Button)findViewById(R.id.BtnEstado);
        
        SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
        String nombre = settings.getString("NOMBRE", "(Sin Nombre)");
        
        cli_id = ""+settings.getInt("ID", 0);
        //txtWelcome.setText("Bienvenido "+nombre);
        
        //Recuperamos la informaci—n pasada en el intent
        Bundle bundle = this.getIntent().getExtras();
        
        //Construimos el mensaje a mostrar
        //txtSaludo.setText("Bienvenido " + bundle.getString("NOMBRE"));
        saldo=bundle.getString("SALDO");
        txtSaldo.setText("$" + Float.parseFloat(saldo));
        //cli_id=bundle.getString("ID");
        
        ImageView banner = (ImageView) findViewById(R.id.ImgAmex);
        ImageView closeBanner = (ImageView) findViewById(R.id.closeBanner);
        final RelativeLayout bannerBottom = (RelativeLayout) findViewById(R.id.bannerBottom);
        
        banner.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	if(!pub_link.equals("")){
	            	Intent browser = new Intent(Intent.ACTION_VIEW);
	            	browser.setData(Uri.parse(pub_link));
	            	startActivity(browser);
            	}
            }
        });
        
        closeBanner.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
            	bannerBottom.setVisibility(View.GONE);
            }
        });
        
        new TareaWSParqueoActivo().execute();
    	new DownloadImageTask(banner).execute();
        
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
            			            	             
			    AlertDialog.Builder alert = new AlertDialog.Builder(WelcomeActivity.this);
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
			        	
			        	Intent intent = new Intent(WelcomeActivity.this, MainActivity.class);
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
            }
       });           
         
   }
	
	@Override
	public void onBackPressed()
	{
		//return false;
	   // super.onBackPressed(); // Comment this super call to avoid calling finish()
	    if (doubleBackToExitPressedOnce) {
	        super.onBackPressed();
	        finish();
	        return;
	    }

	    this.doubleBackToExitPressedOnce = true;
	    Toast.makeText(this, "Presiona ATRAS nuevamente para salir de la aplicaci—n", Toast.LENGTH_SHORT).show();
	    
	    new Handler().postDelayed(new Runnable() {
	    	
	        @Override
	        public void run() {
	            doubleBackToExitPressedOnce=false;                       
	        }
	    }, 2000);		
	}	
	
	
	/******* DownloadImageTask ********/

	class DownloadImageTask extends AsyncTask<String, Void, Bitmap> {
		ImageView bmImage;
	
		public DownloadImageTask(ImageView bmImage) {
			this.bmImage = bmImage;
		}
	
		@Override
		protected Bitmap doInBackground(String... params) {
			boolean result = false;
			String pub_imagen = null;
			String url = "http://www.hawasolutions.com/Violations2/public/api/api/publicidad";	
	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpGet get = new HttpGet(url);
	    	try {
				HttpResponse response = httpClient.execute(get);
				String responseStr = EntityUtils.toString(response.getEntity());
				if(!responseStr.equals("")){

	        		JSONObject object = new JSONObject(responseStr);
		        	pub_imagen = object.getString("pub_imagen");
		        	pub_link = object.getString("pub_link");	        		
				}
				
			} catch (ClientProtocolException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (IOException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	    	
			
			String urldisplay = pub_imagen;
			Bitmap mIcon11 = null;
			try {
				InputStream in = new java.net.URL(urldisplay).openStream();
				mIcon11 = BitmapFactory.decodeStream(in);
			} catch (Exception e) {
				Log.e("Error", e.getMessage());
				e.printStackTrace();
			}
			return mIcon11;
		}
	
		@Override
		protected void onPostExecute(Bitmap result) {
			bmImage.setImageBitmap(result);
		}
	}	
	
	/***** Fin DownloadImageTask ******/
	/******* LastParkingWS ********/
	private class TareaWSParqueoActivo extends AsyncTask<String,Integer,Boolean> {
		private String message = "";
		String par_id="";
		String falta="";
		String aut_placa="";
		@Override
		protected Boolean doInBackground(String... params) {
						
			boolean result = false;
			
			String url = "http://www.hawasolutions.com/Violations2/public/api/api/activos/"+cli_id;	
	    	HttpClient httpClient = new DefaultHttpClient();
	    	HttpGet get = new HttpGet(url);
			HttpResponse response;
			try {
				response = httpClient.execute(get);
				
				String responseStr = EntityUtils.toString(response.getEntity());
				
				if(!responseStr.equals("")){
					
		        	JSONArray responseJSON = new JSONArray(responseStr);
		        	
		        	for(int i=0; i<responseJSON.length(); i++)
		        	{
		        		JSONObject object = responseJSON.getJSONObject(i);

		        		par_id = object.getString("par_id");
		        		falta = object.getString("falta");
		        		aut_placa = object.getString("aut_placa");
		        		
		        		//Log.v("MsgWelcomeParqueo",aut_placa+" - "+par_id+" : "+falta);	
		        	}
					 
				}			

			} catch (ClientProtocolException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	    	
			return true;
			
		}
		
		@Override
		protected void onPostExecute(Boolean result) {
			//Log.v("MsgWelcomeParqueo2",aut_placa+" - "+par_id+" : "+falta);
			//lblParking.setText(aut_placa+" - "+par_id+" : "+falta);
			if(!falta.equals("") && Integer.parseInt(falta) > 0){
				lblParking.setVisibility(View.VISIBLE);
				
			 long milliseconds=Integer.parseInt(falta)*1000;
	   		 new CountDownTimer(milliseconds, 1000) {
	   			
			     @Override
				public void onTick(long millisUntilFinished) {
			    	long secondsUntilFinished=millisUntilFinished/1000;
	    	    	int hours = (int) secondsUntilFinished / 3600;
		    	    int remainder = (int) secondsUntilFinished - hours * 3600;
		    	    int mins = remainder / 60;
		    	    remainder = remainder - mins * 60;
		    	    int secs = remainder;
			    	
		    	    lblParking.setText(String.format("%02d", hours)+":"+String.format("%02d", mins)+":"+String.format("%02d", secs));
		    	    if(secondsUntilFinished<(15*60)){
		    	    	lblParking.setTextColor(Color.parseColor("#ff0000"));
		    	    }
			     }
			     
			     @Override
			     public void onFinish() {
			    	 lblParking.setText("Tu Tiempo Ha Expirado");
			     }
			  }.start();
			} else{
				lblParking.setVisibility(View.GONE);
			}
		}
	}
	/***** Fin LastParkingWS ******/	

}
