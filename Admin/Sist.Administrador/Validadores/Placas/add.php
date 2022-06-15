<?php
    // include_once '../../../../controller/ValidadorController.php';
    ini_set('display_errors', 1);
    session_start();
    if ($_GET['accion'] == 'add') {
        $accion = 'Añadir';
    }
    include('../../../../incluidos/conexion_inc.php');
    Conectarse();
?>

<div class="container">
    <div class="col-6">
        <h1><?php echo $accion; ?> Regla</h1>
    </div>
    <form action="" class="form-group" method="post" enctype="multipart/form-data" id="form_insert_rule" style="width: 50%;">
        <div class="row">
            <div class="col-md-2">
                <input type="text" class="form-control" name="char">
            </div>
        </div>
        <div class="row">
            <? $seg2 = mysql_query("SELECT id, nombre FROM multiseg_2.seguro_tarifas");
            while ($seg = mysql_fetch_array($seg2)) { ?>
                <div class="col-md-6">
                    <div class="form-check">
                        <input id="<?= $seg['id'] ?>" class="form-check-input" type="checkbox" name="select<?= $seg['id'] ?>" value="<?= $seg['id'] ?>">
                        <label for="my-input" class="form-check-label"><?= $seg['nombre'] ?></label>
                    </div>
                </div>
            <? } ?>
        </div>
        <div class="row">
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button name="acep" type="button" id="acep" class="btn btn-success" onClick="CargarAjax2_form('Admin/Sist.Administrador/Validadores/Placas/listado.php','form_insert_rule','cargaajax');" data-dismiss="modal">Crear</button>

            </div>
        </div>
    </form>

</div>