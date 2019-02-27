<?php
class CBDConfig{
	//Atributos de la clase
	protected $mServ;
	protected $mBDName;
	protected $mBDUser;
	protected $mBDPass;
	
	
	//Funciones de la clase
	public function __construct() {
		date_default_timezone_set('Europe/Madrid');
		$modo = 2;	//0=Real, 1=Pruebas remoto, 2=Localhost
		
		//Conectamos con la BBDD
		switch ($modo) {
			case 0:
				$this->ConexionReal();
				break;
			case 1:
				$this->ConexionPruebas();
				break;
			case 2:
				$this->ConexionLocal();
				break;
		}
			
	}

	private function ConexionReal() {
		$this->mServ="";
		$this->mBDName="";
		$this->mBDUser="";
		$this->mBDPass="";		
	}
	private function ConexionPruebas() {
		$this->mServ="";
		$this->mBDName="";
		$this->mBDUser="";
		$this->mBDPass="";		
	}
	private function ConexionLocal() {
		$this->mServ="localhost";
		$this->mBDName="anuncios";
		$this->mBDUser="root";
		$this->mBDPass="";		
	}
}
?>