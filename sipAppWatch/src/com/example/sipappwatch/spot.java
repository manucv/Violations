package com.example.sipappwatch;

import android.view.View;

public class spot {
	private String par_id;
	private String par_estado;
	private String par_tipo;
	private String aut_placa;
	private String par_fecha_ingreso;
	private int par_horas_parqueo;
	private View view; 
	
	public spot(String par_id,String par_estado,String par_tipo, String aut_placa){
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
	
	public String getPar_fecha_ingreso() {
		return par_fecha_ingreso;
	}
	
	public void setPar_fecha_ingreso(String par_fecha_ingreso) {
		this.par_fecha_ingreso = par_fecha_ingreso;
	}
	
	public int getPar_horas_parqueo() {
		return par_horas_parqueo;
	}
	
	public void setPar_horas_parqueo(int par_horas_parqueo) {
		this.par_horas_parqueo = par_horas_parqueo;
	}	
	
}
