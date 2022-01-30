<?
	// ESTE ARCHIVO LO USAMOS TANTO PARA EDITAR COMO PARA REGISTRAR UN NUEVO MODELO
	ini_set('display_errors', 1);
	session_start();
	include("../../../../../incluidos/conexion_inc.php");
    include('../../../../../controller/VehiculoController.php');
	include('../../../../../incluidos/nombres.func.php');
	
    Conectarse();
    $vehiculo = new vehiculoController;
    $row = $vehiculo->getModelo($_GET['id']);
	// ACTIONES PARA TOMAR ....
	if($_GET['accion']){
		$acc	= $_GET['accion'];
		$acc_text = 'Registrar';
	}else{
		$acc 	= 'Editar';
		$acc_text 	= 'Editar';
	}
	
 ?>

<form action="" method="post" enctype="multipart/form-data" id="form_edit_perso">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=$acc_text?> Modelo de la marca <?=Marcas($_GET['idmarca'])?></h4>
    </div>

    <div class="modal-body">

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Información del Modelo
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="info">
                                    <p>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="strong">Nombre <span class="label label-important"
                                                    id="Nombres" style="display:none">*</span></label>
                                            <div class="form-group ">

                                                <input type="text" class="form-control" placeholder="Descripcion"
                                                    id="descripcion" name="descripcion"
                                                    value="<?=$row['descripcion']?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="strong">Codigo <span class="label label-important"
                                                    id="Nombres" style="display:none">*</span></label>
                                            <div class="form-group ">

                                                <input type="text" class="form-control" placeholder="codigo"
                                                    id="cod_modelo" name="cod_modelo" value="<?=$row['cod_modelo']?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="strong">Tipo <span class="label label-important" id="Nombres"
                                                    style="display:none">*</span></label>
                                            <div class="form-group ">
                                                <select name="tipo" id="tipo" style="display:compact"
                                                    class="form-control">
                                                    <?php
                                                        if($row['tipo']){
                                                         $tipoVehiculo = new vehiculoController;
                                                         $tipo = $tipoVehiculo->getType($row['tipo']);
                                                         var_dump($tipo);
                                                         echo '<option value="'.$tipo['veh_tipo'].'">'.$tipo['name'].'</option>';
                                                        }else{
                                                            echo '<option value="">- Seleccionar - </option>';
                                                        }

                                                        $tipoVehiculo = new vehiculoController;
                                                        $rescat2 = $tipoVehiculo->getTypes();
                                                        while ($cat2 = mysql_fetch_array($rescat2)) {
                                                            $c2 = $cat2['nombre'];
                                                            $c_id2 = $cat2['veh_tipo'];
    
                                                            echo "<option value=\"$c_id2\" >$c2</option>";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input name="accion" type="hidden" id="accion" value="<?=$acc?>">
        <input name="id" type="hidden" id="id" value="<?=$row['ID']?>" />

        <? if(!$_GET['id']){?>
        <input name="id_dist" type="hidden" id="id_dist" value="<?=$_SESSION['user_id']?>" />
        <input name="fecha" type="hidden" id="fecha" value="<?=date('Y-m-d G:i:s')?>" />
        <input name="activo" type="hidden" id="activo" value="si" />
        <input name="IDMARCA" type="hidden" id="IDMARCA" value="<?=$_GET['idmarca']?>" />
        <? } ?>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button name="acep" type="button" id="acep" class="btn btn-success"
            onClick="CargarAjax2_form('Admin/Sist.Administrador/Marcas/Modelos/List/listado.php?pagina=<?=$_GET['pagina']?>&idmarca=<?=$_GET['idmarca']?>','form_edit_perso','cargaajax');"><?=$acc_text?></button>

    </div>
</form>