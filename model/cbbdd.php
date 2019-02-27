<?php
include_once("cbdconfig.php");
class CBBDD extends CBDConfig {
	//Atributos
	protected $mConexion;
	protected $mDatos;
	//Propiedades
	
	//Funciones de la clase
	public function __construct() {
		parent::__construct();
	}
	
	private function ConectarBD() {
		//Conectamos con el servidor de bbdd:
		try {
			if (!($this->mConexion=new mysqli($this->mServ,$this->mBDUser,$this->mBDPass,$this->mBDName)))
				throw new Exception("Sin conexión con el servidor");
		} catch (Exception $e) {
			//No hemos podido conectar con el servidor de bbdd
			throw $e;
		}
		$this->mConexion->set_charset('utf8');	
	}
	
	//Método para las consultas de selección:
	public function CS($sql) {
		$res=false;
		try {
			$this->ConectarBD();
			if (!($this->mDatos = $this->mConexion->query($sql))) 
				throw new Exception("Error al ejecutar la consulta: $sql");
			else
				$res=true;
			$this->DesconectarBD();
		} catch (Exception $e) {
			throw $e;
		}
		return $res;
	}
	
	//Método para las consultas de modificación:
	public function CE($sql,$lastid=false) {
		$ret=0;
		try {
			$this->ConectarBD();
			if (!$this->mConexion->query($sql))
				throw new Exception("Error al ejecutar la consulta: $sql");
			//Comprobamos si obtenemos el último codigo o no:
			if ($lastid) 
				$ret = $this->mConexion->insert_id;
			else	//Numero de filas afectadas:
				$ret = $this->mConexion->affected_rows;
			$this->DesconectarBD();
		} catch (Exception $e) {
			throw $e;
		}
		return $ret;
	}

	public function CETrans($sqls,$lastid=false) {
		$res=0;
		try {
			$this->ConectarBD();
			$this->mConexion->autocommit(FALSE);
			//$this->mConexion->begin_transaction();
			for ($i=0;$i<count($sqls);$i++) {
				if (!$this->mConexion->query($sqls[$i])) {
					$this->mConexion->rollback();
					$this->DesconectarBD();
					throw new Exception("Error al ejecutar la consulta: ".$sqls[$i]);
				}
			}
			$this->mConexion->commit();
			$this->DesconectarBD();
			$res = 1;
		} catch (Exception $e) {
			throw $e;
		}
		return $res;
	}

	//Método para las consultas de totales:
	public function CT($sql) {
		$res=0;
		try {
			$this->ConectarBD();
			if (!($this->mDatos = $this->mConexion->query($sql))) 
				throw new Exception("Error al ejecutar la consulta: $sql");

			if ($fila=$this->mDatos->fetch_assoc()) {
				$res = $fila["TOTAL"];
			}
			$this->mDatos->close();
			$this->DesconectarBD();
		} catch (Exception $e) {
			throw $e;
		}
		return $res;
	}
	
	protected function DesconectarBD() {
		//Desconectamos con la BBDD:
		try {
			$this->mConexion->close();
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	public function __destruct() { 

	}
	
}	
?>