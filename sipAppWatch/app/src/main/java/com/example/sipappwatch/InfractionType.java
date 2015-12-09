package com.example.sipappwatch;

public class InfractionType {
	private int tip_inf_id;
	private int cat_inf_id;
	private String tip_inf_descripcion;
	private String tip_inf_legal;
	private Double tip_inf_valor;
	
	public InfractionType( 	int tip_inf_id,
							int cat_inf_id,
							String tip_inf_descripcion,
							String tip_inf_legal,
							Double tip_inf_valor ){
		this.tip_inf_id=tip_inf_id;
		this.cat_inf_id=cat_inf_id;
		this.tip_inf_descripcion=tip_inf_descripcion;
		this.tip_inf_legal=tip_inf_legal;
		this.tip_inf_valor=tip_inf_valor;

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
	
	
}
