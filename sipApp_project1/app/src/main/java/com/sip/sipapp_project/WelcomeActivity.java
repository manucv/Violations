package com.sip.sipapp_project;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.sip.sipapp_project.R;

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.os.Handler;
import android.support.v4.app.NotificationCompat;
import android.support.v4.app.TaskStackBuilder;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

public class WelcomeActivity extends ParqueaderoActivity {
	private String cli_id;
	private String saldo;
	public static final String PREFS_NAME = "Preferencias";
	private String pub_link = "";
	private LinearLayout layoutActive;
	private LinkedHashMap<String, ActiveSpot> parqueaderos = new LinkedHashMap<String, ActiveSpot>();
	Context context = this;

	private SharedPreferences settings;
	public int version;

	public RelativeLayout publicidad;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.isMenuScreen = true;
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);
		super.txtSaldo = (TextView)findViewById(R.id.TxtSaldo);
		super.loadingInfo = (ProgressBar)findViewById(R.id.loadingInfo);

		Button btnCategorias = (Button)findViewById(R.id.BtnCategorias);
        Button btnMiCuenta = (Button)findViewById(R.id.BtnMiCuenta);
        Button btnComprar = (Button)findViewById(R.id.BtnComprar);
        Button btnPrestar = (Button)findViewById(R.id.BtnPrestar);
        Button btnInfo = (Button)findViewById(R.id.BtnInfo);
        Button btnSalir = (Button)findViewById(R.id.BtnSalir);
        Button btnEstado = (Button)findViewById(R.id.BtnEstado);
		publicidad = (RelativeLayout)findViewById(R.id.bannerBottom);
        
        layoutActive = (LinearLayout)findViewById(R.id.LayoutActive);
        
        settings = getSharedPreferences(PREFS_NAME, 0);
        //String nombre = settings.getString("NOMBRE", "(Sin Nombre)");
        
        cli_id = ""+settings.getInt("ID", 0);
        
        
        //Toast.makeText(this,"SALDO: "+settings.getFloat("SALDO", 0), Toast.LENGTH_LONG).show();
        
        
        //Recuperamos la información pasada en el intent
        Bundle bundle = this.getIntent().getExtras();
        
        //Construimos el mensaje a mostrar
        //txtSaludo.setText("Bienvenido " + bundle.getString("NOMBRE"));
        
        
        saldo=bundle.getString("SALDO");
        //txtSaldo.setText("$" + Float.parseFloat(super.getSaldo()));
        
        //new TareaWSCliente().execute();
        
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
                //Intent intent = new Intent(WelcomeActivity.this,LocationActivity.class);
                Intent intent = new Intent(context,ParkingActivity.class);
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
                Intent intent = new Intent(context,HistoryActivity.class);
                
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
                Intent intent = new Intent(context,MethodActivity.class);
                
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
                        new Intent(context,RelatedActivity.class);
                
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

                Intent intent = new Intent(context,MapActivity.class);
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

                Intent intent = new Intent(context,InfoActivity.class);
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
		    	alert.setMessage("Esta seguro de que desea salir y cerrar sesión del sistema.");

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
		                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);
						intent.addFlags(Intent.FLAG_ACTIVITY_NO_HISTORY);
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
			String url = "http://54.69.247.99/Violations/public/api/api/publicidad";	
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
				//Log.e("Error", e.getMessage());
				//e.printStackTrace();
			}
			return mIcon11;
		}
	
		@Override
		protected void onPostExecute(Bitmap result) {
			bmImage.setImageBitmap(result);
			publicidad.setVisibility(View.VISIBLE);
		}
	}	
	
	/***** Fin DownloadImageTask ******/
	/******* LastParkingWS ********/
	private class TareaWSParqueoActivo extends AsyncTask<String,Integer,Boolean> {
		private String message = "";
		String par_id="";
		int falta=0;
		String aut_placa="";
		@Override
		protected Boolean doInBackground(String... params) {
						
			boolean result = false;
			
			String url = "http://54.69.247.99/Violations/public/api/api/activos/"+cli_id;	
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
		        		falta = object.getInt("falta");
		        		aut_placa = object.getString("aut_placa");
		        			
		        		ActiveSpot activeSpot= new ActiveSpot(par_id,aut_placa,falta);
		        		parqueaderos.put(par_id, activeSpot);
		        		
		        	}
		        	
		        	System.out.println(parqueaderos);
					 
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
			
	    	if (result)
	    	{	
				Iterator it = parqueaderos.entrySet().iterator();
	    	    
	    	    while (it.hasNext()) {
	    	        final Map.Entry pairs = (Map.Entry)it.next();
	    	        final View activeRow = View.inflate(context, R.layout.row_active, null);
	    	        final TextView lblAut_placa = (TextView) activeRow.findViewById(R.id.LblAut_placa);
	    	        final TextView lblPar_id = (TextView) activeRow.findViewById(R.id.LblPar_id);
	    	        final TextView lblFalta = (TextView) activeRow.findViewById(R.id.LblFalta);
					final ImageButton btnSwitch = (ImageButton) activeRow.findViewById(R.id.BtnSwitch);

	    	        lblAut_placa.setText( ((ActiveSpot) pairs.getValue()).getAut_placa() );
	    	        lblPar_id.setText( ((ActiveSpot) pairs.getValue()).getPar_id() );
					btnSwitch.setOnClickListener(null);
					btnSwitch.setOnClickListener(new View.OnClickListener() {
						public void onClick(View v) {
							Log.v("Parqueadero", "switchear");

							AlertDialog.Builder  dialog = new AlertDialog.Builder(context);
							dialog.setTitle("Cambiar de Parqueadero");
							View dialogSelect = View.inflate(context, R.layout.dialog_switch, null);
							dialog.setView(dialogSelect);

							final EditText par_id_dest;
							par_id_dest = (EditText) dialogSelect.findViewById(R.id.editText);

							dialog.setPositiveButton("Cambiar", new DialogInterface.OnClickListener() {
								@Override
								public void onClick(DialogInterface paramDialogInterface, int paramInt) {
									// TODO Auto-generated method stub

									TareaWSCambiarParqueadero tarea = new TareaWSCambiarParqueadero();
									tarea.execute(
											((ActiveSpot) pairs.getValue()).getPar_id(),
											par_id_dest.getText().toString()
									);

									lblPar_id.setText(par_id_dest.getText().toString());
								}
							});

							dialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
								@Override
								public void onClick(DialogInterface paramDialogInterface, int paramInt) {
									// TODO Auto-generated method stub
								}
							});
							dialog.show();
						}
					});

	    	        
	    	        ((ActiveSpot) pairs.getValue()).setView(activeRow);
	    	        
	    			if(((ActiveSpot) pairs.getValue()).getFalta()!=0 && ((ActiveSpot) pairs.getValue()).getFalta() > 0){
	    				
	    			 long milliseconds=((ActiveSpot) pairs.getValue()).getFalta()*1000;
	    	   		 new CountDownTimer(milliseconds, 1000) {
	    	   			
	    			     @Override
	    				public void onTick(long millisUntilFinished) {
	    			    	long secondsUntilFinished=millisUntilFinished/1000;
	    	    	    	int hours = (int) secondsUntilFinished / 3600;
	    		    	    int remainder = (int) secondsUntilFinished - hours * 3600;
	    		    	    int mins = remainder / 60;
	    		    	    remainder = remainder - mins * 60;
	    		    	    int secs = remainder;
	    			    	
	    		    	    lblFalta.setText(String.format("%02d", hours)+":"+String.format("%02d", mins)+":"+String.format("%02d", secs));
	    		    	    
	    		    	    if(secondsUntilFinished==(15*60)) {
	    		    		  	NotificationCompat.Builder mBuilder =
	    		    			        new NotificationCompat.Builder(context)
	    		    			        .setSmallIcon(R.drawable.ic_launcher)
	    		    			        .setContentTitle("Tu Parqueo está por Expirar")
	    		    			        .setContentText("Tu parqueadero expira en 15 minutos");

	    		    			Intent resultIntent = new Intent(context, MainActivity.class);

	    		    			TaskStackBuilder stackBuilder = TaskStackBuilder.create(context);
	    		    			stackBuilder.addParentStack(MainActivity.class);
	    		    			stackBuilder.addNextIntent(resultIntent);
	    		    			PendingIntent resultPendingIntent =
	    		    			        stackBuilder.getPendingIntent(
	    		    			            0,
	    		    			            PendingIntent.FLAG_UPDATE_CURRENT
	    		    			        );
	    		    			mBuilder.setContentIntent(resultPendingIntent);
	    		    			NotificationManager mNotificationManager =
	    		    			    (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);
	    		    			mNotificationManager.notify(001, mBuilder.build());		    	
	    		    	    }
	    		    	    
	    		    	    if(secondsUntilFinished<(15*60)){
	    		    	    	lblAut_placa.setTextColor(Color.parseColor("#ff0000"));
	    		    	    	lblPar_id.setTextColor(Color.parseColor("#ff0000"));
	    		    	    	lblFalta.setTextColor(Color.parseColor("#ff0000"));
	    		    	    }
	    			     }
	    			     
	    			     @Override
	    			     public void onFinish() {
	    			    	 //lblFalta.setText("Tu Tiempo Ha Expirado");
	    			    	 activeRow.setVisibility(View.GONE);
	    			     }
	    			  }.start();
	    			}	    	        
	    			else{
	    				activeRow.setVisibility(View.GONE);
	    			}
	    	        
	    	        layoutActive.addView(activeRow);
	    	    }
	    	}
		}
	}
	/***** Fin LastParkingWS ******/

	private class TareaWSCambiarParqueadero extends AsyncTask<String,Integer,Boolean> {

		@Override
		protected Boolean doInBackground(String... params) {

			String par_id = params[0];		//txtName
			String par_id_dest = params[1];	//txtLastName

			String url = "http://54.69.247.99/Violations/public/api/api/parqueaderos/"+par_id;

			HttpClient httpClient = new DefaultHttpClient();
			HttpPost post = new HttpPost(url);

			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "par_id_dest", par_id_dest ) );

			try {
				post.setEntity(new UrlEncodedFormEntity(paramsArray));
				HttpResponse response = httpClient.execute(post);

				int status = response.getStatusLine().getStatusCode();

				switch (status) {
					case 200:    //case success
						Log.v("Cambiando parqueadero",response.toString());
					break;
				}

			} catch(Exception e){
				e.printStackTrace();
			}
			return true;
		}

		@Override
		protected void onPostExecute(Boolean result) {


		}
	}

}
