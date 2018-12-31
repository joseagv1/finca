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

function getCategorias(){
    $.ajax({
        method: "POST",
        url: 'process/process.php',
        data:{action: 'getCategorias'},
        cache: false,
        async: true,
        type: 'POST'
      })
        .done(function( e ) {
            
                $("#categorias").html('<option value="1">'+e+'</option>');
           
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
                data:{action: 'createProd',prod_name:$("#prod_name").val(),producto_categoria:$("#producto_categoria").val(),producto_empaque:$("#producto_empaque").val(),prod_desc:$("#prod_desc").val()},
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
                    $("."+id).removeClass( "newprod" );
               
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

$(document).ready(function($) {
        if($(".products")){
                getProductos("products");
                getMoneda("select_moneda");
        }
        if($("#detalle_lista")){
                getListaCompra();
        }
});

