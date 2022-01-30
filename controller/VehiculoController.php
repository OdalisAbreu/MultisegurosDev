<?

class vehiculoController{

    // Optiene los tipos de Vehiculos y los devuelve como un array
    function getType(){
        $consult = mysql_query(
            "SELECT id, nombre, veh_tipo from seguro_tarifas order by nombre ASC"
        );
        $vehiculos = mysql_fetch_array($consult);
        return  $vehiculos;
    }

    //Optiene los modelos de los vehiculos por su ID
    function getModelo($id){
        Conectarse();
        $r2 = mysql_query("SELECT * from seguro_modelos WHERE ID ='".$id."'");
        $row = mysql_fetch_array($r2);

        return $row;
    }

}