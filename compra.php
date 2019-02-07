
<h1>Costo</h1>
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
        <th scope="row"><input type="text" class="form-control" name="num_fact" placeholder="Ingrese Numero Factura" required></th>
        <td><input type="date" class="form-control" name="fecha_fact"  required></td>
        <td><input type="text" class="form-control" name="forma_fact" placeholder="Ingrese Forma de pago" required></td>
        <td><input type="text" class="form-control" name="nota_fact" placeholder="Ingrese Nota" required></td>
        <td><select class="custom-select" name="tasacompra" id="tasacompra"></select></td>
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
        <td><input type="text" class="form-control cant_prod" name="cant_prod"  required></td>
        <td><input type="text" class="form-control precio_prod" name="precio_prod" required> </td>
      </tr> -->
    </tbody>
  </table>
  <div  style="text-align:left; float:left;"><a href="javascript:void(0);" onclick="addcompraRow(0)" class="addlinkprod"> <span class="oi oi-plus" title="plus" aria-hidden="true"></span></a></div>
  <div  style="text-align:right; float:right;"><button type="button" class="btn btn-primary" onclick="createCompra()">Guardar</button></div>
  <input type="hidden" id="comprapage" name="comprapage" value="">
</div>
</form>