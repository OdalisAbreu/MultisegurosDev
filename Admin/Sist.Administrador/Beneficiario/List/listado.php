<?
	session_start();
	ini_set('display_errors',1);
	$equip = $_POST['privilegio'];

	include("../../../../incluidos/conexion_inc.php");
	Conectarse();
	include('../../../../incluidos/bd_manejos.php');
	include('../../../../incluidos/nombres.func.php');

	// DETERMINAR SI ES GET O POST
	//$actual = $_POST['actual'].$_GET['actual'];  
	 $acc1 = $_POST['accion'].$_GET['action'];
	
	//print_r($_POST);
	// DESACTIVAR
	if($_GET['action']=='desactivar'){
		//unset($_POST['actual']);
		$id=$_GET['id'];
		$query=mysql_query("UPDATE personal SET activo ='no' WHERE id='$id' LIMIT 1");
		echo '<script> $("#actul").fadeIn(0); $("#actul").fadeOut(10000); </script> ';
	}
	
	if($_GET['action']=='activar'){
		//unset($_POST['actual']);
		$id=$_GET['id'];
		$query=mysql_query("UPDATE personal SET activo ='si' WHERE id='$id' LIMIT 1");
		echo '<script> $("#actul").fadeIn(0); $("#actul").fadeOut(10000); </script> ';
	}

	// REGISTRAR NUEVO
	if($acc1=='registrar'){
		//unset($_POST['actual']);
		Insert_form('personal');
		echo mysql_error();
		echo'<script>$("#myModal").modal("hide"); $("#actul").fadeIn(0); $("#actul").fadeOut(10000);</script> ';
	}
	
	// EDITAR
	if($acc1=='Editar'){
		//unset($_POST['actual']);
		EditarForm('personal');
		echo'<script>$("#myModal").modal("hide"); $("#actul").fadeIn(0); $("#actul").fadeOut(10000);</script> ';
	}
	
	// EDITAR PRIVILEGIO
	if($_POST['accion']=='editarpriv'){
		
		 $_POST['privilegio'] = $equip; 
		 
		for($i =0; $i<count($_POST['privilegio']); $i++){
			if($_POST['privilegio']>1){
				$_POST['privilegios'] .= "[".$_POST['privilegio'][$i]."]";
			}
		}
		unset($_POST['privilegio']);
		
		
		 $query=mysql_query("UPDATE privilegios SET
		 privilegios = '".$_POST['privilegios']."'
		 WHERE id_pers = '".$_POST['id_pers']."' AND dist_id  = '".$_SESSION['user_id']."' LIMIT 1");
		 
		echo'<script>$("#myModal").modal("hide"); $("#actul").fadeIn(0); $("#actul").fadeOut(10000);</script> ';
		
	}
	
	//echo $_SESSION['user_id'];
?>

<div class="row" >
                <div class="col-lg-10" style="margin-top:-25px;">
                    <h3 class="page-header">Listados de Beneficiarios </h3>
                </div>
                <div class="col-lg-2" style=" margin-top:10px;">
            <a onClick="CargarAjax2('Admin/Sist.Administrador/Beneficiario/List/listado.php','','GET','cargaajax');" class="btn btn-info"><i class="fa fa-list fa-lg"></i></a>
           
            <a onClick="CargarAjax_win('Admin/Sist.Administrador/Beneficiario/Edit/editar-registar.php?accion=registrar','','GET','cargaajax');" class="btn btn-primary"> <i class="fa fa-plus fa-lg"></i></a>
            </div>
                <!-- /.col-lg-12 -->
            </div>

   <div class="row"> 
    <div class="col-lg-12">
        <div class="panel panel-default">
                <div class="panel-heading">
                    Registros actualmente 
         </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                      <thead>
                          <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Balance</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            <th style="width:172px;">Opciones</th>
                          </tr>
                      </thead>
                      <tbody>
  <? 
  	
 if(!$_GET['estado']){
	 $estado = "AND activo !='' ";
 }else if($_GET['estado'] =='si'){
	 $estado = "AND activo = 'si' ";
 }else if($_GET['estado'] =='no'){
	 $estado = "AND activo = 'no' ";
 }
 
 	//inicializo el criterio y recibo cualquier cadena que se desee buscar 
$criterio = ""; 
$txt_criterio = ""; 
if ($_GET["criterio"] !=""){ 
   $txt_criterio = $_GET["criterio"]; 
   $criterio = " where id_dist = '".$_SESSION['user_id']."' AND funcion_id ='7' "; 
}else{
   $criterio = " where id_dist = '".$_SESSION['user_id']."' AND funcion_id ='7' "; 
}


$sql="SELECT * FROM personal ".$criterio."";
//echo "SELECT * FROM agencia_vehiculos ".$criterio.""; 
$res=mysql_query($sql); 
$numeroRegistros=mysql_num_rows($res); 
if($numeroRegistros<=0) 
{ 
  
}else{ 
   	//////////elementos para el orden 
   	if(!isset($orden)) 
   	{ 
      	$orden="id DESC"; 
   	} 
   	//////////fin elementos de orden 

   	//////////calculo de elementos necesarios para paginacion 
   	//tamaño de la pagina 
   	$tamPag=10; 

   	//pagina actual si no esta definida y limites 
   	if(!isset($_GET["pagina"])) 
   	{ 
      	$pagina=1; 
      	$inicio=1; 
      	$final=$tamPag; 
   	}else{ 
      	$pagina = $_GET["pagina"]; 
   	} 
   	//calculo del limite inferior 
   	$limitInf=($pagina-1)*$tamPag; 

   	//calculo del numero de paginas 
   	$numPags=ceil($numeroRegistros/$tamPag); 
   	if(!isset($pagina)) 
   	{ 
      	$pagina=1; 
      	$inicio=1; 
      	$final=$tamPag; 
   	}else{ 
      	$seccionActual=intval(($pagina-1)/$tamPag); 
      	$inicio=($seccionActual*$tamPag)+1; 

      	if($pagina<$numPags) 
      	{ 
         	$final=$inicio+$tamPag-1; 
      	}else{ 
         	$final=$numPags; 
      	} 

       if ($final>$numPags){ 
          $final=$numPags; 
      	} 
   	} 

//////////fin de dicho calculo  

	$sql="SELECT * FROM personal ".$criterio."  ORDER BY ".$orden." LIMIT ".$limitInf.",".$tamPag; 
	$res=mysql_query($sql); 
	while($row=mysql_fetch_array($res)){
			


?>
<tr>
    <td><?=$row['id']?></td>
    <td><?=FechaList($row['fecha'])?></td>
    <td><?=$row['nombres']?></td>
    <td>$<?=FormatDinero($row['balance'])?></td>
    <td>
	<? if ($row['activo']=='si'){ 
		echo "<font color='#1D0CD6'><b>Activo</b></font>";
	   }else{
		echo "<font color='#F6060A'><b>Inactivo</b></font>";
	   }
	?>
    </td>
    <td>
    	<div class="input-append">
    <div class="btn-group dropdown">
      <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Seleccionar <span class="caret"></span>
</button>
        <ul class="dropdown-menu pull-right">
            <li><a href="#" onclick="CargarAjax2('Admin/Sist.Administrador/Beneficiario/Bancos/List/listado.php?idc=<?=$row['id'];?>','','GET','cargaajax');">Bancos</a></li>
            
            <li><a href="#" onclick="CargarAjax2('Admin/Sist.Administrador/Beneficiario/Reportes/List/listado.php?idc=<?=$row['id'];?>','','GET','cargaajax');">Resumen de ventas</a></li>
            
        </ul>
  </div>
</div>
    </td>
    <td>
    
      
    
   
    
     <!--editar -->
            <a href="javascript:" onclick="CargarAjax_win('Admin/Sist.Administrador/Beneficiario/Edit/editar-registar.php?id=<?=$row['id']; ?>','','GET','cargaajax');" data-title="Editar"  class="btn btn-info">
             <i class="fa fa-pencil fa-lg"></i> 
            </a>
    <!--editar -->
        
    <?
    if ($row['activo']=='si'){ ?>
		 <!--desactivar -->
            <a href="javascript:Elim();" onclick="if(confirm('Deshabilitar \n &iquest; Esta seguro de seguir ?')){ CargarAjax2('Admin/Sist.Administrador/Beneficiario/List/listado.php?action=desactivar&id=<?=$row['id']; ?>','','GET','cargaajax'); }" data-title="Desactivar"  class="btn btn-danger">
             <i class="fa fa-trash-o fa-lg"></i> 
            </a>
    <!--desactivar -->
    
	<?   }else{ ?>
		
         <!--activar -->
            <a href="javascript:Elim();" onclick="if(confirm('Deshabilitar \n &iquest; Esta seguro de seguir ?')){ CargarAjax2('Admin/Sist.Administrador/Beneficiario/List/listado.php?action=activar&id=<?=$row['id']; ?>','','GET','cargaajax'); }"  data-title="Activar"  class="btn btn-primary">
          <i class="fa fa-power-off fa-lg"></i> 
            </a>
    <!--activar -->
    
	<?   } ?>
      
     <!--generar privilegio usuario-->
            <a href="javascript:" onClick="CargarAjax_win('Admin/Sist.Administrador/Personal/Edit/privilegios.php?idClient=<?=$row['id'];?>&list=b','','GET','cargaajax');"   data-toggle="tooltip" data-title="Privilegios"  class="btn btn-primary"><i class="fa fa-key fa-lg"></i> </a>    
            <!--generar privilegio usuario-->  
      
    
      
    </td>
  </tr>
  <? }  }?>
  
    </tbody>
</table>
 </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>