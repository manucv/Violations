<?php 
	//Cliente.php

	namespace Application\Model\Entity;

	class Cliente {

		private $cli_id;
		private $cli_nombre;
		private $cli_email;
		private $cli_passw;
		private $cli_saldo;
		private $cli_estado;

		function __construct() {}

		/**
		* @return the $cli_id
		*/
		public function getCli_id(){
			return $this->cli_id;
		}
		/**
		* @return the $cli_nombre
		*/
		public function getCli_nombre(){
			return $this->cli_nombre;
		}
		/**
		* @return the $cli_email
		*/
		public function getCli_email(){
			return $this->cli_email;
		}
		/**
		* @return the $cli_passw
		*/
		public function getCli_passw(){
			return $this->cli_passw;
		}
		/**
		* @return the $cli_saldo
		*/
		public function getCli_saldo(){
			return $this->cli_saldo;
		}
		/**
		* @return the $cli_estado
		*/
		public function getCli_estado(){
			return $this->cli_estado;
		}

		/**
		* @param Ambigous <NULL, unknown> $cli_id
		*/
		public function setCli_id($cli_id){
			$this->cli_id = $cli_id;
		}
		/**
		* @param Ambigous <NULL, unknown> $cli_nombre
		*/
		public function setCli_nombre($cli_nombre){
			$this->cli_nombre = $cli_nombre;
		}
		/**
		* @param Ambigous <NULL, unknown> $cli_email
		*/
		public function setCli_email($cli_email){
			$this->cli_email = $cli_email;
		}
		/**
		* @param Ambigous <NULL, unknown> $cli_passw
		*/
		public function setCli_passw($cli_passw){
			$this->cli_passw = $cli_passw;
		}
		/**
		* @param Ambigous <NULL, unknown> $cli_saldo
		*/
		public function setCli_saldo($cli_saldo){
			$this->cli_saldo = $cli_saldo;
		}
		/**
		* @param Ambigous <NULL, unknown> $cli_estado
		*/
		public function setCli_estado($cli_estado){
			$this->cli_estado = $cli_estado;
		}

		public function exchangeArray($data)
		{
			$this->cli_id = (isset($data['cli_id'])) ? $data['cli_id'] : null;
			$this->cli_nombre = (isset($data['cli_nombre'])) ? $data['cli_nombre'] : null;
			$this->cli_email = (isset($data['cli_email'])) ? $data['cli_email'] : null;
			$this->cli_passw = (isset($data['cli_passw'])) ? $data['cli_passw'] : null;
			$this->cli_saldo = (isset($data['cli_saldo'])) ? $data['cli_saldo'] : null;
			$this->cli_estado = (isset($data['cli_estado'])) ? $data['cli_estado'] : null;
		}
		
		public function getArrayCopy(){
			return get_object_vars($this);
		}		

	}