<?php
 
 $data1 = '[{"name":"num_fact","value":"FACT####3333"},{"name":"fecha_fact","value":"2018-12-18"},{"name":"forma_fact","value":"ggg"},{"name":"nota_fact","value":"444"},{"name":"productoid","value":"4"},{"name":"cant_prod","value":"11"},{"name":"precio_prod","value":"111"},{"name":"productoid","value":"1"},{"name":"cant_prod","value":"22"},{"name":"precio_prod","value":"2222"}]';

$data = json_decode($data1);
//var $detalleComp = "";
$i = 0;
foreach ($data as $item) {
                
    switch ($item->name) {
        case 'num_fact':
            $num_fact = $item->value;
        break;
        case 'fecha_fact':
            $fecha_fact = $item->value;
        break;
        case 'forma_fact':
            $forma_fact = $item->value;
        break;
        case 'nota_fact':
            $nota_fact = $item->value;
        break;
        case 'productoid':
            $detalleComp[$i][0] = $item->value;
        break;
        case 'cant_prod':
            $detalleComp[$i][1] = $item->value;
        break;
        case 'precio_prod':
            $detalleComp[$i][2] = $item->value;
            $i++;
        break;

    }
}
echo $detalleComp[1][2];
?>