package com.example.sipappwatch;

import android.content.ContentValues;
import android.database.Cursor;
import android.os.AsyncTask;
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
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.Map;

public class InfractionType {
	private int tip_inf_id;
	private int cat_inf_id;
	private String tip_inf_descripcion;
	private String tip_inf_legal;
	private Double tip_inf_valor;

	public DBHelper dbHelper;
	public String table_name = "tipo_infraccion";

	public TextView lblMessage;

	public InfractionType(){
	}

	public int getTip_inf_id() {
		return tip_inf_id;
	}

	public void setTip_inf_id(int tip_inf_id) {
		this.tip_inf_id = tip_inf_id;
	}

	public int getCat_inf_id() {
		return cat_inf_id;
	}

	public void setCat_inf_id(int cat_inf_id) {
		this.cat_inf_id = cat_inf_id;
	}

	public String getTip_inf_descripcion() {
		return tip_inf_descripcion;
	}

	public void setTip_inf_descripcion(String tip_inf_descripcion) {
		this.tip_inf_descripcion = tip_inf_descripcion;
	}

	public String getTip_inf_legal() {
		return tip_inf_legal;
	}

	public void setTip_inf_legal(String tip_inf_legal) {
		this.tip_inf_legal = tip_inf_legal;
	}

	public Double getTip_inf_valor() {
		return tip_inf_valor;
	}

	public void setTip_inf_valor(Double tip_inf_valor) {
		this.tip_inf_valor = tip_inf_valor;
	}

	public Map<String, InfractionType> getAll(DBHelper dbHelper){
		Map<String, InfractionType> tipos_infraccion = new LinkedHashMap<String, InfractionType>();
		Cursor cursor = dbHelper.getAll(table_name);
		for(cursor.moveToFirst();!cursor.isAfterLast();cursor.moveToNext()){
			InfractionType infractionType= new InfractionType();
			infractionType.setTip_inf_id(cursor.getInt(cursor.getColumnIndex("tip_inf_id")));;
			infractionType.setCat_inf_id(cursor.getInt(cursor.getColumnIndex("cat_inf_id")));
			infractionType.setTip_inf_descripcion(cursor.getString(cursor.getColumnIndex("tip_inf_descripcion")));
			infractionType.setTip_inf_legal(cursor.getString(cursor.getColumnIndex("tip_inf_legal")));
			infractionType.setTip_inf_valor(cursor.getDouble(cursor.getColumnIndex("tip_inf_valor")));

			tipos_infraccion.put(
					cursor.getString(cursor.getColumnIndex("tip_inf_descripcion")),infractionType
					);
		}

		return tipos_infraccion;
	}

	public void retrieveAll(DBHelper dbHelper){
		this.dbHelper = dbHelper;
		dbHelper.empty(table_name);
		TareaWSTiposInfracciones tareaTiposInfraccion = new TareaWSTiposInfracciones();
		tareaTiposInfraccion.execute();

	}

	private class TareaWSTiposInfracciones extends AsyncTask<String, Integer, Boolean> {
		boolean result = false;
		private String message;

		Map<String, InfractionType> tiposInfraccion = new LinkedHashMap<String, InfractionType>();

		@Override
		protected Boolean doInBackground(String... params) {

			String url = "http://54.69.247.99/Violations/public/api/vigilante/categoria_infracciones/1/tipo_infracciones";

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

								Integer tip_inf_id = obj.getInt("tip_inf_id");
								Integer cat_inf_id = obj.getInt("cat_inf_id");
								String tip_inf_descripcion = obj.getString("tip_inf_descripcion");
								String tip_inf_legal = obj.getString("tip_inf_legal");
								Double tip_inf_valor = obj.getDouble("tip_inf_valor");

								InfractionType type = new InfractionType();
										type.setTip_inf_id(tip_inf_id);
										type.setCat_inf_id(cat_inf_id);
										type.setTip_inf_descripcion(tip_inf_descripcion);
										type.setTip_inf_legal(tip_inf_legal);
										type.setTip_inf_valor(tip_inf_valor);

								tiposInfraccion.put(tip_inf_descripcion,type);
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

				Iterator it = tiposInfraccion.entrySet().iterator();
				while (it.hasNext()) {
					Map.Entry pairs = (Map.Entry) it.next();

					ContentValues values = new ContentValues();
					InfractionType type= (InfractionType) pairs.getValue();
					values.put("tip_inf_id",type.getTip_inf_id());
					values.put("cat_inf_id",type.getCat_inf_id());
					values.put("tip_inf_descripcion",type.getTip_inf_descripcion());
					values.put("tip_inf_legal",type.getTip_inf_legal());
					values.put("tip_inf_valor",type.getTip_inf_valor());

					dbHelper.insert(table_name,values);

				}

				lblMessage.setText(lblMessage.getText().toString()+"Carga de Tipos de Infracciones Completa\n");
			}
		}
	}

	
}
