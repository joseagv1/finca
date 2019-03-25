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
            $opciones="<option value=''>Todas</option>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $opciones = $opciones."<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $opciones;
            break;
        case 'createProd':
            if($_POST['prodid']==0)
                $query = "INSERT INTO producto(nombre, descripcion, id_categoria, cant_percapita) VALUES ('$_POST[prod_name]','$_POST[prod_desc]','$_POST[producto_categoria]','$_POST[cant_percapita]')";
                else
                $query = "UPDATE producto SET 
                            nombre = '$_POST[prod_name]', descripcion = '$_POST[prod_desc]', id_categoria = '$_POST[producto_categoria]', cant_percapita = '$_POST[cant_percapita]'
                            WHERE id = '$_POST[prodid]'";
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
        case 'getListaProductos':
            $query = "SELECT P.*, cat.nombre AS categoria
                        FROM producto AS P
                        INNER JOIN categoria AS cat ON cat.id = P.id_categoria
                        ORDER BY P.nombre";
            $statement = $connec->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
            break;

        case 'getProductoPorId':
            $query = "SELECT P.*, cat.nombre AS categoria
                        FROM producto AS P
                        INNER JOIN categoria AS cat ON cat.id = P.id_categoria
                        WHERE p.id =  $_POST[id]
                        ORDER BY P.nombre";
            $statement = $connec->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
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
        case 'compraRows':
                $query = "SELECT * FROM producto ORDER BY nombre";
                $currentprod=0;
                $lista="";
               
                $lasttrowshow = 1;
                foreach ($connec->query($query) as $row) {
                    // $currentrow = 0;
                    // $opciones="<option value=''>Seleccione...</option>";
                    // foreach ($connec->query($query) as $row1) {
                    //     //if($row1['id'] > 0)
                    //     $currentrow++;
                    //     if($currentrow == $lasttrowshow){
                    //         $opciones = $opciones."<option value='".$row1['id']."' selected>".$row1['nombre']."</option>";
                    //         $currentprod=$row1['id'];
                    //     }
                    //     else{
                    //         $opciones = $opciones."<option value='".$row1['id']."'>".$row1['nombre']."</option>";
                    //     }                            
                    // }
                    // $lasttrowshow++;
                    // <div class="input-group mb-3">
                    //     <select class="custom-select products"  name="productoid">'.$opciones.'</select>
                    // </div>
                    $lista=$lista.'<tr class="compraRows">
                    <th>
                    '.$row['nombre'].'
                    <input type="hidden" id="productoid" name="productoid" value="'.$row['id'].'">
                    </th>
                    <td><input type="text" class="form-control cant_prod required" name="cant_prod"  ></td>
                    <td><input type="text" class="form-control precio_prod required" name="precio_prod" > </td>
                </tr>';
                
                }
                echo $lista;
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
            $query = "INSERT INTO compra(fecha, factura_numero, forma_pago, nota) VALUES ('$fecha_fact','$num_fact', '$forma_fact','$nota_fact')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            $lastcompraid = $connec->lastInsertId(); 
            $lastInvId=0;
            foreach ($detalleComp as $item) {
                //echo $item[0];
                if($item[1] !="" && $item[1] > 0){
                    $query1 = "INSERT INTO compra_detalle(id_compra, id_producto, cantidad, precio_unitario) VALUES ('$lastcompraid','$item[0]', '$item[1]', '$item[2]')";
                    $queryexec1 = $connec->prepare($query1); 
                    $count = $queryexec1->execute();
                }
            }

            $queryInv = "INSERT INTO inventario(id_compra, fecha) VALUES ('$lastcompraid',CURRENT_DATE)";
            $queryexecInv = $connec->prepare($queryInv); 
            $count = $queryexecInv->execute();
            $lastInvId = $connec->lastInsertId(); 
            
            foreach ($detalleComp as $item) {
                //echo $item[0];
                if($item[1] !="" && $item[1] > 0){
                    $querydetinv = "INSERT INTO inventario_detalle(id_inventario, id_producto, precio_unitario, cantidad, id_tipomovimento,cantidad_disponible) VALUES ('$lastInvId', '$item[0]', '$item[2]', '$item[1]' , 1, '$item[1]')";
                    $queryexecdetinv = $connec->prepare($querydetinv); 
                    $countdetinv = $queryexecdetinv->execute();
                }
            }
            echo $lastInvId;
        break;
        case 'getListaCompra':
            $query = "SELECT * FROM compra ORDER BY fecha DESC";
            $lista="";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $lista = $lista."<tr><th scope='row'><a href='javascript:void(0);' onclick='editCompra(".$row['id'].",0)'> <span class='oi oi-pencil'></span></a>&nbsp;&nbsp;<a href=''><span class='oi oi-trash'></span></a></th>";
                    $lista = $lista."<th scope='row'><a href='javascript:void(0)' onclick='showfactura(".$row['id'].",0)'>".$row['factura_numero']."</a></th><td>".$row['fecha']."</td></tr>";
            }
            echo $lista;
        break;
        case 'getListaDespacho':
            $query = "SELECT * FROM despacho ORDER BY fecha DESC";
            $lista="";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $lista = $lista."<tr><th scope='row'><a href='javascript:void(0);' onclick='editDespacho(".$row['id'].",0)'> <span class='oi oi-pencil'></span></a>&nbsp;&nbsp;<a href=''><span class='oi oi-trash'></span></a></th>";
                    $lista = $lista."<th scope='row'><a href='javascript:void(0)' onclick='showdespacho(".$row['id'].",0)'>".$row['fecha']."</a></th></tr>";
            }
            echo $lista;
        break;
        case 'showfactura':
            /*$query1 = "SELECT
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

            }*/
            $queryCompra="SELECT * FROM compra WHERE id = $_POST[id]";
            $lista="<thead class='thead-dark'><tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Fecha</th>
                        <th scope='col'>Nota</th>
                        <th scope='col'>Forma Pago</th>
                    </tr><thead>";
            foreach ($connec->query($queryCompra) as $rowCompra) {
                $lista = $lista."<tr>
                                        <td scope='row'>".$rowCompra['factura_numero']."</td>
                                        <td>".$rowCompra['fecha']."</td>
                                        <td>".$rowCompra['forma_pago']."</td>
                                        <td>".$rowCompra['nota']."<input type='hidden' id='compraid' name='compraid' value='".$_POST['id']."'></td>
                                    </tr>
                                    ";
            }
            $query = "SELECT nombre, cantidad, precio_unitario, (precio_unitario*cantidad) AS subtotal,prod.id AS productoid
                        FROM compra_detalle AS comp_det 
                        INNER JOIN producto AS prod ON comp_det.id_producto = prod.id
                        INNER JOIN compra AS comp ON comp.id = comp_det.id_compra
                        where id_compra = $_POST[id]
                        ORDER BY prod.nombre";
            if($_POST['opcion'] == 2){
                $lista=$lista."<thead class='thead-dark'><tr>
                                <th scope='col'>Producto</th>
                                <th scope='col'>Cantidad</th>
                                <th scope='col' colspan='2'>Precio Unitario</th>
                            </tr><thead>";  
            }
            else{
                $lista=$lista."<thead class='thead-dark'><tr>
                                <th scope='col'>Producto</th>
                                <th scope='col'>Cantidad</th>
                                <th scope='col'>Precio Unitario</th>
                                <th scope='col'>Subtotal</th>
                            </tr><thead>";
            }         
           
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                if($_POST['opcion'] == 2){
                    $lista = $lista."<tr>
                                        <td scope='row'>".$row['nombre']."<input type='hidden' name='productoid' value='".$row['productoid']."'></td>
                                        <td><input type='text' class='form-control required form-editar-compra' name='cantidad' data-required='Ingrese una cantidad' value='".number_format($row['cantidad'], 2, ',', '.')."'></td>
                                        <td colspan='2'><input type='text' class='form-control required form-editar-compra' name='preciounitario'  data-required='Ingrese precio' value='".number_format($row['precio_unitario'], 2, ',', '.')."'></td>
                                    </tr>";
                }
                else{
                    $lista = $lista."<tr>
                                        <th scope='row'>".$row['nombre']."</th>
                                        <td>".number_format($row['cantidad'], 2, ',', '.')."</td>
                                        <td>".number_format($row['precio_unitario'], 2, ',', '.')."</td>
                                        <td>".number_format($row['subtotal'], 2, ',', '.')."</td>
                                    </tr>";
                }

            }
            if($_POST['opcion']==1)
                $lista = $lista."<tr id='totalCompra'></tr>";
            echo $lista;
            break;
            case 'showdespacho':
                $queryCompra="SELECT * FROM despacho WHERE id = $_POST[id]";
                $lista="<thead class='thead-dark'><tr>
                        <th scope='col' colspan='2'>Fecha</th>
                        </tr><thead>";
                foreach ($connec->query($queryCompra) as $rowCompra) {
                    $lista = $lista."<tr>
                                            <td>".$rowCompra['fecha']."<input type='hidden' id='despachoid' name='despachoid' value='".$_POST['id']."'></td>                                            
                                        </tr>
                                        ";
                }
                $query = "SELECT nombre, cantidad, prod.id AS productoid
                            FROM despacho_detalle AS comp_det 
                            INNER JOIN producto AS prod ON comp_det.id_producto = prod.id
                            INNER JOIN despacho AS comp ON comp.id = comp_det.id_despacho
                            where id_despacho = $_POST[id]
                            ORDER BY prod.nombre";
                if($_POST['opcion'] == 2){
                    $lista=$lista."<thead class='thead-dark'><tr>
                                    <th scope='col'>Producto</th>
                                    <th scope='col'>Cantidad</th>
                                </tr><thead>";  
                }
                else{
                    $lista=$lista."<thead class='thead-dark'><tr>
                                    <th scope='col'>Producto</th>
                                    <th scope='col'>Cantidad</th>
                                </tr><thead>";
                }         
            
                foreach ($connec->query($query) as $row) {
                    //if($row['id'] > 0)
                    if($_POST['opcion'] == 2){
                        $lista = $lista."<tr>
                                            <td scope='row'>".$row['nombre']."<input type='hidden' name='productoid' value='".$row['productoid']."'></td>
                                            <td><input type='text' class='form-control required form-editar-despacho' name='cantidad' data-required='Ingrese una cantidad' value='".number_format($row['cantidad'], 2, ',', '.')."'></td>
                                        </tr>";
                    }
                    else{
                        $lista = $lista."<tr>
                                            <td scope='row'>".$row['nombre']."</td>
                                            <td scope='row'>".number_format($row['cantidad'], 2, ',', '.')."</td>
                                        </tr>";
                    }

                }
                /*if($_POST['opcion']==1)
                    $lista = $lista."<tr id='totalCompra'></tr>";*/
                echo $lista;
        break;
        case 'getTotalFactura':
            /*$query = "SELECT SUM(cantidad*precio_unitario) AS total_factura,
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
                                <th scope='col' >".$total_factura2."</th>";*/
            $query = "SELECT SUM(cantidad*precio_unitario) AS total_factura
                        FROM compra_detalle AS comp_det 
                        INNER JOIN compra AS comp ON comp.id = comp_det.id_compra
                        INNER JOIN producto AS prod ON comp_det.id_producto = prod.id 
                        WHERE id_compra =  $_POST[id]";
            $total_factura="";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $total_factura = $row['total_factura'];

            }
                $result="<th scope='col' >&nbsp;</th>
                                <th scope='col' >&nbsp;</th>
                                <th scope='col'>TOTAL</th>
                                <th scope='col'>".number_format($total_factura, 2, ',', '.')."</th>";
            echo $result;
            break;
        case 'updateCompra':
            $compraid = 0;
            $i = 0;
            $data = json_decode(stripslashes($_POST['compraObj']));
            foreach ($data as $item) {                
                switch ($item->name) {
                    case 'compraid':
                        $compraid = $item->value;
                    break;
                    case 'productoid':
                        $detalleComp[$i][0] = $item->value;
                    break;
                    case 'cantidad':
                        $detalleComp[$i][1] = str_replace(",",".",str_replace(".","",$item->value));
                    break;
                    case 'preciounitario':
                        $detalleComp[$i][2] = str_replace(",",".",str_replace(".","",$item->value));
                        $i++;
                    break;
                }
            }
            $queryInventario = $connec->prepare("SELECT * FROM inventario WHERE id_compra = '$compraid'");
            $queryInventario->execute(); 
            $row = $queryInventario->fetch();
            foreach ($detalleComp as $item) {
                $sqlNewDetInv = $connec->prepare("SELECT SUM(cantidad) AS cantidad 
                                                FROM inventario AS inv 
                                                INNER JOIN inventario_detalle AS invdet ON inv.id = invdet.id_inventario 
                                                WHERE inv.id_compra = $compraid AND invdet.id_producto = $item[0] AND invdet.id_tipomovimento = 2");
                $sqlNewDetInv->execute(); 
                $rowInvdet = $sqlNewDetInv->fetch();
                $newCantDisponible = $item[1]-$rowInvdet['cantidad'];
                $sql = "UPDATE compra_detalle SET cantidad = $item[1], precio_unitario = $item[2] WHERE id_compra = $compraid AND id_producto = $item[0]";
                $queryexecInv = $connec->prepare($sql); 
                $count = $queryexecInv->execute();      
                $sqlDetInv = "UPDATE inventario_detalle SET cantidad = $item[1], precio_unitario = $item[2], cantidad_disponible = $newCantDisponible WHERE id_inventario = $row[id] AND id_producto = $item[0] AND id_tipomovimento = 1";
                $queryexecInvdet = $connec->prepare($sqlDetInv); 
                $count = $queryexecInvdet->execute();     
                echo $sqlDetInv;  
            }
            break;
        case 'validarUpdateCompra':
            $data = json_decode(stripslashes($_POST['compraObj']));
            $i = 0;
            $result = 1;
            foreach ($data as $item) {                
                switch ($item->name) {
                    case 'compraid':
                        $compraid = $item->value;
                    break;
                    case 'productoid':
                        $detalleComp[$i][0] = $item->value;
                    break;
                    case 'cantidad':
                        $detalleComp[$i][1] = str_replace(",",".",str_replace(".","",$item->value));
                    break;
                    case 'preciounitario':
                        $detalleComp[$i][2] = str_replace(",",".",str_replace(".","",$item->value));
                        $i++;
                    break;
                }
            }
            foreach($detalleComp AS $itemInv){
                $queryInvdet = $connec->prepare("SELECT SUM(cantidad) AS cantidad 
                                FROM inventario AS inv 
                                INNER JOIN inventario_detalle AS invdet ON inv.id = invdet.id_inventario 
                                WHERE inv.id_compra = $compraid AND invdet.id_producto = $itemInv[0] AND invdet.id_tipomovimento = 2");
                $queryInvdet->execute(); 
                $rowInvdet = $queryInvdet->fetch();
                
                if($rowInvdet['cantidad']>$itemInv[1]){
                    $result = 0;
                    break;
                }
            }
            echo $result;
            break;
        case 'createMoneda':
            $query = "INSERT INTO moneda(nombre) VALUES ('$_POST[moneda_nomb]')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            $lastmonedaid = $connec->lastInsertId(); 
            echo $lastmonedaid;
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
            $lasttasaid = $connec->lastInsertId(); 
            echo $lasttasaid;
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
        case 'getTasaCompra':
            $query1 = "SELECT (SELECT nombre FROM moneda WHERE id = TC.id_moneda1) AS moneda1,
                              (SELECT nombre FROM moneda WHERE id = TC.id_moneda2) AS moneda2, 
                            TC.factor,
                            TC.id
                            FROM tasa_cambio AS TC INNER JOIN moneda AS mon ON mon.id = TC.id_moneda1 WHERE TC.id_moneda1 = 1 ORDER BY TC.id DESC, TC.fecha DESC  LIMIT 1";
                    
            $opciones="<option value=''>Seleccione...</option><option value='' onclick='createTasaCambioCompra()'>Nueva Tasa</optio>";
            foreach ($connec->query($query1) as $row) {
                    $opciones = $opciones."<option value='".$row['id']."' >".$row['factor']." ".$row['moneda1']." X 1 ".$row['moneda2']."</option>";
            }
            echo $opciones;            
            break;
        case 'createUnidad':
            $query = "INSERT INTO unidad(nombre, empleados, descripcion) VALUES ('$_POST[unidad_nomb]', '$_POST[unidad_empleados]', '$_POST[unidad_descripcion]')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
        break;
        case 'getUnidadProd':
            $query = "SELECT * FROM unidad ORDER BY nombre";
            $opciones="<option value=''>Seleccione una Unidad</option>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $opciones = $opciones."<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $opciones;
        break;
        case 'getCompras':
            $query = "SELECT * FROM compra ORDER BY fecha";
            $opciones="<option value=''>Seleccione una Compra</option>";
            foreach ($connec->query($query) as $row) {
                $opciones = $opciones."<option value='".$row['id']."'>".$row['factura_numero']."</option>";
            }    
            echo $opciones;        
        break;
        case 'showdetallecomp':
            $query1 = "SELECT nombre, empleados
                    FROM unidad
                    WHERE id = $_POST[unidad_prod]";
            $empleados = 1;
            foreach ($connec->query($query1) as $row1) {
                $empleados = $row1['empleados'];
            }
            $query = "SELECT nombre, cantidad, cant_percapita
                        FROM compra_detalle AS comp_det 
                        INNER JOIN producto AS prod ON comp_det.id_producto = prod.id
                        INNER JOIN compra AS comp ON comp.id = comp_det.id_compra
                        where id_compra = $_POST[id]";
                    
            $lista="<thead class='thead-dark'><tr>
                        <th scope='col'>Producto</th>
                        <th scope='col'>Cantidad Disponible</th>
                        <th scope='col'>Empleados</th>
                        <th scope='col'>Cantida Percapita</th>
                        <th scope='col'>Cantida A Despachar</th>
                    </tr><thead>";
            foreach ($connec->query($query) as $row) {
                //if($row['id'] > 0)
                    $lista = $lista."<tr>
                                        <td scope='row'>".$row['nombre']."</td>
                                        <td> ".$row['cantidad']."</td>
                                        <td> ".$empleados."</td>
                                        <td> ".$row['cant_percapita']."</td>
                                        <td> <input type='text' class='form-control' value='".($row['cant_percapita']*$empleados)."'></td>
                                    </tr>";

            }
           
            echo $lista;
        break;
        case 'getDetalleProducto':
            $query = "SELECT *, (SELECT SUM(empleados) FROM unidad) AS total_comensales
                    FROM producto AS prod
                    INNER JOIN compra_detalle AS comp_det ON id_producto = prod.id
                    INNER JOIN compra AS comp ON comp.id = comp_det.id_compra
                    WHERE prod.id = $_POST[id]
                    ORDER BY comp.fecha DESC
                    LIMIT 1";
            $statement = $connec->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
        break;
        case 'addMenuRow':
            $options="";
            for($i=1;$i<=100;$i++){
                $options=$options.'<option id='.$i.'>'.$i.'</option>';
            }
            echo'<tr>
                    <th scope="row">
                    <div class="input-group mb-3">
                        <select class="custom-select products" name="productoid" onchange="getDetalleProducto(this.value)">
                        </select>
                    </div>
                    </th>        
                    <td><span class="cant_percapita" id="cant_percapita" name="cant_percapita"></span><input type="hidden" class="cant_percapita" value=""></td>
                    <td>
                        <div class="input-group mb-3">
                            <select class="custom-select cant_eventos" name="cant_eventos" onchange="refreshSubEventos(this.value)">
                                '.$options.'
                            </select>
                        </div>
                    </td>
                    <td><span class="subt_eventos" id="subt_eventos" name="subt_eventos"></span><input type="hidden" class="subt_eventos" value=""></td>
                </tr>';
        break; 
        case 'menuRows':
            $query = "SELECT * FROM producto ORDER BY nombre";
            $currentprod=0;
            $lista="";
            
            $lasttrowshow = 1;
            foreach ($connec->query($query) as $row) {
                
                $lista=$lista.'<tr>
                <th scope="row">
                '.$row['nombre'].'
                <input type="hidden" name="productoid" value="'.$row['id'].'">
                </th>        
                <td><span class="cant_percapita'.$row['id'].'" id="cant_percapita'.$row['id'].'" name="cant_percapita">'.$row['cant_percapita'].'</span><input type="hidden" class="cant_percapita'.$row['id'].'" value="'.$row['cant_percapita'].'"></td>
                <td>
                    
                    <input type="text" class="cant_eventos'.$row['id'].' form-control" name="cant_eventos" onkeyup="refreshSubEventos('.$row['id'].')">
                </td>
                <td><span class="subt_eventos'.$row['id'].'" id="subt_eventos'.$row['id'].'" name="subt_eventos">0,00</span><input type="hidden" class="subt_eventos'.$row['id'].'" value="0"></td>
            </tr>';
            
            }
            echo $lista;
        break;
        case 'createMenu':
            $data = json_decode(stripslashes($_POST['compraObj']));
            $i = 0;
            foreach($data as $obj){
                switch($obj->name){    
                    case 'cant_eventos':
                        $menu[$i][1] = $obj->value;
                        $i++;
                    break;
                    case 'productoid':
                        $menu[$i][0] = $obj->value;
                    break;
                    case 'comedor_id':
                        $idcomedor = $obj->value;
                    break;
                    case 'fecha_menu':
                        $fecha_menu = $obj->value;
                    break;
                }                
            }
            $query = "INSERT INTO menu(fecha, nombre, id_comedor) VALUES (NOW(),'Menu','$idcomedor')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            $lastmenuid = $connec->lastInsertId(); 
            
            foreach($menu as $item){
                    $query = "INSERT INTO detalle_menu(eventos, id_producto, id_menu) VALUES ('$item[1]','$item[0]','$lastmenuid')";
                    $queryexec = $connec->prepare($query); 
                    $count = $queryexec->execute();
            }        
        break;
        case 'getEmpleados':
            $query = "SELECT * FROM unidad
                    WHERE id = $_POST[id]";
            $statement = $connec->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
        break;
        case 'getEmpleados':
            $query = "SELECT * FROM unidad
                    WHERE id = $_POST[id]";
            $statement = $connec->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
        break;
        case 'addUnidadRow':
            echo'<tr>       
                    <td>
                        <div class="input-group mb-3">
                            <select class="custom-select" name="unidad_prod" id="unidad_prod" onchange="getEmpleadosComedor(this.value)"></select>
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <select class="custom-select cant_eventos" name="cant_empleados" id="cant_empleados"></select>
                        </div>
                    </td>
                </tr>';
        break;
        case 'createComedor':
            $data = json_decode(stripslashes($_POST['compraObj']));
            $i = 0;
            foreach($data as $obj){
                switch($obj->name){    
                    case 'nom_comedor':
                        $nombre = $obj->value;
                    break;
                    case 'unidad_prod':
                        $comedor[$i][0] = $obj->value;
                    break;
                    case 'cant_empleados':
                        $comedor[$i][1] = $obj->value;
                        $i++;
                    break;
                }                
            }
            $query = "INSERT INTO comedor(nombre) VALUES ('$nombre')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            $lastmenuid = $connec->lastInsertId(); 
            foreach($comedor as $item){
                    $query = "INSERT INTO detalle_comedor(id_comedor, id_unidad, empleados) VALUES ('$lastmenuid','$item[0]','$item[1]')";
                    $queryexec = $connec->prepare($query); 
                    $count = $queryexec->execute();
            }        
        break; 
        case 'getComedor':
            $query = "SELECT * FROM comedor";
            $statement = $connec->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
        break;
        case 'getListaCompras':
            $query = "SELECT * FROM compra ORDER BY fecha DESC";
            $statement = $connec->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
        break;
        case 'generarReporteComedor':
            $filtroFecha = "";
            if(isset($_POST['fecha_compra']) && $_POST['fecha_compra'] != ""){
                $filtroFecha = "AND com.fecha ='".$_POST['fecha_compra']."'";
            }
            $query = "SELECT *,
                    (totaleventos*precio_unitario*empleados) AS totalcosto,
                                                (totaleventos*empleados) AS totalcompra
                    FROM 
                        (SELECT DISTINCT prod.nombre AS prodnomb, cat.nombre, det_men.eventos, (prod.cant_percapita*det_men.eventos) AS totaleventos, prod.cant_percapita,
                            (SELECT detcomp.precio_unitario FROM compra AS com INNER JOIN compra_detalle AS detcomp ON detcomp.id_compra = com.id WHERE detcomp.id_producto = prod.id  ".$filtroFecha." ORDER BY com.fecha DESC LIMIT 1),
                            tipoemp.nombre AS nombreempaque,
                            (SELECT SUM(empleados) FROM detalle_comedor WHERE id_comedor = men.id_comedor) AS empleados,
                                men.fecha,  men.id
                                FROM menu AS men
                                INNER JOIN detalle_menu AS det_men ON det_men.id_menu = men.id
                                INNER JOIN producto AS prod ON prod.id = det_men.id_producto
                                INNER JOIN categoria AS cat ON cat.id = prod.id_categoria
                                INNER JOIN empaque AS emp ON emp.id = prod.id_empaque
                                INNER JOIN tipo_empaque AS tipoemp ON tipoemp.id = emp.id_tipo_empaque
                                WHERE men.id_comedor = '$_POST[id]'
                                        AND (SELECT detmen1.id FROM detalle_menu AS detmen1 INNER JOIN menu AS men1 ON detmen1.id_menu = men1.id WHERE detmen1.id_producto = det_men.id_producto AND men1.id_comedor = men.id_comedor
                                                ORDER BY men1.fecha DESC LIMIT 1) = det_men.id    
                                ORDER BY men.fecha DESC
                            ) AS q
                    ORDER BY nombre, prodnomb";
            $result = "";
            $totalcostos = 0;
            foreach ($connec->query($query) as $row) {
                $result = $result.'<tr class="detallerepcomedor">
                <td scope="col" >'.$row["prodnomb"].'</td>
                <td scope="col" >'.$row["nombre"].'</td>
                <td scope="col" >'.number_format($row["cant_percapita"], 2, ',', '.').' '.$row["nombreempaque"].'</td>
                <td scope="col">'.$row["eventos"].'</td>
                <td scope="col">'.number_format($row["totaleventos"], 2, ',', '.').' '.$row["nombreempaque"].'</td>
                <td scope="col">'.$row["empleados"].'</td>
                <td scope="col">'.number_format($row["totalcompra"], 2, ',', '.').' '.$row["nombreempaque"].'</td>
                <td scope="col">'.number_format($row["totalcosto"], 2, ',', '.').'</td>
              </tr>';
              $totalcostos = $totalcostos + $row["totalcosto"];
            }
            $result = $result.'<tr class="detallerepcomedor">
                <th scope="col" colspan="7" style="text-align: right;">Total</th>
                <th scope="col" >'.number_format($totalcostos, 2, ',', '.').'</th>
              </tr>';
            echo $result;
        break;
        case 'generarReporteCentroCostos':
        $filtroFecha = "";
            if(isset($_POST['fecha_compra']) && $_POST['fecha_compra'] != ""){
                $filtroFecha = "AND com.fecha ='".$_POST['fecha_compra']."'";
            }
            $result = '<tr class="detallerepcentrocostos" style="font-weight: bold;"><td scope="col" >&nbsp;</td>';
            $queryCols="SELECT com.nombre, SUM(detcom.empleados) AS empleados, com.id
                            FROM comedor AS com
                            INNER JOIN detalle_comedor AS detcom ON detcom.id_comedor = com.id
                            GROUP BY com.nombre, com.id
                            ORDER BY com.nombre";
            $totalComedor = 0;
            foreach ($connec->query($queryCols) as $row) {
                $result = $result.'<td scope="col" >'.$row["nombre"].'</td>'; 
                $totalComedor++;
            }
            $result = $result.'<td scope="col" >Totales</td>';
            $result = $result."</tr>";

            $totalempleados = 0;
            $result = $result.'<tr class="detallerepcentrocostos" style="font-style: italic;font-weight: bold;"><td scope="col" >Empleados</td>';
            foreach ($connec->query($queryCols) as $row) {
                $result = $result.'<td scope="col" >'.$row["empleados"].'</td>'; 
                $totalempleados = $totalempleados + $row["empleados"];
            }
            $result = $result.'<td scope="col" >'.$totalempleados.'</td>';
            $result = $result."</tr>";
            
            $queryTipo="SELECT * FROM categoria ORDER BY nombre";
            if(isset($_POST['id']) && $_POST['id'] != '')
                $queryTipo="SELECT * FROM categoria WHERE id = '".$_POST['id']."' ORDER BY nombre";
            
            foreach ($connec->query($queryTipo) as $row1) {
                $totalcostos = 0;
                $totaltipo = 0;
                $result = $result.'<tr class="detallerepcentrocostos"><td>'.$row1["nombre"].'</td>'; 
                $show =0;
                foreach ($connec->query($queryCols) as $row) {
                    $totalcostos =0;
                    $query="SELECT  SUM(totaleventos*precio_unitario*empleados) AS totalcosto			
                            FROM
                            (SELECT prod.cant_percapita, det_men.eventos, (prod.cant_percapita*det_men.eventos) AS totaleventos, cat.nombre, (SELECT SUM(empleados) FROM detalle_comedor WHERE id_comedor = men.id_comedor) AS empleados,
                            (SELECT detcomp.precio_unitario FROM compra AS com INNER JOIN compra_detalle AS detcomp ON detcomp.id_compra = com.id WHERE detcomp.id_producto = prod.id ".$filtroFecha." ORDER BY com.fecha DESC LIMIT 1),
                            (SELECT tipoemp.nombre FROM empaque AS emp INNER JOIN tipo_empaque AS tipoemp ON tipoemp.id = emp.id_tipo_empaque) AS nombreempaque
                                FROM menu AS men
                                INNER JOIN detalle_menu AS det_men ON det_men.id_menu = men.id
                                INNER JOIN producto AS prod ON prod.id = det_men.id_producto
                                INNER JOIN categoria AS cat ON cat.id = prod.id_categoria
                                WHERE cat.id = ".$row1['id']."
                                    AND men.id_comedor =  ".$row['id']."
                            ) AS q";
                   
                    foreach ($connec->query($query) as $row2) {
                        $result = $result.'<td>'.number_format($row2["totalcosto"], 2, ',', '.').'</td>';
                        $totalcostos = $totalcostos + $row2["totalcosto"];
                        $show++;
                    }   
                    if(isset($totalcomedor["".$row['id'].""]))
                            $totalcomedor["".$row['id'].""] = $totalcomedor["".$row['id'].""] + $totalcostos;
                            else
                                $totalcomedor["".$row['id'].""] = $totalcostos;
                    $totaltipo = $totaltipo + $totalcostos;          
                }
                if($totalComedor>$show){
                    for($i=0;$i<$totalComedor-$show;$i++){
                        $result = $result.'<td>0,00</td>';
                    }
                }
                $result = $result."<td>".number_format($totaltipo, 2, ',', '.')."</td>";
                $result = $result."</tr>";
                
            }
            $result =  $result.'<tr class="detallerepcentrocostos" style="font-weight: bold;"><td scope="col" >Monto Comedor</td>';
            $totalcomedores = 0;
            foreach ($connec->query($queryCols) as $row) {
                $result = $result."<td>".number_format($totalcomedor["".$row['id'].""], 2, ',', '.')."</td>";
                $totalcomedores = $totalcomedores + $totalcomedor["".$row['id'].""];
            }
            $result = $result."<td>".number_format($totalcomedores, 2, ',', '.')."</td>";
            $result = $result."</tr>";

            $result =  $result.'<tr class="detallerepcentrocostos" style="font-style: italic;font-weight: bold;"><td scope="col" >Monto Alim. Por Empleado</td>';
            $totalcomedorespromedio = 0;
            foreach ($connec->query($queryCols) as $row) {
                $result = $result."<td>".number_format($totalcomedor["".$row['id'].""]/$row["empleados"], 2, ',', '.')."</td>";
                $totalcomedorespromedio = $totalcomedorespromedio + $totalcomedor["".$row['id'].""]/$row["empleados"];
            }
            $result = $result."<td>".number_format($totalcomedorespromedio, 2, ',', '.')."</td>";
            
            $result =  $result.'<tr class="detallerepcentrocostos" style="font-style: italic;font-weight: bold;"><td scope="col" >Monto Nom. Por Empleado</td>';
            $totalnom = 0;
            foreach ($connec->query($queryCols) as $row) {
                $queryNom="SELECT (SUM((SELECT costnom.costo FROM costo_nomina AS costnom WHERE costnom.id_unidad = und.id ORDER BY costnom.fecha DESC LIMIT 1)/und.empleados)) AS totalcostoemp
                            FROM comedor AS com
                            INNER JOIN detalle_comedor AS detcom ON detcom.id_comedor = com.id
                            INNER JOIN unidad AS und ON und.id = detcom.id_unidad
                            WHERE com.id = ".$row['id'];
                foreach ($connec->query($queryNom) as $rowNom) {
                    $result = $result."<td>".number_format(($rowNom["totalcostoemp"]), 2, ',', '.')."</td>";
                    $totalnom = $totalnom + ($rowNom["totalcostoemp"]*$row["empleados"]);
                    $totalnomROW["".$row['id'].""]=$rowNom["totalcostoemp"];
                }
            }
            $result = $result."<td>".number_format($totalnom, 2, ',', '.')."</td>";
            $result = $result."</tr>";

            $result =  $result.'<tr class="detallerepcentrocostos" style="font-style: italic;font-weight: bold;"><td scope="col" >Monto Total</td>';
            foreach ($connec->query($queryCols) as $row) {
                $result = $result."<td>".number_format($totalnomROW["".$row['id'].""]+($totalcomedor["".$row['id'].""]/$row["empleados"]), 2, ',', '.')."</td>";
            }
            $result = $result."</tr>";
            echo $result;
        break;
        case 'crearCostoNomina':
            $query = "INSERT INTO costo_nomina(id_unidad, costo, fecha) VALUES ('$_POST[unidadid]', '$_POST[costo]', NOW())";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            $lastmenuid = $connec->lastInsertId(); 
            echo $count;
        break;
        case 'generarReporteCompras':
            $filtercomedor = "";
            $filtercategoria = "";
            if(isset($_POST['idcomedor']) && $_POST['idcomedor'] > 0)
                $filtercomedor = " WHERE id =".$_POST['idcomedor'];
            if(isset($_POST['idcategoria']) && $_POST['idcategoria'] != "")
                $filtercategoria = " AND cat.id = ".$_POST['idcategoria'];
            $query = "SELECT * FROM comedor".$filtercomedor;
            $menuid = "";
            foreach ($connec->query($query) as $row) {
                $queryMenu = "SELECT fecha, id FROM menu WHERE id_comedor = ".$row['id']." ORDER BY FECHA DESC LIMIT 1";
                if($row['id'] == 0)
                    $queryMenu = "SELECT DISTINCT ON (id_comedor) id_comedor, id,fecha FROM menu ORDER BY id_comedor, fecha DESC";
                foreach ($connec->query($queryMenu) as $rowmenu) { 
                    if($menuid == '')
                        $menuid = $rowmenu['id'];
                        else
                            $menuid = $menuid.",".$rowmenu['id'];
                }
            }
            $queryReporte="SELECT prodnomb, SUM(totalcompra) AS totalacomprar, prodid
                            FROM (
                            SELECT q.prodnomb,
                                                (totaleventos*empleados) AS totalcompra, prodid
                                                FROM 
                                                    (SELECT DISTINCT prod.nombre AS prodnomb, prod.id AS prodid, cat.nombre, det_men.eventos, (prod.cant_percapita*det_men.eventos) AS totaleventos, prod.cant_percapita,
                                                        (SELECT detcomp.precio_unitario FROM compra AS com INNER JOIN compra_detalle AS detcomp ON detcomp.id_compra = com.id WHERE detcomp.id_producto = prod.id  ORDER BY com.fecha DESC LIMIT 1),
                                                        tipoemp.nombre AS nombreempaque,
                                                        (SELECT SUM(empleados) FROM detalle_comedor WHERE id_comedor = men.id_comedor) AS empleados,
                                                            men.fecha,  men.id
                                                            FROM menu AS men
                                                            INNER JOIN detalle_menu AS det_men ON det_men.id_menu = men.id
                                                            INNER JOIN producto AS prod ON prod.id = det_men.id_producto
                                                            INNER JOIN categoria AS cat ON cat.id = prod.id_categoria
                                                            INNER JOIN empaque AS emp ON emp.id = prod.id_empaque
                                                            INNER JOIN tipo_empaque AS tipoemp ON tipoemp.id = emp.id_tipo_empaque
                                                            WHERE men.id IN ($menuid)  AND (SELECT detmen1.id FROM detalle_menu AS detmen1 INNER JOIN menu AS men1 ON detmen1.id_menu = men1.id WHERE detmen1.id_producto = det_men.id_producto AND men1.id_comedor = men.id_comedor
                                                                            ORDER BY men1.fecha DESC LIMIT 1) = det_men.id    
                                                                ".$filtercategoria."
                                                            ORDER BY men.fecha DESC
                                                        ) AS q
                                                ORDER BY nombre, prodnomb
                                ) AS Q1
                                GROUP BY prodnomb, prodid";
                $result = "";
                $totalcostos = 0;
                foreach ($connec->query($queryReporte) as $rowreporte) {
                    $queryInventario = $connec->prepare("SELECT SUM(cantidad_disponible) AS cantdisp FROM inventario_detalle AS invdet WHERE id_producto = '$rowreporte[prodid]' AND id_tipomovimento = 1 AND cantidad_disponible > 0");
                    
                    $queryInventario->execute(); 
                    $row = $queryInventario->fetch();
                    //number_format($row["cantdisp"], 2, ',', '.')
                    $result = $result.'<tr class="detallerepcomedor">
                    <td scope="col" >'.$rowreporte["prodnomb"].'</td>
                    <td scope="col" >'.$rowreporte["totalacomprar"].'</td>
                    <td scope="col" >'.number_format($row["cantdisp"], 2, '.', ',').'</td>
                    <td scope="col" >'. number_format(($row["cantdisp"]-$rowreporte["totalacomprar"]), 2, '.', ',').'</td>
                  </tr>';
                }
                echo $result;
        break;
        case 'getListaUnidad':
            $queryReporte = "SELECT * FROM unidad ORDER BY nombre";
            $result = "";
            foreach ($connec->query($queryReporte) as $rowreporte) {
                $queryCost = $connec->prepare("SELECT * FROM costo_nomina WHERE id_unidad = ".$rowreporte["id"]." ORDER BY fecha, id DESC LIMIT 1");               
                $queryCost->execute(); 
                $rowCosto = $queryCost->fetch();
                $numEmpleados = $rowreporte["empleados"];
                if($rowCosto > 0){                    
                    $numEmpleados = $rowCosto["costo"];
                }
                $result = $result.'<tr class="detallerepcomedor">
                <td scope="col"><a href="javascript:void(0);" onclick="showCostoUnidad('.$rowreporte["id"].')" class="addlinkprod"> <span class="oi oi-pencil"></span></a>&nbsp;&nbsp;<a href=""><span class="oi oi-trash"></span></a></td>
                <td scope="col" >'.$rowreporte["nombre"].'</td>
                <td scope="col" >'.$numEmpleados.'</td>
                </tr>';
            }
            echo $result;
        break;
        case 'getListaCostoUnidad':
            $queryReporte = "SELECT und.nombre, cosNom.costo, cosNom.fecha
                            FROM costo_nomina AS cosNom
                            INNER JOIN unidad AS und ON und.id = cosNom.id_unidad
                            ORDER BY cosNom DESC";
            $result = "";
            foreach ($connec->query($queryReporte) as $rowreporte) {
                $result = $result.'<tr class="detallerepcomedor">
                <td scope="col"><a href="javascript:void(0);" onclick="addcompraRow()" class="addlinkprod"> <span class="oi oi-pencil"></span></a>&nbsp;&nbsp;<a href=""><span class="oi oi-trash"></span></a></td>
                <td scope="col" >'.$rowreporte["nombre"].'</td>
                <td scope="col" >'.$rowreporte["fecha"].'</td>
                <td scope="col" >'.number_format($rowreporte["costo"], 2, ',', '.').'</td>
                </tr>';
            }
            echo $result;
        break;
        case 'getListaMenu':
            $queryReporte = "SELECT com.nombre, men.fecha
                                FROM menu AS men
                                INNER JOIN comedor AS com ON com.id = men.id_comedor
                                ORDER BY men.fecha";
            $result = "";
            foreach ($connec->query($queryReporte) as $rowreporte) {
                $result = $result.'<tr class="detallerepcomedor">
                <td scope="col"><a href="javascript:void(0);" onclick="addcompraRow()" class="addlinkprod"> <span class="oi oi-pencil"></span></a>&nbsp;&nbsp;<a href=""><span class="oi oi-trash"></span></a></td>
                <td scope="col" >'.$rowreporte["nombre"].'</td>
                <td scope="col" >'.$rowreporte["fecha"].'</td>
                </tr>';
            }
            echo $result;
        break;
        case 'despachoRows':
            $lista='<tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                    <input type="hidden" id="id_comedor" name="id_comedor" value="'.$_POST['menuid'].'">';
            $queryMenu = "SELECT * FROM menu AS men WHERE men.id_comedor = '$_POST[menuid]' ORDER BY fecha DESC LIMIT 1";
            foreach ($connec->query($queryMenu) as $rowmenu) {
                $queryproductos = "SELECT prod.id AS prodid, prod.nombre,(detmen.eventos*prod.cant_percapita)*(SELECT SUM(detcom.empleados) FROM detalle_comedor AS detcom WHERE detcom.id_comedor = com.id) AS cantmenu, (SELECT SUM(detcom.empleados) FROM detalle_comedor AS detcom WHERE detcom.id_comedor = com.id) AS totalempleados
                FROM menu AS men
                INNER JOIN detalle_menu AS detmen ON detmen.id_menu = men.id
                INNER JOIN comedor AS com ON com.id = men.id_comedor
                INNER JOIN producto AS prod ON prod.id = detmen.id_producto
                WHERE men.id =  ".$rowmenu['id']."
                ORDER BY men.fecha";
                foreach ($connec->query($queryproductos) as $rowproductos) {
                    $lista=$lista.'<tr>
                        <th scope="row">
                        '.$rowproductos['nombre'].'
                        <input type="hidden" name="productoid" value="'.$rowproductos['prodid'].'">
                        </th>        
                        
                        <td>
                            
                            <input type="text" class="cantidad'.$rowproductos['prodid'].' form-control required" data-required="Ingrese una cantidad" name="cantidad" value="'.$rowproductos['cantmenu'].'">
                        </td>
                    </tr>';
                }
            }
            echo $lista;
        break;
        case 'createDespacho':
            $unidad_despacho = 0;
            $fecha_despacho = 0;
            $forma_fact = 0;
            $nota_fact = 0;
            $i = 0;
            $data = json_decode(stripslashes($_POST['compraObj']));

            foreach ($data as $item) {
                
                switch ($item->name) {
                    case 'unidad_despacho':
                        $unidad_despacho = $item->value;
                    break;
                    case 'fecha_despacho':
                        $fecha_despacho = $item->value;
                    break;
                    case 'id_comedor':
                        $id_comedor = $item->value;
                    break;
                    case 'productoid':
                        $detalleDespacho[$i][0] = $item->value;
                    break;
                    case 'cantidad':
                        $detalleDespacho[$i][1] = $item->value;
                        $i++;
                    break;
                }
            }
            $query = "INSERT INTO despacho(id_comedor, fecha) VALUES ('$id_comedor', '$fecha_despacho')";
            $queryexec = $connec->prepare($query); 
            $count = $queryexec->execute();
            $lastdespacho = $connec->lastInsertId(); 
            foreach ($detalleDespacho as $item) {
                //echo $item[0];
                //$query1 = "INSERT INTO compra_detalle(id_compra, id_producto, cantidad, precio_unitario) VALUES ('$lastdespacho','$item[0]', '$item[1]', '$item[2]')";

                $queryInventario = "SELECT id_inventario, id_producto, precio_unitario, cantidad_disponible as cantidad, id
                                FROM inventario_detalle
                                WHERE id_producto = '$item[0]'
                                AND id_tipomovimento = 1
                                AND cantidad_disponible > 0 
                                ORDER BY id ASC";
                $j = 0;
                $cantAux = $item[1];
                foreach ($connec->query($queryInventario) as $rowinventario) {
                    
                    if($rowinventario['cantidad'] >= $cantAux){
                        $movInv[$j][0] = $rowinventario['id_inventario'];
                        $movInv[$j][1] = $cantAux;
                        $movInv[$j][2] = $rowinventario['precio_unitario'];
                        $cantAux = $rowinventario['cantidad'] - $cantAux;
                        $queryUpdateInv = "UPDATE inventario_detalle SET cantidad_disponible=".$cantAux." WHERE id = ".$rowinventario['id'];
                        $queryexecUpdateInv = $connec->prepare($queryUpdateInv); 
                        $countUpdateInv = $queryexecUpdateInv->execute();
                        break;
                    }
                    else{
                        if($rowinventario['cantidad'] < $cantAux){
                            $movInv[$j][0] = $rowinventario['id_inventario'];
                            $movInv[$j][1] = round($rowinventario['cantidad']);
                            $cantAux = round($cantAux,2) - round($rowinventario['cantidad']);
                            $movInv[$j][2] = $rowinventario['precio_unitario'];
                            $queryUpdateInv = "UPDATE inventario_detalle SET cantidad_disponible = 0 WHERE id = ".$rowinventario['id'];
                            $queryexecUpdateInv = $connec->prepare($queryUpdateInv); 
                            $countUpdateInv = $queryexecUpdateInv->execute();
                        }
                    }
                    $j++;
                }
                foreach ($movInv as $itemInv) {
                    $querydetinv = "INSERT INTO inventario_detalle(id_inventario, id_producto, precio_unitario, cantidad, id_tipomovimento,cantidad_disponible) VALUES ('$itemInv[0]', '$item[0]', '$itemInv[2]', '$itemInv[1]' , 2, 0)";
                    $queryexecdetinv = $connec->prepare($querydetinv); 
                    $countdetinv = $queryexecdetinv->execute();
                }

                if($item[1] !="" && $item[1] > 0){
                    $query1 = "INSERT INTO despacho_detalle(id_producto, id_despacho, cantidad) VALUES ('$item[0]', '$lastdespacho', '$item[1]')";
                    $queryexec1 = $connec->prepare($query1); 
                    $count = $queryexec1->execute();
                }
            }

            
        break;
        case 'generarReporteinventario':
            $result = "";
            $queryReporte="SELECT P.nombre, SUM(detinv.cantidad) AS cantdisp,
                        (SELECT SUM(detinv2.cantidad) FROM inventario_detalle AS detinv2 WHERE detinv2.id_producto = detinv.id_producto AND detinv2.id_tipomovimento = 2) AS cantdesp,
                        SUM(detinv.cantidad) - (SELECT SUM(detinv2.cantidad) FROM inventario_detalle AS detinv2 WHERE detinv2.id_producto = detinv.id_producto AND detinv2.id_tipomovimento = 2) AS difinventario
                        FROM producto AS p
                        INNER JOIN inventario_detalle AS detinv ON detinv.id_producto = p.id
                        WHERE detinv.id_tipomovimento = 1
                        GROUP BY P.nombre, detinv.id_producto
                        ORDER BY P.nombre";
            foreach ($connec->query($queryReporte) as $rowreporte) {
                $result = $result.'<tr class="detallerepcomedor">
                <td scope="col" >'.$rowreporte["nombre"].'</td>
                <td scope="col" >'.number_format($rowreporte["cantdisp"], 2, '.', '').'</td>
                <td scope="col" >'.number_format($rowreporte["cantdesp"], 2, '.', '').'</td>
                <td scope="col" >'.number_format($rowreporte["difinventario"], 2, '.', '').'</td>
              </tr>';
            }
            echo $result;
        break;
        case 'validarUpdateDespacho':
            $data = json_decode(stripslashes($_POST['despachoObj']));
            $i = 0;
            $result = 1;
            foreach ($data as $item) {                
                switch ($item->name) {
                    case 'despachoid':
                        $despachoid = $item->value;
                    break;
                    case 'productoid':
                        $detalleComp[$i][0] = $item->value;
                    break;
                    case 'cantidad':
                        $detalleComp[$i][1] = str_replace(",",".",str_replace(".","",$item->value));
                    break;
                }
            }
            foreach($detalleComp AS $itemInv){
                $queryInvdet = $connec->prepare("SELECT SUM(cantidad) AS cantidad 
                                FROM inventario AS inv 
                                INNER JOIN inventario_detalle AS invdet ON inv.id = invdet.id_inventario 
                                WHERE invdet.cantidad_disponible > 0 AND invdet.id_producto = $itemInv[0] AND invdet.id_tipomovimento = 1");
                $queryInvdet->execute(); 
                $rowInvdet = $queryInvdet->fetch();
                
                if($rowInvdet['cantidad']>$itemInv[1]){
                    $result = 0;
                    break;
                }
            }
            echo $result;
        break;
        case 'updateDespacho':
        
            $data = json_decode(stripslashes($_POST['despachoObj']));
            $i = 0;
            $result = 1;
            foreach ($data as $item) {                
                switch ($item->name) {
                    case 'despachoid':
                        $despachoid = $item->value;
                    break;
                    case 'productoid':
                        $detalleDespacho[$i][0] = $item->value;
                    break;
                    case 'cantidad':
                        $detalleDespacho[$i][1] = str_replace(",",".",str_replace(".","",$item->value));
                        $i++;
                    break;
                }
            }
            $lastdespacho = $despachoid; 
            $ret =$despachoid;
            foreach ($detalleDespacho as $item) {
                $ret =$ret." - ".$item[1];
                //$query1 = "INSERT INTO compra_detalle(id_compra, id_producto, cantidad, precio_unitario) VALUES ('$lastdespacho','$item[0]', '$item[1]', '$item[2]')";

                $queryInventario = "SELECT id_inventario, id_producto, precio_unitario, cantidad_disponible as cantidad, id
                                FROM inventario_detalle
                                WHERE id_producto = '$item[0]'
                                ORDER BY id ASC LIMIT 1";
                $j = 0;
                $cantAux = $item[1];
                foreach ($connec->query($queryInventario) as $rowinventario) {
                    
                    if($rowinventario['cantidad'] >= $cantAux){
                        $movInv[$j][0] = $rowinventario['id_inventario'];
                        $movInv[$j][1] = $cantAux;
                        $movInv[$j][2] = $rowinventario['precio_unitario'];
                        $cantAux = $rowinventario['cantidad'] - $cantAux;
                        $queryUpdateInv = "UPDATE inventario_detalle SET cantidad_disponible=".$cantAux." WHERE id = ".$rowinventario['id'];
                        $queryexecUpdateInv = $connec->prepare($queryUpdateInv); 
                        $countUpdateInv = $queryexecUpdateInv->execute();
                        break;
                    }
                    else{
                        if($rowinventario['cantidad'] < $cantAux){
                            $movInv[$j][0] = $rowinventario['id_inventario'];
                            $movInv[$j][1] = round($rowinventario['cantidad']);
                            $cantAux = round($cantAux,2) - round($rowinventario['cantidad']);
                            $movInv[$j][2] = $rowinventario['precio_unitario'];
                            $queryUpdateInv = "UPDATE inventario_detalle SET cantidad_disponible = 0 WHERE id = ".$rowinventario['id'];
                            $queryexecUpdateInv = $connec->prepare($queryUpdateInv); 
                            $countUpdateInv = $queryexecUpdateInv->execute();
                        }
                    }
                    $j++;
                }
                foreach ($movInv as $itemInv) {
                    $querydetinv = "INSERT INTO inventario_detalle(id_inventario, id_producto, precio_unitario, cantidad, id_tipomovimento,cantidad_disponible) VALUES ('$itemInv[0]', '$item[0]', '$itemInv[2]', '$itemInv[1]' , 2, 0)";
                    $queryexecdetinv = $connec->prepare($querydetinv); 
                    $countdetinv = $queryexecdetinv->execute();
                }

                if($item[1] !="" && $item[1] > 0){
                    $query1 = "UPDATE despacho_detalle SET cantidad = '$item[1]' WHERE id_despacho = '$lastdespacho' AND id_producto = '$item[0]'";                    
                    $queryexec1 = $connec->prepare($query1); 
                    $count = $queryexec1->execute();
                }
            }
            echo $ret;
        break;
        case 'getListaCategorias':
            $filter = "";
            if(isset($_POST['id']) && $_POST['id'] != 0)
                $filter = "WHERE id = ".$_POST['id'];
            $query = "SELECT *
                    FROM categoria AS cat 
                    ".$filter."
                    ORDER BY cat.nombre";
            $statement = $connec->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
        break;
    }
?>