<?php include_once 'cbbdd.php';
class CWebs extends CBBDD
{
	//Atributos de la clase
	private $mID;
	private $mWeb;	

	//Funciones de la clase
	public function __construct() {
		parent::__construct();
		$this->mID=0;
		$this->mWeb="";

	}

	public function Añadir_Web ($nombre_web)
	{
		$id = 0;
		try {
			$sql="INSERT INTO webs (nombre_web) VALUES ('$nombre_web')";
			$id = $this->CE($sql,true);
		}catch (Exception $e) {
			throw $e;
		}
		return $id;
		;
	}
	public function Editar_Web ($id_web,$nombre_web)
	{
		$total = 0;
		try {
			$sql="UPDATE webs SET nombre_web='$nombre_web' WHERE id_webs='$id_web'";
			$total = $this->CE($sql);
		}catch (Exception $e) {
			throw $e;
		}
		return $total;
		
	}
	public function Eliminar_Web ($id_web)
	{
		$total = 0;
		try {
			$sqls[]="DELETE FROM webs WHERE id_webs='$id_web'";
			$sqls[]="DELETE FROM productos where id_web='$id_web'";
			$total = $this->CETrans($sqls);
		}catch (Exception $e) {
			throw $e;
		}
		return $total;
		
	}
	public function TotalWebs(){
		$total = 0;
		try {
			$sql="Select count(*) as TOTAL from webs";
			$total = $this->CT($sql);
		} catch (Exception $e) {
			throw $e;
		}
		return $total;
	}
	
	public function ListarPaginado($inicio, $num_items) {
		return $this->Listar("limit $inicio,$num_items");
	}
	public function Listar($condicion="") {
		$info=array();
		try
		{
			$sql="Select * from webs where id_webs>0 order by nombre_web $condicion";
			if ($this->CS($sql))
			{
				$info = $this->mDatos->fetch_all(MYSQLI_ASSOC);
			}
				$this->mDatos->close();
		
		} catch (Exception $e) {
			//Me viene bien mientras desarrollo:
			throw new Exception($sql);
		}
		return $info;
	}
}
?>