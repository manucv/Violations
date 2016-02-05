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
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.Map;

/**
 * Created by lmpon_000 on 18/01/2016.
 */
public class Zone {
    private int sec_id;
    private String sec_nombre;

    public DBHelper dbHelper;
    public String table_name = "sector";

    public TextView lblMessage;

    public Zone (){
    }

    public int getSec_id() {
        return sec_id;
    }

    public void setSec_id(int sec_id) {
        this.sec_id = sec_id;
    }

    public String getSec_nombre() {
        return sec_nombre;
    }

    public void setSec_nombre(String sec_nombre) {
        this.sec_nombre = sec_nombre;
    }

    public Map<String, Spot> getSpots(DBHelper dbHelper,int sec_id){
        Map<String, Spot> parqueaderos = new LinkedHashMap<String, Spot>();

        Cursor cursor = dbHelper.rawQuery("SELECT * FROM parqueadero JOIN parqueadero_sector ON parqueadero.par_id=parqueadero_sector.par_id WHERE sec_id = "+sec_id);

        for(cursor.moveToFirst();!cursor.isAfterLast();cursor.moveToNext()){
            Spot parqueadero = new Spot(cursor.getString(cursor.getColumnIndex("par_id")),
                                        cursor.getString(cursor.getColumnIndex("par_tipo")),
                                        cursor.getString(cursor.getColumnIndex("par_estado")));
            parqueadero.setAut_placa(cursor.getString(cursor.getColumnIndex("aut_placa")));

            /*Converting string to date*/
            String date = cursor.getString(cursor.getColumnIndex("par_fecha_ingreso"));

            Date start_date = null;
            if(date!=null && !date.equals("")){
                SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
                try {
                    start_date = format.parse(date);
                } catch (ParseException e) {
                    e.printStackTrace();
                }
            }
            parqueadero.setPar_fecha_ingreso(start_date);
            parqueaderos.put(cursor.getString(cursor.getColumnIndex("par_id")),parqueadero);
        }

        return parqueaderos;
    }

    public Map<String, Integer> getAll(DBHelper dbHelper) {
        Map<String, Integer> sectores = new LinkedHashMap<String, Integer>();

        Cursor cursor = dbHelper.getAll(table_name);

        for(cursor.moveToFirst();!cursor.isAfterLast();cursor.moveToNext()){
            sectores.put(cursor.getString(cursor.getColumnIndex("sec_nombre")),cursor.getInt(cursor.getColumnIndex("sec_id")));
        }

        return sectores;
    }

    public void retrieveAll(DBHelper dbHelper){
        this.dbHelper = dbHelper;
        dbHelper.empty(table_name);
        TareaWSSectores tareaSectores = new TareaWSSectores();
        tareaSectores.execute();

    }

    private class TareaWSSectores extends AsyncTask<String, Integer, Boolean> {
        boolean result = false;
        private String message;
        Map<String, Integer> sectores = new LinkedHashMap<String, Integer>();

        @Override
        protected Boolean doInBackground(String... params) {

            String url = "http://54.69.247.99/Violations/public/api/vigilante/sectores";

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
                                String sec_nombre = obj.getString("sec_nombre").toUpperCase();
                                sectores.put(sec_nombre, sec_id);
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

                Iterator it = sectores.entrySet().iterator();
                while (it.hasNext()) {
                    Map.Entry pairs = (Map.Entry) it.next();

                    ContentValues values = new ContentValues();
                    values.put("sec_id",pairs.getValue().toString());
                    values.put("sec_nombre", pairs.getKey().toString());

                    dbHelper.insert(table_name,values);

                }

                lblMessage.setText(lblMessage.getText().toString()+"Carga de Sectores Completa\n");

            }
        }
    }

}
