package com.sip.sipapp_project;

import android.view.View;

public class ActiveSpot {
	private String par_id;
	private String aut_placa;
	private int falta;
	private View view;
	
	public ActiveSpot(String par_id,String aut_placa, int falta){
		this.par_id=par_id;
		this.aut_placa=aut_placa;
		this.falta=falta;
	}
	
	public String getPar_id() {
		return par_id;
	}

	public String getAut_placa(){
		return aut_placa; 
	}
	
	public int getFalta(){
		return falta; 
	}
	
	public void setPar_id(String par_id) {
		this.par_id = par_id;
	}
	
	public void setAut_placa(String aut_placa) {
		this.aut_placa = aut_placa;
	}
	
	public void setFalta(int falta) {
		this.falta = falta;
	}
	
	public View getView() {
		return view;
	}

	public void setView(View view) {
		this.view = view;
	}
	
}
