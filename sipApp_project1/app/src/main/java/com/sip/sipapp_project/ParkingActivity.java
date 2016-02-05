package com.sip.sipapp_project;

import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.GoogleMap.OnMarkerClickListener;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

import android.app.AlertDialog;
import android.app.Dialog;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.AlertDialog.Builder;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.NotificationCompat;
import android.support.v4.app.TaskStackBuilder;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.AdapterView.OnItemSelectedListener;

public class ParkingActivity extends ParqueaderoActivity implements LocationListener, OnMarkerClickListener {
	private String cli_id;
	private String saldo;
	
	private EditText par_id;
	private Integer total=0;
	private Integer vacios=0;
	private Integer ocupados=0;
	private TextView lblTotal;
	private Spinner spnLog_par_horas_parqueo;
	private Double price = 0.0;
	private Double half_price = 0.0;
	
	private GoogleMap map;
	private HashMap<Marker,Integer> markers=new HashMap<Marker,Integer>();
	
	private String sec_id;	
	private String sec_latitud;
	private String sec_longitud;
	private String sec_nombre;
	
	Marker currentMarker;
	
	private ProgressBar progressBar;

	private boolean existeParqueadero = false;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_parking);
        
        final EditText txtAut_placa = (EditText)findViewById(R.id.TxtAut_placa);
        
        super.txtSaldo = (TextView)findViewById(R.id.TxtSaldo);
		super.loadingInfo = (ProgressBar)findViewById(R.id.loadingInfo);

        lblTotal = (TextView)findViewById(R.id.LblTotal);
        spnLog_par_horas_parqueo = (Spinner) findViewById(R.id.SpnLog_par_horas_parqueo);
        par_id = (EditText) findViewById(R.id.TxtPar_id);
        
        progressBar = (ProgressBar)findViewById(R.id.loadingParking);
        progressBar.setVisibility(View.GONE);
        
		cli_id=super.getCli_id();
		saldo=super.getSaldo();
		
		par_id.addTextChangedListener(new TextWatcher(){

			@Override
			public void beforeTextChanged(CharSequence s, int start, int count, int after) { }

			@Override
			public void afterTextChanged(Editable s) {
				existeParqueadero=false;
				if(par_id.getText().toString().length()>=2){
					progressBar.setVisibility(View.VISIBLE);
					TareaWSBuscarParqueadero tarea = new TareaWSBuscarParqueadero();
					tarea.execute();
				}else{
					if(currentMarker != null)
						currentMarker.remove();
				}
			}
				
			@Override
			public void onTextChanged(CharSequence s, int start, int before, int count) { }
			
		});

	     
		
        int status = GooglePlayServicesUtil.isGooglePlayServicesAvailable(getBaseContext()); // Getting Google Play availability status

        if(status!=ConnectionResult.SUCCESS){ // Google Play Services are not available
            int requestCode = 10;
            Dialog dialog = GooglePlayServicesUtil.getErrorDialog(status, this, requestCode);
            dialog.show();
 
        } else { // Google Play Services are available
        	
            map = ((MapFragment) getFragmentManager().findFragmentById(R.id.mapParking)).getMap();
            map.setMyLocationEnabled(true);
            map.setOnMarkerClickListener(this);
            map.getUiSettings().setScrollGesturesEnabled(false);

			double latitude = 0.350963; 		// Getting latitude of the current location
			double longitude =  -78.117815; 	// Getting longitude of the current location
			LatLng latLng = new LatLng(latitude, longitude); 		// Creating a LatLng object for the current location
			map.moveCamera(CameraUpdateFactory.newLatLng(latLng));
			map.animateCamera(CameraUpdateFactory.zoomTo(14));
            
            LocationManager locationManager = (LocationManager) getSystemService(LOCATION_SERVICE); // Getting LocationManager object from System Service LOCATION_SERVICE
            
            
            Boolean gps_enabled = null;
            Boolean network_enabled = null;
            try{
                gps_enabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);
            }catch(Exception ex){}
            try{
            	network_enabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
            }catch(Exception ex){}
            
            
            if(!gps_enabled || !network_enabled){
            	
                Builder  dialog = new AlertDialog.Builder(this);
                dialog.setMessage("Desea Activar los servicios de localización?" );
                 dialog.setPositiveButton("Ir", new DialogInterface.OnClickListener() {

                     @Override
                     public void onClick(DialogInterface paramDialogInterface, int paramInt) {
                         // TODO Auto-generated method stub
                         startActivityForResult(new Intent(android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS),100);//android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS), 100);
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
            
            Criteria criteria = new Criteria(); // Creating a criteria object to retrieve provider
            String provider = locationManager.getBestProvider(criteria, true); // Getting the name of the best provider
            Location location = locationManager.getLastKnownLocation(provider); // Getting Current Location

            if(location!=null){
                onLocationChanged(location);
            }
            locationManager.requestLocationUpdates(provider, 20000, 0, this);
        }

		ImageButton btnComprarParqueadero = (ImageButton)findViewById(R.id.BtnComprarParqueadero);
        
        btnComprarParqueadero.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
				if(existeParqueadero) {
					if(Integer.parseInt(spnLog_par_horas_parqueo.getSelectedItem().toString())>0) {
						if (!par_id.getText().toString().equals("") && !txtAut_placa.getText().toString().equals("")) {

							AlertDialog.Builder alert = new AlertDialog.Builder(ParkingActivity.this);
							alert.setTitle("Confirmación de Parqueo");
							DecimalFormat df = new DecimalFormat();
							df.setMaximumFractionDigits(2);

							final Double horas = Math.floor(Double.parseDouble(spnLog_par_horas_parqueo.getSelectedItem().toString()) / 60);
                            final Double medias_horas = Math.ceil(Double.parseDouble(spnLog_par_horas_parqueo.getSelectedItem().toString()) % 60 / 30);

							alert.setMessage("Está seguro de que desea realizar esta compra, se debitarán " +
									"$" + df.format((horas * price) + (medias_horas * half_price))
									+ " por " + spnLog_par_horas_parqueo.getSelectedItem().toString() + " Minutos.");

							alert.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
								@Override
								public void onClick(DialogInterface dialog, int whichButton) {
                                    if(Double.parseDouble(saldo)>0){
                                        if(((horas * price) + (medias_horas * half_price))<=Double.parseDouble(saldo)){
                                            progressBar.setVisibility(View.VISIBLE);

                                            TareaWSComprar tarea = new TareaWSComprar();
                                            tarea.execute(par_id.getText().toString(),
                                                    txtAut_placa.getText().toString(),
                                                    spnLog_par_horas_parqueo.getSelectedItem().toString() + "");
                                        }else{
                                            Toast toast= Toast.makeText(getApplicationContext(), "Su saldo es insuficiente, por favor cargue saldo en los puntos autorizados", Toast.LENGTH_LONG);
                                            toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
                                            toast.show();
                                        }
                                    }else{
                                        Toast toast= Toast.makeText(getApplicationContext(),
                                                "Su saldo es insuficiente, por favor cargue saldo en los puntos autorizados", Toast.LENGTH_LONG);
                                        toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
                                        toast.show();
                                    }
								}
							});

							alert.setNegativeButton("Cancel",
									new DialogInterface.OnClickListener() {
										@Override
										public void onClick(DialogInterface dialog, int whichButton) {
											//Do Nothing
										}
									});

							alert.show();

						} else {
							Toast toast= Toast.makeText(getApplicationContext(),
									"Debe llenar todos los campos", Toast.LENGTH_LONG);
							toast.setGravity(Gravity.CENTER_VERTICAL | Gravity.CENTER_HORIZONTAL, 0, 0);
							toast.show();
						}
					}else{
						Toast toast= Toast.makeText(getApplicationContext(),
								"Debe seleccionar un Tiempo valido", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
					}
				}
				else{
					Toast toast= Toast.makeText(getApplicationContext(),
						"Debe seleccionar un Parqueadero valido", Toast.LENGTH_LONG);
						toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
						toast.show();
				}
            }
        });
        
        spnLog_par_horas_parqueo.setOnItemSelectedListener(new OnItemSelectedListener() {

			@Override
			public void onItemSelected(AdapterView<?> parent,
					View view, int position, long id) {
				// TODO Auto-generated method stub
				DecimalFormat df = new DecimalFormat();
				df.setMaximumFractionDigits(2);

				Double horas = Math.floor(Double.parseDouble(parent.getItemAtPosition(position).toString()) / 60);
				Double medias_horas = Math.ceil(Double.parseDouble(parent.getItemAtPosition(position).toString()) % 60 /30);

				lblTotal.setText("$" + df.format((horas * price)+(medias_horas * half_price)));

			}

			@Override
			public void onNothingSelected(AdapterView<?> parent) {
				// TODO Auto-generated method stub
			}

    	});        
        
	} 

	private class TareaWSComprar extends AsyncTask<String,Integer,Boolean> {
		
		private String par_id;
		private String aut_placa;
		private String log_par_horas_parqueo;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = false;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();
	        
			String par_id=params[0];
			String aut_placa=params[1];
			String log_par_horas_parqueo=params[2];	
			
			String url = "http://54.69.247.99/Violations/public/api/api/comprar/"+cli_id;
			//String url = "http://192.168.1.169/Hawa/Violations/public/api/api/comprar/"+cli_id;
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "par_id", par_id ) );
			paramsArray.add( new BasicNameValuePair( "aut_placa", aut_placa ) );
			paramsArray.add( new BasicNameValuePair( "log_par_horas_parqueo", log_par_horas_parqueo ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = new HttpGet(uri);
				del.setHeader("content-type", "application/json");
				
				System.out.println(uri);
			
	        	HttpResponse resp = httpClient.execute(del);
                int status = resp.getStatusLine().getStatusCode();
                String respStr = EntityUtils.toString(resp.getEntity());
                switch (status){
                    case 200:
                        JSONObject respJSON = new JSONObject(respStr);

                        if(respStr.length() > 0){

                              /*Envío de Notificación al teléfono*/

                            NotificationCompat.Builder mBuilder =
                                    new NotificationCompat.Builder(ParkingActivity.this)
                                    .setSmallIcon(R.drawable.ic_launcher)
                                    .setContentTitle("Parqueo Exitoso")
                                    .setContentText("Tu parqueadero expira en "+spnLog_par_horas_parqueo.getSelectedItem().toString()+" minutos");

                            Intent resultIntent = new Intent(ParkingActivity.this, MainActivity.class);

                            TaskStackBuilder stackBuilder = TaskStackBuilder.create(ParkingActivity.this);
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

                          /*Fin de Env�o de notificaci�n*/

                             //Creamos el Intent
                             Intent intent =
                                     new Intent(ParkingActivity.this, WelcomeActivity.class);

                             //Creamos la informaci�n a pasar entre actividades
                             Bundle b = new Bundle();
                             b.putString("NOMBRE", respJSON.getString("usu_nombre")+" "+respJSON.getString("usu_apellido"));
                             b.putString("SALDO", respJSON.getString("cli_saldo"));
                             b.putString("ID", respJSON.getString("cli_id"));
                             b.putString("TRA_ID", respJSON.getString("tra_id"));

                             //A�adimos la informaci�n al intent
                             intent.putExtras(b);

                             //Iniciamos la nueva actividad
                             intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                             startActivity(intent);

                             //finish();
                             //System.exit(0);

                             resul=true;
                        }
                    break;
                    case 403:
                        resul=false;
                    break;
                }
			}
	        catch(Exception ex)
	        {
	        	Log.e("ServicioRest","Error!", ex);
	        	resul = false;
	        }
	 
	        return resul;
			//return true;
	    }
	    
	    @Override
		protected void onPostExecute(Boolean result) {
            progressBar.setVisibility(View.GONE);
	    	if (result)
	    	{
                Toast toast= Toast.makeText(getApplicationContext(),
                        "Compra Exitosa", Toast.LENGTH_LONG);
                toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
                toast.show();
	    	}else{
                Toast toast= Toast.makeText(getApplicationContext(),
                        "Error al comprar tiempo de parqueo, su saldo es insuficiente", Toast.LENGTH_LONG);
                toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
                toast.show();
            }
	    }
	}
	
	private class TareaWSListarParqueaderos extends AsyncTask<String,Integer,Boolean> {
		private String[] parqueaderos;
		 
	    @Override
		protected Boolean doInBackground(String... params) {
	    	
	    	boolean resul = true;
	    	
	    	HttpClient httpClient = new DefaultHttpClient();

	    	String sec_id = params[0];
			
			String url = "http://54.69.247.99/Violations/public/api/api/parqueaderos";
			List<NameValuePair> paramsArray = new ArrayList<NameValuePair>();
			paramsArray.add( new BasicNameValuePair( "sec_id", sec_id ) );
			URI uri = null;
			try {
				uri = new URI( url + "?" + URLEncodedUtils.format( paramsArray, "utf-8" ));
				HttpGet del = 
						new HttpGet(uri);
						
				del.setHeader("content-type", "application/json");	    	
	    				
				try
		        {			
		        	HttpResponse resp = httpClient.execute(del);
		        	String respStr = EntityUtils.toString(resp.getEntity());
		        	
		        	JSONArray respJSON = new JSONArray(respStr);
		        	

		        	for(int i=0; i<respJSON.length(); i++)
		        	{
		        		JSONObject obj = respJSON.getJSONObject(i);
			        	String estado = obj.getString("par_estado");
			        	
			        	if(estado.equals("D")){	
			        		vacios++; 
			        		} else { 
			        			ocupados++; 
			        			}
			        	total++;
		        	}
		        	Log.v("vacios",""+vacios);
		        	Log.v("total",""+total);
		        	
		        	parqueaderos = new String[vacios];
		        	int j=0;
		        	for(int i=0; i<respJSON.length(); i++)
		        	{		        	
		        		JSONObject obj = respJSON.getJSONObject(i);
			        	String par_id = obj.getString("par_id");
			        	String estado = obj.getString("par_estado");
			        	if(estado.equals("D")){
			        		parqueaderos[j] = par_id;
			        		j++;
			        	}	
		        	}	
		        }
		        catch(Exception ex)
		        {
		        	Log.e("ServicioRest","Error!", ex);
		        	resul = false;
		        }
			} catch (URISyntaxException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	        return resul;
	    }
	}
	
	private class TareaWSBuscarParqueadero extends AsyncTask<String,Integer,Boolean> {
		private String message = "No se encontró el parqueadero";
		@Override
		protected Boolean doInBackground(String... params) {
			boolean result = false;
			
			if(par_id.getText().toString().length()>=2){
				
				String url="http://54.69.247.99/Violations/public/api/api/parqueaderos/"+par_id.getText().toString();
				
		    	HttpClient httpClient = new DefaultHttpClient();
		    	HttpGet get = new HttpGet(url);
		    	try {
					HttpResponse response = httpClient.execute(get);
					int status = response.getStatusLine().getStatusCode();
					Log.v("Status Code",""+status);
					switch (status){
						case 200: 	//case success
							String responseStr = EntityUtils.toString(response.getEntity());
							if(!responseStr.equals("")){
								JSONObject responseJSON = new JSONObject(responseStr); 
								Log.v("resultado",responseStr);
								sec_id = responseJSON.getString("sec_id");	
								sec_latitud = responseJSON.getString("par_latitud");
								sec_longitud = responseJSON.getString("par_longitud");
								sec_nombre = responseJSON.getString("sec_nombre");
								price = Double.parseDouble(responseJSON.getString("sec_valor_hora"));
								half_price = Double.parseDouble(responseJSON.getString("sec_valor_media_hora"));
								return true;
							}
						break;
						default:
							message = "No se encontró el parqueadero";
							return false;
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
				
			}
				
			return false;
		}
	    @Override
		protected void onPostExecute(Boolean result) {
			map.clear();
	    	if (result)
	    	{
				existeParqueadero=true;
	    		currentMarker=map.addMarker(new MarkerOptions()
	            .position(new LatLng(Double.parseDouble(sec_latitud), Double.parseDouble(sec_longitud)))
	            .title(sec_nombre)
	            //.snippet("Espacios Libres "+(Integer.parseInt(total[i])-Integer.parseInt(taken[i]))+"/"+total[i])
	            .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_ORANGE)));
	    		//lblResultado.setText("" + idCli + "-" + nombCli + "-" + telefCli);
	    		
	        	LatLng latLng = new LatLng(Double.parseDouble(sec_latitud), Double.parseDouble(sec_longitud));
	            map.moveCamera(CameraUpdateFactory.newLatLng(latLng));	// Showing the current location in Google Map
				
	            DecimalFormat df = new DecimalFormat();
				df.setMaximumFractionDigits(2);

				Double horas = Math.floor(Double.parseDouble(spnLog_par_horas_parqueo.getSelectedItem().toString()) / 60);
				Double medias_horas = Math.ceil(Double.parseDouble(spnLog_par_horas_parqueo.getSelectedItem().toString()) % 60 /30);

				lblTotal.setText("$" + df.format((horas * price) + (medias_horas * half_price)));

	    	}else{
                Toast toast= Toast.makeText(getApplicationContext(),
                        message, Toast.LENGTH_LONG);
                toast.setGravity(Gravity.CENTER_VERTICAL|Gravity.CENTER_HORIZONTAL, 0, 0);
                toast.show();
	    	}
	    	progressBar.setVisibility(View.GONE);
	    }
	}

	@Override
	public boolean onMarkerClick(Marker marker) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public void onLocationChanged(Location location) {
		// TODO Auto-generated method stub
        
        if(currentMarker==null){
        	double latitude = location.getLatitude(); 				// Getting latitude of the current location
            double longitude = location.getLongitude(); 			// Getting longitude of the current location
            LatLng latLng = new LatLng(latitude, longitude); 		// Creating a LatLng object for the current location
            map.moveCamera(CameraUpdateFactory.newLatLng(latLng));	// Showing the current location in Google Map
        	map.animateCamera(CameraUpdateFactory.zoomTo(14)); 		// Zoom in the Google Map
        	
        }else{
        	LatLng latLng = new LatLng(Double.parseDouble(sec_latitud), Double.parseDouble(sec_longitud));
            map.moveCamera(CameraUpdateFactory.newLatLng(latLng));	// Showing the current location in Google Map
        }	

	}

	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onProviderDisabled(String provider) {
		// TODO Auto-generated method stub
		
	}
	
	private class TareaWSSectores extends AsyncTask<String,Integer,Boolean> {
		private String[] sectores;
		private String[] idSectores;
		private String[] latitude;
		private String[] longitude;
		private String[] taken;
		private String[] total;
		@Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://54.69.247.99/Violations/public/api/api/sectores";

	    	HttpClient httpClient = new DefaultHttpClient();
			HttpGet get = new HttpGet(url);
	    				
			try {			
				HttpResponse response = httpClient.execute(get);
		        String responseStr = EntityUtils.toString(response.getEntity());
		        if(!responseStr.equals("")){
		        	JSONArray responseJSON = new JSONArray(responseStr);
		        	sectores = new String[responseJSON.length()];
		        	idSectores = new String[responseJSON.length()];
		        	latitude = new String[responseJSON.length()];
		        	longitude = new String[responseJSON.length()];
		        	taken = new String[responseJSON.length()];
		        	total = new String[responseJSON.length()];
		        			
		        	for(int i=0; i < responseJSON.length(); i++)
		        	{
		        		JSONObject obj = responseJSON.getJSONObject(i);
		        		String sec_id = obj.getString("id");
		        		String sec_nombre = obj.getString("title").toUpperCase();
			        	String sec_latitude = obj.getString("lat");
			        	String sec_longitude = obj.getString("lng");
			        	String sec_taken = obj.getString("ocupados");
			        	String sec_total = obj.getString("total");
			        	
			        	sectores[i] = sec_nombre;
			        	idSectores[i] = sec_id;
			    		latitude[i] = sec_latitude;
			    		longitude[i] = sec_longitude;
			    		taken[i] = sec_taken;
			    		total[i] = sec_total;
		        	}
		        }
			} catch(Exception e){
				e.printStackTrace();	        	
		    }			
			return true;
		}	
	    @Override
		protected void onPostExecute(Boolean result) {

        	for(int i=0; i < idSectores.length; i++)
        	{
        		Marker marker = map.addMarker(new MarkerOptions()
        		        .position(new LatLng(Double.parseDouble(latitude[i]), Double.parseDouble(longitude[i])))
        		        .title(sectores[i])
        		        .snippet("Espacios Libres "+(Integer.parseInt(total[i])-Integer.parseInt(taken[i]))+"/"+total[i])
        		        .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_ORANGE)));
        		
        		markers.put(marker,Integer.parseInt(idSectores[i]));
        	}
	    }		
	}
}
