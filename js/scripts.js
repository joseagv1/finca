function toJSONString(formname) {
        var form = document.getElementById( formname );
        var obj = {};
        var elements = form.querySelectorAll( "input, select, textarea" );
        for( var i = 0; i < elements.length; ++i ) {
                var element = elements[i];
                //var name = element.name;
                var value = element.value;
                var a = new Array();
                a[value] = value;

               //if( name ) {
                        obj[ name ] = a;
               // }
        }

        return JSON.stringify( obj );
}

// Types: success,warning,danger,info

function showNotify(messagePar,typePar){
	if($('.alert').is(':visible') && !messagePar && !typePar){
		return false
	}
	if(typePar){
		lastMessageType = typePar;
	}
	if(messagePar && messagePar.length > 0){
		lastMessage = messagePar;
	}
	if(lastMessage && lastMessage!=""){
                $.notify(
                        {
                                message: lastMessage
                        },{
                                animate: {
                                        enter: 'animated fadeInRight',
                                        exit: 'animated fadeOutRight'
                                },
                                offset:{
                                        y: 55,
                                        x: 20
                                },
                                type: lastMessageType,
                                newest_on_top: true,
                                element: 'body',
                                mouse_over: 'pause',
                                z_index: 2147483647
                        }
                );
	}
}

function getCategorias(id){
    $.ajax({
        method: "POST",
        url: 'process/process.php',
        data:{action: 'getCategorias'},
        cache: false,
        async: true,
        type: 'POST'
      })
        .done(function( e ) {
            
                $("#"+id).html(e);
           
        });
}

function createEmpType(){
        if($("#empaq_nomb").val() == ""){
                showNotify("Nombre del empaque es obligatorio","danger");
                return false;
        }
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createEmpType',empaq_nomb:$("#empaq_nomb").val(),empaq_desc:$("#empaq_desc").val()},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                
                        if(e != 'Error'){
                        showNotify("Nuevo tipo de empaque fue creado","success");
                        $("#nuevo_tipo_empa").modal('hide');
                } 
        });
        $("#empaq_nomb").val('');
        $("#empaq_desc").val('');
}

function showempaquemodal(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getTipoEmpaque'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#emp_tipo").html(e);
                   
                });
        $('#nuevo_empa').modal('show');
}


function createEmpaque(){
        if($("#emp_nomb").val() == ""){
                showNotify("Nombre del empaque es obligatorio","danger");
                return false;
        }
        if($("#emp_tipo option:selected").val()==""){
                showNotify("Seleccione un tipo de empaque","danger");
                return false;
        }
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createEmpaque',emp_nomb:$("#emp_nomb").val(),emp_tipo:$("#emp_tipo option:selected").val(),emp_cant:$("#emp_cant").val()},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                
                        if(e != 'Error'){
                        showNotify("Nuevo empaque fue creado","success");
                        $("#nuevo_empa").modal('hide');
                } 
        });
        $("#emp_nomb").val('');
        $("#emp_tipo").val('');
}


function showcategoriamodal(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getEmpaque'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#tipo_empaque").html(e);
                   
                });
        $('#nueva_categoria').modal('show');
}

function createCategory(){
        if($("#category_nomb").val() == ""){
                showNotify("Nombre de la categoria es obligatorio","danger");
                return false;
        }
        if($("#tipo_empaque option:selected").val()==""){
                showNotify("Seleccione un empaque","danger");
                return false;
        }
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createCategoria',category_nomb:$("#category_nomb").val(),category_desc:$("#category_desc").val()},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                console.log(e);
                        if(e != 'Error'){
                        showNotify("Nuevo categoria fue creada","success");
                        $("#nueva_categoria").modal('hide');
                } 
        });
        $("#category_nomb").val('');
        $("#tipo_empaque").val('');
}

function showproductomodal(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getEmpaque'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#producto_empaque").html(e);
                   
                });
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getCategorias'},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                        
                        $("#producto_categoria").html(e);
                        
                });
        $('#nuevo_prod').modal('show');
}

function createProd(){
        if($("#prod_name").val() == ""){
                showNotify("Nombre de la categoria es obligatorio","danger");
                return false;
        }
        if($("#producto_categoria option:selected").val()==""){
                showNotify("Seleccione una categoria","danger");
                return false;
        }
        if($("#producto_empaque option:selected").val()==""){
                showNotify("Seleccione un empaque","danger");
                return false;
        }
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createProd',prod_name:$("#prod_name").val(),producto_categoria:$("#producto_categoria").val(),producto_empaque:$("#producto_empaque").val(),prod_desc:$("#prod_desc").val(),cant_percapita:$("#cant_percapita").val()},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                console.log(e);
                        if(e != 'Error'){
                        showNotify("Nuevo producto fue creada","success");
                        $("#nuevo_prod").modal('hide');
                } 
        });
        $("#prod_name").val('');
        $("#producto_categoria").val('');
        $("#producto_empaque").val('');
        $("#prod_desc").val('');
}

function getProductos(id){
        $.ajax({
            method: "POST",
            url: 'process/process.php',
            data:{action: 'getProductos'},
            cache: false,
            async: true,
            type: 'POST'
          })
            .done(function( e ) {
                
                    $("."+id).html(e);
                    $("."+id).removeClass( id );
               
            });
}

function menuRows(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'menuRows'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      
                    $("#detalle_menu").append(e);
                    //getProductos("newprod");
                   
                });
}

function addcompraRow(){
        $.ajax({
            method: "POST",
            url: 'process/process.php',
            data:{action: 'addcompraRow'},
            cache: false,
            async: true,
            type: 'POST'
          })
            .done(function( e ) {
                  
                $("#detalle_compra").append(e);
                getProductos("newprod");
               
            });
}

function compraRows(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'compraRows'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      
                    $("#detalle_compra").append(e);
                        //getProductos("newprod",prodid);
                   
                });
}

function cargarListaProductos(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getListaProductos'},
                cache: false,
                async: true,
                type: 'POST'
              })
        .done(function( e ) {
                var objJson = $.parseJSON(e);
                //console.log(objJson);
                for(i=0;i<objJson.length;i++){
                        
                        addcompraRow(objJson[i].id); 
                        //getProductos("newprod",objJson[i].id);
                }
                
        });
        
}

function createCompra(){
        var compraObj = $("#compraform").serializeArray();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createCompra',compraObj:JSON.stringify(compraObj)},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      console.log(e);
                    /*    $("#detalle_compra").append(e);
                        getProductos("newprod");*/
                   
                }); 
}

function getListaCompra(){
        $.ajax({
            method: "POST",
            url: 'process/process.php',
            data:{action: 'getListaCompra'},
            cache: false,
            async: true,
            type: 'POST'
          })
            .done(function( e ) {
                
                    $("#lista_compra").html(e);
               
            });
}

function getTotalFactura(id){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getTotalFactura', id: id},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#totalCompra").html(e);

                });
}

function showfactura(id,moneda){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'showfactura', id: id, moneda:moneda},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        $("#spanMoneda").html('<select class="custom-select" id="fact_moneda" onchange="showfactura(id)"></select>');                        
                        getMonedaFactura("fact_moneda",id);
                        $("#tabla_detalle_lista").html(e);
                        getTotalFactura(id);                   
                        $("#tabla_detalle_lista").show();
                });
}

function getTasa(moneda_id,tasa_compra){
        console.log(moneda_id);
        moneda_id = $("#"+moneda_id+" option:selected").val();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getTasa', moneda_id: moneda_id, tasa_compra:tasa_compra},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#"+tasa_compra).html(e);

                })
}

function getMonedaFactura(id,fact_id){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getMonedaFactura', id: id, fact_id:fact_id},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#"+id).html(e);

                });
}

function showCrearMonedaModal(){
        $("#nueva_moneda").modal('show');
}

function getMoneda(id){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getMoneda'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#"+id).html(e);
                        
                });
}

function showTasaCambioModal(){
        getMoneda("select_moneda1");
        getMoneda("select_moneda2");
        $("#nuevaTasaCambio").modal('show');
}

function createMoneda(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createMoneda',moneda_nomb:$("#moneda_nomb").val()},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                console.log(e);
                        if(e != 'Error'){
                        showNotify("Nuevo moneda fue creada","success");
                        $("#nueva_moneda").modal('hide');
                } 
        });
}

function createTasaCambio(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createTasaCambio',tasacambio:$("#tasacambio").val(),select_moneda1:$("#select_moneda1").val(),select_moneda2:$("#select_moneda2").val(),fecha_tasa:$("#fecha_tasa").val()},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                console.log(e);
                        if(e != 'Error'){
                        showNotify("Nuevo Tasa de cambio fue creada","success");
                        $("#nuevaTasaCambio").modal('hide');
                } 
        });
}

function createUnidad(){
        if($("#unidad_nomb").val() == ""){
                showNotify("Nombre de la unidad es obligatorio","danger");
                return false;
        }
        if($("#unidad_empleados").val()==""){
                showNotify("Numeros de empleados es obligatorio","danger");
                return false;
        }
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createUnidad',unidad_nomb:$("#unidad_nomb").val(),unidad_empleados:$("#unidad_empleados").val(),unidad_descripcion:$("#unidad_descripcion").val()},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                console.log(e);
                        if(e != 'Error'){
                        showNotify("Nueva unidad fue creada","success");
                        $("#nueva_unidad").modal('hide');
                } 
        });
        $("#category_nomb").val('');
        $("#tipo_empaque").val('');
}

function getUnidadProd(id){
        $.ajax({
            method: "POST",
            url: 'process/process.php',
            data:{action: 'getUnidadProd'},
            cache: false,
            async: true,
            type: 'POST'
          })
            .done(function( e ) {
                
                    $("#"+id).html(e);
               
            });
}
function getCompras(id){
        $.ajax({
            method: "POST",
            url: 'process/process.php',
            data:{action: 'getCompras'},
            cache: false,
            async: true,
            type: 'POST'
          })
            .done(function( e ) {
                
                    $("#"+id).html(e);
               
            });
}

function showdetallecomp(id){
        var unidad_prod = $("#unidad_prod option:selected").val();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'showdetallecomp', id: id, unidad_prod:unidad_prod},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#detalle_despacho").html(e);
                   
                });
}

function getDetalleProducto(id){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getDetalleProducto',id:id},
                cache: false,
                async: true,
                type: 'POST'
        })
        .done(function( e ) {
                var objJson = $.parseJSON(e);
                //console.log(objJson[0].id);
                $(".cant_percapita").html(parseFloat(objJson[0].cant_percapita).toFixed(2));
                $(".subt_eventos").html(parseFloat( objJson[0].cant_percapita*$(".cant_eventos option:selected").val() ).toFixed(2) );
                /*$("#subt_costo").html(parseFloat(objJson[0].precio_unitario).toFixed(2));
                $("#comensales").html(objJson[0].total_comensales);                
                $("#tot_compra").html(parseFloat(objJson[0].total_comensales*objJson[0].cant_percapita*$("select[class='cant_eventos'] option:selected").val()).toFixed(2));
                $("#total_costo").html(parseFloat(objJson[0].total_comensales*objJson[0].cant_percapita*$("select[class='cant_eventos'] option:selected").val()*parseFloat(objJson[0].precio_unitario)).toFixed(2));*/
                
        });
}

function refreshSubEventos(id){
        //$(".cant_percapita").html(parseFloat(objJson[0].cant_percapita).toFixed(2));
        $(".subt_eventos"+id).html(parseFloat($(".cant_percapita"+id).html()*$(".cant_eventos"+id+"").val()).toFixed(2));
        /*$("#subt_eventos").html(parseFloat($(".cant_percapita").html()*$("select[class='cant_eventos'] option:selected").val()).toFixed(2));
        $("#tot_compra").html(parseFloat($("#comensales").html())*parseFloat($("#cant_percapita").html()*$("select[class='cant_eventos'] option:selected").val()).toFixed(2));
        $("#total_costo").html(parseFloat($("#comensales").html())*parseFloat($("#cant_percapita").html()*$("select[class='cant_eventos'] option:selected").val()*parseFloat($("#subt_costo").html()).toFixed(2)));*/
}

function addMenuRow(){
        $.ajax({
            method: "POST",
            url: 'process/process.php',
            data:{action: 'addMenuRow'},
            cache: false,
            async: true,
            type: 'POST'
          })
            .done(function( e ) {
                    $(".products").removeClass("products");
                    $(".cant_percapita").removeClass("cant_percapita");
                    $(".subt_eventos").removeClass("subt_eventos");
                    $(".cant_eventos").removeClass("cant_eventos");

                    $("#detalle_menu").append(e);
                    getProductos("products");
               
            });
}

function createMenu(){
        var compraObj = $("#menuform").serializeArray();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createMenu',compraObj:JSON.stringify(compraObj)},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      console.log(e);
                   
                   
                }); 
}

function getEmpleadosComedor(id){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getEmpleados',id:id},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        var objJson = $.parseJSON(e);   
                        var options="";
                        for(i=1;i<=objJson[0]['empleados'];i++){
                                options=options+"<option value='"+i+"'>"+i+"</option>";
                        }
                        $("#cant_empleados").html(options);
                }); 
}


function addUnidadRow(){
        $.ajax({
            method: "POST",
            url: 'process/process.php',
            data:{action: 'addUnidadRow'},
            cache: false,
            async: true,
            type: 'POST'
          })
            .done(function( e ) {
                    /*$(".products").removeClass("products");
                    $(".cant_percapita").removeClass("cant_percapita");
                    $(".subt_eventos").removeClass("subt_eventos");
                    $(".cant_eventos").removeClass("cant_eventos");*/
                    $(".unidadprod").removeAttr('id');
                    $(".cant_empleados").removeAttr('id');
                    $("#unidades_comedor").append(e);
                    getUnidadProd('unidad_prod');
                    //getProductos("products");
               
            });
}

function createComedor(){
        var compraObj = $("#comedorform").serializeArray();
        console.log(compraObj);
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createComedor',compraObj:JSON.stringify(compraObj)},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      console.log(e);
                   
                   
                }); 
}

function getComedor(id){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getComedor'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        var objJson = $.parseJSON(e);   
                        console.log(objJson.length);
                        var options="<option value=''>Seleccione Comedor</option>";
                        for(i=0;i<objJson.length;i++){
                                options=options+"<option value='"+objJson[i]['id']+"'>"+objJson[i]['nombre']+"</option>";
                        }
                        $("#"+id).html(options);
                }); 
}

function generarReporteComedor(){
        var id = $("#comedor_id option:selected").val();
        var id_compra = $("#compra option:selected").val();
        var fecha_compra = $("#dia_compra option:selected").val();
        $(".detallerepcomedor").remove();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'generarReporteComedor',id: id, id_compra: id_compra,fecha_compra:fecha_compra},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        $("#reporte").append(e);
                        $("#reporte").show();
                }); 
}

function generarReporteCentroCostos(){
        $(".detallerepcentrocostos").remove();
        var fecha_compra = $("#dia_compra option:selected").val();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'generarReporteCentroCostos', id: $("#categoria_id option:selected").val(),fecha_compra:fecha_compra},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        $("#reporte_centro_costos").append(e);
                        $("#reporte_centro_costos").show();
                }); 
}

function generarReporteCompras(){
        $(".detallerepcomedor").remove();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'generarReporteCompras', idcomedor:$("#comedor_id option:selected").val()},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        $("#reporte").append(e);
                        $("#reporte").show();
                }); 
}

function crearCostoNomina(){
        if($("#unidadprodid option:selected").val() == ""){
                showNotify("Seleccione una unidad de produccion","danger");
                return false;
        }
        if($("#costo_nomina").val()==""){
                showNotify("Ingrese un costo","danger");
                return false;
        }
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'crearCostoNomina',unidadid:$("#unidadprodid option:selected").val(),costo:$("#costo_nomina").val()},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                console.log(e);
                        if(e != 'Error'){
                        showNotify("Nuevo costo por unidad fue creado","success");
                        $("#nuevo_costo_unidad").modal('hide');
                } 
        });
        $("#unidadprodid").val('');
        $("#costo_nomina").val('');
}

function getDiasCompras(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getListaCompras'},
                cache: false,
                async: true,
                type: 'POST'
                })
                .done(function( e ) {
                        var objJson = $.parseJSON(e);   
                        //console.log(objJson.length);
                        var options="<option value=''>Ultimo</option>";
                        for(i=0;i<objJson.length;i++){
                                options=options+"<option value='"+objJson[i]['fecha']+"'>"+objJson[i]['fecha']+"</option>";
                        }
                        $("#dia_compra").html(options);
        }); 
}

function getListaUnidad(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getListaUnidad'},
                cache: false,
                async: true,
                type: 'POST'
              })
        .done(function( e ) {
                $("#lista_unidad").html(e);
                /*var objJson = $.parseJSON(e);
                //console.log(objJson);
                for(i=0;i<objJson.length;i++){
                        $("#lista_unidad").html(e);
                        //addcompraRow(objJson[i].id); 
                        //getProductos("newprod",objJson[i].id);
                }*/
                
        });
}

function getListaCostoUnidad(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getListaCostoUnidad'},
                cache: false,
                async: true,
                type: 'POST'
              })
        .done(function( e ) {
                $("#lista_costo_unidad").html(e);
                /*var objJson = $.parseJSON(e);
                //console.log(objJson);
                for(i=0;i<objJson.length;i++){
                        $("#lista_unidad").html(e);
                        //addcompraRow(objJson[i].id); 
                        //getProductos("newprod",objJson[i].id);
                }*/
                
        });
}

function getListaMenu(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getListaMenu'},
                cache: false,
                async: true,
                type: 'POST'
              })
        .done(function( e ) {
                $("#lista_menu").html(e);
                /*var objJson = $.parseJSON(e);
                //console.log(objJson);
                for(i=0;i<objJson.length;i++){
                        $("#lista_unidad").html(e);
                        //addcompraRow(objJson[i].id); 
                        //getProductos("newprod",objJson[i].id);
                }*/
                
        });
}
function despachoRows(){
        $("#detalle_despacho").html('');
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'despachoRows',menuid:$("#unidad_despacho option:selected").val()},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      
                    $("#detalle_despacho").append(e);
                    //getProductos("newprod");
                   
                });
}

function createDespacho(){
        var compraObj = $("#despachoform").serializeArray();
        console.log(compraObj);
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'createDespacho',compraObj:JSON.stringify(compraObj)},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      console.log(e);
                    /*    $("#detalle_compra").append(e);
                        getProductos("newprod");*/
                   
                }); 
}

$(document).ready(function($) {
        if($("#comprapage").length>0){
                //getProductos("products");
                compraRows();
                getMoneda("select_moneda");
                //cargarListaProductos();
        }
        if($("#lista_compra").length>0){
                getListaCompra();
        }
        if($("#unidad_prod").length>0){
                getUnidadProd('unidad_prod');
                getCompras('compra_id');
        }
        if($("#comedor_id").length>0){
                getComedor('comedor_id');
                getCompras('compra_id')
        }
        if($("#categoria_id").length>0){
                getCategorias('categoria_id');
        }
        if($("#unidadprodid").length>0){
                getUnidadProd('unidadprodid');
        }
        if($("#menupage").length>0){
                menuRows();
        }
        if($("#dia_compra").length > 0 ){
                getDiasCompras();
        }
        if($("#lista_unidad").length > 0 ){
                getListaUnidad();
        }
        if($("#lista_costo_unidad").length > 0){
                getListaCostoUnidad();
        }
        if($("#lista_menu").length > 0){
                getListaMenu();
        }
        if($("#detalle_despacho").length > 0){
                getUnidadProd('unidad_despacho');
        }
});

