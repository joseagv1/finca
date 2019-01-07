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
          <input type="date" class="form-control" name="fecha_menu"  required>
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
      <tr>
        <td scope="row">
          <div class="input-group mb-3">
            <select class="custom-select products" name="productoid" onchange="getDetalleProducto(this.value)">
            </select>
          </div>
        </td>        
        <td><span class="cant_percapita" id="cant_percapita" name="cant_percapita"></span><input type="hidden" class="cant_percapita" value=""></td>
        <td>
            <div class="input-group mb-3">
                <select class="custom-select cant_eventos" name="cant_eventos" onchange="refreshSubEventos(this.value)">
                    <?php
                    for($i=1;$i<=100;$i++){
                        echo '<option id='.$i.'>'.$i.'</option>';
                    }
                    ?>
                </select>
            </div>
        </td>
        <td><span class="subt_eventos" id="subt_eventos" name="subt_eventos"></span><input type="hidden" class="subt_eventos" value=""></td>
      </tr>
    </tbody>
  </table>   
  <div  style="text-align:left; float:left;"><a href="javascript:void(0);" onclick="addMenuRow()" class="addlinkprod"> <span class="oi oi-plus" title="plus" aria-hidden="true"></span></a></div>
  <div  style="text-align:right; float:right;"><button type="button" class="btn btn-primary" onclick="createMenu()">Guardar</button></div>
</div>
</div>
</form>