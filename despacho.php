<h1>Depacho</h1>
<form id="despachoform" >
<div class="form-group">
  <table class="table">
    <thead class="thead-dark"">
      <tr>
        <th scope="col" >Unidad Produccion</th>
        <th scope="col">Fecha</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><select class="custom-select required" name="unidad_despacho" id="unidad_despacho" data-required="Seleccione una Unidad" onchange="despachoRows()"><option>Seleccione una Unidad</option></select></th>
        <td><input type="date" class="form-control required" name="fecha_despacho" data-required="Ingrese una Fecha"></td>
      </tr>
    </tbody>
  </table>
  <table class="table" id="detalle_despacho">
    
  </table>
  
  
  <div  style="text-align:right; float:right;"><button type="button" class="btn btn-primary" onclick="createDespacho()">Guardar</button></div>
</div>
</div>
</form>