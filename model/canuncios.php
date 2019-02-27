<?php
include_once 'cbbdd.php';
class CAnuncios extends CBBDD
{
	//Atributos de la clase
	private $mID;
	private $mNombre_producto;
	private $mURLfoto;
	private $mURLanuncio;
	private $mWeb;
	private $mPrecio_anuncio;
	private $mPrecio_correcto;
	private $mPrecio_chollo;
	private $mCategoria;
	private $mValoracion;

	//Funciones de la clase
	public function __construct()
	{
		parent::__construct();
		$this->mID=0;
		$this->mNombre_producto="";
		$this->mURLfoto="";
		$this->mURLanuncio="";
		$this->mWeb=0;
		$this->mPrecio_anuncio=0;
		$this->mPrecio_correcto=0;
		$this->mPrecio_chollo=0;
		$this->mCategoria=0;
		$this->mValoracion=0;
	}
	
	//Inserta un nuevo anuncio, devuelve su nuevo id si ok, 0 si no lo consigue: 
	public function Insertar($id_usuario,$id_web,$id_categoria,$nombre_producto,$URL_foto,$URL_anuncio,$precio_anuncio,$precio_correcto,$precio_chollo)
	{
		//Calculo la valoracion del precio del producto (0=chollo,1=bueno,2=malo)
		$valor=$this->Valoracion($precio_anuncio,$precio_correcto,$precio_chollo);
		$id = 0;
		try
		{
			$sql="INSERT INTO productos (id_usuario,id_web,id_categoria,nombre_producto,URL_foto,URL_anuncio,precio_anuncio,precio_correcto,precio_chollo,valoracion) 
				VALUES ('$id_usuario','$id_web','$id_categoria','$nombre_producto','$URL_foto','$URL_anuncio','$precio_anuncio','$precio_correcto','$precio_chollo','$valor')";
			$id = $this->CE($sql,true);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		
		return $id;
	}
	
	//Actualiza una peli, devuelve el número de filas afectadas para saber si se ha actualizado o no: 
	public function Actualizar($id_producto,$id_web,$id_categoria,$nombre_producto,$URL_foto,$URL_anuncio,$precio_anuncio,$precio_correcto,$precio_chollo)
	{
		//Calculo la valoracion del precio del producto (0=chollo,1=bueno,2=malo)
		$valor=$this->Valoracion($precio_anuncio,$precio_correcto,$precio_chollo);
		$total = 0;
		try
		{
			$sql="UPDATE productos SET id_web=$id_web,id_categoria=$id_categoria,nombre_producto='$nombre_producto',URL_foto='$URL_foto',URL_anuncio='$URL_anuncio',precio_anuncio=$precio_anuncio,precio_correcto=$precio_correcto,precio_chollo=$precio_chollo,valoracion='$valor' WHERE id_producto=$id_producto ";
			$total = $this->CE($sql);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		return $total;
	}
	
	//Elimina una peli, devuelve su nuevo id si ok, -1 si no lo consigue: 
	public function Eliminar($id_producto)
	{
		$total = 0;
		try
		{
			$sql="DELETE FROM productos WHERE id_producto='$id_producto'";
			$total = $this->CE($sql);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		return $total;
	}

	public function TotalAnuncios($id_usuario)
	{
		$total = 0;
		try
		{
			$sql="SELECT count(*) AS TOTAL FROM productos WHERE id_usuario='$id_usuario'";
			$total = $this->CT($sql);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		return $total;
	}

	//Devuelve la lista de peliculas según la condición
	public function Listar($inicio,$num_items,$id_usuario)
	{
		$info=array();
		try
		{
			$sql="SELECT * FROM productos INNER JOIN categorias ON productos.id_categoria=categorias.id_cat INNER JOIN 		webs ON productos.id_web=webs.id_webs WHERE id_producto>0 and id_usuario='$id_usuario' order by id_producto desc LIMIT $inicio,$num_items";
			if ($this->CS($sql))
			{
				$info = $this->mDatos->fetch_all(MYSQLI_ASSOC);	
			}
			$this->mDatos->close();
		}
		catch (Exception $e)
		{
			//Me viene bien mientras desarrollo:
			throw new Exception($sql);
		}
		return $info;
	}
	
	public function __destruct()
	{ 
		try
		{

		}
		catch (Exception $e)
		{
			throw $e;
		}
	}
	
	//Devuelve la lista de anuncios por usuario
	public function ListarTotalPaginado($id_usuario,$inicio,$tam_pag)
	{
		$lista=array();
		try
		{
			$sql="SELECT * FROM productos INNER JOIN webs ON productos.id_web=webs.id_webs INNER JOIN categorias ON productos.id_categoria=categorias.id_cat where id_usuario=$id_usuario order by id_producto DESC limit $inicio,$tam_pag";
			if ($this->CS($sql))
			{
				$lista = $this->mDatos->fetch_all(MYSQLI_ASSOC);
			}
			$this->mDatos->close();
		}
		catch (Exception $e)
		{
			throw new Exception($sql);
		}
		return $lista;
	}
	//Devuelve la lista de anuncios
	public function ListarCat($id_cat=0)
	{
		$lista=array();
		try
		{ 	
			if ($id_cat==0)
				$sql="SELECT * FROM productos INNER JOIN webs ON productos.id_web=webs.id_webs order by id_producto DESC";
			else
				$sql="SELECT * FROM productos INNER JOIN webs ON productos.id_web=webs.id_webs WHERE id_categoria='$id_cat' ORDER BY id_producto DESC";
				if ($this->CS($sql))
				{
					$lista = $this->mDatos->fetch_all(MYSQLI_ASSOC);
				}
				$this->mDatos->close();
		}
		catch (Exception $e)
		{
			throw new Exception($sql);
		}
		return $lista;
	}
	public function Producto_Cat_Min ($id_cat)
	{
		$lista=array();
		try
		{
			$sql="SELECT * FROM productos WHERE id_categoria='$id_cat' and valoracion=0 ORDER BY precio_anuncio ASC LIMIT 1";
			if ($this->CS($sql))
			{
				$lista = $this->mDatos->fetch_all(MYSQLI_ASSOC);
			}
			$this->mDatos->close();
		}
		catch (Exception $e)
		{
			throw new Exception($sql);
		}
		return $lista;
	}

	public function Valoracion ($precio_anuncio,$precio_correcto,$precio_chollo)
	{
		if ($precio_anuncio<$precio_chollo) 
			$valor=0;
		elseif ($precio_anuncio>$precio_correcto) 
			$valor=2;
		else
			$valor=1;

		return $valor;
		
	}
	//Calculamos el total de anuncios (total o por categoriasS)
	public function Total($id_cat){
		$total = 0;
		try {
			if ($id_cat==0)
				$sql="SELECT count(*) AS TOTAL FROM productos";
			else				
				$sql="SELECT count(*) AS TOTAL FROM productos WHERE id_categoria=$id_cat";

			$total = $this->CT($sql);
		} catch (Exception $e) {
			throw $e;
		}
		return $total;
	}
	//Calculamos el total de anuncios (total o por valoracion)
	public function TotalValoracion($valoracion=null){
		$total = 0;
		try {
			if ($valoracion===null)
				$sql="SELECT count(*) AS TOTAL FROM productos";
			else				
				$sql="SELECT count(*) AS TOTAL FROM productos WHERE valoracion='$valoracion'";
			$total = $this->CT($sql);
		} catch (Exception $e) {
			throw $e;
		}
		return $total;
	}
}
?>