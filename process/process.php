<?php
    switch ($_POST["action"]) {
        case "createEmpType":            
            include_once "tipo_empaque.php"; 
            break;
        case 'getTipoEmpaque':
            include_once "tipo_empaque.php"; 
            break;
        case 'createEmpaque':
            include_once "tipo_empaque.php"; 
            break;
        case 'getEmpaque':
            include_once "tipo_empaque.php"; 
            break;
        case 'createCategoria':
            include_once "tipo_empaque.php"; 
            break;
        case 'getCategorias':
            include_once "tipo_empaque.php"; 
            break;
        case 'createProd':
            include_once "tipo_empaque.php"; 
            break;
        case 'getProductos':
            include_once "tipo_empaque.php"; 
            break;
        case 'addcompraRow':
            include_once "tipo_empaque.php"; 
            break;
        case 'createCompra':
            include_once "tipo_empaque.php"; 
            break;
        case 'getListaCompra':
                include_once "tipo_empaque.php"; 
                break;
        case 'showfactura':
                include_once "tipo_empaque.php";
                break;
        case 'getTotalFactura':
                include_once "tipo_empaque.php";
                break;
        case 'createMoneda':
                include_once "tipo_empaque.php";
                break;
        case 'getMoneda':
                include_once "tipo_empaque.php";
                break;
        case 'createTasaCambio':
                include_once "tipo_empaque.php";
                break;
        case 'getMonedaFactura':
                include_once "tipo_empaque.php";
                break;
        case 'getTasa':
                include_once "tipo_empaque.php";
                break;
    }
?>