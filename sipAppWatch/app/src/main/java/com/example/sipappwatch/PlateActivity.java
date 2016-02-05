package com.example.sipappwatch;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONObject;

import android.app.ActionBar;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.google.android.gms.appindexing.Action;
import com.google.android.gms.appindexing.AppIndex;
import com.google.android.gms.common.api.GoogleApiClient;

public class PlateActivity extends Activity {

	private Context context;

	private ProgressBar loadingPlate;
	private ListView lstPlate;
	private TextView emptyPlate;
	private EditText txtPlate;
	/**
	 * ATTENTION: This was auto-generated to implement the App Indexing API.
	 * See https://g.co/AppIndexing/AndroidStudio for more information.
	 */
	private GoogleApiClient client;

	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_plate);
		ActionBar actionBar = getActionBar();
		//actionBar.setDisplayHomeAsUpEnabled(true);

		context = PlateActivity.this;

		loadingPlate = (ProgressBar) findViewById(R.id.loadingPlate);
		lstPlate = (ListView) findViewById(R.id.LstPlate);
		emptyPlate = (TextView) findViewById(R.id.EmptyPlate);
		txtPlate = (EditText) findViewById(R.id.txtPlate);

		// ATTENTION: This was auto-generated to implement the App Indexing API.
		// See https://g.co/AppIndexing/AndroidStudio for more information.
		client = new GoogleApiClient.Builder(this).addApi(AppIndex.API).build();
	}

	public boolean onOptionsItemSelected(MenuItem item) {
		super.onOptionsItemSelected(item);
		Intent intent = null;
		switch (item.getItemId()) {
			case android.R.id.home:
				intent = new Intent(context, ZonesActivity.class);
				break;
		}
		if (intent != null) {
			intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
			startActivity(intent);
			finish();
		}
		return super.onOptionsItemSelected(item);

	}

	@Override
	public void onBackPressed() {

		Intent intent = null;
		intent = new Intent(context, ZonesActivity.class);
		intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		startActivity(intent);
		finish();
	}

	public void onSearchClick(View pressed) {
		loadingPlate.setVisibility(View.VISIBLE);
		emptyPlate.setVisibility(View.GONE);

		TareaWSListarHistorial tarea = new TareaWSListarHistorial();
		String plate = txtPlate.getText().toString().toUpperCase();
		tarea.execute(plate);
	}

	@Override
	public void onStart() {
		super.onStart();

		// ATTENTION: This was auto-generated to implement the App Indexing API.
		// See https://g.co/AppIndexing/AndroidStudio for more information.
		client.connect();
		Action viewAction = Action.newAction(
				Action.TYPE_VIEW, // TODO: choose an action type.
				"Plate Page", // TODO: Define a title for the content shown.
				// TODO: If you have web page content that matches this app activity's content,
				// make sure this auto-generated web page URL is correct.
				// Otherwise, set the URL to null.
				Uri.parse("http://host/path"),
				// TODO: Make sure this auto-generated app deep link URI is correct.
				Uri.parse("android-app://com.example.sipappwatch/http/host/path")
		);
		AppIndex.AppIndexApi.start(client, viewAction);
	}

	@Override
	public void onStop() {
		super.onStop();

		// ATTENTION: This was auto-generated to implement the App Indexing API.
		// See https://g.co/AppIndexing/AndroidStudio for more information.
		Action viewAction = Action.newAction(
				Action.TYPE_VIEW, // TODO: choose an action type.
				"Plate Page", // TODO: Define a title for the content shown.
				// TODO: If you have web page content that matches this app activity's content,
				// make sure this auto-generated web page URL is correct.
				// Otherwise, set the URL to null.
				Uri.parse("http://host/path"),
				// TODO: Make sure this auto-generated app deep link URI is correct.
				Uri.parse("android-app://com.example.sipappwatch/http/host/path")
		);
		AppIndex.AppIndexApi.end(client, viewAction);
		client.disconnect();
	}

	private class TareaWSListarHistorial extends AsyncTask<String, Integer, Boolean> {
		private String[] infracciones;


		@Override
		protected Boolean doInBackground(String... params) {

			boolean resul = false;
			String plate = params[0];

			HttpClient httpClient = new DefaultHttpClient();
			HttpGet del = new HttpGet("http://54.69.247.99/Violations/sismert/infracciones.php?placa=" + plate);
			del.setHeader("content-type", "application/json");

			try {
				HttpResponse resp = httpClient.execute(del);
				String respStr = EntityUtils.toString(resp.getEntity());

				if (!respStr.equals("")) {
					JSONArray respJSON = new JSONArray(respStr);
					if (respJSON.length() > 0) {

						infracciones = new String[respJSON.length()];

						for (int i = 0; i < respJSON.length(); i++) {
							JSONObject obj = respJSON.getJSONObject(i);
							String numero = obj.getString("numero");
							String calles = obj.getString("calles");
							String fecha = obj.getString("fecha");
							String hora = obj.getString("hora");
							String valor = obj.getString("valor");

							infracciones[i] = "Infracción Nro. " + numero + " registrada el " + fecha + " a las " + hora + " en " + calles;


						}
						resul = true;
					} else {
						resul = false;
					}
				}
			} catch (Exception ex) {
				Log.e("ServicioRest", "Error!", ex);
				resul = false;
			}

			return resul;
		}

		@Override
		protected void onPostExecute(Boolean result) {
			if (result) {
				lstPlate.setVisibility(View.VISIBLE);
				//Rellenamos la lista con los nombres de los clientes
				//Rellenamos la lista con los resultados
				ArrayAdapter<String> adaptador =
						new ArrayAdapter<String>(context,
								android.R.layout.simple_list_item_1, infracciones);

				lstPlate.setAdapter(adaptador);

			} else {
				emptyPlate.setVisibility(View.VISIBLE);
				lstPlate.setVisibility(View.GONE);
			}
			loadingPlate.setVisibility(View.GONE);
		}
	}
}

