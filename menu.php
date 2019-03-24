<h1>Menu</h1>
<form id="menuform" >
<div class="form-group">
  <table class="table">
      <tr>
        <td>
          <div class="input-group mb-3">
            <select class="custom-select" name="comedor_id" id="comedor_id"></select>
          </div>
        </td>
        <td>
          <input type="hidden " class="form-control" name="fecha_menu"  required>
        </td>
      </tr>
  </table>
  <table class="table" id="detalle_menu">
    <thead class="thead-dark"">
      <tr>
        <th scope="col">Producto</th>
        <th scope="col">Cant. Percapita</th>
        <th scope="col">Eventos</th>
        <th scope="col">Sub. Total Eventos</th>
      </tr>
    </thead>
    <tbody>
      <!--  -->
    </tbody>
  </table>   
  <!-- <div  style="text-align:left; float:left;"><a href="javascript:void(0);" onclick="addMenuRow()" class="addlinkprod"> <span class="oi oi-plus" title="plus" aria-hidden="true"></span></a></div> -->
  <div  style="text-align:right; float:right;"><button type="button" class="btn btn-primary" onclick="createMenu()">Guardar</button></div>
  <input type="hidden" id="menupage" name="menupage" value="">
</div>
</div>
</form>