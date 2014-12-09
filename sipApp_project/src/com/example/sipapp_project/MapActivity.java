package com.example.sipapp_project;

import java.util.HashMap;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONObject;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.GoogleMap.OnMarkerClickListener;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.widget.TextView;



public class MapActivity extends ParqueaderoActivity implements LocationListener, OnMarkerClickListener{ //es necesario implementar un location listener para q funcione
	
	private GoogleMap map;
	private HashMap<Marker,Integer> markers=new HashMap<Marker,Integer>();
	private String cli_id;
	private String saldo;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map);
        
        //Construimos el mensaje a mostrar
        cli_id=super.getCli_id();		
        saldo=super.getSaldo();
        
		TextView txtSaldoMap = (TextView)findViewById(R.id.TxtSaldoMap);
        txtSaldoMap.setText("$" + Float.parseFloat(saldo));        
        
        int status = GooglePlayServicesUtil.isGooglePlayServicesAvailable(getBaseContext()); // Getting Google Play availability status

        if(status!=ConnectionResult.SUCCESS){ // Google Play Services are not available
            int requestCode = 10;
            Dialog dialog = GooglePlayServicesUtil.getErrorDialog(status, this, requestCode);
            dialog.show();
 
        } else { // Google Play Services are available
        	
            map = ((MapFragment) getFragmentManager().findFragmentById(R.id.map)).getMap();
            map.setMyLocationEnabled(true);
            map.setOnMarkerClickListener(this);         
            
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
            
            TareaWSSectores tarea = new TareaWSSectores();
			tarea.execute();
			
			
        }
        
	}

	@Override
	public void onLocationChanged(Location location) {
        
        double latitude = location.getLatitude(); 				// Getting latitude of the current location
        double longitude = location.getLongitude(); 			// Getting longitude of the current location
        LatLng latLng = new LatLng(latitude, longitude); 		// Creating a LatLng object for the current location
        map.moveCamera(CameraUpdateFactory.newLatLng(latLng));	// Showing the current location in Google Map
        map.animateCamera(CameraUpdateFactory.zoomTo(10)); 		// Zoom in the Google Map
        
	}

	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) { }

	@Override
	public void onProviderEnabled(String provider) { }

	@Override
	public void onProviderDisabled(String provider) { }

	private class TareaWSSectores extends AsyncTask<String,Integer,Boolean> {
		private String[] sectores;
		private String[] idSectores;
		private String[] latitude;
		private String[] longitude;
		private String[] taken;
		private String[] total;
		@Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://www.hawasolutions.com/Violations2/public/api/api/sectores";

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
        		//TODO: la idea aquí es hacer un marker gris sí es q no hay espacios

        	}
	    }
	}

	@Override
	public boolean onMarkerClick(Marker marker) {
		// TODO Auto-generated method stub
		
		Integer id =0;
		id = markers.get(marker);
		if(id > 0){
			//DESCOMENTAR LO DE ABAJO PARA QUE FUNCIONE LA REDIRECCIÓN
			/*
	        Intent intent = new Intent(MapActivity.this,ParkingActivity.class);
	        
	        Bundle bundle = new Bundle();
	        bundle.putString("ID", cli_id);
	        bundle.putString("SEC_ID", String.valueOf(id) );
	        bundle.putString("SALDO", saldo );
	        
	        intent.putExtras(bundle);                
	        
	        startActivity(intent);*/			
		}
		return false;
	}	
}
