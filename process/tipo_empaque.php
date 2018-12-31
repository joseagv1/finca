<?php
    try {
        $host = 'localhost';
        $dbuser = 'postgres';
        $dbpass = 'postgres123';
        $dbname =  'finca';
        $connec = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    }catch (PDOException $e){
     echo "Error!: " . $e->getMessage() . "<br/>";
     die();
     }
    switch ($_POST["action"]) {
        case "createEmpType":    
            $query = "INSERT INTO tipo_empaque (nombre, descripcion) VALUES ('$_POST[empaq_nomb]', '$_POST[empaq_desc]')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            echo $count;
            break;
        case 'getTipoEmpaque':
            $query = "SELECT * FROM tipo_empaque ORDER BY nombre";
            $opciones="<option value=''>Seleccione...</option>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $opciones = $opciones."<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $opciones;
            break;
        case "createEmpaque":
            $query = "INSERT INTO empaque (nombre, id_tipo_empaque,cantidad_empaque) VALUES ('$_POST[emp_nomb]', '$_POST[emp_tipo]', '$_POST[emp_cant]')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            echo $count;
            break;
        case 'getEmpaque':
            $query = "SELECT * FROM empaque ORDER BY nombre";
            $opciones="<option value=''>Seleccione...</option>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $opciones = $opciones."<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $opciones;
            break;
        case 'createCategoria':
            $query = "INSERT INTO categoria (nombre, descripcion) VALUES ('$_POST[category_nomb]', '$_POST[category_desc]')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            echo $count;
            break;
        case 'getCategorias':
            $query = "SELECT * FROM categoria ORDER BY nombre";
            $opciones="<option value=''>Seleccione...</option>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $opciones = $opciones."<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $opciones;
            break;
        case 'createProd':
            $query = "INSERT INTO producto(nombre, descripcion, id_categoria, id_empaque) VALUES ('$_POST[prod_name]','$_POST[prod_desc]','$_POST[producto_categoria]','$_POST[producto_empaque]')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            echo $count;
            break;
        case 'getProductos':
            $query = "SELECT * FROM producto ORDER BY nombre";
            $opciones="<option value=''>Seleccione...</option>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $opciones = $opciones."<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $opciones;
            break;
        case 'addcompraRow':
                echo '<tr>
                <td>
                  <div class="input-group mb-3">
                    <select class="custom-select products newprod"  name="productoid">
                    </select>
                  </div>
                </td>
                <td><input type="text" class="form-control cant_prod" name="cant_prod"  required></td>
                <td><input type="text" class="form-control precio_prod" name="precio_prod" required> </td>
              </tr>';
            break;

        case 'createCompra':
            $num_fact = 0;
            $fecha_fact = 0;
            $forma_fact = 0;
            $nota_fact = 0;
            $i = 0;
            $data = json_decode(stripslashes($_POST['compraObj']));

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
                    case 'tasa_compra':
                        $tasa_compra = $item->value;
                    break;
                    case 'select_moneda':
                        $select_moneda = $item->value;
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
            $query = "INSERT INTO compra(fecha, factura_numero, forma_pago, nota, id_moneda, id_tasa) VALUES ('$fecha_fact','$num_fact', '$forma_fact','$nota_fact','$select_moneda','$tasa_compra')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            $lastcompraid = $connec->lastInsertId(); 
            foreach ($detalleComp as $item) {
                //echo $item[0];
                $query1 = "INSERT INTO compra_detalle(id_compra, id_producto, cantidad, precio_unitario) VALUES ('$lastcompraid','$item[0]', '$item[1]', '$item[2]')";
                $queryexec1 = $connec->prepare($query1); 
                $count = $queryexec1->execute();
            }
            
        break;
        case 'getListaCompra':
            $query = "SELECT * FROM compra ORDER BY fecha DESC";
            $lista="";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $lista = $lista."<tr><th scope='row'><a href='javascript:void(0);' onclick='addcompraRow()' class='addlinkprod'> <span class='oi oi-pencil'></span></a>&nbsp;&nbsp;<a href=''><span class='oi oi-trash'></span></a></th>";
                    $lista = $lista."<th scope='row'><a href='javascript:void(0)' onclick='showfactura(".$row['id'].",0)'>".$row['factura_numero']."</a></th><td>".$row['fecha']."</td></tr>";
            }
            echo $lista;
        break;
        case 'showfactura':
            $query1 = "SELECT
                    CASE WHEN mon1.id = comp.id_moneda THEN mon1.nombre ELSE mon2.nombre END AS moneda1,
                    CASE WHEN mon2.id != comp.id_moneda THEN mon2.nombre ELSE mon1.nombre END AS moneda2
                    FROM compra AS comp
                    INNER JOIN tasa_cambio AS TC ON TC.id = comp.id_tasa
                    INNER JOIN moneda AS mon1 ON mon1.id = TC.id_moneda1
                    INNER JOIN moneda AS mon2 ON mon2.id = TC.id_moneda2
                    WHERE comp.id = $_POST[id]";
            $moneda1 = "";
            $moneda2 = "";
            foreach ($connec->query($query1) as $row1) {
                $moneda1 = $row1['moneda1'];
                $moneda2 = $row1['moneda2'];
            }
            $query = "SELECT nombre, cantidad, precio_unitario, (precio_unitario*cantidad) AS subtotal,
                        (CASE WHEN comp.id_moneda = TC.id_moneda1 THEN (precio_unitario*TC.factor) ELSE ((precio_unitario)/TC.factor) END) AS preunimoneda,
                        (CASE WHEN comp.id_moneda = TC.id_moneda1 THEN ((precio_unitario*cantidad)*TC.factor) ELSE ((precio_unitario*cantidad)/TC.factor) END) AS subtotalmoneda
                        FROM compra_detalle AS comp_det 
                        INNER JOIN producto AS prod ON comp_det.id_producto = prod.id
                        INNER JOIN compra AS comp ON comp.id = comp_det.id_compra
                        INNER JOIN tasa_cambio TC ON TC.id = comp.id_tasa 
                        where id_compra = $_POST[id]";
                       
            $lista="<thead class='thead-dark'><tr>
                        <th scope='col'>Producto</th>
                        <th scope='col'>Cantidad</th>
                        <th scope='col'>Precio Unitario ".$moneda1."</th>
                        <th scope='col'>Subtotal ".$moneda1."</th>
                        <th scope='col'>Precio Unitario ".$moneda2."</th>
                        <th scope='col'>Subtotal ".$moneda2."</th>
                    </tr><thead>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $lista = $lista."<tr>
                                        <th scope='row'>".$row['nombre']."</th>
                                        <td>".$row['cantidad']."</td>
                                        <td>".$row['precio_unitario']."</td>
                                        <td>".$row['subtotal']."</td>
                                        <td>".$row['preunimoneda']."</td>
                                        <td>".$row['subtotalmoneda']."</td>
                                    </tr>";

            }
            $lista = $lista."<tr id='totalCompra'></tr>";
            echo $lista;
            break;
        case 'getTotalFactura':
            $query = "SELECT SUM(cantidad*precio_unitario) AS total_factura,
                        SUM(
                            (SELECT CASE WHEN TC.id_moneda1 = comp.id_moneda THEN (cantidad*precio_unitario)*TC.factor ELSE (cantidad*precio_unitario)/TC.factor END FROM tasa_cambio AS TC WHERE TC.id = comp.id_tasa)
                            ) as total_factura2
                        FROM compra_detalle AS comp_det 
                        INNER JOIN compra AS comp ON comp.id = comp_det.id_compra
                        INNER JOIN producto AS prod ON comp_det.id_producto = prod.id 
                        WHERE id_compra =  $_POST[id]
                        GROUP BY comp.id_tasa ";
            $total_factura="";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $total_factura = $row['total_factura'];
                    $total_factura2 = $row['total_factura2'];

            }
                $result="<th scope='col' >&nbsp;</th>
                                <th scope='col' >&nbsp;</th>
                                <th scope='col'>TOTAL</th>
                                <th scope='col'>".$total_factura."</th>
                                <th scope='col' >-</th>
                                <th scope='col' >".$total_factura2."</th>";
            echo $result;
            break;
        case 'createMoneda':
            $query = "INSERT INTO moneda(nombre) VALUES ('$_POST[moneda_nomb]')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            echo $count;
            break;
        case 'getMoneda':
            $query = "SELECT * FROM moneda ORDER BY nombre";
            $opciones="<option value=''>Seleccione...</option>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $opciones = $opciones."<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $opciones;
            break;
        case 'createTasaCambio':
            $query = "INSERT INTO tasa_cambio(fecha, id_moneda1, id_moneda2, factor) VALUES ('$_POST[fecha_tasa]', '$_POST[select_moneda1]', '$_POST[select_moneda2]', '$_POST[tasacambio]')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            //echo $count;
            break;
        case 'getMonedaFactura':
            $query1 = "SELECT id_moneda FROM compra WHERE id = '$_POST[fact_id]'";
            $moneda = 1;
            foreach ($connec->query($query1) as $row1) {
                $moneda = $row1["id_moneda"];
            }
            $query = "SELECT nombre, id FROM moneda ORDER BY nombre";
            $opciones="<option value=''>Seleccione...</option>";
            foreach ($connec->query($query) as $row) {
                $selected = "";
                if($row['id'] == $moneda)
                    $selected = "selected";
                    $opciones = $opciones."<option value='".$row['id']."' ".$selected.">".$row['nombre']."</option>";
            }
            echo $opciones;            
            break;
        case 'getTasa':
            $query1 = "SELECT 
                        (SELECT nombre FROM moneda WHERE id = TC.id_moneda1) AS moneda1,
                        (SELECT nombre FROM moneda WHERE id = TC.id_moneda2) AS moneda2,
                        TC.factor,
                        TC.id
                    FROM tasa_cambio AS TC 
                    WHERE TC.id_moneda1 = '$_POST[moneda_id]' OR TC.id_moneda2 = '$_POST[moneda_id]'
                    ORDER BY fecha DESC LIMIT 5";
                    echo $query1;
            $opciones="<option value=''>Seleccione...</option>";
            foreach ($connec->query($query1) as $row) {
                    $opciones = $opciones."<option value='".$row['id']."' >".$row['factor']." ".$row['moneda1']." X 1 ".$row['moneda2']."</option>";
            }
            echo $opciones;            
            break;
    }
?>