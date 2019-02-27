<?php
include_once 'cbbdd.php';
class CUsuarios extends CBBDD {
	//Atributos de la clase
	private $mID;
	private $mNombre;	
	private $mMail;
	private $mPassword;
	//private $mFoto;
	//private $WEB_ROOT="http://cursos.bymhost.com/videoclub";
	
	//Propiedades
	public function getID() {
		return $this->mID;
	}
	
	public function getNombre() {
		return $this->mNombre;
	}
	
	public function getMail() {
		return $this->mMail;
	}

	//Funciones de la clase
	public function __construct() {
		parent::__construct();
		$this->mID=0;
		$this->mNombre="";
		$this->mMail="";
		$this->mPassword="";
	}
	
	//Inserta un nuevo usuario, devuelve su nuevo id si ok, -1 si no lo consigue: 
	public function Insertar($nombre, $mail, $pass) {
		$id = 0;
		try {
			$sql="Select count(*) as TOTAL from usuarios where email='$mail'";
			$total = $this->CT($sql);
			if ($total>0) {
				throw new Exception("Mail ya existente");
			}
			$enc_pass=md5($pass);
			$sql="INSERT INTO usuarios (nombre_usuario, email, password) 
			VALUES ('$nombre','$mail','$enc_pass')";
			$id = $this->CE($sql,true);
		}catch (Exception $e) {
			throw $e;
		}
		return $id;
	}

	//Comprueba mail y clave. Si es correcto obtiene el id del usuario (us_id) si no es correcto devuelve 0:
	public function Validar($mail,$pass) {
		$this->mID = 0;
		try {
			$enc_pass = md5($pass);
			$sql="Select * from usuarios where email='$mail' and password='$enc_pass'";
			if ($this->CS($sql)) {
				if ($fila=$this->mDatos->fetch_assoc()) { 	
					//Login correcto, obtenemos el código y nombre:
					$this->mID=$fila["id_usuario"];
					$this->mNombre=$fila["nombre_usuario"];
				}
				$this->mDatos->close();
			}
		} catch (Exception $e) {
			throw $e;
		}
		return $this->mID;
	}
	
	public function Cargar($id) {
		try {
			$sql="Select * from usuarios where id_usuario=$id";
			if ($this->CS($sql)) {
				if ($fila=$this->mDatos->fetch_assoc()){
					$this->mID=$fila["id_usuario"];
					$this->mNombre=$fila["nombre_usuario"];
					$this->mMail=$fila["email"];
				}
				$this->mDatos->close();
			}
		} catch (Exception $e) {
			throw new Exception($sql);
		}
	}

	public function __destruct() { 
		try {

		} catch (Exception $e) {
			throw $e;
		}
	}

	//Crea un nuevo password aleatorio 
	public function Cambiar_Pass($id, $pass_act, $pass_new) {
		$res=0;
		try {
			//encriptar el password actual y nuevo:
			$pass_act_enc = md5($pass_act);
			$pass_new_enc = md5($pass_new);

			$sql="update usuarios set password= '$pass_new_enc' 
				where id_usuario='$id' and password='$pass_act_enc'";
			$res = $this->CE($sql,false);
			/*
			if ($res<=0) {
				throw new Exception("No se ha podido cambiar tu password");
			}
			*/
		}catch (Exception $e) {
			throw $e;
		}
		return $res;
	}
}
?>