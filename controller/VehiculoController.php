<?

class vehiculoController{

    // Optiene los tipos de Vehiculos 
    function getTypes(){
        $consult = mysql_query("SELECT id, nombre, veh_tipo from seguro_tarifas order by nombre ASC"        );
        $row = mysql_fetch_array($consult);
        return  $row;
    }
    // Optiene un tipo de Vehiculos po ID 
        function getType($id){
            $consult = mysql_query("SELECT id, nombre, veh_tipo FROM seguro_tarifas WHERE veh_tipo = $id"            );
            $row = mysql_fetch_array($consult);
             return  $row;
        }

    //Optiene los modelos de los vehiculos por su ID
    function getModelo($id){
        $r2 = mysql_query("SELECT * from seguro_modelos WHERE ID ='".$id."'");
        $row = mysql_fetch_array($r2);

        return $row;
    }

}