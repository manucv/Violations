package com.example.sipappwatch;

import android.content.ContentValues;
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

/**
 * Created by lmpon_000 on 24/01/2016.
 */
public class ZoneSpot {
    private int sec_id;
    private String par_id;

    public DBHelper dbHelper;
    public String table_name = "parqueadero_sector";

    public TextView lblMessage;

    public ZoneSpot() {}

    public ZoneSpot(int sec_id, String par_id) {
        this.sec_id = sec_id;
        this.par_id = par_id;
    }

    public int getSec_id() {
        return sec_id;
    }

    public void setSec_id(int sec_id) {
        this.sec_id = sec_id;
    }

    public String getPar_id() {
        return par_id;
    }

    public void setPar_id(String par_id) {
        this.par_id = par_id;
    }

    public void retrieveAll(DBHelper dbHelper){
        this.dbHelper = dbHelper;
        dbHelper.empty(table_name);
        TareaWSSectoresParqueadero tareaSectoresParqueadero = new TareaWSSectoresParqueadero();
        tareaSectoresParqueadero.execute();

    }

    private class TareaWSSectoresParqueadero extends AsyncTask<String, Integer, Boolean> {
        boolean result = false;
        private String message;
        Map<Integer, ZoneSpot> parqueaderosSectores = new LinkedHashMap<Integer, ZoneSpot>();

        @Override
        protected Boolean doInBackground(String... params) {

            String url = "http://54.69.247.99/Violations/public/api/vigilante/parqueaderos-sectores";

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
                                Integer sec_id = obj.getInt("sec_id");
                                String par_id = obj.getString("par_id").toUpperCase();

                                ZoneSpot parqueaderoSector = new ZoneSpot(sec_id,par_id);

                                parqueaderosSectores.put(i,parqueaderoSector);
                            }

                            result = true;
                        } else {
                            result = false;
                            message = "Error al consultar los sectores";
                        }
                        break;
                    default:
                        result = false;
                        message = "Error al consultar los sectores";
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
                Iterator it = parqueaderosSectores.entrySet().iterator();
                while (it.hasNext()) {
                    Map.Entry pairs = (Map.Entry) it.next();

                    ContentValues values = new ContentValues();
                    ZoneSpot parqueaderoSector= (ZoneSpot) pairs.getValue();
                    values.put("sec_id",parqueaderoSector.getSec_id());
                    values.put("par_id",parqueaderoSector.getPar_id());
                    dbHelper.insert(table_name,values);
                }

                lblMessage.setText(lblMessage.getText().toString()+"Carga de Parqueaderos por Zonas Completa\n");
            }
        }
    }
}
