<?php include_once 'cbbdd.php';
class CCategorias extends CBBDD {
	//Atributos de la clase
	private $mID;
	private $mCategoria;	

	//Funciones de la clase
	public function __construct()
	{
		parent::__construct();
		$this->mID=0;
		$this->mCategoria="";
	}
	public function Añadir_Cat ($nombre_cat)
	{
		$id = 0;
		try {
			$sql="INSERT INTO categorias (nombre_cat) VALUES ('$nombre_cat')";
			$id = $this->CE($sql,true);
		}catch (Exception $e) {
			throw $e;
		}
		return $id;
		;
	}
	public function Editar_Cat ($id_cat,$nombre_cat)
	{
		$total = 0;
		try {
			$sql="UPDATE categorias SET nombre_cat='$nombre_cat' WHERE id_cat='$id_cat'";
			$total = $this->CE($sql);
		}catch (Exception $e) {
			throw $e;
		}
		return $total;
		
	}
	public function Eliminar_Cat ($id_cat)
	{
		$total = 0;
		try {

			$sqls[]="DELETE FROM categorias WHERE id_cat=$id_cat";
			$sqls[]="DELETE FROM productos WHERE id_categoria=$id_cat";
			$total = $this->CETrans($sqls);
		}catch (Exception $e) {
			throw $e;
		}
		return $total;
		
	}
	public function TotalCategorias(){
		$total = 0;
		try {
			$sql="Select count(*) as TOTAL from categorias";
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
		try {
			$sql="Select * from categorias where id_cat>0 order by nombre_cat asc $condicion ";
			if ($this->CS($sql)) {
				$info = $this->mDatos->fetch_all(MYSQLI_ASSOC);
				/*
				while ($fila=$this->mDatos->fetch_assoc()){
					$info[] = $fila;
				}
				*/
				$this->mDatos->close();
			}
		} catch (Exception $e) {
			//Me viene bien mientras desarrollo:
			throw new Exception($sql);
		}
		return $info;
	}
}
?>