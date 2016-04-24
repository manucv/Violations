package com.example.sipappwatch;

import android.content.ContentValues;

import java.text.SimpleDateFormat;
import java.util.Date;

/**
 * Created by lmponceb on 2/14/16.
 */
public class Violation {
    private int inf_local_id;
    private int inf_id;
    private String image1;
    private String image2;
    private String image3;
    private String par_id;
    private String aut_placa;
    private Float inf_latitud;
    private Float inf_longitud;
    private int usu_id;
    private Date inf_fecha;
    private int tip_inf_id;
    private String inf_estado;

    public DBHelper dbHelper;
    public String table_name = "infraccion";

    public Violation() {
    }

    public int getInf_local_id() {
        return inf_local_id;
    }

    public void setInf_local_id(int inf_local_id) {
        this.inf_local_id = inf_local_id;
    }

    public int getInf_id() {
        return inf_id;
    }

    public void setInf_id(int inf_id) {
        this.inf_id = inf_id;
    }

    public String getImage1() {
        return image1;
    }

    public void setImage1(String image1) {
        this.image1 = image1;
    }

    public String getImage2() {
        return image2;
    }

    public void setImage2(String image2) {
        this.image2 = image2;
    }

    public String getImage3() {
        return image3;
    }

    public void setImage3(String image3) {
        this.image3 = image3;
    }

    public String getPar_id() {
        return par_id;
    }

    public void setPar_id(String par_id) {
        this.par_id = par_id;
    }

    public String getAut_placa() {
        return aut_placa;
    }

    public void setAut_placa(String aut_placa) {
        this.aut_placa = aut_placa;
    }

    public Float getInf_latitud() {
        return inf_latitud;
    }

    public void setInf_latitud(Float inf_latitud) {
        this.inf_latitud = inf_latitud;
    }

    public Float getInf_longitud() {
        return inf_longitud;
    }

    public void setInf_longitud(Float inf_longitud) {
        this.inf_longitud = inf_longitud;
    }

    public int getUsu_id() {
        return usu_id;
    }

    public void setUsu_id(int usu_id) {
        this.usu_id = usu_id;
    }

    public Date getInf_fecha() {
        return inf_fecha;
    }

    public void setInf_fecha(Date inf_fecha) {
        this.inf_fecha = inf_fecha;
    }

    public int getTip_inf_id() {
        return tip_inf_id;
    }

    public void setTip_inf_id(int tip_inf_id) {
        this.tip_inf_id = tip_inf_id;
    }

    public String getInf_estado() {
        return inf_estado;
    }

    public void setInf_estado(String inf_estado) {
        this.inf_estado = inf_estado;
    }

    public long registrar(Violation infraccion){
        ContentValues values = new ContentValues();
        values.put("image1",infraccion.getImage1());
        values.put("image2",infraccion.getImage2());
        values.put("image3",infraccion.getImage3());
        values.put("par_id",infraccion.getPar_id());
        values.put("aut_placa",infraccion.getAut_placa());
        values.put("inf_latitud",infraccion.getInf_latitud());
        values.put("inf_longitud",infraccion.getInf_longitud());
        values.put("usu_id",infraccion.getUsu_id());
        SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        String formattedDate = df.format(infraccion.getInf_fecha());
        values.put("inf_fecha",formattedDate);
        values.put("tip_inf_id",infraccion.getTip_inf_id());
        values.put("inf_estado","P");
        return dbHelper.insert(table_name, values);
    }
}
