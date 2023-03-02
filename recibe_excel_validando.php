<?php
require('config.php');
$tipo       = $_FILES['dataCliente']['type'];
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);
       
        $codigo            = !empty($datos[0]) ? ($datos[0]) : '';
        $nombre            = !empty($datos[1]) ? ($datos[1]) : '';
        $tipoIva           = !empty($datos[2]) ? ($datos[2]) : '';
        $cuit              = !empty($datos[3]) ? ($datos[3]) : '';
        $localidad         = !empty($datos[4]) ? ($datos[4]) : '';
        $provincia         = !empty($datos[5]) ? ($datos[5]) : '';
        $listaPrecio       = !empty($datos[6]) ? ($datos[6]) : '';
        $saldoCtaCorriente = !empty($datos[7]) ? ($datos[7]) : '';
        
        if( !empty($tipoIva) ){
            $checkemail_duplicidad = ("SELECT nombre FROM clientes WHERE nombre='".($nombre)."' ");
                    $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
                    $cant_duplicidad = mysqli_num_rows($ca_dupli);
        }   

        //No existe Registros Duplicados
        if ( $cant_duplicidad == 0 ) { 

            $insertarData = "INSERT INTO clientes( 
                codigo,
                nombre,
                tipoIva,
                cuit,
                localidad,
                provincia,
                listaPrecio,
                saldoCtaCorriente
            ) VALUES (
                '$codigo',
                '$nombre',
                '$tipoIva',
                '$cuit',
                '$localidad',
                '$provincia',
                '$listaPrecio',
                '$saldoCtaCorriente'
            )";
            mysqli_query($con, $insertarData);
                    
        } 
        /* Caso Contrario actualizo el o los Registros ya existentes */
        else {
            $updateData =  ("UPDATE clientes SET 
                codigo='" .$codigo. "',
                nombre='" .$nombre. "',
                tipoIva='" .$tipoIva. "',
                cuit='" .$cuit. "',
                localidad='" .$localidad. "',
                provincia='" .$provincia. "',
                listaPrecio='" .$listaPrecio. "',     
                saldoCtaCorriente='" .$saldoCtaCorriente. "'
                WHERE nombre='" .$nombre."'
            ");
            $result_update = mysqli_query($con, $updateData);
            var_dump($result_update);
        } 
    }

    $i++;
}

    // Para refrescar la página y mostrar datos
    header('Location: index.php');

?>