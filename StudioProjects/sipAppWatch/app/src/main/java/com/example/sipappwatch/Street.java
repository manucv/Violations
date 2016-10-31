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

/**
 * Created by lmponceb on 2/7/16.
 */
public class Street {
    public int cal_id;
    public String cal_codigo;
    public String cal_nombre;

    public DBHelper dbHelper;
    public String table_name = "calle";

    public TextView lblMessage;

    public Street() {
    }

    public int getCal_id() {
        return cal_id;
    }

    public void setCal_id(int cal_id) {
        this.cal_id = cal_id;
    }

    public String getCal_codigo() {
        return cal_codigo;
    }

    public void setCal_codigo(String cal_codigo) {
        this.cal_codigo = cal_codigo;
    }

    public String getCal_nombre() {
        return cal_nombre;
    }

    public void setCal_nombre(String cal_nombre) {
        this.cal_nombre = cal_nombre;
    }

    public Map<Integer, Street> getAll(DBHelper dbHelper){
        Map<Integer, Street> streets = new LinkedHashMap<Integer, Street>();
        Cursor cursor = dbHelper.getAll(table_name);
        for(cursor.moveToFirst();!cursor.isAfterLast();cursor.moveToNext()){
            Street street= new Street();
            street.setCal_id(cursor.getInt(cursor.getColumnIndex("cal_id")));
            street.setCal_codigo(cursor.getString(cursor.getColumnIndex("cal_codigo")));
            street.setCal_nombre(cursor.getString(cursor.getColumnIndex("cal_nombre")));

            streets.put(
                    cursor.getInt(cursor.getColumnIndex("cal_id")),street
            );
        }
        return streets;
    }

    public void retrieveAll(DBHelper dbHelper){
        this.dbHelper = dbHelper;
        dbHelper.empty(table_name);
        TareaWSCalles tareaCalles = new TareaWSCalles();
        tareaCalles.execute();
    }

    private class TareaWSCalles extends AsyncTask<String, Integer, Boolean> {
        boolean result = false;
        private String message;

        Map<Integer, Street> streets = new LinkedHashMap<Integer, Street>();

        @Override
        protected Boolean doInBackground(String... params) {

            String url = "http://54.69.247.99/Violations/public/api/vigilante/calles";

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

                                Integer cal_id = obj.getInt("cal_id");
                                String cal_codigo = obj.getString("cal_codigo");
                                String cal_nombre = obj.getString("cal_nombre");

                                Street street = new Street();
                                street.setCal_id(cal_id);
                                street.setCal_codigo(cal_codigo);
                                street.setCal_nombre(cal_nombre);

                                streets.put(cal_id,street);
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

                Iterator it = streets.entrySet().iterator();
                while (it.hasNext()) {
                    Map.Entry pairs = (Map.Entry) it.next();

                    ContentValues values = new ContentValues();
                    Street street= (Street) pairs.getValue();
                    values.put("cal_id",street.getCal_id());
                    values.put("cal_codigo",street.getCal_codigo());
                    values.put("cal_nombre",street.getCal_nombre());

                    dbHelper.insert(table_name,values);

                }

                lblMessage.setText(lblMessage.getText().toString()+"Carga de Calles Completa\n");
            }
        }
    }

}
