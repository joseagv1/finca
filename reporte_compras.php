<h1>Orden De Pedido</h1>
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
  <div  style="text-align:center; float:center;margin-bottom: 30px;"><button type="button" class="btn btn-primary" onclick="generarReporteCompras()">Generar</button></div>
  
  <table class="table" id="reporte" style="display:none;">
    <thead class="thead-dark"">
      <tr>
        <th scope="col" >Producto</th>
        <th scope="col">Total Compra</th>
        <th scope="col">Disponible Inventario</th>
        <th scope="col">Diferencia</th>
      </tr>
    </thead>
  </table>