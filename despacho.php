<h1>Depacho</h1>
<form id="compraform" >
<div class="form-group">
  <table class="table">
    <thead class="thead-dark"">
      <tr>
        <th scope="col" >Unidad Produccion</th>
        <th scope="col">Fecha</th>
        <th scope="col">Nota</th>
        <th scope="col">Compra</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><select class="custom-select" name="unidad_prod" id="unidad_prod"><option>Seleccione una Unidad</option></select></th>
        <td><input type="date" class="form-control" name="fecha_despacho"  required></td>
        <td><input type="text" class="form-control" name="nota_fact" placeholder="Ingrese Nota" required></td>
        <td><select class="custom-select" name="compra_id" id="compra_id" onchange="showdetallecomp(this.value)"><option>Seleccione Compra</option></select></td>
      </tr>
    </tbody>
  </table>
  <table class="table" id="detalle_despacho">
  </table>
  
  
  <div  style="text-align:right; float:right;"><button type="button" class="btn btn-primary" onclick="createCompra()">Guardar</button></div>
</div>
</div>
</form>