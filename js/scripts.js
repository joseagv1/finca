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

function validationForm(extraClass){
        var error = 0;
        jQuery(".required"+extraClass).filter( ":visible" ).filter(function(){return this.value}).removeClass("requireClass");
        if(jQuery(".required"+extraClass).filter( ":visible" ).filter(function(){return !this.value}).length){
                jQuery(".required"+extraClass).filter( ":visible" ).filter(function(){return !this.value}).addClass("requireClass");
                jQuery(".required"+extraClass).filter( ":visible" ).filter(function(){ if(!this.value && jQuery(this).data("required")){ showNotify('Error: '+jQuery(this).data("required"),'danger'); } });
                error = 1;
        }
        return error;
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
        /*$.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getEmpaque'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#tipo_empaque").html(e);
                   
                });*/
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

function showproductomodal(reloadList){
        $("#reloadList").val(0);
        $("#editProdid").val(0);
        $("#prod_name").val("");
        $("#prod_desc").val("");        
        $("#cant_percapita").val("");
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
                        if(reloadList==1){
                                $("#reloadList").val(1);
                        }
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
        var error=0;
        error=validationForm(".form-producto");
        if(!error){
                /*if($("#prod_name").val() == ""){
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
                }*/
                $.ajax({
                        method: "POST",
                        url: 'process/process.php',
                        data:{action: 'createProd',prodid: $("#editProdid").val(),prod_name:$("#prod_name").val(),producto_categoria:$("#producto_categoria").val(),producto_empaque:$("#producto_empaque").val(),prod_desc:$("#prod_desc").val(),cant_percapita:$("#cant_percapita").val()},
                        cache: false,
                        async: true,
                        type: 'POST'
                        })
                        .done(function( e ) {
                        console.log(e);
                                if(e != 'Error'){
                                showNotify("Nuevo producto fue creado","success");
                                if($("#reloadList").val()==1)
                                        compraRows();
                                $("#nuevo_prod").modal('hide');
                                if($("#productoform").length > 0){
                                        getListaProductos();
                                }
                        } 
                });
                $("#prod_name").val('');
                $("#producto_categoria").val('');
                $("#producto_empaque").val('');
                $("#prod_desc").val('');
                //if($("#editProdid").val()!=0)
                        
        }
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

function editProducto(id){
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
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getProductoPorId', id: id},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        var objJson = $.parseJSON(e);
                        //showproductomodal(0);
                        $("#prod_name").val(objJson[0]["nombre"]);
                        $("#prod_desc").val(objJson[0]["descripcion"]);
                        $("#producto_categoria").val(objJson[0]["id_categoria"]);
                        $("#cant_percapita").val(objJson[0]["cant_percapita"]);
                        $("#editProdid").val(id);
                        $('#nuevo_prod').modal('show');
                });
}

function getListaProductos(){
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
                        var listProds = "";
                        for(i=0;i<objJson.length;i++){
                                tools ='<a href="javascript:void(0);" onclick="editProducto('+objJson[i]["id"]+')" class="addlinkprod"> <span class="oi oi-pencil"></span></a>&nbsp;&nbsp;<a href=""><span class="oi oi-trash"></span></a>';
                                listProds = listProds + "<tr><td>"+tools+"</td><td>"+objJson[i]["nombre"]+"</td><td>"+objJson[i]["categoria"]+"</td><td>"+objJson[i]["cant_percapita"]+"</td></tr>";
                        }
                        $("#lista_producto").html(listProds);
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
        $(".compraRows").remove();
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
        var error=0;
        error=validationForm("");
        var cantvaciototal=0;
        $(".cant_prod").each(function(){
                if($(this).val() == "" || $(this).val() == 0){
                        cantvaciototal++;
                }
        });
        var preciovaciototal=0;
        $(".precio_prod").each(function(){
                if($(this).val() == "" || $(this).val() == 0){
                        preciovaciototal++;
                }
        });
        if($(".cant_prod").length == cantvaciototal){
                showNotify('Error: Ingrese cantidad mayor a 0 almenos algun producto','danger');
                error = 1;
        }
        if($(".precio_prod").length == preciovaciototal){
                showNotify('Error: Ingrese precio mayor a 0 almenos algun producto','danger');
                error = 1;
        }
        /*if($("#tasacompra option:selected").val() == ""){
                showNotify('Error: Seleccione una tasa de cambio o cree una nueva','danger');
                error = 1;
        }*/
        if(error == 0){
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
                                //console.log(e);
                                showNotify('Factura Ingresada','success');
                                $(".compraRows").remove();
                                compraRows();
                                getMoneda("select_moneda");
                                getTasaCompra("tasacompra","");
                        }); 
        }
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

function editCompra(id,moneda){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'showfactura', id: id, moneda:moneda, opcion:2},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        //$("#spanMoneda").html('<select class="custom-select" id="fact_moneda" onchange="showfactura(id)"></select>');                        
                        getMonedaFactura("fact_moneda",id);
                        $("#tabla_detalle_lista").html(e);
                        getTotalFactura(id);                   
                        //$("#tabla_detalle_lista").show();
                        $('#detalle_compra').modal('show');
                        $("#botones_modificar").show();
                });
}

function validarUpdateCompra(){
        var error = validationForm(".form-editar-compra");
        if(!error){
                var compraObj = $("#compraform").serializeArray();
                $.ajax({
                        method: "POST",
                        url: 'process/process.php',
                        data:{action: 'validarUpdateCompra',compraObj:JSON.stringify(compraObj)},
                        cache: false,
                        async: true,
                        type: 'POST'
                })
                        .done(function( e ) {
                        console.log(e);
                        if(e==0){
                                alert("Cantidad errada");
                        }
                        else{
                                updateCompra();
                        }
                        
                        });
        } 
}

function updateCompra(){
        var compraObj = $("#compraform").serializeArray();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'updateCompra',compraObj:JSON.stringify(compraObj)},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      console.log(e);
                      $('#detalle_compra').modal('hide');
                    
                   
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
        $("#botones_modificar").hide();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'showfactura', id: id, moneda:moneda, opcion:1},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        $("#spanMoneda").html('<select class="custom-select" id="fact_moneda" onchange="showfactura(id)"></select>');                        
                        getMonedaFactura("fact_moneda",id);
                        $("#tabla_detalle_lista").html(e);
                        getTotalFactura(id);                   
                        //$("#tabla_detalle_lista").show();
                        $('#detalle_compra').modal('show');
                });
}

function getTasa(moneda_id,tasa_compra){
        //console.log(moneda_id);
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

function getTasaCompra(id,preselecttasa){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getTasaCompra'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                    
                        $("#"+id).html(e);
                        if(preselecttasa!='')
                                $('#'+id+' option[value="'+preselecttasa+'"]').prop('selected', true);
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

function createTasaCambioCompra(){
        showTasaCambioModal();
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
                type: 'POST',
                complete: function( e ) {
                        console.log(e.responseText);
                                if(e != 'Error'){
                                showNotify("Nuevo Tasa de cambio fue creada","success");
                                $("#nuevaTasaCambio").modal('hide');
                                if($("#preselecttasa").length && $("#tasacompra").length){
                                        //alert(e.responseText);
                                        getTasaCompra("tasacompra",e.responseText);
                                       // $('#tasacompra option[value="'+e.responseText+'"]').prop('selected', true);
                                }
                        } 
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
                        options=options+"<option value='0'>Todos</option>";
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
                data:{action: 'generarReporteCompras', idcomedor:$("#comedor_id option:selected").val(), idcategoria:$("#categoria_id option:selected").val()},
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
                        getListaUnidad();
                } 
        });
        $("#unidadprodid").val('');
        $("#costo_nomina").val('');
        
}

function showCostoUnidad(unidad_id){
        $("#unidadprodid").val(unidad_id);
        $("#nuevo_costo_unidad").modal('show');
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
        var error = validationForm("");
        if(!error){
                var compraObj = $("#despachoform").serializeArray();
                //console.log(compraObj);
                $.ajax({
                        method: "POST",
                        url: 'process/process.php',
                        data:{action: 'createDespacho',compraObj:JSON.stringify(compraObj)},
                        cache: false,
                        async: true,
                        type: 'POST'
                })
                .done(function( e ) {
                //console.log(e);
                /*    $("#detalle_compra").append(e);
                        getProductos("newprod");*/
                
                }); 
        }
}

function generarReporteinventario(){
        //$("#reporte_inventario_detalle").html('');
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'generarReporteinventario'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        console.log(e);
                        $("#reporte_inventario_detalle").append(e);
                        $("#reporte_inventario_detalle").show();
                }); 
}

function getListaDespacho(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getListaDespacho'},
                cache: false,
                async: true,
                type: 'POST'
              })
        .done(function( e ) {
                
                $("#lista_despacho").html(e);
                
        });
}

function editDespacho(id){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'showdespacho', id: id, opcion:2},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        //$("#spanMoneda").html('<select class="custom-select" id="fact_moneda" onchange="showfactura(id)"></select>');                        
                        getMonedaFactura("fact_moneda",id);
                        $("#tabla_detalle_lista").html(e);
                        getTotalFactura(id);                   
                        //$("#tabla_detalle_lista").show();
                        $('#detalle_compra').modal('show');
                        $("#botones_modificar").show();
                });
}

function showdespacho(id){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'showdespacho', id: id, opcion:1},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        //$("#spanMoneda").html('<select class="custom-select" id="fact_moneda" onchange="showfactura(id)"></select>');                        
                        getMonedaFactura("fact_moneda",id);
                        $("#tabla_detalle_lista").html(e);
                        getTotalFactura(id);                   
                        //$("#tabla_detalle_lista").show();
                        $('#detalle_compra').modal('show');
                        $("#botones_modificar").show();
                });
}

function validarUpdateDespacho(){
        var error = validationForm(".form-editar-despacho");
        if(!error){
                var despachoObj = $("#despachoform").serializeArray();
                $.ajax({
                        method: "POST",
                        url: 'process/process.php',
                        data:{action: 'validarUpdateDespacho',despachoObj:JSON.stringify(despachoObj)},
                        cache: false,
                        async: true,
                        type: 'POST'
                })
                        .done(function( e ) {
                        console.log(e);
                        if(e==0){
                                alert("Cantidad errada");
                        }
                        else{
                                updateDespacho();
                        }
                        
                        });
        } 
}

function updateDespacho(){
        var despachoObj = $("#despachoform").serializeArray();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'updateDespacho',despachoObj:JSON.stringify(despachoObj)},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                      console.log(e);
                      $('#detalle_compra').modal('hide');
                    
                   
                }); 
}

function getListaCategorias(){
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getListaCategorias'},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        var objJson = $.parseJSON(e);
                        var listProds = "";
                        for(i=0;i<objJson.length;i++){
                                tools ='<a href="javascript:void(0);" onclick="editCategoria('+objJson[i]["id"]+')" class="addlinkprod"> <span class="oi oi-pencil"></span></a>&nbsp;&nbsp;<a href=""><span class="oi oi-trash"></span></a>';
                                listProds = listProds + "<tr><td>"+tools+"</td><td>"+objJson[i]["nombre"]+"</td></tr>";
                        }
                        $("#lista_categoria").html(listProds);
                });
}

function editCategoria(id){
        showcategoriamodal();
        $.ajax({
                method: "POST",
                url: 'process/process.php',
                data:{action: 'getListaCategorias',id: id},
                cache: false,
                async: true,
                type: 'POST'
              })
                .done(function( e ) {
                        var objJson = $.parseJSON(e);
                        $("#category_nomb").val(objJson[0].nombre);
                        $("#category_desc").val(objJson[0].descripcion);
                        $("#edit_categoria_id").val(id);
                });
}

$(document).ready(function($) {
        if($("#comprapage").length>0){
                //getProductos("products");
                compraRows();
                getMoneda("select_moneda");
                getTasaCompra("tasacompra","");
                //cargarListaProductos();
        }
        if($("#lista_compra").length>0){
                getListaCompra();
        }
        if($("#lista_despacho").length>0){
                getListaDespacho();
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
                getComedor('unidad_despacho');
        }
        if($("#reporte_compras").length > 0){
                getCategorias("categoria_id");
        }
        if($("#productoform").length > 0){
                getListaProductos();
        }
        if($("#categoriaform").length > 0){
                getListaCategorias();
        }
        
});

