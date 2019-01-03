<h1>Comedor</h1>
<form id="comedorform" >
<div class="form-group">
  <table class="table" id="">
    <thead class="thead-dark"">
      <tr>
        <th scope="col">Nombre Comedor</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><input type="text" class="form-control" name="nom_comedor" placeholder="Ingrese Nombre" required></th>  
      </tr>
    </tbody>
  </table>
  <table class="table" id="unidades_comedor">
    <thead class="thead-dark"">
      <tr>
        <th scope="col">Unidad Produccion</th>
        <th scope="col">Cant. Empleados</th>
      </tr>
    </thead>
    <tbody>
      <tr>       
        <td>
            <div class="input-group mb-3">
                <select class="custom-select unidadprod" name="unidad_prod" id="unidad_prod" onchange="getEmpleadosComedor(this.value)"></select>
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <select class="custom-select cant_empleados" name="cant_empleados" id="cant_empleados"></select>
            </div>
        </td>
      </tr>
    </tbody>
  </table>   
  <div  style="text-align:left; float:left;"><a href="javascript:void(0);" onclick="addUnidadRow()" class="addlinkprod"> <span class="oi oi-plus" title="plus" aria-hidden="true"></span></a></div>
  <div  style="text-align:right; float:right;"><button type="button" class="btn btn-primary" onclick="createComedor()">Guardar</button></div>
</div>
</div>
</form>