package com.example.sipappwatch;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

/**
 * Created by lmpon_000 on 18/01/2016.
 */
public class DBHelper extends SQLiteOpenHelper {

    private static final String DBNAME = "sip.db";
    private static final int VERSION = 1;

    SQLiteDatabase SipDB;

    public DBHelper(Context context) {
        super(context, DBNAME, null, VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String sector_tbl="CREATE TABLE sector (sec_id INTEGER PRIMARY KEY, sec_nombre TEXT NOT NULL )";
        db.execSQL(sector_tbl);

        String parqueadero_tbl="CREATE TABLE parqueadero (par_id TEXT PRIMARY KEY, par_tipo TEXT NOT NULL, par_estado TEXT NOT NULL, aut_placa TEXT, inf_id INTEGER, par_horas_parqueo INTEGER, par_fecha_ingreso TEXT )";
        db.execSQL(parqueadero_tbl);

        String parqueadero_sector_tbl="CREATE TABLE parqueadero_sector (sec_id INTEGER, par_id TEXT)";
        db.execSQL(parqueadero_sector_tbl);

        String tipo_infraccion_tbl="CREATE TABLE tipo_infraccion (" +
            "tip_inf_id INTEGER PRIMARY KEY," +
            "cat_inf_id INTEGER NOT NULL," +
            "tip_inf_descripcion TEXT NOT NULL," +
            "tip_inf_legal TEXT NOT NULL," +
            "tip_inf_valor REAL NOT NULL)";
        db.execSQL(tipo_infraccion_tbl);


    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

    }

    public void openDB(){
        SipDB = getWritableDatabase();
    }
    public void closeDB(){
        if(SipDB != null && SipDB.isOpen()){
            SipDB.close();
        }
    }

    public int isEmpty(String table){
        Cursor mCount= SipDB.rawQuery("select count(*) from "+table, null);
        mCount.moveToFirst();
        int count= mCount.getInt(0);
        return count;
    }

    public long insert(String table, ContentValues values){
        return SipDB.insert(table,null,values);
    }

    public long update(String table, ContentValues values, String where){
        return SipDB.update(table, values, where, null);
    }

    public int empty(String table){
        return SipDB.delete(table, null, null);
    }

    public Cursor getAll(String table){
        String query = "SELECT * FROM "+table;
        return SipDB.rawQuery(query, null);
    }

    public Cursor rawQuery(String query){
        return SipDB.rawQuery(query,null);
    }
}
