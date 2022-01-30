<?

class vehiculoController{


    function optenerModelo($id){
        Conectarse();
        $r2 = mysql_query("SELECT * from seguro_modelos WHERE ID ='".$id."'");
        $row = mysql_fetch_array($r2);

        return $id;
    }

}