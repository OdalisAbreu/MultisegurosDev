<?

	// FUNCIONES DE MANEJO DE BASE DE DATOS
	// version 1.2 de LinksApps.
	
		function Insert_form($tabla){
		global $App_nom_uso;
		
		foreach($_POST as $nombre_campo => $valor)
		{
		if($nombre_campo !=='accion'){
		$campos  .= $nombre_campo.',';
		$valores .= "'".$valor."',";
		}
		}
		$campos  .='ultimo';
		$valores .='ultimo';
		
		$campos  = str_replace(',ultimo','',$campos);
		$valores = str_replace(',ultimo','',$valores);
		
		$consulta = "INSERT INTO $tabla ($campos) VALUES ($valores)";
		
		mysql_query($consulta);
		
	}
	// -------------------------------
	
	
	// EDITAR REGISTROS
	
	function EditarForm($tabla){
		var_dump($_POST);
		exit();
	foreach($_POST as $nombre_campo => $valor)
		{
		$consulta = "UPDATE $tabla
		SET $nombre_campo ='$valor' 
		where id = '".$_POST['id']."'";
		@mysql_query($consulta);
		}
	}
	
?>