<?php
    include_once '../../../../controller/ValidadorController.php';
    session_start();
    ini_set('display_errors', 1);
    include("../../../../incluidos/conexion_inc.php");
	Conectarse();
   
    if($_POST){
        //Insertar Char
        $query = "INSERT INTO `char_plates` (`char`, `created_at`) VALUES ('".$_POST['char']."', '". date('Y-m-d H:i:s') ."')";
        if(mysql_query($query)){
            echo 'Se creo Correectamente';
        }else{
            die(mysql_error());
        }
        for($i = 1; $i <= 25; $i++ ){
            if($_POST['select'.$i]){
                echo $_POST['select'.$i];
            }
        }

    }
?>

<div class="row">
    <div class="col-lg-10" style="margin-top:-35px;">
        <h3 class="page-header">Listados de Placas </h3>
    </div>
    <div class="col-lg-2" style=" margin-top:10px;">
        <a onClick="CargarAjax_win('Admin/Sist.Administrador/Validadores/Placas/add.php?accion=add','','GET','cargaajax');" class="btn btn-primary">
            <i class="fa fa-plus fa-lg"></i>
        </a>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Placas  registradas
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Letra</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="gradeX">
                                <td></td>
                                <td></td>
                                <td>
                                    <!--editar -->
                                            <a href="javascript:" onclick="CargarAjax_win('Admin/Sist.Administrador/Validadores/Placas/listado.php?id=<?=$row['ID'];?>','','GET','cargaajax');" data-title="Editar"  class="btn btn-info">
                                            <i class="fa fa-pencil fa-lg"></i> 
                                            </a>
                                    <!--editar -->
                                    <!--active -->
                                            <a href="javascript:" onclick="CargarAjax2('Admin/Sist.Administrador/Validadores/Placas/listado.php?idmarca=<?=$row['ID']; ?>','','GET','cargaajax');" data-title="Editar"  class="btn btn-success">
                                            <i class="fa fa-check fa-lg"></i> 
                                            </a>
                                    <!--active -->
                                     <!--inactive -->
                                     <a href="javascript:" onclick="CargarAjax2('Admin/Sist.Administrador/Validadores/Placas/listado.php?idmarca=<?=$row['ID']; ?>','','GET','cargaajax');" data-title="Editar"  class="btn btn-secondary">
                                            <i class="fa fa-times fa-lg"></i> 
                                            </a>
                                    <!--inactive -->
                                    <!--desactivar -->
                                            <a href="javascript:Elim();" onclick="if(confirm('Deshabilitar \n &iquest; Esta seguro de seguir ?')){ CargarAjax2('Admin/Sist.Administrador/Marcas/List/listado.php?action=desactivar&id=<?=$row['ID']; ?>','','GET','cargaajax'); }" data-title="Desactivar"  class="btn btn-danger">
                                            <i class="fa fa-trash-o fa-lg"></i> 
                                            </a>
                                    <!--desactivar -->
                                </td>
                            </tr>
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