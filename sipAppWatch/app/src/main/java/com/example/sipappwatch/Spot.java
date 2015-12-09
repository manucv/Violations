package com.example.sipappwatch;

import java.util.Calendar;
import java.util.Date;

import android.view.View;

public class Spot {
	private String par_id;
	private String par_estado;
	private String par_tipo;
	private String aut_placa;
	private Date par_fecha_ingreso;
	private int par_horas_parqueo;
	private int inf_id;
	private View view; 
	
	public Spot(String par_id,String par_estado,String par_tipo, String aut_placa){
		this.par_id=par_id;
		this.par_estado=par_estado;
		this.par_tipo=par_tipo;
		this.aut_placa=aut_placa;
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

	public void setView(View view) {
		this.view = view;
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
	}

	public void setAut_placa(String aut_placa) {
		this.aut_placa = aut_placa;
	}
	
	public Date getPar_fecha_ingreso() {
		return par_fecha_ingreso;
	}
	
	public void setPar_fecha_ingreso(Date par_fecha_ingreso) {
		this.par_fecha_ingreso = par_fecha_ingreso;
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
	
	public String getRemainingTime(){

		if(this.par_fecha_ingreso != null){
			Date current = new Date();
			Calendar cal = Calendar.getInstance(); // creates calendar
		    cal.setTime(this.par_fecha_ingreso); // sets calendar time/date
		    cal.add(Calendar.HOUR_OF_DAY, this.par_horas_parqueo); // adds one hour
		    
			long diff = (cal.getTimeInMillis()-current.getTime())/1000/60;
		    //System.out.println(this.par_id+"-"+this.par_fecha_ingreso+"-"+this.par_horas_parqueo+"-"+diff);
			int hours = (int) Math.floor(diff/60);
			int minutes = (int)(diff-(hours*60));
			return "Falta: "+String.format("%02d", hours)+":"+String.format("%02d", minutes);
		}
		return "";
	}
	
}
