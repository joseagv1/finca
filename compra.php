
<h1>Compra</h1>
<form id="compraform" >
<div class="form-group">
  <table class="table">
    <thead class="thead-dark"">
      <tr>
        <th scope="col" ># </th>
        <th scope="col">Fecha</th>
        <th scope="col">Forma Pago</th>
        <th scope="col">Nota</th>
        <th scope="col">Tasa Cambio</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><input type="text" class="form-control required" name="num_fact" placeholder="Ingrese Numero Factura" data-required="Ingrese Un numero de Factura"></th>
        <td><input type="date" class="form-control required" name="fecha_fact" data-required="Ingrese una fecha"></td>
        <td><input type="text" class="form-control " name="forma_fact" placeholder="Ingrese Forma de pago" ></td>
        <td><input type="text" class="form-control " name="nota_fact" placeholder="Ingrese Nota" ></td>
        <td><select class="custom-select required" name="tasacompra" id="tasacompra" data-required="Seleccione una tasa de cambio"></select></td>
      </tr>
      <!-- <tr>
        <td colspan="2"><select class="custom-select" name="select_moneda" id="select_moneda" onchange="getTasa('select_moneda','tasa_compra')"></select></td>
        <td colspan="2"><select class="custom-select" name="tasa_compra" id="tasa_compra"><option>Seleccione tasa</option></select></td>
      </tr> -->
    </tbody>
  </table>
  <!-- <table class="table">
    <tbody>
      <tr>
        <th scope="row">Moneda <select class="custom-select" name="select_moneda" id="select_moneda"></select></th>
        <td>Tasa Cambio <select class="custom-select" name="select_moneda" id="tasa"></select></td>
      </tr>
    </tbody>
  </table> -->
  <table class="table" id="detalle_compra">
    <thead class="thead-dark"">
      <tr>
        <th scope="col" >Proucto</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Precio Unitario</th>
      </tr>
    </thead>
    <tbody>
      <!-- <tr>
        <th scope="row">
          <div class="input-group mb-3">
            <select class="custom-select products" name="productoid">
            </select>
          </div>
        </th>
        <td><input type="text" class="form-control cant_prod" name="cant_prod"  ></td>
        <td><input type="text" class="form-control precio_prod" name="precio_prod" > </td>
      </tr> -->
    </tbody>
  </table>
  <div  style="text-align:left; float:left;"><a href="javascript:void(0);" onclick="showproductomodal(1)" class="addlinkprod"> <span class="oi oi-plus" title="plus" aria-hidden="true"></span></a></div>
  <div  style="text-align:right; float:right;"><button type="button" class="btn btn-primary" onclick="createCompra()">Guardar</button></div>
  <input type="hidden" id="comprapage" name="comprapage" value="">
  <input type="hidden" id="preselecttasa" name="preselecttasa" value="">
</div>
</form>