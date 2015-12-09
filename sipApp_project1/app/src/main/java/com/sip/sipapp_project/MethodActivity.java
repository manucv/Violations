package com.sip.sipapp_project;

import java.util.HashMap;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONObject;

import com.sip.sipapp_project.R;
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
import android.app.AlertDialog.Builder;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.widget.ProgressBar;
import android.widget.TextView;

public class MethodActivity extends ParqueaderoActivity implements LocationListener, OnMarkerClickListener{
	
	private GoogleMap map;
	private HashMap<Marker,Integer> markers=new HashMap<Marker,Integer>();
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_method);

		super.txtSaldo = (TextView)findViewById(R.id.TxtSaldo);
		super.loadingInfo = (ProgressBar)findViewById(R.id.loadingInfo);

        int status = GooglePlayServicesUtil.isGooglePlayServicesAvailable(getBaseContext()); // Getting Google Play availability status

        if(status!=ConnectionResult.SUCCESS){ // Google Play Services are not available
            int requestCode = 10;
            Dialog dialog = GooglePlayServicesUtil.getErrorDialog(status, this, requestCode);
            dialog.show();
 
        } else { // Google Play Services are available
        	
            map = ((MapFragment) getFragmentManager().findFragmentById(R.id.mapStore)).getMap();
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
            
            TareaWSPuntosRecarga tarea = new TareaWSPuntosRecarga();
			tarea.execute();
			
        }        
        
        
	}
	

	@Override
	public void onLocationChanged(Location location) {
        
        double latitude = location.getLatitude(); 				// Getting latitude of the current location
        double longitude = location.getLongitude(); 			// Getting longitude of the current location
        LatLng latLng = new LatLng(latitude, longitude); 		// Creating a LatLng object for the current location
        map.moveCamera(CameraUpdateFactory.newLatLng(latLng));	// Showing the current location in Google Map
        map.animateCamera(CameraUpdateFactory.zoomTo(18)); 		// Zoom in the Google Map
        
	}

	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) { }

	@Override
	public void onProviderEnabled(String provider) { }

	@Override
	public void onProviderDisabled(String provider) { }
	
	private class TareaWSPuntosRecarga extends AsyncTask<String,Integer,Boolean> {
		
		private String[] arr_pun_rec_id;
		private String[] arr_pun_rec_nombre;
		private String[] arr_pun_rec_ruc;
		private String[] arr_pun_rec_lat;
		private String[] arr_pun_rec_lng;
		private String[] arr_pun_rec_direccion;
		private String[] arr_pun_rec_observaciones;
		private String[] arr_pun_rec_habilitado;
		
		@Override
		protected Boolean doInBackground(String... params) {
	    	
			String url = "http://54.69.247.99/Violations/public/api/api/recargas";

	    	HttpClient httpClient = new DefaultHttpClient();
			HttpGet get = new HttpGet(url);
	    				
			try {			
				HttpResponse response = httpClient.execute(get);
		        String responseStr = EntityUtils.toString(response.getEntity());
		        if(!responseStr.equals("")){
		        	JSONArray responseJSON = new JSONArray(responseStr);
		        	
		        	arr_pun_rec_id = new String[responseJSON.length()];
		        	arr_pun_rec_nombre = new String[responseJSON.length()];
		        	arr_pun_rec_ruc = new String[responseJSON.length()];
		        	arr_pun_rec_lat = new String[responseJSON.length()];
		        	arr_pun_rec_lng = new String[responseJSON.length()];
		        	arr_pun_rec_direccion = new String[responseJSON.length()];
		        	arr_pun_rec_observaciones = new String[responseJSON.length()];
		        	arr_pun_rec_habilitado = new String[responseJSON.length()];
		        			
		        	for(int i=0; i < responseJSON.length(); i++)
		        	{
		        		JSONObject obj = responseJSON.getJSONObject(i);
		        		
		        		String pun_rec_id = obj.getString("pun_rec_id");
		        		String pun_rec_nombre = obj.getString("pun_rec_nombre");
		        		String pun_rec_ruc = obj.getString("pun_rec_ruc");
		        		String pun_rec_lat = obj.getString("pun_rec_lat");
		        		String pun_rec_lng = obj.getString("pun_rec_lng");
		        		String pun_rec_direccion = obj.getString("pun_rec_direccion");
		        		String pun_rec_observaciones = obj.getString("pun_rec_observaciones");
		        		String pun_rec_habilitado = obj.getString("pun_rec_habilitado");
			        	
		        		arr_pun_rec_id[i] = pun_rec_id;
		        		arr_pun_rec_nombre[i] = pun_rec_nombre;
		        		arr_pun_rec_ruc[i] = pun_rec_ruc;
		        		arr_pun_rec_lat[i] = pun_rec_lat;
		        		arr_pun_rec_lng[i] = pun_rec_lng;
		        		arr_pun_rec_direccion[i] = pun_rec_direccion;
		        		arr_pun_rec_observaciones[i] = pun_rec_observaciones;
		        		arr_pun_rec_habilitado[i] = pun_rec_habilitado;
		        	
		        	}
		        
		        }
			} catch(Exception e){
				e.printStackTrace();	        	
		    }			
			return true;
		}
		
	    @Override
		protected void onPostExecute(Boolean result) {
	    	
        	for(int i=0; i < arr_pun_rec_id.length; i++)
        	{
        		if(arr_pun_rec_habilitado[i].equals("1")){
            		Marker marker = map.addMarker(new MarkerOptions()
    		        .position(new LatLng(Double.parseDouble(arr_pun_rec_lat[i]), Double.parseDouble(arr_pun_rec_lng[i])))
    		        .title(arr_pun_rec_nombre[i])
    		        .snippet("Recargas y Tarjetas")
    		        .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_ORANGE)));
            		markers.put(marker,Integer.parseInt(arr_pun_rec_id[i]));
        		}else{
            		Marker marker = map.addMarker(new MarkerOptions()
    		        .position(new LatLng(Double.parseDouble(arr_pun_rec_lat[i]), Double.parseDouble(arr_pun_rec_lng[i])))
    		        .title(arr_pun_rec_nombre[i])
    		        .snippet("Solo Tarjetas")
    		        .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_AZURE)));
            		markers.put(marker,Integer.parseInt(arr_pun_rec_id[i]));
        		}
        		
        		//TODO: la idea aquí es hacer un marker gris sí es q no hay espacios

        	}
	    }
	}

	@Override
	public boolean onMarkerClick(Marker marker) {
		// TODO Auto-generated method stub
		return false;
	}
}
