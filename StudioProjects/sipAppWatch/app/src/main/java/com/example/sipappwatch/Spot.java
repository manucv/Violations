package com.example.sipappwatch;

import android.content.ContentValues;
import android.content.Context;
import android.os.AsyncTask;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.Map;

public class Spot {
	private String par_id;
	private String par_estado;
	private String par_tipo;
	private String aut_placa;
	private String par_tipo_compra;
	private Date par_fecha_ingreso;
	private int par_horas_parqueo;
	private int inf_id;
	private View view;

	public DBHelper dbHelper;
	public String table_name = "parqueadero";

	public TextView lblMessage;

	public Spot(){}

	public Spot(String par_id, String par_tipo, String par_estado){
		this.par_id=par_id;
		this.par_tipo=par_tipo;
		this.par_estado=par_estado;
	}
	
	public String getPar_tipo() {
		return par_tipo;
	}

	public void setPar_tipo(String par_tipo) {
		this.par_tipo = par_tipo;
	}

	public View getView() {
		return view;
	}

	public View createView (Context context){
		View buttonSpot = View.inflate(context, R.layout.button_spot, null);
		Button btnSpot = (Button) buttonSpot.findViewById(R.id.BtnSpot);
		TextView txtInfo=(TextView) buttonSpot.findViewById(R.id.TxtInfo);
		btnSpot.setText(this.getPar_id());
		txtInfo.setText(this.getAut_placa());
		this.setView(buttonSpot);
		this.setPar_fecha_ingreso(this.getPar_fecha_ingreso());
		return buttonSpot;
	}

	public void setView(View view) {
		this.view = view;
		setBackground();
	}

	public String getPar_id() {
		return par_id;
	}

	public String getAut_placa(){
		return aut_placa; 
	}
	
	public void setPar_id(String par_id) {
		this.par_id = par_id;
	}

	public String getPar_estado() {
		return par_estado;
	}

	public void setPar_estado(String par_estado) {
		this.par_estado = par_estado;
		if(this.getView()!=null){
			setBackground();
		}
	}

	public void setAut_placa(String aut_placa) {
		this.aut_placa = aut_placa;
		if(this.getView()!=null){
			TextView txtInfo=(TextView) this.getView().findViewById(R.id.TxtInfo);
			txtInfo.setText(aut_placa);
		}
	}
	
	public Date getPar_fecha_ingreso() {
		return par_fecha_ingreso;
	}
	
	public void setPar_fecha_ingreso(Date par_fecha_ingreso) {
		this.par_fecha_ingreso = par_fecha_ingreso;
		if(this.getView()!=null) {
			TextView txtTimer=(TextView) this.getView().findViewById(R.id.TxtTimer);
			if (par_fecha_ingreso != null) {
				if (this.getPar_estado().equals("X")) {
					txtTimer.setText(this.getElapsedTime());
				} else {
					txtTimer.setText(this.getRemainingTime());
				}
			} else{
				txtTimer.setText("");
			}
		}
	}
	
	public int getPar_horas_parqueo() {
		return par_horas_parqueo;
	}
	
	public void setPar_horas_parqueo(int par_horas_parqueo) {
		this.par_horas_parqueo = par_horas_parqueo;
	}	
	
	public int getInf_id() {
		return inf_id;
	}
	
	public void setInf_id(int inf_id) {
		this.inf_id = inf_id;
	}

	public String getPar_tipo_compra() {
		return par_tipo_compra;
	}

	public void setPar_tipo_compra(String par_tipo_compra) {
		this.par_tipo_compra = par_tipo_compra;
	}

	public String getRemainingTime(){

		if(this.par_fecha_ingreso != null){
			Date current = new Date();
			Calendar cal = Calendar.getInstance(); // creates calendar
		    cal.setTime(this.par_fecha_ingreso); // sets calendar time/date
		    cal.add(Calendar.MINUTE, this.par_horas_parqueo); // adds one hour
		    
			long diff = (cal.getTimeInMillis()-current.getTime())/1000/60;
		    //System.out.println(this.par_id+"-"+this.par_fecha_ingreso+"-"+this.par_horas_parqueo+"-"+diff);
			int hours = (int) Math.floor(diff/60);
			int minutes = (int)(diff-(hours*60));
			return "Falta: "+String.format("%02d", hours)+":"+String.format("%02d", minutes);
		}
		return "";
	}

	public String getElapsedTime(){

		if(this.par_fecha_ingreso != null){
			Date current = new Date();
			Calendar cal = Calendar.getInstance(); // creates calendar
			cal.setTime(this.par_fecha_ingreso); // sets calendar time/date

			long diff = (current.getTime()-cal.getTimeInMillis())/1000/60;
			int hours = (int) Math.floor(diff/60);
			int minutes = (int)(diff-(hours*60));
			return "Lleva: "+String.format("%02d", hours)+":"+String.format("%02d", minutes);
		}
		return "";
	}

	public void retrieveAll(DBHelper dbHelper){
		this.dbHelper = dbHelper;
		dbHelper.empty(table_name);
		TareaWSParqueaderos tareaParqueaderos = new TareaWSParqueaderos();
		tareaParqueaderos.execute();
	}

	public void note(DBHelper dbHelper, String aut_placa){
		Date current = new Date();
		this.setPar_estado("X");
		this.setAut_placa(aut_placa);
		this.setPar_fecha_ingreso(current);
		this.update(dbHelper, this);
	}
	public void release(DBHelper dbHelper){
		this.setPar_estado("D");
		this.setAut_placa("");
		this.setPar_fecha_ingreso(null);
		this.setPar_horas_parqueo(0);
		this.setInf_id(0);
		this.update(dbHelper, this);
	}


	public void addInfraction(DBHelper dbHelper, String aut_placa){
		Date current = new Date();
		this.setPar_estado("R");
		if(this.view!=null){
			Button btnSpot = (Button) this.view.findViewById(R.id.BtnSpot);
			btnSpot.setBackgroundResource(R.drawable.violation_upload);
		}
		aut_placa = aut_placa.toUpperCase();
		this.setAut_placa(aut_placa);
		this.setPar_fecha_ingreso(null);
		//this.update(dbHelper, this);
	}

	public void park(DBHelper dbHelper, String aut_placa){
		Date current = new Date();
		this.setPar_estado("O");
		if(this.view!=null){
			Button btnSpot = (Button) this.view.findViewById(R.id.BtnSpot);
			btnSpot.setBackgroundResource(R.drawable.occupied_upload);
		}
		aut_placa = aut_placa.toUpperCase();
		this.setAut_placa(aut_placa);
		this.setPar_fecha_ingreso(null);
		//this.update(dbHelper, this);
	}

	public boolean update(DBHelper dbHelper, Spot spot){
		this.dbHelper = dbHelper;
		ContentValues values = new ContentValues();
		values.put("par_estado", spot.getPar_estado());
		values.put("aut_placa", spot.getAut_placa());

		Date start = spot.getPar_fecha_ingreso();
		if(start!=null){
			SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
			String formattedDate = df.format(start);
			values.put("par_fecha_ingreso", formattedDate);
		}else{
			values.put("par_fecha_ingreso", "");
		}

		if(dbHelper.update(table_name, values, "par_id='"+par_id+"'")>0){
			return true;
		}
		return false;
	}



	private void setBackground(){
		if(this.view != null){
			Button btnSpot = (Button) this.view.findViewById(R.id.BtnSpot);
			if(this.par_estado.equals("D")){
				if(this.par_tipo.equals("N")){
					btnSpot.setBackgroundResource(R.drawable.empty);
				}else{
					if(this.par_tipo.equals("V")) {
						btnSpot.setBackgroundResource(R.drawable.empty_forbidden);
					}else if(this.par_tipo.equals("M")) {
						btnSpot.setBackgroundResource(R.drawable.empty_bike);
					}else{
						btnSpot.setBackgroundResource(R.drawable.empty_handicap);
					}
				}
			}else{
				if(this.par_estado.equals("O")){
					if(this.par_tipo_compra != null && this.par_tipo_compra.equals("I")){
						btnSpot.setBackgroundResource(R.drawable.occupied_online);
					}else{
						btnSpot.setBackgroundResource(R.drawable.occupied);
					}
				}else if(this.par_estado.equals("X")){
					btnSpot.setBackgroundResource(R.drawable.noted);
				} else {
					if(this.par_estado.equals("L")){
						btnSpot.setBackgroundResource(R.drawable.violation_lock);
					}else{
						btnSpot.setBackgroundResource(R.drawable.violation);
					}

				}
			}
		}
	}

	private class TareaWSParqueaderos extends AsyncTask<String, Integer, Boolean> {
		boolean result = false;
		private String message;

		Map<String, Spot> parqueaderos = new LinkedHashMap<String, Spot>();

		@Override
		protected Boolean doInBackground(String... params) {

			String url = "http://54.69.247.99/Violations/public/api/vigilante/parqueaderos";

			HttpClient httpClient = new DefaultHttpClient();
			HttpGet get = new HttpGet(url);

			try {

				HttpResponse response = httpClient.execute(get);
				int status = response.getStatusLine().getStatusCode();

				switch (status) {
					case 200:    //case success

						String responseStr = EntityUtils.toString(response.getEntity());
						if (!responseStr.equals("")) {
							JSONArray responseJSON = new JSONArray(responseStr);
							for (int i = 0; i < responseJSON.length(); i++) {
								JSONObject obj = responseJSON.getJSONObject(i);

								/*Campos necesarios para la creación del Spot*/
								String par_id = obj.getString("par_id");
								String par_tipo = obj.getString("par_tipo").toUpperCase();

								/*Campos extra
								String par_estado = obj.getString("par_estado").toUpperCase();
								String aut_placa = obj.getString("aut_placa").toUpperCase();
								String par_fecha_ingreso_string = obj.getString("par_fecha_ingreso");
								int inf_id = obj.getInt("inf_id");
								int par_horas_parqueo = obj.getInt("par_horas_parqueo");
								*/

								Spot parqueadero = new Spot(par_id,par_tipo,"D");

								parqueaderos.put(par_id,parqueadero);
							}
							result = true;
						} else {
							result = false;
							message = "Error al consultar los tipos de infracción";
						}
						break;
					default:
						result = false;
						message = "Error al consultar los tipos de infracción";
						break;
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

			return result;
		}

		@Override
		protected void onPostExecute(Boolean result) {

			if (result) {

				Iterator it = parqueaderos.entrySet().iterator();
				while (it.hasNext()) {
					Map.Entry pairs = (Map.Entry) it.next();

					ContentValues values = new ContentValues();
					Spot parqueadero= (Spot) pairs.getValue();

					values.put("par_id",parqueadero.getPar_id());
					values.put("par_tipo",parqueadero.getPar_tipo());
					values.put("par_estado", parqueadero.getPar_estado());
					dbHelper.insert(table_name, values);

				}

				lblMessage.setText(lblMessage.getText().toString()+"Carga de Parqueadero Completa\n");
			}
		}
	}

}
