<h1>Inventario</h1>
<table class="table" id="">
      <tr>
        <td>
        <select class="custom-select" name="comedor_id" id="comedor_id"></select>
        </td>  
      </tr>
      <!-- <tr>
        <td>
        <select class="custom-select" name="compra_id" id="compra_id"></select>
        </td>  
      </tr> -->
  </table>
  <div  style="text-align:center; float:center;margin-bottom: 30px;"><button type="button" class="btn btn-primary" onclick="generarReporteinventario()">Generar</button></div> 
  
  <table class="table" id="reporte_inventario_detalle" style="display:none;">
    <thead class="thead-dark"">
      <tr>
        <th scope="col">Producto</th>
        <th scope="col">Total Compra</th>
        <th scope="col">Total Despachado</th>
        <th scope="col">Disponible Inventario</th>
      </tr>
    </thead>
  </table>